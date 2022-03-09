    <?php
    class Radio_model extends CI_Model {
              // Função inserir 

     public function inserir(){
      $this->db->trans_start();
      $this->db->insert("radio" ,array(
        "nome_radio"=> $this->input->post("nome_radio", true),
        "site"=> $this->input->post("site", true),
        "email"=> $this->input->post("email", true),
        "telefone"=> $this->input->post("telefone", true),
        "whatsapp"=> $this->input->post("whatsapp", true),
        "stream1"=> $this->input->post("stream1", true),
        "stream2"=> $this->input->post("stream2", true),
        "streamYoutube"=> $this->input->post("streamYoutube", true),
        "streamFacebook"=> $this->input->post("streamFacebook", true),
        "facebook"=> $this->input->post("facebook", true),
        "youtube"=> $this->input->post("youtube", true),
        "instagram"=> $this->input->post("instagram", true),
        "logoRadio"=> $this->input->post("logoRadio", true),
        "googlePlay"=> $this->input->post("googlePlay", true),
        "appStore"=> $this->input->post("appStore", true)              
      ) );
      $id = $this->db->insert_id();
      $this->db->trans_complete();
      return $id;
    }

     //editar ítem
    public function editar(){

      $consulta = $this->db->get_where('radio',array('codigo'=>$this->session->radio_codigo))->row_array();
      return $consulta;
    }


    // Função Atualizar             
    public function atualizar()
    {
     $this->db->trans_start();
     $this->db->update("radio" ,array(
      "nome_radio"=> $this->input->post("nome_radio", true),
      "site"=> $this->input->post("site", true),
      "email"=> $this->input->post("email", true),
      "telefone"=> $this->input->post("telefone", true),
      "whatsapp"=> $this->input->post("whatsapp", true),
      "stream1"=> $this->input->post("stream1", true),
      "stream2"=> $this->input->post("stream2", true),
      "streamYoutube"=> $this->input->post("streamYoutube", true),
      "streamFacebook"=> $this->input->post("streamFacebook", true),
      "facebook"=> $this->input->post("facebook", true),
      "youtube"=> $this->input->post("youtube", true),
      "instagram"=> $this->input->post("instagram", true),
      "logoRadio"=> $this->input->post("logoRadio", true),
      "googlePlay"=> $this->input->post("googlePlay", true),
      "appStore"=> $this->input->post("appStore", true)        
    ) ,array('codigo'=>$this->session->radio_codigo));  
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

} 
?>