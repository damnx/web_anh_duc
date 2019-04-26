<div class="gallery gallery-product <?=isset($color)?$color:''?> wow fadeInUp animated" data-wow-delay=".5s">
    <div class="container">
        <div class='title-product'>
            <div class="title-feature-new col-lg-9 col-sm-9 col-xs-8">
                <h2><?=isset($title)?$title:''?></h2>
                <span></span>
            </div>
            <div style ='padding: 0px;' class="col-lg-3 col-sm-3 col-xs-4">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left glyphicon glyphicon-menu-left btn btn-danger" href="#carousel-example<?=$cid?>"
                       data-slide="prev"></a>
                    <a class="right glyphicon glyphicon-menu-right btn btn-danger" href="#carousel-example<?=$cid?>"
                       data-slide="next"></a>
                </div>
                <div class="controls pull-right visible-xs">
                    <a class="left glyphicon glyphicon-menu-left btn btn-danger" href="#carousel-example-mobi<?=$cid?>"
                       data-slide="prev"></a>
                    <a class="right glyphicon glyphicon-menu-right btn btn-danger" href="#carousel-example-mobi<?=$cid?>"
                       data-slide="next"></a>
                </div>
            </div>
        </div>
        <?php
        if (isset($posts) && count($posts) > 0)
        {
            ?>
            <div id="carousel-example<?=$cid?>" class="carousel carousel-gb slide hidden-xs">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key>=0 && $key<=3)
                            {
                                ?>
                                <div class="product-featured-gb col-sm-3 wow fadeInUp animated" data-wow-delay=".5s">
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
                                                        <ul></ul>
                                                        <h5 class="price-text-color">
                                                            <?=number_format($post['fake_price'])?><i> VND</i>
                                                        </h5>
                                                        <h5 class="price-text-color price-fack hidden-sm">
                                                            <?=number_format($post['price'])?><i> VND</i>
                                                        </h5>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="price-gb">
                                                        <h5 class="price-text-color price-text-color-gb ">
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
                                            <div class="clearfix">
                                            </div>
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
                            if ($key>3)
                            {
                                ?>
                                <div class="product-featured-gb col-sm-3 wow fadeInUp animated" data-wow-delay=".5s">
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
                                                        <h5 class="price-text-color price-fack hidden-sm">
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
            <div id="carousel-example-mobi<?=$cid?>" class="carousel carousel-gb slide visible-xs">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key <= 1)
                            {
                                ?>
                                <div class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
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
                                <div class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
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
                                <div class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
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
                                <div class="product-featured-gb col-lg-6 col-sm-6 col-xs-6 wow fadeInUp animated" data-wow-delay=".5s">
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