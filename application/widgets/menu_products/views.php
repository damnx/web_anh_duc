<div class="sidebar-row">
    <h4>Thể Loại</h4>
    <ul class="faq">
        <?php
if (isset($menus_products) && count($menus_products) > 0) {
    foreach ($menus_products as $menus) {
        if ($menus['type'] == 'category') {
            $link = '/' . $menus['category']['alias'] . '.html';
        } else {
            $link = $menus['link'];
        }
        if (isset($menus['mni']) && count($menus['mni']) > 0) {
            ?>
                        <li class="item"><a href="<?=$link?>"><?=$menus['name']?><span class="glyphicon glyphicon-menu-down"></span></a>
                            <ul>
                                <?php
if (isset($menus['mni']) && count($menus['mni']) > 0) {
                foreach ($menus['mni'] as $mni) {
                    if ($mni['type'] == 'category') {
                        $link = '/' . $mni['category']['alias'] . '.html';
                    } else {
                        $link = $mni['link'];
                    }
                    ?>
                                                <li class=""><a href="<?=$link?>"><?=$mni['name']?></a></li>
                                            <?php
}
            }
            ?>
                            </ul>
                        </li>
                        <?php
} else {
            echo ' <li onclick=myFunction("'.$link .'") class="accc"><a href="' . $link . '">' . $menus['name'] . '</a></li>';
        }

    }
}
?>
    </ul>
    <script type="text/javascript">
            function myFunction(url) {
                location.href = url;
            }
    </script>
    <!-- script for tabs -->
    <script type="text/javascript">
            
        $(function() {

            var menu_ul = $('.faq > li > ul'),
                menu_a  = $('.faq > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if(!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true,true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true,true).slideUp('normal');
                }
            });

        });
    </script>
    <!-- script for tabs -->
</div>