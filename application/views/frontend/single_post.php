<link href="<?=CDN?>/frontend/css/posts.css?vs=<?=time()?>" rel="stylesheet" type="text/css" media="all" />
<!--breadcrumbs-->
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
            <li class="active"><?=cutOf($post['title'],25,false)?></li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--new-->
<div class="container">
    <div class="container-post">
        <div style="padding: 0px 2px" class="col-lg-8 col-sm-8 col-xs-12 ">
            <div class="single-cont">
                <div class="title-widget-sidebar title-widget-sidebar-gb">
                    <h1 class=""><?=isset($post['title'])?$post['title']:'GB'?>
                </div>
                </h1>
                <div class="gb-adc">
                     <span style="float: right" class="fb" >
                        <div class="fb-like" data-href="<?=URL?>/tin-tuc/<?=$post['alias']?>.html" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
                    </span>
                    <span style="float: left" class="date">
                        <?=isset($post['published'])?showDate($post['published']):'GB'?>
                    </span>
                </div>
                <h2 class="single-description"><?=isset($post['description'])?$post['description']:'GB'?></h2>
                <?=isset($post['content'])?$post['content']:'GB'?>
                <div class="fb-comments" data-href="<?=URL?>/sp/<?=$post['alias']?>.html" data-width="100%" data-numposts="15" data-colorscheme="light" data-mobile="false" data-order-by="reverse_time"></div>
            </div>
        </div>
        <div style="padding: 0px 2px" class="col-lg-4 col-sm-4 col-xs-12 widget-sidebar-gb">
            <?=$this->load->widget('tags_news',array('id_post' => isset($post['id'])?$post['id']:0)); ?>
            <?=$this->load->widget('feature_news');?>
            <?=$this->load->widget('news_read_much');?>
        </div>
    </div>

</div>
<!--//new-->

