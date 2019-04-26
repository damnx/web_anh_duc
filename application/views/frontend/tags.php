<link href="<?=CDN?>/frontend/css/posts.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
<!--breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li><a href="/tin-tuc.html">Tin Tức</a></li>
            <li><a href="javascript:;">Tags</a></li>
            <li class="active"><?=$tags['name']?></li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--new-->
<div class="container">
    <div class="container-post">
        <div class="col-lg-8 col-sm-8 col-xs-12">
            <div style="padding:0px 2px" class="row">
                <?php
                if (isset($posts) && count($posts) > 0)
                {
                    foreach ($posts as $post)
                    {
                        ?>
                        <div style="padding: 2px" class="col-lg-6 col-sm-6 col-xs-12  simpleCart_shelfItem wow fadeInUp animated animated" data-wow-delay=".5s">
                            <aside class="post-gb">
                                <div class="thumb-category-post">
                                    <a href="/tin-tuc/<?=$post['alias']?>.html" title="<?=$post['title']?>">
                                        <img src="<?=$post['thumb']?>" class="img-responsive">
                                    </a>
                                </div>
                                <div class="content-footer content-footer-gb">
                                    <a href="/tin-tuc/<?=$post['alias']?>.html" title="<?=$post['title']?>">
                                        <span><?=$post['title']?></span>
                                    </a>
                                </div>
                            </aside>
                        </div>
                        <?php
                    }
                }
                ?>
                <div style="padding: 5px;text-align: center" class="col-lg-12 col-sm-12 col-xs-12 simpleCart_shelfItem wow fadeInUp animated animated" data-wow-delay=".5s">
                    <?= isset($pagination) ? $pagination :''?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12 widget-sidebar-gb">
            <?=$this->load->widget('feature_news');?>
            <?=$this->load->widget('news_read_much');?>
        </div>
    </div>

</div>
<!--//new-->