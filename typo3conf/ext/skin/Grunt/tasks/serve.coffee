module.exports = (grunt)->
  grunt.registerTask 'serve', [
    'concurrent:builds'
    'autoprefixer:build'
    'docco:coffeeFiles'
    # 'uglify:build'
    'docco:sassFiles'
    'cssmin:minify'
  ]