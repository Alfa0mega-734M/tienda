@extends('layaouts.principal')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 offset-lg-4 margin-top-login" id="app">
                <img class="logo" src="{{ asset('images/logo.jpg') }}" alt="Logo CARTONBOL" />
                <h3 class="mb-4">Resgistro</h3>
                <form id='formulario-iniciar-sesion'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre: </label>
                        <input type="text" name='nombre' class="form-control" placeholder="Ingrese su nombre completo" v-model="nombre">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email: </label>
                      <input type="email" name='email' class="form-control" placeholder="Ingrese su correo electrónico" v-model="email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password: </label>
                      <input type="password" name='contrasena' class="form-control" placeholder="Ingrese su contraseña" v-model="pass1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirmar Password: </label>
                        <input type="password" name='contrasena_confirmacion' class="form-control" placeholder="Verificar su contraseña" v-model="pass2"> 
                      </div>
                    <button id='btn-enviar-formulario' @click="crearCuenta()" type="button" class="btn btn-primary btn-block mt-4">Regístrate</button>
                    <div id="load_login" class="btn btn-primary disabled btn-block d-none mt-4">
                        <div class="loader">
                            Verificando información...
                        </div>
                    </div>
                </form>
                <p class="mt-3">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}">¡Inicia sesión!</a>
                </p>
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //Código de VueJS
        let app = new Vue({
            el: '#app',
            data: {
                nombre:'',
                email: '',
                pass1: '',
                pass2: ''
            },
            methods:{
                crearCuenta: function(){
                    let _this = this;
                    $.ajax({
                        method: 'post',
                        url:'{{ route('registro') }}',
                        data: {
                            nombre: this.nombre,
                            email: this.email,
                            contrasena: this.pass1,
                            contrasena_confirmation: this.pass2
                        },
                        beforeSend: function(){
                            $('#load_login').removeClass('d-none');
                            $('#btn-enviar-formulario').addClass('d-none');
                        },
                        success: function(res){
                            _this.nombre = '';
                            _this.email = '';
                            _this.pass1 = '';
                            _this.pass2 = '';
                            swal({
                                title: 'Te has registrado',
                                text: 'Tu cuenta ha sido creada',
                                icon: 'success',
                                closeOnEsc: false,
                                closeOnClickOutside: false,
                            }).then(function(){
                                location.reload();
                            });
                            
                        },
                        error: function(error){
                            let errores = error.responseJSON.errors;
                            let mensaje = 'Error en el servidor';

                            if (errores.hasOwnProperty('nombre')){
                                mensaje = errores.nombre[0];
                            }else  if (errores.hasOwnProperty('email')){ 
                                mensaje = errores.email[0];
                                    
                            }else  if (errores.hasOwnProperty('contrasena')){ 
                                mensaje = errores.contrasena[0];
                                    
                            }else{
                                mensaje = errores.login[0];
                            }

                            swal('Error', mensaje,'error');
                        },
                        complete: function(){
                            $('#load_login').addClass('d-none');
                            $('#btn-enviar-formulario').removeClass('d-none');
                        }
                    });
                }
            }
        });
    </script>
@endsection