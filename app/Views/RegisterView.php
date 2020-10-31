<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="app/Views/css/RegisterStyle.css">
    <link rel="stylesheet" type="text/css" href="app/Views/css/MainPage.css">
    <title>Register</title>
    <script>
        function validate(){
            let a = document.getElementById("password").value;
            let b = document.getElementById("password-repeat").value;
            if (a!==b) {
                alert("Passwords do no match");
                return false;
            }
        }
    </script>
</head>
<body>
<div class="header">
    <a href="/" class="logo">Articles</a>
    <div class="header-right">
        <a href="/">HOME</a>
        <a href="/articles/create">CREATE</a>
        <div id="indicator"></div>
    </div>
</div>
<form onSubmit="return validate()" action="/register/store" method="post">

    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" id="name" required>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="psw" required>

        <label for="password-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" id="psw-repeat" required>

        <?php if(!isset($vars)) : ?>
        <label for="reffer"><b>Add refferal link</b></label>
        <input type="text" placeholder="reffer" name="reffer" id="reffer">
        <?php else : ?>
            <label for="reffer"><b>Add refferal link</b></label>
            <input type="text" placeholder="reffer" name="reffer" id="reffer" value="<?=$vars['reffer'];?>"required>
        <?php endif ; ?>
        <hr>
        <button type="submit" class="registerbtn">Register</button>
    </div>
</form>
</form>
</body>
</html>