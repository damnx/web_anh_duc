<?php
    if (isset($posts) && count($posts) > 0 )
    {
        ?>
        <div class="gallery gallery-news wow fadeInUp animated" data-wow-delay=".5s">
            <div class="container">
                <div class="title-feature-new col-lg-12 col-sm-12 col-xs-12">
                        <h2>Tin tức nổi bật</h2>
                        <span></span>
                </div>
				<?php
                    foreach ($posts as $key => $post)
                    {
                        if ($key == 0)
                        {
                            ?>
                            <div class="gallery-news-1 col-lg-6 col-sm-6 col-xs-12 hidden-xs">
                                <div class="info-feature-new">
                                    <span class="cate"><a href="/<?=isset($post['category']['alias'])?$post['category']['alias']:''?>.html"><?=isset($post['category']['name'])?$post['category']['name']:''?></a></span>
                                    <h3>
                                        <a href="/tin-tuc/<?=$post['alias']?>.html"><?=cutOf($post['title'],100,false)?>”</a>
                                    </h3>
                                </div>
                                <a title="<?=$post['title']?>" href="/tin-tuc/<?=$post['alias']?>.html">
                                    <img class="img-responsive"  src="<?=getThumb($post['thumb'])?>">
                                </a>
                            </div>
                            <?php
                        }
                    }
                ?>
                    <div style="" class="gallery-news-2 col-lg-6 col-sm-6 col-xs-12 hidden-xs">
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key == 1)
                            {
                                ?>
                                <div class="gallery-news-2-1 gallery-news-2-1-bottom col-lg-12 col-sm-12 col-xs-12">
                                    <div class="info-feature-new">
                                        <span class="cate"><a href="/<?=isset($post['category']['alias'])?$post['category']['alias']:''?>.html"><?=isset($post['category']['name'])?$post['category']['name']:''?></a></span>
                                        <h3>
                                            <a href="/tin-tuc/<?=$post['alias']?>.html" title="<?=$post['title']?>"><?=cutOf($post['title'],100,false)?>”</a>
                                        </h3>
                                    </div>
                                    <a title="ảnh một" href="#">
                                        <img class="img-responsive"  src="<?=getThumb($post['thumb'])?>">
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <?php
                            foreach ($posts as $key => $post)
                            {
                                if ($key == 2)
                                {
                                    ?>
                                    <div  class="gallery-news-2-2 col-lg-6 col-sm-6 col-xs-12">
                                        <div class="info-feature-new">
                                            <span class="cate"><a href="/<?=isset($post['category']['alias'])?$post['category']['alias']:''?>.html"><?=isset($post['category']['name'])?$post['category']['name']:''?></a></span>
                                            <h3>
                                                <a href="/tin-tuc/<?=$post['alias']?>.html" title="<?=$post['title']?>"><?=cutOf($post['title'],60,false)?>”</a>
                                            </h3>
                                        </div>
                                        <a title="ảnh một" href="#">
                                            <img class="img-responsive"  src="<?=getThumb($post['thumb'])?>">
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                        <?php
                        foreach ($posts as $key => $post)
                        {
                            if ($key == 3)
                            {
                                ?>
                                <div  class="gallery-news-2-2 gallery-news-2-1-top-right col-lg-6 col-sm-6 col-xs-12">
                                    <div class="info-feature-new">
                                        <span class="cate"><a href="/<?=isset($post['category']['alias'])?$post['category']['alias']:''?>.html"><?=isset($post['category']['name'])?$post['category']['name']:''?></a></span>
                                        <h3>
                                            <a href="/tin-tuc/<?=$post['alias']?>.html" title="<?=$post['title']?>"><?=cutOf($post['title'],60,false)?>”</a>
                                        </h3>
                                    </div>
                                    <a title="ảnh một" href="#">
                                        <img class="img-responsive"  src="<?=getThumb($post['thumb'])?>">
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php
                foreach ($posts as $key => $post)
                {
                    ?>
                    <div class="gallery-news-1 col-lg-6 col-sm-6 col-xs-6 visible-xs">
                        <div class="info-feature-new">
                            <h3 class="hidden-xs">
                                <a href="/tin-tuc/<?=$post['alias']?>.html"><?=cutOf($post['title'],100,false)?>”</a>
                            </h3>
                            <h3 class="visible-xs">
                                <a href="/tin-tuc/<?=$post['alias']?>.html"><?=cutOf($post['title'],30,false)?>”</a>
                            </h3>
                        </div>
                        <a title="<?=$post['title']?>" href="/tin-tuc/<?=$post['alias']?>.html">
                            <img class="img-responsive"  src="<?=getThumb($post['thumb'])?>">
                        </a>
                    </div>
                    <?php
                }
                ?>
			</div>
        </div>
        <?php
    }
?>
