@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
              
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2> Show Role</h2>
                        </div>
                        <div class="pull-right">
                            
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            <ul>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <li>
                                        <label class="label label-success">{{ $v->name }},</label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('roles.index') }}"> Atras</a>
                    </div>
                </div>

            </div>
          </div>
    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop