# TWIG CHEAT SHEET

<!-- TOC -->

*   [TWIG CHEAT SHEET](#twig-cheat-sheet)
    *   [Web Synopsis](#web-synopsis)
    *   [Attributes](#attributes)
    *   [Setting Variables](#setting-variables)
    *   [Filters](#filters)
    *   [Functions](#functions)
    *   [Named Arguments](#named-arguments)
    *   [Control Flow Structure](#control-flow-structure)
    *   [Comments](#comments)
    *   [Include](#include)
    *   [Extends](#extends)
    *   [Template Inheritance](#template-inheritance)
    *   [Manual Escaping](#manual-escaping)
    *   [Macros (add in if you think it is relevant)](#macros-add-in-if-you-think-it-is-relevant)

<!-- /TOC -->

// references

http://twig.sensiolabs.org/doc/templates.html

Ensure you have a highlighter tool.

## Web Synopsis

```html
<!DOCTYPE html>
<html>
    <head>
        <title>My Webpage</title>
    </head>
    <body>
        <ul id="navigation">
        {% for item in navigation %}
            <li><a href="{{ item.href }}">{{ item.caption }}</a></li>
        {% endfor %}
        </ul>

        <h1>My Webpage</h1>
        {{ a_variable }}
    </body>
</html>
```

## Attributes

The application passes variables to the templates for manipulation in the template. Variables may have attributes or elements you can access, too. The visual representation of a variable depends heavily on the application providing it.

You can use a dot (.) to access attributes of a variable (methods or properties of a PHP object, or items of a PHP array), or the so-called "subscript" syntax ([]):

```
{{ foo.bar }}
{{ foo['bar'] }}
```

When the attribute contains special characters (like - that would be interpreted as the minus operator), use the attribute function instead to access the variable attribute:

```
{# equivalent to the non-working foo.data-foo #}
{{ attribute(foo, 'data-foo') }}
```

## Setting Variables

```
{% set foo = 'foo' %}
{% set foo = [1, 2] %}
{% set foo = {'foo': 'bar'} %}
```

## Filters

Variables can be modified by filters. Filters are separated from the variable by a pipe symbol (|) and may have optional arguments in parentheses. Multiple filters can be chained. The output of one filter is applied to the next.

The following example removes all HTML tags from the name and title-cases it:

```
{{ name|striptags|title }}
```

Filters that accept arguments have parentheses around the arguments. This example will join a list by commas:

```
{{ list|join(', ') }}
```

To apply a filter on a section of code, wrap it in the filter tag:

```
{% filter upper %}
    This text becomes uppercase
{% endfilter %}
```

Go to the filters page to learn more about built-in filters.

http://twig.sensiolabs.org/doc/filters/index.html

## Functions

Functions can be called to generate content. Functions are called by their name followed by parentheses (()) and may have arguments.

For instance, the range function returns a list containing an arithmetic progression of integers:

```
{% for i in range(0, 3) %}
    {{ i }},
{% endfor %}
```

http://twig.sensiolabs.org/doc/functions/index.html

## Named Arguments

New in version 1.12: Support for named arguments was added in Twig 1.12.

```
{% for i in range(low=1, high=10, step=2) %}
    {{ i }},
{% endfor %}
```

Using named arguments makes your templates more explicit about the meaning of the values you pass as arguments:

```
{{ data|convert_encoding('UTF-8', 'iso-2022-jp') }}

{# versus #}

{{ data|convert_encoding(from='iso-2022-jp', to='UTF-8') }}
```

Named arguments also allow you to skip some arguments for which you don't want to change the default value:

```
{# the first argument is the date format, which defaults to the global date format if null is passed #}
{{ "now"|date(null, "Europe/Paris") }}

{# or skip the format value by using a named argument for the time zone #}
{{ "now"|date(timezone="Europe/Paris") }}
```

You can also use both positional and named arguments in one call, in which case positional arguments must always come before named arguments:

```
{{ "now"|date('d/m/Y H:i', timezone="Europe/Paris") }}
```

## Control Flow Structure

A control structure refers to all those things that control the flow of a program - conditionals (i.e. if/elseif/else), for-loops, as well as things like blocks. Control structures appear inside {% ... %} blocks.

For example, to display a list of users provided in a variable called users, use the for tag:

```html
<h1>Members</h1>
<ul>
    {% for user in users %}
        <li>{{ user.username|e }}</li>
    {% endfor %}
</ul>

The if tag can be used to test an expression:

{% if users|length > 0 %}
    <ul>
        {% for user in users %}
            <li>{{ user.username|e }}</li>
        {% endfor %}
    </ul>
{% endif %}
```

http://twig.sensiolabs.org/doc/tags/index.html

## Comments

To comment-out part of a line in a template, use the comment syntax {# ... #}. This is useful for debugging or to add information for other template designers or yourself:

```
{# note: disabled template because we no longer use this
    {% for user in users %}
        ...
    {% endfor %}
#}
```

## Include

Includes a partial file

```
{% include 'partials/head.twig' %}

{% for box in boxes %}
    {{ include('render_box.html') }}
{% endfor %}
```

## Extends

Use extends to include the layout and then use the block headers to import the required content.

```
{% extends "master.twig" %}

{% block header %}
  {% include 'partials/header.twig' with {
    'title': artist.title
  } %}
{% endblock %}
```

## Template Inheritance

The most powerful part of Twig is template inheritance. Template inheritance allows you to build a base "skeleton" template that contains all the common elements of your site and defines blocks that child templates can override.

Sounds complicated but it is very basic. It's easier to understand it by starting with an example.

Let's define a base template, base.html, which defines a simple HTML skeleton document that you might use for a simple two-column page:

```html
<!DOCTYPE html>
<html>
    <head>
        {% block head %}
            <link rel="stylesheet" href="style.css" />
            <title>{% block title %}{% endblock %} - My Webpage</title>
        {% endblock %}
    </head>
    <body>
        <div id="content">{% block content %}{% endblock %}</div>
        <div id="footer">
            {% block footer %}
                &copy; Copyright 2011 by <a href="http://domain.invalid/">you</a>.
            {% endblock %}
        </div>
    </body>
</html>
```

In this example, the block tags define four blocks that child templates can fill in. All the block tag does is to tell the template engine that a child template may override those portions of the template.

A child template might look like this:

```html
{% extends "base.html" %}

{% block title %}Index{% endblock %}
{% block head %}
    {{ parent() }}
    <style type="text/css">
        .important { color: #336699; }
    </style>
{% endblock %}
{% block content %}
    <h1>Index</h1>
    <p class="important">
        Welcome to my awesome homepage.
    </p>
{% endblock %}
```

The extends tag is the key here. It tells the template engine that this template "extends" another template. When the template system evaluates this template, first it locates the parent. The extends tag should be the first tag in the template.

Note that since the child template doesn't define the footer block, the value from the parent template is used instead.

It's possible to render the contents of the parent block by using the parent function. This gives back the results of the parent block:

```html
{% block sidebar %}
    <h3>Table Of Contents</h3>
    ...
    {{ parent() }}
{% endblock %}
```

## Manual Escaping

Working with Manual Escaping
If manual escaping is enabled, it is your responsibility to escape variables if needed. What to escape? Any variable you don't trust.

Escaping works by piping the variable through the escape or e filter:

```
{{ user.username|e }}
```

By default, the escape filter uses the html strategy, but depending on the escaping context, you might want to explicitly use any other available strategies:

```
{{ user.username|e('js') }}
{{ user.username|e('css') }}
{{ user.username|e('url') }}
{{ user.username|e('html_attr') }}
```

Working with Automatic Escaping

Whether automatic escaping is enabled or not, you can mark a section of a template to be escaped or not by using the autoescape tag:

```
{% autoescape %}
    Everything will be automatically escaped in this block (using the HTML strategy)
{% endautoescape %}

By default, auto-escaping uses the html escaping strategy. If you output variables in other contexts, you need to explicitly escape them with the appropriate escaping strategy:

{% autoescape 'js' %}
    Everything will be automatically escaped in this block (using the JS strategy)
{% endautoescape %}
```

## Macros (add in if you think it is relevant)
