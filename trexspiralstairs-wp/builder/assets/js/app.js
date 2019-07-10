(function() {

  var build = angular.module('builder', [ ]);

  build.controller('StaircaseController', function() {
    this.scene = build;
    this.descriptions = staircaseOptionsDescriptions;
    this.descriptionalts = staircaseOptionsDescriptionAlts;
    this.names = staircaseOptionsNames;
    this.stairOptions = staircaseOptions;
    this.style = $('.options').data('style');
    this.stairTabs =  Object.keys(staircaseTabs);
    this.sections = Object.keys(this.stairOptions);
    (this.sections).forEach(function(section) {
      var savedValue = getQueryString(section);
      var isSavedValueARealOption = $.inArray(savedValue, staircaseOptions[section]) !== -1;
      this[section] = isSavedValueARealOption ? savedValue : staircaseOptions[section][0];
    }.bind(this));
    this.setOption = function(key, value) {
      this[key] = value;
    }

    this.loadBuild = function() {
      var buildOptions = $("#loadBuild").val().split(';');

      for(var option in buildOptions) {
        option = buildOptions[option].split(':');
        possibleOptions = [];

        var thisSavedValueIsARealOption
        for(var stairOpt in staircaseOptions[option[0]]) {
          possibleOptions.push( staircaseOptions[option[0]][stairOpt].name );
          thisSavedValueIsARealOption = $.inArray(option[1], possibleOptions) !== -1;
          if (thisSavedValueIsARealOption) {
            this[option[0]] = staircaseOptions[option[0]][stairOpt];
            break;
          }
        }

      }
    };

    this.saveBuild = function() {
      buildCode = "";
      for(var option in this.stairOptions) {
        buildCode += (option+":"+this[option].name+";");
      }
      $("#buildcode").val(buildCode);
    }
    this.facebookShare = function() {
      window.open(this.createLink(), '_blank');
    }

    this.createLink = function() {
      fbURI = "https://www.facebook.com/sharer/sharer.php?u=";
      currentURI = window.location
      buildQuery = "?";
      for (var option in this.stairOptions) {
        buildQuery += (option+"="+this[option].name+"&");
      }
      console.log(fbURI + encodeURI(currentURI + buildQuery));
      return fbURI + encodeURIComponent(currentURI + buildQuery);
    }

  });

  build.controller('SectionController', function(){
    this.section = "diameter";
    this.optionChoice = {};
    this.optionTitle = "";
    this.selectTab = function(userSelectedSection) {
      this.section = userSelectedSection;
      $(".active").addClass('visited');
    }

    this.isSelected =  function(sectionID) {
      return this.section === sectionID;
    }

    this.setTakeOverOptions = function(option, title) {
      this.optionChoice = option;
      this.optionTitle = title;
      $(".takeover").addClass('showTakeover');
    }

    this.hideTakeover = function() {
      $('.takeover.showTakeover').removeClass('showTakeover');
      $('.takeover-nav.show-menu').removeClass('show-menu')
    }

  });

  staircaseTabs = {
    diameter: "Diameter",
    treads: "Treads",
    tread_coverings: "Tread Coverings",
    spindles: "Spindles",
    colors_finishes: "Colors & Options"
  };

  staircaseOptions = {
    diameter: [
      {name: "5'", slug: "5", inorout: "indoor outdoor", description: ""},
      {name: "6'", slug: "6", inorout: "indoor outdoor", description: ""},
      // {name: "Aluminum Handrail with Scroll Ends", slug: "handrail-alum-scrolls", inorout: "indoor outdoor", description: ""},
      // {name: "Brass Handrail", slug: "handrail-brass", inorout: "indoor", description: ""},
      // {name: "Brass Handrail with Scroll Ends", slug: "handrail-brass-scrolls", inorout: "indoor", description: ""},
      // {name: "Wood Handrail with End Caps & Landing Top Rail", slug: "handrail-wood-toprail", inorout: "indoor", description: ""},
      // {name: "Wood Handrail with Scroll Ends & Landing Top Rail", slug: "handrail-wood-scrolls-toprail", inorout: "indoor", description: ""}
    ],
    treads: [
      {name: "Smooth Plate with Open Ends", slug: "smooth-plate-open-ends", treadtype: "tread-covering", platetype: "platetype-open", description: ""},
      {name: "Smooth Plate with Closed Ends", slug: "smooth-plate-closed-ends", treadtype: "tread-covering", platetype: "platetype-closed", description: ""},
      {name: "Diamond Plate with Open Ends", slug: "diamond-plate-open-ends", treadtype: "no-tread-covering", platetype: "platetype-open", description: ""},
      {name: "Diamond Plate with Closed Ends", slug: "diamond-plate-closed-ends", treadtype: "no-tread-covering", platetype: "platetype-closed", description: ""},
      // {name: "Tapered Lip Diamond Plate Tread Design", slug: "tread-diamondplate-tapered", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Back Lip Up Diamond Plate Tread Design", slug: "tread-diamondplate-blu", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Tapered Lip Tread Design w/ Bar Grating Inserts", slug: "tread-grate-tapered-closed", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Back Lip Up Tread Design w/ Bar Grating Inserts", slug: "tread-grate-blu-closed", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "G2 Tread Design", slug: "tread-g2", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "G4 Tread Design", slug: "tread-g4", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "G7 Tread Design", slug: "tread-g7", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "G8 Tread Design", slug: "tread-g8", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "G8 Tread Design w/ Back Lip Up", slug: "tread-g8-blu", treadtype: "backlipup", inorout: "indoor outdoor", description: ""}
    ],
    tread_coverings: [
      {name: "No Tread Covering", slug: "no-tread-covering", covered: "no-tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Fire Pit", slug: "fire-pit", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Gravel Path", slug: "gravel-path", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Havana Gold", slug: "havana-gold", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Island Mist", slug: "island-mist", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Lava Rock", slug: "lava-rock", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Rope Swing", slug: "rope-swing", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Spiced Rum", slug: "spiced-rum", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Tiki Torch", slug: "tiki-torch", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Tree House", slug: "tree-house", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Vintage Lantern", slug: "vintage-lantern", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},      
      // {name: "Charcoal Black", slug: "taperedlip-american-cherry", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Classic White", slug: "taperedlip-australian-cyprus", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Fire Pit", slug: "taperedlip-bamboo", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Gravel Path", slug: "taperedlip-cumaru", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Rope Swing", slug: "taperedlip-hickory", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Tree House", slug: "taperedlip-jatoba", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Vintage Lantern", slug: "taperedlip-mahogany", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Maple", slug: "taperedlip-maple", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Red Oak", slug: "taperedlip-red-oak", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Walnut", slug: "taperedlip-walnut", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "White Oak", slug: "taperedlip-white-oak", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},

      // {name: "Ipe (Brazilian Walnut)", slug: "taperedlip-brazilian-walnut-ext", covered: "tread-covering", treadtype: "taperedlip", inorout: "outdoor", description: ""},
      // {name: "Mahogany", slug: "taperedlip-mahogany-ext", covered: "tread-covering", treadtype: "taperedlip", inorout: "outdoor", description: ""},
      // {name: "Red Cedar", slug: "taperedlip-red-cedar-ext", covered: "tread-covering", treadtype: "taperedlip", inorout: "outdoor", description: ""},

      // {name: "No Tread Covering", slug: "backlipup-no-tread-covering", covered: "no-tread-covering", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "American Cherry", slug: "backlipup-american-cherry", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Australian Cyprus", slug: "backlipup-australian-cyprus", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Bamboo", slug: "backlipup-bamboo", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Cumaru", slug: "backlipup-cumaru", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Hickory", slug: "backlipup-hickory", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Jatoba", slug: "backlipup-jatoba", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Mahogany", slug: "backlipup-mahogany", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Maple", slug: "backlipup-maple", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Red Oak", slug: "backlipup-red-oak", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Walnut", slug: "backlipup-walnut", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "White Oak", slug: "backlipup-white-oak", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},

      // {name: "Ipe (Brazilian Walnut)", slug: "backlipup-brazilian-walnut-ext", covered: "tread-covering", treadtype: "backlipup", inorout: "outdoor", description: ""},
      // {name: "Mahogany", slug: "backlipup-mahogany-ext", covered: "tread-covering", treadtype: "backlipup", inorout: "outdoor", description: ""},
      // {name: "Red Cedar", slug: "backlipup-red-cedar-ext", covered: "tread-covering", treadtype: "backlipup", inorout: "outdoor", description: ""},

      // {name: "No Tread Covering", slug: "backlipup-ssmultiline-no-tread-covering", covered: "no-tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "American Cherry", slug: "backlipup-ssmultiline-american-cherry", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Australian Cyprus", slug: "backlipup-ssmultiline-australian-cyprus", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Bamboo", slug: "backlipup-ssmultiline-bamboo", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Cumaru", slug: "backlipup-ssmultiline-cumaru", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Hickory", slug: "backlipup-ssmultiline-hickory", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Jatoba", slug: "backlipup-ssmultiline-jatoba", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Mahogany", slug: "backlipup-ssmultiline-mahogany", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Maple", slug: "backlipup-ssmultiline-maple", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Red Oak", slug: "backlipup-ssmultiline-red-oak", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "Walnut", slug: "backlipup-ssmultiline-walnut", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},
      // {name: "White Oak", slug: "backlipup-ssmultiline-white-oak", covered: "tread-covering", treadtype: "backlipup", inorout: "indoor", description: ""},

      // {name: "No Tread Covering", slug: "taperedlip-ssmultiline-no-tread-covering", covered: "no-tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "American Cherry", slug: "taperedlip-ssmultiline-american-cherry", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Australian Cyprus", slug: "taperedlip-ssmultiline-australian-cyprus", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Bamboo", slug: "taperedlip-ssmultiline-bamboo", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Cumaru", slug: "taperedlip-ssmultiline-cumaru", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Hickory", slug: "taperedlip-ssmultiline-hickory", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Jatoba", slug: "taperedlip-ssmultiline-jatoba", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Mahogany", slug: "taperedlip-ssmultiline-mahogany", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Maple", slug: "taperedlip-ssmultiline-maple", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Red Oak", slug: "taperedlip-ssmultiline-red-oak", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "Walnut", slug: "taperedlip-ssmultiline-walnut", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
      // {name: "White Oak", slug: "taperedlip-ssmultiline-white-oak", covered: "tread-covering", treadtype: "taperedlip", inorout: "indoor", description: ""},
    ],
    spindles: [
      {name: "Square", slug: "square", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Round", slug: "round", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      {name: "Multiline", slug: "multiline", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Aluminum Cast Center Collars", slug: "taperedlip-castcollar-alum-lr", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Brass Cast Center Collars", slug: "taperedlip-castcollar-brass-lr", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Small Scroll Castings", slug: "taperedlip-smallscroll-lr", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Double Scroll Castings", slug: "taperedlip-doublescroll-lr", treadtype: "taperedlip", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles", slug: "backlipup-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Baskets", slug: "backlipup-basket-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Aluminum Cast Center Collars", slug: "backlipup-castcollar-alum-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Brass Cast Center Collars", slug: "backlipup-castcollar-brass-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Small Scroll Castings", slug: "backlipup-smallscroll-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Triple In-Between Spindles w/ Double Scroll Castings", slug: "backlipup-doublescroll-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""},
      // {name: "Stainless Steel Multi-Line Rail System", slug: "backlipup-multiline-lr", treadtype: "backlipup", inorout: "indoor outdoor", description: ""}
    ],
    
    // poles: [
    //   {name: "STD Sleeve",description: "lorem ipsum"},
    //   {name: "Continuous Sleeve",description: "lorem ipsum"}
    // ],
    /*pole_caps: [
      {name: "Aluminum Ball Pole Cap", slug: "balltop-aluminum", inorout: "indoor outdoor", description: ""},
      {name: "Aluminum Dome Pole Cap", slug: "dometop-aluminum", inorout: "indoor outdoor", description: ""},
      {name: "Brass Ball Pole Cap", slug: "balltop-brass", inorout: "indoor", description: ""},
      {name: "Red Oak Ball Pole Cap", slug: "balltop-red-oak", inorout: "indoor", description: ""},
      {name: "Flat Red Oak Pole Cap", slug: "flattop-red-oak", inorout: "indoor", description: ""},
      // {name: "Red Oak Base Plate Covers", slug: "baseplate-red-oak", inorout: "indoor", description: ""}
    ],*/
    lighting: [
      {name: "No Lighting Kit", slug: "no-lighting-kit", inorout: "indoor outdoor", description: ""},
      {name: "Lighting Kit", slug: "lighting-kit", inorout: "indoor outdoor", description: ""},
    ],
    colors_finishes: [
      {name: "Black", subname: "", slug: "black", finish: "hp", inorout: "indoor outdoor", description: ""},
      {name: "Bronze", subname: "", slug: "bronze", finish: "hp", inorout: "indoor outdoor", description: ""},
      {name: "White", subname: "", slug: "white", finish: "hp", inorout: "indoor outdoor", description: ""},
      {name: "Vintage Lantern", subname: "", slug: "vintage-lantern", finish: "hp", inorout: "indoor outdoor", description: ""},
      {name: "Natural", subname: "", slug: "natural", finish: "natural", inorout: "indoor outdoor", description: ""},
      // {name: "Galvanized", subname: "", slug: "finish-galvanized", finish: "galvanized", inorout: "outdoor", description: ""},
      // {name: "Black Gloss", subname: "Powder Coat", slug: "finish-black-gloss", finish: "black-gloss", inorout: "indoor outdoor", description: ""},
      // {name: "Black Matte", subname: "Powder Coat", slug: "finish-black-matte", finish: "black-matte", inorout: "indoor outdoor", description: ""},
      // {name: "Brick Red", subname: "Powder Coat", slug: "finish-brick-red", finish: "brick-red", inorout: "indoor outdoor", description: ""},
      // {name: "Brown", subname: "Powder Coat", slug: "finish-brown", finish: "brown", inorout: "indoor outdoor", description: ""},
      // {name: "Brown Grey", subname: "Powder Coat", slug: "finish-brown-grey", finish: "brown-grey", inorout: "indoor outdoor", description: ""},
      // {name: "Champagne", subname: "Powder Coat", slug: "finish-champagne", finish: "champagne", inorout: "indoor outdoor", description: ""},
      // {name: "Classic Grey", subname: "Powder Coat", slug: "finish-classic-grey", finish: "classic-grey", inorout: "indoor outdoor", description: ""},
      // {name: "Dark Roast", subname: "Powder Coat", slug: "finish-dark-roast", finish: "dark-roast", inorout: "indoor outdoor", description: ""},
      // {name: "Forest Green", subname: "Powder Coat", slug: "finish-forest-green", finish: "forest-green", inorout: "indoor outdoor", description: ""},
      // {name: "Hunter Green", subname: "Powder Coat", slug: "finish-hunter-green", finish: "hunter-green", inorout: "indoor outdoor", description: ""},
      // {name: "Light Grey", subname: "Powder Coat", slug: "finish-light-grey", finish: "light-grey", inorout: "indoor outdoor", description: ""},
      // {name: "Mineral Bronze", subname: "Powder Coat", slug: "finish-mineral-bronze", finish: "mineral-bronze", inorout: "indoor outdoor", description: ""},
      // {name: "Navy Blue", subname: "Powder Coat", slug: "finish-navy-blue", finish: "navy-blue", inorout: "indoor outdoor", description: ""},
      // {name: "Rust", subname: "Powder Coat", slug: "finish-rust", finish: "rust", inorout: "indoor outdoor", description: ""},
      // {name: "Sandstone", subname: "Powder Coat", slug: "finish-sandstone", finish: "sandstone", inorout: "indoor outdoor", description: ""},
      // {name: "Silver", subname: "Powder Coat", slug: "finish-silver", finish: "silver", inorout: "indoor outdoor", description: ""},
      // {name: "Stainless Steel", subname: "Powder Coat", slug: "finish-stainless-steel", finish: "stainless-steel", inorout: "indoor outdoor", description: ""},
      // {name: "Tan", subname: "Powder Coat", slug: "finish-tan", finish: "tan", inorout: "indoor outdoor", description: ""},
      // {name: "Verdigris", subname: "Powder Coat", slug: "finish-verdigris", finish: "verdigris", inorout: "indoor outdoor", description: ""},
      // {name: "Weathered Brown", subname: "Powder Coat", slug: "finish-weathered-brown", finish: "weathered-brown", inorout: "indoor outdoor", description: ""},
      // {name: "Weathered Iron", subname: "Powder Coat", slug: "finish-weathered-iron", finish: "weathered-iron", inorout: "indoor outdoor", description: ""},
      // {name: "White Gloss", subname: "Powder Coat", slug: "finish-white-gloss", finish: "white-gloss", inorout: "indoor outdoor", description: ""},
      // {name: "White Matte", subname: "Powder Coat", slug: "finish-white-matte", finish: "white-matte", inorout: "indoor outdoor", description: ""}
    ]
  }

  staircaseOptionsNames = {
    treads: "Treads",
    tread_coverings: "Tread Coverings",
    spindles: "Spindles",
    diameter: "Diameter",
    // poles: "Poles",
    //pole_caps: "Pole Caps",
    colors_finishes: "Colors & Options"
  }

  staircaseOptionsDescriptions = {
    treads: "Trex Spiral Stairs come in two varieties; smooth plate or diamond plate. Please note that you can choose a covering with smooth plate but not with diamond plate.",
    spindles: "Please choose from a sampling of our most popular spindle options.",
    diameter: "Please choose your preferred diameter.",
    // poles: "Laoreet quam tincidunt convallis dignissim proin nunc fusce in. Lacinia rutrum egestas gravida at luctus tincidunt venenatis. Vel orci vivamus diam volutpat adipiscing. Lacinia orci eros accumsan gravida et malesuada. Pulvinar orci nulla eros. Euismod elementum faucibus dui ipsum adipiscing aenean augue in odio.",
    tread_coverings: "Trex offers it's top of the line Trex Transcend Decking as options for your tread coverings. There are a total of 10 options for this high performance material.",
    //pole_caps: "Please choose from a sampling of our most popular Pole Cap options.",
    colors_finishes: "With a Trex stair, you have the option of 4 premium Trex colors for your spiral stair."
  }

  staircaseOptionsDescriptionAlts = {
    no_tread_coverings_diamond: "When you select the Diamond plate tread there are no tread coverings. Please proceed to your spindles options.",
    no_tread_coverings: "We are happy to provide you with a cut out template if you wish to choose another material for your tread coverings.",
  }

  var getQueryString = function ( field ) {
    var href = window.location.href;
    var regex = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
    var query = regex.exec(href);
    return query ? query[1] : null;
  };

})();
