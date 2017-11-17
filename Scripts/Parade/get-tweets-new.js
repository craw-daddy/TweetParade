// Customise those settings
var seconds = 8*1000; // time in milliseconds
var tweetsAvailable = 0;
var fadeSeconds = 3000;
var url = '../../Functions/Parade/tweet-array-generator.php';
// var response;

var tweetArray = new Array();

function setTickerNews(tweetObj) {

    document.getElementsByClassName("tweet-parade-header")[0].style.visibility = "hidden";
    document.getElementById("brand").style.visibility = "hidden";


    //if there is media, do the following.
    if((tweetObj.media_url.length > 0)&&(tweetObj.media_img_censored === "0")) {
      $(".tweet-card").fadeOut(fadeSeconds).promise().done(function() {
        
          document.getElementsByClassName("tweet-card__handle")[0].innerHTML = "@"+tweetObj.screen_name;
          if(tweetObj.profile_img_censored === "0"){
              document.getElementsByClassName("tweet-card__avatar")[0].src = tweetObj.profile_image_url;
          }
          else {
              document.getElementsByClassName("tweet-card__avatar")[0].src = "../../Content/Images/Parade/tweet-parade-default-logo.png";
          }

          document.getElementsByClassName("tweet-card__time-tag")[0].innerHTML = getTweetTime(tweetObj.created_at);
          
          document.getElementsByClassName("tweet-card__tweet")[0].innerHTML = tweetObj.text;

          //Media Fade
          var media_url = tweetObj.media_url;
          // #Image switching glitch
          document.getElementsByClassName("tweet-card__media-image")[0].src = tweetObj.media_url;
              // $('#media-box').fadeIn(fadeSeconds);
              document.getElementsByClassName("tweet-card__media")[0].style.display ='inline-block';

           $(".tweet-card").fadeIn(fadeSeconds);
      });
    }
    //else if there is no media, do the following
    else {

      $(".tweet-card").fadeOut(fadeSeconds).promise().done(function() {

          document.getElementsByClassName("tweet-card__handle")[0].innerHTML = "@"+tweetObj.screen_name;
          if(tweetObj.profile_img_censored === "0"){
              document.getElementsByClassName("tweet-card__avatar")[0].src = tweetObj.profile_image_url;
          }
          else {
              document.getElementsByClassName("tweet-card__avatar")[0].src = "../../Content/Images/Parade/tweet-parade-default-logo.png";
          }
          document.getElementsByClassName("tweet-card__time-tag")[0].innerHTML = getTweetTime(tweetObj.created_at);

          document.getElementsByClassName("tweet-card__tweet")[0].innerHTML = tweetObj.text;
          document.getElementsByClassName("tweet-card__media")[0].style.display ='none';
          //document.getElementsByClassName("tweets").innerHTML = tweetObj.tweet_count;
          //document.getElementById("followers").innerHTML = tweetObj.followers_count;
          //document.getElementById("following").innerHTML = tweetObj.friends_count;

           $(".tweet-card").fadeIn(fadeSeconds);
      });
    }
}
function getTweetTime(timestamp) {
  // Create a new JavaScript Date object based on the timestamp
          // multiplied by 1000 so that the argument is in milliseconds, not seconds.
          var date = new Date(timestamp*1000);
          // Hours part from the timestamp
          var hours = date.getHours();
          // Minutes part from the timestamp
          var minutes = "0" + date.getMinutes();
          // Seconds part from the timestamp
          var seconds = "0" + date.getSeconds();

          var suffix; 
          if (hours<12) suffix = "AM";
          else suffix = "PM"; 

          // Will display time in 10:30:23 format
          var formattedTime = hours + ':' + minutes.substr(-2) + '   ' + suffix;
          return formattedTime;
}

function repeat_function(){

	var reload = function() {

      // fetch_unix_timestamp = function () {
      //   return parseInt(new Date().getTime().toString().substring(0, 10))
      // };
      // var timestamp = fetch_unix_timestamp();
      // var nocacheurl = url + "?t=" + timestamp;

      iterate_array();

     };

    // setInterval("reload()", (seconds+(fadeSeconds*2))*tweetsAvailable);
    reload();
}


$(document).ready(function () {
    
    updateArray();
    repeat_function();
    // setTimeout('reload()', (seconds+(fadeSeconds*2))*tweetsAvailable);

});

function updateArray() {
	fetch_unix_timestamp = function () {
        return parseInt(new Date().getTime().toString().substring(0, 10))
    };
    var timestamp = fetch_unix_timestamp();
    var nocacheurl = url + "?t=" + timestamp + "&project_name=" + document.getElementById("project_name").innerHTML
    //var nocacheurl = url + "?t=" + timestamp;
    var response;

	$.ajax({
            type: 'POST',
            url: nocacheurl,
            data: 'id=testdata',
            dataType: 'json',
            cache: false,
            success: function(data) {


              tweetArray = data;
              //**********************
              //end of array iteration
              //**********************
          }

       }); //end ajax

}

function iterate_array() {

    var curTweetIndex = -1;
    //**********************
    //Iterate over array
    //**********************
    var intervalID = setInterval(function() {
    ++curTweetIndex;
    if (curTweetIndex >= tweetArray.length) {
        //this is not breaking out of the loop
        // clearInterval(intervalID);
        curTweetIndex = -1;
        // response = updateResponse();
        updateArray();

    }else{
        setTickerNews(tweetArray[curTweetIndex]);
    }
        // set new news item into the ticker

    }, seconds+(fadeSeconds*2));
}
