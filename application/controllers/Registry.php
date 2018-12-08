<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Venkat
 * Date: 09/03/2018
 * Time: 10:57
 */
class Registry extends CI_Controller
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
             if($action=="get_exam_questions")
                $data = $this->_get_exam_questions($jodata);
             else if($action=="save_exam")
                $data = $this->_save_exam($jodata);

            echo json_encode($data);
        }
    }

    public function _get_exam_questions($input)
    {
        $qgroup = $input->qgroup;
        $callfrom = isset($input->callFrom) ? $input->callFrom : '';

        if($callfrom == '')
            $qry = "SELECT * FROM `exam_m_qst` WHERE `Q_GROUP` = '".$qgroup."' order by RAND() limit 25  ";
        else
            $qry = "SELECT * FROM `exam_m_qst` WHERE `Q_GROUP` = '".$qgroup."' order by Q_ID ";
        $quest = $this->basemodel->execute_qry($qry);

        for($i = 0; $i < count($quest); $i++) {
            for ($j = 0; $j < $quest[$i]['MAX_OPT']; $j++) {
                $opt = 'OPT' . ($j + 1);
                $quest[$i]['OPT_ARR'][$j] = $quest[$i][$opt];
            }
        }
        $res = $this->basemodel->result_validation($quest);
        return $res;
    }

    public function _save_exam($input)
    {
        $user_id = isset($input->user_id) ? $input->user_id : $this->session->exam_uid;
        $insert[$this->result_hd->USER_ID] = $user_id;
        $insert[$this->result_hd->BRANCH] = $input->exam_branch;
        $insert[$this->result_hd->Q_GROUP] = $input->qgroup;
        $insert[$this->result_hd->TOTAL_QUEST] = $input->total_quest;
        $insert[$this->result_hd->ANS_QUS] = sizeof($input->exam_data);
        $insert[$this->result_hd->LEFT_QUS] = (int)$input->total_quest - ((int)$input->wrong_ans + (int)$input->currect_ans);
        $insert[$this->result_hd->CUR_ANS] = (int)$input->currect_ans;
        $insert[$this->result_hd->WRG_ANS] = (int)$input->wrong_ans;
        $insert[$this->result_hd->MARKS] = (int)$input->currect_ans;
        $insert[$this->result_hd->PERCENT] = (int)$input->percent;
        $insert[$this->result_hd->CREATED_ON] = date('Y-m-d');
        $insert[$this->result_hd->CREATED_AT] = date('H:i:s');

        $this->basemodel->insert_into_table($this->result_hd->tbl_name, $insert);

        for($i = 0; $i < count($input->exam_data); $i++){
            $row1 = $input->exam_data[$i];

            $qinsert[$this->results->USER_ID] = isset($input->user_id) ? $input->user_id : $this->session->exam_uid;
            $qinsert[$this->results->Q_GROUP] = $input->qgroup;
            $qinsert[$this->results->Q_ID] = $row1->q_id;
            $qinsert[$this->results->ANS] = $row1->value;
            $qinsert[$this->results->Q_TYPE] = $row1->type;

            $this->basemodel->insert_into_table($this->results->tbl_name, $qinsert);
        }

        $update[$this->users->EXAM_STATUS] = 'Y';
        $where[$this->users->USER_ID] = $user_id;

        $this->basemodel->update_operation($update, $this->users->tbl_name, $where);

        $data["response"] = SUCCESSDATA;
        $data["status"] = "Success";

        return $data;
    }


}