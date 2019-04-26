<!-- page content -->
<div class="right_col" role="main">
    <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>List <small>Product</small></h3>
                <a href="<?=URL?>/manager/product-iteam.html" class="btn btn-success"><i class="fa fa-plus"></i> Add Product</a>
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
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Status </th>
                                    <th class="column-title">Views</th>
                                    <th class="column-title no-link last"><span class="nobr">Feature</span>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                if (isset($products) && count($products)>0)
                                {
                                    $i = 0;
                                    foreach ($products as $product)
                                    {
                                        $i ++;
                                        if ($i % 2 == 0)
                                        {
                                            ?>
                                            <tr id="id-<?=isset($product['id'])?$product['id']:''?>" class="odd pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="flat" name="table_records">
                                                </td>
                                                <td><img height="40" src="<?=isset($product['thumb'])?$product['thumb']:''?>"></td>
                                                <td class=" ">
                                                    <a href="<?=URL?>/manager/product-iteam/<?=isset($product['id'])?$product['id']:''?>.html" style="color: #00CC00"><?=isset($product['name'])?$product['name']:''?></a>
                                                    <p>Name posts : <?=isset($product['use_admin'])?$product['use_admin']['full_name']:'..'?></p>
                                                    <a style="color:red " href="<?=URL?>/manager/product/pratt/<?=isset($product['id'])?$product['id']:''?>.html">Attribute  product : <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                                </td>
                                                <td class=""><?=isset($product['type'])?$product['type']:''?></td>
                                                <td class=" "><?=isset($product['status']) && $product['status'] == 1 ? 'Publish':'Pending'?></td>
                                                <td class=" "><?=isset($product['views']) ? $product['views']:'..'?></td>
                                                <td class="">
                                                    <div class="material-switch center">
                                                        <input onclick="feature(<?=isset($product['id'])?$product['id']:''?>)" id="feature<?=isset($product['id'])?$product['id']:''?>" <?=isset($product['feature']) && $product['feature'] == 1?'checked':''?> name="feature" type="checkbox"/>
                                                        <label for="feature<?=isset($product['id'])?$product['id']:''?>" class="label-success"></label>
                                                    </div>
                                                </td>
                                                <td class=" last">
                                                    <a  href="<?=URL?>/manager/product-iteam/<?=isset($product['id'])?$product['id']:''?>.html" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a onclick="remove(<?= $product['id']?>)" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <tr id="id-<?=isset($product['id'])?$product['id']:''?>" class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" class="flat" name="table_records">
                                                </td>
                                                <td><img height="40" src="<?=isset($product['thumb'])?$product['thumb']:''?>"></td>
                                                <td class=" ">
                                                    <a href="<?=URL?>/manager/product-iteam/<?=isset($product['id'])?$product['id']:''?>.html" style="color: #00CC00"><?=isset($product['name'])?$product['name']:''?></a>
                                                    <p>Name posts : <?=isset($product['use_admin'])?$product['use_admin']['full_name']:'..'?></p>
                                                    <a style="color:red " href="<?=URL?>/manager/product/pratt/<?=isset($product['id'])?$product['id']:''?>.html">Attribute  product : <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                                </td>
                                                <td class=""><?=isset($product['type'])?$product['type']:''?></td>
                                                <td class=" "><?=isset($product['status']) && $product['status'] == 1 ? 'Publish':'Pending'?></td>
                                                <td class=" "><?=isset($product['views']) ? $product['views']:'..'?></td>
                                                <td class="">
                                                    <div class="material-switch center">
                                                        <input onclick="feature(<?=isset($product['id'])?$product['id']:''?>)" id="feature<?=isset($product['id'])?$product['id']:''?>" <?=isset($product['feature']) && $product['feature'] == 1?'checked':''?> name="feature" type="checkbox"/>
                                                        <label for="feature<?=isset($product['id'])?$product['id']:''?>" class="label-success"></label>
                                                    </div>
                                                </td>
                                                <td class=" last">
                                                    <a  href="<?=URL?>/manager/product-iteam/<?=isset($product['id'])?$product['id']:''?>.html" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a onclick="remove(<?= $product['id']?>)" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
    function remove(id) {
        if (id)
        {
            var result = confirm("Want to delete?");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-product/delete", {id:id},
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
    function feature(id) {
        if (id)
        {
            $.post("<?=URL?>/manager/ajax-product/feature", {id:id},
                function(data)
                {
                    var data = jQuery.parseJSON(data);
                    var type = data.title;
                    var text = data.text;
                    onload =  notification (type,text);
                });

        }
    }
    function submit_search() {
        document.getElementById("search").submit();
    }
</script>
<!-- /page content -->