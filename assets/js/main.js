
var intTime = 500;
var intMax = 1000;
var intMin = 100;
var fileList = [], filteredList = [];
var totalFrames = 0;
var playing = false;
var slideShowInterval;
var currentFrame = 0;
var currentIndex = 0;
var sliderPadding = 6;

var start_timestamp, end_timestamp;

$(function(){
  $(".datepicker").datepicker({
    onSelect: function(dateText, inst) {
      stopSlideShow();
      getFileListByDate(dateText);
    },
    onClose: function(dateText, inst) { 
      $(this).attr("disabled", false);
    },
    beforeShow: function(input, inst) {
      $(this).attr("disabled", true);
    }
  });
  $("#slider").slider({
    values: [0],
    slide: function( event, ui ) {
      stopSlideShow();
      var sliderPosition = Math.round(ui.values[0] / totalFrames * (filteredList.length-1));
      currentIndex = filteredList[sliderPosition].index;
      renderFrame();
    }
  });
  $("#slider-range").slider({
    values: [0,0],
    slide: function( event, ui ) {
      if(ui.values[1] - ui.values[0] <= 10){
        return false;
      }
      //if(parseInt($("#custom-handle-min").css("left")) > $("#slider-range").width()*0.95){
        //$("#custom-handle-min").css("left", $("#slider-range").width()*0.95);
        //return false;
      //}
      stopSlideShow();
      adjustFilterRange();
      setSliderRangeBackground();
    },
    change: function(){
      //if(parseInt($("#custom-handle-min").css("left")) > $("#slider-range").width()*0.95){
        //$("#custom-handle-min").css("left", $("#slider-range").width()*0.95);
      //}
      adjustFilterRange();
      setSliderRangeBackground();
    }
  });
  $("#speed > div").slider({
    max: intMax,
    min: intMin,
    value: intTime,
    slide: function( event, ui ){
      intTime = intMax - ui.value + intMin;
    }
  });
  $("#showHour").change(function(){
    getFileListHourly();
  });

  loadFiles();
});