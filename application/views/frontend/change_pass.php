<?php
if ($use['email'])
{
    $email = explode('@',$use['email']);
    $strlen = strlen($email[0]);
    if ($strlen > 3)
    {
        $strlen = strlen($email[0]) - 3 ;
        $name_eamil = substr($email[0], 0, - $strlen) .'......';
        $email = $name_eamil.'@'.$email[1];
    }
    else
    {
        $name_eamil = $email[0].'......';
        $email = $name_eamil.'@'.$email[1];
    }
}
?>

<link href="<?=CDN?>/frontend/css/posts.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
<!--breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Quản lý tài khoản</li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--new-->
<div class="container">
    <div class="container-post">
        <div style="padding:0px 5px;" class="col-lg-4 col-sm-4 col-xs-12 widget-sidebar-gb wow fadeInDown animated animated">
            <div class="well well-sm well-sm-gb " style="min-height: 329.5px;">
                <div style="" class="col-lg-6 col-sm-6 col-xs-12 hidden-xs">
                    <img src="<?=CDN?>/frontend/images/use.png" alt="" class="img-rounded img-responsive" />
                </div>
                <div  style="padding: 0px 5px" class="col-lg-6 col-sm-6 col-xs-12">
                    <h4 style="color: #ff0000; text-transform: uppercase;padding-bottom: 10px"><?=isset($use['full_name'])?$use['full_name']:'GB'?></h4>
                    <p style="padding: 2px 0px" >
                        <i class="glyphicon glyphicon-envelope"></i> <?=isset($email)?$email:'GB'?>
                    </p>
                    <p style="padding: 2px 0px">
                        <i class="glyphicon glyphicon-phone"></i> <?=isset($use['phome'])?$use['phome']:'GB'?>
                    </p>

                    <p style="padding: 2px 0px">
                        <i style="color: #ff0000" class="glyphicon glyphicon-heart"></i> <?=isset($use['money'])?number_format($use['money']).' VND':'GB'?>
                    </p>
                    <p style="padding: 2px 0px">
                        <i class="glyphicon glyphicon-user"></i><a href="/tai-khoan/doi-mat-khau.html"> Thay đổi Mật khẩu</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="padding: 0px 5px" class="col-lg-8 col-sm-8 col-xs-12 wow fadeInDown animated animated">
            <div class="well well-sm well-sm-gb">
                <h4>ĐỔI MẬT KHẨU</h4>
                <hr>
                <p></p>
                <div  class="bs-docs-example wow fadeInDown animated animated" data-wow-delay=".5s">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-sm-12">
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

                               <div class="form-group">
                                   <input class="form-control" placeholder="E-mail" name="email" value="<?=set_value('email')?>" type="text">
                                   <?php echo form_error('email', '<label class="error">', '</label>'); ?>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Mật khẩu mới" name="password" type="password" value="<?=set_value('password')?>">
                                   <?php echo form_error('password', '<label class="error">', '</label>'); ?>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Nhập lại mật khẩu mới" name="passconf" type="password" value="<?=set_value('passconf')?>">
                                   <?php echo form_error('passconf', '<label class="error">', '</label>'); ?>
                               </div>
                               <div class="recaptcha-gb" style="">
                                   <?php echo $this->recaptcha->render(); ?>
                               </div>
                               <div class="form-group">
                                   <input type="submit" value="Đổi mât khẩu" class="btn btn-info btn-block">
                               </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</script>
<!--//new-->