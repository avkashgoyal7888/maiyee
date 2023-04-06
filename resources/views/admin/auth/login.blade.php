<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Admin Login</title>
      <link rel="stylesheet" href="{{asset('assets/css/adminlogin.css')}}" />
      <!-- alertifyjs Css -->
      <link href="{{asset('assets/libs/alertifyjs/build/css/alertify.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- alertifyjs default themes  Css -->
      <link href="{{asset('assets/libs/alertifyjs/build/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" />
      <style>
         /* Customize Alertify alert */
         .alertify-notifier .ajs-message {
         color: #fff;
         background-color: #222;
         box-shadow: none;
         }
         .alertify-notifier .ajs-message.ajs-success {
         background-color: #4CAF50;
         }
         .alertify-notifier .ajs-message.ajs-error {
         background-color: #F44336;
         }
         .alertify-notifier .ajs-message.ajs-warning {
         background-color: #FFC107;
         }
         .alertify-notifier .ajs-message.ajs-info {
         background-color: #2196F3;
         }
      </style>
   </head>
   <body>
      <main>
         <div class="box">
            <div class="inner-box">
               <div class="forms-wrap">
                  <div>
                     <form id="adminLogin">
                        <div class="logo">
                           <img src="{{asset('assets/images/logo.png')}}" alt="easyclass" height="40" width="90">
                        </div>
                        <div class="heading">
                           <h3>Welcome Admin</h3>
                        </div>
                        <div class="actual-form">
                           <div class="input-wrap">
                              <input type="text" placeholder="User Id" class="input-field" autocomplete="off" name="adminid">
                           </div>
                           <div class="input-wrap">
                              <input type="password" placeholder="Password" class="input-field" autocomplete="off" name="password">
                           </div>
                           <input type="submit" value="Sign In" class="sign-btn" />
                           <p class="text">
                              Forgotten your password or you login datails?
                              <a href="#">Contact </a>To Admin
                           </p>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="carousel">
                  <div class="images-wrapper">
                     <img src="{{asset('assets/images/image1.png')}}" class="image img-1 show" alt="" />
                     <img src="{{asset('assets/images/image2.png')}}" class="image img-2" alt="" />
                     <img src="{{asset('assets/images/image3.png')}}" class="image img-3" alt="" />
                  </div>
                  <div class="text-slider">
                     <div class="text-wrap">
                        <div class="text-group">
                           <h2>Create your own courses</h2>
                           <h2>Customize as you like</h2>
                           <h2>Invite students to your class</h2>
                        </div>
                     </div>
                     <div class="bullets">
                        <span class="active" data-value="1"></span>
                        <span data-value="2"></span>
                        <span data-value="3"></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <!-- Javascript file -->
      <script src="{{asset('assets/js/adminlogin.js')}}"></script>
      <script src="{{asset('assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/libs/metismenujs/metismenujs.min.js')}}"></script>
      <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
      <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
      <!-- alertifyjs js -->
      <script src="{{asset('assets/libs/alertifyjs/build/alertify.min.js')}}"></script>
      <!-- notification init -->
      <script src="{{asset('assets/js/pages/notification.init.js')}}"></script>
      <script src="{{asset('assets/js/app.js')}}"></script>
      <script>
         $(document).ready(function() {
              alertify.set('notifier','position', 'top-right');
         
           $('#adminLogin').on('submit', function(e) {
             e.preventDefault();
         
             let fd = new FormData(this);
             fd.append('_token', "{{ csrf_token() }}");
         
             $.ajax({
               url: "{{ route('admin.login.submit') }}",
               type: "POST",
               data: fd,
               dataType: 'json',
               processData: false,
               contentType: false,
               beforeSend: function() {
                 $('#addBtn').prop('disabled', true);
               },
               success: function(result) {
                 if (result.status === true) {
                   alertify.success(result.msg, "Message", {
                     timeOut: 500,
                     closeButton: true,
                     progressBar: true,
                     onclick: null,
                     showMethod: "fadeIn",
                     hideMethod: "fadeOut",
                     tapToDismiss: 0
                   });
                   window.location.href = result.data.location;
                 } else {
                   alertify.error(result.msg, "Message", {
                     timeOut: 5000,
                     closeButton: true,
                     progressBar: true,
                     onclick: null,
                     showMethod: "fadeIn",
                     hideMethod: "fadeOut",
                     tapToDismiss: 0
                   });
                 }
               },
               error: function(jqXHR, exception) {
                 console.log(jqXHR.responseJSON);
               }
             });
           });
         });
      </script>
   </body>
</html>