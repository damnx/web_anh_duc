<link rel="stylesheet" href="<?=CDN?>/frontend/css/flexslider.css?vs=<?=time()?>" type="text/css" media="screen" />
<!--breadcrumbs-->
<?php
if (isset($post) && count($post) > 0)
{
    $left_ct = $post['left_ct'];
    $right_ct = $post['right_ct'];
}
else
{
    $left_ct  = 0;
    $right_ct = 0;
}
?>
<?=$this->load->widget('breadcrumbs',array($left_ct,$right_ct));?>
<!--//breadcrumbs-->
<!--products-->
<div class="products">
    <div class="container">
        <div style="padding: 0px" class="col-lg-9 col-sm-9 col-xs-12 product-model-sec wow fadeInUp animated" data-wow-delay=".5s">
            <?php
            if (isset($products)&& count($products) > 0)
            {
                foreach ($products as $product)
                {
                    ?>
<!--                    <div class="col-lg-4 col-sm-6 col-xs-6 product-grids-gb simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".5s">-->
<!--                        <div class="product-grids">-->
<!--                            <div class="new-top">-->
<!--                                <a href="sp/--><?//=$product['alias']?><!--.html"><img src="--><?//=getThumb($product['thumb'],250,200)?><!--" class="img-responsive" alt=""/></a>-->
<!--                            </div>-->
<!--                            <div class="new-bottom">-->
<!--                                <h5><a class="name" href="sp/--><?//=$product['alias']?><!--.html">--><?//=$product['name']?><!-- </a></h5>-->
<!--                                <div class="ofr">-->
<!--                                    --><?php
//                                    if ($product['fake_price'] >= 1)
//                                    {
//                                        echo '<p class="pric1 hidden-xs"><del>'.number_format($product['price']).'<i> vnđ</i></del></p>';
//                                        echo '<p><span class="item_price">'.number_format($product['fake_price']).'<i> vnđ</i></span></p>';
//                                    }
//                                    else
//                                    {
//                                        echo '<p><span class="item_price">'.number_format($product['price']).'<i> vnđ</i></span></p>';
//                                    }
//                                    ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="product-featured-gb col-lg-4 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
                        <div class="col-item">
                            <div class="photo photo-product">
                                <a href="/sp/<?=$product['alias']?>.html"> <img src="<?=$product['thumb']?>" class="img-responsive" alt="<?=$product['name']?>" /></a>
                            </div>
                            <div class="info">
                                <div class="price col-lg-12">
                                    <h5 class="title-product-featured">
                                        <a href="/sp/<?=$product['alias']?>.html"> <?=$product['name']?></a>
                                    </h5>
                                    <?php
                                    if ($product['fake_price'] >= 1)
                                    {
                                        ?>
                                        <div class="price-gb">
                                            <h5 class="price-text-color">
                                                <?=number_format($product['fake_price'])?><i> VND</i>
                                            </h5>
                                            <h5 class="price-text-color price-fack hidden-sm">
                                                <?=number_format($product['price'])?><i> VND</i>
                                            </h5>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="price-gb">
                                            <h5 class="price-text-color price-text-color-gb">
                                                <?=number_format($product['price'])?><i> VND</i>
                                            </h5>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <div class="separator clear-left">
                                    <p class="btn-add">
                                        <a onclick="addCart(<?=$product['id']?>)"  href="javascript:;" class="" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart-gb"></i> Mua ngay</a></p>
                                    <p class="btn-details">
                                        <a href="/sp/<?=$product['alias']?>.html" class=""><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a></p>
                                </div>
                                <div class="clearfix">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                <div class="col-lg-12 col-sm-12 col-xs-12 product-grids-gb simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".5s">
                    <div class="grid_3 grid_5 wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
                        <div class="alert alert-warning" role="alert">
                            <strong><span class="glyphicon glyphicon-alert"></span> ! </strong> Best check yo self, you're not looking too good.
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row text-center">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <?= isset($pagination) ? $pagination :''?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-12 rsidebar">
            <div class="rsidebar-top">
                <?=$this->load->widget('menu_products')?>
                <form id="attribute" class="attribute" method="get" action="">
                <?php
                    if (isset($attributes) && count($attributes) > 0)
                    {
                        foreach ($attributes as $attribute)
                        {
                            ?>
                                <div class="sidebar-row">
                                <h4 class="text-uppercase"><?=$attribute['name']?></h4>
                                <div class="row row1 scroll-pane">
                                    <?php
                                        if (isset($attribute['detail_attribute']) && count($attribute['detail_attribute']) > 0 )
                                        {
                                            foreach ($attribute['detail_attribute'] as $detail_attribute)
                                            {
                                                if (isset($checkbox) && count($checkbox)>0)
                                                    $checkbox = $checkbox;
                                                else
                                                {
                                                    $checkbox = array();
                                                }
                                                if (in_array($detail_attribute['id'],$checkbox))
                                                {
                                                    $checked = 'checked';
                                                }

                                                else
                                                {
                                                    $checked =  NULL;
                                                }

                                                ?>
                                                    <label class="checkbox"><input type="checkbox" <?=$checked?> value="<?=$detail_attribute['id']?>" name="checkbox[]"><i></i><?=$detail_attribute['name']?></label>
                                                <?php
                                            }
                                        }
                                    ?>

                                </div>
                            </div>
                            <?php
                        }

                    }
                ?>
                </form>
<!--                <div class="sidebar-row">-->
<!--                    <h4>Color</h4>-->
<!--                    <div class="row row1 scroll-pane">-->
<!--                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>White</label>-->
<!--                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Pink</label>-->
<!--                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Gold</label>-->
<!--                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Silver</label>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
<!--            <div class="gallery-grid ">-->
<!--                <h6>YOU MAY ALSO LIKE</h6>-->
<!--                <a href="single.html"><img src="images/b1.png" class="img-responsive" alt=""/></a>-->
<!--                <div class="gallery-text simpleCart_shelfItem">-->
<!--                    <h5><a class="name" href="single.html">Full Sleeves Romper</a></h5>-->
<!--                    <p><span class="item_price">60$</span></p>-->
<!--                    <h4 class="sizes">Sizes: <a href="#"> s</a> - <a href="#">m</a> - <a href="#">l</a> - <a href="#">xl</a> </h4>-->
<!--                    <ul>-->
<!--                        <li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li>-->
<!--                        <li><a class="item_add" href="#"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>-->
<!--                        <li><a href="#"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>
<!--//products-->
<!-- the jScrollPane script -->
<script type="text/javascript" src="<?=CDN?>/frontend/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" id="sourcecode">
    $(function()
    {
        $('.scroll-pane').jScrollPane();
    });
    $(document).ready(function(){
        $("#attribute").on("change", "input:checkbox", function(){
            $("#attribute").submit();
        });
    });
</script>
<!-- //the jScrollPane script -->
<script type="text/javascript" src="<?=CDN?>/frontend/js/jquery.mousewheel.js"></script>
<!-- the mousewheel plugin -->