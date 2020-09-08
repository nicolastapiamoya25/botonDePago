<?php 
@session_start();
require_once '../vendor/autoload.php';
//require_once './conexion.php';

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

if(isset($_SESSION['idSocio']) && isset($_SESSION['user'])) {

    /*
    $configuration = new Configuration();
    $configuration->setEnvironment("PRODUCCION");

    $configuration->setWebpayCert(
        "-----BEGIN CERTIFICATE-----\n" .
        "MIIEDzCCAvegAwIBAgIJAMaH4DFTKdnJMA0GCSqGSIb3DQEBCwUAMIGdMQswCQYD\n" .
        "VQQGEwJDTDERMA8GA1UECAwIU2FudGlhZ28xETAPBgNVBAcMCFNhbnRpYWdvMRcw\n" .
        ...
        "MX5lzVXafBH/sPd545fBH2J3xAY3jtP764G4M8JayOFzGB0=\n" .
        "-----END CERTIFICATE-----\n");
    );
    */

    /*
    ***********INTEGRACIÓN PRUEBAS***************
    $configuration->setEnvironment("INTEGRACION");
    $configuration->setCommerceCode("597020000540");
    $configuration->setPrivateKey(
        "-----BEGIN RSA PRIVATE KEY-----\n" .
        ... .
        "-----END RSA PRIVATE KEY-----\n"
    );
    $configuration->setPublicCert(
        "-----BEGIN CERTIFICATE-----\n" .
        ... .
        "-----END CERTIFICATE-----\n"
    );
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
    // echo '<script>window.localStorage.setItem("paymentType",'. $output->paymentType .' )</script>';
        echo '<script>window.localStorage.setItem("sharesNumber",'. $output->sharesNumber .' )</script>';
        echo '<script>window.localStorage.setItem("commerceCode",'. $output->commerceCode .' )</script>';
        echo '<script>window.localStorage.setItem("buyOrder",'. $output->buyOrder .' )</script>';
        echo '<script>window.localStorage.setItem("socio",'. $_SESSION['user'] .' )</script>';
        $_SESSION['monto'] = $output->amount;
        $_SESSION['ordenCompra']= $output->buyOrder;
    }
}else{
    header('location:../home/error.php');
} 

?>

<!--SI LA TRANSACCIÓN ES CORRECTA REDIRECCIONA A TRANSBANK-->

<?php if($output->responseCode == 0) :?>
<form action="<?php echo $result->urlRedirection ?>" method="post" id="return-form">
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>" >
</form>
<p><?php //echo $id_socio ?></p>
<script>
    document.getElementById('return-form').submit();
</script>


<?php
else:
    header('location:../home/error.php');
    //echo $output->responseCode;
endif;
?>

