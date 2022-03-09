<?php
class Enquete_model extends CI_Model 
{
 private $camposBusca = ['status','data_criacao'];

// Função inserir 
 public function inserir()
 {
   $this->db->trans_start();
   $this->db->insert("enquete" ,array(
    "pergunta"=> $this->input->post("pergunta", true),
    "itens"=> $this->input->post("itens", true),
    "status"=> $this->input->post("status", true),
    "radio_codigo"=>$this->session->radio_codigo,
    'data_criacao'=>date('Y-m-d H:i:s')
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

// Função Atualizar             
public function atualizar($condicao)
{
  $this->db->trans_start();
  $this->db->update("enquete" ,array(
    "pergunta"=> $this->input->post("pergunta", true),
    "itens"=> $this->input->post("itens", true),
    "status"=> $this->input->post("status", true)    
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
 $this->db->trans_start();
 $this->db->delete("enquete" ,$condicao);      
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
public function listar($pagina=0)
{
  $limite = 15;

  if($_POST['filtro'] !='')
  {
//verifica se é uma data e converte para o padrão de bano de dados
   $isData = strpos($_POST['filtro'],"/");

   if ($isData) 
   {   
    $_POST['filtro'] = data_db($_POST['filtro']);
  }
//fim da configuração da data
  $this->db->where('radio_codigo',$this->session->radio_codigo);
  $this->db->group_start();
  $this->db->or_where('pergunta LIKE "%'.$this->input->post('filtro').'%"');  
  foreach ($this->camposBusca as $v) 
  {
    $this->db->or_where($v.' LIKE "%'.$this->input->post('filtro').'%"');   
  }    
   $this->db->group_end();
}
///////////// Dados que difinirão o total de registros/////////////////////////
$this->db->select('count(*) as total');
$this->db->from('enquete');    
$total = $this->db->get()->row()->total;

///////////// Dados que serão apresentados para o usuário/////////////////////////
$this->db->select('id,pergunta,itens,status,data_criacao');
$this->db->from('enquete');

$this->db->where('radio_codigo',$this->session->radio_codigo);
if($_POST['filtro'] !='')
{
  $this->db->group_start();
  $this->db->or_where('pergunta LIKE "%'.$this->input->post('filtro').'%"');  
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


$dadosN = [];
foreach ($dados as $key => $value) 
{
  $dadosN[$key] = $value;
  $itens = json_decode($value['itens'],true);
  // print_r($itens);

  $dadosN[$key]['itens'] = $itens ;
  
  $total_g = 0;
  foreach ($itens as $y => $va) 
  {
    if ($va['item'] !='') 
    {      
     $total_g += $va['valor'];
   }
 }

 foreach ($itens as $y => $va) 
 {
   if ($va['valor'] !='' && $va['valor'] !=0) 
   { 
     $dadosN[$key]['itens'][$y]['porcentagem'] = round(($va['valor'] * 100)/ $total_g,2).'%';
   }
 }

}

$sql['dados'] = $dadosN;
$sql['paginacao'] = $total;
return $sql;
}

} 
?>