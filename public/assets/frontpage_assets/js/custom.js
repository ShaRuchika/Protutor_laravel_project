$('.btnNext').click(function() {
  const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
  const nextTab = new bootstrap.Tab(nextTabLinkEl);
  nextTab.show();
});
$('.btnPrevious').click(function() {
  const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
  const prevTab = new bootstrap.Tab(prevTabLinkEl);
  prevTab.show();
});

// $(document).ready(function() {
//   var typed = new Typed('#typed', {
//     stringsElement: '#typed-strings',
//     loop: true,
//     typeSpeed: 30,
//     backDelay: 3000,
//     fadeIn: true,
//     fadeOut: true,
//   });
// });

$(document).ready(function() {
  $('.js-tilt').tilt({
    maxTilt: 3,
  })
});

AOS.init({
  delay: 100,
  duration: 1000,
  disable: function() {
    var maxWidth = 800;
    return window.innerWidth < maxWidth;
  },
  once: true,
});

$('.mobClick').click(function() {
  $(this).toggleClass('open');
  $('.site-nav').toggleClass('act');
});

$('.nav-list').on('click', 'li', function() {
  $('.nav-list li.active').removeClass('active');
  $(this).addClass('active');
});


$(document).ready(function() {
  $(".tabs-menu a").hover(function() {
      $(this).parent().addClass("current");
      $(this).parent().siblings().removeClass("current");
      var tab = $(this).attr("href");
      $(".tab-content").not(tab).css("display", "none");
      $(tab).show();
  });
$(".tabs-menu a").click(function(e) { 
      e.preventDefault();
});
$(".tabs-menu li:first-child").addClass("current");
});


$(document).ready(function() {
  var quotes = $(".quotes");
  var quoteIndex = -1;
  function showNextQuote() {
      ++quoteIndex;
      quotes.eq(quoteIndex % quotes.length)
          .fadeIn(500)
          .delay(3000)
          .fadeOut(500, showNextQuote);
  }
  showNextQuote();
});


$(".show-more").click(function () {
  $(this).text(function(i, v){
     return v === 'Show More' ? 'Show Less' : 'Show More'
  })
  $('.proView').toggleClass('act');
});

