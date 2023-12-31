<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $mailData['title'] }}</h1>
        <p>Thank you for choosing our platform! To activate your account and unlock the full range of features, please verify your email address by clicking the link below:</p>

        <p>{{ $mailData['link'] }}</p>
            
        <p>If you did not create an account with us, please ignore this email. Your account will remain inactive until verified.</p>
            
        <h5>Thank you for joining our community!</h5>
            
        <h5>Best regards,</h5>
        <p>VirtualCareerExpo</p>
        
    </div>
</body>
</html>
