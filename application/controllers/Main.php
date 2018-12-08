<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 07/02/2018
 * Time: 11:49
 */
class Main extends CI_Controller
{
    public function index()
    {
        $this->load->view('main');
    }
	
    public function get_patipno()
    {
        $this->load->view('dialogs/get_pat_ipno');
    }
    public function get_zcodename()
    {
        $this->load->view('dialogs/get_zcodename');
    }

}