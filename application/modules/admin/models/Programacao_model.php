<?php
class Programacao_model extends CI_Model 
{
// Função inserir 

 private $camposBusca = ['nome_programa', 'locutor', 'data_inicio', 'email', 'whatsapp', 'telefone'];

 public function inserir(){
   $this->db->trans_start();
   $this->db->insert("programacao" ,array(
     "nome_programa"=> $this->input->post("nome_programa", true),
     "locutor"=> $this->input->post("locutor", true),
     "foto_locutor"=> $this->input->post("foto_locutor", true),
     "foto_programa"=> $this->input->post("foto_programa", true),
     "descricao"=> $this->input->post("descricao", true),
     "facebook"=> $this->input->post("facebook", true),
     "youtube"=> $this->input->post("youtube", true),
     "instagram"=> $this->input->post("instagram", true),
     "data_inicio"=> data_db($this->input->post("data_inicio", true)),
     "data_fim"=>data_db( $this->input->post("data_fim", true)),
     "email"=> $this->input->post("email", true),
     "whatsapp"=> $this->input->post("whatsapp", true),
     "telefone"=> $this->input->post("telefone", true),
     "radio_codigo"=>$this->session->radio_codigo,
     "status"=> $this->input->post("status", true)
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
public function atualizar($condicao){
  $this->db->trans_start();
  $this->db->update("programacao" ,array("nome_programa"=> $this->input->post("nome_programa", true),
   "locutor"=> $this->input->post("locutor", true),
   "foto_locutor"=> $this->input->post("foto_locutor", true),
   "foto_programa"=> $this->input->post("foto_programa", true),
   "descricao"=> $this->input->post("descricao", true),
   "facebook"=> $this->input->post("facebook", true),
   "youtube"=> $this->input->post("youtube", true),
   "instagram"=> $this->input->post("instagram", true),
   "data_inicio"=> data_db($this->input->post("data_inicio", true)),
   "data_fim"=>data_db( $this->input->post("data_fim", true)),
   "email"=> $this->input->post("email", true),
   "whatsapp"=> $this->input->post("whatsapp", true),
   "telefone"=> $this->input->post("telefone", true),   
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
  $this->db->delete("programacao" ,$condicao);      
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
  foreach ($this->camposBusca as $v) 
  {
    $this->db->or_where($v.' LIKE "%'.$this->input->post('filtro').'%"');   
  }    
  $this->db->group_end();
}

$this->db->select('count(*) as total');
$this->db->from('programacao');    
$total = $this->db->get()->row()->total;

$this->db->select('programacao.*');
$this->db->from('programacao');
$this->db->where('radio_codigo',$this->session->radio_codigo);
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


//carrega os dias que acontece este programa

foreach ($dados as $key => $value) 
{
  $dados[$key]['horarios'] = $this->db->get_where('gradeProgramacao', array('programacao_id'=>$value['id']))->result_array();
}




$sql['dados'] = $dados;
$sql['paginacao'] = $total;
return $sql;
}

} 
?>