$(document).ready(function() {


            $( "#responsecontainer" ).load( "../../Views/Admin/review-pending-tweets.php?project_name="+document.getElementById("nameOfProject").innerHTML, function() {
          
            });

            $("#config_panel").click(function() {

              window.location.href = "../../Views/User/index.php";
        });


		        $("#review_pending").click(function() {

		          $.ajax({    //create an ajax request to load_page.php
		            type: "GET",
		            url: "../../Views/Admin/review-pending-tweets.php?project_name="+document.getElementById("nameOfProject").innerHTML,
		            dataType: "html",   //expect html to be returned
		            success: function(response){
		                $("#responsecontainer").html(response);
		                //alert(response);
		            }
		        });
		    });

                 $("#review_approved").click(function() {

                     $.ajax({    //create an ajax request to load_page.php
                         type: "GET",
                         url: "../../Views/Admin/review-approved-tweets.php?project_name="+document.getElementById("nameOfProject").innerHTML,
                         dataType: "html",   //expect html to be returned
                         success: function(response){
                             $("#responsecontainer").html(response);
                             //alert(response);
                         }
                     });
                 });

                 $("#review_declined").click(function() {

                     $.ajax({    //create an ajax request to load_page.php
                         type: "GET",
                         url: "../../Views/Admin/review-denied-tweets.php?project_name="+document.getElementById("nameOfProject").innerHTML,
                         dataType: "html",   //expect html to be returned
                         success: function(response){
                             $("#responsecontainer").html(response);
                             //alert(response);
                         }
                     });
                 });
		    });