<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
/** 
 * Layouts Class. PHP5 only. 
 * 
 */
class Layouts { 
    
  // Will hold a CodeIgniter instance 
  private $CI; 
    
  // Will hold a title for the page, NULL by default 
  private $title_for_layout = NULL; 
    
  // The title separator, ' | ' by default 
  private $title_separator = ' | '; 
    
  public function __construct()  
  {
    $this->CI =& get_instance(); 
  } 
    
  public function set_title($title) 
  { 
    $this->title_for_layout = $title;
  } 
    
  public function view($params = array(), $layout = 'default', $layout_data = []) 
  {
    // Handle the site's title. If NULL, don't add anything. If not, add a
    // echo $params['view'];
    // exit;
    // Load the view's content, with the params passed

    $content = [];
    foreach($params as $key=>$val){
      $content[$key] = $this->CI->load->view($val['path'], $val['data'], TRUE); 
    }

    // foreach($layout_data as $key=>$val){
    //   $content[$key] = $this->CI->load->view($val['path'], $val['data'], TRUE); 
    // }
    if(!empty($layout_data)){
      $content = array_merge($content,$layout_data);
    }

    // echo "<pre>"; print_r($content); exit;

    // Now load the layout, and pass the view we just rendered 
    $this->CI->load->view('laytous/' . $layout, $content);
  }

  public function add_include($path, $prepend_base_url = TRUE) 
  {
    if ($prepend_base_url)
    {
      $this->CI->load->helper('url'); // Load this just to be sure 
      $this->file_includes[] = base_url() . $path; 
    } else { 
      $this->file_includes[] = $path; 
    } 
  
    return $this; // This allows chain-methods 
  } 
  
  public function print_includes()
  { 
    // Initialize a string that will hold all includes 
    $final_includes = ''; 
  
    foreach ($this->includes as $include) 
    { 
      // Check if it's a JS or a CSS file 
      if (preg_match('/js$/', $include)) 
      { 
        // It's a JS file 
        $final_includes .= '<script type="text/javascript" src="' . $include . '"></script>'; 
      } 
      elseif (preg_match('/css$/', $include)) 
      { 
        // It's a CSS file 
        $final_includes .= '<link href="' . $include . '" rel="stylesheet" type="text/css" />'; 
      } 
  
      return $final_includes; 
    } 
  } 
}