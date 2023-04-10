<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="update">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="p-2 w-100">
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add</button>
      </div>
      <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <button class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addFund">Add Fund</button>
         <button class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#fund">Transfer to Account</button>
         <button class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#supplierfund">Transfer to Supplier</button>
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Account Name</th>
                  <th>Nickname</th>
                  <th>Balance</th>
                  <th>Statement</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $accs)
               <tr>
                  <td> {{ $key +1 }} </td>
                  <td>{{ ucwords($accs->ac_name) }}</td>
                  <td>{{ ucwords($accs->nickname) }}</td>
                  <td>{{$accs->effective_balance}}</td>
                  <td><a class="btn btn-success btn-sm" href="{{ route('admin.account.statement',$accs->id) }}">View</a></td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editStore({{$accs->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;
                     <button type="button" class="btn btn-sm btn-danger" wire:click="delete({{$accs->id}})"><i class="fas fa-trash"></i></button>
                  </td>
               </tr>
               @empty
               <td colspan="7">No Record Found</td>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
   <!--Supplier fund transfer -->
   <div wire:ignore.self class="modal" id="supplierfund" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Transaction</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='supFundTransfer()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">From</label>
                           <select class="form-control" wire:model='from'>
                              <option>Select Account</option>
                              @foreach($acc as $categ)
                              <option value="{{$categ->id}}">{{$categ->nickname}}</option>
                              @endforeach
                           </select>
                           @error('from')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">To</label>
                           <select class="form-control" wire:model='to'>
                              <option>Select Supplier</option>
                              @foreach($sup as $categ)
                              <option value="{{$categ->id}}">{{$categ->sname}}</option>
                              @endforeach
                           </select>
                           @error('to')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Amount</label>
                              <input type="text" class="form-control" wire:model='amount' placeholder="0.00"/>
                              @error('amount')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Date</label>
                              <input type="date" class="form-control" wire:model='transaction_date'/>
                              @error('transaction_date')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Remarks</label>
                              <input type="text" class="form-control" wire:model='perticuler' placeholder="Remarks"/>
                              @error('perticuler')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--Account fund transfer -->
   <div wire:ignore.self class="modal" id="fund" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Transaction</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='accFundTransfer()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">From</label>
                           <select class="form-control" wire:model='from'>
                              <option>Select Account</option>
                              @foreach($acc as $categ)
                              <option value="{{$categ->id}}">{{$categ->nickname}}</option>
                              @endforeach
                           </select>
                           @error('from')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">To</label>
                           <select class="form-control" wire:model='to'>
                              <option>Select Account</option>
                              @foreach($acc as $categ)
                              <option value="{{$categ->id}}">{{$categ->nickname}}</option>
                              @endforeach
                           </select>
                           @error('to')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Amount</label>
                              <input type="text" class="form-control" wire:model='amount' placeholder="0.00"/>
                              @error('amount')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Date</label>
                              <input type="date" class="form-control" wire:model='transaction_date'/>
                              @error('transaction_date')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Remarks</label>
                              <input type="text" class="form-control" wire:model='perticuler' placeholder="Remarks"/>
                              @error('perticuler')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Add fund --> 
   <div wire:ignore.self class="modal" id="addFund" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Funds</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='addFunds()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">To</label>
                           <select class="form-control" wire:model='to'>
                              <option>Select Account</option>
                              @foreach($acc as $categ)
                              <option value="{{$categ->id}}">{{$categ->nickname}}</option>
                              @endforeach
                           </select>
                           @error('to')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Amount</label>
                              <input type="text" class="form-control" wire:model='amount' placeholder="0.00"/>
                              @error('amount')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Date</label>
                              <input type="date" class="form-control" wire:model='transaction_date'/>
                              @error('transaction_date')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6 mb-3">
                              <label for="nameExLarge" class="form-label">Remarks</label>
                              <input type="text" class="form-control" wire:model='perticuler' placeholder="Remarks"/>
                              @error('perticuler')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--  Add Account Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Account</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account name</label>
                           <input type="text" class="form-control" placeholder="Account Name" wire:model='ac_name'>
                           @error('ac_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account Number</label>
                           <input type="text" class="form-control" placeholder="Enter Account Number" wire:model='ac_no'>
                           @error('ac_no')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">ifsc</label>
                           <input type="text" class="form-control" placeholder="Enter IFSC" wire:model='ifsc'>
                           @error('ifsc')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Branch</label>
                           <input type="text" class="form-control" placeholder="Enter Branch" wire:model='branch'>
                           @error('branch')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bank</label>
                           <input type="text" class="form-control" placeholder="Enter Bank" wire:model='bankname'>
                           @error('bankname')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Nick Name</label>
                           <input type="text" class="form-control" placeholder="Enter Nick Name" wire:model='nickname'>
                           @error('nickname')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--  Edit Account Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Account</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='updateStore()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account Name</label>
                           <input type="text" class="form-control" wire:model='ac_name'>
                           @error('ac_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account Number</label>
                           <input type="text" class="form-control" wire:model='ac_no'>
                           @error('ac_no')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">IFSC</label>
                           <input type="text" class="form-control" wire:model='ifsc'>
                           @error('ifsc')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Branch</label>
                           <input type="text" class="form-control" wire:model='branch'>
                           @error('branch')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bank</label>
                           <input type="text" class="form-control" wire:model='bankname'>
                           @error('bankname')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Nick Name</label>
                           <input type="text" class="form-control" wire:model='nickname'>
                           @error('nickname')<span class="text-danger">{{$message}}</span>@enderror
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
   <!-- End Here -->
</div>