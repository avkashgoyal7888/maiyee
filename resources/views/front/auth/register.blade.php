@extends('layouts.front.app')
@section('css')
<title>Register</title>
@stop
@section('content')
<div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Create an Account</h1></div>
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
                        <input type="text" name="confirm_password">
                        </div>
                        <div class="inputBx">
                        <input type="submit" value="Signup">
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
	$(document).ready(function(){
		$('#register_user').on('submit', function(e) {
                 e.preventDefault();
                 let fd = new FormData(this);
                 fd.append('_token', "{{ csrf_token() }}");
         
                 $.ajax({
                     url: "{{ route('web.register.submit') }}",
                     type: "POST",
                     data: fd,
                     dataType: 'json',
                     processData: false,
                     contentType: false,
                     beforeSend: function() {
                         $('#addBtn').prop('disabled', true)
                     },
                     success: function(result) {
                         if (result.status === 400) {
                             // Display error messages
                             $('#name-error').text(result.nameError);
                             $('#number-error').text(result.numberError);
                             $('#email-error').text(result.emailError);
                             $('#password-error').text(result.passwordError);
                             $('#confpassword-error').text(result.confpasswordError);
                         } else if (result.status === 200) {
                             toastr.success(result.message, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })
                             $('#register_user')[0].reset();
                         }
                     },
                     error: function(jqXHR, exception) {
                         console.log(jqXHR.responseJSON);
                     }
                 });
             });
	});
</script>


@stop