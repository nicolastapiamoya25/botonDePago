<?php
$condition = "1";
if(isset($_GET['idcredito'])){
   $condition = $_GET['idcredito'];
   
  $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  ); 
  
  $url= "https://localhost:44319/api/DesgloseCreditos/Listar";
  $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
  
  $json = json_decode($response);
  
  $arrayCredito = array();
  
  foreach($json as $item) {
    if ($item->idcredito == $condition) {
        $arrayCredito[] = $item;
    }
  }
  echo json_encode($arrayCredito);
}
