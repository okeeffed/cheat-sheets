# Drupal 8 Theming

<!-- TOC -->

*   [Drupal 8 Theming](#drupal-8-theming)
    *   [THEME.info.yml](#themeinfoyml)
    *   [THEME.theme](#themetheme)
    *   [Templates](#templates)
    *   [THEMENAME.libraries.yml file](#themenamelibrariesyml-file)
    *   [THEMENAME.breakpoints.yml file](#themenamebreakpointsyml-file)
    *   [config/\* directory](#config-directory)
    *   [Describing the theme with an info file](#describing-the-theme-with-an-info-file)
        *   [Generating an info file](#generating-an-info-file)
        *   [Editing the file](#editing-the-file)
    *   [Twig Cache](#twig-cache)
    *   [Regions](#regions)
        *   [Confirmation that it is working](#confirmation-that-it-is-working)
    *   [Suggestions added by "hooks"](#suggestions-added-by-hooks)
    *   [THEME.theme proprocessing](#themetheme-proprocessing)
    *   [Custom Twig functions](#custom-twig-functions)

<!-- /TOC -->

## THEME.info.yml

THEMENAME.info.yml file

Defines required meta-data for a theme and provides additional optional settings used by Drupal's theme layer.

This is the only required file for a theme. The name of this file determines the value of THEMENAME.

Example: themes/icecream/icecream.info.yml

## THEME.theme

THEMENAME.theme file

A PHP file that contains conditional logic, and handles preprocessing of variables before they are output via template files.

Example: themes/icecream/icecream.theme

## Templates

templates/.html.twig files

Twig template files provide HTML markup and very basic presentation logic. Template files in a theme generally follow a specific naming convention and are used to override the default markup output by Drupal. Twig template files are required to be placed within the templates/ sub-directory and may be organized into any number of sub-folders from there.

## THEMENAME.libraries.yml file

Define CSS and JavaScript libraries that can be loaded by your theme. All CSS and JavaScript should be added to the page via an asset library.

Example: themes/icecream/icecream.libraries.yml

## THEMENAME.breakpoints.yml file

Defines the responsive design breakpoints used by your theme for Drupal.

Example: themes/icecream/icecream.breakpoints.yml

## config/\* directory

Some themes may contain additional configuration for Drupal. A common example is image styles used by your theme. This optional configuration is located in files within the config/ directory.

Example: themes/icecream/config/schema/icecream.schema.yml

## Describing the theme with an info file

### Generating an info file

`drupal generate:theme` will walk you through theme setup.

### Editing the file

```
# THEMENAME.info.yml file for Ice Cream example theme.
name: Ice Cream
type: theme
base theme: classy
description: 'A great theme for warm summer days.'
package: Custom
core: 8.x
```

For a complete list of keys:

*   name (required) The human readable name of your theme, displayed in Drupal's UI when administrators are browsing the list of available themes
*   type (required) Tell Drupal what type of project this is. Required, and will always be set to 'theme' for a Theme.
*   description A short one-line description used in the UI when listing your theme.
*   package The package your theme belongs in; used for grouping projects together.
*   core (required) The version of Drupal core that your theme is compatible with. Required; for Drupal 8 themes this will likely always just be '8.x'.
*   base theme (default = Stable) The machine name of an installed theme to be used as a base theme. If no base theme is set, then the core base theme "Stable" will be used. Classy is the other base theme alternative provided in core. If no base theme should be used, enter "false" as a value for this key.

See more [here](https://www.drupal.org/node/2349827)

## Twig Cache

Ensure you disable the cache to enable updates on reloads/save changes.

## Regions

Regions are areas of a page into which content can be placed. Content is assigned to regions via blocks. If you think of blocks as the base elements that can be used to compose a page, then regions provide the containers within the page where an administrator can place blocks. Regions give your site layout, and your markup its structure.

Regions are defined by themes. Since the theme ultimately controls the layout of a page, it must also specify the set of regions that an administrator is allowed to place content into, and how those regions are represented in the HTML markup of the page. A header region might be rendered as an HTML `<header>` and a left sidebar might be an `<aside>` or a `<div>` depending on the requirements of the theme.

### Confirmation that it is working

Navigate to `Structure > Block` layout (admin/structure/block) to confirm that Drupal is now using your regions. Region names shown in block layout UI.

If we now edit `page.html.twig`...

Displaying regions in your page.html.twig template.

If you haven't already, you'll need to override the default page.html.twig file since we'll be modifying it. Learn more about overriding template files.

Adding the metadata to your THEMENAME.info.yml file above has automatically introduced new variables that you can access in your page.html.twig template. These contain the content of whatever blocks have been placed into each region. The names correspond with the array keys you used in your THEMENAME.info.yml file.

`content: 'Content'` corresponds with `{{ page.content }}` and `sidebar_first: 'Sidebar first'` corresponds with `{{ page.sidebar_first }}`

Now, just adjust the markup in your page.html.twig template to accommodate your new regions.

```
<div class="layout-content">{{ page.content }}</div>
```

Tip: When printing regions in your template that are not guaranteed to have content, it's a good idea to wrap them in some conditional logic. This way you won't end up with empty container elements in your output. This is a key part of creating responsive themes.

```
{% if page.sidebar_first %}
  <aside class="layout-sidebar-first" role="complementary">
    {{ page.sidebar_first }}
  </aside>
{% endif %}
```

## Suggestions added by "hooks"

Theme hook suggestions are provided by one of three hooks. Both modules and themes can add or remove suggestions from the list.

```
hook_theme_suggestions_HOOK(array $variables)
hook_theme_suggestions_alter(array &$suggestions, array $variables, $hook)
hook_theme_suggestions_HOOK_alter(array &$suggestions, array $variables)
```

For example, if you wanted to use a different template to display nodes for users who are logged in to your site you might add a theme hook suggestion via your theme that makes it so the template node--authenticated.html.twig is added to the list, and thus used, for all logged in users.

## THEME.theme proprocessing

Preprocess functions allow Drupal themes to manipulate the variables that are used in Twig template files by using PHP functions to preprocess data before it is exposed to each template. All of the dynamic content available to theme developers within a Twig template file is exposed through a preprocess function. Understanding how preprocess functions work, and the role they play, is important for both module developers and theme developers.

Some examples:

*   template_preprocess(&$variables, $hook): Creates a default set of variables for all theme hooks with template implementations. Provided by Drupal Core.
*   template_preprocess_HOOK(&$variables): Should be implemented by the module that registers the theme hook, to set up default variables.
*   MODULE_preprocess(&$variables, $hook): hook_preprocess() is invoked on all implementing modules.
*   MODULE_preprocess_HOOK(&$variables): hook_preprocess_HOOK() is invoked on all implementing modules, so that modules that didn't define the theme hook can alter the variables.
*   ENGINE_engine_preprocess(&$variables, $hook): Allows the theme engine to set necessary variables for all theme hooks with template implementations.
*   ENGINE_engine_preprocess_HOOK(&$variables): Allows the theme engine to set necessary variables for the particular theme hook.
*   THEME_preprocess(&$variables, $hook): Allows the theme to set necessary variables for all theme hooks with template implementations.
*   THEME_preprocess_HOOK(&$variables): Allows the theme to set necessary variables specific to the particular theme hook.

## Custom Twig functions

If you want to look up Drupal-specific Twig functions on api.drupal.org, you will need to search for the corresponding PHP callable. You can find the corresponding method in `core/lib/Drupal/Core/Template/TwigExtension.php` inside the method: public function getFunctions().
