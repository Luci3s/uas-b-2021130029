@extends('layouts.master')

@section('title', 'Items')

@section('content')
<div class="container mt-4">
    <h2>Create Item</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('items.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" class="form-control" name="id" pattern="[0-9]{16}" title="ID must be a 16-digit number" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" name="harga" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" class="form-control" name="stok" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection