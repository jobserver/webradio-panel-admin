<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('Login_model');
  // $post_date = file_get_contents("php://input");
  // $_POST = json_decode($post_date,TRUE); 
 }

 public function index()
 {
  // echo 'login-executando';
  // $data = array(
  //  'name' => $this->security->get_csrf_token_name(),
  //  'hash' => $this->security->get_csrf_hash()
  // );
  $this->load->view('login');
 }

 public function post() 
 {
  $query = $this->Login_model->validate();
  if ($query) 
{ // VERIFICA LOGIN E SENHA
 $data = array(
  'login' => $this->input->post('login'),
  'logged_radio' => true,                                   
 );
 $this->session->set_userdata($data);
  // print_r($query);
  // exit();
// print_r($this->input->request_headers());
 // $this->historicoAcao(['acao'=>'acessou painel sindico']);

 redirect(base_url('/admin'));
}
else
{
 show_error('Para acessar o endereço solicitado é obrigatório uma autenticação <a href="'.base_url('/admin/login').'">Tentar novamente</a>', '401', "401 - Não Autorizado !");
 exit();
 //redirect(base_url('/webservice/login'));
}

}

function logout()
{
 $data = array(
  'login' => '',
  'logged_radio' => false,                                   
 );
 // $this->historicoAcao(['acao'=>'saiu do painel sindico']);

 $this->session->set_userdata($data);
 $this->session->unset_userdata('login');
 $this->session->unset_userdata('logged_radio');
//$this->session->unset_userdata('clienteId');
 $this->session->sess_destroy(); 
 redirect(base_url('/admin/login'));
}




// function historicoAcao($object='')
// {
//   $object['horario'] = date('Y-m-d H:i:s');
//   $object['ip'] = $this->getUserIP();
//   $object['pessoa_id_pessoa'] = $this->session->userdata('pessoa_id_pessoa');

//   $this->db->insert('historico_acoes', $object);
// }


function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


}

/* End of file Login.php */

/* Location: ./application/modules/webservice/Login.php */