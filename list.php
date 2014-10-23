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
<!--
<section>
  <form action="list.php" method = "post" name="searchbyticket" id="searchbyticket">
    <label for="ticket"> Ticket Search:</label>
    <input type="text" name="ticket" id ="ticket" maxlength="50" />
    <p>
      <input type="submit" value="Search" name="search" />
    </p>
  </form>
</section>
-->
<?php
$ticket=get_ticket(); ?>

<section>
    <form action="list.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
   <label for="ticketname">Ticket Name:</label>
   <input type="text" name="ticketname" id="ticketname" maxlength="50" />
   <label for="ticketdesc">Ticket Description:</label>
   <input type="text" name="ticketdesc" id="ticketdesc" maxlength="50" />
   <label for="ticketpriority">Ticket Priority:</label>
   <input type="text" name="ticketstatus" id="ticketstatus" maxlength="50" />
   <label for="ticketstatus">Ticket Status:</label>
   <input type="text" name="tickestatus" id="ticketstatus" maxlength="50" />

   <p>
      <input name = "search" type="submit" value="Search" />
   </p>

</form>
</section>

<?php
$ticketname = $_POST['tkt_name'];
$ticketdesc = $_POST['tkt_desc'];
$ticketpriority = $_POST['tkt_priority'];
$ticketstatus = $PST['tkt_status'];


$ticketname = preg_replace("/[^a-zA-Z0-9\s]/", '', $ticketname);
$ticketdesc = preg_replace("/[^a-zA-Z0-9\s]/", '', $ticketdesc);
$ticketpriority = preg_replace("/[^a-zA-Z0-9\s]/", '', $ticketpriority);
$ticketstatus = preg_replace("/[^a-zA-Z0-9\s]/", '', $ticketstatus);


$heading = <<<ABC
You searched for<br />
Ticket Name: '$ticketname' <br />
Ticket Description: '$ticketdesc' <br />
Ticket Priority: '$ticketpriority' <br />
Ticket Status: '$ticektstatus'
ABC;


echo $heading;
?>

<!--
$tickets = getTicketByMultiCriteria($ticketname, $ticketdesc, $ticketpriority, $ticketstatus);

$matchingRecords = count($tickets);

echo "<section>";

if ($matchingRecords == 0)
{
   echo "<h3>No matches found for the search term(s)</h3>";
}
else
{

$output = <<<ABC
<table>
   <caption>$matchingRecords tickets(s) found</caption>
   <tbody>
ABC;

    foreach ($movieList as $movie)
    {
        extract($movie);
        $movieNum ++;
        $dateReleased = date_format(new DateTime($dateintheaters), "F j, Y");
        $output .= <<<ABC
        <tr>
            <td>$movieNum: $movietitle<br />
                $pitchtext
            </td>
            <td>
               Released: $dateReleased
            </td>
        </tr>
        <tr>
            <td colspan="2">
                $summary
            </td>
        </tr>
ABC;
    }

    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="d4search2.php">[Back to Search Page]</a>
</p></section>
ABC;

echo $output;
-->


 </div><!-- .entry-content -->
          </article>
        </div><!-- .row -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php include_once('footer.php'); ?>

