<?php
/**
 * Functions
 *
 * All function definitions for the site
 *
 * @author  Matt Beall
 * @version 0.0.1
 */
function is_user_logged_in() {
  global $user;

  $u_id_PK = !empty($user)             ? get_user_data( $user , 'u_id_PK' ) : 0;
  $u_id    = !empty($_SESSION['u_id']) ? $_SESSION['u_id']                  : '';

  if ($u_id_PK == $u_id)
    return true;
  else
    return false;
}
