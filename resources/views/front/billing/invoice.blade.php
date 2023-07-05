<!DOCTYPE html>
<html lang="en">

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style type="text/css">
        .invoice-form
        {
         width: 100%;
         border: 1px solid #333333;
         border-radius: 10px;
         margin-bottom: 10px;
        }
        .responsive
        {
         padding: 25px;
        }
       .responsive select
       {
        width: 20%;
        margin: 20px;
        }       
        .responsive input
        {
         width: 20%;
         margin: 20px;
         border: 1px solid #969ea3;
         border-radius: 5px;
        }
        .responsive input[type=submit]
        {
         width: 100px;
         margin: 20px;
        }

        .responsive p{
         width: 20%;
         margin: 20px;
         color: #0a476e;
         font-size: 20px;
        }
    </style>

  </head>

  <body id="page-top">

    <div class="container d-flex justify-content-center">
        <div class="row">

            <div class="col-md-12">
                <div class="card" id="invoice" style="font-size:12px;">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title text-primary" style="text-align: center;">Tax Invoice</h6>
                    </div>
                    <div class="card-body">
                        <div class="bill" style="display: flex; justify-content: space-between;">
                            <div class="details1">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <img src="../../web-assets/img/logo.png" height="50" width="50">
                                        <li style="font-size: 14px; margin-top:5px;" ><b>Zara Trendz</b></li>
                                        <li><b>Place Of Supply : </b></li>
                                        <li><b>Gst No : </b> </li>
                                        <li><b>Address: </b>{{ $orderCoupon['address'] }} {{ $orderCoupon['landmark'] }} {{ $orderCoupon['state'] }} {{ $orderCoupon['city'] }} {{ $orderCoupon['pin_code'] }}</li>
                                        <li><b>Contact No : </b>{{ $orderCoupon['contact'] }}</li>
                                        <li><b>Email Id : </b> {{ $orderCoupon['email'] }} </li>
                                    </ul>
                            </div>
                                
                              <div class="details2">
                                        <h6 class="invoice-color mb-2 mt-md-2" style="font-size: 12px;"><b>Invoice No :</b>{{ $orderCoupon['invoice_num'] }} </h6>
                                        <h6 class="invoice-color mb-2 mt-md-2" style="font-size: 12px;"><b>Date :</b>{{ $orderCoupon['order_date'] }} </h6>
                                        <h6 class="invoice-color mb-2 mt-md-2" style="font-size: 12px;">Amount Paid :</b> {{ $orderCoupon['payable'] }}</h6>
                                        <ul class="list list-unstyled" style="margin-top: 20px;">
                                            <b><li>Invoice To</li></b>
                                            <li><b>Name :</b> {{ $orderCoupon['name'] }} </li>
                                        </ul>
                                </div>
                              </div>
                        
                    <div class="table-responsive">
                        <table class="table table-lg table-bordered">
                            <thead style="font-size:10px;">
                                <tr  style="text-align: center;">
                                    <th>Product Name</th>
                                    <th>HSN</th>
                                    <th>Qty</th>
                                    <th>Taxable Value</th>
                                    <th colspan="4">GST</th>
                                    <th>Total</th>
                                </tr>
                                <tr >
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Rate</th>
                                    <th>SGST</th>
                                    <th>CGST</th>
                                    <th>IGST</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="font-size:10px;">
                                @foreach($orderd as $item)
                        <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->product->hsn_code}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->taxable}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->sgst}}</td>
                        <td>{{$item->cgst}}</td>
                        <td>{{$item->igst}}</td>
                        <td>{{$item->total}}</td>
                        </tr>
                        @endforeach
                              
                             
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Total:</th>
                                                <td class="text-right">{{ $orderCoupon['taxable'] }}</td>
                                            </tr>
                                           <tr>
                                                <th class="text-right" >Tax:</th>
                                                <td class="text-right">
                                                <br><span>CGST : {{ $orderCoupon['cgst'] }}</span>
                                                <br><span>SGST : {{ $orderCoupon['sgst'] }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Subtotal:</th>
                                                <td class="text-right text-primary">
                                                    <h5 class="font-weight-semibold" style="font-size: 12px;">{{ $orderCoupon['total'] }}</h5>
                                                </td>
                                            </tr>
                                                                                      <tr>
                                                <th class="text-left">Discount</th>
                                                <td class="text-right">{{ $orderCoupon['discount'] }}</td>
                                            </tr>
                                            </tr>
                                                                                      <tr>
                                                <th class="text-left">Payable</th>
                                                <td class="text-right">{{ $orderCoupon['payable'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                  <p style="text-align: center;">No need for signature as it is computer generated invoice</p>


                        </div>
                    </div>
                    <div class="card-footer text-center"> <span class="text-muted" style="text-align: center;" >*If you have any query about this invoice, please contact us at <b>0120-4138181</b></span> </div>
                </div>
              </div>
            </div>
          </div>


      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    