<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
      <meta content="Themesdesign" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">
      <!-- plugin css -->
      <link href="{{asset('admin/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- swiper css -->
      <link rel="stylesheet" href="{{asset('admin/assets/libs/swiper/swiper-bundle.min.css')}}">
      <!-- Bootstrap Css -->
      <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
      <link href="{{asset('admin/assets/libs/alertifyjs/build/css/alertify.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('admin/assets/libs/alertifyjs/build/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" />
      @yield('css')
      @stack('css')
      @livewireStyles
   </head>
   <body>
      <!---------- Begin page ------------------>
      <div id="layout-wrapper">
         @include('layouts.admin.include.nav')
         <!-- ========== Left Sidebar Start ========== -->
         @include('layouts.admin.include.side')
         <!-- Left Sidebar End -->
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  @yield('content')
               </div>
            </div>
         </div>
         <footer class="footer">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6">
                     <script>document.write(new Date().getFullYear())</script> &copy; Maiyee.
                  </div>
                  <div class="col-sm-6">
                     <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="#" target="_blank">Edutech</a>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>
      <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
      <!-- JAVASCRIPT -->
      <script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('admin/assets/libs/metismenujs/metismenujs.min.js')}}"></script>
      <script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
      <script src="{{asset('admin/assets/libs/feather-icons/feather.min.js')}}"></script>
      <!-- Vector map-->
      <script src="{{asset('admin/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
      <script src="{{asset('admin/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>
      <!-- swiper js -->
      <script src="{{asset('admin/assets/libs/swiper/swiper-bundle.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/app.js')}}"></script>
      <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('admin/assets/libs/alertifyjs/build/alertify.min.js')}}"></script>
      @yield('js')
      @stack('js')
      @livewireScripts
      <script type="text/javascript">
         window.livewire.on('closemodal', () => {
             $('#add').modal('hide');
             $('#edit').modal('hide');
             $('#view').modal('hide');
             $('#delete').modal('hide');
             $('#fund').modal('hide');
             $('#addFund').modal('hide');
             $('#supplierfund').modal('hide');
             $('#addInventory').modal('hide');
             $('#removeInventory').modal('hide');
             $('#pickupStatus').modal('hide');
         });
      </script>
   </body>
</html>