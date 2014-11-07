<?php
/**
 * Create tag page
 *
 * Allows a registered user to create or edit a tag
 *
 * @author Crystal Carr
 * @since 0.0.9
 */
global $the_title;
$the_title= 'Create a Tag';

include_once('header.php');

$tag_name  = !empty($_POST['tag_name' ]) ? $_POST['tag_name' ] : '';
$tag_color = !empty($_POST['tag_color']) ? $_POST['tag_color'] : 'ffffff';
$tag_bg    = !empty($_POST['tag_bg'   ]) ? $_POST['tag_bg'   ] : '777777';


if(!empty($tag_name) && !empty($tag_color) && !empty($tag_bg)) {
  create_tag($tag_name, $tag_color, $tag_bg);
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
        <?php if (is_logged_in()) { ?>

        <form class="col-md-6" action="create-tag.php" method="post" name="create_tag" id="create_tag">
          <div class="form-group">
            <label for="tag_name">Tag Name</label>
            <input class="form-control" type="text" name="tag_name" id="tag_name" maxlength="32">
          </div><!-- .form-group -->

          <div class="form-group">
            <label for="tag_color">Tag Color</label>

            <div class="input-group">
              <div class="input-group-addon">#</div>
              <input class="form-control" type="text" name="tag_color" id="tag_color" pattern="[a-fA-F0-9]"  maxlength="6" value="ffffff">
            </div><!-- .input-group -->
          </div><!-- .form-group -->

          <div class="form-group">
            <label for="tag_bg">Tag Background</label>

            <div class="input-group">
              <div class="input-group-addon">#</div>
              <input class="form-control" type="text" name="tag_bg" id="tag_bg" pattern="[a-fA-F0-9]"  maxlength="6" value="777777">
            </div><!-- .input-group -->
          </div><!-- .form-group -->

          <p>
            <input class="btn btn-primary" type="submit" value="Submit">
            <a class="btn btn-default" href="index.php">Cancel</a>
          </p>
        </form>

        <div class="col-md-6">
          <?php
            $tags = get_tags();
            foreach ($tags as $tag) {
              echo '<span class="label" style="color:'.get_tag_color($tag).';background:'.get_tag_bg($tag).';">'.get_tag_name($tag).'</span> ';
            }
          ?>
        </div><?php

        }
        else {
          echo '<div class="col-xs-12"><h2> You need to be logged in to create a tag.</h2></div>';
        } ?>
        </div> <!--.entry-content -->
      </article>
    </div> <!--.row -->
  </div> <!-- #content -->
</div> <!-- #primary -->
