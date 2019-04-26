<!--banner-->
<div class="banner">
    <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            if (isset($posts) && count($posts))
            {
                $count = count($posts);
                for ($i = 1; $i <= $count ; $i++)
                {
                    if ($i ==1)
                    {
                        $active = 'active';
                    }
                    else
                        $active = NULL;
                    ?>
                    <li data-target="#bootstrap-touch-slider" data-slide-to="<?=$i-1?>" class="<?=$active?>"></li>
                    <?php
                }
            }
            ?>
        </ol>
        <!-- Wrapper For Slides -->
        <div class="carousel-inner" role="listbox">
            <?php
            if (isset($posts) && count($posts))
            {
                foreach ($posts as $key =>$post )
                {
                    if ($key+1 == 1)
                    {
                        ?>
                        <!-- Third Slide -->
                        <div class="item active">
                            <!-- Slide Background -->

                            <img src="<?=getThumb($post['thumb'],840,500)?>" alt="<?=$post['title']?>"  class="slide-image"/>
                            <a style="overflow: hidden;float: left" href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>">
                                <div class="bs-slider-overlay"></div>
                            </a>
                            <div class="container">
                                <div class="row">
                                    <!-- Slide Text Layer -->
                                    <div class="slide-text slide_style_left">
                                        <h1 data-animation="animated zoomInRight"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['title']?></a></h1>
                                        <p data-animation="animated fadeInLeft"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['content']?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Slide -->
                        <?php
                    }
                    if ($key+1 == 2)
                    {
                        ?>
                        <!-- Second Slide -->
                        <div class="item">
                            <!-- Slide Background -->
                            <img src="<?=getThumb($post['thumb'],840,500)?>" alt="<?=$post['title']?>"  class="slide-image"/>
                            <a style="overflow: hidden;float: left" href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>">
                                <div class="bs-slider-overlay"></div>
                            </a>
                            <!-- Slide Text Layer -->
                            <div class="slide-text slide_style_center">
                                <h1 data-animation="animated flipInX"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['title']?></a></h1>
                                <p data-animation="animated lightSpeedIn"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['content']?></a></p>
                            </div>
                        </div>
                        <!-- End of Slide -->
                        <?php
                    }
                    if ($key+1 == 3)
                    {
                        ?>
                        <!-- Third Slide -->
                        <div class="item">
                            <!-- Slide Background -->
                            <img src="<?=getThumb($post['thumb'],840,500)?>" alt="<?=$post['title']?>"  class="slide-image"/>
                            <a style="overflow: hidden;float: left" href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>">
                                <div class="bs-slider-overlay"></div>
                            </a>
                            <!-- Slide Text Layer -->
                            <div class="slide-text slide_style_right">
                                <h1 data-animation="animated zoomInLeft"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['title']?></a></h1>
                                <p data-animation="animated fadeInRight"><a href="<?=$post['link']?>" target="_blank" title="<?=$post['title']?>"><?=$post['content']?></a></p>
                            </div>
                        </div>
                        <!-- End of Slide -->
                        <?php
                    }

                }
            }
            ?>
        </div>
        <!-- End of Wrapper For Slides -->
        <!-- Left Control -->
        <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <!-- Right Control -->
        <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div> <!-- End  bootstrap-touch-slider Slider -->
</div>

<!--//banner-->