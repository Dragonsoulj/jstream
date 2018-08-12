<?php

class JS_System_Activator {
  public static function activate() {
    $add_post_default = array( 'flooring' );
    update_post_meta( 1, 'js_system_allow_post', serialize( $add_post_default ) );
  }
}
