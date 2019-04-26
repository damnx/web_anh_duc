<!--
	Author: Nguyễn Đạm
	Author URL: https://www.facebook.com/DamNguyenXuan
	Date : 28/6/2017
-->

<!DOCTYPE html>
<html>

<head>
    <title>Manager Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="keywords">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="<?=CDN?>/backend/css/popuo-box.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=CDN?>/backend/css/login-style.css?vs=<?=time()?>" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
</head>
<body>

<h1>CMC BÉO DEVELOPERS</h1>
<div class="w3layoutscontaineragileits">
    <h2>Login here</h2>
    <form action="" method="post">
        <input type="text" name="username" value="<?=htmlspecialchars(set_value('username'))?>" placeholder="USERNAME" required="">
        <?= form_error('username', '<label style="float: left;padding-bottom: 15px; color: red;padding-left: 35px">', '</label>'); ?>
        <input type="password" name="password" value="<?=htmlspecialchars(set_value('password'))?>" placeholder="PASSWORD" required="">
        <?= form_error('password', '<label style="float: left;padding-bottom: 15px; color: red;padding-left: 35px">', '</label>'); ?>
        <ul class="agileinfotickwthree">
            <li>
                <input type="checkbox" id="brand1" name="remember" value="">
                <label for="brand1"><span></span>Remember me</label>
                <a href="#">Forgot password?</a>
            </li>
        </ul>
        <div class="aitssendbuttonw3ls">
            <input type="submit" name="login" value="LOGIN">
            <div class="clear"></div>
        </div>
    </form>
</div>
<div class="w3footeragile">
    <p> &copy; <?=date('Y')?> Existing Login Form. All Rights Reserved | Design by <a href="https://www.facebook.com/DamNguyenXuan" target="_blank">Béo developers</a></p>
</div>
<script type="text/javascript" src="<?=CDN?>/backend/js/login/jquery-2.1.4.min.js?vs=<?=time()?>"></script>
</body>
<!-- //Body -->

</html>