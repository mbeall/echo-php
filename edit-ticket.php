<?php
/**
 * Edit ticket page
 *
 * Allows a ticket to be edited
 *
 * @author  Crystal Carr
 * @since 0.0.5
 *
 * @todo Validate input fields
 */


global $the_title;
$the_title= 'Edit a Ticket';


include_once('header.php');?>
$tkt_name = get_tkt_name($ticket);
$tkt_priority = get_tkt_priority($ticket);
$tkt_desc = get_tkt_desc($ticket);
$tkt_status = get_tkt_status($ticket);
$tag_name = get_tag_name($tag);


<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

              <div class="entry-content">
               <?php if (is_admin()) { ?>

              <form class="col-xs-6" action="edit-ticket.php" method="post" name="edit_ticket_user" id="edit_ticket_user">
                    <input type="hidden" name="tkt_id_pk" value="">
                    <div class="form-group">
                      <label for="tkt_name">Ticket Name</label>
                      <input class="form-control" type="text" name="tkt_name" id="tkt_name" maxlength="45" value="<?php echo $tkt_name ?>">
                    </div>

                    <div class="form-group">
                      <label for="tkt_priority">Ticket Priority</label>
                      <input type="text" name="tkt_priority" Pattern ="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$"  maxlength="8" value="<?php echo $tkt_priority; ?>">
                    </div>
                    <div class="form-group">
                      <label for="tkt_status">Ticket Status</label>
                      <select name="tkt_status">
                        <option value="closed">Closed</option>
                        <option value="open">Open</option>
                        <option value="review">Review</option>
                        <option value="<?php echo $tkt_status ?>" selected="selected"></option>
                      </Select>
                    </div>
                    <div class="form-group">
                      <label for="tkt_desc">Description:</label>
                      <textarea class="form-control" value="<?php echo $tkt_desc ?>"></textarea>
                    </div>
                    <p><input type="submit" value="Sumbit">
                  <a href="index.php">Cancel</a>
                </p>
                  </form>

              <?php }else {  ?>

                <?php ('Refresh: 5, URL=login.php');
            echo '<h2> You need to be logged in to Edit a ticket. You are being redirected to the login page in 5 seconds.</h2>';
            ?>


          <?php  } ?>

      <?php update_ticket('tkt_name', 'tkt_desc', 'tkt_priority', 'tkt_status','tags') ?>

              </div> <!--.entry-content -->
           </article>
        </div> <!--.row -->
      </div> <!-- #content -->
    </div> <!-- #primary -->




<?php include_once('Untitled_1.htmlfooter.php'); ?>

