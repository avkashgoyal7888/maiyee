@extends('layouts.admin.app')
@section('css')
<title>Suppliers</title>
@stop
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="d-flex align-items-center justify-content-end my-4 mx-3">
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
               <li class="breadcrumb-item active"><b>Suppliers</b></li>
            </ol>
         </div>
      </div>
   </div>
</div>
<!----------- Page Content Starts From Here ----------->
<div class="row justify-content-center">
   <div class="col-xxl-12 col-xl-12">
      <div class="card card-h-100">
         <div class="card-header justify-content-between d-flex align-items-center">
            <h4 class="card-title">Suppliers List</h4>
         </div>
         <livewire:admin.supplier.index>
      </div>
   </div>
</div>
<!----------- Page Content End Here ----------->
@endsection