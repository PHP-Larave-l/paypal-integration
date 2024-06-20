<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay with PayPal</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD"></script>
</head>

<body>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01' // Replace with the actual amount
                        }
                    }]
                });
            },

            // Finalize the transaction after buyer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Redirect to success page
                    window.location.href = "{{ route('success') }}";
                });
            },

            // Handle payment cancellations
            onCancel: function(data) {
                // Redirect to cancel page
                window.location.href = "{{ route('cancel') }}";
            },

            // Handle errors during the transaction
            onError: function(err) {
                console.error('An error occurred during the transaction:', err);
                alert('An error occurred during the transaction. Please try again.');
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>
