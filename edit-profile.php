<?php
/**
 * Edit profile page
 *
 * Allows a moderator to edit profile
 *
 * @author Hannah Turner
 * @since 0.1.1
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='Edit Profile';
include_once ('header.php');

global $moderator;
$mod_id = !empty($_REQUEST['profile']) ? (int) $_REQUEST['profile'] : (int) $_SESSION['mod_id'];
$moderator = get_moderator($mod_id);

$mod_login_name = get_moderator_login_name($moderator);
$mod_pass       = !empty($_POST['mod_pass'])  ? $_POST['mod_pass']  : null;
$mod_first      =  isset($_POST['mod_first']) ? $_POST['mod_first'] : get_moderator_first($moderator);
$mod_last       =  isset($_POST['mod_last'])  ? $_POST['mod_last']  : get_moderator_last($moderator);
$mod_email      = !empty($_POST['mod_email']) ? $_POST['mod_email'] : get_moderator_email($moderator);

if(isset($_POST['mod_first']) || isset($_POST['mod_last']) || !empty($_POST['mod_email']) || !empty($_POST['mod_pass']) ) {
  update_moderator($mod_id, $mod_email, $mod_login_name, $mod_pass, $mod_first, $mod_last);
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

              <form role="form" action="edit-profile.php" method="post">
                <input type="hidden" value="<?php echo $mod_id; ?>">
                <div class="form-group">
                  <label for="mod_login_name">Username</label>
                  <p class="text-muted" id="mod_login_name"><?php echo $mod_login_name; ?></p>
                </div>
                <div class="form-group">
                  <label for="mod_pass">Password</label>
                  <input type="password" class="form-control" id="mod_pass" name="mod_pass">
                </div>
                <div class="form-group">
                  <label for="mod_first">First Name</label>
                  <input type="text" class="form-control" id="mod_first" name="mod_first" value="<?php echo $mod_first; ?>">
                </div>
                <div class="form-group">
                  <label for="mod_last">Last Name</label>
                  <input type="text" class="form-control" id="mod_last" name="mod_last" value="<?php echo $mod_last; ?>">
                </div>
                <div class="form-group">
                  <label for="mod_email">Email address</label>
                  <input type="email" class="form-control" id="mod_email" name="mod_email" value="<?php echo $mod_email; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </form>

            </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php include_once('footer.php'); ?>
