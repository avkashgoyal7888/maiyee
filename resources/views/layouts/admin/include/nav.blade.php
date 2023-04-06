<header id="page-topbar">
   <div class="navbar-header">
      <!----------------- LOGO --------------->        
      <div class="d-flex">
         <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-light">
            <span class="logo-sm"><img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26"></span>
            <span class="logo-lg"><img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26"></span>
            </a>
         </div>
         <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
         <i class="fa fa-fw fa-bars font-size-16"></i>
         </button>
         <form class="app-search d-none d-lg-block">
            <div class="position-relative">
               <input type="text" class="form-control" placeholder="Search...">
               <span class="bx bx-search icon-sm"></span>
            </div>
         </form>
      </div>
      <!----------------- LOGO END --------------->
      <div class="d-flex">
         <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-3.jpg')}}" alt="Header Avatar">
            <span class="ms-2 d-none d-xl-inline-block user-item-desc">
            <span class="user-name">Avkash Goyal<i class="mdi mdi-chevron-down"></i></span>
            </span>
            </button>
            <!----------------- LOGOUT SECTION --------------->
            <div class="dropdown-menu dropdown-menu-end pt-0">
               <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#image">
               <i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> 
               <span class="align-middle">Change Profile Picture</span>
               </a>
               <!--<a class="dropdown-item" href="#"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$6951.02</b></span></a>-->
               <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changepassword">
               <i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> 
               <span class="align-middle">Change Password</span>
               </a>
               <a class="dropdown-item" href="{{route('admin.logout')}}">
               <i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> 
               <span class="align-middle">Logout</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</header>
<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="changePasswordModalLabel">Update Profile</h5>
            <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div class="col-md-12" id="countryAddMsgs"></div>
            <form id="updateImage">
               <label for="image"><b>Image*</b></label>
               <div class="form-group">
                  <img id="image-preview" src="#" alt="Image Preview" style="display:none; max-width: 100%; max-height: 100%;">
                  <input type="file" class="form-control" id="image" name="image" accept="image/*">
               </div>
               <div class="modal-footer">
                  <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
            <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div class="col-md-12" id="countryAddMsgs"></div>
            <form id="changePasswordForm">
               <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" class="form-control" id="old_password" name="old_password" required>
               </div>
               <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
               </div>
               <div class="form-group">
                  <label for="confirm_password">Confirm New Password</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
               </div>
               <div class="modal-footer">
                  <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<script>
   $(document).ready(function() {
         function readURL(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function(e) {
         $('#image-preview').attr('src', e.target.result).show();
       }
       reader.readAsDataURL(input.files[0]); // convert to base64 string
     }
   }
   
   $("#image").on('change', '#image', function() {
     readURL(this);
   });
   
   $('#updateImage').on('submit', function(e) {
     e.preventDefault();
   
     let fd = new FormData(this);
     fd.append('_token', "{{ csrf_token() }}");
   
     $.ajax({
       url: "{{ route('admin.update.image') }}",
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
           $('#changePasswordForm')[0].reset();
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
   
        alertify.set('notifier','position', 'top-right');
   
     $('#changePasswordForm').on('submit', function(e) {
       e.preventDefault();
   
       let fd = new FormData(this);
       fd.append('_token', "{{ csrf_token() }}");
   
       $.ajax({
         url: "{{ route('admin.change.password') }}",
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
             $('#changePasswordForm')[0].reset();
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