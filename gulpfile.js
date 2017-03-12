var gutil 		= require('gulp-util');
var fs 			= require('fs');
var gulp 		= require('gulp');
var spawn 		= require('child_process').spawn;

require('dotenv').load();

gulp.task( "watch", function() {
	gulp.watch([
		"*.md",
		"**/*.md"
	]).on( "change", function( file ) {
		var list = file.path.split('/');
		fileName = list[list.length-1];

		var prefix = "";
		if (process.env.TASK) {
			prefix = process.env.TASK + " - ";
		}
		var gitChange = prefix + fileName;

		gutil.log(gitChange + " changed");
		// task = 'git commit -m "' + gitChange + '"';

		var gitAdd = spawn('./gitcommit.sh', [fileName]);
		gitAdd.stdout.on('data', function (data) {
			gutil.log('gitcommit: ', data.toString().slice(0, -1)); // Remove \n
		});
	});
});