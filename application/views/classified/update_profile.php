<!DOCTYPE html>
<html>
<head>

<title>Update Profile | 99 Right Deals</title>

<!-- xxx Head Content xxx -->
<?php echo $this->load->view('common/head');?> 
<!-- xxx End xxx -->

<link rel="stylesheet" href="<?php echo base_url(); ?>j-folder/css/j-forms.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/innerpagestyles.css" />

<script>
function isNumber(e){e=e?e:window.event;var n=e.which?e.which:e.keyCode;return n>31&&(48>n||n>57)?!1:!0}$(function(){$("#save_changes").validate({rules:{firstnamepost:{required:!0,lettersonly:!0},lastnamepost:{required:!0,lettersonly:!0},contactnopost:{required:!0,minlength:11}},messages:{firstnamepost:{required:"Please enter first name"},lastnamepost:{required:"Please enter last name"},contactnopost:{required:"Please enter a mobile no"}},submitHandler:function(e){return!0}})}),$(function(){$.validator.addMethod("pwcheck",function(e){return/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/.test(e)}),$("#change_pwd").validate({rules:{currentpasspost:{required:!0,minlength:8,pwcheck:!0},newpasspost:{required:!0,minlength:8,pwcheck:!0},confirmpasspost:{required:!0,minlength:8,equalTo:"#newpasspost",pwcheck:!0}},messages:{currentpasspost:{required:"Please enter a current password",pwcheck:"Should Include atleast one lowercase, one uppercase, one digit"},newpasspost:{required:"Please enter a new password",pwcheck:"Should Include atleast one lowercase, one uppercase, one digit"},confirmpasspost:{required:"Please enter a confirm password",pwcheck:"Should Include atleast one lowercase, one uppercase, one digit"}},submitHandler:function(e){return!0}})});

/*deactivation account*/
$(function(){
$("#deactivate_account").click(function(){
$("#deactivate_account").text("Please Wait");
$('#deactivate_account').attr("disabled", true);
var reason_msg;
var mail = $('#email').val();
var id = $('#profile_id').val();
var fname = $("#firstnamepost").val();
var reasonname = $(".reasonname").val();
if (reasonname == 'I_Found_My_deals_with_another_website') {
reason_msg = $("#reasonurl").val();
}
else if (reasonname == 'I_am_unhappy_about_services' || reasonname == 'Other_Reasons'){
reason_msg = $("#reason").val();
}
else{
reason_msg = '';
}
$.ajax({
type : 'post',
url  : '<?php echo base_url()?>update_profile/deactivate_account',
data : {
mail: mail,
id: id,
fname: fname,
reasonname: reasonname,
reason_msg: reason_msg},
dataType : 'json',
success : function(res) {
if (res == 0){
window.location.href = "<?php echo base_url(); ?>login";
}
else{
window.location.href = "<?php echo base_url(); ?>update-profile";      		
}

}
});
});
});
</script>
<?php foreach ($prof_data as $prof_val) {
$prof_id = $prof_data['login_id'];
$fname = $prof_data['first_name'];
$lname = $prof_data['lastname'];
$mail_id = $prof_data['login_email'];
$mobile = $prof_data['mobile'];
} ?>
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
<div class="bg_parallax image_01_parallax"></div>
</div>

<section class="content-central">
<div class="semiboxshadow text-center">
<img src="<?php echo base_url(); ?>img/img-theme/shp.png" class="img-responsive" alt="Shadow" title="Shadow view">
</div>
<div class="content_info">
<div class="paddings">
<div class="container">
<div class="row">
<!-- Item Table-->
<div class="col-sm-3">
<div class="item-table">
<div class="header-table color-red">
<img src="<?php echo base_url(); ?>img/icons/user_pro.png" alt="user_pro" title="Profile" class="img-responsive pvt-no-img">
<h2><?php echo @$log_name; ?></h2> 
</div>
<ul class="dashboard_tag">
<a href='<?php echo base_url(); ?>deals-status'>
<li><img src="<?php echo base_url(); ?>img/icons/status.png" alt="status" title="Deals">Deals Status</li>
</a>
<a href='<?php echo base_url(); ?>deals-administrator'>
<li><img src="<?php echo base_url(); ?>img/icons/admin.png" alt="admin" title="Admin">Deals Administrator</li>
</a>
<a href='<?php echo base_url(); ?>pickup-deals'>
<li><img src="<?php echo base_url(); ?>img/icons/pickup.png" alt="pickup" title="Pickup">Pickup deals</li>
</a>
<a href='<?php echo base_url(); ?>my-wishes'>
<li><img src="<?php echo base_url(); ?>img/icons/seaked.png" alt="favourites" title="Favourites">My Wishes</li>
</a>
<a href='<?php echo base_url(); ?>update-profile'>
<li><img src="<?php echo base_url(); ?>img/icons/updateprofile.png" alt="Update Profile" title="<?php echo base_url(); ?>updateprofile image"> Update Profile</li>
</a>
</ul>
<a class="btn color-red" href="<?php echo base_url(); ?>login/logout">Logout</a>
</div>
</div>
<!-- End Item Table-->
<!-- Item Table-->
<div class="j-forms">
<div class="col-sm-9">
<?php echo $this->view("classified_layout/success_error"); ?>	

<div class="accordion">
<div class="panel-group" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
<div class="panel-heading" role="tab">
<h3 class="panel-title">
<a  role="button" data-toggle="collapse" data-parent="#accordion" href="#one" aria-expanded="false" aria-controls="collapseTwo">
UPDATE PROFILE
</a>
</h3>
</div>
<div id="one" class="panel-collapse collapse in" role="tabpanel" >
<div class="panel-body">
<div class="row top_20">
<!-- contact details-->
<form id="save_changes" action="<?php echo base_url()?>update_profile/up_profile" class="tooltip-hover change_pwd" method="post">
<div class="col-sm-6">
<div class="row">
<div class="col-sm-12 unit">
<h3>Change Profile</h3>
<label class="label">First Name 
<sup data-toggle="tooltip" title="" data-original-title="First Name">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="firstnamepost">
<i class="fa fa-user"></i>
</label>
<input type="hidden" id="profile_id" name="profile_id" value="<?php echo $prof_id; ?>"  >
<input type="text" id="firstnamepost" name="firstnamepost" placeholder="Enter First Name" value="<?php echo $fname; ?>"  >
</div>
</div>
<div class="col-sm-12 unit">
<label class="label">Last Name 
<sup data-toggle="tooltip" title="" data-original-title="Last Name">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="lastnamepost">
<i class="fa fa-user"></i>
</label>
<input type="text" id="lastnamepost" name="lastnamepost" placeholder="Enter Last Name" value="<?php echo $lname; ?>" >
</div>
</div>
<div class="col-sm-12 unit">
<label class="label">Contact Number 
<sup data-toggle="tooltip" title="" data-original-title="Contact Number">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="phone">
<i class="fa fa-phone"></i>
</label>
<input type="text" id="contactnopost" name="contactnopost" placeholder="Enter Contact Number" value="<?php echo $mobile; ?>" maxlength='11' onkeypress="return isNumber(event)" >
</div>
</div>
<div class="col-sm-12 unit">													
<button class="btn btn-primary "  >Save Changes</button>
</div>
</div>
</div>
</form>
<!-- Change password-->
<form id="change_pwd" action="<?php echo base_url()?>update_profile/change_pwd" class="tooltip-hover change_pwd" method="post">
<div class="col-sm-6">
<div class="row">
<div class="col-sm-12 unit">
<h3>Change password</h3>
<label class="label">Current Password 
<sup data-toggle="tooltip" title="" data-original-title="Current Password ">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="currentpasspost">
<i class="fa fa-lock"></i>
</label>
<input type="password" id="currentpasspost" name="currentpasspost" placeholder="Enter Current Password" >
<?php echo form_error("currentpasspost");?>
</div>
</div>
<div class="col-sm-12 unit">
<label class="label">New password 
<sup data-toggle="tooltip" title="" data-original-title="Atleast 8 characters, one uppercase, one lowercase and one special character">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="newpasspost">
<i class="fa fa-lock"></i>
</label>
<input type="password" id="newpasspost" name="newpasspost" placeholder="Enter New password" >
<?php echo form_error("newpasspost");?>
</div>
</div>
<div class="col-sm-12 unit">
<label class="label">Confirm password 
<sup data-toggle="tooltip" title="" data-original-title="Should match with new password">
<img src="<?php echo base_url(); ?>img/icons/i.png" alt="I Error" title="Error view">
</sup>
</label>
<div class="input">
<label class="icon-right" for="confirmpasspost">
<i class="fa fa-lock"></i>
</label>
<input type="password" id="confirmpasspost" name="confirmpasspost" placeholder="Enter Confirm password" >
<?php echo form_error("confirmpasspost");?>
</div>
</div>
<div class="col-sm-12 unit">	
<button class="btn btn-primary ">Change Password</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading" role="tab">
<h3 class="panel-title">
<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#two" aria-expanded="false" aria-controls="collapseTwo">
DEACTIVATE ACCOUNT
</a>
</h3>
</div>
<div id="two" class="panel-collapse collapse" role="tabpanel" >
<div class="panel-body pad_bot_30">
<p>Are you sure to Deactivate your Account ...?? If you are really decided it then We will miss you.</p>
<p>Please tell Us why you taken this decision, So that we can improve it.</p>
<div class="row">
<div class="col-sm-8 unit">
<label class="input select">
<select name="reasonname" class="reasonname">
<option value="I_found_my_deal_with_99_Right_Deals" class="remove_text_box">I found my deal with 99 Right Deals.</option>
<option value="I_Found_My_deals_with_another_website" class="other_reasonurl_show">I Found My deals with another website</option>
<option value="I_am_unhappy_about_services" class="other_reason_show">I am unhappy about services</option>
<option value="Other_Reasons" class="other_reason_show">Other Reasons</option>
</select>
<input type="hidden" id="email" name="email" value="<?php echo $mail_id; ?>" >
<i></i>
</label>
<div class="unit" id="other_reason_hide" style="display:none;">
<div class="input">
<textarea type="text" id="reason" name="reason" placeholder="Enter Your Reason" ></textarea>
</div>
</div>
<div class="unit" id="other_reasonurl_hide" style="display:none;">
<div class="input top_10">
<input type="text" id="reasonurl" name="reasonurl" placeholder="Enter Your URL" >
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<button class="btn btn-primary" id='deactivate_account'>Deactivate Account</button>
</div>
</div>
</div>
</div>
</div>
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

<!-- End Shadow Semiboxed -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>j-folder/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>j-folder/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>j-folder/js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>j-folder/js/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>j-folder/js/j-forms.min.js"></script>
<script>
setTimeout(function(){
$(".alert").hide();
},5000);
</script>

<!-- xxx footerscript Content xxx -->
<?php echo $this->load->view('common/footerscript');?> 
<!-- xxx footerscript End xxx -->

</body>
</html>
