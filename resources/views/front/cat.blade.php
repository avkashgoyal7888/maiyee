@extends('layouts.front.app')
@section('css')
<title>Category</title>
<style>
    .swatch {
        display: inline-block;
        width: 30px;
        height: 14px;
        margin-right: 5px;

    }
</style>
@stop
@section('content')
<!--Body Content-->
<div id="page-content">
   <!--Collection Banner-->
   <div class="collection-header">
      <div class="collection-hero">
         <div class="collection-hero__image"><img class="blur-up lazyload" data-src="{{asset('admin/category/' . $catimg->image)}}" src="{{asset('admin/category/'.$catimg->image)}}" alt="Women" title="Women" /></div>
         <div class="collection-hero__title-wrapper">
            <h1 class="collection-hero__title page-width">Shop Grid 5 Column</h1>
         </div>
      </div>
   </div>
   <!--End Collection Banner-->
   <div class="container mt-4">
      <div class="row">
         <!--Sidebar-->
         <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
            <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
            <div class="sidebar_tags">
               <!--Categories-->
               <div class="sidebar_widget categories filter-widget">
                  <div class="widget-title">
                     <h2>Categories</h2>
                  </div>
                  <div class="widget-content">
                     <ul class="sidebar_categories">
                        @foreach($category as $categories)
                        <li class="level1 sub-level">
                           <a href="#;" class="site-nav">{{$categories->cat_name}}</a>
                           <ul class="sublinks">
                              @foreach($sub->where('cat_id', $categories->id) as $subs)
                              <li class="level2"><a href="{{route('front.cat',$subs->id)}}" class="site-nav">{{$subs->sub_name}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               <!--Categories-->
               <!--Price Filter-->
               <div class="sidebar_widget filterBox filter-widget">
                  <div class="widget-title">
                     <h2>Price</h2>
                  </div>
                  <form id="price_filter" class="price-filter">
                     <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                     </div>
                     <div class="row">
                        <div class="col-6">
                           <p class="no-margin"><input id="amount" type="text"></p>
                        </div>
                        <div class="col-6 text-right margin-25px-top">
                           <button class="btn btn-secondary btn--small">filter</button>
                        </div>
                     </div>
                  </form>
               </div>
               <!--End Price Filter-->
               <!--Size Swatches-->
               <div class="sidebar_widget filterBox filter-widget size-swacthes">
                  <div class="widget-title">
                     <h2>Size</h2>
                  </div>
                  <div class="filter-color swacth-list">
                     <form id="filter-form">
                        <div id="size">
                           @foreach($size as $sizes)
                           <label>
                           <input type="checkbox" class="size-checkbox" value="{{ $sizes->size }}"> {{ $sizes->size }}
                           </label>
                           @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                     </form>
                  </div>
               </div>
               <!--End Size Swatches-->
               <!--Color Swatches-->
               <div class="sidebar_widget filterBox filter-widget size-swacthes">
    <div class="widget-title">
        <h2>Color</h2>
    </div>
    <div class="filter-color swacth-list">
        <form id="color-form">
            <div id="size">
                @foreach($color as $colors)
                    <label>
                        <input type="checkbox" class="color-checkbox" value="{{ $colors->code }}">
                        <span class="swatch" style="background-color:{{ $colors->code }};"></span>
                    </label>
                    <br>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>


               <!--End Color Swatches-->
               <!--Brand-->
               <div class="sidebar_widget filterBox filter-widget">
                  <div class="widget-title">
                     <h2>Brands</h2>
                  </div>
                  <ul>
                     <li>
                        <input type="checkbox" value="allen-vela" id="check1">
                        <label for="check1"><span><span></span></span>Allen Vela</label>
                     </li>
                     <li>
                        <input type="checkbox" value="oxymat" id="check3">
                        <label for="check3"><span><span></span></span>Oxymat</label>
                     </li>
                     <li>
                        <input type="checkbox" value="vanelas" id="check4">
                        <label for="check4"><span><span></span></span>Vanelas</label>
                     </li>
                     <li>
                        <input type="checkbox" value="pagini" id="check5">
                        <label for="check5"><span><span></span></span>Pagini</label>
                     </li>
                     <li>
                        <input type="checkbox" value="monark" id="check6">
                        <label for="check6"><span><span></span></span>Monark</label>
                     </li>
                  </ul>
               </div>
               <!--End Brand-->
               <!--Popular Products-->
               <div class="sidebar_widget">
                  <div class="widget-title">
                     <h2>Popular Products</h2>
                  </div>
                  <div class="widget-content">
                     <div class="list list-sidebar-products">
                        <div class="grid">
                           <div class="grid__item">
                              <div class="mini-list-item">
                                 <div class="mini-view_image">
                                    <a class="grid-view-item__link" href="#">
                                    <img class="grid-view-item__image" src="{{asset('front/assets/images/product-images/mini-product-img.jpg')}}" alt="" />
                                    </a>
                                 </div>
                                 <div class="details">
                                    <a class="grid-view-item__title" href="#">Cena Skirt</a>
                                    <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">₹173.60</span></span></div>
                                 </div>
                              </div>
                           </div>
                           <div class="grid__item">
                              <div class="mini-list-item">
                                 <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('front/assets/images/product-images/mini-product-img1.jpg')}}" alt="" /></a> </div>
                                 <div class="details">
                                    <a class="grid-view-item__title" href="#">Block Button Up</a>
                                    <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">₹378.00</span></span></div>
                                 </div>
                              </div>
                           </div>
                           <div class="grid__item">
                              <div class="mini-list-item">
                                 <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('front/assets/images/product-images/mini-product-img2.jpg')}}" alt="" /></a> </div>
                                 <div class="details">
                                    <a class="grid-view-item__title" href="#">Balda Button Pant</a>
                                    <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">₹278.60</span></span></div>
                                 </div>
                              </div>
                           </div>
                           <div class="grid__item">
                              <div class="mini-list-item">
                                 <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('front/assets/images/product-images/mini-product-img3.jpg')}}" alt="" /></a> </div>
                                 <div class="details">
                                    <a class="grid-view-item__title" href="#">Border Dress in Black/Silver</a>
                                    <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">₹228.00</span></span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End Popular Products-->
               <!--Banner-->
               <div class="sidebar_widget static-banner">
                  <img src="{{asset('front/assets/images/side-banner-2.jpg')}}" alt="" />
               </div>
               <!--Banner-->
               <!--Information-->
               <div class="sidebar_widget">
                  <div class="widget-title">
                     <h2>Information</h2>
                  </div>
                  <div class="widget-content">
                     <p>Use this text to share information about your brand with your customers. Describe a product, share announcements, or welcome customers to your store.</p>
                  </div>
               </div>
               <!--end Information-->
               <!--Product Tags-->
               <div class="sidebar_widget">
                  <div class="widget-title">
                     <h2>Product Tags</h2>
                  </div>
                  <div class="widget-content">
                     <ul class="product-tags">
                        <li><a href="#" title="Show products matching tag $100 - $400">₹100 - ₹400</a></li>
                        <li><a href="#" title="Show products matching tag $400 - $600">₹400 - ₹600</a></li>
                        <li><a href="#" title="Show products matching tag $600 - $800">₹600 - ₹800</a></li>
                        <li><a href="#" title="Show products matching tag Above $800">Above $800</a></li>
                        <li><a href="#" title="Show products matching tag Allen Vela">Allen Vela</a></li>
                        <li><a href="#" title="Show products matching tag Black">Black</a></li>
                        <li><a href="#" title="Show products matching tag Blue">Blue</a></li>
                        <li><a href="#" title="Show products matching tag Cantitate">Cantitate</a></li>
                        <li><a href="#" title="Show products matching tag Famiza">Famiza</a></li>
                        <li><a href="#" title="Show products matching tag Gray">Gray</a></li>
                        <li><a href="#" title="Show products matching tag Green">Green</a></li>
                        <li><a href="#" title="Show products matching tag Hot">Hot</a></li>
                        <li><a href="#" title="Show products matching tag jean shop">jean shop</a></li>
                        <li><a href="#" title="Show products matching tag jesse kamm">jesse kamm</a></li>
                        <li><a href="#" title="Show products matching tag L">L</a></li>
                        <li><a href="#" title="Show products matching tag Lardini">Lardini</a></li>
                        <li><a href="#" title="Show products matching tag lareida">lareida</a></li>
                        <li><a href="#" title="Show products matching tag Lirisla">Lirisla</a></li>
                        <li><a href="#" title="Show products matching tag M">M</a></li>
                        <li><a href="#" title="Show products matching tag mini-dress">mini-dress</a></li>
                        <li><a href="#" title="Show products matching tag Monark">Monark</a></li>
                        <li><a href="#" title="Show products matching tag Navy">Navy</a></li>
                        <li><a href="#" title="Show products matching tag new">new</a></li>
                        <li><a href="#" title="Show products matching tag new arrivals">new arrivals</a></li>
                        <li><a href="#" title="Show products matching tag Orange">Orange</a></li>
                        <li><a href="#" title="Show products matching tag oxford">oxford</a></li>
                        <li><a href="#" title="Show products matching tag Oxymat">Oxymat</a></li>
                     </ul>
                     <span class="btn btn--small btnview">View all</span> 
                  </div>
               </div>
               <!--end Product Tags-->
            </div>
         </div>
         <!--End Sidebar-->
         <!--Main Content-->
         <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col shop-grid-5">
            <div class="productList">
               <!--Toolbar-->
               <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
               <div class="toolbar">
                  <div class="filters-toolbar-wrapper">
                     <div class="row">
                        <div class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                           <a href="shop-left-sidebar.html" title="Grid View" class="change-view change-view--active">
                           <img src="{{asset('front/assets/images/grid.jpg')}}" alt="Grid" />
                           </a>
                           <a href="shop-listview.html" title="List View" class="change-view">
                           <img src="{{asset('front/assets/images/list.jpg')}}" alt="List" />
                           </a>
                        </div>
                        <div class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                        </div>
                        <div class="col-4 col-md-4 col-lg-4 text-right">
                           <div class="filters-toolbar__item">
    <label for="SortBy" class="hidden">Sort</label>
    <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
        <option value="title-ascending" @if($sortBy === 'title-ascending') selected @endif>Sort</option>
        <option value="Best Selling" @if($sortBy === 'Best Selling') selected @endif>Best Selling</option>
        <option value="Alphabetically, A-Z" @if($sortBy === 'Alphabetically, A-Z') selected @endif>Alphabetically, A-Z</option>
        <option value="Alphabetically, Z-A" @if($sortBy === 'Alphabetically, Z-A') selected @endif>Alphabetically, Z-A</option>
        <option value="Price, low to high" @if($sortBy === 'Price, low to high') selected @endif>Price, low to high</option>
        <option value="Price, high to low" @if($sortBy === 'Price, high to low') selected @endif>Price, high to low</option>
        <option value="Date, new to old" @if($sortBy === 'Date, new to old') selected @endif>Date, new to old</option>
        <option value="Date, old to new" @if($sortBy === 'Date, old to new') selected @endif>Date, old to new</option>
    </select>
</div>


                        </div>
                     </div>
                  </div>
               </div>
               <!--End Toolbar-->
               <div class="grid-products grid--view-items" id="product_container">
                  <div class="row">
                     @foreach($product as $products)
                     <div class="col-6 col-sm-6 col-md-4 col-lg-2 item">
                        <!-- start product image -->
                        <div class="product-image">
                           <!-- start product image -->
                           <a href="{{route('web.product.detail',$products->id)}}">
                              <!-- image -->
                              <img class="primary blur-up lazyload" data-src="{{ asset('admin/product/' . $products->image) }}" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product">
                              <!-- End image -->
                              <!-- Hover image -->
                              <img class="hover blur-up lazyload" data-src="{{ asset('admin/product/' . $products->image) }}" src="{{ asset('admin/product/' . $products->image) }}" alt="image" title="product">
                              <!-- End hover image -->
                              <!-- product label -->
                              <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                              <!-- End product label -->
                           </a>
                           <!-- end product image -->
                           <!-- Start product button -->
                           <form class="variants add" action="#" method="post">
                              <button class="btn btn-addto-cart" type="button">Select Options</button>
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
                                 <a class="compare add-to-compare" href="#" title="Add to Compare">
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
                              <a href="#">{{$products->name}}</a>
                           </div>
                           <!-- End product name -->
                           <!-- product price -->
                           <div class="product-price">
                              <span class="old-price">₹{{$products->mrp}}</span>
                              <span class="price">₹{{$products->discount}}</span>
                           </div>
                           <!-- End product price -->
                           <div class="product-review">
                              <i class="font-13 fa fa-star"></i>
                              <i class="font-13 fa fa-star"></i>
                              <i class="font-13 fa fa-star"></i>
                              <i class="font-13 fa fa-star-o"></i>
                              <i class="font-13 fa fa-star-o"></i>
                           </div>
                        </div>
                        <!-- End product details -->
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
            <div class="infinitpaginOuter">
               <div class="infinitpagin">  
                  <a href="#" class="btn loadMore">Load More</a>
               </div>
            </div>
         </div>
         <!--End Main Content-->
         <!-- <div id="product_container"></div> -->
      </div>
   </div>
</div>
<!--End Body Content-->
@stop
@section('js')
<script>
   $(document).ready(function() {
  $('#SortBy').on('change', function() {
    var sortBy = $(this).val();
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var searchParams = new URLSearchParams(url.search);
    searchParams.set('SortBy', sortBy);
    url.search = searchParams.toString();
    var newUrl = url.toString().replace(/,+|%2C/g, '');
    window.location.href = newUrl;
  });




      $(".size-btn").click(function() {
       $("#color-form").submit();
     });
     // Handle the form submission
     $("#color-form").submit(function(e) {
       e.preventDefault();
       // Get the selected sizes
       var selectedSizes = [];
       $(".color-checkbox:checked").each(function() {
         selectedSizes.push($(this).val());
       });
       // Make the AJAX request to filter products
       $.ajax({
         url: "{{route('filter.by.color')}}",
         type: "GET",
         data: {
           selected_sizes: selectedSizes
         },
         success: function(result) {
       let html = '';
       result.forEach(function(products) {
             url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.proid));
           html += '<div class="grid-products grid--view-items" id="product_container">';
           html += '<div class="row">';
           html += '<div class="col-6 col-sm-6 col-md-4 col-lg-2 item" id="price">';
           html += '<div class="product-image">';
           html += '<a href="' + url + '">';
           html += '<img class="primary blur-up lazyload" data-src="{{ asset('admin/color/') }}/' + products.image + '" src="{{ asset('admin/color/') }}/' + products.image + '" alt="image" title="product">';
           html += '<img class="hover blur-up lazyload" data-src="{{ asset('admin/color/') }}/' + products.image + '" src="{{ asset('admin/color/') }}/' + products.image + '" alt="image" title="product">';
           html += '<div class="product-labels rectangular">';
           // html += '<span class="lbl on-sale">-' + products.discount_percentage + '%</span>';
           html += '<span class="lbl pr-label1">new</span>';
           html += '</div>';
           html += '</a>';
           html += '<form class="variants add" action="#" method="post">';
           html += '<button class="btn btn-addto-cart" type="button">Select Options</button>';
           html += '</form>';
           html += '<div class="button-set">';
           html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
           html += '<i class="icon anm anm-search-plus-r"></i>';
           html += '</a>';
           html += '<div class="wishlist-btn">';
           html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
           html += '<i class="icon anm anm-heart-l"></i>';
           html += '</a>';
           html += '</div>';
           html += '<div class="compare-btn">';
           html += '<a class="compare add-to-compare" href="#" title="Add to Compare">';
           html += '<i class="icon anm anm-random-r"></i>';
           html += '</a>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '<div class="product-details text-center">';
           html += '<div class="product-name">';
           html += '<a href="#">' + products.proname + '</a>';
           html += '</div>';
           html += '<div class="product-price">';
           html += '<span class="old-price">₹' + products.mrps + '</span>';
           html += '<span class="price">₹' + products.discounts + '</span>';
           html += '</div>';
           html += '<div class="product-review">';
           html += '<i class="font-13 fa fa-star"></i>';
           html +=        '<i class="font-13 fa fa-star"></i>';
           html += '<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
       });
       $('#product_container').html(html);
   },
         error: function(jqXHR, textStatus, errorThrown) {
           // Handle the error
           console.error("Error filtering products:", errorThrown);
         }
       });
     });

      // Size FIlter
         $(".size-btn").click(function() {
       $("#filter-form").submit();
     });
     // Handle the form submission
     $("#filter-form").submit(function(e) {
       e.preventDefault();
       // Get the selected sizes
       var selectedSizes = [];
       $(".size-checkbox:checked").each(function() {
         selectedSizes.push($(this).val());
       });
       // Make the AJAX request to filter products
       $.ajax({
         url: "{{route('filter.by.size')}}",
         type: "GET",
         data: {
           selected_sizes: selectedSizes
         },
         success: function(result) {
       let html = '';
       result.forEach(function(products) {
         url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.proid));
           html += '<div class="grid-products grid--view-items" id="product_container">';
           html += '<div class="row">';
           html += '<div class="col-6 col-sm-6 col-md-4 col-lg-2 item" id="price">';
           html += '<div class="product-image">';
           html += '<a href="' + url + '">';
           html += '<img class="primary blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.images + '" src="{{ asset('admin/product/') }}/' + products.images + '" alt="image" title="product">';
           html += '<img class="hover blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.images + '" src="{{ asset('admin/product/') }}/' + products.images + '" alt="image" title="product">';
           html += '<div class="product-labels rectangular">';
           // html += '<span class="lbl on-sale">-' + products.discount_percentage + '%</span>';
           html += '<span class="lbl pr-label1">new</span>';
           html += '</div>';
           html += '</a>';
           html += '<form class="variants add" action="#" method="post">';
           html += '<button class="btn btn-addto-cart" type="button">Select Options</button>';
           html += '</form>';
           html += '<div class="button-set">';
           html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
           html += '<i class="icon anm anm-search-plus-r"></i>';
           html += '</a>';
           html += '<div class="wishlist-btn">';
           html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
           html += '<i class="icon anm anm-heart-l"></i>';
           html += '</a>';
           html += '</div>';
           html += '<div class="compare-btn">';
           html += '<a class="compare add-to-compare" href="#" title="Add to Compare">';
           html += '<i class="icon anm anm-random-r"></i>';
           html += '</a>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '<div class="product-details text-center">';
           html += '<div class="product-name">';
           html += '<a href="#">' + products.proname + '</a>';
           html += '</div>';
           html += '<div class="product-price">';
           html += '<span class="old-price">₹' + products.mrps + '</span>';
           html += '<span class="price">₹' + products.discounts + '</span>';
           html += '</div>';
           html += '<span class="price">' + products.size + '</span>';
           html += '<div class="product-review">';
           html += '<i class="font-13 fa fa-star"></i>';
           html +=        '<i class="font-13 fa fa-star"></i>';
           html += '<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
       });
       $('#product_container').html(html);
   },
         error: function(jqXHR, textStatus, errorThrown) {
           // Handle the error
           console.error("Error filtering products:", errorThrown);
         }
       });
     });
   
       // price filter
       function price_slider(){
           $("#slider-range").slider({
               range: true,
               min: 1,
               max: 10000,
               values: [0, 10000],
               slide: function(event, ui) {
                   $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
               }
           });
           $("#amount").val("₹" + $("#slider-range").slider("values", 0) +
           " - ₹" + $("#slider-range").slider("values", 1));
       }
       price_slider();
       $('#price_filter').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
               let min_price = $("#slider-range").slider("values", 0);
               let max_price = $("#slider-range").slider("values", 1);
           $.ajax({
               url: "{{ route('filter.by.price') }}",
               type: "GET",
               data: {min_price: min_price, max_price: max_price, _token: "{{ csrf_token() }}"},
               dataType: 'json',
               beforeSend: function() {
                   $('#addBtn').prop('disabled', true);
               },
               success: function(result) {
       let html = '';
       result.forEach(function(products) {
         url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.id));
           html += '<div class="grid-products grid--view-items" id="product_container">';
           html += '<div class="row">';
           html += '<div class="col-6 col-sm-6 col-md-4 col-lg-2 item" id="price">';
           html += '<div class="product-image">';
           html += '<a href="' + url + '">';
           html += '<img class="primary blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.image + '" src="{{ asset('admin/product/') }}/' + products.image + '" alt="image" title="product">';
           html += '<img class="hover blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.image + '" src="{{ asset('admin/product/') }}/' + products.image + '" alt="image" title="product">';
           html += '<div class="product-labels rectangular">';
           html += '<span class="lbl on-sale">-' + products.discount_percentage + '%</span>';
           html += '<span class="lbl pr-label1">new</span>';
           html += '</div>';
           html += '</a>';
           html += '<form class="variants add" action="#" method="post">';
           html += '<button class="btn btn-addto-cart" type="button">Select Options</button>';
           html += '</form>';
           html += '<div class="button-set">';
           html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
           html += '<i class="icon anm anm-search-plus-r"></i>';
           html += '</a>';
           html += '<div class="wishlist-btn">';
           html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
           html += '<i class="icon anm anm-heart-l"></i>';
           html += '</a>';
           html += '</div>';
           html += '<div class="compare-btn">';
           html += '<a class="compare add-to-compare" href="#" title="Add to Compare">';
           html += '<i class="icon anm anm-random-r"></i>';
           html += '</a>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '<div class="product-details text-center">';
           html += '<div class="product-name">';
           html += '<a href="#">' + products.name + '</a>';
           html += '</div>';
           html += '<div class="product-price">';
           html += '<span class="old-price">₹' + products.mrp + '</span>';
           html += '<span class="price">₹' + products.discount + '</span>';
           html += '</div>';
           html += '<div class="product-review">';
           html += '<i class="font-13 fa fa-star"></i>';
           html +=        '<i class="font-13 fa fa-star"></i>';
           html += '<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html +='<i class="font-13 fa fa-star-o"></i>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
           html += '</div>';
       });
       $('#product_container').html(html);
   },
               error: function(jqXHR, exception) {
                   console.log(jqXHR.responseJSON);
               },
               complete: function() {
                   $('#addBtn').prop('disabled', false);
               }
           });
       });
   });
   
   
</script>
@stop