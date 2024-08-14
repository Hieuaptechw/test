@extends('admin.app')
@section('content')
<div class="subcategories">
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

    <div class="subcategorie-form">
        <div class="row">
            <h3>{{ isset($subcategory) ? 'Edit Subcategory' : 'Add Subcategory' }}</h3>
            <form method="POST" action="{{ isset($subcategory) ? url('/admin/subcategories/update/' . $subcategory->subcategory_id) : url('/admin/subcategories/add') }}" onsubmit="return confirmUpdate()">
                @csrf
                @if(isset($subcategory))
                    @method('PUT')
                @endif
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Subcategory Name" value="{{ isset($subcategory) ? $subcategory->name : '' }}" required>
                    <label for="floatingInput">Subcategory:</label>
                </div>
                <label for="validationCustom04" class="form-label">Category</label>
                <select class="form-select" id="validationCustom04" name="category_id" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" {{ isset($subcategory) && $subcategory->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">{{ isset($subcategory) ? 'Update' : 'Add' }}</button>
            </form>
        </div>
   
    </div>

    <div class="subcategorie-list">
        <h3>List Subcategory</h3>
        <table class="subcategorie-list-table">
            <tr class="subcategorie-list-table-header">
                <td>Name</td>
                <td>Category</td>
                <td>Option</td>
            </tr>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->name }}</td>
                 
                        <td>
                            @php
                                $categoryName = DB::table('categories')->where('category_id', $subcategory->category_id)->value('name');
                            @endphp
                            {{ $categoryName ?? 'No Category' }}
                        </td>
                 
                    <td>
                        <a href="{{ url('/admin/subcategories/edit/' . $subcategory->subcategory_id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ url('/admin/subcategories/delete/' . $subcategory->subcategory_id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $subcategories->links() }}
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xoá?');
    }

    function confirmUpdate() {
        var isEdit = {{ isset($subcategory) ? 'true' : 'false' }};
        if (isEdit === 'true') {
            return confirm('Bạn có chắc chắn muốn cập nhật?');
        }
        return true;
    }
</script>

@endsection
