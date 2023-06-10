@extends('layouts.front.app')
@section('css')
<title>{{$product->name}}</title>
<style>
   .spr-form-review-rating {
   margin-bottom: 20px;
   }
   .spr-starrating {
   direction: rtl;
   unicode-bidi: bidi-override;
   text-align: left;
   font-size: 24px;
   }
   .spr-starrating label {
   display: inline-block;
   padding: 0 10px;
   margin-right: -15px;
   color: #ccc;
   cursor: pointer;
   }
   .spr-starrating input[type="radio"] {
   display: none;
   }
   .spr-starrating label:hover,
   .spr-starrating label:hover ~ label,
   .spr-starrating input[type="radio"]:checked ~ label {
   color: #ffd700;
   }
   .social-btn-sp #social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            .social-btn-sp #social-links ul li {
                display: inline-block;
            }          
            .social-btn-sp #social-links ul li a {
                padding: 15px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 30px;
            }
</style>
@stop
@section('content')
<div id="MainContent" class="main-content" role="main">
   <!--Breadcrumb-->
   <div class="bredcrumbWrap">
      <div class="container breadcrumbs">
         <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Product Details</span>
      </div>
   </div>
   <!--End Breadcrumb-->
   <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
      <!--product-single-->
      <div class="product-single">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
               <div class="product-details-img">
                  <div class="product-thumb">
                     <div id="gallery" class="product-dec-slider-2 product-tab-left">
                        @foreach($proimage as $img)
                        <a data-color-id="{{$img->color_id}}" data-image="{{ asset('admin/color/'.$img->image) }}" data-zoom-image="{{ asset('admin/color/'.$img->image) }}" class="product-image slick-slide slick-cloned color-image" aria-hidden="true" tabindex="-1">
                        <img class="blur-up lazyload" src="{{ asset('admin/color/'.$img->image) }}" alt="" />
                        </a>
                        @endforeach
                     </div>
                  </div>
                  <div class="zoompro-wrap product-zoom-right pl-20">
                     <div class="zoompro-span">
                        <img id="zoompro-image" class="blur-up lazyload zoompro" alt="" src="{{ asset('admin/color/'.$proimage->where('color_id', app('request')->input('color_id', $proimage[0]->color_id))->first()->image) }}" />
                     </div>
                  </div>
                  <div class="lightboximages">
                     <a href="{{asset('admin/color/'.$colorzoom->image)}}" data-size="1462x2048"></a>
                     @if(!is_null($proimage) && count($proimage) > 0)
                     @foreach($proimage as $img)
                     @if(!is_null($img) && property_exists($img, 'image'))
                     <a href="{{ asset('admin/color/'.$img->image) }}" data-size="1462x2048"></a>
                     @endif
                     @endforeach
                     @else
                     <p>No images available</p>
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
               <div class="product-single__meta">
                  <h1 class="product-single__title">{{$product->name}}</h1>
                  <div class="product-nav clearfix">                  
                     <a href="#" class="next" title="Next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>
                  <div class="prInfoRow">
                     <div class="product-sku">SKU: <span class="variant-sku">{{$product->style_code}}</span></div>
                     <div class="product-review">
                        @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($avg))
                        <i class="font-13 fa fa-star"></i>
                        @elseif($i == ceil($avg) && $avg - floor($avg) >= 0.5)
                        <i class="font-13 fa fa-star-half-o"></i>
                        @else
                        <i class="font-13 fa fa-star-o"></i>
                        @endif
                        @endfor
                        <span class="spr-badge-caption">{{$count}} reviews</span>
                     </div>
                  </div>
                  <p class="product-single__price product-single__price-product-template">
                     <span class="visually-hidden">Regular price</span>
                     <s id="ComparePrice-product-template"><span class="money">₹{{$product->mrp}}</span></s>
                     <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                     <span id="ProductPrice-product-template"><span class="money">₹{{$product->discount}}</span></span>
                     </span>
                     <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                     <span>You Save</span>
                     <span id="SaveAmount-product-template" class="product-single__save-amount">
                     <span class="money">₹{{$discount}}</span>
                     </span>
                     <span class="off">({{ number_format($discount * 100 / $product->mrp, 0) }}%)</span>
                     </span>  
                  </p>
                  <div class="orderMsg" data-user="23" data-time="24">
                     <img src="{{asset('front/assets/images/order-icon.jpg')}}" alt="" /> <strong class="items">5</strong> sold in last <strong class="time">26</strong> hours
                  </div>
               </div>
               <div class="product-single__description rte">
                  <ul>
                     <li>{{$product->description}}</li>
                  </ul>
               </div>
               <div id="quantity_message">Hurry! Only  <span class="items">4</span>  left in stock.</div>
               <form class="product-form product-form-product-template hidedropdown" id="addToCart">
                  <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                     <div class="product-form__item">
                        <label class="header">Color:</label>
                        @foreach($color as $colors)
                        <div data-value="{{$colors->code}}" class="swatch-element available" data-color="{{$colors->id}}">
                           <input class="swatchInput" id="{{$colors->id}}" type="radio" name="color_id" value="{{$colors->id}}" @if($colors->id == app('request')->input('color_id', $proimage[0]->color_id)) checked @endif>
                           <label class="swatchLbl color small" for="{{$colors->id}}" style="background-color:{{$colors->code}}" title="{{$colors->code}}"></label>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                     <div class="product-form__item">
                        <label class="header">Size: <span class="slVariant"></span></label>
                        @foreach($size as $sizes)
                        @if($sizes->color_id == app('request')->input('color_id', $proimage[0]->color_id))
                        <div data-value="{{$sizes->size}}" data-size="{{$sizes->id}}" data-color="{{$sizes->color_id}}" class="swatch-element xs available">
                           <input class="swatchInput" id="{{$sizes->id}}" type="radio" name="size_id" value="{{$sizes->id}}" @if($sizes->id == app('request')->input('size_id')) checked @endif {{$sizes->quantity === 0 ? 'disabled' : ''}}>
                           <label class="swatchLbl medium rectangle" for="{{$sizes->id}}" title="XS">{{$sizes->size}}</label>
                        </div>
                        @endif
                        @endforeach
                     </div>
                  </div>
                  <p class="infolinks"><a href="#sizechart" class="sizelink btn"> Size Guide</a></p>
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
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="price" value="{{$product->discount}}">
                        <input type="hidden" name="gst" value="{{$product->gst_rate}}">
                        @if(Auth::guard('web')->user() == '')
                        <button class="btn btn-addto-cart" data-toggle="modal" data-target="#myModal" tabindex="0">Add To Cart</button>
                        @else
                        <button class="btn btn-addto-cart" type="submit" tabindex="0">Add To Cart</button>
                        @endif
                     </div>
                     <div class="shopify-payment-button" data-shopify="payment-button">
                        @if(Auth::guard('web')->user() == '')
                        <button class="shopify-payment-button__button shopify-payment-button__button--unbranded" data-toggle="modal" data-target="#myModal">Buy it now</button>
                        @else
                        <button type="button" class="shopify-payment-button__button shopify-payment-button__button--unbranded" >Buy it now</button>
                        @endif
                     </div>
                  </div>
                  <!-- End Product Action -->
               </form>
               <div class="display-table shareRow">
                  <div class="display-table-cell medium-up--one-third">
                     <div class="wishlist-btn">
                        @auth
                                 <a href="#" data-product-id="{{$product->id}}" class="wishlist add-to-wishlist" style="font-size: 16px">
                                 <i class="icon anm anm-heart-l"></i><span>Add to Wishlist</span>
                                 <i class="icon anm anm-heart-l" style="color: #000;"></i><span>Already Added To Wishlist</span>
                                 </a>
                                 @else
                                 <a href="#" data-toggle="modal" data-target="#myModal" class="wishlist">
                                 <i class="icon anm anm-heart-l"></i><span>Add to Wishlist</span>
                                 </a>
                                 @endauth
                     </div>
                  </div>
                  <div class="display-table-cell text-right">
                     <div class="social-btn-sp">
                        {!! $shareButton !!}
                     </div>
                  </div>
               </div>
               <p id="freeShipMsg" class="freeShipMsg" data-price="199"><i class="fa fa-truck" aria-hidden="true"></i> GETTING CLOSER! ONLY <b class="freeShip"><span class="money">₹99.00</span>SHIPPING CHARGES!</b></p>
               <p class="shippingMsg"><i class="fa fa-clock-o" aria-hidden="true"></i> ESTIMATED DELIVERY BETWEEN <b id="fromDate">{{ $startFormatted }}</b> to <b id="toDate">{{ $endFormatted }}</b>.</p>
               <div class="userViewMsg" data-user="20" data-time="11000"><i class="fa fa-users" aria-hidden="true"></i> <strong class="uersView">14</strong> PEOPLE ARE LOOKING FOR THIS PRODUCT</div>
            </div>
         </div>
      </div>
      <!--End-product-single-->
      <!--Product Fearure-->
      <div class="prFeatures">
         <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 feature">
               <img src="{{asset('front/assets/images/credit-card.png')}}" alt="Safe Payment" title="Safe Payment" />
               <div class="details">
                  <h3>SAFE PAYMENTS</h3>
                  Pay with the world's most payment methods.
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 feature">
               <img src="{{asset('front/assets/images/shield.png')}}" alt="Confidence" title="Confidence" />
               <div class="details">
                  <h3>Security</h3>
                  Protection covers your purchase and personal data.
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 feature">
               <img src="{{asset('front/assets/images/worldwide.png')}}" alt="Worldwide Delivery" title="Worldwide Delivery" />
               <div class="details">
                  <h3>All Over India Delivery</h3>
                  Fast shipping to over 200+ cities &amp; regions.
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 feature">
               <img src="{{asset('front/assets/images/phone-call.png')}}" alt="Hotline" title="Hotline" />
               <div class="details">
                  <h3>Hotline</h3>
                  Talk to help line for your question on +91-9904145427
               </div>
            </div>
         </div>
      </div>
      <!--End Product Fearure-->
      <!--Product Tabs-->
      <div class="tabs-listing">
         <ul class="product-tabs">
            <li rel="tab1"><a class="tablink">Product Details</a></li>
            <li rel="tab2"><a class="tablink">Product Reviews</a></li>
         </ul>
         <div class="tab-container">
            <div id="tab1" class="tab-content">
               <div class="product-description rte">
                  <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <table class="table">
                           <tr>
                              <th>Ideal For :</th>
                              <td>{{ $productdetail->ideal }}</td>
                           </tr>
                           <tr>
                              <th>Length Type :</th>
                              <td>{{ $productdetail->length_type }}</td>
                           </tr>
                           <tr>
                              <th>Brand Color :</th>
                              <td>{{ $productdetail->brand_color }}</td>
                           </tr>
                           <tr>
                              <th>Ocassion :</th>
                              <td>{{ $productdetail->ocassion }}</td>
                           </tr>
                           <tr>
                              <th>Pattern :</th>
                              <td>{{ $productdetail->pattern }}</td>
                           </tr>
                           <tr>
                              <th>Type :</th>
                              <td>{{ $productdetail->type }}</td>
                           </tr>
                           <tr>
                              <th>Fabric :</th>
                              <td>{{ $productdetail->fabric }}</td>
                           </tr>
                           <tr>
                              <th>Neck :</th>
                              <td>{{ $productdetail->neck }}</td>
                           </tr>
                           <tr>
                              <th>Sleeve :</th>
                              <td>{{ $productdetail->sleeve }}</td>
                           </tr>
                           <tr>
                              <th>Number of Contents in Sales Package :</th>
                              <td>{{ $productdetail->sale_package }}</td>
                           </tr>
                           <tr>
                              <th>Fabric Care :</th>
                              <td>{{ $productdetail->fabric_care }}</td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div id="tab2" class="tab-content">
               <div id="shopify-product-reviews">
                  <div class="spr-container">
                     <div class="spr-header clearfix">
                        <div class="spr-summary">
                           <span class="product-review">@for($i = 1; $i <= 5; $i++)
                           @if($i <= floor($avg))
                           <i class="font-13 fa fa-star"></i>
                           @elseif($i == ceil($avg) && $avg - floor($avg) >= 0.5)
                           <i class="font-13 fa fa-star-half-o"></i>
                           @else
                           <i class="font-13 fa fa-star-o"></i>
                           @endif
                           @endfor<span class="spr-summary-actions-togglereviews">Based on {{$count}} reviews</span></span>
                           <span class="spr-summary-actions">
                           <a href="#" class="spr-summary-actions-newreview btn">Write a review</a>
                           </span>
                        </div>
                     </div>
                     <div class="spr-content">
                        <div class="spr-form clearfix">
                           <form id="review-form" class="new-review-form">
                              <h3 class="spr-form-title">Write a review</h3>
                              <fieldset class="spr-form-contact">
                                 @if(Auth::guard('web')->user() == '')
                                 <div class="spr-form-contact-name">
                                    <label class="spr-form-label" for="review_author_10508262282">Name</label>
                                    <input class="spr-form-input spr-form-input-text" type="text" name="name" placeholder="Enter your name">
                                 </div>
                                 <div class="spr-form-contact-email">
                                    <label class="spr-form-label" for="review_email_10508262282">Email</label>
                                    <input class="spr-form-input spr-form-input-email" type="email" name="email" placeholder="john.smith@example.com">
                                 </div>
                                 @elseif(Auth::guard('web')->user() != '')
                                 <div class="spr-form-contact-name">
                                    <label class="spr-form-label" for="review_author_10508262282">Name</label>
                                    <input class="spr-form-input spr-form-input-text" type="text" name="name" value="{{Auth::guard('web')->user()->name}}" readonly>
                                 </div>
                                 <div class="spr-form-contact-email">
                                    <label class="spr-form-label" for="review_email_10508262282">Email</label>
                                    <input class="spr-form-input spr-form-input-email" type="text" name="email" value="{{Auth::guard('web')->user()->email}}" readonly>
                                 </div>
                                 @endif
                              </fieldset>
                              <fieldset class="spr-form-review">
                                 <div class="spr-form-review-rating">
                                    <label class="spr-form-label">Rating</label>
                                    <div class="spr-form-input spr-starrating">
                                       <input type="radio" id="star1" name="rating" value="5" /><label for="star1" title="1 star"><i class="fa fa-star"></i></label>
                                       <input type="radio" id="star2" name="rating" value="4" /><label for="star2" title="2 stars"><i class="fa fa-star"></i></label>
                                       <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="fa fa-star"></i></label>
                                       <input type="radio" id="star4" name="rating" value="2" /><label for="star4" title="4 stars"><i class="fa fa-star"></i></label>
                                       <input type="radio" id="star5" name="rating" value="1" /><label for="star5" title="5 stars"><i class="fa fa-star"></i></label>
                                    </div>
                                 </div>
                                 <div class="spr-form-review-title">
                                    <label class="spr-form-label" for="review_title_10508262282">Review Title</label>
                                    <input class="spr-form-input spr-form-input-text " type="text" name="title" placeholder="Give your review a title">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                 </div>
                                 <div class="spr-form-review-title">
                                    <label class="spr-form-label" for="review_title_10508262282">Image</label>
                                    <input class="spr-form-input spr-form-input-text " type="file" name="image[]" multiple>
                                 </div>
                                 <div class="spr-form-review-body">
                                    <label class="spr-form-label" for="review_body_10508262282">Body of Review</label>
                                    <div class="spr-form-input">
                                       <textarea class="spr-form-input spr-form-input-textarea " name="review" rows="4"placeholder="Write your comments here"></textarea>
                                    </div>
                                 </div>
                              </fieldset>
                              <fieldset class="spr-form-actions">
                                 <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Submit Review">
                              </fieldset>
                           </form>
                        </div>
                        <div class="spr-reviews">
                           @foreach($review as $reviews)
                           <div class="spr-review">
                              <div class="spr-review-header">
                                 @foreach($rim->where('review_id', $reviews->id) as $rims)
                                 <img src="{{ asset('admin/review/' . $rims->image) }}" width="300" height="100" />
                                 @endforeach
                                 <br>
                                 <span class="product-review spr-starratings spr-review-header-starratings">
                                 <span class="reviewLink">
                                 @for($i = 1; $i <= $reviews->rating; $i++)
                                 <i class="fa fa-star"></i>
                                 @endfor
                                 </span>
                                 </span>
                                 <h3 class="spr-review-header-title">{{$reviews->title}}</h3>
                                 <span class="spr-review-header-byline"><strong>{{$reviews->name}}</strong> on <strong>{{ $reviews->created_at->format('M d, Y') }}</strong></span>
                              </div>
                              <div class="spr-review-content">
                                 <p class="spr-review-content-body">{{$reviews->review}}</p>
                              </div>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
                     </div>
      </div>
      <!--End Product Tabs-->
      </div>
   <!--#ProductSection-product-template-->
</div>
<!--MainContent-->
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
      function qnt_incre(){
      $(".qtyBtn").on("click", function() {
        var qtyField = $(this).parent(".qtyField"),
          oldValue = $(qtyField).find(".qty").val(),
           newVal = 1;
   
        if ($(this).is(".plus")) {
         newVal = parseInt(oldValue) + 1;
        } else if (oldValue > 1) {
         newVal = parseInt(oldValue) - 1;
        }
        $(qtyField).find(".qty").val(newVal);
      });
   }
   qnt_incre();
       var selectedColorId = '{{ app('request')->input('color_id', $proimage[0]->color_id) }}';
   
   $('input[name="color_id"][value="' + selectedColorId + '"]').prop('checked', true);
   
   function filterImagesByColorId(colorId) {
    $('.product-image').hide();
    $('.product-image[data-color-id="' + colorId + '"]').show();
   }
   
   filterImagesByColorId(selectedColorId);
   
   // Update main image based on the selected color ID
   var selectedImage = $('.product-image[data-color-id="' + selectedColorId + '"]').first();
   var imageSrc = selectedImage.data('image');
   var zoomImageSrc = selectedImage.data('zoom-image');
   $('#zoompro-image').attr('src', imageSrc).data('zoom-image', zoomImageSrc);
   
   $('input[name="color_id"]').on('change', function() {
    var selectedColorId = $(this).val();
    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set('color_id', selectedColorId);
    var newUrl = window.location.pathname + '?' + searchParams.toString();
    window.location.href = newUrl;
   });
   
   // Show all colors
   $('.swatch-element').show();
   
   // Show sizes based on color selection
   var selectedSizeId = '{{ app('request')->input('size_id') }}';
   
   function filterSizesByColorId(colorId) {
    $('.swatch-element[data-color]').show(); // Show all sizes
    $('.swatch-element[data-color]').not('[data-color="' + colorId + '"]').show(); // Hide sizes for other colors
   
    // Select the first size for the selected color
    var firstSize = $('.swatch-element[data-color="' + colorId + '"]').first();
    var firstSizeId = firstSize.data('size');
    $('input[name="size_id"][value="' + firstSizeId + '"]').prop('checked', true);
   }
   
   filterSizesByColorId(selectedColorId);
   
   $('input[name="color_id"]').on('change', function() {
    var selectedColorId = $(this).val();
    filterSizesByColorId(selectedColorId);
   });
   
   // Handle size selection change
   $('input[name="size_id"]').on('change', function() {
    var selectedSizeId = $(this).val();
   });
   
   
      // addtocart
      $('#addToCart').submit(function(e) {
    e.preventDefault();
    var fd = new FormData(this);
    fd.append('_token', "{{ csrf_token() }}");

    addToCart(fd);
});

$('.shopify-payment-button__button').click(function(e) {
    e.preventDefault();
    var fd = new FormData($('#addToCart')[0]);
    fd.append('_token', "{{ csrf_token() }}");

    buyNow(fd);
});

function addToCart(data) {
    $.ajax({
        url: "{{ route('web.add.cart') }}",
        type: "post",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(result) {
            if (result.status === true) {
                toastr.success(result.msg, "Message", {
                    timeOut: 500,
                    closeButton: true,
                    progressBar: true,
                    onclick: null,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: 0
                });
                window.location.reload();
            } else {
                toastr.error(result.msg, "Message", {
                    timeOut: 500,
                    closeButton: true,
                    progressBar: true,
                    onclick: null,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: 0
                });
            }
        }
    });
}

function buyNow(data) {
    $.ajax({
        url: "{{ route('web.buy.now') }}",
        type: "post",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(result) {
            if (result.status === true) {
                toastr.success(result.msg, "Message", {
                    timeOut: 500,
                    closeButton: true,
                    progressBar: true,
                    onclick: null,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: 0
                });
                setTimeout(function(){
     window.location.href="{{route('web.check.buy')}}";
     }, 500);
            } else {
                toastr.error(result.msg, "Message", {
                    timeOut: 500,
                    closeButton: true,
                    progressBar: true,
                    onclick: null,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: 0
                });
            }
        }
    });
}

      // Review Form
      $('#review-form').submit(function(e){
   
            e.preventDefault();
            var fd = new FormData(this);
            fd.append('_token',"{{ csrf_token() }}");
   
            $.ajax({
                url: "{{ route('web.review.submit') }}",
                type: "post",
                data: fd,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function (result) {
   
                    if(result.status===true){
                        toastr.success(result.msg, "Message", {
                            timeOut: 500,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: 0
                        });
                        window.location.reload();
                    }
                    else{
                        toastr.error(result.msg, "Message", {
                            timeOut: 500,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: 0
                        })
                    }
                }
            });
        });
   
        // Add End
   });
</script>
@stop