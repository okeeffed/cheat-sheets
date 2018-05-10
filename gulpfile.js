var gutil = require('gulp-util');
var fs = require('fs');
var gulp = require('gulp');
var spawn = require('child_process').spawn;
var git = require('gulp-git');
var runSequence = require('run-sequence');
require('dotenv').load();

gulp.task("watch", function () {
    gulp
        .watch([
            // "*.md",
            "Business/*.md",
            ".env"
        ])
        .on("change", function (file) {
            var list = file
                .path
                .split('/');
            fileName = list[list.length - 1];

            var prefix = "";
            var suffix = "";

            if (process.env.TASK) {
                prefix = process.env.TASK + " - ";
            }

            if (process.env.DESCRIPTION) {
                suffix = ": " + process.env.DESCRIPTION;
            }

            var gitChange = prefix + fileName + suffix;

            gutil.log(gitChange + " changed");

            var gitAdd = spawn('./gitcommit.sh', [gitChange]);
            gitAdd
                .stdout
                .on('data', function (data) {
                    gutil.log('gitcommit: ', data.toString().slice(0, -1)); // Remove \n
                });
            // runSequence('push');
        });
});
