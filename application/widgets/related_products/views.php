<?php
if (isset($posts) && count($posts) > 0)
    {
        ?>
            <div class="wow fadeInUp animated hidden-xs" data-wow-delay=".5s">
                <div class="title-feature-new col-lg-12 col-sm-12 col-xs-12">
                    <h2>Sản phẩm liên quan</h2>
                    <span></span>
                </div>
                <div class="related-products-info">
                    <?php
                    if (isset($posts) && count($posts))
                    {
                        $i = 0;
                        foreach ($posts as $product)
                        {
                          ?>
                            <div class="product-featured-gb col-lg-12 col-sm-12 col-xs-12">
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
                    ?>
                    <div class="clearfix"> </div>
                </div>
            </div>
        <?php
    }
?>
<div class="gallery gallery-product <?=isset($color)?$color:''?> wow fadeInUp animated visible-xs" data-wow-delay=".5s">
    <div style="padding: 0px" class="container">
        <div class='title-product'>
            <div style="padding: 0px" class="title-feature-new col-lg-9 col-sm-9 col-xs-8">
                <h2>Sản phẩm liên quan</h2>
                <span></span>
            </div>
            <div style ='padding: 0px;' class="col-lg-3 col-sm-3 col-xs-4">
                <!-- Controls -->
                <div class="controls pull-right visible-xs">
                    <a class="left glyphicon glyphicon-menu-left btn btn-danger" href="#carousel-example-mobi"
                       data-slide="prev"></a>
                    <a class="right glyphicon glyphicon-menu-right btn btn-danger" href="#carousel-example-mobi"
                       data-slide="next"></a>
                </div>
            </div>
        </div>
        <?php
        if (isset($posts) && count($posts) > 0)
        {
            ?>
            <div id="carousel-example-mobi" class="carousel carousel-gb slide visible-xs">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key <= 1)
                            {
                                ?>
                                <div style="padding: 2px" class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
                                    <div class="col-item">
                                        <div class="photo photo-product">
                                            <a href="/sp/<?=$post['alias']?>.html"> <img src="<?=$post['thumb']?>" class="img-responsive" alt="<?=$post['name']?>" /></a>
                                        </div>
                                        <div class="info">
                                            <div class="price col-lg-12">
                                                <h5 class="title-product-featured">
                                                    <a href="/sp/<?=$post['alias']?>.html"> <?=$post['name']?></a>
                                                </h5>
                                                <?php
                                                if ($post['fake_price'] >= 1)
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color">
                                                            <?=number_format($post['fake_price'])?><i> VND</i>
                                                        </h5>
                                                        <h5 class="price-text-color price-fack">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color price-text-color-gb">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <a onclick="addCart(<?=$post['id']?>)"  href="javascript:;" class="" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart-gb"></i> Mua ngay</a></p>
                                                <p class="btn-details">
                                                    <a href="/sp/<?=$post['alias']?>.html" class=""><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="item">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key > 1 && $key<=3)
                            {
                                ?>
                                <div  style="padding: 2px" class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
                                    <div class="col-item">
                                        <div class="photo photo-product">
                                            <a href="/sp/<?=$post['alias']?>.html"> <img src="<?=$post['thumb']?>" class="img-responsive" alt="<?=$post['name']?>" /></a>
                                        </div>
                                        <div class="info">
                                            <div class="price col-lg-12">
                                                <h5 class="title-product-featured">
                                                    <a href="/sp/<?=$post['alias']?>.html"> <?=$post['name']?></a>
                                                </h5>
                                                <?php
                                                if ($post['fake_price'] >= 1)
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color">
                                                            <?=number_format($post['fake_price'])?><i> VND</i>
                                                        </h5>
                                                        <h5 class="price-text-color price-fack">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color price-text-color-gb">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <a onclick="addCart(<?=$post['id']?>)"  href="javascript:;" class="" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart-gb"></i> Mua ngay</a></p>
                                                <p class="btn-details">
                                                    <a href="/sp/<?=$post['alias']?>.html" class=""><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="item">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key > 3 && $key<=5)
                            {
                                ?>
                                <div style="padding: 2px" class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
                                    <div class="col-item">
                                        <div class="photo photo-product">
                                            <a href="/sp/<?=$post['alias']?>.html"> <img src="<?=$post['thumb']?>" class="img-responsive" alt="<?=$post['name']?>" /></a>
                                        </div>
                                        <div class="info">
                                            <div class="price col-lg-12">
                                                <h5 class="title-product-featured">
                                                    <a href="/sp/<?=$post['alias']?>.html"> <?=$post['name']?></a>
                                                </h5>
                                                <?php
                                                if ($post['fake_price'] >= 1)
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color">
                                                            <?=number_format($post['fake_price'])?><i> VND</i>
                                                        </h5>
                                                        <h5 class="price-text-color price-fack">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color price-text-color-gb">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <a onclick="addCart(<?=$post['id']?>)"  href="javascript:;" class="" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart-gb"></i> Mua ngay</a></p>
                                                <p class="btn-details">
                                                    <a href="/sp/<?=$post['alias']?>.html" class=""><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="item">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key > 5)
                            {
                                ?>
                                <div style="padding: 2px" class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
                                    <div class="col-item">
                                        <div class="photo photo-product">
                                            <a href="/sp/<?=$post['alias']?>.html"> <img src="<?=$post['thumb']?>" class="img-responsive" alt="<?=$post['name']?>" /></a>
                                        </div>
                                        <div class="info">
                                            <div class="price col-lg-12">
                                                <h5 class="title-product-featured">
                                                    <a href="/sp/<?=$post['alias']?>.html"> <?=$post['name']?></a>
                                                </h5>
                                                <?php
                                                if ($post['fake_price'] >= 1)
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color">
                                                            <?=number_format($post['fake_price'])?><i> VND</i>
                                                        </h5>
                                                        <h5 class="price-text-color price-fack">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color price-text-color-gb">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <a onclick="addCart(<?=$post['id']?>)"  href="javascript:;" class="" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="glyphicon glyphicon-shopping-cart glyphicon-shopping-cart-gb"></i> Mua ngay</a></p>
                                                <p class="btn-details">
                                                    <a href="/sp/<?=$post['alias']?>.html" class=""><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>