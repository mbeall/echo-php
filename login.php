<?php
/**
 * Login page
 *
 * Allows a registered user to login
 *
 * @author  Hannah Turner
 * @package Echo/PHP
 * @since 0.0.1
 *
 * @todo Validate input fields
 */

Global $the_title;
$the_title='Login';
include_once ('header.php');?>
<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

<!--function getUser($u_login_name, $u_pass)
{
    $query = <<<STR
Select reg_u_id_PK_FK, u_first, u_last
From registered_users
Where userlogin = '$u_login_name'
and userpassword = '$u_pass'
STR;

return executeQuery($query);-->

<form action="login.php" name="loginForm" id="loginForm" method="post">

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.\-]+" title="User Name has invalid characters" />
   <label for="userpassword">Password:</label>
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.\-]+" title="Password has invalid characters" />
      <p>
         <input type="submit" value="Login" name="login" /> <br />
         New user?  <a href="register.php">Register Here</a>
      </p>
</form>
</div><!-- .entry-content -->
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->
<?php include_once ('footer.php'); ?>