@extends('layouts.admin')

@section('content')
 <div class="row">
    <h1>Principal</h1>
 </div>
<div class="row">
    <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
               @php $cont_user = 0; @endphp

               @foreach($usuarios as $usuario)
                  @php $cont_user++; @endphp
               @endforeach
                <h3>{{$cont_user}}</h3>

                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{url('/admin/usuarios')}}" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

</div>


@endsection