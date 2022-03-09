<?php
class Enquete extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
    $this->Login_model->logged();
    $this->load->model('enquete_model','enquete');
    $post_date = file_get_contents("php://input");
    $_POST = json_decode($post_date,TRUE); 
  }

  public function index()
  {      
    $this->load->view("admin/tela_enquete");                
  }

  public function salvar()
  {
    if(!$this->input->post('id'))
    {
      $dados = $this->enquete->inserir();
    }
    else
    {
     $dados = $this->enquete->atualizar(array('id'=>$this->input->post('id')));
   }
   echo json_encode($dados);
 }

 public function get($pagina=0)
 {    
  $sql = $this->enquete->listar($pagina);
  echo json_encode($sql);
}

// Função Deletar             
public function apagar()
{
 if($this->input->post('id'))
 {
  $dados = $this->enquete->apagar(array("radio_codigo"=>$this->session->radio_codigo,'id'=>$this->input->post('id')) );
  echo json_encode($dados);
}
}
} 
?>