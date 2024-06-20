<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe with PayPal</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&vault=true&intent=subscription"></script>
</head>
<body>
    <h1>Subscribe to Our Plan</h1>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    'plan_id': '{{ $planId }}'
                });
            },
            onApprove: function(data, actions) {
                // Redirect to subscription success page
                window.location.href = "{{ route('subscription-success') }}";
            },
            onCancel: function(data) {
                // Redirect to subscription cancel page
                window.location.href = "{{ route('subscription-cancel') }}";
            },
            onError: function(err) {
                console.error('An error occurred during the subscription process:', err);
                alert('An error occurred during the subscription process. Please try again.');
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
