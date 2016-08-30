# Flexbox Help Sheet

Sources:

[CSS Tricks](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)

## Terminology

#### Flex Container (parent)

Properties of the parent:

```css
.container {
  display: flex; /* or inline-flex */
  flex-direction: row | row-reverse | column | column-reverse;
  flex-wrap: nowrap | wrap | wrap-reverse;
  flex-flow: <‘flex-direction’> || <‘flex-wrap’>; //shorthand code
  justify-content: flex-start | flex-end | center | space-between | space-around;
  align-items: flex-start | flex-end | center | baseline | stretch;
  align-content: flex-start | flex-end | center | space-between | space-around | stretch;
}
```

#### Flex Items (child)

Properties of the child:

```css
.item {
	order: <integer>;
	flex-grow: <number>; /* default 0 */
	flex-shrink: <number>; /* default 1 */
	flex-basis: <length> | auto; /* default auto */
	flex: none | [ <'flex-grow'> <'flex-shrink'>? || <'flex-basis'> ];
	align-self: auto | flex-start | flex-end | center | baseline | stretch;
}
```

## Example

```css
.parent {
  display: flex;
  height: 300px; /* Or whatever */
}

.child {
  width: 100px;  /* Or whatever */
  height: 100px; /* Or whatever */
  margin: auto;  /* Magic! */
}

.flex-container {
  /* We first create a flex layout context */
  display: flex;

  /* Then we define the flow direction and if we allow the items to wrap
   * Remember this is the same as:
   * flex-direction: row;
   * flex-wrap: wrap;
   */
  flex-flow: row wrap;

  /* Then we define how is distributed the remaining space */
  justify-content: space-around;
}
```
