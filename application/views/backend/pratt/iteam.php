<!-- page content -->
<div class="right_col" role="main">
    <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product  <small>attribute</small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <form method="get" id="search">
                        <div class="input-group">

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
                        <div class="table-responsive" style="overflow: hidden !important;padding-bottom: 10px">
                            <?php
                                if (isset($attributes) && count($attributes))
                                {
                                    foreach ($attributes as $attribute)
                                    {
                                        ?>
                                            <h3><?=$attribute['name']?></h3>
                                            <div class="row">
                                                <?php
                                                    if (isset($attribute['detail_attribute']) && count($attribute['detail_attribute']))
                                                    {
                                                        foreach ($attribute['detail_attribute'] as $detail)
                                                        {
                                                            ?>
                                                                <div class="form-group attribute  col-sm-3">
                                                                <label style="padding-top: 7px" class="control-label col-sm-4" for="frm-test-elm-120-<?=$detail['id']?>"><?=$detail['name']?> : </label>
                                                                <div class="col-sm-8">
                                                                    <?php
                                                                    if (isset($product_detail_attribute) && count($product_detail_attribute))
                                                                    {
                                                                        if (in_array($detail['id'],$product_detail_attribute))
                                                                        {
                                                                            ?>
                                                                            <input onclick="detail(<?=$detail['id']?>,<?=$pr_id?>,<?=$attribute['id']?>)" checked  type="checkbox" name="checkboxes[]" value="<?=$detail['id']?>" id="frm-test-elm-120-<?=$detail['id']?>" autocomplete="off" />
                                                                            <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                            <input onclick="detail(<?=$detail['id']?>,<?=$pr_id?>,<?=$attribute['id']?>)"  type="checkbox" name="checkboxes[]" value="<?=$detail['id']?>" id="frm-test-elm-120-<?=$detail['id']?>" autocomplete="off" />
                                                                            <?php
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <input onclick="detail(<?=$detail['id']?>,<?=$pr_id?>,<?=$attribute['id']?>)"  type="checkbox" name="checkboxes[]" value="<?=$detail['id']?>" id="frm-test-elm-120-<?=$detail['id']?>" autocomplete="off" />
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="btn-group">
                                                                        <label for="frm-test-elm-120-<?=$detail['id']?>" class="btn btn-primary">
                                                                            <span class="fa fa-check-square-o fa-lg"></span>
                                                                            <span class="fa fa-square-o fa-lg"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
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
    function detail(id,pr_id,id_att) {
        if(id) {
            $.post("<?=URL?>/manager/ajax-pratt/checkbox", {id:id,pr_id:pr_id,id_att:id_att},
                function(data)
                {
                    var data = jQuery.parseJSON(data);
                    var type = data.title;
                    var text = data.text;
                    onload =  notification (type,text);
                });
        }
    }

</script>
<!-- /page content -->