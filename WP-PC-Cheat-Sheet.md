# WP PRES COMPANY CHEAT SHEET

<!-- TOC -->

*   [WP PRES COMPANY CHEAT SHEET](#wp-pres-company-cheat-sheet)
    *   [WPPRES-1: FAQ](#wppres-1-faq)
    *   [WPPRES-2: Custom Type Relationships](#wppres-2-custom-type-relationships)
    *   [WPPRES-3: Example of Rendering a .twig file using Timber WP functions](#wppres-3-example-of-rendering-a-twig-file-using-timber-wp-functions)
    *   [WPPRES-4: Example PHP functions.php](#wppres-4-example-php-functionsphp)
    *   [WPPRES-5: Creating AJAX (Loading example)](#wppres-5-creating-ajax-loading-example)

<!-- /TOC -->

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

*   using the above examples

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

**function.php**

```php
<?php
...
require_once('functions/load_more.php');
...
?>
```

**loadmore.php**

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

**routes.php**

```php
...
// $params are the :section, :cat and :page args
Routes::map(':section/:cat/:page', function($params){
    $articles = new LoadMore();
    echo $articles->loadNextSet($params);
});
...
```

````
__loadmore.twig__

```html
<div class="loadmore-container" data-page='1' data-section='{{ section }}' data-category='{{ category }}'>
	<a>Load More</a>
</div>
````

**load-more.js**

```javascript
var titleTagline = require('./title-tagline.js');

var loadMore = {
    $loadMoreContainer: $('.loadmore-container'),
    category: $('.loadmore-container').data('category'),
    section: $('.loadmore-container').data('section'),
    search: $('.loadmore-container').data('search'),
    page: $('.loadmore-container').data('page'),
    base_url: $('meta[name=base_url]').attr('content'),
    perPage: 6,

    init: function() {
        // Show mega-menu when mega-menu link is focused
        loadMore.$loadMoreContainer.on('click', function(e) {
            e.preventDefault();
            if ($('ul.grid').length > 0) {
                loadMore.loadNextSection();
            } else {
                loadMore.loadNextSearch();
            }
        });
    },

    loadNextSection: function() {
        return $.ajax({
            url:
                loadMore.base_url +
                '/section/' +
                loadMore.section +
                '/' +
                loadMore.category +
                '/' +
                loadMore.page,
            type: 'GET',
            success: loadMore.resultsSection,
            error: loadMore.outputError
        });
    },

    loadNextSearch: function() {
        var urlString = loadMore.search;
        urlString = urlString.replace(' ', '+');
        console.log(urlString);
        return $.ajax({
            url:
                loadMore.base_url +
                '/search/' +
                urlString +
                '/' +
                loadMore.page,
            type: 'GET',
            success: loadMore.resultsSearch,
            error: loadMore.outputError
        });
    },

    resultsSection: function(data) {
        var numPosts = $(data).find('li.-post').length;
        loadMore.page = parseInt(loadMore.page) + 1;
        var render = $(data)
            .find('li.-post')
            .unwrap();
        $('ul.grid')
            .last()
            .append(render);

        if (numPosts < loadMore.perPage) {
            loadMore.hideViewAll();
        }

        titleTagline.init();
        titleTagline.doneResizing();
    },

    resultsSearch: function(data) {
        console.log(data);

        var numPosts = $(data).find('li.list-item').length;
        loadMore.page = parseInt(loadMore.page) + 1;

        var render = $(data)
            .find('li.list-item')
            .unwrap();
        $('ul.list')
            .last()
            .append(render);

        if (numPosts < loadMore.perPage) {
            loadMore.hideViewAll();
        }
    },

    hideViewAll: function() {
        loadMore.$loadMoreContainer.css('display', 'none');
    }
};

module.exports = {
    init: loadMore.init
};
```

**loadmore.php**

```php
<?php

class LoadMore {
	public function loadNextLocationsSet($params) {
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

	public function loadNextSearchSet($params) {
		$perPage = 6;
	    $page = (int)$params['page'];
	    $field = $params['search'];
	    $offset = ($perPage*$page) + 4;
	    $data = Context::getDefaultContext();
	    $search = get_query_var('s');
		$searchTerm = htmlspecialchars($field);

	    $data['posts'] = SearchTerms::getSearchArticles($field, $offset, $perPage);

	    Timber::render('partials/post/list.twig', $data);
	    exit();
	}

	public function loadNextInspirationsSet($params) {

		$exclusion = [];

		$perPage = 6;
		$page = $params['page'];
		$category = $params['cat'];
		$data = Context::getDefaultContext();
		$data['category'] = new TimberTerm($category);
		$data['tag'] = 'tag';

		if($featuredIds = $data['category']->featured) {
			$data['categoryFeatured'] = Timber::get_posts($featuredIds);
			$exclusion = self::updateExclusionList($data['categoryFeatured'], $exclusion);
		}

		$posts = $data['category']->get_posts([
			'posts_per_page' => $perPage,
			'orderby' => 'date',
			'order' => 'DESC',
			'offset' => ($perPage*$page) + 4,
			'post__not_in' => $exclusion,
		]);

		$data['posts'] = $posts;

	    Timber::render('partials/post/grid.twig', $data);
	    exit();
	}

	static function updateExclusionList($original, $exclusion) {
		foreach($original as $post) {
			if($post) {
				array_push($exclusion, $post->id);
			}
		}
		return $exclusion;
	}
}

?>
```

## WPPRES-6: Custom Search Terms

This example was taken from YAC when it was required to search for a CPT ID and then use it to get some post ids returned with the latest meta data values.

```php
// from functions > search_term.php

global $wpdb;

$park_ids = [];
$meta_arrays = [];
$posts_park = [];

if (strlen($search_term) > 3) {

	$park_post_type='parks';
	$park_post_status='publish';

	// get the park ids that relate to the search
	$park_args = $wpdb->get_col( $wpdb->prepare(
			"
			SELECT ID
			FROM $wpdb->posts WP
			WHERE WP.post_title LIKE '%%%s%%'
			AND post_type='%s'
			AND post_status='%s'
			",
			esc_sql($search_term),
			esc_sql($park_post_type),
			esc_sql($park_post_status)
		)
	);

	$park_ids = $park_args;

	if ($park_ids != null ) {

		$park_ids = esc_sql( $park_ids );
		$park_ids_str = "'[^0-9]*" . implode( "[^0-9]*'|'[^0-9]*", $park_ids ) . "[^0-9]*'";
		$park = 'park';

		//find the parks
		$init_park = $wpdb->get_col( $wpdb->prepare(
				"
				SELECT WP.ID
				FROM $wpdb->posts WP
				INNER JOIN $wpdb->postmeta PM
				ON ( WP.ID = PM.post_id )
				WHERE 1=1
				AND ( ( PM.meta_key = %s
				AND PM.meta_value REGEXP {$park_ids_str} ) )
				AND WP.post_type = 'post'
				AND (WP.post_status = 'publish')
				GROUP BY WP.ID
				ORDER BY WP.post_title DESC, WP.post_date DESC
				",
				esc_sql($park)
			)
		);

		// grab post results to allow metadata
		// comparison for park
		$results = Timber::get_posts($init_park);

		// filter the results to ensure posts are associated with
		// the latest and correct `park` value
		if ($results) {
			foreach ($results as $result) {
				if (array_intersect($result->custom['park'], $park_ids)) {
					$posts_park[] = $result->id;
				}
			}
		}
	}
}
```
