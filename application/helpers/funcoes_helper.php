<?php
//echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
date_default_timezone_set('America/Sao_Paulo');

function data($time, $h = FALSE) {
    //converte data do banco de dados  Y-m-d
    if ($time != null)
        return date(($h != FALSE) ? "d/m/Y H:i:s" : "d/m/Y", strtotime($time));
    else
        return '';
}

function data_db($time, $h = FALSE) {
    //converte data do banco de dados  Y-m-d
 if ($time != null) {
  $data = substr($time, 0, 10);
  $horas = substr($time, 10);
  $nova_data = implode("-", array_reverse(explode("/", $data)));

  return ($h != FALSE) ? $nova_data . $horas : $nova_data;
 } else {
  return '';
 }
}

function mes($mes, $sigla = TRUE) {

 if (substr($mes, 0, 1) == 0) {
  $mes = substr($mes, 1, 1);
 }

 $meses = array(1 => 'Jan',
  2 => 'Fev',
  3 => 'Mar',
  4 => 'Abr',
  5 => 'Maio',
  6 => 'Jun',
  7 => 'Jul',
  8 => 'Ago',
  9 => 'Set',
  10 => 'Out',
  11 => 'Nov',
  12 => 'Dez',
 );
 $meses_completo = array(1 => 'Janeiro',
  2 => 'Fevereiro',
  3 => 'Março',
  4 => 'Abril',
  5 => 'Maio',
  6 => 'Junho',
  7 => 'Julho',
  8 => 'Agosto',
  9 => 'Setembro',
  10 => 'Outubro',
  11 => 'Novembro',
  12 => 'Dezembo',
 );

 if ($sigla)
  return $meses[$mes];
 else
  return $meses_completo[$mes];
}

function color($i = 0) {
 if (is_numeric($i)) {

  $cor[0] = '#FFCE5D';
  $cor[1] = '#54BC3E';
  $cor[2] = '#FFCE5D';
  $cor[3] = '#E4DED9';
  return $cor[$i];
 }
}


function imagem($img = null, $conf = array('largura' => 53, 'altura' => 31)) {
 if ($img != null) {
        // $arquivo = explode('/', $img);
  return '<a href="' . $img . '">
  <button class="btn btn-info btn-xs" type="button"> <span class="glyphicon glyphicon-download-alt"></span>  </button>
  </a>';
 } else
 return '';
}

function instalacao() {

 return 'http://' . $_SERVER["HTTP_HOST"];
}

function pasta_cliente() {
 return $_SERVER['DOCUMENT_ROOT'];
}

function correr_mes($lista) {
 $registro = array();
 foreach ($lista AS $datas) {
  $registro[$datas['mes']] = $datas['total'];
 }

 for ($i = 1; $i <= 12; $i++) {
  if (!isset($registro[$i]))
   $registro[$i] = 0;
 }
 ksort($registro);
 echo (implode(",", $registro));
}


         function porcentagem($dados) {
          
          
          
          $d = explode('.', number_format($dados,2));
          
          
          if ($dados == 100 ||  $d[1] == 00) {
           printf("%.0f%%", $dados);
          } else {
           printf("%.2f%%", $dados);
          }
         }



    /**
     * Colunas a serem inseridas na tabela OUTBOX, 
     * DestinationNumber,TextDecoded,CreatorID,Class
     * 
     * @param type $frase
     * @param type $destino
     * @param type $remetente
     */
    
    function enviar_sms_massa($frase=null,$destino=null,$remetente=null){
     
     $ci =& get_instance();
     $db_smsd =  $ci->load->database('smsd', TRUE);
     
     
     
     if(is_array($frase)){
      $db_smsd->insert_batch('proclama_smsd.outbox', $frase);
     }
     
     else if(is_array($destino)){
      
      $lista=[];
      foreach($destino as $key=>$val){
       if(isset($val['celular'])){
        $lista[$key]['TextDecoded']=preg_replace("/%nome%/",$val['nome'], $frase);
        $lista[$key]['CreatorID']=$remetente;
        $lista[$key]['Class']='-1';
        $lista[$key]['DestinationNumber']=preg_replace("/[^0-9]/","", $val['celular']);
       }
      }
      
      print_r($lista);
      $db_smsd->insert_batch('proclama_smsd.outbox', $lista);
     }
     
     
     $db_smsd->close();
    }

    function criar_pasta($caminho)
    {    
     if(!file_exists($caminho)){        
      mkdir($caminho,755,true);        
     }
    }


    ?>