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
