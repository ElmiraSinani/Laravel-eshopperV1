
@extends('layouts.admin')

@section('body')

@if(Auth::user()->admin_level == 1)
<div class="table-responsive">


    <form action="{{route('adminUpdateOrder',['order_id' => $order->order_id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="{{$order->date}}" required>
        </div>
        <div class="form-group">
            <label for="del_date">Delivery Date</label>
            <input type="date" class="form-control" name="del_date" id="del_date" placeholder="delivery date" value="{{$order->del_date}}" required>
        </div>


        <div class="form-group">
            <label for="price">Price</label>
            <input type=number step="0.01" class="form-control" name="price" id="price" placeholder="price" value="{{$order->price}}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" name="status" id="status" placeholder="status" value="{{$order->status}}" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>

</div>

@else
<div class="alert alert-danger">Only first level admins can edit products</div>
@endif
@endsection