'use strict'

mountFolder = (connect, dir) ->
    connect.static require('path').resolve(dir)

module.exports = (grunt) ->
  # load all grunt tasks
  require("load-grunt-tasks")(grunt)

  in8Config =
    jsSrc   : '../Resources/Public/js/src'
    jsDest  : '../Resources/Public/js'
    imgSrc  : '../Resources/Public/img'
    cssSrc  : '../Resources/Public/css/src'
    cssDest : '../Resources/Public/js/src'
    htmlSrc : '../Resources/Private'
    docDest : '../Resources/Public/docs'

  grunt.initConfig
    in8: in8Config

    # You can't run the docco task alone, coffeFiles & sassFiles don't chain.
    # You have to call them separatly.
    docco:
      coffeeFiles:
        files:
          src: ['<%= in8.jsSrc %>/*.coffee']
        options:
          output: '<?= in8.docDest ?>/coffee/annotated-source'
          css: '<?= in8.docDest ?>/assets/custom.css'

    coffee:
      build:
        options:
          sourceMap: true
        expand: true
        flatten: true
        cwd: '<?= in8.jsSrc ?>'
        src: ['*.coffee']
        dest: '<?= in8.jsDest ?>'
        ext: '.js'

    sass:
      build:
        options:
          sourcemap: true
          style: "compact"
          precision: 20
          lineNumbers: true
        files:
          '<?= in8.cssDest ?>/main.css': '<?= in8.cssSrc ?>/styles.scss'
          '<?= in8.cssDest ?>/ie.css': '<?= in8.cssSrc ?>/ie.scss'

    autoprefixer:
      build:
        browsers: ["last 3 version", "ie 8", "ie 7"]
        src: '<?= in8.jcssDest ?>/main.css'

    watch:
      options:
        livereload: grunt.option('liveport') || 35729

      html:
        files:[
          '<?= in8.htmlSrc ?>/*.html'
          '<?= in8.htmlSrc ?>/*.tmpl'
        ]

      sass:
        files:'<?= in8.cssSrc ?>/*.scss'
        tasks: [
          'sass:build',
          'autoprefixer:build'
        ]
      images:
        files:[
          '<?= in8.imgSrc ?>/**'
        ]
      coffee:
        files: '<?= in8.jsSrc ?>/*.coffee'
        tasks: [
          'coffee:build'
          'docco:coffeeFiles'
        ]

    grunt.registerTask 'default', [
      'sass:build'
      'autoprefixer:build'
      'coffee:build'
      'watch'
    ]
    grunt.registerTask 'serve', [
      'sass:build'
      'autoprefixer:build'
      'coffee:build'
    ]

