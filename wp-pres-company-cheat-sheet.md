# WP PRES COMPANY CHEAT SHEET

## FAQ

**Q: Adjust get_posts posts_per_page for a data["term"] request**

A: Add it as an argument in twig or create a custom function adjusting the posts_per_page.

**Q: Where can I find what I need?**

A: Check against the staging website if it is up to grab things like taxonomies, types, and to figure out the layout.


## Custom Type Relationships

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

## Example of Rendering a .twig file using Timber WP functions
- using the above examples

```html
/********************

 	 author.twig

********************/

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

/********************

      list.twig

********************/

<div class="list -post">
	<ul class="list-items">
	{% for post in posts %}
 		{% include 'partials/post/list-item.twig' %}
 	{% else %}
        <p>Sorry, no posts matched your criteria</p>
	{% endfor %}
	</ul>
</div>

/********************

   list-item.twig

********************/

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

## Example PHP functions.php

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
