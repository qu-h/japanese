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



var publicPath = "../../../public/";
var gitAssetsPath = "D:/WWW/quanict.github.io";

String.prototype.fileIsExist = function(){
    var file = this;
    // try {
    //     var f = require(file);
    // } catch (error) {
    //     console.log(" ====================== prototype.fileIsExist return file not exits : %s",file)
    // }
    //
    // return (typeof f !== 'undefined') ? file : false;
    // return fileExists.sync(file) ? file : false;

    try {
        // fs.accessSync("file://"+file);
        fs.readFileSync(new URL('file:///'+file));
        // console.log("check file is exist : %s | return true",file);
        return file;
    }catch(e){
        // console.log("check file is exist : %s | return false",file,e);
        return false;
    }
};

var getGitResource = function(dir,version,file){
    var resource = gitAssetsPath;

    if( typeof dir !== 'undefined'){
        resource += "/"+dir;
    }
    if( typeof version !== 'undefined' && version !== null){
        resource += "/"+version;
    }

    if( typeof file !== 'undefined' && file !== null){
        var fileCheck = resource+"/"+file;
        var fileExist = fileCheck.fileIsExist();
        if (fileExist) {
            return fileCheck;
        } else {
            var fileExt = fileExtension(file);
            if( fileExt === 'js' ){
                fileCheck = resource+"/js/"+file;
                if( fileCheck.fileIsExist() ){
                    return fileCheck;
                }
            } else if ( fileExt === 'css' ){
                fileCheck = resource+"/css/"+file;

                if( fileCheck.fileIsExist() ){
                    console.log("debug add file",fileCheck)
                    return fileCheck;
                } else {
                    console.log("file not exits",fileCheck)
                }
            } else if ( fileExt === 'scss' ) {
                fileCheck = resource + "/scss/" + file;

                if (fileCheck.fileIsExist()) {
                    console.log("debug add file", fileCheck)
                    return fileCheck;
                } else {
                    console.log("file not exits", fileCheck)
                }
            }
        }
    } else {
        if (resource.fileIsExist()) {
            return resource;
        }
    }

    return false;
};

Array.prototype.addGitResource = function(dir,version,file) {
    var fileCheck = getGitResource(dir,version,file);
    if( typeof fileCheck === 'string' ){
        this.push(fileCheck);
    }

};

Object.prototype.addConcatCss = function(dir,version,file){
    var fileCheck = getGitResource(dir,version,file);
    if( typeof fileCheck === 'string' ){
        console.log('add file concat',fileCheck
        )
        this.pipe(concatCss(fileCheck))
    }
};

gulp.task('sass', function() {
    var files = [];
    files.addGitResource('bootstrap/','4.0.0',"bootstrap.scss");
    files.push('scss/*.scss');

    var gulpTask = gulp.src(files)
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError));
        // .pipe(minifyCSS())
        // .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'));

    return gulpTask.pipe(concat('style.min.css')).pipe(gulp.dest(publicPath+'css'));
});

gulp.task('js', function(){
    var jsFiles = [
        'modules/Word/assets/js/inputs.js'
    ];
    return gulp.src(jsFiles)
        .pipe(concat('backend.js'))
        //.pipe(uglify())
        .pipe(gulp.dest('public/js'))
});

gulp.task('default', function() {
    gulp.start(['js']);
    //gulp.start('jquery-plugin');
    //gulp.start('concatCss');

    // gulp.start(['copy-fonts','copy-image']);
});

