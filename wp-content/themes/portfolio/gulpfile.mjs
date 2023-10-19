// Required packages for Gulp tasks
import gulp from 'gulp';
import sassModule from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import imagemin from 'gulp-imagemin';
import imageResize from 'gulp-image-resize';
import * as sassImplementation from 'sass';
import fileSync from 'gulp-file-sync';
import postcss from 'gulp-postcss';
import cleanCSS from 'gulp-clean-css';
import include from 'gulp-include';

// Setting up the Sass compiler with the Node Sass implementation
const sass = sassModule(sassImplementation);

// Common configurations for compiling Sass files
const sassOptions = {
  outputStyle: 'compressed', // Compressed output for smaller file size
  includePaths: ['./node_modules', './src/scss'], // Directories to look for Sass imports
};

// Utility function to compile Sass files
// This accepts source path, destination path, and optional path modification function
function compileSass(src, dest, modifyPath = null) {
  let pipeline = gulp
    .src(src)
    .pipe(sourcemaps.init()) // Initializes sourcemap generation for debugging
    .pipe(sass(sassOptions).on('error', sass.logError)) // Compile Sass files
    .pipe(postcss([autoprefixer()])) // Auto-prefix CSS properties for browser compatibility
    .pipe(rename({ suffix: '.min' })); // Add a .min suffix to the output filename

  // If a path modification function is provided, use it
  if (modifyPath) {
    pipeline = pipeline.pipe(rename(modifyPath));
  }

  // Finalize the compilation process
  return pipeline.pipe(sourcemaps.write('.')).pipe(gulp.dest(dest));
}

// Utility function to compile JavaScript files
// Similar structure to the compileSass function
function compileJs(src, dest, modifyPath = null) {
  let pipeline = gulp
    .src(src)
    .pipe(sourcemaps.init()) // Initializes sourcemap generation for debugging
    .pipe(include()) // Allows for including other JS files into the current file
    .pipe(uglify()) // Minifies the JavaScript
    .pipe(rename({ suffix: '.min' })); // Add a .min suffix to the output filename

  if (modifyPath) {
    pipeline = pipeline.pipe(rename(modifyPath));
  }

  return pipeline.pipe(sourcemaps.write('.')).pipe(gulp.dest(dest));
}

/* Tasks
-------------------------------------------------------------- */

// Task to compile Sass files for theme blocks
gulp.task('blockSass', () => {
  return compileSass('theme-blocks/**/src/block.scss', './theme-blocks', (path) => {
    path.dirname = path.dirname.replace('src', 'dist'); // Modifying directory path
    path.basename = 'block.min'; // Setting the output filename
  });
});

// Task to compile JS files for theme blocks
gulp.task('blockJs', () => {
  return compileJs('theme-blocks/**/src/block.js', './theme-blocks', (path) => {
    path.dirname = path.dirname.replace('src', 'dist');
    path.basename = 'block.min';
  });
});

// Task to compile Sass for the admin section
gulp.task('adminSass', () => compileSass('admin/src/admin-styles.scss', 'admin/dist'));

// Task to compile JS for the admin section
gulp.task('adminJs', () => compileJs('admin/src/admin-scripts.js', 'admin/dist'));

// Task to compile the main theme's Sass
gulp.task('themeSass', () => compileSass('src/scss/main.scss', 'dist'));

// Task to compile the main theme's JavaScript
gulp.task('themeJs', () => compileJs('src/js/**/*.js', 'dist'));

// Task to sync image folders without optimization
gulp.task('imgSync', function (done) {
  fileSync('src/assets/media/images', 'src/assets/media/images-opt', { recursive: false });
  done();
});

// Task to optimize and resize images
gulp.task('imgOpt', () => {
  return gulp
    .src('src/assets/media/images/*.{jpg,jpeg,png,gif}')
    .pipe(imagemin()) // Reduces image file sizes
    .pipe(
      imageResize({
        width: 1400, // Max width set to 1400px
        height: null, // Height remains auto to maintain aspect ratio
        crop: false, // Avoid cropping the image
        upscale: false, // Don't upscale smaller images
      })
    )
    .pipe(gulp.dest('src/assets/media/images-opt')); // Set the output directory
});

// Combined task for syncing and optimizing images
gulp.task('imgSyncAndOpt', gulp.series('imgSync', 'imgOpt'));

/* Gulp watch - Watch task that listens to file changes and triggers the appropriate tasks
-------------------------------------------------------------- */
gulp.task('watch', () => {
  // Watch Sass and JS files and trigger their respective compilation tasks
  gulp.watch('admin/src/**/*.scss', gulp.series('adminSass'));
  gulp.watch('src/scss/**/*.scss', gulp.series('themeSass'));
  gulp.watch('theme-blocks/**/src/block.scss', gulp.series('blockSass'));
  gulp.watch('admin/src/**/*.js', gulp.series('adminJs'));
  gulp.watch('src/js/**/*.js', gulp.series('themeJs'));
  gulp.watch('theme-blocks/**/src/block.js', gulp.series('blockJs'));

  // Watch image changes to sync and optimize them
  gulp.watch('src/assets/media/images/*.{jpg,jpeg,png,gif}', gulp.series('imgSyncAndOpt'));
});
