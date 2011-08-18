<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Edit User</title>

<link rel="stylesheet" type="text/css" media="screen" href="styles.css" />

<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>
<script src="additional-methods.js" type="text/javascript"></script>
<script src="jquery.validate.password.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
    $("#editUserForm").validate();
});
</script>
</head>

<body>
<?php $newuser = FALSE ?>
<?php include("global/processuser.php"); ?>

  <div id="new_user_form">
  <form class="cmxform" id="editUserForm" method="post" action="">
 <fieldset>
   <legend>Edit user information</legend>
   <p>
     <label for="name">First Name</label>
     <em>*</em><input id="firstname" name="firstname" size="25" class="required" minlength="2" value="<?php echo $valid_firstname; ?>"/>
	 <?php echo $error_firstname; ?>
   </p>
   
   <p>
     <label for="lastname">Last Name</label>
     <em>*</em><input id="lastname" name="lastname" size="25" class="required" minlength="2" class="required" minlength="2" value="<?php echo $valid_lastname; ?>"/>
	 <?php echo $error_lastname; ?>
   </p>
   
   <p>
     <label for="birthdate">Birthdate</label>
     <em>*</em><input id="birthdate" name="birthdate" size="25" class="required date" value="<?php echo $valid_birthdate; ?>"/>
	<?php echo $error_birthdate; ?>
   </p>
   
   <p>
     <label for="email">E-Mail</label>
     <em>*</em><input id="email" name="email" size="25"  class="required email" value="<?php echo $valid_email; ?>" />
	 <?php echo $error_email; ?>
   </p>
   
   <p>
     <label for="phone">Phone Number</label>
     <em>*</em><input id="phone" name="phone" size="25" class="required phoneUS" value="<?php echo $valid_phone; ?>"/>
	 <?php echo $error_phone; ?>
   </p>
   
   <br/>
   <h2>Local address</h2>
   
   <p>
     <label for="address">Address</label>
     <em>*</em><input id="address" name="address" size="25" class="required" value="<?php echo $valid_address; ?>"/>
	 <?php echo $error_address; ?>
   </p>
   
   <p>
     <label for="apt">Apartment</label>
     <em> </em><em> </em><input id="apt" name="apt" size="25" value="<?php echo $apartment; ?>" />
   </p>
   
   <p>
     <label for="city">City</label>
     <em>*</em><input id="city" name="city" size="25" class="required" value="<?php echo $valid_city; ?>" />
	 <?php echo $error_city; ?>
   </p>

   <p>
     <label for="state">State</label>
     <em>*</em><input id="state" name="state" size="25" class="required" minlength="2" maxlength="2" value="<?php echo $valid_state; ?>" />
	 <?php echo $error_state; ?>
   </p>
	
   <p>
   <label for="zip">Zip</label>
     <em>*</em><input id="zip" name="zip" size="25" class="required number" minlength="5" value="<?php echo $valid_zip; ?>"/>
	 <?php echo $error_zip; ?>
	</p>
	
	<br/>
	<h2>Student Information</h2>
	
	<p>
     <label for="rin">RIN</label>
     <em> </em><em> </em><input id="rin" name="rin" size="25" class="number" minlength="9" maxlength="9" value="<?php echo $valid_rin; ?>"/>
	 <?php echo $error_rin; ?>
   </p>
   
   <p>
     <label for="major">Major</label>
     <em> </em><em> </em><input id="major" name="major" size="50" value="<?php echo $major; ?>" />
   </p>
   
   <p>
     <input class="submit" type="submit" value="Submit"/>
   </p>
   
 </fieldset>
 </form>
  </div>
 </body>
 
 </html>