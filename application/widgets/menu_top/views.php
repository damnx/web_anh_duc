               <ul id="menu-top-nav" class="menu">
                    <?php 
                        foreach($menuTops as $key=>$value){
                            if ($value['id_category'] == 0){
                                $link = $value['link'];
                            }else{
                                $link =URL.'/'.$value['category']['alias'].'.html';
                            }
                          ?>
                          <li id="menu-item-4" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4"><a href="<?=$link?>"><?=$value['name']?></a></li>
                          <?php
                        }
                    ?>
                     
                  </ul>
