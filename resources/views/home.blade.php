@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Info</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $userData->name }}

                    <p>Name: {!! Auth::user()->name !!}</p>
                    <p>E-mail: {!! Auth::user()->email !!}</p>
                    
                    <div>
                        <a href="{{ route('allProducts') }}" class="btn btn-primary">Main Website</a>
                        @if($userData->isAdmin())
                            <a href="{{ route('adminDisplayProducts') }}"  class="btn btn-warning">Admin Dashboard</a>
                        @else
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
