@extends('layouts.admin.app')
@section('css')
<title>Dashboard</title>
<style>
        body {
            text-align: center;
            background: #ffffff;
            font-family: 'PT Sans Narrow', sans-serif;
        }

        .counter {
            background-color: #fdd200;
            display: inline-block;
            margin: 60px 0;
            padding: 30px;
            font-weight: bold;
            border-radius: 6px;
            box-shadow: 0px 0px 30px rgba(0, 46, 108, .8);
        }

        .counter:after {
            content: '';
            display: block;
            clear: both;
        }

        .counter-digit {
            position: relative;
            float: left;
            margin-right: 5px;
            width: auto;
            height: 60px;
            line-height: 58px;
            color: white;
            text-align: center;
            font-size: 45px;
            background: #304361;
            border-radius: 4px;
            overflow: hidden;
            text-shadow: 2px 1px 1px rgba(0, 0, 0, .2);
            box-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
        }

        .counter-digit:last-child {
            margin-right: 0;
        }

        .gradient-top {
            position: absolute;
            top: 0;
            bottom: 50%;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .3), transparent, transparent);
        }

        .gradient-top:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: rgba(0, 0, 0, .2);
        }

        .comma {
            float: left;
            margin-right: 5px;
            height: 60px;
            line-height: 85px;
            font-size: 35px;
            color: #304361;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
        }

        div#dollars {
            position: relative;
            margin-top: 20px;
        }

        a {
            color: #304361;
        }
    </style>
@stop
@section('content')
    <div class="container">
       <div class="row">
         <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3 col-12">
    <div class="d-flex">
        <div class="counter mb-3">
            <div id="donors">Visitors:</div>
            <div class="counter-digit">
                <span>{{$visitorCount}}</span>
                <div class="gradient-top"></div>
            </div>
        </div>
        <div class="counter ms-5" onclick="document.getElementById('counterBtn').click()">
         <div id="donors"></div>
         <div class="counter-digit">
            <button id="counterBtn" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#edit">
                Navbar
            </button>
         </div>
        </div>
    </div>
 </div>
</div>
    </div>




<!-- End -->
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