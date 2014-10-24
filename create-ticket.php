<?php
/**
 * Single ticket page
 *
 * Allows a ticket to be created or edited
 *
 * @author Crystal Carr
 * @since 0.0.7
 *
 * @todo Validate input fields
 */


global $the_title;
$the_title= 'Submit Ticket';

include_once('header.php');?>

<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

              <div class="entry-content">
               <?php if (is_admin()) { ?>
        <div class='alert alert-success'>
        <p>Ticket Creation was a Success</p>
        </div>
              <form class="col-xs-6" action="create-ticket.php" method="post" name="create_ticket_user" id="create_ticket_user">
                    <input type="hidden" name="tkt_id_pk" value="">
                    <div class="form-group">
                      <label for="tkt_name">Ticket Name</label>
                      <input class="form-control" type="text" name="tkt_name" id="tkt_name" maxlength="45">
                    </div>
                    <div class="form-group">
                      <label for="tkt_priority">Ticket Priority</label>
                      <input type="text" name="tkt_priority" Pattern ="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$"  maxlength="8" value="">
                    </div>
                    <div class="form-group">
                      <label for="tkt_desc">Description:</label>
                      <textarea class="form-control"></textarea>
                    </div>
                    <p><input type="submit" value="Sumbit">
                  <a href="index.php">Cancel</a>
                </p>
                  </form>

              <?php }else {  ?>

                <form class="col-xs-6" action="create-ticket.php" method="post" name="create_ticket" id="create_ticket">
                  <input type="hidden" name="tkt_id_pk" value="">
                  <div class="form-group">
                    <label for="tkt_name">Ticket Name</label>
                    <input class="form-control" type="text" name="tkt_name" id="tkt_name" maxlength="45">
                  </div>
                  <input type="hidden" name="tkt_priority" value="">
                  <div class="form-group">
                    <label for="tkt_desc">Description:</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <p><input type="submit" value="Submit">
                <a href="index.php">Cancel</a>
              </p>
                </form>
          <?php  } ?>

      <?php create_ticket('tkt_name', 'tkt_desc', 'tkt_priority', 'tkt_status') ?>

              </div> <!--.entry-content -->
           </article>
        </div> <!--.row -->
      </div> <!-- #content -->
    </div> <!-- #primary -->




<?php include_once('footer.php'); ?>

