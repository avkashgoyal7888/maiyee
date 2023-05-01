<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ShiprocketController extends Controller
{
    public function createOrder()
{
    $client = new Client([
        'base_uri' => 'https://apiv2.shiprocket.in/v1/',
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.base64_encode('<tech@maiyee.in>:<Eduse@123>')
        ]
    ]);

    // Authenticate the user
    $response = $client->post('external/auth/login', [
        'json' => [
            'email' => 'tech@maiyee.in',
            'password' => 'Eduse@123',
        ]
    ]);

    if ($response->getStatusCode() == 200) {
        $result = json_decode($response->getBody()->getContents());
        $access_token = $result->token;

        // Define the order data
        $orderData = [
            'order_id' => 'ORD123456',
            'billing_customer_name' => 'John Doe',
            'order_date' => '2023-05-01',
            'billing_last_name' => 'Doe',
            'billing_address' => '123 Main St',
            'billing_city' => 'Los Angeles',
            'billing_pincode' => '90001',
            'billing_state' => 'CA',
            'billing_country' => 'USA',
            'billing_email' => 'johndoe@example.com',
            'billing_phone' => '1234567890',
            'shipping_is_billing' => true,
            'order_items' => [
                [
                    'name' => 'Product 1',
                    'sku' => 'PROD123',
                    'units' => 1,
                    'selling_price' => 100.00,
                    'discount' => 0.00,
                    'tax' => 0.00,
                ],
            ],
            'payment_method' => 'COD',
            'shipping_charges' => 50.00,
            'giftwrap_charges' => 0.00,
            'transaction_charges' => 0.00,
            'total_discount' => 0.00,
            'sub_total' => 100.00,
            'length' => 10.00,
            'breadth' => 10.00,
            'height' => 10.00,
            'weight' => 1.00,
        ];

        // Create the order
        $response = $client->post('external/orders/create/adhoc', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$access_token,
            ],
            'json' => $orderData,
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents());
            // Handle the successful order placement
        } else {
            $result = json_decode($response->getBody()->getContents());
            $error_message = $result->message;
            // Handle the error
        }
    }
}

}
