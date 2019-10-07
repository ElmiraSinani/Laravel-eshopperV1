@extends('layouts.admin')

@section('body')


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Price</th>
            <th>Edit Image</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product['id']}}</td>
            <td><img src="{{asset ('storage')}}/products/{{$product['image']}}" alt="{{asset ('storage')}}/products/{{$product['image']}}" width="100" height="100" style="max-height:220px" ></td>
            <!-- <td><img src="{{ Storage::url('products/'.$product['image'])}}" alt="<?php echo Storage::url($product['image']); ?>" width="100" height="100" style="max-height:220px" >   </td>  -->
            <td>{{$product['name']}}</td>
            <td>{{$product['description']}}</td>
            <td>{{$product['type']}}</td>
            <td>{{$product['price']}}</td>
            <td><a href="{{ route('adminEditProductImageForm',['id' => $product['id'] ])}}" class="btn btn-primary">Edit Image</a></td>
            <td><a href="{{ route('adminEditProductForm',['id' => $product['id'] ])}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('adminDeleteProduct',['id' => $product['id']])}}"  class="btn btn-warning">Remove</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{$products->links()}}

</div>
@endsection