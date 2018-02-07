<?php
 /**
  *  WpApiFeaturedImage
  *
  *  Adds featured images to the products endpoint
  *  using register_rest_field hook.
  *
  *  @version   1.0
  *  @author    stephen scaff
  */

 class WpApiFeaturedImage {

   /**
    * The endpoints we want to target
    */
   public $target_endpoints = '';

   /**
    * Constructor
    * @uses rest_api_init
    */
   function __construct() {
     $this->target_endpoints = array('product', 'post');
     add_action( 'rest_api_init', array( $this, 'add_image' ));
   }


   /**
    * Add Images to json api
    */
   function add_image() {

     /**
      * Add 'featured_image'
      */
     register_rest_field( $this->target_endpoints, 'featured_image',
        array(
          'get_callback'    => array( $this, 'get_image_url_full'),
          'update_callback' => null,
          'schema'          => null,
        )
      );

      /**
       * Add 'featured_image_thumbnail'
       */
      register_rest_field( $this->target_endpoints, 'featured_image_thumbnail',
         array(
           'get_callback'    => array( $this, 'get_image_url_thumb'),
           'update_callback' => null,
           'schema'          => null,
         )
       );
    }

  /**
   * Get Image: Thumb
   */
  function get_image_url_thumb(){
    $url = $this->get_image('thumbnail');
    return $url;
  }

  /**
   * Get Image: Full
   */
  function get_image_url_full(){
    $url = $this->get_image('full');
    return $url;
  }

  /**
   * Get Image Helpers
   */
  function get_image($size) {
    $id = get_the_ID();

    if ( has_post_thumbnail( $id ) ){
        $img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
        $url = $img_arr[0];
        return $url;
    } else {
        return false;
    }
  }
}

 new WpApiFeaturedImage;
