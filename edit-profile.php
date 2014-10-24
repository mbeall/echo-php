<?php
/**
 * Edit profile page
 *
 * Allows a registered user to edit profile
 *
 * @author Hannah Turner
 * @since 0.1.0
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='Edit Profile';
include_once ('header.php');
global $user;
$u_id=(int)$_REQUEST['profile'];
echo $u_id;
$user=get_user($u_id);
$u_first=get_user_first($user);
$u_last=get_user_last($user);
$u_email=get_user_email($user);
$u_login_name=get_user_login_name($user);?>

<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

<form class="col-xs-6" name ="addEditForm" id="addEditForm" action="edit-profile.php" method="post" onsubmit="return checkForm(this)">

<?php
    if ($editmode)
    {
        echo '<input type="hidden" name="u_id_PK" value="' . $u_id_PK . '" />';
    }
?>

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
     <input type="submit" value="Submit Changes" />
     <a href="profile.php">Cancel</a>
   </p>

</form>



 </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php include_once('footer.php'); ?>
