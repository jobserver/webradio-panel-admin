<?php
class Banner_model extends CI_Model 
{
 private $camposBusca = ['data_cadastro','views','clicks'];
     // Função inserir 
 public function inserir()
 {
  $this->db->trans_start();
  $this->db->insert("banner" ,array(
    "arquivo"=> $this->input->post("arquivo", true),    
    "radio_codigo"=>$this->session->radio_codigo,
    "data_cadastro"=> date('Y-m-d H:i:s'),
    "link"=> $this->input->post("link", true),
    "status"=> $this->input->post("status", true),
    "empresa"=> $this->input->post("empresa", true)
  ) );
  $id = $this->db->insert_id();
  $this->db->trans_complete();
  if ($this->db->trans_status()===FALSE) 
  {
    $r = array('status'=>['frase'=>'erro ao salvar no banco de dados','classe'=>'red']);
  }
  else
  {
    $r = array('status'=>['frase'=>'Salvo com sucesso!','classe'=>'green'],'dados'=>['id'=>$id]);   
  }
  return $r;  
}
      
public function atualizar($condicao)
{
  $this->db->trans_start();
  $this->db->update("banner" ,array(
    "arquivo"=> $this->input->post("arquivo", true),    
    "data_cadastro"=> $this->input->post("data_cadastro", true),
    "link"=> $this->input->post("link", true),
    "status"=> $this->input->post("status", true),
    "empresa"=> $this->input->post("empresa", true)
  ) ,$condicao); 
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
//Listagem
 public function listar($pagina=0){

  $limite = 15;

$this->db->where('radio_codigo',$this->session->radio_codigo);
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
   $this->db->or_where('status LIKE "%'.$this->input->post('filtro').'%"');
   foreach ($this->camposBusca as $v) 
   {
    $this->db->or_where($v.' LIKE "%'.$this->input->post('filtro').'%"');   
   } 
   $this->db->group_end();   
  }
///////////// Dados que difinirão o total de registros/////////////////////////
  $this->db->select('count(*) as total');
  $this->db->from('banner');  
   
  $total = $this->db->get()->row()->total;

///////////// Dados que serão apresentados para o usuário/////////////////////////
  $this->db->select('*');
  $this->db->from('banner');
  $this->db->where('radio_codigo',$this->session->radio_codigo);
  if($_POST['filtro'] !=''){

 $this->db->group_start();
   $this->db->or_where('status LIKE "%'.$this->input->post('filtro').'%"');
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