/* -------------------------------------------------------------------------------
 * collagraph gruntfile v1.0
 *
 * http://collagraph.com.au
 * -------------------------------------------------------------------------------*/

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

/* -------------------------------------------------------------------------------
 * compass
 *
 * https://github.com/gruntjs/grunt-contrib-compass
 * -------------------------------------------------------------------------------*/

        compass: {
          dist: {
            options: {
              sassDir: 'css',
              cssDir: 'css',
              environment: 'production',
              outputStyle: 'expanded'
            }
          }
        },


/* -------------------------------------------------------------------------------
 * svgmin
 *
 * https://github.com/sindresorhus/grunt-svgmin
 * -------------------------------------------------------------------------------*/

        svgmin: {
            options: {
                plugins: [{
                    removeViewBox: false
                }]
            },

            dist: {
                files: [{
                    expand: true,
                    cwd: 'img/icons/svg',
                    src: '*.svg',
                    dest: 'img/icons/svg/build'// ,
                    // ext: '.colors-888-fff.svg'
                }]
            }
        },

/* -------------------------------------------------------------------------------
 * grunticon
 *
 * https://github.com/filamentgroup/grunticon
 * -------------------------------------------------------------------------------*/

        grunticon: {
            icons: {
                files: [{
                    expand: true,
                    cwd: 'img/icons/svg/build',
                    src: '*.svg',
                    dest: 'img/icons/build'
                }]
            }
        },

/* -------------------------------------------------------------------------------
 * autoprefixer
 *
 * https://github.com/nDmitry/grunt-autoprefixer
 * -------------------------------------------------------------------------------*/

        autoprefixer: {
            options: {
                browsers: ['last 1 version', '> 5%', 'ie 7', 'ie 8']
            },

            multiple_files: {
                expand: true,
                flatten: true,
                src: 'css/style.css',
                dest: 'css/build/prefixed/'
            }
        },

/* -------------------------------------------------------------------------------
 * cssmin
 *
 * https://github.com/gruntjs/grunt-contrib-cssmin
 * -------------------------------------------------------------------------------*/

        cssmin: {
            combine: {
                files: {
                    'css/build/prefixed/style.min.css': ['css/build/prefixed/style.css'],
                    'style.css': ['css/build/prefixed/style.css'],
                    'img/icons/build/icons.data.png.min.css': ['img/icons/build/icons.data.png.css'],
                    'img/icons/build/icons.data.svg.min.css': ['img/icons/build/icons.data.svg.css'],
                    'img/icons/build/icons.fallback.min.css': ['img/icons/build/icons.fallback.css']
                }
            }
        },

/* -------------------------------------------------------------------------------
 * jshint
 *
 * https://github.com/gruntjs/grunt-contrib-jshint
 * -------------------------------------------------------------------------------*/

        jshint: {
            beforeconcat: ['js/functions.js']
        },

/* -------------------------------------------------------------------------------
 * concat
 *
 * https://github.com/gruntjs/grunt-contrib-concat
 * -------------------------------------------------------------------------------*/

        concat: {
            production: {
                src: [
                    'js/plugins/*.js',
                    'js/functions.js'
               ],

                dest: 'js/build/production.js',
            },

            polyfill: {
                src: [
                    'js/polyfills/html5shiv.min.js',
                    'js/polyfills/respond.min.js'
               ],

                dest: 'js/build/polyfill.js',
            }
        },

/* -------------------------------------------------------------------------------
 * uglify
 *
 * https://github.com/gruntjs/grunt-contrib-uglify
 * -------------------------------------------------------------------------------*/

        uglify: {
            production: {
                src: 'js/build/production.js',
                dest: 'js/build/production.min.js'
            },

            polyfill: {
                src: 'js/build/polyfill.js',
                dest: 'js/build/polyfill.min.js'
            }
        },

/* -------------------------------------------------------------------------------
 * watch
 *
 * https://github.com/gruntjs/grunt-contrib-watch
 * -------------------------------------------------------------------------------*/

        watch: {
            options: {
                livereload: true,
            },

            scripts: {
                files: ['js/*.js'],
                tasks: ['concat', 'uglify', 'jshint'],
                options: {
                    spawn: false,
                }
            },

            css: {
                files: ['css/*.scss'],
                tasks: ['compass', 'autoprefixer', 'cssmin'],

                options: {
                    spawn: false,
                }
            }
        }
    });

/* -------------------------------------------------------------------------------
 * https://github.com/sindresorhus/load-grunt-tasks
 * -------------------------------------------------------------------------------*/

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', ['concat', 'uglify', 'compass', 'svgmin', 'grunticon:icons', 'cssmin']);
    grunt.registerTask('dev', ['watch']);
};