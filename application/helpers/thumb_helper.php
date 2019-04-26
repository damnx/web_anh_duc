<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Thumb()
 * A TimThumb-style function to generate image thumbnails on the fly.
 *
 * @author Darren Craig
 * @author Lozano Hernán <hernantz@gmail.com>
 * @access public
 * @param string $src
 * @param int $width
 * @param int $height
 * @param string $image_thumb
 * @return String
 *
 */

// $image= "https://photo2.tinhte.vn/data/attachment-files/2019/04/4627926_cover_tinhte_dadabots_death_metal.jpg";   
// $data = file_get_contents($image);
// /*store image in server*/
// $new  = "statics/upload/test.jpg";
// /*Write the contents back to a new file*/
// file_put_contents($new, $data);
// $config['image_library'] = 'gd2';
// $config['source_image'] = $new;
// $config['create_thumb'] = TRUE;
// $config['maintain_ratio'] = TRUE;
// $config['width']    = 368;
// $config['height']   = 230;
// $config['new_image'] = FCPATH."statics/upload/thumb/";
// $config['thumb_marker'] = '_thumb';
// $this->load->library('image_lib', $config); 
// $this->image_lib->resize();

// die();



function thumb($src, $width, $height) {
	// Get the CodeIgniter super object
	$CI = &get_instance();
	// get src file's dirname, filename and extension
    $path = pathinfo($src);
   
	// Path to image thumbnail
	if( !$image_thumb )
        $image_thumb = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . $height . '_' . $width . "." . $path['extension'];
	if ( !file_exists($image_thumb) ) {
		// LOAD LIBRARY
		$CI->load->library('image_lib');
		// CONFIGURE IMAGE LIBRARY
		$config['source_image'] = $src;
		$config['new_image'] = $image_thumb;
		$config['width'] = $width;
		$config['height'] = $height;
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
		// get our image attributes
		list($original_width, $original_height, $file_type, $attr) = getimagesize($image_thumb);
		// set our cropping limits.
		$crop_x = ($original_width / 2) - ($width / 2);
		$crop_y = ($original_height / 2) - ($height / 2);
		
		// initialize our configuration for cropping
		$config['source_image'] = $image_thumb;
		$config['new_image'] = $image_thumb;
		$config['x_axis'] = $crop_x;
		$config['y_axis'] = $crop_y;
		$config['maintain_ratio'] = FALSE;
		$CI->image_lib->initialize($config);
		$CI->image_lib->crop();
		$CI->image_lib->clear();
		
    }
    
	return basename($image_thumb);
}
/* End of file thumb_helper.php */
/* Location: ./application/helpers/thumb_helper.php */