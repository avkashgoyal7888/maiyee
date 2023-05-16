@extends('layouts.front.app')
@section('css')
<title>Order-Cancel</title>
@stop
@section('content')
<div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Order Cancel</h1></div>
            </div>
        </div>
        <!--End Page Title-->
       <div class="container mt-5 d-flex justify-content-center">
       <div class="order-card p-4 mt-3">
          <div class="first d-flex justify-content-between align-items-center mb-3">
            <div class="order-info">
                <span class="d-block order-name">Thank you!! {{$order->name}}</span>
                <span class="order-order">Order Id - {{$order->order_id}}</span>
                 
            </div>
           
             <img src="https://i.imgur.com/NiAVkEw.png" width="40"/>
              

          </div>
              <div class="order-detail">
          <span class="d-block order-summery">Your order has been placed. we will deliver your order as soon as possible. Your order invoice has been sent to your email.</span>
              </div>
          <hr>
          <div class="text">
        <span class="d-block new mb-1" >{{$order->name}}</span>
         </div>
        <span class="d-block address mb-3">{{$order->address}} {{$order->landmark}} {{$order->state}} {{$order->city}} {{$order->pin_code}}</span>
          <div class="  money d-flex flex-row mt-2 align-items-center">
            <img src="https://i.imgur.com/ppwgjMU.png" width="20" />
          @if($order->payment_method == 'COD')
            <span class="ml-2">{{$order->payable}} to be paid (Cash on Delivery)</span> 
            @else
            <span class="ml-2">{{$order->payable}} paid</span> 
            @endif
               </div>
               <div class="last d-flex align-items-center mt-3">
                <span class="address-line">Enjoy Shopping With Us!!</span>

               </div>
        </div>
    </div>
@stop
@section('js')
@stop