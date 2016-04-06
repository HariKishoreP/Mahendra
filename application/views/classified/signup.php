<!DOCTYPE html>
<html>
	<head>
		
		<title>Sign UP | 99 Right Deals</title>
		
		<!-- xxx Head Content xxx -->
		<?php echo $this->load->view('common/head');?> 
		<!-- xxx End xxx -->
		<style type="text/css">
		.email_width{
			width: 88% !important;
		}
		</style>
		<link rel="stylesheet" href="<?php echo base_url(); ?>j-folder/css/j-forms.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/innerpagestyles.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/signreg.css">
		
		<script type="text/javascript">
			/*accept number only*/
			function isNumber(evt) {
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}

	  

			$(function(){
				$('.sign_type').change(function(){
						var ch = $("input[name='signup_type']:checked").val();
						if(ch == 6){
							$("#signup_business").css('display', 'block');
							$("#signup_consumer").css('display', 'none');
						}else if(ch == 7){
							$("#signup_business").css('display', 'none');
							$("#signup_consumer").css('display', 'block');
						}
				});

				$.validator.addMethod("pwcheck", function(value) {
				   return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/.test(value); // consists of only these
				});

				 jQuery.validator.addMethod("character", function (value) {
					 return /^[a-zA-Z\s]+$/.test(value);
					});

				$("#register_form").validate({
			
				// Specify the validation rules
				rules: {
					con_fname: {
						required: true,
						character:true
					},
					con_lname: {
						required: true,
						character:true
					},
					con_mobile: "required",
					con_email: {
						required: true,
						email: true
					},
					con_password: {
						required: true,
						pwcheck: true
					},
					bus_fname: {
						required: true,
						character:true
					},
					bus_lname: {
						required: true,
						character:true
					},
					bus_name: {
						required: true,
						character:true
					},
					bus_address: "required",
					bus_mobile: "required",
					bus_email: {
						required: true,
						email: true
					},
					bus_password: {
						required: true,
						pwcheck: true
					},
				},
				
				// Specify the validation error messages
				messages: {
					con_fname: {
						required: "Please enter your First name",
						character: "please Enter characters"
					},
					con_lname: {
						required: "Please enter your Last name",
						character: "please Enter characters"
					},
					con_mobile: "Please enter your 11 Digit Mobile No",
					bus_fname: {
						required: "Please enter your First name",
						character: "please Enter characters"
					},
					bus_lname: {
						required: "Please enter your Last name",
						character: "please Enter characters"
					},
					bus_name: {
						required: "Please enter your Business name",
						character: "please Enter characters"
					},
					bus_address: "Please enter your Business Address",
					bus_mobile: "Please enter your 11 Digit Mobile No",
					bus_password: {
						required: "Please provide a password",
						// minlength: "Your password must be at least 8 characters long",
						pwcheck: "minimum 8 characters(Should Include atleast one lowercase, one uppercase, one digit)"
					},
					con_password: {
						required: "Please provide a password",
						// minlength: "Your password must be at least 8 characters long",
						pwcheck: "minimum 8 characters(Should Include atleast one lowercase, one uppercase, one digit)"
					},
					con_email: "Please enter a valid email address",
					bus_email: "Please enter a valid email address",
				},
				
				submitHandler: function(form) {
					return true;
					//form.submit();
				}
			});
			
			});
		</script>
	</head>
	
	<body id="home">
		
		<!--Preloader-->
		<div class="preloader">
			<div class="status">&nbsp;</div>
		</div> 
			   
		<!-- Start Entire Wrap-->
		<div id="layout">
			
			<!-- xxx tophead Content xxx -->
			<?php echo $this->load->view('common/tophead'); ?> 
			<!-- xxx End tophead xxx -->
			
			<!-- Inner Page Content Start-->
			<div class="section-title-01">
				<div class="bg_parallax image_02_parallax"></div>
			</div>   
			
			<section class="content-central">
				<div class="semiboxshadow text-center">
					<img src="<?php echo base_url(); ?>img/img-theme/shp.png" class="img-responsive" alt="">
				</div>
				
				<!-- End content info - page Fill with -->
				<div class="content_info">
					<div class="paddings-mini">
						<div class="container">
							<div class="row ">
								<div class="col-sm-10 col-sm-offset-1">
									<div class="login-title">
										<?php echo $this->view("classified_layout/success_error"); ?>
									</div>
									<div class="row login_totpad">
										<div class="col-sm-12">
											<div class="row login_left">
												<div class="col-md-8">
													<div class=" pull-left">
														<a href="<?php echo base_url(); ?>home-page"><img src="<?php echo base_url(); ?>img/maillogo.png"  class="" alt="Logo" title="99 Right Deals">  </a> 
													</div>
												</div>
												<div class="col-md-4">
													<h2 class="login_name">SignUp</h2>
												</div>
											</div>
											<div class="login-form">
												<form  method="post" class="log_form" action="" id="register_form" novalidate="novalidate">
													<div class="col-1">
														<label class="radio-inline">
															<input type="radio" name="signup_type" value='7' class='sign_type'  checked /> Consumer
														</label>
														<label class="radio-inline">
															<input type="radio" name="signup_type" value='6' class='sign_type' /> Business
														</label>
													</div>
													<div class="form" id='signup_consumer'>
														<div class="col-2">
															<label>First Name <sup style='color:red;'>*</sup>    
																<input placeholder="Enter First Name" id="con_fname" name="con_fname" tabindex="1">
																 
															</label>
														</div>
														<div class="col-2">
															<label>Last Name <sup style='color:red;'>*</sup>
																<input placeholder="Enter Last Name" id="con_lname" name="con_lname" tabindex="2">
																
															</label>
														</div>
														<div class="col-2">
															<label>Email <sup style='color:red;'>*</sup>
																<input placeholder="Enter Email" id="con_email" class='email_width' name="con_email" tabindex="3">
																
															</label>
														</div>
														<div class="col-2">
															<label>Password <sup style='color:red;'>*</sup>
																<input type="password" placeholder="Enter password" id="con_password" name="con_password" tabindex="4">
																
															</label>
														</div>
														<div class="col-1">
															<label>Phone Number <sup style='color:red;'>*</sup>
																<input placeholder="Enter Mobile number" id="con_mobile" name="con_mobile" tabindex="5" maxlength='11' onkeypress="return isNumber(event)" >
																
															</label>
														</div>
													</div>
													<div class="form" style='display:none;' id='signup_business'>
														<div class="col-2">
															<label>First Name <sup style='color:red;'>*</sup>    
																<input placeholder="Enter First Name" id="bus_fname" name="bus_fname" tabindex="1">
															</label>
														</div>
														<div class="col-2">
															<label>Last Name <sup style='color:red;'>*</sup>
																<input placeholder="Enter Last Name" id="bus_lname" name="bus_lname" tabindex="2">
															</label>
														</div>
														<div class="col-2">
															<label>Business Name <sup style='color:red;'>*</sup>    
																<input placeholder="Enter Business name" id="bus_name" name="bus_name" tabindex="3">
															</label>
														</div>
														<div class="col-2">
															<label>Business Address <sup style='color:red;'>*</sup>
																<input placeholder="Enter Business Address" id="bus_address" name="bus_address" tabindex="4">
															</label>
														</div>
														<div class="col-2">
															<label>Email <sup style='color:red;'>*</sup>
																<input placeholder="Enter Email" id="bus_email" name="bus_email" class="email_width" tabindex="5">
															</label>
														</div>
														<div class="col-2">
															<label>Password <sup style='color:red;'>*</sup>
																<input type="password" placeholder="Enter password" id="bus_password" name="bus_password" tabindex="6">
																
															</label>
														</div>
														<div class="col-2">
															<label>Phone Number <sup style='color:red;'>*</sup>
																<input placeholder="Enter Mobile number" id="bus_mobile" name="bus_mobile"  maxlength='11' onkeypress="return isNumber(event)" tabindex="7">
															</label>
														</div>
														<div class="col-2">
															<label>VAT Number
																<input placeholder="Enter VAT number" id="vat_number" name="vat_number" tabindex="8" >
															</label>
														</div>
													</div>
													<div class="col-submit">
														<input type="submit" id="submit" name='submit' class="btn btn-primary" value="Register">
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>   
			</section>
			<!-- Inner Page Content End-->
		
			<!-- xxx footer Content xxx -->
			<?php echo $this->load->view('common/footer');?> 
			<!-- xxx footer End xxx -->
			
		</div>
		<!-- End Entire Wrap -->
		
		<script src="<?php echo base_url(); ?>js/jquery.js"></script> 
		<script>
		   setTimeout(function(){
				$(".alert").hide();
		   },5000);
		</script>
		<script src="<?php echo base_url(); ?>j-folder/js/jquery.validate.min.js"></script>
		
		<!-- xxx footerscript Content xxx -->
		<?php echo $this->load->view('common/footerscript');?> 
		<!-- xxx footerscript End xxx -->
			
	</body>
</html>
