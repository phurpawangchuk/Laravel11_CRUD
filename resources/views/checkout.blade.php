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
        <h1 class="text-center mb-4">Checkout</h1>
        <form id="payment-form">
            <div class="mb-3">
                <label for="payment-method" class="form-label">Choose payment method:</label>
                <select id="payment-method" class="form-select">
                    <option value="card">Card</option>
                    <option value="ideal">iDEAL</option>
                    <option value="alipay">Alipay</option>
                </select>
            </div>

            <!-- Card Element for 'card' payment method -->
            <div id="card-element" class="payment-element"></div> 

            <!-- iDEAL Element for 'ideal' payment method -->
            <div id="ideal-element" class="payment-element" style="display: none;">
                <label for="ideal-bank" class="form-label">Choose your bank:</label>
                <div id="ideal-bank-element"></div>
            </div>

            <!-- Alipay Element for 'alipay' payment method -->
            <div id="alipay-element" class="payment-element" style="display: none;">
                <p>Please follow the instructions to complete your payment.</p>
            </div>

            <button id="submit" class="btn btn-primary w-100">Pay</button>
            <div id="card-errors" role="alert" class="mt-3"></div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();

            // Create Card Element
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            // Create iDEAL Element
            const idealBankElement = elements.create('idealBank');
            idealBankElement.mount('#ideal-bank-element');

            // Handle switching between payment methods
            const paymentMethodSelect = document.getElementById('payment-method');
            paymentMethodSelect.addEventListener('change', function(event) {
                const method = event.target.value;
                document.querySelectorAll('.payment-element').forEach(function(el) {
                    el.style.display = 'none';
                });
                if (method === 'card') {
                    document.getElementById('card-element').style.display = 'block';
                } else if (method === 'ideal') {
                    document.getElementById('ideal-element').style.display = 'block';
                } else if (method === 'alipay') {
                    document.getElementById('alipay-element').style.display = 'block';
                }
            });

            // Handle form submission
            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit');

            form.addEventListener('submit', async function (event) {
                event.preventDefault();
                submitButton.disabled = true;

                const selectedPaymentMethod = paymentMethodSelect.value;

                // Create PaymentIntent on server
                const { clientSecret } = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ payment_method: selectedPaymentMethod })
                }).then(res => res.json());

                let paymentResult;

                if (selectedPaymentMethod === 'card') {
                    // Confirm Card Payment
                    paymentResult = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement,
                        }
                    });
                } else if (selectedPaymentMethod === 'ideal') {
                    // Confirm iDEAL Payment
                    paymentResult = await stripe.confirmIdealPayment(clientSecret, {
                        payment_method: {
                            ideal: idealBankElement,
                        },
                        return_url: window.location.href
                    });
                } else if (selectedPaymentMethod === 'alipay') {
                    // Confirm Alipay Payment
                    paymentResult = await stripe.confirmAlipayPayment(clientSecret, {
                        return_url: window.location.href
                    });
                }

                if (paymentResult.error) {
                    // Display error message
                    document.getElementById('card-errors').textContent = paymentResult.error.message;
                    submitButton.disabled = false;
                } else if (paymentResult.paymentIntent && paymentResult.paymentIntent.status === 'succeeded') {
                    alert('Payment successful!');
                    window.location.href = '/success'; // Redirect or update UI
                }
            });
        });
    </script>
</body>
</html>
