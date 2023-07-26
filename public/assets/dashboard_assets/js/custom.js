$('.nav-expand').click(function() {
  $('.site-wrap').toggleClass('act');
});

$('.time.clickable, .schedule-box-close').click(function() {
  $('.schedule-box-wrap').toggleClass('act');
});

$('.filter-action').click(function() {
  $(this).toggleClass('act');
  $('.table-inp').toggleClass('act');
});

$('.quiz-temp').click(function() {
  $('.quiz-creation').toggleClass('act');
  $('.slide-wrap').hide();
});


/*$('.open-res, .res-center-close').click(function() {
  $('.res-center').toggleClass('act');
});*/

/*$('.res-center-close').click(function() {
  $('.res-center').toggleClass('act');
});*/

$('.fancy-btn.step-1').click(function() { 
  $('.pay-step-1').hide();
  $('.pay-step-2').show();
});

$('.fancy-btn.pay-back').click(function() {
  $('.pay-step-2').hide();
  $('.pay-step-3').show();
});


// next previous tabs for preview Quiz
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
// next previous tabs for preview Quiz


// next previous tabs for Create Quiz
$('.btnNext2').click(function() {
  const nextTabLinkEl = $('.nav-tabs2 .active').closest('li').next('li').find('a')[0];
  const nextTab = new bootstrap.Tab(nextTabLinkEl);
  nextTab.show();
});
$('.btnPrevious2').click(function() {
  const prevTabLinkEl = $('.nav-tabs2 .active').closest('li').prev('li').find('a')[0];
  const prevTab = new bootstrap.Tab(prevTabLinkEl);
  prevTab.show();
});
// next previous tabs for Create Quiz



document.querySelectorAll('a.anchor[href^="#"]').forEach(a => {
  a.addEventListener('click', function (e) {
      e.preventDefault();
      var href = this.getAttribute("href");
      var elem = document.querySelector(href)||document.querySelector("a[name="+href.substring(1, href.length)+"]");
      window.scroll({
          top: elem.offsetTop - 80,
          left: 0,
          behavior: 'smooth'
      });
  });
});

