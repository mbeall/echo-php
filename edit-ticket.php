<?php
/**
 * Edit ticket page
 *
 * Allows a ticket to be edited
 *
 * @author Matt Beall, Crystal Carr
 * @since 0.1.0
 *
 * @todo Make "Add tag" button functional
 * @todo Make "Remove" on tags functional
 */
global $the_title;
$the_title= 'Edit Ticket';

include_once('header.php');

global $ticket;
$tkt_id = (int) $_REQUEST['tkt_id'];
?>

<div id="primary" class="content-area container">
  <div id="content" class="site-content col-lg-12 col-md-12" role="main">
    <div class="row">
      <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
        <header class="entry-header">
          <h1 class="entry-title"><?php echo $the_title; ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content"><?php
          if (!empty($tkt_id) && is_logged_in()) {
            $ticket = get_ticket($tkt_id);
            $tags   = get_ticket_tags($ticket);

            $tkt_name     = !empty($_POST['tkt_name'    ]) ? $_POST['tkt_name'    ] : get_ticket_name($ticket);
            $tkt_desc     = !empty($_POST['tkt_desc'    ]) ? $_POST['tkt_desc'    ] : get_ticket_desc($ticket);
            $tkt_priority = !empty($_POST['tkt_priority']) ? $_POST['tkt_priority'] : get_ticket_priority($ticket);
            $tkt_status   = !empty($_POST['tkt_status'  ]) ? $_POST['tkt_status'  ] : get_ticket_status($ticket);
            $updated      = !empty($_POST['updated'     ]) ? true                   : false;

            if(!empty($tkt_name) && !empty($tkt_desc) && !empty($tkt_priority) && !empty($tkt_status) && $updated == true) {
              update_ticket($tkt_id, $tkt_name, $tkt_desc, $tkt_priority, $tkt_status);
            }
            ?>
            <form class="col-md-6" action="edit-ticket.php" method="post" name="edit_ticket_user" id="edit_ticket_user">
              <input type="hidden" name="tkt_id" value="<?php echo $tkt_id; ?>">

              <div class="form-group">
                <label for="tkt_name">Ticket Name</label>
                <input class="form-control" type="text" name="tkt_name" id="tkt_name" maxlength="45" value="<?php echo $tkt_name ?>">
              </div>

              <div class="form-group">
                <label for="tkt_priority">Ticket Priority</label>
                <select class="form-control" name="tkt_priority">
                  <option value="high"<?php if ($tkt_priority == 'high') { echo ' selected'; } ?>>High</option>
                  <option value="normal"<?php if ($tkt_priority == 'normal') { echo ' selected'; } ?>>Normal</option>
                  <option value="low"<?php if ($tkt_priority == 'low') { echo ' selected'; } ?>>Low</option>
                </select>
              </div>

              <div class="form-group">
                <label for="tkt_status">Ticket Status</label>
                <select class="form-control" name="tkt_status">
                  <option value="closed"<?php if ($tkt_status == 'closed') { echo ' selected'; } ?>>Closed</option>
                  <option value="open"<?php if ($tkt_status == 'open') { echo ' selected'; } ?>>Open</option>
                  <option value="review"<?php if ($tkt_status == 'review') { echo ' selected'; } ?>>Review</option>
                </select>
              </div>

              <div class="form-group">
                <label for="tkt_desc">Description</label>
                <textarea class="form-control" name="tkt_desc"><?php echo $tkt_desc ?></textarea>
              </div>

              <input type="hidden" name="tkt_tags" value="<?php foreach ($tags as $tag) { echo $tag->tag_id . ','; } ?>">
              <input type="hidden" name="updated" value="1">

              <p>
                <input class="btn btn-primary" type="submit" value="Submit">
                <a class="btn btn-default" href="index.php">Cancel</a>
              </p>
            </form>
            <div class="col-md-6">
              <h4>Tags</h4>
              <?php
              foreach ($tags as $tag) { ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm" style="color:<?php echo get_tag_color($tag); ?>;background:<?php echo get_tag_bg($tag); ?>;"><?php echo get_tag_name($tag); ?></button>
                  <button type="button" class="btn btn-sm" style="color:<?php echo get_tag_color($tag); ?>;background:<?php echo get_tag_bg($tag); ?>;" data-toggle="dropdown"><span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="edit-tag.php?tag_id=<?php echo $tag->tag_id; ?>">Edit <?php echo get_tag_name($tag); ?></a></li>
                    <li><a href="#">Remove</a></li></ul>
                </div>
              <?php }?>
              <button type="button" class="btn btn-sm btn-default">Add Tag</button>
            </div><!-- .col-md-6 --><?php
          }
          elseif (is_logged_in()) {
            ?>
            <p>Please select a ticket to edit.</p>
            <form class="col-xs-6" action="edit-ticket.php" method="post" name="select_ticket" id="select_ticket">
              <div class="form-group">
                <label class="sr-only" for="tkt_id">Ticket</label>
                <select class="form-control" id="tkt_id" name="tkt_id">
                  <option value="">All tickets</option>
                  <?php
                    $tickets = get_tickets();

                    $output = '';

                    foreach($tickets as $ticket) {
                      $output .= '<option value="';
                      $output .= $ticket->tkt_id;
                      $output .= '">';
                      $output .= $ticket->tkt_name;
                      $output .= '</option>';
                    }

                    echo $output;
                  ?>
                </select>
              </div>

              <p>
                <input class="btn btn-primary" type="submit" value="Submit">
                <a class="btn btn-default" href="browse.php">Browse</a>
              </p>
            </form><?php
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
