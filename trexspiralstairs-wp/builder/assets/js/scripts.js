$(function($){

// NEXT OR FIRST
  $.fn.nextOrFirst = function(selector) {
    var next = this.next(selector);
    return (next.length) ? next : this.prevAll(selector).last();
  };

// SCROLL TO NEXT
  $('[data-scroll="next"]').on('click', function (e) {
    e.preventDefault();
    $('div.options').scrollTo($(this).closest('.section-section').nextAll(".section-section.no-hide").first(), {
      axis : 'y',
      offset : 0,
      duration : 600
    });
  });

// SPLASH BOX

  window.setTimeout(function() {
    $("#splash").addClass("splash");
  }, 800);

  $("[data-splash]").click(function(e) {
    e.preventDefault();
    $(this).parents('#splash').addClass('unsplash');
  });

// IMAGESLOADED

  $('#staircase figure .panzoom').imagesLoaded().always( function( instance ) {
    window.setTimeout(function () {
      $("#loader").removeClass("loading").addClass("ready");
    }, 2500);
  });

// TOGGLE SWITCHES
  $("input.tog").click(function(e) {
    if ($(this).is(':checked')) {
      $(this).parents('.tog-wrap').find('label:last-child').addClass('active');
      $(this).parents('.tog-wrap').find('label:first-child').removeClass('active');
    } else {
      $(this).parents('.tog-wrap').find('label:last-child').removeClass('active');
      $(this).parents('.tog-wrap').find('label:first-child').addClass('active');
    }
  });

  // deprecated
  /*$(".opt-toggle").click(function(e) {
    e.preventDefault();
    if ($('#tog-inorout').hasClass('show')) {
      $('#tog-inorout').removeClass('show');
      $(this).children('i').removeClass().addClass('_dgicon-tune');
    } else {
      $('#tog-inorout').addClass('show');
      $(this).children('i').removeClass().addClass('_dgicon-close');
    }
  });*/

// deprecated
// CONTINUOUS OR NON-CONTINUOUS
  /*$("#tog-nonorcont input").click(function(e) {
    if ($(this).is(':checked')) {
      $("#staircase").attr('data-cont', "cont");
      $("#review-staircase").attr('data-cont', "cont");
      $(".review-cont").text("Continuous");
      $(this).attr('data-nonorcont', 'cont');
    } else {
      $("#staircase").attr('data-cont', "non");
      $("#review-staircase").attr('data-cont', "non");
      $(".review-cont").text("Non-continuous");
      $(this).attr('data-nonorcont', 'non');
    }

    // LOADER
    $("#loader").removeClass("ready").addClass("loading");
    $("#staircase figure").hide();

    $('#staircase figure .panzoom').imagesLoaded().always( function( instance ) {
      window.setTimeout(function () {
        $("#staircase figure").show();
        $("#loader").removeClass("loading").addClass("ready");
      }, 200);
    });

  });*/

// DIAMETER
  $("#tog-diameter input").click(function(e) {

    $('#slider-treads').slick('slickUnfilter');

    if ($(this).is(':checked')) {
      $("#staircase").attr('data-cont', "6");
      $("#review-staircase").attr('data-cont', "6");
      $(this).attr('data-diameter', '6');
      $('#slider-treads').slick('slickFilter','.platetype-closed');
      $(".options").attr('data-isdiameter', "6");

      // get a hold of controller and scope
      var element = angular.element($('body'));
      var controller = element.controller();
      var scope = element.scope();

      // as this happends outside of angular you probably have to notify angular of the change by wrapping your function call in $apply
      scope.$apply(function(){
        scope.staircase.setOption('diameter', staircaseOptions.diameter[1]);
      });

    } else {
      $("#staircase").attr('data-cont', "5");
      $("#review-staircase").attr('data-cont', "5");
      $(this).attr('data-diameter', '5');
      $(".options").attr('data-isdiameter', "5");

      // get a hold of controller and scope
      var element = angular.element($('body'));
      var controller = element.controller();
      var scope = element.scope();

      // as this happends outside of angular you probably have to notify angular of the change by wrapping your function call in $apply
      scope.$apply(function(){
        scope.staircase.setOption('diameter', staircaseOptions.diameter[0]);
      });

    }

    $('#slider-treads').slick('refresh');
    
    window.setTimeout(function () {
      $('#slider-treads').slick('slickGoTo', 0);
    }, 200);
    window.setTimeout(function () {
      $('#slider-treads').find(".slick-current").click();
    }, 400);

    // LOADER
    $("#loader").removeClass("ready").addClass("loading");
    $("#staircase figure").hide();

    $('#staircase figure .panzoom').imagesLoaded().always( function( instance ) {
      window.setTimeout(function () {
        $("#staircase figure").show();
        $("#loader").removeClass("loading").addClass("ready");
      }, 200);
    });

  });

// TREAD COVERING TOGGLE
  var theCovering;

  $("#tog-tread_coverings input").click(function(e) {
    
    theCovering = $(".options").attr('data-iscovering');

    $('#slider-tread_coverings').slick('slickUnfilter');

    if ($(this).is(':checked')) {
      $(this).attr('data-tread_coverings', "no-tread-covering");
      $(".options").attr('data-iscovering', "no-tread-covering");
      theCovering = $(".options").attr('data-iscovering');

      $('#slider-tread_coverings').slick('slickFilter','.'+theCovering+'');
    } else {
      $(this).attr('data-tread_coverings', "tread-covering");
      $(".options").attr('data-iscovering', "tread-covering");
      theCovering = $(".options").attr('data-iscovering');

      $('#slider-tread_coverings').slick('slickFilter','.'+theCovering+'');
    }

    $('#slider-tread_coverings').slick('refresh');

    window.setTimeout(function () {
      $('#slider-tread_coverings').slick('slickGoTo', 0);
    }, 200);
    window.setTimeout(function () {
      $('#slider-tread_coverings').find(".slick-current").click();
    }, 400);

  });

// LIGHTING
  $("#tog-lighting input").click(function(e) {
    if ($(this).is(':checked')) {
      //$("#staircase").attr('data-cont', "6");
      //$("#review-staircase").attr('data-cont', "6");
      //$(".review-cont").text("Continuous");
      $(this).attr('data-lighting', 'yes');

      // get a hold of controller and scope
      var element = angular.element($('body'));
      var controller = element.controller();
      var scope = element.scope();

      // as this happends outside of angular you probably have to notify angular of the change by wrapping your function call in $apply
      scope.$apply(function(){
        scope.staircase.setOption('lighting', staircaseOptions.lighting[1]);
      });

    } else {
      //$("#staircase").attr('data-cont', "5");
      //$("#review-staircase").attr('data-cont', "5");
      //$(".review-cont").text("Non-continuous");
      $(this).attr('data-lighting', 'no');

      // get a hold of controller and scope
      var element = angular.element($('body'));
      var controller = element.controller();
      var scope = element.scope();

      // as this happends outside of angular you probably have to notify angular of the change by wrapping your function call in $apply
      scope.$apply(function(){
        scope.staircase.setOption('lighting', staircaseOptions.lighting[0]);
      });
    }

    // LOADER
    $("#loader").removeClass("ready").addClass("loading");
    $("#staircase figure").hide();

    $('#staircase figure .panzoom').imagesLoaded().always( function( instance ) {
      window.setTimeout(function () {
        $("#staircase figure").show();
        $("#loader").removeClass("loading").addClass("ready");
      }, 200);
    });

  });

// INDOOR OUTDOOR TOGGLE

  var treadType;
  var inORout = $("#inorout-tog").attr('data-inorout');
  var theTreadType;

  $("#tog-inorout input").click(function(e) {

    theTreadType = $(".options").attr('data-istreadtype');

    $('#slider-tread_coverings, #slider-spindles, #slider-handrails, #slider-pole_caps, #slider-colors_finishes').slick('slickUnfilter');

    if ($(this).is(':checked')) {
      $(this).attr('data-inorout', "outdoor");
      $(".options").attr('data-isinorout', "outdoor");
      //$(this).attr('data-nonorcont', 'cont');


      $('#slider-tread_coverings').slick('slickFilter','.'+theTreadType+'.outdoor');
      $('#slider-spindles').slick('slickFilter','.'+theTreadType);
      $('#slider-handrails').slick('slickFilter','.outdoor');
      $('#slider-pole_caps').slick('slickFilter','.outdoor');
      $('#slider-colors_finishes').slick('slickFilter','.outdoor');
    } else {
      $(this).attr('data-inorout', "indoor");
      $(".options").attr('data-isinorout', "indoor");
      //$(this).attr('data-nonorcont', 'non');

      $('#slider-tread_coverings').slick('slickFilter','.'+theTreadType+'.indoor');
      $('#slider-spindles').slick('slickFilter','.'+theTreadType);
      $('#slider-handrails').slick('slickFilter','.indoor');
      $('#slider-pole_caps').slick('slickFilter','.indoor');
      $('#slider-colors_finishes').slick('slickFilter','.indoor');
    }

    $('#slider-tread_coverings, #slider-spindles, #slider-handrails, #slider-pole_caps, #slider-colors_finishes').slick('refresh');

    window.setTimeout(function () {
      $('#slider-tread_coverings, #slider-spindles, #slider-handrails, #slider-pole_caps, #slider-colors_finishes').slick('slickGoTo', 0);
    }, 200);
    window.setTimeout(function () {
      $('#slider-tread_coverings, #slider-spindles, #slider-handrails, #slider-pole_caps, #slider-colors_finishes').find(".slick-current").click();
    }, 400);

  });

// SLIDERS
  $(".s-slider").slick({
    centerMode: true,
    centerPadding: '0',
    slidesToShow: 3,
    slidesToScroll: 1,
    swipeToSlide: true,
    infinite: false,
    dots: true,
    prevArrow: '<div data-role="none" class="prev slick-button" aria-label="Previous" tabindex="0" role="button"><i class="_dgicon-chevron-left"></i></div>',
    nextArrow: '<div data-role="none" class="next slick-button" aria-label="Next" tabindex="0" role="button"><i class="_dgicon-chevron-right"></i></div>',
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerPadding: '25%',
        }
      },
      {
        breakpoint: 481,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerPadding: '0',
        }
      }
    ]
  });

  // $(".slick-current").children('.slide-container').children(".img-wrap").addClass("selected");

  $(".slick-current").addClass("selected");

  // ADD SELECTED STATE TO SLIDE
  $('.slick-slider').each( function (e) {

    var thisSlide = $(this);

    $(this).on('click', '.slick-slide', function (e) {
      e.stopPropagation();

      // LOADER
      $("#loader").removeClass("ready").addClass("loading");
      // $("#staircase figure").hide();

      $('#staircase figure .panzoom').imagesLoaded().always( function( instance ) {
        window.setTimeout(function () {
          // $("#staircase figure").show();
          $("#loader").removeClass("loading").addClass("ready");
        }, 400);
      });

      var index = $(this).attr("data-slick-index");
      if ($(thisSlide).slick('slickCurrentSlide') !== index) {
        $(thisSlide).slick('slickGoTo', index);
        $(thisSlide).find('.selected').removeClass('selected');
        $(this).addClass("selected");
      } else {
        $(thisSlide).find('.selected').removeClass('selected');
        $(this).addClass("selected");
      }

    });

  });


  // INITIAL FILTERING
  //$('#slider-tread_coverings').slick('slickFilter','.taperedlip.indoor');
  //$('#slider-spindles').slick('slickFilter','.taperedlip');
  var staircase_style = $('.options').data('style');
    $('#slider-spindles').slick( 'slickSetOption', { centerMode: false }, true );
    $('#slider-spindles').slick( 'refresh' );
  $('#slider-colors_finishes').slick('slickFilter','.'+staircase_style);
    $('#slider-colors_finishes .slick-slide:first-child').click();
    $('#slider-colors_finishes').slick('slickGoTo', 0);


  // Tread SLIDE CLICK FILTERING
  $('#slider-treads').on('click', '.slick-slide', function (e) {
    e.stopPropagation();

    var treadType = $(this).data("treadtype");
    var inORout = $(".options").attr('data-isinorout');
    theCovering = $(this).data("treadtype");

    $('#slider-tread_coverings').slick('slickUnfilter');

    //$('#slider-tread_coverings').slick('slickFilter','.'+theCovering);

    $('#slider-tread_coverings').slick('refresh');

    $('.toggle-wrap.tread_coverings-wrap').show(0);


    window.setTimeout(function () {
      var currentTreadCovering = $('#slider-tread_coverings').find(".slick-current").data("slick-index");
      var currentSpindle = $('#slider-spindles').find(".slick-current").data("slick-index");

      $('#slider-tread_coverings').slick('slickGoTo', currentTreadCovering);
      $('#slider-spindles').slick('slickGoTo', currentSpindle);
    }, 200);
    window.setTimeout(function () {
      $('#slider-tread_coverings').find(".slick-current").click();
      $('#slider-spindles').find(".slick-current").click();
    }, 400);


    // NO TREAD COVERING TREAD STYLES
    if ($(this).data('slug') == "diamond-plate-open-ends" ||
        $(this).data('slug') == "diamond-plate-closed-ends") {
      //$('#nav-tread_coverings').addClass('disabled');
      //$('#section-tread_coverings').removeClass('no-hide').addClass('hide');
      //$('#review-tread_coverings a[data-show="tread_coverings"]').addClass('disabled');

      $("#tog-tread_coverings input").attr('data-tread_coverings', "no-tread-covering");
      $(".options").attr('data-iscovering', "no-tread-covering");
      if (!$("#tog-tread_coverings input").is(':checked')) {
        $("#tog-tread_coverings input").click();
      }
      $('.toggle-wrap.tread_coverings-wrap').hide(0);

      $('#slider-tread_coverings').slick('slickFilter','.'+theCovering);

      $('#slider-tread_coverings').slick('refresh');

      window.setTimeout(function () {
        $('#slider-tread_coverings .slick-slide:first-child').click();
      }, 800); // 800
      window.setTimeout(function () {
        $('#slider-tread_coverings').slick('slickGoTo', 0);
      }, 1200); // 1200

    } else {
      $('#nav-tread_coverings').removeClass('disabled');
      $('#section-tread_coverings').removeClass('hide').addClass('no-hide');
      $('#review-tread_coverings a[data-show="tread_coverings"]').removeClass('disabled');

      $('#slider-tread_coverings').slick('slickUnfilter');

      $('#slider-tread_coverings').slick('refresh');

      if ($("#tog-tread_coverings input").is(':checked')) {
        $("#tog-tread_coverings input").click();
      }
    }

  });

// NAV TABS
  $(".stairTab").click(function(e) {
    e.preventDefault();
    $(".active").addClass('visited')
    // $('.s-slider').slick('refresh');
  });

// PAN ZOOM
  // http://timmywil.github.io/jquery.panzoom/
  var $section = $('#staircase');
  var $panzoom = $section.find('.panzoom').panzoom({
    $zoomIn: $section.find(".zoom-in"),
    $zoomOut: $section.find(".zoom-out"),
    $zoomRange: $section.find(".zoom-range"),
    $reset: $section.find(".reset"),
    startTransform: 'scale(1)',
    maxScale: 2,
    minScale: 1,
    increment: 0.25,
  });

  $panzoom.parent().on('mousewheel.focal', function(e) {
    e.preventDefault();
    var delta = e.delta || e.originalEvent.wheelDelta;
    var zoomOut = delta ? delta < 0 : e.originalEvent.deltaY > 0;
    $panzoom.panzoom('zoom', zoomOut, {
      increment: 0.25,
      // animate: false,
      focal: e
    });
    window.setTimeout(function () {
      $panzoom.panzoom('resetDimensions');
    }, 200);
  });

  $('[data-zoom]').click(function(e) {
    e.preventDefault();
    var zoom = $(this).attr("data-zoom");

    $('[data-zoom]').removeClass('active');
    $('[data-zoom]').removeClass('active');
    $('[data-zoom]').removeClass('active');
    $(this).addClass('active');

    if ($(this).parents('#staircase').hasClass('zoom-default')) {
      $(this).parents('#staircase').removeClass('zoom-default');
    } else if ($(this).parents('#staircase').hasClass('zoom-top')) {
      $(this).parents('#staircase').removeClass('zoom-top');
    } else if ($(this).parents('#staircase').hasClass('zoom-bottom')) {
      $(this).parents('#staircase').removeClass('zoom-bottom');
    }

    $(this).parents('#staircase').addClass('zoom-'+zoom);
    $panzoom.panzoom("reset");

  });

// EXPAND STAIR VIEWER
  $('.zoom-fill').click(function(e) {
    e.preventDefault();

    $('body').toggleClass('zoom-filled');

    if ($(this).children('i').hasClass('_dgicon-zoom-in')) {
      $(this).children('i').removeClass('_dgicon-zoom-in');
      $(this).children('i').addClass('_dgicon-zoom-out');
      $panzoom.panzoom("reset");
    } else if ($(this).children('i').hasClass('_dgicon-zoom-out')) {
      $(this).children('i').removeClass('_dgicon-zoom-out');
      $(this).children('i').addClass('_dgicon-zoom-in');
      $panzoom.panzoom("reset");
    }
  });

  $('.zoom-fill').click(function(e) {
    e.preventDefault();
    $('#staircase').removeClass('zoom-top');
    $('#staircase').removeClass('zoom-bottom');
    $('[data-zoom]').removeClass('active');
    $('[data-zoom="default"]').addClass('active');
    window.setTimeout(function () {
      $panzoom.panzoom('resetDimensions');
    }, 800);
  });

  $('.zoom-close').click(function(e) {
    e.preventDefault();

    $('body').removeClass('zoom-filled');
    $('.zoom-fill').children('i').removeClass('_dgicon-zoom-out').addClass('_dgicon-zoom-in');
    $panzoom.panzoom("reset");
    window.setTimeout(function () {
      $panzoom.panzoom('resetDimensions');
    }, 400);

  });

  $(window).on('resize', function() {
    window.setTimeout(function () {
      $panzoom.panzoom('resetDimensions');
    }, 400);
  });

// SECTION CONTROL

  $(".active").addClass('visited');

  $('.sections > div:first-child').addClass('is-visible');

  var toShow;

  $('[data-show]').on('click', function (e) {
    e.preventDefault();

    toShow = $(this).attr("data-show");

    var windowWidth = $(window).width();

    if ( windowWidth > 768 ) {

      $('.sections >  div').removeClass('is-visible');
      $('#section-'+ toShow).addClass('is-visible');

      $('.top-nav > li').removeClass('active');
      $('#nav-'+ toShow).addClass('active');

    } else {

      $('.sections >  div').removeClass('is-visible');
      $('#section-'+ toShow).addClass('is-visible');

      $('div.options').scrollTo('#section-'+ toShow, {
        axis : 'y',
        offset : 0,
        duration : 600
      });

    }

  });

  $('#review-items [data-show]').on('click', function (e) {
    e.preventDefault();

    $('.takeover-nav').removeClass('show-menu');
    $('.takeover-nav a').removeClass('toggled');
    $('#review.takeover').removeClass('is-active');
  });


  $('.info-toggle').on('click', function (e) {
    e.preventDefault();
    $(this).parents(".sectionTitle").toggleClass('show-info');
    if ($(this).parents(".sectionTitle").hasClass('show-info')) {
      $(this).children('i').removeClass('_dgicon-info');
      $(this).children('i').addClass('_dgicon-close');
    } else {
      $(this).children('i').removeClass('_dgicon-close');
      $(this).children('i').addClass('_dgicon-info');
    }
  });

// TAKEOVERS

  var toToggle;
  var toClose;

  $('[data-toggle]').on('click', function (e) {
    e.preventDefault();

    toToggle = $(this).attr("data-toggle");

    if ( $('#'+ toToggle).hasClass('is-active') ) {
      // $('#'+ toToggle).removeClass('is-active');
      // $(this).removeClass('toggled');
      // $('body').removeClass('js-no-scroll');
    } else {
      $('.takeover.is-active').removeClass('is-active');
      $('#'+ toToggle).addClass('is-active');
      // $(this).addClass('toggled');
      $('body').addClass('js-no-scroll');
    }
  });

  $('[data-close]').on('click', function (e) {
    e.preventDefault();

    toggleContainer = $(this).parents('.takeover').attr("id");

    $(this).parents('.takeover').removeClass('is-active');
    $('[data-toggle="'+toggleContainer+'"]').removeClass('toggled');
    $('body').removeClass('js-no-scroll');

  });

// REVIEW BUTTON
  $(".review-trigger").click(function(event) {
    $(".takeover-nav").addClass('show-menu');
  });

// REVIEW SELECTIONS
  $('[data-toggle="review"]').on('click', function (e) {
    e.preventDefault();
    var staircase = $('#staircase figure .panzoom').html();
    $('#review-staircase figure').html(staircase);
  });

// JSPDF

  // $('[data-toggle="download-print"]').on('click', function (e) {
  //   e.preventDefault();
  //   var reviewItems = $('#review-items .content-wrap').html();
  //   $('#content').html(reviewItems);
  // });

 $('.downpdf').click(function(e) {
    e.preventDefault();

    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#content')[0];

    // we support special element handlers. Register them with jQuery-style
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 40,
        bottom: 40,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF
        //          this allow the insertion of new lines after html
        pdf.save('Trex_Spiral_Stairs-staircase-build.pdf');
    }, margins);

  });

// GRAVITY FORMS

  $("#tog-diameter input").click(function(e) {
    if ($(this).is(':checked')) {
      $("#gform_3 #input_3_18.gform_hidden").val("6");
      $("#content .diameter").text("6'");
    } else {
      $("#gform_3 #input_3_18.gform_hidden").val("5");
      $("#content .diameter").text("5'");
    }
  });

  $('#slider-treads .slick-slide').click(function(e) {
    e.preventDefault();
    var treadClicked = $(this).find('h3').text();
    $("#gform_3 #input_3_8.gform_hidden").val(treadClicked);
  });

  window.setTimeout(function () {
    $('#slider-tread_coverings .slick-slide').click(function(e) {
      e.preventDefault();
      var treadcoveringClicked = $(this).find('h3').text();
      $("#gform_3 #input_3_9.gform_hidden").val(treadcoveringClicked);
    });
    $('#slider-spindles .slick-slide').click(function(e) {
      e.preventDefault();
      var spindleClicked = $(this).find('h3').text();
      $("#gform_3 #input_3_10.gform_hidden").val(spindleClicked);
    });
  }, 400);

  $('#slider-colors_finishes .slick-slide').click(function(e) {
    e.preventDefault();
    var colorClicked = $(this).find('h3').text();
    $("#gform_3 #input_3_13.gform_hidden").val(colorClicked);
  });

  $("#tog-lighting input").click(function(e) {
    if ($(this).is(':checked')) {
      $("#gform_3 #input_3_18.gform_hidden").val("Lighting Kit");
      $("#content .lighting").text("Lighting Kit");
    } else {
      $("#gform_3 #input_3_18.gform_hidden").val("No Lighting Kit");
      $("#content .lighting").text("No Lighting Kit");
    }
  });

// HTML-TO-CANVAS-TO-PNG


  // https://jsfiddle.net/8ypxW/3/

  $(".review-trigger").click(function() {
    html2canvas($("#staircase figure .panzoom"), {
      onrendered: function(canvas) {
        theCanvas = canvas;
        document.body.appendChild(canvas);

        // Convert and download as image

        $("#img-out").html(Canvas2Image.convertToJPEG(canvas));
        // Clean up
        document.body.removeChild(canvas);
      }
    });
  });

// MISC
  function fadeIn(){
    $("[data-fade]").addClass("in");
  }
  window.setTimeout(function() {
    fadeIn();
  }, 600);

  window.setTimeout(function() {
    $("main").addClass("in");
  }, 1200);

  window.setTimeout(function() {
    $("#staircase").addClass("in");
  }, 1600);

  $('[data-mh]').matchHeight();

  FastClick.attach(document.body);


});
