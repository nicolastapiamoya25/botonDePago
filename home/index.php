<?php 
@session_start();
if (isset($_SESSION['user'])) {
    echo $_SESSION['user'];
    echo $_SESSION['idSocio'];
}else{
    header('location:../index.php');
}

include_once '../includes/header.php';
?>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col">
        <h3 class="text-left"><b>Pago Online</b></h3>
        <p class="text-left">Realiza de forma rápida y segura el pago de tus productos </p>
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-tabs justify-content-center rounded nav-justified border-success" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><span class="badge badge-pill badge-success">1</span> Tus Productos</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><span class="badge badge-pill badge-success">2</span> Monto a Pagar</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><span class="badge badge-pill badge-success">3</span> Medio de Pago</a>
            </li>
        </ul>
        <div class="tab-content shadow-lg bg-white rounded border-right border-left border-bottom border-success " id="myTabContent">
            <!--************************************TAB HOME*****************************************-->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="alert alert-primary justify-content-center text-center" role="alert">
                    <i class="fas fa-exclamation"></i>
                    Selecciona tu producto, Credito(s) o Cuota de Gasto
                </div>
                <div class="container">
                    <section>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-6" v-for="item in listarCreditos">                             
                                <div @click='seleccionarCredito(item.idcredito);' class="card btn btn-raised btn-primary btn-lg btn-block text-white">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><i class="material-icons prefix">monetization_on</i></h5>
                                        <p class="card-text">Credito {{item.num_credito}}</p>
                                    </div>
                                </div>                             
                            </div>                           

                            <div class="col-sm-6"  v-for="item in listarCuotaGastos">
                              <div @click='seleccionarCuotagasto(item.idcuota_gastos);' class="card btn btn-raised btn-primary btn-lg btn-block text-white">
                                <div class="card-body text-center">
                                <h5 class="card-title"><i class="material-icons prefix">pie_chart</i></h5>
                                <p class="card-text">Cuota de Gastos {{item.num_cuota_gastos}}</p>
                                </div>
                              </div>
                            </div>
                        </div>
                        <br><br> 
                    </section>
                </div>
            </div>
            <!--************************************TAB PROFILE*****************************************-->
            <div class="tab-pane fade" id="profile" role="tabpanel"  aria-labelledby="profile-tab">
                <div class="alert alert-primary justify-content-center text-center" role="alert">
                    <i class="fas fa-exclamation"></i>
                    Selecciona las cuotas que deseas pagar
                </div>
                <div class="container">
                    <section>
                    <br><br>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <b class="text-white">Cuotas Pendientes</b>
                                    </div>
                                    <div class="card-body" v-if="btn_cuota==false">
                                        <div class="row justify-content-center border border-light rounded " v-for="cuota in listaDesgloseCredito">
                                            <div class="col-1">
                                            <br>
                                                <input v-model="selected" @click="seleccionarCheck(cuota.iddesglose_credito);" :value="cuota" type="checkbox" class="form-check-input" /> 
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">
                                                    <b>Cuota N° {{cuota.cuota}}</b> 
                                                </label>
                                                <label class="form-label">
                                                    Monto Pendiente 
                                                </label>
                                                <label class="form-label">
                                                    <h5><b>${{cuota.valor | money}}</b></h5>
                                                </label>
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label">
                                                    <b>Fecha de Vencimiento </b>
                                                </label>
                                                <label class="form-label">
                                                    21/22/2013
                                                </label>
                                                <br>
                                            </div>                                             
                                        </div>
                                         
                                        <br>                                                                       
                                    </div>

                                    <div class="card-body" v-if="btn_cuota == true">
                                        <div class="row justify-content-center border border-light rounded " v-for="cuotagasto in listaDesgloseCuotagasto">
                                            <div class="col-1">
                                            <br>
                                                <input v-model="selected" @click="seleccionarCheck(cuotagasto.iddesglose_cuotagasto);" :value="cuotagasto" type="checkbox" class="form-check-input" /> 
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">
                                                    <b>Cuota N° {{cuotagasto.cuota}}</b> 
                                                </label>
                                                <label class="form-label">
                                                    Monto Pendiente 
                                                </label>
                                                <label class="form-label">
                                                    <h5><b>${{cuotagasto.valor | money}}</b></h5>
                                                </label>
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label">
                                                    <b>Fecha de Vencimiento </b>
                                                </label>
                                                <label class="form-label">
                                                    21/22/2013
                                                </label>
                                                <br>
                                            </div>                                             
                                        </div>
                                        <br>                                                                       
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <form id="formTotal" action="totalPagoTotal.php" method="POST">   
                                            <div class= "form-row justify-content-center"> 
                                                <div class="col">
                                                    <h5><p><b>Total a Pagar</b></p></h5>
                                                    <input type="text" class="form-control text-center rounded" v-model="money(total_price)" readonly="true" name="total" id="total">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="boton_pagar" type="submit" class="btn btn-raised btn-primary btn-lg btn-block text-white" value="Pagar" >
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <!-- checked seleccionado aparece html con vue -->
                                        <div class="row" v-html="checkSeleccionado">
                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </section>
                </div>
            </div>
            <!--************************************TAB CONTACT*****************************************-->
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="container">
                    <section>
                    </section>
                </div>
            </div>

        </div>
    </div>
</div>
<h5>Res: {{selected}}</h5>

<?php 
include_once '../includes/footer.php';
?>