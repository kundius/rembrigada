const gulp = require('gulp')
const babel = require('gulp-babel')
const sourcemaps = require('gulp-sourcemaps')
const sass = require('gulp-sass')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const imagemin = require('gulp-imagemin')

const config = {
    srcDir: './src/',
    stylePattern: './src/**/*.+(scss|sass|css)',
    jsPattern: './src/**/*.js'
}

function fontsTask() {
  return gulp.src([
    config.srcDir + 'fonts/**/*'
  ])
    .pipe(gulp.dest('dist/fonts'))
}

function imagesTask() {
  return gulp.src([
    config.srcDir + 'img/**/*'
  ])
    .pipe(gulp.dest('dist/img'))
}

function sassTask() {
  return gulp.src([
    config.srcDir + 'scss/styles.scss'
  ])
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(concat('all.css'))
    .pipe(postcss([ autoprefixer(), cssnano() ]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/css'))
}

function jsTask(){
  return gulp.src([
    './node_modules/lory.js/dist/lory.min.js',
    // './node_modules/jquery-migrate/dist/jquery-migrate.min.js',
    // './node_modules/uikit/dist/js/uikit.min.js',
    // './node_modules/uikit/dist/js/components/sticky.min.js',
    // './node_modules/uikit/dist/js/components/notify.min.js',
    // // './node_modules/uikit/dist/js/components/tooltip.min.js',
    // // './node_modules/uikit/dist/js/components/slider.min.js',
    // './node_modules/slick-carousel/slick/slick.min.js',
    // './node_modules/choices.js/public/assets/scripts/choices.min.js',
    // './node_modules/jquery-lazy/jquery.lazy.min.js',
    // './node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
    // './node_modules/jquery-form/dist/jquery.form.min.js',
    // './node_modules/jquery-validation/dist/jquery.validate.min.js',
    // './node_modules/jquery-validation/dist/localization/messages_ru.min.js',
    // './node_modules/jquery.cookie/jquery.cookie.js',
    // config.srcDir + 'js/flexmenu.min.js',
    // config.srcDir + 'js/mobilemenu.js',
    config.srcDir + 'js/main.js'
  ])
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/js'))
}

function watchTask(){
  gulp.watch(
    [config.stylePattern, config.jsPattern],
    gulp.parallel(sassTask, jsTask)
  )
}

exports.default = gulp.series(gulp.parallel(imagesTask, fontsTask, sassTask, jsTask), watchTask)
