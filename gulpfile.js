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
    './node_modules/tiny-slider/dist/min/tiny-slider.js',
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
