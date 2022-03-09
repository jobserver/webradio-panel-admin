<?php
class Radio extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
    $this->Login_model->logged();
    $this->load->model('radio_model','radio');
    $post_date = file_get_contents("php://input");
    $_POST = json_decode($post_date,TRUE); 
  }

  public function index()
  {      
    $this->load->view("admin/form_radio");                
  }

  public  function editar()
  {         
    $dados = $this->radio->editar();    
    echo json_encode($dados);
  }

// Função salvar 

  public function salvar()
  {  
    echo json_encode($this->radio->atualizar());
  }
    // Função Deletar             
  public function apagar($condicao)
  {
    $this->radio->apagar(array('codigo'=>$condicao) );
  }

} 
?>