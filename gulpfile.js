//gulpfile.js
const gulp = require('gulp'),
    minifyCSS = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require("gulp-rename"),
    sass = require('gulp-sass'),
    npmDist = require('gulp-npm-dist'),
    browserSync = require('browser-sync').create();

const sassFiles = 'ui/public/scss/*.scss',
    cssDest = 'ui/public/css/';

//compile scss into css
function style() {
    //1. Where is my scss
    return gulp.src(sassFiles)
    //2.pass through compiler
        .pipe(sass().on('error', sass.logError))
        //3.wher to save css
        .pipe(gulp.dest(cssDest))
}
//This is for the minify css
function minifycss() {
    return gulp.src(['ui/public/css/*.css', '!ui/public/css/**/*.min.css'])
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest(cssDest))
}


function watch() {
    gulp.watch(['ui/public/scss/**/*.scss'], style);
    gulp.watch(['ui/public/css/style.css'], minifycss);
}

gulp.task('default', watch);

exports.style = style;
exports.minifycss = minifycss;
exports.watch = watch;
