<?php
/**
 * Register page
 *
 * Allows moderators to register
 *
 * @author Hannah Turner
 * @since 0.1.1
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='User Registration';
include_once ('header.php');

$mod_login_name = !empty($_POST['mod_login_name']) ? $_POST['mod_login_name'] : null;
$mod_pass = !empty($_POST['mod_pass']) ? $_POST['mod_pass'] : null;
$mod_first = !empty($_POST['mod_first']) ? $_POST['mod_first'] : null;
$mod_last = !empty($_POST['mod_last']) ? $_POST['mod_last'] : null;
$mod_email = !empty($_POST['mod_email']) ? $_POST['mod_email'] : null;

if(!empty($mod_login_name) && !empty($mod_pass) && !empty($mod_email)) {
  create_moderator($mod_email, $mod_login_name, $mod_pass, $mod_first, $mod_last);
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

              <form role="form" action="register.php" method="post">
                <div class="form-group">
                  <label for="mod_login_name">Username</label>
                  <input type="text" class="form-control" id="mod_login_name" name="mod_login_name" required>
                </div>
                <div class="form-group">
                  <label for="mod_pass">Password</label>
                  <input type="password" class="form-control" id="mod_pass" name="mod_pass" required>
                </div>
                <div class="form-group">
                  <label for="mod_first">First Name</label>
                  <input type="text" class="form-control" id="mod_first" name="mod_first">
                </div>
                <div class="form-group">
                  <label for="mod_last">Last Name</label>
                  <input type="text" class="form-control" id="mod_last" name="mod_last">
                </div>
                <div class="form-group">
                  <label for="mod_email">Email address</label>
                  <input type="email" class="form-control" id="mod_email" name="mod_email" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </form>

            </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->
<?php include_once ('footer.php'); ?>
