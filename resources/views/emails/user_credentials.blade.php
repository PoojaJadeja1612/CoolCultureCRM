<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User Credentials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
        }

        .credentials {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #dddddd;
        }

        strong {
            color: #555555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Credentials</h2>
        <div class="credentials">
            <p>Your credentials:</p>
            <p><strong>Login here:</strong> {{ asset('customer/login') }}</p>
            <p><strong>User ID:</strong> {{ $userId }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>
    </div>
</body>

</html>
