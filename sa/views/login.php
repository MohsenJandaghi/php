
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluffs - Ultimate Bootstrap Social Network UI Kit</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />

    <!-- ==============================================
		Favicons
		=============================================== -->
    <link rel="icon" href="/sa/view/assets/img/logo.html">
    <link rel="apple-touch-icon" href="iview/mg/favicons/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="/sa/view/img/favicons/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="/sa/view/img/favicons/apple-touch-icon-114x114.html">

    <!-- ==============================================
		CSS
		=============================================== -->
    <link type="text/css" href="/sa/view/assets/css/demos/photo.css" rel="stylesheet" />

</head>

<body>

    <!-- ==============================================
	 Header Section
	 =============================================== -->
    <section class="login">
        <div class="container">
            <div class="banner-content">
                <h1><i class="fa fa-smile"></i> P-Instagram</h1>
                <form method="post" onsubmit="login(event)" class="form-signin">
                    <h3 class="form-signin-heading">لطفا وارد شوید</h3>
                    <div class="form-group">
                        <input name="username" id="username" type="text" class="form-control" placeholder="نام کاربری یا تلفن همراه">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control" name="password" placeholder="رمز عبور">
                    </div>
                    <button class="kafe-btn kafe-btn-mint btn-block" >ورود</button>
                    <br/>
                    <a class="btn btn-dark " href="register.php" role="button">برای اولین بار وارد میشوید؟ ثبت نام کنید</a>
                    <a class="btn btn-dark " href="photo_register.html" role="button">رمز عبور خود را فراموش کرده اید؟</a>
                </form>
            </div>
            <!--/. banner-content -->
        </div>
        <!-- /.container -->
    </section>

    <!-- ==============================================
	 Scripts
	 =============================================== -->
    <script src="/sa/view/assets/js/jquery.min.js"></script>
    <script src="/sa/view/assets/js/bootstrap.min.js"></script>
    <script src="/sa/view/assets/js/base.js"></script>
    <script>
        function login(e)
        {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "http://localhost/sa/Controller/Login.php",
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function(result){
                    result = $.parseJSON(result);
                    if(result.status == 'success') {
                        window.location.href = result.url
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    </script>
</body>

</html>