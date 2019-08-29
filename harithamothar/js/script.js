var general = {
  limitval: 8,
  paginval: 1,
  init: function() {
    general.pageslide();
    general.pageLoading();
  },
  pageslide: function() {
    $("nav ul li").on("click", function() {
      var winWidth = $(window).width();
      general.toggleClassFn();
      var _class = $(this).attr("class");
      var _url = $(this).data("url");
      history.pushState(null, "", "/" + _url + "");
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
      if (_class == "apoorva") {
        setTimeout(function() {
          apoorva.slider();
        }, 1000);
      }
      if (_class == "projects") {
        $(".projectlist").empty();
        projectpage.getProjects(0, general.limitval);
        general.paginval = 1;

        if (winWidth < 768) {
          $(".loadmore").show();
        }
      }
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
  },
  pageLoading: function() {
    var slugname = window.location.pathname.split("/")[1];
    var winWidth = $(window).width();
    if (slugname == "") {
      $("#landing")
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
    } else {
      if (slugname == "projects") {
        $(".projectlist").empty();
        projectpage.getProjects(0, general.limitval);
        general.paginval = 1;
        if (winWidth < 768) {
          $(".loadmore").show();
        }
      }
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
      $("#" + slugname)
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
    }
  }
};

var homepage = {
  init: function() {
    homepage.slider();
    homepage.hamburger();
    homepage.textSlider();
  },
  slider: function() {
    var owl = $("#homeslider");
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 10,
      lazyLoad: true,
      autoplay: true,
      autoplaySpeed: 500,
      autoplayTimeout: 7000
    });
  },
  textSlider: function() {
    var owl = $("#text-slider");
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 0,
      animateOut: "fadeOut",
      autoplay: true,
      autoplaySpeed: 500,
      autoplayTimeout: 3000
    });
  },
  hamburger: function() {
    $(".hamb-wrap").click(function() {
      general.toggleClassFn();
    });
  }
};

var projectpage = {
  init: function() {
    projectpage.paginNext();
    projectpage.paginPrev();
    projectpage.projectPopup();
    projectpage.showVideo();
    projectpage.mobileProjectLoad();
  },
  paginNext: function() {
    $(document).on("click", ".nextset span", function() {
      var _start = parseInt($(".showing .from").text());
      _start += general.limitval - 1;
      general.paginval += 1;
      $(".projectlist").empty();
      projectpage.getProjects(_start, general.limitval);
    });
  },
  paginPrev: function() {
    $(document).on("click", ".prevset span", function() {
      var _start = parseInt($(".showing .from").text());
      _start -= general.limitval + 1;
      general.paginval -= 1;
      $(".projectlist").empty();
      projectpage.getProjects(_start, general.limitval);
    });
  },
  mobileProjectLoad: function() {
    var winWidth = $(window).width();
    $(".loadmore").on("click", function() {
      if (winWidth < 768) {
        var _start = parseInt($(".showing .from").text());
        _start += general.limitval - 1;
        general.paginval += 1;
        projectpage.getProjects(_start, general.limitval);
      }
    });
  },
  getProjects: function(_start, _limit) {
    $.ajax({
      url: "/getprojects?start=" + _start + "&limit=" + _limit,
      cache: false,
      type: "POST",
      dataType: "json",
      success: function(data) {
        $.each(data.Results, function() {
          projectpage.appendItems(this);
        });
        projectpage.pagin(_start, _limit, data.Count);
      }
    });
  },
  appendItems: function(e) {
    var t = jQuery($("#project").html());
    t.find(".item-inner").attr({
      style: "background-image: url('" + e.project_image + "')"
    });
    t.find(".content h2").text(e.project_name);
    t.find(".content p").text(e.project_address);
    t.find(".tags").text(e.tags);
    t.find(".item-inner").attr({
      "data-descript": e.project_description,
      "data-image": e.project_image,
      "data-tags": e.tags,
      "data-prjectname": e.project_name,
      "data-youtubeid": e.youtube_id
    });
    $(".projectlist").append(t);
    if (e.youtube_id != "") {
      t.find(".video").show();
    } else {
      t.find(".video").hide();
    }
  },
  pagin: function(_start, _limit, count) {
    $(".filtering .count").text(count);
    $(".filtering .prevset span").text("PREV " + general.limitval);
    $(".filtering .nextset span").text("NEXT " + general.limitval);
    $(".filtering .showing .from")
      .empty()
      .text(_start + 1);
    $(".filtering .showing .to")
      .empty()
      .text(_start + general.limitval);
    if (_start == 0) {
      $(".filtering .prevset").hide();
    } else {
      $(".filtering .prevset").show();
    }
    if (general.limitval * general.paginval >= count) {
      $(".filtering .nextset").hide();
      $(".loadmore").hide();
    } else {
      $(".filtering .nextset").show();
    }
  },
  projectPopup: function() {
    $(document).on("click", ".projectlist .item .expand", function() {
      var srcimg = $(this)
        .closest(".item")
        .find(".item-inner")
        .data("image");
      var descript = $(this)
        .closest(".item")
        .find(".item-inner")
        .data("descript");
      var header = $(this)
        .closest(".item")
        .find(".item-inner")
        .data("prjectname");
      var tags = $(this)
        .closest(".item")
        .find(".item-inner")
        .data("tags");
      var p = $(".popup-wrapper");
      p.find(".content .text-content")
        .text("")
        .text(descript);
      p.find(".content h2")
        .text("")
        .text(header);
      p.find(".content .tags")
        .text("")
        .text(tags);
      p.find(".image img")
        .attr("src", "")
        .attr("src", srcimg);
      setTimeout(function() {
        $(".popup-wrapper").fadeIn("slow");
      }, 10);
    });
    $(document).on("click", ".close", function() {
      $(".popup-wrapper").fadeOut("fast");
      $(".youtube-popup")
        .fadeOut("fast")
        .find(".youtube-holder")
        .empty();
    });
  },
  showVideo: function() {
    $(document).on("click", ".projectlist .item .video", function() {
      var youtube_id = $(this)
        .closest(".item")
        .find(".item-inner")
        .data("youtubeid");
      var youtube_iframe =
        "<iframe width='560' height='315' src='https://www.youtube.com/embed/" +
        youtube_id +
        "?autoplay=1&rel=0' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
      $(".youtube-popup .popup-inner .youtube-holder").append(youtube_iframe);
      setTimeout(function() {
        $(".youtube-popup").fadeIn("slow");
      }, 10);
    });
  }
};

var apoorva = {
  init: function() {
    //apoorva.lazySlider();
  },
  lazySlider: function() {
    $("#apoorvalist").owlCarousel({
      items: 1,
      lazyLoad: true,
      loop: true,
      margin: 10
    });
  },
  slider: function() {
    var owl = $("#apoorva-slider");
    owl.owlCarousel({
      items: 1,
      loop: true,
      margin: 10,
      autoplay: true,
      lazyLoad: true
    });
  }
};

horVerSlider = {
  HWidth: 800,
  HHeight: 500,
  HElement: jQuery("#horizon-slider"),
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
  }
};

(function($) {
  $(document).ready(function() {
    homepage.init();
    general.init();
    horVerSlider.init();
    projectpage.init();
  });
})(jQuery);
