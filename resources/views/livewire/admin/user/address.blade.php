<div>

      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Landmark</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Pin Code</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $user)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($user->name) }}</td>
                  <td>{{ ucwords($user->email) }}</td>
                  <td>{{ ucwords($user->contact) }}</td>
                  <td>{{ ucwords($user->address) }}</td>
                  <td>{{ ucwords($user->landmark) }}</td>
                  <td>{{ ucwords($user->state) }}</td>
                  <td>{{ ucwords($user->city) }}</td>
                  <td>{{ ucwords($user->pin_code) }}</td>
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
</div>