@extends('admin.app')
@section('content')
<div class="categories">
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
    <div class="categorie-from">
        <div class="row">
            <h3>{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h3>
            <form method="POST" action="{{ isset($category) ? url('/admin/categories/update/'. $category->category_id) : url('/admin/categories/add') }}"  onsubmit="return confirmUpdate()">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Category Name" value="{{ isset($category) ? $category->name : '' }}" required>
                    <label for="floatingInput">Category:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="slug" id="floatingInput" placeholder="Category Slug" value="{{ isset($category) ? $category->slug : '' }}" required>
                    <label for="floatingInput">Slug:</label>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Add' }}</button>
            </form>
        </div>
        
    </div>
    <div class="categorie-list">
        <h3>List Category</h3>
        <table class="categorie-list-table">
            <tr class="categorie-list-table-header">
               
                <td>Name</td>              
                <td>Slug</td>
                <td>Option</td>
            </tr>
            @foreach ($categories as $categorys)
                <tr>
                    

                    <td>{{ $categorys->name }}</td>
                    <td>{{ $categorys->slug }}</td>
                    <td>
                        <a href="{{  url('/admin/categories/edit/' . $categorys->category_id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ url('/admin/categories/delete/' . $categorys->category_id) }}" method="POST"
                            style="display:inline;"  onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Phân trang -->
        {{ $categories->links() }}
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xoá');
}
function confirmUpdate() {
    var isEdit = {{ isset($category) ? 'true' : 'false' }};
    if (isEdit) {
        return confirm('Bạn có chắc chắn muốn cập nhật?');
    };
    return true;
    }

</script>
@endsection