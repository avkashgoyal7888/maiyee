@extends('layouts.front.app')
@section('css')
<title>Exhibition</title>
@stop
@section('content')
<!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Exhibitions</h1></div>
            </div>
        </div>
<!--Parallax Section-->
	@foreach($ex as $exh)
<div class="section">
   <div class="hero hero--medium hero__overlay bg-size">
      <img class="bg-img" src="{{asset('admin/exhibition/'. $exh->image)}}" alt="" />
      <div class="hero__inner">
         <div class="container">
            <div class="wrap-text left text-small font-bold">
               <h2 class="h2 mega-title">{{$exh->title}}</h2>
               <div class="rte-setting mega-subtitle">on {{ date('d-M-y', strtotime($exh->ex_date)) }}</div>
            </div>
         </div>
      </div>
   </div>
</div>
   @endforeach
<!--End Parallax Section-->
@stop
@section('js')
@stop