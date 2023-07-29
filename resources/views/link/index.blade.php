@extends('layouts.link.app')
@section('css')
<title>Link Product</title>
@stop
@section('content')
<div class="slideshow slideshow-wrapper pb-section">
   <div class="home-slideshow">
      @foreach($banner as $banners)
      <div class="slide">
         <div class="blur-up lazyload">
            <img class="blur-up lazyload" data-src="{{ $banners->image }}" src="{{ $banners->image }}" title="{{$banners->title}}" />
         </div>
      </div>
      @endforeach
   </div>
</div>
<div class="pb-section">
    <form id="session" action="{{ route('store.product.session') }}" method="POST">
        @csrf
        @foreach($cat as $cats)
        <div class="">
            <div class="blur-up lazyload">
                <label for="checkbox{{$cats->id}}">
                    <img class="blur-up lazyload w-100" src="{{$cats->image}}" />
                </label>
            </div>
        </div>
        <div class="container">
            <div class="grid-products">
                <div class="row">
                    @foreach($products as $product)
                    @if($product->link_id == $cats->id)
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <div class="product-image" style="text-align: center; position: relative;">
                            <p class="style-code" style="font-weight: bold; color:black; margin-top:190px;">{{$product->style_code}}</p>
                            <img src="{{$product->image}}" class="h-50 wardrobe-image">
                            <h4 class="mt-2">{{$product->product_name}}</h4>
                            <div class="product-price">
                                <span class="old-price">₹{{$product->mrp}}</span>
                                <span class="price">₹{{$product->selling_price}}</span>
                            </div>
                            <input type="checkbox" id="checkbox{{$cats->id}}" name="selected_products[]" value="{{$product->id}}" data-product-id="{{$product->id}}">
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <!-- Submit Button -->
        <div class="container">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@stop
@section('js')
<script>
// Remove the previous JavaScript code since we no longer need it.
</script>
@stop
