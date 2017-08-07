var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;
var sass        = require('gulp-sass');
var source      = require('vinyl-source-stream');
var browserify  = require('browserify');
var jshint      = require('gulp-jshint');
var uglify      = require('gulp-uglify');
var rename      = require('gulp-rename');
var cssnano     = require('gulp-cssnano');
// var buffer   = require('vinyl-buffer'); // .pipe(buffer()) use buffer if you want to uglify JS on browserify on fly event
var watch = require('gulp-watch');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var autoprefixer = require('gulp-autoprefixer');
var babelify = require('babelify');

var config = {
    sass: {
        source: './asset_sources/sass/style.scss',
        dist: './assets/css',
        fileName: 'style.css',
        minifiedFileName: 'style.min.css',
        watch: './asset_sources/sass/**/*.scss'
    },
    js: {
        source: './asset_sources/js/app.js',
        dist: './assets/js',
        fileName: 'app.js',
        minifiedFileName: 'app.min.js',
        watch: './asset_sources/js/**/*.js'
    },
    image: {
        source: './asset_sources/images/*',
        dist: './assets/images'
    },
    sync: {
        server: true
    }
};
// https://www.browsersync.io/docs/options/


// sass to css
gulp.task('sass', function () {
    gulp.src(config.sass.source)
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest(config.sass.dist))
        .pipe(browserSync.stream());
});

// browserify
gulp.task('browserify', function() {
    return browserify({ entries: [config.js.source] })
        .transform(babelify, {presets: ["es2015"]})
        .bundle()
        .pipe(source(config.js.fileName))
        .pipe(gulp.dest(config.js.dist))
        .pipe(browserSync.stream());
});

// jslint
gulp.task('lint', function() {
    return gulp.src(config.js.watch)
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'));
});

// image min
gulp.task('imagemin', function() {
    return gulp.src(config.image.source)
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest(config.image.dist));
});

// default task adn watch
gulp.task('serve', ['sass', 'browserify'], function() {
    browserSync.init(config.sync);

    watch(config.sass.watch, function(){
        gulp.start('sass');
    });
    watch(config.js.watch, function(){
        gulp.start('browserify');
    });
    watch(['./*.html', './**/*.php'], function(){
        reload();
    });
    // watch(config.image.source, function(){
    //     gulp.start('imagemin');
    //     reload();
    // });
});

// default task
gulp.task('default', ['serve']);

// gulp build and minify things
gulp.task('build', ['sass', 'browserify'], function(){
    gulp.src(config.js.dist + '/' + config.js.fileName)
        .pipe(uglify())
        .pipe(rename(config.js.minifiedFileName))
        .pipe(gulp.dest(config.js.dist));

    gulp.src(config.sass.dist + '/' + config.sass.fileName)
        .pipe(cssnano())
        .pipe(rename(config.sass.minifiedFileName))
        .pipe(gulp.dest(config.sass.dist));
});
