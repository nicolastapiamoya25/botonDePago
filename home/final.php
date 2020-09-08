<?php
 @session_start();
 
 if (isset($_SESSION['monto']) && isset($_SESSION['ordenCompra']) && isset($_SESSION['idSocio'])) :
   //require_once './conexion.php';
 //**********VARIABLES DE SESSION*************//
 $monto= $_SESSION['monto'];
 //echo $_SESSION['ordenCompra'];
 $orden= $_SESSION['ordenCompra'];
 $idsocio= $_SESSION['idSocio'];
 $fecha_hora = date("Y-m-d H:i:s");

        //**********LLAMADO A API CREAR TRANSACCION, INSERTA DATOS EN TABLA TRANSACCION*************//
        $url = "https://localhost:44319/api/Transacciones/Crear";    

        //**********ARRAY CON DATOS DE SOCIO, NUM DE TRANSACCION, FECHA Y MONTO*************//
        $data = array(
        'idsocio' => $idsocio,
        'num_transaccion' => $orden,
        'fecha_hora' => $fecha_hora,
        'total' => $monto);
    
        $postdata = json_encode($data);
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        //**********SI EXISTE EL ID DESGLOSE CREDITO*************//
//if(isset($_GET['iddesglose_credito'])){
          //$condition = $_GET['iddesglose_credito'];
          //echo $condition;
      
          //**********LLAMADO A API CREAR DESGLOSECREDITO, ACTUALIZA DATOS EN TABLA DESGLOSE CREDITOS*************//
          /*$url = "https://localhost:44319/api/DesgloseCreditos/Actualizar";    
      
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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


  </head>
  <body>
  <div>
        <a class="btn btn-raised btn-success" href="cerrar_session.php">Cerrar Sesion</a>
        </div>
  <div class="container">
    <div class="col-md-6 col-md-offset-3">
    <h3>Compra Exitosa</h3>
        <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Campo</th>
            <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>Monto</td>
              <td id="amount"></td>
            </tr>
            <tr>
              <td>Codigo de autorización</td>
              <td id="authorizationCode"></td>
            </tr>
            <tr>
              <td>Codigo de Respuesta</td>
              <td id="responseCode"></td>
            </tr>
            <tr>
              <td>Socio</td>
              <td id="socio"></td>
            </tr>
            <tr>
              <td>Número de acción</td>
              <td id="sharesNumber"></td>
            </tr>
            <tr>
              <td>Codigo de comercio</td>
              <td id="commerceCode"></td>
            </tr>
            <tr>
              <td>Orden de Compra</td>
              <td id="buyOrder"><?php $orden ?></td>
            </tr>
            
        </tbody>
        </table>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  
    <script>
        document.getElementById('amount').innerHTML = window.localStorage.getItem('amount');
        document.getElementById('authorizationCode').innerHTML = window.localStorage.getItem('authorizationCode');
        document.getElementById('responseCode').innerHTML = window.localStorage.getItem('responseCode');
        //document.getElementById('paymentType').innerHTML = window.localStorage.getItem('paymentType');
        document.getElementById('sharesNumber').innerHTML = window.localStorage.getItem('sharesNumber');
        document.getElementById('commerceCode').innerHTML = window.localStorage.getItem('commerceCode');
        document.getElementById('buyOrder').innerHTML = window.localStorage.getItem('buyOrder');
        document.getElementById('socio').innerHTML = window.localStorage.getItem('socio');
    </script>
  
  </body>
</html>



 <?php
 else:
  header('location:../home/error.php');
 endif;
?>
