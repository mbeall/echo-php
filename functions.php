<?php
/**
 * Functions
 *
 * All function definitions for the site
 *
 * @author Matt Beall
 */

/**
 * Checks to see if a particular moderator is logged in
 *
 * @since 0.2.0
 *
 * @uses get_moderator_data() Gets ID of moderator object
 * @uses is_logged_in() Checks to see if anyone is logged in
 *
 * @param object $_moderator The moderator to check against
 * @return bool
 * @var int $mod_id_PK The ID of the moderator object
 * @var int $mod_id_PK    The ID of the moderator logged in
 */
function is_moderator_logged_in( $_moderator ) {
  if (is_logged_in()) {
    $mod_id_PK = !empty($_moderator) ? get_moderator_data( $_moderator , 'mod_id_PK' ) : 0;
    $mod_id_PK    = (int) $_SESSION['mod_id_PK'];

    if ($mod_id_PK == $mod_id_PK)
      return true;
    else
      return false;
  }
  else {
    return false;
  }
}

/**
 * Checks to see if anyone is logged in
 *
 * @since 0.2.0
 *
 * @uses get_moderator() Gets moderator object to make sure moderator actually exists
 *
 * @return bool
 * @var    int    $mod_id_PK  The ID of the moderator logged in
 * @var    object $_moderator The moderator object with the ID of the moderator logged in
 *
 * @todo Do additional checks besides just if the id exists
 */
function is_logged_in() {
  if (!empty($_SESSION['mod_id_PK'])) {
    global $edb;
    $mod_id_PK = (int) $_SESSION['mod_id_PK'];
    $_moderator = get_moderator($mod_id_PK);

    if (!empty($_moderator))
      return true;
    else
      return false;
  }
  else {
    return false;
  }
}

/**
 * Sanitize input to hexadecimal value
 *
 * First, checks to make sure that string only contains 0-9 and lowercase a-f.
 * Then, checks to make sure length is either 6 or 3 (shorthand).
 * If longer than 6, truncates to 6. If less than 6 and not 3, returns nothing.
 *
 * @since 0.2.0
 *
 * @param  string      $string The string to sanitize
 * @return string|void
 * @var    string      $new The sanitized string
 * @var    int         $len The length of $str
 */
function _hexadec( $string ) {
  $new = preg_replace( '/#/', '', preg_replace( '[^0-9a-f]', '', strtolower($string) ) );
  $len = strlen($new);

  if ($len == 6 | $len == 3)
    return $new;
  elseif ($len > 6)
    return substr($new,0,6);
  else
    return;
}

/**
 * Sanitize text input and trim to size
 *
 * First, make sure only numbers and letters are used.
 * Next, if length is specificied, trim to length.
 *
 * @since 0.0.4
 *
 * @param  string $text The string to sanitize
 * @param  int    $length The length of the string
 * @return string
 * @var    string $new The sanitized string
 */
function _text( $text, $length = 0 ) {
  $new = preg_replace( '[^0-9a-fA-F]', '', $text);

  $length = (int) $length;

  if ( $length != 0 )
    return substr($new, 0, $length);
  else
    return $new;
}

/**
 * Sanitize email input and trim to size
 *
 * First, make sure string is an email address.
 * Next, if length is specificied, trim to length.
 *
 * @since 0.0.4
 *
 * @param  string $email The string to sanitize
 * @param  int    $length The length of the string
 * @return string
 * @var    string $new The sanitized string
 */
function _email( $email, $length = 0 ) {
  $new = filter_var($email, FILTER_VALIDATE_EMAIL);

  $length = (int) $length;

  if ( $length != 0 )
    return substr($new, 0, $length);
  else
    return $new;
}

/**
 * Get all tickets
 *
 * Get all tickets or get tickets that match
 * specified criteria.
 *
 * @since 0.2.0
 *
 * @param  string $match The search condition
 * @param  bool   $join  If yes, join with ticket_tags table.
 * @param  array  $args  Additional options
 * @return array         An array of E_Ticket objects
 */
function get_tickets( $match = NULL, $join = false, $args = array() ) {
  global $edb;

  /**
   * Default parameters for select statement
   *
   * @param string $groupby Group by expression
   * @param string $having  Search condition for group
   * @param string $orderby Order expression
   * @param string $order   Ascending or descending ('ASC' or 'DESC')
   */
  $defaults = array(
    'groupby' => '',
    'having'  => '',
    'orderby' => 'tkt_priority',
    'order'   => 'DESC',
  );

  /**
   * Parse connection arguments
   */
  $args = array_merge( $defaults, $args );

  $match = !empty($match) ? $match : "tkt_status = 'open'";
  if ($join) {
    $results = $edb->select( 'tickets LEFT JOIN ticket_tags ON tkt_id_PK = tkt_id_FK', '*', $match, $args );
  }
  else {
    $results = $edb->select( 'tickets', '*', $match, $args );
  }
  return $results;
}

/**
 * Get all tags
 *
 * @since 0.2.0
 *
 * @return array An array of E_Tag objects
 */
function get_tags() {
  global $edb;
  $results = $edb->select( 'tags', '*' );
  return $results;
}
