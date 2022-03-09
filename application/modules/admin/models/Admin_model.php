<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model 
{

	public function musicaTotal()
	{
		$q =  $this->db->select('count(*) as total')->get_where('musica',['status'=>1,'radio_codigo'=>$this->session->radio_codigo])->row_array();
		return $q['total'];
	}

	public function ultimasPedidas()
	{
		$q =  $this->db->select('artista, musica, data_pedido')->get_where('musica',['status'=>null,'radio_codigo'=>$this->session->radio_codigo],10)->result_array();
		return $q;
	}

	public function oracaoTotal()
	{
		$q =  $this->db->select('count(*) as total')->get_where('oracao',['status'=>1,'radio_codigo'=>$this->session->radio_codigo])->row_array();
		return $q['total'];
	}

	public function programas()
	{
		$q =  $this->db->select('id,nome_programa')->get_where('programacao',['status'=>null,'radio_codigo'=>$this->session->radio_codigo])->result_array();
		return $q;
	}

	public function aniversariantes()
	{
		$mes = date('m');
		$dia = date('d');

		$q =  $this->db->select('seu_nome,data_nascimento')->get_where('musica',"month(data_nascimento)='$mes' AND day(data_nascimento)='$dia' AND radio_codigo={$this->session->radio_codigo}")->result_array();
		return $q;
	}
	public function videoAoVivo($condicao)
	{

$this->db->trans_start();
//atualiza nas configurações da rádio o link do vídeo ao vivo
  $this->db->update("radio" ,array(
    "streamYoutube"=> $this->input->post("url", true)
  ) ,$condicao); 

 //cadastra o novo vídeo dentro do programa que está passando. 
  $object = [
  	'url' => $this->input->post("url", true),
  	'imagem' => 'https://img.youtube.com/vi/'.$this->input->post("url", true).'/mqdefault.jpg',
  	'data_publicacao' => date('Y-m-d H:i:s'),
  	'data' => date('Y-m-d H:i:s'),
  	'status' => 1,
  	'titulo'=>'',
  	'programacao_id'=>$this->input->post('programa'),
  	'radio_codigo'=>$this->session->radio_codigo
  ];
  $this->db->insert('videos', $object);

    $this->db->trans_complete();  
  if ($this->db->trans_status()===FALSE) 
  {
    $r = array('status'=>['frase'=>'erro ao salvar no banco de dados','classe'=>'red']);
  }
  else
  {
    $r = array('status'=>['frase'=>'Salvo com sucesso!','classe'=>'green']);
  }
  return $r;               
}        
    // Função Deletar             
public function apagar($condicao)
{

 $b = $this->db->select('arquivo')->get_where('banner',$condicao)->row_array();

$path = realpath(".");
$path .= '/uploads/doc/'.$b['arquivo'];

if(file_exists($path))
{
 unlink($path);
}


 $this->db->trans_start();
 $this->db->delete("banner" ,$condicao);      
 $this->db->trans_complete();  
 if ($this->db->trans_status()===FALSE) 
 {
  $r = array('status'=>['frase'=>'erro ao excluir do banco de dados','classe'=>'red']);
}
else
{
  $r = array('status'=>['frase'=>'Excluído com sucesso!','classe'=>'green']);
}
return $r; 

	}

}

/* End of file Admin_model.php */
?>