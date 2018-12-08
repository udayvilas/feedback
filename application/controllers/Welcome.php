<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function home()
    {
        $this->load->view('home');
    }

	public function header()
    {
        $this->load->view('basic/header');
    }

	public function sidebar()
    {
        $this->load->view('basic/sidebar');
    }

	public function footer()
    {
        $this->load->view('basic/footer');
    }

	public function content()
    {
        $this->load->view('question_paper');
    }

	public function reports()
    {
        $this->load->view('member_list');
    }

	public function dashboard()
    {
        $this->load->view('dashboard');
    }

    public function check()
    {
        $this->load->view('welcome_message');
    }

    public function qgroups()
    {
        $this->load->view('qgroups');
    }

    public function qlists()
    {
        $this->load->view('qlists');
    }

    public function addquestion()
    {
        $this->load->view('dialogs/addquestion');
    }


}
