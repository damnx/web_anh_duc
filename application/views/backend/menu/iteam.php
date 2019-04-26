<!-- page content -->
<div class="right_col" role="main">
        <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Menu <small></small></h3>
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick = "renders()"><i class="fa fa-plus"></i> Add Menu</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Menu <small></small></h2>
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
                        <br>
                        <form method="post" name="form" id="form" class="form-horizontal form-label-left input_mask">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select  name="mid" id="mid" class="form-control">
                                        <?php
                                        if (isset($menu_team) && is_array($menu_team))
                                        {
                                            foreach ($menu_team as $menu)
                                            {
                                                ?>
                                                <option value="<?=$menu['id']?>"><?=$menu['name']?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="<?=isset($return)&& isset($return['id'])?$return['id']:set_value('id')?>" name="id" id = "id">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" value="<?=set_value('name')?>" class="form-control" onkeyup="autoAlias()"  placeholder="Name" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alias (<?=URL?>/)</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="<?=set_value('alias')?>"   placeholder="Alias" name="alias" id="alias">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent</label>
                                <div id="parent" class="col-md-9 col-sm-9 col-xs-12">
                                    <select  name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">No Parent</option>
                                        <?php
                                        if (isset($menus) && is_array($menus))
                                        {
                                            foreach ($menus as $menu)
                                            {
                                                ?>
                                                <option value="<?=$menu['id']?>"><?=$menu['name']?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select  name="type" id="type" class="form-control">
                                        <option value="category">category</option>
                                        <option value="link">link</option>
                                    </select>
                                </div>
                            </div>
                            <div  id="link_content" class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="<?=set_value('link')?>"   placeholder="Link" name="link" id="link">
                                </div>
                            </div>
                            <div id="category_content" class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <?php
                                    unset($categorys[0]);
                                    $js = 'id="id_category" class="form-control"';
                                    echo form_dropdown('id_category', $categorys, 0, $js);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product / Post <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select  name="product_posts" id="product_posts" class="form-control">
                                        <option value="product">Product</option>
                                        <option value="posts">Posts</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                                <div style="margin-top: 8px" class="col-md-9 col-sm-9 col-xs-12">
                                    <label>
                                        <input type="radio" value="1" id="status_1" name="status" <?= set_radio('status', '1', FALSE); ?> checked=""> Active
                                        &nbsp;
                                        &nbsp;
                                    </label>
                                    <label>
                                        <input type="radio" value="0" id="status_2" <?= set_radio('status', '0', FALSE); ?> name="status"> Lock
                                    </label>
                                </div>
                            </div>
                            <div id="" class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Order</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" value="<?=set_value('wednesday')?>"   placeholder="Order" name="wednesday" id="wednesday">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                                    <button type="button" onclick="renders()" class="btn btn-success">Cancel</button>
                                    <button type="button" onclick="validateForm()" class="btn btn-success"><?=isset($return)&& isset($return['id'])?'Submit':'Submit'?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List Menu <small></small></h2>
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
                        <br>
                        <div id="left" class="span3 col-lg-12">
                            <ul id="menu-group-1" class="nav menu">
                                <?php
                                    if (isset($menus) && is_array($menus))
                                    {
                                        foreach ($menus as $menu)
                                        {
                                            ?>
                                            <li id="id-<?=$menu['id']?>" class="item-1 deeper parent active">
                                                <a  href="javascript:;" onclick="renders(<?= $menu['id']?>)" class="lbl"><?=$menu['name']?></a>
                                                <a href="javascript:;" onclick="remove(<?= $menu['id']?>)"  class="sign-cate sign-cate-trash  "><i  class="fa fa-trash" aria-hidden="true"></i></a>
                                                <a href="javascript:;" onclick="renders(<?= $menu['id']?>)"  class="sign-cate sign-cate-square"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </li>
                                            <?php

                                        }
                                    }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    <?php
        if (isset($check_type) && $check_type =='link')
        {
            ?>
                $("#type").val('link').change();
                $("#category_content").hide();
                $("#link_content").show();
            <?php
        }
        else
        {
            ?>
                $("#type").val('category').change();
                $("#category_content").show();
                $("#link_content").hide();
                $("#link").val('');
            <?php
        }
    ?>
    $('#type').on('change', function() {
        var value = $(this).val();
        if (value =='category')
        {
            $("#category_content").show();
            $("#link_content").hide();
            $("#link").val('');
        }
        if (value =='link')
        {
            $("#link").val('');
            $("#category_content").hide();
            $("#link_content").show();
        }
    });
    function notification (type,text) {
        new PNotify({
            title: 'Warning!',
            text: text,
            type: type,
            styling: 'bootstrap3'
        });
    }
    function remove(id) {
        if (id)
        {
            var result = confirm(" Can't recover deleted data ? ");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-menu/delete", {id:id},
                    function(data)
                    {
                        var data = jQuery.parseJSON(data);
                        var type = data.title;
                        if (type == 'success')
                        {
                            $("#id-"+id).hide();
                        }
                        var text = data.text;
                        onload =  notification (type,text);
                    });
            }
        }
    }
	 function autoAlias() {
        var alias = $("#name").val();
        $.post("<?=URL?>/manager/ajax-category/alias", {alias:alias},
            function(data){
                $("#alias").val(data);
            });
    }
    function validateForm() {
		var id = document.forms["form"]["id"].value;
        var alias = document.forms["form"]["alias"].value;
		var name = document.forms["form"]["name"].value;
		if (name == "")
		{
			var type ='error';
            var text ='name not null';
            onload =  notification (type,text);
            return false;
		}
        if (alias == "") {
            var type ='error';
            var text ='alias not null';
            onload =  notification (type,text);
            return false;
        }
        document.getElementById("form").submit();
        return true
    }
	function renders(id) {
        if(id) {
            $.post("<?=URL?>/manager/ajax-menu/get", {id:id},
                function(data){
                    var data = jQuery.parseJSON(data);
                    $("input[name=id]").val(data.id);
                    $("#name").val(data.name);
                    $("#alias").val(data.alias);
                    $("#wednesday").val(data.wednesday);
                    if (data.type == 'link' )
                    {
                        $("#type").val('link').change();
                        $("#link").val(data.link);
                        $("#category_content").hide();
                        $("#link_content").show();
                    }
                    else
                    {
                        $("#type").val('category').change();
                        $("#link").val('');
                        $("#id_category").val(data.id_category).change();
                        $("#category_content").show();
                        $("#link_content").hide();
                    }
                    $("#parent_id").val(data.parent_id).change();
                    if (data.status == '1')
                    {
                        $("#status_1").prop("checked",true );

                    }
                    else
                    {
                        $("#status_2").prop("checked",true );
                    }
                    if (data.product_posts =='posts')
                    {
                        $("#product_posts").val('posts').change();
                    }
                    if (data.product_posts =='product')
                    {
                        $("#product_posts").val('product').change();
                    }
                });
        } else {
            $("input[name=id]").val('');
            $("#name").val('');
            $("#alias").val('');
            $("#wednesday").val('');
            $("#link").val('');
            $("#status_1").prop("checked",true );
            $("#type").val('category').change();
            $("#category_content").show();
            $("#link_content").hide();

        }
    }
    $('#mid').on('change', function() {
        var id = $(this).val();
        if (id)
        {
            $.ajax({
                type:'post',
                url:'<?=URL?>/manager/ajax-menu/getMenu',
                data:{'id':id},
                success:function (data) {
                    $('#left').html(data);
                }
            });
        }
    });
    $('#mid').on('change', function() {
        var id = $(this).val();
        if (id)
        {
            $.ajax({
                type:'post',
                url:'<?=URL?>/manager/ajax-menu/getParent',
                data:{'id':id},
                success:function (data) {
                    $('#parent').html(data);
                }
            });
        }
    });
</script>
<!-- /page content -->