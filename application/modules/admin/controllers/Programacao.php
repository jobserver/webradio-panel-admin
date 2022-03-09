<?php
class Programacao extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login_model');
    $this->Login_model->logged();
    $this->load->model('programacao_model','programacao');    
  }

  public function index()
  {   
    $this->load->view("tela_programacao");                
  }

// Função salvar 
  public function salvar()
  {

//upload de foto
    // print_r($_FILES);
   $_POST = json_decode($_POST['dados'],true);

   $path = realpath(".");
   $path .= '/uploads/'.$this->session->radio_codigo;
   $foto = null;
    //////FOTO LOCUTOR
   $foto_locutor  =($this->upload_ajax($path,'foto_locutor'));  
   if (isset($foto_locutor['success'])) 
   {
    $_POST['foto_locutor'] = $foto_locutor['success']['file_name'];
  }
    /////FOTO PROGRAMA
  $foto_programa  =($this->upload_ajax($path,'foto_programa'));
    // print_r($foto_programa);
  if (isset($foto_programa['success'])) 
  {
    $_POST['foto_programa'] = $foto_programa['success']['file_name'];
  }
  


  if(!$this->input->post('id'))
  {
    $dados = $this->programacao->inserir();
  }
  else
  {
   $dados = $this->programacao->atualizar(array("radio_codigo"=>$this->session->radio_codigo,'id'=>$this->input->post('id')));
 }

 echo json_encode($dados);
}
// Função Deletar             
 public function apagar()
 {
    $post_date = file_get_contents("php://input");
  $_POST = json_decode($post_date,TRUE);

   if($this->input->post('id'))
   {
    $dados = $this->programacao->apagar(array("radio_codigo"=>$this->session->radio_codigo,'id'=>$this->input->post('id')) );
    echo json_encode($dados);
  }
}
//listagem
public function get($pagina=0)
{    
  $post_date = file_get_contents("php://input");
  $_POST = json_decode($post_date,TRUE);

  $sql = $this->programacao->listar($pagina);
  echo json_encode($sql);
}


public function grade()
{
  $post_date = file_get_contents("php://input");
  $_POST = json_decode($post_date,TRUE);

  $cor[] = '#3CCF38';
  $cor[] = '#E6C117';
  $cor[] = '#F53F3F';

  $this->db->where('gradeProgramacao.radio_codigo',$this->session->radio_codigo);
  $this->db->select('programacao.nome_programa as title, gradeProgramacao.hora_inicio as start,gradeProgramacao.hora_fim as end,dia_semana');
  $this->db->from('gradeProgramacao');
    // $this->db->where(['gradeProgramacao.excluido'=>null]);
  $this->db->join('programacao', 'programacao.id = gradeProgramacao.programacao_id');
  $sql = $this->db->get()->result_array();

  foreach ($sql as $key => $value) 
  {
    $sql[$key]['color']       = $cor[rand(0,2)];
    $sql[$key]['description'] = '';
    $sql[$key]['allDay']      = false;
    $sql[$key]['start']       = $value['start'] ;
    $sql[$key]['end']         = $value['end'];
    $sql[$key]['dow']         = $value['dia_semana'];
    
  }

    // print_r($sql);
  echo json_encode($sql);
}



private function upload_ajax($destino,$campo)
{
  if (!file_exists($destino)) 
  {
    mkdir($destino,0755,TRUE);
  }

  $config['upload_path'] = $destino;
  $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
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