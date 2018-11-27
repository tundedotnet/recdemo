<?php if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') { 
	$rating = $movie[3];
	/*print "<pre>";
	print_r($rating);
	print "</pre>";*/
?>
<ul class="w3l-ratings">

	<?php if($rating == 0) { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>

	<?php } elseif($rating == 1) { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>

	<?php } elseif($rating == 2) { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>

	<?php } elseif($rating == 3) { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>

	<?php } elseif($rating == 4) { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star-o" data-value='1' aria-hidden="true"></i></a></li>

	<?php } else { ?>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=1"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=2"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=3"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=4"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
		<li><a id="star" href="rate.php?ref=<?php echo $key; ?>&star=5"><i class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>

	<?php } ?>
</ul>
<?php } ?>


<script>
	$(document).ready(function () {

        $('a#star').on('click', function (e) {

        	e.preventDefault();

        	var targetAttr = $(this).attr('target');
	  		var linkHref = $(this).attr('href');
	  		var newQueryString = '?'+linkHref.split('?').pop();
	  		// alert(newQueryString)

        	var assoc = queryConvert(newQueryString)
        	// alert(assoc['ref'])
        	// alert(assoc['star'])
     

        	//grab all query data  
			var queryData = 'ref=' + assoc['ref'] + '&star=' + assoc['star'];

			$.ajax({

				type: 'POST',
	            url: 'rate.php',
	            data: queryData,
			    
			    success: function(data){
	            	// alert(data);
	            	if (data == 1){			
		                // window.location.href = "";
		                // DO NOTHING
		            }
	            }

			});
        	
        });

        // THIS FIX THE PROBLEM OF EXECUTING THE CLICK ACTION OF $('a#star') ELEMENT MULTIPLE TIMES
        $(element).off().on('click', function() {
		    // function body
		});
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