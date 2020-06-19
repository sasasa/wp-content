(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory() :
	typeof define === 'function' && define.amd ? define(factory) :
	(factory());
}(this, (function () { 'use strict';

var scrollTopY = 0;

jQuery(document).ready(function() {
  localNavi();
  activeNav();
  addHeaderClass();
  onscrollHeadFollow();
  onClickNav();
  onClickSearchIcon();
  privacy_policy_class();
  localNavi();
});

function activeNav() {
  var url = window.location.href;
  var path_ary = location.pathname.split('/');
  var page_id = jQuery('.page-main').attr('id');
  var body_class = jQuery('body').attr( 'class' );
  jQuery('.global-nav a').addClass('nav-link');
  if( path_ary[1] == '' ) {
  	jQuery('.global-nav a[href="'+url+'"]').addClass('active');
  }
  else if( path_ary[1] == 'archives' && page_id == 'pg-contribution' || body_class.indexOf('contribution-template') != -1 ) {
  	url = window.location.origin + '/contribution/';
  	jQuery('.global-nav a[href="'+url+'"]').addClass('active');
  }
  else if( path_ary[1] == 'archives' && ['pg-news', 'pg-newsDetail'].includes(page_id) ) {
  	url = window.location.origin + '/archives/category/news/';
  	jQuery('.global-nav a[href="'+url+'"]').addClass('active');
  }
  else if( url.match(path_ary[1]) ) {
	var url = window.location.origin + '/' + path_ary[1] + '/';
  	jQuery('.global-nav a').addClass('nav-link');
  	jQuery('.global-nav a[href="'+url+'"]').addClass('active');
  }
}

function addHeaderClass(){
	var path_url = location.href.split('/');
	if( path_url[3] ){
  		jQuery('header').addClass('header standby fixed js-header');
	} 
	else {
  		jQuery('header').addClass('header js-fix-header js-header');
	}
}

function privacy_policy_class() {
  var pathname = window.location.pathname;
  var path_ary = pathname.split('/');
  if( path_ary[1] == 'privacy-policy' ) {
    jQuery('body').addClass('privacy');
  }
}

/**
 * スクロールに応じたヘッダー固定切り替え
 */
function onscrollHeadFollow() {
  var $header = jQuery('.js-fix-header');
  var headerH = $header.outerHeight();
  var overplus = jQuery(window).outerWidth() * 0.1;
  jQuery(window).on('scroll', function() {
    if (jQuery(window).scrollTop() > headerH + overplus) {
      // 固定ヘッダー時
      $header.css({ 'transition': 'transform .5s ease-out' });
      $header.addClass('standby').addClass('fixed');
    } else if (jQuery(window).scrollTop() > headerH) {
      // 固定ヘッダー準備時
      if ($header.hasClass('standby')) {
        $header.css({ 'transition': 'transform .5s ease-out' });
      } else {
        $header.css({ 'transition': '' });
      }
      $header.addClass('standby').removeClass('fixed');
    } else {
      // 通常時
      $header.css({ 'transition': '' });
      $header.removeClass('standby fixed');
    }
  });
}

/**
 * SPハンバーガーメニュー押下時のイベントをセット
 */
function onClickNav() {
  var $toggleNav = jQuery('.js-toggoleNav');
  var $header = jQuery('.js-header');
  $toggleNav.on('click', function() {
    if ($header.hasClass('open')) {
      $header.removeClass('open');
      fixedBase('close');
    } else {
      $header.addClass('open');
      fixedBase('open');
    }
    
  });
}

/**
 * メニュー押下時に背景を固定する
 */
function fixedBase(toggle) {
  var $window = jQuery(window);
  var $body = jQuery('body');

  switch(toggle) {
    case 'open':
      // 現在のスクロール位置を保管
      scrollTopY = $window.scrollTop();
      // 下層コンテナの固定化
      $body.css({
        'position': 'fixed',
        'top': -1 * scrollTopY
      });
      break;
    case 'close':
      $body.attr({ style: '' });
      $window.scrollTop(scrollTopY);
      break;
  }
}

/**
 * PC検索アイコン押下時のイベントをセット
 */
function onClickSearchIcon() {
  var $searchIcon = jQuery('.js-searchIcon');
  var $header = jQuery('.js-header');
  $searchIcon.on('click', function() {
    if ($header.hasClass('search-mode')) {
      $header.removeClass('search-mode');
    } else {
      $header.addClass('search-mode');
      jQuery(document).click(function(event) {
        if(!$(event.target).closest($header).length) {
          $header.removeClass('search-mode');
        }
      });
    }
  });
}

/**
 *  ローカルでhtmlを確認した際に、headerにclassを付与する
 */
function localNavi() {
  var protocol = location.protocol
  if( protocol == "file:" ){
    var path_ary = location.pathname.split('/');
    var file_name = path_ary.pop();
    if( file_name == 'start.html' ){
  		jQuery('header').addClass('header js-fix-header js-header');
    } else {
  		jQuery('header').addClass('header standby fixed js-header');
    }
	} 
}

})));
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYnVuZGxlLmpzIiwic291cmNlcyI6WyIuLi8uLi8uLi9fcmVzb3VyY2UvYXNzZXRzL2J1bmRsZWpzL2luZGV4LmpzIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBzY3JvbGxUb3BZID0gMDtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gIG9uc2Nyb2xsSGVhZEZvbGxvdygpO1xuICBvbkNsaWNrTmF2KCk7XG4gIG9uQ2xpY2tTZWFyY2hJY29uKCk7XG59KTtcblxuLyoqXG4gKiDjgrnjgq/jg63jg7zjg6vjgavlv5zjgZjjgZ/jg5jjg4Pjg4Djg7zlm7rlrprliIfjgormm7/jgYhcbiAqL1xuZnVuY3Rpb24gb25zY3JvbGxIZWFkRm9sbG93KCkge1xuICB2YXIgJGhlYWRlciA9ICQoJy5qcy1maXgtaGVhZGVyJyk7XG4gIHZhciBoZWFkZXJIID0gJGhlYWRlci5vdXRlckhlaWdodCgpO1xuICB2YXIgb3ZlcnBsdXMgPSAkKHdpbmRvdykub3V0ZXJXaWR0aCgpICogMC4xO1xuICAkKHdpbmRvdykub24oJ3Njcm9sbCcsIGZ1bmN0aW9uKCkge1xuICAgIGlmICgkKHdpbmRvdykuc2Nyb2xsVG9wKCkgPiBoZWFkZXJIICsgb3ZlcnBsdXMpIHtcbiAgICAgIC8vIOWbuuWumuODmOODg+ODgOODvOaZglxuICAgICAgJGhlYWRlci5jc3MoeyAndHJhbnNpdGlvbic6ICd0cmFuc2Zvcm0gLjVzIGVhc2Utb3V0JyB9KTtcbiAgICAgICRoZWFkZXIuYWRkQ2xhc3MoJ3N0YW5kYnknKS5hZGRDbGFzcygnZml4ZWQnKTtcbiAgICB9IGVsc2UgaWYgKCQod2luZG93KS5zY3JvbGxUb3AoKSA+IGhlYWRlckgpIHtcbiAgICAgIC8vIOWbuuWumuODmOODg+ODgOODvOa6luWCmeaZglxuICAgICAgaWYgKCRoZWFkZXIuaGFzQ2xhc3MoJ3N0YW5kYnknKSkge1xuICAgICAgICAkaGVhZGVyLmNzcyh7ICd0cmFuc2l0aW9uJzogJ3RyYW5zZm9ybSAuNXMgZWFzZS1vdXQnIH0pO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgJGhlYWRlci5jc3MoeyAndHJhbnNpdGlvbic6ICcnIH0pO1xuICAgICAgfVxuICAgICAgJGhlYWRlci5hZGRDbGFzcygnc3RhbmRieScpLnJlbW92ZUNsYXNzKCdmaXhlZCcpO1xuICAgIH0gZWxzZSB7XG4gICAgICAvLyDpgJrluLjmmYJcbiAgICAgICRoZWFkZXIuY3NzKHsgJ3RyYW5zaXRpb24nOiAnJyB9KTtcbiAgICAgICRoZWFkZXIucmVtb3ZlQ2xhc3MoJ3N0YW5kYnkgZml4ZWQnKTtcbiAgICB9XG4gIH0pO1xufVxuXG4vKipcbiAqIFNQ44OP44Oz44OQ44O844Ks44O844Oh44OL44Ol44O85oq85LiL5pmC44Gu44Kk44OZ44Oz44OI44KS44K744OD44OIXG4gKi9cbmZ1bmN0aW9uIG9uQ2xpY2tOYXYoKSB7XG4gIHZhciAkdG9nZ2xlTmF2ID0gJCgnLmpzLXRvZ2dvbGVOYXYnKTtcbiAgdmFyICRoZWFkZXIgPSAkKCcuanMtaGVhZGVyJyk7XG4gICR0b2dnbGVOYXYub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgaWYgKCRoZWFkZXIuaGFzQ2xhc3MoJ29wZW4nKSkge1xuICAgICAgJGhlYWRlci5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgZml4ZWRCYXNlKCdjbG9zZScpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkaGVhZGVyLmFkZENsYXNzKCdvcGVuJyk7XG4gICAgICBmaXhlZEJhc2UoJ29wZW4nKTtcbiAgICB9XG4gICAgXG4gIH0pO1xufVxuXG4vKipcbiAqIOODoeODi+ODpeODvOaKvOS4i+aZguOBq+iDjOaZr+OCkuWbuuWumuOBmeOCi1xuICovXG5mdW5jdGlvbiBmaXhlZEJhc2UodG9nZ2xlKSB7XG4gIHZhciAkd2luZG93ID0gJCh3aW5kb3cpO1xuICB2YXIgJGJvZHkgPSAkKCdib2R5Jyk7XG5cbiAgc3dpdGNoKHRvZ2dsZSkge1xuICAgIGNhc2UgJ29wZW4nOlxuICAgICAgLy8g54++5Zyo44Gu44K544Kv44Ot44O844Or5L2N572u44KS5L+d566hXG4gICAgICBzY3JvbGxUb3BZID0gJHdpbmRvdy5zY3JvbGxUb3AoKTtcbiAgICAgIC8vIOS4i+WxpOOCs+ODs+ODhuODiuOBruWbuuWumuWMllxuICAgICAgJGJvZHkuY3NzKHtcbiAgICAgICAgJ3Bvc2l0aW9uJzogJ2ZpeGVkJyxcbiAgICAgICAgJ3RvcCc6IC0xICogc2Nyb2xsVG9wWVxuICAgICAgfSk7XG4gICAgICBicmVhaztcbiAgICBjYXNlICdjbG9zZSc6XG4gICAgICAkYm9keS5hdHRyKHsgc3R5bGU6ICcnIH0pO1xuICAgICAgJHdpbmRvdy5zY3JvbGxUb3Aoc2Nyb2xsVG9wWSk7XG4gICAgICBicmVhaztcbiAgfVxufVxuXG4vKipcbiAqIFBD5qSc57Si44Ki44Kk44Kz44Oz5oq85LiL5pmC44Gu44Kk44OZ44Oz44OI44KS44K744OD44OIXG4gKi9cbmZ1bmN0aW9uIG9uQ2xpY2tTZWFyY2hJY29uKCkge1xuICB2YXIgJHNlYXJjaEljb24gPSAkKCcuanMtc2VhcmNoSWNvbicpO1xuICB2YXIgJGhlYWRlciA9ICQoJy5qcy1oZWFkZXInKTtcbiAgJHNlYXJjaEljb24ub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgaWYgKCRoZWFkZXIuaGFzQ2xhc3MoJ3NlYXJjaC1tb2RlJykpIHtcbiAgICAgICRoZWFkZXIucmVtb3ZlQ2xhc3MoJ3NlYXJjaC1tb2RlJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICRoZWFkZXIuYWRkQ2xhc3MoJ3NlYXJjaC1tb2RlJyk7XG4gICAgICAkKGRvY3VtZW50KS5jbGljayhmdW5jdGlvbihldmVudCkge1xuICAgICAgICBpZighJChldmVudC50YXJnZXQpLmNsb3Nlc3QoJGhlYWRlcikubGVuZ3RoKSB7XG4gICAgICAgICAgJGhlYWRlci5yZW1vdmVDbGFzcygnc2VhcmNoLW1vZGUnKTtcbiAgICAgICAgfVxuICAgICAgfSlcbiAgICB9XG4gIH0pO1xufSJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoi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

