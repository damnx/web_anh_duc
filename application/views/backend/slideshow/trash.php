<!-- page content -->
<div class="right_col" role="main">
        <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>List <small>slideshow</small></h3>
<!--                <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="renders()"><i class="fa fa-plus"></i> Add slideshow</a>-->
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <form method="get" id="search">
                    <div class="input-group">
                        <input type="text" name="q" value="<?=isset($search) ? $search :''?>" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button onclick="submit_search()" class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" id="check-all" class="flat">
                                    </th>
                                    <th class="column-title">Thumb</th>
                                    <th class="column-title">Title</th>
                                    <th class="column-title">Content</th>
                                    <th class="column-title">Status </th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                    if (isset($posts) && count($posts)>0)
                                    {
                                        $i = 0;
                                        foreach ($posts as $post)
                                        {

                                            $i ++;
                                            if ($i % 2 == 0)
                                            {
                                                ?>
                                                <tr id="id-<?=$post['id']?>" class="odd pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td><img height="40" src="<?=isset($post['thumb'])?$post['thumb']:''?>"></td>
                                                    <td class=" ">
                                                        <a><?=isset($post['title'])?$post['title']:''?></a>
                                                        <p>Order : <?=isset($post['wednesday'])?$post['wednesday']:'0'?></p>
                                                    </td>
                                                    <td class=""><?=isset($post['content'])?$post['content']:''?></td>
                                                    <td class=" "><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"> Trash</button></td>
                                                    <td class=" last">
                                                        <a  onclick="restore(<?= $post['id']?>)"href="javascript:;" class="btn btn-info btn-xs"><i class="fa fa-spinner"></i> Restore </a>
                                                        <a onclick="remove(<?= $post['id']?>)" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <tr id="id-<?=$post['id']?>" class="even pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td class=" "><img height="40" src="<?=isset($post['thumb'])?$post['thumb']:''?>"></td>
                                                    <td class=" ">
                                                        <a><?=isset($post['title'])?$post['title']:''?></a>
                                                        <p>Order : <?=isset($post['wednesday'])?$post['wednesday']:'0'?></p>
                                                    </td>
                                                    <td class=""><?=isset($post['content'])?$post['content']:''?></td>
                                                    <td class=" "><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"> Trash</button></td>
                                                    <td class=" last">
                                                        <a  onclick="restore(<?= $post['id']?>)"href="javascript:;" class="btn btn-info btn-xs"><i class="fa fa-spinner"></i> Restore </a>
                                                        <a onclick="remove(<?= $post['id']?>)" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?= isset($pagination) ? $pagination :''?>
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
    function validateForm() {
		var id = document.forms["save"]["id"].value;
        var thumb = document.forms["save"]["thumb"].value;
        if (thumb == "") {
            var type ='error';
            var text ='Thumb bắt buộc';
            onload =  notification (type,text);
            return false;
        }

		document.getElementById("saver").submit();
		return true
    }
    function renders(id) {
        if(id) {
            $.post("<?=URL?>/manager/ajax-slideshow/get", {id:id},
                function(data){
                    var data = jQuery.parseJSON(data);
                    $("input[name=id]").val(data.id);
                    $("#title").val(data.title);
                    $("#content").val(data.content);
                    $("#thumb").val(data.thumb);
                    $("#wednesday").val(data.wednesday);
                    if (data.sex == '1')
                    {
                        $("#sex_M").prop("checked",true );

                    }
                    else
                    {
                        $("#sex_F").prop("checked",true );
                    }
                    if (data.status == '1')
                    {
                        $("#status_1").prop("checked",true );

                    }
                    else
                    {
                        $("#status_2").prop("checked",true );
                    }
                    var timestamp = moment.unix(data.birthday);
                    $("#single_cal3").val(timestamp.format("MM/D/Y"));
                });
        } else {
            $("input[name=id]").val('');
            $("#title").val('');
            $("#content").val('');
            $("#thumb").val('');
            $("#sex_M").prop("checked", true);
            $("#wednesday").val('');
        }
    }
	function remove(id) {
        if (id)
        {
            var result = confirm(" Can't recover deleted data ? ");
            if (result)
            {
				$.post("<?=URL?>/manager/ajax-slideshow/trash", {id:id},
                    function(data)
                    {
                        $("#id-"+id).hide();
						var data = jQuery.parseJSON(data);
						var type = data.title;
						var text = data.text;
						onload =  notification (type,text);
                    });
            }

        }
    }
    function restore(id) {
        if (id)
        {
            var result = confirm(" Restore data ? ");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-slideshow/restore", {id:id},
                    function(data)
                    {
                        $("#id-"+id).hide();
						var data = jQuery.parseJSON(data);
						var type = data.title;
						var text = data.text;
						onload =  notification (type,text);
                    });
            }

        }
    }
    function submit_search() {
        document.getElementById("search").submit();
    }
</script>
<!-- /page content -->