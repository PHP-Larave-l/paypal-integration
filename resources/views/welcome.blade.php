{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Paypal integration</h2>
    <h2>Payemt: 20$</h2>

    <button type="submit">Pay</button>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Checkout Integration | Server Demo </title>
</head>

<body>
    <p>Select a product</p>
    <input type="radio" id="plan-1" name="paypalPlans" onclick="handleClick(this)" value="plan-1">
    <label for="plan-1">Plan 1 = 1.5$</label><br>

    <p>Select a product</p>
    <input type="radio" id="plan-2" name="paypalPlans" onclick="handleClick(this)" value="plan-2">
    <label for="plan-2">Plan 1 = 2$</label><br>

    <p>Select a product</p>
    <input type="radio" id="plan-3" name="paypalPlans" onclick="handleClick(this)" value="plan-3">
    <label for="plan-3">Plan 1 = 5$</label><br>
    <br>

    <div id="paypal-button-container-P-41X03904E8095424UMZZGVWY"></div>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AfSnYFNDsIv49_avn9dXOvrbmnCeX1--J9JKFbJjf7OF6lZV3fuHpG2ok4dZNS3zTKUomzLRDaBFYHu7&vault=true&intent=subscription"
        data-sdk-integration-source="button-factory"></script>
    <script>
        // Find which button select
        function handleClick(radioBtn) {
            productValue = radioBtn.value;
            console.log(productValue);
        }

        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'blue',
                layout: 'vertical',
                label: 'subscribe'
            },
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    /* Creates the subscription */
                    plan_id: 'P-41X03904E8095424UMZZGVWY'
                });
            },
            createOrder: function(data, actions) {
                return fetch('api/paypal/order/create', {
                    method: 'post',
                    body: JSON.stringify({
                        "value": productValue
                    })
                }).then(function(res){
                    return res.json();
                }).then(function(orderData){
                    return orderData.id;
                });
            },
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(
                            msg
                            ); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id +
                        '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container-P-41X03904E8095424UMZZGVWY'); // Renders the PayPal button
    </script>
</body>

</html>
