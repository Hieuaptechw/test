@extends('admin.app')
@section('content')
    <div class="brand">
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
        <div class="brand-from">
            <div class="row">
                <h3>{{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}</h3>
                <form method="POST" action="{{ isset($brand) ? url('/admin/brand/update/' . $brand->brand_id) : url('/admin/brand/add') }}" onsubmit="return confirmUpdate()">
                    @csrf
                    @if (isset($brand))
                        @method('PUT')
                    @endif
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Brand Name" value="{{ isset($brand) ? $brand->name : '' }}" required>
                        <label for="floatingInput">Brand:</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($brand) ? 'Update' : 'Add' }}</button>
                </form>
                
            </div>

        </div>
        <div class="brand-list">
            <h3>List Brand</h3>
            <table class="brand-list-table">
                <tr class="brand-list-table-header">
                    <td>Name</td>
                    <td>Description</td>
                    <td>Option</td>
                </tr>
                @foreach ($brands as $branditem)
                    <tr>
                
                        <td>{{ $branditem->name }}</td>
                        <td>{{ $branditem->description }}</td>
                        <td>
                            <a href="{{ url('/admin/brand/edit/' . $branditem->brand_id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ url('/admin/brand/delete/' . $branditem->brand_id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $brands->links() }}

        </div>
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
