<!-- page content -->
<div class="right_col" role="main">
        <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Category <small></small></h3>
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick = "renders()"><i class="fa fa-plus"></i> Add Category</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Category <small></small></h2>
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
                                <input type="hidden" value="<?=isset($return)&& isset($return['id'])?$return['id']:set_value('id')?>" name="id" id = "id">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" value="<?=set_value('name')?>" class="form-control" onkeyup="autoAlias()"  placeholder="Name" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=URL?>/</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" value="<?=set_value('alias')?>"   placeholder="Alias" name="alias" id="alias">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <?php
                                        $js = 'id="parent_id" class="form-control"';
                                        echo form_dropdown('parent_id', $categorys, 0, $js);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Description
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" rows="4" name="description" id="description"></textarea>
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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Show Index<span class="required">*</span></label>
                                <div style="margin-top: 8px" class="col-md-9 col-sm-9 col-xs-12">
                                    <label>
                                        <input type="radio" value="1" id="show_1" name="show_index" <?= set_radio('show_index', '1', FALSE); ?> checked=""> Active
                                        &nbsp;
                                        &nbsp;
                                    </label>
                                    <label>
                                        <input type="radio" value="0" id="show_2" <?= set_radio('show_index', '0', FALSE); ?> name="show_index"> Lock
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Order Show Index</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control"  value="<?=set_value('order')?>"  placeholder="order" name="order" id="order">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta image</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control"  value="<?=set_value('thumb')?>"  placeholder="Thumb" name="thumb" id="thumb">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                                    <button type="button" onclick="renders()" class="btn btn-success">Cancel</button>
                                    <button type="button" onclick="validateForm()" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List Category <small></small></h2>
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
                                    if (isset($categorys) && is_array($categorys))
                                    {

                                        foreach ($categorys as $key => $category)
                                        {
                                            if ($key > 0)
                                            {
                                                ?>
                                                <li id="id-<?=$key?>" class="item-1 deeper parent active">
                                                    <a  href="javascript:;" onclick="renders(<?=$key?>)" class="lbl"><?=$category?></a>
                                                    <a href="javascript:;" onclick="remove(<?=$key?>)"  class="sign-cate sign-cate-trash  "><i  class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <a href="javascript:;" onclick="renders(<?=$key?>)"  class="sign-cate sign-cate-square"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </li>
                                                <?php
                                            }

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
                $.post("<?=URL?>/manager/ajax-category/delete", {id:id},
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
            $.post("<?=URL?>/manager/ajax-category/get", {id:id},
                function(data){
                    var data = jQuery.parseJSON(data);
                    $("input[name=id]").val(data.id);
                    $("#name").val(data.name);
                    $("#alias").val(data.alias);
                    $("#description").text(data.description);
                    $("#order").val(data.order);
                    $("#thumb").val(data.thumb);
                    $("#parent_id").val(data.parent_id).change();
                    if (data.status == '1')
                    {
                        $("#status_1").prop("checked",true );

                    }
                    else
                    {
                        $("#status_2").prop("checked",true );
                    }
                    if (data.show_index == '1')
                    {
                        $("#show_1").prop("checked",true );

                    }
                    else
                    {
                        $("#show_2").prop("checked",true );
                    }
                });
        } else {
            $("input[name=id]").val('');
            $("#name").val('');
            $("#alias").val('');
            $("#description").val('');
            $("#thumb").val('');
            $("#order").val('0');
            $("#status_1").prop("checked",true );
            $("#show_1").prop("checked",true );
            $("#parent_id").val(0).change();
        }
    }
</script>
<!-- /page content -->