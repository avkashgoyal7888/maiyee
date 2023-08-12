@extends('layouts.link.app')
@section('css')
<title>Link Product</title>
<style>
    .wardrobe-image {
        width: 100%; /* Adjust this as needed */
        height: auto; /* This maintains the aspect ratio */
        max-width: 100%;
    }

    .wardrobe-image:hover {
        transition: transform .2s;
        transform: scale(1.8);
        cursor: pointer;
        position: relative;
        z-index: 1;
    }
</style>

@stop
@section('content')
<!--Header-->
<div class="header-wrap animated d-flex border-bottom" style="position: fixed; background-color:#fff; position:fixed; z-index:2; width:100%; margin-bottom:50px;">
    <div class="container-fluid" style="width:100%; padding:15px;">
        <a href="#" style="margin: auto; margin-top:50px;">
            <img src="https://res.cloudinary.com/dzujz2mkt/image/upload/v1688378123/maiyee.png" height="55" width="110">
        </a>
        <div class="site-cart"> 
            <p style="text-align: right; margin-top:25px;"><a href="#" class="site-header__cart" title="Cart">
                <i class="icon anm anm-bag-l"></i>
                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"></span>
            </a></p>
        </div>
    </div>
</div>
<!--End Header-->
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
    <div id="loader" style="display:none;">
    @include('components.loader')
   </div>
    <form id="session">
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
                            <img src="{{$product->image}}" class="wardrobe-image" alt="Product Image">
                            <h4 class="mt-2">
    {{$product->product_name}}
    <span class="style-code" style="font-weight: bold; color: black; margin-top: 190px;">({{$product->style_code}})</span>
</h4>

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
            <p class="text-center text-danger" id="error"></p>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <div id="error-message" style="color: red;"></div>
</div>
@stop
@section('js')
<script>
$(document).ready(function(){
    function updateCartCount() {
            var selectedProductsCount = $("input[name='selected_products[]']:checked").length;
            $("#CartCount").text(selectedProductsCount);
        }

        // Call the function on page load
        updateCartCount();

        // Call the function whenever a checkbox is clicked
        $("input[name='selected_products[]']").on("change", function () {
            updateCartCount();
        });
    $('#session').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission
        let fd = new FormData(this);
        fd.append('_token', "{{ csrf_token() }}");
 
        $.ajax({
            url: "{{ route('store.product.session') }}",
            type: "POST",
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#addBtn').prop('disabled', true)
                $('#loader').show();
            },
            success: function(result) {
                if (result.status === false) {
                    $('#error').text(result.msg);
                    toastr.error(result.msg, 'Error', {
                        timeOut: 1500,
                        progressBar: true,
                        closeButton: true
                    });
                } else if (result.status === true) {
                    $('#session')[0].reset();
                    toastr.success(result.msg, 'Success', {
                        timeOut: 500,
                        progressBar: true,
                        closeButton: true
                    });
                    window.location.href = result.redirectTo; // Update this line
                }
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR.responseJSON);
                toastr.error(result.msg, 'Error', {
                    timeOut: 500,
                    progressBar: true,
                    closeButton: true
                });
            },
            complete: function() {
                $('#addBtn').prop('disabled', false);
                $('#loader').hide();
            }
        });
    });
});
</script>

@stop
