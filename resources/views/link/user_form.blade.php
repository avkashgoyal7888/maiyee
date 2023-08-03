@extends('layouts.link.app')
@section('css')
<title>Register</title>
@stop
@section('content')
<div class="page section-header text-center">
   <div class="page-title">
      <div class="wrapper">
         <h1 class="page-width">Create an Account</h1>
      </div>
   </div>
</div>
<section class="register-page">
   <div class="imgBx">
      <img src="{{asset('front/assets/images/register.jpg')}}">   
   </div>
   <div class="contentBx">
      <div class="formBx">
         <h2>Signup</h2>
         <form id="register_user">
            <div class="inputBx">
               <span>Username</span>
               <div id="name" class="text-danger error-message my-2"></div>
               <input type="text" name="name">
               <input type="hidden" name="sessionid" value="{{$requestUniqueId}}">
            </div>
            <div class="inputBx">
               <span>Mobile Number</span>
               <div id="number" class="text-danger error-message my-2"></div>
               <input type="number" name="number">
            </div>
            <div class="inputBx">
               <span>Size</span>
               <div id="size" class="text-danger error-message my-2"></div>
               <select name="size">
                                    <option value="">Select A Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="2XL">2XL</option>
                                    <option value="3XL">3XL</option>
                                    <option value="4XL">4XL</option>
                                    <option value="5XL">5XL</option>
                                 </select>
            </div>
            <div class="inputBx">
               <span>Address</span>
               <div id="address" class="text-danger error-message my-2"></div>
               <input type="text" name="address">
            </div>
            <div class="inputBx">
               <button class="btn btn-primary" type="submit">Submit</button>
            </div>
         </form>
      </div>
   </div>
</section>
@stop
@section('js')
<script>
$(document).ready(function(){
    $('#register_user').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission
        let fd = new FormData(this);
        fd.append('_token', "{{ csrf_token() }}");
 
        $.ajax({
            url: "{{ route('link.user.submit') }}",
            type: "POST",
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#addBtn').prop('disabled', true)
                $('#loader').show();
            },
            success: function(result) {
                if (result.status === false) {
                    $('#name').text(result.nameError);
                    $('#number').text(result.numberError);
                    $('#size').text(result.sizeError);
                    $('#address').text(result.addressError);
                } else if (result.status === true) {
                    toastr.success(result.msg, 'Success', {
                        timeOut: 500,
                        progressBar: true,
                        closeButton: true
                    });
                    window.location.href="{{ route('link.order.placed') }}";
                }
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR.responseJSON);
                toastr.error(result.msg, 'Error', {
                    timeOut: 500,
                    progressBar: true,
                    closeButton: true
                });
            },
            complete: function() {
                $('#addBtn').prop('disabled', false);
                $('#loader').hide();
            }
        });
    });
});
</script>
@stop