const gulp                      = require('gulp');
const sass                      = require('gulp-sass');
const autoPrefixer              = require('gulp-autoprefixer');
const browserSync               = require('browser-sync').create();
const reload                    = browserSync.reload;
const cleanCSS                  = require('gulp-clean-css');
const sourceMaps                = require('gulp-sourcemaps');
const concat                    = require('gulp-concat');
const concatMulti               = require('gulp-concat-multi');
const imagemin                  = require('gulp-imagemin');
const imageminJpegRecompress    = require('imagemin-jpeg-recompress');
const imageminMozjpeg           = require('imagemin-mozjpeg');
const changed                   = require('gulp-changed');
const uglify                    = require('gulp-uglify');
const lineEC                    = require('gulp-line-ending-corrector');
const clean                     = require('gulp-clean');
const config                    = require('./gulp.config.json');



/*
** SASS Compiler
*/
gulp.task('sass', function(){
    return gulp.src(config.sassDir+'/**/*.scss')
            .pipe(sourceMaps.init({ loadMaps: true }))
            .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
            .pipe(autoPrefixer('last 2 versions'))
            .pipe(sourceMaps.write())
            .pipe(lineEC())
            .pipe(gulp.dest(config.cssDir));
});


/*
** Minify CSS
*/
gulp.task('minify:css', function(){
    return gulp.src(config.cssDir+'/**/*.css')
            .pipe(cleanCSS())
            .pipe(lineEC())
            .pipe(gulp.dest(config.cssDist));
});


/*
** Minify JS
*/
gulp.task('minify:js', function(){
    return gulp.src(config.jsDir+'/**/*.js')
            .pipe(uglify())
            .pipe(lineEC())
            .pipe(gulp.dest(config.jsDist));
});


/*
** Minify/Compress Images
*/
gulp.task('minify:images', function(){
    return gulp.src(config.imgDir+'/**/*.{jpg,jpeg,png,svg,gif}')
            .pipe(imagemin([
                imagemin.gifsicle({ interlaced: true }),
                // imagemin.jpegtran({ progressive: true }),
                // imageminJpegRecompress({progressive: true, method: 'smallfry', quality: 'veryhigh'}),
                imageminMozjpeg({
                    quality: 80,
                    progressive: true
                }),
                imagemin.optipng({ optimizationLevel: 5 }),
                imagemin.svgo({ plugins: [{removeViewBox: true}] })
            ]))
            .pipe(gulp.dest(config.imgDist));
});



/*
** Minify Vendor Files
*/
gulp.task('minify:vendor', function(){
    return gulp.src(config.vendorDir+'/**/*')
        .pipe(gulp.dest(config.vendorDist));
});



/*
** Minify Fonts Files
*/
gulp.task('minify:fonts', function(){
    return gulp.src(config.fontsDir+'/**/*')
        .pipe(gulp.dest(config.fontsDist));
});



/*
** Minify Videos Files
*/
gulp.task('minify:videos', function(){
    return gulp.src(config.videosDir+'/**/*')
        .pipe(gulp.dest(config.videosDist));
});



/*
** Concat JS Files
*/
gulp.task('bundle:js', function(done){
    if(config.jsBundle.active){
        let files = config.jsBundle.files;

        if(Object.keys(files).length){
            concatMulti(files)
                .pipe(uglify())
                .pipe(gulp.dest(config.jSDir));
        }
    }

    done();
});


/*
** Concat CSS Files
*/
gulp.task('bundle:css', function(done){
    if(config.cssBundle.active){
        let files = config.cssBundle.files;

        if(Object.keys(files).length){
            concatMulti(files)
                .pipe(cleanCSS())
                .pipe(gulp.dest(config.cssDir));
        }
    }

    done();
});


/*
** Clear/Empty Minified Folder
*/
gulp.task('minify:empty', function(){
    return gulp.src([
        config.cssDist+'/*.css',
        config.jsDist+'/*.js',
        config.imgDist+'/*.{jpg,jpeg,png,svg,gif}',
    ], {read: false})
        .pipe(clean());
});


/*
** Compressed Files
*/
gulp.task('minify', gulp.series(['minify:css', 'minify:js', 'minify:images', 'minify:vendor', 'minify:fonts', 'minify:videos']));


/*
** Watch Files
*/
gulp.task('watch', function(){    
    gulp.watch(config.sassDir+'/**/*.scss', gulp.series(['sass', 'bundle:css']));
    gulp.watch(config.jsDir+'/**/*.js', gulp.series(['bundle:js']));
    // gulp.watch(config.imgDir+'/**/*.{jpg,jpeg,png,svg,gif}', gulp.series(['minify:images']));

    if(config.browserSync){
        let files = [
            './**/*.php',
            config.cssDir+'/**/*.css',
            config.jsDir+'/**/*.js',
            config.cssDist+'/**/*.css',
            config.jsDist+'/**/*.js',
        ];

        browserSync.init(files, {
            watchTask: true,
            proxy: config.siteURL,
            port: 8888,
            notify: true
        });
    }
});


gulp.task('default', gulp.series(['sass', 'bundle:css', 'bundle:js', 'watch']));