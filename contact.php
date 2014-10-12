<?php
/**
 * Contact page
 *
 * Displays contact information and includes basic contact form
 *
 * @author  Crystal Carr
 * @package Echo/PHP
 * @since 0.0.1
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title = 'Contact Us';
include_once ('header.php'); ?>

 <div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
              <p>Please report an issues you find on the Echo website to the development team at <a href="mailto:dev@starverte.com">Star Verte LLC.</a></p>
              <p>If you are need to submit a ticket regarding a software or hardware issue please create the ticket using the <a href="ticket.php">ticket form.</a></p>
              <p>To contact the webmasters for any other reasons please contact the Star Verte LLC <a href="mailto:dev@starverte.com">here.</a></p>
            </div> <!--.entry-content -->
          </article>
        </div> <!--.row -->
      </div> <!-- #content -->
    </div> <!-- #primary -->

<?php include_once('footer.php');?>