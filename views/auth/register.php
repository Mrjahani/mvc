<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
<form action="/register" method="post">
    <?=csrf_token() ?>
    <input type="text" name="username">
    <input type="password" name="password">
    <button type="submit">send</button>
</form>
</body>
</html>