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
        <h3 class="title">Nạp thẻ<span> Linh Chi's</span></h3>
    </div>
    <div class="widget-shadow">
        <div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
            <?php
            if (isset($return))
            {
                ?>
                <div style="padding: 0px" class="col-lg-12">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning! </strong> <?=$return['text']?>
                    </div>
                </div>
                <?php
            }
            ?>
            <form method="post" action="">
                <input type="text" class="user" value="<?=set_value('code')?>" id="code" name="code" placeholder="Mã thẻ" required="">
                <?php echo form_error('username', '<label class="error">', '</label>'); ?>
                <input type="text" name="seri" class="lock" value="<?=set_value('seri')?>"  placeholder="Số seri">
                <?php echo form_error('password', '<label class="error">', '</label>'); ?>
                <select class="form-control" name="type" id="type">
                    <option value="0">Chọn loại thẻ</option>
                    <option value="VTT">Thẻ Vietel</option>
                    <option value="VMS">Thẻ Mobifone</option>
                    <option value="VNP">Thẻ Vinaphone</option>
                    <option value="MGC">Thẻ Megacard</option>
                    <option value="FPT">Thẻ Gate</option>
                    <option value="ZING">Thẻ ZING</option>
                    <option value="ONC">Thẻ Oncash</option>
                </select>
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
</div>
<!--//login-->