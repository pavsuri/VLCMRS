<?php namespace Util;

abstract class Obj {

  /**
   * Convert an Object to an Array.
   * Source: https://coderwall.com/p/8mmicq
   *
   * @param  object $d object to convert
   * @return array    array build from object
   */
  public static function objectToArray($d)
  {
    return json_decode(json_encode($d), true);
  }

  /**
   * Convert to Array to an Object.
   * Source: http://stackoverflow.com/a/21650726/3756480
   *
   * @param  array $d array to convert
   * @return object    object built from array
   */
  public static function arrayToObject($array) {
    $resultObj = new \stdClass;
    $resultArr = array();
    $hasIntKeys = false;
    $hasStrKeys = false;
    foreach ( $array as $k => $v ) {
        if ( !$hasIntKeys ) {
            $hasIntKeys = is_int( $k );
        }
        if ( !$hasStrKeys ) {
            $hasStrKeys = is_string( $k );
        }
        if ( $hasIntKeys && $hasStrKeys ) {
            $e = new \Exception( 'Current level has both integer and string keys, thus it is impossible to keep array or convert to object' );
            $e->vars = array( 'level' => $array );
            throw $e;
        }
        if ( $hasStrKeys ) {
            $resultObj->{$k} = is_array( $v ) ? self::arrayToObject( $v ) : $v;
        } else {
            $resultArr[$k] = is_array( $v ) ? self::arrayToObject( $v ) : $v;
        }
    }
    return ($hasStrKeys) ? $resultObj : $resultArr;
  }

}
