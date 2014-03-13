module.exports =
  coffeeFiles:
    files:
      src: ['<%= in8.jsSrc %>/*.coffee']
    options:
      output: '<%= in8.docDest %>/coffee'
      css: '<%= in8.docDest %>/assets/custom.css'
  sassFiles:
    files:
      src: ['<%= in8.cssSrc %>/*.scss']
    options:
      output: '<%= in8.docDest %>/sass'
      css: '<%= in8.docDest %>/assets/custom.css'