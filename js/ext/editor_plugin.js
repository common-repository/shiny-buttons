 
(function() {

    tinymce.create('tinymce.plugins.wpsb_tinyplugin', {

        init : function(ed, url){            
            ed.addCommand('wpsb_buttons', function() {
                                ed.windowManager.open({
                                        title: 'Shiny Buttons',
                                        file : 'admin.php?wpsb_action=wpsb_tinymce_button',
                                        height: 300,
                                        width:400,                                        
                                        inline : 1
                                }, {
                                        plugin_url : url, // Plugin absolute URL
                                        some_custom_arg : 'custom arg' // Custom argument
                                });
                        });
            
            ed.addButton('wpsb_tinyplugin', {
                title : 'Insert Button',
                cmd : 'wpsb_buttons',
                image:  url+"/images/buttons.png"
            });
        },                       

        getInfo : function() {
            return {
                longname : 'WPDC - TinyMCE Button Add-on',
                author : 'Shaon',
                authorurl : 'http://wpeden.com',
                infourl : 'http://wpeden.com',
                version : "1.0"
            };
        }
    });

    tinymce.PluginManager.add('wpsb_tinyplugin', tinymce.plugins.wpsb_tinyplugin);
    
})();
