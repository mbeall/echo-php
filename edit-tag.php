<?php
/**
 * Edit tag page
 *
 * Allows a moderator to create or edit a tag
 *
 * @author Crystal Carr
 * @since  0.2.0
 */
global $the_title;
$the_title= 'Edit Tag';

include_once('header.php');

global $tag;
$tag_id_PK = (int)$_REQUEST['tag_id_PK'];
?>

<div id="primary" class="content-area container">
  <div id="content" class="site-content col-lg-12 col-md-12" role="main">
    <div class="row">
      <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
        <header class="entry-header">
          <h1 class="entry-title"><?php echo $the_title; ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content"><?php
          if (!empty($tag_id_PK) && is_logged_in()) {
            $tag       = get_tag($tag_id_PK);
            $tag_name  = !empty($_POST['tag_name' ]) ? $_POST['tag_name' ] : get_tag_name($tag);
            $tag_color = !empty($_POST['tag_color']) ? $_POST['tag_color'] : get_tag_color($tag);
            $tag_bg    = !empty($_POST['tag_bg'   ]) ? $_POST['tag_bg'   ] : get_tag_bg($tag);

            if(!empty($_POST['tag_name']) && !empty($tag_color) && !empty($tag_bg)) {
              update_tag($tag_id_PK, $tag_name, $tag_color, $tag_bg);
            }
            ?>
            <form class="col-md-6" action="edit-tag.php" method="post" name="edit_tag" id="edit_tag">
              <input type="hidden" name="tag_id_PK" id="tag_id_PK" value="<?php echo $tag_id_PK; ?>">
              <div class="form-group">
                <label for="tag_name">Tag Name</label>
                <input class="form-control" type="text" name="tag_name" id="tag_name" maxlength="32" value="<?php echo $tag_name; ?>">
              </div><!-- .form-group -->

              <div class="form-group">
                <label for="tag_color">Tag Color</label>

                <div class="input-group">
                  <div class="input-group-addon">#</div>
                  <input class="form-control" type="text" name="tag_color" id="tag_color" pattern="[a-fA-F0-9]"  maxlength="6" value="<?php echo _hexadec($tag_color); ?>">
                </div><!-- .input-group -->
              </div><!-- .form-group -->

              <div class="form-group">
                <label for="tag_bg">Tag Background</label>

                <div class="input-group">
                  <div class="input-group-addon">#</div>
                  <input class="form-control" type="text" name="tag_bg" id="tag_bg" pattern="[a-fA-F0-9]"  maxlength="6" value="<?php echo _hexadec($tag_bg); ?>">
                </div><!-- .input-group -->
              </div><!-- .form-group -->

              <p>
                <input class="btn btn-primary" type="submit" value="Submit">
                <a class="btn btn-default" href="edit-tag.php">Back</a>
              </p>
            </form>

            <div class="col-md-6"><?php
              $style = "background:$tag->tag_bg;color:$tag->tag_color;"; ?>
              <span class="label" style="<?php echo $style; ?>"><?php echo $tag->tag_name; ?></span>
            </div><?php
          }
          elseif (is_logged_in()) {
            ?>
            <p>Please select a tag to edit.</p>
            <form class="col-md-6" action="edit-tag.php" method="post" name="select_tag" id="select_tag">
              <div class="form-group">
                <label class="sr-only" for="tag_id_PK">Tag</label>
                <select class="form-control" id="tag_id_PK" name="tag_id_PK">
                  <option value="">All tags</option>
                  <?php
                    $tags = get_tags();
                    echo '<p><code>get_tags()</code></p><pre>';
                    print_r($tags);
                    echo '</pre>';

                    $output = '';

                    foreach($tags as $tag) {
                      $output .= '<option value="';
                      $output .= $tag->tag_id_PK;
                      $output .= '">';
                      $output .= $tag->tag_name;
                      $output .= '</option>';
                    }

                    echo $output;
                  ?>
                </select>
              </div>

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
            echo '<h2>You must be logged in to edit a tag. <a href="login.php">Please login first</a>.</h2>';
          }
          ?>

        </div> <!--.entry-content -->
      </article>
    </div> <!--.row -->
  </div> <!-- #content -->
</div> <!-- #primary -->

<?php include_once('footer.php'); ?>
