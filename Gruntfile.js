module.exports = function (grunt) {

	grunt.initConfig({

		// Setting folder templates.
		dirs: {
			css: 'assets/css',
			js: 'assets/js',
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
				files: [{
					expand: true,
					cwd: '<%= dirs.js %>/frontend/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: '<%= dirs.js %>/frontend/',
					ext: '.min.js'
				}]
			},
		},

		// Compile all .scss files.
		sass: {
			compile: {
				options: {
					sourcemap: 'none',
					style: 'compressed',
				},
				files: [{
					expand: true,
					cwd: '<%= dirs.css %>/',
					src: '*.scss',
					dest: '<%= dirs.css %>/',
					ext: '.min.css',
				}]
			}
		},

		// Watch changes for assets.
		watch: {
			css: {
				files: [ '<%= dirs.css %>/*.scss' ],
				tasks: [ 'sass' ],
			},
			js: {
				files: [
					'GruntFile.js',
					'<%= dirs.js %>/admin/*js',
					'<%= dirs.js %>/frontend/*js',
					'!<%= dirs.js %>/admin/*.min.js',
					'!<%= dirs.js %>/frontend/*.min.js',
				],
				tasks: [ 'uglify' ],
			}
		},
	});

	// Load NPM tasks to be used here.
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	// Register tasks.
	grunt.registerTask( 'default', [
		'sass',
		'uglify',
	] );
};