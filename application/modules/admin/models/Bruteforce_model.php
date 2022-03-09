<?php
class Bruteforce_model extends CI_Model 
{
 public function __construct()
 {
  parent::__construct();

  $this->ip = $this->input->ip_address();
  $query = $this->db->get_where('brute_force',array('ip'=>$this->ip,'data'=>date("Y-m-d") ) )->row();
  if (count($query) == 1 && $query->tentativas >=5) 
  { 
   show_error("O endereço de IP {$this->ip}, foi bloqueado. Contate o administrador.", '401', "401 - Não Autorizado !");
   exit();
  }
 }

public function listar()
{
return $this->db->get('brute_force')->result();
}

public function remover($ip)
{ 
 $this->db->delete('brute_force',array('ip'=>$ip));
}

 public function bloquear() 
 {
  $query = $this->db->get_where('brute_force',array('ip'=>$this->ip,'data'=>date("Y-m-d") ) )->row();
  if (count($query)==1) 
  {
   $this->db->update('brute_force',array('tentativas'=>$query->tentativas+1,'horario'=>date("H:i:s")),array('ip'=>$this->ip,'data'=>date("Y-m-d")));            
  }
  else
  {
   $this->db->insert('brute_force',array('ip'=>$this->ip,'data'=>date("Y-m-d"),'horario'=>date("H:i:s"),'tentativas'=>1));            
  }

 }

}