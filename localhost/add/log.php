<!doctype html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<form id="loginform" method="post">
    <div>
        Username:
        <input type="text" name="username" id="username" />
        <div id="loginF"></div>
        Password:
        <input type="password" name="password" id="password" />
        <div id="passF"></div>
        <input type="submit" name="loginBtn" id="loginBtn" value="Login" />
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#username').focusout(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'http://hookahstore/add/chekLogin.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    $('#loginF').html(response)
                }
            });
        });
    });

    $(document).ready(function() {
        $('#password').focusout(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'http://localhost/web/src/project/lab9/vadim/checPassword.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    $('#passF').html(response)
                }
            });
        });
    });

</script>
</body>
</html>