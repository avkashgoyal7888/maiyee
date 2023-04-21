@extends('layouts.admin.app')
@section('css')
<title>Dashboard</title>
@stop
@section('content')
<div class="col-xl-3 col-sm-6 col-md-3 col-lg-3 col-12">
   <div class="card">
      <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit">
         <div class="card-body">
            <div>
            </div>
            Navbar
      </button>
      </div>
   </div>
</div>
<!--  Edit City Modal -->
<div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Nav</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
         </div>
         <div class="modal-body">
            <form id="editNav">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" value="{{$nav->code}}">
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Order</label>
                        <input type="text" class="form-control" name="order" value="{{$nav->order}}">
                        <input type="hidden" name="id" value="{{$nav->id}}">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="closemodal">Close</button>
                  <button type="submit" class="btn btn-success">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop
@section('js')
<script>
   $(document).ready(function() {
        alertify.set('notifier','position', 'top-right');
   
     $('#editNav').on('submit', function(e) {
       e.preventDefault();
   
       let fd = new FormData(this);
       fd.append('_token', "{{ csrf_token() }}");
   
       $.ajax({
         url: "{{ route('admin.nav.edit') }}",
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
             window.location.reload();
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
@stop