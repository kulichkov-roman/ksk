'use strict';
/**
 * Сборка CSS
 */
var gulp = require('gulp'),
	streamqueue = require('streamqueue'),
	browserSync = require('browser-sync'),
	$ = require('gulp-load-plugins')();

/**
 * Сборка CSS плагинов
 */
gulp.task('styles-bower', function () {

	return streamqueue(
			{ objectMode: true },
			gulp.src('bower_components/fancybox/source/jquery.fancybox.css')
				.pipe($.cssUrlAdjuster({prependRelative: '../images/fancybox/'})),
			// gulp.src('bower_components/select2/dist/css/select2.css')
			gulp.src('bower_components/owl.carousel/dist/assets/owl.carousel.css'),
			gulp.src('bower_components/owl.carousel/dist/assets/owl.theme.default.css')
		)
		.pipe($.newer(gulp.destPath + '/css/vendor.css'))
		.pipe($.concat('vendor.css'))
		.pipe($.autoprefixer(['last 2 versions', 'Explorer > 8']))
		.pipe(gulp.dest(gulp.destPath + '/css/'));

});

/**
 * Сборка CSS проекта
 */
gulp.task('styles-main', function (sources) {
	sources = sources || false;

	return gulp.src('src/stylus/main.styl')
		.pipe($.plumber())
		.pipe($.if(sources, $.sourcemaps.init()))
			.pipe($.stylus())
			.pipe($.autoprefixer(['last 2 versions', 'Explorer > 8']))
		.pipe($.if(sources, $.sourcemaps.write()))
		.pipe(browserSync.stream())
		.pipe(gulp.dest(gulp.destPath + '/css/'));
});