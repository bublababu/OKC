<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



/* load the MX_Router class */

require APPPATH."third_party/MX/Router.php";



class MY_Router extends MX_Router {
   
FUNCTION _SET_REQUEST($SEG = ARRAY()) {
// THE STR_REPLACE() BELOW GOES THROUGH ALL OUR SEGMENTS
// AND REPLACES THE HYPHENS WITH UNDERSCORES MAKING IT
// POSSIBLE TO USE HYPHENS IN CONTROLLERS, FOLDER NAMES AND
// FUNCTION NAMES
PARENT::_SET_REQUEST(STR_REPLACE('-', '_', $SEG));
}
}