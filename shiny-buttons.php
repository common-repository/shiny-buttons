<?php 
/*
Plugin Name: Shiny Buttons
Plugin URI: http://wpeden.com/
Description: Shiny Buttons will help you to generate CSS3 Button from you wordpress admin simple using GUI, no need to write any css code
Author: Shaon
Version: 1.1.0
Author URI: http://www.wpeden.com/
*/
 
include("libs/class.plugin.php");
global $sb_plugin;
$sb_plugin = new ahm_plugin('shiny-buttons');


$plugindir = str_replace('\\','/',dirname(__FILE__));
 

define('PLUGINDIR',$plugindir);  


function wpbtn_save_template(){
    if($_POST['wpbtn_tpl']['id']!=''){
       $templates = get_option('_wpbtn_templates'); 
       $templates[$_POST['wpbtn_tpl']['id']] = $_POST['wpbtn_tpl'];
       update_option('_wpbtn_templates',$templates);
       $fonts = array(); 
       foreach($templates as $id=>$tpl){ 
       $tpl[bg_css] = stripcslashes($tpl[bg_css]);
       $fonts[] = $tpl[font];
       $tpl[font] = str_replace("+"," ",$tpl[font]);
       $css .=<<<TID
         
       .{$id}{
           $tpl[bg_css]
           color: #{$tpl[text_color]} !important;
           font-family: '$tpl[font]' !important;
           font-size: {$tpl[font_size]}pt !important;
           font-weight: $tpl[font_weight] !important;
           border-color: #{$tpl[border_color]} !important;
           border-width: {$tpl[width]}px !important;
           border-style: solid;                      
           line-height:30px;
           text-align:center;
            -moz-box-shadow: 0 0 5px #888;
            -webkit-box-shadow: 0 0 5px #888;
            box-shadow: 0 0 5px #888;
            z-index:999999;
            -webkit-border-radius: {$tpl[radius]}px;
            -moz-border-radius: {$tpl[radius]}px;
            border-radius: {$tpl[radius]}px;
            padding:5px 10px;
       }
TID;
   }
       $fonts = '@import url("http://fonts.googleapis.com/css?family='.implode('|',$fonts).'");';
       file_put_contents(dirname(__FILE__).'/css/site/shiny-buttons.css',$fonts.$css); 
       header("location: admin.php?page=shiny-buttons");
       die();
    }
}

function wpbtn_delete_template(){

       $templates = get_option('_wpbtn_templates'); 
       unset($templates[$_GET['id']]);
       update_option('_wpbtn_templates',$templates);
       foreach($templates as $id=>$tpl){ 
       $tpl[bg_css] = stripcslashes($tpl[bg_css]);
       $fonts[] = $tpl[font];
       $tpl[font] = str_replace("+"," ",$tpl[font]);       
       $css .=<<<TID
         
       .{$id}{
           $tpl[bg_css]
           color: #{$tpl[text_color]} !important;
           font-family: '$tpl[font]' !important;
           font-size: {$tpl[font_size]}pt !important;
           font-weight: $tpl[font_weight] !important;
           border-color: #{$tpl[border_color]} !important;
           border-width: {$tpl[width]}px !important;
           border-style: solid;                      
           line-height:30px;
           text-align:center;
            -moz-box-shadow: 0 0 5px #888;
            -webkit-box-shadow: 0 0 5px #888;
            box-shadow: 0 0 5px #888;
            z-index:999999;
            -webkit-border-radius: {$tpl[radius]}px;
            -moz-border-radius: {$tpl[radius]}px;
            border-radius: {$tpl[radius]}px;
            padding:5px 10px;
       }
TID;
   }
       $fonts = '@import url("http://fonts.googleapis.com/css?family='.implode('|',$fonts).'");';
       file_put_contents(dirname(__FILE__).'/css/site/shiny-buttons.css',$fonts.$css); 

} 

function wpbtn_templates(){
    $templates = get_option('_wpbtn_templates');
    include("tpls/templates.php");
}

 
function wpsb_showbutton($params){
    extract($params);
    if($type=='link')
    return "<a href='$url' class='$template'>$label</a>";
    if($type=='button')
    return "<input type='button' class='$template' value='$label' />";
    
}

function wpbtn_menu(){
    add_menu_page( 'Shiny Buttons', 'Shiny Buttons', 'administrator', 'shiny-buttons', 'wpbtn_templates');    
    
}

wp_enqueue_script("jquery");
if(is_admin()){
 add_action("admin_menu","wpbtn_menu");
 
} 
 
$sb_plugin->load_scripts(); 
$sb_plugin->load_styles(); 
$sb_plugin->load_modules(); 

 
add_action('init', 'wpbtn_save_template'); 
add_action('wp_ajax_delete_template', 'wpbtn_delete_template'); 
add_shortcode('shiny_button',"wpsb_showbutton");