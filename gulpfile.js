/**
 * Created by ken on 09/08/2017.
 */

var gulp         = require("gulp"),
    sass         = require("gulp-sass"),
    autoprefixer = require('gulp-autoprefixer'),
    uglify       = require('gulp-uglify'),
    minifycss    = require('gulp-minify-css'),
    sourcemaps   = require('gulp-sourcemaps'),
    rename       = require('gulp-rename'),
    notify       = require('gulp-notify'),
    plumber      = require('gulp-plumber'),
    path         = require('path');

var cssFiles = [
        'assets/css/style.css',
        'assets/css/admin.css'
    ],
    cssDestDir = 'assets/css';

var sass_input = 'assets/cachu/*.{scss,sass}',
    sass_watch = ['assets/cachu/*.{scss,sass}', 'assets/cachu/*/*.{scss,sass}', 'assets/cachu/*/*/*.{scss,sass}'],
    sass_output = 'assets/css',
    sass_options = {
        errLogToConsole: true,
        outputStyle: 'expanded'
};

var js_src = 'assets/js/*.js',
    js_dist = 'assets/js/dist';


//the title and icon that will be used for the Grunt notifications
var notifyInfo = {
    title: 'Gulp',
    icon: path.join(__dirname, 'gulp.png')
};

//error notification settings for plumber
var plumberErrorHandler = { errorHandler: notify.onError({
    title: notifyInfo.title,
    icon: notifyInfo.icon,
    message: "Error: <%= error.message %>"
})
};

gulp.task("styles", function() {
    return gulp.src(cssFiles)
        .pipe(plumber(plumberErrorHandler))
        .pipe(autoprefixer({
            browsers: ['last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'Firefox <= 20', 'opera 12.1', 'ios 6', 'android 4'],
            cascade: false
        }))
        .pipe(gulp.dest(cssDestDir))
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss())
        .pipe(gulp.dest(cssDestDir));
});


gulp.task("sass", function () {
    return gulp.src(sass_input)
        .pipe(sass(sass_options).on("error", sass.logError))
        .pipe(gulp.dest(sass_output));
});


gulp.task('js', function() {
    gulp.src(js_src)
        .pipe(sourcemaps.init())
        .pipe(gulp.dest(js_dist))
        .pipe(uglify({
            mangle: true,
            preserveComments: 'license',
            compress: {
                sequences: true,
                dead_code: true,
                conditionals: true,
                booleans: true,
                unused: true,
                if_return: true,
                join_vars: true,
                drop_console: true
            }
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(js_dist));
});

gulp.task("watch", ["styles", "sass", "js"], function() {
    gulp.watch(cssFiles, ["styles"]);
    gulp.watch(sass_watch, ["sass"]);
    gulp.watch(js_src, ["js"]);
});