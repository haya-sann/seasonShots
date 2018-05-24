
function setToday(){
  dt = new Date();
<<<<<<< HEAD
  $("input[name=showDate]").val(dt.getFullYear() + "/" + padNumber(dt.getMonth() + 1) + "/" + padNumber(dt.getDate()));
=======
  $("input[name=showDate]").val(dt.getDateString());
>>>>>>> ef73900da3f8a5f615872dae3f956f088ae53d33
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
<<<<<<< HEAD
  fileList = arg_data;
  if (fileList.length > 0){
    document.getElementById('timeStamp').innerHTML = "指定の撮影データが" + fileList.length + "枚あります";
  } else {
    document.getElementById('timeStamp').innerHTML = "指定の撮影データはありません";
  }
  $("#slider-gauge span.start").html(fileList[0].dateString);
  $("#slider-gauge span.end").html(fileList[fileList.length-1].dateString);

  for(i = 0; i < sliderPadding; i++){
    fileList.unshift(null);
    fileList.push(null);
  }
  $("#slider").slider( "option", "max", fileList.length );
  $("#slider").slider("values",0,0).slider("values",1,fileList.length).slider("values",2,sliderPadding);
  currentFrame = sliderPadding;
  setSliderRange();

  setToday();
  $("#button_start").click(togglePlay);
}

function renderFrame() {
  $("#timeStamp").html(fileList[currentFrame].dateString);
  $(".slideshow").css('background-image', 'url(' + dir + fileList[currentFrame].fileName + ')');
=======
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
    currentIndex = filteredList[0].index;
    console.log("Today's photos: ", filteredList);

    $("input[name=showDate]").val(end_timestamp.getFullYear() + "/" + (end_timestamp.getMonth()+1) + "/" + end_timestamp.getDate());

    $("#slider").slider( "option", "max", totalFrames );
    $("#slider-range").slider( "option", "max", totalFrames );
    setSliderRange();

    //setToday();
    $("#button_start").click(togglePlay);

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
    filteredList = fileList.all().slice(slider_range_min, slider_range_max).filterByHour($("#showHour").val());
  }else{
    filteredList = fileList.all().slice(slider_range_min, slider_range_max);
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

function renderPhoto(arg_index) {
  $("#timeStamp").html(fileList[arg_index].dateString);
  $(".slideshow").css('background-image', 'url(./' + fileList[arg_index].dir_thumb + fileList[arg_index].fileName + ')');
>>>>>>> ef73900da3f8a5f615872dae3f956f088ae53d33
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
<<<<<<< HEAD
function runSlideShow() {
  currentFrame++;
  if(fileList.length - sliderPadding <= currentFrame){
    console.log('end')
    currentFrame = sliderPadding;
  }
  $("#slider").slider( "values", 2, currentFrame );
=======
function runSlideShow() {  
  currentFrame++;
  if(filteredList.length <= currentFrame){
    currentFrame = 0;
  }
  currentIndex = filteredList[currentFrame].index;
  
  var sliderPosition = currentFrame / (filteredList.length-1) * totalFrames;
  $("#slider").slider("values", 0, sliderPosition);
>>>>>>> ef73900da3f8a5f615872dae3f956f088ae53d33
  renderFrame();
  slideShowInterval = setTimeout("runSlideShow()", intTime);
}
function stopSlideShow() {
  playing = false;
  $("#button_start").removeClass("stop");
  clearTimeout(slideShowInterval);
}

<<<<<<< HEAD
/* - - -  S L I D E R  S T U F F  - - - */
function setSliderRange(arg_values){
  var min = $("#slider").slider("values",0);
  var diff = $("#slider").slider("values",1) - $("#slider").slider("values",0);
  var max = $("#slider").slider("option","max");
  $("#custom-range").css({
    'left': Math.floor(min / max * 100) + "%",
    'width': (diff / max * 100) + "%"
=======

/* - - -  S L I D E R  S T U F F  - - - */
function setSliderRange(){
  var filteredList_cached = filteredList.slice(); //CACHE THE LIST SO IT WON'T CHANGE ITS VALUES WHEN SLIDER UPDATES
  $("#slider-range").slider("values",0,filteredList_cached[0].index).slider("values",1,filteredList_cached[filteredList_cached.length-1].index)
  $("#slider").slider("values",0,filteredList_cached[currentFrame].index);
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
>>>>>>> ef73900da3f8a5f615872dae3f956f088ae53d33
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
<<<<<<< HEAD
=======

Date.prototype.getDateString = function(){
  return this.getFullYear() + "/" + padNumber(this.getMonth() + 1) + "/" + padNumber(this.getDate())
}
>>>>>>> ef73900da3f8a5f615872dae3f956f088ae53d33