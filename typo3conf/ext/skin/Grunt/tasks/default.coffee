module.exports = (grunt)->
	grunt.registerTask 'default', [
    'concurrent:builds'
    'concurrent:optimize'
    'watch'
  ]