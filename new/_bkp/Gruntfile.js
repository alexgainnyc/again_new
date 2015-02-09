module.exports = function(grunt) {
	require('time-grunt')(grunt);

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		config: {
			/*src_dir: 'public',
			dest_dir: '_dist',*/
			banner: [
				'/*',
				' * <%= pkg.name %> - <%= pkg.version %>',
				' * Copyright (c) <%= grunt.template.today("yyyy") %> Ramon Fritsch',
				' */\n'
			].join('\n')
		},

		// clean: {
		// 	dist: [
		// 		"<%=config.dest_dir%>/js",
		// 		"<%=config.dest_dir%>/css",
		// 		"<%=config.dest_dir%>/fonts"
		// 	],
		// 	tmp: [
		// 		".tmp/"
		// 	]
		// },

		// copy: {
		// 	dist:	{src: ['**', '\.*', '!styl/**', '!js/**', '!img/**'], dest: '<%=config.dest_dir%>', expand: true, cwd: '<%=config.src_dir%>'}
		// },

		// imagemin: {
		// 	dist: {
		// 		// options: {
		// 		// 	optimizationLevel: 3
		// 		// },

		// 		files: [
		// 			{ src: ['**/*', '!-*'], dest: '<%=config.dest_dir%>/img/', expand: true, cwd: '<%=config.src_dir%>/img/' }
		// 		]
		// 	}
		// },

		useminPrepare: {
			html: {
				files: {
					"public/index.html": "public/index.html"
				}
				,
				options: {
					root: "public/",
					dest: "public/"
				}
			}
			// html: {
			// 	root: "<%=config.src_dir%>",
			// 	files: [
			// 		{ src: ['**/*'], expand: true, cwd: '/views/inc/' }
			// 	]
			// }//,
			// options: {
			// 	dest: '<%=config.dest_dir%>'
			// }
		},

		cssmin: {
			options: {
				banner: '<%=config.banner%>'
			}
		},

		// strip_code: {
		// 	dist: {
		// 		files: [
		// 			{ src: ['*.ejs'], dest: '<%=config.dest_dir%>', cwd: '<%=config.dest_dir%>', expand: true },
		// 			{ src: ['**/*.css'], dest: '.tmp/concat/css', cwd: '.tmp/concat/css', expand: true },
		// 			{ src: ['**/*.js'], dest: '.tmp/concat/js', cwd: '.tmp/concat/js', expand: true }
		// 		]
		// 	}
		// },

		// manifest: {
		// 	generate: {
		// 		options: {
		// 			basePath: "<%=config.dest_dir%>",
		// 			timestamp: true,
		// 			preferOnline: true
		// 		},

		// 		src: ["**/*.{jpg,png,js,css}", "!node_modules/**/*"],
		// 		dest: "<%=config.dest_dir%>/manifest.appcache"
		// 	}
		// },

		watch: {
			options: {
				spawn: false,
				livereload: true
			},

			styles: {
				options: {
					spawn: false,
					livereload: true
				},
				files: ['public/**/*.styl', 'public/**/*.css'],
				tasks: ['stylus']
			},

			other: {
				files: ['public/**/*', '*', '!public/**/*.styl', '!public/**/*.css'],
			}
		},

		// jshint: {
		// 	options: {
		// 		globals: {
		// 			"curly": true,
		// 			"eqnull": true,
		// 			"eqeqeq": false,
		// 			"undef": true,
		// 			"globals": {
		// 				"jQuery": true
		// 			}
		// 		}
		// 	},
		// 	before: [
		// 		"<%=config.src_dir%>/js/*.js"
		// 	],
		// 	after: [
		// 		"<%=config.dest_dir%>/js/main.js"
		// 	]
		// },

		uglify: {
			options: {
				banner: '<%=config.banner%>'
			}
		},

		stylus: {
			compile: {
				options: {
					banner: '<%=config.banner%>',
					// paths: ['<%=config.src_dir%>'],
					urlfunc: 'embedurl', // use embedurl('test.png') in our code to trigger Data URI embedding
					use: [
						require('nib') // use stylus plugin at compile time
					],
					compress: false,
				},
				files: {
					'public/css/global.css': 'public/styl/global.styl'
				}
			}
		},

		// htmlmin: {
		// 	dist: {
		// 		options: {
		// 			removeComments: true,
		// 			removeCommentsFromCDATA: true,
		// 			collapseBooleanAttributes: true,
		// 			removeRedundantAttributes: true
		// 		},
		// 		files: [
		// 			{ src: "**/*.html", dest: "<%=config.dest_dir%>", expand: true, cwd: "<%=config.dest_dir%>" }
		// 		]
		// 	}
		// },

		// unretina: {
		// 	dist: {
		// 		options: {
		// 			quality: 0.65
		// 		},
		// 		files: [
		// 			{ src: "**/*@2x.{png,jpg,gif}", dest: "<%=config.dest_dir%>", expand: true, cwd: "<%=config.dest_dir%>" }
		// 		]
		// 	}
		// }

		});

			// grunt.loadNpmTasks('grunt-contrib-clean');
		grunt.loadNpmTasks('grunt-contrib-concat');
		grunt.loadNpmTasks('grunt-contrib-uglify');
		grunt.loadNpmTasks('grunt-usemin');
		grunt.loadNpmTasks('grunt-contrib-cssmin');
			// grunt.loadNpmTasks('grunt-contrib-imagemin');
		// grunt.loadNpmTasks('grunt-contrib-htmlmin');
			// grunt.loadNpmTasks('grunt-contrib-uglify');
			// grunt.loadNpmTasks('grunt-contrib-jshint');
			// grunt.loadNpmTasks('grunt-contrib-copy');
		// grunt.loadNpmTasks('grunt-manifest');
			// grunt.loadNpmTasks('grunt-usemin');
		grunt.loadNpmTasks('grunt-contrib-stylus');
			// grunt.loadNpmTasks('grunt-contrib-cssmin');
			// grunt.loadNpmTasks('grunt-strip-code');
			// grunt.loadNpmTasks('grunt-newer');
		// grunt.loadNpmTasks('grunt-unretina');

		// grunt.loadNpmTasks('grunt-stylus-sprite');
		// grunt.loadNpmTasks('grunt-git-ftp-include');
		// grunt.loadNpmTasks('grunt-s3-sync');

		// grunt.registerTask('mkdir', grunt.file.mkdir);

		grunt.registerTask('default', [
			'useminPrepare',
			'concat',
			'cssmin',
			'uglify',
		]);

		// grunt.registerTask('images', ['imagemin']);

		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.registerTask('dev', ['watch']);

};