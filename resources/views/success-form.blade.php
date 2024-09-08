<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-control {
            border-radius: 4px;
        }
        .payment-element {
            margin-bottom: 1rem;
        }
        #card-errors {
            color: #dc3545;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Success</h1>
    </div>
</body>
</html>
