<?php
class Banner extends CI_Controller 
{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Login_model');
  $this->Login_model->logged();
  $this->load->model('banner_model','banner'); 
}

public function index()
{
  $this->load->view("admin/tela_banner");                
}
public function salvar()
{
 $_POST = json_decode($_POST['dados'],true);

 $path = realpath(".");
 $path .= '/uploads/'.$this->session->radio_codigo;
 $foto = null;
    //////FOTO LOCUTOR
 $arquivo  =($this->upload_ajax($path,'arquivo'));  
 if (isset($arquivo['success'])) 
 {
  $_POST['arquivo'] = $arquivo['success']['file_name'];
}

if(!$this->input->post('id'))
{
 $dados = $this->banner->inserir();
}
else
{
 $dados = $this->banner->atualizar(array('id'=>$this->input->post('id')));
}
echo json_encode($dados);
}

public function get($pagina=0)
{    
 $post_date = file_get_contents("php://input");
 $_POST = json_decode($post_date,TRUE); 
 
 $sql = $this->banner->listar($pagina);
 echo json_encode($sql);
}

// Função Deletar             
public function apagar()
{
 $post_date = file_get_contents("php://input");
 $_POST = json_decode($post_date,TRUE); 

 if($this->input->post('id'))
 {
   $dados = $this->banner->apagar(array('id'=>$this->input->post('id')) );
   echo json_encode($dados);
 }
}

private function upload_ajax($destino,$campo)
{
  if (!file_exists($destino)) 
  {
    mkdir($destino,0644,TRUE);
  }

  $config['upload_path'] = $destino;
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
    // $config['max_filename'] = '255';
  $config['encrypt_name'] = TRUE;

  $result = array();

  $this->load->library('upload', $config);
  if (!$this->upload->do_upload($campo)) 
  {
    $result['errors']= $this->upload->display_errors();
  }else
  { 
    $result['success']= $this->upload->data(); 
  }   
  return($result);
}

} 
?>