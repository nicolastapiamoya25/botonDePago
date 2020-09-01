<?php @session_start();

$id_socio=$_SESSION['idSocio'];

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  ); 

$url= "https://localhost:44319/api/Creditos/Listar";
$response = file_get_contents($url, false, stream_context_create($arrContextOptions));

$json = json_decode($response);

$arraySocio = array();

foreach($json as $item) {
   if($item->idsocio == $id_socio){
      
        $arraySocio[] = $item;
   }      
}
echo json_encode($arraySocio);
?>