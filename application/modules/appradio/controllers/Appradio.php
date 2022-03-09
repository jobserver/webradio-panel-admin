<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppRadio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$post_date = file_get_contents("php://input");
		$_POST = json_decode($post_date,TRUE); 
	}

	public function index()
	{
		echo 'carregado';
	}
/////// carrega as configurações da rádio /////////////////////////
	public function votarEnquete()
	{		
		
		$radioId = $this->input->post('radioId');
		$opcao   = $this->input->post('opcao');
		$enquete = $this->input->post('enquete');

		$row =	$this->db->where(array('radio_codigo'=>$radioId,'id'=>$enquete,'status'=>'1') )->get('enquete', 1, 0)->row_array();
		if (	$row) {

			$dadosN  = $row;
			$dadosN['itens']  = json_decode($dadosN['itens'],true);

//soma mais um voto
			$dadosN['itens'][$opcao]['valor'] = (int) $dadosN['itens'][$opcao]['valor'] +1;
			$total_g = 0;
			foreach ($dadosN['itens'] as $y => $va) 
			{
				if ($va['item'] !='') 
				{      
					$total_g +=(int) $va['valor'];
				}
			}

			foreach ($dadosN['itens'] as $y => $va) 
			{ 	
				$dadosN['itens'][$y]['porcentagem'] = 0;
				$dadosN['itens'][$y]['valor'] = (int)$va['valor'];
				if ($va['valor'] !='' && $va['valor'] !=0) 
				{ 
					$dadosN['itens'][$y]['porcentagem'] = round(($va['valor'] * 100)/ $total_g,2).'%';
				}
			}

 //salva no banco de dados o novo valor;
			$this->db->where(array('radio_codigo'=>$radioId,'id'=>$enquete,'status'=>'1') )
			->update('enquete',['itens'=>json_encode( $dadosN['itens'] ) ] );

			$hash = md5(json_encode($dadosN));

			if ($this->input->post('hash') != $hash) 
			{			
				echo json_encode(['hash'=>$hash,'dados'=>$dadosN]);
			}

		}

	}

	/////// carrega as configurações da rádio /////////////////////////
	public function getEnquete()
	{		
		$radioId = $this->input->post('radioId');
		$row =	$this->db->where(array('radio_codigo'=>$radioId,'status'=>'1') )->get('enquete', 1, 0)->row_array();

		$dadosN  = $row;
		$dadosN['itens']  = json_decode($dadosN['itens'],true);
		$itens = $dadosN['itens'];

		$total_g = 0;
		foreach ($itens as $y => $va) 
		{
			if ($va['item'] !='') 
			{      
				$total_g +=(int) $va['valor'];
			}
		}

		foreach ($itens as $y => $va) 
		{ 	
			$dadosN['itens'][$y]['porcentagem'] = 0;
			$dadosN['itens'][$y]['valor'] = (int)$va['valor'];
			if ($va['valor'] !='' && $va['valor'] !=0) 
			{ 
				$dadosN['itens'][$y]['porcentagem'] = round(($va['valor'] * 100)/ $total_g,2).'%';
			}
		}

		$hash = md5(json_encode($dadosN));

		if ($this->input->post('hash') != $hash) 
		{			

			echo json_encode(['hash'=>$hash,'dados'=>$dadosN]);
		}
	}
	/////// carrega as configurações da rádio /////////////////////////
	public function getRadio()
	{		
		$radioId = $this->input->post('radioId');
		$row =	$this->db->where('codigo',$radioId )->get('radio', 1, 0)->row_array();
		$hash = md5(json_encode($row));

		if ($this->input->post('hash') != $hash) 
		{			
			echo json_encode(['hash'=>$hash,'dados'=>$row]);
		}
	}
//////// carrega a grade de programação ///////////////////////////
  
	public function getProgramacao()
	{		
		$radioId = $this->input->post('radioId');
		if (is_numeric($radioId)) 
		{			
			$row =	$this->db->where(['gradeProgramacao.radio_codigo'=> $radioId])->from('gradeProgramacao')->join('programacao','gradeProgramacao.programacao_id=programacao.id')->get()->result_array();
			$hash = md5(json_encode($row));
			if ($this->input->post('hash') != $hash) 
			{			
				echo json_encode(['hash'=>$hash,'dados'=>$row]);
			}
		}
	}
	//////// carrega os vídeos de um program ///////////////////////////
	public function getVideos()
	{		
		$programacao_id = $this->input->post('programacao_id');
		if (is_numeric($programacao_id)) 
		{			
			$row =	$this->db->where(['programacao_id'=> $programacao_id])->from('videos')->get()->result_array();
			$hash = md5(json_encode($row));
			if ($this->input->post('hash') != $hash) 
			{			
				echo json_encode(['hash'=>$hash,'dados'=>$row]);
			}
		}
	}
		//////// carrega os vídeos ///////////////////////////
	public function getVideosGeral()
	{		
		$radioId = $this->input->post('radioId');
		$row =	$this->db->where(['radio_codigo'=> $radioId])->from('videos')->order_by('id','desc')->get()->result_array();
		$hash = md5(json_encode($row));
		if ($this->input->post('hash') != $hash) 
		{			
			echo json_encode(['hash'=>$hash,'dados'=>$row]);
		}
	}

			//////// carrega os vídeos de um program ///////////////////////////
	public function getBanner()
	{		
		$radioId = $this->input->post('radioId');
		$row =	$this->db->select('id,arquivo,link,views,clicks')->where(['status'=>'Ativo','radio_codigo'=> $radioId])->from('banner')->get()->result_array();
		$hash = md5(json_encode($row));
		if ($this->input->post('hash') != $hash) 
		{			
			echo json_encode(['hash'=>$hash,'dados'=>$row]);
		}
	}
///// pedido de música////////////////////////////////////////////
	public function setPedidoMusica()
	{
		// print_r($_POST);
		$object                   = $this->input->post('formulario');
		$object['data_pedido']    = date('Y-m-d H:i:s');
		$object['programacao_id'] = $this->input->post('programacao_id',true);
		$object['radio_codigo']   = $this->input->post('radioId',true);
		$object['status'] = 1;

		$this->db->trans_start();
		$this->db->insert('musica', $object);
		$this->db->trans_complete();
		if ($this->db->trans_status()===FALSE) 
		{
			$r = array('status'=>['frase'=>'erro ao salvar no banco de dados','classe'=>'red']);
		}
		else
		{
			$r = array('status'=>['frase'=>'Enviado com sucesso!','classe'=>'green']);
		}
		echo json_encode($r);
	}
	//////// pedido de oração/////////////////////////////////////////
	public function setPedidoOracao()
	{
		// print_r($_POST);
		$object = $this->input->post('formulario');
		$object['data_pedido'] = date('Y-m-d H:i:s');
		$object['programacao_id'] = $this->input->post('programacao_id',true);
		$object['radio_codigo']   = $this->input->post('radioId',true);
		$object['status'] = 1;

		$this->db->trans_start();
		$this->db->insert('oracao', $object);
		$this->db->trans_complete();
		if ($this->db->trans_status()===FALSE) 
		{
			$r = array('status'=>['frase'=>'erro ao salvar no banco de dados','classe'=>'red']);
		}
		else
		{
			$r = array('status'=>['frase'=>'Enviado com sucesso!','classe'=>'green']);
		}
		echo json_encode($r);
	}


}
