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
               @foreach($size as $colors)
               @foreach($product->where('id', $colors->product_id) as $products)
               <div class="col-12 item">
                  <!-- start product image -->
                  <div class="product-image">
                     <!-- start product image -->
                     <a href="{{route('web.product.detail',$products->id)}}" class="grid-view-item__link">
                        <!-- image -->
                        <img class="primary blur-up lazyload" data-src="{{ asset('admin/color/' . $colors->color->image) }}" src="{{ asset('admin/color/' . $colors->color->image) }}" alt="image" title="product" />
                        <!-- End image -->
                        <!-- Hover image -->
                        <img class="hover blur-up lazyload" data-src="{{ asset('admin/color/' . $colors->color->image) }}" src="{{ asset('admin/color/' . $colors->color->image) }}" alt="image" title="product" />
                        <!-- End hover image -->
                        <!-- Variant Image-->
                        <img class="grid-view-item__image hover variantImg" src="{{ asset('admin/color/' . $colors->color->image) }}" alt="image" title="product">
                        <!-- Variant Image-->
                        <!-- product label -->
                        <div class="product-labels rounded"><span class="lbl on-sale">Sale</span></div>
                        <!-- End product label -->
                     </a>
                     <!-- end product image -->
                     <!-- Start product button -->
                     <form class="variants add" id="addToCart_{{$products->id}}_{{$colors->color->id}}">
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <input type="hidden" name="color_id" value="{{$colors->color->id}}">
                        <input type="hidden" name="size_id" value="{{$colors->id}}">
                        <input type="hidden" name="price" value="{{$products->discount}}">
                        <input type="hidden" name="gst" value="{{$products->gst_rate}}">
                        <input type="hidden" name="quantity" value="1">
                        @if(Auth::guard('web')->user() == '')
                        <button class="btn btn-addto-cart" data-toggle="modal" data-target="#myModal" tabindex="0">Add To Cart</button>
                        @else
                        <button class="btn btn-addto-cart" type="submit" tabindex="0">Add To Cart</button>
                        @endif
                     </form>
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
                     <div> {{$colors->size}} </div>
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
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image1.jpg')}}" alt="image" title="product">
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image1-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image1-1.jpg')}}" alt="image" title="product">
                     <!-- End hover image -->
                     <!-- Variant Image-->
                     <img class="grid-view-item__image hover variantImg" src="{{asset('front/assets/images/product-images/product-image1.jpg')}}" alt="image" title="product">
                     <!-- Variant Image-->
                     <!-- product label -->
                     <div class="product-labels rounded"><span class="lbl on-sale">Sale</span> <span class="lbl pr-label1">new</span></div>
                     <!-- End product label -->
                  </a>
                  <!-- end product image -->
                  <!-- countdown start -->
                  <div class="saleTime desktop" data-countdown="2022/03/01"></div>
                  <!-- countdown end -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
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
                     <a href="product-layout-1.html">Edna Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="old-price">$500.00</span>
                     <span class="price">$600.00</span>
                  </div>
                  <!-- End product price -->
                  <!-- Color Variant -->
                  <ul class="swatches">
                     <li class="swatch small rounded navy" rel="{{asset('front/assets/images/product-images/product-image-stw1.jpg')}}"></li>
                     <li class="swatch small rounded green" rel="{{asset('front/assets/images/product-images/product-image-stw1-1.jpg')}}"></li>
                     <li class="swatch small rounded gray" rel="{{asset('front/assets/images/product-images/product-image-stw1-2.jpg')}}"></li>
                     <li class="swatch small rounded aqua" rel="{{asset('front/assets/images/product-images/product-image-stw1-3.jpg')}}"></li>
                     <li class="swatch small rounded orange" rel="{{asset('front/assets/images/product-images/product-image-stw1-4.jpg')}}"></li>
                  </ul>
                  <!-- End Variant -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image2.jpg')}}" src="{{asset('front/assets/images/product-images/product-image2.jpg')}}" alt="image" title="product">
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image2-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image2-1.jpg')}}" alt="image" title="product">
                     <!-- End hover image -->
                     <!-- Variant Image-->
                     <img class="grid-view-item__image hover variantImg" src="{{asset('front/assets/images/product-images/product-image1.jpg')}}" alt="image" title="product">
                     <!-- Variant Image-->
                  </a>
                  <!-- end product image -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                  </form>
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
                     <a href="product-layout-1.html">Elastic Waist Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$748.00</span>
                  </div>
                  <!-- End product price -->
                  <!-- Color Variant -->
                  <ul class="swatches">
                     <li class="swatch small rounded black" rel="{{asset('front/assets/images/product-images/product-image2.jpg')}}"></li>
                     <li class="swatch small rounded navy" rel="{{asset('front/assets/images/product-images/product-image-swt2.jpg')}}"></li>
                     <li class="swatch small rounded purple" rel="{{asset('front/assets/images/product-images/product-image-swt2-1.jpg')}}"></li>
                     <li class="swatch small rounded teal" rel="{{asset('front/assets/images/product-images/product-image-swt2-2.jpg')}}"></li>
                  </ul>
                  <!-- End Variant -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image3.jpg')}}" src="assets/images/product-images/product-image3.jpg" alt="image" title="product">
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image3-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image3-1.jpg')}}" alt="image" title="product">
                     <!-- End hover image -->
                     <!-- Variant Image-->
                     <img class="grid-view-item__image hover variantImg" src="{{asset('front/assets/images/product-images/product-image3.jpg')}}" alt="image" title="product">
                     <!-- Variant Image-->
                     <!-- product label -->
                     <div class="product-labels rounded"><span class="lbl pr-label2">Hot</span></div>
                     <!-- End product label -->
                  </a>
                  <!-- end product image -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
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
                     <a href="product-layout-1.html">3/4 Sleeve Kimono Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$550.00</span>
                  </div>
                  <!-- End product price -->
                  <!-- Color Variant -->
                  <ul class="swatches">
                     <li class="swatch small rounded gray" rel="{{asset('front/assets/images/product-images/product-image16.jpg')}}"></li>
                     <li class="swatch small rounded red" rel="{{asset('front/assets/images/product-images/product-image5.jpg')}}"></li>
                     <li class="swatch small rounded orange" rel="{{asset('front/assets/images/product-images/product-image5-1.jpg')}}"></li>
                     <li class="swatch small rounded yellow" rel="{{asset('front/assets/images/product-images/product-image17.jpg')}}"></li>
                  </ul>
                  <!-- End Variant -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image4.jpg')}}" src="{{asset('front/assets/images/product-images/product-image4.jpg')}}" alt="image" title="product" />
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image4-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image4-1.jpg')}}" alt="image" title="product" />
                     <!-- End hover image -->
                     <!-- Variant Image-->
                     <img class="grid-view-item__image hover variantImg" src="{{asset('front/assets/images/product-images/product-image3.jpg')}}" alt="image" title="product">
                     <!-- Variant Image-->
                     <!-- product label -->
                     <div class="product-labels rounded"><span class="lbl on-sale">Sale</span></div>
                     <!-- End product label -->
                  </a>
                  <!-- end product image -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
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
                     <a href="product-layout-1.html">Cape Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="old-price">$900.00</span>
                     <span class="price">$788.00</span>
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
         </div>
         <div class="row">
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <!-- start product image -->
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image5.jpg')}}" src="{{asset('front/assets/images/product-images/product-image5.jpg')}}" alt="image" title="product" />
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image5-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image5-1.jpg')}}" alt="image" title="product" />
                     <!-- End hover image -->
                     <!-- Variant Image-->
                     <img class="grid-view-item__image hover variantImg" src="{{asset('front/assets/images/product-images/product-image5.jpg')}}" alt="image" title="product">
                     <!-- Variant Image-->
                  </a>
                  <!-- end product image -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                  </form>
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
                     <a href="product-layout-1.html">Paper Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$550.00</span>
                  </div>
                  <!-- End product price -->
                  <!-- Color Variant -->
                  <ul class="swatches">
                     <li class="swatch small rounded gray" rel="{{asset('front/assets/images/product-images/product-image16.jpg')}}"></li>
                     <li class="swatch small rounded red" rel="{{asset('front/assets/images/product-images/product-image5.jpg')}}"></li>
                     <li class="swatch small rounded orange" rel="{{asset('front/assets/images/product-images/product-image5-1.jpg')}}"></li>
                     <li class="swatch small rounded yellow" rel="{{asset('front/assets/images/product-images/product-image17.jpg')}}"></li>
                  </ul>
                  <!-- End Variant -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <div class="product-image">
                  <!--start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image19.jpg')}}" src="{{asset('front/assets/images/product-images/product-image19.jpg')}}" alt="image" title="product" />
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image19-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image19-1.jpg')}}" alt="image" title="product" />
                     <!-- End hover image -->
                  </a>
                  <!-- end product image -->
                  <!-- product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
                  <div class="button-set">
                     <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                     <i class="icon anm anm-search-plus-r"></i>
                     </a>
                     <!-- Start product button -->
                     <div class="wishlist-btn">
                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                        <i class="icon anm anm-heart-l"></i>
                        </a>
                     </div>
                     <div class="compare-btn">
                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                        <i class="icon anm anm-random-r"></i>
                        </a>
                     </div>
                  </div>
                  <!-- End product button -->
               </div>
               <!--End start product image -->
               <!--start product details -->
               <div class="product-details text-center">
                  <!-- product name -->
                  <div class="product-name">
                     <a href="product-layout-1.html">Romary Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$348.60</span>
                  </div>
                  <!-- End product price -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image18.jpg')}}" src="{{asset('front/assets/images/product-images/product-image18.jpg')}}" alt="image" title="product" />
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image18-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image18-1.jpg')}}" alt="image" title="product" />
                     <!-- End hover image -->
                  </a>
                  <!-- end product image -->
                  <!-- Start product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
                  <div class="button-set">
                     <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                     <i class="icon anm anm-search-plus-r"></i>
                     </a>
                     <div class="wishlist-btn">
                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                        <i class="icon anm anm-heart-l"></i>
                        </a>
                     </div>
                     <div class="compare-btn">
                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                        <i class="icon anm anm-random-r"></i>
                        </a>
                     </div>
                  </div>
                  <!-- End product button -->
               </div>
               <!--End start product image -->
               <!--start product details -->
               <div class="product-details text-center">
                  <!-- product name -->
                  <div class="product-name">
                     <a href="product-layout-1.html">Lima Shirt</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$698.00</span>
                  </div>
                  <!-- End product price -->
               </div>
               <!-- End product details -->
            </div>
            <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
               <div class="product-image">
                  <!-- start product image -->
                  <a href="product-layout-1.html" class="grid-view-item__link">
                     <!-- image -->
                     <img class="primary blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image2.jpg')}}" src="{{asset('front/assets/images/product-images/product-image2.jpg')}}" alt="image" title="product">
                     <!-- End image -->
                     <!-- Hover image -->
                     <img class="hover blur-up lazyload" data-src="{{asset('front/assets/images/product-images/product-image2-1.jpg')}}" src="{{asset('front/assets/images/product-images/product-image2-1.jpg')}}" alt="image" title="product">
                     <!-- End hover image -->
                  </a>
                  <!-- product button -->
                  <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                     <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                  </form>
                  <div class="button-set">
                     <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                     <i class="icon anm anm-search-plus-r"></i>
                     </a> 
                     <div class="wishlist-btn">
                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                        <i class="icon anm anm-heart-l"></i>
                        </a>
                     </div>
                     <div class="compare-btn">
                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                        <i class="icon anm anm-random-r"></i>
                        </a>
                     </div>
                  </div>
                  <!-- End product button -->
               </div>
               <!-- End start product image -->
               <!--start product details -->
               <div class="product-details text-center">
                  <!-- product name -->
                  <div class="product-name">
                     <a href="product-layout-1.html">Elastic Waist Dress</a>
                  </div>
                  <!-- End product name -->
                  <!-- product price -->
                  <div class="product-price">
                     <span class="price">$748.00</span>
                  </div>
                  <!-- End product price -->
               </div>
               <!-- End product details -->
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
               <a href="shop-left-sidebar.html" class="btn">View all</a>
            </div>
         </div>
      </div>
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