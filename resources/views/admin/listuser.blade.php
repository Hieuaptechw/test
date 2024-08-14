@extends('admin.app')
@section('content')
<div class="user">
<table class="user-list-table table table-striped">
    <h3>List User</h3>
            <thead>
                <tr class="user-list-table-header">
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Order</td>
                    <td>Cart</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                     <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>    
                    <td>{{ $user->total_orders }}</td> 
                    <td>{{ $user->total_cart_items }}</td>                     
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}

</div>
@endsection