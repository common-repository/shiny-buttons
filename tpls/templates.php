<?php
if(!$templates) $templates = array();
 foreach($templates as $id=>$tpl){ $font = str_replace(" ","+",$tpl[font]); ?>   
<link href='http://fonts.googleapis.com/css?family=<?php echo $font; ?>' rel='stylesheet' type='text/css'>
 <?php } ?> 
 
    
<style type="text/css">
   .edit{
       float: right;
       background: #fff url('<?php echo plugins_url(); ?>/shiny-buttons/images/edit.png') center center no-repeat;  
       margin: 4px;
        width: 22px;
        height: 22px;
        display: block;
        text-indent: -999999px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin-right: 0px;
   }   
   .delete{
       float: right;
       background: #fff url('<?php echo plugins_url(); ?>/shiny-buttons/images/delete.png') center center no-repeat;  
       margin: 4px;
        width: 22px;
        height: 22px;
        display: block;
        text-indent: -999999px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
   }
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
       }
TID;
    echo $css;
   } ?>
   </style>
   
   <script type="text/javascript">
    function minicolorpicker(){        
         
                jQuery(".colors").miniColors({
                    
                    //change: function(hex, rgb) {
                        //jQuery("#console").prepend('HEX: ' + hex + ' (RGB: ' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')<br />');
                    //}
                    
                });

           

    }

var n = 0;
 jQuery(function() {
        //minicolorpicker();
        
        jQuery('#addcolor').click(function(){
            n++;
            var html = "<tr><td>#<input type='text' id='' style='width: 130px;' name='color1' value='' class='colors miniColors' rel='#p"+n+"' /></td><td><input type='text' style='width: 130px;' name='color' value='' id='p"+n+"' />%</td></tr>";
            jQuery('#gt').append(html);
            
            minicolorpicker();
            
        });

 });

 function generate(){
     var ff3 = 'background: -moz-linear-gradient(top, ';
     var chrome = 'background: -webkit-gradient(linear, left top, right top, ';
     var safari = 'background: -webkit-linear-gradient(left, ';
     var opera = 'background: -o-linear-gradient(left, ';
     var ie10 = 'background: -ms-linear-gradient(left, ';
     var w3c = 'background: linear-gradient(left, ';
     var iex6 = 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr= ';
     var k=0, ff3c= new Array(), chrom= new Array(), safri= new Array(), opra= new Array(), iex= new Array(), ie6, wc= new Array();
     jQuery('.color').each(function(){
         
        ie6 = "'#"+this.value+"', endColorstr='#"+this.value+"',GradientType=1"; 
                 
        wc[k] = "#"+this.value+" "+jQuery(jQuery(this).attr('rel')).val()+"%";        
         
        iex[k] = "#"+this.value+" "+jQuery(jQuery(this).attr('rel')).val()+"%";
         
        opra[k] = "#"+this.value+" "+jQuery(jQuery(this).attr('rel')).val()+"%";
        
        safri[k] = "#"+this.value+" "+jQuery(jQuery(this).attr('rel')).val()+"%";
        
        chrom[k] = "color-stop("+jQuery(jQuery(this).attr('rel')).val()+"%, #"+this.value+")";      
        
        ff3c[k] = "#"+this.value+" "+jQuery(jQuery(this).attr('rel')).val()+"%";         
       
        k++;
               
     });
     
     ff3 += ff3c.join(', ')+');';   
     chrome +=  chrom.join(', ')+');';
     safari += safri.join(', ')+');';   
     opera += opra.join(', ')+');';   
     ie10 += iex.join(', ')+');';  
      w3c += wc.join(', ')+');';     
     iex6 += ie6+');';   
     
     var css = "<style>#preview {"+ff3+chrome+safari+opera+ie10+w3c+iex6+"}</style>";
     var css1 = ff3+chrome+safari+opera+ie10+w3c+iex6;
     //alert(css);
     //jQuery('#preview').css("<style>#preview {"+ff3+chrome+safari+opera+ie10+w3c+iex6+"}</style>");
     jQuery('#preview').html(css); 
     jQuery('#preview_code').html(css1); 

 }
 </script>
   <div class="wrap">
   <div class="icon32" id="icon-plugins"><br></div>
   <h2>Templates</h2> <br>
   <div>
   <a href="http://wpeden.com/" style="margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Themes & Plugins Collection</h3><img src="http://wpeden.com/wp-content/themes/wp-eden/img/logo.png" /></a>
   <a href="http://www.wpdownloadmanager.com/" style="margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Download Manager</h3><img src="http://www.wpdownloadmanager.com/wp-content/themes/wpdm/images/icon.png" /></a>
   <a href="http://www.wpmarketplaceplugin.com/" style="margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Marketplace Plugin</h3><img vspace="12" src="http://wpmarketplaceplugin.com/wp-content/uploads/2011/06/logo2.png" /></a>
   <div style="clear: both;"></div>
   </div>
   <div style="float: left;width: 47%;"> 
   <ul id="templates">
   <?php foreach($templates as $id=>$tpl){ if($id!=''){ ?>
   <li id="<?php echo $id; ?>" class="<?php echo $id; ?>">  <?php echo $tpl['name']; ?> ( <?php echo $id;?> ). 
   <a href='#<?php echo $id;?>' class='delete'>Delete</a> 
   <a href='admin.php?page=shiny-buttons&id=<?php echo $tpl['id']; ?>' class="edit">edit</a></li>
   <?php }} $wpbtn_tpl = $templates[$_GET['id']];  ?>     
   </ul>
   
     
   </div>
   <div style="float: right;width: 50%;"> 
   <h3>New Template</h3>
   <form action="" method="post" id="wpqn">
   <input type="hidden" name="wpbtn_tpl[id]" value="<?php echo $wpbtn_tpl['id']?$wpbtn_tpl['id']:'wpbtn_id_'.uniqid();?>" />
     Name:
    <input style="font-size: 14pt;width: 100%;" type="text" name="wpbtn_tpl[name]" value="<?php echo $wpbtn_tpl['name'];?>" ><br><br>
    
    <label>Background CSS Style: <em>( you can copy exclusive css styles from <a class="thickbox" href='http://www.colorzilla.com/gradient-editor/' onclick="window.open(this.href,'','width=900,height=600,scrollbars=yes');return false;" target="_blank" style="font-weight:bold">here</a> )</em></label>
    <a class="link" style="font-weight: bold;text-decoration: underline;" onclick="jQuery('#css-generator').slideToggle();">CSS Generator</a> 
       <div style="clear: both;"></div>
       <div id="css-generator" class="wrap" style="display: none;">

    <div style="clear:both;"></div>                

    <div style="float: left;">
        
        <div style="float: left;width: 300px;">
        <h4>Gradient Generator</h4><hr noshade="noshade" size="1" />
       
       <div style="margin: 10px 0px 10px 0px;">         
       <table id="gt"><tr><td align='left' class="label">Color</td><td align='left' class="label">Position</td></tr>
         
       </table>
        &nbsp;&nbsp;&nbsp;<input type="button" value="Add new color" id="addcolor" class="button-secondary" title="Add">
        <input type="button" onclick="generate()" value="Generate" class="button-secondary">
        </div>
        </div>
        
    <div style="float: left;margin-left: 10px;">
      <h4>Preview</h4>
      <div id="preview" style="width:250px;height: 40px;border-radius:<?php echo $tpl['radius']?$tpl['radius']:'0'; ?>px;border-color: #<?php echo $tpl['border_color']?$tpl['border_color']:'ffffff'; ?>;">

      </div>
      </div>
</div>

    <div style="clear: both;"></div>
 </div> 
    <br/>
    <textarea id="preview_code"  style="width: 100%" rows="5" name="wpbtn_tpl[bg_css]"><?php echo $wpbtn_tpl['bg_css']?stripcslashes($wpbtn_tpl['bg_css']):"background: #6d0019;background: -moz-linear-gradient(top, #6d0019 0%, #a90329 74%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6d0019), color-stop(74%,#a90329));background: -webkit-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -o-linear-gradient(top, #6d0019 0%,#a90329 74%);background: -ms-linear-gradient(top, #6d0019 0%,#a90329 74%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6d0019', endColorstr='#a90329',GradientType=0 );background: linear-gradient(top, #6d0019 0%,#a90329 74%);"; ?></textarea>  
    <br clear="all" />
    <br clear="all" />
    <table cellspacing="10">
    <tr><td>
    <label>Text Color:</label><br/>
    #<input type="text" class="colors" name="wpbtn_tpl[text_color]" value="<?php echo $wpbtn_tpl['text_color']?$wpbtn_tpl['text_color']:'ffffff'; ?>" style="padding:3px 10px;width:120px;">
    </td>
    <td>
    <label>Font:</label><br/>
    <select name="wpbtn_tpl[font]">
    <option value="Michroma" <?php echo $wpbtn_tpl['font']=='Michroma'?'selected=selected':''; ?> >Michroma</option>
    <option value="Oswald" <?php echo $wpbtn_tpl['font']=='Oswald'?'selected=selected':''; ?>>Oswald</option>
    <option value="Lobster+Two" <?php echo $wpbtn_tpl['font']=='Lobster+Two'?'selected=selected':''; ?> >Lobster Two</option>
    <option value="Nixie+One" <?php echo $wpbtn_tpl['font']=='Nixie+One'?'selected=selected':''; ?> >Nixie One</option>
    <option value="Kameron" <?php echo $wpbtn_tpl['font']=='Kameron'?'selected=selected':''; ?> >Kameron</option>    
    <option value="Shadows+Into+Light" <?php echo $wpbtn_tpl['font']=='Shadows+Into+Light'?'selected=selected':''; ?> >Shadows Into Light</option>    
    <option value="Special+Elite" <?php echo $wpbtn_tpl['font']=='Special+Elite'?'selected=selected':''; ?> >Special Elite</option>
    <option value="Jura" <?php echo $wpbtn_tpl['font']=='Jura'?'selected=selected':''; ?> >Jura</option>
    <option value="Artifika" <?php echo $wpbtn_tpl['font']=='Artifika'?'selected=selected':''; ?> >Artifika</option>
    <option value="Bevan" <?php echo $wpbtn_tpl['font']=='Bevan'?'selected=selected':''; ?> >Bevan</option>
    <option value="Maven+Pro" <?php echo $wpbtn_tpl['font']=='Maven+Pro'?'selected=selected':''; ?> >Maven Pro</option>
    <option value="Tenor+Sans" <?php echo $wpbtn_tpl['font']=='Tenor+Sans'?'selected=selected':''; ?> >Tenor Sans</option>
    <option value="Metrophobic" <?php echo $wpbtn_tpl['font']=='Metrophobic'?'selected=selected':''; ?> >Metrophobic</option>
    <option value="Ultra" <?php echo $wpbtn_tpl['font']=='Ultra'?'selected=selected':''; ?> >Ultra</option>
    <option value="Muli" <?php echo $wpbtn_tpl['font']=='Muli'?'selected=selected':''; ?> >Muli</option>
    <option value="Anonymous+Pro" <?php echo $wpbtn_tpl['font']=='Anonymous Pro'?'selected=selected':''; ?> >Anonymous Pro</option>
    <option value="Paytone+One" <?php echo $wpbtn_tpl['font']=='Paytone+One'?'selected=selected':''; ?> >Paytone One</option>
    <option value="Francois+One" <?php echo $wpbtn_tpl['font']=='Francois+One'?'selected=selected':''; ?> >Francois One</option>
    <option value="Verdana" <?php echo $wpbtn_tpl['font']=='Verdana'?'selected=selected':''; ?> >Verdana</option>
    <option value="Tahoma" <?php echo $wpbtn_tpl['font']=='Tahoma'?'selected=selected':''; ?> >Tahoma</option>
    </select>
    </td>
    <td>
    <label>Font Size:</label><br/>
    <input type="text" name="wpbtn_tpl[font_size]" value="<?php echo $wpbtn_tpl['font_size']?$wpbtn_tpl['font_size']:'12'; ?>" style="padding:3px 10px;width:50px;"> pt
    </td>
    <td>
    <label>Font Weight:</label><br/>
    <select name="wpbtn_tpl[font_weight]">
    <option value="normal">Normal</option>
    <option value="bold" <?php echo $wpbtn_tpl['font_weight']=='bold'?'selected=selected':''; ?>>Bold</option>
    </select>
    </td>
    </tr>
    </table>
    
    <table cellspacing="10">
    <tr><td>
    <label>Border Color:</label><br/>
    #<input type="text" class="colors" name="wpbtn_tpl[border_color]" value="<?php echo $wpbtn_tpl['border_color']?$wpbtn_tpl['border_color']:'ffffff'; ?>" style="padding:3px 10px;width:70px;">
    </td>

    <td>
    <label>Border Radius:</label><br/>
    <input type="text" name="wpbtn_tpl[radius]" value="<?php echo $wpbtn_tpl['radius']?$wpbtn_tpl['radius']:'0'; ?>" style="padding:3px 10px;width:70px;"> px
    </td>
    <td>
    <label>Border Width:</label><br/>
    <input type="text" name="wpbtn_tpl[width]" value="<?php echo $wpbtn_tpl['width']?$wpbtn_tpl['width']:'0'; ?>" style="padding:3px 10px;width:70px;"> px
    </td>
    </tr>
    </table>
    
    <br>

    

    <input type="submit" name="do" id="btn" class="button-primary" value="<?php echo $_GET['id']?'Update Changes':'Save Changes'; ?>">
    <?php echo $_GET['id']?'<input type=button onclick="location.href=\'admin.php?page=shiny-buttons\'"  class="button-primary" value="Cancel" >':''; ?> 
    <span id="loading" style="display: none;"><img src="images/loading.gif" alt=""> saving...</span>
    </form>
    </div>    

    <script language="JavaScript">
    <!--
/*      jQuery('#wpqn').submit(function(){
           jQuery(this).ajaxSubmit({
               'url': ajaxurl+"?action=wpbtn_save_template",
               'beforeSubmit':function(){
                   jQuery('#loading').fadeIn();
               },
               'success':function(res){
                   jQuery('#loading').fadeOut();
               }
           });
      return false;
      }); */
      jQuery(function(){
         
          jQuery('a.delete').click(function(){
              var id = jQuery(this).attr('href');
              if(confirm('Are you sure?')){
                  jQuery.post(ajaxurl+'?action=delete_template&id='+jQuery(this).attr('href').replace('#',''),function(){
                     jQuery(id).fadeOut(); 
                  });
              }
              return false;
          });
          
      });
    //-->
    </script>