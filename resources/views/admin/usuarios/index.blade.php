@extends('layouts.admin')

@section('content')
 <div class="row">
    <h1>Listado de Usuarios</h1>
 </div>
 <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
                <div class="card-tools">
                  <a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"><i class="bi bi-person-add"></i> Agregar usuario</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $cont=0; 
                    @endphp
                    @foreach($usuarios as $usuario)
                        @php 
                            $cont++; 
                            $id = $usuario->id;                        
                        @endphp
                    <tr>
                        <td class="text-center">{{$cont}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('usuarios.show',$usuario->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{route('usuarios.edit',$usuario->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{route('usuarios.destroy',$usuario->id)}}" onclick = "preguntar<?=$id;?>(event)" method="POST" 
                                                 id="miFormulario<?=$id;?>">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                                <script>
                                    function preguntar<?=$id;?>(event){
                                        event.preventDefault();
                                        Swal.fire({
                                            title: "Eliminar Registro",
                                            text: "¿Desea eleminar este registro?",
                                            icon: "question",
                                            showDenyButton: true,
                                            confirmButtonText: "Eliminar",
                                            confirmButtonColor: "#a5161d",
                                            denyButtonText: "Cancelar",
                                            denyButtonColor: "#270a0a"
                                        }).then((result) => {
                                            if (result.isConfirmed) 
                                            {
                                                var form = $('#miFormulario<?=$id;?>');
                                                form.submit();
                                            };
                                        });

                                    }

                                </script>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
 </div>
@endsection