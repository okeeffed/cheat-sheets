# JavaScript Grid Alignment Cheat Sheet

```javascript
/*
	This example comes from the NPWS grid system
*/

var grid = {

	row: [],
	perRow: 0,
	height: 0,
	small: 767,
	medium: 1190,

	$grid: $('.grid'),
	$tile: $('.grid .tile'),

	init: function () {
		grid.resize();

		$(window).resize(grid.resize);
	},

	resize: function () {
		if ($(window).outerWidth() < grid.small) {
			grid.$tile.find('.info').height('auto');
		} else {
			grid.$tile.each(function (key) {
				if ((key) % grid.elemPerRow + 1 === 1 && (key !== 0)) {
					grid.setHeight();
					grid.height = 0;
					grid.row = [];
				}

				grid.row.push(this);

				if ($(this).find('.info').height() > grid.height) {
					grid.height = $(this).find('.info').height();
				}
			});

			if (grid.row.length) {
				grid.setHeight();
			}
		}
	},

	setHeight: function () {
		for (var i in grid.row) {
			$(grid.row[i]).find('.info').height(grid.height);
		}
	},

	getElemPerRow: function () {
		if ($(window).outerWidth() > grid.medium) {
			grid.elemPerRow = 3;
		} else if ($(window).outerWidth() > grid.small) {
			grid.elemPerRow = 2;
		} else {
			grid.elemPerRow = 1;
		}
	},
};
```
