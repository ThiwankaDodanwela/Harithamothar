$(document).ready(function() {
  homepage.init();
  general.init();
  horVerSlider.init();
});

var general = {
  init: function() {
    general.pageslide();
  },
  pageslide: function() {
    $("nav ul li").on("click", function() {
      general.toggleClassFn();
      var _class = $(this).attr("class");
      $(".pages")
        .animate(
          {
            width: "0"
          },
          500,
          function() {
            // Animation complete.
          }
        )
        .removeClass("active");
      $("#" + _class)
        .animate(
          {
            width: "100%"
          },
          500,
          function() {
            // Animation complete.
          }
        )
        .addClass("active");
    });
  },
  toggleClassFn: function() {
    $(".stick").toggleClass(function() {
      return $(this).is(".open, .close") ? "open close" : "open";
    });
    $("body").toggleClass(function() {
      return $(this)
        .closest("body")
        .is(".navopen, .navclose")
        ? "navopen navclose"
        : "navopen";
    });
  }
};

var homepage = {
  init: function() {
    homepage.slider();
    homepage.hamburger();
  },
  slider: function() {
    var owl = $("#homeslider");
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayHoverPause: true
    });
  },
  hamburger: function() {
    $(".hamb-wrap").click(function() {
      general.toggleClassFn();
    });
  }
};

var projectpage = {
  init: function() {}
};

var apoorva = {
  init: function() {
    apoorva.lazySlider();
  },
  lazySlider: function() {
    $("#apoorvalist").owlCarousel({
      items: 1,
      lazyLoad: true,
      loop: true,
      margin: 10
    });
  }
};

function initMap() {
  var myLatLng = { lat: 6.913135, lng: 79.904573 };
  var image = "<?php bloginfo( 'template_directory' ); ?>/images/mapicon.png";
  var map = new google.maps.Map(document.getElementById("map"), {
    center: myLatLng,
    zoom: 16,
    styles: [
      {
        elementType: "geometry",
        stylers: [{ color: "#f5f5f5" }]
      },
      {
        elementType: "labels.icon",
        stylers: [{ visibility: "off" }]
      },
      {
        elementType: "labels.text.fill",
        stylers: [{ color: "#616161" }]
      },
      {
        elementType: "labels.text.stroke",
        stylers: [{ color: "#f5f5f5" }]
      },
      {
        featureType: "administrative.land_parcel",
        elementType: "labels.text.fill",
        stylers: [{ color: "#bdbdbd" }]
      },
      {
        featureType: "poi",
        elementType: "geometry",
        stylers: [{ color: "#eeeeee" }]
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [{ color: "#757575" }]
      },
      {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{ color: "#e5e5e5" }]
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [{ color: "#9e9e9e" }]
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [{ color: "#ffffff" }]
      },
      {
        featureType: "road.arterial",
        elementType: "labels.text.fill",
        stylers: [{ color: "#757575" }]
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [{ color: "#dadada" }]
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.fill",
        stylers: [{ color: "#616161" }]
      },
      {
        featureType: "road.local",
        elementType: "labels.text.fill",
        stylers: [{ color: "#9e9e9e" }]
      },
      {
        featureType: "transit.line",
        elementType: "geometry",
        stylers: [{ color: "#e5e5e5" }]
      },
      {
        featureType: "transit.station",
        elementType: "geometry",
        stylers: [{ color: "#eeeeee" }]
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [{ color: "#c9c9c9" }]
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{ color: "#9e9e9e" }]
      }
    ]
  });
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    icon: image
  });
}

horVerSlider = {
  HWidth: 500,
  HHeight: 500,
  HElement: $("#horizon-slider"),
  HElementCount: "",
  HElemIndex: 0,
  HMouseDown: false,
  HToughDown: false,
  HMovement: 0,
  HOldX: 0,
  HtoughedAt: 0,

  VWidth: 100,
  VHeight: 130,
  VElement: $("#vertical-slider"),
  VElementCount: "",
  VElemIndex: 0,
  VMouseDown: false,
  VToughDown: false,
  VMovement: 0,
  HOldY: 0,
  VtoughedAt: 0,

  dotsHTML: "",
  init: function() {
    horVerSlider.setSlider();
    horVerSlider.HmouseMove();
    horVerSlider.HtoughMove();
    horVerSlider.VmouseMove();
    horVerSlider.VtoughMove();
    horVerSlider.HNav();
    horVerSlider.VNav();
    horVerSlider.verticalClick();
    horVerSlider.dotClick();
    horVerSlider.lazyLoad();
    horVerSlider.lightBox();
  },
  HmouseMove: function() {
    $(horVerSlider.HElement)
      .on("mousedown", function(e1) {
        horVerSlider.HMouseDown = true;
        horVerSlider.HOldX = e1.pageX;
      })
      .on("mouseup", function(e1) {
        horVerSlider.HMouseDown = false;
      });
    $(horVerSlider.HElement).mousemove(function(e2) {
      if (horVerSlider.HMouseDown) {
        $("img").on("dragstart", function(event) {
          event.preventDefault();
        });
        if (e2.pageX > horVerSlider.HOldX) {
          if (horVerSlider.HMovement != 0) {
            horVerSlider.HMovement += horVerSlider.HWidth;
            horVerSlider.moveRight();
            horVerSlider.VElemIndex -= 1;
            horVerSlider.HElemIndex -= 1;
          }
          horVerSlider.HMouseDown = false;
        } else if (e2.pageX != horVerSlider.HOldX) {
          if (
            horVerSlider.HMovement !=
            -((horVerSlider.HElementCount - 1) * horVerSlider.HWidth)
          ) {
            horVerSlider.HMovement -= horVerSlider.HWidth;
            horVerSlider.moveLeft();
            horVerSlider.VElemIndex += 1;
            horVerSlider.HElemIndex += 1;
          }
          horVerSlider.HMouseDown = false;
        }
        horVerSlider.handleVertElm(horVerSlider.VElemIndex);
      }
    });
  },
  VmouseMove: function() {
    $(horVerSlider.VElement)
      .on("mousedown", function(e1) {
        horVerSlider.VMouseDown = true;
        horVerSlider.HOldY = e1.pageY;
      })
      .on("mouseup", function(e1) {
        horVerSlider.VMouseDown = false;
      });
    $(horVerSlider.VElement).mousemove(function(e2) {
      if (horVerSlider.VMouseDown) {
        $("img").on("dragstart", function(event) {
          event.preventDefault();
        });
        if (e2.pageY > horVerSlider.HOldY) {
          if (horVerSlider.VMovement != 0) {
            horVerSlider.VMovement += horVerSlider.VHeight;
            horVerSlider.moveDown();
            horVerSlider.VElemIndex -= 1;
            horVerSlider.HElemIndex -= 1;
          }
          horVerSlider.VMouseDown = false;
        } else if (e2.pageY != horVerSlider.HOldY) {
          if (
            horVerSlider.VMovement - horVerSlider.VHeight * 3 !=
            -((horVerSlider.VElementCount - 1) * horVerSlider.VHeight)
          ) {
            horVerSlider.VMovement -= horVerSlider.VHeight;
            horVerSlider.moveUp();
            horVerSlider.VElemIndex += 1;
            horVerSlider.HElemIndex += 1;
          }
          horVerSlider.VMouseDown = false;
        }
        horVerSlider.handleHorizElm(horVerSlider.HElemIndex);
      }
    });
  },
  HtoughMove: function() {
    $(horVerSlider.HElement)
      .on("touchstart", function(e1) {
        horVerSlider.HToughDown = true;
        horVerSlider.HtoughedAt = e1.originalEvent.touches[0].pageX;
      })
      .mouseup(function() {
        horVerSlider.HToughDown = false;
      });
    $(horVerSlider.HElement).on("touchmove", function(e2) {
      if (horVerSlider.HToughDown) {
        $("img").on("dragstart", function(event) {
          event.preventDefault();
        });
        if (e2.originalEvent.touches[0].pageX > horVerSlider.HtoughedAt) {
          if (horVerSlider.HMovement != 0) {
            horVerSlider.HMovement += horVerSlider.HWidth;
            horVerSlider.moveRight();
            horVerSlider.VElemIndex -= 1;
            horVerSlider.HElemIndex -= 1;
          }
          horVerSlider.HToughDown = false;
        } else {
          if (
            horVerSlider.HMovement !=
            -((horVerSlider.HElementCount - 1) * horVerSlider.HWidth)
          ) {
            horVerSlider.HMovement -= horVerSlider.HWidth;
            horVerSlider.moveLeft();
            horVerSlider.VElemIndex += 1;
            horVerSlider.HElemIndex += 1;
          }
          horVerSlider.HToughDown = false;
        }
        horVerSlider.handleVertElm(horVerSlider.VElemIndex);
      }
    });
  },
  VtoughMove: function() {
    $(horVerSlider.VElement)
      .on("touchstart", function(e1) {
        horVerSlider.VToughDown = true;
        horVerSlider.VtoughedAt = e1.originalEvent.touches[0].pageY;
      })
      .mouseup(function() {
        horVerSlider.VToughDown = false;
      });
    $(horVerSlider.VElement).on("touchmove", function(e2) {
      if (horVerSlider.VToughDown) {
        $("img").on("dragstart", function(event) {
          event.preventDefault();
        });
        if (e2.originalEvent.touches[0].pageY > horVerSlider.VtoughedAt) {
          if (horVerSlider.VMovement != 0) {
            horVerSlider.VMovement += horVerSlider.VHeight;
            horVerSlider.moveDown();
            horVerSlider.VElemIndex -= 1;
            horVerSlider.HElemIndex -= 1;
          }
          horVerSlider.VToughDown = false;
        } else {
          if (
            horVerSlider.VMovement - horVerSlider.VHeight * 3 !=
            -((horVerSlider.VElementCount - 1) * horVerSlider.VHeight)
          ) {
            horVerSlider.VMovement -= horVerSlider.VHeight;
            horVerSlider.moveUp();
            horVerSlider.VElemIndex += 1;
            horVerSlider.HElemIndex += 1;
          }
          horVerSlider.VToughDown = false;
        }
        horVerSlider.handleHorizElm(horVerSlider.HElemIndex);
      }
    });
  },
  HNav: function() {
    $(".horizone-nav .next").on("click", function() {
      if (
        horVerSlider.HMovement !=
        -((horVerSlider.HElementCount - 1) * horVerSlider.HWidth)
      ) {
        horVerSlider.HMovement -= horVerSlider.HWidth;
        horVerSlider.moveLeft();
        horVerSlider.VElemIndex += 1;
        horVerSlider.HElemIndex += 1;
      }
      horVerSlider.handleVertElm(horVerSlider.VElemIndex);
    });
    $(".horizone-nav .prev").on("click", function() {
      if (horVerSlider.HMovement != 0) {
        horVerSlider.HMovement += horVerSlider.HWidth;
        horVerSlider.moveRight();
        horVerSlider.VElemIndex -= 1;
        horVerSlider.HElemIndex -= 1;
      }
      horVerSlider.handleVertElm(horVerSlider.VElemIndex);
    });
  },
  VNav: function() {
    $(".vertical-nav .bottom").on("click", function() {
      if (
        horVerSlider.VMovement - horVerSlider.VHeight * 3 !=
        -((horVerSlider.VElementCount - 1) * horVerSlider.VHeight)
      ) {
        horVerSlider.VMovement -= horVerSlider.VHeight;
        horVerSlider.moveUp();
      }
      if (horVerSlider.VElemIndex + 1 < horVerSlider.VElementCount) {
        horVerSlider.VElemIndex += 1;
        horVerSlider.HElemIndex += 1;
      }
      horVerSlider.handleHorizElm(horVerSlider.HElemIndex);
      console.log(horVerSlider.HElemIndex + "  " + horVerSlider.VElemIndex);
    });
    $(".vertical-nav .top").on("click", function() {
      if (horVerSlider.VMovement != 0) {
        horVerSlider.VMovement += horVerSlider.VHeight;
        horVerSlider.moveDown();
      }
      if (horVerSlider.VElemIndex != 0) {
        horVerSlider.VElemIndex -= 1;
        horVerSlider.HElemIndex -= 1;
      }
      horVerSlider.handleHorizElm(horVerSlider.VElemIndex);
      console.log(horVerSlider.HElemIndex + "  " + horVerSlider.VElemIndex);
    });
  },
  handleVertElm: function(elemIndex) {
    $(horVerSlider.VElement)
      .find("li")
      .removeClass("active");
    $(horVerSlider.VElement)
      .find("li:eq(" + elemIndex + ")")
      .addClass("active");
    $(".dotwrap > div").removeClass("active");
    $(".dotwrap > div:eq(" + elemIndex + ")").addClass("active");
    horVerSlider.VMovement = -(elemIndex * horVerSlider.VHeight);
    if (elemIndex < horVerSlider.VElementCount - 3) {
      $(horVerSlider.VElement)
        .find("ul")
        .animate(
          {
            top: horVerSlider.VMovement
          },
          500
        );
    }
  },
  handleHorizElm: function(elemIndex) {
    $(horVerSlider.VElement)
      .find("li")
      .removeClass("active");
    $(horVerSlider.VElement)
      .find("li:eq(" + elemIndex + ")")
      .addClass("active");
    $(".dotwrap > div").removeClass("active");
    $(".dotwrap > div:eq(" + elemIndex + ")").addClass("active");
    horVerSlider.HMovement = -(elemIndex * horVerSlider.HWidth);
    if (elemIndex < horVerSlider.HElementCount) {
      $(horVerSlider.HElement)
        .find("ul")
        .animate(
          {
            left: horVerSlider.HMovement
          },
          500
        );
    }
  },
  moveLeft: function() {
    $(horVerSlider.HElement)
      .find("ul")
      .animate(
        {
          left: horVerSlider.HMovement
        },
        500
      );
  },
  moveRight: function() {
    $(horVerSlider.HElement)
      .find("ul")
      .animate(
        {
          left: horVerSlider.HMovement
        },
        500
      );
  },
  moveDown: function() {
    $(horVerSlider.VElement)
      .find("ul")
      .animate(
        {
          top: horVerSlider.VMovement
        },
        500
      );
  },
  moveUp: function() {
    $(horVerSlider.VElement)
      .find("ul")
      .animate(
        {
          top: horVerSlider.VMovement
        },
        500
      );
  },
  verticalClick: function() {
    horVerSlider.VElement.find("li").on("click", function() {
      horVerSlider.VElemIndex = $(this).index();
      horVerSlider.HElemIndex = $(this).index();
      horVerSlider.HMovement = -(horVerSlider.HElemIndex * horVerSlider.HWidth);
      horVerSlider.VElement.find("li").removeClass("active");
      $(this).addClass("active");
      $(".dotwrap > div").removeClass("active");
      $(".dotwrap > div:eq(" + horVerSlider.VElemIndex + ")").addClass(
        "active"
      );
      $(horVerSlider.HElement)
        .find("ul")
        .animate(
          {
            left: horVerSlider.HMovement
          },
          500
        );
    });
  },
  dotClick: function() {
    $(document).on("click", ".dotwrap > div", function() {
      horVerSlider.VElemIndex = $(this).index();
      horVerSlider.HElemIndex = $(this).index();
      $(".dotwrap > div").removeClass("active");
      $(this).addClass("active");
      horVerSlider.VElement.find("li").removeClass("active");
      horVerSlider.VElement.find(
        "li:eq(" + horVerSlider.HElemIndex + ")"
      ).addClass("active");
      horVerSlider.HMovement = -(horVerSlider.HElemIndex * horVerSlider.HWidth);
      horVerSlider.VMovement = -(
        horVerSlider.VElemIndex * horVerSlider.VHeight
      );
      $(horVerSlider.HElement)
        .find("ul")
        .animate(
          {
            left: horVerSlider.HMovement
          },
          500
        );
      if (horVerSlider.VElemIndex < horVerSlider.VElementCount - 3) {
        console.log("1");
        $(horVerSlider.VElement)
          .find("ul")
          .animate(
            {
              top: horVerSlider.VMovement
            },
            500
          );
      } else {
        horVerSlider.VMovement = -(
          (horVerSlider.VElementCount - 4) *
          horVerSlider.VHeight
        );
        $(horVerSlider.VElement)
          .find("ul")
          .animate(
            {
              top: horVerSlider.VMovement
            },
            500
          );
      }
    });
  },
  setSlider: function() {
    horVerSlider.HElementCount = horVerSlider.HElement.find("ul li").length;
    horVerSlider.HElement.find("ul").css({
      width: horVerSlider.HElementCount * horVerSlider.HWidth
    });
    horVerSlider.VElementCount = horVerSlider.VElement.find("ul li").length;
    horVerSlider.VElement.find("ul").css({
      height: horVerSlider.VElementCount * horVerSlider.VHeight
    });
    $(horVerSlider.VElement)
      .find("li")
      .removeClass("active");
    $(horVerSlider.VElement)
      .find("li:eq(" + horVerSlider.HElemIndex + ")")
      .addClass("active");
    for (i = 0; i < horVerSlider.HElementCount; i++) {
      if (i == 0) {
        horVerSlider.dotsHTML += "<div class='active'></div>";
      } else {
        horVerSlider.dotsHTML += "<div></div>";
      }
    }
    $(".dots .dotwrap").append(horVerSlider.dotsHTML);
  },
  lazyLoad: function() {
    horVerSlider.HElement.find("li").each(function() {
      var himage = $(this).data("image");
      $(this)
        .find("img")
        .attr("src", himage);
    });
    horVerSlider.VElement.find("li").each(function() {
      var vimage = $(this).data("image");
      $(this)
        .find("img")
        .attr("src", vimage);
    });
  },
  lightBox: function() {
    $(document).on("click", ".zoomin", function() {
      $(".horVerSlider").addClass("fullscreen");
      $("#horizon-slider").removeClass("zoomin");
      $("html").css({ overflow: "hidden" });
    });
    $(document).on("click", ".close", function() {
      $(".horVerSlider").removeClass("fullscreen");
      $("#horizon-slider").addClass("zoomin");
      $("html").css({ overflow: "" });
    });
  }
};
