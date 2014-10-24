<?php
/**
 * Login page
 *
 * Allows a registered user to login
 *
 * @author Hannah Turner
 * @since 0.0.3
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='Login';
include_once ('header.php');
require_once ('functions.php');?>
<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
<?php
$userLogin = (isset($_POST['u_login_name'])) ? trim($_POST['u_login_name']) : '';
$userPassword = (isset($_POST['u_pass'])) ? trim($_POST['u_pass']) : '';

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'd8home.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getUser method to check credentials

    $userList = get_user($userLogin, $userPassword);

    if (count($userList)==1) //If credentials check out
    {
        extract($userList[0]);

        // assign user info to an array

        $userInfo = array('contactpk'=>$contactpk, 'firstname'=>$firstname, 'userrole'=>$userrolename);

        // assign the array to a session array element

        $_SESSION['userInfo'] = $userInfo;
        session_write_close(); //typically not required; ensures that the session data is stored

        // redirect the user

        header('location:' . $redirect);
        die();
    }

    else // Otherwise, assign error message to $error
    {
        $error = 'Invalid login credentials<br />Please try again';
    }
}
?>
<form class="col-xs-6" action="login.php" name="loginForm" id="loginForm" method="post">

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <div class="form-group">
	<label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.\-]+" title="User Name has invalid characters" /></div>
   <div class="form-group">
	<label for="userpassword">Password:</label>
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.\-]+" title="Password has invalid characters" /></div>
      <p>
         <input type="submit" value="Login" name="login" /> <br />
         New user?  <a href="register.php">Register Here</a>
      </p>
</form>

<?php
//$login=get_user()
?>

</div><!-- .entry-content -->
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->
<?php include_once ('footer.php'); ?>
