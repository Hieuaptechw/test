@extends('admin.app')

@section('content')
<div class="order">
    <div class="row">
        <div class="col-lg-12">
            @foreach($userOrders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Order ID: #{{ $order->order_id }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="order-details mb-3">                                    
                            <p class="mb-1 "><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $order->user->phone }}</p>
                            <p class="mb-1"><strong>Address:</strong>{{ $order->user->address }}</p>
                            <p class="mb-1"><strong>Status:</strong> <span class="status-{{ $order->status }}">{{ $order->status }}</span></p>
                            <p class="mb-1"><strong>Total Price:</strong> ${{ $order->total_price }}</p>
                            <p class="mb-1"><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                            <p class="mb-1"><strong>Order Code:</strong> #{{ $order->order_code }}</p>
                        </div>
                        
                        <div class="order-items row">
                            @foreach($order->orderItems as $item)
                                <div class="d-flex align-items-center mb-3 col-4">
                                    <div class="me-3">
                                        <img src="{{ url($item->product->avatar_product) }}" alt="{{ $item->product->name }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                        <p class="mb-1"><strong>Price:</strong> ${{ $item->price }}</p>
                                        <p class="mb-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                 
                        <form action="{{ route('order.updateStatus', $order->order_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Update Status:</strong></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
