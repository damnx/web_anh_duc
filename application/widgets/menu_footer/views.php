<div class="col-md-4 footer-grids wow fadeInUp animated" data-wow-delay=".7s">
    <h3>Phổ biến</h3>
    <ul>
        <?php
            if (isset($menus_footer) && count($menus_footer) > 0)
            {
                foreach ($menus_footer as $menu)
                {
                    if ($menu['id_category'] == 0)
                        $link = $menu['link'];
                    else
                        $link =URL.'/'.$menu['category']['alias'].'.html';
                    ?>
                    <li><a href="<?=$link?>"><?=$menu['name']?></a></li>
                    <?php
                }
            }
        ?>
    </ul>
</div>