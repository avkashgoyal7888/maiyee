@extends('layouts.front.app')
@section('css')
<title>My-WishList</title>
<style>
   .block {
   pointer-events: none;
   opacity: 0.5;
   }
</style>
@stop
@section('content')
<!--Page Title-->
<div class="page section-header text-center">
   <div class="page-title">
      <div class="wrapper">
         <h1 class="page-width">Your cart</h1>
      </div>
   </div>
</div>
<!--End Page Title-->
<div class="container">
    <div id="loader" style="display:none;">
    @include('components.loader')
   </div>
   <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
         <div class=".table-responsive{-sm|-md|-lg|-xl}">
            <table id="cart-table">
               <thead class="cart__row cart__header">
                  <tr>
                     <th class="text-center">Product</th>
                     <th class="text-center">Price</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($wish as $carts)
                  <tr class="cart__row border-bottom line1 cart-flex border-top">
                     <td class="cart__image-wrapper cart-flex-item">
                        <a href="#"><img class="cart__image" src="{{asset('admin/product/'.$carts->product->image)}}" alt="Elastic Waist Dress - Navy / Small"></a>
                     </td>
                     <td class="cart__meta small--text-center cart-flex-item">
                        <div class="list-view-item__title">
                           <a href="#">{{$carts->product->name}} </a>
                        </div>
                     </td>
                     <td class="cart__price-wrapper">
                        <span class="money">₹{{$carts->product->mrp}}</span>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@stop