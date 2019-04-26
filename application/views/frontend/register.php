<!--breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Register</li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--login-->
<div class="login-page">
    <div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
        <h3 class="title">Đang ký<span></span></h3>
    </div>
    <div class="widget-shadow">
        <div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
            <h4>Bạn có sẵn một tài khoản ?<a href="/dang-nhap.html">  Đăng nhập »</a> </h4>
        </div>
        <div class="login-body">
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
            <form method="post" class="wow fadeInUp animated" id="register" name="register" data-wow-delay=".7s">
                <input type="text" class="email" name="email" id="email" value="<?=set_value('email')?>" placeholder="Địa chỉ eamil" required="">
                <?php echo form_error('email', '<label class="error">', '</label>'); ?>
                <input type="text" class="" name="username" id="username" value="<?=set_value('username')?>" placeholder="Tài khoản" required="">
                <?php echo form_error('username', '<label class="error">', '</label>'); ?>
                <input type="password" name="password" id="password" class="lock" value="<?=set_value('password')?>"  placeholder="Mật khẩu" required="">
                <?php echo form_error('password', '<label class="error">', '</label>'); ?>
                <input type="password" name="passconf" id="passconf" class="lock" value="<?=set_value('passconf')?>" placeholder="Nhập lại mật khẩu" required="">
                <?php echo form_error('passconf', '<label class="error">', '</label>'); ?>
                <input type="text"  placeholder="Họ tên đầy đủ" name="full_name" value="<?=set_value('full_name')?>" id="name">
                <input type="text" placeholder="Số điện thoại" name="phome" value="<?=set_value('phome')?>" id="phome" >
                <?php echo form_error('phome', '<label class="error">', '</label>'); ?>
                <div class="recaptcha-gb" style="">
                    <?php echo $this->recaptcha->render(); ?>
                </div>
                <input type="button" id="registers" onclick="validateForm()" name="register" value="Đăng ký">
            </form>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        document.getElementById("register").submit();
        return true
    }
</script>