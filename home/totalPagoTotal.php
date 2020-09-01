<?php

@session_start();
include_once '../includes/header.php';
require_once '../vendor/autoload.php';
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

if($_POST["total"]=="" || $_POST["total"]=="$0" || $_POST["total"]=='$NaN')
{
  echo "Valor nulo";
  header('location:miscreditos.php'); 
}else{
  $_POST["total"];
  $varTotal = $_POST["total"];
  $varTotal = str_replace(array('.', '$'), '' , $varTotal);
  $total = (int)$varTotal;
}

/*
$configuration = new Transbank\Webpay\Configuration();
$configuration->setEnvironment("PRODUCCION");
$configuration->setCommerceCode();
$configuration->setPublicCert("-----BEGIN CERTIFICATE----\n-");
$configuration->setPrivateKey("-----BEGIN CERTIFICATE----\n-");

$webpay = new Transbank\Webpay\Webpay($configuration);
*/

  $configuration = Configuration::forTestingWebpayPlusNormal();
  $transaction = (new Webpay($configuration))->getNormalTransaction();

  $amount=$total; 
  $sessionId = 'sessionId';
  $buyOrder = strval(rand(10000,9999999));
  $returnUrl= 'http://localhost/estructura/home/return.php';
  $finalurl = 'http://localhost/estructura/home/final.php';

  $initResult = $transaction->initTransaction($amount,$sessionId,$buyOrder,$returnUrl,$finalurl);

  $formAction = $initResult->url;
  $tokenWs = $initResult->token;
?>
  <div class="container">
    <br><br><br><br><br>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
          <div class="card text-center rounded">
            <div class="card-header">
            <img src="../librerias/tranbank.jpg" class="img-thumbnail" width="500px" height="500px">
            </div>
            <div class="card-body">
              <h5 class="card-title">Total pago</h5>
                  <div class="container">     
                      <p><b>Valor</b>:  $<?php echo $amount ?> </p>
                      <p><b>Orden de compra</b>:  <?php echo $buyOrder ?> </p>
                      <form action="<?php echo $formAction ?>"  method="POST" class="form-inline" role="form">
                          <input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>">
                          <button type="submit" id="botonpagartotal" class="btn btn-raised btn-success btn-lg btn-block">Pagar</button>
                      </form>
            </div>
            <div class="card-footer text-muted">
              Lautaro Rosas 2020
            </div>
          </div>
        </div>
    </div>
  </div>     
<?php 
include_once '../includes/footer.php';
?>
       