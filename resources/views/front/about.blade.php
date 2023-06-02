@extends('layouts.front.app')
@section('css')
<title>Disclaimer</title>
@stop
@section('content')
<!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">About Us</h1></div>
            </div>
        </div>
        <!--End Page Title-->
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                    <h2 class="h2">Our story</h2>
                        <div class="rte-setting">
                            <p>“Maiyee,” (brand of The Zara Trendz) a name which itself describes “My”,“a girl”,“a mother” and what not. A brand which is designed only and only for women with utmost love. A woman is all about being passionate, professional, visionary, achiever, home maker and thinker while adorning multiple more hats. We are pleased to introduce our company (Maiyee.in), as a leading manufacturer of ready-to-wear garments for women who have an independent mindset. Looking forward to their comfortability this brand deals only in superior quality of cotton/silk fabrics that too with competitive prices which have made us one of the most reliable names across India. </p>
                        </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <h2 class="h2"><strong>Business</strong></h2>
                        <div class="rte-setting">
                            <p>‘Maiyee’ located in Gujarat, deals in a process of converting raw materials in finished garment. To brief it from yarn to raw fabrics, then dying, printing, designing, cutting, stitching, finishing, and packaging. </p>
                        </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <h2 class="h2"><strong>Certificate</strong></h2>
                        <div class="rte-setting">
                            <p>We are GRS certified company (Recycled fabrics)</p>
                        </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <h2 class="h2"><strong>Vision</strong></h2>
                        <div class="rte-setting">
                            <p>We are a technology-driven company that strives to constantly improve its production processes, while closely preserving our commitment towards the highest quality and guaranteed customer satisfaction. Considering women’s comfortability, we need to reach every wardrobe at reasonable price.</p>
                        </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                    <video id='myVideo' width="500" height="500" autoplay controls muted>
                        <source src="{{asset('front/assets/video/about.MP4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                      </video>
                </div>
            </div>
                       
            
        </div>
@stop
@section('js')
@stop