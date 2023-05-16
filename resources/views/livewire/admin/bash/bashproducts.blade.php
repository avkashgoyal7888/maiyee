<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="update">
         <x-loader/>
      </div>
      <div wire:loading wire:target="delete">
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
      <div class="mt-3">
         <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
            <label for="search">Search</label>
            <input type="text" wire:model="search" class="form-control" id="search">
         </div>
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Bash Name</th>
                  <th>Product Name</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $product)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($product->bash->name) }}</td>
                  <td>{{ ucwords($product->product->name) }}</td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete" wire:click="deleteBashProduct({{$product->id}})"><i class="fas fa-trash"></i></button>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="3">No Record Found</td>
               </tr>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
   <!--  Add State Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Bash</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bash name</label>
                           <select class="form-control" id="bash_id" wire:model="bash_id">
                              <option value="">Select Bash</option>
                              @foreach($bash as $bashes)
                              <option value="{{ $bashes->id }}">{{ $bashes->name }}</option>
                              @endforeach
                           </select>
                           @error('bash_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="products">Products</label>
                           <div style="position: relative;">
                              <input type="text" id="search-products" class="form-control" placeholder="Search products...">
                              <select class="form-control" id="products" wire:model="selectedProducts" multiple>
                                 @foreach($products as $product)
                                 <option value="{{ $product->id }}">{{ $product->style_code }}</option>
                                 @endforeach
                              </select>
                           </div>
                           @error('selectedProducts')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        @foreach($selectedProductNames as $productName)
                        <button type="button" class="btn btn-sm btn-primary btn-rounded" wire:click.prevent="removeSelectedProduct('{{ $productName }}')" style="width: auto; margin-right: 5px;">{{ $productName }} X</button>
                        @endforeach
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
   <!--  Edit State Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Bash</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='update()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bash name</label>
                           <input type="text" class="form-control" wire:model='name'>
                           <input type="hidden" wire:model='bash_id'>
                           @error('name')<span class="text-danger">{{$message}}</span>@enderror
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
   <!-- Delete modal -->
   <div wire:ignore.self class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myLargeModalLabel">Delete Bash</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form wire:submit.prevent='delete()'>
               <input type="hidden" wire:model='bash_id'>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-dark">Delete</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@push('js')
<script>
$(document).ready(function() {
   // Get the select field and its options
   const select = $('#products')[0];
   const options = select.options;
   
   // Get the search input field
   const searchInput = $('#search-products');
   
   // Add an event listener to the search input field
   searchInput.on('input', function(event) {
      const searchTerm = event.target.value.toLowerCase();
      
      // Loop through the select field options and hide/show them based on the search term
      for (let i = 0; i < options.length; i++) {
         const option = options[i];
         const optionText = option.text.toLowerCase();
         
         if (optionText.includes(searchTerm)) {
            option.style.display = '';
         } else {
            option.style.display = 'none';
         }
      }
   });
});
</script>
@endpush
