/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	var parentJsonpFunction = window["webpackJsonp"];
/******/ 	window["webpackJsonp"] = function webpackJsonpCallback(chunkIds, moreModules) {
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, callbacks = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(installedChunks[chunkId])
/******/ 				callbacks.push.apply(callbacks, installedChunks[chunkId]);
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			modules[moduleId] = moreModules[moduleId];
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(chunkIds, moreModules);
/******/ 		while(callbacks.length)
/******/ 			callbacks.shift().call(null, __webpack_require__);
/******/ 		if(moreModules[0]) {
/******/ 			installedModules[0] = 0;
/******/ 			return __webpack_require__(0);
/******/ 		}
/******/ 	};

/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// object to store loaded and loading chunks
/******/ 	// "0" means "already loaded"
/******/ 	// Array means "loading", array contains callbacks
/******/ 	var installedChunks = {
/******/ 		7:0
/******/ 	};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}

/******/ 	// This file contains only the entry chunk.
/******/ 	// The chunk loading function for additional chunks
/******/ 	__webpack_require__.e = function requireEnsure(chunkId, callback) {
/******/ 		// "0" is the signal for "already loaded"
/******/ 		if(installedChunks[chunkId] === 0)
/******/ 			return callback.call(null, __webpack_require__);

/******/ 		// an array means "currently loading".
/******/ 		if(installedChunks[chunkId] !== undefined) {
/******/ 			installedChunks[chunkId].push(callback);
/******/ 		} else {
/******/ 			// start chunk loading
/******/ 			installedChunks[chunkId] = [callback];
/******/ 			var head = document.getElementsByTagName('head')[0];
/******/ 			var script = document.createElement('script');
/******/ 			script.type = 'text/javascript';
/******/ 			script.charset = 'utf-8';
/******/ 			script.async = true;

/******/ 			script.src = __webpack_require__.p + "" + chunkId + ".js/fbq." + ({"3":"main"}[chunkId]||chunkId) + ".js";
/******/ 			head.appendChild(script);
/******/ 		}
/******/ 	};

/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(523);


/***/ },

/***/ 6:
/***/ function(module, exports) {

	module.exports = jQuery;

/***/ },

/***/ 9:
/***/ function(module, exports) {

	
	/*jshint
	   asi: true,
	   unused: true,
	   boss: true,
	   loopfunc: true,
	   eqnull: true
	 */


	/*!
	 * Legacy browser support
	 */


	// Map array support
	if ( ![].map ) {
	    Array.prototype.map = function ( callback, self ) {
	        var array = this, len = array.length, newArray = new Array( len )
	        for ( var i = 0; i < len; i++ ) {
	            if ( i in array ) {
	                newArray[ i ] = callback.call( self, array[ i ], i, array )
	            }
	        }
	        return newArray
	    }
	}


	// Filter array support
	if ( ![].filter ) {
	    Array.prototype.filter = function( callback ) {
	        if ( this == null ) throw new TypeError()
	        var t = Object( this ), len = t.length >>> 0
	        if ( typeof callback != 'function' ) throw new TypeError()
	        var newArray = [], thisp = arguments[ 1 ]
	        for ( var i = 0; i < len; i++ ) {
	          if ( i in t ) {
	            var val = t[ i ]
	            if ( callback.call( thisp, val, i, t ) ) newArray.push( val )
	          }
	        }
	        return newArray
	    }
	}


	// Index of array support
	if ( ![].indexOf ) {
	    Array.prototype.indexOf = function( searchElement ) {
	        if ( this == null ) throw new TypeError()
	        var t = Object( this ), len = t.length >>> 0
	        if ( len === 0 ) return -1
	        var n = 0
	        if ( arguments.length > 1 ) {
	            n = Number( arguments[ 1 ] )
	            if ( n != n ) {
	                n = 0
	            }
	            else if ( n !== 0 && n != Infinity && n != -Infinity ) {
	                n = ( n > 0 || -1 ) * Math.floor( Math.abs( n ) )
	            }
	        }
	        if ( n >= len ) return -1
	        var k = n >= 0 ? n : Math.max( len - Math.abs( n ), 0 )
	        for ( ; k < len; k++ ) {
	            if ( k in t && t[ k ] === searchElement ) return k
	        }
	        return -1
	    }
	}


	/*!
	 * Cross-Browser Split 1.1.1
	 * Copyright 2007-2012 Steven Levithan <stevenlevithan.com>
	 * Available under the MIT License
	 * http://blog.stevenlevithan.com/archives/cross-browser-split
	 */
	var nativeSplit = String.prototype.split, compliantExecNpcg = /()??/.exec('')[1] === undefined
	String.prototype.split = function(separator, limit) {
	    var str = this
	    if (Object.prototype.toString.call(separator) !== '[object RegExp]') {
	        return nativeSplit.call(str, separator, limit)
	    }
	    var output = [],
	        flags = (separator.ignoreCase ? 'i' : '') +
	                (separator.multiline  ? 'm' : '') +
	                (separator.extended   ? 'x' : '') +
	                (separator.sticky     ? 'y' : ''),
	        lastLastIndex = 0,
	        separator2, match, lastIndex, lastLength
	    separator = new RegExp(separator.source, flags + 'g')
	    str += ''
	    if (!compliantExecNpcg) {
	        separator2 = new RegExp('^' + separator.source + '$(?!\\s)', flags)
	    }
	    limit = limit === undefined ? -1 >>> 0 : limit >>> 0
	    while (match = separator.exec(str)) {
	        lastIndex = match.index + match[0].length
	        if (lastIndex > lastLastIndex) {
	            output.push(str.slice(lastLastIndex, match.index))
	            if (!compliantExecNpcg && match.length > 1) {
	                match[0].replace(separator2, function () {
	                    for (var i = 1; i < arguments.length - 2; i++) {
	                        if (arguments[i] === undefined) {
	                            match[i] = undefined
	                        }
	                    }
	                })
	            }
	            if (match.length > 1 && match.index < str.length) {
	                Array.prototype.push.apply(output, match.slice(1))
	            }
	            lastLength = match[0].length
	            lastLastIndex = lastIndex
	            if (output.length >= limit) {
	                break
	            }
	        }
	        if (separator.lastIndex === match.index) {
	            separator.lastIndex++
	        }
	    }
	    if (lastLastIndex === str.length) {
	        if (lastLength || !separator.test('')) {
	            output.push('')
	        }
	    } else {
	        output.push(str.slice(lastLastIndex))
	    }
	    return output.length > limit ? output.slice(0, limit) : output
	};


/***/ },

/***/ 10:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * pickadate.js v3.5.6, 2015/04/20
	 * By Amsul, http://amsul.ca
	 * Hosted on http://amsul.github.io/pickadate.js
	 * Licensed under MIT
	 */

	(function ( factory ) {

	    // AMD.
	    if ( true )
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(6)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))

	    // Node.js/browserify.
	    else if ( typeof exports == 'object' )
	        module.exports = factory( require('jquery') )

	    // Browser globals.
	    else this.Picker = factory( jQuery )

	}(function( $ ) {

	var $window = $( window )
	var $document = $( document )
	var $html = $( document.documentElement )
	var supportsTransitions = document.documentElement.style.transition != null


	/**
	 * The picker constructor that creates a blank picker.
	 */
	function PickerConstructor( ELEMENT, NAME, COMPONENT, OPTIONS ) {

	    // If there’s no element, return the picker constructor.
	    if ( !ELEMENT ) return PickerConstructor


	    var
	        IS_DEFAULT_THEME = false,


	        // The state of the picker.
	        STATE = {
	            id: ELEMENT.id || 'P' + Math.abs( ~~(Math.random() * new Date()) )
	        },


	        // Merge the defaults and options passed.
	        SETTINGS = COMPONENT ? $.extend( true, {}, COMPONENT.defaults, OPTIONS ) : OPTIONS || {},


	        // Merge the default classes with the settings classes.
	        CLASSES = $.extend( {}, PickerConstructor.klasses(), SETTINGS.klass ),


	        // The element node wrapper into a jQuery object.
	        $ELEMENT = $( ELEMENT ),


	        // Pseudo picker constructor.
	        PickerInstance = function() {
	            return this.start()
	        },


	        // The picker prototype.
	        P = PickerInstance.prototype = {

	            constructor: PickerInstance,

	            $node: $ELEMENT,


	            /**
	             * Initialize everything
	             */
	            start: function() {

	                // If it’s already started, do nothing.
	                if ( STATE && STATE.start ) return P


	                // Update the picker states.
	                STATE.methods = {}
	                STATE.start = true
	                STATE.open = false
	                STATE.type = ELEMENT.type


	                // Confirm focus state, convert into text input to remove UA stylings,
	                // and set as readonly to prevent keyboard popup.
	                ELEMENT.autofocus = ELEMENT == getActiveElement()
	                ELEMENT.readOnly = !SETTINGS.editable
	                ELEMENT.id = ELEMENT.id || STATE.id
	                if ( ELEMENT.type != 'text' ) {
	                    ELEMENT.type = 'text'
	                }


	                // Create a new picker component with the settings.
	                P.component = new COMPONENT(P, SETTINGS)


	                // Create the picker root and then prepare it.
	                P.$root = $( '<div class="' + CLASSES.picker + '" id="' + ELEMENT.id + '_root" />' )
	                prepareElementRoot()


	                // Create the picker holder and then prepare it.
	                P.$holder = $( createWrappedComponent() ).appendTo( P.$root )
	                prepareElementHolder()


	                // If there’s a format for the hidden input element, create the element.
	                if ( SETTINGS.formatSubmit ) {
	                    prepareElementHidden()
	                }


	                // Prepare the input element.
	                prepareElement()


	                // Insert the hidden input as specified in the settings.
	                if ( SETTINGS.containerHidden ) $( SETTINGS.containerHidden ).append( P._hidden )
	                else $ELEMENT.after( P._hidden )


	                // Insert the root as specified in the settings.
	                if ( SETTINGS.container ) $( SETTINGS.container ).append( P.$root )
	                else $ELEMENT.after( P.$root )


	                // Bind the default component and settings events.
	                P.on({
	                    start: P.component.onStart,
	                    render: P.component.onRender,
	                    stop: P.component.onStop,
	                    open: P.component.onOpen,
	                    close: P.component.onClose,
	                    set: P.component.onSet
	                }).on({
	                    start: SETTINGS.onStart,
	                    render: SETTINGS.onRender,
	                    stop: SETTINGS.onStop,
	                    open: SETTINGS.onOpen,
	                    close: SETTINGS.onClose,
	                    set: SETTINGS.onSet
	                })


	                // Once we’re all set, check the theme in use.
	                IS_DEFAULT_THEME = isUsingDefaultTheme( P.$holder[0] )


	                // If the element has autofocus, open the picker.
	                if ( ELEMENT.autofocus ) {
	                    P.open()
	                }


	                // Trigger queued the “start” and “render” events.
	                return P.trigger( 'start' ).trigger( 'render' )
	            }, //start


	            /**
	             * Render a new picker
	             */
	            render: function( entireComponent ) {

	                // Insert a new component holder in the root or box.
	                if ( entireComponent ) {
	                    P.$holder = $( createWrappedComponent() )
	                    prepareElementHolder()
	                    P.$root.html( P.$holder )
	                }
	                else P.$root.find( '.' + CLASSES.box ).html( P.component.nodes( STATE.open ) )

	                // Trigger the queued “render” events.
	                return P.trigger( 'render' )
	            }, //render


	            /**
	             * Destroy everything
	             */
	            stop: function() {

	                // If it’s already stopped, do nothing.
	                if ( !STATE.start ) return P

	                // Then close the picker.
	                P.close()

	                // Remove the hidden field.
	                if ( P._hidden ) {
	                    P._hidden.parentNode.removeChild( P._hidden )
	                }

	                // Remove the root.
	                P.$root.remove()

	                // Remove the input class, remove the stored data, and unbind
	                // the events (after a tick for IE - see `P.close`).
	                $ELEMENT.removeClass( CLASSES.input ).removeData( NAME )
	                setTimeout( function() {
	                    $ELEMENT.off( '.' + STATE.id )
	                }, 0)

	                // Restore the element state
	                ELEMENT.type = STATE.type
	                ELEMENT.readOnly = false

	                // Trigger the queued “stop” events.
	                P.trigger( 'stop' )

	                // Reset the picker states.
	                STATE.methods = {}
	                STATE.start = false

	                return P
	            }, //stop


	            /**
	             * Open up the picker
	             */
	            open: function( dontGiveFocus ) {

	                // If it’s already open, do nothing.
	                if ( STATE.open ) return P

	                // Add the “active” class.
	                $ELEMENT.addClass( CLASSES.active )
	                aria( ELEMENT, 'expanded', true )

	                // * A Firefox bug, when `html` has `overflow:hidden`, results in
	                //   killing transitions :(. So add the “opened” state on the next tick.
	                //   Bug: https://bugzilla.mozilla.org/show_bug.cgi?id=625289
	                setTimeout( function() {

	                    // Add the “opened” class to the picker root.
	                    P.$root.addClass( CLASSES.opened )
	                    aria( P.$root[0], 'hidden', false )

	                }, 0 )

	                // If we have to give focus, bind the element and doc events.
	                if ( dontGiveFocus !== false ) {

	                    // Set it as open.
	                    STATE.open = true

	                    // Prevent the page from scrolling.
	                    if ( IS_DEFAULT_THEME ) {
	                        $html.
	                            css( 'overflow', 'hidden' ).
	                            css( 'padding-right', '+=' + getScrollbarWidth() )
	                    }

	                    // Pass focus to the root element’s jQuery object.
	                    focusPickerOnceOpened()

	                    // Bind the document events.
	                    $document.on( 'click.' + STATE.id + ' focusin.' + STATE.id, function( event ) {

	                        var target = event.target

	                        // If the target of the event is not the element, close the picker picker.
	                        // * Don’t worry about clicks or focusins on the root because those don’t bubble up.
	                        //   Also, for Firefox, a click on an `option` element bubbles up directly
	                        //   to the doc. So make sure the target wasn't the doc.
	                        // * In Firefox stopPropagation() doesn’t prevent right-click events from bubbling,
	                        //   which causes the picker to unexpectedly close when right-clicking it. So make
	                        //   sure the event wasn’t a right-click.
	                        if ( target != ELEMENT && target != document && event.which != 3 ) {

	                            // If the target was the holder that covers the screen,
	                            // keep the element focused to maintain tabindex.
	                            P.close( target === P.$holder[0] )
	                        }

	                    }).on( 'keydown.' + STATE.id, function( event ) {

	                        var
	                            // Get the keycode.
	                            keycode = event.keyCode,

	                            // Translate that to a selection change.
	                            keycodeToMove = P.component.key[ keycode ],

	                            // Grab the target.
	                            target = event.target


	                        // On escape, close the picker and give focus.
	                        if ( keycode == 27 ) {
	                            P.close( true )
	                        }


	                        // Check if there is a key movement or “enter” keypress on the element.
	                        else if ( target == P.$holder[0] && ( keycodeToMove || keycode == 13 ) ) {

	                            // Prevent the default action to stop page movement.
	                            event.preventDefault()

	                            // Trigger the key movement action.
	                            if ( keycodeToMove ) {
	                                PickerConstructor._.trigger( P.component.key.go, P, [ PickerConstructor._.trigger( keycodeToMove ) ] )
	                            }

	                            // On “enter”, if the highlighted item isn’t disabled, set the value and close.
	                            else if ( !P.$root.find( '.' + CLASSES.highlighted ).hasClass( CLASSES.disabled ) ) {
	                                P.set( 'select', P.component.item.highlight )
	                                if ( SETTINGS.closeOnSelect ) {
	                                    P.close( true )
	                                }
	                            }
	                        }


	                        // If the target is within the root and “enter” is pressed,
	                        // prevent the default action and trigger a click on the target instead.
	                        else if ( $.contains( P.$root[0], target ) && keycode == 13 ) {
	                            event.preventDefault()
	                            target.click()
	                        }
	                    })
	                }

	                // Trigger the queued “open” events.
	                return P.trigger( 'open' )
	            }, //open


	            /**
	             * Close the picker
	             */
	            close: function( giveFocus ) {

	                // If we need to give focus, do it before changing states.
	                if ( giveFocus ) {
	                    if ( SETTINGS.editable ) {
	                        ELEMENT.focus()
	                    }
	                    else {
	                        // ....ah yes! It would’ve been incomplete without a crazy workaround for IE :|
	                        // The focus is triggered *after* the close has completed - causing it
	                        // to open again. So unbind and rebind the event at the next tick.
	                        P.$holder.off( 'focus.toOpen' ).focus()
	                        setTimeout( function() {
	                            P.$holder.on( 'focus.toOpen', handleFocusToOpenEvent )
	                        }, 0 )
	                    }
	                }

	                // Remove the “active” class.
	                $ELEMENT.removeClass( CLASSES.active )
	                aria( ELEMENT, 'expanded', false )

	                // * A Firefox bug, when `html` has `overflow:hidden`, results in
	                //   killing transitions :(. So remove the “opened” state on the next tick.
	                //   Bug: https://bugzilla.mozilla.org/show_bug.cgi?id=625289
	                setTimeout( function() {

	                    // Remove the “opened” and “focused” class from the picker root.
	                    P.$root.removeClass( CLASSES.opened + ' ' + CLASSES.focused )
	                    aria( P.$root[0], 'hidden', true )

	                }, 0 )

	                // If it’s already closed, do nothing more.
	                if ( !STATE.open ) return P

	                // Set it as closed.
	                STATE.open = false

	                // Allow the page to scroll.
	                if ( IS_DEFAULT_THEME ) {
	                    $html.
	                        css( 'overflow', '' ).
	                        css( 'padding-right', '-=' + getScrollbarWidth() )
	                }

	                // Unbind the document events.
	                $document.off( '.' + STATE.id )

	                // Trigger the queued “close” events.
	                return P.trigger( 'close' )
	            }, //close


	            /**
	             * Clear the values
	             */
	            clear: function( options ) {
	                return P.set( 'clear', null, options )
	            }, //clear


	            /**
	             * Set something
	             */
	            set: function( thing, value, options ) {

	                var thingItem, thingValue,
	                    thingIsObject = $.isPlainObject( thing ),
	                    thingObject = thingIsObject ? thing : {}

	                // Make sure we have usable options.
	                options = thingIsObject && $.isPlainObject( value ) ? value : options || {}

	                if ( thing ) {

	                    // If the thing isn’t an object, make it one.
	                    if ( !thingIsObject ) {
	                        thingObject[ thing ] = value
	                    }

	                    // Go through the things of items to set.
	                    for ( thingItem in thingObject ) {

	                        // Grab the value of the thing.
	                        thingValue = thingObject[ thingItem ]

	                        // First, if the item exists and there’s a value, set it.
	                        if ( thingItem in P.component.item ) {
	                            if ( thingValue === undefined ) thingValue = null
	                            P.component.set( thingItem, thingValue, options )
	                        }

	                        // Then, check to update the element value and broadcast a change.
	                        if ( thingItem == 'select' || thingItem == 'clear' ) {
	                            $ELEMENT.
	                                val( thingItem == 'clear' ? '' : P.get( thingItem, SETTINGS.format ) ).
	                                trigger( 'change' )
	                        }
	                    }

	                    // Render a new picker.
	                    P.render()
	                }

	                // When the method isn’t muted, trigger queued “set” events and pass the `thingObject`.
	                return options.muted ? P : P.trigger( 'set', thingObject )
	            }, //set


	            /**
	             * Get something
	             */
	            get: function( thing, format ) {

	                // Make sure there’s something to get.
	                thing = thing || 'value'

	                // If a picker state exists, return that.
	                if ( STATE[ thing ] != null ) {
	                    return STATE[ thing ]
	                }

	                // Return the submission value, if that.
	                if ( thing == 'valueSubmit' ) {
	                    if ( P._hidden ) {
	                        return P._hidden.value
	                    }
	                    thing = 'value'
	                }

	                // Return the value, if that.
	                if ( thing == 'value' ) {
	                    return ELEMENT.value
	                }

	                // Check if a component item exists, return that.
	                if ( thing in P.component.item ) {
	                    if ( typeof format == 'string' ) {
	                        var thingValue = P.component.get( thing )
	                        return thingValue ?
	                            PickerConstructor._.trigger(
	                                P.component.formats.toString,
	                                P.component,
	                                [ format, thingValue ]
	                            ) : ''
	                    }
	                    return P.component.get( thing )
	                }
	            }, //get



	            /**
	             * Bind events on the things.
	             */
	            on: function( thing, method, internal ) {

	                var thingName, thingMethod,
	                    thingIsObject = $.isPlainObject( thing ),
	                    thingObject = thingIsObject ? thing : {}

	                if ( thing ) {

	                    // If the thing isn’t an object, make it one.
	                    if ( !thingIsObject ) {
	                        thingObject[ thing ] = method
	                    }

	                    // Go through the things to bind to.
	                    for ( thingName in thingObject ) {

	                        // Grab the method of the thing.
	                        thingMethod = thingObject[ thingName ]

	                        // If it was an internal binding, prefix it.
	                        if ( internal ) {
	                            thingName = '_' + thingName
	                        }

	                        // Make sure the thing methods collection exists.
	                        STATE.methods[ thingName ] = STATE.methods[ thingName ] || []

	                        // Add the method to the relative method collection.
	                        STATE.methods[ thingName ].push( thingMethod )
	                    }
	                }

	                return P
	            }, //on



	            /**
	             * Unbind events on the things.
	             */
	            off: function() {
	                var i, thingName,
	                    names = arguments;
	                for ( i = 0, namesCount = names.length; i < namesCount; i += 1 ) {
	                    thingName = names[i]
	                    if ( thingName in STATE.methods ) {
	                        delete STATE.methods[thingName]
	                    }
	                }
	                return P
	            },


	            /**
	             * Fire off method events.
	             */
	            trigger: function( name, data ) {
	                var _trigger = function( name ) {
	                    var methodList = STATE.methods[ name ]
	                    if ( methodList ) {
	                        methodList.map( function( method ) {
	                            PickerConstructor._.trigger( method, P, [ data ] )
	                        })
	                    }
	                }
	                _trigger( '_' + name )
	                _trigger( name )
	                return P
	            } //trigger
	        } //PickerInstance.prototype


	    /**
	     * Wrap the picker holder components together.
	     */
	    function createWrappedComponent() {

	        // Create a picker wrapper holder
	        return PickerConstructor._.node( 'div',

	            // Create a picker wrapper node
	            PickerConstructor._.node( 'div',

	                // Create a picker frame
	                PickerConstructor._.node( 'div',

	                    // Create a picker box node
	                    PickerConstructor._.node( 'div',

	                        // Create the components nodes.
	                        P.component.nodes( STATE.open ),

	                        // The picker box class
	                        CLASSES.box
	                    ),

	                    // Picker wrap class
	                    CLASSES.wrap
	                ),

	                // Picker frame class
	                CLASSES.frame
	            ),

	            // Picker holder class
	            CLASSES.holder,

	            'tabindex="-1"'
	        ) //endreturn
	    } //createWrappedComponent



	    /**
	     * Prepare the input element with all bindings.
	     */
	    function prepareElement() {

	        $ELEMENT.

	            // Store the picker data by component name.
	            data(NAME, P).

	            // Add the “input” class name.
	            addClass(CLASSES.input).

	            // If there’s a `data-value`, update the value of the element.
	            val( $ELEMENT.data('value') ?
	                P.get('select', SETTINGS.format) :
	                ELEMENT.value
	            )


	        // Only bind keydown events if the element isn’t editable.
	        if ( !SETTINGS.editable ) {

	            $ELEMENT.

	                // On focus/click, open the picker.
	                on( 'focus.' + STATE.id + ' click.' + STATE.id, function(event) {
	                    event.preventDefault()
	                    P.open()
	                }).

	                // Handle keyboard event based on the picker being opened or not.
	                on( 'keydown.' + STATE.id, handleKeydownEvent )
	        }


	        // Update the aria attributes.
	        aria(ELEMENT, {
	            haspopup: true,
	            expanded: false,
	            readonly: false,
	            owns: ELEMENT.id + '_root'
	        })
	    }


	    /**
	     * Prepare the root picker element with all bindings.
	     */
	    function prepareElementRoot() {
	        aria( P.$root[0], 'hidden', true )
	    }


	     /**
	      * Prepare the holder picker element with all bindings.
	      */
	    function prepareElementHolder() {

	        P.$holder.

	            on({

	                // For iOS8.
	                keydown: handleKeydownEvent,

	                'focus.toOpen': handleFocusToOpenEvent,

	                blur: function() {
	                    // Remove the “target” class.
	                    $ELEMENT.removeClass( CLASSES.target )
	                },

	                // When something within the holder is focused, stop from bubbling
	                // to the doc and remove the “focused” state from the root.
	                focusin: function( event ) {
	                    P.$root.removeClass( CLASSES.focused )
	                    event.stopPropagation()
	                },

	                // When something within the holder is clicked, stop it
	                // from bubbling to the doc.
	                'mousedown click': function( event ) {

	                    var target = event.target

	                    // Make sure the target isn’t the root holder so it can bubble up.
	                    if ( target != P.$holder[0] ) {

	                        event.stopPropagation()

	                        // * For mousedown events, cancel the default action in order to
	                        //   prevent cases where focus is shifted onto external elements
	                        //   when using things like jQuery mobile or MagnificPopup (ref: #249 & #120).
	                        //   Also, for Firefox, don’t prevent action on the `option` element.
	                        if ( event.type == 'mousedown' && !$( target ).is( 'input, select, textarea, button, option' )) {

	                            event.preventDefault()

	                            // Re-focus onto the holder so that users can click away
	                            // from elements focused within the picker.
	                            P.$holder[0].focus()
	                        }
	                    }
	                }

	            }).

	            // If there’s a click on an actionable element, carry out the actions.
	            on( 'click', '[data-pick], [data-nav], [data-clear], [data-close]', function() {

	                var $target = $( this ),
	                    targetData = $target.data(),
	                    targetDisabled = $target.hasClass( CLASSES.navDisabled ) || $target.hasClass( CLASSES.disabled ),

	                    // * For IE, non-focusable elements can be active elements as well
	                    //   (http://stackoverflow.com/a/2684561).
	                    activeElement = getActiveElement()
	                    activeElement = activeElement && ( activeElement.type || activeElement.href )

	                // If it’s disabled or nothing inside is actively focused, re-focus the element.
	                if ( targetDisabled || activeElement && !$.contains( P.$root[0], activeElement ) ) {
	                    P.$holder[0].focus()
	                }

	                // If something is superficially changed, update the `highlight` based on the `nav`.
	                if ( !targetDisabled && targetData.nav ) {
	                    P.set( 'highlight', P.component.item.highlight, { nav: targetData.nav } )
	                }

	                // If something is picked, set `select` then close with focus.
	                else if ( !targetDisabled && 'pick' in targetData ) {
	                    P.set( 'select', targetData.pick )
	                    if ( SETTINGS.closeOnSelect ) {
	                        P.close( true )
	                    }
	                }

	                // If a “clear” button is pressed, empty the values and close with focus.
	                else if ( targetData.clear ) {
	                    P.clear()
	                    if ( SETTINGS.closeOnClear ) {
	                        P.close( true )
	                    }
	                }

	                else if ( targetData.close ) {
	                    P.close( true )
	                }

	            }) //P.$holder

	    }


	     /**
	      * Prepare the hidden input element along with all bindings.
	      */
	    function prepareElementHidden() {

	        var name

	        if ( SETTINGS.hiddenName === true ) {
	            name = ELEMENT.name
	            ELEMENT.name = ''
	        }
	        else {
	            name = [
	                typeof SETTINGS.hiddenPrefix == 'string' ? SETTINGS.hiddenPrefix : '',
	                typeof SETTINGS.hiddenSuffix == 'string' ? SETTINGS.hiddenSuffix : '_submit'
	            ]
	            name = name[0] + ELEMENT.name + name[1]
	        }

	        P._hidden = $(
	            '<input ' +
	            'type=hidden ' +

	            // Create the name using the original input’s with a prefix and suffix.
	            'name="' + name + '"' +

	            // If the element has a value, set the hidden value as well.
	            (
	                $ELEMENT.data('value') || ELEMENT.value ?
	                    ' value="' + P.get('select', SETTINGS.formatSubmit) + '"' :
	                    ''
	            ) +
	            '>'
	        )[0]

	        $ELEMENT.

	            // If the value changes, update the hidden input with the correct format.
	            on('change.' + STATE.id, function() {
	                P._hidden.value = ELEMENT.value ?
	                    P.get('select', SETTINGS.formatSubmit) :
	                    ''
	            })
	    }


	    // Wait for transitions to end before focusing the holder. Otherwise, while
	    // using the `container` option, the view jumps to the container.
	    function focusPickerOnceOpened() {

	        if (IS_DEFAULT_THEME && supportsTransitions) {
	            P.$holder.find('.' + CLASSES.frame).one('transitionend', function() {
	                P.$holder[0].focus()
	            })
	        }
	        else {
	            P.$holder[0].focus()
	        }
	    }


	    function handleFocusToOpenEvent(event) {

	        // Stop the event from propagating to the doc.
	        event.stopPropagation()

	        // Add the “target” class.
	        $ELEMENT.addClass( CLASSES.target )

	        // Add the “focused” class to the root.
	        P.$root.addClass( CLASSES.focused )

	        // And then finally open the picker.
	        P.open()
	    }


	    // For iOS8.
	    function handleKeydownEvent( event ) {

	        var keycode = event.keyCode,

	            // Check if one of the delete keys was pressed.
	            isKeycodeDelete = /^(8|46)$/.test(keycode)

	        // For some reason IE clears the input value on “escape”.
	        if ( keycode == 27 ) {
	            P.close( true )
	            return false
	        }

	        // Check if `space` or `delete` was pressed or the picker is closed with a key movement.
	        if ( keycode == 32 || isKeycodeDelete || !STATE.open && P.component.key[keycode] ) {

	            // Prevent it from moving the page and bubbling to doc.
	            event.preventDefault()
	            event.stopPropagation()

	            // If `delete` was pressed, clear the values and close the picker.
	            // Otherwise open the picker.
	            if ( isKeycodeDelete ) { P.clear().close() }
	            else { P.open() }
	        }
	    }


	    // Return a new picker instance.
	    return new PickerInstance()
	} //PickerConstructor



	/**
	 * The default classes and prefix to use for the HTML classes.
	 */
	PickerConstructor.klasses = function( prefix ) {
	    prefix = prefix || 'picker'
	    return {

	        picker: prefix,
	        opened: prefix + '--opened',
	        focused: prefix + '--focused',

	        input: prefix + '__input',
	        active: prefix + '__input--active',
	        target: prefix + '__input--target',

	        holder: prefix + '__holder',

	        frame: prefix + '__frame',
	        wrap: prefix + '__wrap',

	        box: prefix + '__box'
	    }
	} //PickerConstructor.klasses



	/**
	 * Check if the default theme is being used.
	 */
	function isUsingDefaultTheme( element ) {

	    var theme,
	        prop = 'position'

	    // For IE.
	    if ( element.currentStyle ) {
	        theme = element.currentStyle[prop]
	    }

	    // For normal browsers.
	    else if ( window.getComputedStyle ) {
	        theme = getComputedStyle( element )[prop]
	    }

	    return theme == 'fixed'
	}



	/**
	 * Get the width of the browser’s scrollbar.
	 * Taken from: https://github.com/VodkaBears/Remodal/blob/master/src/jquery.remodal.js
	 */
	function getScrollbarWidth() {

	    if ( $html.height() <= $window.height() ) {
	        return 0
	    }

	    var $outer = $( '<div style="visibility:hidden;width:100px" />' ).
	        appendTo( 'body' )

	    // Get the width without scrollbars.
	    var widthWithoutScroll = $outer[0].offsetWidth

	    // Force adding scrollbars.
	    $outer.css( 'overflow', 'scroll' )

	    // Add the inner div.
	    var $inner = $( '<div style="width:100%" />' ).appendTo( $outer )

	    // Get the width with scrollbars.
	    var widthWithScroll = $inner[0].offsetWidth

	    // Remove the divs.
	    $outer.remove()

	    // Return the difference between the widths.
	    return widthWithoutScroll - widthWithScroll
	}



	/**
	 * PickerConstructor helper methods.
	 */
	PickerConstructor._ = {

	    /**
	     * Create a group of nodes. Expects:
	     * `
	        {
	            min:    {Integer},
	            max:    {Integer},
	            i:      {Integer},
	            node:   {String},
	            item:   {Function}
	        }
	     * `
	     */
	    group: function( groupObject ) {

	        var
	            // Scope for the looped object
	            loopObjectScope,

	            // Create the nodes list
	            nodesList = '',

	            // The counter starts from the `min`
	            counter = PickerConstructor._.trigger( groupObject.min, groupObject )


	        // Loop from the `min` to `max`, incrementing by `i`
	        for ( ; counter <= PickerConstructor._.trigger( groupObject.max, groupObject, [ counter ] ); counter += groupObject.i ) {

	            // Trigger the `item` function within scope of the object
	            loopObjectScope = PickerConstructor._.trigger( groupObject.item, groupObject, [ counter ] )

	            // Splice the subgroup and create nodes out of the sub nodes
	            nodesList += PickerConstructor._.node(
	                groupObject.node,
	                loopObjectScope[ 0 ],   // the node
	                loopObjectScope[ 1 ],   // the classes
	                loopObjectScope[ 2 ]    // the attributes
	            )
	        }

	        // Return the list of nodes
	        return nodesList
	    }, //group


	    /**
	     * Create a dom node string
	     */
	    node: function( wrapper, item, klass, attribute ) {

	        // If the item is false-y, just return an empty string
	        if ( !item ) return ''

	        // If the item is an array, do a join
	        item = $.isArray( item ) ? item.join( '' ) : item

	        // Check for the class
	        klass = klass ? ' class="' + klass + '"' : ''

	        // Check for any attributes
	        attribute = attribute ? ' ' + attribute : ''

	        // Return the wrapped item
	        return '<' + wrapper + klass + attribute + '>' + item + '</' + wrapper + '>'
	    }, //node


	    /**
	     * Lead numbers below 10 with a zero.
	     */
	    lead: function( number ) {
	        return ( number < 10 ? '0': '' ) + number
	    },


	    /**
	     * Trigger a function otherwise return the value.
	     */
	    trigger: function( callback, scope, args ) {
	        return typeof callback == 'function' ? callback.apply( scope, args || [] ) : callback
	    },


	    /**
	     * If the second character is a digit, length is 2 otherwise 1.
	     */
	    digits: function( string ) {
	        return ( /\d/ ).test( string[ 1 ] ) ? 2 : 1
	    },


	    /**
	     * Tell if something is a date object.
	     */
	    isDate: function( value ) {
	        return {}.toString.call( value ).indexOf( 'Date' ) > -1 && this.isInteger( value.getDate() )
	    },


	    /**
	     * Tell if something is an integer.
	     */
	    isInteger: function( value ) {
	        return {}.toString.call( value ).indexOf( 'Number' ) > -1 && value % 1 === 0
	    },


	    /**
	     * Create ARIA attribute strings.
	     */
	    ariaAttr: ariaAttr
	} //PickerConstructor._



	/**
	 * Extend the picker with a component and defaults.
	 */
	PickerConstructor.extend = function( name, Component ) {

	    // Extend jQuery.
	    $.fn[ name ] = function( options, action ) {

	        // Grab the component data.
	        var componentData = this.data( name )

	        // If the picker is requested, return the data object.
	        if ( options == 'picker' ) {
	            return componentData
	        }

	        // If the component data exists and `options` is a string, carry out the action.
	        if ( componentData && typeof options == 'string' ) {
	            return PickerConstructor._.trigger( componentData[ options ], componentData, [ action ] )
	        }

	        // Otherwise go through each matched element and if the component
	        // doesn’t exist, create a new picker using `this` element
	        // and merging the defaults and options with a deep copy.
	        return this.each( function() {
	            var $this = $( this )
	            if ( !$this.data( name ) ) {
	                new PickerConstructor( this, name, Component, options )
	            }
	        })
	    }

	    // Set the defaults.
	    $.fn[ name ].defaults = Component.defaults
	} //PickerConstructor.extend



	function aria(element, attribute, value) {
	    if ( $.isPlainObject(attribute) ) {
	        for ( var key in attribute ) {
	            ariaSet(element, key, attribute[key])
	        }
	    }
	    else {
	        ariaSet(element, attribute, value)
	    }
	}
	function ariaSet(element, attribute, value) {
	    element.setAttribute(
	        (attribute == 'role' ? '' : 'aria-') + attribute,
	        value
	    )
	}
	function ariaAttr(attribute, data) {
	    if ( !$.isPlainObject(attribute) ) {
	        attribute = { attribute: data }
	    }
	    data = ''
	    for ( var key in attribute ) {
	        var attr = (key == 'role' ? '' : 'aria-') + key,
	            attrVal = attribute[key]
	        data += attrVal == null ? '' : attr + '="' + attribute[key] + '"'
	    }
	    return data
	}

	// IE8 bug throws an error for activeElements within iframes.
	function getActiveElement() {
	    try {
	        return document.activeElement
	    } catch ( err ) { }
	}



	// Expose the picker constructor.
	return PickerConstructor


	}));





/***/ },

/***/ 11:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * Date picker for pickadate.js v3.5.6
	 * http://amsul.github.io/pickadate.js/date.htm
	 */

	(function ( factory ) {

	    // AMD.
	    if ( true )
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(10), __webpack_require__(6)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))

	    // Node.js/browserify.
	    else if ( typeof exports == 'object' )
	        module.exports = factory( require('./picker.js'), require('jquery') )

	    // Browser globals.
	    else factory( Picker, jQuery )

	}(function( Picker, $ ) {


	/**
	 * Globals and constants
	 */
	var DAYS_IN_WEEK = 7,
	    WEEKS_IN_CALENDAR = 6,
	    _ = Picker._



	/**
	 * The date picker constructor
	 */
	function DatePicker( picker, settings ) {

	    var calendar = this,
	        element = picker.$node[ 0 ],
	        elementValue = element.value,
	        elementDataValue = picker.$node.data( 'value' ),
	        valueString = elementDataValue || elementValue,
	        formatString = elementDataValue ? settings.formatSubmit : settings.format,
	        isRTL = function() {

	            return element.currentStyle ?

	                // For IE.
	                element.currentStyle.direction == 'rtl' :

	                // For normal browsers.
	                getComputedStyle( picker.$root[0] ).direction == 'rtl'
	        }

	    calendar.settings = settings
	    calendar.$node = picker.$node

	    // The queue of methods that will be used to build item objects.
	    calendar.queue = {
	        min: 'measure create',
	        max: 'measure create',
	        now: 'now create',
	        select: 'parse create validate',
	        highlight: 'parse navigate create validate',
	        view: 'parse create validate viewset',
	        disable: 'deactivate',
	        enable: 'activate'
	    }

	    // The component's item object.
	    calendar.item = {}

	    calendar.item.clear = null
	    calendar.item.disable = ( settings.disable || [] ).slice( 0 )
	    calendar.item.enable = -(function( collectionDisabled ) {
	        return collectionDisabled[ 0 ] === true ? collectionDisabled.shift() : -1
	    })( calendar.item.disable )

	    calendar.
	        set( 'min', settings.min ).
	        set( 'max', settings.max ).
	        set( 'now' )

	    // When there’s a value, set the `select`, which in turn
	    // also sets the `highlight` and `view`.
	    if ( valueString ) {
	        calendar.set( 'select', valueString, {
	            format: formatString,
	            defaultValue: true
	        })
	    }

	    // If there’s no value, default to highlighting “today”.
	    else {
	        calendar.
	            set( 'select', null ).
	            set( 'highlight', calendar.item.now )
	    }


	    // The keycode to movement mapping.
	    calendar.key = {
	        40: 7, // Down
	        38: -7, // Up
	        39: function() { return isRTL() ? -1 : 1 }, // Right
	        37: function() { return isRTL() ? 1 : -1 }, // Left
	        go: function( timeChange ) {
	            var highlightedObject = calendar.item.highlight,
	                targetDate = new Date( highlightedObject.year, highlightedObject.month, highlightedObject.date + timeChange )
	            calendar.set(
	                'highlight',
	                targetDate,
	                { interval: timeChange }
	            )
	            this.render()
	        }
	    }


	    // Bind some picker events.
	    picker.
	        on( 'render', function() {
	            picker.$root.find( '.' + settings.klass.selectMonth ).on( 'change', function() {
	                var value = this.value
	                if ( value ) {
	                    picker.set( 'highlight', [ picker.get( 'view' ).year, value, picker.get( 'highlight' ).date ] )
	                    picker.$root.find( '.' + settings.klass.selectMonth ).trigger( 'focus' )
	                }
	            })
	            picker.$root.find( '.' + settings.klass.selectYear ).on( 'change', function() {
	                var value = this.value
	                if ( value ) {
	                    picker.set( 'highlight', [ value, picker.get( 'view' ).month, picker.get( 'highlight' ).date ] )
	                    picker.$root.find( '.' + settings.klass.selectYear ).trigger( 'focus' )
	                }
	            })
	        }, 1 ).
	        on( 'open', function() {
	            var includeToday = ''
	            if ( calendar.disabled( calendar.get('now') ) ) {
	                includeToday = ':not(.' + settings.klass.buttonToday + ')'
	            }
	            picker.$root.find( 'button' + includeToday + ', select' ).attr( 'disabled', false )
	        }, 1 ).
	        on( 'close', function() {
	            picker.$root.find( 'button, select' ).attr( 'disabled', true )
	        }, 1 )

	} //DatePicker


	/**
	 * Set a datepicker item object.
	 */
	DatePicker.prototype.set = function( type, value, options ) {

	    var calendar = this,
	        calendarItem = calendar.item

	    // If the value is `null` just set it immediately.
	    if ( value === null ) {
	        if ( type == 'clear' ) type = 'select'
	        calendarItem[ type ] = value
	        return calendar
	    }

	    // Otherwise go through the queue of methods, and invoke the functions.
	    // Update this as the time unit, and set the final value as this item.
	    // * In the case of `enable`, keep the queue but set `disable` instead.
	    //   And in the case of `flip`, keep the queue but set `enable` instead.
	    calendarItem[ ( type == 'enable' ? 'disable' : type == 'flip' ? 'enable' : type ) ] = calendar.queue[ type ].split( ' ' ).map( function( method ) {
	        value = calendar[ method ]( type, value, options )
	        return value
	    }).pop()

	    // Check if we need to cascade through more updates.
	    if ( type == 'select' ) {
	        calendar.set( 'highlight', calendarItem.select, options )
	    }
	    else if ( type == 'highlight' ) {
	        calendar.set( 'view', calendarItem.highlight, options )
	    }
	    else if ( type.match( /^(flip|min|max|disable|enable)$/ ) ) {
	        if ( calendarItem.select && calendar.disabled( calendarItem.select ) ) {
	            calendar.set( 'select', calendarItem.select, options )
	        }
	        if ( calendarItem.highlight && calendar.disabled( calendarItem.highlight ) ) {
	            calendar.set( 'highlight', calendarItem.highlight, options )
	        }
	    }

	    return calendar
	} //DatePicker.prototype.set


	/**
	 * Get a datepicker item object.
	 */
	DatePicker.prototype.get = function( type ) {
	    return this.item[ type ]
	} //DatePicker.prototype.get


	/**
	 * Create a picker date object.
	 */
	DatePicker.prototype.create = function( type, value, options ) {

	    var isInfiniteValue,
	        calendar = this

	    // If there’s no value, use the type as the value.
	    value = value === undefined ? type : value


	    // If it’s infinity, update the value.
	    if ( value == -Infinity || value == Infinity ) {
	        isInfiniteValue = value
	    }

	    // If it’s an object, use the native date object.
	    else if ( $.isPlainObject( value ) && _.isInteger( value.pick ) ) {
	        value = value.obj
	    }

	    // If it’s an array, convert it into a date and make sure
	    // that it’s a valid date – otherwise default to today.
	    else if ( $.isArray( value ) ) {
	        value = new Date( value[ 0 ], value[ 1 ], value[ 2 ] )
	        value = _.isDate( value ) ? value : calendar.create().obj
	    }

	    // If it’s a number or date object, make a normalized date.
	    else if ( _.isInteger( value ) || _.isDate( value ) ) {
	        value = calendar.normalize( new Date( value ), options )
	    }

	    // If it’s a literal true or any other case, set it to now.
	    else /*if ( value === true )*/ {
	        value = calendar.now( type, value, options )
	    }

	    // Return the compiled object.
	    return {
	        year: isInfiniteValue || value.getFullYear(),
	        month: isInfiniteValue || value.getMonth(),
	        date: isInfiniteValue || value.getDate(),
	        day: isInfiniteValue || value.getDay(),
	        obj: isInfiniteValue || value,
	        pick: isInfiniteValue || value.getTime()
	    }
	} //DatePicker.prototype.create


	/**
	 * Create a range limit object using an array, date object,
	 * literal “true”, or integer relative to another time.
	 */
	DatePicker.prototype.createRange = function( from, to ) {

	    var calendar = this,
	        createDate = function( date ) {
	            if ( date === true || $.isArray( date ) || _.isDate( date ) ) {
	                return calendar.create( date )
	            }
	            return date
	        }

	    // Create objects if possible.
	    if ( !_.isInteger( from ) ) {
	        from = createDate( from )
	    }
	    if ( !_.isInteger( to ) ) {
	        to = createDate( to )
	    }

	    // Create relative dates.
	    if ( _.isInteger( from ) && $.isPlainObject( to ) ) {
	        from = [ to.year, to.month, to.date + from ];
	    }
	    else if ( _.isInteger( to ) && $.isPlainObject( from ) ) {
	        to = [ from.year, from.month, from.date + to ];
	    }

	    return {
	        from: createDate( from ),
	        to: createDate( to )
	    }
	} //DatePicker.prototype.createRange


	/**
	 * Check if a date unit falls within a date range object.
	 */
	DatePicker.prototype.withinRange = function( range, dateUnit ) {
	    range = this.createRange(range.from, range.to)
	    return dateUnit.pick >= range.from.pick && dateUnit.pick <= range.to.pick
	}


	/**
	 * Check if two date range objects overlap.
	 */
	DatePicker.prototype.overlapRanges = function( one, two ) {

	    var calendar = this

	    // Convert the ranges into comparable dates.
	    one = calendar.createRange( one.from, one.to )
	    two = calendar.createRange( two.from, two.to )

	    return calendar.withinRange( one, two.from ) || calendar.withinRange( one, two.to ) ||
	        calendar.withinRange( two, one.from ) || calendar.withinRange( two, one.to )
	}


	/**
	 * Get the date today.
	 */
	DatePicker.prototype.now = function( type, value, options ) {
	    value = new Date()
	    if ( options && options.rel ) {
	        value.setDate( value.getDate() + options.rel )
	    }
	    return this.normalize( value, options )
	}


	/**
	 * Navigate to next/prev month.
	 */
	DatePicker.prototype.navigate = function( type, value, options ) {

	    var targetDateObject,
	        targetYear,
	        targetMonth,
	        targetDate,
	        isTargetArray = $.isArray( value ),
	        isTargetObject = $.isPlainObject( value ),
	        viewsetObject = this.item.view/*,
	        safety = 100*/


	    if ( isTargetArray || isTargetObject ) {

	        if ( isTargetObject ) {
	            targetYear = value.year
	            targetMonth = value.month
	            targetDate = value.date
	        }
	        else {
	            targetYear = +value[0]
	            targetMonth = +value[1]
	            targetDate = +value[2]
	        }

	        // If we’re navigating months but the view is in a different
	        // month, navigate to the view’s year and month.
	        if ( options && options.nav && viewsetObject && viewsetObject.month !== targetMonth ) {
	            targetYear = viewsetObject.year
	            targetMonth = viewsetObject.month
	        }

	        // Figure out the expected target year and month.
	        targetDateObject = new Date( targetYear, targetMonth + ( options && options.nav ? options.nav : 0 ), 1 )
	        targetYear = targetDateObject.getFullYear()
	        targetMonth = targetDateObject.getMonth()

	        // If the month we’re going to doesn’t have enough days,
	        // keep decreasing the date until we reach the month’s last date.
	        while ( /*safety &&*/ new Date( targetYear, targetMonth, targetDate ).getMonth() !== targetMonth ) {
	            targetDate -= 1
	            /*safety -= 1
	            if ( !safety ) {
	                throw 'Fell into an infinite loop while navigating to ' + new Date( targetYear, targetMonth, targetDate ) + '.'
	            }*/
	        }

	        value = [ targetYear, targetMonth, targetDate ]
	    }

	    return value
	} //DatePicker.prototype.navigate


	/**
	 * Normalize a date by setting the hours to midnight.
	 */
	DatePicker.prototype.normalize = function( value/*, options*/ ) {
	    value.setHours( 0, 0, 0, 0 )
	    return value
	}


	/**
	 * Measure the range of dates.
	 */
	DatePicker.prototype.measure = function( type, value/*, options*/ ) {

	    var calendar = this

	    // If it’s anything false-y, remove the limits.
	    if ( !value ) {
	        value = type == 'min' ? -Infinity : Infinity
	    }

	    // If it’s a string, parse it.
	    else if ( typeof value == 'string' ) {
	        value = calendar.parse( type, value )
	    }

	    // If it's an integer, get a date relative to today.
	    else if ( _.isInteger( value ) ) {
	        value = calendar.now( type, value, { rel: value } )
	    }

	    return value
	} ///DatePicker.prototype.measure


	/**
	 * Create a viewset object based on navigation.
	 */
	DatePicker.prototype.viewset = function( type, dateObject/*, options*/ ) {
	    return this.create([ dateObject.year, dateObject.month, 1 ])
	}


	/**
	 * Validate a date as enabled and shift if needed.
	 */
	DatePicker.prototype.validate = function( type, dateObject, options ) {

	    var calendar = this,

	        // Keep a reference to the original date.
	        originalDateObject = dateObject,

	        // Make sure we have an interval.
	        interval = options && options.interval ? options.interval : 1,

	        // Check if the calendar enabled dates are inverted.
	        isFlippedBase = calendar.item.enable === -1,

	        // Check if we have any enabled dates after/before now.
	        hasEnabledBeforeTarget, hasEnabledAfterTarget,

	        // The min & max limits.
	        minLimitObject = calendar.item.min,
	        maxLimitObject = calendar.item.max,

	        // Check if we’ve reached the limit during shifting.
	        reachedMin, reachedMax,

	        // Check if the calendar is inverted and at least one weekday is enabled.
	        hasEnabledWeekdays = isFlippedBase && calendar.item.disable.filter( function( value ) {

	            // If there’s a date, check where it is relative to the target.
	            if ( $.isArray( value ) ) {
	                var dateTime = calendar.create( value ).pick
	                if ( dateTime < dateObject.pick ) hasEnabledBeforeTarget = true
	                else if ( dateTime > dateObject.pick ) hasEnabledAfterTarget = true
	            }

	            // Return only integers for enabled weekdays.
	            return _.isInteger( value )
	        }).length/*,

	        safety = 100*/



	    // Cases to validate for:
	    // [1] Not inverted and date disabled.
	    // [2] Inverted and some dates enabled.
	    // [3] Not inverted and out of range.
	    //
	    // Cases to **not** validate for:
	    // • Navigating months.
	    // • Not inverted and date enabled.
	    // • Inverted and all dates disabled.
	    // • ..and anything else.
	    if ( !options || (!options.nav && !options.defaultValue) ) if (
	        /* 1 */ ( !isFlippedBase && calendar.disabled( dateObject ) ) ||
	        /* 2 */ ( isFlippedBase && calendar.disabled( dateObject ) && ( hasEnabledWeekdays || hasEnabledBeforeTarget || hasEnabledAfterTarget ) ) ||
	        /* 3 */ ( !isFlippedBase && (dateObject.pick <= minLimitObject.pick || dateObject.pick >= maxLimitObject.pick) )
	    ) {


	        // When inverted, flip the direction if there aren’t any enabled weekdays
	        // and there are no enabled dates in the direction of the interval.
	        if ( isFlippedBase && !hasEnabledWeekdays && ( ( !hasEnabledAfterTarget && interval > 0 ) || ( !hasEnabledBeforeTarget && interval < 0 ) ) ) {
	            interval *= -1
	        }


	        // Keep looping until we reach an enabled date.
	        while ( /*safety &&*/ calendar.disabled( dateObject ) ) {

	            /*safety -= 1
	            if ( !safety ) {
	                throw 'Fell into an infinite loop while validating ' + dateObject.obj + '.'
	            }*/


	            // If we’ve looped into the next/prev month with a large interval, return to the original date and flatten the interval.
	            if ( Math.abs( interval ) > 1 && ( dateObject.month < originalDateObject.month || dateObject.month > originalDateObject.month ) ) {
	                dateObject = originalDateObject
	                interval = interval > 0 ? 1 : -1
	            }


	            // If we’ve reached the min/max limit, reverse the direction, flatten the interval and set it to the limit.
	            if ( dateObject.pick <= minLimitObject.pick ) {
	                reachedMin = true
	                interval = 1
	                dateObject = calendar.create([
	                    minLimitObject.year,
	                    minLimitObject.month,
	                    minLimitObject.date + (dateObject.pick === minLimitObject.pick ? 0 : -1)
	                ])
	            }
	            else if ( dateObject.pick >= maxLimitObject.pick ) {
	                reachedMax = true
	                interval = -1
	                dateObject = calendar.create([
	                    maxLimitObject.year,
	                    maxLimitObject.month,
	                    maxLimitObject.date + (dateObject.pick === maxLimitObject.pick ? 0 : 1)
	                ])
	            }


	            // If we’ve reached both limits, just break out of the loop.
	            if ( reachedMin && reachedMax ) {
	                break
	            }


	            // Finally, create the shifted date using the interval and keep looping.
	            dateObject = calendar.create([ dateObject.year, dateObject.month, dateObject.date + interval ])
	        }

	    } //endif


	    // Return the date object settled on.
	    return dateObject
	} //DatePicker.prototype.validate


	/**
	 * Check if a date is disabled.
	 */
	DatePicker.prototype.disabled = function( dateToVerify ) {

	    var
	        calendar = this,

	        // Filter through the disabled dates to check if this is one.
	        isDisabledMatch = calendar.item.disable.filter( function( dateToDisable ) {

	            // If the date is a number, match the weekday with 0index and `firstDay` check.
	            if ( _.isInteger( dateToDisable ) ) {
	                return dateToVerify.day === ( calendar.settings.firstDay ? dateToDisable : dateToDisable - 1 ) % 7
	            }

	            // If it’s an array or a native JS date, create and match the exact date.
	            if ( $.isArray( dateToDisable ) || _.isDate( dateToDisable ) ) {
	                return dateToVerify.pick === calendar.create( dateToDisable ).pick
	            }

	            // If it’s an object, match a date within the “from” and “to” range.
	            if ( $.isPlainObject( dateToDisable ) ) {
	                return calendar.withinRange( dateToDisable, dateToVerify )
	            }
	        })

	    // If this date matches a disabled date, confirm it’s not inverted.
	    isDisabledMatch = isDisabledMatch.length && !isDisabledMatch.filter(function( dateToDisable ) {
	        return $.isArray( dateToDisable ) && dateToDisable[3] == 'inverted' ||
	            $.isPlainObject( dateToDisable ) && dateToDisable.inverted
	    }).length

	    // Check the calendar “enabled” flag and respectively flip the
	    // disabled state. Then also check if it’s beyond the min/max limits.
	    return calendar.item.enable === -1 ? !isDisabledMatch : isDisabledMatch ||
	        dateToVerify.pick < calendar.item.min.pick ||
	        dateToVerify.pick > calendar.item.max.pick

	} //DatePicker.prototype.disabled


	/**
	 * Parse a string into a usable type.
	 */
	DatePicker.prototype.parse = function( type, value, options ) {

	    var calendar = this,
	        parsingObject = {}

	    // If it’s already parsed, we’re good.
	    if ( !value || typeof value != 'string' ) {
	        return value
	    }

	    // We need a `.format` to parse the value with.
	    if ( !( options && options.format ) ) {
	        options = options || {}
	        options.format = calendar.settings.format
	    }

	    // Convert the format into an array and then map through it.
	    calendar.formats.toArray( options.format ).map( function( label ) {

	        var
	            // Grab the formatting label.
	            formattingLabel = calendar.formats[ label ],

	            // The format length is from the formatting label function or the
	            // label length without the escaping exclamation (!) mark.
	            formatLength = formattingLabel ? _.trigger( formattingLabel, calendar, [ value, parsingObject ] ) : label.replace( /^!/, '' ).length

	        // If there's a format label, split the value up to the format length.
	        // Then add it to the parsing object with appropriate label.
	        if ( formattingLabel ) {
	            parsingObject[ label ] = value.substr( 0, formatLength )
	        }

	        // Update the value as the substring from format length to end.
	        value = value.substr( formatLength )
	    })

	    // Compensate for month 0index.
	    return [
	        parsingObject.yyyy || parsingObject.yy,
	        +( parsingObject.mm || parsingObject.m ) - 1,
	        parsingObject.dd || parsingObject.d
	    ]
	} //DatePicker.prototype.parse


	/**
	 * Various formats to display the object in.
	 */
	DatePicker.prototype.formats = (function() {

	    // Return the length of the first word in a collection.
	    function getWordLengthFromCollection( string, collection, dateObject ) {

	        // Grab the first word from the string.
	        // Regex pattern from http://stackoverflow.com/q/150033
	        var word = string.match( /[^\x00-\x7F]+|\w+/ )[ 0 ]

	        // If there's no month index, add it to the date object
	        if ( !dateObject.mm && !dateObject.m ) {
	            dateObject.m = collection.indexOf( word ) + 1
	        }

	        // Return the length of the word.
	        return word.length
	    }

	    // Get the length of the first word in a string.
	    function getFirstWordLength( string ) {
	        return string.match( /\w+/ )[ 0 ].length
	    }

	    return {

	        d: function( string, dateObject ) {

	            // If there's string, then get the digits length.
	            // Otherwise return the selected date.
	            return string ? _.digits( string ) : dateObject.date
	        },
	        dd: function( string, dateObject ) {

	            // If there's a string, then the length is always 2.
	            // Otherwise return the selected date with a leading zero.
	            return string ? 2 : _.lead( dateObject.date )
	        },
	        ddd: function( string, dateObject ) {

	            // If there's a string, then get the length of the first word.
	            // Otherwise return the short selected weekday.
	            return string ? getFirstWordLength( string ) : this.settings.weekdaysShort[ dateObject.day ]
	        },
	        dddd: function( string, dateObject ) {

	            // If there's a string, then get the length of the first word.
	            // Otherwise return the full selected weekday.
	            return string ? getFirstWordLength( string ) : this.settings.weekdaysFull[ dateObject.day ]
	        },
	        m: function( string, dateObject ) {

	            // If there's a string, then get the length of the digits
	            // Otherwise return the selected month with 0index compensation.
	            return string ? _.digits( string ) : dateObject.month + 1
	        },
	        mm: function( string, dateObject ) {

	            // If there's a string, then the length is always 2.
	            // Otherwise return the selected month with 0index and leading zero.
	            return string ? 2 : _.lead( dateObject.month + 1 )
	        },
	        mmm: function( string, dateObject ) {

	            var collection = this.settings.monthsShort

	            // If there's a string, get length of the relevant month from the short
	            // months collection. Otherwise return the selected month from that collection.
	            return string ? getWordLengthFromCollection( string, collection, dateObject ) : collection[ dateObject.month ]
	        },
	        mmmm: function( string, dateObject ) {

	            var collection = this.settings.monthsFull

	            // If there's a string, get length of the relevant month from the full
	            // months collection. Otherwise return the selected month from that collection.
	            return string ? getWordLengthFromCollection( string, collection, dateObject ) : collection[ dateObject.month ]
	        },
	        yy: function( string, dateObject ) {

	            // If there's a string, then the length is always 2.
	            // Otherwise return the selected year by slicing out the first 2 digits.
	            return string ? 2 : ( '' + dateObject.year ).slice( 2 )
	        },
	        yyyy: function( string, dateObject ) {

	            // If there's a string, then the length is always 4.
	            // Otherwise return the selected year.
	            return string ? 4 : dateObject.year
	        },

	        // Create an array by splitting the formatting string passed.
	        toArray: function( formatString ) { return formatString.split( /(d{1,4}|m{1,4}|y{4}|yy|!.)/g ) },

	        // Format an object into a string using the formatting options.
	        toString: function ( formatString, itemObject ) {
	            var calendar = this
	            return calendar.formats.toArray( formatString ).map( function( label ) {
	                return _.trigger( calendar.formats[ label ], calendar, [ 0, itemObject ] ) || label.replace( /^!/, '' )
	            }).join( '' )
	        }
	    }
	})() //DatePicker.prototype.formats




	/**
	 * Check if two date units are the exact.
	 */
	DatePicker.prototype.isDateExact = function( one, two ) {

	    var calendar = this

	    // When we’re working with weekdays, do a direct comparison.
	    if (
	        ( _.isInteger( one ) && _.isInteger( two ) ) ||
	        ( typeof one == 'boolean' && typeof two == 'boolean' )
	     ) {
	        return one === two
	    }

	    // When we’re working with date representations, compare the “pick” value.
	    if (
	        ( _.isDate( one ) || $.isArray( one ) ) &&
	        ( _.isDate( two ) || $.isArray( two ) )
	    ) {
	        return calendar.create( one ).pick === calendar.create( two ).pick
	    }

	    // When we’re working with range objects, compare the “from” and “to”.
	    if ( $.isPlainObject( one ) && $.isPlainObject( two ) ) {
	        return calendar.isDateExact( one.from, two.from ) && calendar.isDateExact( one.to, two.to )
	    }

	    return false
	}


	/**
	 * Check if two date units overlap.
	 */
	DatePicker.prototype.isDateOverlap = function( one, two ) {

	    var calendar = this,
	        firstDay = calendar.settings.firstDay ? 1 : 0

	    // When we’re working with a weekday index, compare the days.
	    if ( _.isInteger( one ) && ( _.isDate( two ) || $.isArray( two ) ) ) {
	        one = one % 7 + firstDay
	        return one === calendar.create( two ).day + 1
	    }
	    if ( _.isInteger( two ) && ( _.isDate( one ) || $.isArray( one ) ) ) {
	        two = two % 7 + firstDay
	        return two === calendar.create( one ).day + 1
	    }

	    // When we’re working with range objects, check if the ranges overlap.
	    if ( $.isPlainObject( one ) && $.isPlainObject( two ) ) {
	        return calendar.overlapRanges( one, two )
	    }

	    return false
	}


	/**
	 * Flip the “enabled” state.
	 */
	DatePicker.prototype.flipEnable = function(val) {
	    var itemObject = this.item
	    itemObject.enable = val || (itemObject.enable == -1 ? 1 : -1)
	}


	/**
	 * Mark a collection of dates as “disabled”.
	 */
	DatePicker.prototype.deactivate = function( type, datesToDisable ) {

	    var calendar = this,
	        disabledItems = calendar.item.disable.slice(0)


	    // If we’re flipping, that’s all we need to do.
	    if ( datesToDisable == 'flip' ) {
	        calendar.flipEnable()
	    }

	    else if ( datesToDisable === false ) {
	        calendar.flipEnable(1)
	        disabledItems = []
	    }

	    else if ( datesToDisable === true ) {
	        calendar.flipEnable(-1)
	        disabledItems = []
	    }

	    // Otherwise go through the dates to disable.
	    else {

	        datesToDisable.map(function( unitToDisable ) {

	            var matchFound

	            // When we have disabled items, check for matches.
	            // If something is matched, immediately break out.
	            for ( var index = 0; index < disabledItems.length; index += 1 ) {
	                if ( calendar.isDateExact( unitToDisable, disabledItems[index] ) ) {
	                    matchFound = true
	                    break
	                }
	            }

	            // If nothing was found, add the validated unit to the collection.
	            if ( !matchFound ) {
	                if (
	                    _.isInteger( unitToDisable ) ||
	                    _.isDate( unitToDisable ) ||
	                    $.isArray( unitToDisable ) ||
	                    ( $.isPlainObject( unitToDisable ) && unitToDisable.from && unitToDisable.to )
	                ) {
	                    disabledItems.push( unitToDisable )
	                }
	            }
	        })
	    }

	    // Return the updated collection.
	    return disabledItems
	} //DatePicker.prototype.deactivate


	/**
	 * Mark a collection of dates as “enabled”.
	 */
	DatePicker.prototype.activate = function( type, datesToEnable ) {

	    var calendar = this,
	        disabledItems = calendar.item.disable,
	        disabledItemsCount = disabledItems.length

	    // If we’re flipping, that’s all we need to do.
	    if ( datesToEnable == 'flip' ) {
	        calendar.flipEnable()
	    }

	    else if ( datesToEnable === true ) {
	        calendar.flipEnable(1)
	        disabledItems = []
	    }

	    else if ( datesToEnable === false ) {
	        calendar.flipEnable(-1)
	        disabledItems = []
	    }

	    // Otherwise go through the disabled dates.
	    else {

	        datesToEnable.map(function( unitToEnable ) {

	            var matchFound,
	                disabledUnit,
	                index,
	                isExactRange

	            // Go through the disabled items and try to find a match.
	            for ( index = 0; index < disabledItemsCount; index += 1 ) {

	                disabledUnit = disabledItems[index]

	                // When an exact match is found, remove it from the collection.
	                if ( calendar.isDateExact( disabledUnit, unitToEnable ) ) {
	                    matchFound = disabledItems[index] = null
	                    isExactRange = true
	                    break
	                }

	                // When an overlapped match is found, add the “inverted” state to it.
	                else if ( calendar.isDateOverlap( disabledUnit, unitToEnable ) ) {
	                    if ( $.isPlainObject( unitToEnable ) ) {
	                        unitToEnable.inverted = true
	                        matchFound = unitToEnable
	                    }
	                    else if ( $.isArray( unitToEnable ) ) {
	                        matchFound = unitToEnable
	                        if ( !matchFound[3] ) matchFound.push( 'inverted' )
	                    }
	                    else if ( _.isDate( unitToEnable ) ) {
	                        matchFound = [ unitToEnable.getFullYear(), unitToEnable.getMonth(), unitToEnable.getDate(), 'inverted' ]
	                    }
	                    break
	                }
	            }

	            // If a match was found, remove a previous duplicate entry.
	            if ( matchFound ) for ( index = 0; index < disabledItemsCount; index += 1 ) {
	                if ( calendar.isDateExact( disabledItems[index], unitToEnable ) ) {
	                    disabledItems[index] = null
	                    break
	                }
	            }

	            // In the event that we’re dealing with an exact range of dates,
	            // make sure there are no “inverted” dates because of it.
	            if ( isExactRange ) for ( index = 0; index < disabledItemsCount; index += 1 ) {
	                if ( calendar.isDateOverlap( disabledItems[index], unitToEnable ) ) {
	                    disabledItems[index] = null
	                    break
	                }
	            }

	            // If something is still matched, add it into the collection.
	            if ( matchFound ) {
	                disabledItems.push( matchFound )
	            }
	        })
	    }

	    // Return the updated collection.
	    return disabledItems.filter(function( val ) { return val != null })
	} //DatePicker.prototype.activate


	/**
	 * Create a string for the nodes in the picker.
	 */
	DatePicker.prototype.nodes = function( isOpen ) {

	    var
	        calendar = this,
	        settings = calendar.settings,
	        calendarItem = calendar.item,
	        nowObject = calendarItem.now,
	        selectedObject = calendarItem.select,
	        highlightedObject = calendarItem.highlight,
	        viewsetObject = calendarItem.view,
	        disabledCollection = calendarItem.disable,
	        minLimitObject = calendarItem.min,
	        maxLimitObject = calendarItem.max,


	        // Create the calendar table head using a copy of weekday labels collection.
	        // * We do a copy so we don't mutate the original array.
	        tableHead = (function( collection, fullCollection ) {

	            // If the first day should be Monday, move Sunday to the end.
	            if ( settings.firstDay ) {
	                collection.push( collection.shift() )
	                fullCollection.push( fullCollection.shift() )
	            }

	            // Create and return the table head group.
	            return _.node(
	                'thead',
	                _.node(
	                    'tr',
	                    _.group({
	                        min: 0,
	                        max: DAYS_IN_WEEK - 1,
	                        i: 1,
	                        node: 'th',
	                        item: function( counter ) {
	                            return [
	                                collection[ counter ],
	                                settings.klass.weekdays,
	                                'scope=col title="' + fullCollection[ counter ] + '"'
	                            ]
	                        }
	                    })
	                )
	            ) //endreturn
	        })( ( settings.showWeekdaysFull ? settings.weekdaysFull : settings.weekdaysShort ).slice( 0 ), settings.weekdaysFull.slice( 0 ) ), //tableHead


	        // Create the nav for next/prev month.
	        createMonthNav = function( next ) {

	            // Otherwise, return the created month tag.
	            return _.node(
	                'div',
	                ' ',
	                settings.klass[ 'nav' + ( next ? 'Next' : 'Prev' ) ] + (

	                    // If the focused month is outside the range, disabled the button.
	                    ( next && viewsetObject.year >= maxLimitObject.year && viewsetObject.month >= maxLimitObject.month ) ||
	                    ( !next && viewsetObject.year <= minLimitObject.year && viewsetObject.month <= minLimitObject.month ) ?
	                    ' ' + settings.klass.navDisabled : ''
	                ),
	                'data-nav=' + ( next || -1 ) + ' ' +
	                _.ariaAttr({
	                    role: 'button',
	                    controls: calendar.$node[0].id + '_table'
	                }) + ' ' +
	                'title="' + (next ? settings.labelMonthNext : settings.labelMonthPrev ) + '"'
	            ) //endreturn
	        }, //createMonthNav


	        // Create the month label.
	        createMonthLabel = function() {

	            var monthsCollection = settings.showMonthsShort ? settings.monthsShort : settings.monthsFull

	            // If there are months to select, add a dropdown menu.
	            if ( settings.selectMonths ) {

	                return _.node( 'select',
	                    _.group({
	                        min: 0,
	                        max: 11,
	                        i: 1,
	                        node: 'option',
	                        item: function( loopedMonth ) {

	                            return [

	                                // The looped month and no classes.
	                                monthsCollection[ loopedMonth ], 0,

	                                // Set the value and selected index.
	                                'value=' + loopedMonth +
	                                ( viewsetObject.month == loopedMonth ? ' selected' : '' ) +
	                                (
	                                    (
	                                        ( viewsetObject.year == minLimitObject.year && loopedMonth < minLimitObject.month ) ||
	                                        ( viewsetObject.year == maxLimitObject.year && loopedMonth > maxLimitObject.month )
	                                    ) ?
	                                    ' disabled' : ''
	                                )
	                            ]
	                        }
	                    }),
	                    settings.klass.selectMonth,
	                    ( isOpen ? '' : 'disabled' ) + ' ' +
	                    _.ariaAttr({ controls: calendar.$node[0].id + '_table' }) + ' ' +
	                    'title="' + settings.labelMonthSelect + '"'
	                )
	            }

	            // If there's a need for a month selector
	            return _.node( 'div', monthsCollection[ viewsetObject.month ], settings.klass.month )
	        }, //createMonthLabel


	        // Create the year label.
	        createYearLabel = function() {

	            var focusedYear = viewsetObject.year,

	            // If years selector is set to a literal "true", set it to 5. Otherwise
	            // divide in half to get half before and half after focused year.
	            numberYears = settings.selectYears === true ? 5 : ~~( settings.selectYears / 2 )

	            // If there are years to select, add a dropdown menu.
	            if ( numberYears ) {

	                var
	                    minYear = minLimitObject.year,
	                    maxYear = maxLimitObject.year,
	                    lowestYear = focusedYear - numberYears,
	                    highestYear = focusedYear + numberYears

	                // If the min year is greater than the lowest year, increase the highest year
	                // by the difference and set the lowest year to the min year.
	                if ( minYear > lowestYear ) {
	                    highestYear += minYear - lowestYear
	                    lowestYear = minYear
	                }

	                // If the max year is less than the highest year, decrease the lowest year
	                // by the lower of the two: available and needed years. Then set the
	                // highest year to the max year.
	                if ( maxYear < highestYear ) {

	                    var availableYears = lowestYear - minYear,
	                        neededYears = highestYear - maxYear

	                    lowestYear -= availableYears > neededYears ? neededYears : availableYears
	                    highestYear = maxYear
	                }

	                return _.node( 'select',
	                    _.group({
	                        min: lowestYear,
	                        max: highestYear,
	                        i: 1,
	                        node: 'option',
	                        item: function( loopedYear ) {
	                            return [

	                                // The looped year and no classes.
	                                loopedYear, 0,

	                                // Set the value and selected index.
	                                'value=' + loopedYear + ( focusedYear == loopedYear ? ' selected' : '' )
	                            ]
	                        }
	                    }),
	                    settings.klass.selectYear,
	                    ( isOpen ? '' : 'disabled' ) + ' ' + _.ariaAttr({ controls: calendar.$node[0].id + '_table' }) + ' ' +
	                    'title="' + settings.labelYearSelect + '"'
	                )
	            }

	            // Otherwise just return the year focused
	            return _.node( 'div', focusedYear, settings.klass.year )
	        } //createYearLabel


	    // Create and return the entire calendar.
	    return _.node(
	        'div',
	        ( settings.selectYears ? createYearLabel() + createMonthLabel() : createMonthLabel() + createYearLabel() ) +
	        createMonthNav() + createMonthNav( 1 ),
	        settings.klass.header
	    ) + _.node(
	        'table',
	        tableHead +
	        _.node(
	            'tbody',
	            _.group({
	                min: 0,
	                max: WEEKS_IN_CALENDAR - 1,
	                i: 1,
	                node: 'tr',
	                item: function( rowCounter ) {

	                    // If Monday is the first day and the month starts on Sunday, shift the date back a week.
	                    var shiftDateBy = settings.firstDay && calendar.create([ viewsetObject.year, viewsetObject.month, 1 ]).day === 0 ? -7 : 0

	                    return [
	                        _.group({
	                            min: DAYS_IN_WEEK * rowCounter - viewsetObject.day + shiftDateBy + 1, // Add 1 for weekday 0index
	                            max: function() {
	                                return this.min + DAYS_IN_WEEK - 1
	                            },
	                            i: 1,
	                            node: 'td',
	                            item: function( targetDate ) {

	                                // Convert the time date from a relative date to a target date.
	                                targetDate = calendar.create([ viewsetObject.year, viewsetObject.month, targetDate + ( settings.firstDay ? 1 : 0 ) ])

	                                var isSelected = selectedObject && selectedObject.pick == targetDate.pick,
	                                    isHighlighted = highlightedObject && highlightedObject.pick == targetDate.pick,
	                                    isDisabled = disabledCollection && calendar.disabled( targetDate ) || targetDate.pick < minLimitObject.pick || targetDate.pick > maxLimitObject.pick,
	                                    formattedDate = _.trigger( calendar.formats.toString, calendar, [ settings.format, targetDate ] )

	                                return [
	                                    _.node(
	                                        'div',
	                                        targetDate.date,
	                                        (function( klasses ) {

	                                            // Add the `infocus` or `outfocus` classes based on month in view.
	                                            klasses.push( viewsetObject.month == targetDate.month ? settings.klass.infocus : settings.klass.outfocus )

	                                            // Add the `today` class if needed.
	                                            if ( nowObject.pick == targetDate.pick ) {
	                                                klasses.push( settings.klass.now )
	                                            }

	                                            // Add the `selected` class if something's selected and the time matches.
	                                            if ( isSelected ) {
	                                                klasses.push( settings.klass.selected )
	                                            }

	                                            // Add the `highlighted` class if something's highlighted and the time matches.
	                                            if ( isHighlighted ) {
	                                                klasses.push( settings.klass.highlighted )
	                                            }

	                                            // Add the `disabled` class if something's disabled and the object matches.
	                                            if ( isDisabled ) {
	                                                klasses.push( settings.klass.disabled )
	                                            }

	                                            return klasses.join( ' ' )
	                                        })([ settings.klass.day ]),
	                                        'data-pick=' + targetDate.pick + ' ' + _.ariaAttr({
	                                            role: 'gridcell',
	                                            label: formattedDate,
	                                            selected: isSelected && calendar.$node.val() === formattedDate ? true : null,
	                                            activedescendant: isHighlighted ? true : null,
	                                            disabled: isDisabled ? true : null
	                                        })
	                                    ),
	                                    '',
	                                    _.ariaAttr({ role: 'presentation' })
	                                ] //endreturn
	                            }
	                        })
	                    ] //endreturn
	                }
	            })
	        ),
	        settings.klass.table,
	        'id="' + calendar.$node[0].id + '_table' + '" ' + _.ariaAttr({
	            role: 'grid',
	            controls: calendar.$node[0].id,
	            readonly: true
	        })
	    ) +

	    // * For Firefox forms to submit, make sure to set the buttons’ `type` attributes as “button”.
	    _.node(
	        'div',
	        _.node( 'button', settings.today, settings.klass.buttonToday,
	            'type=button data-pick=' + nowObject.pick +
	            ( isOpen && !calendar.disabled(nowObject) ? '' : ' disabled' ) + ' ' +
	            _.ariaAttr({ controls: calendar.$node[0].id }) ) +
	        _.node( 'button', settings.clear, settings.klass.buttonClear,
	            'type=button data-clear=1' +
	            ( isOpen ? '' : ' disabled' ) + ' ' +
	            _.ariaAttr({ controls: calendar.$node[0].id }) ) +
	        _.node('button', settings.close, settings.klass.buttonClose,
	            'type=button data-close=true ' +
	            ( isOpen ? '' : ' disabled' ) + ' ' +
	            _.ariaAttr({ controls: calendar.$node[0].id }) ),
	        settings.klass.footer
	    ) //endreturn
	} //DatePicker.prototype.nodes




	/**
	 * The date picker defaults.
	 */
	DatePicker.defaults = (function( prefix ) {

	    return {

	        // The title label to use for the month nav buttons
	        labelMonthNext: 'Next month',
	        labelMonthPrev: 'Previous month',

	        // The title label to use for the dropdown selectors
	        labelMonthSelect: 'Select a month',
	        labelYearSelect: 'Select a year',

	        // Months and weekdays
	        monthsFull: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
	        monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
	        weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
	        weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],

	        // Today and clear
	        today: 'Today',
	        clear: 'Clear',
	        close: 'Close',

	        // Picker close behavior
	        closeOnSelect: true,
	        closeOnClear: true,

	        // The format to show on the `input` element
	        format: 'd mmmm, yyyy',

	        // Classes
	        klass: {

	            table: prefix + 'table',

	            header: prefix + 'header',

	            navPrev: prefix + 'nav--prev',
	            navNext: prefix + 'nav--next',
	            navDisabled: prefix + 'nav--disabled',

	            month: prefix + 'month',
	            year: prefix + 'year',

	            selectMonth: prefix + 'select--month',
	            selectYear: prefix + 'select--year',

	            weekdays: prefix + 'weekday',

	            day: prefix + 'day',
	            disabled: prefix + 'day--disabled',
	            selected: prefix + 'day--selected',
	            highlighted: prefix + 'day--highlighted',
	            now: prefix + 'day--today',
	            infocus: prefix + 'day--infocus',
	            outfocus: prefix + 'day--outfocus',

	            footer: prefix + 'footer',

	            buttonClear: prefix + 'button--clear',
	            buttonToday: prefix + 'button--today',
	            buttonClose: prefix + 'button--close'
	        }
	    }
	})( Picker.klasses().picker + '__' )





	/**
	 * Extend the picker to add the date picker.
	 */
	Picker.extend( 'pickadate', DatePicker )


	}));





/***/ },

/***/ 12:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * Time picker for pickadate.js v3.5.6
	 * http://amsul.github.io/pickadate.js/time.htm
	 */

	(function ( factory ) {

	    // AMD.
	    if ( true )
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(10), __webpack_require__(6)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))

	    // Node.js/browserify.
	    else if ( typeof exports == 'object' )
	        module.exports = factory( require('./picker.js'), require('jquery') )

	    // Browser globals.
	    else factory( Picker, jQuery )

	}(function( Picker, $ ) {


	/**
	 * Globals and constants
	 */
	var HOURS_IN_DAY = 24,
	    MINUTES_IN_HOUR = 60,
	    HOURS_TO_NOON = 12,
	    MINUTES_IN_DAY = HOURS_IN_DAY * MINUTES_IN_HOUR,
	    _ = Picker._



	/**
	 * The time picker constructor
	 */
	function TimePicker( picker, settings ) {

	    var clock = this,
	        elementValue = picker.$node[ 0 ].value,
	        elementDataValue = picker.$node.data( 'value' ),
	        valueString = elementDataValue || elementValue,
	        formatString = elementDataValue ? settings.formatSubmit : settings.format

	    clock.settings = settings
	    clock.$node = picker.$node

	    // The queue of methods that will be used to build item objects.
	    clock.queue = {
	        interval: 'i',
	        min: 'measure create',
	        max: 'measure create',
	        now: 'now create',
	        select: 'parse create validate',
	        highlight: 'parse create validate',
	        view: 'parse create validate',
	        disable: 'deactivate',
	        enable: 'activate'
	    }

	    // The component's item object.
	    clock.item = {}

	    clock.item.clear = null
	    clock.item.interval = settings.interval || 30
	    clock.item.disable = ( settings.disable || [] ).slice( 0 )
	    clock.item.enable = -(function( collectionDisabled ) {
	        return collectionDisabled[ 0 ] === true ? collectionDisabled.shift() : -1
	    })( clock.item.disable )

	    clock.
	        set( 'min', settings.min ).
	        set( 'max', settings.max ).
	        set( 'now' )

	    // When there’s a value, set the `select`, which in turn
	    // also sets the `highlight` and `view`.
	    if ( valueString ) {
	        clock.set( 'select', valueString, {
	            format: formatString
	        })
	    }

	    // If there’s no value, default to highlighting “today”.
	    else {
	        clock.
	            set( 'select', null ).
	            set( 'highlight', clock.item.now )
	    }

	    // The keycode to movement mapping.
	    clock.key = {
	        40: 1, // Down
	        38: -1, // Up
	        39: 1, // Right
	        37: -1, // Left
	        go: function( timeChange ) {
	            clock.set(
	                'highlight',
	                clock.item.highlight.pick + timeChange * clock.item.interval,
	                { interval: timeChange * clock.item.interval }
	            )
	            this.render()
	        }
	    }


	    // Bind some picker events.
	    picker.
	        on( 'render', function() {
	            var $pickerHolder = picker.$root.children(),
	                $viewset = $pickerHolder.find( '.' + settings.klass.viewset ),
	                vendors = function( prop ) {
	                    return ['webkit', 'moz', 'ms', 'o', ''].map(function( vendor ) {
	                        return ( vendor ? '-' + vendor + '-' : '' ) + prop
	                    })
	                },
	                animations = function( $el, state ) {
	                    vendors( 'transform' ).map(function( prop ) {
	                        $el.css( prop, state )
	                    })
	                    vendors( 'transition' ).map(function( prop ) {
	                        $el.css( prop, state )
	                    })
	                }
	            if ( $viewset.length ) {
	                animations( $pickerHolder, 'none' )
	                $pickerHolder[ 0 ].scrollTop = ~~$viewset.position().top - ( $viewset[ 0 ].clientHeight * 2 )
	                animations( $pickerHolder, '' )
	            }
	        }, 1 ).
	        on( 'open', function() {
	            picker.$root.find( 'button' ).attr( 'disabled', false )
	        }, 1 ).
	        on( 'close', function() {
	            picker.$root.find( 'button' ).attr( 'disabled', true )
	        }, 1 )

	} //TimePicker


	/**
	 * Set a timepicker item object.
	 */
	TimePicker.prototype.set = function( type, value, options ) {

	    var clock = this,
	        clockItem = clock.item

	    // If the value is `null` just set it immediately.
	    if ( value === null ) {
	        if ( type == 'clear' ) type = 'select'
	        clockItem[ type ] = value
	        return clock
	    }

	    // Otherwise go through the queue of methods, and invoke the functions.
	    // Update this as the time unit, and set the final value as this item.
	    // * In the case of `enable`, keep the queue but set `disable` instead.
	    //   And in the case of `flip`, keep the queue but set `enable` instead.
	    clockItem[ ( type == 'enable' ? 'disable' : type == 'flip' ? 'enable' : type ) ] = clock.queue[ type ].split( ' ' ).map( function( method ) {
	        value = clock[ method ]( type, value, options )
	        return value
	    }).pop()

	    // Check if we need to cascade through more updates.
	    if ( type == 'select' ) {
	        clock.set( 'highlight', clockItem.select, options )
	    }
	    else if ( type == 'highlight' ) {
	        clock.set( 'view', clockItem.highlight, options )
	    }
	    else if ( type == 'interval' ) {
	        clock.
	            set( 'min', clockItem.min, options ).
	            set( 'max', clockItem.max, options )
	    }
	    else if ( type.match( /^(flip|min|max|disable|enable)$/ ) ) {
	        if ( clockItem.select && clock.disabled( clockItem.select ) ) {
	            clock.set( 'select', value, options )
	        }
	        if ( clockItem.highlight && clock.disabled( clockItem.highlight ) ) {
	            clock.set( 'highlight', value, options )
	        }
	        if ( type == 'min' ) {
	            clock.set( 'max', clockItem.max, options )
	        }
	    }

	    return clock
	} //TimePicker.prototype.set


	/**
	 * Get a timepicker item object.
	 */
	TimePicker.prototype.get = function( type ) {
	    return this.item[ type ]
	} //TimePicker.prototype.get


	/**
	 * Create a picker time object.
	 */
	TimePicker.prototype.create = function( type, value, options ) {

	    var clock = this

	    // If there’s no value, use the type as the value.
	    value = value === undefined ? type : value

	    // If it’s a date object, convert it into an array.
	    if ( _.isDate( value ) ) {
	        value = [ value.getHours(), value.getMinutes() ]
	    }

	    // If it’s an object, use the “pick” value.
	    if ( $.isPlainObject( value ) && _.isInteger( value.pick ) ) {
	        value = value.pick
	    }

	    // If it’s an array, convert it into minutes.
	    else if ( $.isArray( value ) ) {
	        value = +value[ 0 ] * MINUTES_IN_HOUR + (+value[ 1 ])
	    }

	    // If no valid value is passed, set it to “now”.
	    else if ( !_.isInteger( value ) ) {
	        value = clock.now( type, value, options )
	    }

	    // If we’re setting the max, make sure it’s greater than the min.
	    if ( type == 'max' && value < clock.item.min.pick ) {
	        value += MINUTES_IN_DAY
	    }

	    // If the value doesn’t fall directly on the interval,
	    // add one interval to indicate it as “passed”.
	    if ( type != 'min' && type != 'max' && (value - clock.item.min.pick) % clock.item.interval !== 0 ) {
	        value += clock.item.interval
	    }

	    // Normalize it into a “reachable” interval.
	    value = clock.normalize( type, value, options )

	    // Return the compiled object.
	    return {

	        // Divide to get hours from minutes.
	        hour: ~~( HOURS_IN_DAY + value / MINUTES_IN_HOUR ) % HOURS_IN_DAY,

	        // The remainder is the minutes.
	        mins: ( MINUTES_IN_HOUR + value % MINUTES_IN_HOUR ) % MINUTES_IN_HOUR,

	        // The time in total minutes.
	        time: ( MINUTES_IN_DAY + value ) % MINUTES_IN_DAY,

	        // Reference to the “relative” value to pick.
	        pick: value % MINUTES_IN_DAY
	    }
	} //TimePicker.prototype.create


	/**
	 * Create a range limit object using an array, date object,
	 * literal “true”, or integer relative to another time.
	 */
	TimePicker.prototype.createRange = function( from, to ) {

	    var clock = this,
	        createTime = function( time ) {
	            if ( time === true || $.isArray( time ) || _.isDate( time ) ) {
	                return clock.create( time )
	            }
	            return time
	        }

	    // Create objects if possible.
	    if ( !_.isInteger( from ) ) {
	        from = createTime( from )
	    }
	    if ( !_.isInteger( to ) ) {
	        to = createTime( to )
	    }

	    // Create relative times.
	    if ( _.isInteger( from ) && $.isPlainObject( to ) ) {
	        from = [ to.hour, to.mins + ( from * clock.settings.interval ) ];
	    }
	    else if ( _.isInteger( to ) && $.isPlainObject( from ) ) {
	        to = [ from.hour, from.mins + ( to * clock.settings.interval ) ];
	    }

	    return {
	        from: createTime( from ),
	        to: createTime( to )
	    }
	} //TimePicker.prototype.createRange


	/**
	 * Check if a time unit falls within a time range object.
	 */
	TimePicker.prototype.withinRange = function( range, timeUnit ) {
	    range = this.createRange(range.from, range.to)
	    return timeUnit.pick >= range.from.pick && timeUnit.pick <= range.to.pick
	}


	/**
	 * Check if two time range objects overlap.
	 */
	TimePicker.prototype.overlapRanges = function( one, two ) {

	    var clock = this

	    // Convert the ranges into comparable times.
	    one = clock.createRange( one.from, one.to )
	    two = clock.createRange( two.from, two.to )

	    return clock.withinRange( one, two.from ) || clock.withinRange( one, two.to ) ||
	        clock.withinRange( two, one.from ) || clock.withinRange( two, one.to )
	}


	/**
	 * Get the time relative to now.
	 */
	TimePicker.prototype.now = function( type, value/*, options*/ ) {

	    var interval = this.item.interval,
	        date = new Date(),
	        nowMinutes = date.getHours() * MINUTES_IN_HOUR + date.getMinutes(),
	        isValueInteger = _.isInteger( value ),
	        isBelowInterval

	    // Make sure “now” falls within the interval range.
	    nowMinutes -= nowMinutes % interval

	    // Check if the difference is less than the interval itself.
	    isBelowInterval = value < 0 && interval * value + nowMinutes <= -interval

	    // Add an interval because the time has “passed”.
	    nowMinutes += type == 'min' && isBelowInterval ? 0 : interval

	    // If the value is a number, adjust by that many intervals.
	    if ( isValueInteger ) {
	        nowMinutes += interval * (
	            isBelowInterval && type != 'max' ?
	                value + 1 :
	                value
	            )
	    }

	    // Return the final calculation.
	    return nowMinutes
	} //TimePicker.prototype.now


	/**
	 * Normalize minutes to be “reachable” based on the min and interval.
	 */
	TimePicker.prototype.normalize = function( type, value/*, options*/ ) {

	    var interval = this.item.interval,
	        minTime = this.item.min && this.item.min.pick || 0

	    // If setting min time, don’t shift anything.
	    // Otherwise get the value and min difference and then
	    // normalize the difference with the interval.
	    value -= type == 'min' ? 0 : ( value - minTime ) % interval

	    // Return the adjusted value.
	    return value
	} //TimePicker.prototype.normalize


	/**
	 * Measure the range of minutes.
	 */
	TimePicker.prototype.measure = function( type, value, options ) {

	    var clock = this

	    // If it’s anything false-y, set it to the default.
	    if ( !value ) {
	        value = type == 'min' ? [ 0, 0 ] : [ HOURS_IN_DAY - 1, MINUTES_IN_HOUR - 1 ]
	    }

	    // If it’s a string, parse it.
	    if ( typeof value == 'string' ) {
	        value = clock.parse( type, value )
	    }

	    // If it’s a literal true, or an integer, make it relative to now.
	    else if ( value === true || _.isInteger( value ) ) {
	        value = clock.now( type, value, options )
	    }

	    // If it’s an object already, just normalize it.
	    else if ( $.isPlainObject( value ) && _.isInteger( value.pick ) ) {
	        value = clock.normalize( type, value.pick, options )
	    }

	    return value
	} ///TimePicker.prototype.measure


	/**
	 * Validate an object as enabled.
	 */
	TimePicker.prototype.validate = function( type, timeObject, options ) {

	    var clock = this,
	        interval = options && options.interval ? options.interval : clock.item.interval

	    // Check if the object is disabled.
	    if ( clock.disabled( timeObject ) ) {

	        // Shift with the interval until we reach an enabled time.
	        timeObject = clock.shift( timeObject, interval )
	    }

	    // Scope the object into range.
	    timeObject = clock.scope( timeObject )

	    // Do a second check to see if we landed on a disabled min/max.
	    // In that case, shift using the opposite interval as before.
	    if ( clock.disabled( timeObject ) ) {
	        timeObject = clock.shift( timeObject, interval * -1 )
	    }

	    // Return the final object.
	    return timeObject
	} //TimePicker.prototype.validate


	/**
	 * Check if an object is disabled.
	 */
	TimePicker.prototype.disabled = function( timeToVerify ) {

	    var clock = this,

	        // Filter through the disabled times to check if this is one.
	        isDisabledMatch = clock.item.disable.filter( function( timeToDisable ) {

	            // If the time is a number, match the hours.
	            if ( _.isInteger( timeToDisable ) ) {
	                return timeToVerify.hour == timeToDisable
	            }

	            // If it’s an array, create the object and match the times.
	            if ( $.isArray( timeToDisable ) || _.isDate( timeToDisable ) ) {
	                return timeToVerify.pick == clock.create( timeToDisable ).pick
	            }

	            // If it’s an object, match a time within the “from” and “to” range.
	            if ( $.isPlainObject( timeToDisable ) ) {
	                return clock.withinRange( timeToDisable, timeToVerify )
	            }
	        })

	    // If this time matches a disabled time, confirm it’s not inverted.
	    isDisabledMatch = isDisabledMatch.length && !isDisabledMatch.filter(function( timeToDisable ) {
	        return $.isArray( timeToDisable ) && timeToDisable[2] == 'inverted' ||
	            $.isPlainObject( timeToDisable ) && timeToDisable.inverted
	    }).length

	    // If the clock is "enabled" flag is flipped, flip the condition.
	    return clock.item.enable === -1 ? !isDisabledMatch : isDisabledMatch ||
	        timeToVerify.pick < clock.item.min.pick ||
	        timeToVerify.pick > clock.item.max.pick
	} //TimePicker.prototype.disabled


	/**
	 * Shift an object by an interval until we reach an enabled object.
	 */
	TimePicker.prototype.shift = function( timeObject, interval ) {

	    var clock = this,
	        minLimit = clock.item.min.pick,
	        maxLimit = clock.item.max.pick/*,
	        safety = 1000*/

	    interval = interval || clock.item.interval

	    // Keep looping as long as the time is disabled.
	    while ( /*safety &&*/ clock.disabled( timeObject ) ) {

	        /*safety -= 1
	        if ( !safety ) {
	            throw 'Fell into an infinite loop while shifting to ' + timeObject.hour + ':' + timeObject.mins + '.'
	        }*/

	        // Increase/decrease the time by the interval and keep looping.
	        timeObject = clock.create( timeObject.pick += interval )

	        // If we've looped beyond the limits, break out of the loop.
	        if ( timeObject.pick <= minLimit || timeObject.pick >= maxLimit ) {
	            break
	        }
	    }

	    // Return the final object.
	    return timeObject
	} //TimePicker.prototype.shift


	/**
	 * Scope an object to be within range of min and max.
	 */
	TimePicker.prototype.scope = function( timeObject ) {
	    var minLimit = this.item.min.pick,
	        maxLimit = this.item.max.pick
	    return this.create( timeObject.pick > maxLimit ? maxLimit : timeObject.pick < minLimit ? minLimit : timeObject )
	} //TimePicker.prototype.scope


	/**
	 * Parse a string into a usable type.
	 */
	TimePicker.prototype.parse = function( type, value, options ) {

	    var hour, minutes, isPM, item, parseValue,
	        clock = this,
	        parsingObject = {}

	    // If it’s already parsed, we’re good.
	    if ( !value || typeof value != 'string' ) {
	        return value
	    }

	    // We need a `.format` to parse the value with.
	    if ( !( options && options.format ) ) {
	        options = options || {}
	        options.format = clock.settings.format
	    }

	    // Convert the format into an array and then map through it.
	    clock.formats.toArray( options.format ).map( function( label ) {

	        var
	            substring,

	            // Grab the formatting label.
	            formattingLabel = clock.formats[ label ],

	            // The format length is from the formatting label function or the
	            // label length without the escaping exclamation (!) mark.
	            formatLength = formattingLabel ?
	                _.trigger( formattingLabel, clock, [ value, parsingObject ] ) :
	                label.replace( /^!/, '' ).length

	        // If there's a format label, split the value up to the format length.
	        // Then add it to the parsing object with appropriate label.
	        if ( formattingLabel ) {
	            substring = value.substr( 0, formatLength )
	            parsingObject[ label ] = substring.match(/^\d+$/) ? +substring : substring
	        }

	        // Update the time value as the substring from format length to end.
	        value = value.substr( formatLength )
	    })

	    // Grab the hour and minutes from the parsing object.
	    for ( item in parsingObject ) {
	        parseValue = parsingObject[item]
	        if ( _.isInteger(parseValue) ) {
	            if ( item.match(/^(h|hh)$/i) ) {
	                hour = parseValue
	                if ( item == 'h' || item == 'hh' ) {
	                    hour %= 12
	                }
	            }
	            else if ( item == 'i' ) {
	                minutes = parseValue
	            }
	        }
	        else if ( item.match(/^a$/i) && parseValue.match(/^p/i) && ('h' in parsingObject || 'hh' in parsingObject) ) {
	            isPM = true
	        }
	    }

	    // Calculate it in minutes and return.
	    return (isPM ? hour + 12 : hour) * MINUTES_IN_HOUR + minutes
	} //TimePicker.prototype.parse


	/**
	 * Various formats to display the object in.
	 */
	TimePicker.prototype.formats = {

	    h: function( string, timeObject ) {

	        // If there's string, then get the digits length.
	        // Otherwise return the selected hour in "standard" format.
	        return string ? _.digits( string ) : timeObject.hour % HOURS_TO_NOON || HOURS_TO_NOON
	    },
	    hh: function( string, timeObject ) {

	        // If there's a string, then the length is always 2.
	        // Otherwise return the selected hour in "standard" format with a leading zero.
	        return string ? 2 : _.lead( timeObject.hour % HOURS_TO_NOON || HOURS_TO_NOON )
	    },
	    H: function( string, timeObject ) {

	        // If there's string, then get the digits length.
	        // Otherwise return the selected hour in "military" format as a string.
	        return string ? _.digits( string ) : '' + ( timeObject.hour % 24 )
	    },
	    HH: function( string, timeObject ) {

	        // If there's string, then get the digits length.
	        // Otherwise return the selected hour in "military" format with a leading zero.
	        return string ? _.digits( string ) : _.lead( timeObject.hour % 24 )
	    },
	    i: function( string, timeObject ) {

	        // If there's a string, then the length is always 2.
	        // Otherwise return the selected minutes.
	        return string ? 2 : _.lead( timeObject.mins )
	    },
	    a: function( string, timeObject ) {

	        // If there's a string, then the length is always 4.
	        // Otherwise check if it's more than "noon" and return either am/pm.
	        return string ? 4 : MINUTES_IN_DAY / 2 > timeObject.time % MINUTES_IN_DAY ? 'a.m.' : 'p.m.'
	    },
	    A: function( string, timeObject ) {

	        // If there's a string, then the length is always 2.
	        // Otherwise check if it's more than "noon" and return either am/pm.
	        return string ? 2 : MINUTES_IN_DAY / 2 > timeObject.time % MINUTES_IN_DAY ? 'AM' : 'PM'
	    },

	    // Create an array by splitting the formatting string passed.
	    toArray: function( formatString ) { return formatString.split( /(h{1,2}|H{1,2}|i|a|A|!.)/g ) },

	    // Format an object into a string using the formatting options.
	    toString: function ( formatString, itemObject ) {
	        var clock = this
	        return clock.formats.toArray( formatString ).map( function( label ) {
	            return _.trigger( clock.formats[ label ], clock, [ 0, itemObject ] ) || label.replace( /^!/, '' )
	        }).join( '' )
	    }
	} //TimePicker.prototype.formats




	/**
	 * Check if two time units are the exact.
	 */
	TimePicker.prototype.isTimeExact = function( one, two ) {

	    var clock = this

	    // When we’re working with minutes, do a direct comparison.
	    if (
	        ( _.isInteger( one ) && _.isInteger( two ) ) ||
	        ( typeof one == 'boolean' && typeof two == 'boolean' )
	     ) {
	        return one === two
	    }

	    // When we’re working with time representations, compare the “pick” value.
	    if (
	        ( _.isDate( one ) || $.isArray( one ) ) &&
	        ( _.isDate( two ) || $.isArray( two ) )
	    ) {
	        return clock.create( one ).pick === clock.create( two ).pick
	    }

	    // When we’re working with range objects, compare the “from” and “to”.
	    if ( $.isPlainObject( one ) && $.isPlainObject( two ) ) {
	        return clock.isTimeExact( one.from, two.from ) && clock.isTimeExact( one.to, two.to )
	    }

	    return false
	}


	/**
	 * Check if two time units overlap.
	 */
	TimePicker.prototype.isTimeOverlap = function( one, two ) {

	    var clock = this

	    // When we’re working with an integer, compare the hours.
	    if ( _.isInteger( one ) && ( _.isDate( two ) || $.isArray( two ) ) ) {
	        return one === clock.create( two ).hour
	    }
	    if ( _.isInteger( two ) && ( _.isDate( one ) || $.isArray( one ) ) ) {
	        return two === clock.create( one ).hour
	    }

	    // When we’re working with range objects, check if the ranges overlap.
	    if ( $.isPlainObject( one ) && $.isPlainObject( two ) ) {
	        return clock.overlapRanges( one, two )
	    }

	    return false
	}


	/**
	 * Flip the “enabled” state.
	 */
	TimePicker.prototype.flipEnable = function(val) {
	    var itemObject = this.item
	    itemObject.enable = val || (itemObject.enable == -1 ? 1 : -1)
	}


	/**
	 * Mark a collection of times as “disabled”.
	 */
	TimePicker.prototype.deactivate = function( type, timesToDisable ) {

	    var clock = this,
	        disabledItems = clock.item.disable.slice(0)


	    // If we’re flipping, that’s all we need to do.
	    if ( timesToDisable == 'flip' ) {
	        clock.flipEnable()
	    }

	    else if ( timesToDisable === false ) {
	        clock.flipEnable(1)
	        disabledItems = []
	    }

	    else if ( timesToDisable === true ) {
	        clock.flipEnable(-1)
	        disabledItems = []
	    }

	    // Otherwise go through the times to disable.
	    else {

	        timesToDisable.map(function( unitToDisable ) {

	            var matchFound

	            // When we have disabled items, check for matches.
	            // If something is matched, immediately break out.
	            for ( var index = 0; index < disabledItems.length; index += 1 ) {
	                if ( clock.isTimeExact( unitToDisable, disabledItems[index] ) ) {
	                    matchFound = true
	                    break
	                }
	            }

	            // If nothing was found, add the validated unit to the collection.
	            if ( !matchFound ) {
	                if (
	                    _.isInteger( unitToDisable ) ||
	                    _.isDate( unitToDisable ) ||
	                    $.isArray( unitToDisable ) ||
	                    ( $.isPlainObject( unitToDisable ) && unitToDisable.from && unitToDisable.to )
	                ) {
	                    disabledItems.push( unitToDisable )
	                }
	            }
	        })
	    }

	    // Return the updated collection.
	    return disabledItems
	} //TimePicker.prototype.deactivate


	/**
	 * Mark a collection of times as “enabled”.
	 */
	TimePicker.prototype.activate = function( type, timesToEnable ) {

	    var clock = this,
	        disabledItems = clock.item.disable,
	        disabledItemsCount = disabledItems.length

	    // If we’re flipping, that’s all we need to do.
	    if ( timesToEnable == 'flip' ) {
	        clock.flipEnable()
	    }

	    else if ( timesToEnable === true ) {
	        clock.flipEnable(1)
	        disabledItems = []
	    }

	    else if ( timesToEnable === false ) {
	        clock.flipEnable(-1)
	        disabledItems = []
	    }

	    // Otherwise go through the disabled times.
	    else {

	        timesToEnable.map(function( unitToEnable ) {

	            var matchFound,
	                disabledUnit,
	                index,
	                isRangeMatched

	            // Go through the disabled items and try to find a match.
	            for ( index = 0; index < disabledItemsCount; index += 1 ) {

	                disabledUnit = disabledItems[index]

	                // When an exact match is found, remove it from the collection.
	                if ( clock.isTimeExact( disabledUnit, unitToEnable ) ) {
	                    matchFound = disabledItems[index] = null
	                    isRangeMatched = true
	                    break
	                }

	                // When an overlapped match is found, add the “inverted” state to it.
	                else if ( clock.isTimeOverlap( disabledUnit, unitToEnable ) ) {
	                    if ( $.isPlainObject( unitToEnable ) ) {
	                        unitToEnable.inverted = true
	                        matchFound = unitToEnable
	                    }
	                    else if ( $.isArray( unitToEnable ) ) {
	                        matchFound = unitToEnable
	                        if ( !matchFound[2] ) matchFound.push( 'inverted' )
	                    }
	                    else if ( _.isDate( unitToEnable ) ) {
	                        matchFound = [ unitToEnable.getFullYear(), unitToEnable.getMonth(), unitToEnable.getDate(), 'inverted' ]
	                    }
	                    break
	                }
	            }

	            // If a match was found, remove a previous duplicate entry.
	            if ( matchFound ) for ( index = 0; index < disabledItemsCount; index += 1 ) {
	                if ( clock.isTimeExact( disabledItems[index], unitToEnable ) ) {
	                    disabledItems[index] = null
	                    break
	                }
	            }

	            // In the event that we’re dealing with an overlap of range times,
	            // make sure there are no “inverted” times because of it.
	            if ( isRangeMatched ) for ( index = 0; index < disabledItemsCount; index += 1 ) {
	                if ( clock.isTimeOverlap( disabledItems[index], unitToEnable ) ) {
	                    disabledItems[index] = null
	                    break
	                }
	            }

	            // If something is still matched, add it into the collection.
	            if ( matchFound ) {
	                disabledItems.push( matchFound )
	            }
	        })
	    }

	    // Return the updated collection.
	    return disabledItems.filter(function( val ) { return val != null })
	} //TimePicker.prototype.activate


	/**
	 * The division to use for the range intervals.
	 */
	TimePicker.prototype.i = function( type, value/*, options*/ ) {
	    return _.isInteger( value ) && value > 0 ? value : this.item.interval
	}


	/**
	 * Create a string for the nodes in the picker.
	 */
	TimePicker.prototype.nodes = function( isOpen ) {

	    var
	        clock = this,
	        settings = clock.settings,
	        selectedObject = clock.item.select,
	        highlightedObject = clock.item.highlight,
	        viewsetObject = clock.item.view,
	        disabledCollection = clock.item.disable

	    return _.node(
	        'ul',
	        _.group({
	            min: clock.item.min.pick,
	            max: clock.item.max.pick,
	            i: clock.item.interval,
	            node: 'li',
	            item: function( loopedTime ) {
	                loopedTime = clock.create( loopedTime )
	                var timeMinutes = loopedTime.pick,
	                    isSelected = selectedObject && selectedObject.pick == timeMinutes,
	                    isHighlighted = highlightedObject && highlightedObject.pick == timeMinutes,
	                    isDisabled = disabledCollection && clock.disabled( loopedTime ),
	                    formattedTime = _.trigger( clock.formats.toString, clock, [ settings.format, loopedTime ] )
	                return [
	                    _.trigger( clock.formats.toString, clock, [ _.trigger( settings.formatLabel, clock, [ loopedTime ] ) || settings.format, loopedTime ] ),
	                    (function( klasses ) {

	                        if ( isSelected ) {
	                            klasses.push( settings.klass.selected )
	                        }

	                        if ( isHighlighted ) {
	                            klasses.push( settings.klass.highlighted )
	                        }

	                        if ( viewsetObject && viewsetObject.pick == timeMinutes ) {
	                            klasses.push( settings.klass.viewset )
	                        }

	                        if ( isDisabled ) {
	                            klasses.push( settings.klass.disabled )
	                        }

	                        return klasses.join( ' ' )
	                    })( [ settings.klass.listItem ] ),
	                    'data-pick=' + loopedTime.pick + ' ' + _.ariaAttr({
	                        role: 'option',
	                        label: formattedTime,
	                        selected: isSelected && clock.$node.val() === formattedTime ? true : null,
	                        activedescendant: isHighlighted ? true : null,
	                        disabled: isDisabled ? true : null
	                    })
	                ]
	            }
	        }) +

	        // * For Firefox forms to submit, make sure to set the button’s `type` attribute as “button”.
	        _.node(
	            'li',
	            _.node(
	                'button',
	                settings.clear,
	                settings.klass.buttonClear,
	                'type=button data-clear=1' + ( isOpen ? '' : ' disabled' ) + ' ' +
	                _.ariaAttr({ controls: clock.$node[0].id })
	            ),
	            '', _.ariaAttr({ role: 'presentation' })
	        ),
	        settings.klass.list,
	        _.ariaAttr({ role: 'listbox', controls: clock.$node[0].id })
	    )
	} //TimePicker.prototype.nodes







	/**
	 * Extend the picker to add the component with the defaults.
	 */
	TimePicker.defaults = (function( prefix ) {

	    return {

	        // Clear
	        clear: 'Clear',

	        // The format to show on the `input` element
	        format: 'h:i A',

	        // The interval between each time
	        interval: 30,

	        // Picker close behavior
	        closeOnSelect: true,
	        closeOnClear: true,

	        // Classes
	        klass: {

	            picker: prefix + ' ' + prefix + '--time',
	            holder: prefix + '__holder',

	            list: prefix + '__list',
	            listItem: prefix + '__list-item',

	            disabled: prefix + '__list-item--disabled',
	            selected: prefix + '__list-item--selected',
	            highlighted: prefix + '__list-item--highlighted',
	            viewset: prefix + '__list-item--viewset',
	            now: prefix + '__list-item--now',

	            buttonClear: prefix + '__button--clear'
	        }
	    }
	})( Picker.klasses().picker )





	/**
	 * Extend the picker to add the time picker.
	 */
	Picker.extend( 'pickatime', TimePicker )


	}));





/***/ },

/***/ 523:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	__webpack_require__(524);

	__webpack_require__(525);

	__webpack_require__(526);

	__webpack_require__(527);

	__webpack_require__(528);

	__webpack_require__(529);

	__webpack_require__(530);

	__webpack_require__(531);

	__webpack_require__(532);

	__webpack_require__(533);

	__webpack_require__(534);

	__webpack_require__(535);

	__webpack_require__(536);

	__webpack_require__(537);

	__webpack_require__(538);

	__webpack_require__(9);

	__webpack_require__(10);

	__webpack_require__(11);

	__webpack_require__(12);


/***/ },

/***/ 524:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_0__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_1__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * imagesLoaded PACKAGED v3.1.8
	 * JavaScript is all like "You images are done yet or what?"
	 * MIT License
	 */


	/*!
	 * EventEmitter v4.2.6 - git.io/ee
	 * Oliver Caldwell
	 * MIT license
	 * @preserve
	 */

	(function () {
		

		/**
		 * Class for managing events.
		 * Can be extended to provide event functionality in other classes.
		 *
		 * @class EventEmitter Manages event registering and emitting.
		 */
		function EventEmitter() {}

		// Shortcuts to improve speed and size
		var proto = EventEmitter.prototype;
		var exports = this;
		var originalGlobalValue = exports.EventEmitter;

		/**
		 * Finds the index of the listener for the event in it's storage array.
		 *
		 * @param {Function[]} listeners Array of listeners to search through.
		 * @param {Function} listener Method to look for.
		 * @return {Number} Index of the specified listener, -1 if not found
		 * @api private
		 */
		function indexOfListener(listeners, listener) {
			var i = listeners.length;
			while (i--) {
				if (listeners[i].listener === listener) {
					return i;
				}
			}

			return -1;
		}

		/**
		 * Alias a method while keeping the context correct, to allow for overwriting of target method.
		 *
		 * @param {String} name The name of the target method.
		 * @return {Function} The aliased method
		 * @api private
		 */
		function alias(name) {
			return function aliasClosure() {
				return this[name].apply(this, arguments);
			};
		}

		/**
		 * Returns the listener array for the specified event.
		 * Will initialise the event object and listener arrays if required.
		 * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
		 * Each property in the object response is an array of listener functions.
		 *
		 * @param {String|RegExp} evt Name of the event to return the listeners from.
		 * @return {Function[]|Object} All listener functions for the event.
		 */
		proto.getListeners = function getListeners(evt) {
			var events = this._getEvents();
			var response;
			var key;

			// Return a concatenated array of all matching events if
			// the selector is a regular expression.
			if (typeof evt === 'object') {
				response = {};
				for (key in events) {
					if (events.hasOwnProperty(key) && evt.test(key)) {
						response[key] = events[key];
					}
				}
			}
			else {
				response = events[evt] || (events[evt] = []);
			}

			return response;
		};

		/**
		 * Takes a list of listener objects and flattens it into a list of listener functions.
		 *
		 * @param {Object[]} listeners Raw listener objects.
		 * @return {Function[]} Just the listener functions.
		 */
		proto.flattenListeners = function flattenListeners(listeners) {
			var flatListeners = [];
			var i;

			for (i = 0; i < listeners.length; i += 1) {
				flatListeners.push(listeners[i].listener);
			}

			return flatListeners;
		};

		/**
		 * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
		 *
		 * @param {String|RegExp} evt Name of the event to return the listeners from.
		 * @return {Object} All listener functions for an event in an object.
		 */
		proto.getListenersAsObject = function getListenersAsObject(evt) {
			var listeners = this.getListeners(evt);
			var response;

			if (listeners instanceof Array) {
				response = {};
				response[evt] = listeners;
			}

			return response || listeners;
		};

		/**
		 * Adds a listener function to the specified event.
		 * The listener will not be added if it is a duplicate.
		 * If the listener returns true then it will be removed after it is called.
		 * If you pass a regular expression as the event name then the listener will be added to all events that match it.
		 *
		 * @param {String|RegExp} evt Name of the event to attach the listener to.
		 * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.addListener = function addListener(evt, listener) {
			var listeners = this.getListenersAsObject(evt);
			var listenerIsWrapped = typeof listener === 'object';
			var key;

			for (key in listeners) {
				if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
					listeners[key].push(listenerIsWrapped ? listener : {
						listener: listener,
						once: false
					});
				}
			}

			return this;
		};

		/**
		 * Alias of addListener
		 */
		proto.on = alias('addListener');

		/**
		 * Semi-alias of addListener. It will add a listener that will be
		 * automatically removed after it's first execution.
		 *
		 * @param {String|RegExp} evt Name of the event to attach the listener to.
		 * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.addOnceListener = function addOnceListener(evt, listener) {
			return this.addListener(evt, {
				listener: listener,
				once: true
			});
		};

		/**
		 * Alias of addOnceListener.
		 */
		proto.once = alias('addOnceListener');

		/**
		 * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
		 * You need to tell it what event names should be matched by a regex.
		 *
		 * @param {String} evt Name of the event to create.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.defineEvent = function defineEvent(evt) {
			this.getListeners(evt);
			return this;
		};

		/**
		 * Uses defineEvent to define multiple events.
		 *
		 * @param {String[]} evts An array of event names to define.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.defineEvents = function defineEvents(evts) {
			for (var i = 0; i < evts.length; i += 1) {
				this.defineEvent(evts[i]);
			}
			return this;
		};

		/**
		 * Removes a listener function from the specified event.
		 * When passed a regular expression as the event name, it will remove the listener from all events that match it.
		 *
		 * @param {String|RegExp} evt Name of the event to remove the listener from.
		 * @param {Function} listener Method to remove from the event.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.removeListener = function removeListener(evt, listener) {
			var listeners = this.getListenersAsObject(evt);
			var index;
			var key;

			for (key in listeners) {
				if (listeners.hasOwnProperty(key)) {
					index = indexOfListener(listeners[key], listener);

					if (index !== -1) {
						listeners[key].splice(index, 1);
					}
				}
			}

			return this;
		};

		/**
		 * Alias of removeListener
		 */
		proto.off = alias('removeListener');

		/**
		 * Adds listeners in bulk using the manipulateListeners method.
		 * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
		 * You can also pass it a regular expression to add the array of listeners to all events that match it.
		 * Yeah, this function does quite a bit. That's probably a bad thing.
		 *
		 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
		 * @param {Function[]} [listeners] An optional array of listener functions to add.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.addListeners = function addListeners(evt, listeners) {
			// Pass through to manipulateListeners
			return this.manipulateListeners(false, evt, listeners);
		};

		/**
		 * Removes listeners in bulk using the manipulateListeners method.
		 * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
		 * You can also pass it an event name and an array of listeners to be removed.
		 * You can also pass it a regular expression to remove the listeners from all events that match it.
		 *
		 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
		 * @param {Function[]} [listeners] An optional array of listener functions to remove.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.removeListeners = function removeListeners(evt, listeners) {
			// Pass through to manipulateListeners
			return this.manipulateListeners(true, evt, listeners);
		};

		/**
		 * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
		 * The first argument will determine if the listeners are removed (true) or added (false).
		 * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
		 * You can also pass it an event name and an array of listeners to be added/removed.
		 * You can also pass it a regular expression to manipulate the listeners of all events that match it.
		 *
		 * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
		 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
		 * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
			var i;
			var value;
			var single = remove ? this.removeListener : this.addListener;
			var multiple = remove ? this.removeListeners : this.addListeners;

			// If evt is an object then pass each of it's properties to this method
			if (typeof evt === 'object' && !(evt instanceof RegExp)) {
				for (i in evt) {
					if (evt.hasOwnProperty(i) && (value = evt[i])) {
						// Pass the single listener straight through to the singular method
						if (typeof value === 'function') {
							single.call(this, i, value);
						}
						else {
							// Otherwise pass back to the multiple function
							multiple.call(this, i, value);
						}
					}
				}
			}
			else {
				// So evt must be a string
				// And listeners must be an array of listeners
				// Loop over it and pass each one to the multiple method
				i = listeners.length;
				while (i--) {
					single.call(this, evt, listeners[i]);
				}
			}

			return this;
		};

		/**
		 * Removes all listeners from a specified event.
		 * If you do not specify an event then all listeners will be removed.
		 * That means every event will be emptied.
		 * You can also pass a regex to remove all events that match it.
		 *
		 * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.removeEvent = function removeEvent(evt) {
			var type = typeof evt;
			var events = this._getEvents();
			var key;

			// Remove different things depending on the state of evt
			if (type === 'string') {
				// Remove all listeners for the specified event
				delete events[evt];
			}
			else if (type === 'object') {
				// Remove all events matching the regex.
				for (key in events) {
					if (events.hasOwnProperty(key) && evt.test(key)) {
						delete events[key];
					}
				}
			}
			else {
				// Remove all listeners in all events
				delete this._events;
			}

			return this;
		};

		/**
		 * Alias of removeEvent.
		 *
		 * Added to mirror the node API.
		 */
		proto.removeAllListeners = alias('removeEvent');

		/**
		 * Emits an event of your choice.
		 * When emitted, every listener attached to that event will be executed.
		 * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
		 * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
		 * So they will not arrive within the array on the other side, they will be separate.
		 * You can also pass a regular expression to emit to all events that match it.
		 *
		 * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
		 * @param {Array} [args] Optional array of arguments to be passed to each listener.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.emitEvent = function emitEvent(evt, args) {
			var listeners = this.getListenersAsObject(evt);
			var listener;
			var i;
			var key;
			var response;

			for (key in listeners) {
				if (listeners.hasOwnProperty(key)) {
					i = listeners[key].length;

					while (i--) {
						// If the listener returns true then it shall be removed from the event
						// The function is executed either with a basic call or an apply if there is an args array
						listener = listeners[key][i];

						if (listener.once === true) {
							this.removeListener(evt, listener.listener);
						}

						response = listener.listener.apply(this, args || []);

						if (response === this._getOnceReturnValue()) {
							this.removeListener(evt, listener.listener);
						}
					}
				}
			}

			return this;
		};

		/**
		 * Alias of emitEvent
		 */
		proto.trigger = alias('emitEvent');

		/**
		 * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
		 * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
		 *
		 * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
		 * @param {...*} Optional additional arguments to be passed to each listener.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.emit = function emit(evt) {
			var args = Array.prototype.slice.call(arguments, 1);
			return this.emitEvent(evt, args);
		};

		/**
		 * Sets the current value to check against when executing listeners. If a
		 * listeners return value matches the one set here then it will be removed
		 * after execution. This value defaults to true.
		 *
		 * @param {*} value The new value to check for when executing listeners.
		 * @return {Object} Current instance of EventEmitter for chaining.
		 */
		proto.setOnceReturnValue = function setOnceReturnValue(value) {
			this._onceReturnValue = value;
			return this;
		};

		/**
		 * Fetches the current value to check against when executing listeners. If
		 * the listeners return value matches this one then it should be removed
		 * automatically. It will return true by default.
		 *
		 * @return {*|Boolean} The current value to check for or the default, true.
		 * @api private
		 */
		proto._getOnceReturnValue = function _getOnceReturnValue() {
			if (this.hasOwnProperty('_onceReturnValue')) {
				return this._onceReturnValue;
			}
			else {
				return true;
			}
		};

		/**
		 * Fetches the events object and creates one if required.
		 *
		 * @return {Object} The events storage object.
		 * @api private
		 */
		proto._getEvents = function _getEvents() {
			return this._events || (this._events = {});
		};

		/**
		 * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
		 *
		 * @return {Function} Non conflicting EventEmitter class.
		 */
		EventEmitter.noConflict = function noConflict() {
			exports.EventEmitter = originalGlobalValue;
			return EventEmitter;
		};

		// Expose the class either via AMD, CommonJS or the global object
		if (true) {
			!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_LOCAL_MODULE_0__ = (function () {
				return EventEmitter;
			}.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
		}
		else if (typeof module === 'object' && module.exports){
			module.exports = EventEmitter;
		}
		else {
			this.EventEmitter = EventEmitter;
		}
	}.call(this));

	/*!
	 * eventie v1.0.4
	 * event binding helper
	 *   eventie.bind( elem, 'click', myFn )
	 *   eventie.unbind( elem, 'click', myFn )
	 */

	/*jshint browser: true, undef: true, unused: true */
	/*global define: false */

	( function( window ) {



	var docElem = document.documentElement;

	var bind = function() {};

	function getIEEvent( obj ) {
	  var event = window.event;
	  // add event.target
	  event.target = event.target || event.srcElement || obj;
	  return event;
	}

	if ( docElem.addEventListener ) {
	  bind = function( obj, type, fn ) {
	    obj.addEventListener( type, fn, false );
	  };
	} else if ( docElem.attachEvent ) {
	  bind = function( obj, type, fn ) {
	    obj[ type + fn ] = fn.handleEvent ?
	      function() {
	        var event = getIEEvent( obj );
	        fn.handleEvent.call( fn, event );
	      } :
	      function() {
	        var event = getIEEvent( obj );
	        fn.call( obj, event );
	      };
	    obj.attachEvent( "on" + type, obj[ type + fn ] );
	  };
	}

	var unbind = function() {};

	if ( docElem.removeEventListener ) {
	  unbind = function( obj, type, fn ) {
	    obj.removeEventListener( type, fn, false );
	  };
	} else if ( docElem.detachEvent ) {
	  unbind = function( obj, type, fn ) {
	    obj.detachEvent( "on" + type, obj[ type + fn ] );
	    try {
	      delete obj[ type + fn ];
	    } catch ( err ) {
	      // can't delete window object properties
	      obj[ type + fn ] = undefined;
	    }
	  };
	}

	var eventie = {
	  bind: bind,
	  unbind: unbind
	};

	// transport
	if ( true ) {
	  // AMD
	  !(__WEBPACK_AMD_DEFINE_FACTORY__ = (eventie), __WEBPACK_LOCAL_MODULE_1__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	} else {
	  // browser global
	  window.eventie = eventie;
	}

	})( this );

	/*!
	 * imagesLoaded v3.1.8
	 * JavaScript is all like "You images are done yet or what?"
	 * MIT License
	 */

	( function( window, factory ) { 
	  // universal module definition

	  /*global define: false, module: false, require: false */

	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	      __WEBPACK_LOCAL_MODULE_0__,
	      __WEBPACK_LOCAL_MODULE_1__
	    ], __WEBPACK_AMD_DEFINE_RESULT__ = function( EventEmitter, eventie ) {
	      return factory( window, EventEmitter, eventie );
	    }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	  } else if ( typeof exports === 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      window,
	      require('wolfy87-eventemitter'),
	      require('eventie')
	    );
	  } else {
	    // browser global
	    window.imagesLoaded = factory(
	      window,
	      window.EventEmitter,
	      window.eventie
	    );
	  }

	})( window,

	// --------------------------  factory -------------------------- //

	function factory( window, EventEmitter, eventie ) {



	var $ = window.jQuery;
	var console = window.console;
	var hasConsole = typeof console !== 'undefined';

	// -------------------------- helpers -------------------------- //

	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}

	var objToString = Object.prototype.toString;
	function isArray( obj ) {
	  return objToString.call( obj ) === '[object Array]';
	}

	// turn element or nodeList into an array
	function makeArray( obj ) {
	  var ary = [];
	  if ( isArray( obj ) ) {
	    // use object if already an array
	    ary = obj;
	  } else if ( typeof obj.length === 'number' ) {
	    // convert nodeList to array
	    for ( var i=0, len = obj.length; i < len; i++ ) {
	      ary.push( obj[i] );
	    }
	  } else {
	    // array of single index
	    ary.push( obj );
	  }
	  return ary;
	}

	  // -------------------------- imagesLoaded -------------------------- //

	  /**
	   * @param {Array, Element, NodeList, String} elem
	   * @param {Object or Function} options - if function, use as callback
	   * @param {Function} onAlways - callback function
	   */
	  function ImagesLoaded( elem, options, onAlways ) {
	    // coerce ImagesLoaded() without new, to be new ImagesLoaded()
	    if ( !( this instanceof ImagesLoaded ) ) {
	      return new ImagesLoaded( elem, options );
	    }
	    // use elem as selector string
	    if ( typeof elem === 'string' ) {
	      elem = document.querySelectorAll( elem );
	    }

	    this.elements = makeArray( elem );
	    this.options = extend( {}, this.options );

	    if ( typeof options === 'function' ) {
	      onAlways = options;
	    } else {
	      extend( this.options, options );
	    }

	    if ( onAlways ) {
	      this.on( 'always', onAlways );
	    }

	    this.getImages();

	    if ( $ ) {
	      // add jQuery Deferred object
	      this.jqDeferred = new $.Deferred();
	    }

	    // HACK check async to allow time to bind listeners
	    var _this = this;
	    setTimeout( function() {
	      _this.check();
	    });
	  }

	  ImagesLoaded.prototype = new EventEmitter();

	  ImagesLoaded.prototype.options = {};

	  ImagesLoaded.prototype.getImages = function() {
	    this.images = [];

	    // filter & find items if we have an item selector
	    for ( var i=0, len = this.elements.length; i < len; i++ ) {
	      var elem = this.elements[i];
	      // filter siblings
	      if ( elem.nodeName === 'IMG' ) {
	        this.addImage( elem );
	      }
	      // find children
	      // no non-element nodes, #143
	      var nodeType = elem.nodeType;
	      if ( !nodeType || !( nodeType === 1 || nodeType === 9 || nodeType === 11 ) ) {
	        continue;
	      }
	      var childElems = elem.querySelectorAll('img');
	      // concat childElems to filterFound array
	      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
	        var img = childElems[j];
	        this.addImage( img );
	      }
	    }
	  };

	  /**
	   * @param {Image} img
	   */
	  ImagesLoaded.prototype.addImage = function( img ) {
	    var loadingImage = new LoadingImage( img );
	    this.images.push( loadingImage );
	  };

	  ImagesLoaded.prototype.check = function() {
	    var _this = this;
	    var checkedCount = 0;
	    var length = this.images.length;
	    this.hasAnyBroken = false;
	    // complete if no images
	    if ( !length ) {
	      this.complete();
	      return;
	    }

	    function onConfirm( image, message ) {
	      if ( _this.options.debug && hasConsole ) {
	        console.log( 'confirm', image, message );
	      }

	      _this.progress( image );
	      checkedCount++;
	      if ( checkedCount === length ) {
	        _this.complete();
	      }
	      return true; // bind once
	    }

	    for ( var i=0; i < length; i++ ) {
	      var loadingImage = this.images[i];
	      loadingImage.on( 'confirm', onConfirm );
	      loadingImage.check();
	    }
	  };

	  ImagesLoaded.prototype.progress = function( image ) {
	    this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
	    // HACK - Chrome triggers event before object properties have changed. #83
	    var _this = this;
	    setTimeout( function() {
	      _this.emit( 'progress', _this, image );
	      if ( _this.jqDeferred && _this.jqDeferred.notify ) {
	        _this.jqDeferred.notify( _this, image );
	      }
	    });
	  };

	  ImagesLoaded.prototype.complete = function() {
	    var eventName = this.hasAnyBroken ? 'fail' : 'done';
	    this.isComplete = true;
	    var _this = this;
	    // HACK - another setTimeout so that confirm happens after progress
	    setTimeout( function() {
	      _this.emit( eventName, _this );
	      _this.emit( 'always', _this );
	      if ( _this.jqDeferred ) {
	        var jqMethod = _this.hasAnyBroken ? 'reject' : 'resolve';
	        _this.jqDeferred[ jqMethod ]( _this );
	      }
	    });
	  };

	  // -------------------------- jquery -------------------------- //

	  if ( $ ) {
	    $.fn.imagesLoaded = function( options, callback ) {
	      var instance = new ImagesLoaded( this, options, callback );
	      return instance.jqDeferred.promise( $(this) );
	    };
	  }


	  // --------------------------  -------------------------- //

	  function LoadingImage( img ) {
	    this.img = img;
	  }

	  LoadingImage.prototype = new EventEmitter();

	  LoadingImage.prototype.check = function() {
	    // first check cached any previous images that have same src
	    var resource = cache[ this.img.src ] || new Resource( this.img.src );
	    if ( resource.isConfirmed ) {
	      this.confirm( resource.isLoaded, 'cached was confirmed' );
	      return;
	    }

	    // If complete is true and browser supports natural sizes,
	    // try to check for image status manually.
	    if ( this.img.complete && this.img.naturalWidth !== undefined ) {
	      // report based on naturalWidth
	      this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
	      return;
	    }

	    // If none of the checks above matched, simulate loading on detached element.
	    var _this = this;
	    resource.on( 'confirm', function( resrc, message ) {
	      _this.confirm( resrc.isLoaded, message );
	      return true;
	    });

	    resource.check();
	  };

	  LoadingImage.prototype.confirm = function( isLoaded, message ) {
	    this.isLoaded = isLoaded;
	    this.emit( 'confirm', this, message );
	  };

	  // -------------------------- Resource -------------------------- //

	  // Resource checks each src, only once
	  // separate class from LoadingImage to prevent memory leaks. See #115

	  var cache = {};

	  function Resource( src ) {
	    this.src = src;
	    // add to cache
	    cache[ src ] = this;
	  }

	  Resource.prototype = new EventEmitter();

	  Resource.prototype.check = function() {
	    // only trigger checking once
	    if ( this.isChecked ) {
	      return;
	    }
	    // simulate loading on detached element
	    var proxyImage = new Image();
	    eventie.bind( proxyImage, 'load', this );
	    eventie.bind( proxyImage, 'error', this );
	    proxyImage.src = this.src;
	    // set flag
	    this.isChecked = true;
	  };

	  // ----- events ----- //

	  // trigger specified handler for event type
	  Resource.prototype.handleEvent = function( event ) {
	    var method = 'on' + event.type;
	    if ( this[ method ] ) {
	      this[ method ]( event );
	    }
	  };

	  Resource.prototype.onload = function( event ) {
	    this.confirm( true, 'onload' );
	    this.unbindProxyEvents( event );
	  };

	  Resource.prototype.onerror = function( event ) {
	    this.confirm( false, 'onerror' );
	    this.unbindProxyEvents( event );
	  };

	  // ----- confirm ----- //

	  Resource.prototype.confirm = function( isLoaded, message ) {
	    this.isConfirmed = true;
	    this.isLoaded = isLoaded;
	    this.emit( 'confirm', this, message );
	  };

	  Resource.prototype.unbindProxyEvents = function( event ) {
	    eventie.unbind( event.target, 'load', this );
	    eventie.unbind( event.target, 'error', this );
	  };

	  // -----  ----- //

	  return ImagesLoaded;

	});


/***/ },

/***/ 525:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * jQuery Mousewheel 3.1.13
	 *
	 * Copyright jQuery Foundation and other contributors
	 * Released under the MIT license
	 * http://jquery.org/license
	 */

	(function (factory) {
	    if ( true ) {
	        // AMD. Register as an anonymous module.
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(6)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	    } else if (typeof exports === 'object') {
	        // Node/CommonJS style for Browserify
	        module.exports = factory;
	    } else {
	        // Browser globals
	        factory(jQuery);
	    }
	}(function ($) {

	    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
	        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
	                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
	        slice  = Array.prototype.slice,
	        nullLowestDeltaTimeout, lowestDelta;

	    if ( $.event.fixHooks ) {
	        for ( var i = toFix.length; i; ) {
	            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
	        }
	    }

	    var special = $.event.special.mousewheel = {
	        version: '3.1.12',

	        setup: function() {
	            if ( this.addEventListener ) {
	                for ( var i = toBind.length; i; ) {
	                    this.addEventListener( toBind[--i], handler, false );
	                }
	            } else {
	                this.onmousewheel = handler;
	            }
	            // Store the line height and page height for this particular element
	            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
	            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
	        },

	        teardown: function() {
	            if ( this.removeEventListener ) {
	                for ( var i = toBind.length; i; ) {
	                    this.removeEventListener( toBind[--i], handler, false );
	                }
	            } else {
	                this.onmousewheel = null;
	            }
	            // Clean up the data we added to the element
	            $.removeData(this, 'mousewheel-line-height');
	            $.removeData(this, 'mousewheel-page-height');
	        },

	        getLineHeight: function(elem) {
	            var $elem = $(elem),
	                $parent = $elem['offsetParent' in $.fn ? 'offsetParent' : 'parent']();
	            if (!$parent.length) {
	                $parent = $('body');
	            }
	            return parseInt($parent.css('fontSize'), 10) || parseInt($elem.css('fontSize'), 10) || 16;
	        },

	        getPageHeight: function(elem) {
	            return $(elem).height();
	        },

	        settings: {
	            adjustOldDeltas: true, // see shouldAdjustOldDeltas() below
	            normalizeOffset: true  // calls getBoundingClientRect for each event
	        }
	    };

	    $.fn.extend({
	        mousewheel: function(fn) {
	            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
	        },

	        unmousewheel: function(fn) {
	            return this.unbind('mousewheel', fn);
	        }
	    });


	    function handler(event) {
	        var orgEvent   = event || window.event,
	            args       = slice.call(arguments, 1),
	            delta      = 0,
	            deltaX     = 0,
	            deltaY     = 0,
	            absDelta   = 0,
	            offsetX    = 0,
	            offsetY    = 0;
	        event = $.event.fix(orgEvent);
	        event.type = 'mousewheel';

	        // Old school scrollwheel delta
	        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
	        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
	        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
	        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

	        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
	        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
	            deltaX = deltaY * -1;
	            deltaY = 0;
	        }

	        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
	        delta = deltaY === 0 ? deltaX : deltaY;

	        // New school wheel delta (wheel event)
	        if ( 'deltaY' in orgEvent ) {
	            deltaY = orgEvent.deltaY * -1;
	            delta  = deltaY;
	        }
	        if ( 'deltaX' in orgEvent ) {
	            deltaX = orgEvent.deltaX;
	            if ( deltaY === 0 ) { delta  = deltaX * -1; }
	        }

	        // No change actually happened, no reason to go any further
	        if ( deltaY === 0 && deltaX === 0 ) { return; }

	        // Need to convert lines and pages to pixels if we aren't already in pixels
	        // There are three delta modes:
	        //   * deltaMode 0 is by pixels, nothing to do
	        //   * deltaMode 1 is by lines
	        //   * deltaMode 2 is by pages
	        if ( orgEvent.deltaMode === 1 ) {
	            var lineHeight = $.data(this, 'mousewheel-line-height');
	            delta  *= lineHeight;
	            deltaY *= lineHeight;
	            deltaX *= lineHeight;
	        } else if ( orgEvent.deltaMode === 2 ) {
	            var pageHeight = $.data(this, 'mousewheel-page-height');
	            delta  *= pageHeight;
	            deltaY *= pageHeight;
	            deltaX *= pageHeight;
	        }

	        // Store lowest absolute delta to normalize the delta values
	        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

	        if ( !lowestDelta || absDelta < lowestDelta ) {
	            lowestDelta = absDelta;

	            // Adjust older deltas if necessary
	            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
	                lowestDelta /= 40;
	            }
	        }

	        // Adjust older deltas if necessary
	        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
	            // Divide all the things by 40!
	            delta  /= 40;
	            deltaX /= 40;
	            deltaY /= 40;
	        }

	        // Get a whole, normalized value for the deltas
	        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
	        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
	        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

	        // Normalise offsetX and offsetY properties
	        if ( special.settings.normalizeOffset && this.getBoundingClientRect ) {
	            var boundingRect = this.getBoundingClientRect();
	            offsetX = event.clientX - boundingRect.left;
	            offsetY = event.clientY - boundingRect.top;
	        }

	        // Add information to the event object
	        event.deltaX = deltaX;
	        event.deltaY = deltaY;
	        event.deltaFactor = lowestDelta;
	        event.offsetX = offsetX;
	        event.offsetY = offsetY;
	        // Go ahead and set deltaMode to 0 since we converted to pixels
	        // Although this is a little odd since we overwrite the deltaX/Y
	        // properties with normalized deltas.
	        event.deltaMode = 0;

	        // Add event and delta to the front of the arguments
	        args.unshift(event, delta, deltaX, deltaY);

	        // Clearout lowestDelta after sometime to better
	        // handle multiple device types that give different
	        // a different lowestDelta
	        // Ex: trackpad = 3 and mouse wheel = 120
	        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
	        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

	        return ($.event.dispatch || $.event.handle).apply(this, args);
	    }

	    function nullLowestDelta() {
	        lowestDelta = null;
	    }

	    function shouldAdjustOldDeltas(orgEvent, absDelta) {
	        // If this is an older event and the delta is divisable by 120,
	        // then we are assuming that the browser is treating this as an
	        // older mouse wheel event and that we should divide the deltas
	        // by 40 to try and get a more usable deltaFactor.
	        // Side note, this actually impacts the reported scroll distance
	        // in older browsers and can cause scrolling to be slower than native.
	        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
	        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
	    }

	}));


/***/ },

/***/ 526:
/***/ function(module, exports) {

	/*
	 * jQuery Superfish Menu Plugin - v1.7.8
	 * Copyright (c) 2016 
	 *
	 * Dual licensed under the MIT and GPL licenses:
	 *	http://www.opensource.org/licenses/mit-license.php
	 *	http://www.gnu.org/licenses/gpl.html
	 */

	;(function ($, w) {
		"use strict";

		var methods = (function () {
			// private properties and methods go here
			var c = {
					bcClass: 'sf-breadcrumb',
					menuClass: 'sf-js-enabled',
					anchorClass: 'sf-with-ul',
					menuArrowClass: 'sf-arrows'
				},
				ios = (function () {
					var ios = /^(?![\w\W]*Windows Phone)[\w\W]*(iPhone|iPad|iPod)/i.test(navigator.userAgent);
					if (ios) {
						// tap anywhere on iOS to unfocus a submenu
						$('html').css('cursor', 'pointer').on('click', $.noop);
					}
					return ios;
				})(),
				wp7 = (function () {
					var style = document.documentElement.style;
					return ('behavior' in style && 'fill' in style && /iemobile/i.test(navigator.userAgent));
				})(),
				unprefixedPointerEvents = (function () {
					return (!!w.PointerEvent);
				})(),
				toggleMenuClasses = function ($menu, o) {
					var classes = c.menuClass;
					if (o.cssArrows) {
						classes += ' ' + c.menuArrowClass;
					}
					$menu.toggleClass(classes);
				},
				setPathToCurrent = function ($menu, o) {
					return $menu.find('li.' + o.pathClass).slice(0, o.pathLevels)
						.addClass(o.hoverClass + ' ' + c.bcClass)
							.filter(function () {
								return ($(this).children(o.popUpSelector).hide().show().length);
							}).removeClass(o.pathClass);
				},
				toggleAnchorClass = function ($li) {
					$li.children('a').toggleClass(c.anchorClass);
				},
				toggleTouchAction = function ($menu) {
					var msTouchAction = $menu.css('ms-touch-action');
					var touchAction = $menu.css('touch-action');
					touchAction = touchAction || msTouchAction;
					touchAction = (touchAction === 'pan-y') ? 'auto' : 'pan-y';
					$menu.css({
						'ms-touch-action': touchAction,
						'touch-action': touchAction
					});
				},
				getMenu = function ($el) {
					return $el.closest('.' + c.menuClass);
				},
				getOptions = function ($el) {
					return getMenu($el).data('sf-options');
				},
				over = function () {
					var $this = $(this),
						o = getOptions($this);
					clearTimeout(o.sfTimer);
					$this.siblings().superfish('hide').end().superfish('show');
				},
				close = function (o) {
					o.retainPath = ($.inArray(this[0], o.$path) > -1);
					this.superfish('hide');

					if (!this.parents('.' + o.hoverClass).length) {
						o.onIdle.call(getMenu(this));
						if (o.$path.length) {
							$.proxy(over, o.$path)();
						}
					}
				},
				out = function () {
					var $this = $(this),
						o = getOptions($this);
					if (ios) {
						$.proxy(close, $this, o)();
					}
					else {
						clearTimeout(o.sfTimer);
						o.sfTimer = setTimeout($.proxy(close, $this, o), o.delay);
					}
				},
				touchHandler = function (e) {
					var $this = $(this),
						o = getOptions($this),
						$ul = $this.siblings(e.data.popUpSelector);

					if (o.onHandleTouch.call($ul) === false) {
						return this;
					}

					if ($ul.length > 0 && $ul.is(':hidden')) {
						$this.one('click.superfish', false);
						if (e.type === 'MSPointerDown' || e.type === 'pointerdown') {
							$this.trigger('focus');
						} else {
							$.proxy(over, $this.parent('li'))();
						}
					}
				},
				applyHandlers = function ($menu, o) {
					var targets = 'li:has(' + o.popUpSelector + ')';
					if ($.fn.hoverIntent && !o.disableHI) {
						$menu.hoverIntent(over, out, targets);
					}
					else {
						$menu
							.on('mouseenter.superfish', targets, over)
							.on('mouseleave.superfish', targets, out);
					}
					var touchevent = 'MSPointerDown.superfish';
					if (unprefixedPointerEvents) {
						touchevent = 'pointerdown.superfish';
					}
					if (!ios) {
						touchevent += ' touchend.superfish';
					}
					if (wp7) {
						touchevent += ' mousedown.superfish';
					}
					$menu
						.on('focusin.superfish', 'li', over)
						.on('focusout.superfish', 'li', out)
						.on(touchevent, 'a', o, touchHandler);
				};

			return {
				// public methods
				hide: function (instant) {
					if (this.length) {
						var $this = this,
							o = getOptions($this);
						if (!o) {
							return this;
						}
						var not = (o.retainPath === true) ? o.$path : '',
							$ul = $this.find('li.' + o.hoverClass).add(this).not(not).removeClass(o.hoverClass).children(o.popUpSelector),
							speed = o.speedOut;

						if (instant) {
							$ul.show();
							speed = 0;
						}
						o.retainPath = false;

						if (o.onBeforeHide.call($ul) === false) {
							return this;
						}

						$ul.stop(true, true).animate(o.animationOut, speed, function () {
							var $this = $(this);
							o.onHide.call($this);
						});
					}
					return this;
				},
				show: function () {
					var o = getOptions(this);
					if (!o) {
						return this;
					}
					var $this = this.addClass(o.hoverClass),
						$ul = $this.children(o.popUpSelector);

					if (o.onBeforeShow.call($ul) === false) {
						return this;
					}

					$ul.stop(true, true).animate(o.animation, o.speed, function () {
						o.onShow.call($ul);
					});
					return this;
				},
				destroy: function () {
					return this.each(function () {
						var $this = $(this),
							o = $this.data('sf-options'),
							$hasPopUp;
						if (!o) {
							return false;
						}
						$hasPopUp = $this.find(o.popUpSelector).parent('li');
						clearTimeout(o.sfTimer);
						toggleMenuClasses($this, o);
						toggleAnchorClass($hasPopUp);
						toggleTouchAction($this);
						// remove event handlers
						$this.off('.superfish').off('.hoverIntent');
						// clear animation's inline display style
						$hasPopUp.children(o.popUpSelector).attr('style', function (i, style) {
							return style.replace(/display[^;]+;?/g, '');
						});
						// reset 'current' path classes
						o.$path.removeClass(o.hoverClass + ' ' + c.bcClass).addClass(o.pathClass);
						$this.find('.' + o.hoverClass).removeClass(o.hoverClass);
						o.onDestroy.call($this);
						$this.removeData('sf-options');
					});
				},
				init: function (op) {
					return this.each(function () {
						var $this = $(this);
						if ($this.data('sf-options')) {
							return false;
						}
						var o = $.extend({}, $.fn.superfish.defaults, op),
							$hasPopUp = $this.find(o.popUpSelector).parent('li');
						o.$path = setPathToCurrent($this, o);

						$this.data('sf-options', o);

						toggleMenuClasses($this, o);
						toggleAnchorClass($hasPopUp);
						toggleTouchAction($this);
						applyHandlers($this, o);

						$hasPopUp.not('.' + c.bcClass).superfish('hide', true);

						o.onInit.call(this);
					});
				}
			};
		})();

		$.fn.superfish = function (method, args) {
			if (methods[method]) {
				return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
			}
			else if (typeof method === 'object' || ! method) {
				return methods.init.apply(this, arguments);
			}
			else {
				return $.error('Method ' +  method + ' does not exist on jQuery.fn.superfish');
			}
		};

		$.fn.superfish.defaults = {
			popUpSelector: 'ul,.sf-mega', // within menu context
			hoverClass: 'sfHover',
			pathClass: 'overrideThisToUse',
			pathLevels: 1,
			delay: 800,
			animation: {opacity: 'show'},
			animationOut: {opacity: 'hide'},
			speed: 'normal',
			speedOut: 'fast',
			cssArrows: true,
			disableHI: false,
			onInit: $.noop,
			onBeforeShow: $.noop,
			onShow: $.noop,
			onBeforeHide: $.noop,
			onHide: $.noop,
			onIdle: $.noop,
			onDestroy: $.noop,
			onHandleTouch: $.noop
		};

	})(jQuery, window);


/***/ },

/***/ 527:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/**!
	 * easy-pie-chart
	 * Lightweight plugin to render simple, animated and retina optimized pie charts
	 *
	 * @license 
	 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
	 * @version 2.1.7
	 **/

	(function (root, factory) {
	  if (true) {
	    // AMD. Register as an anonymous module unless amdModuleId is set
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(6)], __WEBPACK_AMD_DEFINE_RESULT__ = function (a0) {
	      return (factory(a0));
	    }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	  } else if (typeof exports === 'object') {
	    // Node. Does not work with strict CommonJS, but
	    // only CommonJS-like environments that support module.exports,
	    // like Node.
	    module.exports = factory(require("jquery"));
	  } else {
	    factory(jQuery);
	  }
	}(this, function ($) {

	/**
	 * Renderer to render the chart on a canvas object
	 * @param {DOMElement} el      DOM element to host the canvas (root of the plugin)
	 * @param {object}     options options object of the plugin
	 */
	var CanvasRenderer = function(el, options) {
		var cachedBackground;
		var canvas = document.createElement('canvas');

		el.appendChild(canvas);

		if (typeof(G_vmlCanvasManager) === 'object') {
			G_vmlCanvasManager.initElement(canvas);
		}

		var ctx = canvas.getContext('2d');

		canvas.width = canvas.height = options.size;

		// canvas on retina devices
		var scaleBy = 1;
		if (window.devicePixelRatio > 1) {
			scaleBy = window.devicePixelRatio;
			canvas.style.width = canvas.style.height = [options.size, 'px'].join('');
			canvas.width = canvas.height = options.size * scaleBy;
			ctx.scale(scaleBy, scaleBy);
		}

		// move 0,0 coordinates to the center
		ctx.translate(options.size / 2, options.size / 2);

		// rotate canvas -90deg
		ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI);

		var radius = (options.size - options.lineWidth) / 2;
		if (options.scaleColor && options.scaleLength) {
			radius -= options.scaleLength + 2; // 2 is the distance between scale and bar
		}

		// IE polyfill for Date
		Date.now = Date.now || function() {
			return +(new Date());
		};

		/**
		 * Draw a circle around the center of the canvas
		 * @param {strong} color     Valid CSS color string
		 * @param {number} lineWidth Width of the line in px
		 * @param {number} percent   Percentage to draw (float between -1 and 1)
		 */
		var drawCircle = function(color, lineWidth, percent) {
			percent = Math.min(Math.max(-1, percent || 0), 1);
			var isNegative = percent <= 0 ? true : false;

			ctx.beginPath();
			ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, isNegative);

			ctx.strokeStyle = color;
			ctx.lineWidth = lineWidth;

			ctx.stroke();
		};

		/**
		 * Draw the scale of the chart
		 */
		var drawScale = function() {
			var offset;
			var length;

			ctx.lineWidth = 1;
			ctx.fillStyle = options.scaleColor;

			ctx.save();
			for (var i = 24; i > 0; --i) {
				if (i % 6 === 0) {
					length = options.scaleLength;
					offset = 0;
				} else {
					length = options.scaleLength * 0.6;
					offset = options.scaleLength - length;
				}
				ctx.fillRect(-options.size/2 + offset, 0, length, 1);
				ctx.rotate(Math.PI / 12);
			}
			ctx.restore();
		};

		/**
		 * Request animation frame wrapper with polyfill
		 * @return {function} Request animation frame method or timeout fallback
		 */
		var reqAnimationFrame = (function() {
			return  window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					function(callback) {
						window.setTimeout(callback, 1000 / 60);
					};
		}());

		/**
		 * Draw the background of the plugin including the scale and the track
		 */
		var drawBackground = function() {
			if(options.scaleColor) drawScale();
			if(options.trackColor) drawCircle(options.trackColor, options.trackWidth || options.lineWidth, 1);
		};

	  /**
	    * Canvas accessor
	   */
	  this.getCanvas = function() {
	    return canvas;
	  };

	  /**
	    * Canvas 2D context 'ctx' accessor
	   */
	  this.getCtx = function() {
	    return ctx;
	  };

		/**
		 * Clear the complete canvas
		 */
		this.clear = function() {
			ctx.clearRect(options.size / -2, options.size / -2, options.size, options.size);
		};

		/**
		 * Draw the complete chart
		 * @param {number} percent Percent shown by the chart between -100 and 100
		 */
		this.draw = function(percent) {
			// do we need to render a background
			if (!!options.scaleColor || !!options.trackColor) {
				// getImageData and putImageData are supported
				if (ctx.getImageData && ctx.putImageData) {
					if (!cachedBackground) {
						drawBackground();
						cachedBackground = ctx.getImageData(0, 0, options.size * scaleBy, options.size * scaleBy);
					} else {
						ctx.putImageData(cachedBackground, 0, 0);
					}
				} else {
					this.clear();
					drawBackground();
				}
			} else {
				this.clear();
			}

			ctx.lineCap = options.lineCap;

			// if barcolor is a function execute it and pass the percent as a value
			var color;
			if (typeof(options.barColor) === 'function') {
				color = options.barColor(percent);
			} else {
				color = options.barColor;
			}

			// draw bar
			drawCircle(color, options.lineWidth, percent / 100);
		}.bind(this);

		/**
		 * Animate from some percent to some other percentage
		 * @param {number} from Starting percentage
		 * @param {number} to   Final percentage
		 */
		this.animate = function(from, to) {
			var startTime = Date.now();
			options.onStart(from, to);
			var animation = function() {
				var process = Math.min(Date.now() - startTime, options.animate.duration);
				var currentValue = options.easing(this, process, from, to - from, options.animate.duration);
				this.draw(currentValue);
				options.onStep(from, to, currentValue);
				if (process >= options.animate.duration) {
					options.onStop(from, to);
				} else {
					reqAnimationFrame(animation);
				}
			}.bind(this);

			reqAnimationFrame(animation);
		}.bind(this);
	};

	var EasyPieChart = function(el, opts) {
		var defaultOptions = {
			barColor: '#ef1e25',
			trackColor: '#f9f9f9',
			scaleColor: '#dfe0e0',
			scaleLength: 5,
			lineCap: 'round',
			lineWidth: 3,
			trackWidth: undefined,
			size: 110,
			rotate: 0,
			animate: {
				duration: 1000,
				enabled: true
			},
			easing: function (x, t, b, c, d) { // more can be found here: http://gsgd.co.uk/sandbox/jquery/easing/
				t = t / (d/2);
				if (t < 1) {
					return c / 2 * t * t + b;
				}
				return -c/2 * ((--t)*(t-2) - 1) + b;
			},
			onStart: function(from, to) {
				return;
			},
			onStep: function(from, to, currentValue) {
				return;
			},
			onStop: function(from, to) {
				return;
			}
		};

		// detect present renderer
		if (typeof(CanvasRenderer) !== 'undefined') {
			defaultOptions.renderer = CanvasRenderer;
		} else if (typeof(SVGRenderer) !== 'undefined') {
			defaultOptions.renderer = SVGRenderer;
		} else {
			throw new Error('Please load either the SVG- or the CanvasRenderer');
		}

		var options = {};
		var currentValue = 0;

		/**
		 * Initialize the plugin by creating the options object and initialize rendering
		 */
		var init = function() {
			this.el = el;
			this.options = options;

			// merge user options into default options
			for (var i in defaultOptions) {
				if (defaultOptions.hasOwnProperty(i)) {
					options[i] = opts && typeof(opts[i]) !== 'undefined' ? opts[i] : defaultOptions[i];
					if (typeof(options[i]) === 'function') {
						options[i] = options[i].bind(this);
					}
				}
			}

			// check for jQuery easing
			if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
				options.easing = jQuery.easing[options.easing];
			} else {
				options.easing = defaultOptions.easing;
			}

			// process earlier animate option to avoid bc breaks
			if (typeof(options.animate) === 'number') {
				options.animate = {
					duration: options.animate,
					enabled: true
				};
			}

			if (typeof(options.animate) === 'boolean' && !options.animate) {
				options.animate = {
					duration: 1000,
					enabled: options.animate
				};
			}

			// create renderer
			this.renderer = new options.renderer(el, options);

			// initial draw
			this.renderer.draw(currentValue);

			// initial update
			if (el.dataset && el.dataset.percent) {
				this.update(parseFloat(el.dataset.percent));
			} else if (el.getAttribute && el.getAttribute('data-percent')) {
				this.update(parseFloat(el.getAttribute('data-percent')));
			}
		}.bind(this);

		/**
		 * Update the value of the chart
		 * @param  {number} newValue Number between 0 and 100
		 * @return {object}          Instance of the plugin for method chaining
		 */
		this.update = function(newValue) {
			newValue = parseFloat(newValue);
			if (options.animate.enabled) {
				this.renderer.animate(currentValue, newValue);
			} else {
				this.renderer.draw(newValue);
			}
			currentValue = newValue;
			return this;
		}.bind(this);

		/**
		 * Disable animation
		 * @return {object} Instance of the plugin for method chaining
		 */
		this.disableAnimation = function() {
			options.animate.enabled = false;
			return this;
		};

		/**
		 * Enable animation
		 * @return {object} Instance of the plugin for method chaining
		 */
		this.enableAnimation = function() {
			options.animate.enabled = true;
			return this;
		};

		init();
	};

	$.fn.easyPieChart = function(options) {
		return this.each(function() {
			var instanceOptions;

			if (!$.data(this, 'easyPieChart')) {
				instanceOptions = $.extend({}, options, $(this).data());
				$.data(this, 'easyPieChart', new EasyPieChart(this, instanceOptions));
			}
		});
	};


	}));


/***/ },

/***/ 528:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*! VelocityJS.org (1.2.2). (C) 2014 Julian Shapiro. MIT @license: en.wikipedia.org/wiki/MIT_License */

	/*************************
	   Velocity jQuery Shim
	*************************/

	/*! VelocityJS.org jQuery Shim (1.0.1). (C) 2014 The jQuery Foundation. MIT @license: en.wikipedia.org/wiki/MIT_License. */

	/* This file contains the jQuery functions that Velocity relies on, thereby removing Velocity's dependency on a full copy of jQuery, and allowing it to work in any environment. */
	/* These shimmed functions are only used if jQuery isn't present. If both this shim and jQuery are loaded, Velocity defaults to jQuery proper. */
	/* Browser support: Using this shim instead of jQuery proper removes support for IE8. */

	;(function (window) {
	    /***************
	         Setup
	    ***************/

	    /* If jQuery is already loaded, there's no point in loading this shim. */
	    if (window.jQuery) {
	        return;
	    }

	    /* jQuery base. */
	    var $ = function (selector, context) {
	        return new $.fn.init(selector, context);
	    };

	    /********************
	       Private Methods
	    ********************/

	    /* jQuery */
	    $.isWindow = function (obj) {
	        /* jshint eqeqeq: false */
	        return obj != null && obj == obj.window;
	    };

	    /* jQuery */
	    $.type = function (obj) {
	        if (obj == null) {
	            return obj + "";
	        }

	        return typeof obj === "object" || typeof obj === "function" ?
	            class2type[toString.call(obj)] || "object" :
	            typeof obj;
	    };

	    /* jQuery */
	    $.isArray = Array.isArray || function (obj) {
	        return $.type(obj) === "array";
	    };

	    /* jQuery */
	    function isArraylike (obj) {
	        var length = obj.length,
	            type = $.type(obj);

	        if (type === "function" || $.isWindow(obj)) {
	            return false;
	        }

	        if (obj.nodeType === 1 && length) {
	            return true;
	        }

	        return type === "array" || length === 0 || typeof length === "number" && length > 0 && (length - 1) in obj;
	    }

	    /***************
	       $ Methods
	    ***************/

	    /* jQuery: Support removed for IE<9. */
	    $.isPlainObject = function (obj) {
	        var key;

	        if (!obj || $.type(obj) !== "object" || obj.nodeType || $.isWindow(obj)) {
	            return false;
	        }

	        try {
	            if (obj.constructor &&
	                !hasOwn.call(obj, "constructor") &&
	                !hasOwn.call(obj.constructor.prototype, "isPrototypeOf")) {
	                return false;
	            }
	        } catch (e) {
	            return false;
	        }

	        for (key in obj) {}

	        return key === undefined || hasOwn.call(obj, key);
	    };

	    /* jQuery */
	    $.each = function(obj, callback, args) {
	        var value,
	            i = 0,
	            length = obj.length,
	            isArray = isArraylike(obj);

	        if (args) {
	            if (isArray) {
	                for (; i < length; i++) {
	                    value = callback.apply(obj[i], args);

	                    if (value === false) {
	                        break;
	                    }
	                }
	            } else {
	                for (i in obj) {
	                    value = callback.apply(obj[i], args);

	                    if (value === false) {
	                        break;
	                    }
	                }
	            }

	        } else {
	            if (isArray) {
	                for (; i < length; i++) {
	                    value = callback.call(obj[i], i, obj[i]);

	                    if (value === false) {
	                        break;
	                    }
	                }
	            } else {
	                for (i in obj) {
	                    value = callback.call(obj[i], i, obj[i]);

	                    if (value === false) {
	                        break;
	                    }
	                }
	            }
	        }

	        return obj;
	    };

	    /* Custom */
	    $.data = function (node, key, value) {
	        /* $.getData() */
	        if (value === undefined) {
	            var id = node[$.expando],
	                store = id && cache[id];

	            if (key === undefined) {
	                return store;
	            } else if (store) {
	                if (key in store) {
	                    return store[key];
	                }
	            }
	        /* $.setData() */
	        } else if (key !== undefined) {
	            var id = node[$.expando] || (node[$.expando] = ++$.uuid);

	            cache[id] = cache[id] || {};
	            cache[id][key] = value;

	            return value;
	        }
	    };

	    /* Custom */
	    $.removeData = function (node, keys) {
	        var id = node[$.expando],
	            store = id && cache[id];

	        if (store) {
	            $.each(keys, function(_, key) {
	                delete store[key];
	            });
	        }
	    };

	    /* jQuery */
	    $.extend = function () {
	        var src, copyIsArray, copy, name, options, clone,
	            target = arguments[0] || {},
	            i = 1,
	            length = arguments.length,
	            deep = false;

	        if (typeof target === "boolean") {
	            deep = target;

	            target = arguments[i] || {};
	            i++;
	        }

	        if (typeof target !== "object" && $.type(target) !== "function") {
	            target = {};
	        }

	        if (i === length) {
	            target = this;
	            i--;
	        }

	        for (; i < length; i++) {
	            if ((options = arguments[i]) != null) {
	                for (name in options) {
	                    src = target[name];
	                    copy = options[name];

	                    if (target === copy) {
	                        continue;
	                    }

	                    if (deep && copy && ($.isPlainObject(copy) || (copyIsArray = $.isArray(copy)))) {
	                        if (copyIsArray) {
	                            copyIsArray = false;
	                            clone = src && $.isArray(src) ? src : [];

	                        } else {
	                            clone = src && $.isPlainObject(src) ? src : {};
	                        }

	                        target[name] = $.extend(deep, clone, copy);

	                    } else if (copy !== undefined) {
	                        target[name] = copy;
	                    }
	                }
	            }
	        }

	        return target;
	    };

	    /* jQuery 1.4.3 */
	    $.queue = function (elem, type, data) {
	        function $makeArray (arr, results) {
	            var ret = results || [];

	            if (arr != null) {
	                if (isArraylike(Object(arr))) {
	                    /* $.merge */
	                    (function(first, second) {
	                        var len = +second.length,
	                            j = 0,
	                            i = first.length;

	                        while (j < len) {
	                            first[i++] = second[j++];
	                        }

	                        if (len !== len) {
	                            while (second[j] !== undefined) {
	                                first[i++] = second[j++];
	                            }
	                        }

	                        first.length = i;

	                        return first;
	                    })(ret, typeof arr === "string" ? [arr] : arr);
	                } else {
	                    [].push.call(ret, arr);
	                }
	            }

	            return ret;
	        }

	        if (!elem) {
	            return;
	        }

	        type = (type || "fx") + "queue";

	        var q = $.data(elem, type);

	        if (!data) {
	            return q || [];
	        }

	        if (!q || $.isArray(data)) {
	            q = $.data(elem, type, $makeArray(data));
	        } else {
	            q.push(data);
	        }

	        return q;
	    };

	    /* jQuery 1.4.3 */
	    $.dequeue = function (elems, type) {
	        /* Custom: Embed element iteration. */
	        $.each(elems.nodeType ? [ elems ] : elems, function(i, elem) {
	            type = type || "fx";

	            var queue = $.queue(elem, type),
	                fn = queue.shift();

	            if (fn === "inprogress") {
	                fn = queue.shift();
	            }

	            if (fn) {
	                if (type === "fx") {
	                    queue.unshift("inprogress");
	                }

	                fn.call(elem, function() {
	                    $.dequeue(elem, type);
	                });
	            }
	        });
	    };

	    /******************
	       $.fn Methods
	    ******************/

	    /* jQuery */
	    $.fn = $.prototype = {
	        init: function (selector) {
	            /* Just return the element wrapped inside an array; don't proceed with the actual jQuery node wrapping process. */
	            if (selector.nodeType) {
	                this[0] = selector;

	                return this;
	            } else {
	                throw new Error("Not a DOM node.");
	            }
	        },

	        offset: function () {
	            /* jQuery altered code: Dropped disconnected DOM node checking. */
	            var box = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : { top: 0, left: 0 };

	            return {
	                top: box.top + (window.pageYOffset || document.scrollTop  || 0)  - (document.clientTop  || 0),
	                left: box.left + (window.pageXOffset || document.scrollLeft  || 0) - (document.clientLeft || 0)
	            };
	        },

	        position: function () {
	            /* jQuery */
	            function offsetParent() {
	                var offsetParent = this.offsetParent || document;

	                while (offsetParent && (!offsetParent.nodeType.toLowerCase === "html" && offsetParent.style.position === "static")) {
	                    offsetParent = offsetParent.offsetParent;
	                }

	                return offsetParent || document;
	            }

	            /* Zepto */
	            var elem = this[0],
	                offsetParent = offsetParent.apply(elem),
	                offset = this.offset(),
	                parentOffset = /^(?:body|html)$/i.test(offsetParent.nodeName) ? { top: 0, left: 0 } : $(offsetParent).offset()

	            offset.top -= parseFloat(elem.style.marginTop) || 0;
	            offset.left -= parseFloat(elem.style.marginLeft) || 0;

	            if (offsetParent.style) {
	                parentOffset.top += parseFloat(offsetParent.style.borderTopWidth) || 0
	                parentOffset.left += parseFloat(offsetParent.style.borderLeftWidth) || 0
	            }

	            return {
	                top: offset.top - parentOffset.top,
	                left: offset.left - parentOffset.left
	            };
	        }
	    };

	    /**********************
	       Private Variables
	    **********************/

	    /* For $.data() */
	    var cache = {};
	    $.expando = "velocity" + (new Date().getTime());
	    $.uuid = 0;

	    /* For $.queue() */
	    var class2type = {},
	        hasOwn = class2type.hasOwnProperty,
	        toString = class2type.toString;

	    var types = "Boolean Number String Function Array Date RegExp Object Error".split(" ");
	    for (var i = 0; i < types.length; i++) {
	        class2type["[object " + types[i] + "]"] = types[i].toLowerCase();
	    }

	    /* Makes $(node) possible, without having to call init. */
	    $.fn.init.prototype = $.fn;

	    /* Globalize Velocity onto the window, and assign its Utilities property. */
	    window.Velocity = { Utilities: $ };
	})(window);

	/******************
	    Velocity.js
	******************/

	;(function (factory) {
	    /* CommonJS module. */
	    if (typeof module === "object" && typeof module.exports === "object") {
	        module.exports = factory();
	    /* AMD module. */
	    } else if (true) {
	        !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	    /* Browser globals. */
	    } else {
	        factory();
	    }
	}(function() {
	return function (global, window, document, undefined) {

	    /***************
	        Summary
	    ***************/

	    /*
	    - CSS: CSS stack that works independently from the rest of Velocity.
	    - animate(): Core animation method that iterates over the targeted elements and queues the incoming call onto each element individually.
	      - Pre-Queueing: Prepare the element for animation by instantiating its data cache and processing the call's options.
	      - Queueing: The logic that runs once the call has reached its point of execution in the element's $.queue() stack.
	                  Most logic is placed here to avoid risking it becoming stale (if the element's properties have changed).
	      - Pushing: Consolidation of the tween data followed by its push onto the global in-progress calls container.
	    - tick(): The single requestAnimationFrame loop responsible for tweening all in-progress calls.
	    - completeCall(): Handles the cleanup process for each Velocity call.
	    */

	    /*********************
	       Helper Functions
	    *********************/

	    /* IE detection. Gist: https://gist.github.com/julianshapiro/9098609 */
	    var IE = (function() {
	        if (document.documentMode) {
	            return document.documentMode;
	        } else {
	            for (var i = 7; i > 4; i--) {
	                var div = document.createElement("div");

	                div.innerHTML = "<!--[if IE " + i + "]><span></span><![endif]-->";

	                if (div.getElementsByTagName("span").length) {
	                    div = null;

	                    return i;
	                }
	            }
	        }

	        return undefined;
	    })();

	    /* rAF shim. Gist: https://gist.github.com/julianshapiro/9497513 */
	    var rAFShim = (function() {
	        var timeLast = 0;

	        return window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {
	            var timeCurrent = (new Date()).getTime(),
	                timeDelta;

	            /* Dynamically set delay on a per-tick basis to match 60fps. */
	            /* Technique by Erik Moller. MIT license: https://gist.github.com/paulirish/1579671 */
	            timeDelta = Math.max(0, 16 - (timeCurrent - timeLast));
	            timeLast = timeCurrent + timeDelta;

	            return setTimeout(function() { callback(timeCurrent + timeDelta); }, timeDelta);
	        };
	    })();

	    /* Array compacting. Copyright Lo-Dash. MIT License: https://github.com/lodash/lodash/blob/master/LICENSE.txt */
	    function compactSparseArray (array) {
	        var index = -1,
	            length = array ? array.length : 0,
	            result = [];

	        while (++index < length) {
	            var value = array[index];

	            if (value) {
	                result.push(value);
	            }
	        }

	        return result;
	    }

	    function sanitizeElements (elements) {
	        /* Unwrap jQuery/Zepto objects. */
	        if (Type.isWrapped(elements)) {
	            elements = [].slice.call(elements);
	        /* Wrap a single element in an array so that $.each() can iterate with the element instead of its node's children. */
	        } else if (Type.isNode(elements)) {
	            elements = [ elements ];
	        }

	        return elements;
	    }

	    var Type = {
	        isString: function (variable) {
	            return (typeof variable === "string");
	        },
	        isArray: Array.isArray || function (variable) {
	            return Object.prototype.toString.call(variable) === "[object Array]";
	        },
	        isFunction: function (variable) {
	            return Object.prototype.toString.call(variable) === "[object Function]";
	        },
	        isNode: function (variable) {
	            return variable && variable.nodeType;
	        },
	        /* Copyright Martin Bohm. MIT License: https://gist.github.com/Tomalak/818a78a226a0738eaade */
	        isNodeList: function (variable) {
	            return typeof variable === "object" &&
	                /^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(variable)) &&
	                variable.length !== undefined &&
	                (variable.length === 0 || (typeof variable[0] === "object" && variable[0].nodeType > 0));
	        },
	        /* Determine if variable is a wrapped jQuery or Zepto element. */
	        isWrapped: function (variable) {
	            return variable && (variable.jquery || (window.Zepto && window.Zepto.zepto.isZ(variable)));
	        },
	        isSVG: function (variable) {
	            return window.SVGElement && (variable instanceof window.SVGElement);
	        },
	        isEmptyObject: function (variable) {
	            for (var name in variable) {
	                return false;
	            }

	            return true;
	        }
	    };

	    /*****************
	       Dependencies
	    *****************/

	    var $,
	        isJQuery = false;

	    if (global.fn && global.fn.jquery) {
	        $ = global;
	        isJQuery = true;
	    } else {
	        $ = window.Velocity.Utilities;
	    }

	    if (IE <= 8 && !isJQuery) {
	        throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
	    } else if (IE <= 7) {
	        /* Revert to jQuery's $.animate(), and lose Velocity's extra features. */
	        jQuery.fn.velocity = jQuery.fn.animate;

	        /* Now that $.fn.velocity is aliased, abort this Velocity declaration. */
	        return;
	    }

	    /*****************
	        Constants
	    *****************/

	    var DURATION_DEFAULT = 400,
	        EASING_DEFAULT = "swing";

	    /*************
	        State
	    *************/

	    var Velocity = {
	        /* Container for page-wide Velocity state data. */
	        State: {
	            /* Detect mobile devices to determine if mobileHA should be turned on. */
	            isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
	            /* The mobileHA option's behavior changes on older Android devices (Gingerbread, versions 2.3.3-2.3.7). */
	            isAndroid: /Android/i.test(navigator.userAgent),
	            isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
	            isChrome: window.chrome,
	            isFirefox: /Firefox/i.test(navigator.userAgent),
	            /* Create a cached element for re-use when checking for CSS property prefixes. */
	            prefixElement: document.createElement("div"),
	            /* Cache every prefix match to avoid repeating lookups. */
	            prefixMatches: {},
	            /* Cache the anchor used for animating window scrolling. */
	            scrollAnchor: null,
	            /* Cache the browser-specific property names associated with the scroll anchor. */
	            scrollPropertyLeft: null,
	            scrollPropertyTop: null,
	            /* Keep track of whether our RAF tick is running. */
	            isTicking: false,
	            /* Container for every in-progress call to Velocity. */
	            calls: []
	        },
	        /* Velocity's custom CSS stack. Made global for unit testing. */
	        CSS: { /* Defined below. */ },
	        /* A shim of the jQuery utility functions used by Velocity -- provided by Velocity's optional jQuery shim. */
	        Utilities: $,
	        /* Container for the user's custom animation redirects that are referenced by name in place of the properties map argument. */
	        Redirects: { /* Manually registered by the user. */ },
	        Easings: { /* Defined below. */ },
	        /* Attempt to use ES6 Promises by default. Users can override this with a third-party promises library. */
	        Promise: window.Promise,
	        /* Velocity option defaults, which can be overriden by the user. */
	        defaults: {
	            queue: "",
	            duration: DURATION_DEFAULT,
	            easing: EASING_DEFAULT,
	            begin: undefined,
	            complete: undefined,
	            progress: undefined,
	            display: undefined,
	            visibility: undefined,
	            loop: false,
	            delay: false,
	            mobileHA: true,
	            /* Advanced: Set to false to prevent property values from being cached between consecutive Velocity-initiated chain calls. */
	            _cacheValues: true
	        },
	        /* A design goal of Velocity is to cache data wherever possible in order to avoid DOM requerying. Accordingly, each element has a data cache. */
	        init: function (element) {
	            $.data(element, "velocity", {
	                /* Store whether this is an SVG element, since its properties are retrieved and updated differently than standard HTML elements. */
	                isSVG: Type.isSVG(element),
	                /* Keep track of whether the element is currently being animated by Velocity.
	                   This is used to ensure that property values are not transferred between non-consecutive (stale) calls. */
	                isAnimating: false,
	                /* A reference to the element's live computedStyle object. Learn more here: https://developer.mozilla.org/en/docs/Web/API/window.getComputedStyle */
	                computedStyle: null,
	                /* Tween data is cached for each animation on the element so that data can be passed across calls --
	                   in particular, end values are used as subsequent start values in consecutive Velocity calls. */
	                tweensContainer: null,
	                /* The full root property values of each CSS hook being animated on this element are cached so that:
	                   1) Concurrently-animating hooks sharing the same root can have their root values' merged into one while tweening.
	                   2) Post-hook-injection root values can be transferred over to consecutively chained Velocity calls as starting root values. */
	                rootPropertyValueCache: {},
	                /* A cache for transform updates, which must be manually flushed via CSS.flushTransformCache(). */
	                transformCache: {}
	            });
	        },
	        /* A parallel to jQuery's $.css(), used for getting/setting Velocity's hooked CSS properties. */
	        hook: null, /* Defined below. */
	        /* Velocity-wide animation time remapping for testing purposes. */
	        mock: false,
	        version: { major: 1, minor: 2, patch: 2 },
	        /* Set to 1 or 2 (most verbose) to output debug info to console. */
	        debug: false
	    };

	    /* Retrieve the appropriate scroll anchor and property name for the browser: https://developer.mozilla.org/en-US/docs/Web/API/Window.scrollY */
	    if (window.pageYOffset !== undefined) {
	        Velocity.State.scrollAnchor = window;
	        Velocity.State.scrollPropertyLeft = "pageXOffset";
	        Velocity.State.scrollPropertyTop = "pageYOffset";
	    } else {
	        Velocity.State.scrollAnchor = document.documentElement || document.body.parentNode || document.body;
	        Velocity.State.scrollPropertyLeft = "scrollLeft";
	        Velocity.State.scrollPropertyTop = "scrollTop";
	    }

	    /* Shorthand alias for jQuery's $.data() utility. */
	    function Data (element) {
	        /* Hardcode a reference to the plugin name. */
	        var response = $.data(element, "velocity");

	        /* jQuery <=1.4.2 returns null instead of undefined when no match is found. We normalize this behavior. */
	        return response === null ? undefined : response;
	    };

	    /**************
	        Easing
	    **************/

	    /* Step easing generator. */
	    function generateStep (steps) {
	        return function (p) {
	            return Math.round(p * steps) * (1 / steps);
	        };
	    }

	    /* Bezier curve function generator. Copyright Gaetan Renaudeau. MIT License: http://en.wikipedia.org/wiki/MIT_License */
	    function generateBezier (mX1, mY1, mX2, mY2) {
	        var NEWTON_ITERATIONS = 4,
	            NEWTON_MIN_SLOPE = 0.001,
	            SUBDIVISION_PRECISION = 0.0000001,
	            SUBDIVISION_MAX_ITERATIONS = 10,
	            kSplineTableSize = 11,
	            kSampleStepSize = 1.0 / (kSplineTableSize - 1.0),
	            float32ArraySupported = "Float32Array" in window;

	        /* Must contain four arguments. */
	        if (arguments.length !== 4) {
	            return false;
	        }

	        /* Arguments must be numbers. */
	        for (var i = 0; i < 4; ++i) {
	            if (typeof arguments[i] !== "number" || isNaN(arguments[i]) || !isFinite(arguments[i])) {
	                return false;
	            }
	        }

	        /* X values must be in the [0, 1] range. */
	        mX1 = Math.min(mX1, 1);
	        mX2 = Math.min(mX2, 1);
	        mX1 = Math.max(mX1, 0);
	        mX2 = Math.max(mX2, 0);

	        var mSampleValues = float32ArraySupported ? new Float32Array(kSplineTableSize) : new Array(kSplineTableSize);

	        function A (aA1, aA2) { return 1.0 - 3.0 * aA2 + 3.0 * aA1; }
	        function B (aA1, aA2) { return 3.0 * aA2 - 6.0 * aA1; }
	        function C (aA1)      { return 3.0 * aA1; }

	        function calcBezier (aT, aA1, aA2) {
	            return ((A(aA1, aA2)*aT + B(aA1, aA2))*aT + C(aA1))*aT;
	        }

	        function getSlope (aT, aA1, aA2) {
	            return 3.0 * A(aA1, aA2)*aT*aT + 2.0 * B(aA1, aA2) * aT + C(aA1);
	        }

	        function newtonRaphsonIterate (aX, aGuessT) {
	            for (var i = 0; i < NEWTON_ITERATIONS; ++i) {
	                var currentSlope = getSlope(aGuessT, mX1, mX2);

	                if (currentSlope === 0.0) return aGuessT;

	                var currentX = calcBezier(aGuessT, mX1, mX2) - aX;
	                aGuessT -= currentX / currentSlope;
	            }

	            return aGuessT;
	        }

	        function calcSampleValues () {
	            for (var i = 0; i < kSplineTableSize; ++i) {
	                mSampleValues[i] = calcBezier(i * kSampleStepSize, mX1, mX2);
	            }
	        }

	        function binarySubdivide (aX, aA, aB) {
	            var currentX, currentT, i = 0;

	            do {
	                currentT = aA + (aB - aA) / 2.0;
	                currentX = calcBezier(currentT, mX1, mX2) - aX;
	                if (currentX > 0.0) {
	                  aB = currentT;
	                } else {
	                  aA = currentT;
	                }
	            } while (Math.abs(currentX) > SUBDIVISION_PRECISION && ++i < SUBDIVISION_MAX_ITERATIONS);

	            return currentT;
	        }

	        function getTForX (aX) {
	            var intervalStart = 0.0,
	                currentSample = 1,
	                lastSample = kSplineTableSize - 1;

	            for (; currentSample != lastSample && mSampleValues[currentSample] <= aX; ++currentSample) {
	                intervalStart += kSampleStepSize;
	            }

	            --currentSample;

	            var dist = (aX - mSampleValues[currentSample]) / (mSampleValues[currentSample+1] - mSampleValues[currentSample]),
	                guessForT = intervalStart + dist * kSampleStepSize,
	                initialSlope = getSlope(guessForT, mX1, mX2);

	            if (initialSlope >= NEWTON_MIN_SLOPE) {
	                return newtonRaphsonIterate(aX, guessForT);
	            } else if (initialSlope == 0.0) {
	                return guessForT;
	            } else {
	                return binarySubdivide(aX, intervalStart, intervalStart + kSampleStepSize);
	            }
	        }

	        var _precomputed = false;

	        function precompute() {
	            _precomputed = true;
	            if (mX1 != mY1 || mX2 != mY2) calcSampleValues();
	        }

	        var f = function (aX) {
	            if (!_precomputed) precompute();
	            if (mX1 === mY1 && mX2 === mY2) return aX;
	            if (aX === 0) return 0;
	            if (aX === 1) return 1;

	            return calcBezier(getTForX(aX), mY1, mY2);
	        };

	        f.getControlPoints = function() { return [{ x: mX1, y: mY1 }, { x: mX2, y: mY2 }]; };

	        var str = "generateBezier(" + [mX1, mY1, mX2, mY2] + ")";
	        f.toString = function () { return str; };

	        return f;
	    }

	    /* Runge-Kutta spring physics function generator. Adapted from Framer.js, copyright Koen Bok. MIT License: http://en.wikipedia.org/wiki/MIT_License */
	    /* Given a tension, friction, and duration, a simulation at 60FPS will first run without a defined duration in order to calculate the full path. A second pass
	       then adjusts the time delta -- using the relation between actual time and duration -- to calculate the path for the duration-constrained animation. */
	    var generateSpringRK4 = (function () {
	        function springAccelerationForState (state) {
	            return (-state.tension * state.x) - (state.friction * state.v);
	        }

	        function springEvaluateStateWithDerivative (initialState, dt, derivative) {
	            var state = {
	                x: initialState.x + derivative.dx * dt,
	                v: initialState.v + derivative.dv * dt,
	                tension: initialState.tension,
	                friction: initialState.friction
	            };

	            return { dx: state.v, dv: springAccelerationForState(state) };
	        }

	        function springIntegrateState (state, dt) {
	            var a = {
	                    dx: state.v,
	                    dv: springAccelerationForState(state)
	                },
	                b = springEvaluateStateWithDerivative(state, dt * 0.5, a),
	                c = springEvaluateStateWithDerivative(state, dt * 0.5, b),
	                d = springEvaluateStateWithDerivative(state, dt, c),
	                dxdt = 1.0 / 6.0 * (a.dx + 2.0 * (b.dx + c.dx) + d.dx),
	                dvdt = 1.0 / 6.0 * (a.dv + 2.0 * (b.dv + c.dv) + d.dv);

	            state.x = state.x + dxdt * dt;
	            state.v = state.v + dvdt * dt;

	            return state;
	        }

	        return function springRK4Factory (tension, friction, duration) {

	            var initState = {
	                    x: -1,
	                    v: 0,
	                    tension: null,
	                    friction: null
	                },
	                path = [0],
	                time_lapsed = 0,
	                tolerance = 1 / 10000,
	                DT = 16 / 1000,
	                have_duration, dt, last_state;

	            tension = parseFloat(tension) || 500;
	            friction = parseFloat(friction) || 20;
	            duration = duration || null;

	            initState.tension = tension;
	            initState.friction = friction;

	            have_duration = duration !== null;

	            /* Calculate the actual time it takes for this animation to complete with the provided conditions. */
	            if (have_duration) {
	                /* Run the simulation without a duration. */
	                time_lapsed = springRK4Factory(tension, friction);
	                /* Compute the adjusted time delta. */
	                dt = time_lapsed / duration * DT;
	            } else {
	                dt = DT;
	            }

	            while (true) {
	                /* Next/step function .*/
	                last_state = springIntegrateState(last_state || initState, dt);
	                /* Store the position. */
	                path.push(1 + last_state.x);
	                time_lapsed += 16;
	                /* If the change threshold is reached, break. */
	                if (!(Math.abs(last_state.x) > tolerance && Math.abs(last_state.v) > tolerance)) {
	                    break;
	                }
	            }

	            /* If duration is not defined, return the actual time required for completing this animation. Otherwise, return a closure that holds the
	               computed path and returns a snapshot of the position according to a given percentComplete. */
	            return !have_duration ? time_lapsed : function(percentComplete) { return path[ (percentComplete * (path.length - 1)) | 0 ]; };
	        };
	    }());

	    /* jQuery easings. */
	    Velocity.Easings = {
	        linear: function(p) { return p; },
	        swing: function(p) { return 0.5 - Math.cos( p * Math.PI ) / 2 },
	        /* Bonus "spring" easing, which is a less exaggerated version of easeInOutElastic. */
	        spring: function(p) { return 1 - (Math.cos(p * 4.5 * Math.PI) * Math.exp(-p * 6)); }
	    };

	    /* CSS3 and Robert Penner easings. */
	    $.each(
	        [
	            [ "ease", [ 0.25, 0.1, 0.25, 1.0 ] ],
	            [ "ease-in", [ 0.42, 0.0, 1.00, 1.0 ] ],
	            [ "ease-out", [ 0.00, 0.0, 0.58, 1.0 ] ],
	            [ "ease-in-out", [ 0.42, 0.0, 0.58, 1.0 ] ],
	            [ "easeInSine", [ 0.47, 0, 0.745, 0.715 ] ],
	            [ "easeOutSine", [ 0.39, 0.575, 0.565, 1 ] ],
	            [ "easeInOutSine", [ 0.445, 0.05, 0.55, 0.95 ] ],
	            [ "easeInQuad", [ 0.55, 0.085, 0.68, 0.53 ] ],
	            [ "easeOutQuad", [ 0.25, 0.46, 0.45, 0.94 ] ],
	            [ "easeInOutQuad", [ 0.455, 0.03, 0.515, 0.955 ] ],
	            [ "easeInCubic", [ 0.55, 0.055, 0.675, 0.19 ] ],
	            [ "easeOutCubic", [ 0.215, 0.61, 0.355, 1 ] ],
	            [ "easeInOutCubic", [ 0.645, 0.045, 0.355, 1 ] ],
	            [ "easeInQuart", [ 0.895, 0.03, 0.685, 0.22 ] ],
	            [ "easeOutQuart", [ 0.165, 0.84, 0.44, 1 ] ],
	            [ "easeInOutQuart", [ 0.77, 0, 0.175, 1 ] ],
	            [ "easeInQuint", [ 0.755, 0.05, 0.855, 0.06 ] ],
	            [ "easeOutQuint", [ 0.23, 1, 0.32, 1 ] ],
	            [ "easeInOutQuint", [ 0.86, 0, 0.07, 1 ] ],
	            [ "easeInExpo", [ 0.95, 0.05, 0.795, 0.035 ] ],
	            [ "easeOutExpo", [ 0.19, 1, 0.22, 1 ] ],
	            [ "easeInOutExpo", [ 1, 0, 0, 1 ] ],
	            [ "easeInCirc", [ 0.6, 0.04, 0.98, 0.335 ] ],
	            [ "easeOutCirc", [ 0.075, 0.82, 0.165, 1 ] ],
	            [ "easeInOutCirc", [ 0.785, 0.135, 0.15, 0.86 ] ]
	        ], function(i, easingArray) {
	            Velocity.Easings[easingArray[0]] = generateBezier.apply(null, easingArray[1]);
	        });

	    /* Determine the appropriate easing type given an easing input. */
	    function getEasing(value, duration) {
	        var easing = value;

	        /* The easing option can either be a string that references a pre-registered easing,
	           or it can be a two-/four-item array of integers to be converted into a bezier/spring function. */
	        if (Type.isString(value)) {
	            /* Ensure that the easing has been assigned to jQuery's Velocity.Easings object. */
	            if (!Velocity.Easings[value]) {
	                easing = false;
	            }
	        } else if (Type.isArray(value) && value.length === 1) {
	            easing = generateStep.apply(null, value);
	        } else if (Type.isArray(value) && value.length === 2) {
	            /* springRK4 must be passed the animation's duration. */
	            /* Note: If the springRK4 array contains non-numbers, generateSpringRK4() returns an easing
	               function generated with default tension and friction values. */
	            easing = generateSpringRK4.apply(null, value.concat([ duration ]));
	        } else if (Type.isArray(value) && value.length === 4) {
	            /* Note: If the bezier array contains non-numbers, generateBezier() returns false. */
	            easing = generateBezier.apply(null, value);
	        } else {
	            easing = false;
	        }

	        /* Revert to the Velocity-wide default easing type, or fall back to "swing" (which is also jQuery's default)
	           if the Velocity-wide default has been incorrectly modified. */
	        if (easing === false) {
	            if (Velocity.Easings[Velocity.defaults.easing]) {
	                easing = Velocity.defaults.easing;
	            } else {
	                easing = EASING_DEFAULT;
	            }
	        }

	        return easing;
	    }

	    /*****************
	        CSS Stack
	    *****************/

	    /* The CSS object is a highly condensed and performant CSS stack that fully replaces jQuery's.
	       It handles the validation, getting, and setting of both standard CSS properties and CSS property hooks. */
	    /* Note: A "CSS" shorthand is aliased so that our code is easier to read. */
	    var CSS = Velocity.CSS = {

	        /*************
	            RegEx
	        *************/

	        RegEx: {
	            isHex: /^#([A-f\d]{3}){1,2}$/i,
	            /* Unwrap a property value's surrounding text, e.g. "rgba(4, 3, 2, 1)" ==> "4, 3, 2, 1" and "rect(4px 3px 2px 1px)" ==> "4px 3px 2px 1px". */
	            valueUnwrap: /^[A-z]+\((.*)\)$/i,
	            wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
	            /* Split a multi-value property into an array of subvalues, e.g. "rgba(4, 3, 2, 1) 4px 3px 2px 1px" ==> [ "rgba(4, 3, 2, 1)", "4px", "3px", "2px", "1px" ]. */
	            valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/ig
	        },

	        /************
	            Lists
	        ************/

	        Lists: {
	            colors: [ "fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor" ],
	            transformsBase: [ "translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ" ],
	            transforms3D: [ "transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY" ]
	        },

	        /************
	            Hooks
	        ************/

	        /* Hooks allow a subproperty (e.g. "boxShadowBlur") of a compound-value CSS property
	           (e.g. "boxShadow: X Y Blur Spread Color") to be animated as if it were a discrete property. */
	        /* Note: Beyond enabling fine-grained property animation, hooking is necessary since Velocity only
	           tweens properties with single numeric values; unlike CSS transitions, Velocity does not interpolate compound-values. */
	        Hooks: {
	            /********************
	                Registration
	            ********************/

	            /* Templates are a concise way of indicating which subproperties must be individually registered for each compound-value CSS property. */
	            /* Each template consists of the compound-value's base name, its constituent subproperty names, and those subproperties' default values. */
	            templates: {
	                "textShadow": [ "Color X Y Blur", "black 0px 0px 0px" ],
	                "boxShadow": [ "Color X Y Blur Spread", "black 0px 0px 0px 0px" ],
	                "clip": [ "Top Right Bottom Left", "0px 0px 0px 0px" ],
	                "backgroundPosition": [ "X Y", "0% 0%" ],
	                "transformOrigin": [ "X Y Z", "50% 50% 0px" ],
	                "perspectiveOrigin": [ "X Y", "50% 50%" ]
	            },

	            /* A "registered" hook is one that has been converted from its template form into a live,
	               tweenable property. It contains data to associate it with its root property. */
	            registered: {
	                /* Note: A registered hook looks like this ==> textShadowBlur: [ "textShadow", 3 ],
	                   which consists of the subproperty's name, the associated root property's name,
	                   and the subproperty's position in the root's value. */
	            },
	            /* Convert the templates into individual hooks then append them to the registered object above. */
	            register: function () {
	                /* Color hooks registration: Colors are defaulted to white -- as opposed to black -- since colors that are
	                   currently set to "transparent" default to their respective template below when color-animated,
	                   and white is typically a closer match to transparent than black is. An exception is made for text ("color"),
	                   which is almost always set closer to black than white. */
	                for (var i = 0; i < CSS.Lists.colors.length; i++) {
	                    var rgbComponents = (CSS.Lists.colors[i] === "color") ? "0 0 0 1" : "255 255 255 1";
	                    CSS.Hooks.templates[CSS.Lists.colors[i]] = [ "Red Green Blue Alpha", rgbComponents ];
	                }

	                var rootProperty,
	                    hookTemplate,
	                    hookNames;

	                /* In IE, color values inside compound-value properties are positioned at the end the value instead of at the beginning.
	                   Thus, we re-arrange the templates accordingly. */
	                if (IE) {
	                    for (rootProperty in CSS.Hooks.templates) {
	                        hookTemplate = CSS.Hooks.templates[rootProperty];
	                        hookNames = hookTemplate[0].split(" ");

	                        var defaultValues = hookTemplate[1].match(CSS.RegEx.valueSplit);

	                        if (hookNames[0] === "Color") {
	                            /* Reposition both the hook's name and its default value to the end of their respective strings. */
	                            hookNames.push(hookNames.shift());
	                            defaultValues.push(defaultValues.shift());

	                            /* Replace the existing template for the hook's root property. */
	                            CSS.Hooks.templates[rootProperty] = [ hookNames.join(" "), defaultValues.join(" ") ];
	                        }
	                    }
	                }

	                /* Hook registration. */
	                for (rootProperty in CSS.Hooks.templates) {
	                    hookTemplate = CSS.Hooks.templates[rootProperty];
	                    hookNames = hookTemplate[0].split(" ");

	                    for (var i in hookNames) {
	                        var fullHookName = rootProperty + hookNames[i],
	                            hookPosition = i;

	                        /* For each hook, register its full name (e.g. textShadowBlur) with its root property (e.g. textShadow)
	                           and the hook's position in its template's default value string. */
	                        CSS.Hooks.registered[fullHookName] = [ rootProperty, hookPosition ];
	                    }
	                }
	            },

	            /*****************************
	               Injection and Extraction
	            *****************************/

	            /* Look up the root property associated with the hook (e.g. return "textShadow" for "textShadowBlur"). */
	            /* Since a hook cannot be set directly (the browser won't recognize it), style updating for hooks is routed through the hook's root property. */
	            getRoot: function (property) {
	                var hookData = CSS.Hooks.registered[property];

	                if (hookData) {
	                    return hookData[0];
	                } else {
	                    /* If there was no hook match, return the property name untouched. */
	                    return property;
	                }
	            },
	            /* Convert any rootPropertyValue, null or otherwise, into a space-delimited list of hook values so that
	               the targeted hook can be injected or extracted at its standard position. */
	            cleanRootPropertyValue: function(rootProperty, rootPropertyValue) {
	                /* If the rootPropertyValue is wrapped with "rgb()", "clip()", etc., remove the wrapping to normalize the value before manipulation. */
	                if (CSS.RegEx.valueUnwrap.test(rootPropertyValue)) {
	                    rootPropertyValue = rootPropertyValue.match(CSS.RegEx.valueUnwrap)[1];
	                }

	                /* If rootPropertyValue is a CSS null-value (from which there's inherently no hook value to extract),
	                   default to the root's default value as defined in CSS.Hooks.templates. */
	                /* Note: CSS null-values include "none", "auto", and "transparent". They must be converted into their
	                   zero-values (e.g. textShadow: "none" ==> textShadow: "0px 0px 0px black") for hook manipulation to proceed. */
	                if (CSS.Values.isCSSNullValue(rootPropertyValue)) {
	                    rootPropertyValue = CSS.Hooks.templates[rootProperty][1];
	                }

	                return rootPropertyValue;
	            },
	            /* Extracted the hook's value from its root property's value. This is used to get the starting value of an animating hook. */
	            extractValue: function (fullHookName, rootPropertyValue) {
	                var hookData = CSS.Hooks.registered[fullHookName];

	                if (hookData) {
	                    var hookRoot = hookData[0],
	                        hookPosition = hookData[1];

	                    rootPropertyValue = CSS.Hooks.cleanRootPropertyValue(hookRoot, rootPropertyValue);

	                    /* Split rootPropertyValue into its constituent hook values then grab the desired hook at its standard position. */
	                    return rootPropertyValue.toString().match(CSS.RegEx.valueSplit)[hookPosition];
	                } else {
	                    /* If the provided fullHookName isn't a registered hook, return the rootPropertyValue that was passed in. */
	                    return rootPropertyValue;
	                }
	            },
	            /* Inject the hook's value into its root property's value. This is used to piece back together the root property
	               once Velocity has updated one of its individually hooked values through tweening. */
	            injectValue: function (fullHookName, hookValue, rootPropertyValue) {
	                var hookData = CSS.Hooks.registered[fullHookName];

	                if (hookData) {
	                    var hookRoot = hookData[0],
	                        hookPosition = hookData[1],
	                        rootPropertyValueParts,
	                        rootPropertyValueUpdated;

	                    rootPropertyValue = CSS.Hooks.cleanRootPropertyValue(hookRoot, rootPropertyValue);

	                    /* Split rootPropertyValue into its individual hook values, replace the targeted value with hookValue,
	                       then reconstruct the rootPropertyValue string. */
	                    rootPropertyValueParts = rootPropertyValue.toString().match(CSS.RegEx.valueSplit);
	                    rootPropertyValueParts[hookPosition] = hookValue;
	                    rootPropertyValueUpdated = rootPropertyValueParts.join(" ");

	                    return rootPropertyValueUpdated;
	                } else {
	                    /* If the provided fullHookName isn't a registered hook, return the rootPropertyValue that was passed in. */
	                    return rootPropertyValue;
	                }
	            }
	        },

	        /*******************
	           Normalizations
	        *******************/

	        /* Normalizations standardize CSS property manipulation by pollyfilling browser-specific implementations (e.g. opacity)
	           and reformatting special properties (e.g. clip, rgba) to look like standard ones. */
	        Normalizations: {
	            /* Normalizations are passed a normalization target (either the property's name, its extracted value, or its injected value),
	               the targeted element (which may need to be queried), and the targeted property value. */
	            registered: {
	                clip: function (type, element, propertyValue) {
	                    switch (type) {
	                        case "name":
	                            return "clip";
	                        /* Clip needs to be unwrapped and stripped of its commas during extraction. */
	                        case "extract":
	                            var extracted;

	                            /* If Velocity also extracted this value, skip extraction. */
	                            if (CSS.RegEx.wrappedValueAlreadyExtracted.test(propertyValue)) {
	                                extracted = propertyValue;
	                            } else {
	                                /* Remove the "rect()" wrapper. */
	                                extracted = propertyValue.toString().match(CSS.RegEx.valueUnwrap);

	                                /* Strip off commas. */
	                                extracted = extracted ? extracted[1].replace(/,(\s+)?/g, " ") : propertyValue;
	                            }

	                            return extracted;
	                        /* Clip needs to be re-wrapped during injection. */
	                        case "inject":
	                            return "rect(" + propertyValue + ")";
	                    }
	                },

	                blur: function(type, element, propertyValue) {
	                    switch (type) {
	                        case "name":
	                            return Velocity.State.isFirefox ? "filter" : "-webkit-filter";
	                        case "extract":
	                            var extracted = parseFloat(propertyValue);

	                            /* If extracted is NaN, meaning the value isn't already extracted. */
	                            if (!(extracted || extracted === 0)) {
	                                var blurComponent = propertyValue.toString().match(/blur\(([0-9]+[A-z]+)\)/i);

	                                /* If the filter string had a blur component, return just the blur value and unit type. */
	                                if (blurComponent) {
	                                    extracted = blurComponent[1];
	                                /* If the component doesn't exist, default blur to 0. */
	                                } else {
	                                    extracted = 0;
	                                }
	                            }

	                            return extracted;
	                        /* Blur needs to be re-wrapped during injection. */
	                        case "inject":
	                            /* For the blur effect to be fully de-applied, it needs to be set to "none" instead of 0. */
	                            if (!parseFloat(propertyValue)) {
	                                return "none";
	                            } else {
	                                return "blur(" + propertyValue + ")";
	                            }
	                    }
	                },

	                /* <=IE8 do not support the standard opacity property. They use filter:alpha(opacity=INT) instead. */
	                opacity: function (type, element, propertyValue) {
	                    if (IE <= 8) {
	                        switch (type) {
	                            case "name":
	                                return "filter";
	                            case "extract":
	                                /* <=IE8 return a "filter" value of "alpha(opacity=\d{1,3})".
	                                   Extract the value and convert it to a decimal value to match the standard CSS opacity property's formatting. */
	                                var extracted = propertyValue.toString().match(/alpha\(opacity=(.*)\)/i);

	                                if (extracted) {
	                                    /* Convert to decimal value. */
	                                    propertyValue = extracted[1] / 100;
	                                } else {
	                                    /* When extracting opacity, default to 1 since a null value means opacity hasn't been set. */
	                                    propertyValue = 1;
	                                }

	                                return propertyValue;
	                            case "inject":
	                                /* Opacified elements are required to have their zoom property set to a non-zero value. */
	                                element.style.zoom = 1;

	                                /* Setting the filter property on elements with certain font property combinations can result in a
	                                   highly unappealing ultra-bolding effect. There's no way to remedy this throughout a tween, but dropping the
	                                   value altogether (when opacity hits 1) at leasts ensures that the glitch is gone post-tweening. */
	                                if (parseFloat(propertyValue) >= 1) {
	                                    return "";
	                                } else {
	                                  /* As per the filter property's spec, convert the decimal value to a whole number and wrap the value. */
	                                  return "alpha(opacity=" + parseInt(parseFloat(propertyValue) * 100, 10) + ")";
	                                }
	                        }
	                    /* With all other browsers, normalization is not required; return the same values that were passed in. */
	                    } else {
	                        switch (type) {
	                            case "name":
	                                return "opacity";
	                            case "extract":
	                                return propertyValue;
	                            case "inject":
	                                return propertyValue;
	                        }
	                    }
	                }
	            },

	            /*****************************
	                Batched Registrations
	            *****************************/

	            /* Note: Batched normalizations extend the CSS.Normalizations.registered object. */
	            register: function () {

	                /*****************
	                    Transforms
	                *****************/

	                /* Transforms are the subproperties contained by the CSS "transform" property. Transforms must undergo normalization
	                   so that they can be referenced in a properties map by their individual names. */
	                /* Note: When transforms are "set", they are actually assigned to a per-element transformCache. When all transform
	                   setting is complete complete, CSS.flushTransformCache() must be manually called to flush the values to the DOM.
	                   Transform setting is batched in this way to improve performance: the transform style only needs to be updated
	                   once when multiple transform subproperties are being animated simultaneously. */
	                /* Note: IE9 and Android Gingerbread have support for 2D -- but not 3D -- transforms. Since animating unsupported
	                   transform properties results in the browser ignoring the *entire* transform string, we prevent these 3D values
	                   from being normalized for these browsers so that tweening skips these properties altogether
	                   (since it will ignore them as being unsupported by the browser.) */
	                if (!(IE <= 9) && !Velocity.State.isGingerbread) {
	                    /* Note: Since the standalone CSS "perspective" property and the CSS transform "perspective" subproperty
	                    share the same name, the latter is given a unique token within Velocity: "transformPerspective". */
	                    CSS.Lists.transformsBase = CSS.Lists.transformsBase.concat(CSS.Lists.transforms3D);
	                }

	                for (var i = 0; i < CSS.Lists.transformsBase.length; i++) {
	                    /* Wrap the dynamically generated normalization function in a new scope so that transformName's value is
	                    paired with its respective function. (Otherwise, all functions would take the final for loop's transformName.) */
	                    (function() {
	                        var transformName = CSS.Lists.transformsBase[i];

	                        CSS.Normalizations.registered[transformName] = function (type, element, propertyValue) {
	                            switch (type) {
	                                /* The normalized property name is the parent "transform" property -- the property that is actually set in CSS. */
	                                case "name":
	                                    return "transform";
	                                /* Transform values are cached onto a per-element transformCache object. */
	                                case "extract":
	                                    /* If this transform has yet to be assigned a value, return its null value. */
	                                    if (Data(element) === undefined || Data(element).transformCache[transformName] === undefined) {
	                                        /* Scale CSS.Lists.transformsBase default to 1 whereas all other transform properties default to 0. */
	                                        return /^scale/i.test(transformName) ? 1 : 0;
	                                    /* When transform values are set, they are wrapped in parentheses as per the CSS spec.
	                                       Thus, when extracting their values (for tween calculations), we strip off the parentheses. */
	                                    } else {
	                                        return Data(element).transformCache[transformName].replace(/[()]/g, "");
	                                    }
	                                case "inject":
	                                    var invalid = false;

	                                    /* If an individual transform property contains an unsupported unit type, the browser ignores the *entire* transform property.
	                                       Thus, protect users from themselves by skipping setting for transform values supplied with invalid unit types. */
	                                    /* Switch on the base transform type; ignore the axis by removing the last letter from the transform's name. */
	                                    switch (transformName.substr(0, transformName.length - 1)) {
	                                        /* Whitelist unit types for each transform. */
	                                        case "translate":
	                                            invalid = !/(%|px|em|rem|vw|vh|\d)$/i.test(propertyValue);
	                                            break;
	                                        /* Since an axis-free "scale" property is supported as well, a little hack is used here to detect it by chopping off its last letter. */
	                                        case "scal":
	                                        case "scale":
	                                            /* Chrome on Android has a bug in which scaled elements blur if their initial scale
	                                               value is below 1 (which can happen with forcefeeding). Thus, we detect a yet-unset scale property
	                                               and ensure that its first value is always 1. More info: http://stackoverflow.com/questions/10417890/css3-animations-with-transform-causes-blurred-elements-on-webkit/10417962#10417962 */
	                                            if (Velocity.State.isAndroid && Data(element).transformCache[transformName] === undefined && propertyValue < 1) {
	                                                propertyValue = 1;
	                                            }

	                                            invalid = !/(\d)$/i.test(propertyValue);
	                                            break;
	                                        case "skew":
	                                            invalid = !/(deg|\d)$/i.test(propertyValue);
	                                            break;
	                                        case "rotate":
	                                            invalid = !/(deg|\d)$/i.test(propertyValue);
	                                            break;
	                                    }

	                                    if (!invalid) {
	                                        /* As per the CSS spec, wrap the value in parentheses. */
	                                        Data(element).transformCache[transformName] = "(" + propertyValue + ")";
	                                    }

	                                    /* Although the value is set on the transformCache object, return the newly-updated value for the calling code to process as normal. */
	                                    return Data(element).transformCache[transformName];
	                            }
	                        };
	                    })();
	                }

	                /*************
	                    Colors
	                *************/

	                /* Since Velocity only animates a single numeric value per property, color animation is achieved by hooking the individual RGBA components of CSS color properties.
	                   Accordingly, color values must be normalized (e.g. "#ff0000", "red", and "rgb(255, 0, 0)" ==> "255 0 0 1") so that their components can be injected/extracted by CSS.Hooks logic. */
	                for (var i = 0; i < CSS.Lists.colors.length; i++) {
	                    /* Wrap the dynamically generated normalization function in a new scope so that colorName's value is paired with its respective function.
	                       (Otherwise, all functions would take the final for loop's colorName.) */
	                    (function () {
	                        var colorName = CSS.Lists.colors[i];

	                        /* Note: In IE<=8, which support rgb but not rgba, color properties are reverted to rgb by stripping off the alpha component. */
	                        CSS.Normalizations.registered[colorName] = function(type, element, propertyValue) {
	                            switch (type) {
	                                case "name":
	                                    return colorName;
	                                /* Convert all color values into the rgb format. (Old IE can return hex values and color names instead of rgb/rgba.) */
	                                case "extract":
	                                    var extracted;

	                                    /* If the color is already in its hookable form (e.g. "255 255 255 1") due to having been previously extracted, skip extraction. */
	                                    if (CSS.RegEx.wrappedValueAlreadyExtracted.test(propertyValue)) {
	                                        extracted = propertyValue;
	                                    } else {
	                                        var converted,
	                                            colorNames = {
	                                                black: "rgb(0, 0, 0)",
	                                                blue: "rgb(0, 0, 255)",
	                                                gray: "rgb(128, 128, 128)",
	                                                green: "rgb(0, 128, 0)",
	                                                red: "rgb(255, 0, 0)",
	                                                white: "rgb(255, 255, 255)"
	                                            };

	                                        /* Convert color names to rgb. */
	                                        if (/^[A-z]+$/i.test(propertyValue)) {
	                                            if (colorNames[propertyValue] !== undefined) {
	                                                converted = colorNames[propertyValue]
	                                            } else {
	                                                /* If an unmatched color name is provided, default to black. */
	                                                converted = colorNames.black;
	                                            }
	                                        /* Convert hex values to rgb. */
	                                        } else if (CSS.RegEx.isHex.test(propertyValue)) {
	                                            converted = "rgb(" + CSS.Values.hexToRgb(propertyValue).join(" ") + ")";
	                                        /* If the provided color doesn't match any of the accepted color formats, default to black. */
	                                        } else if (!(/^rgba?\(/i.test(propertyValue))) {
	                                            converted = colorNames.black;
	                                        }

	                                        /* Remove the surrounding "rgb/rgba()" string then replace commas with spaces and strip
	                                           repeated spaces (in case the value included spaces to begin with). */
	                                        extracted = (converted || propertyValue).toString().match(CSS.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ");
	                                    }

	                                    /* So long as this isn't <=IE8, add a fourth (alpha) component if it's missing and default it to 1 (visible). */
	                                    if (!(IE <= 8) && extracted.split(" ").length === 3) {
	                                        extracted += " 1";
	                                    }

	                                    return extracted;
	                                case "inject":
	                                    /* If this is IE<=8 and an alpha component exists, strip it off. */
	                                    if (IE <= 8) {
	                                        if (propertyValue.split(" ").length === 4) {
	                                            propertyValue = propertyValue.split(/\s+/).slice(0, 3).join(" ");
	                                        }
	                                    /* Otherwise, add a fourth (alpha) component if it's missing and default it to 1 (visible). */
	                                    } else if (propertyValue.split(" ").length === 3) {
	                                        propertyValue += " 1";
	                                    }

	                                    /* Re-insert the browser-appropriate wrapper("rgb/rgba()"), insert commas, and strip off decimal units
	                                       on all values but the fourth (R, G, and B only accept whole numbers). */
	                                    return (IE <= 8 ? "rgb" : "rgba") + "(" + propertyValue.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")";
	                            }
	                        };
	                    })();
	                }
	            }
	        },

	        /************************
	           CSS Property Names
	        ************************/

	        Names: {
	            /* Camelcase a property name into its JavaScript notation (e.g. "background-color" ==> "backgroundColor").
	               Camelcasing is used to normalize property names between and across calls. */
	            camelCase: function (property) {
	                return property.replace(/-(\w)/g, function (match, subMatch) {
	                    return subMatch.toUpperCase();
	                });
	            },

	            /* For SVG elements, some properties (namely, dimensional ones) are GET/SET via the element's HTML attributes (instead of via CSS styles). */
	            SVGAttribute: function (property) {
	                var SVGAttributes = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";

	                /* Certain browsers require an SVG transform to be applied as an attribute. (Otherwise, application via CSS is preferable due to 3D support.) */
	                if (IE || (Velocity.State.isAndroid && !Velocity.State.isChrome)) {
	                    SVGAttributes += "|transform";
	                }

	                return new RegExp("^(" + SVGAttributes + ")$", "i").test(property);
	            },

	            /* Determine whether a property should be set with a vendor prefix. */
	            /* If a prefixed version of the property exists, return it. Otherwise, return the original property name.
	               If the property is not at all supported by the browser, return a false flag. */
	            prefixCheck: function (property) {
	                /* If this property has already been checked, return the cached value. */
	                if (Velocity.State.prefixMatches[property]) {
	                    return [ Velocity.State.prefixMatches[property], true ];
	                } else {
	                    var vendors = [ "", "Webkit", "Moz", "ms", "O" ];

	                    for (var i = 0, vendorsLength = vendors.length; i < vendorsLength; i++) {
	                        var propertyPrefixed;

	                        if (i === 0) {
	                            propertyPrefixed = property;
	                        } else {
	                            /* Capitalize the first letter of the property to conform to JavaScript vendor prefix notation (e.g. webkitFilter). */
	                            propertyPrefixed = vendors[i] + property.replace(/^\w/, function(match) { return match.toUpperCase(); });
	                        }

	                        /* Check if the browser supports this property as prefixed. */
	                        if (Type.isString(Velocity.State.prefixElement.style[propertyPrefixed])) {
	                            /* Cache the match. */
	                            Velocity.State.prefixMatches[property] = propertyPrefixed;

	                            return [ propertyPrefixed, true ];
	                        }
	                    }

	                    /* If the browser doesn't support this property in any form, include a false flag so that the caller can decide how to proceed. */
	                    return [ property, false ];
	                }
	            }
	        },

	        /************************
	           CSS Property Values
	        ************************/

	        Values: {
	            /* Hex to RGB conversion. Copyright Tim Down: http://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb */
	            hexToRgb: function (hex) {
	                var shortformRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i,
	                    longformRegex = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i,
	                    rgbParts;

	                hex = hex.replace(shortformRegex, function (m, r, g, b) {
	                    return r + r + g + g + b + b;
	                });

	                rgbParts = longformRegex.exec(hex);

	                return rgbParts ? [ parseInt(rgbParts[1], 16), parseInt(rgbParts[2], 16), parseInt(rgbParts[3], 16) ] : [ 0, 0, 0 ];
	            },

	            isCSSNullValue: function (value) {
	                /* The browser defaults CSS values that have not been set to either 0 or one of several possible null-value strings.
	                   Thus, we check for both falsiness and these special strings. */
	                /* Null-value checking is performed to default the special strings to 0 (for the sake of tweening) or their hook
	                   templates as defined as CSS.Hooks (for the sake of hook injection/extraction). */
	                /* Note: Chrome returns "rgba(0, 0, 0, 0)" for an undefined color whereas IE returns "transparent". */
	                return (value == 0 || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(value));
	            },

	            /* Retrieve a property's default unit type. Used for assigning a unit type when one is not supplied by the user. */
	            getUnitType: function (property) {
	                if (/^(rotate|skew)/i.test(property)) {
	                    return "deg";
	                } else if (/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(property)) {
	                    /* The above properties are unitless. */
	                    return "";
	                } else {
	                    /* Default to px for all other properties. */
	                    return "px";
	                }
	            },

	            /* HTML elements default to an associated display type when they're not set to display:none. */
	            /* Note: This function is used for correctly setting the non-"none" display value in certain Velocity redirects, such as fadeIn/Out. */
	            getDisplayType: function (element) {
	                var tagName = element && element.tagName.toString().toLowerCase();

	                if (/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(tagName)) {
	                    return "inline";
	                } else if (/^(li)$/i.test(tagName)) {
	                    return "list-item";
	                } else if (/^(tr)$/i.test(tagName)) {
	                    return "table-row";
	                } else if (/^(table)$/i.test(tagName)) {
	                    return "table";
	                } else if (/^(tbody)$/i.test(tagName)) {
	                    return "table-row-group";
	                /* Default to "block" when no match is found. */
	                } else {
	                    return "block";
	                }
	            },

	            /* The class add/remove functions are used to temporarily apply a "velocity-animating" class to elements while they're animating. */
	            addClass: function (element, className) {
	                if (element.classList) {
	                    element.classList.add(className);
	                } else {
	                    element.className += (element.className.length ? " " : "") + className;
	                }
	            },

	            removeClass: function (element, className) {
	                if (element.classList) {
	                    element.classList.remove(className);
	                } else {
	                    element.className = element.className.toString().replace(new RegExp("(^|\\s)" + className.split(" ").join("|") + "(\\s|$)", "gi"), " ");
	                }
	            }
	        },

	        /****************************
	           Style Getting & Setting
	        ****************************/

	        /* The singular getPropertyValue, which routes the logic for all normalizations, hooks, and standard CSS properties. */
	        getPropertyValue: function (element, property, rootPropertyValue, forceStyleLookup) {
	            /* Get an element's computed property value. */
	            /* Note: Retrieving the value of a CSS property cannot simply be performed by checking an element's
	               style attribute (which only reflects user-defined values). Instead, the browser must be queried for a property's
	               *computed* value. You can read more about getComputedStyle here: https://developer.mozilla.org/en/docs/Web/API/window.getComputedStyle */
	            function computePropertyValue (element, property) {
	                /* When box-sizing isn't set to border-box, height and width style values are incorrectly computed when an
	                   element's scrollbars are visible (which expands the element's dimensions). Thus, we defer to the more accurate
	                   offsetHeight/Width property, which includes the total dimensions for interior, border, padding, and scrollbar.
	                   We subtract border and padding to get the sum of interior + scrollbar. */
	                var computedValue = 0;

	                /* IE<=8 doesn't support window.getComputedStyle, thus we defer to jQuery, which has an extensive array
	                   of hacks to accurately retrieve IE8 property values. Re-implementing that logic here is not worth bloating the
	                   codebase for a dying browser. The performance repercussions of using jQuery here are minimal since
	                   Velocity is optimized to rarely (and sometimes never) query the DOM. Further, the $.css() codepath isn't that slow. */
	                if (IE <= 8) {
	                    computedValue = $.css(element, property); /* GET */
	                /* All other browsers support getComputedStyle. The returned live object reference is cached onto its
	                   associated element so that it does not need to be refetched upon every GET. */
	                } else {
	                    /* Browsers do not return height and width values for elements that are set to display:"none". Thus, we temporarily
	                       toggle display to the element type's default value. */
	                    var toggleDisplay = false;

	                    if (/^(width|height)$/.test(property) && CSS.getPropertyValue(element, "display") === 0) {
	                        toggleDisplay = true;
	                        CSS.setPropertyValue(element, "display", CSS.Values.getDisplayType(element));
	                    }

	                    function revertDisplay () {
	                        if (toggleDisplay) {
	                            CSS.setPropertyValue(element, "display", "none");
	                        }
	                    }

	                    if (!forceStyleLookup) {
	                        if (property === "height" && CSS.getPropertyValue(element, "boxSizing").toString().toLowerCase() !== "border-box") {
	                            var contentBoxHeight = element.offsetHeight - (parseFloat(CSS.getPropertyValue(element, "borderTopWidth")) || 0) - (parseFloat(CSS.getPropertyValue(element, "borderBottomWidth")) || 0) - (parseFloat(CSS.getPropertyValue(element, "paddingTop")) || 0) - (parseFloat(CSS.getPropertyValue(element, "paddingBottom")) || 0);
	                            revertDisplay();

	                            return contentBoxHeight;
	                        } else if (property === "width" && CSS.getPropertyValue(element, "boxSizing").toString().toLowerCase() !== "border-box") {
	                            var contentBoxWidth = element.offsetWidth - (parseFloat(CSS.getPropertyValue(element, "borderLeftWidth")) || 0) - (parseFloat(CSS.getPropertyValue(element, "borderRightWidth")) || 0) - (parseFloat(CSS.getPropertyValue(element, "paddingLeft")) || 0) - (parseFloat(CSS.getPropertyValue(element, "paddingRight")) || 0);
	                            revertDisplay();

	                            return contentBoxWidth;
	                        }
	                    }

	                    var computedStyle;

	                    /* For elements that Velocity hasn't been called on directly (e.g. when Velocity queries the DOM on behalf
	                       of a parent of an element its animating), perform a direct getComputedStyle lookup since the object isn't cached. */
	                    if (Data(element) === undefined) {
	                        computedStyle = window.getComputedStyle(element, null); /* GET */
	                    /* If the computedStyle object has yet to be cached, do so now. */
	                    } else if (!Data(element).computedStyle) {
	                        computedStyle = Data(element).computedStyle = window.getComputedStyle(element, null); /* GET */
	                    /* If computedStyle is cached, use it. */
	                    } else {
	                        computedStyle = Data(element).computedStyle;
	                    }

	                    /* IE and Firefox do not return a value for the generic borderColor -- they only return individual values for each border side's color.
	                       Also, in all browsers, when border colors aren't all the same, a compound value is returned that Velocity isn't setup to parse.
	                       So, as a polyfill for querying individual border side colors, we just return the top border's color and animate all borders from that value. */
	                    if (property === "borderColor") {
	                        property = "borderTopColor";
	                    }

	                    /* IE9 has a bug in which the "filter" property must be accessed from computedStyle using the getPropertyValue method
	                       instead of a direct property lookup. The getPropertyValue method is slower than a direct lookup, which is why we avoid it by default. */
	                    if (IE === 9 && property === "filter") {
	                        computedValue = computedStyle.getPropertyValue(property); /* GET */
	                    } else {
	                        computedValue = computedStyle[property];
	                    }

	                    /* Fall back to the property's style value (if defined) when computedValue returns nothing,
	                       which can happen when the element hasn't been painted. */
	                    if (computedValue === "" || computedValue === null) {
	                        computedValue = element.style[property];
	                    }

	                    revertDisplay();
	                }

	                /* For top, right, bottom, and left (TRBL) values that are set to "auto" on elements of "fixed" or "absolute" position,
	                   defer to jQuery for converting "auto" to a numeric value. (For elements with a "static" or "relative" position, "auto" has the same
	                   effect as being set to 0, so no conversion is necessary.) */
	                /* An example of why numeric conversion is necessary: When an element with "position:absolute" has an untouched "left"
	                   property, which reverts to "auto", left's value is 0 relative to its parent element, but is often non-zero relative
	                   to its *containing* (not parent) element, which is the nearest "position:relative" ancestor or the viewport (and always the viewport in the case of "position:fixed"). */
	                if (computedValue === "auto" && /^(top|right|bottom|left)$/i.test(property)) {
	                    var position = computePropertyValue(element, "position"); /* GET */

	                    /* For absolute positioning, jQuery's $.position() only returns values for top and left;
	                       right and bottom will have their "auto" value reverted to 0. */
	                    /* Note: A jQuery object must be created here since jQuery doesn't have a low-level alias for $.position().
	                       Not a big deal since we're currently in a GET batch anyway. */
	                    if (position === "fixed" || (position === "absolute" && /top|left/i.test(property))) {
	                        /* Note: jQuery strips the pixel unit from its returned values; we re-add it here to conform with computePropertyValue's behavior. */
	                        computedValue = $(element).position()[property] + "px"; /* GET */
	                    }
	                }

	                return computedValue;
	            }

	            var propertyValue;

	            /* If this is a hooked property (e.g. "clipLeft" instead of the root property of "clip"),
	               extract the hook's value from a normalized rootPropertyValue using CSS.Hooks.extractValue(). */
	            if (CSS.Hooks.registered[property]) {
	                var hook = property,
	                    hookRoot = CSS.Hooks.getRoot(hook);

	                /* If a cached rootPropertyValue wasn't passed in (which Velocity always attempts to do in order to avoid requerying the DOM),
	                   query the DOM for the root property's value. */
	                if (rootPropertyValue === undefined) {
	                    /* Since the browser is now being directly queried, use the official post-prefixing property name for this lookup. */
	                    rootPropertyValue = CSS.getPropertyValue(element, CSS.Names.prefixCheck(hookRoot)[0]); /* GET */
	                }

	                /* If this root has a normalization registered, peform the associated normalization extraction. */
	                if (CSS.Normalizations.registered[hookRoot]) {
	                    rootPropertyValue = CSS.Normalizations.registered[hookRoot]("extract", element, rootPropertyValue);
	                }

	                /* Extract the hook's value. */
	                propertyValue = CSS.Hooks.extractValue(hook, rootPropertyValue);

	            /* If this is a normalized property (e.g. "opacity" becomes "filter" in <=IE8) or "translateX" becomes "transform"),
	               normalize the property's name and value, and handle the special case of transforms. */
	            /* Note: Normalizing a property is mutually exclusive from hooking a property since hook-extracted values are strictly
	               numerical and therefore do not require normalization extraction. */
	            } else if (CSS.Normalizations.registered[property]) {
	                var normalizedPropertyName,
	                    normalizedPropertyValue;

	                normalizedPropertyName = CSS.Normalizations.registered[property]("name", element);

	                /* Transform values are calculated via normalization extraction (see below), which checks against the element's transformCache.
	                   At no point do transform GETs ever actually query the DOM; initial stylesheet values are never processed.
	                   This is because parsing 3D transform matrices is not always accurate and would bloat our codebase;
	                   thus, normalization extraction defaults initial transform values to their zero-values (e.g. 1 for scaleX and 0 for translateX). */
	                if (normalizedPropertyName !== "transform") {
	                    normalizedPropertyValue = computePropertyValue(element, CSS.Names.prefixCheck(normalizedPropertyName)[0]); /* GET */

	                    /* If the value is a CSS null-value and this property has a hook template, use that zero-value template so that hooks can be extracted from it. */
	                    if (CSS.Values.isCSSNullValue(normalizedPropertyValue) && CSS.Hooks.templates[property]) {
	                        normalizedPropertyValue = CSS.Hooks.templates[property][1];
	                    }
	                }

	                propertyValue = CSS.Normalizations.registered[property]("extract", element, normalizedPropertyValue);
	            }

	            /* If a (numeric) value wasn't produced via hook extraction or normalization, query the DOM. */
	            if (!/^[\d-]/.test(propertyValue)) {
	                /* For SVG elements, dimensional properties (which SVGAttribute() detects) are tweened via
	                   their HTML attribute values instead of their CSS style values. */
	                if (Data(element) && Data(element).isSVG && CSS.Names.SVGAttribute(property)) {
	                    /* Since the height/width attribute values must be set manually, they don't reflect computed values.
	                       Thus, we use use getBBox() to ensure we always get values for elements with undefined height/width attributes. */
	                    if (/^(height|width)$/i.test(property)) {
	                        /* Firefox throws an error if .getBBox() is called on an SVG that isn't attached to the DOM. */
	                        try {
	                            propertyValue = element.getBBox()[property];
	                        } catch (error) {
	                            propertyValue = 0;
	                        }
	                    /* Otherwise, access the attribute value directly. */
	                    } else {
	                        propertyValue = element.getAttribute(property);
	                    }
	                } else {
	                    propertyValue = computePropertyValue(element, CSS.Names.prefixCheck(property)[0]); /* GET */
	                }
	            }

	            /* Since property lookups are for animation purposes (which entails computing the numeric delta between start and end values),
	               convert CSS null-values to an integer of value 0. */
	            if (CSS.Values.isCSSNullValue(propertyValue)) {
	                propertyValue = 0;
	            }

	            if (Velocity.debug >= 2) console.log("Get " + property + ": " + propertyValue);

	            return propertyValue;
	        },

	        /* The singular setPropertyValue, which routes the logic for all normalizations, hooks, and standard CSS properties. */
	        setPropertyValue: function(element, property, propertyValue, rootPropertyValue, scrollData) {
	            var propertyName = property;

	            /* In order to be subjected to call options and element queueing, scroll animation is routed through Velocity as if it were a standard CSS property. */
	            if (property === "scroll") {
	                /* If a container option is present, scroll the container instead of the browser window. */
	                if (scrollData.container) {
	                    scrollData.container["scroll" + scrollData.direction] = propertyValue;
	                /* Otherwise, Velocity defaults to scrolling the browser window. */
	                } else {
	                    if (scrollData.direction === "Left") {
	                        window.scrollTo(propertyValue, scrollData.alternateValue);
	                    } else {
	                        window.scrollTo(scrollData.alternateValue, propertyValue);
	                    }
	                }
	            } else {
	                /* Transforms (translateX, rotateZ, etc.) are applied to a per-element transformCache object, which is manually flushed via flushTransformCache().
	                   Thus, for now, we merely cache transforms being SET. */
	                if (CSS.Normalizations.registered[property] && CSS.Normalizations.registered[property]("name", element) === "transform") {
	                    /* Perform a normalization injection. */
	                    /* Note: The normalization logic handles the transformCache updating. */
	                    CSS.Normalizations.registered[property]("inject", element, propertyValue);

	                    propertyName = "transform";
	                    propertyValue = Data(element).transformCache[property];
	                } else {
	                    /* Inject hooks. */
	                    if (CSS.Hooks.registered[property]) {
	                        var hookName = property,
	                            hookRoot = CSS.Hooks.getRoot(property);

	                        /* If a cached rootPropertyValue was not provided, query the DOM for the hookRoot's current value. */
	                        rootPropertyValue = rootPropertyValue || CSS.getPropertyValue(element, hookRoot); /* GET */

	                        propertyValue = CSS.Hooks.injectValue(hookName, propertyValue, rootPropertyValue);
	                        property = hookRoot;
	                    }

	                    /* Normalize names and values. */
	                    if (CSS.Normalizations.registered[property]) {
	                        propertyValue = CSS.Normalizations.registered[property]("inject", element, propertyValue);
	                        property = CSS.Normalizations.registered[property]("name", element);
	                    }

	                    /* Assign the appropriate vendor prefix before performing an official style update. */
	                    propertyName = CSS.Names.prefixCheck(property)[0];

	                    /* A try/catch is used for IE<=8, which throws an error when "invalid" CSS values are set, e.g. a negative width.
	                       Try/catch is avoided for other browsers since it incurs a performance overhead. */
	                    if (IE <= 8) {
	                        try {
	                            element.style[propertyName] = propertyValue;
	                        } catch (error) { if (Velocity.debug) console.log("Browser does not support [" + propertyValue + "] for [" + propertyName + "]"); }
	                    /* SVG elements have their dimensional properties (width, height, x, y, cx, etc.) applied directly as attributes instead of as styles. */
	                    /* Note: IE8 does not support SVG elements, so it's okay that we skip it for SVG animation. */
	                    } else if (Data(element) && Data(element).isSVG && CSS.Names.SVGAttribute(property)) {
	                        /* Note: For SVG attributes, vendor-prefixed property names are never used. */
	                        /* Note: Not all CSS properties can be animated via attributes, but the browser won't throw an error for unsupported properties. */
	                        element.setAttribute(property, propertyValue);
	                    } else {
	                        element.style[propertyName] = propertyValue;
	                    }

	                    if (Velocity.debug >= 2) console.log("Set " + property + " (" + propertyName + "): " + propertyValue);
	                }
	            }

	            /* Return the normalized property name and value in case the caller wants to know how these values were modified before being applied to the DOM. */
	            return [ propertyName, propertyValue ];
	        },

	        /* To increase performance by batching transform updates into a single SET, transforms are not directly applied to an element until flushTransformCache() is called. */
	        /* Note: Velocity applies transform properties in the same order that they are chronogically introduced to the element's CSS styles. */
	        flushTransformCache: function(element) {
	            var transformString = "";

	            /* Certain browsers require that SVG transforms be applied as an attribute. However, the SVG transform attribute takes a modified version of CSS's transform string
	               (units are dropped and, except for skewX/Y, subproperties are merged into their master property -- e.g. scaleX and scaleY are merged into scale(X Y). */
	            if ((IE || (Velocity.State.isAndroid && !Velocity.State.isChrome)) && Data(element).isSVG) {
	                /* Since transform values are stored in their parentheses-wrapped form, we use a helper function to strip out their numeric values.
	                   Further, SVG transform properties only take unitless (representing pixels) values, so it's okay that parseFloat() strips the unit suffixed to the float value. */
	                function getTransformFloat (transformProperty) {
	                    return parseFloat(CSS.getPropertyValue(element, transformProperty));
	                }

	                /* Create an object to organize all the transforms that we'll apply to the SVG element. To keep the logic simple,
	                   we process *all* transform properties -- even those that may not be explicitly applied (since they default to their zero-values anyway). */
	                var SVGTransforms = {
	                    translate: [ getTransformFloat("translateX"), getTransformFloat("translateY") ],
	                    skewX: [ getTransformFloat("skewX") ], skewY: [ getTransformFloat("skewY") ],
	                    /* If the scale property is set (non-1), use that value for the scaleX and scaleY values
	                       (this behavior mimics the result of animating all these properties at once on HTML elements). */
	                    scale: getTransformFloat("scale") !== 1 ? [ getTransformFloat("scale"), getTransformFloat("scale") ] : [ getTransformFloat("scaleX"), getTransformFloat("scaleY") ],
	                    /* Note: SVG's rotate transform takes three values: rotation degrees followed by the X and Y values
	                       defining the rotation's origin point. We ignore the origin values (default them to 0). */
	                    rotate: [ getTransformFloat("rotateZ"), 0, 0 ]
	                };

	                /* Iterate through the transform properties in the user-defined property map order.
	                   (This mimics the behavior of non-SVG transform animation.) */
	                $.each(Data(element).transformCache, function(transformName) {
	                    /* Except for with skewX/Y, revert the axis-specific transform subproperties to their axis-free master
	                       properties so that they match up with SVG's accepted transform properties. */
	                    if (/^translate/i.test(transformName)) {
	                        transformName = "translate";
	                    } else if (/^scale/i.test(transformName)) {
	                        transformName = "scale";
	                    } else if (/^rotate/i.test(transformName)) {
	                        transformName = "rotate";
	                    }

	                    /* Check that we haven't yet deleted the property from the SVGTransforms container. */
	                    if (SVGTransforms[transformName]) {
	                        /* Append the transform property in the SVG-supported transform format. As per the spec, surround the space-delimited values in parentheses. */
	                        transformString += transformName + "(" + SVGTransforms[transformName].join(" ") + ")" + " ";

	                        /* After processing an SVG transform property, delete it from the SVGTransforms container so we don't
	                           re-insert the same master property if we encounter another one of its axis-specific properties. */
	                        delete SVGTransforms[transformName];
	                    }
	                });
	            } else {
	                var transformValue,
	                    perspective;

	                /* Transform properties are stored as members of the transformCache object. Concatenate all the members into a string. */
	                $.each(Data(element).transformCache, function(transformName) {
	                    transformValue = Data(element).transformCache[transformName];

	                    /* Transform's perspective subproperty must be set first in order to take effect. Store it temporarily. */
	                    if (transformName === "transformPerspective") {
	                        perspective = transformValue;
	                        return true;
	                    }

	                    /* IE9 only supports one rotation type, rotateZ, which it refers to as "rotate". */
	                    if (IE === 9 && transformName === "rotateZ") {
	                        transformName = "rotate";
	                    }

	                    transformString += transformName + transformValue + " ";
	                });

	                /* If present, set the perspective subproperty first. */
	                if (perspective) {
	                    transformString = "perspective" + perspective + " " + transformString;
	                }
	            }

	            CSS.setPropertyValue(element, "transform", transformString);
	        }
	    };

	    /* Register hooks and normalizations. */
	    CSS.Hooks.register();
	    CSS.Normalizations.register();

	    /* Allow hook setting in the same fashion as jQuery's $.css(). */
	    Velocity.hook = function (elements, arg2, arg3) {
	        var value = undefined;

	        elements = sanitizeElements(elements);

	        $.each(elements, function(i, element) {
	            /* Initialize Velocity's per-element data cache if this element hasn't previously been animated. */
	            if (Data(element) === undefined) {
	                Velocity.init(element);
	            }

	            /* Get property value. If an element set was passed in, only return the value for the first element. */
	            if (arg3 === undefined) {
	                if (value === undefined) {
	                    value = Velocity.CSS.getPropertyValue(element, arg2);
	                }
	            /* Set property value. */
	            } else {
	                /* sPV returns an array of the normalized propertyName/propertyValue pair used to update the DOM. */
	                var adjustedSet = Velocity.CSS.setPropertyValue(element, arg2, arg3);

	                /* Transform properties don't automatically set. They have to be flushed to the DOM. */
	                if (adjustedSet[0] === "transform") {
	                    Velocity.CSS.flushTransformCache(element);
	                }

	                value = adjustedSet;
	            }
	        });

	        return value;
	    };

	    /*****************
	        Animation
	    *****************/

	    var animate = function() {

	        /******************
	            Call Chain
	        ******************/

	        /* Logic for determining what to return to the call stack when exiting out of Velocity. */
	        function getChain () {
	            /* If we are using the utility function, attempt to return this call's promise. If no promise library was detected,
	               default to null instead of returning the targeted elements so that utility function's return value is standardized. */
	            if (isUtility) {
	                return promiseData.promise || null;
	            /* Otherwise, if we're using $.fn, return the jQuery-/Zepto-wrapped element set. */
	            } else {
	                return elementsWrapped;
	            }
	        }

	        /*************************
	           Arguments Assignment
	        *************************/

	        /* To allow for expressive CoffeeScript code, Velocity supports an alternative syntax in which "elements" (or "e"), "properties" (or "p"), and "options" (or "o")
	           objects are defined on a container object that's passed in as Velocity's sole argument. */
	        /* Note: Some browsers automatically populate arguments with a "properties" object. We detect it by checking for its default "names" property. */
	        var syntacticSugar = (arguments[0] && (arguments[0].p || (($.isPlainObject(arguments[0].properties) && !arguments[0].properties.names) || Type.isString(arguments[0].properties)))),
	            /* Whether Velocity was called via the utility function (as opposed to on a jQuery/Zepto object). */
	            isUtility,
	            /* When Velocity is called via the utility function ($.Velocity()/Velocity()), elements are explicitly
	               passed in as the first parameter. Thus, argument positioning varies. We normalize them here. */
	            elementsWrapped,
	            argumentIndex;

	        var elements,
	            propertiesMap,
	            options;

	        /* Detect jQuery/Zepto elements being animated via the $.fn method. */
	        if (Type.isWrapped(this)) {
	            isUtility = false;

	            argumentIndex = 0;
	            elements = this;
	            elementsWrapped = this;
	        /* Otherwise, raw elements are being animated via the utility function. */
	        } else {
	            isUtility = true;

	            argumentIndex = 1;
	            elements = syntacticSugar ? (arguments[0].elements || arguments[0].e) : arguments[0];
	        }

	        elements = sanitizeElements(elements);

	        if (!elements) {
	            return;
	        }

	        if (syntacticSugar) {
	            propertiesMap = arguments[0].properties || arguments[0].p;
	            options = arguments[0].options || arguments[0].o;
	        } else {
	            propertiesMap = arguments[argumentIndex];
	            options = arguments[argumentIndex + 1];
	        }

	        /* The length of the element set (in the form of a nodeList or an array of elements) is defaulted to 1 in case a
	           single raw DOM element is passed in (which doesn't contain a length property). */
	        var elementsLength = elements.length,
	            elementsIndex = 0;

	        /***************************
	            Argument Overloading
	        ***************************/

	        /* Support is included for jQuery's argument overloading: $.animate(propertyMap [, duration] [, easing] [, complete]).
	           Overloading is detected by checking for the absence of an object being passed into options. */
	        /* Note: The stop and finish actions do not accept animation options, and are therefore excluded from this check. */
	        if (!/^(stop|finish)$/i.test(propertiesMap) && !$.isPlainObject(options)) {
	            /* The utility function shifts all arguments one position to the right, so we adjust for that offset. */
	            var startingArgumentPosition = argumentIndex + 1;

	            options = {};

	            /* Iterate through all options arguments */
	            for (var i = startingArgumentPosition; i < arguments.length; i++) {
	                /* Treat a number as a duration. Parse it out. */
	                /* Note: The following RegEx will return true if passed an array with a number as its first item.
	                   Thus, arrays are skipped from this check. */
	                if (!Type.isArray(arguments[i]) && (/^(fast|normal|slow)$/i.test(arguments[i]) || /^\d/.test(arguments[i]))) {
	                    options.duration = arguments[i];
	                /* Treat strings and arrays as easings. */
	                } else if (Type.isString(arguments[i]) || Type.isArray(arguments[i])) {
	                    options.easing = arguments[i];
	                /* Treat a function as a complete callback. */
	                } else if (Type.isFunction(arguments[i])) {
	                    options.complete = arguments[i];
	                }
	            }
	        }

	        /***************
	            Promises
	        ***************/

	        var promiseData = {
	                promise: null,
	                resolver: null,
	                rejecter: null
	            };

	        /* If this call was made via the utility function (which is the default method of invocation when jQuery/Zepto are not being used), and if
	           promise support was detected, create a promise object for this call and store references to its resolver and rejecter methods. The resolve
	           method is used when a call completes naturally or is prematurely stopped by the user. In both cases, completeCall() handles the associated
	           call cleanup and promise resolving logic. The reject method is used when an invalid set of arguments is passed into a Velocity call. */
	        /* Note: Velocity employs a call-based queueing architecture, which means that stopping an animating element actually stops the full call that
	           triggered it -- not that one element exclusively. Similarly, there is one promise per call, and all elements targeted by a Velocity call are
	           grouped together for the purposes of resolving and rejecting a promise. */
	        if (isUtility && Velocity.Promise) {
	            promiseData.promise = new Velocity.Promise(function (resolve, reject) {
	                promiseData.resolver = resolve;
	                promiseData.rejecter = reject;
	            });
	        }

	        /*********************
	           Action Detection
	        *********************/

	        /* Velocity's behavior is categorized into "actions": Elements can either be specially scrolled into view,
	           or they can be started, stopped, or reversed. If a literal or referenced properties map is passed in as Velocity's
	           first argument, the associated action is "start". Alternatively, "scroll", "reverse", or "stop" can be passed in instead of a properties map. */
	        var action;

	        switch (propertiesMap) {
	            case "scroll":
	                action = "scroll";
	                break;

	            case "reverse":
	                action = "reverse";
	                break;

	            case "finish":
	            case "stop":
	                /*******************
	                    Action: Stop
	                *******************/

	                /* Clear the currently-active delay on each targeted element. */
	                $.each(elements, function(i, element) {
	                    if (Data(element) && Data(element).delayTimer) {
	                        /* Stop the timer from triggering its cached next() function. */
	                        clearTimeout(Data(element).delayTimer.setTimeout);

	                        /* Manually call the next() function so that the subsequent queue items can progress. */
	                        if (Data(element).delayTimer.next) {
	                            Data(element).delayTimer.next();
	                        }

	                        delete Data(element).delayTimer;
	                    }
	                });

	                var callsToStop = [];

	                /* When the stop action is triggered, the elements' currently active call is immediately stopped. The active call might have
	                   been applied to multiple elements, in which case all of the call's elements will be stopped. When an element
	                   is stopped, the next item in its animation queue is immediately triggered. */
	                /* An additional argument may be passed in to clear an element's remaining queued calls. Either true (which defaults to the "fx" queue)
	                   or a custom queue string can be passed in. */
	                /* Note: The stop command runs prior to Velocity's Queueing phase since its behavior is intended to take effect *immediately*,
	                   regardless of the element's current queue state. */

	                /* Iterate through every active call. */
	                $.each(Velocity.State.calls, function(i, activeCall) {
	                    /* Inactive calls are set to false by the logic inside completeCall(). Skip them. */
	                    if (activeCall) {
	                        /* Iterate through the active call's targeted elements. */
	                        $.each(activeCall[1], function(k, activeElement) {
	                            /* If true was passed in as a secondary argument, clear absolutely all calls on this element. Otherwise, only
	                               clear calls associated with the relevant queue. */
	                            /* Call stopping logic works as follows:
	                               - options === true --> stop current default queue calls (and queue:false calls), including remaining queued ones.
	                               - options === undefined --> stop current queue:"" call and all queue:false calls.
	                               - options === false --> stop only queue:false calls.
	                               - options === "custom" --> stop current queue:"custom" call, including remaining queued ones (there is no functionality to only clear the currently-running queue:"custom" call). */
	                            var queueName = (options === undefined) ? "" : options;

	                            if (queueName !== true && (activeCall[2].queue !== queueName) && !(options === undefined && activeCall[2].queue === false)) {
	                                return true;
	                            }

	                            /* Iterate through the calls targeted by the stop command. */
	                            $.each(elements, function(l, element) {                                
	                                /* Check that this call was applied to the target element. */
	                                if (element === activeElement) {
	                                    /* Optionally clear the remaining queued calls. */
	                                    if (options === true || Type.isString(options)) {
	                                        /* Iterate through the items in the element's queue. */
	                                        $.each($.queue(element, Type.isString(options) ? options : ""), function(_, item) {
	                                            /* The queue array can contain an "inprogress" string, which we skip. */
	                                            if (Type.isFunction(item)) {
	                                                /* Pass the item's callback a flag indicating that we want to abort from the queue call.
	                                                   (Specifically, the queue will resolve the call's associated promise then abort.)  */
	                                                item(null, true);
	                                            }
	                                        });

	                                        /* Clearing the $.queue() array is achieved by resetting it to []. */
	                                        $.queue(element, Type.isString(options) ? options : "", []);
	                                    }

	                                    if (propertiesMap === "stop") {
	                                        /* Since "reverse" uses cached start values (the previous call's endValues), these values must be
	                                           changed to reflect the final value that the elements were actually tweened to. */
	                                        /* Note: If only queue:false animations are currently running on an element, it won't have a tweensContainer
	                                           object. Also, queue:false animations can't be reversed. */
	                                        if (Data(element) && Data(element).tweensContainer && queueName !== false) {
	                                            $.each(Data(element).tweensContainer, function(m, activeTween) {
	                                                activeTween.endValue = activeTween.currentValue;
	                                            });
	                                        }

	                                        callsToStop.push(i);
	                                    } else if (propertiesMap === "finish") {
	                                        /* To get active tweens to finish immediately, we forcefully shorten their durations to 1ms so that
	                                        they finish upon the next rAf tick then proceed with normal call completion logic. */
	                                        activeCall[2].duration = 1;
	                                    }
	                                }
	                            });
	                        });
	                    }
	                });

	                /* Prematurely call completeCall() on each matched active call. Pass an additional flag for "stop" to indicate
	                   that the complete callback and display:none setting should be skipped since we're completing prematurely. */
	                if (propertiesMap === "stop") {
	                    $.each(callsToStop, function(i, j) {
	                        completeCall(j, true);
	                    });

	                    if (promiseData.promise) {
	                        /* Immediately resolve the promise associated with this stop call since stop runs synchronously. */
	                        promiseData.resolver(elements);
	                    }
	                }

	                /* Since we're stopping, and not proceeding with queueing, exit out of Velocity. */
	                return getChain();

	            default:
	                /* Treat a non-empty plain object as a literal properties map. */
	                if ($.isPlainObject(propertiesMap) && !Type.isEmptyObject(propertiesMap)) {
	                    action = "start";

	                /****************
	                    Redirects
	                ****************/

	                /* Check if a string matches a registered redirect (see Redirects above). */
	                } else if (Type.isString(propertiesMap) && Velocity.Redirects[propertiesMap]) {
	                    var opts = $.extend({}, options),
	                        durationOriginal = opts.duration,
	                        delayOriginal = opts.delay || 0;

	                    /* If the backwards option was passed in, reverse the element set so that elements animate from the last to the first. */
	                    if (opts.backwards === true) {
	                        elements = $.extend(true, [], elements).reverse();
	                    }

	                    /* Individually trigger the redirect for each element in the set to prevent users from having to handle iteration logic in their redirect. */
	                    $.each(elements, function(elementIndex, element) {
	                        /* If the stagger option was passed in, successively delay each element by the stagger value (in ms). Retain the original delay value. */
	                        if (parseFloat(opts.stagger)) {
	                            opts.delay = delayOriginal + (parseFloat(opts.stagger) * elementIndex);
	                        } else if (Type.isFunction(opts.stagger)) {
	                            opts.delay = delayOriginal + opts.stagger.call(element, elementIndex, elementsLength);
	                        }

	                        /* If the drag option was passed in, successively increase/decrease (depending on the presense of opts.backwards)
	                           the duration of each element's animation, using floors to prevent producing very short durations. */
	                        if (opts.drag) {
	                            /* Default the duration of UI pack effects (callouts and transitions) to 1000ms instead of the usual default duration of 400ms. */
	                            opts.duration = parseFloat(durationOriginal) || (/^(callout|transition)/.test(propertiesMap) ? 1000 : DURATION_DEFAULT);

	                            /* For each element, take the greater duration of: A) animation completion percentage relative to the original duration,
	                               B) 75% of the original duration, or C) a 200ms fallback (in case duration is already set to a low value).
	                               The end result is a baseline of 75% of the redirect's duration that increases/decreases as the end of the element set is approached. */
	                            opts.duration = Math.max(opts.duration * (opts.backwards ? 1 - elementIndex/elementsLength : (elementIndex + 1) / elementsLength), opts.duration * 0.75, 200);
	                        }

	                        /* Pass in the call's opts object so that the redirect can optionally extend it. It defaults to an empty object instead of null to
	                           reduce the opts checking logic required inside the redirect. */
	                        Velocity.Redirects[propertiesMap].call(element, element, opts || {}, elementIndex, elementsLength, elements, promiseData.promise ? promiseData : undefined);
	                    });

	                    /* Since the animation logic resides within the redirect's own code, abort the remainder of this call.
	                       (The performance overhead up to this point is virtually non-existant.) */
	                    /* Note: The jQuery call chain is kept intact by returning the complete element set. */
	                    return getChain();
	                } else {
	                    var abortError = "Velocity: First argument (" + propertiesMap + ") was not a property map, a known action, or a registered redirect. Aborting.";

	                    if (promiseData.promise) {
	                        promiseData.rejecter(new Error(abortError));
	                    } else {
	                        console.log(abortError);
	                    }

	                    return getChain();
	                }
	        }

	        /**************************
	            Call-Wide Variables
	        **************************/

	        /* A container for CSS unit conversion ratios (e.g. %, rem, and em ==> px) that is used to cache ratios across all elements
	           being animated in a single Velocity call. Calculating unit ratios necessitates DOM querying and updating, and is therefore
	           avoided (via caching) wherever possible. This container is call-wide instead of page-wide to avoid the risk of using stale
	           conversion metrics across Velocity animations that are not immediately consecutively chained. */
	        var callUnitConversionData = {
	                lastParent: null,
	                lastPosition: null,
	                lastFontSize: null,
	                lastPercentToPxWidth: null,
	                lastPercentToPxHeight: null,
	                lastEmToPx: null,
	                remToPx: null,
	                vwToPx: null,
	                vhToPx: null
	            };

	        /* A container for all the ensuing tween data and metadata associated with this call. This container gets pushed to the page-wide
	           Velocity.State.calls array that is processed during animation ticking. */
	        var call = [];

	        /************************
	           Element Processing
	        ************************/

	        /* Element processing consists of three parts -- data processing that cannot go stale and data processing that *can* go stale (i.e. third-party style modifications):
	           1) Pre-Queueing: Element-wide variables, including the element's data storage, are instantiated. Call options are prepared. If triggered, the Stop action is executed.
	           2) Queueing: The logic that runs once this call has reached its point of execution in the element's $.queue() stack. Most logic is placed here to avoid risking it becoming stale.
	           3) Pushing: Consolidation of the tween data followed by its push onto the global in-progress calls container.
	        */

	        function processElement () {

	            /*************************
	               Part I: Pre-Queueing
	            *************************/

	            /***************************
	               Element-Wide Variables
	            ***************************/

	            var element = this,
	                /* The runtime opts object is the extension of the current call's options and Velocity's page-wide option defaults. */
	                opts = $.extend({}, Velocity.defaults, options),
	                /* A container for the processed data associated with each property in the propertyMap.
	                   (Each property in the map produces its own "tween".) */
	                tweensContainer = {},
	                elementUnitConversionData;

	            /******************
	               Element Init
	            ******************/

	            if (Data(element) === undefined) {
	                Velocity.init(element);
	            }

	            /******************
	               Option: Delay
	            ******************/

	            /* Since queue:false doesn't respect the item's existing queue, we avoid injecting its delay here (it's set later on). */
	            /* Note: Velocity rolls its own delay function since jQuery doesn't have a utility alias for $.fn.delay()
	               (and thus requires jQuery element creation, which we avoid since its overhead includes DOM querying). */
	            if (parseFloat(opts.delay) && opts.queue !== false) {
	                $.queue(element, opts.queue, function(next) {
	                    /* This is a flag used to indicate to the upcoming completeCall() function that this queue entry was initiated by Velocity. See completeCall() for further details. */
	                    Velocity.velocityQueueEntryFlag = true;

	                    /* The ensuing queue item (which is assigned to the "next" argument that $.queue() automatically passes in) will be triggered after a setTimeout delay.
	                       The setTimeout is stored so that it can be subjected to clearTimeout() if this animation is prematurely stopped via Velocity's "stop" command. */
	                    Data(element).delayTimer = {
	                        setTimeout: setTimeout(next, parseFloat(opts.delay)),
	                        next: next
	                    };
	                });
	            }

	            /*********************
	               Option: Duration
	            *********************/

	            /* Support for jQuery's named durations. */
	            switch (opts.duration.toString().toLowerCase()) {
	                case "fast":
	                    opts.duration = 200;
	                    break;

	                case "normal":
	                    opts.duration = DURATION_DEFAULT;
	                    break;

	                case "slow":
	                    opts.duration = 600;
	                    break;

	                default:
	                    /* Remove the potential "ms" suffix and default to 1 if the user is attempting to set a duration of 0 (in order to produce an immediate style change). */
	                    opts.duration = parseFloat(opts.duration) || 1;
	            }

	            /************************
	               Global Option: Mock
	            ************************/

	            if (Velocity.mock !== false) {
	                /* In mock mode, all animations are forced to 1ms so that they occur immediately upon the next rAF tick.
	                   Alternatively, a multiplier can be passed in to time remap all delays and durations. */
	                if (Velocity.mock === true) {
	                    opts.duration = opts.delay = 1;
	                } else {
	                    opts.duration *= parseFloat(Velocity.mock) || 1;
	                    opts.delay *= parseFloat(Velocity.mock) || 1;
	                }
	            }

	            /*******************
	               Option: Easing
	            *******************/

	            opts.easing = getEasing(opts.easing, opts.duration);

	            /**********************
	               Option: Callbacks
	            **********************/

	            /* Callbacks must functions. Otherwise, default to null. */
	            if (opts.begin && !Type.isFunction(opts.begin)) {
	                opts.begin = null;
	            }

	            if (opts.progress && !Type.isFunction(opts.progress)) {
	                opts.progress = null;
	            }

	            if (opts.complete && !Type.isFunction(opts.complete)) {
	                opts.complete = null;
	            }

	            /*********************************
	               Option: Display & Visibility
	            *********************************/

	            /* Refer to Velocity's documentation (VelocityJS.org/#displayAndVisibility) for a description of the display and visibility options' behavior. */
	            /* Note: We strictly check for undefined instead of falsiness because display accepts an empty string value. */
	            if (opts.display !== undefined && opts.display !== null) {
	                opts.display = opts.display.toString().toLowerCase();

	                /* Users can pass in a special "auto" value to instruct Velocity to set the element to its default display value. */
	                if (opts.display === "auto") {
	                    opts.display = Velocity.CSS.Values.getDisplayType(element);
	                }
	            }

	            if (opts.visibility !== undefined && opts.visibility !== null) {
	                opts.visibility = opts.visibility.toString().toLowerCase();
	            }

	            /**********************
	               Option: mobileHA
	            **********************/

	            /* When set to true, and if this is a mobile device, mobileHA automatically enables hardware acceleration (via a null transform hack)
	               on animating elements. HA is removed from the element at the completion of its animation. */
	            /* Note: Android Gingerbread doesn't support HA. If a null transform hack (mobileHA) is in fact set, it will prevent other tranform subproperties from taking effect. */
	            /* Note: You can read more about the use of mobileHA in Velocity's documentation: VelocityJS.org/#mobileHA. */
	            opts.mobileHA = (opts.mobileHA && Velocity.State.isMobile && !Velocity.State.isGingerbread);

	            /***********************
	               Part II: Queueing
	            ***********************/

	            /* When a set of elements is targeted by a Velocity call, the set is broken up and each element has the current Velocity call individually queued onto it.
	               In this way, each element's existing queue is respected; some elements may already be animating and accordingly should not have this current Velocity call triggered immediately. */
	            /* In each queue, tween data is processed for each animating property then pushed onto the call-wide calls array. When the last element in the set has had its tweens processed,
	               the call array is pushed to Velocity.State.calls for live processing by the requestAnimationFrame tick. */
	            function buildQueue (next) {

	                /*******************
	                   Option: Begin
	                *******************/

	                /* The begin callback is fired once per call -- not once per elemenet -- and is passed the full raw DOM element set as both its context and its first argument. */
	                if (opts.begin && elementsIndex === 0) {
	                    /* We throw callbacks in a setTimeout so that thrown errors don't halt the execution of Velocity itself. */
	                    try {
	                        opts.begin.call(elements, elements);
	                    } catch (error) {
	                        setTimeout(function() { throw error; }, 1);
	                    }
	                }

	                /*****************************************
	                   Tween Data Construction (for Scroll)
	                *****************************************/

	                /* Note: In order to be subjected to chaining and animation options, scroll's tweening is routed through Velocity as if it were a standard CSS property animation. */
	                if (action === "scroll") {
	                    /* The scroll action uniquely takes an optional "offset" option -- specified in pixels -- that offsets the targeted scroll position. */
	                    var scrollDirection = (/^x$/i.test(opts.axis) ? "Left" : "Top"),
	                        scrollOffset = parseFloat(opts.offset) || 0,
	                        scrollPositionCurrent,
	                        scrollPositionCurrentAlternate,
	                        scrollPositionEnd;

	                    /* Scroll also uniquely takes an optional "container" option, which indicates the parent element that should be scrolled --
	                       as opposed to the browser window itself. This is useful for scrolling toward an element that's inside an overflowing parent element. */
	                    if (opts.container) {
	                        /* Ensure that either a jQuery object or a raw DOM element was passed in. */
	                        if (Type.isWrapped(opts.container) || Type.isNode(opts.container)) {
	                            /* Extract the raw DOM element from the jQuery wrapper. */
	                            opts.container = opts.container[0] || opts.container;
	                            /* Note: Unlike other properties in Velocity, the browser's scroll position is never cached since it so frequently changes
	                               (due to the user's natural interaction with the page). */
	                            scrollPositionCurrent = opts.container["scroll" + scrollDirection]; /* GET */

	                            /* $.position() values are relative to the container's currently viewable area (without taking into account the container's true dimensions
	                               -- say, for example, if the container was not overflowing). Thus, the scroll end value is the sum of the child element's position *and*
	                               the scroll container's current scroll position. */
	                            scrollPositionEnd = (scrollPositionCurrent + $(element).position()[scrollDirection.toLowerCase()]) + scrollOffset; /* GET */
	                        /* If a value other than a jQuery object or a raw DOM element was passed in, default to null so that this option is ignored. */
	                        } else {
	                            opts.container = null;
	                        }
	                    } else {
	                        /* If the window itself is being scrolled -- not a containing element -- perform a live scroll position lookup using
	                           the appropriate cached property names (which differ based on browser type). */
	                        scrollPositionCurrent = Velocity.State.scrollAnchor[Velocity.State["scrollProperty" + scrollDirection]]; /* GET */
	                        /* When scrolling the browser window, cache the alternate axis's current value since window.scrollTo() doesn't let us change only one value at a time. */
	                        scrollPositionCurrentAlternate = Velocity.State.scrollAnchor[Velocity.State["scrollProperty" + (scrollDirection === "Left" ? "Top" : "Left")]]; /* GET */

	                        /* Unlike $.position(), $.offset() values are relative to the browser window's true dimensions -- not merely its currently viewable area --
	                           and therefore end values do not need to be compounded onto current values. */
	                        scrollPositionEnd = $(element).offset()[scrollDirection.toLowerCase()] + scrollOffset; /* GET */
	                    }

	                    /* Since there's only one format that scroll's associated tweensContainer can take, we create it manually. */
	                    tweensContainer = {
	                        scroll: {
	                            rootPropertyValue: false,
	                            startValue: scrollPositionCurrent,
	                            currentValue: scrollPositionCurrent,
	                            endValue: scrollPositionEnd,
	                            unitType: "",
	                            easing: opts.easing,
	                            scrollData: {
	                                container: opts.container,
	                                direction: scrollDirection,
	                                alternateValue: scrollPositionCurrentAlternate
	                            }
	                        },
	                        element: element
	                    };

	                    if (Velocity.debug) console.log("tweensContainer (scroll): ", tweensContainer.scroll, element);

	                /******************************************
	                   Tween Data Construction (for Reverse)
	                ******************************************/

	                /* Reverse acts like a "start" action in that a property map is animated toward. The only difference is
	                   that the property map used for reverse is the inverse of the map used in the previous call. Thus, we manipulate
	                   the previous call to construct our new map: use the previous map's end values as our new map's start values. Copy over all other data. */
	                /* Note: Reverse can be directly called via the "reverse" parameter, or it can be indirectly triggered via the loop option. (Loops are composed of multiple reverses.) */
	                /* Note: Reverse calls do not need to be consecutively chained onto a currently-animating element in order to operate on cached values;
	                   there is no harm to reverse being called on a potentially stale data cache since reverse's behavior is simply defined
	                   as reverting to the element's values as they were prior to the previous *Velocity* call. */
	                } else if (action === "reverse") {
	                    /* Abort if there is no prior animation data to reverse to. */
	                    if (!Data(element).tweensContainer) {
	                        /* Dequeue the element so that this queue entry releases itself immediately, allowing subsequent queue entries to run. */
	                        $.dequeue(element, opts.queue);

	                        return;
	                    } else {
	                        /*********************
	                           Options Parsing
	                        *********************/

	                        /* If the element was hidden via the display option in the previous call,
	                           revert display to "auto" prior to reversal so that the element is visible again. */
	                        if (Data(element).opts.display === "none") {
	                            Data(element).opts.display = "auto";
	                        }

	                        if (Data(element).opts.visibility === "hidden") {
	                            Data(element).opts.visibility = "visible";
	                        }

	                        /* If the loop option was set in the previous call, disable it so that "reverse" calls aren't recursively generated.
	                           Further, remove the previous call's callback options; typically, users do not want these to be refired. */
	                        Data(element).opts.loop = false;
	                        Data(element).opts.begin = null;
	                        Data(element).opts.complete = null;

	                        /* Since we're extending an opts object that has already been extended with the defaults options object,
	                           we remove non-explicitly-defined properties that are auto-assigned values. */
	                        if (!options.easing) {
	                            delete opts.easing;
	                        }

	                        if (!options.duration) {
	                            delete opts.duration;
	                        }

	                        /* The opts object used for reversal is an extension of the options object optionally passed into this
	                           reverse call plus the options used in the previous Velocity call. */
	                        opts = $.extend({}, Data(element).opts, opts);

	                        /*************************************
	                           Tweens Container Reconstruction
	                        *************************************/

	                        /* Create a deepy copy (indicated via the true flag) of the previous call's tweensContainer. */
	                        var lastTweensContainer = $.extend(true, {}, Data(element).tweensContainer);

	                        /* Manipulate the previous tweensContainer by replacing its end values and currentValues with its start values. */
	                        for (var lastTween in lastTweensContainer) {
	                            /* In addition to tween data, tweensContainers contain an element property that we ignore here. */
	                            if (lastTween !== "element") {
	                                var lastStartValue = lastTweensContainer[lastTween].startValue;

	                                lastTweensContainer[lastTween].startValue = lastTweensContainer[lastTween].currentValue = lastTweensContainer[lastTween].endValue;
	                                lastTweensContainer[lastTween].endValue = lastStartValue;

	                                /* Easing is the only option that embeds into the individual tween data (since it can be defined on a per-property basis).
	                                   Accordingly, every property's easing value must be updated when an options object is passed in with a reverse call.
	                                   The side effect of this extensibility is that all per-property easing values are forcefully reset to the new value. */
	                                if (!Type.isEmptyObject(options)) {
	                                    lastTweensContainer[lastTween].easing = opts.easing;
	                                }

	                                if (Velocity.debug) console.log("reverse tweensContainer (" + lastTween + "): " + JSON.stringify(lastTweensContainer[lastTween]), element);
	                            }
	                        }

	                        tweensContainer = lastTweensContainer;
	                    }

	                /*****************************************
	                   Tween Data Construction (for Start)
	                *****************************************/

	                } else if (action === "start") {

	                    /*************************
	                        Value Transferring
	                    *************************/

	                    /* If this queue entry follows a previous Velocity-initiated queue entry *and* if this entry was created
	                       while the element was in the process of being animated by Velocity, then this current call is safe to use
	                       the end values from the prior call as its start values. Velocity attempts to perform this value transfer
	                       process whenever possible in order to avoid requerying the DOM. */
	                    /* If values aren't transferred from a prior call and start values were not forcefed by the user (more on this below),
	                       then the DOM is queried for the element's current values as a last resort. */
	                    /* Note: Conversely, animation reversal (and looping) *always* perform inter-call value transfers; they never requery the DOM. */
	                    var lastTweensContainer;

	                    /* The per-element isAnimating flag is used to indicate whether it's safe (i.e. the data isn't stale)
	                       to transfer over end values to use as start values. If it's set to true and there is a previous
	                       Velocity call to pull values from, do so. */
	                    if (Data(element).tweensContainer && Data(element).isAnimating === true) {
	                        lastTweensContainer = Data(element).tweensContainer;
	                    }

	                    /***************************
	                       Tween Data Calculation
	                    ***************************/

	                    /* This function parses property data and defaults endValue, easing, and startValue as appropriate. */
	                    /* Property map values can either take the form of 1) a single value representing the end value,
	                       or 2) an array in the form of [ endValue, [, easing] [, startValue] ].
	                       The optional third parameter is a forcefed startValue to be used instead of querying the DOM for
	                       the element's current value. Read Velocity's docmentation to learn more about forcefeeding: VelocityJS.org/#forcefeeding */
	                    function parsePropertyValue (valueData, skipResolvingEasing) {
	                        var endValue = undefined,
	                            easing = undefined,
	                            startValue = undefined;

	                        /* Handle the array format, which can be structured as one of three potential overloads:
	                           A) [ endValue, easing, startValue ], B) [ endValue, easing ], or C) [ endValue, startValue ] */
	                        if (Type.isArray(valueData)) {
	                            /* endValue is always the first item in the array. Don't bother validating endValue's value now
	                               since the ensuing property cycling logic does that. */
	                            endValue = valueData[0];

	                            /* Two-item array format: If the second item is a number, function, or hex string, treat it as a
	                               start value since easings can only be non-hex strings or arrays. */
	                            if ((!Type.isArray(valueData[1]) && /^[\d-]/.test(valueData[1])) || Type.isFunction(valueData[1]) || CSS.RegEx.isHex.test(valueData[1])) {
	                                startValue = valueData[1];
	                            /* Two or three-item array: If the second item is a non-hex string or an array, treat it as an easing. */
	                            } else if ((Type.isString(valueData[1]) && !CSS.RegEx.isHex.test(valueData[1])) || Type.isArray(valueData[1])) {
	                                easing = skipResolvingEasing ? valueData[1] : getEasing(valueData[1], opts.duration);

	                                /* Don't bother validating startValue's value now since the ensuing property cycling logic inherently does that. */
	                                if (valueData[2] !== undefined) {
	                                    startValue = valueData[2];
	                                }
	                            }
	                        /* Handle the single-value format. */
	                        } else {
	                            endValue = valueData;
	                        }

	                        /* Default to the call's easing if a per-property easing type was not defined. */
	                        if (!skipResolvingEasing) {
	                            easing = easing || opts.easing;
	                        }

	                        /* If functions were passed in as values, pass the function the current element as its context,
	                           plus the element's index and the element set's size as arguments. Then, assign the returned value. */
	                        if (Type.isFunction(endValue)) {
	                            endValue = endValue.call(element, elementsIndex, elementsLength);
	                        }

	                        if (Type.isFunction(startValue)) {
	                            startValue = startValue.call(element, elementsIndex, elementsLength);
	                        }

	                        /* Allow startValue to be left as undefined to indicate to the ensuing code that its value was not forcefed. */
	                        return [ endValue || 0, easing, startValue ];
	                    }

	                    /* Cycle through each property in the map, looking for shorthand color properties (e.g. "color" as opposed to "colorRed"). Inject the corresponding
	                       colorRed, colorGreen, and colorBlue RGB component tweens into the propertiesMap (which Velocity understands) and remove the shorthand property. */
	                    $.each(propertiesMap, function(property, value) {
	                        /* Find shorthand color properties that have been passed a hex string. */
	                        if (RegExp("^" + CSS.Lists.colors.join("$|^") + "$").test(property)) {
	                            /* Parse the value data for each shorthand. */
	                            var valueData = parsePropertyValue(value, true),
	                                endValue = valueData[0],
	                                easing = valueData[1],
	                                startValue = valueData[2];

	                            if (CSS.RegEx.isHex.test(endValue)) {
	                                /* Convert the hex strings into their RGB component arrays. */
	                                var colorComponents = [ "Red", "Green", "Blue" ],
	                                    endValueRGB = CSS.Values.hexToRgb(endValue),
	                                    startValueRGB = startValue ? CSS.Values.hexToRgb(startValue) : undefined;

	                                /* Inject the RGB component tweens into propertiesMap. */
	                                for (var i = 0; i < colorComponents.length; i++) {
	                                    var dataArray = [ endValueRGB[i] ];

	                                    if (easing) {
	                                        dataArray.push(easing);
	                                    }

	                                    if (startValueRGB !== undefined) {
	                                        dataArray.push(startValueRGB[i]);
	                                    }

	                                    propertiesMap[property + colorComponents[i]] = dataArray;
	                                }

	                                /* Remove the intermediary shorthand property entry now that we've processed it. */
	                                delete propertiesMap[property];
	                            }
	                        }
	                    });

	                    /* Create a tween out of each property, and append its associated data to tweensContainer. */
	                    for (var property in propertiesMap) {

	                        /**************************
	                           Start Value Sourcing
	                        **************************/

	                        /* Parse out endValue, easing, and startValue from the property's data. */
	                        var valueData = parsePropertyValue(propertiesMap[property]),
	                            endValue = valueData[0],
	                            easing = valueData[1],
	                            startValue = valueData[2];

	                        /* Now that the original property name's format has been used for the parsePropertyValue() lookup above,
	                           we force the property to its camelCase styling to normalize it for manipulation. */
	                        property = CSS.Names.camelCase(property);

	                        /* In case this property is a hook, there are circumstances where we will intend to work on the hook's root property and not the hooked subproperty. */
	                        var rootProperty = CSS.Hooks.getRoot(property),
	                            rootPropertyValue = false;

	                        /* Other than for the dummy tween property, properties that are not supported by the browser (and do not have an associated normalization) will
	                           inherently produce no style changes when set, so they are skipped in order to decrease animation tick overhead.
	                           Property support is determined via prefixCheck(), which returns a false flag when no supported is detected. */
	                        /* Note: Since SVG elements have some of their properties directly applied as HTML attributes,
	                           there is no way to check for their explicit browser support, and so we skip skip this check for them. */
	                        if (!Data(element).isSVG && rootProperty !== "tween" && CSS.Names.prefixCheck(rootProperty)[1] === false && CSS.Normalizations.registered[rootProperty] === undefined) {
	                            if (Velocity.debug) console.log("Skipping [" + rootProperty + "] due to a lack of browser support.");

	                            continue;
	                        }

	                        /* If the display option is being set to a non-"none" (e.g. "block") and opacity (filter on IE<=8) is being
	                           animated to an endValue of non-zero, the user's intention is to fade in from invisible, thus we forcefeed opacity
	                           a startValue of 0 if its startValue hasn't already been sourced by value transferring or prior forcefeeding. */
	                        if (((opts.display !== undefined && opts.display !== null && opts.display !== "none") || (opts.visibility !== undefined && opts.visibility !== "hidden")) && /opacity|filter/.test(property) && !startValue && endValue !== 0) {
	                            startValue = 0;
	                        }

	                        /* If values have been transferred from the previous Velocity call, extract the endValue and rootPropertyValue
	                           for all of the current call's properties that were *also* animated in the previous call. */
	                        /* Note: Value transferring can optionally be disabled by the user via the _cacheValues option. */
	                        if (opts._cacheValues && lastTweensContainer && lastTweensContainer[property]) {
	                            if (startValue === undefined) {
	                                startValue = lastTweensContainer[property].endValue + lastTweensContainer[property].unitType;
	                            }

	                            /* The previous call's rootPropertyValue is extracted from the element's data cache since that's the
	                               instance of rootPropertyValue that gets freshly updated by the tweening process, whereas the rootPropertyValue
	                               attached to the incoming lastTweensContainer is equal to the root property's value prior to any tweening. */
	                            rootPropertyValue = Data(element).rootPropertyValueCache[rootProperty];
	                        /* If values were not transferred from a previous Velocity call, query the DOM as needed. */
	                        } else {
	                            /* Handle hooked properties. */
	                            if (CSS.Hooks.registered[property]) {
	                               if (startValue === undefined) {
	                                    rootPropertyValue = CSS.getPropertyValue(element, rootProperty); /* GET */
	                                    /* Note: The following getPropertyValue() call does not actually trigger a DOM query;
	                                       getPropertyValue() will extract the hook from rootPropertyValue. */
	                                    startValue = CSS.getPropertyValue(element, property, rootPropertyValue);
	                                /* If startValue is already defined via forcefeeding, do not query the DOM for the root property's value;
	                                   just grab rootProperty's zero-value template from CSS.Hooks. This overwrites the element's actual
	                                   root property value (if one is set), but this is acceptable since the primary reason users forcefeed is
	                                   to avoid DOM queries, and thus we likewise avoid querying the DOM for the root property's value. */
	                                } else {
	                                    /* Grab this hook's zero-value template, e.g. "0px 0px 0px black". */
	                                    rootPropertyValue = CSS.Hooks.templates[rootProperty][1];
	                                }
	                            /* Handle non-hooked properties that haven't already been defined via forcefeeding. */
	                            } else if (startValue === undefined) {
	                                startValue = CSS.getPropertyValue(element, property); /* GET */
	                            }
	                        }

	                        /**************************
	                           Value Data Extraction
	                        **************************/

	                        var separatedValue,
	                            endValueUnitType,
	                            startValueUnitType,
	                            operator = false;

	                        /* Separates a property value into its numeric value and its unit type. */
	                        function separateValue (property, value) {
	                            var unitType,
	                                numericValue;

	                            numericValue = (value || "0")
	                                .toString()
	                                .toLowerCase()
	                                /* Match the unit type at the end of the value. */
	                                .replace(/[%A-z]+$/, function(match) {
	                                    /* Grab the unit type. */
	                                    unitType = match;

	                                    /* Strip the unit type off of value. */
	                                    return "";
	                                });

	                            /* If no unit type was supplied, assign one that is appropriate for this property (e.g. "deg" for rotateZ or "px" for width). */
	                            if (!unitType) {
	                                unitType = CSS.Values.getUnitType(property);
	                            }

	                            return [ numericValue, unitType ];
	                        }

	                        /* Separate startValue. */
	                        separatedValue = separateValue(property, startValue);
	                        startValue = separatedValue[0];
	                        startValueUnitType = separatedValue[1];

	                        /* Separate endValue, and extract a value operator (e.g. "+=", "-=") if one exists. */
	                        separatedValue = separateValue(property, endValue);
	                        endValue = separatedValue[0].replace(/^([+-\/*])=/, function(match, subMatch) {
	                            operator = subMatch;

	                            /* Strip the operator off of the value. */
	                            return "";
	                        });
	                        endValueUnitType = separatedValue[1];

	                        /* Parse float values from endValue and startValue. Default to 0 if NaN is returned. */
	                        startValue = parseFloat(startValue) || 0;
	                        endValue = parseFloat(endValue) || 0;

	                        /***************************************
	                           Property-Specific Value Conversion
	                        ***************************************/

	                        /* Custom support for properties that don't actually accept the % unit type, but where pollyfilling is trivial and relatively foolproof. */
	                        if (endValueUnitType === "%") {
	                            /* A %-value fontSize/lineHeight is relative to the parent's fontSize (as opposed to the parent's dimensions),
	                               which is identical to the em unit's behavior, so we piggyback off of that. */
	                            if (/^(fontSize|lineHeight)$/.test(property)) {
	                                /* Convert % into an em decimal value. */
	                                endValue = endValue / 100;
	                                endValueUnitType = "em";
	                            /* For scaleX and scaleY, convert the value into its decimal format and strip off the unit type. */
	                            } else if (/^scale/.test(property)) {
	                                endValue = endValue / 100;
	                                endValueUnitType = "";
	                            /* For RGB components, take the defined percentage of 255 and strip off the unit type. */
	                            } else if (/(Red|Green|Blue)$/i.test(property)) {
	                                endValue = (endValue / 100) * 255;
	                                endValueUnitType = "";
	                            }
	                        }

	                        /***************************
	                           Unit Ratio Calculation
	                        ***************************/

	                        /* When queried, the browser returns (most) CSS property values in pixels. Therefore, if an endValue with a unit type of
	                           %, em, or rem is animated toward, startValue must be converted from pixels into the same unit type as endValue in order
	                           for value manipulation logic (increment/decrement) to proceed. Further, if the startValue was forcefed or transferred
	                           from a previous call, startValue may also not be in pixels. Unit conversion logic therefore consists of two steps:
	                           1) Calculating the ratio of %/em/rem/vh/vw relative to pixels
	                           2) Converting startValue into the same unit of measurement as endValue based on these ratios. */
	                        /* Unit conversion ratios are calculated by inserting a sibling node next to the target node, copying over its position property,
	                           setting values with the target unit type then comparing the returned pixel value. */
	                        /* Note: Even if only one of these unit types is being animated, all unit ratios are calculated at once since the overhead
	                           of batching the SETs and GETs together upfront outweights the potential overhead
	                           of layout thrashing caused by re-querying for uncalculated ratios for subsequently-processed properties. */
	                        /* Todo: Shift this logic into the calls' first tick instance so that it's synced with RAF. */
	                        function calculateUnitRatios () {

	                            /************************
	                                Same Ratio Checks
	                            ************************/

	                            /* The properties below are used to determine whether the element differs sufficiently from this call's
	                               previously iterated element to also differ in its unit conversion ratios. If the properties match up with those
	                               of the prior element, the prior element's conversion ratios are used. Like most optimizations in Velocity,
	                               this is done to minimize DOM querying. */
	                            var sameRatioIndicators = {
	                                    myParent: element.parentNode || document.body, /* GET */
	                                    position: CSS.getPropertyValue(element, "position"), /* GET */
	                                    fontSize: CSS.getPropertyValue(element, "fontSize") /* GET */
	                                },
	                                /* Determine if the same % ratio can be used. % is based on the element's position value and its parent's width and height dimensions. */
	                                samePercentRatio = ((sameRatioIndicators.position === callUnitConversionData.lastPosition) && (sameRatioIndicators.myParent === callUnitConversionData.lastParent)),
	                                /* Determine if the same em ratio can be used. em is relative to the element's fontSize. */
	                                sameEmRatio = (sameRatioIndicators.fontSize === callUnitConversionData.lastFontSize);

	                            /* Store these ratio indicators call-wide for the next element to compare against. */
	                            callUnitConversionData.lastParent = sameRatioIndicators.myParent;
	                            callUnitConversionData.lastPosition = sameRatioIndicators.position;
	                            callUnitConversionData.lastFontSize = sameRatioIndicators.fontSize;

	                            /***************************
	                               Element-Specific Units
	                            ***************************/

	                            /* Note: IE8 rounds to the nearest pixel when returning CSS values, thus we perform conversions using a measurement
	                               of 100 (instead of 1) to give our ratios a precision of at least 2 decimal values. */
	                            var measurement = 100,
	                                unitRatios = {};

	                            if (!sameEmRatio || !samePercentRatio) {
	                                var dummy = Data(element).isSVG ? document.createElementNS("http://www.w3.org/2000/svg", "rect") : document.createElement("div");

	                                Velocity.init(dummy);
	                                sameRatioIndicators.myParent.appendChild(dummy);

	                                /* To accurately and consistently calculate conversion ratios, the element's cascaded overflow and box-sizing are stripped.
	                                   Similarly, since width/height can be artificially constrained by their min-/max- equivalents, these are controlled for as well. */
	                                /* Note: Overflow must be also be controlled for per-axis since the overflow property overwrites its per-axis values. */
	                                $.each([ "overflow", "overflowX", "overflowY" ], function(i, property) {
	                                    Velocity.CSS.setPropertyValue(dummy, property, "hidden");
	                                });
	                                Velocity.CSS.setPropertyValue(dummy, "position", sameRatioIndicators.position);
	                                Velocity.CSS.setPropertyValue(dummy, "fontSize", sameRatioIndicators.fontSize);
	                                Velocity.CSS.setPropertyValue(dummy, "boxSizing", "content-box");

	                                /* width and height act as our proxy properties for measuring the horizontal and vertical % ratios. */
	                                $.each([ "minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height" ], function(i, property) {
	                                    Velocity.CSS.setPropertyValue(dummy, property, measurement + "%");
	                                });
	                                /* paddingLeft arbitrarily acts as our proxy property for the em ratio. */
	                                Velocity.CSS.setPropertyValue(dummy, "paddingLeft", measurement + "em");

	                                /* Divide the returned value by the measurement to get the ratio between 1% and 1px. Default to 1 since working with 0 can produce Infinite. */
	                                unitRatios.percentToPxWidth = callUnitConversionData.lastPercentToPxWidth = (parseFloat(CSS.getPropertyValue(dummy, "width", null, true)) || 1) / measurement; /* GET */
	                                unitRatios.percentToPxHeight = callUnitConversionData.lastPercentToPxHeight = (parseFloat(CSS.getPropertyValue(dummy, "height", null, true)) || 1) / measurement; /* GET */
	                                unitRatios.emToPx = callUnitConversionData.lastEmToPx = (parseFloat(CSS.getPropertyValue(dummy, "paddingLeft")) || 1) / measurement; /* GET */

	                                sameRatioIndicators.myParent.removeChild(dummy);
	                            } else {
	                                unitRatios.emToPx = callUnitConversionData.lastEmToPx;
	                                unitRatios.percentToPxWidth = callUnitConversionData.lastPercentToPxWidth;
	                                unitRatios.percentToPxHeight = callUnitConversionData.lastPercentToPxHeight;
	                            }

	                            /***************************
	                               Element-Agnostic Units
	                            ***************************/

	                            /* Whereas % and em ratios are determined on a per-element basis, the rem unit only needs to be checked
	                               once per call since it's exclusively dependant upon document.body's fontSize. If this is the first time
	                               that calculateUnitRatios() is being run during this call, remToPx will still be set to its default value of null,
	                               so we calculate it now. */
	                            if (callUnitConversionData.remToPx === null) {
	                                /* Default to browsers' default fontSize of 16px in the case of 0. */
	                                callUnitConversionData.remToPx = parseFloat(CSS.getPropertyValue(document.body, "fontSize")) || 16; /* GET */
	                            }

	                            /* Similarly, viewport units are %-relative to the window's inner dimensions. */
	                            if (callUnitConversionData.vwToPx === null) {
	                                callUnitConversionData.vwToPx = parseFloat(window.innerWidth) / 100; /* GET */
	                                callUnitConversionData.vhToPx = parseFloat(window.innerHeight) / 100; /* GET */
	                            }

	                            unitRatios.remToPx = callUnitConversionData.remToPx;
	                            unitRatios.vwToPx = callUnitConversionData.vwToPx;
	                            unitRatios.vhToPx = callUnitConversionData.vhToPx;

	                            if (Velocity.debug >= 1) console.log("Unit ratios: " + JSON.stringify(unitRatios), element);

	                            return unitRatios;
	                        }

	                        /********************
	                           Unit Conversion
	                        ********************/

	                        /* The * and / operators, which are not passed in with an associated unit, inherently use startValue's unit. Skip value and unit conversion. */
	                        if (/[\/*]/.test(operator)) {
	                            endValueUnitType = startValueUnitType;
	                        /* If startValue and endValue differ in unit type, convert startValue into the same unit type as endValue so that if endValueUnitType
	                           is a relative unit (%, em, rem), the values set during tweening will continue to be accurately relative even if the metrics they depend
	                           on are dynamically changing during the course of the animation. Conversely, if we always normalized into px and used px for setting values, the px ratio
	                           would become stale if the original unit being animated toward was relative and the underlying metrics change during the animation. */
	                        /* Since 0 is 0 in any unit type, no conversion is necessary when startValue is 0 -- we just start at 0 with endValueUnitType. */
	                        } else if ((startValueUnitType !== endValueUnitType) && startValue !== 0) {
	                            /* Unit conversion is also skipped when endValue is 0, but *startValueUnitType* must be used for tween values to remain accurate. */
	                            /* Note: Skipping unit conversion here means that if endValueUnitType was originally a relative unit, the animation won't relatively
	                               match the underlying metrics if they change, but this is acceptable since we're animating toward invisibility instead of toward visibility,
	                               which remains past the point of the animation's completion. */
	                            if (endValue === 0) {
	                                endValueUnitType = startValueUnitType;
	                            } else {
	                                /* By this point, we cannot avoid unit conversion (it's undesirable since it causes layout thrashing).
	                                   If we haven't already, we trigger calculateUnitRatios(), which runs once per element per call. */
	                                elementUnitConversionData = elementUnitConversionData || calculateUnitRatios();

	                                /* The following RegEx matches CSS properties that have their % values measured relative to the x-axis. */
	                                /* Note: W3C spec mandates that all of margin and padding's properties (even top and bottom) are %-relative to the *width* of the parent element. */
	                                var axis = (/margin|padding|left|right|width|text|word|letter/i.test(property) || /X$/.test(property) || property === "x") ? "x" : "y";

	                                /* In order to avoid generating n^2 bespoke conversion functions, unit conversion is a two-step process:
	                                   1) Convert startValue into pixels. 2) Convert this new pixel value into endValue's unit type. */
	                                switch (startValueUnitType) {
	                                    case "%":
	                                        /* Note: translateX and translateY are the only properties that are %-relative to an element's own dimensions -- not its parent's dimensions.
	                                           Velocity does not include a special conversion process to account for this behavior. Therefore, animating translateX/Y from a % value
	                                           to a non-% value will produce an incorrect start value. Fortunately, this sort of cross-unit conversion is rarely done by users in practice. */
	                                        startValue *= (axis === "x" ? elementUnitConversionData.percentToPxWidth : elementUnitConversionData.percentToPxHeight);
	                                        break;

	                                    case "px":
	                                        /* px acts as our midpoint in the unit conversion process; do nothing. */
	                                        break;

	                                    default:
	                                        startValue *= elementUnitConversionData[startValueUnitType + "ToPx"];
	                                }

	                                /* Invert the px ratios to convert into to the target unit. */
	                                switch (endValueUnitType) {
	                                    case "%":
	                                        startValue *= 1 / (axis === "x" ? elementUnitConversionData.percentToPxWidth : elementUnitConversionData.percentToPxHeight);
	                                        break;

	                                    case "px":
	                                        /* startValue is already in px, do nothing; we're done. */
	                                        break;

	                                    default:
	                                        startValue *= 1 / elementUnitConversionData[endValueUnitType + "ToPx"];
	                                }
	                            }
	                        }

	                        /*********************
	                           Relative Values
	                        *********************/

	                        /* Operator logic must be performed last since it requires unit-normalized start and end values. */
	                        /* Note: Relative *percent values* do not behave how most people think; while one would expect "+=50%"
	                           to increase the property 1.5x its current value, it in fact increases the percent units in absolute terms:
	                           50 points is added on top of the current % value. */
	                        switch (operator) {
	                            case "+":
	                                endValue = startValue + endValue;
	                                break;

	                            case "-":
	                                endValue = startValue - endValue;
	                                break;

	                            case "*":
	                                endValue = startValue * endValue;
	                                break;

	                            case "/":
	                                endValue = startValue / endValue;
	                                break;
	                        }

	                        /**************************
	                           tweensContainer Push
	                        **************************/

	                        /* Construct the per-property tween object, and push it to the element's tweensContainer. */
	                        tweensContainer[property] = {
	                            rootPropertyValue: rootPropertyValue,
	                            startValue: startValue,
	                            currentValue: startValue,
	                            endValue: endValue,
	                            unitType: endValueUnitType,
	                            easing: easing
	                        };

	                        if (Velocity.debug) console.log("tweensContainer (" + property + "): " + JSON.stringify(tweensContainer[property]), element);
	                    }

	                    /* Along with its property data, store a reference to the element itself onto tweensContainer. */
	                    tweensContainer.element = element;
	                }

	                /*****************
	                    Call Push
	                *****************/

	                /* Note: tweensContainer can be empty if all of the properties in this call's property map were skipped due to not
	                   being supported by the browser. The element property is used for checking that the tweensContainer has been appended to. */
	                if (tweensContainer.element) {
	                    /* Apply the "velocity-animating" indicator class. */
	                    CSS.Values.addClass(element, "velocity-animating");

	                    /* The call array houses the tweensContainers for each element being animated in the current call. */
	                    call.push(tweensContainer);

	                    /* Store the tweensContainer and options if we're working on the default effects queue, so that they can be used by the reverse command. */
	                    if (opts.queue === "") {
	                        Data(element).tweensContainer = tweensContainer;
	                        Data(element).opts = opts;
	                    }

	                    /* Switch on the element's animating flag. */
	                    Data(element).isAnimating = true;

	                    /* Once the final element in this call's element set has been processed, push the call array onto
	                       Velocity.State.calls for the animation tick to immediately begin processing. */
	                    if (elementsIndex === elementsLength - 1) {
	                        /* Add the current call plus its associated metadata (the element set and the call's options) onto the global call container.
	                           Anything on this call container is subjected to tick() processing. */
	                        Velocity.State.calls.push([ call, elements, opts, null, promiseData.resolver ]);

	                        /* If the animation tick isn't running, start it. (Velocity shuts it off when there are no active calls to process.) */
	                        if (Velocity.State.isTicking === false) {
	                            Velocity.State.isTicking = true;

	                            /* Start the tick loop. */
	                            tick();
	                        }
	                    } else {
	                        elementsIndex++;
	                    }
	                }
	            }

	            /* When the queue option is set to false, the call skips the element's queue and fires immediately. */
	            if (opts.queue === false) {
	                /* Since this buildQueue call doesn't respect the element's existing queue (which is where a delay option would have been appended),
	                   we manually inject the delay property here with an explicit setTimeout. */
	                if (opts.delay) {
	                    setTimeout(buildQueue, opts.delay);
	                } else {
	                    buildQueue();
	                }
	            /* Otherwise, the call undergoes element queueing as normal. */
	            /* Note: To interoperate with jQuery, Velocity uses jQuery's own $.queue() stack for queuing logic. */
	            } else {
	                $.queue(element, opts.queue, function(next, clearQueue) {
	                    /* If the clearQueue flag was passed in by the stop command, resolve this call's promise. (Promises can only be resolved once,
	                       so it's fine if this is repeatedly triggered for each element in the associated call.) */
	                    if (clearQueue === true) {
	                        if (promiseData.promise) {
	                            promiseData.resolver(elements);
	                        }

	                        /* Do not continue with animation queueing. */
	                        return true;
	                    }

	                    /* This flag indicates to the upcoming completeCall() function that this queue entry was initiated by Velocity.
	                       See completeCall() for further details. */
	                    Velocity.velocityQueueEntryFlag = true;

	                    buildQueue(next);
	                });
	            }

	            /*********************
	                Auto-Dequeuing
	            *********************/

	            /* As per jQuery's $.queue() behavior, to fire the first non-custom-queue entry on an element, the element
	               must be dequeued if its queue stack consists *solely* of the current call. (This can be determined by checking
	               for the "inprogress" item that jQuery prepends to active queue stack arrays.) Regardless, whenever the element's
	               queue is further appended with additional items -- including $.delay()'s or even $.animate() calls, the queue's
	               first entry is automatically fired. This behavior contrasts that of custom queues, which never auto-fire. */
	            /* Note: When an element set is being subjected to a non-parallel Velocity call, the animation will not begin until
	               each one of the elements in the set has reached the end of its individually pre-existing queue chain. */
	            /* Note: Unfortunately, most people don't fully grasp jQuery's powerful, yet quirky, $.queue() function.
	               Lean more here: http://stackoverflow.com/questions/1058158/can-somebody-explain-jquery-queue-to-me */
	            if ((opts.queue === "" || opts.queue === "fx") && $.queue(element)[0] !== "inprogress") {
	                $.dequeue(element);
	            }
	        }

	        /**************************
	           Element Set Iteration
	        **************************/

	        /* If the "nodeType" property exists on the elements variable, we're animating a single element.
	           Place it in an array so that $.each() can iterate over it. */
	        $.each(elements, function(i, element) {
	            /* Ensure each element in a set has a nodeType (is a real element) to avoid throwing errors. */
	            if (Type.isNode(element)) {
	                processElement.call(element);
	            }
	        });

	        /******************
	           Option: Loop
	        ******************/

	        /* The loop option accepts an integer indicating how many times the element should loop between the values in the
	           current call's properties map and the element's property values prior to this call. */
	        /* Note: The loop option's logic is performed here -- after element processing -- because the current call needs
	           to undergo its queue insertion prior to the loop option generating its series of constituent "reverse" calls,
	           which chain after the current call. Two reverse calls (two "alternations") constitute one loop. */
	        var opts = $.extend({}, Velocity.defaults, options),
	            reverseCallsCount;

	        opts.loop = parseInt(opts.loop);
	        reverseCallsCount = (opts.loop * 2) - 1;

	        if (opts.loop) {
	            /* Double the loop count to convert it into its appropriate number of "reverse" calls.
	               Subtract 1 from the resulting value since the current call is included in the total alternation count. */
	            for (var x = 0; x < reverseCallsCount; x++) {
	                /* Since the logic for the reverse action occurs inside Queueing and therefore this call's options object
	                   isn't parsed until then as well, the current call's delay option must be explicitly passed into the reverse
	                   call so that the delay logic that occurs inside *Pre-Queueing* can process it. */
	                var reverseOptions = {
	                    delay: opts.delay,
	                    progress: opts.progress
	                };

	                /* If a complete callback was passed into this call, transfer it to the loop redirect's final "reverse" call
	                   so that it's triggered when the entire redirect is complete (and not when the very first animation is complete). */
	                if (x === reverseCallsCount - 1) {
	                    reverseOptions.display = opts.display;
	                    reverseOptions.visibility = opts.visibility;
	                    reverseOptions.complete = opts.complete;
	                }

	                animate(elements, "reverse", reverseOptions);
	            }
	        }

	        /***************
	            Chaining
	        ***************/

	        /* Return the elements back to the call chain, with wrapped elements taking precedence in case Velocity was called via the $.fn. extension. */
	        return getChain();
	    };

	    /* Turn Velocity into the animation function, extended with the pre-existing Velocity object. */
	    Velocity = $.extend(animate, Velocity);
	    /* For legacy support, also expose the literal animate method. */
	    Velocity.animate = animate;

	    /**************
	        Timing
	    **************/

	    /* Ticker function. */
	    var ticker = window.requestAnimationFrame || rAFShim;

	    /* Inactive browser tabs pause rAF, which results in all active animations immediately sprinting to their completion states when the tab refocuses.
	       To get around this, we dynamically switch rAF to setTimeout (which the browser *doesn't* pause) when the tab loses focus. We skip this for mobile
	       devices to avoid wasting battery power on inactive tabs. */
	    /* Note: Tab focus detection doesn't work on older versions of IE, but that's okay since they don't support rAF to begin with. */
	    if (!Velocity.State.isMobile && document.hidden !== undefined) {
	        document.addEventListener("visibilitychange", function() {
	            /* Reassign the rAF function (which the global tick() function uses) based on the tab's focus state. */
	            if (document.hidden) {
	                ticker = function(callback) {
	                    /* The tick function needs a truthy first argument in order to pass its internal timestamp check. */
	                    return setTimeout(function() { callback(true) }, 16);
	                };

	                /* The rAF loop has been paused by the browser, so we manually restart the tick. */
	                tick();
	            } else {
	                ticker = window.requestAnimationFrame || rAFShim;
	            }
	        });
	    }

	    /************
	        Tick
	    ************/

	    /* Note: All calls to Velocity are pushed to the Velocity.State.calls array, which is fully iterated through upon each tick. */
	    function tick (timestamp) {
	        /* An empty timestamp argument indicates that this is the first tick occurence since ticking was turned on.
	           We leverage this metadata to fully ignore the first tick pass since RAF's initial pass is fired whenever
	           the browser's next tick sync time occurs, which results in the first elements subjected to Velocity
	           calls being animated out of sync with any elements animated immediately thereafter. In short, we ignore
	           the first RAF tick pass so that elements being immediately consecutively animated -- instead of simultaneously animated
	           by the same Velocity call -- are properly batched into the same initial RAF tick and consequently remain in sync thereafter. */
	        if (timestamp) {
	            /* We ignore RAF's high resolution timestamp since it can be significantly offset when the browser is
	               under high stress; we opt for choppiness over allowing the browser to drop huge chunks of frames. */
	            var timeCurrent = (new Date).getTime();

	            /********************
	               Call Iteration
	            ********************/

	            var callsLength = Velocity.State.calls.length;

	            /* To speed up iterating over this array, it is compacted (falsey items -- calls that have completed -- are removed)
	               when its length has ballooned to a point that can impact tick performance. This only becomes necessary when animation
	               has been continuous with many elements over a long period of time; whenever all active calls are completed, completeCall() clears Velocity.State.calls. */
	            if (callsLength > 10000) {
	                Velocity.State.calls = compactSparseArray(Velocity.State.calls);
	            }

	            /* Iterate through each active call. */
	            for (var i = 0; i < callsLength; i++) {
	                /* When a Velocity call is completed, its Velocity.State.calls entry is set to false. Continue on to the next call. */
	                if (!Velocity.State.calls[i]) {
	                    continue;
	                }

	                /************************
	                   Call-Wide Variables
	                ************************/

	                var callContainer = Velocity.State.calls[i],
	                    call = callContainer[0],
	                    opts = callContainer[2],
	                    timeStart = callContainer[3],
	                    firstTick = !!timeStart,
	                    tweenDummyValue = null;

	                /* If timeStart is undefined, then this is the first time that this call has been processed by tick().
	                   We assign timeStart now so that its value is as close to the real animation start time as possible.
	                   (Conversely, had timeStart been defined when this call was added to Velocity.State.calls, the delay
	                   between that time and now would cause the first few frames of the tween to be skipped since
	                   percentComplete is calculated relative to timeStart.) */
	                /* Further, subtract 16ms (the approximate resolution of RAF) from the current time value so that the
	                   first tick iteration isn't wasted by animating at 0% tween completion, which would produce the
	                   same style value as the element's current value. */
	                if (!timeStart) {
	                    timeStart = Velocity.State.calls[i][3] = timeCurrent - 16;
	                }

	                /* The tween's completion percentage is relative to the tween's start time, not the tween's start value
	                   (which would result in unpredictable tween durations since JavaScript's timers are not particularly accurate).
	                   Accordingly, we ensure that percentComplete does not exceed 1. */
	                var percentComplete = Math.min((timeCurrent - timeStart) / opts.duration, 1);

	                /**********************
	                   Element Iteration
	                **********************/

	                /* For every call, iterate through each of the elements in its set. */
	                for (var j = 0, callLength = call.length; j < callLength; j++) {
	                    var tweensContainer = call[j],
	                        element = tweensContainer.element;

	                    /* Check to see if this element has been deleted midway through the animation by checking for the
	                       continued existence of its data cache. If it's gone, skip animating this element. */
	                    if (!Data(element)) {
	                        continue;
	                    }

	                    var transformPropertyExists = false;

	                    /**********************************
	                       Display & Visibility Toggling
	                    **********************************/

	                    /* If the display option is set to non-"none", set it upfront so that the element can become visible before tweening begins.
	                       (Otherwise, display's "none" value is set in completeCall() once the animation has completed.) */
	                    if (opts.display !== undefined && opts.display !== null && opts.display !== "none") {
	                        if (opts.display === "flex") {
	                            var flexValues = [ "-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex" ];

	                            $.each(flexValues, function(i, flexValue) {
	                                CSS.setPropertyValue(element, "display", flexValue);
	                            });
	                        }

	                        CSS.setPropertyValue(element, "display", opts.display);
	                    }

	                    /* Same goes with the visibility option, but its "none" equivalent is "hidden". */
	                    if (opts.visibility !== undefined && opts.visibility !== "hidden") {
	                        CSS.setPropertyValue(element, "visibility", opts.visibility);
	                    }

	                    /************************
	                       Property Iteration
	                    ************************/

	                    /* For every element, iterate through each property. */
	                    for (var property in tweensContainer) {
	                        /* Note: In addition to property tween data, tweensContainer contains a reference to its associated element. */
	                        if (property !== "element") {
	                            var tween = tweensContainer[property],
	                                currentValue,
	                                /* Easing can either be a pre-genereated function or a string that references a pre-registered easing
	                                   on the Velocity.Easings object. In either case, return the appropriate easing *function*. */
	                                easing = Type.isString(tween.easing) ? Velocity.Easings[tween.easing] : tween.easing;

	                            /******************************
	                               Current Value Calculation
	                            ******************************/

	                            /* If this is the last tick pass (if we've reached 100% completion for this tween),
	                               ensure that currentValue is explicitly set to its target endValue so that it's not subjected to any rounding. */
	                            if (percentComplete === 1) {
	                                currentValue = tween.endValue;
	                            /* Otherwise, calculate currentValue based on the current delta from startValue. */
	                            } else {
	                                var tweenDelta = tween.endValue - tween.startValue;
	                                currentValue = tween.startValue + (tweenDelta * easing(percentComplete, opts, tweenDelta));

	                                /* If no value change is occurring, don't proceed with DOM updating. */
	                                if (!firstTick && (currentValue === tween.currentValue)) {
	                                    continue;
	                                }
	                            }

	                            tween.currentValue = currentValue;

	                            /* If we're tweening a fake 'tween' property in order to log transition values, update the one-per-call variable so that
	                               it can be passed into the progress callback. */ 
	                            if (property === "tween") {
	                                tweenDummyValue = currentValue;
	                            } else {
	                                /******************
	                                   Hooks: Part I
	                                ******************/

	                                /* For hooked properties, the newly-updated rootPropertyValueCache is cached onto the element so that it can be used
	                                   for subsequent hooks in this call that are associated with the same root property. If we didn't cache the updated
	                                   rootPropertyValue, each subsequent update to the root property in this tick pass would reset the previous hook's
	                                   updates to rootPropertyValue prior to injection. A nice performance byproduct of rootPropertyValue caching is that
	                                   subsequently chained animations using the same hookRoot but a different hook can use this cached rootPropertyValue. */
	                                if (CSS.Hooks.registered[property]) {
	                                    var hookRoot = CSS.Hooks.getRoot(property),
	                                        rootPropertyValueCache = Data(element).rootPropertyValueCache[hookRoot];

	                                    if (rootPropertyValueCache) {
	                                        tween.rootPropertyValue = rootPropertyValueCache;
	                                    }
	                                }

	                                /*****************
	                                    DOM Update
	                                *****************/

	                                /* setPropertyValue() returns an array of the property name and property value post any normalization that may have been performed. */
	                                /* Note: To solve an IE<=8 positioning bug, the unit type is dropped when setting a property value of 0. */
	                                var adjustedSetData = CSS.setPropertyValue(element, /* SET */
	                                                                           property,
	                                                                           tween.currentValue + (parseFloat(currentValue) === 0 ? "" : tween.unitType),
	                                                                           tween.rootPropertyValue,
	                                                                           tween.scrollData);

	                                /*******************
	                                   Hooks: Part II
	                                *******************/

	                                /* Now that we have the hook's updated rootPropertyValue (the post-processed value provided by adjustedSetData), cache it onto the element. */
	                                if (CSS.Hooks.registered[property]) {
	                                    /* Since adjustedSetData contains normalized data ready for DOM updating, the rootPropertyValue needs to be re-extracted from its normalized form. ?? */
	                                    if (CSS.Normalizations.registered[hookRoot]) {
	                                        Data(element).rootPropertyValueCache[hookRoot] = CSS.Normalizations.registered[hookRoot]("extract", null, adjustedSetData[1]);
	                                    } else {
	                                        Data(element).rootPropertyValueCache[hookRoot] = adjustedSetData[1];
	                                    }
	                                }

	                                /***************
	                                   Transforms
	                                ***************/

	                                /* Flag whether a transform property is being animated so that flushTransformCache() can be triggered once this tick pass is complete. */
	                                if (adjustedSetData[0] === "transform") {
	                                    transformPropertyExists = true;
	                                }

	                            }
	                        }
	                    }

	                    /****************
	                        mobileHA
	                    ****************/

	                    /* If mobileHA is enabled, set the translate3d transform to null to force hardware acceleration.
	                       It's safe to override this property since Velocity doesn't actually support its animation (hooks are used in its place). */
	                    if (opts.mobileHA) {
	                        /* Don't set the null transform hack if we've already done so. */
	                        if (Data(element).transformCache.translate3d === undefined) {
	                            /* All entries on the transformCache object are later concatenated into a single transform string via flushTransformCache(). */
	                            Data(element).transformCache.translate3d = "(0px, 0px, 0px)";

	                            transformPropertyExists = true;
	                        }
	                    }

	                    if (transformPropertyExists) {
	                        CSS.flushTransformCache(element);
	                    }
	                }

	                /* The non-"none" display value is only applied to an element once -- when its associated call is first ticked through.
	                   Accordingly, it's set to false so that it isn't re-processed by this call in the next tick. */
	                if (opts.display !== undefined && opts.display !== "none") {
	                    Velocity.State.calls[i][2].display = false;
	                }
	                if (opts.visibility !== undefined && opts.visibility !== "hidden") {
	                    Velocity.State.calls[i][2].visibility = false;
	                }

	                /* Pass the elements and the timing data (percentComplete, msRemaining, timeStart, tweenDummyValue) into the progress callback. */
	                if (opts.progress) {
	                    opts.progress.call(callContainer[1],
	                                       callContainer[1],
	                                       percentComplete,
	                                       Math.max(0, (timeStart + opts.duration) - timeCurrent),
	                                       timeStart,
	                                       tweenDummyValue);
	                }

	                /* If this call has finished tweening, pass its index to completeCall() to handle call cleanup. */
	                if (percentComplete === 1) {
	                    completeCall(i);
	                }
	            }
	        }

	        /* Note: completeCall() sets the isTicking flag to false when the last call on Velocity.State.calls has completed. */
	        if (Velocity.State.isTicking) {
	            ticker(tick);
	        }
	    }

	    /**********************
	        Call Completion
	    **********************/

	    /* Note: Unlike tick(), which processes all active calls at once, call completion is handled on a per-call basis. */
	    function completeCall (callIndex, isStopped) {
	        /* Ensure the call exists. */
	        if (!Velocity.State.calls[callIndex]) {
	            return false;
	        }

	        /* Pull the metadata from the call. */
	        var call = Velocity.State.calls[callIndex][0],
	            elements = Velocity.State.calls[callIndex][1],
	            opts = Velocity.State.calls[callIndex][2],
	            resolver = Velocity.State.calls[callIndex][4];

	        var remainingCallsExist = false;

	        /*************************
	           Element Finalization
	        *************************/

	        for (var i = 0, callLength = call.length; i < callLength; i++) {
	            var element = call[i].element;

	            /* If the user set display to "none" (intending to hide the element), set it now that the animation has completed. */
	            /* Note: display:none isn't set when calls are manually stopped (via Velocity("stop"). */
	            /* Note: Display gets ignored with "reverse" calls and infinite loops, since this behavior would be undesirable. */
	            if (!isStopped && !opts.loop) {
	                if (opts.display === "none") {
	                    CSS.setPropertyValue(element, "display", opts.display);
	                }

	                if (opts.visibility === "hidden") {
	                    CSS.setPropertyValue(element, "visibility", opts.visibility);
	                }
	            }

	            /* If the element's queue is empty (if only the "inprogress" item is left at position 0) or if its queue is about to run
	               a non-Velocity-initiated entry, turn off the isAnimating flag. A non-Velocity-initiatied queue entry's logic might alter
	               an element's CSS values and thereby cause Velocity's cached value data to go stale. To detect if a queue entry was initiated by Velocity,
	               we check for the existence of our special Velocity.queueEntryFlag declaration, which minifiers won't rename since the flag
	               is assigned to jQuery's global $ object and thus exists out of Velocity's own scope. */
	            if (opts.loop !== true && ($.queue(element)[1] === undefined || !/\.velocityQueueEntryFlag/i.test($.queue(element)[1]))) {
	                /* The element may have been deleted. Ensure that its data cache still exists before acting on it. */
	                if (Data(element)) {
	                    Data(element).isAnimating = false;
	                    /* Clear the element's rootPropertyValueCache, which will become stale. */
	                    Data(element).rootPropertyValueCache = {};

	                    var transformHAPropertyExists = false;
	                    /* If any 3D transform subproperty is at its default value (regardless of unit type), remove it. */
	                    $.each(CSS.Lists.transforms3D, function(i, transformName) {
	                        var defaultValue = /^scale/.test(transformName) ? 1 : 0,
	                            currentValue = Data(element).transformCache[transformName];

	                        if (Data(element).transformCache[transformName] !== undefined && new RegExp("^\\(" + defaultValue + "[^.]").test(currentValue)) {
	                            transformHAPropertyExists = true;

	                            delete Data(element).transformCache[transformName];
	                        }
	                    });

	                    /* Mobile devices have hardware acceleration removed at the end of the animation in order to avoid hogging the GPU's memory. */
	                    if (opts.mobileHA) {
	                        transformHAPropertyExists = true;
	                        delete Data(element).transformCache.translate3d;
	                    }

	                    /* Flush the subproperty removals to the DOM. */
	                    if (transformHAPropertyExists) {
	                        CSS.flushTransformCache(element);
	                    }

	                    /* Remove the "velocity-animating" indicator class. */
	                    CSS.Values.removeClass(element, "velocity-animating");
	                }
	            }

	            /*********************
	               Option: Complete
	            *********************/

	            /* Complete is fired once per call (not once per element) and is passed the full raw DOM element set as both its context and its first argument. */
	            /* Note: Callbacks aren't fired when calls are manually stopped (via Velocity("stop"). */
	            if (!isStopped && opts.complete && !opts.loop && (i === callLength - 1)) {
	                /* We throw callbacks in a setTimeout so that thrown errors don't halt the execution of Velocity itself. */
	                try {
	                    opts.complete.call(elements, elements);
	                } catch (error) {
	                    setTimeout(function() { throw error; }, 1);
	                }
	            }

	            /**********************
	               Promise Resolving
	            **********************/

	            /* Note: Infinite loops don't return promises. */
	            if (resolver && opts.loop !== true) {
	                resolver(elements);
	            }

	            /****************************
	               Option: Loop (Infinite)
	            ****************************/

	            if (Data(element) && opts.loop === true && !isStopped) {
	                /* If a rotateX/Y/Z property is being animated to 360 deg with loop:true, swap tween start/end values to enable
	                   continuous iterative rotation looping. (Otherise, the element would just rotate back and forth.) */
	                $.each(Data(element).tweensContainer, function(propertyName, tweenContainer) {
	                    if (/^rotate/.test(propertyName) && parseFloat(tweenContainer.endValue) === 360) {
	                        tweenContainer.endValue = 0;
	                        tweenContainer.startValue = 360;
	                    }

	                    if (/^backgroundPosition/.test(propertyName) && parseFloat(tweenContainer.endValue) === 100 && tweenContainer.unitType === "%") {
	                        tweenContainer.endValue = 0;
	                        tweenContainer.startValue = 100;
	                    }
	                });

	                Velocity(element, "reverse", { loop: true, delay: opts.delay });
	            }

	            /***************
	               Dequeueing
	            ***************/

	            /* Fire the next call in the queue so long as this call's queue wasn't set to false (to trigger a parallel animation),
	               which would have already caused the next call to fire. Note: Even if the end of the animation queue has been reached,
	               $.dequeue() must still be called in order to completely clear jQuery's animation queue. */
	            if (opts.queue !== false) {
	                $.dequeue(element, opts.queue);
	            }
	        }

	        /************************
	           Calls Array Cleanup
	        ************************/

	        /* Since this call is complete, set it to false so that the rAF tick skips it. This array is later compacted via compactSparseArray().
	          (For performance reasons, the call is set to false instead of being deleted from the array: http://www.html5rocks.com/en/tutorials/speed/v8/) */
	        Velocity.State.calls[callIndex] = false;

	        /* Iterate through the calls array to determine if this was the final in-progress animation.
	           If so, set a flag to end ticking and clear the calls array. */
	        for (var j = 0, callsLength = Velocity.State.calls.length; j < callsLength; j++) {
	            if (Velocity.State.calls[j] !== false) {
	                remainingCallsExist = true;

	                break;
	            }
	        }

	        if (remainingCallsExist === false) {
	            /* tick() will detect this flag upon its next iteration and subsequently turn itself off. */
	            Velocity.State.isTicking = false;

	            /* Clear the calls array so that its length is reset. */
	            delete Velocity.State.calls;
	            Velocity.State.calls = [];
	        }
	    }

	    /******************
	        Frameworks
	    ******************/

	    /* Both jQuery and Zepto allow their $.fn object to be extended to allow wrapped elements to be subjected to plugin calls.
	       If either framework is loaded, register a "velocity" extension pointing to Velocity's core animate() method.  Velocity
	       also registers itself onto a global container (window.jQuery || window.Zepto || window) so that certain features are
	       accessible beyond just a per-element scope. This master object contains an .animate() method, which is later assigned to $.fn
	       (if jQuery or Zepto are present). Accordingly, Velocity can both act on wrapped DOM elements and stand alone for targeting raw DOM elements. */
	    global.Velocity = Velocity;

	    if (global !== window) {
	        /* Assign the element function to Velocity's core animate() method. */
	        global.fn.velocity = animate;
	        /* Assign the object function's defaults to Velocity's global defaults object. */
	        global.fn.velocity.defaults = Velocity.defaults;
	    }

	    /***********************
	       Packaged Redirects
	    ***********************/

	    /* slideUp, slideDown */
	    $.each([ "Down", "Up" ], function(i, direction) {
	        Velocity.Redirects["slide" + direction] = function (element, options, elementsIndex, elementsSize, elements, promiseData) {
	            var opts = $.extend({}, options),
	                begin = opts.begin,
	                complete = opts.complete,
	                computedValues = { height: "", marginTop: "", marginBottom: "", paddingTop: "", paddingBottom: "" },
	                inlineValues = {};

	            if (opts.display === undefined) {
	                /* Show the element before slideDown begins and hide the element after slideUp completes. */
	                /* Note: Inline elements cannot have dimensions animated, so they're reverted to inline-block. */
	                opts.display = (direction === "Down" ? (Velocity.CSS.Values.getDisplayType(element) === "inline" ? "inline-block" : "block") : "none");
	            }

	            opts.begin = function() {
	                /* If the user passed in a begin callback, fire it now. */
	                begin && begin.call(elements, elements);

	                /* Cache the elements' original vertical dimensional property values so that we can animate back to them. */
	                for (var property in computedValues) {
	                    inlineValues[property] = element.style[property];

	                    /* For slideDown, use forcefeeding to animate all vertical properties from 0. For slideUp,
	                       use forcefeeding to start from computed values and animate down to 0. */
	                    var propertyValue = Velocity.CSS.getPropertyValue(element, property);
	                    computedValues[property] = (direction === "Down") ? [ propertyValue, 0 ] : [ 0, propertyValue ];
	                }

	                /* Force vertical overflow content to clip so that sliding works as expected. */
	                inlineValues.overflow = element.style.overflow;
	                element.style.overflow = "hidden";
	            }

	            opts.complete = function() {
	                /* Reset element to its pre-slide inline values once its slide animation is complete. */
	                for (var property in inlineValues) {
	                    element.style[property] = inlineValues[property];
	                }

	                /* If the user passed in a complete callback, fire it now. */
	                complete && complete.call(elements, elements);
	                promiseData && promiseData.resolver(elements);
	            };

	            Velocity(element, computedValues, opts);
	        };
	    });

	    /* fadeIn, fadeOut */
	    $.each([ "In", "Out" ], function(i, direction) {
	        Velocity.Redirects["fade" + direction] = function (element, options, elementsIndex, elementsSize, elements, promiseData) {
	            var opts = $.extend({}, options),
	                propertiesMap = { opacity: (direction === "In") ? 1 : 0 },
	                originalComplete = opts.complete;

	            /* Since redirects are triggered individually for each element in the animated set, avoid repeatedly triggering
	               callbacks by firing them only when the final element has been reached. */
	            if (elementsIndex !== elementsSize - 1) {
	                opts.complete = opts.begin = null;
	            } else {
	                opts.complete = function() {
	                    if (originalComplete) {
	                        originalComplete.call(elements, elements);
	                    }

	                    promiseData && promiseData.resolver(elements);
	                }
	            }

	            /* If a display was passed in, use it. Otherwise, default to "none" for fadeOut or the element-specific default for fadeIn. */
	            /* Note: We allow users to pass in "null" to skip display setting altogether. */
	            if (opts.display === undefined) {
	                opts.display = (direction === "In" ? "auto" : "none");
	            }

	            Velocity(this, propertiesMap, opts);
	        };
	    });

	    return Velocity;
	}((window.jQuery || window.Zepto || window), window, document);
	}));

	/******************
	   Known Issues
	******************/

	/* The CSS spec mandates that the translateX/Y/Z transforms are %-relative to the element itself -- not its parent.
	Velocity, however, doesn't make this distinction. Thus, converting to or from the % unit with these subproperties
	will produce an inaccurate conversion value. The same issue exists with the cx/cy attributes of SVG circles and ellipses. */

/***/ },

/***/ 529:
/***/ function(module, exports, __webpack_require__) {

	/**********************
	   Velocity UI Pack
	**********************/

	/* VelocityJS.org UI Pack (5.0.4). (C) 2014 Julian Shapiro. MIT @license: en.wikipedia.org/wiki/MIT_License. Portions copyright Daniel Eden, Christian Pucci. */

	;(function (factory) {
	    /* CommonJS module. */
	    if (true ) {
	        module.exports = factory();
	    /* AMD module. */
	    } else if (typeof define === "function" && define.amd) {
	        define([ "velocity" ], factory);
	    /* Browser globals. */
	    } else {
	        factory();
	    }
	}(function() {
	return function (global, window, document, undefined) {

	    /*************
	        Checks
	    *************/

	    if (!global.Velocity || !global.Velocity.Utilities) {
	        window.console && console.log("Velocity UI Pack: Velocity must be loaded first. Aborting.");
	        return;
	    } else {
	        var Velocity = global.Velocity,
	            $ = Velocity.Utilities;
	    }

	    var velocityVersion = Velocity.version,
	        requiredVersion = { major: 1, minor: 1, patch: 0 };

	    function greaterSemver (primary, secondary) {
	        var versionInts = [];

	        if (!primary || !secondary) { return false; }

	        $.each([ primary, secondary ], function(i, versionObject) {
	            var versionIntsComponents = [];

	            $.each(versionObject, function(component, value) {
	                while (value.toString().length < 5) {
	                    value = "0" + value;
	                }
	                versionIntsComponents.push(value);
	            });

	            versionInts.push(versionIntsComponents.join(""))
	        });

	        return (parseFloat(versionInts[0]) > parseFloat(versionInts[1]));
	    }

	    if (greaterSemver(requiredVersion, velocityVersion)){
	        var abortError = "Velocity UI Pack: You need to update Velocity (jquery.velocity.js) to a newer version. Visit http://github.com/julianshapiro/velocity.";
	        alert(abortError);
	        throw new Error(abortError);
	    }

	    /************************
	       Effect Registration
	    ************************/

	    /* Note: RegisterUI is a legacy name. */
	    Velocity.RegisterEffect = Velocity.RegisterUI = function (effectName, properties) {
	        /* Animate the expansion/contraction of the elements' parent's height for In/Out effects. */
	        function animateParentHeight (elements, direction, totalDuration, stagger) {
	            var totalHeightDelta = 0,
	                parentNode;

	            /* Sum the total height (including padding and margin) of all targeted elements. */
	            $.each(elements.nodeType ? [ elements ] : elements, function(i, element) {
	                if (stagger) {
	                    /* Increase the totalDuration by the successive delay amounts produced by the stagger option. */
	                    totalDuration += i * stagger;
	                }

	                parentNode = element.parentNode;

	                $.each([ "height", "paddingTop", "paddingBottom", "marginTop", "marginBottom"], function(i, property) {
	                    totalHeightDelta += parseFloat(Velocity.CSS.getPropertyValue(element, property));
	                });
	            });

	            /* Animate the parent element's height adjustment (with a varying duration multiplier for aesthetic benefits). */
	            Velocity.animate(
	                parentNode,
	                { height: (direction === "In" ? "+" : "-") + "=" + totalHeightDelta },
	                { queue: false, easing: "ease-in-out", duration: totalDuration * (direction === "In" ? 0.6 : 1) }
	            );
	        }

	        /* Register a custom redirect for each effect. */
	        Velocity.Redirects[effectName] = function (element, redirectOptions, elementsIndex, elementsSize, elements, promiseData) {
	            var finalElement = (elementsIndex === elementsSize - 1);

	            if (typeof properties.defaultDuration === "function") {
	                properties.defaultDuration = properties.defaultDuration.call(elements, elements);
	            } else {
	                properties.defaultDuration = parseFloat(properties.defaultDuration);
	            }

	            /* Iterate through each effect's call array. */
	            for (var callIndex = 0; callIndex < properties.calls.length; callIndex++) {
	                var call = properties.calls[callIndex],
	                    propertyMap = call[0],
	                    redirectDuration = (redirectOptions.duration || properties.defaultDuration || 1000),
	                    durationPercentage = call[1],
	                    callOptions = call[2] || {},
	                    opts = {};

	                /* Assign the whitelisted per-call options. */
	                opts.duration = redirectDuration * (durationPercentage || 1);
	                opts.queue = redirectOptions.queue || "";
	                opts.easing = callOptions.easing || "ease";
	                opts.delay = parseFloat(callOptions.delay) || 0;
	                opts._cacheValues = callOptions._cacheValues || true;

	                /* Special processing for the first effect call. */
	                if (callIndex === 0) {
	                    /* If a delay was passed into the redirect, combine it with the first call's delay. */
	                    opts.delay += (parseFloat(redirectOptions.delay) || 0);

	                    if (elementsIndex === 0) {
	                        opts.begin = function() {
	                            /* Only trigger a begin callback on the first effect call with the first element in the set. */
	                            redirectOptions.begin && redirectOptions.begin.call(elements, elements);

	                            var direction = effectName.match(/(In|Out)$/);

	                            /* Make "in" transitioning elements invisible immediately so that there's no FOUC between now
	                               and the first RAF tick. */
	                            if ((direction && direction[0] === "In") && propertyMap.opacity !== undefined) {
	                                $.each(elements.nodeType ? [ elements ] : elements, function(i, element) {
	                                    Velocity.CSS.setPropertyValue(element, "opacity", 0);
	                                });
	                            }

	                            /* Only trigger animateParentHeight() if we're using an In/Out transition. */
	                            if (redirectOptions.animateParentHeight && direction) {
	                                animateParentHeight(elements, direction[0], redirectDuration + opts.delay, redirectOptions.stagger);
	                            }
	                        }
	                    }

	                    /* If the user isn't overriding the display option, default to "auto" for "In"-suffixed transitions. */
	                    if (redirectOptions.display !== null) {
	                        if (redirectOptions.display !== undefined && redirectOptions.display !== "none") {
	                            opts.display = redirectOptions.display;
	                        } else if (/In$/.test(effectName)) {
	                            /* Inline elements cannot be subjected to transforms, so we switch them to inline-block. */
	                            var defaultDisplay = Velocity.CSS.Values.getDisplayType(element);
	                            opts.display = (defaultDisplay === "inline") ? "inline-block" : defaultDisplay;
	                        }
	                    }

	                    if (redirectOptions.visibility && redirectOptions.visibility !== "hidden") {
	                        opts.visibility = redirectOptions.visibility;
	                    }
	                }

	                /* Special processing for the last effect call. */
	                if (callIndex === properties.calls.length - 1) {
	                    /* Append promise resolving onto the user's redirect callback. */
	                    function injectFinalCallbacks () {
	                        if ((redirectOptions.display === undefined || redirectOptions.display === "none") && /Out$/.test(effectName)) {
	                            $.each(elements.nodeType ? [ elements ] : elements, function(i, element) {
	                                Velocity.CSS.setPropertyValue(element, "display", "none");
	                            });
	                        }

	                        redirectOptions.complete && redirectOptions.complete.call(elements, elements);

	                        if (promiseData) {
	                            promiseData.resolver(elements || element);
	                        }
	                    }

	                    opts.complete = function() {
	                        if (properties.reset) {
	                            for (var resetProperty in properties.reset) {
	                                var resetValue = properties.reset[resetProperty];

	                                /* Format each non-array value in the reset property map to [ value, value ] so that changes apply
	                                   immediately and DOM querying is avoided (via forcefeeding). */
	                                /* Note: Don't forcefeed hooks, otherwise their hook roots will be defaulted to their null values. */
	                                if (Velocity.CSS.Hooks.registered[resetProperty] === undefined && (typeof resetValue === "string" || typeof resetValue === "number")) {
	                                    properties.reset[resetProperty] = [ properties.reset[resetProperty], properties.reset[resetProperty] ];
	                                }
	                            }

	                            /* So that the reset values are applied instantly upon the next rAF tick, use a zero duration and parallel queueing. */
	                            var resetOptions = { duration: 0, queue: false };

	                            /* Since the reset option uses up the complete callback, we trigger the user's complete callback at the end of ours. */
	                            if (finalElement) {
	                                resetOptions.complete = injectFinalCallbacks;
	                            }

	                            Velocity.animate(element, properties.reset, resetOptions);
	                        /* Only trigger the user's complete callback on the last effect call with the last element in the set. */
	                        } else if (finalElement) {
	                            injectFinalCallbacks();
	                        }
	                    };

	                    if (redirectOptions.visibility === "hidden") {
	                        opts.visibility = redirectOptions.visibility;
	                    }
	                }

	                Velocity.animate(element, propertyMap, opts);
	            }
	        };

	        /* Return the Velocity object so that RegisterUI calls can be chained. */
	        return Velocity;
	    };

	    /*********************
	       Packaged Effects
	    *********************/

	    /* Externalize the packagedEffects data so that they can optionally be modified and re-registered. */
	    /* Support: <=IE8: Callouts will have no effect, and transitions will simply fade in/out. IE9/Android 2.3: Most effects are fully supported, the rest fade in/out. All other browsers: full support. */
	    Velocity.RegisterEffect.packagedEffects =
	        {
	            /* Animate.css */
	            "callout.bounce": {
	                defaultDuration: 550,
	                calls: [
	                    [ { translateY: -30 }, 0.25 ],
	                    [ { translateY: 0 }, 0.125 ],
	                    [ { translateY: -15 }, 0.125 ],
	                    [ { translateY: 0 }, 0.25 ]
	                ]
	            },
	            /* Animate.css */
	            "callout.shake": {
	                defaultDuration: 800,
	                calls: [
	                    [ { translateX: -11 }, 0.125 ],
	                    [ { translateX: 11 }, 0.125 ],
	                    [ { translateX: -11 }, 0.125 ],
	                    [ { translateX: 11 }, 0.125 ],
	                    [ { translateX: -11 }, 0.125 ],
	                    [ { translateX: 11 }, 0.125 ],
	                    [ { translateX: -11 }, 0.125 ],
	                    [ { translateX: 0 }, 0.125 ]
	                ]
	            },
	            /* Animate.css */
	            "callout.flash": {
	                defaultDuration: 1100,
	                calls: [
	                    [ { opacity: [ 0, "easeInOutQuad", 1 ] }, 0.25 ],
	                    [ { opacity: [ 1, "easeInOutQuad" ] }, 0.25 ],
	                    [ { opacity: [ 0, "easeInOutQuad" ] }, 0.25 ],
	                    [ { opacity: [ 1, "easeInOutQuad" ] }, 0.25 ]
	                ]
	            },
	            /* Animate.css */
	            "callout.pulse": {
	                defaultDuration: 825,
	                calls: [
	                    [ { scaleX: 1.1, scaleY: 1.1 }, 0.50, { easing: "easeInExpo" } ],
	                    [ { scaleX: 1, scaleY: 1 }, 0.50 ]
	                ]
	            },
	            /* Animate.css */
	            "callout.swing": {
	                defaultDuration: 950,
	                calls: [
	                    [ { rotateZ: 15 }, 0.20 ],
	                    [ { rotateZ: -10 }, 0.20 ],
	                    [ { rotateZ: 5 }, 0.20 ],
	                    [ { rotateZ: -5 }, 0.20 ],
	                    [ { rotateZ: 0 }, 0.20 ]
	                ]
	            },
	            /* Animate.css */
	            "callout.tada": {
	                defaultDuration: 1000,
	                calls: [
	                    [ { scaleX: 0.9, scaleY: 0.9, rotateZ: -3 }, 0.10 ],
	                    [ { scaleX: 1.1, scaleY: 1.1, rotateZ: 3 }, 0.10 ],
	                    [ { scaleX: 1.1, scaleY: 1.1, rotateZ: -3 }, 0.10 ],
	                    [ "reverse", 0.125 ],
	                    [ "reverse", 0.125 ],
	                    [ "reverse", 0.125 ],
	                    [ "reverse", 0.125 ],
	                    [ "reverse", 0.125 ],
	                    [ { scaleX: 1, scaleY: 1, rotateZ: 0 }, 0.20 ]
	                ]
	            },
	            "transition.fadeIn": {
	                defaultDuration: 500,
	                calls: [
	                    [ { opacity: [ 1, 0 ] } ]
	                ]
	            },
	            "transition.fadeOut": {
	                defaultDuration: 500,
	                calls: [
	                    [ { opacity: [ 0, 1 ] } ]
	                ]
	            },
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipXIn": {
	                defaultDuration: 700,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 800, 800 ], rotateY: [ 0, -55 ] } ]
	                ],
	                reset: { transformPerspective: 0 }
	            },
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipXOut": {
	                defaultDuration: 700,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 800, 800 ], rotateY: 55 } ]
	                ],
	                reset: { transformPerspective: 0, rotateY: 0 }
	            },
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipYIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 800, 800 ], rotateX: [ 0, -45 ] } ]
	                ],
	                reset: { transformPerspective: 0 }
	            },
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipYOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 800, 800 ], rotateX: 25 } ]
	                ],
	                reset: { transformPerspective: 0, rotateX: 0 }
	            },
	            /* Animate.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipBounceXIn": {
	                defaultDuration: 900,
	                calls: [
	                    [ { opacity: [ 0.725, 0 ], transformPerspective: [ 400, 400 ], rotateY: [ -10, 90 ] }, 0.50 ],
	                    [ { opacity: 0.80, rotateY: 10 }, 0.25 ],
	                    [ { opacity: 1, rotateY: 0 }, 0.25 ]
	                ],
	                reset: { transformPerspective: 0 }
	            },
	            /* Animate.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipBounceXOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 0.9, 1 ], transformPerspective: [ 400, 400 ], rotateY: -10 }, 0.50 ],
	                    [ { opacity: 0, rotateY: 90 }, 0.50 ]
	                ],
	                reset: { transformPerspective: 0, rotateY: 0 }
	            },
	            /* Animate.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipBounceYIn": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 0.725, 0 ], transformPerspective: [ 400, 400 ], rotateX: [ -10, 90 ] }, 0.50 ],
	                    [ { opacity: 0.80, rotateX: 10 }, 0.25 ],
	                    [ { opacity: 1, rotateX: 0 }, 0.25 ]
	                ],
	                reset: { transformPerspective: 0 }
	            },
	            /* Animate.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.flipBounceYOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 0.9, 1 ], transformPerspective: [ 400, 400 ], rotateX: -15 }, 0.50 ],
	                    [ { opacity: 0, rotateX: 90 }, 0.50 ]
	                ],
	                reset: { transformPerspective: 0, rotateX: 0 }
	            },
	            /* Magic.css */
	            "transition.swoopIn": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformOriginX: [ "100%", "50%" ], transformOriginY: [ "100%", "100%" ], scaleX: [ 1, 0 ], scaleY: [ 1, 0 ], translateX: [ 0, -700 ], translateZ: 0 } ]
	                ],
	                reset: { transformOriginX: "50%", transformOriginY: "50%" }
	            },
	            /* Magic.css */
	            "transition.swoopOut": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformOriginX: [ "50%", "100%" ], transformOriginY: [ "100%", "100%" ], scaleX: 0, scaleY: 0, translateX: -700, translateZ: 0 } ]
	                ],
	                reset: { transformOriginX: "50%", transformOriginY: "50%", scaleX: 1, scaleY: 1, translateX: 0 }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3. (Fades and scales only.) */
	            "transition.whirlIn": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: [ 1, 0 ], scaleY: [ 1, 0 ], rotateY: [ 0, 160 ] }, 1, { easing: "easeInOutSine" } ]
	                ]
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3. (Fades and scales only.) */
	            "transition.whirlOut": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 0, "easeInOutQuint", 1 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: 0, scaleY: 0, rotateY: 160 }, 1, { easing: "swing" } ]
	                ],
	                reset: { scaleX: 1, scaleY: 1, rotateY: 0 }
	            },
	            "transition.shrinkIn": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: [ 1, 1.5 ], scaleY: [ 1, 1.5 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.shrinkOut": {
	                defaultDuration: 600,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: 1.3, scaleY: 1.3, translateZ: 0 } ]
	                ],
	                reset: { scaleX: 1, scaleY: 1 }
	            },
	            "transition.expandIn": {
	                defaultDuration: 700,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: [ 1, 0.625 ], scaleY: [ 1, 0.625 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.expandOut": {
	                defaultDuration: 700,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformOriginX: [ "50%", "50%" ], transformOriginY: [ "50%", "50%" ], scaleX: 0.5, scaleY: 0.5, translateZ: 0 } ]
	                ],
	                reset: { scaleX: 1, scaleY: 1 }
	            },
	            /* Animate.css */
	            "transition.bounceIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], scaleX: [ 1.05, 0.3 ], scaleY: [ 1.05, 0.3 ] }, 0.40 ],
	                    [ { scaleX: 0.9, scaleY: 0.9, translateZ: 0 }, 0.20 ],
	                    [ { scaleX: 1, scaleY: 1 }, 0.50 ]
	                ]
	            },
	            /* Animate.css */
	            "transition.bounceOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { scaleX: 0.95, scaleY: 0.95 }, 0.35 ],
	                    [ { scaleX: 1.1, scaleY: 1.1, translateZ: 0 }, 0.35 ],
	                    [ { opacity: [ 0, 1 ], scaleX: 0.3, scaleY: 0.3 }, 0.30 ]
	                ],
	                reset: { scaleX: 1, scaleY: 1 }
	            },
	            /* Animate.css */
	            "transition.bounceUpIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ -30, 1000 ] }, 0.60, { easing: "easeOutCirc" } ],
	                    [ { translateY: 10 }, 0.20 ],
	                    [ { translateY: 0 }, 0.20 ]
	                ]
	            },
	            /* Animate.css */
	            "transition.bounceUpOut": {
	                defaultDuration: 1000,
	                calls: [
	                    [ { translateY: 20 }, 0.20 ],
	                    [ { opacity: [ 0, "easeInCirc", 1 ], translateY: -1000 }, 0.80 ]
	                ],
	                reset: { translateY: 0 }
	            },
	            /* Animate.css */
	            "transition.bounceDownIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ 30, -1000 ] }, 0.60, { easing: "easeOutCirc" } ],
	                    [ { translateY: -10 }, 0.20 ],
	                    [ { translateY: 0 }, 0.20 ]
	                ]
	            },
	            /* Animate.css */
	            "transition.bounceDownOut": {
	                defaultDuration: 1000,
	                calls: [
	                    [ { translateY: -20 }, 0.20 ],
	                    [ { opacity: [ 0, "easeInCirc", 1 ], translateY: 1000 }, 0.80 ]
	                ],
	                reset: { translateY: 0 }
	            },
	            /* Animate.css */
	            "transition.bounceLeftIn": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ 30, -1250 ] }, 0.60, { easing: "easeOutCirc" } ],
	                    [ { translateX: -10 }, 0.20 ],
	                    [ { translateX: 0 }, 0.20 ]
	                ]
	            },
	            /* Animate.css */
	            "transition.bounceLeftOut": {
	                defaultDuration: 750,
	                calls: [
	                    [ { translateX: 30 }, 0.20 ],
	                    [ { opacity: [ 0, "easeInCirc", 1 ], translateX: -1250 }, 0.80 ]
	                ],
	                reset: { translateX: 0 }
	            },
	            /* Animate.css */
	            "transition.bounceRightIn": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ -30, 1250 ] }, 0.60, { easing: "easeOutCirc" } ],
	                    [ { translateX: 10 }, 0.20 ],
	                    [ { translateX: 0 }, 0.20 ]
	                ]
	            },
	            /* Animate.css */
	            "transition.bounceRightOut": {
	                defaultDuration: 750,
	                calls: [
	                    [ { translateX: -30 }, 0.20 ],
	                    [ { opacity: [ 0, "easeInCirc", 1 ], translateX: 1250 }, 0.80 ]
	                ],
	                reset: { translateX: 0 }
	            },
	            "transition.slideUpIn": {
	                defaultDuration: 900,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ 0, 20 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideUpOut": {
	                defaultDuration: 900,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateY: -20, translateZ: 0 } ]
	                ],
	                reset: { translateY: 0 }
	            },
	            "transition.slideDownIn": {
	                defaultDuration: 900,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ 0, -20 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideDownOut": {
	                defaultDuration: 900,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateY: 20, translateZ: 0 } ]
	                ],
	                reset: { translateY: 0 }
	            },
	            "transition.slideLeftIn": {
	                defaultDuration: 1000,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ 0, -20 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideLeftOut": {
	                defaultDuration: 1050,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateX: -20, translateZ: 0 } ]
	                ],
	                reset: { translateX: 0 }
	            },
	            "transition.slideRightIn": {
	                defaultDuration: 1000,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ 0, 20 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideRightOut": {
	                defaultDuration: 1050,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateX: 20, translateZ: 0 } ]
	                ],
	                reset: { translateX: 0 }
	            },
	            "transition.slideUpBigIn": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ 0, 75 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideUpBigOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateY: -75, translateZ: 0 } ]
	                ],
	                reset: { translateY: 0 }
	            },
	            "transition.slideDownBigIn": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateY: [ 0, -75 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideDownBigOut": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateY: 75, translateZ: 0 } ]
	                ],
	                reset: { translateY: 0 }
	            },
	            "transition.slideLeftBigIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ 0, -75 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideLeftBigOut": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateX: -75, translateZ: 0 } ]
	                ],
	                reset: { translateX: 0 }
	            },
	            "transition.slideRightBigIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], translateX: [ 0, 75 ], translateZ: 0 } ]
	                ]
	            },
	            "transition.slideRightBigOut": {
	                defaultDuration: 750,
	                calls: [
	                    [ { opacity: [ 0, 1 ], translateX: 75, translateZ: 0 } ]
	                ],
	                reset: { translateX: 0 }
	            },
	            /* Magic.css */
	            "transition.perspectiveUpIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 800, 800 ], transformOriginX: [ 0, 0 ], transformOriginY: [ "100%", "100%" ], rotateX: [ 0, -180 ] } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%" }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveUpOut": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 800, 800 ], transformOriginX: [ 0, 0 ], transformOriginY: [ "100%", "100%" ], rotateX: -180 } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateX: 0 }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveDownIn": {
	                defaultDuration: 800,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 800, 800 ], transformOriginX: [ 0, 0 ], transformOriginY: [ 0, 0 ], rotateX: [ 0, 180 ] } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%" }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveDownOut": {
	                defaultDuration: 850,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 800, 800 ], transformOriginX: [ 0, 0 ], transformOriginY: [ 0, 0 ], rotateX: 180 } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateX: 0 }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveLeftIn": {
	                defaultDuration: 950,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 2000, 2000 ], transformOriginX: [ 0, 0 ], transformOriginY: [ 0, 0 ], rotateY: [ 0, -180 ] } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%" }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveLeftOut": {
	                defaultDuration: 950,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 2000, 2000 ], transformOriginX: [ 0, 0 ], transformOriginY: [ 0, 0 ], rotateY: -180 } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateY: 0 }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveRightIn": {
	                defaultDuration: 950,
	                calls: [
	                    [ { opacity: [ 1, 0 ], transformPerspective: [ 2000, 2000 ], transformOriginX: [ "100%", "100%" ], transformOriginY: [ 0, 0 ], rotateY: [ 0, 180 ] } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%" }
	            },
	            /* Magic.css */
	            /* Support: Loses rotation in IE9/Android 2.3 (fades only). */
	            "transition.perspectiveRightOut": {
	                defaultDuration: 950,
	                calls: [
	                    [ { opacity: [ 0, 1 ], transformPerspective: [ 2000, 2000 ], transformOriginX: [ "100%", "100%" ], transformOriginY: [ 0, 0 ], rotateY: 180 } ]
	                ],
	                reset: { transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateY: 0 }
	            }
	        };

	    /* Register the packaged effects. */
	    for (var effectName in Velocity.RegisterEffect.packagedEffects) {
	        Velocity.RegisterEffect(effectName, Velocity.RegisterEffect.packagedEffects[effectName]);
	    }

	    /*********************
	       Sequence Running
	    **********************/

	    /* Note: Sequence calls must use Velocity's single-object arguments syntax. */
	    Velocity.RunSequence = function (originalSequence) {
	        var sequence = $.extend(true, [], originalSequence);

	        if (sequence.length > 1) {
	            $.each(sequence.reverse(), function(i, currentCall) {
	                var nextCall = sequence[i + 1];

	                if (nextCall) {
	                    /* Parallel sequence calls (indicated via sequenceQueue:false) are triggered
	                       in the previous call's begin callback. Otherwise, chained calls are normally triggered
	                       in the previous call's complete callback. */
	                    var currentCallOptions = currentCall.o || currentCall.options,
	                        nextCallOptions = nextCall.o || nextCall.options;

	                    var timing = (currentCallOptions && currentCallOptions.sequenceQueue === false) ? "begin" : "complete",
	                        callbackOriginal = nextCallOptions && nextCallOptions[timing],
	                        options = {};

	                    options[timing] = function() {
	                        var nextCallElements = nextCall.e || nextCall.elements;
	                        var elements = nextCallElements.nodeType ? [ nextCallElements ] : nextCallElements;

	                        callbackOriginal && callbackOriginal.call(elements, elements);
	                        Velocity(currentCall);
	                    }

	                    if (nextCall.o) {
	                        nextCall.o = $.extend({}, nextCallOptions, options);
	                    } else {
	                        nextCall.options = $.extend({}, nextCallOptions, options);
	                    }
	                }
	            });

	            sequence.reverse();
	        }

	        Velocity(sequence[0]);
	    };
	}((window.jQuery || window.Zepto || window), window, document);
	}));

/***/ },

/***/ 530:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
	     _ _      _       _
	 ___| (_) ___| | __  (_)___
	/ __| | |/ __| |/ /  | / __|
	\__ \ | | (__|   < _ | \__ \
	|___/_|_|\___|_|\_(_)/ |___/
	                   |__/

	 Version: 1.6.0
	  Author: Ken Wheeler
	 Website: http://kenwheeler.github.io
	    Docs: http://kenwheeler.github.io/slick
	    Repo: http://github.com/kenwheeler/slick
	  Issues: http://github.com/kenwheeler/slick/issues

	 */
	/* global window, document, define, jQuery, setInterval, clearInterval */
	(function(factory) {
	    'use strict';
	    if (true) {
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(6)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	    } else if (typeof exports !== 'undefined') {
	        module.exports = factory(require('jquery'));
	    } else {
	        factory(jQuery);
	    }

	}(function($) {
	    'use strict';
	    var Slick = window.Slick || {};

	    Slick = (function() {

	        var instanceUid = 0;

	        function Slick(element, settings) {

	            var _ = this, dataSettings;

	            _.defaults = {
	                accessibility: true,
	                adaptiveHeight: false,
	                appendArrows: $(element),
	                appendDots: $(element),
	                arrows: true,
	                asNavFor: null,
	                prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
	                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
	                autoplay: false,
	                autoplaySpeed: 3000,
	                centerMode: false,
	                centerPadding: '50px',
	                cssEase: 'ease',
	                customPaging: function(slider, i) {
	                    return $('<button type="button" data-role="none" role="button" tabindex="0" />').text(i + 1);
	                },
	                dots: false,
	                dotsClass: 'slick-dots',
	                draggable: true,
	                easing: 'linear',
	                edgeFriction: 0.35,
	                fade: false,
	                focusOnSelect: false,
	                infinite: true,
	                initialSlide: 0,
	                lazyLoad: 'ondemand',
	                mobileFirst: false,
	                pauseOnHover: true,
	                pauseOnFocus: true,
	                pauseOnDotsHover: false,
	                respondTo: 'window',
	                responsive: null,
	                rows: 1,
	                rtl: false,
	                slide: '',
	                slidesPerRow: 1,
	                slidesToShow: 1,
	                slidesToScroll: 1,
	                speed: 500,
	                swipe: true,
	                swipeToSlide: false,
	                touchMove: true,
	                touchThreshold: 5,
	                useCSS: true,
	                useTransform: true,
	                variableWidth: false,
	                vertical: false,
	                verticalSwiping: false,
	                waitForAnimate: true,
	                zIndex: 1000
	            };

	            _.initials = {
	                animating: false,
	                dragging: false,
	                autoPlayTimer: null,
	                currentDirection: 0,
	                currentLeft: null,
	                currentSlide: 0,
	                direction: 1,
	                $dots: null,
	                listWidth: null,
	                listHeight: null,
	                loadIndex: 0,
	                $nextArrow: null,
	                $prevArrow: null,
	                slideCount: null,
	                slideWidth: null,
	                $slideTrack: null,
	                $slides: null,
	                sliding: false,
	                slideOffset: 0,
	                swipeLeft: null,
	                $list: null,
	                touchObject: {},
	                transformsEnabled: false,
	                unslicked: false
	            };

	            $.extend(_, _.initials);

	            _.activeBreakpoint = null;
	            _.animType = null;
	            _.animProp = null;
	            _.breakpoints = [];
	            _.breakpointSettings = [];
	            _.cssTransitions = false;
	            _.focussed = false;
	            _.interrupted = false;
	            _.hidden = 'hidden';
	            _.paused = true;
	            _.positionProp = null;
	            _.respondTo = null;
	            _.rowCount = 1;
	            _.shouldClick = true;
	            _.$slider = $(element);
	            _.$slidesCache = null;
	            _.transformType = null;
	            _.transitionType = null;
	            _.visibilityChange = 'visibilitychange';
	            _.windowWidth = 0;
	            _.windowTimer = null;

	            dataSettings = $(element).data('slick') || {};

	            _.options = $.extend({}, _.defaults, settings, dataSettings);

	            _.currentSlide = _.options.initialSlide;

	            _.originalSettings = _.options;

	            if (typeof document.mozHidden !== 'undefined') {
	                _.hidden = 'mozHidden';
	                _.visibilityChange = 'mozvisibilitychange';
	            } else if (typeof document.webkitHidden !== 'undefined') {
	                _.hidden = 'webkitHidden';
	                _.visibilityChange = 'webkitvisibilitychange';
	            }

	            _.autoPlay = $.proxy(_.autoPlay, _);
	            _.autoPlayClear = $.proxy(_.autoPlayClear, _);
	            _.autoPlayIterator = $.proxy(_.autoPlayIterator, _);
	            _.changeSlide = $.proxy(_.changeSlide, _);
	            _.clickHandler = $.proxy(_.clickHandler, _);
	            _.selectHandler = $.proxy(_.selectHandler, _);
	            _.setPosition = $.proxy(_.setPosition, _);
	            _.swipeHandler = $.proxy(_.swipeHandler, _);
	            _.dragHandler = $.proxy(_.dragHandler, _);
	            _.keyHandler = $.proxy(_.keyHandler, _);

	            _.instanceUid = instanceUid++;

	            // A simple way to check for HTML strings
	            // Strict HTML recognition (must start with <)
	            // Extracted from jQuery v1.11 source
	            _.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;


	            _.registerBreakpoints();
	            _.init(true);

	        }

	        return Slick;

	    }());

	    Slick.prototype.activateADA = function() {
	        var _ = this;

	        _.$slideTrack.find('.slick-active').attr({
	            'aria-hidden': 'false'
	        }).find('a, input, button, select').attr({
	            'tabindex': '0'
	        });

	    };

	    Slick.prototype.addSlide = Slick.prototype.slickAdd = function(markup, index, addBefore) {

	        var _ = this;

	        if (typeof(index) === 'boolean') {
	            addBefore = index;
	            index = null;
	        } else if (index < 0 || (index >= _.slideCount)) {
	            return false;
	        }

	        _.unload();

	        if (typeof(index) === 'number') {
	            if (index === 0 && _.$slides.length === 0) {
	                $(markup).appendTo(_.$slideTrack);
	            } else if (addBefore) {
	                $(markup).insertBefore(_.$slides.eq(index));
	            } else {
	                $(markup).insertAfter(_.$slides.eq(index));
	            }
	        } else {
	            if (addBefore === true) {
	                $(markup).prependTo(_.$slideTrack);
	            } else {
	                $(markup).appendTo(_.$slideTrack);
	            }
	        }

	        _.$slides = _.$slideTrack.children(this.options.slide);

	        _.$slideTrack.children(this.options.slide).detach();

	        _.$slideTrack.append(_.$slides);

	        _.$slides.each(function(index, element) {
	            $(element).attr('data-slick-index', index);
	        });

	        _.$slidesCache = _.$slides;

	        _.reinit();

	    };

	    Slick.prototype.animateHeight = function() {
	        var _ = this;
	        if (_.options.slidesToShow === 1 && _.options.adaptiveHeight === true && _.options.vertical === false) {
	            var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
	            _.$list.animate({
	                height: targetHeight
	            }, _.options.speed);
	        }
	    };

	    Slick.prototype.animateSlide = function(targetLeft, callback) {

	        var animProps = {},
	            _ = this;

	        _.animateHeight();

	        if (_.options.rtl === true && _.options.vertical === false) {
	            targetLeft = -targetLeft;
	        }
	        if (_.transformsEnabled === false) {
	            if (_.options.vertical === false) {
	                _.$slideTrack.animate({
	                    left: targetLeft
	                }, _.options.speed, _.options.easing, callback);
	            } else {
	                _.$slideTrack.animate({
	                    top: targetLeft
	                }, _.options.speed, _.options.easing, callback);
	            }

	        } else {

	            if (_.cssTransitions === false) {
	                if (_.options.rtl === true) {
	                    _.currentLeft = -(_.currentLeft);
	                }
	                $({
	                    animStart: _.currentLeft
	                }).animate({
	                    animStart: targetLeft
	                }, {
	                    duration: _.options.speed,
	                    easing: _.options.easing,
	                    step: function(now) {
	                        now = Math.ceil(now);
	                        if (_.options.vertical === false) {
	                            animProps[_.animType] = 'translate(' +
	                                now + 'px, 0px)';
	                            _.$slideTrack.css(animProps);
	                        } else {
	                            animProps[_.animType] = 'translate(0px,' +
	                                now + 'px)';
	                            _.$slideTrack.css(animProps);
	                        }
	                    },
	                    complete: function() {
	                        if (callback) {
	                            callback.call();
	                        }
	                    }
	                });

	            } else {

	                _.applyTransition();
	                targetLeft = Math.ceil(targetLeft);

	                if (_.options.vertical === false) {
	                    animProps[_.animType] = 'translate3d(' + targetLeft + 'px, 0px, 0px)';
	                } else {
	                    animProps[_.animType] = 'translate3d(0px,' + targetLeft + 'px, 0px)';
	                }
	                _.$slideTrack.css(animProps);

	                if (callback) {
	                    setTimeout(function() {

	                        _.disableTransition();

	                        callback.call();
	                    }, _.options.speed);
	                }

	            }

	        }

	    };

	    Slick.prototype.getNavTarget = function() {

	        var _ = this,
	            asNavFor = _.options.asNavFor;

	        if ( asNavFor && asNavFor !== null ) {
	            asNavFor = $(asNavFor).not(_.$slider);
	        }

	        return asNavFor;

	    };

	    Slick.prototype.asNavFor = function(index) {

	        var _ = this,
	            asNavFor = _.getNavTarget();

	        if ( asNavFor !== null && typeof asNavFor === 'object' ) {
	            asNavFor.each(function() {
	                var target = $(this).slick('getSlick');
	                if(!target.unslicked) {
	                    target.slideHandler(index, true);
	                }
	            });
	        }

	    };

	    Slick.prototype.applyTransition = function(slide) {

	        var _ = this,
	            transition = {};

	        if (_.options.fade === false) {
	            transition[_.transitionType] = _.transformType + ' ' + _.options.speed + 'ms ' + _.options.cssEase;
	        } else {
	            transition[_.transitionType] = 'opacity ' + _.options.speed + 'ms ' + _.options.cssEase;
	        }

	        if (_.options.fade === false) {
	            _.$slideTrack.css(transition);
	        } else {
	            _.$slides.eq(slide).css(transition);
	        }

	    };

	    Slick.prototype.autoPlay = function() {

	        var _ = this;

	        _.autoPlayClear();

	        if ( _.slideCount > _.options.slidesToShow ) {
	            _.autoPlayTimer = setInterval( _.autoPlayIterator, _.options.autoplaySpeed );
	        }

	    };

	    Slick.prototype.autoPlayClear = function() {

	        var _ = this;

	        if (_.autoPlayTimer) {
	            clearInterval(_.autoPlayTimer);
	        }

	    };

	    Slick.prototype.autoPlayIterator = function() {

	        var _ = this,
	            slideTo = _.currentSlide + _.options.slidesToScroll;

	        if ( !_.paused && !_.interrupted && !_.focussed ) {

	            if ( _.options.infinite === false ) {

	                if ( _.direction === 1 && ( _.currentSlide + 1 ) === ( _.slideCount - 1 )) {
	                    _.direction = 0;
	                }

	                else if ( _.direction === 0 ) {

	                    slideTo = _.currentSlide - _.options.slidesToScroll;

	                    if ( _.currentSlide - 1 === 0 ) {
	                        _.direction = 1;
	                    }

	                }

	            }

	            _.slideHandler( slideTo );

	        }

	    };

	    Slick.prototype.buildArrows = function() {

	        var _ = this;

	        if (_.options.arrows === true ) {

	            _.$prevArrow = $(_.options.prevArrow).addClass('slick-arrow');
	            _.$nextArrow = $(_.options.nextArrow).addClass('slick-arrow');

	            if( _.slideCount > _.options.slidesToShow ) {

	                _.$prevArrow.removeClass('slick-hidden').removeAttr('aria-hidden tabindex');
	                _.$nextArrow.removeClass('slick-hidden').removeAttr('aria-hidden tabindex');

	                if (_.htmlExpr.test(_.options.prevArrow)) {
	                    _.$prevArrow.prependTo(_.options.appendArrows);
	                }

	                if (_.htmlExpr.test(_.options.nextArrow)) {
	                    _.$nextArrow.appendTo(_.options.appendArrows);
	                }

	                if (_.options.infinite !== true) {
	                    _.$prevArrow
	                        .addClass('slick-disabled')
	                        .attr('aria-disabled', 'true');
	                }

	            } else {

	                _.$prevArrow.add( _.$nextArrow )

	                    .addClass('slick-hidden')
	                    .attr({
	                        'aria-disabled': 'true',
	                        'tabindex': '-1'
	                    });

	            }

	        }

	    };

	    Slick.prototype.buildDots = function() {

	        var _ = this,
	            i, dot;

	        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

	            _.$slider.addClass('slick-dotted');

	            dot = $('<ul />').addClass(_.options.dotsClass);

	            for (i = 0; i <= _.getDotCount(); i += 1) {
	                dot.append($('<li />').append(_.options.customPaging.call(this, _, i)));
	            }

	            _.$dots = dot.appendTo(_.options.appendDots);

	            _.$dots.find('li').first().addClass('slick-active').attr('aria-hidden', 'false');

	        }

	    };

	    Slick.prototype.buildOut = function() {

	        var _ = this;

	        _.$slides =
	            _.$slider
	                .children( _.options.slide + ':not(.slick-cloned)')
	                .addClass('slick-slide');

	        _.slideCount = _.$slides.length;

	        _.$slides.each(function(index, element) {
	            $(element)
	                .attr('data-slick-index', index)
	                .data('originalStyling', $(element).attr('style') || '');
	        });

	        _.$slider.addClass('slick-slider');

	        _.$slideTrack = (_.slideCount === 0) ?
	            $('<div class="slick-track"/>').appendTo(_.$slider) :
	            _.$slides.wrapAll('<div class="slick-track"/>').parent();

	        _.$list = _.$slideTrack.wrap(
	            '<div aria-live="polite" class="slick-list"/>').parent();
	        _.$slideTrack.css('opacity', 0);

	        if (_.options.centerMode === true || _.options.swipeToSlide === true) {
	            _.options.slidesToScroll = 1;
	        }

	        $('img[data-lazy]', _.$slider).not('[src]').addClass('slick-loading');

	        _.setupInfinite();

	        _.buildArrows();

	        _.buildDots();

	        _.updateDots();


	        _.setSlideClasses(typeof _.currentSlide === 'number' ? _.currentSlide : 0);

	        if (_.options.draggable === true) {
	            _.$list.addClass('draggable');
	        }

	    };

	    Slick.prototype.buildRows = function() {

	        var _ = this, a, b, c, newSlides, numOfSlides, originalSlides,slidesPerSection;

	        newSlides = document.createDocumentFragment();
	        originalSlides = _.$slider.children();

	        if(_.options.rows > 1) {

	            slidesPerSection = _.options.slidesPerRow * _.options.rows;
	            numOfSlides = Math.ceil(
	                originalSlides.length / slidesPerSection
	            );

	            for(a = 0; a < numOfSlides; a++){
	                var slide = document.createElement('div');
	                for(b = 0; b < _.options.rows; b++) {
	                    var row = document.createElement('div');
	                    for(c = 0; c < _.options.slidesPerRow; c++) {
	                        var target = (a * slidesPerSection + ((b * _.options.slidesPerRow) + c));
	                        if (originalSlides.get(target)) {
	                            row.appendChild(originalSlides.get(target));
	                        }
	                    }
	                    slide.appendChild(row);
	                }
	                newSlides.appendChild(slide);
	            }

	            _.$slider.empty().append(newSlides);
	            _.$slider.children().children().children()
	                .css({
	                    'width':(100 / _.options.slidesPerRow) + '%',
	                    'display': 'inline-block'
	                });

	        }

	    };

	    Slick.prototype.checkResponsive = function(initial, forceUpdate) {

	        var _ = this,
	            breakpoint, targetBreakpoint, respondToWidth, triggerBreakpoint = false;
	        var sliderWidth = _.$slider.width();
	        var windowWidth = window.innerWidth || $(window).width();

	        if (_.respondTo === 'window') {
	            respondToWidth = windowWidth;
	        } else if (_.respondTo === 'slider') {
	            respondToWidth = sliderWidth;
	        } else if (_.respondTo === 'min') {
	            respondToWidth = Math.min(windowWidth, sliderWidth);
	        }

	        if ( _.options.responsive &&
	            _.options.responsive.length &&
	            _.options.responsive !== null) {

	            targetBreakpoint = null;

	            for (breakpoint in _.breakpoints) {
	                if (_.breakpoints.hasOwnProperty(breakpoint)) {
	                    if (_.originalSettings.mobileFirst === false) {
	                        if (respondToWidth < _.breakpoints[breakpoint]) {
	                            targetBreakpoint = _.breakpoints[breakpoint];
	                        }
	                    } else {
	                        if (respondToWidth > _.breakpoints[breakpoint]) {
	                            targetBreakpoint = _.breakpoints[breakpoint];
	                        }
	                    }
	                }
	            }

	            if (targetBreakpoint !== null) {
	                if (_.activeBreakpoint !== null) {
	                    if (targetBreakpoint !== _.activeBreakpoint || forceUpdate) {
	                        _.activeBreakpoint =
	                            targetBreakpoint;
	                        if (_.breakpointSettings[targetBreakpoint] === 'unslick') {
	                            _.unslick(targetBreakpoint);
	                        } else {
	                            _.options = $.extend({}, _.originalSettings,
	                                _.breakpointSettings[
	                                    targetBreakpoint]);
	                            if (initial === true) {
	                                _.currentSlide = _.options.initialSlide;
	                            }
	                            _.refresh(initial);
	                        }
	                        triggerBreakpoint = targetBreakpoint;
	                    }
	                } else {
	                    _.activeBreakpoint = targetBreakpoint;
	                    if (_.breakpointSettings[targetBreakpoint] === 'unslick') {
	                        _.unslick(targetBreakpoint);
	                    } else {
	                        _.options = $.extend({}, _.originalSettings,
	                            _.breakpointSettings[
	                                targetBreakpoint]);
	                        if (initial === true) {
	                            _.currentSlide = _.options.initialSlide;
	                        }
	                        _.refresh(initial);
	                    }
	                    triggerBreakpoint = targetBreakpoint;
	                }
	            } else {
	                if (_.activeBreakpoint !== null) {
	                    _.activeBreakpoint = null;
	                    _.options = _.originalSettings;
	                    if (initial === true) {
	                        _.currentSlide = _.options.initialSlide;
	                    }
	                    _.refresh(initial);
	                    triggerBreakpoint = targetBreakpoint;
	                }
	            }

	            // only trigger breakpoints during an actual break. not on initialize.
	            if( !initial && triggerBreakpoint !== false ) {
	                _.$slider.trigger('breakpoint', [_, triggerBreakpoint]);
	            }
	        }

	    };

	    Slick.prototype.changeSlide = function(event, dontAnimate) {

	        var _ = this,
	            $target = $(event.currentTarget),
	            indexOffset, slideOffset, unevenOffset;

	        // If target is a link, prevent default action.
	        if($target.is('a')) {
	            event.preventDefault();
	        }

	        // If target is not the <li> element (ie: a child), find the <li>.
	        if(!$target.is('li')) {
	            $target = $target.closest('li');
	        }

	        unevenOffset = (_.slideCount % _.options.slidesToScroll !== 0);
	        indexOffset = unevenOffset ? 0 : (_.slideCount - _.currentSlide) % _.options.slidesToScroll;

	        switch (event.data.message) {

	            case 'previous':
	                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : _.options.slidesToShow - indexOffset;
	                if (_.slideCount > _.options.slidesToShow) {
	                    _.slideHandler(_.currentSlide - slideOffset, false, dontAnimate);
	                }
	                break;

	            case 'next':
	                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : indexOffset;
	                if (_.slideCount > _.options.slidesToShow) {
	                    _.slideHandler(_.currentSlide + slideOffset, false, dontAnimate);
	                }
	                break;

	            case 'index':
	                var index = event.data.index === 0 ? 0 :
	                    event.data.index || $target.index() * _.options.slidesToScroll;

	                _.slideHandler(_.checkNavigable(index), false, dontAnimate);
	                $target.children().trigger('focus');
	                break;

	            default:
	                return;
	        }

	    };

	    Slick.prototype.checkNavigable = function(index) {

	        var _ = this,
	            navigables, prevNavigable;

	        navigables = _.getNavigableIndexes();
	        prevNavigable = 0;
	        if (index > navigables[navigables.length - 1]) {
	            index = navigables[navigables.length - 1];
	        } else {
	            for (var n in navigables) {
	                if (index < navigables[n]) {
	                    index = prevNavigable;
	                    break;
	                }
	                prevNavigable = navigables[n];
	            }
	        }

	        return index;
	    };

	    Slick.prototype.cleanUpEvents = function() {

	        var _ = this;

	        if (_.options.dots && _.$dots !== null) {

	            $('li', _.$dots)
	                .off('click.slick', _.changeSlide)
	                .off('mouseenter.slick', $.proxy(_.interrupt, _, true))
	                .off('mouseleave.slick', $.proxy(_.interrupt, _, false));

	        }

	        _.$slider.off('focus.slick blur.slick');

	        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
	            _.$prevArrow && _.$prevArrow.off('click.slick', _.changeSlide);
	            _.$nextArrow && _.$nextArrow.off('click.slick', _.changeSlide);
	        }

	        _.$list.off('touchstart.slick mousedown.slick', _.swipeHandler);
	        _.$list.off('touchmove.slick mousemove.slick', _.swipeHandler);
	        _.$list.off('touchend.slick mouseup.slick', _.swipeHandler);
	        _.$list.off('touchcancel.slick mouseleave.slick', _.swipeHandler);

	        _.$list.off('click.slick', _.clickHandler);

	        $(document).off(_.visibilityChange, _.visibility);

	        _.cleanUpSlideEvents();

	        if (_.options.accessibility === true) {
	            _.$list.off('keydown.slick', _.keyHandler);
	        }

	        if (_.options.focusOnSelect === true) {
	            $(_.$slideTrack).children().off('click.slick', _.selectHandler);
	        }

	        $(window).off('orientationchange.slick.slick-' + _.instanceUid, _.orientationChange);

	        $(window).off('resize.slick.slick-' + _.instanceUid, _.resize);

	        $('[draggable!=true]', _.$slideTrack).off('dragstart', _.preventDefault);

	        $(window).off('load.slick.slick-' + _.instanceUid, _.setPosition);
	        $(document).off('ready.slick.slick-' + _.instanceUid, _.setPosition);

	    };

	    Slick.prototype.cleanUpSlideEvents = function() {

	        var _ = this;

	        _.$list.off('mouseenter.slick', $.proxy(_.interrupt, _, true));
	        _.$list.off('mouseleave.slick', $.proxy(_.interrupt, _, false));

	    };

	    Slick.prototype.cleanUpRows = function() {

	        var _ = this, originalSlides;

	        if(_.options.rows > 1) {
	            originalSlides = _.$slides.children().children();
	            originalSlides.removeAttr('style');
	            _.$slider.empty().append(originalSlides);
	        }

	    };

	    Slick.prototype.clickHandler = function(event) {

	        var _ = this;

	        if (_.shouldClick === false) {
	            event.stopImmediatePropagation();
	            event.stopPropagation();
	            event.preventDefault();
	        }

	    };

	    Slick.prototype.destroy = function(refresh) {

	        var _ = this;

	        _.autoPlayClear();

	        _.touchObject = {};

	        _.cleanUpEvents();

	        $('.slick-cloned', _.$slider).detach();

	        if (_.$dots) {
	            _.$dots.remove();
	        }


	        if ( _.$prevArrow && _.$prevArrow.length ) {

	            _.$prevArrow
	                .removeClass('slick-disabled slick-arrow slick-hidden')
	                .removeAttr('aria-hidden aria-disabled tabindex')
	                .css('display','');

	            if ( _.htmlExpr.test( _.options.prevArrow )) {
	                _.$prevArrow.remove();
	            }
	        }

	        if ( _.$nextArrow && _.$nextArrow.length ) {

	            _.$nextArrow
	                .removeClass('slick-disabled slick-arrow slick-hidden')
	                .removeAttr('aria-hidden aria-disabled tabindex')
	                .css('display','');

	            if ( _.htmlExpr.test( _.options.nextArrow )) {
	                _.$nextArrow.remove();
	            }

	        }


	        if (_.$slides) {

	            _.$slides
	                .removeClass('slick-slide slick-active slick-center slick-visible slick-current')
	                .removeAttr('aria-hidden')
	                .removeAttr('data-slick-index')
	                .each(function(){
	                    $(this).attr('style', $(this).data('originalStyling'));
	                });

	            _.$slideTrack.children(this.options.slide).detach();

	            _.$slideTrack.detach();

	            _.$list.detach();

	            _.$slider.append(_.$slides);
	        }

	        _.cleanUpRows();

	        _.$slider.removeClass('slick-slider');
	        _.$slider.removeClass('slick-initialized');
	        _.$slider.removeClass('slick-dotted');

	        _.unslicked = true;

	        if(!refresh) {
	            _.$slider.trigger('destroy', [_]);
	        }

	    };

	    Slick.prototype.disableTransition = function(slide) {

	        var _ = this,
	            transition = {};

	        transition[_.transitionType] = '';

	        if (_.options.fade === false) {
	            _.$slideTrack.css(transition);
	        } else {
	            _.$slides.eq(slide).css(transition);
	        }

	    };

	    Slick.prototype.fadeSlide = function(slideIndex, callback) {

	        var _ = this;

	        if (_.cssTransitions === false) {

	            _.$slides.eq(slideIndex).css({
	                zIndex: _.options.zIndex
	            });

	            _.$slides.eq(slideIndex).animate({
	                opacity: 1
	            }, _.options.speed, _.options.easing, callback);

	        } else {

	            _.applyTransition(slideIndex);

	            _.$slides.eq(slideIndex).css({
	                opacity: 1,
	                zIndex: _.options.zIndex
	            });

	            if (callback) {
	                setTimeout(function() {

	                    _.disableTransition(slideIndex);

	                    callback.call();
	                }, _.options.speed);
	            }

	        }

	    };

	    Slick.prototype.fadeSlideOut = function(slideIndex) {

	        var _ = this;

	        if (_.cssTransitions === false) {

	            _.$slides.eq(slideIndex).animate({
	                opacity: 0,
	                zIndex: _.options.zIndex - 2
	            }, _.options.speed, _.options.easing);

	        } else {

	            _.applyTransition(slideIndex);

	            _.$slides.eq(slideIndex).css({
	                opacity: 0,
	                zIndex: _.options.zIndex - 2
	            });

	        }

	    };

	    Slick.prototype.filterSlides = Slick.prototype.slickFilter = function(filter) {

	        var _ = this;

	        if (filter !== null) {

	            _.$slidesCache = _.$slides;

	            _.unload();

	            _.$slideTrack.children(this.options.slide).detach();

	            _.$slidesCache.filter(filter).appendTo(_.$slideTrack);

	            _.reinit();

	        }

	    };

	    Slick.prototype.focusHandler = function() {

	        var _ = this;

	        _.$slider
	            .off('focus.slick blur.slick')
	            .on('focus.slick blur.slick',
	                '*:not(.slick-arrow)', function(event) {

	            event.stopImmediatePropagation();
	            var $sf = $(this);

	            setTimeout(function() {

	                if( _.options.pauseOnFocus ) {
	                    _.focussed = $sf.is(':focus');
	                    _.autoPlay();
	                }

	            }, 0);

	        });
	    };

	    Slick.prototype.getCurrent = Slick.prototype.slickCurrentSlide = function() {

	        var _ = this;
	        return _.currentSlide;

	    };

	    Slick.prototype.getDotCount = function() {

	        var _ = this;

	        var breakPoint = 0;
	        var counter = 0;
	        var pagerQty = 0;

	        if (_.options.infinite === true) {
	            while (breakPoint < _.slideCount) {
	                ++pagerQty;
	                breakPoint = counter + _.options.slidesToScroll;
	                counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
	            }
	        } else if (_.options.centerMode === true) {
	            pagerQty = _.slideCount;
	        } else if(!_.options.asNavFor) {
	            pagerQty = 1 + Math.ceil((_.slideCount - _.options.slidesToShow) / _.options.slidesToScroll);
	        }else {
	            while (breakPoint < _.slideCount) {
	                ++pagerQty;
	                breakPoint = counter + _.options.slidesToScroll;
	                counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
	            }
	        }

	        return pagerQty - 1;

	    };

	    Slick.prototype.getLeft = function(slideIndex) {

	        var _ = this,
	            targetLeft,
	            verticalHeight,
	            verticalOffset = 0,
	            targetSlide;

	        _.slideOffset = 0;
	        verticalHeight = _.$slides.first().outerHeight(true);

	        if (_.options.infinite === true) {
	            if (_.slideCount > _.options.slidesToShow) {
	                _.slideOffset = (_.slideWidth * _.options.slidesToShow) * -1;
	                verticalOffset = (verticalHeight * _.options.slidesToShow) * -1;
	            }
	            if (_.slideCount % _.options.slidesToScroll !== 0) {
	                if (slideIndex + _.options.slidesToScroll > _.slideCount && _.slideCount > _.options.slidesToShow) {
	                    if (slideIndex > _.slideCount) {
	                        _.slideOffset = ((_.options.slidesToShow - (slideIndex - _.slideCount)) * _.slideWidth) * -1;
	                        verticalOffset = ((_.options.slidesToShow - (slideIndex - _.slideCount)) * verticalHeight) * -1;
	                    } else {
	                        _.slideOffset = ((_.slideCount % _.options.slidesToScroll) * _.slideWidth) * -1;
	                        verticalOffset = ((_.slideCount % _.options.slidesToScroll) * verticalHeight) * -1;
	                    }
	                }
	            }
	        } else {
	            if (slideIndex + _.options.slidesToShow > _.slideCount) {
	                _.slideOffset = ((slideIndex + _.options.slidesToShow) - _.slideCount) * _.slideWidth;
	                verticalOffset = ((slideIndex + _.options.slidesToShow) - _.slideCount) * verticalHeight;
	            }
	        }

	        if (_.slideCount <= _.options.slidesToShow) {
	            _.slideOffset = 0;
	            verticalOffset = 0;
	        }

	        if (_.options.centerMode === true && _.options.infinite === true) {
	            _.slideOffset += _.slideWidth * Math.floor(_.options.slidesToShow / 2) - _.slideWidth;
	        } else if (_.options.centerMode === true) {
	            _.slideOffset = 0;
	            _.slideOffset += _.slideWidth * Math.floor(_.options.slidesToShow / 2);
	        }

	        if (_.options.vertical === false) {
	            targetLeft = ((slideIndex * _.slideWidth) * -1) + _.slideOffset;
	        } else {
	            targetLeft = ((slideIndex * verticalHeight) * -1) + verticalOffset;
	        }

	        if (_.options.variableWidth === true) {

	            if (_.slideCount <= _.options.slidesToShow || _.options.infinite === false) {
	                targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex);
	            } else {
	                targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex + _.options.slidesToShow);
	            }

	            if (_.options.rtl === true) {
	                if (targetSlide[0]) {
	                    targetLeft = (_.$slideTrack.width() - targetSlide[0].offsetLeft - targetSlide.width()) * -1;
	                } else {
	                    targetLeft =  0;
	                }
	            } else {
	                targetLeft = targetSlide[0] ? targetSlide[0].offsetLeft * -1 : 0;
	            }

	            if (_.options.centerMode === true) {
	                if (_.slideCount <= _.options.slidesToShow || _.options.infinite === false) {
	                    targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex);
	                } else {
	                    targetSlide = _.$slideTrack.children('.slick-slide').eq(slideIndex + _.options.slidesToShow + 1);
	                }

	                if (_.options.rtl === true) {
	                    if (targetSlide[0]) {
	                        targetLeft = (_.$slideTrack.width() - targetSlide[0].offsetLeft - targetSlide.width()) * -1;
	                    } else {
	                        targetLeft =  0;
	                    }
	                } else {
	                    targetLeft = targetSlide[0] ? targetSlide[0].offsetLeft * -1 : 0;
	                }

	                targetLeft += (_.$list.width() - targetSlide.outerWidth()) / 2;
	            }
	        }

	        return targetLeft;

	    };

	    Slick.prototype.getOption = Slick.prototype.slickGetOption = function(option) {

	        var _ = this;

	        return _.options[option];

	    };

	    Slick.prototype.getNavigableIndexes = function() {

	        var _ = this,
	            breakPoint = 0,
	            counter = 0,
	            indexes = [],
	            max;

	        if (_.options.infinite === false) {
	            max = _.slideCount;
	        } else {
	            breakPoint = _.options.slidesToScroll * -1;
	            counter = _.options.slidesToScroll * -1;
	            max = _.slideCount * 2;
	        }

	        while (breakPoint < max) {
	            indexes.push(breakPoint);
	            breakPoint = counter + _.options.slidesToScroll;
	            counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
	        }

	        return indexes;

	    };

	    Slick.prototype.getSlick = function() {

	        return this;

	    };

	    Slick.prototype.getSlideCount = function() {

	        var _ = this,
	            slidesTraversed, swipedSlide, centerOffset;

	        centerOffset = _.options.centerMode === true ? _.slideWidth * Math.floor(_.options.slidesToShow / 2) : 0;

	        if (_.options.swipeToSlide === true) {
	            _.$slideTrack.find('.slick-slide').each(function(index, slide) {
	                if (slide.offsetLeft - centerOffset + ($(slide).outerWidth() / 2) > (_.swipeLeft * -1)) {
	                    swipedSlide = slide;
	                    return false;
	                }
	            });

	            slidesTraversed = Math.abs($(swipedSlide).attr('data-slick-index') - _.currentSlide) || 1;

	            return slidesTraversed;

	        } else {
	            return _.options.slidesToScroll;
	        }

	    };

	    Slick.prototype.goTo = Slick.prototype.slickGoTo = function(slide, dontAnimate) {

	        var _ = this;

	        _.changeSlide({
	            data: {
	                message: 'index',
	                index: parseInt(slide)
	            }
	        }, dontAnimate);

	    };

	    Slick.prototype.init = function(creation) {

	        var _ = this;

	        if (!$(_.$slider).hasClass('slick-initialized')) {

	            $(_.$slider).addClass('slick-initialized');

	            _.buildRows();
	            _.buildOut();
	            _.setProps();
	            _.startLoad();
	            _.loadSlider();
	            _.initializeEvents();
	            _.updateArrows();
	            _.updateDots();
	            _.checkResponsive(true);
	            _.focusHandler();

	        }

	        if (creation) {
	            _.$slider.trigger('init', [_]);
	        }

	        if (_.options.accessibility === true) {
	            _.initADA();
	        }

	        if ( _.options.autoplay ) {

	            _.paused = false;
	            _.autoPlay();

	        }

	    };

	    Slick.prototype.initADA = function() {
	        var _ = this;
	        _.$slides.add(_.$slideTrack.find('.slick-cloned')).attr({
	            'aria-hidden': 'true',
	            'tabindex': '-1'
	        }).find('a, input, button, select').attr({
	            'tabindex': '-1'
	        });

	        _.$slideTrack.attr('role', 'listbox');

	        _.$slides.not(_.$slideTrack.find('.slick-cloned')).each(function(i) {
	            $(this).attr({
	                'role': 'option',
	                'aria-describedby': 'slick-slide' + _.instanceUid + i + ''
	            });
	        });

	        if (_.$dots !== null) {
	            _.$dots.attr('role', 'tablist').find('li').each(function(i) {
	                $(this).attr({
	                    'role': 'presentation',
	                    'aria-selected': 'false',
	                    'aria-controls': 'navigation' + _.instanceUid + i + '',
	                    'id': 'slick-slide' + _.instanceUid + i + ''
	                });
	            })
	                .first().attr('aria-selected', 'true').end()
	                .find('button').attr('role', 'button').end()
	                .closest('div').attr('role', 'toolbar');
	        }
	        _.activateADA();

	    };

	    Slick.prototype.initArrowEvents = function() {

	        var _ = this;

	        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
	            _.$prevArrow
	               .off('click.slick')
	               .on('click.slick', {
	                    message: 'previous'
	               }, _.changeSlide);
	            _.$nextArrow
	               .off('click.slick')
	               .on('click.slick', {
	                    message: 'next'
	               }, _.changeSlide);
	        }

	    };

	    Slick.prototype.initDotEvents = function() {

	        var _ = this;

	        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
	            $('li', _.$dots).on('click.slick', {
	                message: 'index'
	            }, _.changeSlide);
	        }

	        if ( _.options.dots === true && _.options.pauseOnDotsHover === true ) {

	            $('li', _.$dots)
	                .on('mouseenter.slick', $.proxy(_.interrupt, _, true))
	                .on('mouseleave.slick', $.proxy(_.interrupt, _, false));

	        }

	    };

	    Slick.prototype.initSlideEvents = function() {

	        var _ = this;

	        if ( _.options.pauseOnHover ) {

	            _.$list.on('mouseenter.slick', $.proxy(_.interrupt, _, true));
	            _.$list.on('mouseleave.slick', $.proxy(_.interrupt, _, false));

	        }

	    };

	    Slick.prototype.initializeEvents = function() {

	        var _ = this;

	        _.initArrowEvents();

	        _.initDotEvents();
	        _.initSlideEvents();

	        _.$list.on('touchstart.slick mousedown.slick', {
	            action: 'start'
	        }, _.swipeHandler);
	        _.$list.on('touchmove.slick mousemove.slick', {
	            action: 'move'
	        }, _.swipeHandler);
	        _.$list.on('touchend.slick mouseup.slick', {
	            action: 'end'
	        }, _.swipeHandler);
	        _.$list.on('touchcancel.slick mouseleave.slick', {
	            action: 'end'
	        }, _.swipeHandler);

	        _.$list.on('click.slick', _.clickHandler);

	        $(document).on(_.visibilityChange, $.proxy(_.visibility, _));

	        if (_.options.accessibility === true) {
	            _.$list.on('keydown.slick', _.keyHandler);
	        }

	        if (_.options.focusOnSelect === true) {
	            $(_.$slideTrack).children().on('click.slick', _.selectHandler);
	        }

	        $(window).on('orientationchange.slick.slick-' + _.instanceUid, $.proxy(_.orientationChange, _));

	        $(window).on('resize.slick.slick-' + _.instanceUid, $.proxy(_.resize, _));

	        $('[draggable!=true]', _.$slideTrack).on('dragstart', _.preventDefault);

	        $(window).on('load.slick.slick-' + _.instanceUid, _.setPosition);
	        $(document).on('ready.slick.slick-' + _.instanceUid, _.setPosition);

	    };

	    Slick.prototype.initUI = function() {

	        var _ = this;

	        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {

	            _.$prevArrow.show();
	            _.$nextArrow.show();

	        }

	        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

	            _.$dots.show();

	        }

	    };

	    Slick.prototype.keyHandler = function(event) {

	        var _ = this;
	         //Dont slide if the cursor is inside the form fields and arrow keys are pressed
	        if(!event.target.tagName.match('TEXTAREA|INPUT|SELECT')) {
	            if (event.keyCode === 37 && _.options.accessibility === true) {
	                _.changeSlide({
	                    data: {
	                        message: _.options.rtl === true ? 'next' :  'previous'
	                    }
	                });
	            } else if (event.keyCode === 39 && _.options.accessibility === true) {
	                _.changeSlide({
	                    data: {
	                        message: _.options.rtl === true ? 'previous' : 'next'
	                    }
	                });
	            }
	        }

	    };

	    Slick.prototype.lazyLoad = function() {

	        var _ = this,
	            loadRange, cloneRange, rangeStart, rangeEnd;

	        function loadImages(imagesScope) {

	            $('img[data-lazy]', imagesScope).each(function() {

	                var image = $(this),
	                    imageSource = $(this).attr('data-lazy'),
	                    imageToLoad = document.createElement('img');

	                imageToLoad.onload = function() {

	                    image
	                        .animate({ opacity: 0 }, 100, function() {
	                            image
	                                .attr('src', imageSource)
	                                .animate({ opacity: 1 }, 200, function() {
	                                    image
	                                        .removeAttr('data-lazy')
	                                        .removeClass('slick-loading');
	                                });
	                            _.$slider.trigger('lazyLoaded', [_, image, imageSource]);
	                        });

	                };

	                imageToLoad.onerror = function() {

	                    image
	                        .removeAttr( 'data-lazy' )
	                        .removeClass( 'slick-loading' )
	                        .addClass( 'slick-lazyload-error' );

	                    _.$slider.trigger('lazyLoadError', [ _, image, imageSource ]);

	                };

	                imageToLoad.src = imageSource;

	            });

	        }

	        if (_.options.centerMode === true) {
	            if (_.options.infinite === true) {
	                rangeStart = _.currentSlide + (_.options.slidesToShow / 2 + 1);
	                rangeEnd = rangeStart + _.options.slidesToShow + 2;
	            } else {
	                rangeStart = Math.max(0, _.currentSlide - (_.options.slidesToShow / 2 + 1));
	                rangeEnd = 2 + (_.options.slidesToShow / 2 + 1) + _.currentSlide;
	            }
	        } else {
	            rangeStart = _.options.infinite ? _.options.slidesToShow + _.currentSlide : _.currentSlide;
	            rangeEnd = Math.ceil(rangeStart + _.options.slidesToShow);
	            if (_.options.fade === true) {
	                if (rangeStart > 0) rangeStart--;
	                if (rangeEnd <= _.slideCount) rangeEnd++;
	            }
	        }

	        loadRange = _.$slider.find('.slick-slide').slice(rangeStart, rangeEnd);
	        loadImages(loadRange);

	        if (_.slideCount <= _.options.slidesToShow) {
	            cloneRange = _.$slider.find('.slick-slide');
	            loadImages(cloneRange);
	        } else
	        if (_.currentSlide >= _.slideCount - _.options.slidesToShow) {
	            cloneRange = _.$slider.find('.slick-cloned').slice(0, _.options.slidesToShow);
	            loadImages(cloneRange);
	        } else if (_.currentSlide === 0) {
	            cloneRange = _.$slider.find('.slick-cloned').slice(_.options.slidesToShow * -1);
	            loadImages(cloneRange);
	        }

	    };

	    Slick.prototype.loadSlider = function() {

	        var _ = this;

	        _.setPosition();

	        _.$slideTrack.css({
	            opacity: 1
	        });

	        _.$slider.removeClass('slick-loading');

	        _.initUI();

	        if (_.options.lazyLoad === 'progressive') {
	            _.progressiveLazyLoad();
	        }

	    };

	    Slick.prototype.next = Slick.prototype.slickNext = function() {

	        var _ = this;

	        _.changeSlide({
	            data: {
	                message: 'next'
	            }
	        });

	    };

	    Slick.prototype.orientationChange = function() {

	        var _ = this;

	        _.checkResponsive();
	        _.setPosition();

	    };

	    Slick.prototype.pause = Slick.prototype.slickPause = function() {

	        var _ = this;

	        _.autoPlayClear();
	        _.paused = true;

	    };

	    Slick.prototype.play = Slick.prototype.slickPlay = function() {

	        var _ = this;

	        _.autoPlay();
	        _.options.autoplay = true;
	        _.paused = false;
	        _.focussed = false;
	        _.interrupted = false;

	    };

	    Slick.prototype.postSlide = function(index) {

	        var _ = this;

	        if( !_.unslicked ) {

	            _.$slider.trigger('afterChange', [_, index]);

	            _.animating = false;

	            _.setPosition();

	            _.swipeLeft = null;

	            if ( _.options.autoplay ) {
	                _.autoPlay();
	            }

	            if (_.options.accessibility === true) {
	                _.initADA();
	            }

	        }

	    };

	    Slick.prototype.prev = Slick.prototype.slickPrev = function() {

	        var _ = this;

	        _.changeSlide({
	            data: {
	                message: 'previous'
	            }
	        });

	    };

	    Slick.prototype.preventDefault = function(event) {

	        event.preventDefault();

	    };

	    Slick.prototype.progressiveLazyLoad = function( tryCount ) {

	        tryCount = tryCount || 1;

	        var _ = this,
	            $imgsToLoad = $( 'img[data-lazy]', _.$slider ),
	            image,
	            imageSource,
	            imageToLoad;

	        if ( $imgsToLoad.length ) {

	            image = $imgsToLoad.first();
	            imageSource = image.attr('data-lazy');
	            imageToLoad = document.createElement('img');

	            imageToLoad.onload = function() {

	                image
	                    .attr( 'src', imageSource )
	                    .removeAttr('data-lazy')
	                    .removeClass('slick-loading');

	                if ( _.options.adaptiveHeight === true ) {
	                    _.setPosition();
	                }

	                _.$slider.trigger('lazyLoaded', [ _, image, imageSource ]);
	                _.progressiveLazyLoad();

	            };

	            imageToLoad.onerror = function() {

	                if ( tryCount < 3 ) {

	                    /**
	                     * try to load the image 3 times,
	                     * leave a slight delay so we don't get
	                     * servers blocking the request.
	                     */
	                    setTimeout( function() {
	                        _.progressiveLazyLoad( tryCount + 1 );
	                    }, 500 );

	                } else {

	                    image
	                        .removeAttr( 'data-lazy' )
	                        .removeClass( 'slick-loading' )
	                        .addClass( 'slick-lazyload-error' );

	                    _.$slider.trigger('lazyLoadError', [ _, image, imageSource ]);

	                    _.progressiveLazyLoad();

	                }

	            };

	            imageToLoad.src = imageSource;

	        } else {

	            _.$slider.trigger('allImagesLoaded', [ _ ]);

	        }

	    };

	    Slick.prototype.refresh = function( initializing ) {

	        var _ = this, currentSlide, lastVisibleIndex;

	        lastVisibleIndex = _.slideCount - _.options.slidesToShow;

	        // in non-infinite sliders, we don't want to go past the
	        // last visible index.
	        if( !_.options.infinite && ( _.currentSlide > lastVisibleIndex )) {
	            _.currentSlide = lastVisibleIndex;
	        }

	        // if less slides than to show, go to start.
	        if ( _.slideCount <= _.options.slidesToShow ) {
	            _.currentSlide = 0;

	        }

	        currentSlide = _.currentSlide;

	        _.destroy(true);

	        $.extend(_, _.initials, { currentSlide: currentSlide });

	        _.init();

	        if( !initializing ) {

	            _.changeSlide({
	                data: {
	                    message: 'index',
	                    index: currentSlide
	                }
	            }, false);

	        }

	    };

	    Slick.prototype.registerBreakpoints = function() {

	        var _ = this, breakpoint, currentBreakpoint, l,
	            responsiveSettings = _.options.responsive || null;

	        if ( $.type(responsiveSettings) === 'array' && responsiveSettings.length ) {

	            _.respondTo = _.options.respondTo || 'window';

	            for ( breakpoint in responsiveSettings ) {

	                l = _.breakpoints.length-1;
	                currentBreakpoint = responsiveSettings[breakpoint].breakpoint;

	                if (responsiveSettings.hasOwnProperty(breakpoint)) {

	                    // loop through the breakpoints and cut out any existing
	                    // ones with the same breakpoint number, we don't want dupes.
	                    while( l >= 0 ) {
	                        if( _.breakpoints[l] && _.breakpoints[l] === currentBreakpoint ) {
	                            _.breakpoints.splice(l,1);
	                        }
	                        l--;
	                    }

	                    _.breakpoints.push(currentBreakpoint);
	                    _.breakpointSettings[currentBreakpoint] = responsiveSettings[breakpoint].settings;

	                }

	            }

	            _.breakpoints.sort(function(a, b) {
	                return ( _.options.mobileFirst ) ? a-b : b-a;
	            });

	        }

	    };

	    Slick.prototype.reinit = function() {

	        var _ = this;

	        _.$slides =
	            _.$slideTrack
	                .children(_.options.slide)
	                .addClass('slick-slide');

	        _.slideCount = _.$slides.length;

	        if (_.currentSlide >= _.slideCount && _.currentSlide !== 0) {
	            _.currentSlide = _.currentSlide - _.options.slidesToScroll;
	        }

	        if (_.slideCount <= _.options.slidesToShow) {
	            _.currentSlide = 0;
	        }

	        _.registerBreakpoints();

	        _.setProps();
	        _.setupInfinite();
	        _.buildArrows();
	        _.updateArrows();
	        _.initArrowEvents();
	        _.buildDots();
	        _.updateDots();
	        _.initDotEvents();
	        _.cleanUpSlideEvents();
	        _.initSlideEvents();

	        _.checkResponsive(false, true);

	        if (_.options.focusOnSelect === true) {
	            $(_.$slideTrack).children().on('click.slick', _.selectHandler);
	        }

	        _.setSlideClasses(typeof _.currentSlide === 'number' ? _.currentSlide : 0);

	        _.setPosition();
	        _.focusHandler();

	        _.paused = !_.options.autoplay;
	        _.autoPlay();

	        _.$slider.trigger('reInit', [_]);

	    };

	    Slick.prototype.resize = function() {

	        var _ = this;

	        if ($(window).width() !== _.windowWidth) {
	            clearTimeout(_.windowDelay);
	            _.windowDelay = window.setTimeout(function() {
	                _.windowWidth = $(window).width();
	                _.checkResponsive();
	                if( !_.unslicked ) { _.setPosition(); }
	            }, 50);
	        }
	    };

	    Slick.prototype.removeSlide = Slick.prototype.slickRemove = function(index, removeBefore, removeAll) {

	        var _ = this;

	        if (typeof(index) === 'boolean') {
	            removeBefore = index;
	            index = removeBefore === true ? 0 : _.slideCount - 1;
	        } else {
	            index = removeBefore === true ? --index : index;
	        }

	        if (_.slideCount < 1 || index < 0 || index > _.slideCount - 1) {
	            return false;
	        }

	        _.unload();

	        if (removeAll === true) {
	            _.$slideTrack.children().remove();
	        } else {
	            _.$slideTrack.children(this.options.slide).eq(index).remove();
	        }

	        _.$slides = _.$slideTrack.children(this.options.slide);

	        _.$slideTrack.children(this.options.slide).detach();

	        _.$slideTrack.append(_.$slides);

	        _.$slidesCache = _.$slides;

	        _.reinit();

	    };

	    Slick.prototype.setCSS = function(position) {

	        var _ = this,
	            positionProps = {},
	            x, y;

	        if (_.options.rtl === true) {
	            position = -position;
	        }
	        x = _.positionProp == 'left' ? Math.ceil(position) + 'px' : '0px';
	        y = _.positionProp == 'top' ? Math.ceil(position) + 'px' : '0px';

	        positionProps[_.positionProp] = position;

	        if (_.transformsEnabled === false) {
	            _.$slideTrack.css(positionProps);
	        } else {
	            positionProps = {};
	            if (_.cssTransitions === false) {
	                positionProps[_.animType] = 'translate(' + x + ', ' + y + ')';
	                _.$slideTrack.css(positionProps);
	            } else {
	                positionProps[_.animType] = 'translate3d(' + x + ', ' + y + ', 0px)';
	                _.$slideTrack.css(positionProps);
	            }
	        }

	    };

	    Slick.prototype.setDimensions = function() {

	        var _ = this;

	        if (_.options.vertical === false) {
	            if (_.options.centerMode === true) {
	                _.$list.css({
	                    padding: ('0px ' + _.options.centerPadding)
	                });
	            }
	        } else {
	            _.$list.height(_.$slides.first().outerHeight(true) * _.options.slidesToShow);
	            if (_.options.centerMode === true) {
	                _.$list.css({
	                    padding: (_.options.centerPadding + ' 0px')
	                });
	            }
	        }

	        _.listWidth = _.$list.width();
	        _.listHeight = _.$list.height();


	        if (_.options.vertical === false && _.options.variableWidth === false) {
	            _.slideWidth = Math.ceil(_.listWidth / _.options.slidesToShow);
	            _.$slideTrack.width(Math.ceil((_.slideWidth * _.$slideTrack.children('.slick-slide').length)));

	        } else if (_.options.variableWidth === true) {
	            _.$slideTrack.width(5000 * _.slideCount);
	        } else {
	            _.slideWidth = Math.ceil(_.listWidth);
	            _.$slideTrack.height(Math.ceil((_.$slides.first().outerHeight(true) * _.$slideTrack.children('.slick-slide').length)));
	        }

	        var offset = _.$slides.first().outerWidth(true) - _.$slides.first().width();
	        if (_.options.variableWidth === false) _.$slideTrack.children('.slick-slide').width(_.slideWidth - offset);

	    };

	    Slick.prototype.setFade = function() {

	        var _ = this,
	            targetLeft;

	        _.$slides.each(function(index, element) {
	            targetLeft = (_.slideWidth * index) * -1;
	            if (_.options.rtl === true) {
	                $(element).css({
	                    position: 'relative',
	                    right: targetLeft,
	                    top: 0,
	                    zIndex: _.options.zIndex - 2,
	                    opacity: 0
	                });
	            } else {
	                $(element).css({
	                    position: 'relative',
	                    left: targetLeft,
	                    top: 0,
	                    zIndex: _.options.zIndex - 2,
	                    opacity: 0
	                });
	            }
	        });

	        _.$slides.eq(_.currentSlide).css({
	            zIndex: _.options.zIndex - 1,
	            opacity: 1
	        });

	    };

	    Slick.prototype.setHeight = function() {

	        var _ = this;

	        if (_.options.slidesToShow === 1 && _.options.adaptiveHeight === true && _.options.vertical === false) {
	            var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
	            _.$list.css('height', targetHeight);
	        }

	    };

	    Slick.prototype.setOption =
	    Slick.prototype.slickSetOption = function() {

	        /**
	         * accepts arguments in format of:
	         *
	         *  - for changing a single option's value:
	         *     .slick("setOption", option, value, refresh )
	         *
	         *  - for changing a set of responsive options:
	         *     .slick("setOption", 'responsive', [{}, ...], refresh )
	         *
	         *  - for updating multiple values at once (not responsive)
	         *     .slick("setOption", { 'option': value, ... }, refresh )
	         */

	        var _ = this, l, item, option, value, refresh = false, type;

	        if( $.type( arguments[0] ) === 'object' ) {

	            option =  arguments[0];
	            refresh = arguments[1];
	            type = 'multiple';

	        } else if ( $.type( arguments[0] ) === 'string' ) {

	            option =  arguments[0];
	            value = arguments[1];
	            refresh = arguments[2];

	            if ( arguments[0] === 'responsive' && $.type( arguments[1] ) === 'array' ) {

	                type = 'responsive';

	            } else if ( typeof arguments[1] !== 'undefined' ) {

	                type = 'single';

	            }

	        }

	        if ( type === 'single' ) {

	            _.options[option] = value;


	        } else if ( type === 'multiple' ) {

	            $.each( option , function( opt, val ) {

	                _.options[opt] = val;

	            });


	        } else if ( type === 'responsive' ) {

	            for ( item in value ) {

	                if( $.type( _.options.responsive ) !== 'array' ) {

	                    _.options.responsive = [ value[item] ];

	                } else {

	                    l = _.options.responsive.length-1;

	                    // loop through the responsive object and splice out duplicates.
	                    while( l >= 0 ) {

	                        if( _.options.responsive[l].breakpoint === value[item].breakpoint ) {

	                            _.options.responsive.splice(l,1);

	                        }

	                        l--;

	                    }

	                    _.options.responsive.push( value[item] );

	                }

	            }

	        }

	        if ( refresh ) {

	            _.unload();
	            _.reinit();

	        }

	    };

	    Slick.prototype.setPosition = function() {

	        var _ = this;

	        _.setDimensions();

	        _.setHeight();

	        if (_.options.fade === false) {
	            _.setCSS(_.getLeft(_.currentSlide));
	        } else {
	            _.setFade();
	        }

	        _.$slider.trigger('setPosition', [_]);

	    };

	    Slick.prototype.setProps = function() {

	        var _ = this,
	            bodyStyle = document.body.style;

	        _.positionProp = _.options.vertical === true ? 'top' : 'left';

	        if (_.positionProp === 'top') {
	            _.$slider.addClass('slick-vertical');
	        } else {
	            _.$slider.removeClass('slick-vertical');
	        }

	        if (bodyStyle.WebkitTransition !== undefined ||
	            bodyStyle.MozTransition !== undefined ||
	            bodyStyle.msTransition !== undefined) {
	            if (_.options.useCSS === true) {
	                _.cssTransitions = true;
	            }
	        }

	        if ( _.options.fade ) {
	            if ( typeof _.options.zIndex === 'number' ) {
	                if( _.options.zIndex < 3 ) {
	                    _.options.zIndex = 3;
	                }
	            } else {
	                _.options.zIndex = _.defaults.zIndex;
	            }
	        }

	        if (bodyStyle.OTransform !== undefined) {
	            _.animType = 'OTransform';
	            _.transformType = '-o-transform';
	            _.transitionType = 'OTransition';
	            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.webkitPerspective === undefined) _.animType = false;
	        }
	        if (bodyStyle.MozTransform !== undefined) {
	            _.animType = 'MozTransform';
	            _.transformType = '-moz-transform';
	            _.transitionType = 'MozTransition';
	            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.MozPerspective === undefined) _.animType = false;
	        }
	        if (bodyStyle.webkitTransform !== undefined) {
	            _.animType = 'webkitTransform';
	            _.transformType = '-webkit-transform';
	            _.transitionType = 'webkitTransition';
	            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.webkitPerspective === undefined) _.animType = false;
	        }
	        if (bodyStyle.msTransform !== undefined) {
	            _.animType = 'msTransform';
	            _.transformType = '-ms-transform';
	            _.transitionType = 'msTransition';
	            if (bodyStyle.msTransform === undefined) _.animType = false;
	        }
	        if (bodyStyle.transform !== undefined && _.animType !== false) {
	            _.animType = 'transform';
	            _.transformType = 'transform';
	            _.transitionType = 'transition';
	        }
	        _.transformsEnabled = _.options.useTransform && (_.animType !== null && _.animType !== false);
	    };


	    Slick.prototype.setSlideClasses = function(index) {

	        var _ = this,
	            centerOffset, allSlides, indexOffset, remainder;

	        allSlides = _.$slider
	            .find('.slick-slide')
	            .removeClass('slick-active slick-center slick-current')
	            .attr('aria-hidden', 'true');

	        _.$slides
	            .eq(index)
	            .addClass('slick-current');

	        if (_.options.centerMode === true) {

	            centerOffset = Math.floor(_.options.slidesToShow / 2);

	            if (_.options.infinite === true) {

	                if (index >= centerOffset && index <= (_.slideCount - 1) - centerOffset) {

	                    _.$slides
	                        .slice(index - centerOffset, index + centerOffset + 1)
	                        .addClass('slick-active')
	                        .attr('aria-hidden', 'false');

	                } else {

	                    indexOffset = _.options.slidesToShow + index;
	                    allSlides
	                        .slice(indexOffset - centerOffset + 1, indexOffset + centerOffset + 2)
	                        .addClass('slick-active')
	                        .attr('aria-hidden', 'false');

	                }

	                if (index === 0) {

	                    allSlides
	                        .eq(allSlides.length - 1 - _.options.slidesToShow)
	                        .addClass('slick-center');

	                } else if (index === _.slideCount - 1) {

	                    allSlides
	                        .eq(_.options.slidesToShow)
	                        .addClass('slick-center');

	                }

	            }

	            _.$slides
	                .eq(index)
	                .addClass('slick-center');

	        } else {

	            if (index >= 0 && index <= (_.slideCount - _.options.slidesToShow)) {

	                _.$slides
	                    .slice(index, index + _.options.slidesToShow)
	                    .addClass('slick-active')
	                    .attr('aria-hidden', 'false');

	            } else if (allSlides.length <= _.options.slidesToShow) {

	                allSlides
	                    .addClass('slick-active')
	                    .attr('aria-hidden', 'false');

	            } else {

	                remainder = _.slideCount % _.options.slidesToShow;
	                indexOffset = _.options.infinite === true ? _.options.slidesToShow + index : index;

	                if (_.options.slidesToShow == _.options.slidesToScroll && (_.slideCount - index) < _.options.slidesToShow) {

	                    allSlides
	                        .slice(indexOffset - (_.options.slidesToShow - remainder), indexOffset + remainder)
	                        .addClass('slick-active')
	                        .attr('aria-hidden', 'false');

	                } else {

	                    allSlides
	                        .slice(indexOffset, indexOffset + _.options.slidesToShow)
	                        .addClass('slick-active')
	                        .attr('aria-hidden', 'false');

	                }

	            }

	        }

	        if (_.options.lazyLoad === 'ondemand') {
	            _.lazyLoad();
	        }

	    };

	    Slick.prototype.setupInfinite = function() {

	        var _ = this,
	            i, slideIndex, infiniteCount;

	        if (_.options.fade === true) {
	            _.options.centerMode = false;
	        }

	        if (_.options.infinite === true && _.options.fade === false) {

	            slideIndex = null;

	            if (_.slideCount > _.options.slidesToShow) {

	                if (_.options.centerMode === true) {
	                    infiniteCount = _.options.slidesToShow + 1;
	                } else {
	                    infiniteCount = _.options.slidesToShow;
	                }

	                for (i = _.slideCount; i > (_.slideCount -
	                        infiniteCount); i -= 1) {
	                    slideIndex = i - 1;
	                    $(_.$slides[slideIndex]).clone(true).attr('id', '')
	                        .attr('data-slick-index', slideIndex - _.slideCount)
	                        .prependTo(_.$slideTrack).addClass('slick-cloned');
	                }
	                for (i = 0; i < infiniteCount; i += 1) {
	                    slideIndex = i;
	                    $(_.$slides[slideIndex]).clone(true).attr('id', '')
	                        .attr('data-slick-index', slideIndex + _.slideCount)
	                        .appendTo(_.$slideTrack).addClass('slick-cloned');
	                }
	                _.$slideTrack.find('.slick-cloned').find('[id]').each(function() {
	                    $(this).attr('id', '');
	                });

	            }

	        }

	    };

	    Slick.prototype.interrupt = function( toggle ) {

	        var _ = this;

	        if( !toggle ) {
	            _.autoPlay();
	        }
	        _.interrupted = toggle;

	    };

	    Slick.prototype.selectHandler = function(event) {

	        var _ = this;

	        var targetElement =
	            $(event.target).is('.slick-slide') ?
	                $(event.target) :
	                $(event.target).parents('.slick-slide');

	        var index = parseInt(targetElement.attr('data-slick-index'));

	        if (!index) index = 0;

	        if (_.slideCount <= _.options.slidesToShow) {

	            _.setSlideClasses(index);
	            _.asNavFor(index);
	            return;

	        }

	        _.slideHandler(index);

	    };

	    Slick.prototype.slideHandler = function(index, sync, dontAnimate) {

	        var targetSlide, animSlide, oldSlide, slideLeft, targetLeft = null,
	            _ = this, navTarget;

	        sync = sync || false;

	        if (_.animating === true && _.options.waitForAnimate === true) {
	            return;
	        }

	        if (_.options.fade === true && _.currentSlide === index) {
	            return;
	        }

	        if (_.slideCount <= _.options.slidesToShow) {
	            return;
	        }

	        if (sync === false) {
	            _.asNavFor(index);
	        }

	        targetSlide = index;
	        targetLeft = _.getLeft(targetSlide);
	        slideLeft = _.getLeft(_.currentSlide);

	        _.currentLeft = _.swipeLeft === null ? slideLeft : _.swipeLeft;

	        if (_.options.infinite === false && _.options.centerMode === false && (index < 0 || index > _.getDotCount() * _.options.slidesToScroll)) {
	            if (_.options.fade === false) {
	                targetSlide = _.currentSlide;
	                if (dontAnimate !== true) {
	                    _.animateSlide(slideLeft, function() {
	                        _.postSlide(targetSlide);
	                    });
	                } else {
	                    _.postSlide(targetSlide);
	                }
	            }
	            return;
	        } else if (_.options.infinite === false && _.options.centerMode === true && (index < 0 || index > (_.slideCount - _.options.slidesToScroll))) {
	            if (_.options.fade === false) {
	                targetSlide = _.currentSlide;
	                if (dontAnimate !== true) {
	                    _.animateSlide(slideLeft, function() {
	                        _.postSlide(targetSlide);
	                    });
	                } else {
	                    _.postSlide(targetSlide);
	                }
	            }
	            return;
	        }

	        if ( _.options.autoplay ) {
	            clearInterval(_.autoPlayTimer);
	        }

	        if (targetSlide < 0) {
	            if (_.slideCount % _.options.slidesToScroll !== 0) {
	                animSlide = _.slideCount - (_.slideCount % _.options.slidesToScroll);
	            } else {
	                animSlide = _.slideCount + targetSlide;
	            }
	        } else if (targetSlide >= _.slideCount) {
	            if (_.slideCount % _.options.slidesToScroll !== 0) {
	                animSlide = 0;
	            } else {
	                animSlide = targetSlide - _.slideCount;
	            }
	        } else {
	            animSlide = targetSlide;
	        }

	        _.animating = true;

	        _.$slider.trigger('beforeChange', [_, _.currentSlide, animSlide]);

	        oldSlide = _.currentSlide;
	        _.currentSlide = animSlide;

	        _.setSlideClasses(_.currentSlide);

	        if ( _.options.asNavFor ) {

	            navTarget = _.getNavTarget();
	            navTarget = navTarget.slick('getSlick');

	            if ( navTarget.slideCount <= navTarget.options.slidesToShow ) {
	                navTarget.setSlideClasses(_.currentSlide);
	            }

	        }

	        _.updateDots();
	        _.updateArrows();

	        if (_.options.fade === true) {
	            if (dontAnimate !== true) {

	                _.fadeSlideOut(oldSlide);

	                _.fadeSlide(animSlide, function() {
	                    _.postSlide(animSlide);
	                });

	            } else {
	                _.postSlide(animSlide);
	            }
	            _.animateHeight();
	            return;
	        }

	        if (dontAnimate !== true) {
	            _.animateSlide(targetLeft, function() {
	                _.postSlide(animSlide);
	            });
	        } else {
	            _.postSlide(animSlide);
	        }

	    };

	    Slick.prototype.startLoad = function() {

	        var _ = this;

	        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {

	            _.$prevArrow.hide();
	            _.$nextArrow.hide();

	        }

	        if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {

	            _.$dots.hide();

	        }

	        _.$slider.addClass('slick-loading');

	    };

	    Slick.prototype.swipeDirection = function() {

	        var xDist, yDist, r, swipeAngle, _ = this;

	        xDist = _.touchObject.startX - _.touchObject.curX;
	        yDist = _.touchObject.startY - _.touchObject.curY;
	        r = Math.atan2(yDist, xDist);

	        swipeAngle = Math.round(r * 180 / Math.PI);
	        if (swipeAngle < 0) {
	            swipeAngle = 360 - Math.abs(swipeAngle);
	        }

	        if ((swipeAngle <= 45) && (swipeAngle >= 0)) {
	            return (_.options.rtl === false ? 'left' : 'right');
	        }
	        if ((swipeAngle <= 360) && (swipeAngle >= 315)) {
	            return (_.options.rtl === false ? 'left' : 'right');
	        }
	        if ((swipeAngle >= 135) && (swipeAngle <= 225)) {
	            return (_.options.rtl === false ? 'right' : 'left');
	        }
	        if (_.options.verticalSwiping === true) {
	            if ((swipeAngle >= 35) && (swipeAngle <= 135)) {
	                return 'down';
	            } else {
	                return 'up';
	            }
	        }

	        return 'vertical';

	    };

	    Slick.prototype.swipeEnd = function(event) {

	        var _ = this,
	            slideCount,
	            direction;

	        _.dragging = false;
	        _.interrupted = false;
	        _.shouldClick = ( _.touchObject.swipeLength > 10 ) ? false : true;

	        if ( _.touchObject.curX === undefined ) {
	            return false;
	        }

	        if ( _.touchObject.edgeHit === true ) {
	            _.$slider.trigger('edge', [_, _.swipeDirection() ]);
	        }

	        if ( _.touchObject.swipeLength >= _.touchObject.minSwipe ) {

	            direction = _.swipeDirection();

	            switch ( direction ) {

	                case 'left':
	                case 'down':

	                    slideCount =
	                        _.options.swipeToSlide ?
	                            _.checkNavigable( _.currentSlide + _.getSlideCount() ) :
	                            _.currentSlide + _.getSlideCount();

	                    _.currentDirection = 0;

	                    break;

	                case 'right':
	                case 'up':

	                    slideCount =
	                        _.options.swipeToSlide ?
	                            _.checkNavigable( _.currentSlide - _.getSlideCount() ) :
	                            _.currentSlide - _.getSlideCount();

	                    _.currentDirection = 1;

	                    break;

	                default:


	            }

	            if( direction != 'vertical' ) {

	                _.slideHandler( slideCount );
	                _.touchObject = {};
	                _.$slider.trigger('swipe', [_, direction ]);

	            }

	        } else {

	            if ( _.touchObject.startX !== _.touchObject.curX ) {

	                _.slideHandler( _.currentSlide );
	                _.touchObject = {};

	            }

	        }

	    };

	    Slick.prototype.swipeHandler = function(event) {

	        var _ = this;

	        if ((_.options.swipe === false) || ('ontouchend' in document && _.options.swipe === false)) {
	            return;
	        } else if (_.options.draggable === false && event.type.indexOf('mouse') !== -1) {
	            return;
	        }

	        _.touchObject.fingerCount = event.originalEvent && event.originalEvent.touches !== undefined ?
	            event.originalEvent.touches.length : 1;

	        _.touchObject.minSwipe = _.listWidth / _.options
	            .touchThreshold;

	        if (_.options.verticalSwiping === true) {
	            _.touchObject.minSwipe = _.listHeight / _.options
	                .touchThreshold;
	        }

	        switch (event.data.action) {

	            case 'start':
	                _.swipeStart(event);
	                break;

	            case 'move':
	                _.swipeMove(event);
	                break;

	            case 'end':
	                _.swipeEnd(event);
	                break;

	        }

	    };

	    Slick.prototype.swipeMove = function(event) {

	        var _ = this,
	            edgeWasHit = false,
	            curLeft, swipeDirection, swipeLength, positionOffset, touches;

	        touches = event.originalEvent !== undefined ? event.originalEvent.touches : null;

	        if (!_.dragging || touches && touches.length !== 1) {
	            return false;
	        }

	        curLeft = _.getLeft(_.currentSlide);

	        _.touchObject.curX = touches !== undefined ? touches[0].pageX : event.clientX;
	        _.touchObject.curY = touches !== undefined ? touches[0].pageY : event.clientY;

	        _.touchObject.swipeLength = Math.round(Math.sqrt(
	            Math.pow(_.touchObject.curX - _.touchObject.startX, 2)));

	        if (_.options.verticalSwiping === true) {
	            _.touchObject.swipeLength = Math.round(Math.sqrt(
	                Math.pow(_.touchObject.curY - _.touchObject.startY, 2)));
	        }

	        swipeDirection = _.swipeDirection();

	        if (swipeDirection === 'vertical') {
	            return;
	        }

	        if (event.originalEvent !== undefined && _.touchObject.swipeLength > 4) {
	            event.preventDefault();
	        }

	        positionOffset = (_.options.rtl === false ? 1 : -1) * (_.touchObject.curX > _.touchObject.startX ? 1 : -1);
	        if (_.options.verticalSwiping === true) {
	            positionOffset = _.touchObject.curY > _.touchObject.startY ? 1 : -1;
	        }


	        swipeLength = _.touchObject.swipeLength;

	        _.touchObject.edgeHit = false;

	        if (_.options.infinite === false) {
	            if ((_.currentSlide === 0 && swipeDirection === 'right') || (_.currentSlide >= _.getDotCount() && swipeDirection === 'left')) {
	                swipeLength = _.touchObject.swipeLength * _.options.edgeFriction;
	                _.touchObject.edgeHit = true;
	            }
	        }

	        if (_.options.vertical === false) {
	            _.swipeLeft = curLeft + swipeLength * positionOffset;
	        } else {
	            _.swipeLeft = curLeft + (swipeLength * (_.$list.height() / _.listWidth)) * positionOffset;
	        }
	        if (_.options.verticalSwiping === true) {
	            _.swipeLeft = curLeft + swipeLength * positionOffset;
	        }

	        if (_.options.fade === true || _.options.touchMove === false) {
	            return false;
	        }

	        if (_.animating === true) {
	            _.swipeLeft = null;
	            return false;
	        }

	        _.setCSS(_.swipeLeft);

	    };

	    Slick.prototype.swipeStart = function(event) {

	        var _ = this,
	            touches;

	        _.interrupted = true;

	        if (_.touchObject.fingerCount !== 1 || _.slideCount <= _.options.slidesToShow) {
	            _.touchObject = {};
	            return false;
	        }

	        if (event.originalEvent !== undefined && event.originalEvent.touches !== undefined) {
	            touches = event.originalEvent.touches[0];
	        }

	        _.touchObject.startX = _.touchObject.curX = touches !== undefined ? touches.pageX : event.clientX;
	        _.touchObject.startY = _.touchObject.curY = touches !== undefined ? touches.pageY : event.clientY;

	        _.dragging = true;

	    };

	    Slick.prototype.unfilterSlides = Slick.prototype.slickUnfilter = function() {

	        var _ = this;

	        if (_.$slidesCache !== null) {

	            _.unload();

	            _.$slideTrack.children(this.options.slide).detach();

	            _.$slidesCache.appendTo(_.$slideTrack);

	            _.reinit();

	        }

	    };

	    Slick.prototype.unload = function() {

	        var _ = this;

	        $('.slick-cloned', _.$slider).remove();

	        if (_.$dots) {
	            _.$dots.remove();
	        }

	        if (_.$prevArrow && _.htmlExpr.test(_.options.prevArrow)) {
	            _.$prevArrow.remove();
	        }

	        if (_.$nextArrow && _.htmlExpr.test(_.options.nextArrow)) {
	            _.$nextArrow.remove();
	        }

	        _.$slides
	            .removeClass('slick-slide slick-active slick-visible slick-current')
	            .attr('aria-hidden', 'true')
	            .css('width', '');

	    };

	    Slick.prototype.unslick = function(fromBreakpoint) {

	        var _ = this;
	        _.$slider.trigger('unslick', [_, fromBreakpoint]);
	        _.destroy();

	    };

	    Slick.prototype.updateArrows = function() {

	        var _ = this,
	            centerOffset;

	        centerOffset = Math.floor(_.options.slidesToShow / 2);

	        if ( _.options.arrows === true &&
	            _.slideCount > _.options.slidesToShow &&
	            !_.options.infinite ) {

	            _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');
	            _.$nextArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

	            if (_.currentSlide === 0) {

	                _.$prevArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
	                _.$nextArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

	            } else if (_.currentSlide >= _.slideCount - _.options.slidesToShow && _.options.centerMode === false) {

	                _.$nextArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
	                _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

	            } else if (_.currentSlide >= _.slideCount - 1 && _.options.centerMode === true) {

	                _.$nextArrow.addClass('slick-disabled').attr('aria-disabled', 'true');
	                _.$prevArrow.removeClass('slick-disabled').attr('aria-disabled', 'false');

	            }

	        }

	    };

	    Slick.prototype.updateDots = function() {

	        var _ = this;

	        if (_.$dots !== null) {

	            _.$dots
	                .find('li')
	                .removeClass('slick-active')
	                .attr('aria-hidden', 'true');

	            _.$dots
	                .find('li')
	                .eq(Math.floor(_.currentSlide / _.options.slidesToScroll))
	                .addClass('slick-active')
	                .attr('aria-hidden', 'false');

	        }

	    };

	    Slick.prototype.visibility = function() {

	        var _ = this;

	        if ( _.options.autoplay ) {

	            if ( document[_.hidden] ) {

	                _.interrupted = true;

	            } else {

	                _.interrupted = false;

	            }

	        }

	    };

	    $.fn.slick = function() {
	        var _ = this,
	            opt = arguments[0],
	            args = Array.prototype.slice.call(arguments, 1),
	            l = _.length,
	            i,
	            ret;
	        for (i = 0; i < l; i++) {
	            if (typeof opt == 'object' || typeof opt == 'undefined')
	                _[i].slick = new Slick(_[i], opt);
	            else
	                ret = _[i].slick[opt].apply(_[i].slick, args);
	            if (typeof ret != 'undefined') return ret;
	        }
	        return _;
	    };

	}));


/***/ },

/***/ 531:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_1__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_2__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_3__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_4__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_5__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_6__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_7__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_8__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_LOCAL_MODULE_9__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_10__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_11__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_12__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_13__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_14__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_LOCAL_MODULE_15__;var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * Isotope PACKAGED v2.2.2
	 *
	 * Licensed GPLv3 for open source use
	 * or Isotope Commercial License for commercial use
	 *
	 * http://isotope.metafizzy.co
	 * Copyright 2015 Metafizzy
	 */

	/**
	 * Bridget makes jQuery widgets
	 * v1.1.0
	 * MIT license
	 */

	( function( window ) {



	// -------------------------- utils -------------------------- //

	var slice = Array.prototype.slice;

	function noop() {}

	// -------------------------- definition -------------------------- //

	function defineBridget( $ ) {

	// bail if no jQuery
	if ( !$ ) {
	  return;
	}

	// -------------------------- addOptionMethod -------------------------- //

	/**
	 * adds option method -> $().plugin('option', {...})
	 * @param {Function} PluginClass - constructor class
	 */
	function addOptionMethod( PluginClass ) {
	  // don't overwrite original option method
	  if ( PluginClass.prototype.option ) {
	    return;
	  }

	  // option setter
	  PluginClass.prototype.option = function( opts ) {
	    // bail out if not an object
	    if ( !$.isPlainObject( opts ) ){
	      return;
	    }
	    this.options = $.extend( true, this.options, opts );
	  };
	}

	// -------------------------- plugin bridge -------------------------- //

	// helper function for logging errors
	// $.error breaks jQuery chaining
	var logError = typeof console === 'undefined' ? noop :
	  function( message ) {
	    console.error( message );
	  };

	/**
	 * jQuery plugin bridge, access methods like $elem.plugin('method')
	 * @param {String} namespace - plugin name
	 * @param {Function} PluginClass - constructor class
	 */
	function bridge( namespace, PluginClass ) {
	  // add to jQuery fn namespace
	  $.fn[ namespace ] = function( options ) {
	    if ( typeof options === 'string' ) {
	      // call plugin method when first argument is a string
	      // get arguments for method
	      var args = slice.call( arguments, 1 );

	      for ( var i=0, len = this.length; i < len; i++ ) {
	        var elem = this[i];
	        var instance = $.data( elem, namespace );
	        if ( !instance ) {
	          logError( "cannot call methods on " + namespace + " prior to initialization; " +
	            "attempted to call '" + options + "'" );
	          continue;
	        }
	        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
	          logError( "no such method '" + options + "' for " + namespace + " instance" );
	          continue;
	        }

	        // trigger method with arguments
	        var returnValue = instance[ options ].apply( instance, args );

	        // break look and return first value if provided
	        if ( returnValue !== undefined ) {
	          return returnValue;
	        }
	      }
	      // return this if no return value
	      return this;
	    } else {
	      return this.each( function() {
	        var instance = $.data( this, namespace );
	        if ( instance ) {
	          // apply options & init
	          instance.option( options );
	          instance._init();
	        } else {
	          // initialize new instance
	          instance = new PluginClass( this, options );
	          $.data( this, namespace, instance );
	        }
	      });
	    }
	  };

	}

	// -------------------------- bridget -------------------------- //

	/**
	 * converts a Prototypical class into a proper jQuery plugin
	 *   the class must have a ._init method
	 * @param {String} namespace - plugin name, used in $().pluginName
	 * @param {Function} PluginClass - constructor class
	 */
	$.bridget = function( namespace, PluginClass ) {
	  addOptionMethod( PluginClass );
	  bridge( namespace, PluginClass );
	};

	return $.bridget;

	}

	// transport
	if ( true ) {
	  // AMD
	  !(__WEBPACK_AMD_DEFINE_ARRAY__ = [ __webpack_require__(6) ], __WEBPACK_AMD_DEFINE_FACTORY__ = (defineBridget), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else if ( typeof exports === 'object' ) {
	  defineBridget( require('jquery') );
	} else {
	  // get jquery from browser global
	  defineBridget( window.jQuery );
	}

	})( window );

	/*!
	 * eventie v1.0.6
	 * event binding helper
	 *   eventie.bind( elem, 'click', myFn )
	 *   eventie.unbind( elem, 'click', myFn )
	 * MIT license
	 */

	/*jshint browser: true, undef: true, unused: true */
	/*global define: false, module: false */

	( function( window ) {



	var docElem = document.documentElement;

	var bind = function() {};

	function getIEEvent( obj ) {
	  var event = window.event;
	  // add event.target
	  event.target = event.target || event.srcElement || obj;
	  return event;
	}

	if ( docElem.addEventListener ) {
	  bind = function( obj, type, fn ) {
	    obj.addEventListener( type, fn, false );
	  };
	} else if ( docElem.attachEvent ) {
	  bind = function( obj, type, fn ) {
	    obj[ type + fn ] = fn.handleEvent ?
	      function() {
	        var event = getIEEvent( obj );
	        fn.handleEvent.call( fn, event );
	      } :
	      function() {
	        var event = getIEEvent( obj );
	        fn.call( obj, event );
	      };
	    obj.attachEvent( "on" + type, obj[ type + fn ] );
	  };
	}

	var unbind = function() {};

	if ( docElem.removeEventListener ) {
	  unbind = function( obj, type, fn ) {
	    obj.removeEventListener( type, fn, false );
	  };
	} else if ( docElem.detachEvent ) {
	  unbind = function( obj, type, fn ) {
	    obj.detachEvent( "on" + type, obj[ type + fn ] );
	    try {
	      delete obj[ type + fn ];
	    } catch ( err ) {
	      // can't delete window object properties
	      obj[ type + fn ] = undefined;
	    }
	  };
	}

	var eventie = {
	  bind: bind,
	  unbind: unbind
	};

	// ----- module definition ----- //

	if ( true ) {
	  // AMD
	  !(__WEBPACK_AMD_DEFINE_FACTORY__ = (eventie), __WEBPACK_LOCAL_MODULE_1__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = eventie;
	} else {
	  // browser global
	  window.eventie = eventie;
	}

	})( window );

	/*!
	 * EventEmitter v4.2.11 - git.io/ee
	 * Unlicense - http://unlicense.org/
	 * Oliver Caldwell - http://oli.me.uk/
	 * @preserve
	 */

	;(function () {
	    'use strict';

	    /**
	     * Class for managing events.
	     * Can be extended to provide event functionality in other classes.
	     *
	     * @class EventEmitter Manages event registering and emitting.
	     */
	    function EventEmitter() {}

	    // Shortcuts to improve speed and size
	    var proto = EventEmitter.prototype;
	    var exports = this;
	    var originalGlobalValue = exports.EventEmitter;

	    /**
	     * Finds the index of the listener for the event in its storage array.
	     *
	     * @param {Function[]} listeners Array of listeners to search through.
	     * @param {Function} listener Method to look for.
	     * @return {Number} Index of the specified listener, -1 if not found
	     * @api private
	     */
	    function indexOfListener(listeners, listener) {
	        var i = listeners.length;
	        while (i--) {
	            if (listeners[i].listener === listener) {
	                return i;
	            }
	        }

	        return -1;
	    }

	    /**
	     * Alias a method while keeping the context correct, to allow for overwriting of target method.
	     *
	     * @param {String} name The name of the target method.
	     * @return {Function} The aliased method
	     * @api private
	     */
	    function alias(name) {
	        return function aliasClosure() {
	            return this[name].apply(this, arguments);
	        };
	    }

	    /**
	     * Returns the listener array for the specified event.
	     * Will initialise the event object and listener arrays if required.
	     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
	     * Each property in the object response is an array of listener functions.
	     *
	     * @param {String|RegExp} evt Name of the event to return the listeners from.
	     * @return {Function[]|Object} All listener functions for the event.
	     */
	    proto.getListeners = function getListeners(evt) {
	        var events = this._getEvents();
	        var response;
	        var key;

	        // Return a concatenated array of all matching events if
	        // the selector is a regular expression.
	        if (evt instanceof RegExp) {
	            response = {};
	            for (key in events) {
	                if (events.hasOwnProperty(key) && evt.test(key)) {
	                    response[key] = events[key];
	                }
	            }
	        }
	        else {
	            response = events[evt] || (events[evt] = []);
	        }

	        return response;
	    };

	    /**
	     * Takes a list of listener objects and flattens it into a list of listener functions.
	     *
	     * @param {Object[]} listeners Raw listener objects.
	     * @return {Function[]} Just the listener functions.
	     */
	    proto.flattenListeners = function flattenListeners(listeners) {
	        var flatListeners = [];
	        var i;

	        for (i = 0; i < listeners.length; i += 1) {
	            flatListeners.push(listeners[i].listener);
	        }

	        return flatListeners;
	    };

	    /**
	     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
	     *
	     * @param {String|RegExp} evt Name of the event to return the listeners from.
	     * @return {Object} All listener functions for an event in an object.
	     */
	    proto.getListenersAsObject = function getListenersAsObject(evt) {
	        var listeners = this.getListeners(evt);
	        var response;

	        if (listeners instanceof Array) {
	            response = {};
	            response[evt] = listeners;
	        }

	        return response || listeners;
	    };

	    /**
	     * Adds a listener function to the specified event.
	     * The listener will not be added if it is a duplicate.
	     * If the listener returns true then it will be removed after it is called.
	     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to attach the listener to.
	     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addListener = function addListener(evt, listener) {
	        var listeners = this.getListenersAsObject(evt);
	        var listenerIsWrapped = typeof listener === 'object';
	        var key;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
	                listeners[key].push(listenerIsWrapped ? listener : {
	                    listener: listener,
	                    once: false
	                });
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of addListener
	     */
	    proto.on = alias('addListener');

	    /**
	     * Semi-alias of addListener. It will add a listener that will be
	     * automatically removed after its first execution.
	     *
	     * @param {String|RegExp} evt Name of the event to attach the listener to.
	     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addOnceListener = function addOnceListener(evt, listener) {
	        return this.addListener(evt, {
	            listener: listener,
	            once: true
	        });
	    };

	    /**
	     * Alias of addOnceListener.
	     */
	    proto.once = alias('addOnceListener');

	    /**
	     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
	     * You need to tell it what event names should be matched by a regex.
	     *
	     * @param {String} evt Name of the event to create.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.defineEvent = function defineEvent(evt) {
	        this.getListeners(evt);
	        return this;
	    };

	    /**
	     * Uses defineEvent to define multiple events.
	     *
	     * @param {String[]} evts An array of event names to define.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.defineEvents = function defineEvents(evts) {
	        for (var i = 0; i < evts.length; i += 1) {
	            this.defineEvent(evts[i]);
	        }
	        return this;
	    };

	    /**
	     * Removes a listener function from the specified event.
	     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to remove the listener from.
	     * @param {Function} listener Method to remove from the event.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeListener = function removeListener(evt, listener) {
	        var listeners = this.getListenersAsObject(evt);
	        var index;
	        var key;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key)) {
	                index = indexOfListener(listeners[key], listener);

	                if (index !== -1) {
	                    listeners[key].splice(index, 1);
	                }
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of removeListener
	     */
	    proto.off = alias('removeListener');

	    /**
	     * Adds listeners in bulk using the manipulateListeners method.
	     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
	     * You can also pass it a regular expression to add the array of listeners to all events that match it.
	     * Yeah, this function does quite a bit. That's probably a bad thing.
	     *
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to add.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addListeners = function addListeners(evt, listeners) {
	        // Pass through to manipulateListeners
	        return this.manipulateListeners(false, evt, listeners);
	    };

	    /**
	     * Removes listeners in bulk using the manipulateListeners method.
	     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	     * You can also pass it an event name and an array of listeners to be removed.
	     * You can also pass it a regular expression to remove the listeners from all events that match it.
	     *
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to remove.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeListeners = function removeListeners(evt, listeners) {
	        // Pass through to manipulateListeners
	        return this.manipulateListeners(true, evt, listeners);
	    };

	    /**
	     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
	     * The first argument will determine if the listeners are removed (true) or added (false).
	     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	     * You can also pass it an event name and an array of listeners to be added/removed.
	     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
	     *
	     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
	        var i;
	        var value;
	        var single = remove ? this.removeListener : this.addListener;
	        var multiple = remove ? this.removeListeners : this.addListeners;

	        // If evt is an object then pass each of its properties to this method
	        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
	            for (i in evt) {
	                if (evt.hasOwnProperty(i) && (value = evt[i])) {
	                    // Pass the single listener straight through to the singular method
	                    if (typeof value === 'function') {
	                        single.call(this, i, value);
	                    }
	                    else {
	                        // Otherwise pass back to the multiple function
	                        multiple.call(this, i, value);
	                    }
	                }
	            }
	        }
	        else {
	            // So evt must be a string
	            // And listeners must be an array of listeners
	            // Loop over it and pass each one to the multiple method
	            i = listeners.length;
	            while (i--) {
	                single.call(this, evt, listeners[i]);
	            }
	        }

	        return this;
	    };

	    /**
	     * Removes all listeners from a specified event.
	     * If you do not specify an event then all listeners will be removed.
	     * That means every event will be emptied.
	     * You can also pass a regex to remove all events that match it.
	     *
	     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeEvent = function removeEvent(evt) {
	        var type = typeof evt;
	        var events = this._getEvents();
	        var key;

	        // Remove different things depending on the state of evt
	        if (type === 'string') {
	            // Remove all listeners for the specified event
	            delete events[evt];
	        }
	        else if (evt instanceof RegExp) {
	            // Remove all events matching the regex.
	            for (key in events) {
	                if (events.hasOwnProperty(key) && evt.test(key)) {
	                    delete events[key];
	                }
	            }
	        }
	        else {
	            // Remove all listeners in all events
	            delete this._events;
	        }

	        return this;
	    };

	    /**
	     * Alias of removeEvent.
	     *
	     * Added to mirror the node API.
	     */
	    proto.removeAllListeners = alias('removeEvent');

	    /**
	     * Emits an event of your choice.
	     * When emitted, every listener attached to that event will be executed.
	     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
	     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
	     * So they will not arrive within the array on the other side, they will be separate.
	     * You can also pass a regular expression to emit to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	     * @param {Array} [args] Optional array of arguments to be passed to each listener.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.emitEvent = function emitEvent(evt, args) {
	        var listeners = this.getListenersAsObject(evt);
	        var listener;
	        var i;
	        var key;
	        var response;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key)) {
	                i = listeners[key].length;

	                while (i--) {
	                    // If the listener returns true then it shall be removed from the event
	                    // The function is executed either with a basic call or an apply if there is an args array
	                    listener = listeners[key][i];

	                    if (listener.once === true) {
	                        this.removeListener(evt, listener.listener);
	                    }

	                    response = listener.listener.apply(this, args || []);

	                    if (response === this._getOnceReturnValue()) {
	                        this.removeListener(evt, listener.listener);
	                    }
	                }
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of emitEvent
	     */
	    proto.trigger = alias('emitEvent');

	    /**
	     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
	     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	     * @param {...*} Optional additional arguments to be passed to each listener.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.emit = function emit(evt) {
	        var args = Array.prototype.slice.call(arguments, 1);
	        return this.emitEvent(evt, args);
	    };

	    /**
	     * Sets the current value to check against when executing listeners. If a
	     * listeners return value matches the one set here then it will be removed
	     * after execution. This value defaults to true.
	     *
	     * @param {*} value The new value to check for when executing listeners.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.setOnceReturnValue = function setOnceReturnValue(value) {
	        this._onceReturnValue = value;
	        return this;
	    };

	    /**
	     * Fetches the current value to check against when executing listeners. If
	     * the listeners return value matches this one then it should be removed
	     * automatically. It will return true by default.
	     *
	     * @return {*|Boolean} The current value to check for or the default, true.
	     * @api private
	     */
	    proto._getOnceReturnValue = function _getOnceReturnValue() {
	        if (this.hasOwnProperty('_onceReturnValue')) {
	            return this._onceReturnValue;
	        }
	        else {
	            return true;
	        }
	    };

	    /**
	     * Fetches the events object and creates one if required.
	     *
	     * @return {Object} The events storage object.
	     * @api private
	     */
	    proto._getEvents = function _getEvents() {
	        return this._events || (this._events = {});
	    };

	    /**
	     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
	     *
	     * @return {Function} Non conflicting EventEmitter class.
	     */
	    EventEmitter.noConflict = function noConflict() {
	        exports.EventEmitter = originalGlobalValue;
	        return EventEmitter;
	    };

	    // Expose the class either via AMD, CommonJS or the global object
	    if (true) {
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_LOCAL_MODULE_2__ = (function () {
	            return EventEmitter;
	        }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	    }
	    else if (typeof module === 'object' && module.exports){
	        module.exports = EventEmitter;
	    }
	    else {
	        exports.EventEmitter = EventEmitter;
	    }
	}.call(this));

	/*!
	 * getStyleProperty v1.0.4
	 * original by kangax
	 * http://perfectionkills.com/feature-testing-css-properties/
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true */
	/*global define: false, exports: false, module: false */

	( function( window ) {



	var prefixes = 'Webkit Moz ms Ms O'.split(' ');
	var docElemStyle = document.documentElement.style;

	function getStyleProperty( propName ) {
	  if ( !propName ) {
	    return;
	  }

	  // test standard property first
	  if ( typeof docElemStyle[ propName ] === 'string' ) {
	    return propName;
	  }

	  // capitalize
	  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

	  // test vendor specific properties
	  var prefixed;
	  for ( var i=0, len = prefixes.length; i < len; i++ ) {
	    prefixed = prefixes[i] + propName;
	    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
	      return prefixed;
	    }
	  }
	}

	// transport
	if ( true ) {
	  // AMD
	  !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_LOCAL_MODULE_3__ = (function() {
	    return getStyleProperty;
	  }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	} else if ( typeof exports === 'object' ) {
	  // CommonJS for Component
	  module.exports = getStyleProperty;
	} else {
	  // browser global
	  window.getStyleProperty = getStyleProperty;
	}

	})( window );

	/*!
	 * getSize v1.2.2
	 * measure size of elements
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true */
	/*global define: false, exports: false, require: false, module: false, console: false */

	( function( window, undefined ) {



	// -------------------------- helpers -------------------------- //

	// get a number from a string, not a percentage
	function getStyleSize( value ) {
	  var num = parseFloat( value );
	  // not a percent like '100%', and a number
	  var isValid = value.indexOf('%') === -1 && !isNaN( num );
	  return isValid && num;
	}

	function noop() {}

	var logError = typeof console === 'undefined' ? noop :
	  function( message ) {
	    console.error( message );
	  };

	// -------------------------- measurements -------------------------- //

	var measurements = [
	  'paddingLeft',
	  'paddingRight',
	  'paddingTop',
	  'paddingBottom',
	  'marginLeft',
	  'marginRight',
	  'marginTop',
	  'marginBottom',
	  'borderLeftWidth',
	  'borderRightWidth',
	  'borderTopWidth',
	  'borderBottomWidth'
	];

	function getZeroSize() {
	  var size = {
	    width: 0,
	    height: 0,
	    innerWidth: 0,
	    innerHeight: 0,
	    outerWidth: 0,
	    outerHeight: 0
	  };
	  for ( var i=0, len = measurements.length; i < len; i++ ) {
	    var measurement = measurements[i];
	    size[ measurement ] = 0;
	  }
	  return size;
	}



	function defineGetSize( getStyleProperty ) {

	// -------------------------- setup -------------------------- //

	var isSetup = false;

	var getStyle, boxSizingProp, isBoxSizeOuter;

	/**
	 * setup vars and functions
	 * do it on initial getSize(), rather than on script load
	 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
	 */
	function setup() {
	  // setup once
	  if ( isSetup ) {
	    return;
	  }
	  isSetup = true;

	  var getComputedStyle = window.getComputedStyle;
	  getStyle = ( function() {
	    var getStyleFn = getComputedStyle ?
	      function( elem ) {
	        return getComputedStyle( elem, null );
	      } :
	      function( elem ) {
	        return elem.currentStyle;
	      };

	      return function getStyle( elem ) {
	        var style = getStyleFn( elem );
	        if ( !style ) {
	          logError( 'Style returned ' + style +
	            '. Are you running this code in a hidden iframe on Firefox? ' +
	            'See http://bit.ly/getsizebug1' );
	        }
	        return style;
	      };
	  })();

	  // -------------------------- box sizing -------------------------- //

	  boxSizingProp = getStyleProperty('boxSizing');

	  /**
	   * WebKit measures the outer-width on style.width on border-box elems
	   * IE & Firefox measures the inner-width
	   */
	  if ( boxSizingProp ) {
	    var div = document.createElement('div');
	    div.style.width = '200px';
	    div.style.padding = '1px 2px 3px 4px';
	    div.style.borderStyle = 'solid';
	    div.style.borderWidth = '1px 2px 3px 4px';
	    div.style[ boxSizingProp ] = 'border-box';

	    var body = document.body || document.documentElement;
	    body.appendChild( div );
	    var style = getStyle( div );

	    isBoxSizeOuter = getStyleSize( style.width ) === 200;
	    body.removeChild( div );
	  }

	}

	// -------------------------- getSize -------------------------- //

	function getSize( elem ) {
	  setup();

	  // use querySeletor if elem is string
	  if ( typeof elem === 'string' ) {
	    elem = document.querySelector( elem );
	  }

	  // do not proceed on non-objects
	  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
	    return;
	  }

	  var style = getStyle( elem );

	  // if hidden, everything is 0
	  if ( style.display === 'none' ) {
	    return getZeroSize();
	  }

	  var size = {};
	  size.width = elem.offsetWidth;
	  size.height = elem.offsetHeight;

	  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
	    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

	  // get all measurements
	  for ( var i=0, len = measurements.length; i < len; i++ ) {
	    var measurement = measurements[i];
	    var value = style[ measurement ];
	    value = mungeNonPixel( elem, value );
	    var num = parseFloat( value );
	    // any 'auto', 'medium' value will be 0
	    size[ measurement ] = !isNaN( num ) ? num : 0;
	  }

	  var paddingWidth = size.paddingLeft + size.paddingRight;
	  var paddingHeight = size.paddingTop + size.paddingBottom;
	  var marginWidth = size.marginLeft + size.marginRight;
	  var marginHeight = size.marginTop + size.marginBottom;
	  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
	  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

	  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

	  // overwrite width and height if we can get it from style
	  var styleWidth = getStyleSize( style.width );
	  if ( styleWidth !== false ) {
	    size.width = styleWidth +
	      // add padding and border unless it's already including it
	      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
	  }

	  var styleHeight = getStyleSize( style.height );
	  if ( styleHeight !== false ) {
	    size.height = styleHeight +
	      // add padding and border unless it's already including it
	      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
	  }

	  size.innerWidth = size.width - ( paddingWidth + borderWidth );
	  size.innerHeight = size.height - ( paddingHeight + borderHeight );

	  size.outerWidth = size.width + marginWidth;
	  size.outerHeight = size.height + marginHeight;

	  return size;
	}

	// IE8 returns percent values, not pixels
	// taken from jQuery's curCSS
	function mungeNonPixel( elem, value ) {
	  // IE8 and has percent value
	  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
	    return value;
	  }
	  var style = elem.style;
	  // Remember the original values
	  var left = style.left;
	  var rs = elem.runtimeStyle;
	  var rsLeft = rs && rs.left;

	  // Put in the new values to get a computed value out
	  if ( rsLeft ) {
	    rs.left = elem.currentStyle.left;
	  }
	  style.left = value;
	  value = style.pixelLeft;

	  // Revert the changed values
	  style.left = left;
	  if ( rsLeft ) {
	    rs.left = rsLeft;
	  }

	  return value;
	}

	return getSize;

	}

	// transport
	if ( true ) {
	  // AMD for RequireJS
	  !(__WEBPACK_AMD_DEFINE_ARRAY__ = [ __WEBPACK_LOCAL_MODULE_3__ ], __WEBPACK_AMD_DEFINE_FACTORY__ = (defineGetSize), __WEBPACK_LOCAL_MODULE_4__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	} else if ( typeof exports === 'object' ) {
	  // CommonJS for Component
	  module.exports = defineGetSize( require('desandro-get-style-property') );
	} else {
	  // browser global
	  window.getSize = defineGetSize( window.getStyleProperty );
	}

	})( window );

	/*!
	 * docReady v1.0.4
	 * Cross browser DOMContentLoaded event emitter
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true*/
	/*global define: false, require: false, module: false */

	( function( window ) {



	var document = window.document;
	// collection of functions to be triggered on ready
	var queue = [];

	function docReady( fn ) {
	  // throw out non-functions
	  if ( typeof fn !== 'function' ) {
	    return;
	  }

	  if ( docReady.isReady ) {
	    // ready now, hit it
	    fn();
	  } else {
	    // queue function when ready
	    queue.push( fn );
	  }
	}

	docReady.isReady = false;

	// triggered on various doc ready events
	function onReady( event ) {
	  // bail if already triggered or IE8 document is not ready just yet
	  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
	  if ( docReady.isReady || isIE8NotReady ) {
	    return;
	  }

	  trigger();
	}

	function trigger() {
	  docReady.isReady = true;
	  // process queue
	  for ( var i=0, len = queue.length; i < len; i++ ) {
	    var fn = queue[i];
	    fn();
	  }
	}

	function defineDocReady( eventie ) {
	  // trigger ready if page is ready
	  if ( document.readyState === 'complete' ) {
	    trigger();
	  } else {
	    // listen for events
	    eventie.bind( document, 'DOMContentLoaded', onReady );
	    eventie.bind( document, 'readystatechange', onReady );
	    eventie.bind( window, 'load', onReady );
	  }

	  return docReady;
	}

	// transport
	if ( true ) {
	  // AMD
	  !(__WEBPACK_AMD_DEFINE_ARRAY__ = [ __WEBPACK_LOCAL_MODULE_1__ ], __WEBPACK_AMD_DEFINE_FACTORY__ = (defineDocReady), __WEBPACK_LOCAL_MODULE_5__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	} else if ( typeof exports === 'object' ) {
	  module.exports = defineDocReady( require('eventie') );
	} else {
	  // browser global
	  window.docReady = defineDocReady( window.eventie );
	}

	})( window );

	/**
	 * matchesSelector v1.0.3
	 * matchesSelector( element, '.selector' )
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true */
	/*global define: false, module: false */

	( function( ElemProto ) {

	  'use strict';

	  var matchesMethod = ( function() {
	    // check for the standard method name first
	    if ( ElemProto.matches ) {
	      return 'matches';
	    }
	    // check un-prefixed
	    if ( ElemProto.matchesSelector ) {
	      return 'matchesSelector';
	    }
	    // check vendor prefixes
	    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

	    for ( var i=0, len = prefixes.length; i < len; i++ ) {
	      var prefix = prefixes[i];
	      var method = prefix + 'MatchesSelector';
	      if ( ElemProto[ method ] ) {
	        return method;
	      }
	    }
	  })();

	  // ----- match ----- //

	  function match( elem, selector ) {
	    return elem[ matchesMethod ]( selector );
	  }

	  // ----- appendToFragment ----- //

	  function checkParent( elem ) {
	    // not needed if already has parent
	    if ( elem.parentNode ) {
	      return;
	    }
	    var fragment = document.createDocumentFragment();
	    fragment.appendChild( elem );
	  }

	  // ----- query ----- //

	  // fall back to using QSA
	  // thx @jonathantneal https://gist.github.com/3062955
	  function query( elem, selector ) {
	    // append to fragment if no parent
	    checkParent( elem );

	    // match elem with all selected elems of parent
	    var elems = elem.parentNode.querySelectorAll( selector );
	    for ( var i=0, len = elems.length; i < len; i++ ) {
	      // return true if match
	      if ( elems[i] === elem ) {
	        return true;
	      }
	    }
	    // otherwise return false
	    return false;
	  }

	  // ----- matchChild ----- //

	  function matchChild( elem, selector ) {
	    checkParent( elem );
	    return match( elem, selector );
	  }

	  // ----- matchesSelector ----- //

	  var matchesSelector;

	  if ( matchesMethod ) {
	    // IE9 supports matchesSelector, but doesn't work on orphaned elems
	    // check for that
	    var div = document.createElement('div');
	    var supportsOrphans = match( div, 'div' );
	    matchesSelector = supportsOrphans ? match : matchChild;
	  } else {
	    matchesSelector = query;
	  }

	  // transport
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_LOCAL_MODULE_6__ = (function() {
	      return matchesSelector;
	    }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	  } else if ( typeof exports === 'object' ) {
	    module.exports = matchesSelector;
	  }
	  else {
	    // browser global
	    window.matchesSelector = matchesSelector;
	  }

	})( Element.prototype );

	/**
	 * Fizzy UI utils v1.0.1
	 * MIT license
	 */

	/*jshint browser: true, undef: true, unused: true, strict: true */

	( function( window, factory ) {
	  /*global define: false, module: false, require: false */
	  'use strict';
	  // universal module definition

	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	      __WEBPACK_LOCAL_MODULE_5__,
	      __WEBPACK_LOCAL_MODULE_6__
	    ], __WEBPACK_LOCAL_MODULE_7__ = (function( docReady, matchesSelector ) {
	      return factory( window, docReady, matchesSelector );
	    }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      window,
	      require('doc-ready'),
	      require('desandro-matches-selector')
	    );
	  } else {
	    // browser global
	    window.fizzyUIUtils = factory(
	      window,
	      window.docReady,
	      window.matchesSelector
	    );
	  }

	}( window, function factory( window, docReady, matchesSelector ) {



	var utils = {};

	// ----- extend ----- //

	// extends objects
	utils.extend = function( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	};

	// ----- modulo ----- //

	utils.modulo = function( num, div ) {
	  return ( ( num % div ) + div ) % div;
	};

	// ----- isArray ----- //
	  
	var objToString = Object.prototype.toString;
	utils.isArray = function( obj ) {
	  return objToString.call( obj ) == '[object Array]';
	};

	// ----- makeArray ----- //

	// turn element or nodeList into an array
	utils.makeArray = function( obj ) {
	  var ary = [];
	  if ( utils.isArray( obj ) ) {
	    // use object if already an array
	    ary = obj;
	  } else if ( obj && typeof obj.length == 'number' ) {
	    // convert nodeList to array
	    for ( var i=0, len = obj.length; i < len; i++ ) {
	      ary.push( obj[i] );
	    }
	  } else {
	    // array of single index
	    ary.push( obj );
	  }
	  return ary;
	};

	// ----- indexOf ----- //

	// index of helper cause IE8
	utils.indexOf = Array.prototype.indexOf ? function( ary, obj ) {
	    return ary.indexOf( obj );
	  } : function( ary, obj ) {
	    for ( var i=0, len = ary.length; i < len; i++ ) {
	      if ( ary[i] === obj ) {
	        return i;
	      }
	    }
	    return -1;
	  };

	// ----- removeFrom ----- //

	utils.removeFrom = function( ary, obj ) {
	  var index = utils.indexOf( ary, obj );
	  if ( index != -1 ) {
	    ary.splice( index, 1 );
	  }
	};

	// ----- isElement ----- //

	// http://stackoverflow.com/a/384380/182183
	utils.isElement = ( typeof HTMLElement == 'function' || typeof HTMLElement == 'object' ) ?
	  function isElementDOM2( obj ) {
	    return obj instanceof HTMLElement;
	  } :
	  function isElementQuirky( obj ) {
	    return obj && typeof obj == 'object' &&
	      obj.nodeType == 1 && typeof obj.nodeName == 'string';
	  };

	// ----- setText ----- //

	utils.setText = ( function() {
	  var setTextProperty;
	  function setText( elem, text ) {
	    // only check setTextProperty once
	    setTextProperty = setTextProperty || ( document.documentElement.textContent !== undefined ? 'textContent' : 'innerText' );
	    elem[ setTextProperty ] = text;
	  }
	  return setText;
	})();

	// ----- getParent ----- //

	utils.getParent = function( elem, selector ) {
	  while ( elem != document.body ) {
	    elem = elem.parentNode;
	    if ( matchesSelector( elem, selector ) ) {
	      return elem;
	    }
	  }
	};

	// ----- getQueryElement ----- //

	// use element as selector string
	utils.getQueryElement = function( elem ) {
	  if ( typeof elem == 'string' ) {
	    return document.querySelector( elem );
	  }
	  return elem;
	};

	// ----- handleEvent ----- //

	// enable .ontype to trigger from .addEventListener( elem, 'type' )
	utils.handleEvent = function( event ) {
	  var method = 'on' + event.type;
	  if ( this[ method ] ) {
	    this[ method ]( event );
	  }
	};

	// ----- filterFindElements ----- //

	utils.filterFindElements = function( elems, selector ) {
	  // make array of elems
	  elems = utils.makeArray( elems );
	  var ffElems = [];

	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    // check that elem is an actual element
	    if ( !utils.isElement( elem ) ) {
	      continue;
	    }
	    // filter & find items if we have a selector
	    if ( selector ) {
	      // filter siblings
	      if ( matchesSelector( elem, selector ) ) {
	        ffElems.push( elem );
	      }
	      // find children
	      var childElems = elem.querySelectorAll( selector );
	      // concat childElems to filterFound array
	      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
	        ffElems.push( childElems[j] );
	      }
	    } else {
	      ffElems.push( elem );
	    }
	  }

	  return ffElems;
	};

	// ----- debounceMethod ----- //

	utils.debounceMethod = function( _class, methodName, threshold ) {
	  // original method
	  var method = _class.prototype[ methodName ];
	  var timeoutName = methodName + 'Timeout';

	  _class.prototype[ methodName ] = function() {
	    var timeout = this[ timeoutName ];
	    if ( timeout ) {
	      clearTimeout( timeout );
	    }
	    var args = arguments;

	    var _this = this;
	    this[ timeoutName ] = setTimeout( function() {
	      method.apply( _this, args );
	      delete _this[ timeoutName ];
	    }, threshold || 100 );
	  };
	};

	// ----- htmlInit ----- //

	// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
	utils.toDashed = function( str ) {
	  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
	    return $1 + '-' + $2;
	  }).toLowerCase();
	};

	var console = window.console;
	/**
	 * allow user to initialize classes via .js-namespace class
	 * htmlInit( Widget, 'widgetName' )
	 * options are parsed from data-namespace-option attribute
	 */
	utils.htmlInit = function( WidgetClass, namespace ) {
	  docReady( function() {
	    var dashedNamespace = utils.toDashed( namespace );
	    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
	    var dataAttr = 'data-' + dashedNamespace + '-options';

	    for ( var i=0, len = elems.length; i < len; i++ ) {
	      var elem = elems[i];
	      var attr = elem.getAttribute( dataAttr );
	      var options;
	      try {
	        options = attr && JSON.parse( attr );
	      } catch ( error ) {
	        // log error, do not initialize
	        if ( console ) {
	          console.error( 'Error parsing ' + dataAttr + ' on ' +
	            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
	            error );
	        }
	        continue;
	      }
	      // initialize
	      var instance = new WidgetClass( elem, options );
	      // make available via $().data('layoutname')
	      var jQuery = window.jQuery;
	      if ( jQuery ) {
	        jQuery.data( elem, namespace, instance );
	      }
	    }
	  });
	};

	// -----  ----- //

	return utils;

	}));

	/**
	 * Outlayer Item
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_2__,
	        __WEBPACK_LOCAL_MODULE_4__,
	        __WEBPACK_LOCAL_MODULE_3__,
	        __WEBPACK_LOCAL_MODULE_7__
	      ], __WEBPACK_LOCAL_MODULE_8__ = (function( EventEmitter, getSize, getStyleProperty, utils ) {
	        return factory( window, EventEmitter, getSize, getStyleProperty, utils );
	      }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	  } else if (typeof exports === 'object') {
	    // CommonJS
	    module.exports = factory(
	      window,
	      require('wolfy87-eventemitter'),
	      require('get-size'),
	      require('desandro-get-style-property'),
	      require('fizzy-ui-utils')
	    );
	  } else {
	    // browser global
	    window.Outlayer = {};
	    window.Outlayer.Item = factory(
	      window,
	      window.EventEmitter,
	      window.getSize,
	      window.getStyleProperty,
	      window.fizzyUIUtils
	    );
	  }

	}( window, function factory( window, EventEmitter, getSize, getStyleProperty, utils ) {
	'use strict';

	// ----- helpers ----- //

	var getComputedStyle = window.getComputedStyle;
	var getStyle = getComputedStyle ?
	  function( elem ) {
	    return getComputedStyle( elem, null );
	  } :
	  function( elem ) {
	    return elem.currentStyle;
	  };


	function isEmptyObj( obj ) {
	  for ( var prop in obj ) {
	    return false;
	  }
	  prop = null;
	  return true;
	}

	// -------------------------- CSS3 support -------------------------- //

	var transitionProperty = getStyleProperty('transition');
	var transformProperty = getStyleProperty('transform');
	var supportsCSS3 = transitionProperty && transformProperty;
	var is3d = !!getStyleProperty('perspective');

	var transitionEndEvent = {
	  WebkitTransition: 'webkitTransitionEnd',
	  MozTransition: 'transitionend',
	  OTransition: 'otransitionend',
	  transition: 'transitionend'
	}[ transitionProperty ];

	// properties that could have vendor prefix
	var prefixableProperties = [
	  'transform',
	  'transition',
	  'transitionDuration',
	  'transitionProperty'
	];

	// cache all vendor properties
	var vendorProperties = ( function() {
	  var cache = {};
	  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
	    var prop = prefixableProperties[i];
	    var supportedProp = getStyleProperty( prop );
	    if ( supportedProp && supportedProp !== prop ) {
	      cache[ prop ] = supportedProp;
	    }
	  }
	  return cache;
	})();

	// -------------------------- Item -------------------------- //

	function Item( element, layout ) {
	  if ( !element ) {
	    return;
	  }

	  this.element = element;
	  // parent layout class, i.e. Masonry, Isotope, or Packery
	  this.layout = layout;
	  this.position = {
	    x: 0,
	    y: 0
	  };

	  this._create();
	}

	// inherit EventEmitter
	utils.extend( Item.prototype, EventEmitter.prototype );

	Item.prototype._create = function() {
	  // transition objects
	  this._transn = {
	    ingProperties: {},
	    clean: {},
	    onEnd: {}
	  };

	  this.css({
	    position: 'absolute'
	  });
	};

	// trigger specified handler for event type
	Item.prototype.handleEvent = function( event ) {
	  var method = 'on' + event.type;
	  if ( this[ method ] ) {
	    this[ method ]( event );
	  }
	};

	Item.prototype.getSize = function() {
	  this.size = getSize( this.element );
	};

	/**
	 * apply CSS styles to element
	 * @param {Object} style
	 */
	Item.prototype.css = function( style ) {
	  var elemStyle = this.element.style;

	  for ( var prop in style ) {
	    // use vendor property if available
	    var supportedProp = vendorProperties[ prop ] || prop;
	    elemStyle[ supportedProp ] = style[ prop ];
	  }
	};

	 // measure position, and sets it
	Item.prototype.getPosition = function() {
	  var style = getStyle( this.element );
	  var layoutOptions = this.layout.options;
	  var isOriginLeft = layoutOptions.isOriginLeft;
	  var isOriginTop = layoutOptions.isOriginTop;
	  var xValue = style[ isOriginLeft ? 'left' : 'right' ];
	  var yValue = style[ isOriginTop ? 'top' : 'bottom' ];
	  // convert percent to pixels
	  var layoutSize = this.layout.size;
	  var x = xValue.indexOf('%') != -1 ?
	    ( parseFloat( xValue ) / 100 ) * layoutSize.width : parseInt( xValue, 10 );
	  var y = yValue.indexOf('%') != -1 ?
	    ( parseFloat( yValue ) / 100 ) * layoutSize.height : parseInt( yValue, 10 );

	  // clean up 'auto' or other non-integer values
	  x = isNaN( x ) ? 0 : x;
	  y = isNaN( y ) ? 0 : y;
	  // remove padding from measurement
	  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
	  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

	  this.position.x = x;
	  this.position.y = y;
	};

	// set settled position, apply padding
	Item.prototype.layoutPosition = function() {
	  var layoutSize = this.layout.size;
	  var layoutOptions = this.layout.options;
	  var style = {};

	  // x
	  var xPadding = layoutOptions.isOriginLeft ? 'paddingLeft' : 'paddingRight';
	  var xProperty = layoutOptions.isOriginLeft ? 'left' : 'right';
	  var xResetProperty = layoutOptions.isOriginLeft ? 'right' : 'left';

	  var x = this.position.x + layoutSize[ xPadding ];
	  // set in percentage or pixels
	  style[ xProperty ] = this.getXValue( x );
	  // reset other property
	  style[ xResetProperty ] = '';

	  // y
	  var yPadding = layoutOptions.isOriginTop ? 'paddingTop' : 'paddingBottom';
	  var yProperty = layoutOptions.isOriginTop ? 'top' : 'bottom';
	  var yResetProperty = layoutOptions.isOriginTop ? 'bottom' : 'top';

	  var y = this.position.y + layoutSize[ yPadding ];
	  // set in percentage or pixels
	  style[ yProperty ] = this.getYValue( y );
	  // reset other property
	  style[ yResetProperty ] = '';

	  this.css( style );
	  this.emitEvent( 'layout', [ this ] );
	};

	Item.prototype.getXValue = function( x ) {
	  var layoutOptions = this.layout.options;
	  return layoutOptions.percentPosition && !layoutOptions.isHorizontal ?
	    ( ( x / this.layout.size.width ) * 100 ) + '%' : x + 'px';
	};

	Item.prototype.getYValue = function( y ) {
	  var layoutOptions = this.layout.options;
	  return layoutOptions.percentPosition && layoutOptions.isHorizontal ?
	    ( ( y / this.layout.size.height ) * 100 ) + '%' : y + 'px';
	};


	Item.prototype._transitionTo = function( x, y ) {
	  this.getPosition();
	  // get current x & y from top/left
	  var curX = this.position.x;
	  var curY = this.position.y;

	  var compareX = parseInt( x, 10 );
	  var compareY = parseInt( y, 10 );
	  var didNotMove = compareX === this.position.x && compareY === this.position.y;

	  // save end position
	  this.setPosition( x, y );

	  // if did not move and not transitioning, just go to layout
	  if ( didNotMove && !this.isTransitioning ) {
	    this.layoutPosition();
	    return;
	  }

	  var transX = x - curX;
	  var transY = y - curY;
	  var transitionStyle = {};
	  transitionStyle.transform = this.getTranslate( transX, transY );

	  this.transition({
	    to: transitionStyle,
	    onTransitionEnd: {
	      transform: this.layoutPosition
	    },
	    isCleaning: true
	  });
	};

	Item.prototype.getTranslate = function( x, y ) {
	  // flip cooridinates if origin on right or bottom
	  var layoutOptions = this.layout.options;
	  x = layoutOptions.isOriginLeft ? x : -x;
	  y = layoutOptions.isOriginTop ? y : -y;

	  if ( is3d ) {
	    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
	  }

	  return 'translate(' + x + 'px, ' + y + 'px)';
	};

	// non transition + transform support
	Item.prototype.goTo = function( x, y ) {
	  this.setPosition( x, y );
	  this.layoutPosition();
	};

	// use transition and transforms if supported
	Item.prototype.moveTo = supportsCSS3 ?
	  Item.prototype._transitionTo : Item.prototype.goTo;

	Item.prototype.setPosition = function( x, y ) {
	  this.position.x = parseInt( x, 10 );
	  this.position.y = parseInt( y, 10 );
	};

	// ----- transition ----- //

	/**
	 * @param {Object} style - CSS
	 * @param {Function} onTransitionEnd
	 */

	// non transition, just trigger callback
	Item.prototype._nonTransition = function( args ) {
	  this.css( args.to );
	  if ( args.isCleaning ) {
	    this._removeStyles( args.to );
	  }
	  for ( var prop in args.onTransitionEnd ) {
	    args.onTransitionEnd[ prop ].call( this );
	  }
	};

	/**
	 * proper transition
	 * @param {Object} args - arguments
	 *   @param {Object} to - style to transition to
	 *   @param {Object} from - style to start transition from
	 *   @param {Boolean} isCleaning - removes transition styles after transition
	 *   @param {Function} onTransitionEnd - callback
	 */
	Item.prototype._transition = function( args ) {
	  // redirect to nonTransition if no transition duration
	  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
	    this._nonTransition( args );
	    return;
	  }

	  var _transition = this._transn;
	  // keep track of onTransitionEnd callback by css property
	  for ( var prop in args.onTransitionEnd ) {
	    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
	  }
	  // keep track of properties that are transitioning
	  for ( prop in args.to ) {
	    _transition.ingProperties[ prop ] = true;
	    // keep track of properties to clean up when transition is done
	    if ( args.isCleaning ) {
	      _transition.clean[ prop ] = true;
	    }
	  }

	  // set from styles
	  if ( args.from ) {
	    this.css( args.from );
	    // force redraw. http://blog.alexmaccaw.com/css-transitions
	    var h = this.element.offsetHeight;
	    // hack for JSHint to hush about unused var
	    h = null;
	  }
	  // enable transition
	  this.enableTransition( args.to );
	  // set styles that are transitioning
	  this.css( args.to );

	  this.isTransitioning = true;

	};

	// dash before all cap letters, including first for
	// WebkitTransform => -webkit-transform
	function toDashedAll( str ) {
	  return str.replace( /([A-Z])/g, function( $1 ) {
	    return '-' + $1.toLowerCase();
	  });
	}

	var transitionProps = 'opacity,' +
	  toDashedAll( vendorProperties.transform || 'transform' );

	Item.prototype.enableTransition = function(/* style */) {
	  // HACK changing transitionProperty during a transition
	  // will cause transition to jump
	  if ( this.isTransitioning ) {
	    return;
	  }

	  // make `transition: foo, bar, baz` from style object
	  // HACK un-comment this when enableTransition can work
	  // while a transition is happening
	  // var transitionValues = [];
	  // for ( var prop in style ) {
	  //   // dash-ify camelCased properties like WebkitTransition
	  //   prop = vendorProperties[ prop ] || prop;
	  //   transitionValues.push( toDashedAll( prop ) );
	  // }
	  // enable transition styles
	  this.css({
	    transitionProperty: transitionProps,
	    transitionDuration: this.layout.options.transitionDuration
	  });
	  // listen for transition end event
	  this.element.addEventListener( transitionEndEvent, this, false );
	};

	Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

	// ----- events ----- //

	Item.prototype.onwebkitTransitionEnd = function( event ) {
	  this.ontransitionend( event );
	};

	Item.prototype.onotransitionend = function( event ) {
	  this.ontransitionend( event );
	};

	// properties that I munge to make my life easier
	var dashedVendorProperties = {
	  '-webkit-transform': 'transform',
	  '-moz-transform': 'transform',
	  '-o-transform': 'transform'
	};

	Item.prototype.ontransitionend = function( event ) {
	  // disregard bubbled events from children
	  if ( event.target !== this.element ) {
	    return;
	  }
	  var _transition = this._transn;
	  // get property name of transitioned property, convert to prefix-free
	  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

	  // remove property that has completed transitioning
	  delete _transition.ingProperties[ propertyName ];
	  // check if any properties are still transitioning
	  if ( isEmptyObj( _transition.ingProperties ) ) {
	    // all properties have completed transitioning
	    this.disableTransition();
	  }
	  // clean style
	  if ( propertyName in _transition.clean ) {
	    // clean up style
	    this.element.style[ event.propertyName ] = '';
	    delete _transition.clean[ propertyName ];
	  }
	  // trigger onTransitionEnd callback
	  if ( propertyName in _transition.onEnd ) {
	    var onTransitionEnd = _transition.onEnd[ propertyName ];
	    onTransitionEnd.call( this );
	    delete _transition.onEnd[ propertyName ];
	  }

	  this.emitEvent( 'transitionEnd', [ this ] );
	};

	Item.prototype.disableTransition = function() {
	  this.removeTransitionStyles();
	  this.element.removeEventListener( transitionEndEvent, this, false );
	  this.isTransitioning = false;
	};

	/**
	 * removes style property from element
	 * @param {Object} style
	**/
	Item.prototype._removeStyles = function( style ) {
	  // clean up transition styles
	  var cleanStyle = {};
	  for ( var prop in style ) {
	    cleanStyle[ prop ] = '';
	  }
	  this.css( cleanStyle );
	};

	var cleanTransitionStyle = {
	  transitionProperty: '',
	  transitionDuration: ''
	};

	Item.prototype.removeTransitionStyles = function() {
	  // remove transition
	  this.css( cleanTransitionStyle );
	};

	// ----- show/hide/remove ----- //

	// remove element from DOM
	Item.prototype.removeElem = function() {
	  this.element.parentNode.removeChild( this.element );
	  // remove display: none
	  this.css({ display: '' });
	  this.emitEvent( 'remove', [ this ] );
	};

	Item.prototype.remove = function() {
	  // just remove element if no transition support or no transition
	  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
	    this.removeElem();
	    return;
	  }

	  // start transition
	  var _this = this;
	  this.once( 'transitionEnd', function() {
	    _this.removeElem();
	  });
	  this.hide();
	};

	Item.prototype.reveal = function() {
	  delete this.isHidden;
	  // remove display: none
	  this.css({ display: '' });

	  var options = this.layout.options;

	  var onTransitionEnd = {};
	  var transitionEndProperty = this.getHideRevealTransitionEndProperty('visibleStyle');
	  onTransitionEnd[ transitionEndProperty ] = this.onRevealTransitionEnd;

	  this.transition({
	    from: options.hiddenStyle,
	    to: options.visibleStyle,
	    isCleaning: true,
	    onTransitionEnd: onTransitionEnd
	  });
	};

	Item.prototype.onRevealTransitionEnd = function() {
	  // check if still visible
	  // during transition, item may have been hidden
	  if ( !this.isHidden ) {
	    this.emitEvent('reveal');
	  }
	};

	/**
	 * get style property use for hide/reveal transition end
	 * @param {String} styleProperty - hiddenStyle/visibleStyle
	 * @returns {String}
	 */
	Item.prototype.getHideRevealTransitionEndProperty = function( styleProperty ) {
	  var optionStyle = this.layout.options[ styleProperty ];
	  // use opacity
	  if ( optionStyle.opacity ) {
	    return 'opacity';
	  }
	  // get first property
	  for ( var prop in optionStyle ) {
	    return prop;
	  }
	};

	Item.prototype.hide = function() {
	  // set flag
	  this.isHidden = true;
	  // remove display: none
	  this.css({ display: '' });

	  var options = this.layout.options;

	  var onTransitionEnd = {};
	  var transitionEndProperty = this.getHideRevealTransitionEndProperty('hiddenStyle');
	  onTransitionEnd[ transitionEndProperty ] = this.onHideTransitionEnd;

	  this.transition({
	    from: options.visibleStyle,
	    to: options.hiddenStyle,
	    // keep hidden stuff hidden
	    isCleaning: true,
	    onTransitionEnd: onTransitionEnd
	  });
	};

	Item.prototype.onHideTransitionEnd = function() {
	  // check if still hidden
	  // during transition, item may have been un-hidden
	  if ( this.isHidden ) {
	    this.css({ display: 'none' });
	    this.emitEvent('hide');
	  }
	};

	Item.prototype.destroy = function() {
	  this.css({
	    position: '',
	    left: '',
	    right: '',
	    top: '',
	    bottom: '',
	    transition: '',
	    transform: ''
	  });
	};

	return Item;

	}));

	/*!
	 * Outlayer v1.4.2
	 * the brains and guts of a layout library
	 * MIT license
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition

	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_1__,
	        __WEBPACK_LOCAL_MODULE_2__,
	        __WEBPACK_LOCAL_MODULE_4__,
	        __WEBPACK_LOCAL_MODULE_7__,
	        __WEBPACK_LOCAL_MODULE_8__
	      ], __WEBPACK_LOCAL_MODULE_9__ = (function( eventie, EventEmitter, getSize, utils, Item ) {
	        return factory( window, eventie, EventEmitter, getSize, utils, Item);
	      }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      window,
	      require('eventie'),
	      require('wolfy87-eventemitter'),
	      require('get-size'),
	      require('fizzy-ui-utils'),
	      require('./item')
	    );
	  } else {
	    // browser global
	    window.Outlayer = factory(
	      window,
	      window.eventie,
	      window.EventEmitter,
	      window.getSize,
	      window.fizzyUIUtils,
	      window.Outlayer.Item
	    );
	  }

	}( window, function factory( window, eventie, EventEmitter, getSize, utils, Item ) {
	'use strict';

	// ----- vars ----- //

	var console = window.console;
	var jQuery = window.jQuery;
	var noop = function() {};

	// -------------------------- Outlayer -------------------------- //

	// globally unique identifiers
	var GUID = 0;
	// internal store of all Outlayer intances
	var instances = {};


	/**
	 * @param {Element, String} element
	 * @param {Object} options
	 * @constructor
	 */
	function Outlayer( element, options ) {
	  var queryElement = utils.getQueryElement( element );
	  if ( !queryElement ) {
	    if ( console ) {
	      console.error( 'Bad element for ' + this.constructor.namespace +
	        ': ' + ( queryElement || element ) );
	    }
	    return;
	  }
	  this.element = queryElement;
	  // add jQuery
	  if ( jQuery ) {
	    this.$element = jQuery( this.element );
	  }

	  // options
	  this.options = utils.extend( {}, this.constructor.defaults );
	  this.option( options );

	  // add id for Outlayer.getFromElement
	  var id = ++GUID;
	  this.element.outlayerGUID = id; // expando
	  instances[ id ] = this; // associate via id

	  // kick it off
	  this._create();

	  if ( this.options.isInitLayout ) {
	    this.layout();
	  }
	}

	// settings are for internal use only
	Outlayer.namespace = 'outlayer';
	Outlayer.Item = Item;

	// default options
	Outlayer.defaults = {
	  containerStyle: {
	    position: 'relative'
	  },
	  isInitLayout: true,
	  isOriginLeft: true,
	  isOriginTop: true,
	  isResizeBound: true,
	  isResizingContainer: true,
	  // item options
	  transitionDuration: '0.4s',
	  hiddenStyle: {
	    opacity: 0,
	    transform: 'scale(0.001)'
	  },
	  visibleStyle: {
	    opacity: 1,
	    transform: 'scale(1)'
	  }
	};

	// inherit EventEmitter
	utils.extend( Outlayer.prototype, EventEmitter.prototype );

	/**
	 * set options
	 * @param {Object} opts
	 */
	Outlayer.prototype.option = function( opts ) {
	  utils.extend( this.options, opts );
	};

	Outlayer.prototype._create = function() {
	  // get items from children
	  this.reloadItems();
	  // elements that affect layout, but are not laid out
	  this.stamps = [];
	  this.stamp( this.options.stamp );
	  // set container style
	  utils.extend( this.element.style, this.options.containerStyle );

	  // bind resize method
	  if ( this.options.isResizeBound ) {
	    this.bindResize();
	  }
	};

	// goes through all children again and gets bricks in proper order
	Outlayer.prototype.reloadItems = function() {
	  // collection of item elements
	  this.items = this._itemize( this.element.children );
	};


	/**
	 * turn elements into Outlayer.Items to be used in layout
	 * @param {Array or NodeList or HTMLElement} elems
	 * @returns {Array} items - collection of new Outlayer Items
	 */
	Outlayer.prototype._itemize = function( elems ) {

	  var itemElems = this._filterFindItemElements( elems );
	  var Item = this.constructor.Item;

	  // create new Outlayer Items for collection
	  var items = [];
	  for ( var i=0, len = itemElems.length; i < len; i++ ) {
	    var elem = itemElems[i];
	    var item = new Item( elem, this );
	    items.push( item );
	  }

	  return items;
	};

	/**
	 * get item elements to be used in layout
	 * @param {Array or NodeList or HTMLElement} elems
	 * @returns {Array} items - item elements
	 */
	Outlayer.prototype._filterFindItemElements = function( elems ) {
	  return utils.filterFindElements( elems, this.options.itemSelector );
	};

	/**
	 * getter method for getting item elements
	 * @returns {Array} elems - collection of item elements
	 */
	Outlayer.prototype.getItemElements = function() {
	  var elems = [];
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    elems.push( this.items[i].element );
	  }
	  return elems;
	};

	// ----- init & layout ----- //

	/**
	 * lays out all items
	 */
	Outlayer.prototype.layout = function() {
	  this._resetLayout();
	  this._manageStamps();

	  // don't animate first layout
	  var isInstant = this.options.isLayoutInstant !== undefined ?
	    this.options.isLayoutInstant : !this._isLayoutInited;
	  this.layoutItems( this.items, isInstant );

	  // flag for initalized
	  this._isLayoutInited = true;
	};

	// _init is alias for layout
	Outlayer.prototype._init = Outlayer.prototype.layout;

	/**
	 * logic before any new layout
	 */
	Outlayer.prototype._resetLayout = function() {
	  this.getSize();
	};


	Outlayer.prototype.getSize = function() {
	  this.size = getSize( this.element );
	};

	/**
	 * get measurement from option, for columnWidth, rowHeight, gutter
	 * if option is String -> get element from selector string, & get size of element
	 * if option is Element -> get size of element
	 * else use option as a number
	 *
	 * @param {String} measurement
	 * @param {String} size - width or height
	 * @private
	 */
	Outlayer.prototype._getMeasurement = function( measurement, size ) {
	  var option = this.options[ measurement ];
	  var elem;
	  if ( !option ) {
	    // default to 0
	    this[ measurement ] = 0;
	  } else {
	    // use option as an element
	    if ( typeof option === 'string' ) {
	      elem = this.element.querySelector( option );
	    } else if ( utils.isElement( option ) ) {
	      elem = option;
	    }
	    // use size of element, if element
	    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
	  }
	};

	/**
	 * layout a collection of item elements
	 * @api public
	 */
	Outlayer.prototype.layoutItems = function( items, isInstant ) {
	  items = this._getItemsForLayout( items );

	  this._layoutItems( items, isInstant );

	  this._postLayout();
	};

	/**
	 * get the items to be laid out
	 * you may want to skip over some items
	 * @param {Array} items
	 * @returns {Array} items
	 */
	Outlayer.prototype._getItemsForLayout = function( items ) {
	  var layoutItems = [];
	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    if ( !item.isIgnored ) {
	      layoutItems.push( item );
	    }
	  }
	  return layoutItems;
	};

	/**
	 * layout items
	 * @param {Array} items
	 * @param {Boolean} isInstant
	 */
	Outlayer.prototype._layoutItems = function( items, isInstant ) {
	  this._emitCompleteOnItems( 'layout', items );

	  if ( !items || !items.length ) {
	    // no items, emit event with empty array
	    return;
	  }

	  var queue = [];

	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    // get x/y object from method
	    var position = this._getItemLayoutPosition( item );
	    // enqueue
	    position.item = item;
	    position.isInstant = isInstant || item.isLayoutInstant;
	    queue.push( position );
	  }

	  this._processLayoutQueue( queue );
	};

	/**
	 * get item layout position
	 * @param {Outlayer.Item} item
	 * @returns {Object} x and y position
	 */
	Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
	  return {
	    x: 0,
	    y: 0
	  };
	};

	/**
	 * iterate over array and position each item
	 * Reason being - separating this logic prevents 'layout invalidation'
	 * thx @paul_irish
	 * @param {Array} queue
	 */
	Outlayer.prototype._processLayoutQueue = function( queue ) {
	  for ( var i=0, len = queue.length; i < len; i++ ) {
	    var obj = queue[i];
	    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
	  }
	};

	/**
	 * Sets position of item in DOM
	 * @param {Outlayer.Item} item
	 * @param {Number} x - horizontal position
	 * @param {Number} y - vertical position
	 * @param {Boolean} isInstant - disables transitions
	 */
	Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
	  if ( isInstant ) {
	    // if not transition, just set CSS
	    item.goTo( x, y );
	  } else {
	    item.moveTo( x, y );
	  }
	};

	/**
	 * Any logic you want to do after each layout,
	 * i.e. size the container
	 */
	Outlayer.prototype._postLayout = function() {
	  this.resizeContainer();
	};

	Outlayer.prototype.resizeContainer = function() {
	  if ( !this.options.isResizingContainer ) {
	    return;
	  }
	  var size = this._getContainerSize();
	  if ( size ) {
	    this._setContainerMeasure( size.width, true );
	    this._setContainerMeasure( size.height, false );
	  }
	};

	/**
	 * Sets width or height of container if returned
	 * @returns {Object} size
	 *   @param {Number} width
	 *   @param {Number} height
	 */
	Outlayer.prototype._getContainerSize = noop;

	/**
	 * @param {Number} measure - size of width or height
	 * @param {Boolean} isWidth
	 */
	Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
	  if ( measure === undefined ) {
	    return;
	  }

	  var elemSize = this.size;
	  // add padding and border width if border box
	  if ( elemSize.isBorderBox ) {
	    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
	      elemSize.borderLeftWidth + elemSize.borderRightWidth :
	      elemSize.paddingBottom + elemSize.paddingTop +
	      elemSize.borderTopWidth + elemSize.borderBottomWidth;
	  }

	  measure = Math.max( measure, 0 );
	  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
	};

	/**
	 * emit eventComplete on a collection of items events
	 * @param {String} eventName
	 * @param {Array} items - Outlayer.Items
	 */
	Outlayer.prototype._emitCompleteOnItems = function( eventName, items ) {
	  var _this = this;
	  function onComplete() {
	    _this.dispatchEvent( eventName + 'Complete', null, [ items ] );
	  }

	  var count = items.length;
	  if ( !items || !count ) {
	    onComplete();
	    return;
	  }

	  var doneCount = 0;
	  function tick() {
	    doneCount++;
	    if ( doneCount === count ) {
	      onComplete();
	    }
	  }

	  // bind callback
	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    item.once( eventName, tick );
	  }
	};

	/**
	 * emits events via eventEmitter and jQuery events
	 * @param {String} type - name of event
	 * @param {Event} event - original event
	 * @param {Array} args - extra arguments
	 */
	Outlayer.prototype.dispatchEvent = function( type, event, args ) {
	  // add original event to arguments
	  var emitArgs = event ? [ event ].concat( args ) : args;
	  this.emitEvent( type, emitArgs );

	  if ( jQuery ) {
	    // set this.$element
	    this.$element = this.$element || jQuery( this.element );
	    if ( event ) {
	      // create jQuery event
	      var $event = jQuery.Event( event );
	      $event.type = type;
	      this.$element.trigger( $event, args );
	    } else {
	      // just trigger with type if no event available
	      this.$element.trigger( type, args );
	    }
	  }
	};

	// -------------------------- ignore & stamps -------------------------- //


	/**
	 * keep item in collection, but do not lay it out
	 * ignored items do not get skipped in layout
	 * @param {Element} elem
	 */
	Outlayer.prototype.ignore = function( elem ) {
	  var item = this.getItem( elem );
	  if ( item ) {
	    item.isIgnored = true;
	  }
	};

	/**
	 * return item to layout collection
	 * @param {Element} elem
	 */
	Outlayer.prototype.unignore = function( elem ) {
	  var item = this.getItem( elem );
	  if ( item ) {
	    delete item.isIgnored;
	  }
	};

	/**
	 * adds elements to stamps
	 * @param {NodeList, Array, Element, or String} elems
	 */
	Outlayer.prototype.stamp = function( elems ) {
	  elems = this._find( elems );
	  if ( !elems ) {
	    return;
	  }

	  this.stamps = this.stamps.concat( elems );
	  // ignore
	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    this.ignore( elem );
	  }
	};

	/**
	 * removes elements to stamps
	 * @param {NodeList, Array, or Element} elems
	 */
	Outlayer.prototype.unstamp = function( elems ) {
	  elems = this._find( elems );
	  if ( !elems ){
	    return;
	  }

	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    // filter out removed stamp elements
	    utils.removeFrom( this.stamps, elem );
	    this.unignore( elem );
	  }

	};

	/**
	 * finds child elements
	 * @param {NodeList, Array, Element, or String} elems
	 * @returns {Array} elems
	 */
	Outlayer.prototype._find = function( elems ) {
	  if ( !elems ) {
	    return;
	  }
	  // if string, use argument as selector string
	  if ( typeof elems === 'string' ) {
	    elems = this.element.querySelectorAll( elems );
	  }
	  elems = utils.makeArray( elems );
	  return elems;
	};

	Outlayer.prototype._manageStamps = function() {
	  if ( !this.stamps || !this.stamps.length ) {
	    return;
	  }

	  this._getBoundingRect();

	  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
	    var stamp = this.stamps[i];
	    this._manageStamp( stamp );
	  }
	};

	// update boundingLeft / Top
	Outlayer.prototype._getBoundingRect = function() {
	  // get bounding rect for container element
	  var boundingRect = this.element.getBoundingClientRect();
	  var size = this.size;
	  this._boundingRect = {
	    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
	    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
	    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
	    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
	  };
	};

	/**
	 * @param {Element} stamp
	**/
	Outlayer.prototype._manageStamp = noop;

	/**
	 * get x/y position of element relative to container element
	 * @param {Element} elem
	 * @returns {Object} offset - has left, top, right, bottom
	 */
	Outlayer.prototype._getElementOffset = function( elem ) {
	  var boundingRect = elem.getBoundingClientRect();
	  var thisRect = this._boundingRect;
	  var size = getSize( elem );
	  var offset = {
	    left: boundingRect.left - thisRect.left - size.marginLeft,
	    top: boundingRect.top - thisRect.top - size.marginTop,
	    right: thisRect.right - boundingRect.right - size.marginRight,
	    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
	  };
	  return offset;
	};

	// -------------------------- resize -------------------------- //

	// enable event handlers for listeners
	// i.e. resize -> onresize
	Outlayer.prototype.handleEvent = function( event ) {
	  var method = 'on' + event.type;
	  if ( this[ method ] ) {
	    this[ method ]( event );
	  }
	};

	/**
	 * Bind layout to window resizing
	 */
	Outlayer.prototype.bindResize = function() {
	  // bind just one listener
	  if ( this.isResizeBound ) {
	    return;
	  }
	  eventie.bind( window, 'resize', this );
	  this.isResizeBound = true;
	};

	/**
	 * Unbind layout to window resizing
	 */
	Outlayer.prototype.unbindResize = function() {
	  if ( this.isResizeBound ) {
	    eventie.unbind( window, 'resize', this );
	  }
	  this.isResizeBound = false;
	};

	// original debounce by John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

	// this fires every resize
	Outlayer.prototype.onresize = function() {
	  if ( this.resizeTimeout ) {
	    clearTimeout( this.resizeTimeout );
	  }

	  var _this = this;
	  function delayed() {
	    _this.resize();
	    delete _this.resizeTimeout;
	  }

	  this.resizeTimeout = setTimeout( delayed, 100 );
	};

	// debounced, layout on resize
	Outlayer.prototype.resize = function() {
	  // don't trigger if size did not change
	  // or if resize was unbound. See #9
	  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
	    return;
	  }

	  this.layout();
	};

	/**
	 * check if layout is needed post layout
	 * @returns Boolean
	 */
	Outlayer.prototype.needsResizeLayout = function() {
	  var size = getSize( this.element );
	  // check that this.size and size are there
	  // IE8 triggers resize on body size change, so they might not be
	  var hasSizes = this.size && size;
	  return hasSizes && size.innerWidth !== this.size.innerWidth;
	};

	// -------------------------- methods -------------------------- //

	/**
	 * add items to Outlayer instance
	 * @param {Array or NodeList or Element} elems
	 * @returns {Array} items - Outlayer.Items
	**/
	Outlayer.prototype.addItems = function( elems ) {
	  var items = this._itemize( elems );
	  // add items to collection
	  if ( items.length ) {
	    this.items = this.items.concat( items );
	  }
	  return items;
	};

	/**
	 * Layout newly-appended item elements
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.appended = function( elems ) {
	  var items = this.addItems( elems );
	  if ( !items.length ) {
	    return;
	  }
	  // layout and reveal just the new items
	  this.layoutItems( items, true );
	  this.reveal( items );
	};

	/**
	 * Layout prepended elements
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.prepended = function( elems ) {
	  var items = this._itemize( elems );
	  if ( !items.length ) {
	    return;
	  }
	  // add items to beginning of collection
	  var previousItems = this.items.slice(0);
	  this.items = items.concat( previousItems );
	  // start new layout
	  this._resetLayout();
	  this._manageStamps();
	  // layout new stuff without transition
	  this.layoutItems( items, true );
	  this.reveal( items );
	  // layout previous items
	  this.layoutItems( previousItems );
	};

	/**
	 * reveal a collection of items
	 * @param {Array of Outlayer.Items} items
	 */
	Outlayer.prototype.reveal = function( items ) {
	  this._emitCompleteOnItems( 'reveal', items );

	  var len = items && items.length;
	  for ( var i=0; len && i < len; i++ ) {
	    var item = items[i];
	    item.reveal();
	  }
	};

	/**
	 * hide a collection of items
	 * @param {Array of Outlayer.Items} items
	 */
	Outlayer.prototype.hide = function( items ) {
	  this._emitCompleteOnItems( 'hide', items );

	  var len = items && items.length;
	  for ( var i=0; len && i < len; i++ ) {
	    var item = items[i];
	    item.hide();
	  }
	};

	/**
	 * reveal item elements
	 * @param {Array}, {Element}, {NodeList} items
	 */
	Outlayer.prototype.revealItemElements = function( elems ) {
	  var items = this.getItems( elems );
	  this.reveal( items );
	};

	/**
	 * hide item elements
	 * @param {Array}, {Element}, {NodeList} items
	 */
	Outlayer.prototype.hideItemElements = function( elems ) {
	  var items = this.getItems( elems );
	  this.hide( items );
	};

	/**
	 * get Outlayer.Item, given an Element
	 * @param {Element} elem
	 * @param {Function} callback
	 * @returns {Outlayer.Item} item
	 */
	Outlayer.prototype.getItem = function( elem ) {
	  // loop through items to get the one that matches
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    var item = this.items[i];
	    if ( item.element === elem ) {
	      // return item
	      return item;
	    }
	  }
	};

	/**
	 * get collection of Outlayer.Items, given Elements
	 * @param {Array} elems
	 * @returns {Array} items - Outlayer.Items
	 */
	Outlayer.prototype.getItems = function( elems ) {
	  elems = utils.makeArray( elems );
	  var items = [];
	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    var item = this.getItem( elem );
	    if ( item ) {
	      items.push( item );
	    }
	  }

	  return items;
	};

	/**
	 * remove element(s) from instance and DOM
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.remove = function( elems ) {
	  var removeItems = this.getItems( elems );

	  this._emitCompleteOnItems( 'remove', removeItems );

	  // bail if no items to remove
	  if ( !removeItems || !removeItems.length ) {
	    return;
	  }

	  for ( var i=0, len = removeItems.length; i < len; i++ ) {
	    var item = removeItems[i];
	    item.remove();
	    // remove item from collection
	    utils.removeFrom( this.items, item );
	  }
	};

	// ----- destroy ----- //

	// remove and disable Outlayer instance
	Outlayer.prototype.destroy = function() {
	  // clean up dynamic styles
	  var style = this.element.style;
	  style.height = '';
	  style.position = '';
	  style.width = '';
	  // destroy items
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    var item = this.items[i];
	    item.destroy();
	  }

	  this.unbindResize();

	  var id = this.element.outlayerGUID;
	  delete instances[ id ]; // remove reference to instance by id
	  delete this.element.outlayerGUID;
	  // remove data for jQuery
	  if ( jQuery ) {
	    jQuery.removeData( this.element, this.constructor.namespace );
	  }

	};

	// -------------------------- data -------------------------- //

	/**
	 * get Outlayer instance from element
	 * @param {Element} elem
	 * @returns {Outlayer}
	 */
	Outlayer.data = function( elem ) {
	  elem = utils.getQueryElement( elem );
	  var id = elem && elem.outlayerGUID;
	  return id && instances[ id ];
	};


	// -------------------------- create Outlayer class -------------------------- //

	/**
	 * create a layout class
	 * @param {String} namespace
	 */
	Outlayer.create = function( namespace, options ) {
	  // sub-class Outlayer
	  function Layout() {
	    Outlayer.apply( this, arguments );
	  }
	  // inherit Outlayer prototype, use Object.create if there
	  if ( Object.create ) {
	    Layout.prototype = Object.create( Outlayer.prototype );
	  } else {
	    utils.extend( Layout.prototype, Outlayer.prototype );
	  }
	  // set contructor, used for namespace and Item
	  Layout.prototype.constructor = Layout;

	  Layout.defaults = utils.extend( {}, Outlayer.defaults );
	  // apply new options
	  utils.extend( Layout.defaults, options );
	  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
	  Layout.prototype.settings = {};

	  Layout.namespace = namespace;

	  Layout.data = Outlayer.data;

	  // sub-class Item
	  Layout.Item = function LayoutItem() {
	    Item.apply( this, arguments );
	  };

	  Layout.Item.prototype = new Item();

	  // -------------------------- declarative -------------------------- //

	  utils.htmlInit( Layout, namespace );

	  // -------------------------- jQuery bridge -------------------------- //

	  // make into jQuery plugin
	  if ( jQuery && jQuery.bridget ) {
	    jQuery.bridget( namespace, Layout );
	  }

	  return Layout;
	};

	// ----- fin ----- //

	// back in global
	Outlayer.Item = Item;

	return Outlayer;

	}));


	/**
	 * Isotope Item
	**/

	( function( window, factory ) {
	'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_9__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_10__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('outlayer')
	    );
	  } else {
	    // browser global
	    window.Isotope = window.Isotope || {};
	    window.Isotope.Item = factory(
	      window.Outlayer
	    );
	  }

	}( window, function factory( Outlayer ) {
	'use strict';

	// -------------------------- Item -------------------------- //

	// sub-class Outlayer Item
	function Item() {
	  Outlayer.Item.apply( this, arguments );
	}

	Item.prototype = new Outlayer.Item();

	Item.prototype._create = function() {
	  // assign id, used for original-order sorting
	  this.id = this.layout.itemGUID++;
	  Outlayer.Item.prototype._create.call( this );
	  this.sortData = {};
	};

	Item.prototype.updateSortData = function() {
	  if ( this.isIgnored ) {
	    return;
	  }
	  // default sorters
	  this.sortData.id = this.id;
	  // for backward compatibility
	  this.sortData['original-order'] = this.id;
	  this.sortData.random = Math.random();
	  // go thru getSortData obj and apply the sorters
	  var getSortData = this.layout.options.getSortData;
	  var sorters = this.layout._sorters;
	  for ( var key in getSortData ) {
	    var sorter = sorters[ key ];
	    this.sortData[ key ] = sorter( this.element, this );
	  }
	};

	var _destroy = Item.prototype.destroy;
	Item.prototype.destroy = function() {
	  // call super
	  _destroy.apply( this, arguments );
	  // reset display, #741
	  this.css({
	    display: ''
	  });
	};

	return Item;

	}));

	/**
	 * Isotope LayoutMode
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition

	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_4__,
	        __WEBPACK_LOCAL_MODULE_9__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_11__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('get-size'),
	      require('outlayer')
	    );
	  } else {
	    // browser global
	    window.Isotope = window.Isotope || {};
	    window.Isotope.LayoutMode = factory(
	      window.getSize,
	      window.Outlayer
	    );
	  }

	}( window, function factory( getSize, Outlayer ) {
	  'use strict';

	  // layout mode class
	  function LayoutMode( isotope ) {
	    this.isotope = isotope;
	    // link properties
	    if ( isotope ) {
	      this.options = isotope.options[ this.namespace ];
	      this.element = isotope.element;
	      this.items = isotope.filteredItems;
	      this.size = isotope.size;
	    }
	  }

	  /**
	   * some methods should just defer to default Outlayer method
	   * and reference the Isotope instance as `this`
	  **/
	  ( function() {
	    var facadeMethods = [
	      '_resetLayout',
	      '_getItemLayoutPosition',
	      '_manageStamp',
	      '_getContainerSize',
	      '_getElementOffset',
	      'needsResizeLayout'
	    ];

	    for ( var i=0, len = facadeMethods.length; i < len; i++ ) {
	      var methodName = facadeMethods[i];
	      LayoutMode.prototype[ methodName ] = getOutlayerMethod( methodName );
	    }

	    function getOutlayerMethod( methodName ) {
	      return function() {
	        return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
	      };
	    }
	  })();

	  // -----  ----- //

	  // for horizontal layout modes, check vertical size
	  LayoutMode.prototype.needsVerticalResizeLayout = function() {
	    // don't trigger if size did not change
	    var size = getSize( this.isotope.element );
	    // check that this.size and size are there
	    // IE8 triggers resize on body size change, so they might not be
	    var hasSizes = this.isotope.size && size;
	    return hasSizes && size.innerHeight != this.isotope.size.innerHeight;
	  };

	  // ----- measurements ----- //

	  LayoutMode.prototype._getMeasurement = function() {
	    this.isotope._getMeasurement.apply( this, arguments );
	  };

	  LayoutMode.prototype.getColumnWidth = function() {
	    this.getSegmentSize( 'column', 'Width' );
	  };

	  LayoutMode.prototype.getRowHeight = function() {
	    this.getSegmentSize( 'row', 'Height' );
	  };

	  /**
	   * get columnWidth or rowHeight
	   * segment: 'column' or 'row'
	   * size 'Width' or 'Height'
	  **/
	  LayoutMode.prototype.getSegmentSize = function( segment, size ) {
	    var segmentName = segment + size;
	    var outerSize = 'outer' + size;
	    // columnWidth / outerWidth // rowHeight / outerHeight
	    this._getMeasurement( segmentName, outerSize );
	    // got rowHeight or columnWidth, we can chill
	    if ( this[ segmentName ] ) {
	      return;
	    }
	    // fall back to item of first element
	    var firstItemSize = this.getFirstItemSize();
	    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
	      // or size of container
	      this.isotope.size[ 'inner' + size ];
	  };

	  LayoutMode.prototype.getFirstItemSize = function() {
	    var firstItem = this.isotope.filteredItems[0];
	    return firstItem && firstItem.element && getSize( firstItem.element );
	  };

	  // ----- methods that should reference isotope ----- //

	  LayoutMode.prototype.layout = function() {
	    this.isotope.layout.apply( this.isotope, arguments );
	  };

	  LayoutMode.prototype.getSize = function() {
	    this.isotope.getSize();
	    this.size = this.isotope.size;
	  };

	  // -------------------------- create -------------------------- //

	  LayoutMode.modes = {};

	  LayoutMode.create = function( namespace, options ) {

	    function Mode() {
	      LayoutMode.apply( this, arguments );
	    }

	    Mode.prototype = new LayoutMode();

	    // default options
	    if ( options ) {
	      Mode.options = options;
	    }

	    Mode.prototype.namespace = namespace;
	    // register in Isotope
	    LayoutMode.modes[ namespace ] = Mode;

	    return Mode;
	  };

	  return LayoutMode;

	}));

	/*!
	 * Masonry v3.3.1
	 * Cascading grid layout library
	 * http://masonry.desandro.com
	 * MIT License
	 * by David DeSandro
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_9__,
	        __WEBPACK_LOCAL_MODULE_4__,
	        __WEBPACK_LOCAL_MODULE_7__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_12__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports === 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('outlayer'),
	      require('get-size'),
	      require('fizzy-ui-utils')
	    );
	  } else {
	    // browser global
	    window.Masonry = factory(
	      window.Outlayer,
	      window.getSize,
	      window.fizzyUIUtils
	    );
	  }

	}( window, function factory( Outlayer, getSize, utils ) {



	// -------------------------- masonryDefinition -------------------------- //

	  // create an Outlayer layout class
	  var Masonry = Outlayer.create('masonry');

	  Masonry.prototype._resetLayout = function() {
	    this.getSize();
	    this._getMeasurement( 'columnWidth', 'outerWidth' );
	    this._getMeasurement( 'gutter', 'outerWidth' );
	    this.measureColumns();

	    // reset column Y
	    var i = this.cols;
	    this.colYs = [];
	    while (i--) {
	      this.colYs.push( 0 );
	    }

	    this.maxY = 0;
	  };

	  Masonry.prototype.measureColumns = function() {
	    this.getContainerWidth();
	    // if columnWidth is 0, default to outerWidth of first item
	    if ( !this.columnWidth ) {
	      var firstItem = this.items[0];
	      var firstItemElem = firstItem && firstItem.element;
	      // columnWidth fall back to item of first element
	      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
	        // if first elem has no width, default to size of container
	        this.containerWidth;
	    }

	    var columnWidth = this.columnWidth += this.gutter;

	    // calculate columns
	    var containerWidth = this.containerWidth + this.gutter;
	    var cols = containerWidth / columnWidth;
	    // fix rounding errors, typically with gutters
	    var excess = columnWidth - containerWidth % columnWidth;
	    // if overshoot is less than a pixel, round up, otherwise floor it
	    var mathMethod = excess && excess < 1 ? 'round' : 'floor';
	    cols = Math[ mathMethod ]( cols );
	    this.cols = Math.max( cols, 1 );
	  };

	  Masonry.prototype.getContainerWidth = function() {
	    // container is parent if fit width
	    var container = this.options.isFitWidth ? this.element.parentNode : this.element;
	    // check that this.size and size are there
	    // IE8 triggers resize on body size change, so they might not be
	    var size = getSize( container );
	    this.containerWidth = size && size.innerWidth;
	  };

	  Masonry.prototype._getItemLayoutPosition = function( item ) {
	    item.getSize();
	    // how many columns does this brick span
	    var remainder = item.size.outerWidth % this.columnWidth;
	    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
	    // round if off by 1 pixel, otherwise use ceil
	    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
	    colSpan = Math.min( colSpan, this.cols );

	    var colGroup = this._getColGroup( colSpan );
	    // get the minimum Y value from the columns
	    var minimumY = Math.min.apply( Math, colGroup );
	    var shortColIndex = utils.indexOf( colGroup, minimumY );

	    // position the brick
	    var position = {
	      x: this.columnWidth * shortColIndex,
	      y: minimumY
	    };

	    // apply setHeight to necessary columns
	    var setHeight = minimumY + item.size.outerHeight;
	    var setSpan = this.cols + 1 - colGroup.length;
	    for ( var i = 0; i < setSpan; i++ ) {
	      this.colYs[ shortColIndex + i ] = setHeight;
	    }

	    return position;
	  };

	  /**
	   * @param {Number} colSpan - number of columns the element spans
	   * @returns {Array} colGroup
	   */
	  Masonry.prototype._getColGroup = function( colSpan ) {
	    if ( colSpan < 2 ) {
	      // if brick spans only one column, use all the column Ys
	      return this.colYs;
	    }

	    var colGroup = [];
	    // how many different places could this brick fit horizontally
	    var groupCount = this.cols + 1 - colSpan;
	    // for each group potential horizontal position
	    for ( var i = 0; i < groupCount; i++ ) {
	      // make an array of colY values for that one group
	      var groupColYs = this.colYs.slice( i, i + colSpan );
	      // and get the max value of the array
	      colGroup[i] = Math.max.apply( Math, groupColYs );
	    }
	    return colGroup;
	  };

	  Masonry.prototype._manageStamp = function( stamp ) {
	    var stampSize = getSize( stamp );
	    var offset = this._getElementOffset( stamp );
	    // get the columns that this stamp affects
	    var firstX = this.options.isOriginLeft ? offset.left : offset.right;
	    var lastX = firstX + stampSize.outerWidth;
	    var firstCol = Math.floor( firstX / this.columnWidth );
	    firstCol = Math.max( 0, firstCol );
	    var lastCol = Math.floor( lastX / this.columnWidth );
	    // lastCol should not go over if multiple of columnWidth #425
	    lastCol -= lastX % this.columnWidth ? 0 : 1;
	    lastCol = Math.min( this.cols - 1, lastCol );
	    // set colYs to bottom of the stamp
	    var stampMaxY = ( this.options.isOriginTop ? offset.top : offset.bottom ) +
	      stampSize.outerHeight;
	    for ( var i = firstCol; i <= lastCol; i++ ) {
	      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
	    }
	  };

	  Masonry.prototype._getContainerSize = function() {
	    this.maxY = Math.max.apply( Math, this.colYs );
	    var size = {
	      height: this.maxY
	    };

	    if ( this.options.isFitWidth ) {
	      size.width = this._getContainerFitWidth();
	    }

	    return size;
	  };

	  Masonry.prototype._getContainerFitWidth = function() {
	    var unusedCols = 0;
	    // count unused columns
	    var i = this.cols;
	    while ( --i ) {
	      if ( this.colYs[i] !== 0 ) {
	        break;
	      }
	      unusedCols++;
	    }
	    // fit container to columns that have been used
	    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
	  };

	  Masonry.prototype.needsResizeLayout = function() {
	    var previousWidth = this.containerWidth;
	    this.getContainerWidth();
	    return previousWidth !== this.containerWidth;
	  };

	  return Masonry;

	}));

	/*!
	 * Masonry layout mode
	 * sub-classes Masonry
	 * http://masonry.desandro.com
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_11__,
	        __WEBPACK_LOCAL_MODULE_12__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_13__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('../layout-mode'),
	      require('masonry-layout')
	    );
	  } else {
	    // browser global
	    factory(
	      window.Isotope.LayoutMode,
	      window.Masonry
	    );
	  }

	}( window, function factory( LayoutMode, Masonry ) {
	'use strict';

	// -------------------------- helpers -------------------------- //

	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}

	// -------------------------- masonryDefinition -------------------------- //

	  // create an Outlayer layout class
	  var MasonryMode = LayoutMode.create('masonry');

	  // save on to these methods
	  var _getElementOffset = MasonryMode.prototype._getElementOffset;
	  var layout = MasonryMode.prototype.layout;
	  var _getMeasurement = MasonryMode.prototype._getMeasurement;

	  // sub-class Masonry
	  extend( MasonryMode.prototype, Masonry.prototype );

	  // set back, as it was overwritten by Masonry
	  MasonryMode.prototype._getElementOffset = _getElementOffset;
	  MasonryMode.prototype.layout = layout;
	  MasonryMode.prototype._getMeasurement = _getMeasurement;

	  var measureColumns = MasonryMode.prototype.measureColumns;
	  MasonryMode.prototype.measureColumns = function() {
	    // set items, used if measuring first item
	    this.items = this.isotope.filteredItems;
	    measureColumns.call( this );
	  };

	  // HACK copy over isOriginLeft/Top options
	  var _manageStamp = MasonryMode.prototype._manageStamp;
	  MasonryMode.prototype._manageStamp = function() {
	    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
	    this.options.isOriginTop = this.isotope.options.isOriginTop;
	    _manageStamp.apply( this, arguments );
	  };

	  return MasonryMode;

	}));

	/**
	 * fitRows layout mode
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_11__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_14__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('../layout-mode')
	    );
	  } else {
	    // browser global
	    factory(
	      window.Isotope.LayoutMode
	    );
	  }

	}( window, function factory( LayoutMode ) {
	'use strict';

	var FitRows = LayoutMode.create('fitRows');

	FitRows.prototype._resetLayout = function() {
	  this.x = 0;
	  this.y = 0;
	  this.maxY = 0;
	  this._getMeasurement( 'gutter', 'outerWidth' );
	};

	FitRows.prototype._getItemLayoutPosition = function( item ) {
	  item.getSize();

	  var itemWidth = item.size.outerWidth + this.gutter;
	  // if this element cannot fit in the current row
	  var containerWidth = this.isotope.size.innerWidth + this.gutter;
	  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
	    this.x = 0;
	    this.y = this.maxY;
	  }

	  var position = {
	    x: this.x,
	    y: this.y
	  };

	  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
	  this.x += itemWidth;

	  return position;
	};

	FitRows.prototype._getContainerSize = function() {
	  return { height: this.maxY };
	};

	return FitRows;

	}));

	/**
	 * vertical layout mode
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition
	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_11__
	      ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_LOCAL_MODULE_15__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      require('../layout-mode')
	    );
	  } else {
	    // browser global
	    factory(
	      window.Isotope.LayoutMode
	    );
	  }

	}( window, function factory( LayoutMode ) {
	'use strict';

	var Vertical = LayoutMode.create( 'vertical', {
	  horizontalAlignment: 0
	});

	Vertical.prototype._resetLayout = function() {
	  this.y = 0;
	};

	Vertical.prototype._getItemLayoutPosition = function( item ) {
	  item.getSize();
	  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
	    this.options.horizontalAlignment;
	  var y = this.y;
	  this.y += item.size.outerHeight;
	  return { x: x, y: y };
	};

	Vertical.prototype._getContainerSize = function() {
	  return { height: this.y };
	};

	return Vertical;

	}));

	/*!
	 * Isotope v2.2.2
	 *
	 * Licensed GPLv3 for open source use
	 * or Isotope Commercial License for commercial use
	 *
	 * http://isotope.metafizzy.co
	 * Copyright 2015 Metafizzy
	 */

	( function( window, factory ) {
	  'use strict';
	  // universal module definition

	  if ( true ) {
	    // AMD
	    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
	        __WEBPACK_LOCAL_MODULE_9__,
	        __WEBPACK_LOCAL_MODULE_4__,
	        __WEBPACK_LOCAL_MODULE_6__,
	        __WEBPACK_LOCAL_MODULE_7__,
	        __WEBPACK_LOCAL_MODULE_10__,
	        __WEBPACK_LOCAL_MODULE_11__,
	        // include default layout modes
	        __WEBPACK_LOCAL_MODULE_13__,
	        __WEBPACK_LOCAL_MODULE_14__,
	        __WEBPACK_LOCAL_MODULE_15__
	      ], __WEBPACK_AMD_DEFINE_RESULT__ = function( Outlayer, getSize, matchesSelector, utils, Item, LayoutMode ) {
	        return factory( window, Outlayer, getSize, matchesSelector, utils, Item, LayoutMode );
	      }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	  } else if ( typeof exports == 'object' ) {
	    // CommonJS
	    module.exports = factory(
	      window,
	      require('outlayer'),
	      require('get-size'),
	      require('desandro-matches-selector'),
	      require('fizzy-ui-utils'),
	      require('./item'),
	      require('./layout-mode'),
	      // include default layout modes
	      require('./layout-modes/masonry'),
	      require('./layout-modes/fit-rows'),
	      require('./layout-modes/vertical')
	    );
	  } else {
	    // browser global
	    window.Isotope = factory(
	      window,
	      window.Outlayer,
	      window.getSize,
	      window.matchesSelector,
	      window.fizzyUIUtils,
	      window.Isotope.Item,
	      window.Isotope.LayoutMode
	    );
	  }

	}( window, function factory( window, Outlayer, getSize, matchesSelector, utils,
	  Item, LayoutMode ) {



	// -------------------------- vars -------------------------- //

	var jQuery = window.jQuery;

	// -------------------------- helpers -------------------------- //

	var trim = String.prototype.trim ?
	  function( str ) {
	    return str.trim();
	  } :
	  function( str ) {
	    return str.replace( /^\s+|\s+$/g, '' );
	  };

	var docElem = document.documentElement;

	var getText = docElem.textContent ?
	  function( elem ) {
	    return elem.textContent;
	  } :
	  function( elem ) {
	    return elem.innerText;
	  };

	// -------------------------- isotopeDefinition -------------------------- //

	  // create an Outlayer layout class
	  var Isotope = Outlayer.create( 'isotope', {
	    layoutMode: "masonry",
	    isJQueryFiltering: true,
	    sortAscending: true
	  });

	  Isotope.Item = Item;
	  Isotope.LayoutMode = LayoutMode;

	  Isotope.prototype._create = function() {
	    this.itemGUID = 0;
	    // functions that sort items
	    this._sorters = {};
	    this._getSorters();
	    // call super
	    Outlayer.prototype._create.call( this );

	    // create layout modes
	    this.modes = {};
	    // start filteredItems with all items
	    this.filteredItems = this.items;
	    // keep of track of sortBys
	    this.sortHistory = [ 'original-order' ];
	    // create from registered layout modes
	    for ( var name in LayoutMode.modes ) {
	      this._initLayoutMode( name );
	    }
	  };

	  Isotope.prototype.reloadItems = function() {
	    // reset item ID counter
	    this.itemGUID = 0;
	    // call super
	    Outlayer.prototype.reloadItems.call( this );
	  };

	  Isotope.prototype._itemize = function() {
	    var items = Outlayer.prototype._itemize.apply( this, arguments );
	    // assign ID for original-order
	    for ( var i=0, len = items.length; i < len; i++ ) {
	      var item = items[i];
	      item.id = this.itemGUID++;
	    }
	    this._updateItemsSortData( items );
	    return items;
	  };


	  // -------------------------- layout -------------------------- //

	  Isotope.prototype._initLayoutMode = function( name ) {
	    var Mode = LayoutMode.modes[ name ];
	    // set mode options
	    // HACK extend initial options, back-fill in default options
	    var initialOpts = this.options[ name ] || {};
	    this.options[ name ] = Mode.options ?
	      utils.extend( Mode.options, initialOpts ) : initialOpts;
	    // init layout mode instance
	    this.modes[ name ] = new Mode( this );
	  };


	  Isotope.prototype.layout = function() {
	    // if first time doing layout, do all magic
	    if ( !this._isLayoutInited && this.options.isInitLayout ) {
	      this.arrange();
	      return;
	    }
	    this._layout();
	  };

	  // private method to be used in layout() & magic()
	  Isotope.prototype._layout = function() {
	    // don't animate first layout
	    var isInstant = this._getIsInstant();
	    // layout flow
	    this._resetLayout();
	    this._manageStamps();
	    this.layoutItems( this.filteredItems, isInstant );

	    // flag for initalized
	    this._isLayoutInited = true;
	  };

	  // filter + sort + layout
	  Isotope.prototype.arrange = function( opts ) {
	    // set any options pass
	    this.option( opts );
	    this._getIsInstant();
	    // filter, sort, and layout

	    // filter
	    var filtered = this._filter( this.items );
	    this.filteredItems = filtered.matches;

	    var _this = this;
	    function hideReveal() {
	      _this.reveal( filtered.needReveal );
	      _this.hide( filtered.needHide );
	    }

	    this._bindArrangeComplete();

	    if ( this._isInstant ) {
	      this._noTransition( hideReveal );
	    } else {
	      hideReveal();
	    }

	    this._sort();
	    this._layout();
	  };
	  // alias to _init for main plugin method
	  Isotope.prototype._init = Isotope.prototype.arrange;

	  // HACK
	  // Don't animate/transition first layout
	  // Or don't animate/transition other layouts
	  Isotope.prototype._getIsInstant = function() {
	    var isInstant = this.options.isLayoutInstant !== undefined ?
	      this.options.isLayoutInstant : !this._isLayoutInited;
	    this._isInstant = isInstant;
	    return isInstant;
	  };

	  // listen for layoutComplete, hideComplete and revealComplete
	  // to trigger arrangeComplete
	  Isotope.prototype._bindArrangeComplete = function() {
	    // listen for 3 events to trigger arrangeComplete
	    var isLayoutComplete, isHideComplete, isRevealComplete;
	    var _this = this;
	    function arrangeParallelCallback() {
	      if ( isLayoutComplete && isHideComplete && isRevealComplete ) {
	        _this.dispatchEvent( 'arrangeComplete', null, [ _this.filteredItems ] );
	      }
	    }
	    this.once( 'layoutComplete', function() {
	      isLayoutComplete = true;
	      arrangeParallelCallback();
	    });
	    this.once( 'hideComplete', function() {
	      isHideComplete = true;
	      arrangeParallelCallback();
	    });
	    this.once( 'revealComplete', function() {
	      isRevealComplete = true;
	      arrangeParallelCallback();
	    });
	  };

	  // -------------------------- filter -------------------------- //

	  Isotope.prototype._filter = function( items ) {
	    var filter = this.options.filter;
	    filter = filter || '*';
	    var matches = [];
	    var hiddenMatched = [];
	    var visibleUnmatched = [];

	    var test = this._getFilterTest( filter );

	    // test each item
	    for ( var i=0, len = items.length; i < len; i++ ) {
	      var item = items[i];
	      if ( item.isIgnored ) {
	        continue;
	      }
	      // add item to either matched or unmatched group
	      var isMatched = test( item );
	      // item.isFilterMatched = isMatched;
	      // add to matches if its a match
	      if ( isMatched ) {
	        matches.push( item );
	      }
	      // add to additional group if item needs to be hidden or revealed
	      if ( isMatched && item.isHidden ) {
	        hiddenMatched.push( item );
	      } else if ( !isMatched && !item.isHidden ) {
	        visibleUnmatched.push( item );
	      }
	    }

	    // return collections of items to be manipulated
	    return {
	      matches: matches,
	      needReveal: hiddenMatched,
	      needHide: visibleUnmatched
	    };
	  };

	  // get a jQuery, function, or a matchesSelector test given the filter
	  Isotope.prototype._getFilterTest = function( filter ) {
	    if ( jQuery && this.options.isJQueryFiltering ) {
	      // use jQuery
	      return function( item ) {
	        return jQuery( item.element ).is( filter );
	      };
	    }
	    if ( typeof filter == 'function' ) {
	      // use filter as function
	      return function( item ) {
	        return filter( item.element );
	      };
	    }
	    // default, use filter as selector string
	    return function( item ) {
	      return matchesSelector( item.element, filter );
	    };
	  };

	  // -------------------------- sorting -------------------------- //

	  /**
	   * @params {Array} elems
	   * @public
	   */
	  Isotope.prototype.updateSortData = function( elems ) {
	    // get items
	    var items;
	    if ( elems ) {
	      elems = utils.makeArray( elems );
	      items = this.getItems( elems );
	    } else {
	      // update all items if no elems provided
	      items = this.items;
	    }

	    this._getSorters();
	    this._updateItemsSortData( items );
	  };

	  Isotope.prototype._getSorters = function() {
	    var getSortData = this.options.getSortData;
	    for ( var key in getSortData ) {
	      var sorter = getSortData[ key ];
	      this._sorters[ key ] = mungeSorter( sorter );
	    }
	  };

	  /**
	   * @params {Array} items - of Isotope.Items
	   * @private
	   */
	  Isotope.prototype._updateItemsSortData = function( items ) {
	    // do not update if no items
	    var len = items && items.length;

	    for ( var i=0; len && i < len; i++ ) {
	      var item = items[i];
	      item.updateSortData();
	    }
	  };

	  // ----- munge sorter ----- //

	  // encapsulate this, as we just need mungeSorter
	  // other functions in here are just for munging
	  var mungeSorter = ( function() {
	    // add a magic layer to sorters for convienent shorthands
	    // `.foo-bar` will use the text of .foo-bar querySelector
	    // `[foo-bar]` will use attribute
	    // you can also add parser
	    // `.foo-bar parseInt` will parse that as a number
	    function mungeSorter( sorter ) {
	      // if not a string, return function or whatever it is
	      if ( typeof sorter != 'string' ) {
	        return sorter;
	      }
	      // parse the sorter string
	      var args = trim( sorter ).split(' ');
	      var query = args[0];
	      // check if query looks like [an-attribute]
	      var attrMatch = query.match( /^\[(.+)\]$/ );
	      var attr = attrMatch && attrMatch[1];
	      var getValue = getValueGetter( attr, query );
	      // use second argument as a parser
	      var parser = Isotope.sortDataParsers[ args[1] ];
	      // parse the value, if there was a parser
	      sorter = parser ? function( elem ) {
	        return elem && parser( getValue( elem ) );
	      } :
	      // otherwise just return value
	      function( elem ) {
	        return elem && getValue( elem );
	      };

	      return sorter;
	    }

	    // get an attribute getter, or get text of the querySelector
	    function getValueGetter( attr, query ) {
	      var getValue;
	      // if query looks like [foo-bar], get attribute
	      if ( attr ) {
	        getValue = function( elem ) {
	          return elem.getAttribute( attr );
	        };
	      } else {
	        // otherwise, assume its a querySelector, and get its text
	        getValue = function( elem ) {
	          var child = elem.querySelector( query );
	          return child && getText( child );
	        };
	      }
	      return getValue;
	    }

	    return mungeSorter;
	  })();

	  // parsers used in getSortData shortcut strings
	  Isotope.sortDataParsers = {
	    'parseInt': function( val ) {
	      return parseInt( val, 10 );
	    },
	    'parseFloat': function( val ) {
	      return parseFloat( val );
	    }
	  };

	  // ----- sort method ----- //

	  // sort filteredItem order
	  Isotope.prototype._sort = function() {
	    var sortByOpt = this.options.sortBy;
	    if ( !sortByOpt ) {
	      return;
	    }
	    // concat all sortBy and sortHistory
	    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
	    // sort magic
	    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
	    this.filteredItems.sort( itemSorter );
	    // keep track of sortBy History
	    if ( sortByOpt != this.sortHistory[0] ) {
	      // add to front, oldest goes in last
	      this.sortHistory.unshift( sortByOpt );
	    }
	  };

	  // returns a function used for sorting
	  function getItemSorter( sortBys, sortAsc ) {
	    return function sorter( itemA, itemB ) {
	      // cycle through all sortKeys
	      for ( var i = 0, len = sortBys.length; i < len; i++ ) {
	        var sortBy = sortBys[i];
	        var a = itemA.sortData[ sortBy ];
	        var b = itemB.sortData[ sortBy ];
	        if ( a > b || a < b ) {
	          // if sortAsc is an object, use the value given the sortBy key
	          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
	          var direction = isAscending ? 1 : -1;
	          return ( a > b ? 1 : -1 ) * direction;
	        }
	      }
	      return 0;
	    };
	  }

	  // -------------------------- methods -------------------------- //

	  // get layout mode
	  Isotope.prototype._mode = function() {
	    var layoutMode = this.options.layoutMode;
	    var mode = this.modes[ layoutMode ];
	    if ( !mode ) {
	      // TODO console.error
	      throw new Error( 'No layout mode: ' + layoutMode );
	    }
	    // HACK sync mode's options
	    // any options set after init for layout mode need to be synced
	    mode.options = this.options[ layoutMode ];
	    return mode;
	  };

	  Isotope.prototype._resetLayout = function() {
	    // trigger original reset layout
	    Outlayer.prototype._resetLayout.call( this );
	    this._mode()._resetLayout();
	  };

	  Isotope.prototype._getItemLayoutPosition = function( item  ) {
	    return this._mode()._getItemLayoutPosition( item );
	  };

	  Isotope.prototype._manageStamp = function( stamp ) {
	    this._mode()._manageStamp( stamp );
	  };

	  Isotope.prototype._getContainerSize = function() {
	    return this._mode()._getContainerSize();
	  };

	  Isotope.prototype.needsResizeLayout = function() {
	    return this._mode().needsResizeLayout();
	  };

	  // -------------------------- adding & removing -------------------------- //

	  // HEADS UP overwrites default Outlayer appended
	  Isotope.prototype.appended = function( elems ) {
	    var items = this.addItems( elems );
	    if ( !items.length ) {
	      return;
	    }
	    // filter, layout, reveal new items
	    var filteredItems = this._filterRevealAdded( items );
	    // add to filteredItems
	    this.filteredItems = this.filteredItems.concat( filteredItems );
	  };

	  // HEADS UP overwrites default Outlayer prepended
	  Isotope.prototype.prepended = function( elems ) {
	    var items = this._itemize( elems );
	    if ( !items.length ) {
	      return;
	    }
	    // start new layout
	    this._resetLayout();
	    this._manageStamps();
	    // filter, layout, reveal new items
	    var filteredItems = this._filterRevealAdded( items );
	    // layout previous items
	    this.layoutItems( this.filteredItems );
	    // add to items and filteredItems
	    this.filteredItems = filteredItems.concat( this.filteredItems );
	    this.items = items.concat( this.items );
	  };

	  Isotope.prototype._filterRevealAdded = function( items ) {
	    var filtered = this._filter( items );
	    this.hide( filtered.needHide );
	    // reveal all new items
	    this.reveal( filtered.matches );
	    // layout new items, no transition
	    this.layoutItems( filtered.matches, true );
	    return filtered.matches;
	  };

	  /**
	   * Filter, sort, and layout newly-appended item elements
	   * @param {Array or NodeList or Element} elems
	   */
	  Isotope.prototype.insert = function( elems ) {
	    var items = this.addItems( elems );
	    if ( !items.length ) {
	      return;
	    }
	    // append item elements
	    var i, item;
	    var len = items.length;
	    for ( i=0; i < len; i++ ) {
	      item = items[i];
	      this.element.appendChild( item.element );
	    }
	    // filter new stuff
	    var filteredInsertItems = this._filter( items ).matches;
	    // set flag
	    for ( i=0; i < len; i++ ) {
	      items[i].isLayoutInstant = true;
	    }
	    this.arrange();
	    // reset flag
	    for ( i=0; i < len; i++ ) {
	      delete items[i].isLayoutInstant;
	    }
	    this.reveal( filteredInsertItems );
	  };

	  var _remove = Isotope.prototype.remove;
	  Isotope.prototype.remove = function( elems ) {
	    elems = utils.makeArray( elems );
	    var removeItems = this.getItems( elems );
	    // do regular thing
	    _remove.call( this, elems );
	    // bail if no items to remove
	    var len = removeItems && removeItems.length;
	    if ( !len ) {
	      return;
	    }
	    // remove elems from filteredItems
	    for ( var i=0; i < len; i++ ) {
	      var item = removeItems[i];
	      // remove item from collection
	      utils.removeFrom( this.filteredItems, item );
	    }
	  };

	  Isotope.prototype.shuffle = function() {
	    // update random sortData
	    for ( var i=0, len = this.items.length; i < len; i++ ) {
	      var item = this.items[i];
	      item.sortData.random = Math.random();
	    }
	    this.options.sortBy = 'random';
	    this._sort();
	    this._layout();
	  };

	  /**
	   * trigger fn without transition
	   * kind of hacky to have this in the first place
	   * @param {Function} fn
	   * @returns ret
	   * @private
	   */
	  Isotope.prototype._noTransition = function( fn ) {
	    // save transitionDuration before disabling
	    var transitionDuration = this.options.transitionDuration;
	    // disable transition
	    this.options.transitionDuration = 0;
	    // do it
	    var returnValue = fn.call( this );
	    // re-enable transition for reveal
	    this.options.transitionDuration = transitionDuration;
	    return returnValue;
	  };

	  // ----- helper methods ----- //

	  /**
	   * getter method for getting filtered item elements
	   * @returns {Array} elems - collection of item elements
	   */
	  Isotope.prototype.getFilteredItemElements = function() {
	    var elems = [];
	    for ( var i=0, len = this.filteredItems.length; i < len; i++ ) {
	      elems.push( this.filteredItems[i].element );
	    }
	    return elems;
	  };

	  // -----  ----- //

	  return Isotope;

	}));



/***/ },

/***/ 532:
/***/ function(module, exports) {

	!function(t){"use strict";var s=function(s,e){this.el=t(s),this.options=t.extend({},t.fn.typed.defaults,e),this.isInput=this.el.is("input"),this.attr=this.options.attr,this.showCursor=this.isInput?!1:this.options.showCursor,this.elContent=this.attr?this.el.attr(this.attr):this.el.text(),this.contentType=this.options.contentType,this.typeSpeed=this.options.typeSpeed,this.startDelay=this.options.startDelay,this.backSpeed=this.options.backSpeed,this.backDelay=this.options.backDelay,this.stringsElement=this.options.stringsElement,this.strings=this.options.strings,this.strPos=0,this.arrayPos=0,this.stopNum=0,this.loop=this.options.loop,this.loopCount=this.options.loopCount,this.curLoop=0,this.stop=!1,this.cursorChar=this.options.cursorChar,this.shuffle=this.options.shuffle,this.sequence=[],this.build()};s.prototype={constructor:s,init:function(){var t=this;t.timeout=setTimeout(function(){for(var s=0;s<t.strings.length;++s)t.sequence[s]=s;t.shuffle&&(t.sequence=t.shuffleArray(t.sequence)),t.typewrite(t.strings[t.sequence[t.arrayPos]],t.strPos)},t.startDelay)},build:function(){var s=this;if(this.showCursor===!0&&(this.cursor=t('<span class="typed-cursor">'+this.cursorChar+"</span>"),this.el.after(this.cursor)),this.stringsElement){s.strings=[],this.stringsElement.hide();var e=this.stringsElement.find("p");t.each(e,function(e,i){s.strings.push(t(i).html())})}this.init()},typewrite:function(t,s){if(this.stop!==!0){var e=Math.round(70*Math.random())+this.typeSpeed,i=this;i.timeout=setTimeout(function(){var e=0,r=t.substr(s);if("^"===r.charAt(0)){var o=1;/^\^\d+/.test(r)&&(r=/\d+/.exec(r)[0],o+=r.length,e=parseInt(r)),t=t.substring(0,s)+t.substring(s+o)}if("html"===i.contentType){var n=t.substr(s).charAt(0);if("<"===n||"&"===n){var a="",h="";for(h="<"===n?">":";";t.substr(s).charAt(0)!==h;)a+=t.substr(s).charAt(0),s++;s++,a+=h}}i.timeout=setTimeout(function(){if(s===t.length){if(i.options.onStringTyped(i.arrayPos),i.arrayPos===i.strings.length-1&&(i.options.callback(),i.curLoop++,i.loop===!1||i.curLoop===i.loopCount))return;i.timeout=setTimeout(function(){i.backspace(t,s)},i.backDelay)}else{0===s&&i.options.preStringTyped(i.arrayPos);var e=t.substr(0,s+1);i.attr?i.el.attr(i.attr,e):i.isInput?i.el.val(e):"html"===i.contentType?i.el.html(e):i.el.text(e),s++,i.typewrite(t,s)}},e)},e)}},backspace:function(t,s){if(this.stop!==!0){var e=Math.round(70*Math.random())+this.backSpeed,i=this;i.timeout=setTimeout(function(){if("html"===i.contentType&&">"===t.substr(s).charAt(0)){for(var e="";"<"!==t.substr(s).charAt(0);)e-=t.substr(s).charAt(0),s--;s--,e+="<"}var r=t.substr(0,s);i.attr?i.el.attr(i.attr,r):i.isInput?i.el.val(r):"html"===i.contentType?i.el.html(r):i.el.text(r),s>i.stopNum?(s--,i.backspace(t,s)):s<=i.stopNum&&(i.arrayPos++,i.arrayPos===i.strings.length?(i.arrayPos=0,i.shuffle&&(i.sequence=i.shuffleArray(i.sequence)),i.init()):i.typewrite(i.strings[i.sequence[i.arrayPos]],s))},e)}},shuffleArray:function(t){var s,e,i=t.length;if(i)for(;--i;)e=Math.floor(Math.random()*(i+1)),s=t[e],t[e]=t[i],t[i]=s;return t},reset:function(){var t=this;clearInterval(t.timeout);var s=this.el.attr("id");this.el.after('<span id="'+s+'"/>'),this.el.remove(),"undefined"!=typeof this.cursor&&this.cursor.remove(),t.options.resetCallback()}},t.fn.typed=function(e){return this.each(function(){var i=t(this),r=i.data("typed"),o="object"==typeof e&&e;r||i.data("typed",r=new s(this,o)),"string"==typeof e&&r[e]()})},t.fn.typed.defaults={strings:["These are the default values...","You know what you should do?","Use your own!","Have a great day!"],stringsElement:null,typeSpeed:0,startDelay:0,backSpeed:0,shuffle:!1,backDelay:500,loop:!1,loopCount:!1,showCursor:!0,cursorChar:"|",attr:null,contentType:"html",callback:function(){},preStringTyped:function(){},onStringTyped:function(){},resetCallback:function(){}}}(window.jQuery);

/***/ },

/***/ 533:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * ScrollMagic v2.0.5 (2015-04-29)
	 * The javascript library for magical scroll interactions.
	 * (c) 2015 Jan Paepke (@janpaepke)
	 * Project Website: http://scrollmagic.io
	 * 
	 * @version 2.0.5
	 * @license Dual licensed under MIT license and GPL.
	 * @author Jan Paepke - e-mail@janpaepke.de
	 *
	 * @file ScrollMagic main library.
	 */
	/**
	 * @namespace ScrollMagic
	 */
	(function (root, factory) {
		if (true) {
			// AMD. Register as an anonymous module.
			!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		} else if (typeof exports === 'object') {
			// CommonJS
			module.exports = factory();
		} else {
			// Browser global
			root.ScrollMagic = factory();
		}
	}(this, function () {
		"use strict";

		var ScrollMagic = function () {
			_util.log(2, '(COMPATIBILITY NOTICE) -> As of ScrollMagic 2.0.0 you need to use \'new ScrollMagic.Controller()\' to create a new controller instance. Use \'new ScrollMagic.Scene()\' to instance a scene.');
		};

		ScrollMagic.version = "2.0.5";

		// TODO: temporary workaround for chrome's scroll jitter bug
		window.addEventListener("mousewheel", function () {});

		// global const
		var PIN_SPACER_ATTRIBUTE = "data-scrollmagic-pin-spacer";

		/**
		 * The main class that is needed once per scroll container.
		 *
		 * @class
		 *
		 * @example
		 * // basic initialization
		 * var controller = new ScrollMagic.Controller();
		 *
		 * // passing options
		 * var controller = new ScrollMagic.Controller({container: "#myContainer", loglevel: 3});
		 *
		 * @param {object} [options] - An object containing one or more options for the controller.
		 * @param {(string|object)} [options.container=window] - A selector, DOM object that references the main container for scrolling.
		 * @param {boolean} [options.vertical=true] - Sets the scroll mode to vertical (`true`) or horizontal (`false`) scrolling.
		 * @param {object} [options.globalSceneOptions={}] - These options will be passed to every Scene that is added to the controller using the addScene method. For more information on Scene options see {@link ScrollMagic.Scene}.
		 * @param {number} [options.loglevel=2] Loglevel for debugging. Note that logging is disabled in the minified version of ScrollMagic.
		 ** `0` => silent
		 ** `1` => errors
		 ** `2` => errors, warnings
		 ** `3` => errors, warnings, debuginfo
		 * @param {boolean} [options.refreshInterval=100] - Some changes don't call events by default, like changing the container size or moving a scene trigger element.  
		 This interval polls these parameters to fire the necessary events.  
		 If you don't use custom containers, trigger elements or have static layouts, where the positions of the trigger elements don't change, you can set this to 0 disable interval checking and improve performance.
		 *
		 */
		ScrollMagic.Controller = function (options) {
	/*
		 * ----------------------------------------------------------------
		 * settings
		 * ----------------------------------------------------------------
		 */
			var
			NAMESPACE = 'ScrollMagic.Controller',
				SCROLL_DIRECTION_FORWARD = 'FORWARD',
				SCROLL_DIRECTION_REVERSE = 'REVERSE',
				SCROLL_DIRECTION_PAUSED = 'PAUSED',
				DEFAULT_OPTIONS = CONTROLLER_OPTIONS.defaults;

	/*
		 * ----------------------------------------------------------------
		 * private vars
		 * ----------------------------------------------------------------
		 */
			var
			Controller = this,
				_options = _util.extend({}, DEFAULT_OPTIONS, options),
				_sceneObjects = [],
				_updateScenesOnNextCycle = false,
				// can be boolean (true => all scenes) or an array of scenes to be updated
				_scrollPos = 0,
				_scrollDirection = SCROLL_DIRECTION_PAUSED,
				_isDocument = true,
				_viewPortSize = 0,
				_enabled = true,
				_updateTimeout, _refreshTimeout;

	/*
		 * ----------------------------------------------------------------
		 * private functions
		 * ----------------------------------------------------------------
		 */

			/**
			 * Internal constructor function of the ScrollMagic Controller
			 * @private
			 */
			var construct = function () {
				for (var key in _options) {
					if (!DEFAULT_OPTIONS.hasOwnProperty(key)) {
						log(2, "WARNING: Unknown option \"" + key + "\"");
						delete _options[key];
					}
				}
				_options.container = _util.get.elements(_options.container)[0];
				// check ScrollContainer
				if (!_options.container) {
					log(1, "ERROR creating object " + NAMESPACE + ": No valid scroll container supplied");
					throw NAMESPACE + " init failed."; // cancel
				}
				_isDocument = _options.container === window || _options.container === document.body || !document.body.contains(_options.container);
				// normalize to window
				if (_isDocument) {
					_options.container = window;
				}
				// update container size immediately
				_viewPortSize = getViewportSize();
				// set event handlers
				_options.container.addEventListener("resize", onChange);
				_options.container.addEventListener("scroll", onChange);

				_options.refreshInterval = parseInt(_options.refreshInterval) || DEFAULT_OPTIONS.refreshInterval;
				scheduleRefresh();

				log(3, "added new " + NAMESPACE + " controller (v" + ScrollMagic.version + ")");
			};

			/**
			 * Schedule the next execution of the refresh function
			 * @private
			 */
			var scheduleRefresh = function () {
				if (_options.refreshInterval > 0) {
					_refreshTimeout = window.setTimeout(refresh, _options.refreshInterval);
				}
			};

			/**
			 * Default function to get scroll pos - overwriteable using `Controller.scrollPos(newFunction)`
			 * @private
			 */
			var getScrollPos = function () {
				return _options.vertical ? _util.get.scrollTop(_options.container) : _util.get.scrollLeft(_options.container);
			};

			/**
			 * Returns the current viewport Size (width vor horizontal, height for vertical)
			 * @private
			 */
			var getViewportSize = function () {
				return _options.vertical ? _util.get.height(_options.container) : _util.get.width(_options.container);
			};

			/**
			 * Default function to set scroll pos - overwriteable using `Controller.scrollTo(newFunction)`
			 * Make available publicly for pinned mousewheel workaround.
			 * @private
			 */
			var setScrollPos = this._setScrollPos = function (pos) {
				if (_options.vertical) {
					if (_isDocument) {
						window.scrollTo(_util.get.scrollLeft(), pos);
					} else {
						_options.container.scrollTop = pos;
					}
				} else {
					if (_isDocument) {
						window.scrollTo(pos, _util.get.scrollTop());
					} else {
						_options.container.scrollLeft = pos;
					}
				}
			};

			/**
			 * Handle updates in cycles instead of on scroll (performance)
			 * @private
			 */
			var updateScenes = function () {
				if (_enabled && _updateScenesOnNextCycle) {
					// determine scenes to update
					var scenesToUpdate = _util.type.Array(_updateScenesOnNextCycle) ? _updateScenesOnNextCycle : _sceneObjects.slice(0);
					// reset scenes
					_updateScenesOnNextCycle = false;
					var oldScrollPos = _scrollPos;
					// update scroll pos now instead of onChange, as it might have changed since scheduling (i.e. in-browser smooth scroll)
					_scrollPos = Controller.scrollPos();
					var deltaScroll = _scrollPos - oldScrollPos;
					if (deltaScroll !== 0) { // scroll position changed?
						_scrollDirection = (deltaScroll > 0) ? SCROLL_DIRECTION_FORWARD : SCROLL_DIRECTION_REVERSE;
					}
					// reverse order of scenes if scrolling reverse
					if (_scrollDirection === SCROLL_DIRECTION_REVERSE) {
						scenesToUpdate.reverse();
					}
					// update scenes
					scenesToUpdate.forEach(function (scene, index) {
						log(3, "updating Scene " + (index + 1) + "/" + scenesToUpdate.length + " (" + _sceneObjects.length + " total)");
						scene.update(true);
					});
					if (scenesToUpdate.length === 0 && _options.loglevel >= 3) {
						log(3, "updating 0 Scenes (nothing added to controller)");
					}
				}
			};

			/**
			 * Initializes rAF callback
			 * @private
			 */
			var debounceUpdate = function () {
				_updateTimeout = _util.rAF(updateScenes);
			};

			/**
			 * Handles Container changes
			 * @private
			 */
			var onChange = function (e) {
				log(3, "event fired causing an update:", e.type);
				if (e.type == "resize") {
					// resize
					_viewPortSize = getViewportSize();
					_scrollDirection = SCROLL_DIRECTION_PAUSED;
				}
				// schedule update
				if (_updateScenesOnNextCycle !== true) {
					_updateScenesOnNextCycle = true;
					debounceUpdate();
				}
			};

			var refresh = function () {
				if (!_isDocument) {
					// simulate resize event. Only works for viewport relevant param (performance)
					if (_viewPortSize != getViewportSize()) {
						var resizeEvent;
						try {
							resizeEvent = new Event('resize', {
								bubbles: false,
								cancelable: false
							});
						} catch (e) { // stupid IE
							resizeEvent = document.createEvent("Event");
							resizeEvent.initEvent("resize", false, false);
						}
						_options.container.dispatchEvent(resizeEvent);
					}
				}
				_sceneObjects.forEach(function (scene, index) { // refresh all scenes
					scene.refresh();
				});
				scheduleRefresh();
			};

			/**
			 * Send a debug message to the console.
			 * provided publicly with _log for plugins
			 * @private
			 *
			 * @param {number} loglevel - The loglevel required to initiate output for the message.
			 * @param {...mixed} output - One or more variables that should be passed to the console.
			 */
			var log = this._log = function (loglevel, output) {
				if (_options.loglevel >= loglevel) {
					Array.prototype.splice.call(arguments, 1, 0, "(" + NAMESPACE + ") ->");
					_util.log.apply(window, arguments);
				}
			};
			// for scenes we have getters for each option, but for the controller we don't, so we need to make it available externally for plugins
			this._options = _options;

			/**
			 * Sort scenes in ascending order of their start offset.
			 * @private
			 *
			 * @param {array} ScenesArray - an array of ScrollMagic Scenes that should be sorted
			 * @return {array} The sorted array of Scenes.
			 */
			var sortScenes = function (ScenesArray) {
				if (ScenesArray.length <= 1) {
					return ScenesArray;
				} else {
					var scenes = ScenesArray.slice(0);
					scenes.sort(function (a, b) {
						return a.scrollOffset() > b.scrollOffset() ? 1 : -1;
					});
					return scenes;
				}
			};

			/**
			 * ----------------------------------------------------------------
			 * public functions
			 * ----------------------------------------------------------------
			 */

			/**
			 * Add one ore more scene(s) to the controller.  
			 * This is the equivalent to `Scene.addTo(controller)`.
			 * @public
			 * @example
			 * // with a previously defined scene
			 * controller.addScene(scene);
			 *
			 * // with a newly created scene.
			 * controller.addScene(new ScrollMagic.Scene({duration : 0}));
			 *
			 * // adding multiple scenes
			 * controller.addScene([scene, scene2, new ScrollMagic.Scene({duration : 0})]);
			 *
			 * @param {(ScrollMagic.Scene|array)} newScene - ScrollMagic Scene or Array of Scenes to be added to the controller.
			 * @return {Controller} Parent object for chaining.
			 */
			this.addScene = function (newScene) {
				if (_util.type.Array(newScene)) {
					newScene.forEach(function (scene, index) {
						Controller.addScene(scene);
					});
				} else if (newScene instanceof ScrollMagic.Scene) {
					if (newScene.controller() !== Controller) {
						newScene.addTo(Controller);
					} else if (_sceneObjects.indexOf(newScene) < 0) {
						// new scene
						_sceneObjects.push(newScene); // add to array
						_sceneObjects = sortScenes(_sceneObjects); // sort
						newScene.on("shift.controller_sort", function () { // resort whenever scene moves
							_sceneObjects = sortScenes(_sceneObjects);
						});
						// insert Global defaults.
						for (var key in _options.globalSceneOptions) {
							if (newScene[key]) {
								newScene[key].call(newScene, _options.globalSceneOptions[key]);
							}
						}
						log(3, "adding Scene (now " + _sceneObjects.length + " total)");
					}
				} else {
					log(1, "ERROR: invalid argument supplied for '.addScene()'");
				}
				return Controller;
			};

			/**
			 * Remove one ore more scene(s) from the controller.  
			 * This is the equivalent to `Scene.remove()`.
			 * @public
			 * @example
			 * // remove a scene from the controller
			 * controller.removeScene(scene);
			 *
			 * // remove multiple scenes from the controller
			 * controller.removeScene([scene, scene2, scene3]);
			 *
			 * @param {(ScrollMagic.Scene|array)} Scene - ScrollMagic Scene or Array of Scenes to be removed from the controller.
			 * @returns {Controller} Parent object for chaining.
			 */
			this.removeScene = function (Scene) {
				if (_util.type.Array(Scene)) {
					Scene.forEach(function (scene, index) {
						Controller.removeScene(scene);
					});
				} else {
					var index = _sceneObjects.indexOf(Scene);
					if (index > -1) {
						Scene.off("shift.controller_sort");
						_sceneObjects.splice(index, 1);
						log(3, "removing Scene (now " + _sceneObjects.length + " left)");
						Scene.remove();
					}
				}
				return Controller;
			};

			/**
			 * Update one ore more scene(s) according to the scroll position of the container.  
			 * This is the equivalent to `Scene.update()`.  
			 * The update method calculates the scene's start and end position (based on the trigger element, trigger hook, duration and offset) and checks it against the current scroll position of the container.  
			 * It then updates the current scene state accordingly (or does nothing, if the state is already correct) – Pins will be set to their correct position and tweens will be updated to their correct progress.  
			 * _**Note:** This method gets called constantly whenever Controller detects a change. The only application for you is if you change something outside of the realm of ScrollMagic, like moving the trigger or changing tween parameters._
			 * @public
			 * @example
			 * // update a specific scene on next cycle
			 * controller.updateScene(scene);
			 *
			 * // update a specific scene immediately
			 * controller.updateScene(scene, true);
			 *
			 * // update multiple scenes scene on next cycle
			 * controller.updateScene([scene1, scene2, scene3]);
			 *
			 * @param {ScrollMagic.Scene} Scene - ScrollMagic Scene or Array of Scenes that is/are supposed to be updated.
			 * @param {boolean} [immediately=false] - If `true` the update will be instant, if `false` it will wait until next update cycle.  
			 This is useful when changing multiple properties of the scene - this way it will only be updated once all new properties are set (updateScenes).
			 * @return {Controller} Parent object for chaining.
			 */
			this.updateScene = function (Scene, immediately) {
				if (_util.type.Array(Scene)) {
					Scene.forEach(function (scene, index) {
						Controller.updateScene(scene, immediately);
					});
				} else {
					if (immediately) {
						Scene.update(true);
					} else if (_updateScenesOnNextCycle !== true && Scene instanceof ScrollMagic.Scene) { // if _updateScenesOnNextCycle is true, all connected scenes are already scheduled for update
						// prep array for next update cycle
						_updateScenesOnNextCycle = _updateScenesOnNextCycle || [];
						if (_updateScenesOnNextCycle.indexOf(Scene) == -1) {
							_updateScenesOnNextCycle.push(Scene);
						}
						_updateScenesOnNextCycle = sortScenes(_updateScenesOnNextCycle); // sort
						debounceUpdate();
					}
				}
				return Controller;
			};

			/**
			 * Updates the controller params and calls updateScene on every scene, that is attached to the controller.  
			 * See `Controller.updateScene()` for more information about what this means.  
			 * In most cases you will not need this function, as it is called constantly, whenever ScrollMagic detects a state change event, like resize or scroll.  
			 * The only application for this method is when ScrollMagic fails to detect these events.  
			 * One application is with some external scroll libraries (like iScroll) that move an internal container to a negative offset instead of actually scrolling. In this case the update on the controller needs to be called whenever the child container's position changes.
			 * For this case there will also be the need to provide a custom function to calculate the correct scroll position. See `Controller.scrollPos()` for details.
			 * @public
			 * @example
			 * // update the controller on next cycle (saves performance due to elimination of redundant updates)
			 * controller.update();
			 *
			 * // update the controller immediately
			 * controller.update(true);
			 *
			 * @param {boolean} [immediately=false] - If `true` the update will be instant, if `false` it will wait until next update cycle (better performance)
			 * @return {Controller} Parent object for chaining.
			 */
			this.update = function (immediately) {
				onChange({
					type: "resize"
				}); // will update size and set _updateScenesOnNextCycle to true
				if (immediately) {
					updateScenes();
				}
				return Controller;
			};

			/**
			 * Scroll to a numeric scroll offset, a DOM element, the start of a scene or provide an alternate method for scrolling.  
			 * For vertical controllers it will change the top scroll offset and for horizontal applications it will change the left offset.
			 * @public
			 *
			 * @since 1.1.0
			 * @example
			 * // scroll to an offset of 100
			 * controller.scrollTo(100);
			 *
			 * // scroll to a DOM element
			 * controller.scrollTo("#anchor");
			 *
			 * // scroll to the beginning of a scene
			 * var scene = new ScrollMagic.Scene({offset: 200});
			 * controller.scrollTo(scene);
			 *
			 * // define a new scroll position modification function (jQuery animate instead of jump)
			 * controller.scrollTo(function (newScrollPos) {
			 *	$("html, body").animate({scrollTop: newScrollPos});
			 * });
			 * controller.scrollTo(100); // call as usual, but the new function will be used instead
			 *
			 * // define a new scroll function with an additional parameter
			 * controller.scrollTo(function (newScrollPos, message) {
			 *  console.log(message);
			 *	$(this).animate({scrollTop: newScrollPos});
			 * });
			 * // call as usual, but supply an extra parameter to the defined custom function
			 * controller.scrollTo(100, "my message");
			 *
			 * // define a new scroll function with an additional parameter containing multiple variables
			 * controller.scrollTo(function (newScrollPos, options) {
			 *  someGlobalVar = options.a + options.b;
			 *	$(this).animate({scrollTop: newScrollPos});
			 * });
			 * // call as usual, but supply an extra parameter containing multiple options
			 * controller.scrollTo(100, {a: 1, b: 2});
			 *
			 * // define a new scroll function with a callback supplied as an additional parameter
			 * controller.scrollTo(function (newScrollPos, callback) {
			 *	$(this).animate({scrollTop: newScrollPos}, 400, "swing", callback);
			 * });
			 * // call as usual, but supply an extra parameter, which is used as a callback in the previously defined custom scroll function
			 * controller.scrollTo(100, function() {
			 *	console.log("scroll has finished.");
			 * });
			 *
			 * @param {mixed} scrollTarget - The supplied argument can be one of these types:
			 * 1. `number` -> The container will scroll to this new scroll offset.
			 * 2. `string` or `object` -> Can be a selector or a DOM object.  
			 *  The container will scroll to the position of this element.
			 * 3. `ScrollMagic Scene` -> The container will scroll to the start of this scene.
			 * 4. `function` -> This function will be used for future scroll position modifications.  
			 *  This provides a way for you to change the behaviour of scrolling and adding new behaviour like animation. The function receives the new scroll position as a parameter and a reference to the container element using `this`.  
			 *  It may also optionally receive an optional additional parameter (see below)  
			 *  _**NOTE:**  
			 *  All other options will still work as expected, using the new function to scroll._
			 * @param {mixed} [additionalParameter] - If a custom scroll function was defined (see above 4.), you may want to supply additional parameters to it, when calling it. You can do this using this parameter – see examples for details. Please note, that this parameter will have no effect, if you use the default scrolling function.
			 * @returns {Controller} Parent object for chaining.
			 */
			this.scrollTo = function (scrollTarget, additionalParameter) {
				if (_util.type.Number(scrollTarget)) { // excecute
					setScrollPos.call(_options.container, scrollTarget, additionalParameter);
				} else if (scrollTarget instanceof ScrollMagic.Scene) { // scroll to scene
					if (scrollTarget.controller() === Controller) { // check if the controller is associated with this scene
						Controller.scrollTo(scrollTarget.scrollOffset(), additionalParameter);
					} else {
						log(2, "scrollTo(): The supplied scene does not belong to this controller. Scroll cancelled.", scrollTarget);
					}
				} else if (_util.type.Function(scrollTarget)) { // assign new scroll function
					setScrollPos = scrollTarget;
				} else { // scroll to element
					var elem = _util.get.elements(scrollTarget)[0];
					if (elem) {
						// if parent is pin spacer, use spacer position instead so correct start position is returned for pinned elements.
						while (elem.parentNode.hasAttribute(PIN_SPACER_ATTRIBUTE)) {
							elem = elem.parentNode;
						}

						var
						param = _options.vertical ? "top" : "left",
							// which param is of interest ?
							containerOffset = _util.get.offset(_options.container),
							// container position is needed because element offset is returned in relation to document, not in relation to container.
							elementOffset = _util.get.offset(elem);

						if (!_isDocument) { // container is not the document root, so substract scroll Position to get correct trigger element position relative to scrollcontent
							containerOffset[param] -= Controller.scrollPos();
						}

						Controller.scrollTo(elementOffset[param] - containerOffset[param], additionalParameter);
					} else {
						log(2, "scrollTo(): The supplied argument is invalid. Scroll cancelled.", scrollTarget);
					}
				}
				return Controller;
			};

			/**
			 * **Get** the current scrollPosition or **Set** a new method to calculate it.  
			 * -> **GET**:
			 * When used as a getter this function will return the current scroll position.  
			 * To get a cached value use Controller.info("scrollPos"), which will be updated in the update cycle.  
			 * For vertical controllers it will return the top scroll offset and for horizontal applications it will return the left offset.
			 *
			 * -> **SET**:
			 * When used as a setter this method prodes a way to permanently overwrite the controller's scroll position calculation.  
			 * A typical usecase is when the scroll position is not reflected by the containers scrollTop or scrollLeft values, but for example by the inner offset of a child container.  
			 * Moving a child container inside a parent is a commonly used method for several scrolling frameworks, including iScroll.  
			 * By providing an alternate calculation function you can make sure ScrollMagic receives the correct scroll position.  
			 * Please also bear in mind that your function should return y values for vertical scrolls an x for horizontals.
			 *
			 * To change the current scroll position please use `Controller.scrollTo()`.
			 * @public
			 *
			 * @example
			 * // get the current scroll Position
			 * var scrollPos = controller.scrollPos();
			 *
			 * // set a new scroll position calculation method
			 * controller.scrollPos(function () {
			 *	return this.info("vertical") ? -mychildcontainer.y : -mychildcontainer.x
			 * });
			 *
			 * @param {function} [scrollPosMethod] - The function to be used for the scroll position calculation of the container.
			 * @returns {(number|Controller)} Current scroll position or parent object for chaining.
			 */
			this.scrollPos = function (scrollPosMethod) {
				if (!arguments.length) { // get
					return getScrollPos.call(Controller);
				} else { // set
					if (_util.type.Function(scrollPosMethod)) {
						getScrollPos = scrollPosMethod;
					} else {
						log(2, "Provided value for method 'scrollPos' is not a function. To change the current scroll position use 'scrollTo()'.");
					}
				}
				return Controller;
			};

			/**
			 * **Get** all infos or one in particular about the controller.
			 * @public
			 * @example
			 * // returns the current scroll position (number)
			 * var scrollPos = controller.info("scrollPos");
			 *
			 * // returns all infos as an object
			 * var infos = controller.info();
			 *
			 * @param {string} [about] - If passed only this info will be returned instead of an object containing all.  
			 Valid options are:
			 ** `"size"` => the current viewport size of the container
			 ** `"vertical"` => true if vertical scrolling, otherwise false
			 ** `"scrollPos"` => the current scroll position
			 ** `"scrollDirection"` => the last known direction of the scroll
			 ** `"container"` => the container element
			 ** `"isDocument"` => true if container element is the document.
			 * @returns {(mixed|object)} The requested info(s).
			 */
			this.info = function (about) {
				var values = {
					size: _viewPortSize,
					// contains height or width (in regard to orientation);
					vertical: _options.vertical,
					scrollPos: _scrollPos,
					scrollDirection: _scrollDirection,
					container: _options.container,
					isDocument: _isDocument
				};
				if (!arguments.length) { // get all as an object
					return values;
				} else if (values[about] !== undefined) {
					return values[about];
				} else {
					log(1, "ERROR: option \"" + about + "\" is not available");
					return;
				}
			};

			/**
			 * **Get** or **Set** the current loglevel option value.
			 * @public
			 *
			 * @example
			 * // get the current value
			 * var loglevel = controller.loglevel();
			 *
			 * // set a new value
			 * controller.loglevel(3);
			 *
			 * @param {number} [newLoglevel] - The new loglevel setting of the Controller. `[0-3]`
			 * @returns {(number|Controller)} Current loglevel or parent object for chaining.
			 */
			this.loglevel = function (newLoglevel) {
				if (!arguments.length) { // get
					return _options.loglevel;
				} else if (_options.loglevel != newLoglevel) { // set
					_options.loglevel = newLoglevel;
				}
				return Controller;
			};

			/**
			 * **Get** or **Set** the current enabled state of the controller.  
			 * This can be used to disable all Scenes connected to the controller without destroying or removing them.
			 * @public
			 *
			 * @example
			 * // get the current value
			 * var enabled = controller.enabled();
			 *
			 * // disable the controller
			 * controller.enabled(false);
			 *
			 * @param {boolean} [newState] - The new enabled state of the controller `true` or `false`.
			 * @returns {(boolean|Controller)} Current enabled state or parent object for chaining.
			 */
			this.enabled = function (newState) {
				if (!arguments.length) { // get
					return _enabled;
				} else if (_enabled != newState) { // set
					_enabled = !! newState;
					Controller.updateScene(_sceneObjects, true);
				}
				return Controller;
			};

			/**
			 * Destroy the Controller, all Scenes and everything.
			 * @public
			 *
			 * @example
			 * // without resetting the scenes
			 * controller = controller.destroy();
			 *
			 * // with scene reset
			 * controller = controller.destroy(true);
			 *
			 * @param {boolean} [resetScenes=false] - If `true` the pins and tweens (if existent) of all scenes will be reset.
			 * @returns {null} Null to unset handler variables.
			 */
			this.destroy = function (resetScenes) {
				window.clearTimeout(_refreshTimeout);
				var i = _sceneObjects.length;
				while (i--) {
					_sceneObjects[i].destroy(resetScenes);
				}
				_options.container.removeEventListener("resize", onChange);
				_options.container.removeEventListener("scroll", onChange);
				_util.cAF(_updateTimeout);
				log(3, "destroyed " + NAMESPACE + " (reset: " + (resetScenes ? "true" : "false") + ")");
				return null;
			};

			// INIT
			construct();
			return Controller;
		};

		// store pagewide controller options
		var CONTROLLER_OPTIONS = {
			defaults: {
				container: window,
				vertical: true,
				globalSceneOptions: {},
				loglevel: 2,
				refreshInterval: 100
			}
		};
	/*
	 * method used to add an option to ScrollMagic Scenes.
	 */
		ScrollMagic.Controller.addOption = function (name, defaultValue) {
			CONTROLLER_OPTIONS.defaults[name] = defaultValue;
		};
		// instance extension function for plugins
		ScrollMagic.Controller.extend = function (extension) {
			var oldClass = this;
			ScrollMagic.Controller = function () {
				oldClass.apply(this, arguments);
				this.$super = _util.extend({}, this); // copy parent state
				return extension.apply(this, arguments) || this;
			};
			_util.extend(ScrollMagic.Controller, oldClass); // copy properties
			ScrollMagic.Controller.prototype = oldClass.prototype; // copy prototype
			ScrollMagic.Controller.prototype.constructor = ScrollMagic.Controller; // restore constructor
		};


		/**
		 * A Scene defines where the controller should react and how.
		 *
		 * @class
		 *
		 * @example
		 * // create a standard scene and add it to a controller
		 * new ScrollMagic.Scene()
		 *		.addTo(controller);
		 *
		 * // create a scene with custom options and assign a handler to it.
		 * var scene = new ScrollMagic.Scene({
		 * 		duration: 100,
		 *		offset: 200,
		 *		triggerHook: "onEnter",
		 *		reverse: false
		 * });
		 *
		 * @param {object} [options] - Options for the Scene. The options can be updated at any time.  
		 Instead of setting the options for each scene individually you can also set them globally in the controller as the controllers `globalSceneOptions` option. The object accepts the same properties as the ones below.  
		 When a scene is added to the controller the options defined using the Scene constructor will be overwritten by those set in `globalSceneOptions`.
		 * @param {(number|function)} [options.duration=0] - The duration of the scene. 
		 If `0` tweens will auto-play when reaching the scene start point, pins will be pinned indefinetly starting at the start position.  
		 A function retuning the duration value is also supported. Please see `Scene.duration()` for details.
		 * @param {number} [options.offset=0] - Offset Value for the Trigger Position. If no triggerElement is defined this will be the scroll distance from the start of the page, after which the scene will start.
		 * @param {(string|object)} [options.triggerElement=null] - Selector or DOM object that defines the start of the scene. If undefined the scene will start right at the start of the page (unless an offset is set).
		 * @param {(number|string)} [options.triggerHook="onCenter"] - Can be a number between 0 and 1 defining the position of the trigger Hook in relation to the viewport.  
		 Can also be defined using a string:
		 ** `"onEnter"` => `1`
		 ** `"onCenter"` => `0.5`
		 ** `"onLeave"` => `0`
		 * @param {boolean} [options.reverse=true] - Should the scene reverse, when scrolling up?
		 * @param {number} [options.loglevel=2] - Loglevel for debugging. Note that logging is disabled in the minified version of ScrollMagic.
		 ** `0` => silent
		 ** `1` => errors
		 ** `2` => errors, warnings
		 ** `3` => errors, warnings, debuginfo
		 * 
		 */
		ScrollMagic.Scene = function (options) {

	/*
		 * ----------------------------------------------------------------
		 * settings
		 * ----------------------------------------------------------------
		 */

			var
			NAMESPACE = 'ScrollMagic.Scene',
				SCENE_STATE_BEFORE = 'BEFORE',
				SCENE_STATE_DURING = 'DURING',
				SCENE_STATE_AFTER = 'AFTER',
				DEFAULT_OPTIONS = SCENE_OPTIONS.defaults;

	/*
		 * ----------------------------------------------------------------
		 * private vars
		 * ----------------------------------------------------------------
		 */

			var
			Scene = this,
				_options = _util.extend({}, DEFAULT_OPTIONS, options),
				_state = SCENE_STATE_BEFORE,
				_progress = 0,
				_scrollOffset = {
					start: 0,
					end: 0
				},
				// reflects the controllers's scroll position for the start and end of the scene respectively
				_triggerPos = 0,
				_enabled = true,
				_durationUpdateMethod, _controller;

			/**
			 * Internal constructor function of the ScrollMagic Scene
			 * @private
			 */
			var construct = function () {
				for (var key in _options) { // check supplied options
					if (!DEFAULT_OPTIONS.hasOwnProperty(key)) {
						log(2, "WARNING: Unknown option \"" + key + "\"");
						delete _options[key];
					}
				}
				// add getters/setters for all possible options
				for (var optionName in DEFAULT_OPTIONS) {
					addSceneOption(optionName);
				}
				// validate all options
				validateOption();
			};

	/*
	 * ----------------------------------------------------------------
	 * Event Management
	 * ----------------------------------------------------------------
	 */

			var _listeners = {};
			/**
			 * Scene start event.  
			 * Fires whenever the scroll position its the starting point of the scene.  
			 * It will also fire when scrolling back up going over the start position of the scene. If you want something to happen only when scrolling down/right, use the scrollDirection parameter passed to the callback.
			 *
			 * For details on this event and the order in which it is fired, please review the {@link Scene.progress} method.
			 *
			 * @event ScrollMagic.Scene#start
			 *
			 * @example
			 * scene.on("start", function (event) {
			 * 	console.log("Hit start point of scene.");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.progress - Reflects the current progress of the scene
			 * @property {string} event.state - The current state of the scene `"BEFORE"` or `"DURING"`
			 * @property {string} event.scrollDirection - Indicates which way we are scrolling `"PAUSED"`, `"FORWARD"` or `"REVERSE"`
			 */
			/**
			 * Scene end event.  
			 * Fires whenever the scroll position its the ending point of the scene.  
			 * It will also fire when scrolling back up from after the scene and going over its end position. If you want something to happen only when scrolling down/right, use the scrollDirection parameter passed to the callback.
			 *
			 * For details on this event and the order in which it is fired, please review the {@link Scene.progress} method.
			 *
			 * @event ScrollMagic.Scene#end
			 *
			 * @example
			 * scene.on("end", function (event) {
			 * 	console.log("Hit end point of scene.");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.progress - Reflects the current progress of the scene
			 * @property {string} event.state - The current state of the scene `"DURING"` or `"AFTER"`
			 * @property {string} event.scrollDirection - Indicates which way we are scrolling `"PAUSED"`, `"FORWARD"` or `"REVERSE"`
			 */
			/**
			 * Scene enter event.  
			 * Fires whenever the scene enters the "DURING" state.  
			 * Keep in mind that it doesn't matter if the scene plays forward or backward: This event always fires when the scene enters its active scroll timeframe, regardless of the scroll-direction.
			 *
			 * For details on this event and the order in which it is fired, please review the {@link Scene.progress} method.
			 *
			 * @event ScrollMagic.Scene#enter
			 *
			 * @example
			 * scene.on("enter", function (event) {
			 * 	console.log("Scene entered.");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.progress - Reflects the current progress of the scene
			 * @property {string} event.state - The current state of the scene - always `"DURING"`
			 * @property {string} event.scrollDirection - Indicates which way we are scrolling `"PAUSED"`, `"FORWARD"` or `"REVERSE"`
			 */
			/**
			 * Scene leave event.  
			 * Fires whenever the scene's state goes from "DURING" to either "BEFORE" or "AFTER".  
			 * Keep in mind that it doesn't matter if the scene plays forward or backward: This event always fires when the scene leaves its active scroll timeframe, regardless of the scroll-direction.
			 *
			 * For details on this event and the order in which it is fired, please review the {@link Scene.progress} method.
			 *
			 * @event ScrollMagic.Scene#leave
			 *
			 * @example
			 * scene.on("leave", function (event) {
			 * 	console.log("Scene left.");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.progress - Reflects the current progress of the scene
			 * @property {string} event.state - The current state of the scene `"BEFORE"` or `"AFTER"`
			 * @property {string} event.scrollDirection - Indicates which way we are scrolling `"PAUSED"`, `"FORWARD"` or `"REVERSE"`
			 */
			/**
			 * Scene update event.  
			 * Fires whenever the scene is updated (but not necessarily changes the progress).
			 *
			 * @event ScrollMagic.Scene#update
			 *
			 * @example
			 * scene.on("update", function (event) {
			 * 	console.log("Scene updated.");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.startPos - The starting position of the scene (in relation to the conainer)
			 * @property {number} event.endPos - The ending position of the scene (in relation to the conainer)
			 * @property {number} event.scrollPos - The current scroll position of the container
			 */
			/**
			 * Scene progress event.  
			 * Fires whenever the progress of the scene changes.
			 *
			 * For details on this event and the order in which it is fired, please review the {@link Scene.progress} method.
			 *
			 * @event ScrollMagic.Scene#progress
			 *
			 * @example
			 * scene.on("progress", function (event) {
			 * 	console.log("Scene progress changed to " + event.progress);
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {number} event.progress - Reflects the current progress of the scene
			 * @property {string} event.state - The current state of the scene `"BEFORE"`, `"DURING"` or `"AFTER"`
			 * @property {string} event.scrollDirection - Indicates which way we are scrolling `"PAUSED"`, `"FORWARD"` or `"REVERSE"`
			 */
			/**
			 * Scene change event.  
			 * Fires whenvever a property of the scene is changed.
			 *
			 * @event ScrollMagic.Scene#change
			 *
			 * @example
			 * scene.on("change", function (event) {
			 * 	console.log("Scene Property \"" + event.what + "\" changed to " + event.newval);
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {string} event.what - Indicates what value has been changed
			 * @property {mixed} event.newval - The new value of the changed property
			 */
			/**
			 * Scene shift event.  
			 * Fires whenvever the start or end **scroll offset** of the scene change.
			 * This happens explicitely, when one of these values change: `offset`, `duration` or `triggerHook`.
			 * It will fire implicitly when the `triggerElement` changes, if the new element has a different position (most cases).
			 * It will also fire implicitly when the size of the container changes and the triggerHook is anything other than `onLeave`.
			 *
			 * @event ScrollMagic.Scene#shift
			 * @since 1.1.0
			 *
			 * @example
			 * scene.on("shift", function (event) {
			 * 	console.log("Scene moved, because the " + event.reason + " has changed.)");
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {string} event.reason - Indicates why the scene has shifted
			 */
			/**
			 * Scene destroy event.  
			 * Fires whenvever the scene is destroyed.
			 * This can be used to tidy up custom behaviour used in events.
			 *
			 * @event ScrollMagic.Scene#destroy
			 * @since 1.1.0
			 *
			 * @example
			 * scene.on("enter", function (event) {
			 *        // add custom action
			 *        $("#my-elem").left("200");
			 *      })
			 *      .on("destroy", function (event) {
			 *        // reset my element to start position
			 *        if (event.reset) {
			 *          $("#my-elem").left("0");
			 *        }
			 *      });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {boolean} event.reset - Indicates if the destroy method was called with reset `true` or `false`.
			 */
			/**
			 * Scene add event.  
			 * Fires when the scene is added to a controller.
			 * This is mostly used by plugins to know that change might be due.
			 *
			 * @event ScrollMagic.Scene#add
			 * @since 2.0.0
			 *
			 * @example
			 * scene.on("add", function (event) {
			 * 	console.log('Scene was added to a new controller.');
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 * @property {boolean} event.controller - The controller object the scene was added to.
			 */
			/**
			 * Scene remove event.  
			 * Fires when the scene is removed from a controller.
			 * This is mostly used by plugins to know that change might be due.
			 *
			 * @event ScrollMagic.Scene#remove
			 * @since 2.0.0
			 *
			 * @example
			 * scene.on("remove", function (event) {
			 * 	console.log('Scene was removed from its controller.');
			 * });
			 *
			 * @property {object} event - The event Object passed to each callback
			 * @property {string} event.type - The name of the event
			 * @property {Scene} event.target - The Scene object that triggered this event
			 */

			/**
			 * Add one ore more event listener.  
			 * The callback function will be fired at the respective event, and an object containing relevant data will be passed to the callback.
			 * @method ScrollMagic.Scene#on
			 *
			 * @example
			 * function callback (event) {
			 * 		console.log("Event fired! (" + event.type + ")");
			 * }
			 * // add listeners
			 * scene.on("change update progress start end enter leave", callback);
			 *
			 * @param {string} names - The name or names of the event the callback should be attached to.
			 * @param {function} callback - A function that should be executed, when the event is dispatched. An event object will be passed to the callback.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.on = function (names, callback) {
				if (_util.type.Function(callback)) {
					names = names.trim().split(' ');
					names.forEach(function (fullname) {
						var
						nameparts = fullname.split('.'),
							eventname = nameparts[0],
							namespace = nameparts[1];
						if (eventname != "*") { // disallow wildcards
							if (!_listeners[eventname]) {
								_listeners[eventname] = [];
							}
							_listeners[eventname].push({
								namespace: namespace || '',
								callback: callback
							});
						}
					});
				} else {
					log(1, "ERROR when calling '.on()': Supplied callback for '" + names + "' is not a valid function!");
				}
				return Scene;
			};

			/**
			 * Remove one or more event listener.
			 * @method ScrollMagic.Scene#off
			 *
			 * @example
			 * function callback (event) {
			 * 		console.log("Event fired! (" + event.type + ")");
			 * }
			 * // add listeners
			 * scene.on("change update", callback);
			 * // remove listeners
			 * scene.off("change update", callback);
			 *
			 * @param {string} names - The name or names of the event that should be removed.
			 * @param {function} [callback] - A specific callback function that should be removed. If none is passed all callbacks to the event listener will be removed.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.off = function (names, callback) {
				if (!names) {
					log(1, "ERROR: Invalid event name supplied.");
					return Scene;
				}
				names = names.trim().split(' ');
				names.forEach(function (fullname, key) {
					var
					nameparts = fullname.split('.'),
						eventname = nameparts[0],
						namespace = nameparts[1] || '',
						removeList = eventname === '*' ? Object.keys(_listeners) : [eventname];
					removeList.forEach(function (remove) {
						var
						list = _listeners[remove] || [],
							i = list.length;
						while (i--) {
							var listener = list[i];
							if (listener && (namespace === listener.namespace || namespace === '*') && (!callback || callback == listener.callback)) {
								list.splice(i, 1);
							}
						}
						if (!list.length) {
							delete _listeners[remove];
						}
					});
				});
				return Scene;
			};

			/**
			 * Trigger an event.
			 * @method ScrollMagic.Scene#trigger
			 *
			 * @example
			 * this.trigger("change");
			 *
			 * @param {string} name - The name of the event that should be triggered.
			 * @param {object} [vars] - An object containing info that should be passed to the callback.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.trigger = function (name, vars) {
				if (name) {
					var
					nameparts = name.trim().split('.'),
						eventname = nameparts[0],
						namespace = nameparts[1],
						listeners = _listeners[eventname];
					log(3, 'event fired:', eventname, vars ? "->" : '', vars || '');
					if (listeners) {
						listeners.forEach(function (listener, key) {
							if (!namespace || namespace === listener.namespace) {
								listener.callback.call(Scene, new ScrollMagic.Event(eventname, listener.namespace, Scene, vars));
							}
						});
					}
				} else {
					log(1, "ERROR: Invalid event name supplied.");
				}
				return Scene;
			};

			// set event listeners
			Scene.on("change.internal", function (e) {
				if (e.what !== "loglevel" && e.what !== "tweenChanges") { // no need for a scene update scene with these options...
					if (e.what === "triggerElement") {
						updateTriggerElementPosition();
					} else if (e.what === "reverse") { // the only property left that may have an impact on the current scene state. Everything else is handled by the shift event.
						Scene.update();
					}
				}
			}).on("shift.internal", function (e) {
				updateScrollOffset();
				Scene.update(); // update scene to reflect new position
			});

			/**
			 * Send a debug message to the console.
			 * @private
			 * but provided publicly with _log for plugins
			 *
			 * @param {number} loglevel - The loglevel required to initiate output for the message.
			 * @param {...mixed} output - One or more variables that should be passed to the console.
			 */
			var log = this._log = function (loglevel, output) {
				if (_options.loglevel >= loglevel) {
					Array.prototype.splice.call(arguments, 1, 0, "(" + NAMESPACE + ") ->");
					_util.log.apply(window, arguments);
				}
			};

			/**
			 * Add the scene to a controller.  
			 * This is the equivalent to `Controller.addScene(scene)`.
			 * @method ScrollMagic.Scene#addTo
			 *
			 * @example
			 * // add a scene to a ScrollMagic Controller
			 * scene.addTo(controller);
			 *
			 * @param {ScrollMagic.Controller} controller - The controller to which the scene should be added.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.addTo = function (controller) {
				if (!(controller instanceof ScrollMagic.Controller)) {
					log(1, "ERROR: supplied argument of 'addTo()' is not a valid ScrollMagic Controller");
				} else if (_controller != controller) {
					// new controller
					if (_controller) { // was associated to a different controller before, so remove it...
						_controller.removeScene(Scene);
					}
					_controller = controller;
					validateOption();
					updateDuration(true);
					updateTriggerElementPosition(true);
					updateScrollOffset();
					_controller.info("container").addEventListener('resize', onContainerResize);
					controller.addScene(Scene);
					Scene.trigger("add", {
						controller: _controller
					});
					log(3, "added " + NAMESPACE + " to controller");
					Scene.update();
				}
				return Scene;
			};

			/**
			 * **Get** or **Set** the current enabled state of the scene.  
			 * This can be used to disable this scene without removing or destroying it.
			 * @method ScrollMagic.Scene#enabled
			 *
			 * @example
			 * // get the current value
			 * var enabled = scene.enabled();
			 *
			 * // disable the scene
			 * scene.enabled(false);
			 *
			 * @param {boolean} [newState] - The new enabled state of the scene `true` or `false`.
			 * @returns {(boolean|Scene)} Current enabled state or parent object for chaining.
			 */
			this.enabled = function (newState) {
				if (!arguments.length) { // get
					return _enabled;
				} else if (_enabled != newState) { // set
					_enabled = !! newState;
					Scene.update(true);
				}
				return Scene;
			};

			/**
			 * Remove the scene from the controller.  
			 * This is the equivalent to `Controller.removeScene(scene)`.
			 * The scene will not be updated anymore until you readd it to a controller.
			 * To remove the pin or the tween you need to call removeTween() or removePin() respectively.
			 * @method ScrollMagic.Scene#remove
			 * @example
			 * // remove the scene from its controller
			 * scene.remove();
			 *
			 * @returns {Scene} Parent object for chaining.
			 */
			this.remove = function () {
				if (_controller) {
					_controller.info("container").removeEventListener('resize', onContainerResize);
					var tmpParent = _controller;
					_controller = undefined;
					tmpParent.removeScene(Scene);
					Scene.trigger("remove");
					log(3, "removed " + NAMESPACE + " from controller");
				}
				return Scene;
			};

			/**
			 * Destroy the scene and everything.
			 * @method ScrollMagic.Scene#destroy
			 * @example
			 * // destroy the scene without resetting the pin and tween to their initial positions
			 * scene = scene.destroy();
			 *
			 * // destroy the scene and reset the pin and tween
			 * scene = scene.destroy(true);
			 *
			 * @param {boolean} [reset=false] - If `true` the pin and tween (if existent) will be reset.
			 * @returns {null} Null to unset handler variables.
			 */
			this.destroy = function (reset) {
				Scene.trigger("destroy", {
					reset: reset
				});
				Scene.remove();
				Scene.off("*.*");
				log(3, "destroyed " + NAMESPACE + " (reset: " + (reset ? "true" : "false") + ")");
				return null;
			};


			/**
			 * Updates the Scene to reflect the current state.  
			 * This is the equivalent to `Controller.updateScene(scene, immediately)`.  
			 * The update method calculates the scene's start and end position (based on the trigger element, trigger hook, duration and offset) and checks it against the current scroll position of the container.  
			 * It then updates the current scene state accordingly (or does nothing, if the state is already correct) – Pins will be set to their correct position and tweens will be updated to their correct progress.
			 * This means an update doesn't necessarily result in a progress change. The `progress` event will be fired if the progress has indeed changed between this update and the last.  
			 * _**NOTE:** This method gets called constantly whenever ScrollMagic detects a change. The only application for you is if you change something outside of the realm of ScrollMagic, like moving the trigger or changing tween parameters._
			 * @method ScrollMagic.Scene#update
			 * @example
			 * // update the scene on next tick
			 * scene.update();
			 *
			 * // update the scene immediately
			 * scene.update(true);
			 *
			 * @fires Scene.update
			 *
			 * @param {boolean} [immediately=false] - If `true` the update will be instant, if `false` it will wait until next update cycle (better performance).
			 * @returns {Scene} Parent object for chaining.
			 */
			this.update = function (immediately) {
				if (_controller) {
					if (immediately) {
						if (_controller.enabled() && _enabled) {
							var
							scrollPos = _controller.info("scrollPos"),
								newProgress;

							if (_options.duration > 0) {
								newProgress = (scrollPos - _scrollOffset.start) / (_scrollOffset.end - _scrollOffset.start);
							} else {
								newProgress = scrollPos >= _scrollOffset.start ? 1 : 0;
							}

							Scene.trigger("update", {
								startPos: _scrollOffset.start,
								endPos: _scrollOffset.end,
								scrollPos: scrollPos
							});

							Scene.progress(newProgress);
						} else if (_pin && _state === SCENE_STATE_DURING) {
							updatePinState(true); // unpin in position
						}
					} else {
						_controller.updateScene(Scene, false);
					}
				}
				return Scene;
			};

			/**
			 * Updates dynamic scene variables like the trigger element position or the duration.
			 * This method is automatically called in regular intervals from the controller. See {@link ScrollMagic.Controller} option `refreshInterval`.
			 * 
			 * You can call it to minimize lag, for example when you intentionally change the position of the triggerElement.
			 * If you don't it will simply be updated in the next refresh interval of the container, which is usually sufficient.
			 *
			 * @method ScrollMagic.Scene#refresh
			 * @since 1.1.0
			 * @example
			 * scene = new ScrollMagic.Scene({triggerElement: "#trigger"});
			 * 
			 * // change the position of the trigger
			 * $("#trigger").css("top", 500);
			 * // immediately let the scene know of this change
			 * scene.refresh();
			 *
			 * @fires {@link Scene.shift}, if the trigger element position or the duration changed
			 * @fires {@link Scene.change}, if the duration changed
			 *
			 * @returns {Scene} Parent object for chaining.
			 */
			this.refresh = function () {
				updateDuration();
				updateTriggerElementPosition();
				// update trigger element position
				return Scene;
			};

			/**
			 * **Get** or **Set** the scene's progress.  
			 * Usually it shouldn't be necessary to use this as a setter, as it is set automatically by scene.update().  
			 * The order in which the events are fired depends on the duration of the scene:
			 *  1. Scenes with `duration == 0`:  
			 *  Scenes that have no duration by definition have no ending. Thus the `end` event will never be fired.  
			 *  When the trigger position of the scene is passed the events are always fired in this order:  
			 *  `enter`, `start`, `progress` when scrolling forward  
			 *  and  
			 *  `progress`, `start`, `leave` when scrolling in reverse
			 *  2. Scenes with `duration > 0`:  
			 *  Scenes with a set duration have a defined start and end point.  
			 *  When scrolling past the start position of the scene it will fire these events in this order:  
			 *  `enter`, `start`, `progress`  
			 *  When continuing to scroll and passing the end point it will fire these events:  
			 *  `progress`, `end`, `leave`  
			 *  When reversing through the end point these events are fired:  
			 *  `enter`, `end`, `progress`  
			 *  And when continuing to scroll past the start position in reverse it will fire:  
			 *  `progress`, `start`, `leave`  
			 *  In between start and end the `progress` event will be called constantly, whenever the progress changes.
			 * 
			 * In short:  
			 * `enter` events will always trigger **before** the progress update and `leave` envents will trigger **after** the progress update.  
			 * `start` and `end` will always trigger at their respective position.
			 * 
			 * Please review the event descriptions for details on the events and the event object that is passed to the callback.
			 * 
			 * @method ScrollMagic.Scene#progress
			 * @example
			 * // get the current scene progress
			 * var progress = scene.progress();
			 *
			 * // set new scene progress
			 * scene.progress(0.3);
			 *
			 * @fires {@link Scene.enter}, when used as setter
			 * @fires {@link Scene.start}, when used as setter
			 * @fires {@link Scene.progress}, when used as setter
			 * @fires {@link Scene.end}, when used as setter
			 * @fires {@link Scene.leave}, when used as setter
			 *
			 * @param {number} [progress] - The new progress value of the scene `[0-1]`.
			 * @returns {number} `get` -  Current scene progress.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */
			this.progress = function (progress) {
				if (!arguments.length) { // get
					return _progress;
				} else { // set
					var
					doUpdate = false,
						oldState = _state,
						scrollDirection = _controller ? _controller.info("scrollDirection") : 'PAUSED',
						reverseOrForward = _options.reverse || progress >= _progress;
					if (_options.duration === 0) {
						// zero duration scenes
						doUpdate = _progress != progress;
						_progress = progress < 1 && reverseOrForward ? 0 : 1;
						_state = _progress === 0 ? SCENE_STATE_BEFORE : SCENE_STATE_DURING;
					} else {
						// scenes with start and end
						if (progress < 0 && _state !== SCENE_STATE_BEFORE && reverseOrForward) {
							// go back to initial state
							_progress = 0;
							_state = SCENE_STATE_BEFORE;
							doUpdate = true;
						} else if (progress >= 0 && progress < 1 && reverseOrForward) {
							_progress = progress;
							_state = SCENE_STATE_DURING;
							doUpdate = true;
						} else if (progress >= 1 && _state !== SCENE_STATE_AFTER) {
							_progress = 1;
							_state = SCENE_STATE_AFTER;
							doUpdate = true;
						} else if (_state === SCENE_STATE_DURING && !reverseOrForward) {
							updatePinState(); // in case we scrolled backwards mid-scene and reverse is disabled => update the pin position, so it doesn't move back as well.
						}
					}
					if (doUpdate) {
						// fire events
						var
						eventVars = {
							progress: _progress,
							state: _state,
							scrollDirection: scrollDirection
						},
							stateChanged = _state != oldState;

						var trigger = function (eventName) { // tmp helper to simplify code
							Scene.trigger(eventName, eventVars);
						};

						if (stateChanged) { // enter events
							if (oldState !== SCENE_STATE_DURING) {
								trigger("enter");
								trigger(oldState === SCENE_STATE_BEFORE ? "start" : "end");
							}
						}
						trigger("progress");
						if (stateChanged) { // leave events
							if (_state !== SCENE_STATE_DURING) {
								trigger(_state === SCENE_STATE_BEFORE ? "start" : "end");
								trigger("leave");
							}
						}
					}

					return Scene;
				}
			};


			/**
			 * Update the start and end scrollOffset of the container.
			 * The positions reflect what the controller's scroll position will be at the start and end respectively.
			 * Is called, when:
			 *   - Scene event "change" is called with: offset, triggerHook, duration 
			 *   - scroll container event "resize" is called
			 *   - the position of the triggerElement changes
			 *   - the controller changes -> addTo()
			 * @private
			 */
			var updateScrollOffset = function () {
				_scrollOffset = {
					start: _triggerPos + _options.offset
				};
				if (_controller && _options.triggerElement) {
					// take away triggerHook portion to get relative to top
					_scrollOffset.start -= _controller.info("size") * _options.triggerHook;
				}
				_scrollOffset.end = _scrollOffset.start + _options.duration;
			};

			/**
			 * Updates the duration if set to a dynamic function.
			 * This method is called when the scene is added to a controller and in regular intervals from the controller through scene.refresh().
			 * 
			 * @fires {@link Scene.change}, if the duration changed
			 * @fires {@link Scene.shift}, if the duration changed
			 *
			 * @param {boolean} [suppressEvents=false] - If true the shift event will be suppressed.
			 * @private
			 */
			var updateDuration = function (suppressEvents) {
				// update duration
				if (_durationUpdateMethod) {
					var varname = "duration";
					if (changeOption(varname, _durationUpdateMethod.call(Scene)) && !suppressEvents) { // set
						Scene.trigger("change", {
							what: varname,
							newval: _options[varname]
						});
						Scene.trigger("shift", {
							reason: varname
						});
					}
				}
			};

			/**
			 * Updates the position of the triggerElement, if present.
			 * This method is called ...
			 *  - ... when the triggerElement is changed
			 *  - ... when the scene is added to a (new) controller
			 *  - ... in regular intervals from the controller through scene.refresh().
			 * 
			 * @fires {@link Scene.shift}, if the position changed
			 *
			 * @param {boolean} [suppressEvents=false] - If true the shift event will be suppressed.
			 * @private
			 */
			var updateTriggerElementPosition = function (suppressEvents) {
				var
				elementPos = 0,
					telem = _options.triggerElement;
				if (_controller && telem) {
					var
					controllerInfo = _controller.info(),
						containerOffset = _util.get.offset(controllerInfo.container),
						// container position is needed because element offset is returned in relation to document, not in relation to container.
						param = controllerInfo.vertical ? "top" : "left"; // which param is of interest ?
					// if parent is spacer, use spacer position instead so correct start position is returned for pinned elements.
					while (telem.parentNode.hasAttribute(PIN_SPACER_ATTRIBUTE)) {
						telem = telem.parentNode;
					}

					var elementOffset = _util.get.offset(telem);

					if (!controllerInfo.isDocument) { // container is not the document root, so substract scroll Position to get correct trigger element position relative to scrollcontent
						containerOffset[param] -= _controller.scrollPos();
					}

					elementPos = elementOffset[param] - containerOffset[param];
				}
				var changed = elementPos != _triggerPos;
				_triggerPos = elementPos;
				if (changed && !suppressEvents) {
					Scene.trigger("shift", {
						reason: "triggerElementPosition"
					});
				}
			};

			/**
			 * Trigger a shift event, when the container is resized and the triggerHook is > 1.
			 * @private
			 */
			var onContainerResize = function (e) {
				if (_options.triggerHook > 0) {
					Scene.trigger("shift", {
						reason: "containerResize"
					});
				}
			};

			var _validate = _util.extend(SCENE_OPTIONS.validate, {
				// validation for duration handled internally for reference to private var _durationMethod
				duration: function (val) {
					if (_util.type.String(val) && val.match(/^(\.|\d)*\d+%$/)) {
						// percentage value
						var perc = parseFloat(val) / 100;
						val = function () {
							return _controller ? _controller.info("size") * perc : 0;
						};
					}
					if (_util.type.Function(val)) {
						// function
						_durationUpdateMethod = val;
						try {
							val = parseFloat(_durationUpdateMethod());
						} catch (e) {
							val = -1; // will cause error below
						}
					}
					// val has to be float
					val = parseFloat(val);
					if (!_util.type.Number(val) || val < 0) {
						if (_durationUpdateMethod) {
							_durationUpdateMethod = undefined;
							throw ["Invalid return value of supplied function for option \"duration\":", val];
						} else {
							throw ["Invalid value for option \"duration\":", val];
						}
					}
					return val;
				}
			});

			/**
			 * Checks the validity of a specific or all options and reset to default if neccessary.
			 * @private
			 */
			var validateOption = function (check) {
				check = arguments.length ? [check] : Object.keys(_validate);
				check.forEach(function (optionName, key) {
					var value;
					if (_validate[optionName]) { // there is a validation method for this option
						try { // validate value
							value = _validate[optionName](_options[optionName]);
						} catch (e) { // validation failed -> reset to default
							value = DEFAULT_OPTIONS[optionName];
							var logMSG = _util.type.String(e) ? [e] : e;
							if (_util.type.Array(logMSG)) {
								logMSG[0] = "ERROR: " + logMSG[0];
								logMSG.unshift(1); // loglevel 1 for error msg
								log.apply(this, logMSG);
							} else {
								log(1, "ERROR: Problem executing validation callback for option '" + optionName + "':", e.message);
							}
						} finally {
							_options[optionName] = value;
						}
					}
				});
			};

			/**
			 * Helper used by the setter/getters for scene options
			 * @private
			 */
			var changeOption = function (varname, newval) {
				var
				changed = false,
					oldval = _options[varname];
				if (_options[varname] != newval) {
					_options[varname] = newval;
					validateOption(varname); // resets to default if necessary
					changed = oldval != _options[varname];
				}
				return changed;
			};

			// generate getters/setters for all options
			var addSceneOption = function (optionName) {
				if (!Scene[optionName]) {
					Scene[optionName] = function (newVal) {
						if (!arguments.length) { // get
							return _options[optionName];
						} else {
							if (optionName === "duration") { // new duration is set, so any previously set function must be unset
								_durationUpdateMethod = undefined;
							}
							if (changeOption(optionName, newVal)) { // set
								Scene.trigger("change", {
									what: optionName,
									newval: _options[optionName]
								});
								if (SCENE_OPTIONS.shifts.indexOf(optionName) > -1) {
									Scene.trigger("shift", {
										reason: optionName
									});
								}
							}
						}
						return Scene;
					};
				}
			};

			/**
			 * **Get** or **Set** the duration option value.
			 * As a setter it also accepts a function returning a numeric value.  
			 * This is particularly useful for responsive setups.
			 *
			 * The duration is updated using the supplied function every time `Scene.refresh()` is called, which happens periodically from the controller (see ScrollMagic.Controller option `refreshInterval`).  
			 * _**NOTE:** Be aware that it's an easy way to kill performance, if you supply a function that has high CPU demand.  
			 * Even for size and position calculations it is recommended to use a variable to cache the value. (see example)  
			 * This counts double if you use the same function for multiple scenes._
			 *
			 * @method ScrollMagic.Scene#duration
			 * @example
			 * // get the current duration value
			 * var duration = scene.duration();
			 *
			 * // set a new duration
			 * scene.duration(300);
			 *
			 * // use a function to automatically adjust the duration to the window height.
			 * var durationValueCache;
			 * function getDuration () {
			 *   return durationValueCache;
			 * }
			 * function updateDuration (e) {
			 *   durationValueCache = window.innerHeight;
			 * }
			 * $(window).on("resize", updateDuration); // update the duration when the window size changes
			 * $(window).triggerHandler("resize"); // set to initial value
			 * scene.duration(getDuration); // supply duration method
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @fires {@link Scene.shift}, when used as setter
			 * @param {(number|function)} [newDuration] - The new duration of the scene.
			 * @returns {number} `get` -  Current scene duration.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** or **Set** the offset option value.
			 * @method ScrollMagic.Scene#offset
			 * @example
			 * // get the current offset
			 * var offset = scene.offset();
			 *
			 * // set a new offset
			 * scene.offset(100);
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @fires {@link Scene.shift}, when used as setter
			 * @param {number} [newOffset] - The new offset of the scene.
			 * @returns {number} `get` -  Current scene offset.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** or **Set** the triggerElement option value.
			 * Does **not** fire `Scene.shift`, because changing the trigger Element doesn't necessarily mean the start position changes. This will be determined in `Scene.refresh()`, which is automatically triggered.
			 * @method ScrollMagic.Scene#triggerElement
			 * @example
			 * // get the current triggerElement
			 * var triggerElement = scene.triggerElement();
			 *
			 * // set a new triggerElement using a selector
			 * scene.triggerElement("#trigger");
			 * // set a new triggerElement using a DOM object
			 * scene.triggerElement(document.getElementById("trigger"));
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @param {(string|object)} [newTriggerElement] - The new trigger element for the scene.
			 * @returns {(string|object)} `get` -  Current triggerElement.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** or **Set** the triggerHook option value.
			 * @method ScrollMagic.Scene#triggerHook
			 * @example
			 * // get the current triggerHook value
			 * var triggerHook = scene.triggerHook();
			 *
			 * // set a new triggerHook using a string
			 * scene.triggerHook("onLeave");
			 * // set a new triggerHook using a number
			 * scene.triggerHook(0.7);
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @fires {@link Scene.shift}, when used as setter
			 * @param {(number|string)} [newTriggerHook] - The new triggerHook of the scene. See {@link Scene} parameter description for value options.
			 * @returns {number} `get` -  Current triggerHook (ALWAYS numerical).
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** or **Set** the reverse option value.
			 * @method ScrollMagic.Scene#reverse
			 * @example
			 * // get the current reverse option
			 * var reverse = scene.reverse();
			 *
			 * // set new reverse option
			 * scene.reverse(false);
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @param {boolean} [newReverse] - The new reverse setting of the scene.
			 * @returns {boolean} `get` -  Current reverse option value.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** or **Set** the loglevel option value.
			 * @method ScrollMagic.Scene#loglevel
			 * @example
			 * // get the current loglevel
			 * var loglevel = scene.loglevel();
			 *
			 * // set new loglevel
			 * scene.loglevel(3);
			 *
			 * @fires {@link Scene.change}, when used as setter
			 * @param {number} [newLoglevel] - The new loglevel setting of the scene. `[0-3]`
			 * @returns {number} `get` -  Current loglevel.
			 * @returns {Scene} `set` -  Parent object for chaining.
			 */

			/**
			 * **Get** the associated controller.
			 * @method ScrollMagic.Scene#controller
			 * @example
			 * // get the controller of a scene
			 * var controller = scene.controller();
			 *
			 * @returns {ScrollMagic.Controller} Parent controller or `undefined`
			 */
			this.controller = function () {
				return _controller;
			};

			/**
			 * **Get** the current state.
			 * @method ScrollMagic.Scene#state
			 * @example
			 * // get the current state
			 * var state = scene.state();
			 *
			 * @returns {string} `"BEFORE"`, `"DURING"` or `"AFTER"`
			 */
			this.state = function () {
				return _state;
			};

			/**
			 * **Get** the current scroll offset for the start of the scene.  
			 * Mind, that the scrollOffset is related to the size of the container, if `triggerHook` is bigger than `0` (or `"onLeave"`).  
			 * This means, that resizing the container or changing the `triggerHook` will influence the scene's start offset.
			 * @method ScrollMagic.Scene#scrollOffset
			 * @example
			 * // get the current scroll offset for the start and end of the scene.
			 * var start = scene.scrollOffset();
			 * var end = scene.scrollOffset() + scene.duration();
			 * console.log("the scene starts at", start, "and ends at", end);
			 *
			 * @returns {number} The scroll offset (of the container) at which the scene will trigger. Y value for vertical and X value for horizontal scrolls.
			 */
			this.scrollOffset = function () {
				return _scrollOffset.start;
			};

			/**
			 * **Get** the trigger position of the scene (including the value of the `offset` option).  
			 * @method ScrollMagic.Scene#triggerPosition
			 * @example
			 * // get the scene's trigger position
			 * var triggerPosition = scene.triggerPosition();
			 *
			 * @returns {number} Start position of the scene. Top position value for vertical and left position value for horizontal scrolls.
			 */
			this.triggerPosition = function () {
				var pos = _options.offset; // the offset is the basis
				if (_controller) {
					// get the trigger position
					if (_options.triggerElement) {
						// Element as trigger
						pos += _triggerPos;
					} else {
						// return the height of the triggerHook to start at the beginning
						pos += _controller.info("size") * Scene.triggerHook();
					}
				}
				return pos;
			};

			var
			_pin, _pinOptions;

			Scene.on("shift.internal", function (e) {
				var durationChanged = e.reason === "duration";
				if ((_state === SCENE_STATE_AFTER && durationChanged) || (_state === SCENE_STATE_DURING && _options.duration === 0)) {
					// if [duration changed after a scene (inside scene progress updates pin position)] or [duration is 0, we are in pin phase and some other value changed].
					updatePinState();
				}
				if (durationChanged) {
					updatePinDimensions();
				}
			}).on("progress.internal", function (e) {
				updatePinState();
			}).on("add.internal", function (e) {
				updatePinDimensions();
			}).on("destroy.internal", function (e) {
				Scene.removePin(e.reset);
			});
			/**
			 * Update the pin state.
			 * @private
			 */
			var updatePinState = function (forceUnpin) {
				if (_pin && _controller) {
					var
					containerInfo = _controller.info(),
						pinTarget = _pinOptions.spacer.firstChild; // may be pin element or another spacer, if cascading pins
					if (!forceUnpin && _state === SCENE_STATE_DURING) { // during scene or if duration is 0 and we are past the trigger
						// pinned state
						if (_util.css(pinTarget, "position") != "fixed") {
							// change state before updating pin spacer (position changes due to fixed collapsing might occur.)
							_util.css(pinTarget, {
								"position": "fixed"
							});
							// update pin spacer
							updatePinDimensions();
						}

						var
						fixedPos = _util.get.offset(_pinOptions.spacer, true),
							// get viewport position of spacer
							scrollDistance = _options.reverse || _options.duration === 0 ? containerInfo.scrollPos - _scrollOffset.start // quicker
							: Math.round(_progress * _options.duration * 10) / 10; // if no reverse and during pin the position needs to be recalculated using the progress
						// add scrollDistance
						fixedPos[containerInfo.vertical ? "top" : "left"] += scrollDistance;

						// set new values
						_util.css(_pinOptions.spacer.firstChild, {
							top: fixedPos.top,
							left: fixedPos.left
						});
					} else {
						// unpinned state
						var
						newCSS = {
							position: _pinOptions.inFlow ? "relative" : "absolute",
							top: 0,
							left: 0
						},
							change = _util.css(pinTarget, "position") != newCSS.position;

						if (!_pinOptions.pushFollowers) {
							newCSS[containerInfo.vertical ? "top" : "left"] = _options.duration * _progress;
						} else if (_options.duration > 0) { // only concerns scenes with duration
							if (_state === SCENE_STATE_AFTER && parseFloat(_util.css(_pinOptions.spacer, "padding-top")) === 0) {
								change = true; // if in after state but havent updated spacer yet (jumped past pin)
							} else if (_state === SCENE_STATE_BEFORE && parseFloat(_util.css(_pinOptions.spacer, "padding-bottom")) === 0) { // before
								change = true; // jumped past fixed state upward direction
							}
						}
						// set new values
						_util.css(pinTarget, newCSS);
						if (change) {
							// update pin spacer if state changed
							updatePinDimensions();
						}
					}
				}
			};

			/**
			 * Update the pin spacer and/or element size.
			 * The size of the spacer needs to be updated whenever the duration of the scene changes, if it is to push down following elements.
			 * @private
			 */
			var updatePinDimensions = function () {
				if (_pin && _controller && _pinOptions.inFlow) { // no spacerresize, if original position is absolute
					var
					after = (_state === SCENE_STATE_AFTER),
						before = (_state === SCENE_STATE_BEFORE),
						during = (_state === SCENE_STATE_DURING),
						vertical = _controller.info("vertical"),
						pinTarget = _pinOptions.spacer.firstChild,
						// usually the pined element but can also be another spacer (cascaded pins)
						marginCollapse = _util.isMarginCollapseType(_util.css(_pinOptions.spacer, "display")),
						css = {};

					// set new size
					// if relsize: spacer -> pin | else: pin -> spacer
					if (_pinOptions.relSize.width || _pinOptions.relSize.autoFullWidth) {
						if (during) {
							_util.css(_pin, {
								"width": _util.get.width(_pinOptions.spacer)
							});
						} else {
							_util.css(_pin, {
								"width": "100%"
							});
						}
					} else {
						// minwidth is needed for cascaded pins.
						css["min-width"] = _util.get.width(vertical ? _pin : pinTarget, true, true);
						css.width = during ? css["min-width"] : "auto";
					}
					if (_pinOptions.relSize.height) {
						if (during) {
							// the only padding the spacer should ever include is the duration (if pushFollowers = true), so we need to substract that.
							_util.css(_pin, {
								"height": _util.get.height(_pinOptions.spacer) - (_pinOptions.pushFollowers ? _options.duration : 0)
							});
						} else {
							_util.css(_pin, {
								"height": "100%"
							});
						}
					} else {
						// margin is only included if it's a cascaded pin to resolve an IE9 bug
						css["min-height"] = _util.get.height(vertical ? pinTarget : _pin, true, !marginCollapse); // needed for cascading pins
						css.height = during ? css["min-height"] : "auto";
					}

					// add space for duration if pushFollowers is true
					if (_pinOptions.pushFollowers) {
						css["padding" + (vertical ? "Top" : "Left")] = _options.duration * _progress;
						css["padding" + (vertical ? "Bottom" : "Right")] = _options.duration * (1 - _progress);
					}
					_util.css(_pinOptions.spacer, css);
				}
			};

			/**
			 * Updates the Pin state (in certain scenarios)
			 * If the controller container is not the document and we are mid-pin-phase scrolling or resizing the main document can result to wrong pin positions.
			 * So this function is called on resize and scroll of the document.
			 * @private
			 */
			var updatePinInContainer = function () {
				if (_controller && _pin && _state === SCENE_STATE_DURING && !_controller.info("isDocument")) {
					updatePinState();
				}
			};

			/**
			 * Updates the Pin spacer size state (in certain scenarios)
			 * If container is resized during pin and relatively sized the size of the pin might need to be updated...
			 * So this function is called on resize of the container.
			 * @private
			 */
			var updateRelativePinSpacer = function () {
				if (_controller && _pin && // well, duh
				_state === SCENE_STATE_DURING && // element in pinned state?
				( // is width or height relatively sized, but not in relation to body? then we need to recalc.
				((_pinOptions.relSize.width || _pinOptions.relSize.autoFullWidth) && _util.get.width(window) != _util.get.width(_pinOptions.spacer.parentNode)) || (_pinOptions.relSize.height && _util.get.height(window) != _util.get.height(_pinOptions.spacer.parentNode)))) {
					updatePinDimensions();
				}
			};

			/**
			 * Is called, when the mousewhel is used while over a pinned element inside a div container.
			 * If the scene is in fixed state scroll events would be counted towards the body. This forwards the event to the scroll container.
			 * @private
			 */
			var onMousewheelOverPin = function (e) {
				if (_controller && _pin && _state === SCENE_STATE_DURING && !_controller.info("isDocument")) { // in pin state
					e.preventDefault();
					_controller._setScrollPos(_controller.info("scrollPos") - ((e.wheelDelta || e[_controller.info("vertical") ? "wheelDeltaY" : "wheelDeltaX"]) / 3 || -e.detail * 30));
				}
			};

			/**
			 * Pin an element for the duration of the tween.  
			 * If the scene duration is 0 the element will only be unpinned, if the user scrolls back past the start position.  
			 * Make sure only one pin is applied to an element at the same time.
			 * An element can be pinned multiple times, but only successively.
			 * _**NOTE:** The option `pushFollowers` has no effect, when the scene duration is 0._
			 * @method ScrollMagic.Scene#setPin
			 * @example
			 * // pin element and push all following elements down by the amount of the pin duration.
			 * scene.setPin("#pin");
			 *
			 * // pin element and keeping all following elements in their place. The pinned element will move past them.
			 * scene.setPin("#pin", {pushFollowers: false});
			 *
			 * @param {(string|object)} element - A Selector targeting an element or a DOM object that is supposed to be pinned.
			 * @param {object} [settings] - settings for the pin
			 * @param {boolean} [settings.pushFollowers=true] - If `true` following elements will be "pushed" down for the duration of the pin, if `false` the pinned element will just scroll past them.  
			 Ignored, when duration is `0`.
			 * @param {string} [settings.spacerClass="scrollmagic-pin-spacer"] - Classname of the pin spacer element, which is used to replace the element.
			 *
			 * @returns {Scene} Parent object for chaining.
			 */
			this.setPin = function (element, settings) {
				var
				defaultSettings = {
					pushFollowers: true,
					spacerClass: "scrollmagic-pin-spacer"
				};
				settings = _util.extend({}, defaultSettings, settings);

				// validate Element
				element = _util.get.elements(element)[0];
				if (!element) {
					log(1, "ERROR calling method 'setPin()': Invalid pin element supplied.");
					return Scene; // cancel
				} else if (_util.css(element, "position") === "fixed") {
					log(1, "ERROR calling method 'setPin()': Pin does not work with elements that are positioned 'fixed'.");
					return Scene; // cancel
				}

				if (_pin) { // preexisting pin?
					if (_pin === element) {
						// same pin we already have -> do nothing
						return Scene; // cancel
					} else {
						// kill old pin
						Scene.removePin();
					}

				}
				_pin = element;

				var
				parentDisplay = _pin.parentNode.style.display,
					boundsParams = ["top", "left", "bottom", "right", "margin", "marginLeft", "marginRight", "marginTop", "marginBottom"];

				_pin.parentNode.style.display = 'none'; // hack start to force css to return stylesheet values instead of calculated px values.
				var
				inFlow = _util.css(_pin, "position") != "absolute",
					pinCSS = _util.css(_pin, boundsParams.concat(["display"])),
					sizeCSS = _util.css(_pin, ["width", "height"]);
				_pin.parentNode.style.display = parentDisplay; // hack end.
				if (!inFlow && settings.pushFollowers) {
					log(2, "WARNING: If the pinned element is positioned absolutely pushFollowers will be disabled.");
					settings.pushFollowers = false;
				}
				window.setTimeout(function () { // wait until all finished, because with responsive duration it will only be set after scene is added to controller
					if (_pin && _options.duration === 0 && settings.pushFollowers) {
						log(2, "WARNING: pushFollowers =", true, "has no effect, when scene duration is 0.");
					}
				}, 0);

				// create spacer and insert
				var
				spacer = _pin.parentNode.insertBefore(document.createElement('div'), _pin),
					spacerCSS = _util.extend(pinCSS, {
						position: inFlow ? "relative" : "absolute",
						boxSizing: "content-box",
						mozBoxSizing: "content-box",
						webkitBoxSizing: "content-box"
					});

				if (!inFlow) { // copy size if positioned absolutely, to work for bottom/right positioned elements.
					_util.extend(spacerCSS, _util.css(_pin, ["width", "height"]));
				}

				_util.css(spacer, spacerCSS);
				spacer.setAttribute(PIN_SPACER_ATTRIBUTE, "");
				_util.addClass(spacer, settings.spacerClass);

				// set the pin Options
				_pinOptions = {
					spacer: spacer,
					relSize: { // save if size is defined using % values. if so, handle spacer resize differently...
						width: sizeCSS.width.slice(-1) === "%",
						height: sizeCSS.height.slice(-1) === "%",
						autoFullWidth: sizeCSS.width === "auto" && inFlow && _util.isMarginCollapseType(pinCSS.display)
					},
					pushFollowers: settings.pushFollowers,
					inFlow: inFlow,
					// stores if the element takes up space in the document flow
				};

				if (!_pin.___origStyle) {
					_pin.___origStyle = {};
					var
					pinInlineCSS = _pin.style,
						copyStyles = boundsParams.concat(["width", "height", "position", "boxSizing", "mozBoxSizing", "webkitBoxSizing"]);
					copyStyles.forEach(function (val) {
						_pin.___origStyle[val] = pinInlineCSS[val] || "";
					});
				}

				// if relative size, transfer it to spacer and make pin calculate it...
				if (_pinOptions.relSize.width) {
					_util.css(spacer, {
						width: sizeCSS.width
					});
				}
				if (_pinOptions.relSize.height) {
					_util.css(spacer, {
						height: sizeCSS.height
					});
				}

				// now place the pin element inside the spacer	
				spacer.appendChild(_pin);
				// and set new css
				_util.css(_pin, {
					position: inFlow ? "relative" : "absolute",
					margin: "auto",
					top: "auto",
					left: "auto",
					bottom: "auto",
					right: "auto"
				});

				if (_pinOptions.relSize.width || _pinOptions.relSize.autoFullWidth) {
					_util.css(_pin, {
						boxSizing: "border-box",
						mozBoxSizing: "border-box",
						webkitBoxSizing: "border-box"
					});
				}

				// add listener to document to update pin position in case controller is not the document.
				window.addEventListener('scroll', updatePinInContainer);
				window.addEventListener('resize', updatePinInContainer);
				window.addEventListener('resize', updateRelativePinSpacer);
				// add mousewheel listener to catch scrolls over fixed elements
				_pin.addEventListener("mousewheel", onMousewheelOverPin);
				_pin.addEventListener("DOMMouseScroll", onMousewheelOverPin);

				log(3, "added pin");

				// finally update the pin to init
				updatePinState();

				return Scene;
			};

			/**
			 * Remove the pin from the scene.
			 * @method ScrollMagic.Scene#removePin
			 * @example
			 * // remove the pin from the scene without resetting it (the spacer is not removed)
			 * scene.removePin();
			 *
			 * // remove the pin from the scene and reset the pin element to its initial position (spacer is removed)
			 * scene.removePin(true);
			 *
			 * @param {boolean} [reset=false] - If `false` the spacer will not be removed and the element's position will not be reset.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.removePin = function (reset) {
				if (_pin) {
					if (_state === SCENE_STATE_DURING) {
						updatePinState(true); // force unpin at position
					}
					if (reset || !_controller) { // if there's no controller no progress was made anyway...
						var pinTarget = _pinOptions.spacer.firstChild; // usually the pin element, but may be another spacer (cascaded pins)...
						if (pinTarget.hasAttribute(PIN_SPACER_ATTRIBUTE)) { // copy margins to child spacer
							var
							style = _pinOptions.spacer.style,
								values = ["margin", "marginLeft", "marginRight", "marginTop", "marginBottom"];
							margins = {};
							values.forEach(function (val) {
								margins[val] = style[val] || "";
							});
							_util.css(pinTarget, margins);
						}
						_pinOptions.spacer.parentNode.insertBefore(pinTarget, _pinOptions.spacer);
						_pinOptions.spacer.parentNode.removeChild(_pinOptions.spacer);
						if (!_pin.parentNode.hasAttribute(PIN_SPACER_ATTRIBUTE)) { // if it's the last pin for this element -> restore inline styles
							// TODO: only correctly set for first pin (when cascading) - how to fix?
							_util.css(_pin, _pin.___origStyle);
							delete _pin.___origStyle;
						}
					}
					window.removeEventListener('scroll', updatePinInContainer);
					window.removeEventListener('resize', updatePinInContainer);
					window.removeEventListener('resize', updateRelativePinSpacer);
					_pin.removeEventListener("mousewheel", onMousewheelOverPin);
					_pin.removeEventListener("DOMMouseScroll", onMousewheelOverPin);
					_pin = undefined;
					log(3, "removed pin (reset: " + (reset ? "true" : "false") + ")");
				}
				return Scene;
			};


			var
			_cssClasses, _cssClassElems = [];

			Scene.on("destroy.internal", function (e) {
				Scene.removeClassToggle(e.reset);
			});
			/**
			 * Define a css class modification while the scene is active.  
			 * When the scene triggers the classes will be added to the supplied element and removed, when the scene is over.
			 * If the scene duration is 0 the classes will only be removed if the user scrolls back past the start position.
			 * @method ScrollMagic.Scene#setClassToggle
			 * @example
			 * // add the class 'myclass' to the element with the id 'my-elem' for the duration of the scene
			 * scene.setClassToggle("#my-elem", "myclass");
			 *
			 * // add multiple classes to multiple elements defined by the selector '.classChange'
			 * scene.setClassToggle(".classChange", "class1 class2 class3");
			 *
			 * @param {(string|object)} element - A Selector targeting one or more elements or a DOM object that is supposed to be modified.
			 * @param {string} classes - One or more Classnames (separated by space) that should be added to the element during the scene.
			 *
			 * @returns {Scene} Parent object for chaining.
			 */
			this.setClassToggle = function (element, classes) {
				var elems = _util.get.elements(element);
				if (elems.length === 0 || !_util.type.String(classes)) {
					log(1, "ERROR calling method 'setClassToggle()': Invalid " + (elems.length === 0 ? "element" : "classes") + " supplied.");
					return Scene;
				}
				if (_cssClassElems.length > 0) {
					// remove old ones
					Scene.removeClassToggle();
				}
				_cssClasses = classes;
				_cssClassElems = elems;
				Scene.on("enter.internal_class leave.internal_class", function (e) {
					var toggle = e.type === "enter" ? _util.addClass : _util.removeClass;
					_cssClassElems.forEach(function (elem, key) {
						toggle(elem, _cssClasses);
					});
				});
				return Scene;
			};

			/**
			 * Remove the class binding from the scene.
			 * @method ScrollMagic.Scene#removeClassToggle
			 * @example
			 * // remove class binding from the scene without reset
			 * scene.removeClassToggle();
			 *
			 * // remove class binding and remove the changes it caused
			 * scene.removeClassToggle(true);
			 *
			 * @param {boolean} [reset=false] - If `false` and the classes are currently active, they will remain on the element. If `true` they will be removed.
			 * @returns {Scene} Parent object for chaining.
			 */
			this.removeClassToggle = function (reset) {
				if (reset) {
					_cssClassElems.forEach(function (elem, key) {
						_util.removeClass(elem, _cssClasses);
					});
				}
				Scene.off("start.internal_class end.internal_class");
				_cssClasses = undefined;
				_cssClassElems = [];
				return Scene;
			};

			// INIT
			construct();
			return Scene;
		};

		// store pagewide scene options
		var SCENE_OPTIONS = {
			defaults: {
				duration: 0,
				offset: 0,
				triggerElement: undefined,
				triggerHook: 0.5,
				reverse: true,
				loglevel: 2
			},
			validate: {
				offset: function (val) {
					val = parseFloat(val);
					if (!_util.type.Number(val)) {
						throw ["Invalid value for option \"offset\":", val];
					}
					return val;
				},
				triggerElement: function (val) {
					val = val || undefined;
					if (val) {
						var elem = _util.get.elements(val)[0];
						if (elem) {
							val = elem;
						} else {
							throw ["Element defined in option \"triggerElement\" was not found:", val];
						}
					}
					return val;
				},
				triggerHook: function (val) {
					var translate = {
						"onCenter": 0.5,
						"onEnter": 1,
						"onLeave": 0
					};
					if (_util.type.Number(val)) {
						val = Math.max(0, Math.min(parseFloat(val), 1)); //  make sure its betweeen 0 and 1
					} else if (val in translate) {
						val = translate[val];
					} else {
						throw ["Invalid value for option \"triggerHook\": ", val];
					}
					return val;
				},
				reverse: function (val) {
					return !!val; // force boolean
				},
				loglevel: function (val) {
					val = parseInt(val);
					if (!_util.type.Number(val) || val < 0 || val > 3) {
						throw ["Invalid value for option \"loglevel\":", val];
					}
					return val;
				}
			},
			// holder for  validation methods. duration validation is handled in 'getters-setters.js'
			shifts: ["duration", "offset", "triggerHook"],
			// list of options that trigger a `shift` event
		};
	/*
	 * method used to add an option to ScrollMagic Scenes.
	 * TODO: DOC (private for dev)
	 */
		ScrollMagic.Scene.addOption = function (name, defaultValue, validationCallback, shifts) {
			if (!(name in SCENE_OPTIONS.defaults)) {
				SCENE_OPTIONS.defaults[name] = defaultValue;
				SCENE_OPTIONS.validate[name] = validationCallback;
				if (shifts) {
					SCENE_OPTIONS.shifts.push(name);
				}
			} else {
				ScrollMagic._util.log(1, "[static] ScrollMagic.Scene -> Cannot add Scene option '" + name + "', because it already exists.");
			}
		};
		// instance extension function for plugins
		// TODO: DOC (private for dev)
		ScrollMagic.Scene.extend = function (extension) {
			var oldClass = this;
			ScrollMagic.Scene = function () {
				oldClass.apply(this, arguments);
				this.$super = _util.extend({}, this); // copy parent state
				return extension.apply(this, arguments) || this;
			};
			_util.extend(ScrollMagic.Scene, oldClass); // copy properties
			ScrollMagic.Scene.prototype = oldClass.prototype; // copy prototype
			ScrollMagic.Scene.prototype.constructor = ScrollMagic.Scene; // restore constructor
		};


		/**
		 * TODO: DOCS (private for dev)
		 * @class
		 * @private
		 */

		ScrollMagic.Event = function (type, namespace, target, vars) {
			vars = vars || {};
			for (var key in vars) {
				this[key] = vars[key];
			}
			this.type = type;
			this.target = this.currentTarget = target;
			this.namespace = namespace || '';
			this.timeStamp = this.timestamp = Date.now();
			return this;
		};

	/*
	 * TODO: DOCS (private for dev)
	 */

		var _util = ScrollMagic._util = (function (window) {
			var U = {},
				i;

			/**
			 * ------------------------------
			 * internal helpers
			 * ------------------------------
			 */

			// parse float and fall back to 0.
			var floatval = function (number) {
				return parseFloat(number) || 0;
			};
			// get current style IE safe (otherwise IE would return calculated values for 'auto')
			var _getComputedStyle = function (elem) {
				return elem.currentStyle ? elem.currentStyle : window.getComputedStyle(elem);
			};

			// get element dimension (width or height)
			var _dimension = function (which, elem, outer, includeMargin) {
				elem = (elem === document) ? window : elem;
				if (elem === window) {
					includeMargin = false;
				} else if (!_type.DomElement(elem)) {
					return 0;
				}
				which = which.charAt(0).toUpperCase() + which.substr(1).toLowerCase();
				var dimension = (outer ? elem['offset' + which] || elem['outer' + which] : elem['client' + which] || elem['inner' + which]) || 0;
				if (outer && includeMargin) {
					var style = _getComputedStyle(elem);
					dimension += which === 'Height' ? floatval(style.marginTop) + floatval(style.marginBottom) : floatval(style.marginLeft) + floatval(style.marginRight);
				}
				return dimension;
			};
			// converts 'margin-top' into 'marginTop'
			var _camelCase = function (str) {
				return str.replace(/^[^a-z]+([a-z])/g, '$1').replace(/-([a-z])/g, function (g) {
					return g[1].toUpperCase();
				});
			};

			/**
			 * ------------------------------
			 * external helpers
			 * ------------------------------
			 */

			// extend obj – same as jQuery.extend({}, objA, objB)
			U.extend = function (obj) {
				obj = obj || {};
				for (i = 1; i < arguments.length; i++) {
					if (!arguments[i]) {
						continue;
					}
					for (var key in arguments[i]) {
						if (arguments[i].hasOwnProperty(key)) {
							obj[key] = arguments[i][key];
						}
					}
				}
				return obj;
			};

			// check if a css display type results in margin-collapse or not
			U.isMarginCollapseType = function (str) {
				return ["block", "flex", "list-item", "table", "-webkit-box"].indexOf(str) > -1;
			};

			// implementation of requestAnimationFrame
			// based on https://gist.github.com/paulirish/1579671
			var
			lastTime = 0,
				vendors = ['ms', 'moz', 'webkit', 'o'];
			var _requestAnimationFrame = window.requestAnimationFrame;
			var _cancelAnimationFrame = window.cancelAnimationFrame;
			// try vendor prefixes if the above doesn't work
			for (i = 0; !_requestAnimationFrame && i < vendors.length; ++i) {
				_requestAnimationFrame = window[vendors[i] + 'RequestAnimationFrame'];
				_cancelAnimationFrame = window[vendors[i] + 'CancelAnimationFrame'] || window[vendors[i] + 'CancelRequestAnimationFrame'];
			}

			// fallbacks
			if (!_requestAnimationFrame) {
				_requestAnimationFrame = function (callback) {
					var
					currTime = new Date().getTime(),
						timeToCall = Math.max(0, 16 - (currTime - lastTime)),
						id = window.setTimeout(function () {
							callback(currTime + timeToCall);
						}, timeToCall);
					lastTime = currTime + timeToCall;
					return id;
				};
			}
			if (!_cancelAnimationFrame) {
				_cancelAnimationFrame = function (id) {
					window.clearTimeout(id);
				};
			}
			U.rAF = _requestAnimationFrame.bind(window);
			U.cAF = _cancelAnimationFrame.bind(window);

			var
			loglevels = ["error", "warn", "log"],
				console = window.console || {};

			console.log = console.log ||
			function () {}; // no console log, well - do nothing then...
			// make sure methods for all levels exist.
			for (i = 0; i < loglevels.length; i++) {
				var method = loglevels[i];
				if (!console[method]) {
					console[method] = console.log; // prefer .log over nothing
				}
			}
			U.log = function (loglevel) {
				if (loglevel > loglevels.length || loglevel <= 0) loglevel = loglevels.length;
				var now = new Date(),
					time = ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) + ":" + ("0" + now.getSeconds()).slice(-2) + ":" + ("00" + now.getMilliseconds()).slice(-3),
					method = loglevels[loglevel - 1],
					args = Array.prototype.splice.call(arguments, 1),
					func = Function.prototype.bind.call(console[method], console);
				args.unshift(time);
				func.apply(console, args);
			};

			/**
			 * ------------------------------
			 * type testing
			 * ------------------------------
			 */

			var _type = U.type = function (v) {
				return Object.prototype.toString.call(v).replace(/^\[object (.+)\]$/, "$1").toLowerCase();
			};
			_type.String = function (v) {
				return _type(v) === 'string';
			};
			_type.Function = function (v) {
				return _type(v) === 'function';
			};
			_type.Array = function (v) {
				return Array.isArray(v);
			};
			_type.Number = function (v) {
				return !_type.Array(v) && (v - parseFloat(v) + 1) >= 0;
			};
			_type.DomElement = function (o) {
				return (
				typeof HTMLElement === "object" ? o instanceof HTMLElement : //DOM2
				o && typeof o === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string");
			};

			/**
			 * ------------------------------
			 * DOM Element info
			 * ------------------------------
			 */
			// always returns a list of matching DOM elements, from a selector, a DOM element or an list of elements or even an array of selectors
			var _get = U.get = {};
			_get.elements = function (selector) {
				var arr = [];
				if (_type.String(selector)) {
					try {
						selector = document.querySelectorAll(selector);
					} catch (e) { // invalid selector
						return arr;
					}
				}
				if (_type(selector) === 'nodelist' || _type.Array(selector)) {
					for (var i = 0, ref = arr.length = selector.length; i < ref; i++) { // list of elements
						var elem = selector[i];
						arr[i] = _type.DomElement(elem) ? elem : _get.elements(elem); // if not an element, try to resolve recursively
					}
				} else if (_type.DomElement(selector) || selector === document || selector === window) {
					arr = [selector]; // only the element
				}
				return arr;
			};
			// get scroll top value
			_get.scrollTop = function (elem) {
				return (elem && typeof elem.scrollTop === 'number') ? elem.scrollTop : window.pageYOffset || 0;
			};
			// get scroll left value
			_get.scrollLeft = function (elem) {
				return (elem && typeof elem.scrollLeft === 'number') ? elem.scrollLeft : window.pageXOffset || 0;
			};
			// get element height
			_get.width = function (elem, outer, includeMargin) {
				return _dimension('width', elem, outer, includeMargin);
			};
			// get element width
			_get.height = function (elem, outer, includeMargin) {
				return _dimension('height', elem, outer, includeMargin);
			};

			// get element position (optionally relative to viewport)
			_get.offset = function (elem, relativeToViewport) {
				var offset = {
					top: 0,
					left: 0
				};
				if (elem && elem.getBoundingClientRect) { // check if available
					var rect = elem.getBoundingClientRect();
					offset.top = rect.top;
					offset.left = rect.left;
					if (!relativeToViewport) { // clientRect is by default relative to viewport...
						offset.top += _get.scrollTop();
						offset.left += _get.scrollLeft();
					}
				}
				return offset;
			};

			/**
			 * ------------------------------
			 * DOM Element manipulation
			 * ------------------------------
			 */

			U.addClass = function (elem, classname) {
				if (classname) {
					if (elem.classList) elem.classList.add(classname);
					else elem.className += ' ' + classname;
				}
			};
			U.removeClass = function (elem, classname) {
				if (classname) {
					if (elem.classList) elem.classList.remove(classname);
					else elem.className = elem.className.replace(new RegExp('(^|\\b)' + classname.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
				}
			};
			// if options is string -> returns css value
			// if options is array -> returns object with css value pairs
			// if options is object -> set new css values
			U.css = function (elem, options) {
				if (_type.String(options)) {
					return _getComputedStyle(elem)[_camelCase(options)];
				} else if (_type.Array(options)) {
					var
					obj = {},
						style = _getComputedStyle(elem);
					options.forEach(function (option, key) {
						obj[option] = style[_camelCase(option)];
					});
					return obj;
				} else {
					for (var option in options) {
						var val = options[option];
						if (val == parseFloat(val)) { // assume pixel for seemingly numerical values
							val += 'px';
						}
						elem.style[_camelCase(option)] = val;
					}
				}
			};

			return U;
		}(window || {}));

		ScrollMagic.Scene.prototype.addIndicators = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling addIndicators() due to missing Plugin \'debug.addIndicators\'. Please make sure to include plugins/debug.addIndicators.js');
			return this;
		}
		ScrollMagic.Scene.prototype.removeIndicators = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling removeIndicators() due to missing Plugin \'debug.addIndicators\'. Please make sure to include plugins/debug.addIndicators.js');
			return this;
		}
		ScrollMagic.Scene.prototype.setTween = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling setTween() due to missing Plugin \'animation.gsap\'. Please make sure to include plugins/animation.gsap.js');
			return this;
		}
		ScrollMagic.Scene.prototype.removeTween = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling removeTween() due to missing Plugin \'animation.gsap\'. Please make sure to include plugins/animation.gsap.js');
			return this;
		}
		ScrollMagic.Scene.prototype.setVelocity = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling setVelocity() due to missing Plugin \'animation.velocity\'. Please make sure to include plugins/animation.velocity.js');
			return this;
		}
		ScrollMagic.Scene.prototype.removeVelocity = function () {
			ScrollMagic._util.log(1, '(ScrollMagic.Scene) -> ERROR calling removeVelocity() due to missing Plugin \'animation.velocity\'. Please make sure to include plugins/animation.velocity.js');
			return this;
		}

		return ScrollMagic;
	}));

/***/ },

/***/ 534:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * ScrollMagic v2.0.5 (2015-04-29)
	 * The javascript library for magical scroll interactions.
	 * (c) 2015 Jan Paepke (@janpaepke)
	 * Project Website: http://scrollmagic.io
	 * 
	 * @version 2.0.5
	 * @license Dual licensed under MIT license and GPL.
	 * @author Jan Paepke - e-mail@janpaepke.de
	 *
	 * @file ScrollMagic Velocity Animation Plugin.
	 *
	 * requires: velocity ~1.2
	 * Powered by VelocityJS: http://VelocityJS.org
	 * Velocity is published under MIT license.
	 */
	/**
	 * This plugin is meant to be used in conjunction with the Velocity animation framework.  
	 * It offers an easy API to __trigger__ Velocity animations.
	 *
	 * With the current version of Velocity scrollbound animations (scenes with duration) are not supported.  
	 * This feature will be added as soon as Velocity provides the appropriate API.
	 * 
	 * To have access to this extension, please include `plugins/animation.velocity.js`.
	 * @requires {@link http://julian.com/research/velocity/|Velocity ~1.2.0}
	 * @mixin animation.Velocity
	 */
	(function (root, factory) {
		if (true) {
			// AMD. Register as an anonymous module.
			!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(533), __webpack_require__(528)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		} else if (typeof exports === 'object') {
			// CommonJS
			factory(require('scrollmagic'), require('velocity'));
		} else {
			// Browser globals
			factory(root.ScrollMagic || (root.jQuery && root.jQuery.ScrollMagic), root.Velocity || (root.jQuery && root.jQuery.Velocity));
		}
	}(this, function (ScrollMagic, velocity) {
		"use strict";
		var NAMESPACE = "animation.velocity";

		var
		console = window.console || {},
			err = Function.prototype.bind.call(console.error || console.log ||
			function () {}, console);
		if (!ScrollMagic) {
			err("(" + NAMESPACE + ") -> ERROR: The ScrollMagic main module could not be found. Please make sure it's loaded before this plugin or use an asynchronous loader like requirejs.");
		}
		if (!velocity) {
			err("(" + NAMESPACE + ") -> ERROR: Velocity could not be found. Please make sure it's loaded before ScrollMagic or use an asynchronous loader like requirejs.");
		}

		var autoindex = 0;

		ScrollMagic.Scene.extend(function () {
			var
			Scene = this,
				_util = ScrollMagic._util,
				_currentProgress = 0,
				_elems, _properties, _options, _dataID; // used to identify element data related to this scene, will be defined everytime a new velocity animation is added
			var log = function () {
				if (Scene._log) { // not available, when main source minified
					Array.prototype.splice.call(arguments, 1, 0, "(" + NAMESPACE + ")", "->");
					Scene._log.apply(this, arguments);
				}
			};

			// set listeners
			Scene.on("progress.plugin_velocity", function () {
				updateAnimationProgress();
			});
			Scene.on("destroy.plugin_velocity", function (e) {
				Scene.off("*.plugin_velocity");
				Scene.removeVelocity(e.reset);
			});

			var animate = function (elem, properties, options) {
				if (_util.type.Array(elem)) {
					elem.forEach(function (elem) {
						animate(elem, properties, options);
					});
				} else {
					// set reverse values
					if (!velocity.Utilities.data(elem, _dataID)) {
						velocity.Utilities.data(elem, _dataID, {
							reverseProps: _util.css(elem, Object.keys(_properties))
						});
					}
					// animate
					velocity(elem, properties, options);
					if (options.queue !== undefined) {
						velocity.Utilities.dequeue(elem, options.queue);
					}
				}
			};
			var reverse = function (elem, options) {
				if (_util.type.Array(elem)) {
					elem.forEach(function (elem) {
						reverse(elem, options);
					});
				} else {
					var data = velocity.Utilities.data(elem, _dataID);
					if (data && data.reverseProps) {
						velocity(elem, data.reverseProps, options);
						if (options.queue !== undefined) {
							velocity.Utilities.dequeue(elem, options.queue);
						}
					}
				}
			};

			/**
			 * Update the tween progress to current position.
			 * @private
			 */
			var updateAnimationProgress = function () {
				if (_elems) {
					var progress = Scene.progress();
					if (progress != _currentProgress) { // do we even need to update the progress?
						if (Scene.duration() === 0) {
							// play the animation
							if (progress > 0) { // play forward
								animate(_elems, _properties, _options);
							} else { // play reverse
								reverse(_elems, _options);
								// velocity(_elems, _propertiesReverse, _options);
								// velocity("reverse");
							}
						} else {
							// TODO: Scrollbound animations not supported yet...
						}
						_currentProgress = progress;
					}
				}
			};

			/**
			 * Add a Velocity animation to the scene.  
			 * The method accepts the same parameters as Velocity, with the first parameter being the target element.
			 *
			 * To gain better understanding, check out the [Velocity example](../examples/basic/simple_velocity.html).
			 * @memberof! animation.Velocity#
			 *
			 * @example
			 * // trigger a Velocity animation
			 * scene.setVelocity("#myElement", {opacity: 0.5}, {duration: 1000, easing: "linear"});
			 *
			 * @param {(object|string)} elems - One or more Dom Elements or a Selector that should be used as the target of the animation.
			 * @param {object} properties - The CSS properties that should be animated.
			 * @param {object} options - Options for the animation, like duration or easing.
			 * @returns {Scene} Parent object for chaining.
			 */
			Scene.setVelocity = function (elems, properties, options) {
				if (_elems) { // kill old ani?
					Scene.removeVelocity();
				}

				_elems = _util.get.elements(elems);
				_properties = properties || {};
				_options = options || {};
				_dataID = "ScrollMagic." + NAMESPACE + "[" + (autoindex++) + "]";

				if (_options.queue !== undefined) {
					// we'll use the queue to identify the animation. When defined it will always stop the previously running one.
					// if undefined the animation will always fully run, as is expected.
					// defining anything other than 'false' as the que doesn't make much sense, because ScrollMagic takes control over the trigger.
					// thus it is also overwritten.
					_options.queue = _dataID + "_queue";
				}

				var checkDuration = function () {
					if (Scene.duration() !== 0) {
						log(1, "ERROR: The Velocity animation plugin does not support scrollbound animations (scenes with duration) yet.");
					}
				};
				Scene.on("change.plugin_velocity", function (e) {
					if (e.what == 'duration') {
						checkDuration();
					}
				});
				checkDuration();
				log(3, "added animation");

				updateAnimationProgress();
				return Scene;
			};
			/**
			 * Remove the animation from the scene.  
			 * This will stop the scene from triggering the animation.
			 *
			 * Using the reset option you can decide if the animation should remain in the current state or be rewound to set the target elements back to the state they were in before the animation was added to the scene.
			 * @memberof! animation.Velocity#
			 *
			 * @example
			 * // remove the animation from the scene without resetting it
			 * scene.removeVelocity();
			 *
			 * // remove the animation from the scene and reset the elements to initial state
			 * scene.removeVelocity(true);
			 *
			 * @param {boolean} [reset=false] - If `true` the animation will rewound.
			 * @returns {Scene} Parent object for chaining.
			 */
			Scene.removeVelocity = function (reset) {
				if (_elems) {
					// stop running animations
					if (_options.queue !== undefined) {
						velocity(_elems, "stop", _options.queue);
					}
					if (reset) {
						reverse(_elems, {
							duration: 0
						});
					}

					_elems.forEach(function (elem) {
						velocity.Utilities.removeData(elem, _dataID);
					});
					_elems = _properties = _options = _dataID = undefined;
				}
				return Scene;
			};
		});
	}));

/***/ },

/***/ 535:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
	 * JavaScript Cookie v2.1.4
	 * https://github.com/js-cookie/js-cookie
	 *
	 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
	 * Released under the MIT license
	 */
	;(function (factory) {
		var registeredInModuleLoader = false;
		if (true) {
			!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
			registeredInModuleLoader = true;
		}
		if (true) {
			module.exports = factory();
			registeredInModuleLoader = true;
		}
		if (!registeredInModuleLoader) {
			var OldCookies = window.Cookies;
			var api = window.Cookies = factory();
			api.noConflict = function () {
				window.Cookies = OldCookies;
				return api;
			};
		}
	}(function () {
		function extend () {
			var i = 0;
			var result = {};
			for (; i < arguments.length; i++) {
				var attributes = arguments[ i ];
				for (var key in attributes) {
					result[key] = attributes[key];
				}
			}
			return result;
		}

		function init (converter) {
			function api (key, value, attributes) {
				var result;
				if (typeof document === 'undefined') {
					return;
				}

				// Write

				if (arguments.length > 1) {
					attributes = extend({
						path: '/'
					}, api.defaults, attributes);

					if (typeof attributes.expires === 'number') {
						var expires = new Date();
						expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
						attributes.expires = expires;
					}

					// We're using "expires" because "max-age" is not supported by IE
					attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

					try {
						result = JSON.stringify(value);
						if (/^[\{\[]/.test(result)) {
							value = result;
						}
					} catch (e) {}

					if (!converter.write) {
						value = encodeURIComponent(String(value))
							.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
					} else {
						value = converter.write(value, key);
					}

					key = encodeURIComponent(String(key));
					key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
					key = key.replace(/[\(\)]/g, escape);

					var stringifiedAttributes = '';

					for (var attributeName in attributes) {
						if (!attributes[attributeName]) {
							continue;
						}
						stringifiedAttributes += '; ' + attributeName;
						if (attributes[attributeName] === true) {
							continue;
						}
						stringifiedAttributes += '=' + attributes[attributeName];
					}
					return (document.cookie = key + '=' + value + stringifiedAttributes);
				}

				// Read

				if (!key) {
					result = {};
				}

				// To prevent the for loop in the first place assign an empty array
				// in case there are no cookies at all. Also prevents odd result when
				// calling "get()"
				var cookies = document.cookie ? document.cookie.split('; ') : [];
				var rdecode = /(%[0-9A-Z]{2})+/g;
				var i = 0;

				for (; i < cookies.length; i++) {
					var parts = cookies[i].split('=');
					var cookie = parts.slice(1).join('=');

					if (cookie.charAt(0) === '"') {
						cookie = cookie.slice(1, -1);
					}

					try {
						var name = parts[0].replace(rdecode, decodeURIComponent);
						cookie = converter.read ?
							converter.read(cookie, name) : converter(cookie, name) ||
							cookie.replace(rdecode, decodeURIComponent);

						if (this.json) {
							try {
								cookie = JSON.parse(cookie);
							} catch (e) {}
						}

						if (key === name) {
							result = cookie;
							break;
						}

						if (!key) {
							result[name] = cookie;
						}
					} catch (e) {}
				}

				return result;
			}

			api.set = api;
			api.get = function (key) {
				return api.call(api, key);
			};
			api.getJSON = function () {
				return api.apply({
					json: true
				}, [].slice.call(arguments));
			};
			api.defaults = {};

			api.remove = function (key, attributes) {
				api(key, '', extend(attributes, {
					expires: -1
				}));
			};

			api.withConverter = init;

			return api;
		}

		return init(function () {});
	}));


/***/ },

/***/ 536:
/***/ function(module, exports) {

	// Init style shamelessly stolen from jQuery http://jquery.com
	var Froogaloop = (function(){
	    // Define a local copy of Froogaloop
	    function Froogaloop(iframe) {
	        // The Froogaloop object is actually just the init constructor
	        return new Froogaloop.fn.init(iframe);
	    }

	    var eventCallbacks = {},
	        hasWindowEvent = false,
	        isReady = false,
	        slice = Array.prototype.slice,
	        playerOrigin = '*';

	    Froogaloop.fn = Froogaloop.prototype = {
	        element: null,

	        init: function(iframe) {
	            if (typeof iframe === "string") {
	                iframe = document.getElementById(iframe);
	            }

	            this.element = iframe;

	            return this;
	        },

	        /*
	         * Calls a function to act upon the player.
	         *
	         * @param {string} method The name of the Javascript API method to call. Eg: 'play'.
	         * @param {Array|Function} valueOrCallback params Array of parameters to pass when calling an API method
	         *                                or callback function when the method returns a value.
	         */
	        api: function(method, valueOrCallback) {
	            if (!this.element || !method) {
	                return false;
	            }

	            var self = this,
	                element = self.element,
	                target_id = element.id !== '' ? element.id : null,
	                params = !isFunction(valueOrCallback) ? valueOrCallback : null,
	                callback = isFunction(valueOrCallback) ? valueOrCallback : null;

	            // Store the callback for get functions
	            if (callback) {
	                storeCallback(method, callback, target_id);
	            }

	            postMessage(method, params, element);
	            return self;
	        },

	        /*
	         * Registers an event listener and a callback function that gets called when the event fires.
	         *
	         * @param eventName (String): Name of the event to listen for.
	         * @param callback (Function): Function that should be called when the event fires.
	         */
	        addEvent: function(eventName, callback) {
	            if (!this.element) {
	                return false;
	            }

	            var self = this,
	                element = self.element,
	                target_id = element.id !== '' ? element.id : null;


	            storeCallback(eventName, callback, target_id);

	            // The ready event is not registered via postMessage. It fires regardless.
	            if (eventName != 'ready') {
	                postMessage('addEventListener', eventName, element);
	            }
	            else if (eventName == 'ready' && isReady) {
	                callback.call(null, target_id);
	            }

	            return self;
	        },

	        /*
	         * Unregisters an event listener that gets called when the event fires.
	         *
	         * @param eventName (String): Name of the event to stop listening for.
	         */
	        removeEvent: function(eventName) {
	            if (!this.element) {
	                return false;
	            }

	            var self = this,
	                element = self.element,
	                target_id = element.id !== '' ? element.id : null,
	                removed = removeCallback(eventName, target_id);

	            // The ready event is not registered
	            if (eventName != 'ready' && removed) {
	                postMessage('removeEventListener', eventName, element);
	            }
	        }
	    };

	    /**
	     * Handles posting a message to the parent window.
	     *
	     * @param method (String): name of the method to call inside the player. For api calls
	     * this is the name of the api method (api_play or api_pause) while for events this method
	     * is api_addEventListener.
	     * @param params (Object or Array): List of parameters to submit to the method. Can be either
	     * a single param or an array list of parameters.
	     * @param target (HTMLElement): Target iframe to post the message to.
	     */
	    function postMessage(method, params, target) {
	        if (!target.contentWindow.postMessage) {
	            return false;
	        }

	        var data = JSON.stringify({
	            method: method,
	            value: params
	        });

	        target.contentWindow.postMessage(data, playerOrigin);
	    }

	    /**
	     * Event that fires whenever the window receives a message from its parent
	     * via window.postMessage.
	     */
	    function onMessageReceived(event) {
	        var data, method;

	        try {
	            data = JSON.parse(event.data);
	            method = data.event || data.method;
	        }
	        catch(e)  {
	            //fail silently... like a ninja!
	        }

	        if (method == 'ready' && !isReady) {
	            isReady = true;
	        }

	        // Handles messages from the vimeo player only
	        if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
	            return false;
	        }

	        if (playerOrigin === '*') {
	            playerOrigin = event.origin;
	        }

	        var value = data.value,
	            eventData = data.data,
	            target_id = target_id === '' ? null : data.player_id,

	            callback = getCallback(method, target_id),
	            params = [];

	        if (!callback) {
	            return false;
	        }

	        if (value !== undefined) {
	            params.push(value);
	        }

	        if (eventData) {
	            params.push(eventData);
	        }

	        if (target_id) {
	            params.push(target_id);
	        }

	        return params.length > 0 ? callback.apply(null, params) : callback.call();
	    }


	    /**
	     * Stores submitted callbacks for each iframe being tracked and each
	     * event for that iframe.
	     *
	     * @param eventName (String): Name of the event. Eg. api_onPlay
	     * @param callback (Function): Function that should get executed when the
	     * event is fired.
	     * @param target_id (String) [Optional]: If handling more than one iframe then
	     * it stores the different callbacks for different iframes based on the iframe's
	     * id.
	     */
	    function storeCallback(eventName, callback, target_id) {
	        if (target_id) {
	            if (!eventCallbacks[target_id]) {
	                eventCallbacks[target_id] = {};
	            }
	            eventCallbacks[target_id][eventName] = callback;
	        }
	        else {
	            eventCallbacks[eventName] = callback;
	        }
	    }

	    /**
	     * Retrieves stored callbacks.
	     */
	    function getCallback(eventName, target_id) {
	        if (target_id) {
	            return eventCallbacks[target_id][eventName];
	        }
	        else {
	            return eventCallbacks[eventName];
	        }
	    }

	    function removeCallback(eventName, target_id) {
	        if (target_id && eventCallbacks[target_id]) {
	            if (!eventCallbacks[target_id][eventName]) {
	                return false;
	            }
	            eventCallbacks[target_id][eventName] = null;
	        }
	        else {
	            if (!eventCallbacks[eventName]) {
	                return false;
	            }
	            eventCallbacks[eventName] = null;
	        }

	        return true;
	    }

	    function isFunction(obj) {
	        return !!(obj && obj.constructor && obj.call && obj.apply);
	    }

	    function isArray(obj) {
	        return toString.call(obj) === '[object Array]';
	    }

	    // Give the init function the Froogaloop prototype for later instantiation
	    Froogaloop.fn.init.prototype = Froogaloop.fn;

	    // Listens for the message event.
	    // W3C
	    if (window.addEventListener) {
	        window.addEventListener('message', onMessageReceived, false);
	    }
	    // IE
	    else {
	        window.attachEvent('onmessage', onMessageReceived);
	    }

	    // Expose froogaloop to the global object
	    return (window.Froogaloop = window.$f = Froogaloop);

	})();


/***/ },

/***/ 537:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*! PhotoSwipe - v4.1.1 - 2015-12-24
	* http://photoswipe.com
	* Copyright (c) 2015 Dmitry Semenov; */
	(function (root, factory) { 
		if (true) {
			!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		} else if (typeof exports === 'object') {
			module.exports = factory();
		} else {
			root.PhotoSwipe = factory();
		}
	})(this, function () {

		'use strict';
		var PhotoSwipe = function(template, UiClass, items, options){

	/*>>framework-bridge*/
	/**
	 *
	 * Set of generic functions used by gallery.
	 * 
	 * You're free to modify anything here as long as functionality is kept.
	 * 
	 */
	var framework = {
		features: null,
		bind: function(target, type, listener, unbind) {
			var methodName = (unbind ? 'remove' : 'add') + 'EventListener';
			type = type.split(' ');
			for(var i = 0; i < type.length; i++) {
				if(type[i]) {
					target[methodName]( type[i], listener, false);
				}
			}
		},
		isArray: function(obj) {
			return (obj instanceof Array);
		},
		createEl: function(classes, tag) {
			var el = document.createElement(tag || 'div');
			if(classes) {
				el.className = classes;
			}
			return el;
		},
		getScrollY: function() {
			var yOffset = window.pageYOffset;
			return yOffset !== undefined ? yOffset : document.documentElement.scrollTop;
		},
		unbind: function(target, type, listener) {
			framework.bind(target,type,listener,true);
		},
		removeClass: function(el, className) {
			var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
			el.className = el.className.replace(reg, ' ').replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
		},
		addClass: function(el, className) {
			if( !framework.hasClass(el,className) ) {
				el.className += (el.className ? ' ' : '') + className;
			}
		},
		hasClass: function(el, className) {
			return el.className && new RegExp('(^|\\s)' + className + '(\\s|$)').test(el.className);
		},
		getChildByClass: function(parentEl, childClassName) {
			var node = parentEl.firstChild;
			while(node) {
				if( framework.hasClass(node, childClassName) ) {
					return node;
				}
				node = node.nextSibling;
			}
		},
		arraySearch: function(array, value, key) {
			var i = array.length;
			while(i--) {
				if(array[i][key] === value) {
					return i;
				} 
			}
			return -1;
		},
		extend: function(o1, o2, preventOverwrite) {
			for (var prop in o2) {
				if (o2.hasOwnProperty(prop)) {
					if(preventOverwrite && o1.hasOwnProperty(prop)) {
						continue;
					}
					o1[prop] = o2[prop];
				}
			}
		},
		easing: {
			sine: {
				out: function(k) {
					return Math.sin(k * (Math.PI / 2));
				},
				inOut: function(k) {
					return - (Math.cos(Math.PI * k) - 1) / 2;
				}
			},
			cubic: {
				out: function(k) {
					return --k * k * k + 1;
				}
			}
			/*
				elastic: {
					out: function ( k ) {

						var s, a = 0.1, p = 0.4;
						if ( k === 0 ) return 0;
						if ( k === 1 ) return 1;
						if ( !a || a < 1 ) { a = 1; s = p / 4; }
						else s = p * Math.asin( 1 / a ) / ( 2 * Math.PI );
						return ( a * Math.pow( 2, - 10 * k) * Math.sin( ( k - s ) * ( 2 * Math.PI ) / p ) + 1 );

					},
				},
				back: {
					out: function ( k ) {
						var s = 1.70158;
						return --k * k * ( ( s + 1 ) * k + s ) + 1;
					}
				}
			*/
		},

		/**
		 * 
		 * @return {object}
		 * 
		 * {
		 *  raf : request animation frame function
		 *  caf : cancel animation frame function
		 *  transfrom : transform property key (with vendor), or null if not supported
		 *  oldIE : IE8 or below
		 * }
		 * 
		 */
		detectFeatures: function() {
			if(framework.features) {
				return framework.features;
			}
			var helperEl = framework.createEl(),
				helperStyle = helperEl.style,
				vendor = '',
				features = {};

			// IE8 and below
			features.oldIE = document.all && !document.addEventListener;

			features.touch = 'ontouchstart' in window;

			if(window.requestAnimationFrame) {
				features.raf = window.requestAnimationFrame;
				features.caf = window.cancelAnimationFrame;
			}

			features.pointerEvent = navigator.pointerEnabled || navigator.msPointerEnabled;

			// fix false-positive detection of old Android in new IE
			// (IE11 ua string contains "Android 4.0")
			
			if(!features.pointerEvent) { 

				var ua = navigator.userAgent;

				// Detect if device is iPhone or iPod and if it's older than iOS 8
				// http://stackoverflow.com/a/14223920
				// 
				// This detection is made because of buggy top/bottom toolbars
				// that don't trigger window.resize event.
				// For more info refer to _isFixedPosition variable in core.js

				if (/iP(hone|od)/.test(navigator.platform)) {
					var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
					if(v && v.length > 0) {
						v = parseInt(v[1], 10);
						if(v >= 1 && v < 8 ) {
							features.isOldIOSPhone = true;
						}
					}
				}

				// Detect old Android (before KitKat)
				// due to bugs related to position:fixed
				// http://stackoverflow.com/questions/7184573/pick-up-the-android-version-in-the-browser-by-javascript
				
				var match = ua.match(/Android\s([0-9\.]*)/);
				var androidversion =  match ? match[1] : 0;
				androidversion = parseFloat(androidversion);
				if(androidversion >= 1 ) {
					if(androidversion < 4.4) {
						features.isOldAndroid = true; // for fixed position bug & performance
					}
					features.androidVersion = androidversion; // for touchend bug
				}	
				features.isMobileOpera = /opera mini|opera mobi/i.test(ua);

				// p.s. yes, yes, UA sniffing is bad, propose your solution for above bugs.
			}
			
			var styleChecks = ['transform', 'perspective', 'animationName'],
				vendors = ['', 'webkit','Moz','ms','O'],
				styleCheckItem,
				styleName;

			for(var i = 0; i < 4; i++) {
				vendor = vendors[i];

				for(var a = 0; a < 3; a++) {
					styleCheckItem = styleChecks[a];

					// uppercase first letter of property name, if vendor is present
					styleName = vendor + (vendor ? 
											styleCheckItem.charAt(0).toUpperCase() + styleCheckItem.slice(1) : 
											styleCheckItem);
				
					if(!features[styleCheckItem] && styleName in helperStyle ) {
						features[styleCheckItem] = styleName;
					}
				}

				if(vendor && !features.raf) {
					vendor = vendor.toLowerCase();
					features.raf = window[vendor+'RequestAnimationFrame'];
					if(features.raf) {
						features.caf = window[vendor+'CancelAnimationFrame'] || 
										window[vendor+'CancelRequestAnimationFrame'];
					}
				}
			}
				
			if(!features.raf) {
				var lastTime = 0;
				features.raf = function(fn) {
					var currTime = new Date().getTime();
					var timeToCall = Math.max(0, 16 - (currTime - lastTime));
					var id = window.setTimeout(function() { fn(currTime + timeToCall); }, timeToCall);
					lastTime = currTime + timeToCall;
					return id;
				};
				features.caf = function(id) { clearTimeout(id); };
			}

			// Detect SVG support
			features.svg = !!document.createElementNS && 
							!!document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect;

			framework.features = features;

			return features;
		}
	};

	framework.detectFeatures();

	// Override addEventListener for old versions of IE
	if(framework.features.oldIE) {

		framework.bind = function(target, type, listener, unbind) {
			
			type = type.split(' ');

			var methodName = (unbind ? 'detach' : 'attach') + 'Event',
				evName,
				_handleEv = function() {
					listener.handleEvent.call(listener);
				};

			for(var i = 0; i < type.length; i++) {
				evName = type[i];
				if(evName) {

					if(typeof listener === 'object' && listener.handleEvent) {
						if(!unbind) {
							listener['oldIE' + evName] = _handleEv;
						} else {
							if(!listener['oldIE' + evName]) {
								return false;
							}
						}

						target[methodName]( 'on' + evName, listener['oldIE' + evName]);
					} else {
						target[methodName]( 'on' + evName, listener);
					}

				}
			}
		};
		
	}

	/*>>framework-bridge*/

	/*>>core*/
	//function(template, UiClass, items, options)

	var self = this;

	/**
	 * Static vars, don't change unless you know what you're doing.
	 */
	var DOUBLE_TAP_RADIUS = 25, 
		NUM_HOLDERS = 3;

	/**
	 * Options
	 */
	var _options = {
		allowPanToNext:true,
		spacing: 0.12,
		bgOpacity: 1,
		mouseUsed: false,
		loop: true,
		pinchToClose: true,
		closeOnScroll: true,
		closeOnVerticalDrag: true,
		verticalDragRange: 0.75,
		hideAnimationDuration: 333,
		showAnimationDuration: 333,
		showHideOpacity: false,
		focus: true,
		escKey: true,
		arrowKeys: true,
		mainScrollEndFriction: 0.35,
		panEndFriction: 0.35,
		isClickableElement: function(el) {
	        return el.tagName === 'A';
	    },
	    getDoubleTapZoom: function(isMouseClick, item) {
	    	if(isMouseClick) {
	    		return 1;
	    	} else {
	    		return item.initialZoomLevel < 0.7 ? 1 : 1.33;
	    	}
	    },
	    maxSpreadZoom: 1.33,
		modal: true,

		// not fully implemented yet
		scaleMode: 'fit' // TODO
	};
	framework.extend(_options, options);


	/**
	 * Private helper variables & functions
	 */

	var _getEmptyPoint = function() { 
			return {x:0,y:0}; 
		};

	var _isOpen,
		_isDestroying,
		_closedByScroll,
		_currentItemIndex,
		_containerStyle,
		_containerShiftIndex,
		_currPanDist = _getEmptyPoint(),
		_startPanOffset = _getEmptyPoint(),
		_panOffset = _getEmptyPoint(),
		_upMoveEvents, // drag move, drag end & drag cancel events array
		_downEvents, // drag start events array
		_globalEventHandlers,
		_viewportSize = {},
		_currZoomLevel,
		_startZoomLevel,
		_translatePrefix,
		_translateSufix,
		_updateSizeInterval,
		_itemsNeedUpdate,
		_currPositionIndex = 0,
		_offset = {},
		_slideSize = _getEmptyPoint(), // size of slide area, including spacing
		_itemHolders,
		_prevItemIndex,
		_indexDiff = 0, // difference of indexes since last content update
		_dragStartEvent,
		_dragMoveEvent,
		_dragEndEvent,
		_dragCancelEvent,
		_transformKey,
		_pointerEventEnabled,
		_isFixedPosition = true,
		_likelyTouchDevice,
		_modules = [],
		_requestAF,
		_cancelAF,
		_initalClassName,
		_initalWindowScrollY,
		_oldIE,
		_currentWindowScrollY,
		_features,
		_windowVisibleSize = {},
		_renderMaxResolution = false,

		// Registers PhotoSWipe module (History, Controller ...)
		_registerModule = function(name, module) {
			framework.extend(self, module.publicMethods);
			_modules.push(name);
		},

		_getLoopedId = function(index) {
			var numSlides = _getNumItems();
			if(index > numSlides - 1) {
				return index - numSlides;
			} else  if(index < 0) {
				return numSlides + index;
			}
			return index;
		},
		
		// Micro bind/trigger
		_listeners = {},
		_listen = function(name, fn) {
			if(!_listeners[name]) {
				_listeners[name] = [];
			}
			return _listeners[name].push(fn);
		},
		_shout = function(name) {
			var listeners = _listeners[name];

			if(listeners) {
				var args = Array.prototype.slice.call(arguments);
				args.shift();

				for(var i = 0; i < listeners.length; i++) {
					listeners[i].apply(self, args);
				}
			}
		},

		_getCurrentTime = function() {
			return new Date().getTime();
		},
		_applyBgOpacity = function(opacity) {
			_bgOpacity = opacity;
			self.bg.style.opacity = opacity * _options.bgOpacity;
		},

		_applyZoomTransform = function(styleObj,x,y,zoom,item) {
			if(!_renderMaxResolution || (item && item !== self.currItem) ) {
				zoom = zoom / (item ? item.fitRatio : self.currItem.fitRatio);	
			}
				
			styleObj[_transformKey] = _translatePrefix + x + 'px, ' + y + 'px' + _translateSufix + ' scale(' + zoom + ')';
		},
		_applyCurrentZoomPan = function( allowRenderResolution ) {
			if(_currZoomElementStyle) {

				if(allowRenderResolution) {
					if(_currZoomLevel > self.currItem.fitRatio) {
						if(!_renderMaxResolution) {
							_setImageSize(self.currItem, false, true);
							_renderMaxResolution = true;
						}
					} else {
						if(_renderMaxResolution) {
							_setImageSize(self.currItem);
							_renderMaxResolution = false;
						}
					}
				}
				

				_applyZoomTransform(_currZoomElementStyle, _panOffset.x, _panOffset.y, _currZoomLevel);
			}
		},
		_applyZoomPanToItem = function(item) {
			if(item.container) {

				_applyZoomTransform(item.container.style, 
									item.initialPosition.x, 
									item.initialPosition.y, 
									item.initialZoomLevel,
									item);
			}
		},
		_setTranslateX = function(x, elStyle) {
			elStyle[_transformKey] = _translatePrefix + x + 'px, 0px' + _translateSufix;
		},
		_moveMainScroll = function(x, dragging) {

			if(!_options.loop && dragging) {
				var newSlideIndexOffset = _currentItemIndex + (_slideSize.x * _currPositionIndex - x) / _slideSize.x,
					delta = Math.round(x - _mainScrollPos.x);

				if( (newSlideIndexOffset < 0 && delta > 0) || 
					(newSlideIndexOffset >= _getNumItems() - 1 && delta < 0) ) {
					x = _mainScrollPos.x + delta * _options.mainScrollEndFriction;
				} 
			}
			
			_mainScrollPos.x = x;
			_setTranslateX(x, _containerStyle);
		},
		_calculatePanOffset = function(axis, zoomLevel) {
			var m = _midZoomPoint[axis] - _offset[axis];
			return _startPanOffset[axis] + _currPanDist[axis] + m - m * ( zoomLevel / _startZoomLevel );
		},
		
		_equalizePoints = function(p1, p2) {
			p1.x = p2.x;
			p1.y = p2.y;
			if(p2.id) {
				p1.id = p2.id;
			}
		},
		_roundPoint = function(p) {
			p.x = Math.round(p.x);
			p.y = Math.round(p.y);
		},

		_mouseMoveTimeout = null,
		_onFirstMouseMove = function() {
			// Wait until mouse move event is fired at least twice during 100ms
			// We do this, because some mobile browsers trigger it on touchstart
			if(_mouseMoveTimeout ) { 
				framework.unbind(document, 'mousemove', _onFirstMouseMove);
				framework.addClass(template, 'pswp--has_mouse');
				_options.mouseUsed = true;
				_shout('mouseUsed');
			}
			_mouseMoveTimeout = setTimeout(function() {
				_mouseMoveTimeout = null;
			}, 100);
		},

		_bindEvents = function() {
			framework.bind(document, 'keydown', self);

			if(_features.transform) {
				// don't bind click event in browsers that don't support transform (mostly IE8)
				framework.bind(self.scrollWrap, 'click', self);
			}
			

			if(!_options.mouseUsed) {
				framework.bind(document, 'mousemove', _onFirstMouseMove);
			}

			framework.bind(window, 'resize scroll', self);

			_shout('bindEvents');
		},

		_unbindEvents = function() {
			framework.unbind(window, 'resize', self);
			framework.unbind(window, 'scroll', _globalEventHandlers.scroll);
			framework.unbind(document, 'keydown', self);
			framework.unbind(document, 'mousemove', _onFirstMouseMove);

			if(_features.transform) {
				framework.unbind(self.scrollWrap, 'click', self);
			}

			if(_isDragging) {
				framework.unbind(window, _upMoveEvents, self);
			}

			_shout('unbindEvents');
		},
		
		_calculatePanBounds = function(zoomLevel, update) {
			var bounds = _calculateItemSize( self.currItem, _viewportSize, zoomLevel );
			if(update) {
				_currPanBounds = bounds;
			}
			return bounds;
		},
		
		_getMinZoomLevel = function(item) {
			if(!item) {
				item = self.currItem;
			}
			return item.initialZoomLevel;
		},
		_getMaxZoomLevel = function(item) {
			if(!item) {
				item = self.currItem;
			}
			return item.w > 0 ? _options.maxSpreadZoom : 1;
		},

		// Return true if offset is out of the bounds
		_modifyDestPanOffset = function(axis, destPanBounds, destPanOffset, destZoomLevel) {
			if(destZoomLevel === self.currItem.initialZoomLevel) {
				destPanOffset[axis] = self.currItem.initialPosition[axis];
				return true;
			} else {
				destPanOffset[axis] = _calculatePanOffset(axis, destZoomLevel); 

				if(destPanOffset[axis] > destPanBounds.min[axis]) {
					destPanOffset[axis] = destPanBounds.min[axis];
					return true;
				} else if(destPanOffset[axis] < destPanBounds.max[axis] ) {
					destPanOffset[axis] = destPanBounds.max[axis];
					return true;
				}
			}
			return false;
		},

		_setupTransforms = function() {

			if(_transformKey) {
				// setup 3d transforms
				var allow3dTransform = _features.perspective && !_likelyTouchDevice;
				_translatePrefix = 'translate' + (allow3dTransform ? '3d(' : '(');
				_translateSufix = _features.perspective ? ', 0px)' : ')';	
				return;
			}

			// Override zoom/pan/move functions in case old browser is used (most likely IE)
			// (so they use left/top/width/height, instead of CSS transform)
		
			_transformKey = 'left';
			framework.addClass(template, 'pswp--ie');

			_setTranslateX = function(x, elStyle) {
				elStyle.left = x + 'px';
			};
			_applyZoomPanToItem = function(item) {

				var zoomRatio = item.fitRatio > 1 ? 1 : item.fitRatio,
					s = item.container.style,
					w = zoomRatio * item.w,
					h = zoomRatio * item.h;

				s.width = w + 'px';
				s.height = h + 'px';
				s.left = item.initialPosition.x + 'px';
				s.top = item.initialPosition.y + 'px';

			};
			_applyCurrentZoomPan = function() {
				if(_currZoomElementStyle) {

					var s = _currZoomElementStyle,
						item = self.currItem,
						zoomRatio = item.fitRatio > 1 ? 1 : item.fitRatio,
						w = zoomRatio * item.w,
						h = zoomRatio * item.h;

					s.width = w + 'px';
					s.height = h + 'px';


					s.left = _panOffset.x + 'px';
					s.top = _panOffset.y + 'px';
				}
				
			};
		},

		_onKeyDown = function(e) {
			var keydownAction = '';
			if(_options.escKey && e.keyCode === 27) { 
				keydownAction = 'close';
			} else if(_options.arrowKeys) {
				if(e.keyCode === 37) {
					keydownAction = 'prev';
				} else if(e.keyCode === 39) { 
					keydownAction = 'next';
				}
			}

			if(keydownAction) {
				// don't do anything if special key pressed to prevent from overriding default browser actions
				// e.g. in Chrome on Mac cmd+arrow-left returns to previous page
				if( !e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey ) {
					if(e.preventDefault) {
						e.preventDefault();
					} else {
						e.returnValue = false;
					} 
					self[keydownAction]();
				}
			}
		},

		_onGlobalClick = function(e) {
			if(!e) {
				return;
			}

			// don't allow click event to pass through when triggering after drag or some other gesture
			if(_moved || _zoomStarted || _mainScrollAnimating || _verticalDragInitiated) {
				e.preventDefault();
				e.stopPropagation();
			}
		},

		_updatePageScrollOffset = function() {
			self.setScrollOffset(0, framework.getScrollY());		
		};
		


		



	// Micro animation engine
	var _animations = {},
		_numAnimations = 0,
		_stopAnimation = function(name) {
			if(_animations[name]) {
				if(_animations[name].raf) {
					_cancelAF( _animations[name].raf );
				}
				_numAnimations--;
				delete _animations[name];
			}
		},
		_registerStartAnimation = function(name) {
			if(_animations[name]) {
				_stopAnimation(name);
			}
			if(!_animations[name]) {
				_numAnimations++;
				_animations[name] = {};
			}
		},
		_stopAllAnimations = function() {
			for (var prop in _animations) {

				if( _animations.hasOwnProperty( prop ) ) {
					_stopAnimation(prop);
				} 
				
			}
		},
		_animateProp = function(name, b, endProp, d, easingFn, onUpdate, onComplete) {
			var startAnimTime = _getCurrentTime(), t;
			_registerStartAnimation(name);

			var animloop = function(){
				if ( _animations[name] ) {
					
					t = _getCurrentTime() - startAnimTime; // time diff
					//b - beginning (start prop)
					//d - anim duration

					if ( t >= d ) {
						_stopAnimation(name);
						onUpdate(endProp);
						if(onComplete) {
							onComplete();
						}
						return;
					}
					onUpdate( (endProp - b) * easingFn(t/d) + b );

					_animations[name].raf = _requestAF(animloop);
				}
			};
			animloop();
		};
		


	var publicMethods = {

		// make a few local variables and functions public
		shout: _shout,
		listen: _listen,
		viewportSize: _viewportSize,
		options: _options,

		isMainScrollAnimating: function() {
			return _mainScrollAnimating;
		},
		getZoomLevel: function() {
			return _currZoomLevel;
		},
		getCurrentIndex: function() {
			return _currentItemIndex;
		},
		isDragging: function() {
			return _isDragging;
		},	
		isZooming: function() {
			return _isZooming;
		},
		setScrollOffset: function(x,y) {
			_offset.x = x;
			_currentWindowScrollY = _offset.y = y;
			_shout('updateScrollOffset', _offset);
		},
		applyZoomPan: function(zoomLevel,panX,panY,allowRenderResolution) {
			_panOffset.x = panX;
			_panOffset.y = panY;
			_currZoomLevel = zoomLevel;
			_applyCurrentZoomPan( allowRenderResolution );
		},

		init: function() {

			if(_isOpen || _isDestroying) {
				return;
			}

			var i;

			self.framework = framework; // basic functionality
			self.template = template; // root DOM element of PhotoSwipe
			self.bg = framework.getChildByClass(template, 'pswp__bg');

			_initalClassName = template.className;
			_isOpen = true;
					
			_features = framework.detectFeatures();
			_requestAF = _features.raf;
			_cancelAF = _features.caf;
			_transformKey = _features.transform;
			_oldIE = _features.oldIE;
			
			self.scrollWrap = framework.getChildByClass(template, 'pswp__scroll-wrap');
			self.container = framework.getChildByClass(self.scrollWrap, 'pswp__container');

			_containerStyle = self.container.style; // for fast access

			// Objects that hold slides (there are only 3 in DOM)
			self.itemHolders = _itemHolders = [
				{el:self.container.children[0] , wrap:0, index: -1},
				{el:self.container.children[1] , wrap:0, index: -1},
				{el:self.container.children[2] , wrap:0, index: -1}
			];

			// hide nearby item holders until initial zoom animation finishes (to avoid extra Paints)
			_itemHolders[0].el.style.display = _itemHolders[2].el.style.display = 'none';

			_setupTransforms();

			// Setup global events
			_globalEventHandlers = {
				resize: self.updateSize,
				scroll: _updatePageScrollOffset,
				keydown: _onKeyDown,
				click: _onGlobalClick
			};

			// disable show/hide effects on old browsers that don't support CSS animations or transforms, 
			// old IOS, Android and Opera mobile. Blackberry seems to work fine, even older models.
			var oldPhone = _features.isOldIOSPhone || _features.isOldAndroid || _features.isMobileOpera;
			if(!_features.animationName || !_features.transform || oldPhone) {
				_options.showAnimationDuration = _options.hideAnimationDuration = 0;
			}

			// init modules
			for(i = 0; i < _modules.length; i++) {
				self['init' + _modules[i]]();
			}
			
			// init
			if(UiClass) {
				var ui = self.ui = new UiClass(self, framework);
				ui.init();
			}

			_shout('firstUpdate');
			_currentItemIndex = _currentItemIndex || _options.index || 0;
			// validate index
			if( isNaN(_currentItemIndex) || _currentItemIndex < 0 || _currentItemIndex >= _getNumItems() ) {
				_currentItemIndex = 0;
			}
			self.currItem = _getItemAt( _currentItemIndex );

			
			if(_features.isOldIOSPhone || _features.isOldAndroid) {
				_isFixedPosition = false;
			}
			
			template.setAttribute('aria-hidden', 'false');
			if(_options.modal) {
				if(!_isFixedPosition) {
					template.style.position = 'absolute';
					template.style.top = framework.getScrollY() + 'px';
				} else {
					template.style.position = 'fixed';
				}
			}

			if(_currentWindowScrollY === undefined) {
				_shout('initialLayout');
				_currentWindowScrollY = _initalWindowScrollY = framework.getScrollY();
			}
			
			// add classes to root element of PhotoSwipe
			var rootClasses = 'pswp--open ';
			if(_options.mainClass) {
				rootClasses += _options.mainClass + ' ';
			}
			if(_options.showHideOpacity) {
				rootClasses += 'pswp--animate_opacity ';
			}
			rootClasses += _likelyTouchDevice ? 'pswp--touch' : 'pswp--notouch';
			rootClasses += _features.animationName ? ' pswp--css_animation' : '';
			rootClasses += _features.svg ? ' pswp--svg' : '';
			framework.addClass(template, rootClasses);

			self.updateSize();

			// initial update
			_containerShiftIndex = -1;
			_indexDiff = null;
			for(i = 0; i < NUM_HOLDERS; i++) {
				_setTranslateX( (i+_containerShiftIndex) * _slideSize.x, _itemHolders[i].el.style);
			}

			if(!_oldIE) {
				framework.bind(self.scrollWrap, _downEvents, self); // no dragging for old IE
			}	

			_listen('initialZoomInEnd', function() {
				self.setContent(_itemHolders[0], _currentItemIndex-1);
				self.setContent(_itemHolders[2], _currentItemIndex+1);

				_itemHolders[0].el.style.display = _itemHolders[2].el.style.display = 'block';

				if(_options.focus) {
					// focus causes layout, 
					// which causes lag during the animation, 
					// that's why we delay it untill the initial zoom transition ends
					template.focus();
				}
				 

				_bindEvents();
			});

			// set content for center slide (first time)
			self.setContent(_itemHolders[1], _currentItemIndex);
			
			self.updateCurrItem();

			_shout('afterInit');

			if(!_isFixedPosition) {

				// On all versions of iOS lower than 8.0, we check size of viewport every second.
				// 
				// This is done to detect when Safari top & bottom bars appear, 
				// as this action doesn't trigger any events (like resize). 
				// 
				// On iOS8 they fixed this.
				// 
				// 10 Nov 2014: iOS 7 usage ~40%. iOS 8 usage 56%.
				
				_updateSizeInterval = setInterval(function() {
					if(!_numAnimations && !_isDragging && !_isZooming && (_currZoomLevel === self.currItem.initialZoomLevel)  ) {
						self.updateSize();
					}
				}, 1000);
			}

			framework.addClass(template, 'pswp--visible');
		},

		// Close the gallery, then destroy it
		close: function() {
			if(!_isOpen) {
				return;
			}

			_isOpen = false;
			_isDestroying = true;
			_shout('close');
			_unbindEvents();

			_showOrHide(self.currItem, null, true, self.destroy);
		},

		// destroys the gallery (unbinds events, cleans up intervals and timeouts to avoid memory leaks)
		destroy: function() {
			_shout('destroy');

			if(_showOrHideTimeout) {
				clearTimeout(_showOrHideTimeout);
			}
			
			template.setAttribute('aria-hidden', 'true');
			template.className = _initalClassName;

			if(_updateSizeInterval) {
				clearInterval(_updateSizeInterval);
			}

			framework.unbind(self.scrollWrap, _downEvents, self);

			// we unbind scroll event at the end, as closing animation may depend on it
			framework.unbind(window, 'scroll', self);

			_stopDragUpdateLoop();

			_stopAllAnimations();

			_listeners = null;
		},

		/**
		 * Pan image to position
		 * @param {Number} x     
		 * @param {Number} y     
		 * @param {Boolean} force Will ignore bounds if set to true.
		 */
		panTo: function(x,y,force) {
			if(!force) {
				if(x > _currPanBounds.min.x) {
					x = _currPanBounds.min.x;
				} else if(x < _currPanBounds.max.x) {
					x = _currPanBounds.max.x;
				}

				if(y > _currPanBounds.min.y) {
					y = _currPanBounds.min.y;
				} else if(y < _currPanBounds.max.y) {
					y = _currPanBounds.max.y;
				}
			}
			
			_panOffset.x = x;
			_panOffset.y = y;
			_applyCurrentZoomPan();
		},
		
		handleEvent: function (e) {
			e = e || window.event;
			if(_globalEventHandlers[e.type]) {
				_globalEventHandlers[e.type](e);
			}
		},


		goTo: function(index) {

			index = _getLoopedId(index);

			var diff = index - _currentItemIndex;
			_indexDiff = diff;

			_currentItemIndex = index;
			self.currItem = _getItemAt( _currentItemIndex );
			_currPositionIndex -= diff;
			
			_moveMainScroll(_slideSize.x * _currPositionIndex);
			

			_stopAllAnimations();
			_mainScrollAnimating = false;

			self.updateCurrItem();
		},
		next: function() {
			self.goTo( _currentItemIndex + 1);
		},
		prev: function() {
			self.goTo( _currentItemIndex - 1);
		},

		// update current zoom/pan objects
		updateCurrZoomItem: function(emulateSetContent) {
			if(emulateSetContent) {
				_shout('beforeChange', 0);
			}

			// itemHolder[1] is middle (current) item
			if(_itemHolders[1].el.children.length) {
				var zoomElement = _itemHolders[1].el.children[0];
				if( framework.hasClass(zoomElement, 'pswp__zoom-wrap') ) {
					_currZoomElementStyle = zoomElement.style;
				} else {
					_currZoomElementStyle = null;
				}
			} else {
				_currZoomElementStyle = null;
			}
			
			_currPanBounds = self.currItem.bounds;	
			_startZoomLevel = _currZoomLevel = self.currItem.initialZoomLevel;

			_panOffset.x = _currPanBounds.center.x;
			_panOffset.y = _currPanBounds.center.y;

			if(emulateSetContent) {
				_shout('afterChange');
			}
		},


		invalidateCurrItems: function() {
			_itemsNeedUpdate = true;
			for(var i = 0; i < NUM_HOLDERS; i++) {
				if( _itemHolders[i].item ) {
					_itemHolders[i].item.needsUpdate = true;
				}
			}
		},

		updateCurrItem: function(beforeAnimation) {

			if(_indexDiff === 0) {
				return;
			}

			var diffAbs = Math.abs(_indexDiff),
				tempHolder;

			if(beforeAnimation && diffAbs < 2) {
				return;
			}


			self.currItem = _getItemAt( _currentItemIndex );
			_renderMaxResolution = false;
			
			_shout('beforeChange', _indexDiff);

			if(diffAbs >= NUM_HOLDERS) {
				_containerShiftIndex += _indexDiff + (_indexDiff > 0 ? -NUM_HOLDERS : NUM_HOLDERS);
				diffAbs = NUM_HOLDERS;
			}
			for(var i = 0; i < diffAbs; i++) {
				if(_indexDiff > 0) {
					tempHolder = _itemHolders.shift();
					_itemHolders[NUM_HOLDERS-1] = tempHolder; // move first to last

					_containerShiftIndex++;
					_setTranslateX( (_containerShiftIndex+2) * _slideSize.x, tempHolder.el.style);
					self.setContent(tempHolder, _currentItemIndex - diffAbs + i + 1 + 1);
				} else {
					tempHolder = _itemHolders.pop();
					_itemHolders.unshift( tempHolder ); // move last to first

					_containerShiftIndex--;
					_setTranslateX( _containerShiftIndex * _slideSize.x, tempHolder.el.style);
					self.setContent(tempHolder, _currentItemIndex + diffAbs - i - 1 - 1);
				}
				
			}

			// reset zoom/pan on previous item
			if(_currZoomElementStyle && Math.abs(_indexDiff) === 1) {

				var prevItem = _getItemAt(_prevItemIndex);
				if(prevItem.initialZoomLevel !== _currZoomLevel) {
					_calculateItemSize(prevItem , _viewportSize );
					_setImageSize(prevItem);
					_applyZoomPanToItem( prevItem ); 				
				}

			}

			// reset diff after update
			_indexDiff = 0;

			self.updateCurrZoomItem();

			_prevItemIndex = _currentItemIndex;

			_shout('afterChange');
			
		},



		updateSize: function(force) {
			
			if(!_isFixedPosition && _options.modal) {
				var windowScrollY = framework.getScrollY();
				if(_currentWindowScrollY !== windowScrollY) {
					template.style.top = windowScrollY + 'px';
					_currentWindowScrollY = windowScrollY;
				}
				if(!force && _windowVisibleSize.x === window.innerWidth && _windowVisibleSize.y === window.innerHeight) {
					return;
				}
				_windowVisibleSize.x = window.innerWidth;
				_windowVisibleSize.y = window.innerHeight;

				//template.style.width = _windowVisibleSize.x + 'px';
				template.style.height = _windowVisibleSize.y + 'px';
			}



			_viewportSize.x = self.scrollWrap.clientWidth;
			_viewportSize.y = self.scrollWrap.clientHeight;

			_updatePageScrollOffset();

			_slideSize.x = _viewportSize.x + Math.round(_viewportSize.x * _options.spacing);
			_slideSize.y = _viewportSize.y;

			_moveMainScroll(_slideSize.x * _currPositionIndex);

			_shout('beforeResize'); // even may be used for example to switch image sources


			// don't re-calculate size on inital size update
			if(_containerShiftIndex !== undefined) {

				var holder,
					item,
					hIndex;

				for(var i = 0; i < NUM_HOLDERS; i++) {
					holder = _itemHolders[i];
					_setTranslateX( (i+_containerShiftIndex) * _slideSize.x, holder.el.style);

					hIndex = _currentItemIndex+i-1;

					if(_options.loop && _getNumItems() > 2) {
						hIndex = _getLoopedId(hIndex);
					}

					// update zoom level on items and refresh source (if needsUpdate)
					item = _getItemAt( hIndex );

					// re-render gallery item if `needsUpdate`,
					// or doesn't have `bounds` (entirely new slide object)
					if( item && (_itemsNeedUpdate || item.needsUpdate || !item.bounds) ) {

						self.cleanSlide( item );
						
						self.setContent( holder, hIndex );

						// if "center" slide
						if(i === 1) {
							self.currItem = item;
							self.updateCurrZoomItem(true);
						}

						item.needsUpdate = false;

					} else if(holder.index === -1 && hIndex >= 0) {
						// add content first time
						self.setContent( holder, hIndex );
					}
					if(item && item.container) {
						_calculateItemSize(item, _viewportSize);
						_setImageSize(item);
						_applyZoomPanToItem( item );
					}
					
				}
				_itemsNeedUpdate = false;
			}	

			_startZoomLevel = _currZoomLevel = self.currItem.initialZoomLevel;
			_currPanBounds = self.currItem.bounds;

			if(_currPanBounds) {
				_panOffset.x = _currPanBounds.center.x;
				_panOffset.y = _currPanBounds.center.y;
				_applyCurrentZoomPan( true );
			}
			
			_shout('resize');
		},
		
		// Zoom current item to
		zoomTo: function(destZoomLevel, centerPoint, speed, easingFn, updateFn) {
			/*
				if(destZoomLevel === 'fit') {
					destZoomLevel = self.currItem.fitRatio;
				} else if(destZoomLevel === 'fill') {
					destZoomLevel = self.currItem.fillRatio;
				}
			*/

			if(centerPoint) {
				_startZoomLevel = _currZoomLevel;
				_midZoomPoint.x = Math.abs(centerPoint.x) - _panOffset.x ;
				_midZoomPoint.y = Math.abs(centerPoint.y) - _panOffset.y ;
				_equalizePoints(_startPanOffset, _panOffset);
			}

			var destPanBounds = _calculatePanBounds(destZoomLevel, false),
				destPanOffset = {};

			_modifyDestPanOffset('x', destPanBounds, destPanOffset, destZoomLevel);
			_modifyDestPanOffset('y', destPanBounds, destPanOffset, destZoomLevel);

			var initialZoomLevel = _currZoomLevel;
			var initialPanOffset = {
				x: _panOffset.x,
				y: _panOffset.y
			};

			_roundPoint(destPanOffset);

			var onUpdate = function(now) {
				if(now === 1) {
					_currZoomLevel = destZoomLevel;
					_panOffset.x = destPanOffset.x;
					_panOffset.y = destPanOffset.y;
				} else {
					_currZoomLevel = (destZoomLevel - initialZoomLevel) * now + initialZoomLevel;
					_panOffset.x = (destPanOffset.x - initialPanOffset.x) * now + initialPanOffset.x;
					_panOffset.y = (destPanOffset.y - initialPanOffset.y) * now + initialPanOffset.y;
				}

				if(updateFn) {
					updateFn(now);
				}

				_applyCurrentZoomPan( now === 1 );
			};

			if(speed) {
				_animateProp('customZoomTo', 0, 1, speed, easingFn || framework.easing.sine.inOut, onUpdate);
			} else {
				onUpdate(1);
			}
		}


	};


	/*>>core*/

	/*>>gestures*/
	/**
	 * Mouse/touch/pointer event handlers.
	 * 
	 * separated from @core.js for readability
	 */

	var MIN_SWIPE_DISTANCE = 30,
		DIRECTION_CHECK_OFFSET = 10; // amount of pixels to drag to determine direction of swipe

	var _gestureStartTime,
		_gestureCheckSpeedTime,

		// pool of objects that are used during dragging of zooming
		p = {}, // first point
		p2 = {}, // second point (for zoom gesture)
		delta = {},
		_currPoint = {},
		_startPoint = {},
		_currPointers = [],
		_startMainScrollPos = {},
		_releaseAnimData,
		_posPoints = [], // array of points during dragging, used to determine type of gesture
		_tempPoint = {},

		_isZoomingIn,
		_verticalDragInitiated,
		_oldAndroidTouchEndTimeout,
		_currZoomedItemIndex = 0,
		_centerPoint = _getEmptyPoint(),
		_lastReleaseTime = 0,
		_isDragging, // at least one pointer is down
		_isMultitouch, // at least two _pointers are down
		_zoomStarted, // zoom level changed during zoom gesture
		_moved,
		_dragAnimFrame,
		_mainScrollShifted,
		_currentPoints, // array of current touch points
		_isZooming,
		_currPointsDistance,
		_startPointsDistance,
		_currPanBounds,
		_mainScrollPos = _getEmptyPoint(),
		_currZoomElementStyle,
		_mainScrollAnimating, // true, if animation after swipe gesture is running
		_midZoomPoint = _getEmptyPoint(),
		_currCenterPoint = _getEmptyPoint(),
		_direction,
		_isFirstMove,
		_opacityChanged,
		_bgOpacity,
		_wasOverInitialZoom,

		_isEqualPoints = function(p1, p2) {
			return p1.x === p2.x && p1.y === p2.y;
		},
		_isNearbyPoints = function(touch0, touch1) {
			return Math.abs(touch0.x - touch1.x) < DOUBLE_TAP_RADIUS && Math.abs(touch0.y - touch1.y) < DOUBLE_TAP_RADIUS;
		},
		_calculatePointsDistance = function(p1, p2) {
			_tempPoint.x = Math.abs( p1.x - p2.x );
			_tempPoint.y = Math.abs( p1.y - p2.y );
			return Math.sqrt(_tempPoint.x * _tempPoint.x + _tempPoint.y * _tempPoint.y);
		},
		_stopDragUpdateLoop = function() {
			if(_dragAnimFrame) {
				_cancelAF(_dragAnimFrame);
				_dragAnimFrame = null;
			}
		},
		_dragUpdateLoop = function() {
			if(_isDragging) {
				_dragAnimFrame = _requestAF(_dragUpdateLoop);
				_renderMovement();
			}
		},
		_canPan = function() {
			return !(_options.scaleMode === 'fit' && _currZoomLevel ===  self.currItem.initialZoomLevel);
		},
		
		// find the closest parent DOM element
		_closestElement = function(el, fn) {
		  	if(!el || el === document) {
		  		return false;
		  	}

		  	// don't search elements above pswp__scroll-wrap
		  	if(el.getAttribute('class') && el.getAttribute('class').indexOf('pswp__scroll-wrap') > -1 ) {
		  		return false;
		  	}

		  	if( fn(el) ) {
		  		return el;
		  	}

		  	return _closestElement(el.parentNode, fn);
		},

		_preventObj = {},
		_preventDefaultEventBehaviour = function(e, isDown) {
		    _preventObj.prevent = !_closestElement(e.target, _options.isClickableElement);

			_shout('preventDragEvent', e, isDown, _preventObj);
			return _preventObj.prevent;

		},
		_convertTouchToPoint = function(touch, p) {
			p.x = touch.pageX;
			p.y = touch.pageY;
			p.id = touch.identifier;
			return p;
		},
		_findCenterOfPoints = function(p1, p2, pCenter) {
			pCenter.x = (p1.x + p2.x) * 0.5;
			pCenter.y = (p1.y + p2.y) * 0.5;
		},
		_pushPosPoint = function(time, x, y) {
			if(time - _gestureCheckSpeedTime > 50) {
				var o = _posPoints.length > 2 ? _posPoints.shift() : {};
				o.x = x;
				o.y = y; 
				_posPoints.push(o);
				_gestureCheckSpeedTime = time;
			}
		},

		_calculateVerticalDragOpacityRatio = function() {
			var yOffset = _panOffset.y - self.currItem.initialPosition.y; // difference between initial and current position
			return 1 -  Math.abs( yOffset / (_viewportSize.y / 2)  );
		},

		
		// points pool, reused during touch events
		_ePoint1 = {},
		_ePoint2 = {},
		_tempPointsArr = [],
		_tempCounter,
		_getTouchPoints = function(e) {
			// clean up previous points, without recreating array
			while(_tempPointsArr.length > 0) {
				_tempPointsArr.pop();
			}

			if(!_pointerEventEnabled) {
				if(e.type.indexOf('touch') > -1) {

					if(e.touches && e.touches.length > 0) {
						_tempPointsArr[0] = _convertTouchToPoint(e.touches[0], _ePoint1);
						if(e.touches.length > 1) {
							_tempPointsArr[1] = _convertTouchToPoint(e.touches[1], _ePoint2);
						}
					}
					
				} else {
					_ePoint1.x = e.pageX;
					_ePoint1.y = e.pageY;
					_ePoint1.id = '';
					_tempPointsArr[0] = _ePoint1;//_ePoint1;
				}
			} else {
				_tempCounter = 0;
				// we can use forEach, as pointer events are supported only in modern browsers
				_currPointers.forEach(function(p) {
					if(_tempCounter === 0) {
						_tempPointsArr[0] = p;
					} else if(_tempCounter === 1) {
						_tempPointsArr[1] = p;
					}
					_tempCounter++;

				});
			}
			return _tempPointsArr;
		},

		_panOrMoveMainScroll = function(axis, delta) {

			var panFriction,
				overDiff = 0,
				newOffset = _panOffset[axis] + delta[axis],
				startOverDiff,
				dir = delta[axis] > 0,
				newMainScrollPosition = _mainScrollPos.x + delta.x,
				mainScrollDiff = _mainScrollPos.x - _startMainScrollPos.x,
				newPanPos,
				newMainScrollPos;

			// calculate fdistance over the bounds and friction
			if(newOffset > _currPanBounds.min[axis] || newOffset < _currPanBounds.max[axis]) {
				panFriction = _options.panEndFriction;
				// Linear increasing of friction, so at 1/4 of viewport it's at max value. 
				// Looks not as nice as was expected. Left for history.
				// panFriction = (1 - (_panOffset[axis] + delta[axis] + panBounds.min[axis]) / (_viewportSize[axis] / 4) );
			} else {
				panFriction = 1;
			}
			
			newOffset = _panOffset[axis] + delta[axis] * panFriction;

			// move main scroll or start panning
			if(_options.allowPanToNext || _currZoomLevel === self.currItem.initialZoomLevel) {


				if(!_currZoomElementStyle) {
					
					newMainScrollPos = newMainScrollPosition;

				} else if(_direction === 'h' && axis === 'x' && !_zoomStarted ) {
					
					if(dir) {
						if(newOffset > _currPanBounds.min[axis]) {
							panFriction = _options.panEndFriction;
							overDiff = _currPanBounds.min[axis] - newOffset;
							startOverDiff = _currPanBounds.min[axis] - _startPanOffset[axis];
						}
						
						// drag right
						if( (startOverDiff <= 0 || mainScrollDiff < 0) && _getNumItems() > 1 ) {
							newMainScrollPos = newMainScrollPosition;
							if(mainScrollDiff < 0 && newMainScrollPosition > _startMainScrollPos.x) {
								newMainScrollPos = _startMainScrollPos.x;
							}
						} else {
							if(_currPanBounds.min.x !== _currPanBounds.max.x) {
								newPanPos = newOffset;
							}
							
						}

					} else {

						if(newOffset < _currPanBounds.max[axis] ) {
							panFriction =_options.panEndFriction;
							overDiff = newOffset - _currPanBounds.max[axis];
							startOverDiff = _startPanOffset[axis] - _currPanBounds.max[axis];
						}

						if( (startOverDiff <= 0 || mainScrollDiff > 0) && _getNumItems() > 1 ) {
							newMainScrollPos = newMainScrollPosition;

							if(mainScrollDiff > 0 && newMainScrollPosition < _startMainScrollPos.x) {
								newMainScrollPos = _startMainScrollPos.x;
							}

						} else {
							if(_currPanBounds.min.x !== _currPanBounds.max.x) {
								newPanPos = newOffset;
							}
						}

					}


					//
				}

				if(axis === 'x') {

					if(newMainScrollPos !== undefined) {
						_moveMainScroll(newMainScrollPos, true);
						if(newMainScrollPos === _startMainScrollPos.x) {
							_mainScrollShifted = false;
						} else {
							_mainScrollShifted = true;
						}
					}

					if(_currPanBounds.min.x !== _currPanBounds.max.x) {
						if(newPanPos !== undefined) {
							_panOffset.x = newPanPos;
						} else if(!_mainScrollShifted) {
							_panOffset.x += delta.x * panFriction;
						}
					}

					return newMainScrollPos !== undefined;
				}

			}

			if(!_mainScrollAnimating) {
				
				if(!_mainScrollShifted) {
					if(_currZoomLevel > self.currItem.fitRatio) {
						_panOffset[axis] += delta[axis] * panFriction;
					
					}
				}

				
			}
			
		},

		// Pointerdown/touchstart/mousedown handler
		_onDragStart = function(e) {

			// Allow dragging only via left mouse button.
			// As this handler is not added in IE8 - we ignore e.which
			// 
			// http://www.quirksmode.org/js/events_properties.html
			// https://developer.mozilla.org/en-US/docs/Web/API/event.button
			if(e.type === 'mousedown' && e.button > 0  ) {
				return;
			}

			if(_initialZoomRunning) {
				e.preventDefault();
				return;
			}

			if(_oldAndroidTouchEndTimeout && e.type === 'mousedown') {
				return;
			}

			if(_preventDefaultEventBehaviour(e, true)) {
				e.preventDefault();
			}



			_shout('pointerDown');

			if(_pointerEventEnabled) {
				var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');
				if(pointerIndex < 0) {
					pointerIndex = _currPointers.length;
				}
				_currPointers[pointerIndex] = {x:e.pageX, y:e.pageY, id: e.pointerId};
			}
			


			var startPointsList = _getTouchPoints(e),
				numPoints = startPointsList.length;

			_currentPoints = null;

			_stopAllAnimations();

			// init drag
			if(!_isDragging || numPoints === 1) {

				

				_isDragging = _isFirstMove = true;
				framework.bind(window, _upMoveEvents, self);

				_isZoomingIn = 
					_wasOverInitialZoom = 
					_opacityChanged = 
					_verticalDragInitiated = 
					_mainScrollShifted = 
					_moved = 
					_isMultitouch = 
					_zoomStarted = false;

				_direction = null;

				_shout('firstTouchStart', startPointsList);

				_equalizePoints(_startPanOffset, _panOffset);

				_currPanDist.x = _currPanDist.y = 0;
				_equalizePoints(_currPoint, startPointsList[0]);
				_equalizePoints(_startPoint, _currPoint);

				//_equalizePoints(_startMainScrollPos, _mainScrollPos);
				_startMainScrollPos.x = _slideSize.x * _currPositionIndex;

				_posPoints = [{
					x: _currPoint.x,
					y: _currPoint.y
				}];

				_gestureCheckSpeedTime = _gestureStartTime = _getCurrentTime();

				//_mainScrollAnimationEnd(true);
				_calculatePanBounds( _currZoomLevel, true );
				
				// Start rendering
				_stopDragUpdateLoop();
				_dragUpdateLoop();
				
			}

			// init zoom
			if(!_isZooming && numPoints > 1 && !_mainScrollAnimating && !_mainScrollShifted) {
				_startZoomLevel = _currZoomLevel;
				_zoomStarted = false; // true if zoom changed at least once

				_isZooming = _isMultitouch = true;
				_currPanDist.y = _currPanDist.x = 0;

				_equalizePoints(_startPanOffset, _panOffset);

				_equalizePoints(p, startPointsList[0]);
				_equalizePoints(p2, startPointsList[1]);

				_findCenterOfPoints(p, p2, _currCenterPoint);

				_midZoomPoint.x = Math.abs(_currCenterPoint.x) - _panOffset.x;
				_midZoomPoint.y = Math.abs(_currCenterPoint.y) - _panOffset.y;
				_currPointsDistance = _startPointsDistance = _calculatePointsDistance(p, p2);
			}


		},

		// Pointermove/touchmove/mousemove handler
		_onDragMove = function(e) {

			e.preventDefault();

			if(_pointerEventEnabled) {
				var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');
				if(pointerIndex > -1) {
					var p = _currPointers[pointerIndex];
					p.x = e.pageX;
					p.y = e.pageY; 
				}
			}

			if(_isDragging) {
				var touchesList = _getTouchPoints(e);
				if(!_direction && !_moved && !_isZooming) {

					if(_mainScrollPos.x !== _slideSize.x * _currPositionIndex) {
						// if main scroll position is shifted – direction is always horizontal
						_direction = 'h';
					} else {
						var diff = Math.abs(touchesList[0].x - _currPoint.x) - Math.abs(touchesList[0].y - _currPoint.y);
						// check the direction of movement
						if(Math.abs(diff) >= DIRECTION_CHECK_OFFSET) {
							_direction = diff > 0 ? 'h' : 'v';
							_currentPoints = touchesList;
						}
					}
					
				} else {
					_currentPoints = touchesList;
				}
			}	
		},
		// 
		_renderMovement =  function() {

			if(!_currentPoints) {
				return;
			}

			var numPoints = _currentPoints.length;

			if(numPoints === 0) {
				return;
			}

			_equalizePoints(p, _currentPoints[0]);

			delta.x = p.x - _currPoint.x;
			delta.y = p.y - _currPoint.y;

			if(_isZooming && numPoints > 1) {
				// Handle behaviour for more than 1 point

				_currPoint.x = p.x;
				_currPoint.y = p.y;
			
				// check if one of two points changed
				if( !delta.x && !delta.y && _isEqualPoints(_currentPoints[1], p2) ) {
					return;
				}

				_equalizePoints(p2, _currentPoints[1]);


				if(!_zoomStarted) {
					_zoomStarted = true;
					_shout('zoomGestureStarted');
				}
				
				// Distance between two points
				var pointsDistance = _calculatePointsDistance(p,p2);

				var zoomLevel = _calculateZoomLevel(pointsDistance);

				// slightly over the of initial zoom level
				if(zoomLevel > self.currItem.initialZoomLevel + self.currItem.initialZoomLevel / 15) {
					_wasOverInitialZoom = true;
				}

				// Apply the friction if zoom level is out of the bounds
				var zoomFriction = 1,
					minZoomLevel = _getMinZoomLevel(),
					maxZoomLevel = _getMaxZoomLevel();

				if ( zoomLevel < minZoomLevel ) {
					
					if(_options.pinchToClose && !_wasOverInitialZoom && _startZoomLevel <= self.currItem.initialZoomLevel) {
						// fade out background if zooming out
						var minusDiff = minZoomLevel - zoomLevel;
						var percent = 1 - minusDiff / (minZoomLevel / 1.2);

						_applyBgOpacity(percent);
						_shout('onPinchClose', percent);
						_opacityChanged = true;
					} else {
						zoomFriction = (minZoomLevel - zoomLevel) / minZoomLevel;
						if(zoomFriction > 1) {
							zoomFriction = 1;
						}
						zoomLevel = minZoomLevel - zoomFriction * (minZoomLevel / 3);
					}
					
				} else if ( zoomLevel > maxZoomLevel ) {
					// 1.5 - extra zoom level above the max. E.g. if max is x6, real max 6 + 1.5 = 7.5
					zoomFriction = (zoomLevel - maxZoomLevel) / ( minZoomLevel * 6 );
					if(zoomFriction > 1) {
						zoomFriction = 1;
					}
					zoomLevel = maxZoomLevel + zoomFriction * minZoomLevel;
				}

				if(zoomFriction < 0) {
					zoomFriction = 0;
				}

				// distance between touch points after friction is applied
				_currPointsDistance = pointsDistance;

				// _centerPoint - The point in the middle of two pointers
				_findCenterOfPoints(p, p2, _centerPoint);
			
				// paning with two pointers pressed
				_currPanDist.x += _centerPoint.x - _currCenterPoint.x;
				_currPanDist.y += _centerPoint.y - _currCenterPoint.y;
				_equalizePoints(_currCenterPoint, _centerPoint);

				_panOffset.x = _calculatePanOffset('x', zoomLevel);
				_panOffset.y = _calculatePanOffset('y', zoomLevel);

				_isZoomingIn = zoomLevel > _currZoomLevel;
				_currZoomLevel = zoomLevel;
				_applyCurrentZoomPan();

			} else {

				// handle behaviour for one point (dragging or panning)

				if(!_direction) {
					return;
				}

				if(_isFirstMove) {
					_isFirstMove = false;

					// subtract drag distance that was used during the detection direction  

					if( Math.abs(delta.x) >= DIRECTION_CHECK_OFFSET) {
						delta.x -= _currentPoints[0].x - _startPoint.x;
					}
					
					if( Math.abs(delta.y) >= DIRECTION_CHECK_OFFSET) {
						delta.y -= _currentPoints[0].y - _startPoint.y;
					}
				}

				_currPoint.x = p.x;
				_currPoint.y = p.y;

				// do nothing if pointers position hasn't changed
				if(delta.x === 0 && delta.y === 0) {
					return;
				}

				if(_direction === 'v' && _options.closeOnVerticalDrag) {
					if(!_canPan()) {
						_currPanDist.y += delta.y;
						_panOffset.y += delta.y;

						var opacityRatio = _calculateVerticalDragOpacityRatio();

						_verticalDragInitiated = true;
						_shout('onVerticalDrag', opacityRatio);

						_applyBgOpacity(opacityRatio);
						_applyCurrentZoomPan();
						return ;
					}
				}

				_pushPosPoint(_getCurrentTime(), p.x, p.y);

				_moved = true;
				_currPanBounds = self.currItem.bounds;
				
				var mainScrollChanged = _panOrMoveMainScroll('x', delta);
				if(!mainScrollChanged) {
					_panOrMoveMainScroll('y', delta);

					_roundPoint(_panOffset);
					_applyCurrentZoomPan();
				}

			}

		},
		
		// Pointerup/pointercancel/touchend/touchcancel/mouseup event handler
		_onDragRelease = function(e) {

			if(_features.isOldAndroid ) {

				if(_oldAndroidTouchEndTimeout && e.type === 'mouseup') {
					return;
				}

				// on Android (v4.1, 4.2, 4.3 & possibly older) 
				// ghost mousedown/up event isn't preventable via e.preventDefault,
				// which causes fake mousedown event
				// so we block mousedown/up for 600ms
				if( e.type.indexOf('touch') > -1 ) {
					clearTimeout(_oldAndroidTouchEndTimeout);
					_oldAndroidTouchEndTimeout = setTimeout(function() {
						_oldAndroidTouchEndTimeout = 0;
					}, 600);
				}
				
			}

			_shout('pointerUp');

			if(_preventDefaultEventBehaviour(e, false)) {
				e.preventDefault();
			}

			var releasePoint;

			if(_pointerEventEnabled) {
				var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');
				
				if(pointerIndex > -1) {
					releasePoint = _currPointers.splice(pointerIndex, 1)[0];

					if(navigator.pointerEnabled) {
						releasePoint.type = e.pointerType || 'mouse';
					} else {
						var MSPOINTER_TYPES = {
							4: 'mouse', // event.MSPOINTER_TYPE_MOUSE
							2: 'touch', // event.MSPOINTER_TYPE_TOUCH 
							3: 'pen' // event.MSPOINTER_TYPE_PEN
						};
						releasePoint.type = MSPOINTER_TYPES[e.pointerType];

						if(!releasePoint.type) {
							releasePoint.type = e.pointerType || 'mouse';
						}
					}

				}
			}

			var touchList = _getTouchPoints(e),
				gestureType,
				numPoints = touchList.length;

			if(e.type === 'mouseup') {
				numPoints = 0;
			}

			// Do nothing if there were 3 touch points or more
			if(numPoints === 2) {
				_currentPoints = null;
				return true;
			}

			// if second pointer released
			if(numPoints === 1) {
				_equalizePoints(_startPoint, touchList[0]);
			}				


			// pointer hasn't moved, send "tap release" point
			if(numPoints === 0 && !_direction && !_mainScrollAnimating) {
				if(!releasePoint) {
					if(e.type === 'mouseup') {
						releasePoint = {x: e.pageX, y: e.pageY, type:'mouse'};
					} else if(e.changedTouches && e.changedTouches[0]) {
						releasePoint = {x: e.changedTouches[0].pageX, y: e.changedTouches[0].pageY, type:'touch'};
					}		
				}

				_shout('touchRelease', e, releasePoint);
			}

			// Difference in time between releasing of two last touch points (zoom gesture)
			var releaseTimeDiff = -1;

			// Gesture completed, no pointers left
			if(numPoints === 0) {
				_isDragging = false;
				framework.unbind(window, _upMoveEvents, self);

				_stopDragUpdateLoop();

				if(_isZooming) {
					// Two points released at the same time
					releaseTimeDiff = 0;
				} else if(_lastReleaseTime !== -1) {
					releaseTimeDiff = _getCurrentTime() - _lastReleaseTime;
				}
			}
			_lastReleaseTime = numPoints === 1 ? _getCurrentTime() : -1;
			
			if(releaseTimeDiff !== -1 && releaseTimeDiff < 150) {
				gestureType = 'zoom';
			} else {
				gestureType = 'swipe';
			}

			if(_isZooming && numPoints < 2) {
				_isZooming = false;

				// Only second point released
				if(numPoints === 1) {
					gestureType = 'zoomPointerUp';
				}
				_shout('zoomGestureEnded');
			}

			_currentPoints = null;
			if(!_moved && !_zoomStarted && !_mainScrollAnimating && !_verticalDragInitiated) {
				// nothing to animate
				return;
			}
		
			_stopAllAnimations();

			
			if(!_releaseAnimData) {
				_releaseAnimData = _initDragReleaseAnimationData();
			}
			
			_releaseAnimData.calculateSwipeSpeed('x');


			if(_verticalDragInitiated) {

				var opacityRatio = _calculateVerticalDragOpacityRatio();

				if(opacityRatio < _options.verticalDragRange) {
					self.close();
				} else {
					var initalPanY = _panOffset.y,
						initialBgOpacity = _bgOpacity;

					_animateProp('verticalDrag', 0, 1, 300, framework.easing.cubic.out, function(now) {
						
						_panOffset.y = (self.currItem.initialPosition.y - initalPanY) * now + initalPanY;

						_applyBgOpacity(  (1 - initialBgOpacity) * now + initialBgOpacity );
						_applyCurrentZoomPan();
					});

					_shout('onVerticalDrag', 1);
				}

				return;
			}


			// main scroll 
			if(  (_mainScrollShifted || _mainScrollAnimating) && numPoints === 0) {
				var itemChanged = _finishSwipeMainScrollGesture(gestureType, _releaseAnimData);
				if(itemChanged) {
					return;
				}
				gestureType = 'zoomPointerUp';
			}

			// prevent zoom/pan animation when main scroll animation runs
			if(_mainScrollAnimating) {
				return;
			}
			
			// Complete simple zoom gesture (reset zoom level if it's out of the bounds)  
			if(gestureType !== 'swipe') {
				_completeZoomGesture();
				return;
			}
		
			// Complete pan gesture if main scroll is not shifted, and it's possible to pan current image
			if(!_mainScrollShifted && _currZoomLevel > self.currItem.fitRatio) {
				_completePanGesture(_releaseAnimData);
			}
		},


		// Returns object with data about gesture
		// It's created only once and then reused
		_initDragReleaseAnimationData  = function() {
			// temp local vars
			var lastFlickDuration,
				tempReleasePos;

			// s = this
			var s = {
				lastFlickOffset: {},
				lastFlickDist: {},
				lastFlickSpeed: {},
				slowDownRatio:  {},
				slowDownRatioReverse:  {},
				speedDecelerationRatio:  {},
				speedDecelerationRatioAbs:  {},
				distanceOffset:  {},
				backAnimDestination: {},
				backAnimStarted: {},
				calculateSwipeSpeed: function(axis) {
					

					if( _posPoints.length > 1) {
						lastFlickDuration = _getCurrentTime() - _gestureCheckSpeedTime + 50;
						tempReleasePos = _posPoints[_posPoints.length-2][axis];
					} else {
						lastFlickDuration = _getCurrentTime() - _gestureStartTime; // total gesture duration
						tempReleasePos = _startPoint[axis];
					}
					s.lastFlickOffset[axis] = _currPoint[axis] - tempReleasePos;
					s.lastFlickDist[axis] = Math.abs(s.lastFlickOffset[axis]);
					if(s.lastFlickDist[axis] > 20) {
						s.lastFlickSpeed[axis] = s.lastFlickOffset[axis] / lastFlickDuration;
					} else {
						s.lastFlickSpeed[axis] = 0;
					}
					if( Math.abs(s.lastFlickSpeed[axis]) < 0.1 ) {
						s.lastFlickSpeed[axis] = 0;
					}
					
					s.slowDownRatio[axis] = 0.95;
					s.slowDownRatioReverse[axis] = 1 - s.slowDownRatio[axis];
					s.speedDecelerationRatio[axis] = 1;
				},

				calculateOverBoundsAnimOffset: function(axis, speed) {
					if(!s.backAnimStarted[axis]) {

						if(_panOffset[axis] > _currPanBounds.min[axis]) {
							s.backAnimDestination[axis] = _currPanBounds.min[axis];
							
						} else if(_panOffset[axis] < _currPanBounds.max[axis]) {
							s.backAnimDestination[axis] = _currPanBounds.max[axis];
						}

						if(s.backAnimDestination[axis] !== undefined) {
							s.slowDownRatio[axis] = 0.7;
							s.slowDownRatioReverse[axis] = 1 - s.slowDownRatio[axis];
							if(s.speedDecelerationRatioAbs[axis] < 0.05) {

								s.lastFlickSpeed[axis] = 0;
								s.backAnimStarted[axis] = true;

								_animateProp('bounceZoomPan'+axis,_panOffset[axis], 
									s.backAnimDestination[axis], 
									speed || 300, 
									framework.easing.sine.out, 
									function(pos) {
										_panOffset[axis] = pos;
										_applyCurrentZoomPan();
									}
								);

							}
						}
					}
				},

				// Reduces the speed by slowDownRatio (per 10ms)
				calculateAnimOffset: function(axis) {
					if(!s.backAnimStarted[axis]) {
						s.speedDecelerationRatio[axis] = s.speedDecelerationRatio[axis] * (s.slowDownRatio[axis] + 
													s.slowDownRatioReverse[axis] - 
													s.slowDownRatioReverse[axis] * s.timeDiff / 10);

						s.speedDecelerationRatioAbs[axis] = Math.abs(s.lastFlickSpeed[axis] * s.speedDecelerationRatio[axis]);
						s.distanceOffset[axis] = s.lastFlickSpeed[axis] * s.speedDecelerationRatio[axis] * s.timeDiff;
						_panOffset[axis] += s.distanceOffset[axis];

					}
				},

				panAnimLoop: function() {
					if ( _animations.zoomPan ) {
						_animations.zoomPan.raf = _requestAF(s.panAnimLoop);

						s.now = _getCurrentTime();
						s.timeDiff = s.now - s.lastNow;
						s.lastNow = s.now;
						
						s.calculateAnimOffset('x');
						s.calculateAnimOffset('y');

						_applyCurrentZoomPan();
						
						s.calculateOverBoundsAnimOffset('x');
						s.calculateOverBoundsAnimOffset('y');


						if (s.speedDecelerationRatioAbs.x < 0.05 && s.speedDecelerationRatioAbs.y < 0.05) {

							// round pan position
							_panOffset.x = Math.round(_panOffset.x);
							_panOffset.y = Math.round(_panOffset.y);
							_applyCurrentZoomPan();
							
							_stopAnimation('zoomPan');
							return;
						}
					}

				}
			};
			return s;
		},

		_completePanGesture = function(animData) {
			// calculate swipe speed for Y axis (paanning)
			animData.calculateSwipeSpeed('y');

			_currPanBounds = self.currItem.bounds;
			
			animData.backAnimDestination = {};
			animData.backAnimStarted = {};

			// Avoid acceleration animation if speed is too low
			if(Math.abs(animData.lastFlickSpeed.x) <= 0.05 && Math.abs(animData.lastFlickSpeed.y) <= 0.05 ) {
				animData.speedDecelerationRatioAbs.x = animData.speedDecelerationRatioAbs.y = 0;

				// Run pan drag release animation. E.g. if you drag image and release finger without momentum.
				animData.calculateOverBoundsAnimOffset('x');
				animData.calculateOverBoundsAnimOffset('y');
				return true;
			}

			// Animation loop that controls the acceleration after pan gesture ends
			_registerStartAnimation('zoomPan');
			animData.lastNow = _getCurrentTime();
			animData.panAnimLoop();
		},


		_finishSwipeMainScrollGesture = function(gestureType, _releaseAnimData) {
			var itemChanged;
			if(!_mainScrollAnimating) {
				_currZoomedItemIndex = _currentItemIndex;
			}


			
			var itemsDiff;

			if(gestureType === 'swipe') {
				var totalShiftDist = _currPoint.x - _startPoint.x,
					isFastLastFlick = _releaseAnimData.lastFlickDist.x < 10;

				// if container is shifted for more than MIN_SWIPE_DISTANCE, 
				// and last flick gesture was in right direction
				if(totalShiftDist > MIN_SWIPE_DISTANCE && 
					(isFastLastFlick || _releaseAnimData.lastFlickOffset.x > 20) ) {
					// go to prev item
					itemsDiff = -1;
				} else if(totalShiftDist < -MIN_SWIPE_DISTANCE && 
					(isFastLastFlick || _releaseAnimData.lastFlickOffset.x < -20) ) {
					// go to next item
					itemsDiff = 1;
				}
			}

			var nextCircle;

			if(itemsDiff) {
				
				_currentItemIndex += itemsDiff;

				if(_currentItemIndex < 0) {
					_currentItemIndex = _options.loop ? _getNumItems()-1 : 0;
					nextCircle = true;
				} else if(_currentItemIndex >= _getNumItems()) {
					_currentItemIndex = _options.loop ? 0 : _getNumItems()-1;
					nextCircle = true;
				}

				if(!nextCircle || _options.loop) {
					_indexDiff += itemsDiff;
					_currPositionIndex -= itemsDiff;
					itemChanged = true;
				}
				

				
			}

			var animateToX = _slideSize.x * _currPositionIndex;
			var animateToDist = Math.abs( animateToX - _mainScrollPos.x );
			var finishAnimDuration;


			if(!itemChanged && animateToX > _mainScrollPos.x !== _releaseAnimData.lastFlickSpeed.x > 0) {
				// "return to current" duration, e.g. when dragging from slide 0 to -1
				finishAnimDuration = 333; 
			} else {
				finishAnimDuration = Math.abs(_releaseAnimData.lastFlickSpeed.x) > 0 ? 
										animateToDist / Math.abs(_releaseAnimData.lastFlickSpeed.x) : 
										333;

				finishAnimDuration = Math.min(finishAnimDuration, 400);
				finishAnimDuration = Math.max(finishAnimDuration, 250);
			}

			if(_currZoomedItemIndex === _currentItemIndex) {
				itemChanged = false;
			}
			
			_mainScrollAnimating = true;
			
			_shout('mainScrollAnimStart');

			_animateProp('mainScroll', _mainScrollPos.x, animateToX, finishAnimDuration, framework.easing.cubic.out, 
				_moveMainScroll,
				function() {
					_stopAllAnimations();
					_mainScrollAnimating = false;
					_currZoomedItemIndex = -1;
					
					if(itemChanged || _currZoomedItemIndex !== _currentItemIndex) {
						self.updateCurrItem();
					}
					
					_shout('mainScrollAnimComplete');
				}
			);

			if(itemChanged) {
				self.updateCurrItem(true);
			}

			return itemChanged;
		},

		_calculateZoomLevel = function(touchesDistance) {
			return  1 / _startPointsDistance * touchesDistance * _startZoomLevel;
		},

		// Resets zoom if it's out of bounds
		_completeZoomGesture = function() {
			var destZoomLevel = _currZoomLevel,
				minZoomLevel = _getMinZoomLevel(),
				maxZoomLevel = _getMaxZoomLevel();

			if ( _currZoomLevel < minZoomLevel ) {
				destZoomLevel = minZoomLevel;
			} else if ( _currZoomLevel > maxZoomLevel ) {
				destZoomLevel = maxZoomLevel;
			}

			var destOpacity = 1,
				onUpdate,
				initialOpacity = _bgOpacity;

			if(_opacityChanged && !_isZoomingIn && !_wasOverInitialZoom && _currZoomLevel < minZoomLevel) {
				//_closedByScroll = true;
				self.close();
				return true;
			}

			if(_opacityChanged) {
				onUpdate = function(now) {
					_applyBgOpacity(  (destOpacity - initialOpacity) * now + initialOpacity );
				};
			}

			self.zoomTo(destZoomLevel, 0, 200,  framework.easing.cubic.out, onUpdate);
			return true;
		};


	_registerModule('Gestures', {
		publicMethods: {

			initGestures: function() {

				// helper function that builds touch/pointer/mouse events
				var addEventNames = function(pref, down, move, up, cancel) {
					_dragStartEvent = pref + down;
					_dragMoveEvent = pref + move;
					_dragEndEvent = pref + up;
					if(cancel) {
						_dragCancelEvent = pref + cancel;
					} else {
						_dragCancelEvent = '';
					}
				};

				_pointerEventEnabled = _features.pointerEvent;
				if(_pointerEventEnabled && _features.touch) {
					// we don't need touch events, if browser supports pointer events
					_features.touch = false;
				}

				if(_pointerEventEnabled) {
					if(navigator.pointerEnabled) {
						addEventNames('pointer', 'down', 'move', 'up', 'cancel');
					} else {
						// IE10 pointer events are case-sensitive
						addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
					}
				} else if(_features.touch) {
					addEventNames('touch', 'start', 'move', 'end', 'cancel');
					_likelyTouchDevice = true;
				} else {
					addEventNames('mouse', 'down', 'move', 'up');	
				}

				_upMoveEvents = _dragMoveEvent + ' ' + _dragEndEvent  + ' ' +  _dragCancelEvent;
				_downEvents = _dragStartEvent;

				if(_pointerEventEnabled && !_likelyTouchDevice) {
					_likelyTouchDevice = (navigator.maxTouchPoints > 1) || (navigator.msMaxTouchPoints > 1);
				}
				// make variable public
				self.likelyTouchDevice = _likelyTouchDevice; 
				
				_globalEventHandlers[_dragStartEvent] = _onDragStart;
				_globalEventHandlers[_dragMoveEvent] = _onDragMove;
				_globalEventHandlers[_dragEndEvent] = _onDragRelease; // the Kraken

				if(_dragCancelEvent) {
					_globalEventHandlers[_dragCancelEvent] = _globalEventHandlers[_dragEndEvent];
				}

				// Bind mouse events on device with detected hardware touch support, in case it supports multiple types of input.
				if(_features.touch) {
					_downEvents += ' mousedown';
					_upMoveEvents += ' mousemove mouseup';
					_globalEventHandlers.mousedown = _globalEventHandlers[_dragStartEvent];
					_globalEventHandlers.mousemove = _globalEventHandlers[_dragMoveEvent];
					_globalEventHandlers.mouseup = _globalEventHandlers[_dragEndEvent];
				}

				if(!_likelyTouchDevice) {
					// don't allow pan to next slide from zoomed state on Desktop
					_options.allowPanToNext = false;
				}
			}

		}
	});


	/*>>gestures*/

	/*>>show-hide-transition*/
	/**
	 * show-hide-transition.js:
	 *
	 * Manages initial opening or closing transition.
	 *
	 * If you're not planning to use transition for gallery at all,
	 * you may set options hideAnimationDuration and showAnimationDuration to 0,
	 * and just delete startAnimation function.
	 * 
	 */


	var _showOrHideTimeout,
		_showOrHide = function(item, img, out, completeFn) {

			if(_showOrHideTimeout) {
				clearTimeout(_showOrHideTimeout);
			}

			_initialZoomRunning = true;
			_initialContentSet = true;
			
			// dimensions of small thumbnail {x:,y:,w:}.
			// Height is optional, as calculated based on large image.
			var thumbBounds; 
			if(item.initialLayout) {
				thumbBounds = item.initialLayout;
				item.initialLayout = null;
			} else {
				thumbBounds = _options.getThumbBoundsFn && _options.getThumbBoundsFn(_currentItemIndex);
			}

			var duration = out ? _options.hideAnimationDuration : _options.showAnimationDuration;

			var onComplete = function() {
				_stopAnimation('initialZoom');
				if(!out) {
					_applyBgOpacity(1);
					if(img) {
						img.style.display = 'block';
					}
					framework.addClass(template, 'pswp--animated-in');
					_shout('initialZoom' + (out ? 'OutEnd' : 'InEnd'));
				} else {
					self.template.removeAttribute('style');
					self.bg.removeAttribute('style');
				}

				if(completeFn) {
					completeFn();
				}
				_initialZoomRunning = false;
			};

			// if bounds aren't provided, just open gallery without animation
			if(!duration || !thumbBounds || thumbBounds.x === undefined) {

				_shout('initialZoom' + (out ? 'Out' : 'In') );

				_currZoomLevel = item.initialZoomLevel;
				_equalizePoints(_panOffset,  item.initialPosition );
				_applyCurrentZoomPan();

				template.style.opacity = out ? 0 : 1;
				_applyBgOpacity(1);

				if(duration) {
					setTimeout(function() {
						onComplete();
					}, duration);
				} else {
					onComplete();
				}

				return;
			}

			var startAnimation = function() {
				var closeWithRaf = _closedByScroll,
					fadeEverything = !self.currItem.src || self.currItem.loadError || _options.showHideOpacity;
				
				// apply hw-acceleration to image
				if(item.miniImg) {
					item.miniImg.style.webkitBackfaceVisibility = 'hidden';
				}

				if(!out) {
					_currZoomLevel = thumbBounds.w / item.w;
					_panOffset.x = thumbBounds.x;
					_panOffset.y = thumbBounds.y - _initalWindowScrollY;

					self[fadeEverything ? 'template' : 'bg'].style.opacity = 0.001;
					_applyCurrentZoomPan();
				}

				_registerStartAnimation('initialZoom');
				
				if(out && !closeWithRaf) {
					framework.removeClass(template, 'pswp--animated-in');
				}

				if(fadeEverything) {
					if(out) {
						framework[ (closeWithRaf ? 'remove' : 'add') + 'Class' ](template, 'pswp--animate_opacity');
					} else {
						setTimeout(function() {
							framework.addClass(template, 'pswp--animate_opacity');
						}, 30);
					}
				}

				_showOrHideTimeout = setTimeout(function() {

					_shout('initialZoom' + (out ? 'Out' : 'In') );
					

					if(!out) {

						// "in" animation always uses CSS transitions (instead of rAF).
						// CSS transition work faster here, 
						// as developer may also want to animate other things, 
						// like ui on top of sliding area, which can be animated just via CSS
						
						_currZoomLevel = item.initialZoomLevel;
						_equalizePoints(_panOffset,  item.initialPosition );
						_applyCurrentZoomPan();
						_applyBgOpacity(1);

						if(fadeEverything) {
							template.style.opacity = 1;
						} else {
							_applyBgOpacity(1);
						}

						_showOrHideTimeout = setTimeout(onComplete, duration + 20);
					} else {

						// "out" animation uses rAF only when PhotoSwipe is closed by browser scroll, to recalculate position
						var destZoomLevel = thumbBounds.w / item.w,
							initialPanOffset = {
								x: _panOffset.x,
								y: _panOffset.y
							},
							initialZoomLevel = _currZoomLevel,
							initalBgOpacity = _bgOpacity,
							onUpdate = function(now) {
								
								if(now === 1) {
									_currZoomLevel = destZoomLevel;
									_panOffset.x = thumbBounds.x;
									_panOffset.y = thumbBounds.y  - _currentWindowScrollY;
								} else {
									_currZoomLevel = (destZoomLevel - initialZoomLevel) * now + initialZoomLevel;
									_panOffset.x = (thumbBounds.x - initialPanOffset.x) * now + initialPanOffset.x;
									_panOffset.y = (thumbBounds.y - _currentWindowScrollY - initialPanOffset.y) * now + initialPanOffset.y;
								}
								
								_applyCurrentZoomPan();
								if(fadeEverything) {
									template.style.opacity = 1 - now;
								} else {
									_applyBgOpacity( initalBgOpacity - now * initalBgOpacity );
								}
							};

						if(closeWithRaf) {
							_animateProp('initialZoom', 0, 1, duration, framework.easing.cubic.out, onUpdate, onComplete);
						} else {
							onUpdate(1);
							_showOrHideTimeout = setTimeout(onComplete, duration + 20);
						}
					}
				
				}, out ? 25 : 90); // Main purpose of this delay is to give browser time to paint and
						// create composite layers of PhotoSwipe UI parts (background, controls, caption, arrows).
						// Which avoids lag at the beginning of scale transition.
			};
			startAnimation();

			
		};

	/*>>show-hide-transition*/

	/*>>items-controller*/
	/**
	*
	* Controller manages gallery items, their dimensions, and their content.
	* 
	*/

	var _items,
		_tempPanAreaSize = {},
		_imagesToAppendPool = [],
		_initialContentSet,
		_initialZoomRunning,
		_controllerDefaultOptions = {
			index: 0,
			errorMsg: '<div class="pswp__error-msg"><a href="%url%" target="_blank">The image</a> could not be loaded.</div>',
			forceProgressiveLoading: false, // TODO
			preload: [1,1],
			getNumItemsFn: function() {
				return _items.length;
			}
		};


	var _getItemAt,
		_getNumItems,
		_initialIsLoop,
		_getZeroBounds = function() {
			return {
				center:{x:0,y:0}, 
				max:{x:0,y:0}, 
				min:{x:0,y:0}
			};
		},
		_calculateSingleItemPanBounds = function(item, realPanElementW, realPanElementH ) {
			var bounds = item.bounds;

			// position of element when it's centered
			bounds.center.x = Math.round((_tempPanAreaSize.x - realPanElementW) / 2);
			bounds.center.y = Math.round((_tempPanAreaSize.y - realPanElementH) / 2) + item.vGap.top;

			// maximum pan position
			bounds.max.x = (realPanElementW > _tempPanAreaSize.x) ? 
								Math.round(_tempPanAreaSize.x - realPanElementW) : 
								bounds.center.x;
			
			bounds.max.y = (realPanElementH > _tempPanAreaSize.y) ? 
								Math.round(_tempPanAreaSize.y - realPanElementH) + item.vGap.top : 
								bounds.center.y;
			
			// minimum pan position
			bounds.min.x = (realPanElementW > _tempPanAreaSize.x) ? 0 : bounds.center.x;
			bounds.min.y = (realPanElementH > _tempPanAreaSize.y) ? item.vGap.top : bounds.center.y;
		},
		_calculateItemSize = function(item, viewportSize, zoomLevel) {

			if (item.src && !item.loadError) {
				var isInitial = !zoomLevel;
				
				if(isInitial) {
					if(!item.vGap) {
						item.vGap = {top:0,bottom:0};
					}
					// allows overriding vertical margin for individual items
					_shout('parseVerticalMargin', item);
				}


				_tempPanAreaSize.x = viewportSize.x;
				_tempPanAreaSize.y = viewportSize.y - item.vGap.top - item.vGap.bottom;

				if (isInitial) {
					var hRatio = _tempPanAreaSize.x / item.w;
					var vRatio = _tempPanAreaSize.y / item.h;

					item.fitRatio = hRatio < vRatio ? hRatio : vRatio;
					//item.fillRatio = hRatio > vRatio ? hRatio : vRatio;

					var scaleMode = _options.scaleMode;

					if (scaleMode === 'orig') {
						zoomLevel = 1;
					} else if (scaleMode === 'fit') {
						zoomLevel = item.fitRatio;
					}

					if (zoomLevel > 1) {
						zoomLevel = 1;
					}

					item.initialZoomLevel = zoomLevel;
					
					if(!item.bounds) {
						// reuse bounds object
						item.bounds = _getZeroBounds(); 
					}
				}

				if(!zoomLevel) {
					return;
				}

				_calculateSingleItemPanBounds(item, item.w * zoomLevel, item.h * zoomLevel);

				if (isInitial && zoomLevel === item.initialZoomLevel) {
					item.initialPosition = item.bounds.center;
				}

				return item.bounds;
			} else {
				item.w = item.h = 0;
				item.initialZoomLevel = item.fitRatio = 1;
				item.bounds = _getZeroBounds();
				item.initialPosition = item.bounds.center;

				// if it's not image, we return zero bounds (content is not zoomable)
				return item.bounds;
			}
			
		},

		


		_appendImage = function(index, item, baseDiv, img, preventAnimation, keepPlaceholder) {
			

			if(item.loadError) {
				return;
			}

			if(img) {

				item.imageAppended = true;
				_setImageSize(item, img, (item === self.currItem && _renderMaxResolution) );
				
				baseDiv.appendChild(img);

				if(keepPlaceholder) {
					setTimeout(function() {
						if(item && item.loaded && item.placeholder) {
							item.placeholder.style.display = 'none';
							item.placeholder = null;
						}
					}, 500);
				}
			}
		},
		


		_preloadImage = function(item) {
			item.loading = true;
			item.loaded = false;
			var img = item.img = framework.createEl('pswp__img', 'img');
			var onComplete = function() {
				item.loading = false;
				item.loaded = true;

				if(item.loadComplete) {
					item.loadComplete(item);
				} else {
					item.img = null; // no need to store image object
				}
				img.onload = img.onerror = null;
				img = null;
			};
			img.onload = onComplete;
			img.onerror = function() {
				item.loadError = true;
				onComplete();
			};		

			img.src = item.src;// + '?a=' + Math.random();

			return img;
		},
		_checkForError = function(item, cleanUp) {
			if(item.src && item.loadError && item.container) {

				if(cleanUp) {
					item.container.innerHTML = '';
				}

				item.container.innerHTML = _options.errorMsg.replace('%url%',  item.src );
				return true;
				
			}
		},
		_setImageSize = function(item, img, maxRes) {
			if(!item.src) {
				return;
			}

			if(!img) {
				img = item.container.lastChild;
			}

			var w = maxRes ? item.w : Math.round(item.w * item.fitRatio),
				h = maxRes ? item.h : Math.round(item.h * item.fitRatio);
			
			if(item.placeholder && !item.loaded) {
				item.placeholder.style.width = w + 'px';
				item.placeholder.style.height = h + 'px';
			}

			img.style.width = w + 'px';
			img.style.height = h + 'px';
		},
		_appendImagesPool = function() {

			if(_imagesToAppendPool.length) {
				var poolItem;

				for(var i = 0; i < _imagesToAppendPool.length; i++) {
					poolItem = _imagesToAppendPool[i];
					if( poolItem.holder.index === poolItem.index ) {
						_appendImage(poolItem.index, poolItem.item, poolItem.baseDiv, poolItem.img, false, poolItem.clearPlaceholder);
					}
				}
				_imagesToAppendPool = [];
			}
		};
		


	_registerModule('Controller', {

		publicMethods: {

			lazyLoadItem: function(index) {
				index = _getLoopedId(index);
				var item = _getItemAt(index);

				if(!item || ((item.loaded || item.loading) && !_itemsNeedUpdate)) {
					return;
				}

				_shout('gettingData', index, item);

				if (!item.src) {
					return;
				}

				_preloadImage(item);
			},
			initController: function() {
				framework.extend(_options, _controllerDefaultOptions, true);
				self.items = _items = items;
				_getItemAt = self.getItemAt;
				_getNumItems = _options.getNumItemsFn; //self.getNumItems;



				_initialIsLoop = _options.loop;
				if(_getNumItems() < 3) {
					_options.loop = false; // disable loop if less then 3 items
				}

				_listen('beforeChange', function(diff) {

					var p = _options.preload,
						isNext = diff === null ? true : (diff >= 0),
						preloadBefore = Math.min(p[0], _getNumItems() ),
						preloadAfter = Math.min(p[1], _getNumItems() ),
						i;


					for(i = 1; i <= (isNext ? preloadAfter : preloadBefore); i++) {
						self.lazyLoadItem(_currentItemIndex+i);
					}
					for(i = 1; i <= (isNext ? preloadBefore : preloadAfter); i++) {
						self.lazyLoadItem(_currentItemIndex-i);
					}
				});

				_listen('initialLayout', function() {
					self.currItem.initialLayout = _options.getThumbBoundsFn && _options.getThumbBoundsFn(_currentItemIndex);
				});

				_listen('mainScrollAnimComplete', _appendImagesPool);
				_listen('initialZoomInEnd', _appendImagesPool);



				_listen('destroy', function() {
					var item;
					for(var i = 0; i < _items.length; i++) {
						item = _items[i];
						// remove reference to DOM elements, for GC
						if(item.container) {
							item.container = null; 
						}
						if(item.placeholder) {
							item.placeholder = null;
						}
						if(item.img) {
							item.img = null;
						}
						if(item.preloader) {
							item.preloader = null;
						}
						if(item.loadError) {
							item.loaded = item.loadError = false;
						}
					}
					_imagesToAppendPool = null;
				});
			},


			getItemAt: function(index) {
				if (index >= 0) {
					return _items[index] !== undefined ? _items[index] : false;
				}
				return false;
			},

			allowProgressiveImg: function() {
				// 1. Progressive image loading isn't working on webkit/blink 
				//    when hw-acceleration (e.g. translateZ) is applied to IMG element.
				//    That's why in PhotoSwipe parent element gets zoom transform, not image itself.
				//    
				// 2. Progressive image loading sometimes blinks in webkit/blink when applying animation to parent element.
				//    That's why it's disabled on touch devices (mainly because of swipe transition)
				//    
				// 3. Progressive image loading sometimes doesn't work in IE (up to 11).

				// Don't allow progressive loading on non-large touch devices
				return _options.forceProgressiveLoading || !_likelyTouchDevice || _options.mouseUsed || screen.width > 1200; 
				// 1200 - to eliminate touch devices with large screen (like Chromebook Pixel)
			},

			setContent: function(holder, index) {

				if(_options.loop) {
					index = _getLoopedId(index);
				}

				var prevItem = self.getItemAt(holder.index);
				if(prevItem) {
					prevItem.container = null;
				}
		
				var item = self.getItemAt(index),
					img;
				
				if(!item) {
					holder.el.innerHTML = '';
					return;
				}

				// allow to override data
				_shout('gettingData', index, item);

				holder.index = index;
				holder.item = item;

				// base container DIV is created only once for each of 3 holders
				var baseDiv = item.container = framework.createEl('pswp__zoom-wrap'); 

				

				if(!item.src && item.html) {
					if(item.html.tagName) {
						baseDiv.appendChild(item.html);
					} else {
						baseDiv.innerHTML = item.html;
					}
				}

				_checkForError(item);

				_calculateItemSize(item, _viewportSize);
				
				if(item.src && !item.loadError && !item.loaded) {

					item.loadComplete = function(item) {

						// gallery closed before image finished loading
						if(!_isOpen) {
							return;
						}

						// check if holder hasn't changed while image was loading
						if(holder && holder.index === index ) {
							if( _checkForError(item, true) ) {
								item.loadComplete = item.img = null;
								_calculateItemSize(item, _viewportSize);
								_applyZoomPanToItem(item);

								if(holder.index === _currentItemIndex) {
									// recalculate dimensions
									self.updateCurrZoomItem();
								}
								return;
							}
							if( !item.imageAppended ) {
								if(_features.transform && (_mainScrollAnimating || _initialZoomRunning) ) {
									_imagesToAppendPool.push({
										item:item,
										baseDiv:baseDiv,
										img:item.img,
										index:index,
										holder:holder,
										clearPlaceholder:true
									});
								} else {
									_appendImage(index, item, baseDiv, item.img, _mainScrollAnimating || _initialZoomRunning, true);
								}
							} else {
								// remove preloader & mini-img
								if(!_initialZoomRunning && item.placeholder) {
									item.placeholder.style.display = 'none';
									item.placeholder = null;
								}
							}
						}

						item.loadComplete = null;
						item.img = null; // no need to store image element after it's added

						_shout('imageLoadComplete', index, item);
					};

					if(framework.features.transform) {
						
						var placeholderClassName = 'pswp__img pswp__img--placeholder'; 
						placeholderClassName += (item.msrc ? '' : ' pswp__img--placeholder--blank');

						var placeholder = framework.createEl(placeholderClassName, item.msrc ? 'img' : '');
						if(item.msrc) {
							placeholder.src = item.msrc;
						}
						
						_setImageSize(item, placeholder);

						baseDiv.appendChild(placeholder);
						item.placeholder = placeholder;

					}
					

					

					if(!item.loading) {
						_preloadImage(item);
					}


					if( self.allowProgressiveImg() ) {
						// just append image
						if(!_initialContentSet && _features.transform) {
							_imagesToAppendPool.push({
								item:item, 
								baseDiv:baseDiv, 
								img:item.img, 
								index:index, 
								holder:holder
							});
						} else {
							_appendImage(index, item, baseDiv, item.img, true, true);
						}
					}
					
				} else if(item.src && !item.loadError) {
					// image object is created every time, due to bugs of image loading & delay when switching images
					img = framework.createEl('pswp__img', 'img');
					img.style.opacity = 1;
					img.src = item.src;
					_setImageSize(item, img);
					_appendImage(index, item, baseDiv, img, true);
				}
				

				if(!_initialContentSet && index === _currentItemIndex) {
					_currZoomElementStyle = baseDiv.style;
					_showOrHide(item, (img ||item.img) );
				} else {
					_applyZoomPanToItem(item);
				}

				holder.el.innerHTML = '';
				holder.el.appendChild(baseDiv);
			},

			cleanSlide: function( item ) {
				if(item.img ) {
					item.img.onload = item.img.onerror = null;
				}
				item.loaded = item.loading = item.img = item.imageAppended = false;
			}

		}
	});

	/*>>items-controller*/

	/*>>tap*/
	/**
	 * tap.js:
	 *
	 * Displatches tap and double-tap events.
	 * 
	 */

	var tapTimer,
		tapReleasePoint = {},
		_dispatchTapEvent = function(origEvent, releasePoint, pointerType) {		
			var e = document.createEvent( 'CustomEvent' ),
				eDetail = {
					origEvent:origEvent, 
					target:origEvent.target, 
					releasePoint: releasePoint, 
					pointerType:pointerType || 'touch'
				};

			e.initCustomEvent( 'pswpTap', true, true, eDetail );
			origEvent.target.dispatchEvent(e);
		};

	_registerModule('Tap', {
		publicMethods: {
			initTap: function() {
				_listen('firstTouchStart', self.onTapStart);
				_listen('touchRelease', self.onTapRelease);
				_listen('destroy', function() {
					tapReleasePoint = {};
					tapTimer = null;
				});
			},
			onTapStart: function(touchList) {
				if(touchList.length > 1) {
					clearTimeout(tapTimer);
					tapTimer = null;
				}
			},
			onTapRelease: function(e, releasePoint) {
				if(!releasePoint) {
					return;
				}

				if(!_moved && !_isMultitouch && !_numAnimations) {
					var p0 = releasePoint;
					if(tapTimer) {
						clearTimeout(tapTimer);
						tapTimer = null;

						// Check if taped on the same place
						if ( _isNearbyPoints(p0, tapReleasePoint) ) {
							_shout('doubleTap', p0);
							return;
						}
					}

					if(releasePoint.type === 'mouse') {
						_dispatchTapEvent(e, releasePoint, 'mouse');
						return;
					}

					var clickedTagName = e.target.tagName.toUpperCase();
					// avoid double tap delay on buttons and elements that have class pswp__single-tap
					if(clickedTagName === 'BUTTON' || framework.hasClass(e.target, 'pswp__single-tap') ) {
						_dispatchTapEvent(e, releasePoint);
						return;
					}

					_equalizePoints(tapReleasePoint, p0);

					tapTimer = setTimeout(function() {
						_dispatchTapEvent(e, releasePoint);
						tapTimer = null;
					}, 300);
				}
			}
		}
	});

	/*>>tap*/

	/*>>desktop-zoom*/
	/**
	 *
	 * desktop-zoom.js:
	 *
	 * - Binds mousewheel event for paning zoomed image.
	 * - Manages "dragging", "zoomed-in", "zoom-out" classes.
	 *   (which are used for cursors and zoom icon)
	 * - Adds toggleDesktopZoom function.
	 * 
	 */

	var _wheelDelta;
		
	_registerModule('DesktopZoom', {

		publicMethods: {

			initDesktopZoom: function() {

				if(_oldIE) {
					// no zoom for old IE (<=8)
					return;
				}

				if(_likelyTouchDevice) {
					// if detected hardware touch support, we wait until mouse is used,
					// and only then apply desktop-zoom features
					_listen('mouseUsed', function() {
						self.setupDesktopZoom();
					});
				} else {
					self.setupDesktopZoom(true);
				}

			},

			setupDesktopZoom: function(onInit) {

				_wheelDelta = {};

				var events = 'wheel mousewheel DOMMouseScroll';
				
				_listen('bindEvents', function() {
					framework.bind(template, events,  self.handleMouseWheel);
				});

				_listen('unbindEvents', function() {
					if(_wheelDelta) {
						framework.unbind(template, events, self.handleMouseWheel);
					}
				});

				self.mouseZoomedIn = false;

				var hasDraggingClass,
					updateZoomable = function() {
						if(self.mouseZoomedIn) {
							framework.removeClass(template, 'pswp--zoomed-in');
							self.mouseZoomedIn = false;
						}
						if(_currZoomLevel < 1) {
							framework.addClass(template, 'pswp--zoom-allowed');
						} else {
							framework.removeClass(template, 'pswp--zoom-allowed');
						}
						removeDraggingClass();
					},
					removeDraggingClass = function() {
						if(hasDraggingClass) {
							framework.removeClass(template, 'pswp--dragging');
							hasDraggingClass = false;
						}
					};

				_listen('resize' , updateZoomable);
				_listen('afterChange' , updateZoomable);
				_listen('pointerDown', function() {
					if(self.mouseZoomedIn) {
						hasDraggingClass = true;
						framework.addClass(template, 'pswp--dragging');
					}
				});
				_listen('pointerUp', removeDraggingClass);

				if(!onInit) {
					updateZoomable();
				}
				
			},

			handleMouseWheel: function(e) {

				if(_currZoomLevel <= self.currItem.fitRatio) {
					if( _options.modal ) {

						if (!_options.closeOnScroll || _numAnimations || _isDragging) {
							e.preventDefault();
						} else if(_transformKey && Math.abs(e.deltaY) > 2) {
							// close PhotoSwipe
							// if browser supports transforms & scroll changed enough
							_closedByScroll = true;
							self.close();
						}

					}
					return true;
				}

				// allow just one event to fire
				e.stopPropagation();

				// https://developer.mozilla.org/en-US/docs/Web/Events/wheel
				_wheelDelta.x = 0;

				if('deltaX' in e) {
					if(e.deltaMode === 1 /* DOM_DELTA_LINE */) {
						// 18 - average line height
						_wheelDelta.x = e.deltaX * 18;
						_wheelDelta.y = e.deltaY * 18;
					} else {
						_wheelDelta.x = e.deltaX;
						_wheelDelta.y = e.deltaY;
					}
				} else if('wheelDelta' in e) {
					if(e.wheelDeltaX) {
						_wheelDelta.x = -0.16 * e.wheelDeltaX;
					}
					if(e.wheelDeltaY) {
						_wheelDelta.y = -0.16 * e.wheelDeltaY;
					} else {
						_wheelDelta.y = -0.16 * e.wheelDelta;
					}
				} else if('detail' in e) {
					_wheelDelta.y = e.detail;
				} else {
					return;
				}

				_calculatePanBounds(_currZoomLevel, true);

				var newPanX = _panOffset.x - _wheelDelta.x,
					newPanY = _panOffset.y - _wheelDelta.y;

				// only prevent scrolling in nonmodal mode when not at edges
				if (_options.modal ||
					(
					newPanX <= _currPanBounds.min.x && newPanX >= _currPanBounds.max.x &&
					newPanY <= _currPanBounds.min.y && newPanY >= _currPanBounds.max.y
					) ) {
					e.preventDefault();
				}

				// TODO: use rAF instead of mousewheel?
				self.panTo(newPanX, newPanY);
			},

			toggleDesktopZoom: function(centerPoint) {
				centerPoint = centerPoint || {x:_viewportSize.x/2 + _offset.x, y:_viewportSize.y/2 + _offset.y };

				var doubleTapZoomLevel = _options.getDoubleTapZoom(true, self.currItem);
				var zoomOut = _currZoomLevel === doubleTapZoomLevel;
				
				self.mouseZoomedIn = !zoomOut;

				self.zoomTo(zoomOut ? self.currItem.initialZoomLevel : doubleTapZoomLevel, centerPoint, 333);
				framework[ (!zoomOut ? 'add' : 'remove') + 'Class'](template, 'pswp--zoomed-in');
			}

		}
	});


	/*>>desktop-zoom*/

	/*>>history*/
	/**
	 *
	 * history.js:
	 *
	 * - Back button to close gallery.
	 * 
	 * - Unique URL for each slide: example.com/&pid=1&gid=3
	 *   (where PID is picture index, and GID and gallery index)
	 *   
	 * - Switch URL when slides change.
	 * 
	 */


	var _historyDefaultOptions = {
		history: true,
		galleryUID: 1
	};

	var _historyUpdateTimeout,
		_hashChangeTimeout,
		_hashAnimCheckTimeout,
		_hashChangedByScript,
		_hashChangedByHistory,
		_hashReseted,
		_initialHash,
		_historyChanged,
		_closedFromURL,
		_urlChangedOnce,
		_windowLoc,

		_supportsPushState,

		_getHash = function() {
			return _windowLoc.hash.substring(1);
		},
		_cleanHistoryTimeouts = function() {

			if(_historyUpdateTimeout) {
				clearTimeout(_historyUpdateTimeout);
			}

			if(_hashAnimCheckTimeout) {
				clearTimeout(_hashAnimCheckTimeout);
			}
		},

		// pid - Picture index
		// gid - Gallery index
		_parseItemIndexFromURL = function() {
			var hash = _getHash(),
				params = {};

			if(hash.length < 5) { // pid=1
				return params;
			}

			var i, vars = hash.split('&');
			for (i = 0; i < vars.length; i++) {
				if(!vars[i]) {
					continue;
				}
				var pair = vars[i].split('=');	
				if(pair.length < 2) {
					continue;
				}
				params[pair[0]] = pair[1];
			}
			if(_options.galleryPIDs) {
				// detect custom pid in hash and search for it among the items collection
				var searchfor = params.pid;
				params.pid = 0; // if custom pid cannot be found, fallback to the first item
				for(i = 0; i < _items.length; i++) {
					if(_items[i].pid === searchfor) {
						params.pid = i;
						break;
					}
				}
			} else {
				params.pid = parseInt(params.pid,10)-1;
			}
			if( params.pid < 0 ) {
				params.pid = 0;
			}
			return params;
		},
		_updateHash = function() {

			if(_hashAnimCheckTimeout) {
				clearTimeout(_hashAnimCheckTimeout);
			}


			if(_numAnimations || _isDragging) {
				// changing browser URL forces layout/paint in some browsers, which causes noticable lag during animation
				// that's why we update hash only when no animations running
				_hashAnimCheckTimeout = setTimeout(_updateHash, 500);
				return;
			}
			
			if(_hashChangedByScript) {
				clearTimeout(_hashChangeTimeout);
			} else {
				_hashChangedByScript = true;
			}


			var pid = (_currentItemIndex + 1);
			var item = _getItemAt( _currentItemIndex );
			if(item.hasOwnProperty('pid')) {
				// carry forward any custom pid assigned to the item
				pid = item.pid;
			}
			var newHash = _initialHash + '&'  +  'gid=' + _options.galleryUID + '&' + 'pid=' + pid;

			if(!_historyChanged) {
				if(_windowLoc.hash.indexOf(newHash) === -1) {
					_urlChangedOnce = true;
				}
				// first time - add new hisory record, then just replace
			}

			var newURL = _windowLoc.href.split('#')[0] + '#' +  newHash;

			if( _supportsPushState ) {

				if('#' + newHash !== window.location.hash) {
					history[_historyChanged ? 'replaceState' : 'pushState']('', document.title, newURL);
				}

			} else {
				if(_historyChanged) {
					_windowLoc.replace( newURL );
				} else {
					_windowLoc.hash = newHash;
				}
			}
			
			

			_historyChanged = true;
			_hashChangeTimeout = setTimeout(function() {
				_hashChangedByScript = false;
			}, 60);
		};



		

	_registerModule('History', {

		

		publicMethods: {
			initHistory: function() {

				framework.extend(_options, _historyDefaultOptions, true);

				if( !_options.history ) {
					return;
				}


				_windowLoc = window.location;
				_urlChangedOnce = false;
				_closedFromURL = false;
				_historyChanged = false;
				_initialHash = _getHash();
				_supportsPushState = ('pushState' in history);


				if(_initialHash.indexOf('gid=') > -1) {
					_initialHash = _initialHash.split('&gid=')[0];
					_initialHash = _initialHash.split('?gid=')[0];
				}
				

				_listen('afterChange', self.updateURL);
				_listen('unbindEvents', function() {
					framework.unbind(window, 'hashchange', self.onHashChange);
				});


				var returnToOriginal = function() {
					_hashReseted = true;
					if(!_closedFromURL) {

						if(_urlChangedOnce) {
							history.back();
						} else {

							if(_initialHash) {
								_windowLoc.hash = _initialHash;
							} else {
								if (_supportsPushState) {

									// remove hash from url without refreshing it or scrolling to top
									history.pushState('', document.title,  _windowLoc.pathname + _windowLoc.search );
								} else {
									_windowLoc.hash = '';
								}
							}
						}
						
					}

					_cleanHistoryTimeouts();
				};


				_listen('unbindEvents', function() {
					if(_closedByScroll) {
						// if PhotoSwipe is closed by scroll, we go "back" before the closing animation starts
						// this is done to keep the scroll position
						returnToOriginal();
					}
				});
				_listen('destroy', function() {
					if(!_hashReseted) {
						returnToOriginal();
					}
				});
				_listen('firstUpdate', function() {
					_currentItemIndex = _parseItemIndexFromURL().pid;
				});

				

				
				var index = _initialHash.indexOf('pid=');
				if(index > -1) {
					_initialHash = _initialHash.substring(0, index);
					if(_initialHash.slice(-1) === '&') {
						_initialHash = _initialHash.slice(0, -1);
					}
				}
				

				setTimeout(function() {
					if(_isOpen) { // hasn't destroyed yet
						framework.bind(window, 'hashchange', self.onHashChange);
					}
				}, 40);
				
			},
			onHashChange: function() {

				if(_getHash() === _initialHash) {

					_closedFromURL = true;
					self.close();
					return;
				}
				if(!_hashChangedByScript) {

					_hashChangedByHistory = true;
					self.goTo( _parseItemIndexFromURL().pid );
					_hashChangedByHistory = false;
				}
				
			},
			updateURL: function() {

				// Delay the update of URL, to avoid lag during transition, 
				// and to not to trigger actions like "refresh page sound" or "blinking favicon" to often
				
				_cleanHistoryTimeouts();
				

				if(_hashChangedByHistory) {
					return;
				}

				if(!_historyChanged) {
					_updateHash(); // first time
				} else {
					_historyUpdateTimeout = setTimeout(_updateHash, 800);
				}
			}
		
		}
	});


	/*>>history*/
		framework.extend(self, publicMethods); };
		return PhotoSwipe;
	});

/***/ },

/***/ 538:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*! PhotoSwipe Default UI - 4.1.1 - 2015-12-24
	* http://photoswipe.com
	* Copyright (c) 2015 Dmitry Semenov; */
	/**
	*
	* UI on top of main sliding area (caption, arrows, close button, etc.).
	* Built just using public methods/properties of PhotoSwipe.
	* 
	*/
	(function (root, factory) { 
		if (true) {
			!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory), __WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ? (__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) : __WEBPACK_AMD_DEFINE_FACTORY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		} else if (typeof exports === 'object') {
			module.exports = factory();
		} else {
			root.PhotoSwipeUI_Default = factory();
		}
	})(this, function () {

		'use strict';



	var PhotoSwipeUI_Default =
	 function(pswp, framework) {

		var ui = this;
		var _overlayUIUpdated = false,
			_controlsVisible = true,
			_fullscrenAPI,
			_controls,
			_captionContainer,
			_fakeCaptionContainer,
			_indexIndicator,
			_shareButton,
			_shareModal,
			_shareModalHidden = true,
			_initalCloseOnScrollValue,
			_isIdle,
			_listen,

			_loadingIndicator,
			_loadingIndicatorHidden,
			_loadingIndicatorTimeout,

			_galleryHasOneSlide,

			_options,
			_defaultUIOptions = {
				barsSize: {top:44, bottom:'auto'},
				closeElClasses: ['item', 'caption', 'zoom-wrap', 'ui', 'top-bar'], 
				timeToIdle: 4000, 
				timeToIdleOutside: 1000,
				loadingIndicatorDelay: 1000, // 2s
				
				addCaptionHTMLFn: function(item, captionEl /*, isFake */) {
					if(!item.title) {
						captionEl.children[0].innerHTML = '';
						return false;
					}
					captionEl.children[0].innerHTML = item.title;
					return true;
				},

				closeEl:true,
				captionEl: true,
				fullscreenEl: true,
				zoomEl: true,
				shareEl: true,
				counterEl: true,
				arrowEl: true,
				preloaderEl: true,

				tapToClose: false,
				tapToToggleControls: true,

				clickToCloseNonZoomable: true,

				shareButtons: [
					{id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
					{id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
					{id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/'+
														'?url={{url}}&media={{image_url}}&description={{text}}'},
					{id:'download', label:'Download image', url:'{{raw_image_url}}', download:true}
				],
				getImageURLForShare: function( /* shareButtonData */ ) {
					return pswp.currItem.src || '';
				},
				getPageURLForShare: function( /* shareButtonData */ ) {
					return window.location.href;
				},
				getTextForShare: function( /* shareButtonData */ ) {
					return pswp.currItem.title || '';
				},
					
				indexIndicatorSep: ' / ',
				fitControlsWidth: 1200

			},
			_blockControlsTap,
			_blockControlsTapTimeout;



		var _onControlsTap = function(e) {
				if(_blockControlsTap) {
					return true;
				}


				e = e || window.event;

				if(_options.timeToIdle && _options.mouseUsed && !_isIdle) {
					// reset idle timer
					_onIdleMouseMove();
				}


				var target = e.target || e.srcElement,
					uiElement,
					clickedClass = target.getAttribute('class') || '',
					found;

				for(var i = 0; i < _uiElements.length; i++) {
					uiElement = _uiElements[i];
					if(uiElement.onTap && clickedClass.indexOf('pswp__' + uiElement.name ) > -1 ) {
						uiElement.onTap();
						found = true;

					}
				}

				if(found) {
					if(e.stopPropagation) {
						e.stopPropagation();
					}
					_blockControlsTap = true;

					// Some versions of Android don't prevent ghost click event 
					// when preventDefault() was called on touchstart and/or touchend.
					// 
					// This happens on v4.3, 4.2, 4.1, 
					// older versions strangely work correctly, 
					// but just in case we add delay on all of them)	
					var tapDelay = framework.features.isOldAndroid ? 600 : 30;
					_blockControlsTapTimeout = setTimeout(function() {
						_blockControlsTap = false;
					}, tapDelay);
				}

			},
			_fitControlsInViewport = function() {
				return !pswp.likelyTouchDevice || _options.mouseUsed || screen.width > _options.fitControlsWidth;
			},
			_togglePswpClass = function(el, cName, add) {
				framework[ (add ? 'add' : 'remove') + 'Class' ](el, 'pswp__' + cName);
			},

			// add class when there is just one item in the gallery
			// (by default it hides left/right arrows and 1ofX counter)
			_countNumItems = function() {
				var hasOneSlide = (_options.getNumItemsFn() === 1);

				if(hasOneSlide !== _galleryHasOneSlide) {
					_togglePswpClass(_controls, 'ui--one-slide', hasOneSlide);
					_galleryHasOneSlide = hasOneSlide;
				}
			},
			_toggleShareModalClass = function() {
				_togglePswpClass(_shareModal, 'share-modal--hidden', _shareModalHidden);
			},
			_toggleShareModal = function() {

				_shareModalHidden = !_shareModalHidden;
				
				
				if(!_shareModalHidden) {
					_toggleShareModalClass();
					setTimeout(function() {
						if(!_shareModalHidden) {
							framework.addClass(_shareModal, 'pswp__share-modal--fade-in');
						}
					}, 30);
				} else {
					framework.removeClass(_shareModal, 'pswp__share-modal--fade-in');
					setTimeout(function() {
						if(_shareModalHidden) {
							_toggleShareModalClass();
						}
					}, 300);
				}
				
				if(!_shareModalHidden) {
					_updateShareURLs();
				}
				return false;
			},

			_openWindowPopup = function(e) {
				e = e || window.event;
				var target = e.target || e.srcElement;

				pswp.shout('shareLinkClick', e, target);

				if(!target.href) {
					return false;
				}

				if( target.hasAttribute('download') ) {
					return true;
				}

				window.open(target.href, 'pswp_share', 'scrollbars=yes,resizable=yes,toolbar=no,'+
											'location=yes,width=550,height=420,top=100,left=' + 
											(window.screen ? Math.round(screen.width / 2 - 275) : 100)  );

				if(!_shareModalHidden) {
					_toggleShareModal();
				}
				
				return false;
			},
			_updateShareURLs = function() {
				var shareButtonOut = '',
					shareButtonData,
					shareURL,
					image_url,
					page_url,
					share_text;

				for(var i = 0; i < _options.shareButtons.length; i++) {
					shareButtonData = _options.shareButtons[i];

					image_url = _options.getImageURLForShare(shareButtonData);
					page_url = _options.getPageURLForShare(shareButtonData);
					share_text = _options.getTextForShare(shareButtonData);

					shareURL = shareButtonData.url.replace('{{url}}', encodeURIComponent(page_url) )
										.replace('{{image_url}}', encodeURIComponent(image_url) )
										.replace('{{raw_image_url}}', image_url )
										.replace('{{text}}', encodeURIComponent(share_text) );

					shareButtonOut += '<a href="' + shareURL + '" target="_blank" '+
										'class="pswp__share--' + shareButtonData.id + '"' +
										(shareButtonData.download ? 'download' : '') + '>' + 
										shareButtonData.label + '</a>';

					if(_options.parseShareButtonOut) {
						shareButtonOut = _options.parseShareButtonOut(shareButtonData, shareButtonOut);
					}
				}
				_shareModal.children[0].innerHTML = shareButtonOut;
				_shareModal.children[0].onclick = _openWindowPopup;

			},
			_hasCloseClass = function(target) {
				for(var  i = 0; i < _options.closeElClasses.length; i++) {
					if( framework.hasClass(target, 'pswp__' + _options.closeElClasses[i]) ) {
						return true;
					}
				}
			},
			_idleInterval,
			_idleTimer,
			_idleIncrement = 0,
			_onIdleMouseMove = function() {
				clearTimeout(_idleTimer);
				_idleIncrement = 0;
				if(_isIdle) {
					ui.setIdle(false);
				}
			},
			_onMouseLeaveWindow = function(e) {
				e = e ? e : window.event;
				var from = e.relatedTarget || e.toElement;
				if (!from || from.nodeName === 'HTML') {
					clearTimeout(_idleTimer);
					_idleTimer = setTimeout(function() {
						ui.setIdle(true);
					}, _options.timeToIdleOutside);
				}
			},
			_setupFullscreenAPI = function() {
				if(_options.fullscreenEl && !framework.features.isOldAndroid) {
					if(!_fullscrenAPI) {
						_fullscrenAPI = ui.getFullscreenAPI();
					}
					if(_fullscrenAPI) {
						framework.bind(document, _fullscrenAPI.eventK, ui.updateFullscreen);
						ui.updateFullscreen();
						framework.addClass(pswp.template, 'pswp--supports-fs');
					} else {
						framework.removeClass(pswp.template, 'pswp--supports-fs');
					}
				}
			},
			_setupLoadingIndicator = function() {
				// Setup loading indicator
				if(_options.preloaderEl) {
				
					_toggleLoadingIndicator(true);

					_listen('beforeChange', function() {

						clearTimeout(_loadingIndicatorTimeout);

						// display loading indicator with delay
						_loadingIndicatorTimeout = setTimeout(function() {

							if(pswp.currItem && pswp.currItem.loading) {

								if( !pswp.allowProgressiveImg() || (pswp.currItem.img && !pswp.currItem.img.naturalWidth)  ) {
									// show preloader if progressive loading is not enabled, 
									// or image width is not defined yet (because of slow connection)
									_toggleLoadingIndicator(false); 
									// items-controller.js function allowProgressiveImg
								}
								
							} else {
								_toggleLoadingIndicator(true); // hide preloader
							}

						}, _options.loadingIndicatorDelay);
						
					});
					_listen('imageLoadComplete', function(index, item) {
						if(pswp.currItem === item) {
							_toggleLoadingIndicator(true);
						}
					});

				}
			},
			_toggleLoadingIndicator = function(hide) {
				if( _loadingIndicatorHidden !== hide ) {
					_togglePswpClass(_loadingIndicator, 'preloader--active', !hide);
					_loadingIndicatorHidden = hide;
				}
			},
			_applyNavBarGaps = function(item) {
				var gap = item.vGap;

				if( _fitControlsInViewport() ) {
					
					var bars = _options.barsSize; 
					if(_options.captionEl && bars.bottom === 'auto') {
						if(!_fakeCaptionContainer) {
							_fakeCaptionContainer = framework.createEl('pswp__caption pswp__caption--fake');
							_fakeCaptionContainer.appendChild( framework.createEl('pswp__caption__center') );
							_controls.insertBefore(_fakeCaptionContainer, _captionContainer);
							framework.addClass(_controls, 'pswp__ui--fit');
						}
						if( _options.addCaptionHTMLFn(item, _fakeCaptionContainer, true) ) {

							var captionSize = _fakeCaptionContainer.clientHeight;
							gap.bottom = parseInt(captionSize,10) || 44;
						} else {
							gap.bottom = bars.top; // if no caption, set size of bottom gap to size of top
						}
					} else {
						gap.bottom = bars.bottom === 'auto' ? 0 : bars.bottom;
					}
					
					// height of top bar is static, no need to calculate it
					gap.top = bars.top;
				} else {
					gap.top = gap.bottom = 0;
				}
			},
			_setupIdle = function() {
				// Hide controls when mouse is used
				if(_options.timeToIdle) {
					_listen('mouseUsed', function() {
						
						framework.bind(document, 'mousemove', _onIdleMouseMove);
						framework.bind(document, 'mouseout', _onMouseLeaveWindow);

						_idleInterval = setInterval(function() {
							_idleIncrement++;
							if(_idleIncrement === 2) {
								ui.setIdle(true);
							}
						}, _options.timeToIdle / 2);
					});
				}
			},
			_setupHidingControlsDuringGestures = function() {

				// Hide controls on vertical drag
				_listen('onVerticalDrag', function(now) {
					if(_controlsVisible && now < 0.95) {
						ui.hideControls();
					} else if(!_controlsVisible && now >= 0.95) {
						ui.showControls();
					}
				});

				// Hide controls when pinching to close
				var pinchControlsHidden;
				_listen('onPinchClose' , function(now) {
					if(_controlsVisible && now < 0.9) {
						ui.hideControls();
						pinchControlsHidden = true;
					} else if(pinchControlsHidden && !_controlsVisible && now > 0.9) {
						ui.showControls();
					}
				});

				_listen('zoomGestureEnded', function() {
					pinchControlsHidden = false;
					if(pinchControlsHidden && !_controlsVisible) {
						ui.showControls();
					}
				});

			};



		var _uiElements = [
			{ 
				name: 'caption', 
				option: 'captionEl',
				onInit: function(el) {  
					_captionContainer = el; 
				} 
			},
			{ 
				name: 'share-modal', 
				option: 'shareEl',
				onInit: function(el) {  
					_shareModal = el;
				},
				onTap: function() {
					_toggleShareModal();
				} 
			},
			{ 
				name: 'button--share', 
				option: 'shareEl',
				onInit: function(el) { 
					_shareButton = el;
				},
				onTap: function() {
					_toggleShareModal();
				} 
			},
			{ 
				name: 'button--zoom', 
				option: 'zoomEl',
				onTap: pswp.toggleDesktopZoom
			},
			{ 
				name: 'counter', 
				option: 'counterEl',
				onInit: function(el) {  
					_indexIndicator = el;
				} 
			},
			{ 
				name: 'button--close', 
				option: 'closeEl',
				onTap: pswp.close
			},
			{ 
				name: 'button--arrow--left', 
				option: 'arrowEl',
				onTap: pswp.prev
			},
			{ 
				name: 'button--arrow--right', 
				option: 'arrowEl',
				onTap: pswp.next
			},
			{ 
				name: 'button--fs', 
				option: 'fullscreenEl',
				onTap: function() {  
					if(_fullscrenAPI.isFullscreen()) {
						_fullscrenAPI.exit();
					} else {
						_fullscrenAPI.enter();
					}
				} 
			},
			{ 
				name: 'preloader', 
				option: 'preloaderEl',
				onInit: function(el) {  
					_loadingIndicator = el;
				} 
			}

		];

		var _setupUIElements = function() {
			var item,
				classAttr,
				uiElement;

			var loopThroughChildElements = function(sChildren) {
				if(!sChildren) {
					return;
				}

				var l = sChildren.length;
				for(var i = 0; i < l; i++) {
					item = sChildren[i];
					classAttr = item.className;

					for(var a = 0; a < _uiElements.length; a++) {
						uiElement = _uiElements[a];

						if(classAttr.indexOf('pswp__' + uiElement.name) > -1  ) {

							if( _options[uiElement.option] ) { // if element is not disabled from options
								
								framework.removeClass(item, 'pswp__element--disabled');
								if(uiElement.onInit) {
									uiElement.onInit(item);
								}
								
								//item.style.display = 'block';
							} else {
								framework.addClass(item, 'pswp__element--disabled');
								//item.style.display = 'none';
							}
						}
					}
				}
			};
			loopThroughChildElements(_controls.children);

			var topBar =  framework.getChildByClass(_controls, 'pswp__top-bar');
			if(topBar) {
				loopThroughChildElements( topBar.children );
			}
		};


		

		ui.init = function() {

			// extend options
			framework.extend(pswp.options, _defaultUIOptions, true);

			// create local link for fast access
			_options = pswp.options;

			// find pswp__ui element
			_controls = framework.getChildByClass(pswp.scrollWrap, 'pswp__ui');

			// create local link
			_listen = pswp.listen;


			_setupHidingControlsDuringGestures();

			// update controls when slides change
			_listen('beforeChange', ui.update);

			// toggle zoom on double-tap
			_listen('doubleTap', function(point) {
				var initialZoomLevel = pswp.currItem.initialZoomLevel;
				if(pswp.getZoomLevel() !== initialZoomLevel) {
					pswp.zoomTo(initialZoomLevel, point, 333);
				} else {
					pswp.zoomTo(_options.getDoubleTapZoom(false, pswp.currItem), point, 333);
				}
			});

			// Allow text selection in caption
			_listen('preventDragEvent', function(e, isDown, preventObj) {
				var t = e.target || e.srcElement;
				if(
					t && 
					t.getAttribute('class') && e.type.indexOf('mouse') > -1 && 
					( t.getAttribute('class').indexOf('__caption') > 0 || (/(SMALL|STRONG|EM)/i).test(t.tagName) ) 
				) {
					preventObj.prevent = false;
				}
			});

			// bind events for UI
			_listen('bindEvents', function() {
				framework.bind(_controls, 'pswpTap click', _onControlsTap);
				framework.bind(pswp.scrollWrap, 'pswpTap', ui.onGlobalTap);

				if(!pswp.likelyTouchDevice) {
					framework.bind(pswp.scrollWrap, 'mouseover', ui.onMouseOver);
				}
			});

			// unbind events for UI
			_listen('unbindEvents', function() {
				if(!_shareModalHidden) {
					_toggleShareModal();
				}

				if(_idleInterval) {
					clearInterval(_idleInterval);
				}
				framework.unbind(document, 'mouseout', _onMouseLeaveWindow);
				framework.unbind(document, 'mousemove', _onIdleMouseMove);
				framework.unbind(_controls, 'pswpTap click', _onControlsTap);
				framework.unbind(pswp.scrollWrap, 'pswpTap', ui.onGlobalTap);
				framework.unbind(pswp.scrollWrap, 'mouseover', ui.onMouseOver);

				if(_fullscrenAPI) {
					framework.unbind(document, _fullscrenAPI.eventK, ui.updateFullscreen);
					if(_fullscrenAPI.isFullscreen()) {
						_options.hideAnimationDuration = 0;
						_fullscrenAPI.exit();
					}
					_fullscrenAPI = null;
				}
			});


			// clean up things when gallery is destroyed
			_listen('destroy', function() {
				if(_options.captionEl) {
					if(_fakeCaptionContainer) {
						_controls.removeChild(_fakeCaptionContainer);
					}
					framework.removeClass(_captionContainer, 'pswp__caption--empty');
				}

				if(_shareModal) {
					_shareModal.children[0].onclick = null;
				}
				framework.removeClass(_controls, 'pswp__ui--over-close');
				framework.addClass( _controls, 'pswp__ui--hidden');
				ui.setIdle(false);
			});
			

			if(!_options.showAnimationDuration) {
				framework.removeClass( _controls, 'pswp__ui--hidden');
			}
			_listen('initialZoomIn', function() {
				if(_options.showAnimationDuration) {
					framework.removeClass( _controls, 'pswp__ui--hidden');
				}
			});
			_listen('initialZoomOut', function() {
				framework.addClass( _controls, 'pswp__ui--hidden');
			});

			_listen('parseVerticalMargin', _applyNavBarGaps);
			
			_setupUIElements();

			if(_options.shareEl && _shareButton && _shareModal) {
				_shareModalHidden = true;
			}

			_countNumItems();

			_setupIdle();

			_setupFullscreenAPI();

			_setupLoadingIndicator();
		};

		ui.setIdle = function(isIdle) {
			_isIdle = isIdle;
			_togglePswpClass(_controls, 'ui--idle', isIdle);
		};

		ui.update = function() {
			// Don't update UI if it's hidden
			if(_controlsVisible && pswp.currItem) {
				
				ui.updateIndexIndicator();

				if(_options.captionEl) {
					_options.addCaptionHTMLFn(pswp.currItem, _captionContainer);

					_togglePswpClass(_captionContainer, 'caption--empty', !pswp.currItem.title);
				}

				_overlayUIUpdated = true;

			} else {
				_overlayUIUpdated = false;
			}

			if(!_shareModalHidden) {
				_toggleShareModal();
			}

			_countNumItems();
		};

		ui.updateFullscreen = function(e) {

			if(e) {
				// some browsers change window scroll position during the fullscreen
				// so PhotoSwipe updates it just in case
				setTimeout(function() {
					pswp.setScrollOffset( 0, framework.getScrollY() );
				}, 50);
			}
			
			// toogle pswp--fs class on root element
			framework[ (_fullscrenAPI.isFullscreen() ? 'add' : 'remove') + 'Class' ](pswp.template, 'pswp--fs');
		};

		ui.updateIndexIndicator = function() {
			if(_options.counterEl) {
				_indexIndicator.innerHTML = (pswp.getCurrentIndex()+1) + 
											_options.indexIndicatorSep + 
											_options.getNumItemsFn();
			}
		};
		
		ui.onGlobalTap = function(e) {
			e = e || window.event;
			var target = e.target || e.srcElement;

			if(_blockControlsTap) {
				return;
			}

			if(e.detail && e.detail.pointerType === 'mouse') {

				// close gallery if clicked outside of the image
				if(_hasCloseClass(target)) {
					pswp.close();
					return;
				}

				if(framework.hasClass(target, 'pswp__img')) {
					if(pswp.getZoomLevel() === 1 && pswp.getZoomLevel() <= pswp.currItem.fitRatio) {
						if(_options.clickToCloseNonZoomable) {
							pswp.close();
						}
					} else {
						pswp.toggleDesktopZoom(e.detail.releasePoint);
					}
				}
				
			} else {

				// tap anywhere (except buttons) to toggle visibility of controls
				if(_options.tapToToggleControls) {
					if(_controlsVisible) {
						ui.hideControls();
					} else {
						ui.showControls();
					}
				}

				// tap to close gallery
				if(_options.tapToClose && (framework.hasClass(target, 'pswp__img') || _hasCloseClass(target)) ) {
					pswp.close();
					return;
				}
				
			}
		};
		ui.onMouseOver = function(e) {
			e = e || window.event;
			var target = e.target || e.srcElement;

			// add class when mouse is over an element that should close the gallery
			_togglePswpClass(_controls, 'ui--over-close', _hasCloseClass(target));
		};

		ui.hideControls = function() {
			framework.addClass(_controls,'pswp__ui--hidden');
			_controlsVisible = false;
		};

		ui.showControls = function() {
			_controlsVisible = true;
			if(!_overlayUIUpdated) {
				ui.update();
			}
			framework.removeClass(_controls,'pswp__ui--hidden');
		};

		ui.supportsFullscreen = function() {
			var d = document;
			return !!(d.exitFullscreen || d.mozCancelFullScreen || d.webkitExitFullscreen || d.msExitFullscreen);
		};

		ui.getFullscreenAPI = function() {
			var dE = document.documentElement,
				api,
				tF = 'fullscreenchange';

			if (dE.requestFullscreen) {
				api = {
					enterK: 'requestFullscreen',
					exitK: 'exitFullscreen',
					elementK: 'fullscreenElement',
					eventK: tF
				};

			} else if(dE.mozRequestFullScreen ) {
				api = {
					enterK: 'mozRequestFullScreen',
					exitK: 'mozCancelFullScreen',
					elementK: 'mozFullScreenElement',
					eventK: 'moz' + tF
				};

				

			} else if(dE.webkitRequestFullscreen) {
				api = {
					enterK: 'webkitRequestFullscreen',
					exitK: 'webkitExitFullscreen',
					elementK: 'webkitFullscreenElement',
					eventK: 'webkit' + tF
				};

			} else if(dE.msRequestFullscreen) {
				api = {
					enterK: 'msRequestFullscreen',
					exitK: 'msExitFullscreen',
					elementK: 'msFullscreenElement',
					eventK: 'MSFullscreenChange'
				};
			}

			if(api) {
				api.enter = function() { 
					// disable close-on-scroll in fullscreen
					_initalCloseOnScrollValue = _options.closeOnScroll; 
					_options.closeOnScroll = false; 

					if(this.enterK === 'webkitRequestFullscreen') {
						pswp.template[this.enterK]( Element.ALLOW_KEYBOARD_INPUT );
					} else {
						return pswp.template[this.enterK](); 
					}
				};
				api.exit = function() { 
					_options.closeOnScroll = _initalCloseOnScrollValue;

					return document[this.exitK](); 

				};
				api.isFullscreen = function() { return document[this.elementK]; };
			}

			return api;
		};



	};
	return PhotoSwipeUI_Default;


	});


/***/ }

/******/ });