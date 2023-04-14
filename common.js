
// ローディングフェードイン 

  $(function() {
    setTimeout(function(){
      $('.fadeIn p').fadeIn(1600);
    },500); //0.5秒後にロゴをフェードイン
    setTimeout(function(){
      $('.fadeIn').fadeOut(500);
    },3000); //2.5秒後にロゴ含め真っ白背景をフェードアウト
  });

// ハンバーガーメニュー 

  $(function() {
    $('.open-line').on("click", function(){

    $(this).toggleClass('open');
    $('#nav').toggleClass('open');
  });
});

// メニューをクリックされたら非表示
$(function() {
  $('.nav-menu li a').on("click", function(){
    $('#nav').removeClass('open');
  });
});



// スムーズスクロール 

  $(function(){
    $('a[href^="#"]').click(function(){
      let speed = 500;
      let href= $(this).attr("href");
      let target = $(href == "#" || href == "" ? 'html' : href);
      let position = target.offset().top;
      $("html, body").animate({scrollTop:position}, speed, "swing");
      return false;
    });
  });


  // 各コンテンツをふっわっと表示させるJS 
    window.onload = function() {
      scroll_effect();

      $(window).scroll(function(){
      scroll_effect();
    });

    function scroll_effect(){
      $('.fade-up').each(function(){
        var elemPos = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > elemPos - windowHeight){
        $(this).addClass('effect-scroll');
        }
      });
      }
    };

  