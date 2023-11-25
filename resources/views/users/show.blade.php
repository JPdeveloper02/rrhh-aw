@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuario: <b>{{ strtoupper($user->name) }}</b></h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-danger" href="{{ route('users.index') }}">Atras</a>
                    </div>
                </div>
            </div>
          </div>
    </div>

@stop

@section('css')
    
@stop

@section('js')
    
@stop