<?php get_header(); ?>
    <section class="section-contents" id="shop">
      <div class="wrapper">
<?php
$shop_obj = get_page_by_path('shop');
$post = $shop_obj;
setup_postdata($post);
$shop_title = get_the_title();
?>
        <span class="section-title-en"><?php the_field('english_title');?></span>
        <h2 class="section-title"><?php the_title(); ?></h2>
        <p class="section-lead"><?php echo get_the_excerpt(); ?></p>
<?php
wp_reset_postdata();
?>
        <ul class="shops">
<?php
$shop_pages = get_child_pages(4, $shop_obj->ID);
if( $shop_pages->have_posts() ):
  while( $shop_pages->have_posts() ): $shop_pages->the_post();
?>
          <li class="shops-item">
            <a class="shop-link" href="<?php the_permalink(); ?>">
              <div class="shop-image"><?php the_post_thumbnail('common'); ?></div>
              <div class="shop-body">
                <p class="name"><?php the_title();?></p>
                <p class="location"><?php the_field('location');?></p>
                <div class="buttonBox">
                  <button type="button" class="seeDetail">MORE</button>
                </div>
              </div>
            </a>
          </li>
<?php
  endwhile;
  wp_reset_postdata();
endif;
?>
        </ul>
        <div class="section-buttons">
          <button type="button" class="button button-ghost" onclick="javascript:location.href = '<?php echo esc_url(home_url('shop'))?>';">
            <?php echo $shop_title;?>一覧を見る
          </button>
        </div>
      </div>
    </section>
    <section class="section-contents" id="contribution">
      <div class="wrapper">
<?php
$contribution_obj = get_page_by_path('contribution');
$post = $contribution_obj;
setup_postdata($post);
$contribution_title = get_the_title();
?>
        <span class="section-title-en"><?php the_field('english_title');?></span>
        <h2 class="section-title"><?php the_title(); ?></h2>
        <p class="section-lead"><?php echo get_the_excerpt();?></p>
<?php wp_reset_postdata()?>
        <div class="articles">
<?php
// $contribution_pages = get_child_pages(3, $contribution_obj->ID);
$contribution_pages = get_specific_posts('daily_contribution', 'event', '', 3);
if( $contribution_pages->have_posts() ):
  while( $contribution_pages->have_posts() ): $contribution_pages->the_post();
?>
          <article class="article-card">
            <a class="card-link" href="<?php the_permalink(); ?>">
              <div class="card-inner">
                <div class="card-image"><?php the_post_thumbnail('front-contribution'); ?></div>
                <div class="card-body">
                  <p class="title"><?php the_title();?></p>
                  <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                  <div class="buttonBox">
                    <button type="button" class="seeDetail">MORE</button>
                  </div>
                </div>
              </div>
            </a>
          </article>
<?php
  endwhile;
  wp_reset_postdata();
endif;
?>
        </div>
        <div class="section-buttons">
          <button type="button" class="button button-ghost" onclick="javascript:location.href = '<?php echo esc_url(home_url('contribution')); ?>';">
            <?php echo $contribution_title?>一覧を見る
          </button>
        </div>
      </div>
    </section>
    <section class="section-contents" id="news">
      <div class="wrapper">
<?php
$term_obj = get_term_by('slug', 'news', 'category');
?>
        <span class="section-title-en"><?php the_field('english_title', $term_obj->taxonomy.'_'.$term_obj->term_id);?></span>
        <h2 class="section-title"><?php echo $term_obj->name; ?></h2>
        <p class="section-lead"><?php echo $term_obj->description; ?></p>
        <ul class="news">
<?php
$news_posts = get_specific_posts( 'post', 'category', 'news', 3);
if ( $news_posts->have_posts() ):
  while( $news_posts->have_posts() ): $news_posts->the_post();
?>
          <li class="news-item">
            <a class="detail-link" href="<?php the_permalink(); ?>">
              <time class="time"><?php the_time('Y.m.d'); ?></time>
              <p class="title"><?php the_title(); ?></p>
              <p class="news-text"><?php echo get_the_excerpt(); ?></p>
            </a>
          </li>
<?php
  endwhile;
  wp_reset_postdata();
endif;
?>
        </ul>
        <div class="section-buttons">
          <button type="button" class="button button-ghost" onclick="javascript:location.href = '<?php echo esc_url(get_term_link( $term_obj ))?>';">
            <?php echo $term_obj->name; ?>一覧を見る
          </button>
        </div>
      </div>
    </section>
    <section class="section-contents" id="company">
      <div class="wrapper">
<?php
$company_page = get_page_by_path('company');
$post = $company_page;
setup_postdata($post);
?>
        <span class="section-title-en"><?php the_field('english_title'); ?></span>
        <h2 class="section-title"><?php the_title(); ?></h2>
        <p class="section-lead"><?php echo get_the_excerpt(); ?></p>
        <div class="section-buttons">
          <button type="button" class="button button-ghost" onclick="javascript:location.href = '<?php echo esc_url(home_url('company'))?>';">
            <?php the_title(); ?>一覧を見る
          </button>
        </div>
<?php
wp_reset_postdata();
?>
      </div>
    </section>
<?php get_footer(); ?>