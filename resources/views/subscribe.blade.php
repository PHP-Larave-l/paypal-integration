<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Subscription Plan</title>
</head>

<body>
    <h1>Select Your Subscription Plan</h1>
    <form action="{{ route('create-subscription') }}" method="POST">
        @csrf
        <div>
            <label>
                <input type="radio" name="plan" value="{{ env('PAYPAL_BASIC_PLAN_ID') }}" data-name="Basic Plan"
                    data-price="10" required>
                Basic Plan - $10/month
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="plan" value="{{ env('PAYPAL_PREMIUM_PLAN_ID') }}"
                    data-name="Premium Plan" data-price="15" required>
                Premium Plan - $15/month
            </label>
        </div>
        <input type="hidden" name="plan_name" id="plan_name">
        <input type="hidden" name="price" id="price">
        <button type="submit">Subscribe</button>
    </form>

    {{-- <script>
        // Update hidden inputs based on selected plan
        document.querySelectorAll('input[name="plan"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('plan_name').value = this.dataset.name;
                document.getElementById('price').value = this.dataset.price;
                console.log("Plan Name:", this.dataset.name, "Price:", this.dataset.price);
            });
        });
    </script> --}}

</body>

</html>
