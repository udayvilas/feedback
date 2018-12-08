<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 19/03/2018
 * Time: 10:17
 */
class Reports extends CI_Controller
{
    public $shref = NULL;
    public $true_href = NULL;
    public $otb_content_type = NULL;
    public $otb_authorization = NULL;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('token');
        $this->load->model('baseauth');
        $this->load->model('basemodel');
        $this->load->model('obasemodel');
        $this->load->model('users');
        $this->load->model('result_hd');
        $this->load->model('results');
        $this->load->model('branchs');

    }

    public function index()
    {
        include_once APPPATH.'libraries/REST_API/MainRest.php';
    }

    private function _key_rest($base_data='',$content_type='')
    {
        if(!is_null($base_data) && $content_type==$this->baseauth->appjson)
        {
            $data = array();
            $jodata = json_decode($base_data);
            $action = $jodata->action;
            if($action=="reg_member_list")
                $data = $this->_reg_member_list($jodata);
            else if($action=="save_exam")
                $data = $this->_save_exam($jodata);
            else if($action == "loadbranchs")
                $data = $this->_loadbranchs();
            else if($action == "no_of_reg")
                $data = $this->_no_of_reg($jodata);
            else if($action == "gender_cal")
                $data = $this->_gender_cal($jodata);
            else if($action == "merit_cal")
                $data = $this->_merit_cal($jodata);

            echo json_encode($data);
        }
    }

    public function _reg_member_list($input)
    {
        $fromdt = date('Y-m-d', strtotime($input->fromdt));
        $todt = date('Y-m-d', strtotime($input->todt));
        $qgroup = $input->qgroup;

        $orwhere = $this->result_hd->CREATED_ON ." between '". $fromdt. "' AND '" .$todt . "' ";
        $res = $this->basemodel->fetch_records_from_multi_where($this->result_hd->tbl_name,array($this->result_hd->Q_GROUP => $qgroup),$orwhere,'',$this->result_hd->MARKS);

        if(!empty($res)) {
            for($i = 0; $i < sizeof($res); $i++ )
            {
                $uname = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $res[$i]['USER_ID']));
                $res[$i]['USER_NAME'] = $uname;
            }
        }
        return $this->basemodel->result_validation($res);
    }

    public function _loadbranchs()
    {
        $res = $this->basemodel->fetch_records_from($this->branchs->tbl_name, array($this->branchs->STATUS => ACTIVESTS));
        return $this->basemodel->result_validation($res);
    }

    public function _no_of_reg($input)
    {
        $list = $this->_loadbranchs();
        $list = $list['list'];

        $branch = $input->branch;
        $group = $input->dept;

        $total_reg = 0;
        for($i = 0; $i < sizeof($list); $i++ )
        {
            if($group == 'All')
                $list[$i]['count'] = $this->basemodel->num_of_res($this->result_hd->tbl_name, array($this->result_hd->BRANCH => $list[$i]['BRANCH_ID']));
            else
                $list[$i]['count'] = $this->basemodel->num_of_res($this->result_hd->tbl_name, array($this->result_hd->BRANCH => $list[$i]['BRANCH_ID'], $this->result_hd->Q_GROUP => $group));

            if($branch == 'All')
            {
                $total_reg += $list[$i]['count'];
                $list[$i]['active'] = false;
            }
            else if($list[$i]['BRANCH_ID'] == $branch)
            {
                $list[$i]['active'] = true;
                $total_reg = $list[$i]['count'];
            }
            else
                $list[$i]['active'] = false;
        }

        $all = array("BRANCH_ID"=> 'All',
            "BRANCH_NAME" => 'All Units',
            "BRANCH_CODE" => 'All',
            "STATUS"=>'A',
            "count" => $total_reg,
            "active" => ($branch == 'All') ? true : false
        );

        array_unshift($list, $all);

        $data['response'] = SUCCESSDATA;
        $data['list'] = $list;
        $data['total_reg'] = $total_reg;

        return $data;
    }

    public function _gender_cal($input)
    {
        $branch = $input->branch;
        $group = $input->dept;

        $where = '';
        if($branch != 'All' )
            $where = " AND a.BRANCH = '".$branch."'";
        if($group != 'All' )
            $where .= " AND a.Q_GROUP = '".$group."'";

        $qry = "SELECT b.GENDER, count(*) cnt FROM `exam_result_hd` a, exam_users b  WHERE a. `USER_ID` = b.`USER_ID` ".$where." GROUP BY b.GENDER order by b.GENDER ";
        $res = $this->basemodel->execute_qry($qry);

        if(!empty($res))
        {
            $male = $res[1]['cnt'];
            $female = $res[0]['cnt'];
            $total = $male + $female;

            $male = round((float)($male / $total) * 100, 2);
            $female = round((float)($female / $total) * 100, 2);

            $res_arr = array(array("name"=> "Male","y"=> $male),
                array("name"=> "Female","y"=> $female )
            );

        }
        else
        {
            $res_arr = array(array("name"=> "Male","y"=> 0,"drilldown"=> "Male"),
                array("name"=> "Female","y"=> 0,"drilldown"=> "Female")
            );
        }

        $data['response'] = SUCCESSDATA;
        $data['list'] = $res_arr;

        return $data;
    }

    public function _merit_cal($input)
    {
        $branch = $input->branch;
        $group = $input->dept;

        $where = '';
        if($branch != 'All' )
            $where = " BRANCH = '".$branch."'";
        if($group != 'All' )
        {
            if($where != '')
                $where .= " and Q_GROUP = '".$group."'";
            else
                $where .= " Q_GROUP = '".$group."'";
        }

        if($where != '')
            $where = " where ".$where;

        $qry = "SELECT GRADE, COUNT(*) CNT FROM `exam_grades` ".$where." GROUP BY GRADE ";
        $list = $this->basemodel->execute_qry($qry);

        $total = 0;
        for($i = 0; $i < sizeof($list); $i++)
            $total += (int)$list[$i]['CNT'];

        $res = array();
        for($i = 0; $i < sizeof($list); $i++)
        {
            $res[$i] = (object)array("name"=>$list[$i]['GRADE'], 'y'=>round((float)( ($list[$i]['CNT'] / $total) * 100),2));
        }

        if(empty($res))
            $res[0] = (object)array("name"=>"No Records", 'y'=>100);

        $data['response'] = SUCCESSDATA;
        $data['list'] = $res;
        return $data;
    }

}