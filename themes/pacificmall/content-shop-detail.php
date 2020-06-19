                        <li class="shopList-item">
                          <div class="shop-image">
<?php
$image_id = get_sub_field('shop_img');
echo wp_get_attachment_image($image_id, 'shop-detail');
?>
                          </div>
                          <div class="shop-body">
                            <p class="shop-title"><?php the_sub_field('shop_name');?></p>
                            <p class="shop-caption"><?php the_sub_field('shop_strength');?></p>
                            <div class="shop-detail">
                              <dl>
                                <dt>営業時間</dt>
                                <dd><?php the_sub_field('shop_hours');?></dd>
                              </dl>
                              <dl>
                                <dt>フロア情報</dt>
                                <dd><?php the_sub_field('floor_info'); ?></dd>
                              </dl>
                            </div>
                          </div>
                        </li>
