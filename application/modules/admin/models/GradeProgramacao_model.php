<?php
class GradeProgramacao_model extends CI_Model 
{
 public function inserir()
 {
  $this->db->trans_start();     
  $this->db->insert("gradeProgramacao" ,array(
   "radio_codigo"=>$this->session->radio_codigo,
   "programacao_id"=> $this->input->post("programacao_id", true),
   "dia_semana"=> $this->input->post("dia_semana", true),
   "hora_inicio"=> $this->input->post("hora_inicio", true),
   "hora_fim"=> $this->input->post("hora_fim", true),
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
 public function atualizar($condicao)
 {
  $this->db->trans_start();
  $this->db->update("gradeProgramacao" ,array(   
   "programacao_id"=> $this->input->post("programacao_id", true),
   "dia_semana"=> $this->input->post("dia_semana", true),
   "hora_inicio"=> $this->input->post("hora_inicio", true),
   "hora_fim"=> $this->input->post("hora_fim", true),
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
  $this->db->delete("gradeProgramacao" ,$condicao);      
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
?>