<!-- page content -->
<div class="right_col" role="main">
    <link href="<?=CDN?>/backend/css/green.css?gb=<?=time()?>" rel="stylesheet">
    <div class="">
        <div class="page-title">

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form id="form" method="post" action="">
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <p>Thuộc tính thuộc danh mục sản phẩm<span>(*)</span></p>
                    <p></p>
                </div>
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Danh mục <small>sản phẩm</small></h2>
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
                            <?php
                            if (!isset($attribute['category']))
                            {
                                $category_check = array();
                            }
                            else
                            {
                                $category_check = $attribute['category'];
                            }
                            if (isset($categorys) && is_array($categorys))
                            {
                                echo showCategories($categorys,0,'',$category_check);
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <p>Tên thuộc tính<span>(*)</span></p>
                </div>
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Tên thuộc tính <small</small></h2>
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
                            <input type="hidden" id="id"  name="id" value="<?=isset($attribute['id'])?$attribute['id']:''?>" class="form-control">
                            <input type="text" id="name" name="name" value="<?=isset($attribute['name'])?$attribute['name']:''?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <p> Chi tiết thuộc tính<span></span></p>
                </div>
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Tên <small> chi tiết thuộc tính</small></h2>
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
                            <div id="content">
                                <?php
                                    if (isset($attribute['detail_attribute']) && count($attribute['detail_attribute']) > 0)
                                    {
                                        $i=0;
                                        foreach ($attribute['detail_attribute'] as $detail )
                                        {
                                          $i++;
                                          ?>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <input class="form-control" type="hidden" name="details[<?=$i?>][id_details]" id="details" value="<?=$detail['id']?>">
                                                    <input class="form-control" type="text" name="details[<?=$i?>][name]" id="details" value="<?=$detail['name']?>">
                                                </div>
                                                <input type="button" class="btn btn-success" value="+" onclick="addRow()">
                                                <input type="hidden" id="countStock" value="0" />
                                                <input type="button" class="btn btn-danger" value="-" onclick="removeRow(this),removeDetails(<?=$detail['id']?>)">
                                            </div>
                                           <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <input class="form-control" type="hidden" name="details[1][id_details]" id="details" value="">
                                                    <input class="form-control" type="text" name="details[1][name]" id="details" value="">
                                                </div>
                                                <input type="button" class="btn btn-success" value="+" onclick="addRow()">
                                                <input type="hidden" id="countStock" value="0" />
                                                <input type="button" class="btn btn-danger" value="-" onclick="removeRow(this)">
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <p> <span></span></p>
                </div>
                <div class="col-md-8">
                    <button type="button" onclick="validateForm()" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>
<script type="text/javascript">
    <?php
    if (isset($attribute['detail_attribute']) && count($attribute['detail_attribute']) > 0)
    {
        ?>
            var i = <?=count($attribute['detail_attribute'])?>;
        <?php
    }
    else
    {
        ?>
            var i = 1;
        <?php
    }
    ?>
    function addRow() {
        i++;
        var div = document.createElement('div');
        div.className = 'form-group';
        div.innerHTML = '<div class="col-md-6">\
        <input class="form-control" type="hidden" name="details['+i+'][id_details]" id="details" value="" />\
        <input class="form-control" type="text" name="details['+i+'][name]" id="details" value="" /></div>\
        <input type="button" class="btn btn-success" value="+" onclick="addRow()">\
        <input type="button" class="btn btn-danger" value="-" onclick="removeRow(this)">';
        document.getElementById('content').appendChild(div);
    }
    function removeRow(input) {
        document.getElementById('content').removeChild( input.parentNode );
    }
    function notification (type,text) {
        new PNotify({
            title: 'Warning!',
            text: text,
            type: type,
            styling: 'bootstrap3'
        });
    }
    function validateForm() {
        var id = document.forms["form"]["id"].value;
        var name = document.forms["form"]["name"].value;
        if (name == "")
        {
            var type ='error';
            var text ='name not null';
            onload =  notification (type,text);
            return false;
        }
        document.getElementById("form").submit();
        return true
    }
    function removeDetails(id) {
        if (id)
        {
            var result = confirm("Want to delete?");
            if (result)
            {
                $.post("<?=URL?>/manager/ajax-attribute/deleteDetails", {id:id},
                    function(data)
                    {
                        var data = jQuery.parseJSON(data);
                        var type = data.title;
                        var text = data.text;
                        onload =  notification (type,text);
                    });
            }

        }
    }
</script>
<!-- /page content -->