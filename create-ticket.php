<?php
/**
 * Single ticket page
 *
 * Allows a ticket to be created or edited
 *
 * @author Crystal Carr
 * @since 0.0.9
 *
 * @todo Validate input fields
 */
global $the_title;
$the_title= 'Submit Ticket';

include_once('header.php');?>
<?php

$tkt_name     = !empty($_POST['tkt_name'    ]) ? $_POST['tkt_name'    ] : '';
$tkt_desc     = !empty($_POST['tkt_desc'    ]) ? $_POST['tkt_desc'    ] : '';
$tkt_priority = !empty($_POST['tkt_priority']) ? $_POST['tkt_priority'] : 'normal';


if(!empty($tkt_name) && !empty($tkt_desc)) {
  create_ticket($tkt_name, $tkt_desc, $tkt_priority);
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
          <form class="col-xs-6" action="create-ticket.php" method="post" name="create_ticket_moderator" id="create_ticket_moderator">
            <input type="hidden" name="tkt_id" value="">

            <div class="form-group">
              <label for="tkt_name">Ticket Name</label>
              <input class="form-control" type="text" name="tkt_name" id="tkt_name" maxlength="45">
            </div>

            <?php if (is_logged_in()) { ?>

              <div class="form-group">
                <label for="tkt_priority">Ticket Priority</label>
                <select class="form-control" name="tkt_priority">
                  <option value="high">High</option>
                  <option value="normal" selected>Normal</option>
                  <option value="low">Low</option>
                </select>
              </div>

            <?php } ?>

            <div class="form-group">
              <label for="tkt_desc">Description</label>
              <textarea class="form-control" name="tkt_desc"></textarea>
            </div>

            <p>
              <input class="btn btn-primary" type="submit" value="Submit">
              <a class="btn btn-default" href="index.php">Cancel</a>
            </p>
          </form>
        </div> <!--.entry-content -->
      </article>
    </div> <!--.row -->
  </div> <!-- #content -->
</div> <!-- #primary -->

<?php include_once('footer.php'); ?>
