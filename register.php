<?php
/**
 * Register page
 *
 * Allows users to register
 *
 * @author Hannah Turner
 * @since 0.1.1
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='User Registration';
include_once ('header.php');
global $user;
$u_id=(int)$_REQUEST['profile'];
echo $u_id;
$user=create_user($u_id);
$u_first=create_user_first($user);
$u_last=create_user_last($user);
$u_email=create_user_email($user);
$u_login_name=create_user_login_name($user);?>

<?php

$userLogin = (!empty($_POST['u_login_name']));
$userPassword = (!empty($_POST['u_pass']));
$firstName = (!empty($_POST['u_first']));
$lastName = (!empty($_POST['u_last']));
$eMail = (!empty($_POST['u_email']));

if(!empty($u_login_name) && !empty($u_pass) && !empty($u_first) && !empty($u_last) && !empty($u_email)) {
  create_user($u_login_name, $u_pass, $u_fist, $u_last, $u_email);
  }
?>

<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">




/*
echo '<h2>Thank you for Registering.  You will now be redirected to the login page.<h2>';
die();

echo "<section>";
// if the user chose a duplicate username, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
*/


?>
<form class="col-xs-6" name ="addUserForm" id="addUserForm" action="register.php" method="post">
  <div class="form-group">
   <label for="userlogin">Username:</label>
   <input type="text" name="u_login_name" id ="userlogin" value="<?php echo $u_login_name; ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /></div>
  <div class="form-group">
   <label for="userpassword">Password:</label>
   <input type="password" name="u_pass" id="userpassword" value="<?php echo $u_pass; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /></div>
   <div class="form-group">
     <label for="firstname">First Name:</label>
   <input type="text" name="u_first" id ="firstname" value="<?php echo $u_first; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /></div>
    <div class="form-group">
  <label for="lastname">Last Name:</label>
   <input type="text" name="u_last" id ="lastname" value="<?php echo $u_last; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /></div>
   <div class="form-group">
  <label for="email">Email:</label>
   <input type="text" name="u_email" id ="email" value="<?php echo $u_email; ?>" maxlength="50" class="twenty" required="required" pattern="^[\w-\.]+@[\w]+\.[a-zA-Z]{2,4}$" title="Enter a valid email" /></div>

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
