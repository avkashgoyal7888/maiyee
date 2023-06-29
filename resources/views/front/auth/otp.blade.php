@extends('layouts.front.app')
@section('css')
<title>OTP Verify</title>
@stop
@section('content')
<!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">OTP Verification</h1></div>
            </div>
        </div>
        <!--End Page Title-->
        
        <div class="container">
            <div id="loader" style="display:none;">
    @include('components.loader')
   </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                       <form id="forgetPassword" accept-charset="UTF-8" class="contact-form">   
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group">
        <input type="text" value="" name="otp" placeholder="Enter Your OTP" class="" required>                         
      </div>
    </div>
  </div>
  <div class="row">
    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
      <input type="submit" class="btn btn-blue text-center" value="Verify OTP">
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
            url: "{{ route('web.verify.otp') }}",
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
                    window.location.href = "{{ route('web.reset.view') }}";
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