module.exports = (grunt)->
  grunt.registerTask 'serve', [
    'sass:build'
    'autoprefixer:build'
    'docco:coffeeFiles'
    # 'uglify:build'
    'coffee:build'
    'docco:sassFiles'
    'cssmin:minify'
  ]