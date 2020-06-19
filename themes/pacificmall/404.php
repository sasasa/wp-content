<?php get_header();?>
              <div class="page-inner">
                <div class="page-main" id="pg-error">
                  <div class="dataList-inner">
                    <h3>ページが見つかりません</h3>
                    <p>
                      お探しのページは、移動または削除された可能性があります。<br />
                      サイト内検索、または下部フッターリンクより目的のページをお探しください。
                    </p>
                    <form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
                      <div class="search-box">
                        <input type="text" name="s" class="search-input" placeholder="キーワードを入力してください" value="">
                        <button type="submit" class="button button-submit">検索</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
<?php get_footer();?>