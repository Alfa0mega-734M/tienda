@extends('layaouts.principal')
@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<style>
    .nav-principal {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }

    .logo-productos {
        width: 100px;
    }

    .buscador {
        width: 90px !important;
    }

    .btn-registrate {
        border: 1px solid #707070;
        border-radius: 10px;
        padding: 7px 15px !important;
    }

    .img-caja {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        object-fit: cover;
    }

    .precio-caja {
        font-size: 1.3rem;
    }

    .nombre-caja {
        font-size: 1.2rem;
        display: inline-block;
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .nombre-categoria {
        font-size: 1rem;
        display: inline-block;
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .estrella-completa {
        color: #FFD013;
    }

    .enlace-caja:hover {
        text-decoration: none;
    }

    .enlace-caja,
    .enlace-caja:hover {
        color: #2E2E2E;
    }

    .enlace-caja:hover h3 {
        color: #707070;
    }
</style>
@endsection

@section('contenido')

<nav class="navbar navbar-expand-lg navbar-light bg-light nav-principal">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarTogglerDemo03">

            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logoV.png') }}" class="logo-productos" alt="">
            </a>

            <form class="form-inline my-2 my-lg-0">
                <input @keyup="cargarProductos" class="form-control mr-sm-2 buscador" type="search" placeholder="Ancho"
                    v-model="ancho">
                <input @keyup="cargarProductos" class="form-control mr-sm-2 buscador" type="search" placeholder="Largo"
                    v-model="largo">
                <input @keyup="cargarProductos" class="form-control mr-sm-2 buscador" type="search" placeholder="Alto"
                    v-model="alto">
                <select class="custom-select">
                    <option selected>Presición</option>
                    <option value="1">±3</option>
                    <option value="2">±5</option>
                    <option value="3">±10</option>
                </select>
            </form>

            <!--<ul class="navbar-nav mt-2 mt-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
              </li>
              <li class="nav-item ml-2">
                <a class="nav-link btn-registrate" href="{{ route('registro') }}">Regístrate</a>
              </li>
            </ul>-->

        </div>
    </div>

</nav>

<section class="container mt-4">

    <h1 class="text-center mb-3 mt-3">NUESTROS PRODUCTOS</h1>

    <div class="row">
        <div class="col-md-3 mb-4" v-for="item in productos">
            <a href="{{ route('detalle') }}" class="enlace-caja" @click="productoSeleccionado(item)">
                <div class="card card-body text-center">
                    <img src="{{ asset('images/caja.png')}}" alt="" class="img-caja">
                    <h3 class="font-weight-bold mt-3 nombre-caja" v-text="item.nombre"></h3>
                    <p class="nombre-categoria" v-text="item.tipo_producto.nombre">
                        <br>
                    </p>
                    <p><strong> Bs./ </strong> <strong class="precio-caja" v-text="item.precio_unitario_act">
                        </strong></p>
                </div>
            </a>
        </div>
    </div>


</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    const app = new Vue({
        el: '#app',
        data:{
            productos: [],
            ancho: '',
            largo:'',
            alto:''
        },
        mounted(){
            this.cargarProductos();
        },
        methods: {
            cargarProductos: function(){                 
                axios({
                    url: 'http://cartonbol.ga:36512/api/producto/listaCompleta',
                    method: 'get',
                    params: {
                        page: 1,
                        perPage: 8,
                        ancho: this.ancho,
                        largo: this.largo,
                        alto: this.alto
                    }                    
                })
                .then(response => {                                           
                    this.productos = response.data.data;                            
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
            },

            productoSeleccionado: function(item){                
                localStorage.setItem('producto', JSON.stringify(item));                    
            }

        }
    })


</script>

@endsection




