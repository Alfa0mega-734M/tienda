@extends('layaouts.principal')
@section('styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    

    <style>
        .nav-principal{
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }

        .logo-productos{
            width: 100px;
        }

        .buscador{
            width: 90px !important;
        }

        .btn-registrate{
            border:1px solid #707070;
            border-radius: 10px;
            padding: 7px 15px !important;
        }

        .img-caja{
            width: 270px;
            height: 270px;
            margin: 0 auto;
            object-fit: cover;
        }

       

    </style>
@endsection

@section('contenido')

<nav class="navbar navbar-expand-lg navbar-light bg-light nav-principal">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>          
        
          <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarTogglerDemo03">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logoV.png') }}" class="logo-productos" alt="">
                
            </a> 
            <h2 class="text-center">DETALLE DEL PRODUCTO SELECCIONADO</h2>
          </div>
    </div>    
</nav>

  <section class="container">    
    <div class="row mb-5">   

        <div class="col-md-2 mt-5"></div>
        <div class="col-md-3 mt-5">
            <img src="{{ asset('images/caja.png') }}" class="img-caja img-thumbnail img-responsive" alt="">                            
        </div>
        <div v-if="producto<>null" class="col-md-6 mt-4"  v-for="item in productos">
            <h4 class="text-left font-weight-bold" v-text="item.nombre"></h4>
            <p><strong> Precio: </strong> Bs./ <span v-text="item.precio_unitario_act"></span></p>
            <p>
                <strong> Ancho: </strong><span v-text="item.ancho"></span> 
                <strong> Largo: </strong><span v-text="item.largo"></span>
                <strong> Alto: </strong><span v-text="item.alto"></span>
            </p>          
            <p>
                <strong> Calidad: </strong><span v-text="item.calidad.nombre"></span> 
                <strong> Tipo lamina: </strong><span v-text="item.tipo_lamina.nombre"></span>
            </p>  

            <p>
                <strong> Cantidad disponible: </strong> <span v-text="item.ordenes_de_produccion[0].cant_act"></span>
            </p> 

            <h6 class="text-left">Cantidad solicitada: </h6>

            <div class="input-group col-md-5">
                <input class="form-control" type="number" step="50" value="0" min="50" pattern="^[0-9]+">
                <div class="input-group-append">
                  <span class="input-group-text">Unidades</span>
                </div>
              </div>
            
            <a class="btn btn-primary mt-3" href="#" role="button" onclick="productoAgregado()">AÑADIR PRODUCTO</a>
            <a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">SEGUIR BUSCANDO</a>



            <p class="mt-3">
                <a class="btn btn-danger" id="detalleVenta" onclick="mostrarDetalleVenta()" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Mostrar productos añadidos</a>
            </p>
        </div>

    </div>      











    <div class="row mb-5 detalleCompra">   

        <div class="col-11 text-right">
            <a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">SEGUIR BUSCANDO</a>
        </div>
        
        <div class="table-responsive col-md-12 mt-5">
            <!--<h6>Su carrito de compras contiene: 3 Productos</h6>-->
                <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">EDITAR</a></td>
                        <td><a class="btn btn-danger mt-3" href="{{ route('index') }}" role="button">ELIMINAR</a></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td><a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">EDITAR</a></td>
                        <td><a class="btn btn-danger mt-3" href="{{ route('index') }}" role="button">ELIMINAR</a></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td><a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">EDITAR</a></td>
                        <td><a class="btn btn-danger mt-3" href="{{ route('index') }}" role="button">ELIMINAR</a></td>
                      </tr>
                    </tbody>
                </table>
            
              <h5>Total a pagar: </h5>
        </div>
        <div class="col text-center">
            <a class="btn btn-primary mt-3" href="#" role="button" onclick="productoAgregado()">REALIZAR COMPRA</a>
        </div>
        
    </div>      



   
  </section>


@endsection 

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    function productoAgregado(){
        swal({
            title: "¡Producto añadido!",
            text: "Se ha añadido la cantidad indicada",
            icon: "success",
            button: "Aceptar!",
        });
    }

    $(".detalleCompra").hide();
    
    function mostrarDetalleVenta(){
        let text = "";
        if($("#detalleVenta").text() === "Mostrar productos añadidos"){
            $(".row").hide();
            $(".detalleCompra").show();
            text = "Seguir añadiendo productos";
        }else{
            $(".row").show();
            $(".detalleCompra").hide();
            text = "Mostrar productos añadidos";
        }

        $("#detalleVenta").html(text);

    }






    const app = new Vue({
        el: '#app',
        data:{
            productos: [],
            buscador: ''
        },
        mounted(){
            if (!localStorage.get(item)){

            }
        },
        methods: {
            cargarProductos: function(){    
                axios
                    .get('http://cartonbol.ga:36512/api/producto/listaCompleta?page=1&perPage=1')
                    //.get('https://jsonplaceholder.typicode.com/todos')
                    .then(response => {
                        this.productos = response.data.data
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true
                    })
                    .finally(() => this.loading = false)
            },
        
            buscarProductos: function(){
                let productos = [];
                axios
                    .get('https://jsonplaceholder.typicode.com/posts/'+this.buscador)
                    .then(response => {
                        if( this.buscador === '' ) {
                            this.cargarProductos();
                            return;
                        }
                        productos.push({
                            body: response.data.body,
                            id: response.data.id,
                            title: response.data.title,
                            userId: response.data.userId 
                        });
                        this.productos = productos;
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true
                    })
                    .finally(() => this.loading = false)
            }
        }
    })


</script>

@endsection