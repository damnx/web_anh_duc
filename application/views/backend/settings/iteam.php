<!-- page content -->
<div class="right_col" role="main">
    <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <br />
                                        <form id="saver" name="save" method="post" class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <input id="id" name="id" value="<?=isset($settings['id'])?$settings['id']:''?>" type="hidden">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="title" name="title" value="<?=isset($settings['title'])?$settings['title']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Description
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="description" name="description" value="<?=isset($settings['description'])?$settings['description']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Thumb
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="thumb" name="thumb" value="<?=isset($settings['thumb'])?$settings['thumb']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Nạp thẻ
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select id="type" name="type" class="form-control">
                                                        <option  <?php if (isset($settings['type']) && $settings['type'] == 'gamebank' ){echo 'selected';}?> value="gamebank">Gamebank</option>
                                                        <option  <?php if (isset($settings['type']) && $settings['type'] == 'megapay' ){echo 'selected';}?> value="megapay">Megapay</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Eamil
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="eamil" name="eamil" value="<?=isset($settings['eamil'])?$settings['eamil']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Phome
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="phome" name="phome" value="<?=isset($settings['phome'])?$settings['phome']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Link_facebook
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="link_facebook" name="link_facebook" value="<?=isset($settings['link_facebook'])?$settings['link_facebook']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Link_google
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="link_google" name="link_google" value="<?=isset($settings['link_google'])?$settings['link_google']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Link_youtobe
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="link_youtobe" name="link_youtobe" value="<?=isset($settings['link_youtobe'])?$settings['link_youtobe']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Address
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" id="address" name="address" value="<?=isset($settings['address'])?$settings['address']:''?>"  class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"></label>
                                                <button type="button" onclick="validateForm()"  class="btn btn-primary"  name="save">Save changes</button
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    function notification (type,text)
    {
        new PNotify({
            title: 'Warning!',
            text: text,
            type: type,
            styling: 'bootstrap3'
        });
    }
    function validateForm() {
        document.getElementById("saver").submit();
        return true
    }
</script>
<!-- /page content -->