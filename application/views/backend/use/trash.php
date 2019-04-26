<!-- page content -->
<div class="right_col" role="main">
    <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users <small>admin</small></h3>
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="render()"><i class="fa fa-plus"></i> Add Users admin</a>
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
                                                    <a style="color: #00CC00" href="javascript:;"><?=isset($user['username'])?$user['username']:''?></a>
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
                                                <td class=" "><?=showTime($user['birthday'])?></td>
                                                <td class=" "><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"> Trash</button></td>
                                                <td class=" last">
                                                    <a onclick="restore(<?=$user['id']?>)" href="javascript:;" class="btn btn-primary btn-xs"><i class="fa fa-spinner"></i> Restore </a>
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
                                                    <a style="color: #00CC00" href="javascript:;"><?=isset($user['username'])?$user['username']:''?></a>
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
                                                <td class=" "><?=showTime($user['birthday'])?></td>
                                                <td class=" "><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"> Trash</button></td>
                                                <td class=" last">
                                                    <a onclick="restore(<?=$user['id']?>)" href="javascript:;" class="btn btn-primary btn-xs"><i class="fa fa-spinner"></i> Restore </a>
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
        var username = document.forms["save_user"]["username"].value;
        var password = document.forms["save_user"]["password"].value;
        var full_name = document.forms["save_user"]["full_name"].value;
        var birthday = document.forms["save_user"]["birthday"].value;
        if (username == "") {
            var type ='error';
            var text ='Username bắt buộc';
            onload =  notification (type,text);
            return false;
        }
        if (password == "")
        {
            var type ='error';
            var text ='Password bắt buộc';
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
    }
    function render(id) {
        if(id) {
            $.post("<?=URL?>/manager/ajax-user-admin/get", {id:id},
                function(data){
                    var data = jQuery.parseJSON(data);
                    $("input[name=id]").val(data.id);
                    $("#username").val(data.username);
                    $("#full_name").val(data.full_name);
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
            $("#username").val('');
            $("#password").val('');
            $("#full_name").val('');
            $("#sex_M").prop("checked", true);
            $("#single_cal3").val('');
        }
    }
    function remove(id) {
        if (id)
        {
            var result = confirm("Can't recover deleted data ?");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-user-admin/trash", {id:id},
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
            var result = confirm(" Restore data  ? ");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-user-admin/restore", {id:id},
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