@extends('layouts.front.app')
@section('css')
<title>Welcome To Maiyee</title>
@stop
@section('content')
<div class="slideshow slideshow-wrapper pb-section">
        <div class="home-slideshow">
            <div class="slide">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload" data-src="{{asset('front/assets/images/banner.jpg')}}" src="{{asset('front/assets/images/banner.jpg')}}" alt="Shop Our New Collection" title="Shop Our New Collection" />
                </div>
            </div>
            <div class="slide">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload" data-src="{{asset('front/assets/images/banner.jpg')}}" src="{{asset('front/assets/images/banner.jpg')}}" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                </div>
            </div>
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
                        <div class="col-12 item">
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
                                    <!--<div class="product-labels rounded"><span class="lbl on-sale">Sale</span></div>-->
                                    <div class="product-labels rounded"><span class="lbl on-hot">Trend</span></div>
                                    <!--<div class="product-labels rounded"><span class="lbl on-sold">soldout</span></div>-->
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
@stop
@section('js')
@stop