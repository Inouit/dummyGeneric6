module.exports =
  options:
    livereload: '<%= in8.liveport %>'

  html:
    files:'<%= in8.htmlSrc %>/**'
    tasks: 'newer:coffee:build'

  php:
    files:'<%= in8.phpSrc %>/**'
    tasks: 'newer:coffee:build'

  typoscript:
    files:'<%= in8.tsSrc %>/**'
    tasks: 'newer:coffee:build'

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