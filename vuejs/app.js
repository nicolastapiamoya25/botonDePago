//*********filtro de moneda para el punto********//
Vue.filter('money', function(value) {
    totalParts = value.toFixed(2).split('.');
    return totalParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".")
});

$(document).ready(function(){
  //********control de elementos tab en disable menos el home********//
  $( "#profile-tab" ).prop( "disabled", true );
  $( "#contact-tab" ).prop( "disabled", true );
  $( "#medio-pago-tab" ).prop( "disabled", true );

  //********pone la class disable ********//
  $('a[data-toggle="tab"]').addClass('disabled');
});

//*******CONSTANTE DE VUE #app********//
const app = new Vue({
    
    el: '#app',
    data:{
        btn_cuota: false,
        //*******VARIABLE DE MENU********//
        menu:true,
        //*******VARIABLE resuesta utilizada para llenarlo con la data de las apis********//
        respuesta:'',
        //*******VARIABLE array listarCreditos utilizada para llenarlo con la data que viene de la api listar creditos********//
        listarCreditos:[],
        //*******VARIABLE array listarCuotaGastos utilizada para llenarlo con la data que viene de la api listar cuota de gastos********//
        listarCuotaGastos:[],
        //*******VARIABLE array listaDesgloseCredito utilizada para llenarlo con la data que viene de la api listar desglose de credito********//
        listaDesgloseCredito:[],
        //*******VARIABLE array listaDesgloseCuotagasto utilizada para llenarlo con la data que viene de la api listar desglose de cuota de gatos********//
        listaDesgloseCuotagasto:[],
        //*********VARIABLE selected, utilizada para ver los checkbox seleccionados*******//
        selected: [],
        //**********VARIABLE DE ID CREDITO***********///
        idcredito:0,
        //**********VARIABLE DE ID DESGLOSE DE CREDITO***********///
        iddesglose_credito:[],
        //**********VARIABLE DE ID CUOTA DE GASTOS***********///
        idcuota_gastos:0,
        //**********VARIABLE DE ID DESGLOSE DE CUOTA DE GASTOS***********///
        iddesglose_cuotagastos:[],

        arraySelect: []
       
    },
    //*********CREATED ejecuta constantemente los metodos que llaman dentro de este*******//
    created(){
        //*********LLama al metodo listar creditos*******//
        this.listarCredito();
        //*********LLama al metodo listar cuota de gastos*******//
        this.listarCuotaGasto();

    },
    computed: {
        //**********funcion que suma el valor de cada cuotas********//
        total_price() {
            var sum = 0;
            //********recorre el array selected sumando los valores********//
            this.selected.forEach(e => {sum += e.valor;});
            return sum
        },
        //********funcion que muestra las cuotas seleccionadas********//
        checkSeleccionado(){
            var cadena="";
            //********recorre el array selected mostrando el N° de cuota y valor de la cuota********//
            this.selected.forEach(e => {
                cadena +='<div class="col-6"><div class="card border border-light rounded">Cuota N°' +  e.cuota + '<br><b>$' + e.valor + '</b></div><br><br></div>';});
            //console.log(cadena);
            return cadena
        }

        

    },
    methods: {
    
        ///********listar los creditos********// 
        listarCredito(){
            //axios GET a /api/crud/getCredito.php
            axios.get('../api/crud/getCredito.php')
            .then(res => {
                this.listarCreditos = res.data
                //console.log(res.data)
            })
        },
        ///********listar la couta de gastos********// 
        listarCuotaGasto(){
            axios.get('../api/crud/getCuotaGastos.php')
            .then(res => {
                this.listarCuotaGastos = res.data
                //console.log(res.data)
            })
        },

        //************Metodo seleccionar credito***************//
        seleccionarCredito(id){
            this.btn_cuota = false;
            //********se pasa el id*******///
            this.idcredito = id;
            //********si el id del credito es > 0******//
            if(this.idcredito >0){
                //*****axios GET a /api/crud/seleccionaCredito.php pasando parametro id del credito******//
                axios.get('../api/crud/seleccionaCredito.php', {
                    params: {
                        idcredito: this.idcredito
                    }
                 })
                 .then(res => {
                     
                    //*********remueve la clase disabled **********////
                    $('a[data-toggle="tab"]').removeClass('disabled');
                    //*********acciona el tab**********////
                    $('#profile-tab').tab('show');
                    //*********añade la clase disabled**********////
                    $('a[data-toggle="tab"]').addClass('disabled');
                    //*********respuesta desglose de credito en base al id de credito seleccionado**********////
                    this.listaDesgloseCredito = res.data;  
                 })
            } 
        },

        //************Metodo seleccionar cuota gasto***************//
        seleccionarCuotagasto(id){
             this.btn_cuota = true;
            //********se pasa el id*******///
            this.idcuota_gastos = id;
            //********si el id del cuota gasto es > 0******//
            if(this.idcuota_gastos >0){
                //*****axios GET a /api/crud/seleccionaCuotagasto.php pasando parametro id del cuota gasto******//
                axios.get('../api/crud/seleccionaCuotagasto.php', {
                    params: {
                        idcuota_gastos: this.idcuota_gastos
                    }
                })
                .then(res => {
                    
                    //*********remueve la clase disabled **********////
                    $('a[data-toggle="tab"]').removeClass('disabled');
                    //*********acciona el tab**********////
                    $('#profile-tab').tab('show');
                    //*********añade la clase disabled**********////
                    $('a[data-toggle="tab"]').addClass('disabled');
                    //*********respuesta desglose de credito en base al id de credito seleccionado**********////
                    this.listaDesgloseCuotagasto = res.data;
                    console.log(res.data);  
                })
            } 
        },

        //************Metodo seleccionar cuotas de desglose de creditos***************//
        //************se debe pasar un array con los ids***************//
        seleccionarCheck(id = []){  
            //********recorre el array selected s********//
            if (this.selected) {
                this.selected.forEach(e => { 
                    if(e.checked==true){
                        id = e.iddesglose_credito
                        this.iddesglose_credito.push(id); 

                    }
                });
                console.log(this.iddesglose_credito);
                axios.post ('../api/crud/actualizarDesglose.php', {
                    params: {
                        iddesglose_credito: this.iddesglose_credito
                    }
                })
                 .then(res => {
                    this.respuesta = res.data
                    console.log(res.data);
                 })
            }
        },

        money(value) {
            totalParts = value.toFixed(2).split('.');
            return totalParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
        
        
    }
})