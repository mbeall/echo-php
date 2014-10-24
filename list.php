<?php
/**
 * Listing page
 *
 * Used for search; displays list of tickets.
 *
 * @author Hannah Turner
 * @since 0.0.6
 */

global $the_title;
$the_title='Search for Tickets';
include_once ('header.php');?>
<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

<section>
    <form class="col-xs-6" action="list.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
   <div class="form-group">
			<label for="ticketname">Ticket Name:</label>
   <input type="text" name="ticketname" id="ticketname" maxlength="50" /></div>
   <div class="form-group">
			<label for="ticketdesc">Ticket Description:</label>
   <input type="textarea" name="ticketdesc" id="ticketdesc" maxlength="50" /></div>
   <div class="form-group">
			<label for="ticketpriority">Ticket Priority:</label>
   <input type="text" name="ticketstatus" id="ticketstatus" maxlength="50" /></div>
   <div class="form-group">
			<label for="ticketstatus">Ticket Status:</label>
   <input type="text" name="tickestatus" id="ticketstatus" maxlength="50" /></div>
   <div class="form-group">
   <p>
      <input name = "search" type="submit" value="Search" />
   </p>

</form>
</section>
							
							
 </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php include_once('footer.php'); ?>

