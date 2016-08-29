# CSS Gradient Syntax

```css
background: linear-gradient(direction, color-stop1, color-stop2, ...);

// TOP TO BOTTOM (RED TO YELLOW)

#grad {
    background: red; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(red, yellow); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(red, yellow); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(red, yellow); /* For Firefox 3.6 to 15 */
    background: linear-gradient(red, yellow); /* Standard syntax */
}

// WITH DIRECTIONS eg. LEFT TO RIGHT

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left, red , yellow); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(right, red, yellow); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(right, red, yellow); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to right, red , yellow); /* Standard syntax */
}

// DIAGONAL

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left top, red, yellow); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(bottom right, red, yellow); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(bottom right, red, yellow); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to bottom right, red, yellow); /* Standard syntax */
}
```

### CSS Using Angles

```css
background: linear-gradient(angle, color-stop1, color-stop2);

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(-90deg, red, yellow); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(-90deg, red, yellow); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(-90deg, red, yellow); /* For Firefox 3.6 to 15 */
  background: linear-gradient(-90deg, red, yellow); /* Standard syntax */
}

// MULTIPLE COLOURS

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(red, yellow, green); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(red, yellow, green); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(red, yellow, green); /* For Firefox 3.6 to 15 */
  background: linear-gradient(red, yellow, green); /* Standard syntax */
}

// MULTIPLE COLOURS IN DIFFERENT DIRECTIONS

#grad {
  background: red; /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  background: -webkit-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* For Opera 11.1 to 12.0 */
  background: -o-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* For Fx 3.6 to 15 */
  background: -moz-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* Standard syntax */
  background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);
}

// USING TRANSPARENCY

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left,rgba(255,0,0,0),rgba(255,0,0,1)); /*Safari 5.1-6*/
  background: -o-linear-gradient(right,rgba(255,0,0,0),rgba(255,0,0,1)); /*Opera 11.1-12*/
  background: -moz-linear-gradient(right,rgba(255,0,0,0),rgba(255,0,0,1)); /*Fx 3.6-15*/
  background: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1)); /*Standard*/
}

// REPEATING A LINEAR Gradient

#grad {
  background: red; /* For browsers that do not support gradients */
  /* Safari 5.1 to 6.0 */
  background: -webkit-repeating-linear-gradient(red, yellow 10%, green 20%);
  /* Opera 11.1 to 12.0 */
  background: -o-repeating-linear-gradient(red, yellow 10%, green 20%);
  /* Firefox 3.6 to 15 */
  background: -moz-repeating-linear-gradient(red, yellow 10%, green 20%);
  /* Standard syntax */
  background: repeating-linear-gradient(red, yellow 10%, green 20%);
}
```

### CSS Radial Gradients

```css
background: radial-gradient(shape size at position, start-color, ..., last-color);

// EVENLY COLOURED SPACING

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-radial-gradient(red, yellow, green); /* Safari 5.1 to 6.0 */
  background: -o-radial-gradient(red, yellow, green); /* For Opera 11.6 to 12.0 */
  background: -moz-radial-gradient(red, yellow, green); /* For Firefox 3.6 to 15 */
  background: radial-gradient(red, yellow, green); /* Standard syntax */
}

// DIFFERENT SPACING

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-radial-gradient(red 5%, yellow 15%, green 60%); /* Safari 5.1-6.0 */
  background: -o-radial-gradient(red 5%, yellow 15%, green 60%); /* For Opera 11.6-12.0 */
  background: -moz-radial-gradient(red 5%, yellow 15%, green 60%); /* For Firefox 3.6-15 */
  background: radial-gradient(red 5%, yellow 15%, green 60%); /* Standard syntax */
}

// SET SHAPE

#grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-radial-gradient(circle, red, yellow, green); /* Safari */
  background: -o-radial-gradient(circle, red, yellow, green); /* Opera 11.6 to 12.0 */
  background: -moz-radial-gradient(circle, red, yellow, green); /* Firefox 3.6 to 15 */
  background: radial-gradient(circle, red, yellow, green); /* Standard syntax */
}

// USING DIFFERENT SIZE KEYWORDS

#grad1 {
  background: red; /* For browsers that do not support gradients */
  /* Safari 5.1 to 6.0 */
  background: -webkit-radial-gradient(60% 55%, closest-side, red, yellow, black);
  /* For Opera 11.6 to 12.0 */
  background: -o-radial-gradient(60% 55%, closest-side, red, yellow, black);
  /* For Firefox 3.6 to 15 */
  background: -moz-radial-gradient(60% 55%, closest-side, red, yellow, black);
  /* Standard syntax */
  background: radial-gradient(closest-side at 60% 55%, red, yellow, black);
}

#grad2 {
  /* Safari 5.1 to 6.0 */
  background: -webkit-radial-gradient(60% 55%, farthest-side, red, yellow, black);
  /* Opera 11.6 to 12.0 */
  background: -o-radial-gradient(60% 55%, farthest-side, red, yellow, black);
  /* For Firefox 3.6 to 15 */
  background: -moz-radial-gradient(60% 55%, farthest-side, red, yellow, black);
  /* Standard syntax */
  background: radial-gradient(farthest-side at 60% 55%, red, yellow, black);
}

// REPEATING COLOUR GRADIENTS

#grad {
  background: red; /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  background: -webkit-repeating-radial-gradient(red, yellow 10%, green 15%);
  /* For Opera 11.6 to 12.0 */
  background: -o-repeating-radial-gradient(red, yellow 10%, green 15%);
  /* For Firefox 3.6 to 15 */
  background: -moz-repeating-radial-gradient(red, yellow 10%, green 15%);
  /* Standard syntax */
  background: repeating-radial-gradient(red, yellow 10%, green 15%);
}
```
