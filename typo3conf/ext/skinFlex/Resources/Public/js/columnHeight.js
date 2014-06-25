$.handleColumnHeight = function(container, columns) {
  $(window).on('resize', function() {
    container = container ? container : ".forceEqualHeights";
    columns = columns ? columns : ".column";
    $.updateColumnHeight(container, columns);
  });
  $.updateColumnHeight();
};
$.updateColumnHeight = function(container, columns) {
  container = container ? container : ".forceEqualHeights";
  columns = columns ? columns : ".column";
  $(container).each(function() {
    var $highestColumn;
    $highestColumn = $(this).find(columns).first();
    $(this).find(columns).each(function() {
      $(this).children().height('auto');
      if ($(this).outerHeight() > $highestColumn.outerHeight()) {
        $highestColumn = $(this);
      }
    });
    $highestColumn.siblings().children('.columnContent').each(function() {
      if ($highestColumn.hasClass('columnWithPadding') && $(this).parent().hasClass('columnWithPadding')) {
        $(this).height($highestColumn.children('.columnContent').height());
      } else if ($highestColumn.hasClass('columnWithPadding')) {
        $(this).height($highestColumn.outerHeight());
      } else {
        $(this).height($highestColumn.outerHeight() - parseInt($(this).css('paddingTop')) - parseInt($(this).css('paddingBottom')));
      }
    });
  });
};


$(window).load(function() {
  $.handleColumnHeight();
});