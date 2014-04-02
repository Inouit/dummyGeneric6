module.exports =
  options:
    livereload: '<%= in8.liveport %>'

  html:
    files:'<%= in8.htmlSrc %>/**'
    options:
      reload: true

  php:
    files:'<%= in8.phpSrc %>/**.php'
    options:
      reload: true

  typoscript:
    files: ['<%= in8.tsSrc %>/**', '../ext_typoscript_constants**']
    options:
      reload: true

  sass:
    files:'<%= in8.cssSrc %>/*.scss'
    tasks: [
      'sass:build',
      'autoprefixer:build'
    ]

  images:
    files:[
      '<%= in8.imgSrc %>/**'
    ]

  coffee:
    files: '<%= in8.jsSrc %>/*.coffee'
    tasks: 'newer:coffee:build'

  components:
    files:'<%= in8.jsComponentSrc %>/*.js'
    tasks: 'newer:coffee:build'