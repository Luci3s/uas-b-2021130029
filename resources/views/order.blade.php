@extends('layouts.master')

@section('title', 'Order')

@section('content')
<div class="container mt-4">
    <h2>Create Order</h2>

    <form id="orderForm" action="{{ route('order.createOrder') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" name="status" required>
                <option value="selesai">Selesai</option>
                <option value="menunggu pembayaran">Menunggu Pembayaran</option>
            </select>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary" id="addItemBtn">Tambah Item</button>
        </div>

        <div id="itemFormContainer">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Item</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="form-group">
            <label for="totalPrice">Harga Setelah Pajak:</label>
            <input type="text" class="form-control" id="totalPrice" readonly>
        </div>

        <button type="submit" class="btn btn-primary" id="createOrderBtn" disabled>Create Order</button>
    </form>

    <a href="{{ route('app.index') }}" class="btn btn-secondary mt-3">Back to Home</a>
</div>

<script>
    $(document).ready(function() {
        let itemCount = 0;

        $('#createOrderBtn').prop('disabled', true);

        $('#addItemBtn').on('click', function() {
            itemCount++;
            const itemForm = `
                <tr id="item-${itemCount}">
                    <td>
                        <select class="form-control item-select" name="items[${itemCount}][item_id]" required>
                            <option value="">Pilih Item</option>
                            @foreach($items as $item)
                                @if($item->stok > 0)
                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}">{{ $item->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control quantity" name="items[${itemCount}][quantity]" min="1" value="1">
                    </td>
                    <td>
                        <input type="text" class="form-control price" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-remove-item" data-item-id="${itemCount}">Remove</button>
                    </td>
                </tr>
            `;
            $('#itemFormContainer tbody').append(itemForm);

            $('#createOrderBtn').prop('disabled', false);

            $('.item-select').on('change', function() {
                const selectedItem = $(this).find(':selected');
                const price = selectedItem.data('harga');
                const stok = selectedItem.data('stok');
                $(this).closest('tr').find('.price').val(price);

                const quantityInput = $(this).closest('tr').find('.quantity');
                if (quantityInput.val() > stok) {
                    alert('Stok item tidak mencukupi untuk jumlah yang dipilih.');
                    quantityInput.val(1);
                }

                calculateTotalPrice();
            });

            $('.btn-remove-item').on('click', function() {
                const itemId = $(this).data('item-id');
                $(`#item-${itemId}`).remove();
                calculateTotalPrice();
            });
        });
    });

    function calculateTotalPrice() {
        let total = 0;
        $('#itemFormContainer tbody tr').each(function() {
            const quantity = $(this).find('.quantity').val();
            const price = $(this).find('.price').val();
            total += quantity * price;
        });

        const totalWithTax = total * 1.11;

        $('#totalPrice').val(totalWithTax.toFixed(2));
    }

    $(document).on('input', '.quantity', function() {
        const stok = $(this).closest('tr').find('.item-select').find(':selected').data('stok');
        if ($(this).val() > stok) {
            alert('Stok item tidak mencukupi untuk jumlah yang dipilih.');
            $(this).val(stok);
        }
        calculateTotalPrice();
    });

    calculateTotalPrice();
</script>
@endsection