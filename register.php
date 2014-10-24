<?php
/**
 * Register page
 *
 * Allows users to register
 *
 * @author Hannah Turner
 * @since 0.0.6
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='User Registration';
include_once ('header.php');
include_once ('functions.php')?>
<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
<?php
$userLogin = (!empty($_POST['userlogin']));
$userPassword = (!empty($_POST['userpassword']));
$firstName = (!empty($_POST['firstname']));
$lastName = (!empty($_POST['lastname']));
$eMail = (!empty($_POST['email']));
$phone = (!empty($_POST['phone']));

create_user();

   
echo '<h2>Thank you for Registering.  You will now be redirected to the login page.<h2>';
die();

echo "<section>";
// if the user chose a duplicate username, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
*/
?>
<form class="col-xs-6" name ="addUserForm" id="addUserForm" action="register.php" method="post">
	<div class="form-group">
   <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /></div>
	<div class="form-group">
   <label for="userpassword">Password:</label>
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /></div>
   <div class="form-group">
		 <label for="firstname">First Name:</label>
   <input type="text" name="firstname" id ="firstname" value="<?php echo $firstName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /></div>
    <div class="form-group">
	<label for="lastname">Last Name:</label>
   <input type="text" name="lastname" id ="lastname" value="<?php echo $lastName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /></div>
   <div class="form-group">
	<label for="email">Email:</label>
   <input type="text" name="email" id ="email" value="<?php echo $eMail; ?>" maxlength="50" class="twenty" required="required" pattern="^[\w-\.]+@[\w]+\.[a-zA-Z]{2,4}$" title="Enter a valid email" /></div>
   <div class="form-group">
		 <label for="phone">Telephone:</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $phone; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" /></div>
   <p>
      <input type="submit" value="Register" name="register" /> <br />
      <a href="index.php">Cancel</a>
</p>
   </p>
</form>
</section>
										
</div><!-- .entry-content -->
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->
<?php include_once ('footer.php'); ?>
