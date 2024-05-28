@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card" style="max-width:100%">
            <div class="card-header" >{{ __('Product Detail') }}</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="d-flex justify-content-center" style="padding: 1rem">
                                <div class="image" style="margin-right:100px">
                                    <img class="card-img-top" style="object-fit: contain" src="{{ url('storage/'.$product->image) }}" alt="Card image cap" width="400rem;" height="290rem;">
                                </div>
                                <div class="details">
                                    <div class="card d-flex justify-content-center" style="border:0rem;">
                                        <h1 style="font-size:35px">{{ $product->name }}</h1>
                                        <h3>@currency($product->price)</h3>
                                        <hr>
                                        <p>{{ $product->stock }} left</p>
                                        
                                        @if (!Auth::user())
                                        @elseif (!Auth::user()->is_admin)
                                        <form action="{{ route('add_to_cart', $product) }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" aria-describedby="basic-addon2" name="amount" value="1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit"><i class="material-symbols-outlined">add_shopping_cart</i></button>
                                                </div>
                                            </div>
                                        </form>
                                        @else
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group me-2" role="group" aria-label="First group">
                                                <form action="{{ route('edit_product', $product) }}" method="get">
                                                    <button type="submit" class="btn btn-primary"><i class="material-symbols-outlined">edit_note</i></button>
                                                </form>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <form action="{{ route('delete_product', $product) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class="material-symbols-outlined">delete</i></button>
                                                </form>   
                                            </div>                                
                                        </div>
                                        <hr>
                                        @endif
                                        <div class="product-detail">
                                            <h6><b>Product description:</b></h6>
                                            <h6>{{ $product->description }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>            
    </div>
</div>
@endsection