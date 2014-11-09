<?php
/**
 * Defines class E_Tag and related functions
 *
 * @author Matt Beall
 */

/**
 * Tag class
 *
 * Connects to database and creates tag object.
 *
 * @author Matt Beall
 * @since 0.2.0
 */
class E_Tag {

  /**
   * @var int $tag_id_PK The ID of the tag
   */
  public $tag_id_PK;

  /**
   * @var string $tag_name The name of the tag
   */
  public $tag_name = '';

  /**
   * @var string $tag_color The text color of the tag
   */
  public $tag_color = 'ffffff';

  /**
   * @var string $tag_bg The background color of the tag
   */
  public $tag_bg = '777777';

  /**
   * Construct E_Tag object
   *
   * Takes PDO and constructs E_Tag class
   *
   * @since 0.0.4
   *
   * @param  object $tags The PHP Data Object
   */
  public function __construct( $tags ) {
    foreach ( $tags as $tag ) {
      get_class($tag);
      foreach ( $tag as $key => $value )
        $this->$key = $value;
    }
  }

  /**
   * Execute query
   *
   * Attempt to connect to database and execute SQL query
   * If successful, return results.
   *
   * @since 0.0.4
   *
   * @uses edb::connect()
   * @throws PDOException if connection or query cannot execute
   *
   * @param  string $query The SQL query to be executed
   * @return object        Data retrieved from database
   * @var    string $conn  The PHP Data Object
   */
  public static function query( $query ) {
    global $edb;
    $conn = $edb->connect();
    try {
      $query = $conn->query($query);
      do {
        if ($query->columnCount() > 0) {
            $results = $query->fetchAll(PDO::FETCH_OBJ);
        }
      }
      while ($query->nextRowset());

      $conn = null;

      return $results;
    }
    catch (PDOException $e) {
      $conn = null;
      die ('Query failed: ' . $e->getMessage());
    }
  }

  /**
   * Get tag information from database
   *
   * Prepare and execute query to select tag from database
   *
   * @since 0.2.0
   *
   * @uses self::query()
   *
   * @param  int    $tag_id_PK The primary key of the tag being retrieved from the database
   * @return object            Data retrieved from database
   * @var    string $conn      The PHP Data Object for the connection
   */
  public static function get_instance( $tag_id_PK ) {
    global $edb;

    $tag_id_PK = (int) $tag_id_PK;

    if ( ! $tag_id_PK )
      return false;

    $_tag = self::query("SELECT * FROM tags WHERE tag_id_PK = $tag_id_PK LIMIT 1");

    return new E_Tag ( $_tag );
  }

  /**
   * Insert tag in database
   *
   * Prepare and execute query to create tag in tags table
   *
   * @since 0.2.0
   *
   * @uses edb::insert()
   * @uses _text()
   * @uses _hexadec()
   *
   * @param string $tag_name  The name of the tag
   * @param string $tag_color The text color of the tag
   * @param string $tag_bg    The background color of the tag
   *
   * @return void
   *
   * @var int $tag_id_PK The primary key of the tag being registered, as created in tag database
   */
  public static function new_instance( $tag_name, $tag_color = null, $tag_bg = null ) {
    global $edb;

    $tag_name  = _text( $tag_name, 32 );
    $tag_color = !empty($tag_color) ? _hexadec($tag_color) : 'ffffff';
    $tag_bg    = !empty($tag_bg)    ? _hexadec($tag_bg)    : '777777';

    $edb->insert('tags', 'tag_name,tag_color,tag_bg', "'$tag_name', '#$tag_color', '#$tag_bg'" );
  }

  /**
   * Update tag in database
   *
   * Prepare and execute query to create tag in tags table
   *
   * @since 0.2.0
   *
   * @uses edb::insert()
   * @uses _text()
   * @uses _hexadec()
   *
   * @param int    $tag_id_PK   The ID of the tag to update
   * @param string $tag_name    The name of the tag
   * @param string $tag_color   The text color of the tag
   * @param string $tag_bg      The background color of the tag
   *
   * @return void
   *
   * @var int $tag_id_PK The primary key of the tag being registered, as created in tag database
   */
  public static function set_instance( $tag_id_PK, $tag_name = null, $tag_color = null, $tag_bg = null ) {
    global $edb;

    $tag_id_PK = (int) $tag_id_PK;

    $_tag = self::get_instance( $tag_id_PK );

    $tag_name    = !empty($tag_name)  ? _text( $tag_name, 32 ) : $_tag->tag_name;
    $tag_color   = !empty($tag_color) ? _hexadec($tag_color)   : $_tag->tag_color;
    $tag_bg      = !empty($tag_bg)    ? _hexadec($tag_bg)      : $_tag->tag_bg;

    $edb->update('tags', "tag_name = '$tag_name', tag_color = '#$tag_color', tag_bg = '#$tag_bg'", "tag_id_PK = $tag_id_PK" );
  }
}

/**
 * Insert tag into database
 *
 * @since 0.0.4
 *
 * @uses E_Tag::new_instance() Constructs E_Tag class and inserts into database
 *
 * @param string $tag_name  The name of the tag
 * @param string $tag_color The text color of the tag
 * @param string $tag_bg    The background color of the tag
 */
function create_tag( $tag_name, $tag_color = null, $tag_bg = null ) {
  $tag = E_Tag::new_instance( $tag_name, $tag_color, $tag_bg );
  return $tag;
}

/**
 * Update tag in database
 *
 * @since 0.2.0
 *
 * @uses E_Tag::set_instance() Constructs E_Tag class and updates in database
 *
 * @param int    $tag_id_PK    The ID of the tag to update
 * @param string $tag_name  The name of the tag
 * @param string $tag_color The text color of the tag
 * @param string $tag_bg    The background color of the tag
 */
function update_tag( $tag_id_PK, $tag_name = null, $tag_color = null, $tag_bg = null ) {
  $tag = E_Tag::set_instance( $tag_id_PK, $tag_name, $tag_color, $tag_bg );
  return $tag;
}

/**
 * Create E_Tag class
 *
 * @since 0.2.0
 *
 * @uses E_Tag::get_instance() Constructs E_Tag class and gets class object
 *
 * @param  int    $tag_id_PK The ID of the tag to get
 * @return object $tag The E_Tag class with the tag's data
 */
function get_tag( $tag_id_PK ) {
  $tag_id_PK = (int) $tag_id_PK;
  $tag = E_Tag::get_instance( $tag_id_PK );
  return $tag;
}

/**
 * Get specific data from a tag object
 *
 * @since 0.0.4
 *
 * @param  object $tag The E_Tag class containing the data for a tag
 * @param  string $key  The name of the field to be retrieved
 * @return mixed        The value of the data retreived
 */
function get_tag_data( $tag, $key ) {
  if (!empty($tag))
    return $tag->$key;
  else
    echo 'ERROR: There is no data in the tag object.';
    die;
}

/**
 * Get the name of the tag
 *
 * @since 0.0.4
 *
 * @uses get_tag_data()
 *
 * @param  object $tag      The E_Tag class containing the data for the tag
 * @return string           The name of the tag
 * @var    string $tag_name The name of the tag
 */
function get_tag_name( $tag ) {
  $tag_name = get_tag_data( $tag , 'tag_name' );
  return $tag_name;
}

/**
 * Get the text color of the tag
 *
 * @since 0.0.4
 *
 * @uses get_tag_data()
 *
 * @param  object $tag       The E_Tag class containing the data for the tag
 * @return string            The text color of the tag
 * @var    string $tag_color The text color of the tag
 */
function get_tag_color( $tag ) {
  $tag_color = get_tag_data( $tag , 'tag_color' );
  return $tag_color;
}

/**
 * Get the background color of the tag
 *
 * @since 0.0.4
 *
 * @uses get_tag_data()
 *
 * @param  object $tag    The E_Tag class containing the data for the tag
 * @return string         The background color of the tag
 * @var    string $tag_bg The background color of the tag
 */
function get_tag_bg( $tag ) {
  $tag_bg = get_tag_data( $tag , 'tag_bg' );
  return $tag_bg;
}
