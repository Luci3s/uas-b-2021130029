@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Selamat datang di Toko Sembako Serbada Ada dan Serba</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Items</h5>
                    <p class="card-text">Total Items: {{ $totalItems }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">Total Orders: {{ $totalOrders }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
