$(function(){
  $(".datetime-mio").datetimepicker({
      locale: 'es',
      showTodayButton:true,
      sideBySide:true,
      keepOpen:true,
      widgetPositioning:{horizontal:"auto",vertical:"bottom"},
      format:'D-M-YYYY'
  });
  
  $(".datetime-mio-tiempo").datetimepicker({
      locale: 'es',
      showTodayButton:false,
      sideBySide:false,
      format:'H:m:s'
  });


})
