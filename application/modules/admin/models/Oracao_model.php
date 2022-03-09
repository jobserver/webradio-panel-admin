<?php
class Oracao_model extends CI_Model {
// Função inserir 

 private $camposBusca = ['nome','celular','cidade','oracao.status','data_pedido','programacao.nome_programa'];


// Função Atualizar             
 public function confirmarLeitura($condicao){

  $this->db->update("oracao" ,array(
   "status"=> NULL,
  ) ,$condicao);              
 }        

//Listagem
 public function listar($pagina=0){

  $limite = 15;
$this->db->where('oracao.radio_codigo',$this->session->radio_codigo);
  if($_POST['filtro'] !='')
  {

//verifica se é uma data e converte para o padrão de bano de dados
  $isData = strpos($_POST['filtro'],"/");

  if ($isData) 
  {   
    $_POST['filtro'] = data_db($_POST['filtro']);
  }
//fim da configuração da data


 $this->db->group_start();
   foreach ($this->camposBusca as $v) 
   {
    $this->db->or_where($v.' LIKE "%'.$this->input->post('filtro').'%"');   
   }    
    $this->db->group_end();
  }

  $this->db->select('count(*) as total');
  $this->db->from('oracao');  
  $this->db->join('programacao','programacao.id = oracao.programacao_id');  
  $total = $this->db->get()->row()->total;

  $this->db->select('oracao.*,programacao.nome_programa');
  $this->db->from('oracao');
  $this->db->join('programacao','programacao.id = oracao.programacao_id');

$this->db->where('oracao.radio_codigo',$this->session->radio_codigo);
  if($_POST['filtro'] !=''){
    $this->db->group_start(); 
   foreach ($this->camposBusca as $v) 
   {
    $this->db->or_where($v.' LIKE "%'.$this->input->post('filtro').'%"');   
   } 
    $this->db->group_end();
  }

  if($this->input->post('ordenacao'))
  {
   $this->db->order_by($this->input->post('ordenacao')['campo'],$this->input->post('ordenacao')['direcao']);
  }

  $this->db->limit($limite , $pagina * $limite);
  $dados = $this->db->get()->result_array();

  $sql['dados'] = $dados;
  $sql['paginacao'] = $total;
  return $sql;
 }
} 
?>