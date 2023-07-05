<!DOCTYPE html>
<html>
<head>
    <style>
        .invoice {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        
    </style>
</head>
<body>
    <div class="invoice">
        <h1>Order Invoice</h1>
        <p>Order ID: {{ $orderCoupon['order_id'] }}</p>
        <p>Customer Name: {{ $orderCoupon['name'] }}</p>
        <p>Address: {{ $orderCoupon['address'] }}</p>
        <!-- Add more invoice details here -->

        <p>Attached to this email is your invoice.</p>
    </div>
</body>
</html>
