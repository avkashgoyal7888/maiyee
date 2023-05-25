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
            <div id="hide1">
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

   function checkPhoneNumber(number, email) {
      $.ajax({
         url: "{{ route('check-phone-number') }}",
         type: "POST",
         data: {
            number: number,
            email: email
         },
         beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
         },
         success: function(response) {
            // Phone number and email are valid and not registered
            generateOTP();

            // Show OTP input and "Verify OTP" button
            $("#otp-input-container").show();
            $("#verify-otp-button").show();
            $('#generate-otp-button').hide();

            // Disable the phone number and email inputs
            $("#hide1").hide();
         },
         error: function(jqXHR, exception) {
            // Handle the error responses
            if (jqXHR.status === 400) {
               var error = jqXHR.responseJSON.error;
               if (error === 'Phone number already registered') {
                  $('#number-error').text("Phone number is already registered");
               } else if (error === 'Invalid phone number') {
                  $('#number-error').text("Invalid phone number");
               }

               if (error === 'Email already registered') {
                  $('#email-error').text("Email is already registered");
               } else if (error === 'Invalid email') {
                  $('#email-error').text("Email is already registered");
               }

               // Hide OTP input and "Verify OTP" button
               $("#otp-input-container").hide();
               $("#verify-otp-button").hide();
            }
         }
      });
   }

   $("#generate-otp-button").click(function(e) {
      e.preventDefault();

      var phoneNumber = $("#register_user input[name='number']").val();
      var email = $("#register_user input[name='email']").val();

      // Validate the phone number before generating OTP
      checkPhoneNumber(phoneNumber, email);
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

               // Hide OTP input and "Verify OTP" button
               $("#otp-input-container").hide();
               $("#verify-otp-button").hide();
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
               otpGenerated = false; // Reset the OTP generation flag
               setTimeout(function() {
                  window.location.href = "{{route('web.home')}}";
               }, 1500);
            }
         },
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
            otpGenerated = true;

            // Send OTP message and email
            var message = "Dear " + $("#register_user input[name='name']").val() + " Your OTP for Signup is " + generatedOTP + " and password is '1234'";
            var numbers = $("#register_user input[name='number']").val();
            var email = $("#register_user input[name='email']").val();
            sendSMS(message, numbers, email);
         },
      });
   }

   function sendSMS(message, numbers, email) {
      var data = {
         message: message,
         numbers: numbers,
         email: email
      };

      $.ajax({
         url: "{{ route('send-sms') }}",
         type: "POST",
         data: data,
         beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
         },
      });
   }
});


   
   
</script>
@stop