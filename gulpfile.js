var gulp = require('gulp');
// Requires the gulp-sass plugin
var sass = require('gulp-sass');

// Tasks below this line

gulp.task('hello', function() {
    console.log('Hello Zell');
  });


gulp.task('sass', function(){
    return gulp.src('app/assets/css/*.scss')
      .pipe(sass()) // Using gulp-sass
      .pipe(gulp.dest('dist/assets/css'));
  });