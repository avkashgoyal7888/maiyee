@extends('layouts.front.app')
@section('css')
<title>Shipping</title>
@stop
@section('content')
<div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Policies</h1></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    <div id="accordionExample">
                        <h2 class="title h2">Cancellation/Refund Policy</h2>
                        <p>Orders may be placed online on website, and delivered by courier from our head office. Details are given below:</p>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Address</h4>
                            <div id="collapseOne" class="collapse panel-content" data-parent="#accordionExample">Home Delivery or Other Shipping Address orders can be placed on website.</div>
                        </div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Payments</h4>
                            <div id="collapseTwo" class="collapse panel-content">Payment mode options for these orders can be :
                            <br>• Orders placed at Office: Demand Draft, Debit Card or Credit Card or other modes as may be interpolated from time to time.
                            <br>• Orders placed at Website: Credit Card, Debit Card, Pay-by-Demand Draft / Paytm or other modes as may be interpolated from time to time.</div>
                        <div class="faq-body">
                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Home Delivery Shedule</h4>
                            <div class="panel-content collapse" id="collapseThree"><b>Standard Locations- Serviceable by Courier-</b> Delivery orders will be delivered within
                            <br>• 7 working days after the payment has been received and credited.
                            <br>• Non Standard Locations – Serviceable by Speed Post/ Surface.
                            <br>• Village and Post Office: 12 working days after the payment has been received and credited.
                            <br><b>Home Delivery Orders Delivery Charges</b>
                            <br>Delivery fees depends on Order Value for Home Delivery Orders
                            <br>• Invoice Value Rs. 1000 and Above /: Nil
                            <br>• Invoice Value Less than Rs. 1000: Rs 100 inclusive of tax.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@stop
@section('js')
@stop