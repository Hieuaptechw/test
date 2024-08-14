@extends('admin.app')
@section('content')
<div class="add-product ">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        <div class="col-md-8 ">
            <div class="product-information row">
                <h4>Product information</h4>
                <div class="col-md-12 mb-3">
                    <label for="product-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="product-name" name="name" placeholder="Product title" required>
                </div>

                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Category</label>
                    <select class="form-select" id="validationCustom04" name="category_id" required>
                        <option selected disabled value="">Choose...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="subcategory" class="form-label">Sub Category</label>
                    <select class="form-select" id="subcategory" name="subcategory_id" required>
                        <option selected disabled value="">Choose...</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->subcategory_id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Brand</label>
                    <select class="form-select" id="validationCustom04" name="brand_id" required>
                        <option selected disabled value="">Choose...</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Store</label>
                    <select class="form-select" id="validationCustom04" name="store_id" required>
                        <option selected disabled value="">Choose...</option>
                        @foreach ($stores as $store)
                            <option value="{{ $store->store_id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description (Optional)</label>
                    <textarea name="description" id="editor1" class="form-control custom-class ckeditor"></textarea>
                </div>
            </div>
            <div class="product-img row">
                <div class="col-md-4 mb-3">
                    <h4>Product Avatar</h4>
                    <input type="file" id="file" class="form-control" name="product_avatar" required>
                    <input type="hidden" id="input-file-img-hidden" name="product_avatar">
                    <div class="image-show" id="input-file-img"></div>
                </div>
                <div class="col-md-8 mb-3">
                    <h4>Product Images</h4>
                    <input type="file" class="form-control" id="files" name="product_images[]" required multiple>
                    <div class="input-file-imgs" id="input-file-imgs"></div>
                </div>
            </div>
            
        
        </div>
        <div class=" col-md-4">
            <div class="product-price">
                <h4>Product price</h4>
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Product price" required>
                <label for="price_sale" class="form-label">Price Sale</label>
                <input type="text" class="form-control" id="price_sale" name="price_sale" placeholder="Product sale price" required>
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
            </div>
            <div class="product-variant">
                <h4>Product Variants</h4>
                <div class="row">
                    <div class="col-md-4">
                        <h5>Color</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Black" id="Black" name="color[]">
                            <label class="form-check-label" for="Black">Black</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="White" id="White" name="color[]">
                            <label class="form-check-label" for="White">White</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Red" id="Red" name="color[]">
                            <label class="form-check-label" for="Red">Red</label>
                        </div>
                    </div>        
                    <div class="col-md-4">
                        <h5>Weight</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="5kg" id="5kg" name="weight[]">
                            <label class="form-check-label" for="5kg">5kg</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="10kg" id="10kg" name="weight[]">
                            <label class="form-check-label" for="10kg">10kg</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="15kg" id="15kg" name="weight[]">
                            <label class="form-check-label" for="15kg">15kg</label>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <h5>Inch</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="5inch" id="5inch" name="inch[]">
                            <label class="form-check-label" for="5inch">5inch</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="10inch" id="10inch" name="inch[]">
                            <label class="form-check-label" for="10inch">10inch</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="16inch" id="16inch" name="inch[]">
                            <label class="form-check-label" for="16inch">16inch</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="20inch" id="20inch" name="inch[]">
                            <label class="form-check-label" for="20inch">20inch</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="32inch" id="32inch" name="inch[]">
                            <label class="form-check-label" for="32inch">32inch</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="37inch" id="37inch" name="inch[]">
                            <label class="form-check-label" for="37inch">37inch</label>
                        </div>
                    </div>
                    <div class="col-md-12">
    <button type="submit" class="btn btn-primary ">Save Product</button>
                    </div>
                </div>
            </div>           
        </div>
    </form>
</div>
<script>
    document.querySelectorAll('.ckeditor').forEach((editor) => {
        ClassicEditor
            .create(editor, {})
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
