<?php

$templates = get_option('_wpbtn_templates');
 
add_filter('mce_external_plugins', "wpsb_tinyplugin_register");
add_filter('mce_buttons', 'wpsb_tinyplugin_add_button', 0);
 
function wpsb_tinyplugin_add_button($buttons)
{
    array_push($buttons, "separator", "wpsb_tinyplugin");
    return $buttons;
}

function wpsb_tinyplugin_register($plugin_array)
{
    $url = plugins_url("/shiny-buttons/js/ext/editor_plugin.js");

    $plugin_array['wpsb_tinyplugin'] = $url;
    return $plugin_array;
}


function wpsb_free_tinymce(){
    $templates = get_option('_wpbtn_templates');
    global $wpdb;
    if($_GET['wpsb_action']!='wpsb_tinymce_button') return false;
    ?>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title>Shiny Buttons</title>
<style type="text/css">
*{font-family: Tahoma !important; font-size: 9pt; letter-spacing: 1px;}
select,input{padding:5px;font-size: 9pt !important;font-family: Tahoma !important; letter-spacing: 1px;margin:5px;}
.button{
    background: #7abcff; /* old browsers */

background: -moz-linear-gradient(top, #7abcff 0%, #60abf8 44%, #4096ee 100%); /* firefox */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7abcff), color-stop(44%,#60abf8), color-stop(100%,#4096ee)); /* webkit */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* ie */
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
border:1px solid #FFF;
color: #FFF;
}
 
.input{
 width: 340px;   
 background: #EDEDED; /* old browsers */

background: -moz-linear-gradient(top, #EDEDED 24%, #fefefe 81%); /* firefox */

background: -webkit-gradient(linear, left top, left bottom, color-stop(24%,#EDEDED), color-stop(81%,#fefefe)); /* webkit */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#EDEDED', endColorstr='#fefefe',GradientType=0 ); /* ie */
border:1px solid #aaa; 
color: #000;
}
.button-primary{cursor: pointer;}
fieldset{padding: 10px;}
</style> 
<?php
if(!$templates) $templates = array();
 foreach($templates as $id=>$tpl){ $font = str_replace(" ","+",$tpl[font]); ?>   
<link href='http://fonts.googleapis.com/css?family=<?php echo $font; ?>' rel='stylesheet' type='text/css'>
 <?php } ?> 
 
    
<style type="text/css">
    
   .inm{
       padding-left: 10px;
       color: #008000;
       font-weight: bold;
   }
   #templates li{
       min-height: 30px;
       margin-bottom: 10px;
   }
   .link:hover{
      cursor:pointer; 
   }
   <?php foreach($templates as $id=>$tpl){ 
       $tpl[bg_css] = stripcslashes($tpl[bg_css]);
       $tpl[font] = str_replace("+"," ",$tpl[font]);
       $css=<<<TID
       
        
       .{$id}{
           $tpl[bg_css]
           color: #{$tpl[text_color]} !important;
           font-family: '$tpl[font]' !important;
           font-size: 9pt !important;
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
            display:block;
            width:300px;
       }
TID;
    echo $css;
   } ?>
   </style>
</head>
<body>    <br>

<fieldset><legend>Insert Button</legend>
    <div style="height: 200px;overflow: auto;"> 
   <ul id="templates">
   <?php foreach($templates as $id=>$tpl){ if($id!=''){ ?>
   <li id="<?php echo $id; ?>" class="<?php echo $id; ?>"><input type="radio" onclick="jQuery('#template').val(this.value);" name="template" value="<?php echo $id; ?>"> <?php echo $tpl['name']; ?></li>
   <?php }} $wpbtn_tpl = $templates[$_GET['id']];  ?>     
   </ul>
   <input type="hidden" id="template" />
     
   </div>
   Type
   <select id="type">
   <option value="link">Link</option>
   <option value="button">Button</option>
   </select>
 
    <input type="submit" id="addtopost" class="button button-primary" name="addtopost" value="Insert into post" />
</fieldset>   <br>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo home_url('/wp-includes/js/tinymce/tiny_mce_popup.js'); ?>"></script>
                <script type="text/javascript">
                    /* <![CDATA[ */                    
                    jQuery('#addtopost').click(function(){
                    var win = window.dialogArguments || opener || parent || top;     
                    if(jQuery('#type').val()=='link')           
                    win.send_to_editor('[shiny_button type="link" url="Enter URL Here" label="Enter your label here" template="'+jQuery('#template').val()+'"]');
                    if(jQuery('#type').val()=='button')           
                    win.send_to_editor('[shiny_button type="button" label="Enter your label here" template="'+jQuery('#template').val()+'"]');
                    tinyMCEPopup.close();
                    return false;                   
                    });
                    
                    /*
                    jQuery('#addtopostc').click(function(){
                    var win = window.dialogArguments || opener || parent || top;                
                    win.send_to_editor('{wpsb_category='+jQuery('#flc').val()+'}');                   
                    tinyMCEPopup.close();
                    return false;                   
                    });  
                    */          
                  
                </script>

</body>    
</html>
    
    <?php
    
    die();
}
 

add_action('init', 'wpsb_free_tinymce');

