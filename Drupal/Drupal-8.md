# Drupal 8

<!-- TOC -->

*   [Drupal 8](#drupal-8)
    *   [Installation](#installation)
    *   [Basics of Content Creation](#basics-of-content-creation)
    *   [Publishing Options - Published, Promoted, URL](#publishing-options---published-promoted-url)
    *   [5. Simple Site - Content](#5-simple-site---content)
    *   [8. Extending Drupal](#8-extending-drupal)
        *   [Core Modules](#core-modules)
        *   [Forum module](#forum-module)
        *   [Finding modules](#finding-modules)
    *   [9. Creating a site - Content Types](#9-creating-a-site---content-types)
        *   [Updating an existing content type](#updating-an-existing-content-type)
        *   [Changing how the content type displays](#changing-how-the-content-type-displays)
        *   [Create a new content type - Event](#create-a-new-content-type---event)

<!-- /TOC -->

## Installation

Download Drupal: https://www.drupal.org/download

*   Save the contents at the base of your new repo/directory i.e. so the url will be `localhost/YOUR_DIRECTORY/DRUPAL-CONTENT/`

Go to `localhost/YOUR_DIRECTORY/DRUPAL-CONTENT/` and follow the prompts
You also need to run `composer install` from your sites root directory.

## Basics of Content Creation

What we deal with out-of-the-box. Content entry being the most important.

Using `Content > Add content` to get a list of content that we can add.

If we create a page `About` and change the settings on the right hand side, we can also begin to add tables for quick access.

## Publishing Options - Published, Promoted, URL

If we create an article without the default settings, we can then use `saved as unpublished` from the save and publish dropdown. If content is not published, you'll be redirected to a login from a private browser and not allowed to use.

On the right-hand side options, we can also edit things out of the box such as comments, the url path, author info, promotion options as well as the previously explored comment settings. Promotion options also allow you to deal with `sticky-at-top-of-list`.

## 5. Simple Site - Content

## 8. Extending Drupal

### Core Modules

Two types: `core` and `contributed`. Contributed is given back from the community. It's not maintained by the community.

Under the `manage > extend` tab, you can manage the modules. Selecting them on or off and seeing more information is available from here.

Extra configuration may be available from the accordian dropdown.

### Forum module

You can also manage permissions from the `people` section. If you have modules installed, you can see from the accordian dropdown what is required for it to work.

If modules themselves are enabled, they may become directly available on the `content` menu.

### Finding modules

We can search drupal.org and search for modules.

## 9. Creating a site - Content Types

### Updating an existing content type

What happens if we want to add a field for articles if we want to add photo credit? If you are building a site for someone else, take them into account.

From `Structure > Content Type` you can select the `Manage fields` dropdown to edit existing types and what we can easily view. To add something such as a new field, we need to `manage fields`.

As we update the field names, we can see the `machine name` on the left updating - this is important for the database itself.

The next step is asking for global settings themselves.

Next, we can add help text, add `required` and a default value.

### Changing how the content type displays

From `Structure > Content Type`, we can change the display.

### Create a new content type - Event
