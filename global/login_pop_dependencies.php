<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<input type="hidden" id="cur_page" value="<?php echo $_SESSION['cur_page'] . '.php'; ?>" />
					Sign In & Sign Up
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<section>
					<div class="modal-body">
						<div class="w3_login_module">
							<div class="module form-module">
							  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
								<div class="tooltip">Click Me</div>
							  </div>
							  <div class="form">
								<h3>Login to your account</h3>
								<form id="logform" action="#" method="post">
								  <input type="text" name="Username" placeholder="Username" required="">
								  <input type="password" name="Password" placeholder="Password" required="">
								  <input type="submit" value="Login">
								</form>
							  </div>
							  <div class="form">
								<h3>Create an account</h3>
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
								  <input type="text" name="Username" placeholder="Username" required="">
								  <input type="password" name="Password" placeholder="Password" required="">
								  <input type="email" name="Email" placeholder="Email Address" required="">
								  <input type="text" name="Phone" placeholder="Phone Number" required="">
								  <input type="submit" value="Register">
								</form>
							  </div>
							  <div class="cta"><a href="#">Forgot your password?</a></div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function () {

	        $('form#logform').on('submit', function (e) {

	        	e.preventDefault();

	        	var cur_page = window.location.href; // document.getElementById('cur_page').value;

	        	if(cur_page.indexOf('search') !== -1)
	        	{
	        		var s_text = document.getElementById('searchtext').value;

	        		cur_page = cur_page + "?ref=" +  s_text;
	        		// alert(cur_page); return;
	        	}

	        	//grab all form data  
				var formData = new FormData($(this)[0]);
				// alert(formData)

				$.ajax({

					type: 'post',
		            url: 'login.php',
		            data: formData,
				    async: false,
				    cache: false,
				    contentType: false,
				    processData: false,
				    success: function(data){
		            	// alert(data);
		            	if (data == 1){			
			                window.location.href = cur_page;
			            }
			            else{
			               alert("Invalid username or password, please try again.");
			        	}
		            }

				});
	        	
	        });
		});
	</script>