<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form posts</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form class="form-horizontal form-label-left" id="save" method="post" action="">
            <div class="col-md-8 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form <small>Required Information</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Title <span>(*)</span></label>
                                    <p>title for the post ( Obligatory )</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="hidden" name="id" value="<?php if(isset($post) && count($post) >0) {echo $post['id'];}else {if (isset($return)&& !empty($return['id'])) {echo $return['id'];}else {echo set_value('id');}} ?>" id="id">
                                    <input type="text" value="<?=isset($post) && count($post) >0 ?$post['title'] :set_value('title')?>" onkeyup="autoAlias(),autotitle()" name="title" id="title" class="form-control" autocomplete ="off" placeholder="Title for the post ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Alias <span>(*)</span></label>
                                    <p><?=URL?>/.../</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="alias" value="<?=isset($post) && count($post) >0 ?$post['alias'] : set_value('alias')?>" id="alias" class="form-control" placeholder="Alias for the post">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Describe post<span>(*)</span></label>
                                    <p>describe for the post ( Obligatory )</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" onkeyup="autodescription()" row = '10'  id="description" name="description"><?=isset($post) && count($post) >0 ?$post['description'] : set_value('description')?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Content post<span>(*)</span></label>
                                    <p>Content for the post ( Obligatory )</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" row = '10' id="content"  name="content"><?=isset($post) && count($post) >0 ?$post['content'] :set_value('content')?></textarea>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                <label class="control-label">Tags <span></span></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <script id="script_e12">
                                    $(document).ready(function () {
                                        $("#tags").select2({tags:[<?php
                                            if (isset($tags) && count($tags) > 0)
                                            {
                                                $i = 0;
                                                foreach ($tags as $tag)
                                                {
                                                    $i++;
                                                    if ($i == count($tags))
                                                    {
                                                        echo "'".$tag['name']."'";
                                                    }
                                                    else
                                                    {
                                                        echo "'".$tag['name']."' ,";
                                                    }
                                                }
                                            }

                                            ?>]});
                                    });
                                </script>
                                <input type="hidden"  id="tags" name="tags" style="width:100%" value="<?php
                                if(isset($tags_product) && count($tags_product) > 0)
                                {
                                    $j = 0;
                                    foreach ($tags_product as  $tag )
                                    {
                                        $j ++;
                                        if ($j == count($tags_product))
                                        {
                                            echo $tag['name'];
                                        }
                                        else
                                        {
                                            echo $tag['name'] .',';
                                        }
                                    }
                                }
                                ?>"/>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Meta title post<span>(*)</span></label>
                                    <p>meta title for the post - seo web ( Obligatory )</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?=isset($post) && count($post) >0 ?$post['meta_title'] :set_value('meta_title')?>" placeholder="Meta title post ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label">Meta description post<span>(*)</span></label>
                                    <p>meta description for the post - seo web ( Obligatory )</p>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="meta_description" id="meta_description" rows="3" placeholder="Meta description post " class="form-control"><?=isset($post) && count($post) >0 ?$post['meta_description'] :set_value('meta_description')?></textarea>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!--<h2>Form Basic Elements <small>different form elements</small></h2>-->
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                <label class="control-label ">Feature</label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="material-switch">
                                    <input id="someSwitchOptionSuccess"  value="1"
                                           <?php
                                           if (isset($post) && count($post) > 0)
                                           {
                                               if (isset($post['feature']) && $post['feature'] == 1 )
                                               {
                                                   echo('checked');
                                               }
                                           }
                                           else
                                           {
                                               if (isset($feature) && $feature == 1)
                                               {
                                                   echo('checked');
                                               }
                                           }
                                           ?>
                                           name="feature"  type="checkbox"/>
                                    <label for="someSwitchOptionSuccess" class="label-success"></label>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label ">Status</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <?php
                                    $check_status = 1;
                                    if (isset($status))
                                    {
                                        $check_status = (int)$status;
                                    }
                                    else
                                    {
                                        if (isset($post) && count($post) > 0 )
                                        {
                                            $check_status = (int)$post['status'];
                                        }
                                    }
                                    $options = array(
                                        '1'         => 'Publish',
                                        '0'           => 'Pending'
                                    );
                                    $js = 'id="status" class="form-control"';
                                    echo form_dropdown('status', $options, $check_status, $js);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label ">Type</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="type" id="type" class="form-control">
                                        <option value="news">News</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                    <label class="control-label ">Time</label>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <div class="row">
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" value="<?=isset($post) && count($post) >0 ? date('m/d/Y',$post['published']) :set_value('day')?>" name="day" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status">
                                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <div class="row">
                                        <input type="text" name="hour" id="hour" value="<?php if(isset($post['published'])){echo date("H",$post['published']);}else{echo set_value('hour');}?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <div class="row">
                                        <input type="text" name="min" id="min" value="<?php if(isset($post['published'])){echo date("i",$post['published']);}else{echo set_value('min');}?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <button type="button" onclick="validateForm()" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <!--<h2>Form Basic Elements <small>different form elements</small></h2>-->
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h2>Thumb</h2>
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 col-xs-12 text-left">
                                <label class="control-label ">Thumb</label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="thumb" id="thumb" value="<?=isset($post) && count($post) >0 ?$post['thumb'] :set_value('thumb')?>" class="form-control" placeholder="Thumb for the post">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <!--<h2>Form Basic Elements <small>different form elements</small></h2>-->
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <h2>Category</h2>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <?php
                                        if (!isset($category_check))
                                        {
                                            $category_check = array();
                                        }
                                        if (isset($categorys) && is_array($categorys))
                                        {
                                            echo showCategories($categorys,0,'',$category_check);
                                        }
                                    ?>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<link href="<?=CDN?>/backend/css/select2.css?gb=<?=time()?>" rel="stylesheet"/>
<script src="<?=CDN?>/backend/js/select2.js?gb=<?=time()?>"></script>
<script type="text/javascript" src="<?= CDN?>/backend/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(function() {
        if(CKEDITOR.instances['content']) {
            CKEDITOR.remove(CKEDITOR.instances['content']);
        }
        CKEDITOR.config.entities_latin = false;
        CKEDITOR.config.width = '100%';
        CKEDITOR.config.height = 150;
        CKEDITOR.replace('content',{});
    })
    function notification (type,text) {
        new PNotify({
            title: 'Warning!',
            text: text,
            type: type,
            styling: 'bootstrap3'
        });
    }
    function autoAlias() {
        var alias = $("#title").val();
        $.post("<?=URL?>/manager/ajax-category/alias", {alias:alias},
            function(data){
                $("#alias").val(data);
            });
    }
    function autodescription() {
        var description = $("#description").val();
        $.post("<?=URL?>/manager/ajax-posts/description", {description:description},
            function(data){
                $("#meta_description").val(data);
            });
    }
    function autotitle() {
        var title = $("#title").val();
        $.post("<?=URL?>/manager/ajax-posts/meta_title", {title:title},
            function(data){
                $("#meta_title").val(data);
            });
    }
    function validateForm() {
        var thumb = document.forms["save"]["thumb"].value;
        var title = document.forms["save"]["title"].value;
        var alias = document.forms["save"]["alias"].value;
        var meta_title = document.forms["save"]["meta_title"].value;
        var meta_description = document.forms["save"]["meta_description"].value;
        if (thumb == "") {
            var type ='error';
            var text ='Thumb bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (title == "") {
            var type ='error';
            var text ='title bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (alias == "") {
            var type ='error';
            var text ='alias bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (meta_title == "") {
            var type ='error';
            var text ='Meta title bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (meta_description == "") {
            var type ='error';
            var text ='Meta description  bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        document.getElementById("save").submit();
        return true
    }
</script>
<!-- /page content -->