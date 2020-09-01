<?php @session_start();
if(isset($_SESSION['user'])){
    header('location:../home');
}
include_once '../includes/header.php';
?>
<div class="container center">
    <div class="row justify-content-center" style="padding-top:100px">
            <div class="card">
                <div class="card-header text-center">
                    <img src="../librerias/272354.png" class="img-thumbnail" width="200px" height="200px">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    <form id="inicioSesion" autocomplete="off" @submit.prevent="login"> 
                        <div class="form-group row">
                            
                            <div class="form-group col-12">
                                <label>Rut</label>
                                <input class="form-control" name="rut" placeholder="12345678-9" required>
                            </div> 
                        </div>  
                        <input class="btn btn-raised btn-primary btn-lg btn-block" type="submit" value="Entrar">          
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                <a href="registro.php" class="btn btn-primary">Registrarse</a>
                </div>
            </div>
    </div>
</div>	

<?php 
include_once '../includes/footerLogin.php';
?>