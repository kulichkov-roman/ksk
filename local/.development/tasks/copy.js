'use strict';
/**
 * Копирование разного рода файлов
 */
var gulp = require('gulp'),
	$ = require('gulp-load-plugins')();

/**
 * Копирование ассетов плагинов из компонент bower'а в директорию шаблона
 */
gulp.task('copy-bower-images', function () {
	/*
	return gulp.src(['bower_components/fancybox/source/*.gif', 'bower_components/fancybox/source/*.png', 'bower_components/fancybox/source/*.jpg'])
		.pipe($.newer(gulp.destPath + '/images/fancybox'))
		.pipe(gulp.dest(gulp.destPath + '/images/fancybox'));
	*/
});