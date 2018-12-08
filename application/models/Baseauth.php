<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 12:10
 */
class Baseauth extends CI_Model
{
    public $appjson = 'application/json';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function checkHttpReferer($href='')
    {
        $base_url = base_url();
        if(is_null($href))
        {
            return false;
        }
        else if($href==$base_url)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function checkAuthorization($table,$condition='',$select='*')
    {
        $results = json_decode(file_get_contents(APPPATH.'libraries/REST_API/token.json'),true);
        if($results['mytoken'] == $condition['mytoken'] && $results['tname'] == $condition['tname'] && $results['status'] == $condition['status'] )
        {
            return true;
        }
        else
            return false;
    }
}