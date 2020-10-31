<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="app/Views/css/RegisterStyle.css">
    <link rel="stylesheet" type="text/css" href="app/Views/css/MainPage.css">
    <title>Login</title>
</head>
<body>
<div class="header">
    <a href="/" class="logo">Articles</a>
    <div class="header-right">
        <a href="/">HOME</a>
        <a href="/articles/create">CREATE</a>
        <a href="/register">REGISTER</a>
        <a href="/login">LOGIN</a>
        <div id="indicator"></div>
    </div>
</div>
<form  action="/login/authorize" method="post">
    <div class="container">
        <h1>Login</h1>
        <p>Hello user, please login.</p>
        <hr>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="psw" required>

        <hr>

        <button type="submit" class="registerbtn">Login</button>
    </div>

</form>

</body>
</html>