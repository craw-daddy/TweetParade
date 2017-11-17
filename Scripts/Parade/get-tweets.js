// Customise those settings
var seconds = 8*1000; // time in milliseconds
var tweetsAvailable = 0;
var fadeSeconds = 3000;
var url = '../../Functions/Parade/tweet-array-generator.php';
// var response;

var tweetArray = new Array();

function setTickerNews(tweetObj) {

    //if there is media, do the following.
    if((tweetObj.media_url.length > 0)&&(tweetObj.media_img_censored === "0")) {
      $("#tweet, #media-box ").fadeOut(fadeSeconds).promise().done(function() {
  	      document.getElementById('tweet-box').setAttribute("style","width:70%");
          document.getElementById("screen_name").innerHTML = tweetObj.screen_name;
          if(tweetObj.profile_img_censored === "0"){
              document.getElementById("profile_image").innerHTML = '<img src="' + tweetObj.profile_image_url + '" >';
          }
          else {
              document.getElementById("profile_image").innerHTML = '<img src="../../Content/Images/Parade/tweet-parade-default-logo.png" >';
          }

          document.getElementById("text").innerHTML = tweetObj.text;
          document.getElementById("tweets").innerHTML = tweetObj.tweet_count;
          document.getElementById("followers").innerHTML = tweetObj.followers_count;
          document.getElementById("following").innerHTML = tweetObj.friends_count;

          //Media Fade
          var media_url = tweetObj.media_url;
          // #Image switching glitch
          document.getElementById("attached_media").innerHTML = '<img class="media_image" src="' + tweetObj.media_url + '" >';
              // $('#media-box').fadeIn(fadeSeconds);

           $("#tweet, #media-box ").fadeIn(fadeSeconds);
      });
    }
    //else if there is no media, do the following
    else {

      $("#tweet, #media-box ").fadeOut(fadeSeconds).promise().done(function() {
  	      document.getElementById('tweet-box').setAttribute("style","width:100%");
          // document.getElementById('tweet-box').setAttribute("style","margin-right:0");
          // // document.getElementById('tweet-box').setAttribute("style","margin: auto auto");
          // document.getElementById('tweet-box').setAttribute("style","display: inline-block");
          // document.getElementById('tweet-box').setAttribute("style","float: none");
          document.getElementById("screen_name").innerHTML = tweetObj.screen_name;
          if(tweetObj.profile_img_censored === "0"){
              document.getElementById("profile_image").innerHTML = '<img src="' + tweetObj.profile_image_url + '" >';
          }
          else {
              document.getElementById("profile_image").innerHTML = '<img src="../../Content/Images/Parade/tweet-parade-default-logo.png" >';
          }

          document.getElementById("text").innerHTML = tweetObj.text;
          document.getElementById("tweets").innerHTML = tweetObj.tweet_count;
          document.getElementById("followers").innerHTML = tweetObj.followers_count;
          document.getElementById("following").innerHTML = tweetObj.friends_count;

           $("#tweet").fadeIn(fadeSeconds);
      });
    }
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
