<?php
class GradeProgramacao extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
    $this->Login_model->logged();
    $this->load->model('gradeProgramacao_model','gradeProgramacao');
    $post_date = file_get_contents("php://input");
    $_POST = json_decode($post_date,TRUE);
  }

  public function index()
  {
    $this->load->view("form_gradeProgramacao");                
  }

  public function salvar()
  {
    if(!$this->input->post('id')){
      $dados =  $this->gradeProgramacao->inserir();
    }
    else
    {
     $dados = $this->gradeProgramacao->atualizar(array('id'=>$this->input->post('id')));
   }

   echo json_encode($dados);
 }

 public function apagar()
 {
   if($this->input->post('id'))
   {
    $dados = $this->gradeProgramacao->apagar(array("radio_codigo"=>$this->session->radio_codigo,'id'=>$this->input->post('id')) );
    echo json_encode($dados);
  }
}

} 
?>