<?php
/**
 * Edit profile page
 *
 * Allows a registered user to edit profile
 *
 * @author Hannah Turner
 * @since 0.1.1
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title='Edit Profile';
include_once ('header.php');

global $user;
$u_id = !empty($_REQUEST['profile']) ? (int) $_REQUEST['profile'] : (int) $_SESSION['u_id'];
$user = get_user($u_id);

$u_login_name = get_user_login_name($user);
$u_pass       = !empty($_POST['u_pass'])  ? $_POST['u_pass']  : null;
$u_first      =  isset($_POST['u_first']) ? $_POST['u_first'] : get_user_first($user);
$u_last       =  isset($_POST['u_last'])  ? $_POST['u_last']  : get_user_last($user);
$u_email      = !empty($_POST['u_email']) ? $_POST['u_email'] : get_user_email($user);

if(isset($_POST['u_first']) || isset($_POST['u_last']) || !empty($_POST['u_email']) || !empty($_POST['u_pass']) ) {
  update_user($u_id, $u_email, $u_login_name, $u_pass, $u_first, $u_last);
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
                <input type="hidden" value="<?php echo $u_id; ?>">
                <div class="form-group">
                  <label for="u_login_name">Username</label>
                  <p class="text-muted" id="u_login_name"><?php echo $u_login_name; ?></p>
                </div>
                <div class="form-group">
                  <label for="u_pass">Password</label>
                  <input type="password" class="form-control" id="u_pass" name="u_pass">
                </div>
                <div class="form-group">
                  <label for="u_first">First Name</label>
                  <input type="text" class="form-control" id="u_first" name="u_first" value="<?php echo $u_first; ?>">
                </div>
                <div class="form-group">
                  <label for="u_last">Last Name</label>
                  <input type="text" class="form-control" id="u_last" name="u_last" value="<?php echo $u_last; ?>">
                </div>
                <div class="form-group">
                  <label for="u_email">Email address</label>
                  <input type="email" class="form-control" id="u_email" name="u_email" value="<?php echo $u_email; ?>" required>
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
