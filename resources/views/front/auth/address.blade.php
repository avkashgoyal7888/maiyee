@extends('layouts.front.app')
@section('css')
<title>All Address</title>
@stop
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
   <div class="customer-box returning-customer">
      <h3><i class="icon anm anm-home"></i> Saved Addresses<a href="#customer-login" id="customer" class="text-white text-decoration-underline" data-toggle="collapse"> Click here to choose</a></h3>
      <div id="customer-login" class="collapse customer-content">
         <div class="customer-info">
            <p class="coupon-text">If you have shopped with us before, please select your saved address for billing &amp; Shipping process.</p>
            <form id="saved-address">
               <div class="row">
                  <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                     <label for="input-country">Saved Adresses<span class="required-f">*</span></label>
                     <select name="state_id" id="user-address">
                        <option value=""> --- Choose Address --- </option>
                        @foreach($user as $users)
                        <option value="{{$users->id}}" data-id="{{$users->id}}" data-name="{{$users->name}}" data-email="{{$users->email}}" data-contact="{{$users->contact}}" data-address="{{$users->address}}" data-landmark="{{$users->landmark}}" data-state="{{$users->state}}" data-city="{{$users->city}}" data-pin="{{$users->pin_code}}">{{$users->name}}.{{$users->address}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                     <label for="input-country">Address<span class="required-f">*</span></label>
                     <textarea disabled id="fullAddress" readonly>
                     </textarea>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="row billing-fields">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 sm-margin-30px-bottom">
      <div class="create-ac-content bg-light-gray padding-20px-all">
         <form id="Address">
            <fieldset>
               <h2 class="login-title mb-3">Billing details</h2>
               <div class="row">
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-firstname">First Name <span class="required-f">*</span></label>
                     <input name="name" type="text" class="input-field name">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-email">E-Mail </label>
                     <input name="email" type="email" class="input-field email">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-telephone">Telephone <span class="required-f">*</span></label>
                     <input name="contact" type="tel" class="input-field contact">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-address-1">Address <span class="required-f">*</span></label>
                     <input name="address" type="text" class="input-field address">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-address-1">Landmark</label>
                     <input name="landmark" type="text" class="input-field landmark">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-country">State<span class="required-f">*</span></label>
                     <input name="state" type="text" class="input-field state">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-country">City<span class="required-f">*</span></label>
                     <input name="city" type="text" class="city input-field">
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                     <label for="input-postcode">Post Code <span class="required-f">*</span></label>
                     <input name="pin" type="text" class="input-field pin">
                  </div>
               </div>
            </fieldset>
            <button class="btn btn-primary" type="submit" id="verify-otp-button">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('js')
<script>
   $(document).ready(function(){
   	$('#Address').on('submit', function(e) {
     e.preventDefault(); // prevent default form submission
   
     var selectedAddress = $('#user-address option:selected');
     var stateId = selectedAddress.val(); // Get the selected state_id
   
     var formData = new FormData();
     formData.append('state_id', stateId);
     formData.append('name', $('input[name="name"]').val());
     formData.append('email', $('input[name="email"]').val());
     formData.append('contact', $('input[name="contact"]').val());
     formData.append('address', $('input[name="address"]').val());
     formData.append('landmark', $('input[name="landmark"]').val());
     formData.append('state', $('input[name="state"]').val());
     formData.append('city', $('input[name="city"]').val());
     formData.append('pin', $('input[name="pin"]').val());
     formData.append('_token', "{{ csrf_token() }}");
   
     $.ajax({
        url: "{{ route('web.address.submit') }}",
        type: "POST",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function() {
           $('#addBtn').prop('disabled', true);
           $('#loader').show(); // show the loader
           $('#deleteClient').modal('toggle');
        },
        success: function(result) {
           if (result.status === false) {
              toastr.error(result.msg, 'Error', {
                 timeOut: 500,
                 progressBar: true,
                 closeButton: true
              });
           } else if (result.status === true) {
              toastr.success(result.msg, 'Success', {
                 timeOut: 500,
                 progressBar: true,
                 closeButton: true
              });
              window.location.reload();
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
           $('#loader').hide(); // hide the loader when done
        }
     });
   });
   
   	$('#user-address').on('change', function() {
                var  selectedAddress = $(this).find(':selected');
                 if(selectedAddress.val() !== '') {
                    // Fill in the input fields with the address details and make them readonly
                 	var addressId = selectedAddress.data('id');
                    $('.name').val(selectedAddress.data('name')).prop('readonly', false);
                    $('.email').val(selectedAddress.data('email')).prop('readonly', false);
                    $('.contact').val(selectedAddress.data('contact')).prop('readonly', false);
                    $('.address').val(selectedAddress.data('address')).prop('readonly', false);
                    $('.landmark').val(selectedAddress.data('landmark')).prop('readonly', false);
                    $('.state').val(selectedAddress.data('state')).prop('readonly', false);
                    $('.city').val(selectedAddress.data('city')).prop('readonly', false);
                    $('.pin').val(selectedAddress.data('pin')).prop('readonly', false);
                } else {
                    // Clear the input fields and make them editable
                    $('.name').val('').prop('readonly', false);
                    $('.email').val('').prop('readonly', false);
                    $('.contact').val('').prop('readonly', false);
                    $('.address').val('').prop('readonly', false);
                    $('.landmark').val('').prop('readonly', false);
                    $('.state').val('').prop('readonly', false);
                    $('.city').val('').prop('readonly', false);
                    $('.pin').val('').prop('readonly', false);
                }
            });
        $('#user-address').on('change', function() {
        var selected = $(this).val();
        var fullAddress = '';
        @foreach($user as $users)
          if ('{{$users->id}}' === selected) {
            fullAddress += '{{$users->name}} ';
            fullAddress += '{{$users->email}} ';
            fullAddress += '{{$users->contact}} ';
            fullAddress += '{{$users->address}} ';
            fullAddress += '{{$users->landmark}} ';
            fullAddress += '{{$users->state}} ';
            fullAddress += '{{$users->city}} ';
            fullAddress += '{{$users->pin_code}} ';
          }
        @endforeach
        $('#fullAddress').val(fullAddress);
        $('#fullAddress').prop('disabled', false);
      });
    });
</script>
@stop