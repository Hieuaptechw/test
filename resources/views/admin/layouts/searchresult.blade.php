@extends('admin.app')

@section('content')
<div class="search-result">
    <h3>Search Results for "{{ $query }}"</h3>

    
    @if($products->isEmpty())
        
        <p>*No products found.</p>
    @else
    <h2>Products</h2>
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
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price_sale }}</td>
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
    @endif

   
    @if($categories->isEmpty())
        <p>*No categories found.</p>
    @else
    <h2>Categories</h2>
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
    @endif

    
    @if($brands->isEmpty())
        <p>No brands found.</p>
    @else
    <table class="brand-list-table">
    <h2>Brands</h2>
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
    @endif

   
    @if($subcategories->isEmpty())
        <p>*No subcategori found.</p>
    @else
        <ul>
        <h2>Subcategori</h2>
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
        </ul>
    @endif
</div>
@endsection