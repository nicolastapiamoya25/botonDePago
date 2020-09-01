<?php 
@session_start();
/*if($_SESSION['username'] !== '18817532') {
    header("Location:login.php");
} */

//$monto=$_SESSION['monto'];
//$cuota=$_SESSION['numero_cuota'];
require_once '../vendor/autoload.php';
//require_once './conexion.php';

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

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


$tokenWs = filter_input(INPUT_POST, 'token_ws');
$result = $transaction->getTransactionResult($tokenWs);
$output = $result->detailOutput;

if($output->responseCode == 0){
    echo '<script>window.localStorage.clear();</script>';
    echo '<script>window.localStorage.setItem("authorizationCode",'. $output->authorizationCode .' )</script>';
    echo '<script>window.localStorage.setItem("amount",'. $output->amount .' )</script>';
    echo '<script>window.localStorage.setItem("responseCode",'. $output->responseCode .' )</script>';



$_SESSION["monto"] = $output->amount;
$_SESSION["ordenCompra"] = $output->buyOrder;

}

?>


<?php if($output->responseCode == 0) :?>
<form action="<?php echo $result->urlRedirection ?>" method="post" id="return-form">
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>" >
</form>
<p><?php //echo $id_socio ?></p>
<script>
    document.getElementById('return-form').submit();
</script>


<?php

endif;
?>
