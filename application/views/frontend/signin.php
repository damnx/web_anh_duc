<!--breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Đăng nhập</li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--login-->
<div class="login-page">
    <div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
        <h3 class="title">Đăng nhập<span></span></h3>
    </div>
    <div class="widget-shadow">
        <div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
            <h4>Chào mừng bạn đến Linh Chi's ! <br>Không phải là thành viên? <a href="/dang-ky.html"> Đăng ký ngay bây giờ »</a> </h4>
        </div>
        <div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
            <?php
            if (isset($return))
            {
                ?>
                <div style="padding: 0" class="col-lg-12">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning! </strong> <?=$return['text']?>
                    </div>
                </div>
                <?php
            }
            ?>
            <form method="post" action="">
                <input type="text" class="user" value="<?=set_value('username')?>" id="username" name="username" placeholder="Tài khoản" required="">
                <?php echo form_error('username', '<label class="error">', '</label>'); ?>
                <input type="password" name="password" class="lock" value="<?=set_value('password')?>"  placeholder="Mật khẩu">
                <?php echo form_error('password', '<label class="error">', '</label>'); ?>
               <div class="recaptcha-gb" style="">
                   <?php echo $this->recaptcha->render(); ?>
               </div>
                <input type="submit" class="dang-nhap" name="signin" value="Đăng nhập">
                <div class="forgot-grid">
                    <div class="forgot">
<!--                        <a href="#">Quên mật khẩu ?</a>-->
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </form>
        </div>
    </div>
    <div class="login-page-bottom">
        <h5> - OR -</h5>
        <div class="social-btn"><a href="#"><i>Đăng nhập Facebook</i></a></div>
        <div style="background: #db4437" class="social-btn sb-two"><a href="#"><i>Đăng nhập Google</i></a></div>
    </div>
</div>
<!--//login-->