<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$post_date = file_get_contents("php://input");
		$_POST = json_decode($post_date,TRUE); 
	}

	public function index()
	{
		$this->load->view('template');
	}

	public function home()
	{
		$this->load->view('home');
	}	
	public function templateSidebar()
	{
		$this->load->view('template_sidebar');
	}	
	public function templateNavbar()
	{
		$this->load->view('template_navbar');
	}



}
