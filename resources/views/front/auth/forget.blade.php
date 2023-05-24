@extends('layouts.front.app')
@section('css')
<title>Forgot Password</title>
@stop
@section('content')
<!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Recover Password</h1></div>
            </div>
        </div>
        <!--End Page Title-->
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                       <form id="forgetPassword" accept-charset="UTF-8" class="contact-form">   
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group">
        <div id="email-error" class="text-danger error-message my-2"></div>
        <input type="text" value="" name="email_or_contact" placeholder="Enter Your Email/Mobile Number" class="" >                         
      </div>
    </div>
  </div>
  <div class="row">
    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
      <input type="submit" class="btn btn-blue text-center" value="Continue">
    </div>
  </div>
</form>

                    </div>
                </div>
            </div>
@stop
@section('js')
<script>
$(document).ready(function(){
    $('#forgetPassword').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission
        let fd = new FormData(this);
        fd.append('_token', "{{ csrf_token() }}");
 
        $.ajax({
            url: "{{ route('web.forget.submit') }}",
            type: "POST",
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#addBtn').prop('disabled', true)
            },
            success: function(result) {
                if (result.status === false) {
                    $('#email-error').text(result.emailOrContact);
                } else if (result.status === true) {
                    toastr.success(result.msg, 'Success', {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true
                    });
                    window.location.href="{{route('web.otp.view')}}";
                }
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR.responseJSON);
                toastr.error(result.msg, 'Error', {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true
                });
            },
            complete: function() {
                $('#addBtn').prop('disabled', false);
            }
        });
    });
});
</script>
@stop