$('.mobClick').click(function() {
  $(this).toggleClass('open');
  $('.sidebar').toggleClass('act');
});


$('#sarch-expand').focus(function () {
  $('.search-bar-group').slideToggle();
}).blur(function () {
  // $('.search-bar-group').slideToggle();
});


// next previous tabs
$('.btnNext').click(function() {
  const nextTabLinkEl = $('.nav-tabs-first .active').closest('li').next('li').find('a')[0];
  const nextTab = new bootstrap.Tab(nextTabLinkEl);
  nextTab.show();
});
$('.btnPrevious').click(function() {
  const prevTabLinkEl = $('.nav-tabs-first .active').closest('li').prev('li').find('a')[0];
  const prevTab = new bootstrap.Tab(prevTabLinkEl);
  prevTab.show();
});
// next previous tabs


// next previous tabs
$('.btnNext2').click(function() {
  const nextTabLinkEl = $('.nav-tabs-first2 .active').closest('li').next('li').find('a')[0];
  const nextTab = new bootstrap.Tab(nextTabLinkEl);
  nextTab.show();
});
$('.btnPrevious2').click(function() {
  const prevTabLinkEl = $('.nav-tabs-first2 .active').closest('li').prev('li').find('a')[0];
  const prevTab = new bootstrap.Tab(prevTabLinkEl);
  prevTab.show();
});
// next previous tabs



$(function(){
  $("#value-check").change(function() {
    $(".dash-stats-single").toggleClass("act", this.checked)
  }).change();
});



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

