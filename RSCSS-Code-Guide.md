# RSCSS CHEAT SHEET

<!-- TOC -->

*   [RSCSS CHEAT SHEET](#rscss-cheat-sheet)
    *   [RSCSS-1: Naming Components](#rscss-1-naming-components)
    *   [RSCSS-2: Naming Elements](#rscss-2-naming-elements)
    *   [RSCSS-3: Element Selectors](#rscss-3-element-selectors)
    *   [RSCSS-4: Multiple Words](#rscss-4-multiple-words)
    *   [RSCSS-5: Avoid Tag Selectors](#rscss-5-avoid-tag-selectors)
    *   [RSCSS-6: Variants](#rscss-6-variants)
    *   [RSCSS-7: Naming Variants](#rscss-7-naming-variants)
    *   [RSCSS-8: Element Variants](#rscss-8-element-variants)
    *   [RSCSS-9: Nested Components](#rscss-9-nested-components)
    *   [RSCSS-10: Simplifying Nested Components](#rscss-10-simplifying-nested-components)
    *   [RSCSS-11: Layouts](#rscss-11-layouts)
    *   [RSCSS-12: Avoid positioning properties](#rscss-12-avoid-positioning-properties)
    *   [RSCSS-13: Fixed Dimensions](#rscss-13-fixed-dimensions)
    *   [RSCSS-14: Define Position in Parents](#rscss-14-define-position-in-parents)
    *   [RSCSS-15: Helpers](#rscss-15-helpers)
    *   [RSCSS-16: Naming Helpers](#rscss-16-naming-helpers)
    *   [RSCSS-17: Organising Helpers](#rscss-17-organising-helpers)
    *   [RSCSS-18: CSS Structure](#rscss-18-css-structure)
    *   [RSCSS-19: One Component Per File](#rscss-19-one-component-per-file)
    *   [RSCSS-20: Avoid Overnesting](#rscss-20-avoid-overnesting)
    *   [RSCSS-21: Pitfalls](#rscss-21-pitfalls)
    *   [RSCSS-22: Bleeding Through Nested Components](#rscss-22-bleeding-through-nested-components)
    *   [RSCSS-23: Apprehensions](#rscss-23-apprehensions)

<!-- /TOC -->

## RSCSS-1: Naming Components

Components will be named with at least two words, separated by a dash. Examples of components:

A like button (.like-button)
A search form (.search-form)
A news article card (.article-card)

## RSCSS-2: Naming Elements

Each component may have elements. They should have classes that are only one word.

```css
.search-form {
    > .field {
        /* ... */
    }
    > .action {
        /* ... */
    }
}
```

## RSCSS-3: Element Selectors

Prefer to use the > child selector whenever possible. This prevents bleeding through nested components, and performs better than descendant selectors.

```css
.article-card {
    .title {
        /* okay */
    }
    > .author {
        /* ✓ better */
    }
}
```

## RSCSS-4: Multiple Words

For those that need two or more words, concatenate them without dashes or underscores.

```css
.profile-box {
    > .firstname {
        /* ... */
    }
    > .lastname {
        /* ... */
    }
    > .avatar {
        /* ... */
    }
}
```

## RSCSS-5: Avoid Tag Selectors

Use classnames whenever possible. Tag selectors are fine, but they may come at a small performance penalty and may not be as descriptive.

```css
.article-card {
    > h3 {
        /* ✗ avoid */
    }
    > .name {
        /* ✓ better */
    }
}
```

## RSCSS-6: Variants

Components may have variants. Elements may have variants, too.

eg.

```css
.search-form
.search-form .-prefixed
.search-form .-compact
```

## RSCSS-7: Naming Variants

Classnames for variants will be prefixed by a dash (-).

```
.like-button {
  &.-wide { /* ... */ }
  &.-short { /* ... */ }
  &.-disabled { /* ... */ }
}
```

## RSCSS-8: Element Variants

Elements may also have variants.

```css
.shopping-card {
    > .title {
        /* ... */
    }
    > .title.-small {
        /* ... */
    }
}
```

Dash prefixes

Dashes are the preferred prefix for variants.

It prevents ambiguity with elements.
A CSS class can only start with a letter, \_ or -.
Dashes are easier to type than underscores.
It kind of resembles switches in UNIX commands (gcc -O2 -Wall -emit-last).

## RSCSS-9: Nested Components

Sometimes it's necessary to nest components. Here are some guidelines for doing that.

```html
<div class='article-link'>
  <div class='vote-box'>
    ...
  </div>
  <h3 class='title'>...</h3>
  <p class='meta'>...</p>
</div>
```

A component may need to appear a certain way when nested in another component. Avoid modifying the nested component by reaching into it from the containing component.

```css
.article-header {
    > .vote-box > .up {
        /* ✗ avoid this */
    }
}
```

Instead, prefer to add a variant to the nested component and apply it from the containing component.

```html
<div class='article-header'>
  <div class='vote-box -highlight'>
    ...
  </div>
  ...
</div>
```

```css
.vote-box {
    &.-highlight > .up {
        /* ... */
    }
}
```

## RSCSS-10: Simplifying Nested Components

Sometimes, when nesting components, your markup can get dirty:

```html
<div class='search-form'>
  <input class='input' type='text'>
  <button class='search-button -red -large'></button>
</div>
You can simplify this by using your CSS preprocessor's @extend mechanism:

<div class='search-form'>
  <input class='input' type='text'>
  <button class='submit'></button>
</div>
```

```css
.search-form {
    > .submit {
        @extend .search-button;
        @extend .search-button.-red;
        @extend .search-button.-large;
    }
}
```

---

## RSCSS-11: Layouts

```html
<div class="recipe-item">
	<div class="recipe-list">
	</div>
</div>
```

## RSCSS-12: Avoid positioning properties

Components should be made in a way that they're reusable in different contexts. Avoid putting these properties in components:

Positioning (position, top, left, right, bottom)
Floats (float, clear)
Margins (margin)
Dimensions (width, height) \*

## RSCSS-13: Fixed Dimensions

Exception to these would be elements that have fixed width/heights, such as avatars and logos.

## RSCSS-14: Define Position in Parents

If you need to define these, try to define them in whatever context they will be in. In this example below, notice that the widths and floats are applied on the list component, not the component itself.

```css
.article-list {
    & {
        @include clearfix;
    }

    > .article-card {
        width: 33.3%;
        float: left;
    }
}

.article-card {
    & {
        /* ... */
    }
    > .image {
        /* ... */
    }
    > .title {
        /* ... */
    }
    > .category {
        /* ... */
    }
}
```

---

## RSCSS-15: Helpers

For general-purpose classes meant to override values, put them in a separate file and name them beginning with an underscore. They are typically things that are tagged with !important. Use them very sparingly.

```css
._unmargin {
    margin: 0 !important;
}
._center {
    text-align: center !important;
}
._pull-left {
    float: left !important;
}
._pull-right {
    float: right !important;
}
```

## RSCSS-16: Naming Helpers

Prefix classnames with an underscore. This will make it easy to differentiate them from modifiers defined in the component. Underscores also look a bit ugly which is an intentional side effect: using too many helpers should be discouraged.

```html
<div class='order-graphs -slim _unmargin'>
</div>
```

## RSCSS-17: Organising Helpers

Place all helpers in one file called helpers. While you can separate them into multiple files, it's very preferrable to keep your number of helpers to a minimum.

---

## RSCSS-18: CSS Structure

## RSCSS-19: One Component Per File

For each component, place them in their own file.

```css
/* css/components/search-form.scss */
.search-form {
    > .button {
        /* ... */
    }
    > .field {
        /* ... */
    }
    > .label {
        /* ... */
    }

    // variants
    &.-small {
        /* ... */
    }
    &.-wide {
        /* ... */
    }
}
```

Use glob matching

In sass-rails and stylus, this makes including all of them easy:

```css
@import 'components/*';
```

## RSCSS-20: Avoid Overnesting

Use no more than 1 level of nesting. It's easy to get lost with too much nesting.

```css
/* ✗ Avoid: 3 levels of nesting */
.image-frame {
    > .description {
        /* ... */

        > .icon {
            /* ... */
        }
    }
}

/* ✓ Better: 2 levels */
.image-frame {
    > .description {
        /* ... */
    }
    > .description > .icon {
        /* ... */
    }
}
```

---

## RSCSS-21: Pitfalls

## RSCSS-22: Bleeding Through Nested Components

Be careful about nested components with elements sharing the same name as elements in its container.

```html
<article class='article-link'>
 <div class='vote-box'>
    <button class='up'></button>
    <button class='down'></button>
    <span class='count'>4</span>
  </div>

  <h3 class='title'>Article title</h3>
  <p class='count'>3 votes</p>
</article>
```

```css
.article-link {
    > .title {
        /* ... */
    }
    > .count {
        /* ... (!!!) */
    }
}

.vote-box {
    > .up {
        /* ... */
    }
    > .down {
        /* ... */
    }
    > .count {
        /* ... */
    }
}
```

In this case, if .article-link > .count did not have the > (child) selector, it will also apply to the .vote-box .count element. This is one of the reasons why child selectors are preferred.

---

## RSCSS-23: Apprehensions

Some people may have apprehensions to these conventions, such as:

"But dashes suck"

You're free to omit them and just use regular words, but keep the rest of the ideas in place (components, elements, variants).

"But I can't think of 2 words!"

Some components will only need one word to express their purpose, such as alert. In these cases, consider that using some suffixes will make it clearer that it's a block-level element:

```css
.alert-box.alert-card .alert-block Or for inlines: .link-button .link-span;
```
