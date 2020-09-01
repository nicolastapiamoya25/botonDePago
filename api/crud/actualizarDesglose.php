<?php
$condition = [];
if(isset($_GET['iddesglose_credito'])){
    $condition = $_GET['iddesglose_credito'];
    /*$data [] = array(
        'iddesglose_credito' => $condition,
        'estado' => 'Cancelado'
    );*/

    echo $condition;
}  
/*
    
    echo $condition;


    $url = "https://localhost:44319/api/DesgloseCreditos/Actualizar";    

    $data = array(
    'iddesglose_credito' => $condition,
    'estado' => 'Cancelado');

    $postdata = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
}*/
?>