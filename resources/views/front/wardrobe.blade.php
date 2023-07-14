@extends('layouts.front.app')
@section('css')
<title>Wardrobe</title>
<style>
	.style-code {
   position: absolute;
   top: 10px;
   left: 10px;
   color: #ffffff;
   padding: 5px;
   font-weight: bold;
}

</style>
@stop
@section('content')
<!--Page Title-->
<div class="slideshow slideshow-wrapper pb-section">
   <div class="home-slideshow">
      <div class="slide">
         <div class="blur-up lazyload">
            <img class="blur-up lazyload" src="https://res.cloudinary.com/dzujz2mkt/image/upload/v1688378123/maiyee.png" />
         </div>
      </div>
   </div>
</div>
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Wardrobe</h1></div>
            </div>
        </div>
<!-- Parallax Section -->
<style>
.wardrobe-image{
   z-index: -1;
}
.wardrobe-image:hover{
   transition: transform .2s;
   transform: scale(1.8);
   cursor: pointer;
   border: 2px solid #a64dff;
   z-index: 1;

}

</style>
<div class="container">
   <div class="grid-products">
      <div class="row">
         @foreach($wardrobes as $wardrobes)
         <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <div class="product-image" style="text-align: center; position: relative;">
               <p class="style-code"></p>
               <img src="{{$wardrobes->image}}" class="h-50 wardrobe-image">
               <h4 class="mt-2">{{$wardrobes->style_code}}</h4>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>

<!--End Parallax Section-->
@stop
@section('js')
@stop