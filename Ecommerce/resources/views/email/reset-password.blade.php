<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
    <p>Hello, {{ $mailData['user']->name }}</p>
    <h1>You have requested to change password:</h1>
    <p>Click the link below to reset your password:</p>
   <a href="{{ route('front.resetpassword',$mailData['token']) }}">Click Here</a>
   <p>Thank you</p>
</body>
</html>