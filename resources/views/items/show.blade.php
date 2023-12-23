@extends('layouts.master')

@section('title', 'Items')

@section('content')
<div class="container mt-4">
    <h2>Item Detail</h2>

    <div class="card">
        <div class="card-body">
            <p class="card-text">ID: {{ $item->id }}</p>
            <p class="card-text">Nama: {{ $item->nama }}</p>
            <p class="card-text">Harga: {{ $item->harga }}</p>
            <p class="card-text">Stok: {{ $item->stok }}</p>
        </div>
    </div>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection