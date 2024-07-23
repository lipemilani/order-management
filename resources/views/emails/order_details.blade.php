<!DOCTYPE html>
<html>
<head>
    <title>Order Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .order-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .order-details p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
<h1>All order details</h1>
<div class="order-details">
    <p><strong>Client name:</strong> {{ $customer->name }}</p>
    <p><strong>Client mail:</strong> {{ $customer->email }}</p>
    <p><strong>Produt:</strong> {{ $product->name }}</p>
    <p><strong>Preço:</strong> ${{ number_format($product->price, 2) }}</p>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Order date:</strong> {{ $order->created_at }}</p>
</div>
</body>
</html>
