@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado de Productos</div>

                    <div class="card-body">
                        <my-products-component></my-products-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    
@endsection
