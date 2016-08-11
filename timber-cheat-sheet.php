//
//
// 	  Timber Cheat Sheet
//
//

Here are some helpful conversions for functions you're probably well familiar with in WordPress and their Timber equivalents. These assume a PHP file with the Timber::get_context(); function at the top. For example:

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('single.twig', $context);

//
//
// 	  Timber Example
//
//

RedBull home.php file
- $data = Context::getDefaultContext();		//standard include file at the top
- 

<?php

$data = Context::getDefaultContext();

print_r($data);
exit();

// Set page title and other custom data
$data['title'] = $data['site']->title;
$data['events'] = Timber::get_posts([
	'post_type' => 'event',
	'orderby' => 'meta_value_num',
  'meta_key' => 'event_date',
	'order' => 'asc',
	'posts_per_page' => -1,
]);

// render the twig file
Timber::render('home.twig', $data);

?>

// this is the function context found in Redbull under functions > context.php

<?php

class Context {

	// Set up all of the Timber context stuff we need on every page
	public static function getDefaultContext() {
    global $wp;

	$data = Timber::get_context();

	// adding some extra meta to the data context
    $data['meta'] = [
      "title" => $data['site']->title,
      "description" => $data['site']->description,
      "image" => $data['theme']->link . "/img/opengraph.png",
      "url" => home_url(add_query_arg(array(),$wp->request)) . "/"
    ];

		return $data;
	}
}

?> // not actually included in the file


//
//
// 	  TIMBER BLOG INFO
//
//

blog_info('charset') => {{ site.charset }}
blog_info('description') => {{ site.description }}
blog_info('sitename') => {{ site.name }}
blog_info('url') => {{ site.url }}

//
//
// 	  TIMBER BODY CLASS
//
//

implode(' ', get_body_class()) => <body class="{{ body_class }}">


//
//
// 	  TIMBER POST
//
//

the_content() => {{ post.content }}
the_permalink() => {{ post.link }}
the_title() => {{ post.title }}
get_the_tags() => {{ post.tags }}

//
//
// 	  TIMBER THEME
//
//

In WordPress parlance, stylesheet_directory = child theme, template directory = parent theme. Both WP and Timber functions safely return the current theme info if there's no parent/child going on.

get_template_directory_uri() => {{ theme.link }} (Parent Themes)
get_template_directory_uri() => {{ theme.parent.link }} (Child Themes)
get_stylesheet_directory_uri() => {{ theme.link }}
get_template_directory() => {{ theme.parent.path }}
get_stylesheet_directory() => {{ theme.path }}

//
//
// 	  WP FUNCTIONS
//
//

wp_footer() => {{ wp_footer }}
wp_head() => {{ wp_head }}

//+++++++++++++++++++++++++++++++//

//
//
// 	  WP INTEGRATIONS!
//
//

https://github.com/timber/timber/wiki/WP-Integration

**
**
** the_content
**
**

You're probably used to calling the_content() in your theme file. This is good. Before outputting, WordPress will run all the filters and actions that your plugins and themes are using. If you want to get this into your new Timber theme (and you probably do). Call it like this:

<div class="my-article">
   {{post.content}}
</div>
This differs from {{post.post_content}} which is the raw text stored in your database

**
**
** hooks
**
**

Timber hooks to interact with WordPress use this/style/of_hooks instead of this_style_of_hooks. This matches the same methodology as Advanced Custom Fields.

Full documentation to come

**
**
** Scripts + Stylesheets
**
**

What happened to wp_head() and wp_footer()? Don't worry, they haven't gone away. In fact, they have a home now in the Timber::get_context() object. When you setup your PHP file, you should do something like this:

/* single.php */
$data = Timber::get_context();
$data['post'] = new TimberPost();
Timber::render('single.twig', $data);

Now in the corresponding Twig file:

{# single.twig #}
<html>
    <head>
    <!-- Add whatever you need in the head, and then...-->
    {{wp_head}}
    </head>

    <!-- etc... -->

    <footer>
        Copyright &copy; {{"now"|date('Y')}}
    </footer>
    {{wp_footer}}
    </body>
</html>

WordPress will inject whatever output had been loaded into wp_head() and wp_footer() through these variables.


**
**
** 			FUNCTIONS
**
**

But my theme/plugin has some functions I need! Do I really have to re-write all of them?

No.

Let's say you modified twentyeleven and need some of the functions back. Here's the quick-and-dirty way:

<div class="posted-on">{{function("twentyeleven_posted_on")}}</div>
Oh. That's not so bad. What if there are arguments? Easy:

{# single.twig #}
<div class="admin-tools">
    {{function('edit_post_link', 'Edit', '<span class="edit-link">', '</span>')}}
</div>
Nice! Any gotchas? Unfortunately yes. While the above example will totally work in a single.twig file it will not in a loop. Why? Single.twig/single.php retain the context of the current post. Thus for a function like edit_post_link (which will try to guess the ID# of the post you want to edit, based on the current post in the loop), the same function requires some modification in a file like archive.twig or index.twig. There, you will need to explicitly set the post ID:

{# index.twig #}
<div class="admin-tools">
    {{function('edit_post_link', 'Edit', '<span class="edit-link">', '</span>', post.ID)}}
</div>
You can also use fn('my_function') as an alias.

For a less quick-and-dirty way, you can use the TimberFunctionWrapper. This class sets up your PHP functions as functions you can use in your Twig templates. It will execute them only when you actually call them in your template. You can quickly set up a TimberFunctionWrapper using TimberHelper:

/**
 * @param string $function_name
 * @param array (optional) $defaults
 * @param bool (optional) $return_output_buffer Return function output instead of return value (default: false)
 * @return \TimberFunctionWrapper
 */
TimberHelper::function_wrapper( $function_name, $defaults = array(), $return_output_buffer = false );
So if you want to add edit_post_link to your context, you can do something like this:

/* single.php */
$data = Timber::get_context();
$data['post'] = new TimberPost();
$data['edit_post_link'] = TimberHelper::function_wrapper( 'edit_post_link', array( __( 'Edit' ), '<span class="edit-link">', '</span>' ) );
Timber::render('single.twig', $data);
Now you can use it like a 'normal' function:

{# single.twig #}
<div class="admin-tools">
    {{edit_post_link}}
</div>
{# Calls edit_post_link using default arguments #}

{# single-my-post-type.twig #}
<div class="admin-tools">
    {{edit_post_link(null, '<span class="edit-my-post-type-link">')}}
</div>
{# Calls edit_post_link with all defaults, except for second argument #}



**
**
** 			ACTIONS
**
**

Call them in your Twig template...

{% do action('my_action') %}
{% do action('my_action_with_args', 'foo', 'bar') %}
... in your functions.php file:

add_action('my_action', 'my_function');

function my_function($context){
    //$context stores the template context in case you need to reference it
    echo $context['post']->post_title; //outputs title of yr post
}
add_action('my_action_with_args', 'my_function_with_args', 10, 2);

function my_function_with_args($foo, $bar){
    echo 'I say '.$foo.' and '.$bar;
}
You can still get the context object when passing args, it's always the last argument...

add_action('my_action_with_args', 'my_function_with_args', 10, 3);

function my_function_with_args($foo, $bar, $context){
    echo 'I say '.$foo.' and '.$bar;
    echo 'For the post with title '.$context['post']->post_title;
}
Please note the argument count that WordPress requires for add_action

**
**
** 				FILTERS
**
**

{{ post.content|apply_filters('my_filter') }}
{{ "my custom string"|apply_filters('my_filter',param1,param2,...) }}

**
**
** 				WIDGETS
**
**

Everyone loves widgets! Of course they do...

$data['footer_widgets'] = Timber::get_widgets('footer_widgets');
...where 'footer_widgets' is the registered name of the widgets you want to get(in twentythirteen these are called sidebar-1 and sidebar-2 )

Then use it in your template:

{# base.twig #}
<footer>
    {{footer_widgets}}
</footer>

Using Timber inside your own widgets

You can also use twig templates for your widgets! Let's imagine we want a widget that shows a random number each time it is rendered.

Inside the widget class, the widget function is used to show the widget:

public function widget($args, $instance) {
    $number = rand();
    Timber::render('random-widget.twig', array('args' => $args, 'instance' => $instance, 'number' => $number));
}
The corresponding template file random-widget.twig looks like this:

{{ args.before_widget | raw }}
{{ args.before_title | raw }}{{ instance.title | apply_filters('widget_title') }}{{ args.after_title | raw }}

<p>Your magic number is: <strong>{{ number }}</strong></p>

{{ args.after_widget | raw }}
The raw filter is needed here to embed the widget properly.

You may also want to check if the Timber plugin was loaded before using it:

public function widget($args, $instance) {
    if (!class_exists('Timber')) {
        // if you want to show some error message, this is the right place
        return;
    }
    $number = rand();
    Timber::render('random-widget.twig', array('args' => $args, 'instance' => $instance, 'number' => $number));
}
Shortcodes

Well, if it works for widgets, why shouldn't it work for shortcodes ? Of course it does !

Let's implement a [youtube] shorttag which embeds a youtube video. For the desired usage of [youtube id=xxxx] we only need a few lines of code:

// should be called from within an init action hook
add_shortcode('youtube', 'youtube_shorttag');

function youtube_shorttag($atts) {
    if(isset($atts['id'])) {
        $id = sanitize_text_field($atts['id']);
    } else {
        $id = false;
    }
    // this time we use Timber::compile since shorttags should return the code
    return Timber::compile('youtube-short.twig', array('id' => $id));
}
In youtube-short.twig we have the following template:

{% if id %}
<iframe width="560" height="315" src="//www.youtube.com/embed/{{ id }}" frameborder="0" allowfullscreen></iframe>
{% endif %}
Now, when the YouTube embed code changes, we only need to edit the youtube-short.twig template. No need to search your PHP files for this one particular line.

Layouts with Shortcodes

Timber and Twig can process your shortcodes by using the {% filter shortcodes %} tag. Let's say you're using a [tab] shortcode, for example:

{% filter shortcodes %}
    [tabs tab1="Tab 1 title" tab2="Tab 2 title" layout="horizontal" backgroundcolor="" inactivecolor=""]
        [tab id=1]
            Something something something
        [/tab]

        [tab id=2]
            Tab 2 content here
        [/tab]
    [/tabs]
{% endfilter %}














