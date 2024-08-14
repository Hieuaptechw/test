@extends('admin.app')
@section('content')
    <div class="add-product ">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ url('/admin/products/update/'.$product->product_id) }}" method="POST" enctype="multipart/form-data" class="row">
            @csrf
            @method('PUT')
            <div class="col-md-8 ">
                <div class="product-information row">
                    <h4>Update Product</h4>
                    <div class="col-md-12 mb-3">
                        <label for="product-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="product-name" name="name"
                            value="{{ $product->name }}" placeholder="Product title" required>
                    </div>

                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Category</label>
                        <select class="form-select" id="validationCustom04" name="category_id" required>
                            <option value="">Choose...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="subcategory" class="form-label">Sub Category</label>
                        <select class="form-select" id="subcategory" name="subcategory_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->subcategory_id }}"
                                    {{ $product->subcategory_id == $subcategory->subcategory_id ? 'selected' : '' }}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Brand</label>
                        <select class="form-select" id="validationCustom04" name="brand_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->brand_id }}"
                                    {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Store</label>
                        <select class="form-select" id="validationCustom04" name="store_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->store_id }}"
                                    {{ $product->store_id == $store->store_id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description (Optional)</label>
                        <textarea name="description" id="editor1" class="form-control custom-class ckeditor">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="product-img row">
                    <div class="col-md-4 mb-3">
                        <h4>Product Avatar</h4>
                        <input type="file" id="file" class="form-control"  name="product_avatar" 
                            onchange="previewAvatar(event)">
                        <input type="hidden" id="input-file-img-hiden" name="avatar_path">
                        <div class="image-old">
                        <p>Product Avatar OLD</p>
                        <img id="avatar-preview" src="{{ asset($product->avatar_product) }}" alt="Product Image"
                            width="80px">
                        </div>
                        <div class="image-show" id="input-file-img"></div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h4>Product Images</h4>
                        <input type="file" class="form-control" id="files" name="product_images[]"  multiple
                            onchange="previewImages(event)">
                        <div class="image-old" id="image-old-container">
                        <p>Product Images Old</p>
                            @foreach ($product->images as $image)
                                <img src="{{ asset($image->image_url) }}" alt="Product Image" width="80px">
                            @endforeach
                        </div>
        
                        <div class="input-file-imgs" id="input-file-imgs"></div>


                    </div>
                </div>
            </div>
            <div class=" col-md-4">
                <div class="product-price">
                    <h4>Product price</h4>
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Product price"
                        required value="{{ $product->price }}">
                    <label for="price_sale" class="form-label">Price Sale</label>
                    <input type="text" class="form-control" id="price_sale" name="price_sale"
                        placeholder="Product sale price" required value="{{ $product->price_sale }}">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity"
                        required value="{{ $product->quantity }}">
                </div>
                <div class="product-variant">
                    <h4>Product Variants</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Color</h5>
                            @foreach (['Black', 'White', 'Red'] as $color)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $color }}" id="{{ $color }}" name="color[]"
                                        @if(in_array($color, $selectedColorsArray)) checked @endif>
                                    <label class="form-check-label" for="{{ $color }}">{{ $color }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <h5>Weight</h5>
                            @foreach (['5kg', '10kg', '15kg'] as $weight)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $weight }}" id="{{ $weight }}" name="weight[]"
                                        @if(in_array($weight, $selectedWeightArray)) checked @endif>
                                    <label class="form-check-label" for="{{ $weight }}">{{ $weight }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <h5>Inch</h5>
                            @foreach (['5inch', '10inch', '16inch', '20inch', '32inch', '37inch'] as $inch)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $inch }}" id="{{ $inch }}" name="inch[]"
                                        @if(in_array($inch, $selectedInchArray)) checked @endif>
                                    <label class="form-check-label" for="{{ $inch }}">{{ $inch }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
                    </div>
                </div>
            </div>
           
        </form>
    </div>
@endsection

@section('scripts')
<script>
     document.querySelectorAll('.ckeditor').forEach((editor) => {
            ClassicEditor
                .create(editor, {})
                .catch(error => {
                    console.error(error);
                });
        });

        function previewAvatar(event) {
            hideImages();
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('input-file-imgs');
            const oldImagesContainer = document.getElementById('image-old-container');

            oldImagesContainer.style.display = 'none';

            previewContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 90;
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
        function hideImages() {
    // Ẩn Product Avatar cũ
    const avatarPreview = document.getElementById('avatar-preview');
    if (avatarPreview) {
        avatarPreview.style.display = 'none';
    }

    // Ẩn tất cả Product Images cũ
    const oldImages = document.querySelectorAll('.image-old .old-image');
    oldImages.forEach(image => {
        image.style.display = 'none';
    });
}
</script>
@endsection
