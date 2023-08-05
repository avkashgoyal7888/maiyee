@extends('layouts.link.app')
@section('css')
<title>Order-Success</title>
@stop
@section('content')
<div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Order Confirmation</h1></div>
            </div>
        </div>
        <!--End Page Title-->
       <div class="container mt-5 d-flex justify-content-center">
       <div class="order-card p-4 mt-3">
          <div class="first d-flex justify-content-between align-items-center mb-3">
            <div class="order-info">
                <span class="d-block order-name">Thank you!! </span>
                <span class="order-order">Order Id - </span>
                 
            </div>
           
             <img src="https://i.imgur.com/NiAVkEw.png" width="40"/>
              

          </div>
              <div class="order-detail">
          <span class="d-block order-summery">Your order has been placed. we will deliver your order as soon as possible.</span>
              </div>
          <hr>
          <div class="text">
         </div>
               <div class="last d-flex align-items-center mt-3">
                <span class="address-line">Enjoy Shopping With Us!!</span>

               </div>
        </div>
    </div>
@stop
@section('js')
@stop