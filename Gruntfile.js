module.exports = function( grunt ) {
    'use strict';

    grunt.initConfig( {

        // Setting folder templates.
        dirs: {
            css: 'assets/css',
            js: 'assets/js',
            php: 'includes'
        },

        // JavaScript linting with ESLint.
        eslint: {
            src: [
                '<%= dirs.js %>/admin/*.js',
                '!<%= dirs.js %>/admin/*.min.js',
                '<%= dirs.js %>/frontend/*.js',
                '!<%= dirs.js %>/frontend/*.min.js'
            ]
        },

        // Minify .js files.
        uglify: {
            options: {
                ie8: true,
                parse: {
                    strict: false
                },
                output: {
                    comments : /@license|@preserve|^!/
                }
            },
            admin: {
                files: [{
                    expand: true,
                    cwd: '<%= dirs.js %>/admin/',
                    src: [
                        '*.js',
                        '!*.min.js'
                    ],
                    dest: '<%= dirs.js %>/admin/',
                    ext: '.min.js'
                }]
            },
            frontend: {
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.js %>/frontend/',
                    src: [
                        '*.js',
                        '!*.min.js'
                    ],
                    dest: '<%= dirs.js %>/frontend/',
                    ext: '.min.js'
                } ]
            },
        },

        // Compile all .scss files.
        sass: {
            compile: {
                options: {
                    style: 'compressed',
                    sourcemap: 'none',
                },
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.css %>/',
                    src: [
                        '*.scss',
                        '!bootstrap/*'
                    ],
                    dest: '<%= dirs.css %>/',
                    ext: '.min.css'
                } ]
            }
        },

        // Watch changes for assets.
        watch: {
            css: {
                files: ['<%= dirs.css %>/*.scss'],
                tasks: ['sass']
            },
            js: {
                files: [
                    'GruntFile.js',
                    '<%= dirs.js %>/admin/*js',
                    '<%= dirs.js %>/frontend/*js',
                    '!<%= dirs.js %>/admin/*.min.js',
                    '!<%= dirs.js %>/frontend/*.min.js'
                ],
                tasks: ['eslint','uglify']
            }
        },
    } );

    grunt.loadNpmTasks( 'grunt-contrib-watch' );
    grunt.loadNpmTasks( 'grunt-contrib-sass' );
    grunt.loadNpmTasks( 'gruntify-eslint' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );

    grunt.registerTask( 'default', [ 'sass', 'eslint', 'uglify' ] );
};
