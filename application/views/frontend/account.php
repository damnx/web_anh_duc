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
        <div style="padding:0px 5px" class="col-lg-4 col-sm-4 col-xs-12 widget-sidebar-gb wow fadeInDown animated animated">
            <div class="well well-sm well-sm-gb ">
                <div style="" class="col-lg-6 col-sm-6 col-xs-12 hidden-xs">
                    <img src="<?=CDN?>/frontend/images/use.png" alt="" class="img-rounded img-responsive" />
                </div>
                <div  style="padding: 0px 5px" class="col-lg-6 col-sm-6 col-xs-12">
                    <h4 style="color: #ff0000; text-transform: uppercase;padding-bottom: 10px"><?=isset($use['full_name'])?$use['full_name']:'GB'?></h4>
                    <p style="padding: 2px 0px" >
                        <i class="glyphicon glyphicon-envelope"></i> <?=isset($use['email'])?$use['email']:'GB'?>
                    </p>
                    <p style="padding: 2px 0px">
                        <i class="glyphicon glyphicon-phone"></i> <?=isset($use['phome'])?$use['phome']:'GB'?>
                    </p>

                    <p style="padding: 2px 0px">
                        <i style="color: #ff0000" class="glyphicon glyphicon-heart"></i> <?=isset($use['money'])?number_format((int)$use['money']).' VND':'GB'?>
                    </p>
                    <p style="padding: 2px 0px">
                        <i class="glyphicon glyphicon-user"></i><a href="/tai-khoan/doi-mat-khau.html"> Thay đổi Mật khẩu</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="padding: 0px 5px" class="col-lg-8 col-sm-8 col-xs-12 wow fadeInDown animated animated">
            <div class="well well-sm well-sm-gb">
                <h4>SẢN PHẨM CỦA BẠN</h4>
                <hr>
                <p></p>
                <div  class="table-sp  bs-docs-example wow fadeInDown animated animated" data-wow-delay=".5s">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Link Download / Tài Khoản</th>
                            <th>Mật Khẩu</th>
                            <th>Thời Gian</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($orders) && count($orders) > 0)
                            {
                                $i =0;
                                foreach($orders as $order)
                                {
                                    $i++;
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$order['product']['name']?></td>
                                            <td><?=number_format($order['price'])?> VND</td>
                                            <td><a href="<?=$order['product']['link_dowload']?>"><?= cutOf($order['product']['link_dowload'],1)?></a></td>
                                            <td><?=$order['product']['password']?></td>
                                            <td><?=showDate($order['published'])?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>

                        </tbody>
                    </table>
                    <?= isset($pagination) ? $pagination :''?>
                </div>
            </div>
            <div class="well well-sm well-sm-gb">
                <h4>LỊCH SỬ NẠP THẺ</h4>
                <hr>
                <p>5 mã nạp thẻ gần đây</p>
                <div class="table-napthe bs-docs-example wow fadeInDown animated animated" data-wow-delay=".5s">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Số Seri</th>
                            <th>Nhà Mạng</th>
                            <th>Mệnh Giá</th>
                            <th>Thời Gian</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($carts) && count($carts) > 0)
                            {
                                $j = 0;
                                foreach($carts as $cart)
                                {
                                    $j++;
                                    ?>
                                    <tr>
                                        <td><?=$j?></td>
                                        <td><?=$cart['seri']?></td>
                                        <td><?=$cart['type']?></td>
                                        <td><?=number_format($cart['denominations'])?></td>
                                        <td><?=showDate($cart['published'])?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<!--//new-->