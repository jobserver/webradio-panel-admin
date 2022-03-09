<?php
class Oracao extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Login_model');
    $this->Login_model->logged();
    $this->load->model('Oracao_model','oracao');

    $post_date = file_get_contents("php://input");
    $_POST = json_decode($post_date,TRUE); 
  }

  public function index()
  {
    $this->load->view('tela_oracao');               
  }

   //listagem

  public function get($pagina=0)
  {    
    $sql = $this->oracao->listar($pagina);
    echo json_encode($sql);
  }

  public function confirmarLeitura()
  {
    $id = $this->input->post('id');
    if (is_numeric($id)) 
    {    
      $this->oracao->confirmarLeitura(array("radio_codigo"=>$this->session->radio_codigo,'id'=>$id)); 
    }
  }


} 
?>