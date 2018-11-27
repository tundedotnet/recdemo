<?php if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') { 
	// $rating = $movie[3];
	/*print "<pre>";
	print_r($rating);
	print "</pre>";*/
?>
<ul class="w3l-ratings">

	<li>
		<a class="star" data-value="<?php echo $key; ?>" href="#">
			<i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='1' aria-hidden="true"></i>
		</a>
	</li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>

</ul>
<?php } ?>


<script>
	$(document).ready(function () {

        $('a.star i').on('click', function (e) {

        	var me = $(this);
        	e.preventDefault();

        	if ( me.data('requestRunning') ) {
		        return;
		    }

		    me.data('requestRunning', true);

        	var onStarID = e.target.id; // The star ID (i.e., movieid) currently selected
    		// alert(onStarID);

        	var onStar = parseInt($(this).data('value'), 10); // The star score currently selected
    		// alert(onStar);

    		// var stars =  $('a.star li').parent().children('li.star');
    		// console.log($(this).parent().parent().parent().children());
    		var stars = $(this).parent().parent().parent().children();
    		// alert(stars.length);
    
		    for (i = 0; i < stars.length; i++) {
		      $(stars[i]).children().children().removeClass('fa-star').addClass('fa-star-o');
		    }

		    for (i = 0; i < onStar; i++) {
		      $(stars[i]).children().children().removeClass('fa-star-o').addClass('fa-star');
		    }

        	//grab all query data
			var queryData = 'ref=' + onStarID + '&star=' + onStar;
			// console.log(queryData);

			$.ajax({

				type: 'POST',
	            url: 'rate.php',
	            data: queryData,
			    
			    success: function(response){
	            	// console.log(response);
	            	if (response == 1){			
		                // window.location.href = "";
		                // DO NOTHING
		            }
	            },
	            complete: function() {
		            me.data('requestRunning', false);
		        }

			});
        	
        });

        // THIS FIX THE PROBLEM OF EXECUTING THE CLICK ACTION OF $('a#star') ELEMENT MULTIPLE TIMES
  //       $(element).off().on('click', function() {
		//     // function body
		// });
	});

	

	function queryConvert(queryStr){

      queryArr = queryStr.replace('?','').split('&'),
      queryParams = [];

    for (var q = 0, qArrLength = queryArr.length; q < qArrLength; q++) {
        var qArr = queryArr[q].split('=');
        queryParams[qArr[0]] = qArr[1];
    }

    return queryParams;
}

</script>


<!-- <script type="text/javascript">

	$("a#star").on("click",function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        alert(href);
        // $.get('index.php', function() {
        //     window.location.href = href;
        // });

        return false;
    });
</script> -->