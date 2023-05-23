@extends('layouts.front.app')
@section('css')
<title>Register</title>
<style>
    #verify-otp-button{
        display: none;
    }
</style>
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
               <div id="name-error" class="text-danger error-message my-2"></div>
               <input type="text" name="name">
            </div>
            <div class="inputBx">
               <span>Email</span>
               <div id="email-error" class="text-danger error-message my-2"></div>
               <input type="email" name="email">
            </div>
            <div class="inputBx">
               <span>Mobile Number</span>
               <div id="number-error" class="text-danger error-message my-2"></div>
               <input type="number" name="number">
            </div>
            <div class="inputBx">
               <span>Password</span>
               <div id="password-error" class="text-danger error-message my-2"></div>
               <input type="password" name="password">
            </div>
            <div class="inputBx">
               <span>Confirm Password</span>
               <div id="confpassword-error" class="text-danger error-message my-2"></div>
               <input type="password" name="confirm_password">
            </div>
            <div class="inputBx" id="otp-input-container" style="display: none;">
               <span>OTP</span>
               <div id="otp-error" class="text-danger error-message my-2"></div>
               <input type="text" id="otp-input" name="otp">
            </div>
            <div class="inputBx">
               <button class="btn btn-primary" type="button" id="generate-otp-button">Generate OTP</button>
               <button class="btn btn-primary" type="submit" id="verify-otp-button">Verify OTP</button>
            </div>
         </form>
         <h3>Login with social media</h3>
         <ul class="sci">
            <li><img src="{{asset('front/assets/images/google.png')}}"></li>
            <li><img src="{{asset('front/assets/images/facebook.png')}}"></li>
            <li><img src="{{asset('front/assets/images/Instagram.png')}}"></li>
         </ul>
      </div>
   </div>
</section>
@stop
@section('js')
<script>
   $(document).ready(function() {
   var otpGenerated = false;
   var generatedOTP = null;
   
   $("#generate-otp-button").click(function(e) {
       e.preventDefault();
   
       if (!otpGenerated) {
           generateOTP();
           otpGenerated = true;
       }
   
       $("#otp-input-container").show();
       $("#generate-otp-button").hide();
       $("#verify-otp-button").show();
   });
   
   $('#register_user').on('submit', function(e) {
       e.preventDefault();
   
       if (!otpGenerated) {
           return;
       }
   
       let fd = new FormData(this);
       fd.append('otp', generatedOTP);
   
       // Add OTP verification check
       var enteredOTP = $('#otp-input').val();
       if (enteredOTP !== generatedOTP.toString()) {
           $('#otp-error').text("Invalid OTP");
           return;
       }
   
       $.ajax({
           url: "{{ route('web.register.submit') }}",
           type: "POST",
           data: fd,
           processData: false,
           contentType: false,
           beforeSend: function(xhr) {
               xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
               $('#verify-otp-button').prop('disabled', false);
           },
           success: function(result) {
               if (result.status === 400) {
                   // Display error messages
                   $('#name-error').text(result.nameError);
                   $('#number-error').text(result.numberError);
                   $('#email-error').text(result.emailError);
                   $('#password-error').text(result.passwordError);
                   $('#confpassword-error').text(result.confpasswordError);
                   $('#otp-error').text(result.otpError);
               } else if (result.status === 200) {
                   toastr.success(result.message, 'Message', {
                       timeOut: 1000,
                       closeButton: true,
                       progressBar: true,
                       onclick: null,
                       showMethod: 'fadeIn',
                       hideMethod: 'fadeOut',
                       tapToDismiss: 0
                   });
                   otpGenerated = false; // Reset the OTP generation flagEnable the "Generate OTP" button
                   setTimeout(function(){
                       window.location.href="{{route('web.home')}}";
                   }, 1500);
               }
           },
           error: function(jqXHR, exception) {
               console.log(jqXHR.responseJSON);
           }
       });
   });
   
   function generateOTP() {
       // Generate OTP logic here
   
       // Mocking the OTP generation with a random number
       generatedOTP = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;
   
       // Store the generated OTP in the session
       $.ajax({
           url: "{{ route('store.generated.otp') }}",
           type: "POST",
           data: { otp: generatedOTP },
           beforeSend: function(xhr) {
               xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
           },
           success: function(result) {
               console.log("Generated OTP: " + generatedOTP);
               otpGenerated = true;

               // Send OTP message
               var message = "Dear " + $("#register_user input[name='name']").val() + " Your OTP for Signup is " + generatedOTP + " and password is '1234'";
               var numbers = $("#register_user input[name='number']").val();
               sendSMS(message, numbers);
           },
           error: function(jqXHR, exception) {
               console.log(jqXHR.responseJSON);
           }
       });
   }

   function sendSMS(message, numbers) {
   var fields = {
       "sender_id": "TXTIND", // Replace with your sender ID
       "message": message,
       "route": "v3",
       "numbers": numbers
   };

   // Retrieve CSRF token value from meta tag
   var csrfToken = $('meta[name="csrf-token"]').attr('content');

   $.ajax({
       url: "https://www.fast2sms.com/dev/bulkV2",
       type: "POST",
       crossDomain: false,
       data: JSON.stringify(fields),
       beforeSend: function(xhr) {
           xhr.setRequestHeader('authorization', '4OTtNOKY3Sh7bZb20tc4wfQmNUj7GQqkpHUl7khxmo9whfuGjHYb6aGEekLJ'); // Replace with your Fast2SMS authorization key
           xhr.setRequestHeader('accept', '/');
           xhr.setRequestHeader('cache-control', 'no-cache');
           xhr.setRequestHeader('content-type', 'application/json');
           // Add CSRF token to request headers
           xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
       },
       success: function(response) {
           console.log("SMS sent successfully");
           console.log(response);
       },
       error: function(jqXHR, exception) {
           console.log("Error sending SMS");
           console.log(jqXHR.responseJSON);
       }
   });
}

});

   
   
</script>
@stop