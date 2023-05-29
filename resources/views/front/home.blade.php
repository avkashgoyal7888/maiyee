@extends('layouts.front.app')
@section('css')
<title>Welcome To Maiyee</title>
@stop
@section('content')
<div class="slideshow slideshow-wrapper pb-section">
   <div class="home-slideshow">
      @foreach($banner as $banners)
      <div class="slide">
         <div class="blur-up lazyload">
            <a href=" {{route('front.sub',$banners->sub_id)}} ">
            <img class="blur-up lazyload" data-src="{{ asset('admin/banner/' . $banners->image) }}" src="{{ asset('admin/banner/' . $banners->image) }}" alt="{{$banners->tag}}" title="{{$banners->tag}}" />
            </a>
         </div>
      </div>
      @endforeach
      <!-- <div class="slide">
         <div class="blur-up lazyload">
             <img class="blur-up lazyload" data-src="{{asset('front/assets/images/logo.png')}}" src="{{asset('front/assets/images/logo.png')}}" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
         </div>
         </div> -->
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
                        <img class="primary blur-up lazyload" data-src="{{ asset('admin/product/' . $products->image) }}" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product" />
                        <!-- End image -->
                        <!-- Hover image -->
                        <img class="hover blur-up lazyload" data-src="{{ asset('admin/product/' . $products->image) }}" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product" />
                        <!-- End hover image -->
                        <!-- Variant Image-->
                        <img class="grid-view-item__image hover variantImg" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product">
                        <!-- Variant Image-->
                     </a>
                     <div class="button-set">
                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" data-products-id="{{$products->id}}">
                        <i class="icon anm anm-search-plus-r"></i>
                        </a>
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
                     <a href="{{route('web.product.detail',$products->id)}}" class="grid-view-item__link">
                        <!-- image -->
                        <img class="primary blur-up lazyload" data-src="{{ asset('admin/product/' . $products->product->image) }}" src="{{ asset('admin/product/' . $products->product->image) }}" alt="image" title="product" />
                        <!-- End image -->
                        <!-- Hover image -->
                        <img class="hover blur-up lazyload" data-src="{{ asset('admin/product/' . $products->product->image) }}" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product" />
                        <!-- End hover image -->
                        <!-- Variant Image-->
                        <img class="grid-view-item__image hover variantImg" src="{{ asset('admin/product/' . $products->product->image) }}" alt="image" title="product">
                        <!-- Variant Image-->
                     </a>
                     <div class="button-set">
                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                        <i class="icon anm anm-search-plus-r"></i>
                        </a>
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
<!--Parallax Section-->
<div class="section">
   @foreach($hbanner as $home)
   <div class="hero hero--medium hero__overlay bg-size">
      <img class="bg-img" src="{{asset('admin/banner/'. $home->image)}}" alt="" />
      <div class="hero__inner">
         <div class="container">
         </div>
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
                     <img  src="{{ asset('admin/tile/' . $subcat->tile) }}">
                     <!-- End image -->
                     <p class="mt-2">{{$subcat->sub_name}}</p>
                  </a>
               </div>
      </div>
      @endforeach
   </div>
</div>
<!--Quick View popup-->
<div class="modal fade quick-view-popup" id="content_quickview">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <div id="ProductSection-product-template" class="product-template__container prstyle1">
               <div class="product-single">
                  <!-- Start model close -->
                  <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
                  <!-- End model close -->
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img">
                           <div class="pl-20" id="product-image">
                              <img src="{{asset('front/assets/images/product-detail-page/camelia-reversible-big1.jpg')}}" alt="" />
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-single__meta">
                           <h2 class="product-single__title" id="product-name"></h2>
                           <div class="prInfoRow">
                              <div class="product-stock"> <span class="instock ">In Stock</span> <span class="outstock hide">Unavailable</span> </div>
                              <div class="product-sku">SKU: <span class="variant-sku">19115-rdxs</span></div>
                           </div>
                           <p class="product-single__price product-single__price-product-template">
                              <span class="visually-hidden">Regular price</span>
                              <s id="ComparePrice-product-template"><span class="money" id="product-mrp"></span></s>
                              <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                              <span id="ProductPrice-product-template"><span class="money" id="product-discount"></span></span>
                              </span>
                           </p>
                           <div class="product-single__description rte" id="product-desc"></div>
                           <form method="post" action="http://annimexweb.com/cart/add" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                              <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                 <div class="product-form__item">
                                    <label class="header">Color: <span class="slVariant" id="product-code"></span></label>
                                    <div class="swatch-element">
                                       <input class="swatchInput" id="swatch-0-red" type="radio" name="option-0" value="Red">
                                       <label class="swatchLbl color medium rectangle" id="color-image"></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                 <div class="product-form__item">
    <label class="header">Size: </label>
    <div data-value="XS" class="swatch-element xs available">
        <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
        <label class="swatchLbl medium rectangle" id="product-size-list"></label>
    </div>
</div>


                              </div>
                              <!-- Product Action -->
                              <div class="product-action clearfix">
                                 <div class="product-form__item--quantity">
                                    <div class="wrapQtyBtn">
                                       <div class="qtyField">
                                          <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                          <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty">
                                          <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="product-form__item--submit">
                                    <button type="button" name="add" class="btn product-form__cart-submit">
                                    <span>Add to cart</span>
                                    </button>
                                 </div>
                              </div>
                              <!-- End Product Action -->
                           </form>
                           <div class="display-table shareRow">
                              <div class="display-table-cell">
                                 <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--End-product-single-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End Quick View popup--> 
@stop
@section('js')

<script>
$(document).ready(function(){
   $('.quick-view').click(function() {
        // Get the product ID from the button's data attribute
        var productId = $(this).data('products-id');

        // Send an AJAX request to get the product data
        $.ajax({
            url: "{{ route('web.product.data', ':id') }}".replace(':id', productId),
            type: 'GET',
            success: function(data) {
                let sizeList = '';
for (let i = 0; i < data.size.length; i++) {
    sizeList += data.size[i].size + ' ';
}
               let productimage = '<img class="primary blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + data.image + '" src="{{ asset('admin/product/') }}/' + data.image + '" alt="image" title="product">';
                // Update the modal with the product data
                $('#product-name').text(data.name);
                $('#product-image').html(productimage);
                $('#product-mrp').text('₹' + data.mrp);
                $('#product-discount').text('₹' + data.discount);
                $('#product-desc').text(data.description);
                $('#product-size-list').text(sizeList);
                // $('#product-size').text(data.colors[0].code);
                $('#color-image').html(colorimage);
                $('#content_quickview').modal('show');
            },
            error: function() {
                alert('Error fetching product data.');
            }
        });
    });
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