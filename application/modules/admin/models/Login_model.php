<?php
class Login_model extends CI_Model 
{
# VALIDA USUÁRIO
	function validate() 
	{
		$this->db->select('user.ultimo_login,user.id,user.login,radio_codigo');
		$this->db->where('user.login', $this->input->post('login'));
		$this->db->where('user.senha', md5($this->input->post('senha')));
		$this->db->where('user.status', 1); // status deve estar ativo para o login
		$this->db->from('user');

		$query = $this->db->get()->row();
		if (count($query) > 0) {

			$this->login_detalhes = $query;
			$row = $query;

			$dados_secao['user_id'] = $row->id ;             

			$dados_secao['login'] = $row->login ;
			$dados_secao['radio_codigo'] = $row->radio_codigo ;

			$this->session->set_userdata($dados_secao);

			$this->db->update('user',array('ultimo_login'=>date('Y-m-d h:i:s')),array('id'=>$row->id));

return true; // RETORNA VERDADEIRO

}
else
{
	$this->bruteForce->bloquear();
}

}

# VERIFICA SE O USUÁRIO ESTÁ LOGADO

function logged($pg_acesso=NULL) 
{
	$logged = $this->session->userdata('logged_radio');

	if (!isset($logged) || $logged != true) 
	{
		redirect(base_url('/admin/login/index'));
// echo 'login -novamente';
		exit();
//show_error('Para acessar o endereço solicitado é obrigatório uma autenticação. <a href="/admin/login">Efetuar Login</a>', '401', "401 - Não Autorizado !");

	}

	else{

// echo session_id();

// echo $this->input->user_agent();

// if($pg_acesso !='livre_acesso')

// $this->acessos($pg_acesso);

	}

}


}



/* End of file Login.php */

/* Location: ./application/modules/webservice/models/Login.php */