var gulp  = require('gulp'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  cleanCss = require('gulp-clean-css'),
  rename = require('gulp-rename'),
  postcss      = require('gulp-postcss'),
  autoprefixer = require('autoprefixer'),
  browserSync = require('browser-sync').create();

gulp.task('build-template', function() {
  return gulp.src(['resources/scss/maileclipse-app.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([ autoprefixer({ browsers: [
      'Chrome >= 35',
      'Firefox >= 38',
      'Edge >= 12',
      'Explorer >= 10',
      'iOS >= 8',
      'Safari >= 8',
      'Android 2.3',
      'Android >= 4',
      'Opera >= 12']})]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('public/css/'))
    .pipe(cleanCss())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/css/'))
});

/*gulp.task('watch', ['build-theme'], function() {

  browserSync.init({
        proxy: "http://localhost:5000/"
    });

  gulp.watch(['scss/*.scss', '*.html'], ['build-theme']).on('change', function(){
    browserSync.reload();
  });

});*/

gulp.task('default', ['build-template'], function() {
});



