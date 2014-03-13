module.exports =
  options:
    livereload: '<%= in8.port %>'

  html:
    files:[
      '<%= in8.htmlSrc %>/**/*.html'
      '<%= in8.htmlSrc %>/**/*.tmpl'
    ]
    tasks: 'newer:coffee:build'

  typoscript:
    files:[
      '<%= in8.tsSrc %>/**/*.ts'
      '<%= in8.tsSrc %>/**/*.txt'
    ]
    tasks: 'newer:coffee:build'

  sass:
    files:'<%= in8.cssSrc %>/*.scss'
    tasks: [
      'newer:sass:build',
      'newer:autoprefixer:build'
    ]
  images:
    files:[
      '<%= in8.imgSrc %>/**'
    ]
  coffee:
    files: '<%= in8.jsSrc %>/*.coffee'
    tasks: 'newer:coffee:build'