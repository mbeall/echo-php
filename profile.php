<?php
/**
 * Profile page
 *
 * If logged in, this page allows moderator to edit own information.
 * If not logged in, or different moderator from current profile,
 * this page displays public information for a particular moderator.
 *
 * @author Hannah Turner
 * @since 0.2.0
 */

global $the_title;
$the_title='Profile';
include_once ('header.php');
global $moderator;
$mod_id_PK = !empty($_REQUEST['profile']) ? (int) $_REQUEST['profile'] : (int) $_SESSION['mod_id_PK'];
$moderator=get_moderator($mod_id_PK);
$mod_first=get_moderator_first($moderator);
$mod_last=get_moderator_last($moderator);
$mod_email=get_moderator_email($moderator);
$mod_login_name=get_moderator_login_name($moderator); ?>

<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

              <h2><?php echo "$mod_login_name"; ?></h2>
              <p><strong>Name</strong>: <?php echo "$mod_first $mod_last"; ?></p>
              <p><strong>Email</strong>: <?php echo "$mod_email"; ?></p>


              <form method="post" action="edit-profile.php">
                <p>
                  <input type="hidden" name="profile" value="<?php echo $moderator->mod_id_PK; ?>">
                  <input class="btn btn-default" type="submit"  value="Edit Profile" name="edit-profile" />
                </p>
              </form>

            </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php include_once('footer.php'); ?>
