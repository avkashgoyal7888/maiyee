<!DOCTYPE html> 
<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- <title>Welcome To Maiyee</title> -->
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('front/assets/images/logo.png')}}" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/plugins.css')}}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('front/assets/css/responsive.css')}}">
<!-- Footer Style CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@yield('css')

</head>
<body class="template-index">
<section class="home2-default">
<!-- <div id="pre-loader">
    <img src="{{asset('front/assets/images/logo.png')}}" alt="Loading..." />
</div> -->
<div class="pageWrapper">
	<!--Promotion Bar-->
	@include('layouts.front.include.nav')
<!--------------------------End Header------------------------------------->
<!--------------------------End Header------------------------------------->
<!--------------------------End Header------------------------------------->
    
<!--Body Content-->
<div id="page-content">
    <!--Home slider-->
    @yield('content') 
    <!--End Featured Product-->
    
</div>
<!--End Body Content-->
    
<!----------------------------Footer------------------------>
<!----------------------------Footer------------------------>
<!----------------------------Footer------------------------>
@include('layouts.front.include.footer')
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
    <!-- Login Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <h3 style="text-align: center; color: #850c40;">Sign In</h3>
        <div class="row d-flex">
            <div class="col-lg-12">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3" style="margin: auto;">
                        <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
                        <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
                        <div class="google text-center mr-3"><div class="fa fa-google"></div></div>
                        <div class="instagram text-center mr-3"><div class="fa fa-instagram"></div></div>
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="line"></div>
                        <small class="or text-center">Or</small>
                        <div class="line"></div>
                    </div>
                    <form id="login_user">
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                        <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                        <input type="password" name="password" placeholder="Enter password" id="txtPassword" >
                        <p id="btnToggle" class="show-password">Show Password</p>
                    </div>
                    <div class="forgot">
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> 
                            <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                        </div>
                        <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                    </div>
                    <div class="row mb-3 px-3">
                        <button type="submit" class="btn btn-blue text-center">Login</button>
                    </div>
                    </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Don't have an account? <a href="{{route('web.register')}}">Register</a></small>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    
     <!-- Including Jquery -->
     <script src="{{asset('front/assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
     <script src="{{asset('front/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
     <script src="{{asset('front/assets/js/vendor/jquery.cookie.js')}}"></script>
     <script src="{{asset('front/assets/js/vendor/wow.min.js')}}"></script>
     <!-- Including front/g Javascript -->
     <script src="{{asset('front/assets/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('front/assets/js/plugins.js')}}"></script>
     <script src="{{asset('front/assets/js/popper.min.js')}}"></script>
     <script src="{{asset('front/assets/js/lazysizes.js')}}"></script>
     <script src="{{asset('front/assets/js/main.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     @yield('js')
     <!--Footer Scripts-->
     
     <!--For Newsletter Popup-->
     <script>
$(document).ready(function(){
    $('#login_user').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission
        let fd = new FormData(this);
        fd.append('_token', "{{ csrf_token() }}");
 
        $.ajax({
            url: "{{ route('web.login.submit') }}",
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
                    toastr.error(result.msg, 'Error', {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true
                    });
                } else if (result.status === true) {
                    toastr.success(result.msg, 'Success', {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true
                    });
                    window.location.reload();
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
     <script>
		jQuery(document).ready(function(){  
		  jQuery('.closepopup').on('click', function () {
			  jQuery('#popup-container').fadeOut();
			  jQuery('#modalOverly').fadeOut();
		  });
		  
		  var visits = jQuery.cookie('visits') || 0;
		  visits++;
		  jQuery.cookie('visits', visits, { expires: 1, path: '/' });
		  console.debug(jQuery.cookie('visits')); 
		  if ( jQuery.cookie('visits') > 1 ) {
			jQuery('#modalOverly').hide();
			jQuery('#popup-container').hide();
		  } else {
			  var pageHeight = jQuery(document).height();
			  jQuery('<div id="modalOverly"></div>').insertBefore('body');
			  jQuery('#modalOverly').css("height", pageHeight);
			  jQuery('#popup-container').show();
		  }
		  if (jQuery.cookie('noShowWelcome')) { jQuery('#popup-container').hide(); jQuery('#active-popup').hide(); }
		}); 
		
		jQuery(document).mouseup(function(e){
		  var container = jQuery('#popup-container');
		  if( !container.is(e.target)&& container.has(e.target).length === 0)
		  {
			container.fadeOut();
			jQuery('#modalOverly').fadeIn(200);
			jQuery('#modalOverly').hide();
		  }
		});
		
		/*--------------------------------------
			Promotion / Notification Cookie Bar 
		  -------------------------------------- */
		  if(Cookies.get('promotion') != 'true') {   
			 ₹(".notification-bar").show();         
		  }
		  ₹(".close-announcement").on('click',function() {
			₹(".notification-bar").slideUp();  
			Cookies.set('promotion', 'true', { expires: 1});  
			return false;
		  });
	</script>
    <script>
        let passwordInput = document.getElementById('txtPassword'),
  toggle = document.getElementById('btnToggle');

function togglePassword() {  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    toggle.innerHTML = 'Hide Paswword';
  } else {
    passwordInput.type = 'password';
    toggle.innerHTML = 'Show Password';
  }
}
(function () {
  toggle.addEventListener('click', togglePassword, false);
})();
    </script>
    <!--End For Newsletter Popup-->
</div>
</section>
</body>

</html>