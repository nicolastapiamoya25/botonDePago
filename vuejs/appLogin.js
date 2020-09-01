const app = new Vue({
    el: '#app',
    data:{
        datos:'',
        pass:'',
        passC:'',
        respuesta:'',
        correo: '',
        boton: 'btn blue disabled',
        menu:false
    },
    methods: {
        registro(){
            if(this.pass == this.passC){
                //contante de id del formulario
                const form = document.getElementById('formRegistro')
                //axios con peticion POST
                axios.post('../api/loginRegistro/registro.php', new FormData(form))
                .then(res => {
                    //si funciona pasa a la var respuesta todo la res data
                    this.respuesta = res.data
                    this.direccionamiento()
                })
            }else{
                swal('Los password no son iguales')
            }
        },
        direccionamiento(){
            if(this.respuesta == 'success'){
                location.href = 'index.php'
            }else{
                swal('No se pudo registrar')
            }
        },
        validarCorreo(){
            if (this.validarEmail(this.correo)) {
                const formData = new FormData()
                formData.append('correo', this.correo)
                axios.post('../api/loginRegistro/validarEmail.php', formData)
                .then(res => {
                    //si funciona pasa a la var respuesta todo la res data
                    this.respuesta = res.data
                    if (res.data == 'success') {
                        this.boton = 'btn blue'
                    }else{
                        swal('El correo electronico ya existe!')
                    }
                })
            }else{
                swal('Formato de Email incorrecto')
            }
        },
        validarEmail(email){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);

        },
        //metodo login
        login(){
            //constante con el elemento inicioSesion declarado en login/index.php
            const form = document.getElementById('inicioSesion')
            //axios con peticion POST a /api/loginRegistro/login.php pasandole la data de form
            axios.post('../api/loginRegistro/login.php', new FormData(form))
            .then(res => {
                //si funciona pasa a la variable respuesta todo la data
                this.respuesta = res.data
                console.log(res.data)
                //si la data trae success redirecciona a /home
                if (res.data == 'success') {
                    location.href = '../home'
                //si no manda una alerta    
                } else {
                    swal('Usuario y/o contraseña incorrectos')
                }
            })
        }
    },

})