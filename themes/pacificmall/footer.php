<?php if( ! is_front_page() ): ?>
        </div>
      </div>
    </main>
  </div>
</div>
<?php endif;
if ( ! $footer_cache = get_transient( 'footer_cache' ) ):
  ob_start();
?>
    <footer class="footer" id="footer">
      <div class="footerContents">
        <div class="footerContents-contact">
          <div class="enterprise-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/logo-footer.svg" alt="PACIFIC MALL DEVELOPMENT" />
          </div>
          <div class="enterprise-detail">
            <p class="name">パシフィックモール開発株式会社</p>
            <p class="address">
              東京都千代田区大手町0-1-2<br />
              パシフィックモールビルディング18F
            </p>
          </div>
        </div>
        <div class="footerContents-sitemap">
          <nav class="footer-nav">
<?php
wp_nav_menu(
  array (
    'theme_location' => 'place_footer',
    'container' => false,
  )
);
?>

          </nav>
        </div>
        <ul class='sns-navi'>
          <li class='twitter'><a href='https://twitter.com/5Wordpress'></a></li>
          <li class='facebook'><a href='https://www.facebook.com/wordpress5book'></a></li>
          <li class='instagram'><a href='https://www.instagram.com/5wordpress'></a></li>
        </ul>
      </div>
      <p class="copyright">
        <small class="copyright-text">&#169; 2019 PACIFIC MALL DEVELOPMENT CO.,LTD.</small>
      </p>
    </footer>
<?php
  $footer_cache = ob_get_clean();
  set_transient( 'footer_cache', $footer_cache, 60 * 5 );
  echo $footer_cache;
else:
  echo $footer_cache;
endif;
?>
  </div><!-- /.container -->
<?php wp_footer(); ?>
</body>
</html>
