<!-- page content -->
<div class="right_col" role="main">
        <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users <small></small></h3>
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="render()"><i class="fa fa-plus"></i> Add Users</a>
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
                                    <th class="column-title">User name </th>
                                    <th class="column-title">Full name</th>
                                    <th class="column-title">Money </th>
                                    <th class="column-title">Gender</th>
                                    <th class="column-title">Birthday </th>
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
                                    if (isset($user_admin) && count($user_admin)>0)
                                    {
                                        $i = 0;
                                        foreach ($user_admin as $user)
                                        {

                                            $i ++;
                                            if ($i % 2 == 0)
                                            {
                                                ?>
                                                <tr id="id-<?=$user['id']?>" class="odd pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td class=" ">
                                                        <a onclick="render(<?=$user['id']?>)" style="color: #00CC00" data-toggle="modal" data-target="#myModal"><?=isset($user['username'])?$user['username']:''?></a>
                                                        <p>Last login : <?=isset($user['last_login'])&& $user['last_login'] != null ? showTime($user['last_login']):''?></p>
                                                    </td>
                                                    <td class=" "><?=isset($user['full_name'])?$user['full_name']:''?></td>
                                                    <td class=" ">
                                                        <?php
                                                            if (isset($user['sex']) && ($user['sex']) == 0 )
                                                            {
                                                                ?>
                                                                    <i class="fa fa-female"></i
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <i class="fa fa-male"></i>
                                                                <?php
                                                            }
                                                        ?>

                                                    </td>
                                                    <td class=" "><?=number_format((int)$user['money'])?> VNĐ</td>
                                                    <td class=" "><?=showTime($user['birthday'])?></td>
                                                    <td class=" ">
                                                        <?=isset($user['status']) && $user['status'] == 1 ? '<a href="javascript:;" class="btn btn-success btn-xs">Active </a>':'<a href="javascript:;" class="btn btn-danger btn-xs">Lock</a>'?>
                                                    </td>
                                                    <td class=" last">
                                                        <a onclick="render(<?=$user['id']?>)"  data-toggle="modal" data-target="#myModal" href="javascript:;" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                        <a onclick="remove(<?=$user['id']?>)"  href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <tr id="id-<?=$user['id']?>" class="even pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="flat" name="table_records">
                                                    </td>
                                                    <td class=" ">
                                                        <a onclick="render(<?=$user['id']?>)" style="color: #00CC00" data-toggle="modal" data-target="#myModal"><?=isset($user['username'])?$user['username']:''?></a>
                                                        <p>Last login : <?=isset($user['last_login'])&& $user['last_login'] != null ? showTime($user['last_login']):''?></p>
                                                    </td>
                                                    <td class=" "><?=isset($user['full_name'])?$user['full_name']:''?></td>
                                                    <td class=" ">
                                                        <?php
                                                        if (isset($user['sex']) && ($user['sex']) == '0' )
                                                        {
                                                            ?>
                                                            <i class="fa fa-female"></i
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <i class="fa fa-male"></i>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td class=" "><?=number_format((int)$user['money'])?> VNĐ</td>
                                                    <td class=" "><?=showTime($user['birthday'])?></td>
                                                    <td class=" ">
                                                        <?=isset($user['status']) && $user['status'] == 1 ? '<a href="javascript:;" class="btn btn-success btn-xs">Active </a>':'<a href="javascript:;" class="btn btn-danger btn-xs">Lock</a>'?>
                                                    </td>
                                                    <td class=" last">
                                                        <a onclick="render(<?=$user['id']?>)"  data-toggle="modal" data-target="#myModal" href="javascript:;" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                        <a onclick="remove(<?=$user['id']?>)"  href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
                        <div class="modal modal-gb fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add users admin</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_content">
                                                        <br />
                                                        <form id="saver" name="save" method="post" class="form-horizontal form-label-left">
                                                            <input id="id" name="id" value="" type="hidden">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">User name <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="text" id="username" name="username"  class="form-control col-md-7 col-xs-12">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">password <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Full name <span class="required">*</span></label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <input id="full_name" class="form-control col-md-7 col-xs-12" type="text"  name="full_name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Eamil <span class="required">*</span></label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <input id="email" class="form-control col-md-7 col-xs-12" type="text"  name="email">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Money <span class="required">*</span></label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="text" id="money" name="money"  value="" class="form-control col-md-7 col-xs-12" placeholder="money">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
                                                                <div style="margin-top: 8px" class="col-md-9 col-sm-9 col-xs-12">
                                                                    <label>
                                                                        <input type="radio" value="1" id="sex_M" name="sex" checked> M
                                                                        &nbsp;
                                                                        &nbsp;
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="0" id="sex_F" name="sex"> F
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                                                                <div style="margin-top: 8px" class="col-md-9 col-sm-9 col-xs-12">
                                                                    <label>
                                                                        <input type="radio" value="1" id="status_1" name="status" checked> Active
                                                                        &nbsp;
                                                                        &nbsp;
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="0" id="status_2" name="status"> Lock
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-9 xdisplay_inputx form-group has-feedback">
                                                                    <input type="text" class="form-control has-feedback-left" id="single_cal3" name="birthday" value="" placeholder="" aria-describedby="inputSuccess2Status3">
                                                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="validateForm()"  class="btn btn-primary"  name="save">Save changes</button
                                    </div>
                                    </form>
                                </div>
                            </div>
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
        var username = document.forms["save"]["username"].value;
        var password = document.forms["save"]["password"].value;
        var full_name = document.forms["save"]["full_name"].value;
        var birthday = document.forms["save"]["birthday"].value;
        var email = document.forms["save"]["email"].value;
        if (username == "") {
            var type ='error';
            var text ='Username bắt buộc';
            onload =  notification (type,text);
            return false;
        }
		if (username != "" && username.length < 6)
		{
			var type ='error';
			var text ='Username lớn hơn 6 ký tự';
			onload =  notification (type,text);
			return false;
		}
        if (password == "" && id == "")
        {
            var type ='error';
            var text ='Password bắt buộc';
            onload =  notification (type,text);
            return false;
        }
		if (password.length < 6 && id == "")
		{
			var type ='error';
            var text ='Password lớn hơn 6 ký tự';
            onload =  notification (type,text);
            return false;
		}
        if (full_name == "")
        {
            var type ='error';
            var text ='Full name bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (birthday == "")
        {
            var type ='error';
            var text ='Birthday bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (email == "")
        {
            var type ='error';
            var text ='Email bắt buộc';
            onload =  notification (type,text);
            return false;
        }
		document.getElementById("saver").submit();
		return true
    }
    function render(id) {
        if(id) {
            $.post("<?=URL?>/manager/ajax-user/get", {id:id},
                function(data){
                    var data = jQuery.parseJSON(data);
                    $("input[name=id]").val(data.id);
                    $("#username").val(data.username);
					document.getElementById("username").disabled = true;
                    $("#full_name").val(data.full_name);
                    $("#email").val(data.email);
                    $("#money").val('');
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
			document.getElementById("username").disabled = false;
            $("input[name=id]").val('');
            $("#username").val('');
            $("#password").val('');
            $("#full_name").val('');
            $("#sex_M").prop("checked", true);
            $("#single_cal3").val('');
            $("#email").val('');
            $("#money").val('0');
        }
    }
    function remove(id) {
        if (id)
        {
            var result = confirm("Want to delete?");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-user/delete", {id:id},
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