var shriHari = {
  init: function() {
    shriHari.projectSlider();
    shriHari.imageSlider();
  },
  projectSlider: function() {
    var owl = $(".project-slider");
    owl.owlCarousel({
      items: 1,
      loop: false,
      margin: 10,
      lazyLoad: true,
      autoplay: false
    });
  },
  imageSlider: function() {
    var owl = $(".project-image-slider");
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 10,
      lazyLoad: true,
      autoplay: true,
      autoplaySpeed: 500,
      autoplayTimeout: 4000,
      autoHeight: true
    });
  }
};

(function($) {
  $(document).ready(function() {
    shriHari.init();
  });
})(jQuery);
