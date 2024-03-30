<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Please click the link below to verify your email.</p>
    <a target="_gaurav" href="{{ route('news-letters-verification', $subscriber->verified_token) }}">click here</a>
</body>

</html>
