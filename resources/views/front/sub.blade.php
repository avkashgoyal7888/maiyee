@extends('layouts.front.app')
@section('css')
<title>Sub-Category</title>
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
         <div class="collection-hero__image"><img class="blur-up lazyload" data-src="{{asset('admin/subcategory/' . $subimg->image)}}" src="{{asset('admin/subcategory/'.$subimg->image)}}" alt="Women" title="Women" /></div>
         <div class="collection-hero__title-wrapper">
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
                              <li class="level2"><a href="{{route('front.sub',$subs->id)}}" class="site-nav">{{$subs->sub_name}}</a></li>
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
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="black">
                           <span class="swatch mr-3">Black</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="white">
                           <span class="swatch mr-3">White</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="blue">
                           <span class="swatch mr-3">Blue</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="pink">
                           <span class="swatch mr-3">Pink</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="purple">
                           <span class="swatch mr-3">Purple</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="beige">
                           <span class="swatch mr-3">Beige</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="brown">
                           <span class="swatch mr-3">Brown</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="gold">
                           <span class="swatch mr-3">Gold</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="green">
                           <span class="swatch mr-3">Green</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="grey">
                           <span class="swatch mr-3">Grey</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="khaki">
                           <span class="swatch mr-3">Khaki</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="maroon">
                           <span class="swatch mr-3">Maroon</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="red">
                           <span class="swatch mr-3">Red</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="orange">
                           <span class="swatch mr-3">Orange</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="silver">
                           <span class="swatch mr-3">Silver</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="yellow">
                           <span class="swatch mr-3">Yellow</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="teal">
                           <span class="swatch mr-3">Teal</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="wine">
                           <span class="swatch mr-3">Wine</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="turquoise">
                           <span class="swatch mr-3">Turquoise</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="off_white">
                           <span class="swatch mr-3">Off White</span>
                           </label>
                           <label>
                           <input type="checkbox" class="color-checkbox mx-1" value="multi_color">
                           <span class="swatch mr-3">Multi Color</span>
                           </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                     </form>
                  </div>
               </div>
               <!--End Color Swatches-->
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
                              <!--<div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>-->
                              <!-- End product label -->
                           </a>
                           <!-- end product image -->
                           <!-- Start product button -->
                           <div class="button-set">
                              <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
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
                              @for($i = 1; $i <= 5; $i++)
                              @if($i <= floor($avg))
                              <i class="font-13 fa fa-star"></i>
                              @elseif($i == ceil($avg) && $avg - floor($avg) >= 0.5)
                              <i class="font-13 fa fa-star-half-o"></i>
                              @else
                              <i class="font-13 fa fa-star-o"></i>
                              @endif
                              @endfor
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
    let html = '<div class="grid-products grid--view-items" id="product_container">';
    html += '<div class="row">';
    result.forEach(function(products) {
        url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.proid));
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
        html += '<div class="button-set">';
        html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
        html += '<i class="icon anm anm-search-plus-r"></i>';
        html += '</a>';
        html += '<div class="wishlist-btn">';
        html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
        html += '<i class="icon anm anm-heart-l"></i>';
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
   for (var i = 1; i <= 5; i++) {
    if (i <= Math.floor('{{$avg}}')) {
        html += '<i class="font-13 fa fa-star"></i>';
    } else if (i === Math.ceil('{{$avg}}') && '{{$avg}}' - Math.floor('{{$avg}}') >= 0.5) {
        html += '<i class="font-13 fa fa-star-half-o"></i>';
    } else {
        html += '<i class="font-13 fa fa-star-o"></i>';
    }
   }
   html += '</div>';
   
        html += '</div>';
        html += '</div>';
    });
    html += '</div>';
    html += '</div>';
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
    let html = '<div class="grid-products grid--view-items" id="product_container">';
    html += '<div class="row">';
    result.forEach(function(products) {
        url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.proid));
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
        html += '<div class="button-set">';
        html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
        html += '<i class="icon anm anm-search-plus-r"></i>';
        html += '</a>';
        html += '<div class="wishlist-btn">';
        html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
        html += '<i class="icon anm anm-heart-l"></i>';
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
   for (var i = 1; i <= 5; i++) {
    if (i <= Math.floor('{{$avg}}')) {
        html += '<i class="font-13 fa fa-star"></i>';
    } else if (i === Math.ceil('{{$avg}}') && '{{$avg}}' - Math.floor('{{$avg}}') >= 0.5) {
        html += '<i class="font-13 fa fa-star-half-o"></i>';
    } else {
        html += '<i class="font-13 fa fa-star-o"></i>';
    }
   }
   html += '</div>';
   
        html += '</div>';
        html += '</div>';
    });
    html += '</div>';
    html += '</div>';
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
                   $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
               }
           });
           $("#amount").val("$" + $("#slider-range").slider("values", 0) +
           " - $" + $("#slider-range").slider("values", 1));
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
    let html = '<div class="grid-products grid--view-items" id="product_container">';
    html += '<div class="row">';
    result.forEach(function(products) {
        url = '{{ route("web.product.detail", ["id" => ":id"]) }}'.replace(':id', encodeURIComponent(products.id));
        html += '<div class="col-6 col-sm-6 col-md-4 col-lg-2 item" id="price">';
        html += '<div class="product-image">';
        html += '<a href="' + url + '">';
        html += '<img class="primary blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.image + '" src="{{ asset('admin/product/') }}/' + products.image + '" alt="image" title="product">';
        html += '<img class="hover blur-up lazyload" data-src="{{ asset('admin/product/') }}/' + products.image + '" src="{{ asset('admin/product/') }}/' + products.image + '" alt="image" title="product">';
        html += '<div class="product-labels rectangular">';
        // html += '<span class="lbl on-sale">-' + products.discount_percentage + '%</span>';
        html += '<span class="lbl pr-label1">new</span>';
        html += '</div>';
        html += '</a>';
        html += '<div class="button-set">';
        html += '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
        html += '<i class="icon anm anm-search-plus-r"></i>';
        html += '</a>';
        html += '<div class="wishlist-btn">';
        html += '<a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">';
        html += '<i class="icon anm anm-heart-l"></i>';
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
   for (var i = 1; i <= 5; i++) {
    if (i <= Math.floor('{{$avg}}')) {
        html += '<i class="font-13 fa fa-star"></i>';
    } else if (i === Math.ceil('{{$avg}}') && '{{$avg}}' - Math.floor('{{$avg}}') >= 0.5) {
        html += '<i class="font-13 fa fa-star-half-o"></i>';
    } else {
        html += '<i class="font-13 fa fa-star-o"></i>';
    }
   }
   html += '</div>';
   
        html += '</div>';
        html += '</div>';
    });
    html += '</div>';
    html += '</div>';
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