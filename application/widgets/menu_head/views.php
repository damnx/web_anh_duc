<nav class="navbar navbar-default" style="border: none">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand navbar-brand-gb " href="/">Linh Chi's  <b class="shop-gb">Shop</b><span class="tag"> </span> </a>
    </div>
    <div style="padding: 0px" class="collapse navbar-collapse js-navbar-collapse">
        <ul class="nav navbar-nav navbar-nav-gb">
            <?php
                if (isset($menus) && count($menus) )
                {
                    foreach ($menus as $menu)
                    {
                        if (isset($menu['mci']) && count($menu['mci']) > 0)
                        {
                            if ($menu['product_posts'] == 'product')
                            {
                                $title = 'Sản phẩm mới';
                            }
                            elseif ($menu['product_posts']=='posts')
                            {
                                $title = 'Tin mới nhất';
                            }
                            ?>
                            <li class="dropdown mega-dropdown">
                                <a href="/" class="dropdown-toggle" data-toggle="dropdown"><?=$menu['name']?> <span class="glyphicon glyphicon-chevron-down pull-right pull-right-gb"></span></a>
                                <ul class="dropdown-menu mega-dropdown-menu row">
                                    <?php
                                    if (isset($menu['product'] )&& count($menu['product']))
                                    {
                                        $class = 'col-sm-3';
                                        ?>
                                            <li class="col-sm-3">
                                                <ul>
                                                    <li class="dropdown-header"><?=$title?></li>
                                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <?php
                                                            foreach ($menu['product'] as $key =>$product )
                                                            {
                                                                if ($key == 0)
                                                                {
                                                                    $active = 'active';
                                                                }
                                                                else
                                                                {
                                                                    $active = NULL;
                                                                }
                                                                if ($menu['product_posts'] == 'product')
                                                                {
                                                                    ?>
                                                                    <div class="item <?=$active?>">
                                                                        <div class="div-img-menu">
                                                                            <a href="/sp/<?=$product['alias']?>.html">
                                                                                <img src="<?=getThumb($product['thumb'],254,150)?>" class="img-responsive" alt="<?=$product['name']?>">
                                                                            </a>
                                                                        </div>
                                                                        <h4><small><?=$product['name']?></small></h4>
                                                                        <?php
                                                                        if ($product['fake_price'] >= 1)
                                                                            $money = number_format($product['fake_price']);
                                                                        else
                                                                            $money = number_format($product['price']);
                                                                        ?>
                                                                        <button class="btn btn-primary" type="button"><?=$money?> <i>vnđ</i></button>
                                                                        <a onclick="addCart(<?=$product['id']?>)"  data-toggle="modal" data-target=".bs-example-modal-lg" href="#" class="btn btn-default" ><span class="glyphicon glyphicon-heart"></span> Add to cart</a>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                elseif ($menu['product_posts'] == 'posts')
                                                                {
                                                                    ?>
                                                                    <div class="item <?=$active?>">
                                                                        <div class="div-img-menu">
                                                                            <a href="/tin-tuc/<?=$product['alias']?>.html"><img src="<?=getThumb($product['thumb'],254,150)?>" class="img-responsive " alt="<?=$product['title']?>"></a>
                                                                        </div>
                                                                        <h4><small><?=cutOf($product['title'],30,false)?></small></h4>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <!-- End Carousel Inner -->
                                                    </div>
                                                    <!-- /.carousel -->
                                                    <li class="divider"></li>
                                                    <li><a href="/<?=$menu['alias']?>.html">View all <?=$menu['name']?> <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
                                                </ul>
                                            </li>
                                        <?php
                                    }
                                    else
                                    {
                                        $class = 'col-sm-12';
                                    }
                                    ?>
                                    <li class="<?=$class?>">
                                        <ul>
                                            <?php
                                            if (isset($menu['mci']) && count($menu['mci']))
                                            {
                                                foreach ($menu['mci'] as $mci)
                                                {
                                                    if (isset($mci['cid']) && count($mci['cid']) > 0)
                                                        $link = '/'.$mci['alias'].'.html';
                                                    else
                                                        $link = $mci['link'];
                                                    ?>
                                                    <li class="dropdown-header"><a href="<?=$link?>"><?=$mci['name']?></a></li>
                                                    <?php
                                                    if (isset($mci['mciii']) && count($mci['mciii']))
                                                    {

                                                        foreach ($mci['mciii'] as $mcii)
                                                        {
                                                            if ($mcii['type'] =='category')
                                                                $link = '/'.$mcii['alias'].'.html';
                                                            else
                                                                $link = $mcii['link'];
                                                            ?>
                                                            <li><a href="<?=$link?>"><?=$mcii['name']?></a></li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>

                            </li>
                            <?php
                        }
                        else
                        {
                            if ($menu['type'] == 'category')
                            {
                                $link = '/'.$menu['alias'].'.html';
                            }
                            else
                            {
                                $link = $menu['link'];
                            }
                            ?>
                            <li class="dropdown mega-dropdown">
                                <a href="<?=$link?>" class="dropdown-toggle"><?=$menu['name']?></a>
                            </li>
                            <?php
                        }
                    }
                }
            ?>

        </ul>

    </div>
</nav>