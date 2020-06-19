<?php get_header(); ?>
              <div class="page-inner">
                <div class="page-main" id="pg-contribution">
                  <div class="contribution">
<?php
$term = get_specific_posts('daily_contribution', 'event', $term, -1);
if ($term->have_posts()):
  while( $term->have_posts() ): $term->the_post();
    get_template_part('content-tax');
  endwhile;
endif;
?>
                  </div>
                </div>
              </div>
<?php get_footer(); ?>