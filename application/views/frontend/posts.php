<link href="<?=CDN?>/frontend/css/posts.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
<!--breadcrumbs-->
<?php
if (isset($category_check) && count($category_check) > 0)
{

    $left_ct = $category_check['left_ct'];
    $right_ct = $category_check['right_ct'];
}
else
{
    $left_ct  = 0;
    $right_ct = 0;
}
if (isset($category_check) && count($category_check) > 0)
{
   echo $this->load->widget('breadcrumbs',array($left_ct,$right_ct));
}
else
{

}
?>
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
                                            <span style=""><?=$post['title']?></span>
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