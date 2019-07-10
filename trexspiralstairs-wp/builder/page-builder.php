<?php /* Template Name: Builder */ ?>
<?php locate_template(array('builder/header-builder.php'), true ); ?>
<?php
// determine style
$style = 'hp';
if (isset($_GET['natural'])) $style = 'natural';
if (isset($_GET['hp'])) $style = 'hp';
?>

  <div id="splash">
    <div class="inner">
      <h1>Welcome to the Spiral Staircase Builder</h1>
      <p>Our builder is based on a 5 Foot Diameter CODE stair with 13 risers shown. The actual height and diameter of your stairs will vary. Our builder allows you to customize your options and see a visual representation of your stairs on the fly.</p>
      <a href="#" data-splash><span>Build Your Stairs Now</span> <i class="_dgicon-arrow-right"></i></a>
    </div>
  </div>

  <div ng-controller="SectionController as section">

    <header class="site-header top" data-fade>

      <div class="logo-area">

        <div class="logo-img-container">
          <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/builder/assets/img/trex-spiral-stairs-logo.svg" alt="iron shop logo"></a>
        </div>

        <div class="filter-title">
          <?php if ($style == 'natural'): ?>Natural<?php endif; ?>
          <?php if ($style == 'hp'): ?>High Performance<?php endif; ?>
        </div>

        <div class="review-button">
          <div class="review">
            <button class="review-trigger hover-hand"><span>Review &amp; Save</span> <i class="_dgicon-arrow-right"></i></button>
          </div>
        </div>
      </div>

      {{staircase.printSections}}

      <nav>
        <ul class="nav top-nav">
          <li id="nav-{{sectionKey}}" class="stairTab" ng-repeat="sectionKey in staircase.stairTabs" ng-class="{active:section.isSelected(sectionKey)}">
            <a href="#" data-show="{{sectionKey}}" ng-click="section.selectTab(sectionKey)">
              <span ng-if="sectionKey != 'colors_finishes'">{{staircase.names[sectionKey]}}</span><span ng-if="staircase.style == 'natural' && sectionKey == 'colors_finishes'">Options</span><span ng-if="staircase.style == 'hp' && sectionKey == 'colors_finishes'">{{staircase.names[sectionKey]}}</span><i class="_dgicon-caret-down"></i>
            </a>
          </li>
        </ul>
      </nav>

    </header>

    <main>

      <div id="staircase" data-finish="{{staircase.colors_finishes.slug}}" data-collar="{{staircase.spindles.slug}}" data-cont="non">

        <figure>
          <div class="panzoom">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-handrail-top.png' class="handrail handrail2">


            <?php
            /*
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/treads/{{staircase.colors_finishes.finish}}/dp-{{staircase.treads.treadtype}}-continuous-top.png' class="continuous continuous-top" ng-if="staircase.treads.slug == 'tread-diamondplate-tapered' || staircase.treads.slug == 'tread-diamondplate-blu'">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/treads/{{staircase.colors_finishes.finish}}/dp-{{staircase.treads.treadtype}}-continuous.png' class="continuous" ng-if="staircase.treads.slug == 'tread-diamondplate-tapered' || staircase.treads.slug == 'tread-diamondplate-blu'">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/treads/{{staircase.colors_finishes.finish}}/{{staircase.treads.treadtype}}-continuous-top.png' class="continuous continuous-top" ng-if="staircase.treads.slug != 'tread-diamondplate-blu' && staircase.treads.slug != 'tread-diamondplate-tapered'">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/treads/{{staircase.colors_finishes.finish}}/{{staircase.treads.treadtype}}-continuous.png' class="continuous" ng-if="staircase.treads.slug != 'tread-diamondplate-blu' && staircase.treads.slug != 'tread-diamondplate-tapered'">*/
            ?>

            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-lighting-kit.png' class="lighting" ng-if="staircase.lighting.slug == 'lighting-kit'">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-spindle.png' class="spindle">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-tread-covering.png' class="tread-covering" ng-if="staircase.tread_coverings.slug != 'no-tread-covering'">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-tread.png' class="tread">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-handrail-bottom.png' class="handrail">
            <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/{{staircase.colors_finishes.slug}}/{{staircase.treads.slug}}-{{staircase.tread_coverings.slug}}-{{staircase.spindles.slug}}-{{staircase.lighting.slug}}-pole.png' class="pole" ng-if="staircase.colors_finishes.slug == 'natural'">

            <?php /*<img ng-src='<?php echo get_template_directory_uri(); ?>/builder/assets/img/shadow.png' class="shadow">*/ ?>
          </div>
        </figure>

        <div class="zoom-controls">
          <div class="well">
            <a href="#" data-zoom="default" class="active">Full</a>
            <a href="#" data-zoom="top">Top</a>
            <a href="#" data-zoom="bottom">Bottom</a>
          </div>
          <a href="#" class="zoom-fill"><i class="_dgicon-zoom-in"></i></a>
        </div>

        <div class="zoom-buttons">
          <button class="zoom-close"><i class="_dgicon-close"></i></button>
          <button class="zoom-in"><i class="_dgicon-zoom-in"></i></button>
          <button class="zoom-out"><i class="_dgicon-zoom-out"></i></button>
          <input type="range" class="zoom-range">
          <!-- <button class="reset">Reset</button> -->
        </div>

        <div id="loader" class="loading">
          <span><img src="<?php echo get_template_directory_uri(); ?>/builder/assets/img/ajax-loader.gif" width="32px" height="32px"></span>
        </div>

      </div>

      <div class="options" data-fade data-istreadtype="{{staircase.treads.treadtype}}" data-isdiameter="5" data-iscovering="tread-covering" data-style="<?php echo $style; ?>">

        <div class="sections">

          <div id="section-{{sectionKey}}" class="section-section no-hide" ng-repeat="sectionKey in staircase.sections">

            <button data-scroll="next"><i class="_dgicon-chevron-down"></i></button>

            <div class="sectionTitle">
              <h2>{{staircase.names[sectionKey]}}<button class="info-toggle"><i class="_dgicon-info"></i></button></h2>
              <div class="section-info">
                <p>{{staircase.descriptions[sectionKey]}}</p>
                <p class="alt" ng-if="sectionKey == 'tread_coverings' && staircase.treads.slug.indexOf('diamond') > -1">{{staircase.descriptionalts['no_tread_coverings_diamond']}}</p>
                <p class="alt" ng-if="sectionKey == 'tread_coverings' && staircase.treads.slug.indexOf('diamond') < 0">{{staircase.descriptionalts['no_tread_coverings']}}</p>
                <p ng-if="sectionKey == 'treads' && staircase.diameter.slug == '5'">The standard option for our 5' diameter stairs is an open end tread. You may select a closed end but note it will carry an additional cost.</p>

                <!-- <div class="collar-wrap" ng-if="sectionKey == 'treads'">
                  <h3>Tread Collars</h3>
                  <div id="tog-nonorcont" class="tog-wrap">
                    <label for="nonorcont-tog" class="active">Standard</label>
                    <div class="before"></div>
                    <input id='nonorcont-tog' class='tog' type="checkbox" data-nonorcont="cont">
                    <div class="after"></div>
                    <label for="nonorcont-tog" class="">Continuous</label>
                  </div>
                  <div class="collar-desc">
                    <p style="text-align: center;">Standard collars are ideal with any Primed Steel Kit or Galvanized Steel Kit.</p>
                    <p style="text-align: center;">Continuous sleeve collars are required for any powder coated stair made from steel or aluminum.</p>
                  </div>
                </div> -->

                <div class="toggle-wrap diameter-wrap" ng-if="sectionKey == 'diameter'">
                  <p>&nbsp;</p>
                  <div id="tog-diameter" class="tog-wrap">
                    <label for="diameter-tog" class="active">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5'&nbsp;</label>
                    <div class="tog-checkbox">
                      <div class="before"></div>
                      <input id='diameter-tog' class='tog' type="checkbox" data-diameter="5">
                      <div class="after"></div>
                    </div>
                    <label for="diameter-tog" class="">&nbsp;6'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  </div>
                </div>

                <!-- <div class="toggle-wrap tread_coverings-wrap" ng-if="sectionKey == 'tread_coverings'">
                  <p>&nbsp;</p>
                  <div id="tog-tread_coverings" class="tog-wrap">
                    <label for="tread_coverings-tog" class="active">Trex Transcend Coverings</label>
                    <div class="tog-checkbox">
                      <div class="before"></div>
                      <input id='tread_coverings-tog' class='tog' type="checkbox" data-tread_coverings="tread-covering">
                      <div class="after"></div>
                    </div>
                    <label for="tread_coverings-tog" class="">No Tread Covering</label>
                  </div>
                  <div class="toggle-desc">
                    <p style="text-align: center;">Please note that additional styles and materials are also available. <br>To inquire, please call us at 1-877-488-1906.</p>
                    <p style="text-align: center;"></p>
                  </div>
                </div> -->

                <div class="toggle-wrap lighting-wrap" ng-if="sectionKey == 'colors_finishes'">
                  <h2 ng-if="sectionKey == 'colors_finishes' && staircase.style == 'natural'">Illumination</h2>
                  <p>Please specify if you would like to add an additional illumination kit to your stair.</p>
                  <p>&nbsp;</p>
                  <div id="tog-lighting" class="tog-wrap">
                    <label for="lighting-tog" class="active">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;no&nbsp;</label>
                    <div class="tog-checkbox">
                      <div class="before"></div>
                      <input id='lighting-tog' class='tog' type="checkbox" data-lighting="no">
                      <div class="after"></div>
                    </div>
                    <label for="lighting-tog" class="">&nbsp;yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  </div>
                </div>

              </div>
            </div>

            <div id="slider-{{sectionKey}}" class="s-slider" data-slick='{"appendDots": ".dots-{{sectionKey}}"}' ng-if="sectionKey != 'diameter' && sectionKey != 'lighting'">

              <div ng-repeat="option in staircase.stairOptions[sectionKey]" ng-click="staircase.setOption(sectionKey, option)" class="{{option.treadtype}} {{option.inorout}} {{option.covered}} {{option.finish}} {{option.platetype}}" data-slug="{{option.slug}}" data-treadtype="{{option.treadtype}}" data-covering="{{option.covered}}">
                <div class="slide-container">
                  <div class="img-wrap">
                    <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/{{sectionKey}}/{{option.slug}}.png' width="250px" height="auto" alt="{{option.name}}" ng-class="{selected: staircase[sectionKey] === option}">
                  </div>
                  <div class="option-name">
                    <h3>{{option.name}}<br ng-if="option.subname">{{option.subname}}</h3>
                  </div>
                </div>
              </div>

            </div>

            <div class="dots-wrap dots-{{sectionKey}}"></div>

          </div>

          <div class="review-button section-section no-hide">
            <div class="review">
              <button class="review-trigger hover-hand"><span>Review &amp; Save</span> <i class="_dgicon-arrow-right"></i></button>
            </div>
          </div>

        </div>

      </div>

    </main>

    <div class="takeover">
      <button class="close-takeover" ng-click="section.hideTakeover()"><i class="_dgicon-close"></i></button>
      <div class="item-description">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
          <h2 class="orange-title">{{section.optionTitle}}</h2>
          <h1>{{section.optionChoice.name}}</h1>
          <p>{{section.optionChoice.description}}</p>
        </div>
      </div>
    </div>

    <div class="takeover-nav">
      <div class="topbar">
        <button class="close-nav hover-hand" ng-click="section.hideTakeover()" data-close>
          <i class="_dgicon-arrow-left"></i> <span>Back to Builder</span>
        </button>
      </div>
      <div id="menu" class="section active">
        <nav>
          <ul>
            <li><a href="#" data-toggle="review"><span>Review Your Selections <i class="_dgicon-list tag"></i></span></a></li>
            <!-- <li><a href="#" data-toggle="save-stairs"><span>Save Your Stairs <i class="_dgicon-save"></i></span></a></li> -->
            <li><a href="#" data-toggle="get-quote"><span>Get A Quote <i class="_dgicon-tag"></i></span></a></li>
            <li><a href="#" class="downpdf"><span>Download &amp; Print <i class="_dgicon-download"></span></i></a></li>
            <li><a href="#" ng-click="staircase.facebookShare()"><span>Share with Friends <i class="_dgicon-share"></i></span></a></li>
            <li><a href="#" data-toggle="schedule-consultation"><span>Schedule a Consultation <i class="_dgicon-event-note"></i></span></a></li>
            <li><a href="#" ng-click="section.hideTakeover()"><span>Exit <i class="_dgicon-exit"></i></span></a></li>
          </ul>
        </nav>
      </div>

    </div>

    <section id="review" class="takeover">
      <div class="inner">
        <div class="takeover--content">

          <div id="review-staircase" data-finish="{{staircase.colors_finishes.finish}}" data-collar="{{staircase.spindles.slug}}" data-cont="non">
            <figure></figure>
          </div>

          <div id="review-items">
            <div class="topbar">
              <h2><span>Review Your Selections <i class="_dgicon-list tag"></i></span></h2>
              <button class="close-nav hover-hand" ng-click="section.hideTakeover()" data-close>
                <i class="_dgicon-arrow-left"></i> <span>Back to Builder</span>
              </button>
            </div>
            <div class="content-wrap">
              <div class="container-fluid">

                <div id="review-diameter" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Diameter</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <h4>{{staircase.diameter.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="diameter"><i class="_dgicon-swap"></i> <span>Change Diameter</span></a>
                    </div>
                  </div>
                </div>

                <div id="review-treads" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Treads</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <div class="img-wrapper">
                        <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/treads/{{staircase.treads.slug}}.png'>
                      </div>
                      <h4>{{staircase.treads.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="treads"><i class="_dgicon-swap"></i> <span>Change Tread</span></a>
                    </div>
                  </div>
                </div>

                <div id="review-tread_coverings" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Tread Coverings</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <div class="img-wrapper">
                        <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/tread_coverings/{{staircase.tread_coverings.slug}}.png'>
                      </div>
                      <h4>{{staircase.tread_coverings.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="tread_coverings"><i class="_dgicon-swap"></i> <span>Change Tread Covering</span></a>
                    </div>
                  </div>
                </div>

                <div id="review-spindles" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Spindles</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <div class="img-wrapper">
                        <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/spindles/{{staircase.spindles.slug}}.png'>
                      </div>
                      <h4>{{staircase.spindles.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="spindles"><i class="_dgicon-swap"></i> <span>Change Spindle</span></a>
                    </div>
                  </div>
                </div>

                <div id="review-colors_finishes" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Colors &amp; Finishes</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <div class="img-wrapper">
                        <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/colors_finishes/{{staircase.colors_finishes.slug}}.png'>
                      </div>
                      <h4>{{staircase.colors_finishes.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="colors_finishes"><i class="_dgicon-swap"></i> <span>Change Color / Finish</span></a>
                    </div>
                  </div>
                </div>

                <div id="review-lighting" class="row">
                  <div class="inner clearfix">
                    <div class="col-sm-3 col-xs-4">
                      <h3>Lighting</h3>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <h4>{{staircase.lighting.name}}</h4>
                    </div>
                    <div class="col-sm-3 col-xs-2">
                      <a href="#" data-show="colors_finishes"><i class="_dgicon-swap"></i> <span>Lighting</span></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="botbar">
              <nav>
                <ul>
                  <li><a href="#" data-toggle="get-quote" data-tip="Get A Quote"><span><em>Get A Quote</em> <i class="_dgicon-tag"></i></span></a></li>
                  <!-- <li><a href="#" data-toggle="save-stairs"><span><em>Save Your Stairs</em> <i class="_dgicon-save"></i></span></a></li> -->
                  <li><a href="#" class="downpdf" data-tip="Download &amp; Print"><span><em>Download &amp; Print</em> <i class="_dgicon-download"></i></span></a></li>
                  <li><a href="#" data-toggle="schedule-consultation" data-tip="Schedule a Consultation"><span><em>Schedule a Consultation</em> <i class="_dgicon-event-note"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="save-stairs" class="takeover">
      <div class="inner">
        <div class="takeover--content">

          <div class="builder-options">
            <form>
              <div class="col-md-12 row form-group">
                <button class="btn btn-primary" ng-click="staircase.saveBuild()">Save your build</button>
                <input class="form-control" id="buildcode" type="text" placeholder="build code" name="buildcode" disabled="disabled">
              </div>
              <div class="col-md-12 row form-group">
                <input class="form-control" id="loadBuild" type="text" placeholder="Load a build" name="loadBuild">
                <button ng-click="staircase.loadBuild()" class="btn btn-secondary">Load a build</button>
              </div>
            </form>
          </div>

        </div>
      </div>
      <button data-close><i ></i></button>
    </section>

    <section id="get-quote" class="takeover">
      <div class="inner vert-center">
        <div class="takeover--content">

          <div id="">
            <div class="topbar">
              <h2><span>Get A Quote <i class="_dgicon-tag"></i></span></h2>
              <button class="close-nav hover-hand" ng-click="section.hideTakeover()" data-close>
                <i class="_dgicon-arrow-left"></i> <span>Back to Builder</span>
              </button>
            </div>
            <div class="content-wrap">
              <div class="container-fluid">
                <div id="quoteForm">
                  <?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
                </div>
              </div>
            </div>
            <div class="botbar">
              <nav>
                <ul>
                  <li><a href="#" data-toggle="review" data-tip="Review Your Selections"><span><em>Review Your Selections</em> <i class="_dgicon-list tag"></i></span></a></li>
                  <!-- <li><a href="#" data-toggle="save-stairs"><span><em>Save Your Stairs</em> <i class="_dgicon-save"></i></span></a></li> -->
                  <li><a href="#" class="downpdf" data-tip="Download &amp; Print"><span><em>Download &amp; Print</em> <i class="_dgicon-download"></i></span></a></li>
                  <li><a href="#" data-toggle="schedule-consultation" data-tip="Schedule a Consultation"><span><em>Schedule a Consultation</em> <i class="_dgicon-event-note"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="download-print" class="takeover">
      <div class="inner">
        <div class="takeover--content">

          <div id="">
            <div class="topbar">
              <h2><span>Download &amp; Print <i class="_dgicon-download"></i></span></h2>
              <button class="close-nav hover-hand" ng-click="section.hideTakeover()" data-close>
                <i class="_dgicon-arrow-left"></i> <span>Back to Builder</span>
              </button>
            </div>
            <div class="content-wrap">
              <div class="container-fluid">
                <div id="content">
                  <h1 style="margin:0;">Your Custom Sprial Staircase Build</h1>
                  <p style="margin-top:0;"><?php echo date("F j, Y"); ?></p>

                  <div id="img-out" style="width:120px;height:234px;"></div>

                  <h6 style="margin:2em 0 2em;">
                    <!-- <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/treads/{{staircase.treads.slug}}.png' style="width:auto;height:auto;max-height:50px;max-width:50px;display:inline-block;"> -->
                    <span><strong>Diameter: </strong><span style="font-weight:normal;"><span class="diameter">{{staircase.diameter.name}}</span></span></span>
                  </h6>
                  <h6 style="margin:2em 0 2em;">
                    <!-- <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/treads/{{staircase.treads.slug}}.png' style="width:auto;height:auto;max-height:50px;max-width:50px;display:inline-block;"> -->
                    <span><strong>Tread: </strong><span style="font-weight:normal;">{{staircase.treads.name}}</span></span>
                  </h6>
                  <h6 style="margin:0 0 2em;">
                    <!-- <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/tread_coverings/{{staircase.tread_coverings.slug}}.png' style="width:auto;height:auto;max-height:50px;max-width:50px;display:inline-block;"> -->
                    <span><strong>Tread Covering: </strong><span style="font-weight:normal;">{{staircase.tread_coverings.name}}</span></span>
                  </h6>
                  <h6 style="margin:0 0 2em;">
                    <!-- <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/spindles/{{staircase.spindles.slug}}.png' style="width:auto;height:auto;max-height:50px;max-width:50px;display:inline-block;"> -->
                    <span><strong>Spindle: </strong><span style="font-weight:normal;">{{staircase.spindles.name}}</span></span>
                  </h6>
                  <h6 style="margin:0 0 2em;">
                    <!-- <img ng-src='<?php echo content_url('uploads'); ?>/builder/assets/img/opts/colors_finishes/{{staircase.colors_finishes.slug}}.png' style="width:auto;height:auto;max-height:50px;max-width:50px;display:inline-block;"> -->
                    <span><strong>Color / Finish: </strong><span style="font-weight:normal;">{{staircase.colors_finishes.name}}</span></span>
                  </h6>
                  <h6 style="margin:0 0 2em;">
                    <span><strong>Lighting: </strong><span style="font-weight:normal;">{{staircase.lighting.name}}</span></span>
                  </h6>
                  <p style="margin-bottom:2em;"><small><strong>Builder Information:</strong><br>Our builder is based on a 5 Foot Diameter CODE stair with 13 risers shown. The actual height and diameter of your stairs will vary. Our builder allows you to customize your options and see a visual representation of your stairs on the fly.</small></p>
                  <img ng-src="<?php echo get_template_directory_uri(); ?>/builder/assets/img/trex-spiral-stairs-logo.png" style="width:100px;">
                  <p>
                    <strong>Headquarters</strong>
                    <br>400 Reed Road
                    <br>Broomall, PA 19008
                    <br>Tel: (877) 488-1906
                  </p>
                  <p>&copy; <?php echo date('Y'); ?> Trex Spiral Stairs</p>
                </div>
                <div id="bypassme"></div>
                <button class="downpdf">generate PDF</button>
              </div>
            </div>
            <div class="botbar">
              <nav>
                <ul>
                  <li><a href="#" data-toggle="review" data-tip="Review Your Selections"><span><em>Review Your Selections</em> <i class="_dgicon-list tag"></i></span></a></li>
                  <li><a href="#" data-toggle="get-quote" data-tip="Get A Quote"><span><em>Get A Quote</em> <i class="_dgicon-tag"></i></span></a></li>
                  <!-- <li><a href="#" data-toggle="save-stairs"><span><em>Save Your Stairs</em> <i class="_dgicon-save"></i></span></a></li> -->
                  <li><a href="#" data-toggle="schedule-consultation" data-tip="Schedule a Consultation"><span><em>Schedule a Consultation</em> <i class="_dgicon-event-note"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="schedule-consultation" class="takeover">
      <div class="inner vert-center">
        <div class="takeover--content">

          <div id="">
            <div class="topbar">
              <h2><span>Schedule a Consultation <i class="_dgicon-event-note"></i></span></h2>
              <button class="close-nav hover-hand" ng-click="section.hideTakeover()" data-close>
                <i class="_dgicon-arrow-left"></i> <span>Back to Builder</span>
              </button>
            </div>
            <div class="content-wrap">
              <div class="container-fluid">
                <div id="quoteForm">
                  <?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true"]'); ?>
                </div>
              </div>
            </div>
            <div class="botbar">
              <nav>
                <ul>
                  <li><a href="#" data-toggle="review" data-tip="Review Your Selections"><span><em>Review Your Selections</em> <i class="_dgicon-list tag"></i></span></a></li>
                  <li><a href="#" data-toggle="get-quote" data-tip="Get A Quote"><span><em>Get A Quote</em> <i class="_dgicon-tag"></i></span></a></li>
                  <!-- <li><a href="#" data-toggle="save-stairs"><span><em>Save Your Stairs</em> <i class="_dgicon-save"></i></span></a></li> -->
                  <li><a href="#" class="downpdf" data-tip="Download &amp; Print"><span><em>Download &amp; Print</em> <i class="_dgicon-download"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
    </section>

  </div>

<?php locate_template(array('builder/footer-builder.php'), true ); ?>
