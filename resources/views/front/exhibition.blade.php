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
   <div class="section imgBanners">
      @foreach($ex as $exh)
      <div class="container-fluid">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
              <a href="#">
                  <img src="{{asset('admin/exhibition/'. $exh->image)}}" class="blur-up lazyload" />
               </a>
           </div>
       </div>
       @endforeach
   </div>
<!--End Parallax Section-->
@stop
@section('js')
@stop