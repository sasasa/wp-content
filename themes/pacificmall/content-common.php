<li class="common-item">
  <a class="common-link" href="<?php the_permalink(); ?>">
    <div class="common-image"><?php the_post_thumbnail('common');?></div>
    <div class="common-body">
      <p class="name"><?php the_title(); ?></p>
      <p class="caption"><?php echo get_flexible_excerpt(40); ?></p>
      <div class="buttonBox">
        <button type="button" class="seeDetail">MORE</button>
      </div>
    </div>
  </a>
</li>
