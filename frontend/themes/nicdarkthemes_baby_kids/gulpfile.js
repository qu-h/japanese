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


//var publicPath = "D:/WWW/sites-template-git/nicdarkthemes/baby_kids/";
var publicPath = "/home/quannh/PHP-Development/quannh/sites-template/nicdarkthemes/baby_kids/";
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
        this.pipe(concatCss(fileCheck))
    }
};

gulp.task('sass', ()=>{
    var files = [];
    files.push('scss/*.scss');

    var gulpTask = gulp.src(files)
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError));
        // .pipe(minifyCSS())
        // .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'));

    // gulpTask.addConcatCss('bootstrap','4.0.0-beta',"bootstrap.css");
    return gulpTask.pipe(concat('style.min.css')).pipe(gulp.dest(publicPath+'css'));
});

gulp.task('js', function(){
    var jsFiles = [
        'js/*.js'
    ];
    return gulp.src(jsFiles)
        .pipe(concat('baby_kids.js'))
        //.pipe(uglify())
        // .on('error', function (err) {
        //     gutil.log(gutil.colors.red('[Error]'), err.toString());
        // })
        .pipe(gulp.dest(publicPath+'/js'))
});

gulp.task('jquery-plugin', function(){
    var jsFiles = [];

    jsFiles.addGitResource( 'jquery','2.0.3','jquery.min.js');
    jsFiles.addGitResource( 'jquery/ui','1.11.2','widget.min.js');
    jsFiles.addGitResource( 'jquery/ui','1.11.2','tabs.min.js');

    jsFiles.addGitResource( 'jquery/nicescroll','3.2.0','jquery.nicescroll.min.js');
    jsFiles.addGitResource( 'jquery/inview',null,'jquery.inview.min.js');
    jsFiles.addGitResource( 'jquery/tinynav','1.1','tinynav.min.js');
    jsFiles.addGitResource( 'jquery/superfish','1.7.4','superfish.min.js');
    jsFiles.addGitResource( 'jquery/magnific-popup','0.9.9','jquery.magnific-popup.min.js');
    jsFiles.addGitResource( 'jquery/cookie','1.4.0','jquery.cookie.min.js');

    jsFiles.addGitResource( 'jquery/themepunch/jquery.themepunch.tools.min.js');
    jsFiles.addGitResource( 'jquery/themepunch/jquery.themepunch.revolution.min.js');
    jsFiles.addGitResource( 'jquery/countdown/','1.0.1','jquery.countdown.js' );
    jsFiles.addGitResource( 'jquery/parallax','1.1.3','jquery.parallax-1.1.3.js');
    jsFiles.addGitResource( 'jquery/isotope','2.0.0','isotope.pkgd.min.js');

    jsFiles.addGitResource( 'tether','1.4.0','tether.min.js');
    jsFiles.addGitResource( 'popper','1.11.0','popper.min.js');
    jsFiles.addGitResource( 'bootstrap','4.0.0-beta','bootstrap.min.js');
    // console.log("call task jquery-plugin with files :",jsFiles);

    //console.log("add js",jsFiles);
    return gulp.src(jsFiles)
        .pipe(concat('jquery-plugin.js'))
        .pipe(uglify())
        .pipe(gulp.dest(publicPath+'/js'))
});

gulp.task('copy-fonts', function () {
    return gulp.src(['fonts/**/*']).pipe(gulp.dest(publicPath+'fonts/'));
});
gulp.task('copy-image', function () {
    return gulp.src(['images/*']).pipe(gulp.dest(publicPath+'images'));
});

gulp.task("default", gulp.series(["sass","js"]), () => {

});
