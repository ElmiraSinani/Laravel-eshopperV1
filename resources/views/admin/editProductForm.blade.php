@extends('layouts.admin')

@section('body')


<div class="table-responsive">

    <form action="{{ route('adminUpdateProduct',['id' => $product->id ])}}" method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="description" value="{{$product->description}}" required>
        </div>


        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="type" value="{{$product->type}}" required>
        </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="price" value="{{$product->price}}" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>

</div>




@endsection