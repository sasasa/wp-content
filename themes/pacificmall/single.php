<?php get_header(); ?>
              <div class="page-inner full-width">
                <div class="page-main" id="pg-newsDetail">
                  <div class="main-container">
                    <div class="main-wrapper">
<?php
if( have_posts() ):
  while( have_posts() ): the_post();
    get_template_part( 'content-single' );
  endwhile;
endif;
?>
                    </div>
                  </div>
                </div>
              </div>
<?php get_footer(); ?>