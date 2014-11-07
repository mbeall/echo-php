<?php
/**
 * Listing page
 *
 * Used for search; displays list of tickets.
 *
 * @author Matt Beall, Hannah Turner
 * @since 0.0.8
 *
 * @todo Get rid of duplicate results
 */

global $the_title;
$the_title='Browse Tickets';
include_once ('header.php');

$_search   = !empty( $_POST['_search'  ]) ? _text($_POST['_search'  ]) : null;
$_tag_id   = !empty( $_POST['_tag_id'  ]) ? (int) $_POST['_tag_id'  ]  : null;
$_priority = !empty( $_POST['_priority']) ? _text($_POST['_priority']) : null;
$_status   = !empty( $_POST['_status'  ]) ? _text($_POST['_status'  ]) : 'open';

$filter  = null;
$filter .= !empty($_search)   ? " AND (tkt_name LIKE '%$_search%' OR tkt_desc LIKE '%$_search%')" : null;
$filter .= !empty($_tag_id)   ? " AND tag_id       = $_tag_id"                                    : null;
$filter .= !empty($_priority) ? " AND tkt_priority = '$_priority'"                                : null;
$filter .= !empty($_status)   ? " AND tkt_status   = '$_status'"                                  : null;
?>

<div id="primary" class="content-area container">
  <div id="content" class="site-content tickets col-lg-12 col-md-12" role="main">
    <div class="row">
      <form class="form-inline" role="form" method="post" action="browse.php">
        <div class="form-group">
          <label class="sr-only" for="_search">Keyword search</label>
          <input type="text" class="form-control" id="_search" name="_search" placeholder="Search" value="<?php echo $_search; ?>">
        </div><!-- .form-group -->

        <div class="form-group">
          <label class="sr-only" for="_tag_id">Tag</label>
          <select class="form-control" id="_tag_id" name="_tag_id">
            <option value="">All tags</option>
            <?php
              $tags = get_tags();

              $output = '';

              foreach($tags as $tag) {
                $output .= '<option value="';
                $output .= $tag->tag_id;
                $output .= '"';
                $output .= $_tag_id == $tag->tag_id ? 'selected' : '';
                $output .= '>';
                $output .= $tag->tag_name;
                $output .= '</option>';
              }

              echo $output;
            ?>
          </select>
        </div><!-- .form-group -->

        <div class="form-group">
          <label class="sr-only" for="_priority">Priority</label>
          <select class="form-control" id="_priority" name="_priority">
            <option value=""><span class="text-muted">Priority</span></option>
            <?php
              $priorities = array('high', 'normal', 'low');

              $output = '';

              foreach($priorities as $priority) {
                $output .= '<option value="';
                $output .= $priority;
                $output .= '"';
                $output .= $_priority == $priority ? 'selected' : '';
                $output .= '>';
                $output .= $priority;
                $output .= '</option>';
              }

              echo $output;
            ?>
          </select>
        </div><!-- .form-group -->

        <div class="form-group">
          <label class="sr-only" for="_status">Status</label>
          <select class="form-control" id="_status" name="_status">
            <?php
              $stati = array('open', 'closed', 'review');

              $output = '';

              foreach($stati as $status) {
                $output .= '<option value="';
                $output .= $status;
                $output .= '"';
                $output .= $_status == $status ? 'selected' : '';
                $output .= '>';
                $output .= $status;
                $output .= '</option>';
              }

              echo $output;
            ?>
          </select>
        </div><!-- .form-group -->

        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
    </div><!-- .row -->

    <?php
      $tickets = get_tickets($filter);
      echo '<p class="small text-muted" style="float:right;">' . count($tickets) . ' results</p>';

      foreach ($tickets as $ticket) {
        $name     = get_ticket_name(     $ticket );
        $desc     = get_ticket_desc(     $ticket );
        $status   = get_ticket_status(   $ticket );
        $priority = get_ticket_priority( $ticket );
        $tags     = get_ticket_tags(     $ticket );

        $class = "ticket ticket-$status ticket-$priority hentry col-xs-12";
      ?>
        <div class="row">
          <article class="<?php echo $class; ?>">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $name; ?></h1>
              <?php
                if (is_logged_in()) {
                  echo '<a class="btn btn-default btn-sm btn-edit" href="edit-ticket.php?tkt_id='.$ticket->tkt_id.'">Edit Ticket</a>';
                }
              ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
              <p><?php echo $desc; ?></p>
            </div><!-- .entry-content -->

            <footer class="entry-meta">
              <p>
                <?php
                  if ($status == 'closed') { echo "<em>Closed</em>. "; }
                  elseif ($status == 'review') { echo "<em>Under review</em>. "; }

                  if (!empty($tags)) {
                    echo 'Tags: ';
                    foreach ($tags as $tag) {
                      $name  = get_tag_name(  $tag);
                      $color = get_tag_color( $tag);
                      $bg    = get_tag_bg(    $tag);

                      $style = "background:$bg;color:$color";
                      ?>

                      <span class="label" style="<?php echo $style; ?>"><?php echo $name ?></span> <?php
                    }
                  }
                ?>
              </p>
            </footer>
          </article>
        </div><!-- .row --><?php
      } ?>
  </div><!-- #content -->
</div><!-- #primary -->

<?php include_once('footer.php'); ?>
