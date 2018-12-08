<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 09/03/2018
 * Time: 11:55
 */
class OBasemodel extends CI_Model
{
    public $odbc;
    public function __construct()
    {
        parent::__construct();

        // $this->odbc = odbc_connect("BANJARA", "JEEVADB" , "CARE$2273$");
        //$this->load->database();
    }

    function fetch_records_from($qry)
    {
        $result = array();
        if($qry!='')
        {
            $res = odbc_exec($this->odbc , $qry );
            $count = 0;
            while($row = odbc_fetch_array($res))
            {
                $result[$count] = $row;
                $count++;
            }
            return $result;
        }
        else
        {
            return $result;
        }
    }






}