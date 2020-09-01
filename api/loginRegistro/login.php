<?php @session_start();

//include '../conexion.php';
//include_once '../clases/socio.php';

$rut = htmlentities($_POST['rut']);
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  ); 

$url= "https://localhost:44319/api/Socios/Listar";
$response = file_get_contents($url, false, stream_context_create($arrContextOptions));

$json = json_decode($response);

$arraySocio = array();

foreach($json as $item) {
    if($item->rut == $rut){
        $_SESSION['idSocio'] = $item->idsocio;
        $_SESSION['user'] = $rut;
         $arraySocio[] = $item;
         echo "success";
         
    }else{
     continue;
     echo "fail";
    }      
 }
?>
