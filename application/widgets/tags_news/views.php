<?php
   if ( isset($tags) && count($tags) > 0)
   {
       ?>
       <div class="widget-sidebar">
           <h2 class="title-widget-sidebar">// Bài Viết Liên Quan <a href="/tin-tuc/tags/<?=isset($tags['alias'])?$tags['alias']:'GB'?>.html"><span class="see-more">xem thêm</span></a></h2>
           <div class="content-widget-sidebar">
               <ul>
                   <?php
                   if (isset($tags['posts']) && count($tags['posts']) > 0)
                   {
                       foreach ($tags['posts'] as $post)
                       {
                           ?>
                           <li class="recent-post simpleCart_shelfItem wow fadeInUp animated animated">
                               <div class="post-img"><a href="/tin-tuc/<?=$post['alias']?>.html"><img src="<?=$post['thumb']?>" class="img-responsive"></a></div>
                               <a  href="/tin-tuc/<?=$post['alias']?>.html"><h5 ><?=cutOf($post['title'],150,false)?></h5></a>
                               <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> <?=showDate($post['published'])?></small></p>
                           </li>
                           <hr>
                           <?php
                       }
                   }
                   ?>
               </ul>
           </div>
       </div>
        <?php
   }
?>
