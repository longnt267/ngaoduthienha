<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="{{ asset('css/client/thank/thank.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">

</head>

<body>
    <div class="thankyou">
        <div class="wrap-content">
            <strong>THANK YOU!</strong>
            <p>Your order has been successfully ordered.</p>
            <p>Order information has been emailed to you. Thank you!</p>
            <a href="{{ route('home') }}">Back to our home</a>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
