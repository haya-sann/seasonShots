var dir = 'daily_timelapse/';
var intTime = 500;
var intMax = 1000;
var intMin = 10;
var fileList = [];
var playing = false;
var slideShowInterval;
var currentFrame = 0;
var sliderPadding = 6;

$(function(){
  $(".datepicker").datepicker({
    onClose: function(dateText, inst) { 
        $(this).attr("disabled", false);
    },
    beforeShow: function(input, inst) {
        $(this).attr("disabled", true);
    }
  });
  $("#slider").slider({
    values: [0,0,0],
    slide: function( event, ui ) {
      if(ui.values[0] + sliderPadding-1 >= ui.values[2] || ui.values[2] > ui.values[1]){
        return false;
      }
      stopSlideShow();
      setSliderRange();
      currentFrame = ui.values[2];
      renderFrame();
    }
  });
  $("#speed > div").slider({
    max: intMax,
    min: intMin,
    value: intTime,
    slide: function( event, ui ){
      intTime = intMax - ui.value + intMin;
      console.log(intTime);
    }
  });
  loadFiles();
});