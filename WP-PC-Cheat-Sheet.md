# WP PRES COMPANY CHEAT SHEET

## WPPRES-1: FAQ

**Q: I'm having a database connection failure through MAMP**

A: Double check the wp_options in the siteurl and home settings and that they correctly match MAMP. If you are on the default MAMP ports, you may need localhost:8888 in both addresses. Also check the wp_config.php file in your text editor to ensure the content URL is also correct.

Also be sure to check your /etc/hosts file to see what address and terms are set up and that you restart the mySQL daemon, MAMP and Sequel Pro.

**Q: Adjust get_posts posts_per_page for a data["term"] request**

A: Add it as an argument in twig or create a custom function adjusting the posts_per_page. You can pass any get_posts properties as arguments here.

**Q: Where can I find what I need?**

A: Check against the staging website if it is up to grab things like taxonomies, types, and to figure out the layout.


## WPPRES-2: Custom Type Relationships

```php
// in author-articles.php

// be sure to require it in the functions.php file!

<?php

class AuthorArticles {

	// Get all locations w/ recent posts
	public static function getAuthorArticles($author) {

		$args = new WP_Query([
		    'post_type' => 'post',
		    'no_found_rows' => true,
			'fields' => 'ids',
			'orderby' => 'date',
			'order' => 'desc',
			'meta_query' => [
					[
						'key' => 'article_author',
						'value' => $author,
						'compare' => 'LIKE'
					]
				]
		]);

		$postIds = $args->get_posts();

		$results = Timber::get_posts($postIds);

		return Timber::get_posts($postIds);
	}

}

?>

// example in use
// Author Template - single-authors.php file

<?php

/* Template Name: Author */

$data = Context::getDefaultContext();

$data['author'] = Timber::get_post();

$data['posts'] = AuthorArticles::getAuthorArticles($data['author']->id);

$data['breadcrumbs'] = [
	[
		'text' => 'Authors',
		'url' => $data['site']->url .'/authors'
	]
];


Timber::render('author.twig', $data);

?>
```

## WPPRES-3: Example of Rendering a .twig file using Timber WP functions
- using the above examples

```html

// __author.twig__

{% if post.article_author %}
{% set author = TimberPost(post.get_field('article_author')) %}
<div class="author-container">
	<p>Article By</p>
	<div class="author">
		<div class="image">
			{% set image = TimberImage(author.get_thumbnail) %}
			{% include 'partials/image.twig' with {
				image: image,
				size: 'square_400'
			} %}
		</div>
		<div class="info">
			<h3 class="title">{{ author.title }}</h3>
			{% for social in author.get_field('social') %}
				<div class='social'>
					<a href='{{ social.url }}' target="_blank" class='icon'>
						<i class='{{ socialIcons[social.network] }}'></i>
					</a>
					<a href='{{ social.url }}' target="_blank">
						<span>{{ social.display }}</span>
					</a>
				</div>
			{% endfor %}
			<a class="authorlink" href="{{ author.link }}">View Author Page</a>
		</div>
	</div>
</div>
{% endif %}

***

// __list.twig__

<div class="list -post">
	<ul class="list-items">
	{% for post in posts %}
 		{% include 'partials/post/list-item.twig' %}
 	{% else %}
        <p>Sorry, no posts matched your criteria</p>
	{% endfor %}
	</ul>
</div>

***

__list-item.twig__

<li class="list-item -post tile">
	<a href="#">
		<div class="image">
			<img src="{{ post.get_thumbnail }}" alt="">
		</div>
		<div class="info">
			<h3 class="title">{{ post.title }}</h3>
			<p>{{ post.intro }}</p>
			<div class="read-more">
				<a href="{{ post.link }}">read more ></a>
			</div>
		</div>
	</a>
</li>
```

## WPPRES-4: Example PHP functions.php

```php
<?php

add_filter('show_admin_bar', '__return_false');

require_once('functions/routes.php');
require_once('functions/twig.php');
require_once('functions/theme_support.php');
require_once('functions/enqueue_scripts.php');
require_once('functions/acf.php');
require_once('functions/timber.php');
require_once('functions/context.php');
require_once('functions/locations.php');
require_once('functions/author_articles.php');
require_once('functions/infobox.php');

if (!is_admin()) {
	require_once('functions/post_filters.php');
}

?>
```

## WPPRES-5: Creating AJAX (Loading example)

Using twig, variables were passed down to be used for things such as `loadmore.twig`, while a PHP class, routes and functions were set up to interact with the JS file.

__function.php__

```php
<?php
...
require_once('functions/load_more.php');
...
?>
```

__loadmore.php__

```php
<?php

class LoadMore {
	public function loadNextSet($params) {
		$perPage = 6;
	    $page = $params['page'];
	    $category = $params['cat'];
	    $data = Context::getDefaultContext();
	    $data['category'] = new TimberTerm($category);
	    $data['tag'] = 'tag';

	    $posts = $data['category']->get_posts([
	      'posts_per_page' => $perPage,
	      'orderby' => 'date',
	      'order' => 'DESC',
	      'offset' => ($perPage*$page) + 3,
	    ]);

	    $data['posts'] = $posts;

	    Timber::render('partials/post/grid.twig', $data);
	    exit();
	}
}

?>
```

__routes.php__

```php
...
// $params are the :section, :cat and :page args
Routes::map(':section/:cat/:page', function($params){
    $articles = new LoadMore();
    echo $articles->loadNextSet($params);
});
...
```

```

__loadmore.twig__

```html
<div class="loadmore-container" data-page='1' data-section='{{ section }}' data-category='{{ category }}'>
	<a>Load More</a>
</div>
```

__load-more.js__

```javascript
var loadMore = {
	$loadMoreContainer: $('.loadmore-container'),
	category: $('.loadmore-container').data('category'),
	section: $('.loadmore-container').data('section'),
	page: $('.loadmore-container').data('page'),
	base_url: $('meta[name=base_url]').attr('content'),
	perPage: 6,

	init: function () {

		// Show mega-menu when mega-menu link is focused
		loadMore.$loadMoreContainer.on('click', function (e) {
			e.preventDefault();
			loadMore.loadNext();
		});
	},

	loadNext: function () {

		return $.ajax({
			url: loadMore.base_url + '/' + loadMore.section + '/' + loadMore.category + '/' + loadMore.page,
			type: 'GET',
			success: loadMore.results,
			error: loadMore.outputError,
		});
	},

	results: function (data) {
		var numPosts = $(data).find('li.-post').length;
		loadMore.page = parseInt(loadMore.page) + 1;
		var render = $(data).find('li.-post').unwrap();
		$('ul.grid').last().append(render);

		if (numPosts < loadMore.perPage) {
			loadMore.hideViewAll();
		}
	},

	hideViewAll: function () {
		loadMore.$loadMoreContainer.css('display', 'none');
	},
};

module.exports = {
	init: loadMore.init,
};
```
