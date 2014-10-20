<?php
/**
 * Functions
 *
 * All function definitions for the site
 *
 * @author Matt Beall
 * @since 0.0.3
 */

/**
 * Checks to see if a particular user is logged in
 *
 * @since 0.0.3
 *
 * @uses get_user_data() Gets ID of user object
 * @uses is_logged_in() Checks to see if anyone is logged in
 *
 * @param object $_user The user to check against
 * @return bool
 * @var int $u_id_PK The ID of the user object
 * @var int $u_id    The ID of the user logged in
 */
function is_user_logged_in( $_user ) {
  if (is_logged_in()) {
    $u_id_PK = !empty($_user) ? get_user_data( $_user , 'u_id_PK' ) : 0;
    $u_id    = (int) $_SESSION['u_id'];

    if ($u_id_PK == $u_id)
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
 * @since 0.0.3
 *
 * @uses get_user() Gets user object to make sure user actually exists
 *
 * @return bool
 * @var    int    $u_id  The ID of the user logged in
 * @var    object $_user The user object with the ID of the user logged in
 *
 * @todo Do additional checks besides just if the id exists
 */
function is_logged_in() {
  if (!empty($_SESSION['u_id'])) {
    global $edb;
    $u_id = (int) $_SESSION['u_id'];
    $_user = get_user($u_id);

    if (!empty($_user))
      return true;
    else
      return false;
  }
  else {
    return false;
  }
}

/**
 * Check to see if the user is logged in as an administrator
 *
 * @since 0.0.3
 *
 * @uses is_logged_in()  Check to see if anyone is even logged in
 * @uses is_user_admin() Check to see if the user logged in is an admin
 *
 * @return bool
 * @var    int    $u_id  The ID of the user logged in
 * @var    object $_user The user object with the ID of the user logged in
 */
function is_admin() {
  if (is_logged_in()) {
    $u_id = (int) $_SESSION['u_id'];
    $_user = get_user($u_id);

    if (is_user_admin($_user))
      return true;
    else
      return false;
  }
  else {
    return false;
  }
}
