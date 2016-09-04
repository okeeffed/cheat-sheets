# jQuery Cheat Sheet

## JQ-1: Core

```javascript
//jQuery function

$.jQuery( selector [, context] | element | elementArray | jQueryObject ), .jQuery( )
$.jQuery( html [, owner]  | html, props )
$.jQuery( fn )
def.when(deferreds)
fnjQuery.sub( )
$.holdReady( hold )

// jQuery Object Accessors

$.each( fn(index, element) )
num.size( ), .length
str.selector
el.context
$.eq( index )
jQuery.error( str )
[el],el.get( [index] )
num.index( ), .index( selector | element )
$jQuery.pushStack( elements, [name, args] )
arr.toArray( )

//Interoperability

$jQuery.noConflict( [extreme] )
```

***

## JQ-2: jQuery Attributes

```javascript
// Attributes

str.attr( name | name , value )
$.attr( name, val | map | name, fn(index, attr) )
$.removeAttr( name )
$.prop( name )
$.removeProp( name )

// Class
$.addClass( class | fn(index, class) )
bool.hasClass( class )
$.removeClass( [class] | fn(index, class) )
$.toggleClass( class [, switch] | fn(index, class) [, switch] )

// HTML, text
str.html( )
$.html( val | fn(index, html) )
str.text( )
$.text( val | fn(index, html) )

// Value
str,arr.val( )
$.val( val | fn() )
```

***

## JQ-3: jQuery Selectors

#### JQ-4: Basics
\#id
element
.class, .class.class
*
selector1, selector2
Hierarchy
ancestor descendant
parent > child
prev + next
prev ~ siblings

#### JQ-5: Basic Filters
:first
:last
:not(selector)
:even
:odd
:eq(index)
:gt(index)
:lt(index)
:header
:animated
:focus

#### JQ-6: Content Filters
:contains(text)
:empty
:has(selector)
:parent

#### JQ-7: Visibility Filters
:hidden
:visible

#### JQ-8: Child Filters
:nth-child(expr)
:first-child
:last-child
:only-child

#### JQ-9: Attribute Filters
[attribute]
[attribute=value]
[attribute!=value]
[attribute^=value]
[attribute$=value]
[attribute*=value]
[attribute|=value]
[attribute~=value]
[attribute][attribute2]

#### JQ-10: Forms
:input
:text
:password
:radio
:checkbox
:submit
:image
:reset
:button
:file

#### JQ-11: Form Filters
:enabled
:disabled
:checked
:selected

***

## JQ-12: jQuery Traversing

#### JQ-13: Filtering
$.eq( index )
$.first( )
$.last( )
$.has( selector ), .has( element )
$.filter( selector ), .filter( fn(index) )
bool.is( selector | function(index) | jQuery object | element )1.7*
$.map( fn(index, element) )
$.not( selector ), .not( elements ), .not( fn( index ) )
$.slice( start [, end] )

#### JQ-14: Tree traversal
$.children( [selector] )
$.closest( selector [, context] | jQuery object | element )
arr.closest( selectors [, context] )removed
$.find( selector | jQuery object | element )
$.next( [selector] )
$.nextAll( [selector] )
$.nextUntil( [selector] )
$.offsetParent( )
$.parent( [selector] )
$.parents( [selector] )
$.parentsUntil( [selector] )
$.prev( [selector] )
$.prevAll( [selector] )
$.prevUntil( [selector] )
$.siblings( [selector] )

#### JQ-15: Miscellaneous
$.add( selector [, context] | elements | html )
$.andSelf( )
$.contents( )
$.end( )

***

## JQ-16: jQuery Ajax

// GET BACK AND DO THIS!

## JQ-17: jQuery CSS

#### JQ-18: CSS
str.css( name )
$.css( name, val | map | name, fn(index, val) )

#### JQ-19: Positioning
obj.offset( )

$.offset( coord | fn( index, coord ) )
$.offsetParent( )

obj.position( )

int.scrollTop( )
$.scrollTop( val )

int.scrollLeft( )
$.scrollLeft( val )

#### JQ-20: Height and Width

int.height( )
$.height( val | fn(index, height ) )

int.width( )
$.width( val | fn(index, height ) )

int.innerHeight( )
int.innerWidth( )

int.outerHeight( [includeMargin] )
$.outerHeight( val | fn(index, outerHeight ) ) 1.8+

int.outerWidth( [includeMargin] )
$.outerWidth( val | fn(index, outerWidth ) ) 1.8+

***

## JQ-21: jQuery Manipulation

#### JQ-22: Inserting Inside

$.append( content | fn( index, html ) )
$.appendTo( target )
$.prepend( content | fn( index, html ) )
$.prependTo( target )

#### JQ-23: Inserting Outside
$.after( content | fn() )
$.before( content | fn() )
$.insertAfter( target )
$.insertBefore( target )


#### JQ-24: Inserting Around
$.unwrap( )
$.wrap( wrappingElement | fn )
$.wrapAll( wrappingElement | fn )
$.wrapInner( wrappingElement | fn )

#### JQ-25: Replacing
$.replaceWith( content | fn )
$.replaceAll( selector )

#### JQ-26: Removing
$.detach( [selector] )
$.empty( )
$.remove( [selector] )

#### JQ-27: Copying
$.clone( [withDataAndEvents], [deepWithDataAndEvents] )

***

## JQ-28: jQuery Events

#### JQ-29: Events

#### JQ-30: Page Load

$.ready( fn() )

#### JQ-31: Event Handling

$.on( events [, selector] [, data], handler )1.7+
$.on( events-map [, selector] [, data] )1.7+
$.off( events [, selector] [, handler] )1.7+
$.off( events-map [, selector] )1.7+
$.bind( type [, data ], fn(eventObj) )
$.bind( type [, data], false )
$.bind( array )
$.unbind( [type] [, fn])
$.one( type [, data ], fn(eventObj) )
$.trigger( event [, data])
obj.triggerHandler( event [, data])
$.delegate( selector, type, [data], handler)
$.undelegate( [selector, type, [handler]]) | selector, events | namespace )

#### JQ-32: Live Events

$.live( eventType [, data], fn() )
$.die( ), .die( [eventType] [, fn() ])

#### JQ-33: Interaction Helpers

$.hover( fnIn(eventObj), fnOut(eventObj))
$.toggle( fn(eventObj), fn2(eventObj) [, ...])

#### JQ-34: Event Helpers

function ( [data,] [fn] )
$.blur,
.mousedown,
.change,
.mouseenter,
.click,
.mouseleave,
.dblclick,
.mousemove,
.error,
.mouseout,
.focus,
.mouseover,
.focusin,
.mouseup,
.focusout,
.resize,
.keydown,
.scroll,
.keypress,
.select,
.keyup,
.submit,
.load( [data,] fn ),
.unload( [data,] fn )

***

## JQ-35: jQuery Effects

#### JQ-36: Effect Basics

$.show( [ duration [, easing] [, fn] ]  )
$.hide( [ duration [, easing] [, fn] ]  )
$.toggle( [showOrHide] )
$.toggle( duration [, easing] [, fn] )

#### JQ-37: Sliding

$.slideDown( duration [, easing] [, fn] )
$.slideUp( duration [, easing] [, fn] )
$.slideToggle( [duration] [, easing] [, fn] )

#### JQ-38: Fading

$.fadeIn( duration [, easing] [, fn] )
$.fadeOut( duration [, easing] [, fn] )
$.fadeTo( [duration,] opacity [, easing] [, fn] )
$.fadeToggle( [duration,] [, easing] [, fn] )

#### JQ-39: Custom

$.animate( params [, duration] [, easing] [, fn] )
$.animate( params, options )
$.stop( [queue] [, clearQueue] [, jumpToEnd] )1.7*
$.delay( duration [, queueName] )

***

# JQ-40: jQuery FAQ

### JQ-41: Example - How to target something within an anchor tag

In the bottom example from NPWS YAC, we are targeting a div within an anchor tag that will allow us to open a map. That being said, we do not want the anchor tag to activate in this example, so we use the `e.target` capability to find whether or not we are targeting what we want, and if not - we ensure the href doesn't activate.

```javascript
$('.hero .toggle').on('click', function (e) {
			if ($(e.target).hasClass('geolocation')) {
				console.log('here');
				map.$elem.toggleClass('-active').one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function () {
					if (!map.map) {
						map.initMap();
					}
				});

				if ($('html').hasClass('ie9') || $('html').hasClass('lt-ie9')) {
					if (!map.map) {
						map.initMap();
					}
				}

				if (map.$elem.hasClass('-active')) {
					map.$toggle.text('Close the map');
				} else {
					map.$toggle.text('View the ' + map.title + ' map');
				}

				return false;
			} else {
				e.preventDefault();
				$(this).parent().toggleClass('-active');
			}
		});
```
