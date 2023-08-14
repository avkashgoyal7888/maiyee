<!DOCTYPE html>
<html lang="en">

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
        /* Add your table border style here */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black; /* Border around the whole table */
        }
        th, td {
            border: 1px solid black; /* Border for table cells */
            padding: 8px;
            text-align: left;
        }
    </style>
  </head>

  <body>
  	<div class="table-responsive" style="margin-top: 20px;">
         <table>
            <tbody style="WI">
               <tr>
                  <td colspan="3">Name</td>
                  <td colspan="4">{{$user->name}}</td>
               </tr>
               <tr>
                  <td colspan="3">Number</td>
                  <td colspan="4">{{$user->number}}</td>
               </tr>
               <tr>
                  <td colspan="3">Address</td>
                  <td colspan="4">{{$user->address}}</td>
               </tr>
               <tr>
                  <td colspan="3">Size</td>
                  <td colspan="4">{{$user->size}}</td>
               </tr>
               <tr>
                  <td colspan="3">Slot</td>
                  <td colspan="4">Date : {{$user->delivery_date}} Time: {{$user->start_time}}-{{$user->end_time}}</td>
               </tr>
               <tr>
                  <td colspan="7"></td>
               </tr>
            </tbody>
         </tbody>
               <tr>
                  <td>S. No.</td>
                  <td>Category</td>
                  <td>Product Name</td>
                  <td>Style Code</td>
                  <td>MRP</td>
                  <td>Selling Price</td>
                  <th>Remarks</th>
               </tr>
            </tbody>
            <tbody>
               @forelse($data as $key => $order)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($order->product->cat->name) }}</td>
                  <td>{{ ucwords($order->product->product_name) }}</td>
                  <td>{{ ucwords($order->product->style_code) }}</td>
                  <td>{{ ucwords($order->product->mrp) }}</td>
                  <td>{{ ucwords($order->product->selling_price) }}</td>
                  <td>  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="3">No Record Found</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

