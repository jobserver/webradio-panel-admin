<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller 
{


	public function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model');
		$this->Login_model->logged();
		
		$post_date = file_get_contents("php://input");
		$_POST = json_decode($post_date,TRUE); 
		$this->load->model('admin_model','admin');
	}

	public function index()
	{
		echo 	modules::run('template/index');
	}

	public function dashboard()
	{
		$dados = [
			'musicaNova'      => $this->admin->musicaTotal(),
			'ultimasPedidas'  => $this->admin->ultimasPedidas(),
			'oracaoNova'      => $this->admin->oracaoTotal(),
			'programas'       => $this->admin->programas(),
			'aniversariantes' => $this->admin->aniversariantes()
		];

		$hash = md5(json_encode($dados));

		if ($this->input->post('hash') != $hash) 
		{			
			echo json_encode(['hash'=>$hash,'dados'=>$dados]);
		}


	}
	
	public function salvarVideoAoVivo()
	{
		if($this->input->post('url'))
		{
			$dados = $this->admin->videoAoVivo(array('codigo'=>$this->session->radio_codigo));
		}
		
		echo json_encode($dados);
	}


/////// carrega as configurações da rádio /////////////////////////
	public function getRadio()
	{		
		$row =	$this->db->where('codigo', $this->session->radio_codigo)->get('radio', 1, 0)->row_array();
		$hash = md5(json_encode($row));
		echo json_encode(['hash'=>$hash,'dados'=>$row]);
	}

	public function home()
	{
		$this->load->view('home');

	}	
	public function pedirMusica()
	{
		$this->load->view('tela_pedir_musica');
	}
	public function oracao()
	{
		$this->load->view('tela_oracao');
	}
	public function programacao()
	{
		$this->load->view('tela_programacao');
	}
	public function configuracao()
	{
		$this->load->view('tela_configuracao');
	}
	public function enquete()
	{
		$this->load->view('tela_enquete');
	}



}
