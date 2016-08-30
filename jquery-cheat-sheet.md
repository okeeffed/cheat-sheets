# jQuery Core

Core

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

## jQuery Attributes

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

## jQuery Selectors


#### Basics
#id
element
.class, .class.class
*
selector1, selector2
Hierarchy
ancestor descendant
parent > child
prev + next
prev ~ siblings

#### Basic Filters
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

#### Content Filters
:contains(text)
:empty
:has(selector)
:parent

#### Visibility Filters
:hidden
:visible

#### Child Filters
:nth-child(expr)
:first-child
:last-child
:only-child

#### Attribute Filters
[attribute]
[attribute=value]
[attribute!=value]
[attribute^=value]
[attribute$=value]
[attribute*=value]
[attribute|=value]
[attribute~=value]
[attribute][attribute2]

#### Forms
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

#### Form Filters
:enabled
:disabled
:checked
:selected

## jQuery Traversing

#### Filtering
$.eq( index )
$.first( )
$.last( )
$.has( selector ), .has( element )
$.filter( selector ), .filter( fn(index) )
bool.is( selector | function(index) | jQuery object | element )1.7*
$.map( fn(index, element) )
$.not( selector ), .not( elements ), .not( fn( index ) )
$.slice( start [, end] )

#### Tree traversal
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

#### Miscellaneous
$.add( selector [, context] | elements | html )
$.andSelf( )
$.contents( )
$.end( )

## jQuery Ajax

// GET BACK AND DO THIS!

## jQuery CSS

#### CSS
str.css( name )
$.css( name, val | map | name, fn(index, val) )

#### Positioning
obj.offset( )

$.offset( coord | fn( index, coord ) )
$.offsetParent( )

obj.position( )

int.scrollTop( )
$.scrollTop( val )

int.scrollLeft( )
$.scrollLeft( val )

#### Height and Width

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

## jQuery Manipulation

#### Inserting Inside

$.append( content | fn( index, html ) )
$.appendTo( target )
$.prepend( content | fn( index, html ) )
$.prependTo( target )

#### Inserting Outside
$.after( content | fn() )
$.before( content | fn() )
$.insertAfter( target )
$.insertBefore( target )


#### Inserting Around
$.unwrap( )
$.wrap( wrappingElement | fn )
$.wrapAll( wrappingElement | fn )
$.wrapInner( wrappingElement | fn )

#### Replacing
$.replaceWith( content | fn )
$.replaceAll( selector )

#### Removing
$.detach( [selector] )
$.empty( )
$.remove( [selector] )

#### Copying
$.clone( [withDataAndEvents], [deepWithDataAndEvents] )

## jQuery Events

#### Events

#### Page Load

$.ready( fn() )

#### Event Handling

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

#### Live Events

$.live( eventType [, data], fn() )
$.die( ), .die( [eventType] [, fn() ])

#### Interaction Helpers

$.hover( fnIn(eventObj), fnOut(eventObj))
$.toggle( fn(eventObj), fn2(eventObj) [, ...])

#### Event Helpers

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

## jQuery Effects

#### Basics

$.show( [ duration [, easing] [, fn] ]  )
$.hide( [ duration [, easing] [, fn] ]  )
$.toggle( [showOrHide] )
$.toggle( duration [, easing] [, fn] )

#### Sliding

$.slideDown( duration [, easing] [, fn] )
$.slideUp( duration [, easing] [, fn] )
$.slideToggle( [duration] [, easing] [, fn] )

#### Fading

$.fadeIn( duration [, easing] [, fn] )
$.fadeOut( duration [, easing] [, fn] )
$.fadeTo( [duration,] opacity [, easing] [, fn] )
$.fadeToggle( [duration,] [, easing] [, fn] )

#### Custom

$.animate( params [, duration] [, easing] [, fn] )
$.animate( params, options )
$.stop( [queue] [, clearQueue] [, jumpToEnd] )1.7*
$.delay( duration [, queueName] )
