@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('users.create') }}"> Crear Nuevo Usuario</a>
                        </div>
                    </div>
              </div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                 <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->email }}</td>
                   <td>
                     @if(!empty($user->getRoleNames()))
                       @foreach($user->getRoleNames() as $v)
                          <label class="badge badge-success">{{ $v }}</label>
                       @endforeach
                     @endif
                   </td>
                   <td>
                      <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Ver</a>
                      <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                       {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                           {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                       {!! Form::close() !!}
                   </td>
                 </tr>
                @endforeach
               </table>
               
               <div class="py-3">
                {{ $data->links() }}
               </div>
        </div>
       
      </div>
    
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop