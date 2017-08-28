# Drupal 8 Theming

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

## config/* directory

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

- name (required) The human readable name of your theme, displayed in Drupal's UI when administrators are browsing the list of available themes
- type (required) Tell Drupal what type of project this is. Required, and will always be set to 'theme' for a Theme.
- description A short one-line description used in the UI when listing your theme.
- package The package your theme belongs in; used for grouping projects together.
- core (required) The version of Drupal core that your theme is compatible with. Required; for Drupal 8 themes this will likely always just be '8.x'.
- base theme (default = Stable) The machine name of an installed theme to be used as a base theme. If no base theme is set, then the core base theme "Stable" will be used. Classy is the other base theme alternative provided in core. If no base theme should be used, enter "false" as a value for this key.

See more [here](https://www.drupal.org/node/2349827)

## Twig Cache

Ensure you disable the cache to enable updates on reloads/save changes.

## Regions

Regions are areas of a page into which content can be placed. Content is assigned to regions via blocks. If you think of blocks as the base elements that can be used to compose a page, then regions provide the containers within the page where an administrator can place blocks. Regions give your site layout, and your markup its structure.

Regions are defined by themes. Since the theme ultimately controls the layout of a page, it must also specify the set of regions that an administrator is allowed to place content into, and how those regions are represented in the HTML markup of the page. A header region might be rendered as an HTML `<header>` and a left sidebar might be an `<aside>` or a `<div>` depending on the requirements of the theme.

### Confirmation that it is working

Navigate to `Structure > Block` layout (admin/structure/block) to confirm that Drupal is now using your regions. Region names shown in block layout UI.
