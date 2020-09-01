<?php
$condition = "2";
//if(isset($_GET['idcuota_gastos'])){
   //$condition = $_GET['idcuota_gastos'];
   
  $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  ); 
  
  $url= "https://localhost:44319/api/DesgloseCuotaGastos/Listar";
  $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
  
  $json = json_decode($response);
  
  $arrayCredito = array();
  
  foreach($json as $item) {
    if ($item->idcuota_gastos == $condition) {
        $arrayCredito[] = $item;
    }
  }
  echo json_encode($arrayCredito);
//}