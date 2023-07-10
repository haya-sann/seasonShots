
function setToday(){
  dt = new Date();
  $("input[name=showDate]").val(dt.getDateString());
}

function loadFiles(){
  $.ajax({
    type: "GET",
    url: "loadPhotos.php",
    cache: false,
    success: function(data){
      init(data);
    }, dataType: 'json'
  });
}

function init(arg_data){
  console.log("Loaded photos:", arg_data);
  fileList = arg_data;
  filteredList = fileList;
  totalFrames = fileList.length;
  display_total_images();

  if(totalFrames){

    $(".slider-label span.start span").html(fileList[0].dateString);
    $(".slider-label span.end span").html(fileList[fileList.length-1].dateString);

    start_timestamp = new Date(fileList[0].timestamp);
    end_timestamp = new Date(fileList[fileList.length-1].timestamp);

    var beginning_of_today_timestamp = new Date(end_timestamp.getDateString());
    filteredList = fileList.filterByStartTimestamp(beginning_of_today_timestamp);
    currentIndex = filteredList[filteredList.length-1].index; //最後の写真を選択
    console.log("Today's photos: ", filteredList);

    $("input[name=showDate]").val(end_timestamp.getFullYear() + "/" + (end_timestamp.getMonth()+1) + "/" + end_timestamp.getDate());

    $("#slider").slider( "option", { max:totalFrames, value:totalFrames } ); //スライダーの値を最後に設定
    $("#slider .ui-slider-handle").css({left:"100%"}); //スライダーのハンドルの位置も最後に設定
    $("#slider-range").slider( "option", "max", totalFrames );
    setSliderRange();

    //setToday();
    $("#button_start").click(togglePlay);
    $("#button_magnifier").click(showFullSizePhoto);

    renderFrame();
  }
}

/* - - - - - -  F  I  L  T  E  R  S  - - - - - - - - - */

Array.prototype.all = function(arg_timestamp){
  return this.filter(function(file, index){
      file.index = index;
      return true;
  });
}
Array.prototype.filterByStartTimestamp = function(arg_timestamp){
  return this.filter(function(file, index){
    if(file.timestamp > arg_timestamp){
      if(typeof(file.index) == 'undefined'){
        file.index = index;
      }
      return true;
    }else{
      return false;
    }
  });
}
Array.prototype.filterByEndTimestamp = function(arg_timestamp){
  return this.filter(function(file, index){
    if(file.timestamp < arg_timestamp){
      if(typeof(file.index) == 'undefined'){
        file.index = index;
      }
      return true;
    }else{
      return false;
    }
  });
}
Array.prototype.filterByHour = function(arg_hour){
  return this.filter(function(file, index){
    if(file.hour == arg_hour){
      if(typeof(file.index) == 'undefined'){
        file.index = index;
      }
      return true;
    }else{
      return false;
    }
  });
}

function getFileListByDate(dateString){
  $("#showHour").val("");
  var timestamp_start = new Date(dateString).getTime();
  var timestamp_end = timestamp_start + (60*60*24-1)*1000;
  filteredList = fileList.all().filterByStartTimestamp(timestamp_start).filterByEndTimestamp(timestamp_end);
  if(filteredList.length == 0){
    alert('検索日には撮影データがありませんでした。');
    filteredList = fileList.all();
  }
  console.log(filteredList);
  currentIndex = filteredList[0].index;
  currentFrame = 0;
  setSliderRange();
  renderFrame();
}
function getFileListHourly(){
  var val = $("#showHour").val();
  if(val.length){
    filteredList = fileList.filterByHour(val);
  }else{
    filteredList = fileList.all();
  }
  console.log("Filtered by hour: " + val, filteredList);
  currentIndex = filteredList[0].index;
  currentFrame = 0;
  setSliderRange();
}
function adjustFilterRange(){
  var slider_range_min = $("#slider-range").slider("values", 0);
  var slider_range_max = $("#slider-range").slider("values", 1);
  if($("#showHour").val().length){
    filteredList = fileList.all().slice(slider_range_min, slider_range_max+1).filterByHour($("#showHour").val());
  }else{
    filteredList = fileList.all().slice(slider_range_min, slider_range_max+1);
  }
  for(i=0; i < filteredList.length; i++){
    if(filteredList[i].index == currentIndex){
      currentFrame = i;
      break;
    }
    if(i < filteredList.length-1){
      if(filteredList[i].index < currentIndex && filteredList[i+1].index > currentIndex){
        currentFrame = i;
        break;
      }
    }
  }
  if(typeof(filteredList[0]) != "undefined"){
    //DISPLAY PLAYBACK RANGE
    $(".range-start span").html(filteredList[0].dateString);
    $(".range-end span").html(filteredList[filteredList.length-1].dateString);

    var days = Math.ceil((filteredList[filteredList.length-1].timestamp - filteredList[0].timestamp) / 86400000);
    $(".header span").html(days);

  }
}

/* - - - - - - -  R  E  N  D  E  R  - - - - - - - - - */

function display_total_images(){
  if (totalFrames > 0){
    $("#timeStamp").html("指定の撮影データが" + totalFrames + "枚あります");
  } else {
    $("#timeStamp").html("指定の撮影データはありません");
  }
}

function renderFrame() {
  if(fileList[currentIndex].cached == 0){
    preload(currentIndex);
  }else{
    renderPhoto(currentIndex)
  }
}

var img_loading = false;
function preload(load_index) {
  if (!img_loading) {
    img_loading = true;
    $(".loading").fadeIn('fast');
    var img = new Image ();
    img.onload = function() {
      $(".loading").fadeOut('fast');
      img_loading = false;
      fileList[load_index].cached = 1;
      renderPhoto(load_index);
      if(!playing && load_index != currentIndex){
        preload(currentIndex);
      }
    }
    img.src = fileList[load_index].dir_thumb + fileList[load_index].fileName;
  }
}

var photo_fullsize = '';
function renderPhoto(arg_index) {
  $("#timeStamp").html(fileList[arg_index].dateString);
  $(".slideshow").css('background-image', 'url(./' + fileList[arg_index].dir_thumb + fileList[arg_index].fileName + ')');
  photo_fullsize = './' + fileList[arg_index].dir_full+ fileList[arg_index].fileName;
}
function showFullSizePhoto(){
  if(photo_fullsize != ''){
    window.open(photo_fullsize);
  }
}


/* - - -  S L I D E  S H O W  C O N T R O L  - - - */
function togglePlay(){
  if (!playing){
    startSlideShow();
  }else{
    stopSlideShow();
  }
}
function startSlideShow() {
  playing = true;
  $("#button_start").addClass("stop");
  runSlideShow();
}
function runSlideShow() {  
  currentFrame++;
  if(filteredList.length <= currentFrame){
    currentFrame = 0;
  }
  currentIndex = filteredList[currentFrame].index;
  
  var sliderPosition = currentFrame / (filteredList.length-1) * totalFrames;
  $("#slider").slider("values", 0, sliderPosition);
  renderFrame();
  slideShowInterval = setTimeout("runSlideShow()", intTime);
}
function stopSlideShow() {
  playing = false;
  $("#button_start").removeClass("stop");
  clearTimeout(slideShowInterval);
}


/* - - -  S L I D E R  S T U F F  - - - */
function setSliderRange(){
  var filteredList_cached = filteredList.slice(); //CACHE THE LIST SO IT WON'T CHANGE ITS VALUES WHEN SLIDER UPDATES
  $("#slider-range").slider("values",0,filteredList_cached[0].index).slider("values",1,filteredList_cached[filteredList_cached.length-1].index)
  //$("#slider").slider("values",0,filteredList_cached[currentFrame].index);
  currentFrame = 0;
  setSliderRangeBackground();
}

function setSliderRangeBackground(arg_values){
  var min = $("#slider-range").slider("values",0);
  var diff = $("#slider-range").slider("values",1) - $("#slider-range").slider("values",0);
  var max = $("#slider-range").slider("option","max");
  $(".ui-slider-range").not(".full, .last5").css({
    'left': Math.floor(min / max * 100) + "%",
    'width': Math.ceil(diff / max * 100) + "%"
  });
}

/* - - -  U T I L I T Y  - - - */
function padNumber(arg_num){
  if (arg_num < 10) { 
    return "0" + arg_num;
  }else{
    return arg_num;
  }
}

Date.prototype.getDateString = function(){
  return this.getFullYear() + "/" + padNumber(this.getMonth() + 1) + "/" + padNumber(this.getDate())
}
