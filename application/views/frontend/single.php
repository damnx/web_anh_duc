<!--breadcrumbs-->
<link href="<?=CDN?>/frontend/css/style.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <?php
            if (isset($categorys) && count($categorys) >0)
            {
                foreach ($categorys as $category)
                {
                    ?>
                    <li><a href="/<?=$category['alias']?>.html"><?=$category['name']?></a></li>
                    <?php
                }
            }
            ?>
            <li class="active"><?=cutOf($product['name'],25,false)?></li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--single-page-->

<div class="single single-gb">
    <div class="container">
        <div class="title_sanpham">
            <div class="title-feature-new col-lg-9 col-sm-9 col-xs-12">
                <h2><?=$product['name']?></h2>
            </div>
            <div style="padding: 0px 2px"class="col-lg-3 col-sm-3 col-xs-12  facebook_like_she">
                <div class="fb-like" data-href="<?=URL?>/sp/<?=$product['alias']?>.html" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
        <div style="padding: 0px 2px" class="col-lg-9 col-sm-9 col-xs-12  ">
            <div style="padding: 0px" class="col-lg-7 col-sm-7 col-xs-12">
                <div class="product-img">
                    <div class="product-img__main">
                        <a href="">
                            <img src="<?=$product['thumb']?>" alt="">
                        </a>
                    </div>
                    <div class="product-img__thumb">
                        <?php
                        if (isset($product['practical_photo']) && $product['practical_photo'] !=null)
                        {
                            $practical_photo = explode('|', trim($product['practical_photo']));
                            if (count($practical_photo) <= 4)
                            {
                                $count = count($practical_photo);
                            }
                            else
                            {
                                $count = 4;
                            }
                            for ($i = 0; $i < $count; $i++)
                            {
                                if ($i<=4)
                                {
                                    ?>
                                    <a href="" class="product-img__item">
                                        <img src="<?=$practical_photo[$i]?>" alt="">
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                            <a href="" class="product-img__item">
                                <img src="<?=$product['thumb']?>" alt="">
                                <span class="product-img__cap">Xem <span><?=count($practical_photo)?></span> hình</span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="model-fullscr">
                    <div class="model-fullscr-content">
                        <div class="main-slider">

                            <?php
                            if (isset($product['practical_photo']) && $product['practical_photo'] !=null)
                            {
                                $practical_photo = explode('|', trim($product['practical_photo']));
                                for ($i = 0; $i <  count($practical_photo); $i++)
                                {
                                    ?>
                                    <div class="main-slider__item">
                                        <img src="<?=$practical_photo[$i]?>" alt="">
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <div class="main-slider__item">
                                    <img src="<?=$product['thumb']?>" alt="">
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="thumb-img">

                            <?php
                            if (isset($product['practical_photo']) && $product['practical_photo'] !=null)
                            {
                                $practical_photo = explode('|', trim($product['practical_photo']));
                                for ($i = 0; $i <  count($practical_photo); $i++)
                                {
                                    ?>
                                    <a href="" class="thumb-img__item">
                                        <img src="<?=$practical_photo[$i]?>" alt="">
                                    </a>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <a href="" class="thumb-img__item">
                                    <img src="<?=$product['thumb']?>" alt="">
                                </a>
                                <?php
                            }
                            ?>

                        </div>

                        <div class="count-item">
                            Hình <span class="item-current">8</span> / <span class="sum-item">9</span>
                        </div>

                        <a href="javascript:;" class="exit-modal">
                            <i class="icon-exit"></i>
                            <span>Đóng</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-5 col-xs-12">
                <?php
                if ($product['fake_price'] >= 1)
                {
                    ?>
                        <div class="area_price"><p>Giá </p>: <b><?=number_format($product['fake_price'])?> vnđ</b></div>
                        <div class="area_price"><i><?=number_format($product['price'])?> vnđ</i></div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="area_price"><p>Giá </p>: <b><?=number_format($product['price'])?> vnđ</b></div>
                    <?php
                }
                ?>
                <div class="mota-sp">
                  <?=$product['describe']?>
                </div>
                <div class="single-top-left">
                    <?php
                    if (isset($attributes) && count($attributes) > 0)
                    {
                        foreach ($attributes as $attribute)
                        {
                            ?>
                            <ul class="size">
                                <h4><?=$attribute['name']?></h4>
                                <?php
                                if (isset($attribute['detail_attribute']) && count($attribute['detail_attribute']) > 0)
                                {
                                    foreach ($attribute['detail_attribute'] as $detail_attribute)
                                    {
                                        echo '<li><a href="javascript:;">'.$detail_attribute['name'].'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="single-info">
                    <div class="quantity">
                        <p class="qty"> Qty :  </p><input min="1" id="qty" name="qty" type="number" value="1" class="item_quantity">
                    </div>
                    <div class="btn_form">
                        <a href="#" onclick="addCart(<?=$product['id']?>)" data-toggle="modal" data-target=".bs-example-modal-lg" class="add-cart item_add">Mua ngay</a>
                        <a href="/" class="product-howToBuy" target="_blank">
                            <i class="icn-howtobuy"></i><span class="txt-howtobuy">Hướng dẫn <br> mua hàng</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12 container-container-gb single-gb-left">
                <?=$product['content']?>
            </div>
        </div>
        <div style="padding: 0px" class="col-lg-3 col-sm-3 col-xs-12 single-gb-right">
            <?php
            if (isset($categorys) && count($categorys) >0)
            {
                $categorys = array_pop($categorys);
            }
            ?>
            <?= $this->load->widget('related_products',array('cid' => $categorys['foreign_key'],'id_pr'=>$product['id'])); ?>
        </div>
    </div>
</div>
<div class="modal slishow-gb" id="popup" style="display: none;">
    <span class="colse-gb"  data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span>
    <div class="slider-image-gb">
        <div class="slider slider-for">
            <div>
                <img class="img-responsive img__slishow" src="<?=$product['thumb']?>">
            </div>
            <?php
            if (isset($product['practical_photo']) && $product['practical_photo'] !=null)
            {
                $practical_photo = explode('|', trim($product['practical_photo']));
                for ($i = 0; $i < count($practical_photo); $i++)
                {
                    ?>
                    <div>
                        <img class="img-responsive img__slishow" src="<?=$practical_photo[$i]?>">
                    </div>
                    <?php
                }
            }
            ?>


        </div>
        <ul class="slider slider-nav">
            <li>
                <div>
                    <img  class="img-responsive img-slishow" src="<?=$product['thumb']?>">
                </div>
            </li>
            <?php
            if (isset($product['practical_photo']) && $product['practical_photo'] !=null)
            {
                $practical_photo = explode('|', trim($product['practical_photo']));
                for ($i = 0; $i < count($practical_photo); $i++)
                {
                    ?>
                    <li>
                        <div>
                            <img  class="img-responsive img-slishow" src="<?=$practical_photo[$i]?>">
                        </div>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div>
</div>
<!---->
<!--<script type="text/javascript" src="--><?//=CDN?><!--/frontend/js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?=CDN?>/frontend/js/slick.min.js"></script>
<script type="text/javascript" src="<?=CDN?>/frontend/js/script.js"></script>