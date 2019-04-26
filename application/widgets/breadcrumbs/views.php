<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <?php
            if (isset($breadcrumbs) && count($breadcrumbs) > 0)
            {

                $count = count($breadcrumbs);
                foreach ($breadcrumbs as $key => $breadcrumb )
                {
                    if ($key+1 == $count)
                    {
                        ?>
                        <li class="active"><?=$breadcrumb['name']?></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="/<?=$breadcrumb['alias']?>.html"><span class="" aria-hidden="true"></span><?=$breadcrumb['name']?></a></li>
                        <?php
                    }
                }
            }
            ?>
        </ol>
    </div>
</div>