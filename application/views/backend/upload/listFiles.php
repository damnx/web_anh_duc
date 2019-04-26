<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>All Image <small>Upload</small></h3>
                <a href="<?=URL?>/manager/upload.html" type="button" class="btn btn-danger"><i class="fa fa-plus-circle"></i> Upload  </a>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">

                <div class="x_panel">

                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <?php
                                if (isset($posts) && is_array($posts))
                                {
                                    foreach ($posts as $post)
                                    {
                                        $url = 'statics/upload/'.$post.'';
                                        ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img id="" style="width: 100%; display: block;" src="<?=URL?>/<?=$url?>" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a onclick="showimgae('<?=$url?>')" href="javascript:;"><i class="fa fa-link"></i></a>
                                                            <a onclick="unlink('<?=$url?>')" href="javascript:;"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong></p>
                                                    <p><?=$post?></p>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div id="myModal" class="modal modal-gb ">
                            <span onclick="cole()" class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>

    function showimgae(src) {
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        var modal = document.getElementById('myModal');
        modal.style.display = "block";
        modalImg.src = '<?=URL?>/'+src;

        captionText.innerHTML = src;

    }
    function cole() {
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    }
    function unlink(link) {
        var fs = require('fs');
        var filePath = '<?=URL?>/'+link;
        fs.unlinkSync(filePath);
    }
</script>