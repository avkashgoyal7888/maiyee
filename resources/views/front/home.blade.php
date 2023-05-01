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
               <h2 class="h2">Weekly Bestseller</h2>
               <p>Our most popular products based on sales</p>
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
                        <!-- product label -->
                        <div class="product-labels rounded"><span class="lbl on-sale">Sale</span></div>
                        <!-- End product label -->
                     </a>
                     <div class="button-set">
                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                        <i class="icon anm anm-search-plus-r"></i>
                        </a>
                        <div class="wishlist-btn">
                           <a class="wishlist add-to-wishlist" href="wishlist.html">
                           <i class="icon anm anm-heart-l"></i>
                           </a>
                        </div>
                        <div class="compare-btn">
                           <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                           <i class="icon anm anm-random-r"></i>
                           </a>
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
                        <span class="old-price">${{$products->mrp}}</span>
                        <span class="price">${{$products->discount}}</span>
                     </div>
                     <!-- End product price -->
                     <!-- Color Variant -->
                     <ul class="swatches">
                        <li class="swatch small rounded black" rel="{{asset('front/assets/images/product-images/cape-dress-2.jpg')}}"></li>
                        <li class="swatch small rounded maroon" rel="{{asset('front/assets/images/product-images/product-image4-1.jpg')}}"></li>
                        <li class="swatch small rounded navy" rel="{{asset('front/assets/images/product-images/product-image2.jpg')}}"></li>
                        <li class="swatch small rounded darkgreen" rel="{{asset('front/assets/images/product-images/product-image2-1.jpg')}}"></li>
                     </ul>
                     <!-- End Variant -->
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
<!--Parallax Section-->
<div class="section">
   <div class="hero hero--large hero__overlay bg-size">
      <img class="bg-img" src="{{asset('front/assets/images/parallax-banners/parallax-banner.jpg')}}" alt="" />
      <div class="hero__inner">
         <div class="container">
            <div class="wrap-text left text-small font-bold">
               <h2 class="h2 mega-title">Belle <br> The best choice for your store</h2>
               <div class="rte-setting mega-subtitle">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
               <a href="#" class="btn">Purchase Now</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End Parallax Section-->
<!--New Arrivals-->
<div class="product-rows section">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="section-header text-center">
               <h2 class="h2">New Arrivals</h2>
               <p>Grab these new items before they are gone!</p>
            </div>
         </div>
      </div>
      <div class="grid-products">
         <div class="row">
            @foreach($sub as $subcat)
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="{{route('front.sub',$subcat->id)}}" class="grid-view-item__link">
                     <!-- image -->
                     <img class="rounded-circle" data-src="{{ asset('admin/tile/' . $subcat->tile) }}" src="{{ asset('admin/tile/' . $subcat->tile) }}" alt="image" title="product">
                     <!-- End image -->
                     <h2 class="mt-2">{{$subcat->sub_name}}</h2>
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
                           <div class="pl-20">
                              <img src="{{asset('front/assets/images/product-detail-page/camelia-reversible-big1.jpg')}}" alt="" />
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-single__meta">
                           <h2 class="product-single__title">Product Quick View Popup</h2>
                           <div class="prInfoRow">
                              <div class="product-stock"> <span class="instock ">In Stock</span> <span class="outstock hide">Unavailable</span> </div>
                              <div class="product-sku">SKU: <span class="variant-sku">19115-rdxs</span></div>
                           </div>
                           <p class="product-single__price product-single__price-product-template">
                              <span class="visually-hidden">Regular price</span>
                              <s id="ComparePrice-product-template"><span class="money">₹600.00</span></s>
                              <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                              <span id="ProductPrice-product-template"><span class="money">₹500.00</span></span>
                              </span>
                           </p>
                           <div class="product-single__description rte">
                              Belle Multipurpose Bootstrap 4 Html Template that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...
                           </div>
                           <form method="post" action="http://annimexweb.com/cart/add" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                              <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                 <div class="product-form__item">
                                    <label class="header">Color: <span class="slVariant">Red</span></label>
                                    <div data-value="Red" class="swatch-element color red available">
                                       <input class="swatchInput" id="swatch-0-red" type="radio" name="option-0" value="Red">
                                       <label class="swatchLbl color medium rectangle" for="swatch-0-red" style="background-image:url({{asset('front/assets/images/product-detail-page/variant1-1.jpg')}});" title="Red"></label>
                                    </div>
                                    <div data-value="Blue" class="swatch-element color blue available">
                                       <input class="swatchInput" id="swatch-0-blue" type="radio" name="option-0" value="Blue">
                                       <label class="swatchLbl color medium rectangle" for="swatch-0-blue" style="background-image:url({{asset('front/assets/images/product-detail-page/variant1-2.jpg')}});" title="Blue"></label>
                                    </div>
                                    <div data-value="Green" class="swatch-element color green available">
                                       <input class="swatchInput" id="swatch-0-green" type="radio" name="option-0" value="Green">
                                       <label class="swatchLbl color medium rectangle" for="swatch-0-green" style="background-image:url({{asset('front/assets/images/product-detail-page/variant1-3.jpg')}});" title="Green"></label>
                                    </div>
                                    <div data-value="Gray" class="swatch-element color gray available">
                                       <input class="swatchInput" id="swatch-0-gray" type="radio" name="option-0" value="Gray">
                                       <label class="swatchLbl color medium rectangle" for="swatch-0-gray" style="background-image:url({{asset('front/assets/images/product-detail-page/variant1-4.jpg')}});" title="Gray"></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                 <div class="product-form__item">
                                    <label class="header">Size: <span class="slVariant">XS</span></label>
                                    <div data-value="XS" class="swatch-element xs available">
                                       <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
                                       <label class="swatchLbl medium rectangle" for="swatch-1-xs" title="XS">XS</label>
                                    </div>
                                    <div data-value="S" class="swatch-element s available">
                                       <input class="swatchInput" id="swatch-1-s" type="radio" name="option-1" value="S">
                                       <label class="swatchLbl medium rectangle" for="swatch-1-s" title="S">S</label>
                                    </div>
                                    <div data-value="M" class="swatch-element m available">
                                       <input class="swatchInput" id="swatch-1-m" type="radio" name="option-1" value="M">
                                       <label class="swatchLbl medium rectangle" for="swatch-1-m" title="M">M</label>
                                    </div>
                                    <div data-value="L" class="swatch-element l available">
                                       <input class="swatchInput" id="swatch-1-l" type="radio" name="option-1" value="L">
                                       <label class="swatchLbl medium rectangle" for="swatch-1-l" title="L">L</label>
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
       $('.variants.add').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
           let fd = new FormData(this);
           fd.append('_token', "{{ csrf_token() }}");
   
           // get the specific form's ID
           let formID = $(this).attr('id');
   
           $.ajax({
               url: "{{ route('web.add.cart') }}",
               type: "POST",
               data: fd,
               dataType: 'json',
               processData: false,
               contentType: false,
               beforeSend: function() {
                   $('#' + formID + ' button[type=submit]').prop('disabled', true);
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
                       $('#' + formID)[0].reset(); // use [0] to select DOM element from jQuery object
                        $('#' + formID + ' button[type=submit]').prop('disabled', false);

                       // window.location.reload();
                   }
               },
               error: function(jqXHR, exception) {
                   console.log(jqXHR.responseJSON);
                   toastr.error(result.msg, 'Error', {
                       timeOut: 3000,
                       progressBar: true,
                       closeButton: true
                   });
               },
               complete: function() {
                   $('#' + formID + ' button[type=submit]').prop('disabled', false);
               }
           });
       });
   });
   
</script>
@stop