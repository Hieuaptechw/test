@extends('admin.app')

@section('content')
    <div class="list-product">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-fail">
                {{ session('fail') }}
            </div>
        @endif
        <h3>List Product</h3>
        <table class="product-list-table table table-striped">
            <thead>
                <tr class="product-list-table-header">
                    <td>Name</td>
                    <td>Price</td>
                    <td>Image</td>
                    <td>Quantity</td>
                    <td>Option</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($productlist as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td><img src="{{ asset($product->avatar_product) }}" alt="Product Image" style="width:70px;"></td>

                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{ url('/admin/products/edit/' . $product->product_id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ url('/admin/products/delete/' . $product->product_id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $productlist->links() }}
    </div>
    <script>
           function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xoá?');
        }

        function confirmUpdate() {
            var isEdit = {{ isset($brand) ? 'true' : 'false' }};
            if (isEdit) {
                return confirm('Bạn có chắc chắn muốn cập nhật?');
            };
            return true;
        }
    </script>
@endsection
