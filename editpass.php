<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Edit Password</title>

<link rel="stylesheet" type="text/css" media="screen" href="styles.css" />

<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>
<script src="additional-methods.js" type="text/javascript"></script>
<script src="jquery.validate.password.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
    $("#newUserForm").validate( {
		rules: {
			passwordconfirmation: {
				equalTo: "#password"
			}
		},
		messages: {
			passwordconfirmation: {
				equalTo: "Enter same password as above"
			}
		}
	});
});
</script>
</head>

<body>
<?php include("global/processpassupdate.php"); ?>

  <div id="new_user_form">
  <form class="cmxform" id="newUserForm" method="post" action="">
 <fieldset>
   <legend>Update password</legend>
   
   <p>
     <label for="passwordconfirmation">Old Password</label>
     <em>*</em><input type="password" id="oldpassword" name="oldpassword" size="25" class="required" minlength="6" maxlength="20" value="<?php echo $oldpassword; ?>" />
	 <?php echo $error_old_password; ?>
   </p>
   
   <p>
	<fieldset class="noborder">
     <label for="password">New Password</label>
     <em>*</em><input type="password" id="password" name="password" class="password" size="25" value="<?php echo $valid_password; ?>"/>
	 <?php echo $error_password; ?>
	 <div class="password-meter">
		<div class="password-meter-message"> </div>
		<div class="password-meter-bg">
			<div class="password-meter-bar"></div>
		</div>
	 </div>
	 </fieldset>
   </p>
   
   <p>
     <label for="passwordconfirmation">New Password Confirmation</label>
     <em>*</em><input type="password" id="passwordconfirmation" name="passwordconfirmation" size="25" class="required" minlength="6" maxlength="20" value="<?php echo $passwordconfirmation; ?>" />
	 <?php echo $error_password_confirmation; ?>
   </p>
   
   <p>
     <input class="submit" type="submit" value="Submit"/>
   </p>
   
 </fieldset>
 </form>
  </div>
 </body>
 
 </html>