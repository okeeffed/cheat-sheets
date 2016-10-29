# CSS Style Guide

## Table of Contents

<a href="#ordering">Ordering</a>
<a href="#structure">Structure</a>


<div id="ordering"></div>

***

## CSS Ordering

```css
.selector {
  /* Positioning */
  position: absolute;
  z-index: 10;
  top: 0;
  right: 0;

  /* Display & Box Model */
  display: inline-block;
  overflow: hidden;
  box-sizing: border-box;
  width: 100px;
  height: 100px;
  padding: 10px;
  border: 10px solid #333;
  margin: 10px;

  /* Color */
  background: #000;
  color: #fff
  
  /* Text */
  font-family: sans-serif;
  font-size: 16px;
  line-height: 1.4;
  text-align: right;

  /* Other */
  cursor: pointer;
}
```

<div id="structure"></div>

***

## CSS Structure 

<div id="newSection"></div>

### ---- One Component per file

For each component, place them in their own file.

```css
/* css/components/search-form.scss */
.search-form {
  > .button { /* ... */ }
  > .field { /* ... */ }
  > .label { /* ... */ }

  // variants
  &.-small { /* ... */ }
  &.-wide { /* ... */ }
}
```

<div id="newSection"></div>

### ---- Nesting

Use no more than 1 level of nesting. It's easy to get lost with too much nesting.

```
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
  > .description { /* ... */ }
  > .description > .icon { /* ... */ }
}
```