/*!
 * jQuery Takeover plugin
 * Original author: Durkan Group
 * v1.0
 * Requires: jQuery, modernizr
 */

;(function ( $, window, document, undefined ) {

	"use strict";

    // Create the defaults once
    var pluginName = "takeover",
        defaults = {};

    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    $.extend(Plugin.prototype, {

        init: function() {

        	this.buildCache();
        	this.bindEvents();
        },

        toggleTakeover: function(takeover_id, takeover_slug) {
        	var plugin = this;

        	var body = $('body'),
			takeover = $(document).find('#'+takeover_id),
			transEndEventNames = {
				'WebkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd',
				'msTransition': 'MSTransitionEnd',
				'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions };

			// if no takeover_id then check if takeover is open
			if ( (takeover_id == undefined || takeover_id.length == 0) && body.hasClass('show-takeover')) {
				takeover_id = '';
				takeover = $(document).find('.takeover.open');
			}

			// check takeover_slug
			if (takeover_slug == undefined || takeover_slug.length == 0) {
				takeover_slug = takeover_id
			}

			// check if takeover found
			if (takeover.length == 0) {
				return;
			}

			if ( takeover.hasClass('open') ) { // close takeover
				plugin.$element.trigger('takeover-closing', takeover_id);

				takeover.removeClass('open');
				takeover.addClass('close');
				body.removeClass('show-takeover');
				body.removeClass('js-no-scroll');

				history.pushState("", document.title, window.location.pathname);

				var onEndTransitionFnClose = function( ev ) {
					if( support.transitions ) {
						this.removeEventListener( transEndEventName, onEndTransitionFnClose );
					}
					takeover.removeClass('close');
					plugin.$element.trigger('takeover-closed', takeover_id);
				};
				if( support.transitions ) {
					takeover[0].addEventListener( transEndEventName, onEndTransitionFnClose );
				} else {
					onEndTransitionFnClose();
				}
			} else if( !takeover.hasClass('close') ) { // open takeover
				plugin.$element.trigger('takeover-opening', takeover_id);

				takeover.addClass('open');
				body.addClass('show-takeover');

				window.location.hash = "#"+takeover_slug;
				var takeover_locationHashChanged = function() {  
					if (window.location.hash == '') {
						toggleTakeover();
					}
				} 
				window.onhashchange = takeover_locationHashChanged;

				var onEndTransitionFnOpen = function( ev ) {
					if( support.transitions ) {
						this.removeEventListener( transEndEventName, onEndTransitionFnOpen );
					}
					body.addClass('js-no-scroll');
					plugin.$element.trigger('takeover-open', takeover_id);
				};
				if( support.transitions ) {
					takeover[0].addEventListener( transEndEventName, onEndTransitionFnOpen );
				} else {
					onEndTransitionFnOpen();
				}
			}

        },

        // Cache DOM nodes for performance
        buildCache: function () {
            this.$element = $(this.element);
        },

        bindEvents: function() {
            var plugin = this;
            
            // toggle on click
            plugin.$element.on('click'+'.'+plugin._name, '.toggle-takeover', function(event) {
            	var takeover_id = $(this).data('takeover');
            	var takeover_slug = $(this).data('takeover-slug');
            		if (typeof takeover_slug === 'undefined') {
            			takeover_slug = takeover_id;
            		}
                plugin.toggleTakeover.call(plugin, takeover_id, takeover_slug);
            });

            // toggle on event
            plugin.$element.on('toggle-takeover'+'.'+plugin._name+' close-takeover'+'.'+plugin._name, function(event, takeover_id, takeover_slug) {
                plugin.toggleTakeover.call(plugin, takeover_id, takeover_slug);
            });

            // close with escape key
            plugin.$element.on('keydown'+'.'+plugin._name, function(event) {
            	var keycode = (event.keyCode ? event.keyCode : event.which);
            	if (keycode == '27' && $('body').hasClass('show-takeover')) {
					plugin.toggleTakeover.call(plugin);
				}
            });

        }

    });

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );