var gulp = require('gulp'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    uglifyes = require('uglify-es'),
    composer = require('gulp-uglify/composer'),
    uglify = composer(uglifyes, console),
    gutil = require('gulp-util'),
    fileExtension = require('file-extension'),
    fileExists = require('file-exists'),
    fs = require('fs');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

var publicPath = "D:/WWW/sites-template-git/nicdarkthemes/baby_kids/";
let resourcePath = 'D:/WWW/quanict.github.io';

gulp.task('js', function(){
    var jsFiles = [
        resourcePath+'/raphael/2.0.2/raphael-min.js',

        /**
         * https://github.com/KanjiVG/kanjivg
         * http://kanjivg.tagaini.net
         * https://github.com/mbilbille/dmak
         */


        resourcePath+'/svg/kanjiviewer.js',
        'assets/js/kanji.js'
    ];
    return gulp.src(jsFiles)
        .pipe(concat('kanji.min.js'))
        //.pipe(uglify())
        // .on('error', function (err) {
        //     gutil.log(gutil.colors.red('[Error]'), err.toString());
        // })
        .pipe(gulp.dest(publicPath+'/js'))
});


gulp.task('default', function() {
    gulp.start(['js']);
});

