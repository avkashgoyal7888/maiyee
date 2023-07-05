@extends('layouts.front.app')
@section('css')
<title>Welcome To Maiyee</title>
@stop
@section('content')
<a href="{{route('download')}}">download</a>
<div class="slideshow slideshow-wrapper pb-section">
   <div class="home-slideshow">
      @foreach($banner as $banners)
      <div class="slide">
         <div class="blur-up lazyload">
            <a href=" {{route('front.sub',$banners->sub_id)}} ">
            <img class="blur-up lazyload" data-src="{{ $banners->image }}" src="{{ $banners->image }}" alt="{{$banners->tag}}" title="{{$banners->tag}}" />
            </a>
         </div>
      </div>
      @endforeach
   </div>
</div>
<!--End Home slider-->
<!--Weekly Bestseller-->
<div class="section">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
               <h2 class="h2">New Arrivals</h2>
               <p>Our Most recent Added Products</p>
            </div>
            <div class="productSlider grid-products">
               @foreach($product as $products)
               <div class="col-12 item">
                  <!-- start product image -->
                  <div class="product-image">
                     <!-- start product image -->
                     <a href="{{route('web.product.detail',$products->id)}}" class="grid-view-item__link">
                        <!-- image -->
                        <img class="primary blur-up lazyload" data-src="{{$products->image}}" src="{{$products->image}}" alt="image" title="product" />
                        <!-- End image -->
                        <!-- Hover image -->
                        <img class="hover blur-up lazyload" data-src="{{$products->image}}" src="{{$products->image}}" alt="image" title="product" />
                        <!-- End hover image -->
                        <!-- Variant Image-->
                        <img class="grid-view-item__image hover variantImg" src="{{$products->image}}" alt="image" title="product">
                        <!-- Variant Image-->
                     </a>
                     <div class="button-set">
                        <div class="wishlist-btn">
    @auth
        <a href="#" data-product-id="{{$products->id}}" class="wishlist add-to-wishlist">
            <i class="icon anm anm-heart-l"></i>
        </a>
    @else
        <a href="#" data-toggle="modal" data-target="#myModal" class="wishlist">
            <i class="icon anm anm-heart-l"></i>
        </a>
    @endauth
</div>

                     </div>
                     <!-- end product button -->
                  </div>
                  <!-- end product image -->
                  <!--start product details -->
                  <div class="product-details text-center">
                     <!-- product name -->
                     <div class="product-name">
                        <a href="product-layout-1.html">{{$products->name}}</a>
                     </div>
                     <!-- End product name -->
                     <!-- product price -->
                     <div class="product-price">
                        <span class="old-price">₹{{$products->mrp}}</span>
                        <span class="price">₹{{$products->discount}}</span>
                     </div>
                     <!-- End product price -->
                  </div>
                  <!-- End product details -->
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
<!--Weekly Bestseller-->
<!--Bash-->
<div class="section">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               @foreach($bash as $bashes)
            <div class="section-header text-center mt-2">
               <h2 class="h2">{{$bashes->name}}</h2>
               <p>Our most popular products based on sales</p>
            </div>
            <div class="productSlider grid-products">
            @foreach($bashpr->where('bash_id', $bashes->id) as $products)
            @if($products != '')
               <div class="col-12 item">
                  <!-- start product image -->
                  <div class="product-image">
                     <!-- start product image -->
                     <a href="{{route('web.product.detail',$products->product->id)}}" class="grid-view-item__link">
                        <!-- image -->
                        <img class="primary blur-up lazyload" data-src="{{$products->product->image}}" src="{{$products->product->image}}" alt="image" title="product" />
                        <!-- End image -->
                        <!-- Hover image -->
                        <img class="hover blur-up lazyload" data-src="{{$products->product->image}}" src="{{$products->image}}" alt="image" title="product" />
                        <!-- End hover image -->
                        <!-- Variant Image-->
                        <img class="grid-view-item__image hover variantImg" src="{{$products->product->image}}" alt="image" title="product">
                        <!-- Variant Image-->
                     </a>
                     <div class="button-set">
                        <div class="wishlist-btn">
                           <a class="wishlist add-to-wishlist" href="#" data-product-id="{{$products->product->id}}"><i class="icon anm anm-heart-l"></i></a>

                        </div>
                     </div>
                     <!-- end product button -->
                  </div>
                  <!-- end product image -->
                  <!--start product details -->
                  <div class="product-details text-center">
                     <!-- product name -->
                     <div class="product-name">
                        <a href="product-layout-1.html">{{$products->product->name}}</a>
                     </div>
                     <!-- End product name -->
                     <!-- product price -->
                     <div class="product-price">
                        <span class="old-price">₹{{$products->product->mrp}}</span>
                        <span class="price">₹{{$products->product->discount}}</span>
                     </div>
                     <!-- End product price -->
                     
                     <!-- End Variant -->
                  </div>
                  <!-- End product details -->
               </div>
               @endif
               @endforeach
            </div>
               @endforeach
         </div>
      </div>
   </div>
</div>
<!--Bash-->


<div class="section imgBanners">
   @foreach($hbanner as $home)
   <div class="container-fluid">
       <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
           <a href="#">
               <img src="{{$home->image}}" class="blur-up lazyload" />
            </a>
        </div>
    </div>
    @endforeach
</div>
<!--End Parallax Section-->
<!--New Arrivals-->
<div class="product-rows section">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
               <h2 class="h2">Match Your Vibes</h2>
               <p>Grab these new items before they are gone!</p>
            </div>
         </div>
      </div>
      <div class="grid-products">
         <div class="row">
            @foreach($sub as $subcat)
            <div class="col-lg-2 col-md-3 col-sm-6 col-6">
               <!-- start product image -->
               <div class="product-image" style="text-align: center">
                  <!-- start product image -->
                  <a href="{{route('front.sub',$subcat->id)}}">
                     <!-- image --> 
                     <img  src="{{$subcat->tile}}">
                     <!-- End image -->
                     <h4 class="mt-2">{{$subcat->sub_name}}</h4>
                  </a>
               </div>
      </div>
      @endforeach
   </div>
</div>
@stop
@section('js')

<script>
$(document).ready(function(){
    $('.add-to-wishlist').on('click', function(e) {
        e.preventDefault(); // prevent default form submission
        let product_id = $(this).data('product-id');
        let token = "{{ csrf_token() }}";

        $.ajax({
            url: "{{ route('web.add.wishlist') }}",
            type: "POST",
            data: {
                product_id: product_id,
                _token: token
            },
            dataType: 'json',
            beforeSend: function() {
                $('.add-to-wishlist').prop('disabled', true);
            },
            success: function(result) {
                if (result.status === false) {
                    toastr.error(result.msg, 'Error', {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true
                    });
                } else if (result.status === true) {
                    toastr.success(result.msg, 'Success', {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true
                    });
                    window.location.reload();
                }
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR.responseJSON);
                toastr.error(jqXHR.responseJSON.msg, 'Error', {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true
                });
            },
            complete: function() {
                $('.add-to-wishlist').prop('disabled', false);
            }
        });
    });
});
</script>

@stop