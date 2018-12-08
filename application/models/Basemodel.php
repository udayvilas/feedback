<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 12:13
 */
class Basemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function execute_qry($qry='')
    {
        if($qry!='')
        {
            $res = $this->db->query($qry);
            return $res->result_array();
        }
        else
        {
            return false;
        }
    }

    function run_qry($qry='')
    {
        if($qry!='')
        {
            $res = $this->db->query($qry);
            return $res;
        }
        else
        {
            return false;
        }
    }
    function fetch_records_from($table, $condition = '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }
    function fetch_records_from_pagination($table, $condition = '', $select = '*', $order_by = '', $order_type='asc', $limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }

    function awesome_fetch_records_from_multi_where_pagination($table, $where = '' ,$qry_where='', $where_in= '',$where_in_field='', $where_not_in='',$where_not_in_key='', $select = '*', $order_by = '', $order_type='asc',$limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($where))
            $this->db->where($where);

        if(!empty($qry_where))
            $this->db->where($qry_where);

        if($where_in_field!='' && !empty($where_in))
            $this->db->where_in($where_in_field, $where_in);

        if($where_not_in_key!='' && !empty($where_not_in))
            $this->db->where_not_in($where_not_in_key, $where_not_in);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if($limit!='')
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }
    function awesome_fetch($table, $where = '' ,$qry_where='', $where_in= '',$where_in_field='', $where_not_in='',$where_not_in_key='', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($where))
            $this->db->where($where);

        if(!empty($qry_where))
            $this->db->where($qry_where);

        if($where_in_field!='' && !empty($where_in))
            $this->db->where_in($where_in_field, $where_in);

        if($where_not_in_key!='' && !empty($where_not_in))
            $this->db->where_not_in($where_not_in_key, $where_not_in);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }

    function fetch_records_from_multi_where($table, $condition1 = '',$condition2= '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }
    function fetch_records_from_multi_where_like($table, $condition1 = '',$condition2= '',$like='', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }

    function fetch_records_from_multi_where_vndr($table, $condition1 = '',$condition2= '', $select = '*', $order_by = '', $order_type='asc',$limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if($limit!='')
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }
    function fetch_records_from_multi_where_pagination($table, $condition1 = '',$condition2= '', $select = '*', $order_by = '', $order_type='asc',$limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if($limit!='')
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }

    function fetch_records_from_three_multi_where($table, $condition1 = '',$condition2= '',$condition3= '', $select = '*', $order_by = '', $order_type='asc', $limit='',$like='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($condition3))
            $this->db->where($condition3);

        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }

    function fetch_records_from_three_multi_where_pagination($table, $condition1 = '',$condition2 = '',$con3 ='', $select = '*', $order_by = '', $order_type='asc',$limit='',$limit_from='0',$like='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($con3))
            $this->db->where($con3);

        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if($limit!='')
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }
    function fetch_records_from_where_not_in($table, $condition = '',$where_in='',$where_in_array = '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if($where_in!='' && !empty($where_in_array))
            $this->db->where_not_in($where_in, $where_in_array);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }

    function select_max_val($table,$column)
    {
        $this->db->select_max($column);
        $result = $this->db->get($this->db->dbprefix($table))->row_array();
        return $result[$column];
    }
    function num_of_rows($table)
    {
        $table_row_count = $this->db->count_all($this->db->dbprefix($table));
        return  $table_row_count;
    }
    function num_of_res($table,$condition='',$qry_condition='',$order_by='',$order_type='ASC',$like='')
    {
        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($qry_condition))
            $this->db->where($qry_condition);

        if(!empty($like))
            $this->db->like($like);
        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        $this->db->from($this->db->dbprefix($table));
        $count = $this->db->count_all_results();
        return $count;
    }
    function count_no_of_records($table,$where='')
    {
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($where))
            $this->db->where($where);

        $total = $this->db->count();
        return $total;
    }
    function count_no_distinct_records($table,$select,$where='',$where2='',$like='',$order_by='',$order_type='ASC')
    {
        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($where))
            $this->db->where($where);

        if(!empty($where2))
            $this->db->where($where2);

        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        $total = $this->db->count_all_results();
        return $total;
    }
    function fetch_records_with_like($table, $condition = '',$like='', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);
        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }
    function sum_of_column($table,$select,$condition='',$qry_condition='',$like='')
    {
        $this->db->select_sum($select);
        $this->db->from($this->db->dbprefix($table));
        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($qry_condition))
            $this->db->where($qry_condition);

        if(!empty($like))
            $this->db->like($like);

        $result = $this->db->get();
        $res = $result->result();
        $ret='';
        if( count( $res ) > 0 )
        {
            $ret = $res[0]->$select;
            if($ret=='')
            {
                $ret=0;
            }
        }
        else
            $ret = '-';
        return $ret;
    }
    function fetch_records_with_like_pagination($table, $condition = '',$like='', $select = '*', $order_by = '', $order_type='asc', $limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);
        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }
    function get_column_with_like($table, $condition = '',$like='', $select = '')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);
        if(!empty($like))
            $this->db->like($like);

        $result_rs = $this->db->get();

        $result = $result_rs->result();

        if( count( $result ) > 0 )

            $ret = $result[0]->$select;
        else
            $ret = '-';
        return $ret;
    }
    function fetch_distinct_records($table, $condition = '', $select = '', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }
    public function fetch_records_groupby($table, $condition = '', $select = '', $group_by='',$order_by = '', $order_type='asc', $limit='')
    {
        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($group_by))
            $this->db->group_by($group_by);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }

    function get_single_distinct_column_value($table, $column, $where)
    {
        $this->db->distinct();
        $this->db->select($column,FALSE);

        $this->db->from( $this->db->dbprefix( $table ) );

        if( !empty( $where ) )
            $this->db->where( $where );

        $result_rs = $this->db->get();

        $result = $result_rs->result();

        if( count( $result ) > 0 )

            $ret = $result[0]->$column;
        else
            $ret = '-';
        return $ret;
    }


    function fetch_single_row($table, $condition = '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        $list = $result->result_array();
        if(!empty($list))
            return $list[0];
        else
            return array();
    }

    function fetch_single_row_multi_where($table, $condition = '',$condition2 = '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($condition2))
            $this->db->where($condition2);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        $list = $result->result_array();
        if(!empty($list))
            return $list[0];
        else
            return array();
    }

    function fetch_single_row_obj($table, $condition = '', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition))
            $this->db->where($condition);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        $list = $result->result();
        return $list[0];
    }

    function get_single_column_value($table, $column, $where,$order_by = '', $order_type='asc',$limit='')
    {
        $this->db->select($column,FALSE);

        $this->db->from( $this->db->dbprefix( $table ) );

        if( !empty( $where ) )
            $this->db->where( $where );
        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);
        if(!empty($limit))
            $this->db->limit($limit,$limit);
        $result_rs = $this->db->get();

        $result = $result_rs->result();

        if( count( $result ) > 0 )

            $ret = $result[0]->$column;
        else
            $ret = '-';
        return $ret;
    }
    function insert_into_table($table,$data)
    {
        if($this->db->insert($this->db->dbprefix($table),$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function update_operation($inputdata,$table,$where)
    {
        $result  = $this->db->update($this->db->dbprefix($table),$inputdata, $where);
        return $result;
    }

    function exclDate($EXCEL_DATE)
    {
        $UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;

        $EXCEL_DATE = 25569 + ($UNIX_DATE / 86400);

        $UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
        return gmdate("Y-m-d", $UNIX_DATE);
    }

    function convertExcelDate($date='')
    {
        $val = "";
        if(strpos($date,'-')!=false || strpos($date,'.')!=false)
        {
            $val=date('Y-m-d',strtotime($date));
        }
        else if(is_numeric($date) && $date!="")
        {
            $val=$this->exclDate($date);
        }
        else
        {
            $val = "1970-01-01";
        }

        return $val;
    }
    function timeDifference($start_datetime,$end_date_time,$return='days')
    {
        //change times to Unix timestamp.
        $start = strtotime($start_datetime);
        $end = strtotime($end_date_time);
        //subtract dates
        $difference = $end - $start;
        $time = NULL;
        //calculate time difference.
        switch($return)
        {
            case 'minutes':
                $minutes = floor($difference/60);
                $difference = $difference % 60;
                $time .= $minutes;
                break;
            case 'days':
                $days = ceil($difference/86400);
                $difference = $difference % 86400;
                $time .= $days;
                break;
        }
        return $time;
    }


    function fetch_records_with_like_multiwhere($table, $condition1 = '',$condition2 = '',$like='', $select = '*', $order_by = '', $order_type='asc', $limit='')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);
        if(!empty($condition2))
            $this->db->where($condition2);
        if(!empty($like))
            $this->db->like($like);

        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if(!empty($limit))
            $this->db->limit($limit);

        $result = $this->db->get();
        return $result->result_array();
    }
    function fetch_records_from_multi_where_pagination_like($table, $condition1 = '',$condition2= '',$like, $select = '*', $order_by = '', $order_type='asc',$limit='',$limit_from='0')
    {
        $this->db->select($select, FALSE);
        $this->db->from( $this->db->dbprefix($table));

        if(!empty($condition1))
            $this->db->where($condition1);

        if(!empty($condition2))
            $this->db->where($condition2);
        if(!empty($like))
            $this->db->like($like);
        if(!empty($order_by))
            $this->db->order_by($order_by,$order_type);

        if($limit!='')
            $this->db->limit($limit,$limit_from);

        $result = $this->db->get();
        return $result->result_array();
    }
    function count_digit($number) {
        return strlen($number);
    }
    function divider($number_of_digits) {
        $tens="1";
        while(($number_of_digits-1)>0)
        {
            $tens.="0";
            $number_of_digits--;
        }
        return $tens;
    }
    function nubersincourse($num)
    {
        $ext="";//thousand,lac, crore
        $number_of_digits = $this->count_digit($num); //this is call :)
        if($number_of_digits<1){
            $ext= $ext/100000;
        }
        if($number_of_digits>3)
        {
            if($number_of_digits%2!=0)
                $divider=$this->divider($number_of_digits-1);
            else
                $divider=$this->divider($number_of_digits);
        }
        else
            $divider=1;

        $fraction=$num/$divider;
        $fraction=number_format($fraction,2);
        if($number_of_digits==4 ||$number_of_digits==5)
            $ext="K";
        if($number_of_digits==6 ||$number_of_digits==7)
            $ext="L";
        if($number_of_digits==8 ||$number_of_digits==9)
            $ext="C";
        return $fraction." ".$ext;
    }
    function  to_lakhs($val)
    {
        if($val!=0)
        {
            return $val/100000;
        }
        else
        {
            return 0;
        }
    }
    function  to_cr($val)
    {
        if($val!=0)
        {

            return $val/1000000;
        }
        else
        {
            return 0;
        }
    }
    function dateformate($days,$formate)
    {
        $month = date("Y-m-d", strtotime(date('Y-m-d'))) . " + ".$days ." ". $formate;
        return date('Y-m-d',strtotime($month));
    }
    public function delete_row($table,$where=array())
    {
        if(!empty($where))
        {
            $this->db->where($where);
            $this->db->delete($this->db->dbprefix($table));
        }
        return true;
    }

    public function result_validation($result)
    {
        $data = array();
        if($result)
        {
            if(!empty($result))
            {
                $data["response"] = SUCCESSDATA;
                $data["list"] = $result;
                $data["status"] = "Success";
            }
            else
            {
                $data["response"] = EMPTYDATA;
                $data["list"] = [];
                $data["status"] = "No Data";
            }
        }
        else
        {
            $data["response"] = FAILEDDATA;
            $data["status"] = "Something Went Wrong";
        }

        return $data;
    }
}