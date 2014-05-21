<!-- MAIN CONTAINER OF THE SIGN UP WINDOW -->

		<div id='sign_up' style='display:none;margin:0 auto'>

			<!-- this will contain the div for the contents of the pop up window. it is moved down from the the position of the main container. the height is bigger than the entire pop up window-->

			<div id='sign_up_background' class='font_regular_family'>
		
				<!--it has the contents for the pop up. it can probably be removed-->
				<div id='sign_up_contents'>
				
			
					<!--creates image with logo enclosed in div, but probably dont need the div-->
					<div><img src='images/logo.png' width='377px' height='58px' style='margin:0 auto' /></div>
		
					<!--separator div-->
					<div style='width:100%;height:10px'></div>
		
					<div style='font-size: 13.5pt'>Never any subscription. Always free shipping. Become a member for free to receive exclusive styling tips every week.</div>
		
					<!--this div is used to separate the elements on top and bottom of it-->
					<div style='width:100%;height:17px'></div>
		
					<!--this contains the table that has the user to sign up and sends posts the info to the account2.php-->
					<form method='post' action='account2.php'>
						<input type='hidden' name='version' value='0' />
		
						<table cellspacing='0' style='margin:0 auto;'>
							<tr>
								<td></td>
								<td colspan='2'><div style='width:100%;text-align:left;margin: 0 20px'><a href='home.php?signup=false' style='text-decoration:underline;margin-right:30px'>No thanks, I just want to preview</a></div></td>
							</tr>
						
							<!--this is used as a separator for the two rows next to it (the ones above and below it)-->
							<tr><td><div style='height:10px'></div></td></tr>
						
							<tr>
								<td><div style='text-align:right'>Email</div></td>
			
								<!-- the margin for the div is useful to separate the two cells next to it, mainly the one that contains email and  sign up button-->
								<td><div style='margin: 0 10px' class='custom_tb_frame'><input class='custom_tb' name='email' type='text' maxlength='50' value='' /></div></td>
			
								<!--edit: removed margin-left:0px-->
								<td><div><input type='submit' class='custom_button sign_up' value='' /></div></td>
							</tr>
						</table>
					</form>
		
		</div></div></div>  <!--  end of div with id=sign_up,sign_up_background,sign_up_contents-->

<!--end of sign up page------------------------------------------------------------------------------------->

<!--start of sign in pop up page-->
		<div id='sign_in' style='display: none; background-size:<?php echo $popup_width; ?>px <?php echo $popup_height;?>px'>
			<div id='sign_in_background'>
				<div id='sign_in_contents' class='font_regular_family'>

					<!--EDIT: src= images/logo uncropped.jpg,width=222px height=80px-->
					<div><img src='images/logo.png' width='377px' height='58px' /></div>

					<br />
			
					<!--the image about the 3 items for 39.99
					<img src='images/sticker1.png' width='120px' height='115px' style='position: absolute; top: 20px; left: 420px; z-index: 9010' />						-->

					<div style='font-size: 13.5pt'>Never any subscription. Always free shipping. Become a member for free to receive exclusive styling tips every week.</div>

					<br />
			
		
					<div style='width: 100%; height: 10px'></div>

					<a href='home.php?join=false' style='text-decoration: underline; font-size: 10pt' class='font_regular_light_family'> No thanks, I just want to preview </a>

					<div style='width: 100%; height: 10px'></div>

					<table cellspacing='0' style='margin: 0 auto;width:100%'>

						<form method='post' action='process_sign_in2.php'>
				
							<tr>
								<td><div style='text-align: right; padding-right: 10px'>Email</div></td>

								<td><div class='custom_tb_frame'><input class='custom_tb' name='email' type='text' maxlength='50' value='<?php echo $_POST["email"]; ?>' /></div></td>
								<!--PROBABLY DO NOT NEED THE value=post ABOVE-->
						
								<td></td>
							</tr>

							<tr><td colspan='3'><div style='width: 100%; height: 5px'></div></td></tr>

							<tr>
								<td><div style='text-align: right; padding-right: 10px'>Password</div></td>

								<td><div class='custom_tb_frame'><input class='custom_tb' name='pw' type='password' maxlength='20' value='' /></div></td>

								<td></td>
							</tr>

							<tr><td colspan='3'><div style='width: 100%; height: 5px'></div></td></tr>

							<tr><td colspan='3'><input type='submit' class='custom_button sign_in' value='' /></td></tr>

							<tr><td colspan='3'><div style='width: 100%; height: 5px'></div></td></tr>

						</form>


						<!--this creates the password form to send it to the account.php file -->
						<form id='forgot_pw_form' method='post' action='account2.php'>
				
						<!--it is used to pass the values of this input to the action page, to tell it what version it is-->
							<input name='version' value='4' type='hidden' />

						</form>
				
						<!--somewhat similar to the submit form with the submit() implicit function the submit value is to send all data in the form to the server -->
						<tr><td colspan='3'><div onclick="document.getElementById('forgot_pw_form').submit()" class='forgot_pw'>Forgot password?</div></td></tr>

					</table>				

		</div></div></div><!-- end sign-up-in_contents, sign-up-in_background, sign-up-in -->