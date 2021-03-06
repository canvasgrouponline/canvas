/**
 * Gulp WordPress Toolkit.
 * @author Jobayer Arman (@jobayerarman)
 */

/**
 * Configuration.
 *
 * Project Configuration for gulp tasks.
 *
 * In paths you can add <<glob or array of globs>>. Edit the variables as per your project requirements.
 */

// START Editing Project Variables.
// Project related.
var project              = 'canvas';                                  // Project Name
var projectURL           = 'http://canvasonline.dev';                 // Project URL
var productURL           = './';                                      // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder
var build                = './buildTheme/';                           // Files that you want to package into a zip go here
var buildInclude  = [
  // include common file types
  '**/*.php',
  '**/*.html',
  '**/*.css',
  '**/*.js',
  '**/*.jpg',
  '**/*.png',
  '**/*.svg',
  '**/*.ttf',
  '**/*.otf',
  '**/*.eot',
  '**/*.woff',
  '**/*.woff2',

  // include specific files and folders
  'screenshot.png',

  // exclude files and folders
  '!node_modules/**/*',
  '!vendor/**/*',
  '!files/**/*',
  '!style.css.map',
  '!gulpfile.js',
  '!src/*'
];

// Translation related.
var text_domain          = 'canvas';                                    // Your textdomain here
var destFile             = 'canvas.pot';                                // Name of the transalation file
var packageName          = 'canvas';                                    // Package name
var bugReport            = 'http://jobayerarman.github.io/';            // Where can users report bugs
var lastTranslator       = 'Jobayer Arman <jobayer.arman@gmail.com>';   // Last translator Email ID
var team                 = 'Jobayer Arman <jobayer.arman@email.com>';   // Team's Email ID
var translatePath        = './languages'                                // Where to save the translation files

// Style related
var style = {
  src    : './src/styles/main.scss',                       // Path to main .scss file
  dest   : './assets/styles/',                             // Path to place the compiled CSS file
  destFiles  : './assets/styles/*.+(css|map)'              // Destination files
};

// JavaScript related
var script = {
  user: {
    src    : './src/scripts/user/*.js',                      // Path to user JS scripts folder
    dest   : './assets/scripts/',                            // Path to place the compiled scripts file
    file   : 'script.js',                                    // Compiled JS file name
    destFiles   : './assets/scripts/*.js'                    // Destination files
  },
  vendor: {
    src    : ['./src/scripts/vendor/*.js',
      './node_modules/popper.js/dist/umd/popper.js',
      './node_modules/bootstrap/dist/js/bootstrap.js'],        // Path to vendor JS scripts folder
    dest   : './assets/scripts/',                            // Path to place the compiled scripts file
    file   : 'vendor.js',                                    // Compiled JS file name
    destFiles   : './assets/scripts/*.js'                    // Destination files
  }
}

// Images related.
var image = {
  src    : './src/img/**/*.{png,jpg,gif,svg}',             // Source folder of images which should be optimized
  dest   : './assets/img/'                                 // Destination folder of optimized images
}

// Watch files paths.
var watch = {
  style  : './src/styles/**/*.scss',                       // Path to all *.scss files
  script : './src/scripts/**/*.js',                        // Path to all custom JS files
  php    : './**/*.php'                                    // Path to all PHP files
}

// Browsers you care about for autoprefixing.
// Browserlist https://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
  'last 2 versions',
  'ie 8',
  'ie 9',
  'android 4',
  'opera 12'
];
// STOP Editing Project Variables.

/**
 * Load Plugins.
 *
 * Load gulp plugins and assing them semantic names.
 */
var gulp         = require('gulp');                  // Gulp of-course
var gutil        = require('gulp-util');             // Utility functions for gulp plugins

// CSS related plugins.
var sass         = require('gulp-sass');             // Gulp plugin for Sass compilation.
var cleancss     = require('gulp-clean-css');        // Minifies CSS files.
var autoprefixer = require('gulp-autoprefixer');     // Autoprefixing magic.
var sourcemaps   = require('gulp-sourcemaps');       // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file.

// JS related plugins.
var eslint       = require('gulp-eslint');           // ESlint plugin for gulp
var concat       = require('gulp-concat');           // Concatenates JS files
var uglify       = require('gulp-uglify');           // Minifies JS files
var merge        = require('merge-stream');          // Merge (interleave) a bunch of streams

// Image realted plugins.
var imagemin     = require('gulp-imagemin');         // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Github related plugins
var fs           = require('fs');
var git          = require('gulp-git');
var bump         = require('gulp-bump');
var shell        = require('gulp-shell');
var prompt       = require('gulp-prompt');
var replace      = require('gulp-replace');
var gitChangelog = require('gulp-conventional-changelog');

// Utility plugins.
var browserSync  = require('browser-sync').create(); // Reloads browser and injects CSS. Time-saving synchronised browser testing.
var cache        = require('gulp-cache');
var del          = require('del');                   // Delete files and folders
var filter       = require('gulp-filter');           // Helps work on a subset of the original files by filtering them using globbing.
var gulpSequence = require('gulp-sequence');         // Run a series of gulp tasks in order
var gulpif       = require('gulp-if');               // A ternary gulp plugin: conditionally control the flow of vinyl objects.
var ignore       = require('gulp-ignore');           // Helps with ignoring files and directories in our run tasks
var lazypipe     = require('lazypipe');              // Lazypipe allows to create an immutable, lazily-initialized pipeline.
var notify       = require('gulp-notify');           // Sends message notification to you
var plumber      = require('gulp-plumber');          // Prevent pipe breaking caused by errors from gulp plugins
var reload       = browserSync.reload;               // For manual browser reload.
var rename       = require('gulp-rename');           // Renames files E.g. style.css -> style.min.css
var size         = require('gulp-size');             // Logs out the total size of files in the stream and optionally the individual file-sizes
var sort         = require('gulp-sort');             // Recommended to prevent unnecessary changes in pot-file.
var wpPot        = require('gulp-wp-pot');           // For generating the .pot file.
var zip          = require('gulp-zip');              // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
var phpcs        = require('gulp-phpcs');

// production variable
var config = {
  production: !!gutil.env.production,                // Two exclamations turn undefined into a proper false.
  sourceMaps:  !gutil.env.production
};

/**
 * Notify Errors
 */
function errorLog(error) {
  // Inspect the error object
  // console.log(error);

  // Pretty error reporting
  var report = '';
  var chalk = gutil.colors.white.bgRed;

  report += '\n';
  report += chalk('TASK:') + ' [' + error.plugin + ']\n';
  report += chalk('PROB:') + ' ' + error.message + '\n';
  if (error.lineNumber) { report += chalk('LINE:') + ' ' + error.lineNumber + '\n'; }
  if (error.column)     { report += chalk('COL:')  + ' ' + error.column     + '\n'; }
  if (error.fileName)   { report += chalk('FILE:') + ' ' + error.fileName   + '\n'; }
  console.error(report);

  this.emit('end');
};

/**
 * Theme Dev Setup
 *
 * Task:
 */
gulp.task('update-function-name', function() {
  return gulp.src([ './**/*.php' ])
    .pipe(replace( '', 'canvas' ))
    .pipe(gulp.dest( './' ));
});
gulp.task('update-package-name', function() {
  return gulp.src([ './**/*.php' ])
    .pipe(replace( /(@package)(\s*)(.*)/, '$1$2' +project ))
    .pipe(gulp.dest( './' ));
});
gulp.task('update:all-name', gulpSequence('update-function-name', 'update-package-name'));

/**
 * Github release workflow
 *
 * Task: bump version
 */
function getPackageJsonVersion() {
  return JSON.parse(fs.readFileSync('./package.json', 'utf8')).version;
}
gulp.task('bump-version', function() {
  return gulp.src(['./package.json'])
    .pipe(bump({type: 'patch'}).on('error', gutil.log))
    .pipe(gulp.dest('./'));
});
gulp.task('update-wp-style-css', function() {
  return gulp.src(['./style.css'])
    .pipe(replace( /(Version:)(\s*)(.*)/, '$1$2' + getPackageJsonVersion() ))
    .pipe(gulp.dest('./'));
});
gulp.task('bump:all', gulpSequence('bump-version', 'update-wp-style-css'));

/**
 * Task: Cleanup
 *
 * Cleans destination files
 */
gulp.task('clean:css', function() {
  return del([style.destFiles]);
});
gulp.task('clean:js', function() {
  return del([script.user.destFiles]);
});
gulp.task('clean:build', function() {
  return del(build);
});
gulp.task('clean:all', gulpSequence('clean:css', 'clean:js', 'clean:build'));

/**
 *
 * Check the code with PHP_CodeSniffer against the WordPress Coding Standards.
 *
 */
gulp.task('lint:phpcs', function() {
  return gulp.src([watch.php, '!vendor/**/*', '!node_modules/**/*'])
    .pipe(plumber({errorHandler: errorLog}))
    .pipe(phpcs({
      bin: 'vendor/bin/phpcs',
      standard: 'phpcs.xml',
      warningSeverity: 0
    }))
    .pipe(phpcs.reporter('log'));
});

/**
 * Task: `browser-sync`.
 */
gulp.task('browser-sync', function() {
  browserSync.init( {

    // Project URL.
    proxy: projectURL,

    // Will not attempt to determine your network status, assumes you're ONLINE
    online: true,

    // `true` Automatically open the browser with BrowserSync live server.
    // `false` Stop the browser from automatically opening.
    open: false,

    // Inject CSS changes.
    // Commnet it to reload browser for every CSS change.
    injectChanges: true,

    // The small pop-over notifications in the browser are not always needed/wanted
    notify: false,

    // Log connections
    logConnections: true,
  });
});

/**
 * Task: `styles`.
 *
 * Compiles SCSS, Autoprefixes it and Minifies CSS.
 *
 */
var minifyCss = lazypipe()
  .pipe(cleancss, {keepSpecialComments: false});

gulp.task('build:styles', ['clean:css'], function() {
  return gulp.src(style.src)
    .pipe(plumber({errorHandler: errorLog}))
    .pipe(gulpif(config.sourceMaps, sourcemaps.init()))

    .pipe(sass().on('error', sass.logError))

    .pipe(autoprefixer(AUTOPREFIXER_BROWSERS))
    .pipe(gulpif(config.sourceMaps, sourcemaps.write('.')))

    .pipe(gulpif(config.production, minifyCss()))
    .pipe(gulp.dest(style.dest))

    .pipe(filter('**/*.css'))
    .pipe(browserSync.stream())
    .pipe(size({showFiles: true}));
});

/**
  * Task: `scripts`.
  *
  * Concatenate and uglify vendor and user scripts.
  *
  */
gulp.task('build:scripts', ['clean:js'], function() {
  var minifyScripts = lazypipe().pipe(uglify);

  var vendorJs = gulp.src(script.vendor.src)
    .pipe(plumber({errorHandler: errorLog}))

    .pipe(concat(script.vendor.file))
    .pipe(minifyScripts())

    .pipe(gulp.dest(script.vendor.dest))
    .pipe(size({showFiles: true}));

  var appJs =  gulp.src(script.user.src)
    .pipe(plumber({errorHandler: errorLog}))
    .pipe(eslint())
    .pipe(eslint.format())

    .pipe(concat(script.user.file))
    .pipe(gulpif(config.production, minifyScripts()))

    .pipe(gulp.dest(script.user.dest))
    .pipe(size({showFiles: true}));;

  return merge(vendorJs, appJs);
});

/**
  * Task: `images`.
  *
  * Minifies PNG, JPEG, GIF and SVG images.
  *
  */
gulp.task('images', function() {
  gulp.src(image.src)
    .pipe(imagemin({
      interlaced: true,
      progressive: true,
      optimizationLevel: 5, // 0-7 low-high
      svgoPlugins: [{removeViewBox: false}]
    }))
    .pipe(gulp.dest(image.dest));
});

/**
  * WP POT Translation File Generator.
  *
  * * This task does the following:
  *     1. Gets the source of all the PHP files
  *     2. Sort files in stream by path or any custom sort comparator
  *     3. Applies wpPot with the variable set at the top of this file
  *     4. Generate a .pot file of i18n that can be used for l10n to build .mo file
  */
gulp.task('translate', function() {
  return gulp.src( projectPHPWatchFiles )
    .pipe(sort())
    .pipe(wpPot({
      domain         : text_domain,
      destFile       : destFile,
      package        : packageName,
      bugReport      : bugReport,
      lastTranslator : lastTranslator,
      team           : team
    }))
    .pipe( gulp.dest(translatePath));
});

/**
 * Clean gulp cache
 */
gulp.task('clear', function () {
  cache.clearAll();
});

/**
  * Build task that moves essential theme files for production-ready sites
  *
  * buildFiles copies all the files in buildInclude to build folder - check variable values at the top
  * buildImages copies all the images from img folder in assets while ignoring images inside raw folder if any
  */

gulp.task('buildFiles', function() {
  return gulp.src(buildInclude)
    .pipe(gulp.dest(build))
    .pipe(notify({ message: 'Copy from buildFiles complete', onLast: true }));
});

/**
  * Zipping build directory for distribution
  *
  * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
  */
gulp.task('buildZip', function () {
  return gulp.src(build+'/**/')
    .pipe(zip(project+'.zip'))
    .pipe(gulp.dest('./'))
    .pipe(notify({ message: 'Zip task complete', onLast: true }));
});

// Package Distributable Theme
gulp.task('build', function(cb) {
  gulpSequence('clean:all', 'build:styles', 'scripts', 'buildFiles', 'buildZip', cb);
});

/**
 * Default Gulp task
 */
gulp.task('default', function(cb) {
  gulpSequence('clean:all', 'build:styles', 'build:scripts', 'translate', 'images', cb);
});

/**
 * Run all the tasks sequentially
 * Use this task for development
 */
gulp.task('serve', function(cb) {
  gulpSequence('build:styles', 'build:scripts', 'watch', cb);
});

// reload browser
gulp.task('watch:scripts', ['build:scripts'], function(done) {
  reload();
  done();
});

/**
  * Watch Tasks.
  *
  * Watches for file changes and runs specific tasks.
  */
gulp.task('watch', ['browser-sync'], function() {
  gulp.watch(watch.php).on('change', reload);         // Reload on PHP file changes.
  gulp.watch(watch.style, ['build:styles']);          // Reload on less file changes.
  gulp.watch(watch.script, ['watch:scripts']);        // Reload on script file changes.
});

// reload browser
// gulp.task('watch-php', function(done) {
//   reload();
//   done();
// });
// gulp.task('watch-scripts', ['scripts'], function(done) {
//   reload();
//   done();
// })
