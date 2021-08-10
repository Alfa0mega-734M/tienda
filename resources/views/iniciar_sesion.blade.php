@extends('layaouts.principal')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 offset-lg-4 margin-top-login">
                <img class="logo" src="{{ asset('images/logo.jpg') }}" alt="Logo CARTONBOL" />
                <h3 class="mb-4">Iniciar sesión</h3>
                <form id='formulario-iniciar-sesion'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email: </label>
                      <input type="email" name='email' class="form-control" placeholder="Ingrese su correo electrónico">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password: </label>
                      <input type="password" name='contrasena' class="form-control" placeholder="Ingrese su contraseña">
                    </div>
                    <button id='btn-enviar-formulario' type="button" class="btn btn-primary btn-block mt-4">Ingresar</button>
                    <div id="load_login" class="btn btn-primary disabled btn-block d-none mt-4">
                        <div class="loader">
                            Verificando información...
                        </div>
                    </div>
                </form>
                <p class="mt-3">
                    ¿No tienes una cuenta? <a href="{{ route('registro') }}">¡Regístrate!</a>
                </p>
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        
        $('#btn-enviar-formulario').click( function(){
            let formulario = $('#formulario-iniciar-sesion').serialize();
            $.ajax({
                method: 'post',
                url:'/validacion-iniciar-sesion',
                data: formulario,
                beforeSend: function(){
                    $('#load_login').removeClass('d-none');
                    $('#btn-enviar-formulario').addClass('d-none');
                },
                success: function(res){
                    location.reload();
                },
                error: function(error){
                    let errores = error.responseJSON.errors;

                    if (errores.hasOwnProperty('email')){
                        alert(errores.email[0]);
                    }else  if (errores.hasOwnProperty('contrasena')){ 
                        alert(errores.contrasena[0]);
                            
                    }else{
                        alert(errores.login[0])
                    }
                },
                complete: function(){
                    $('#load_login').addClass('d-none');
                    $('#btn-enviar-formulario').removeClass('d-none');
                }
            });
        });
    </script>
@endsection