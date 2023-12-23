@extends('layouts.master')

@section('title', 'Items')

@section('content')
<div class="container mt-4">
    <h2>Edit Item</h2>

    <form action="{{ route('items.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" name="harga" value="{{ $item->harga }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" class="form-control" name="stok" value="{{ $item->stok }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection