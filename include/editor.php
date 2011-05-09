<?php

if(@include(_CAL_BASE_PATH_."customize/editor.php")) return;

$_cal_editor_attrib = "mce_editable='true'";


echo('

    <script type="text/javascript" src="'._CAL_BASE_URL_.'include/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    tinyMCE.init({
        theme : "advanced",
        language : "'.substr(_CAL_LANG_,0,2) .'",
        mode : "specific_textareas",
        document_base_url : "'._CAL_BASE_URL_.'",
        relative_urls : false,
        remove_script_host : false,
        save_callback : "TinyMCE_Save",
        invalid_elements : "script,applet,iframe",
        theme_advanced_toolbar_location : "top",
        theme_advanced_source_editor_height : "550",
        theme_advanced_source_editor_width : "750",
        directionality: "ltr",
        force_br_newlines : "false",
        content_css : "'._CAL_BASE_URL_.'include/tinymce/jscripts/tiny_mce/themes/advanced/css/editor_content.css",
        debug : false,
        cleanup : true,
        safari_warning : false,
        theme_advanced_buttons3 : "",
        plugins : "advlink,advimage,preview,searchreplace,advhr,fullscreen'.
	(@constant("_CAL_WYSIWYG_TABLES_") ? ',table' : '') .'",
        theme_advanced_disable : "styleselect,help,sub,sup",
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
        theme_advanced_buttons2_add : "hr,removeformat,preview,separator,forecolor,backcolor",'.
	(@constant("_CAL_WYSIWYG_TABLES_") ? '
	theme_advanced_buttons3 : "tablecontrols",
' : '') .'
        plugin_preview_width : "750",
        plugin_preview_height : "550",
        extended_valid_elements : "a[name|href|target|title|onclick], img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name], ,hr[class|width|size|noshade]",
        fullscreen_settings : {
            theme_advanced_path_location : "top"
        }
    });
    function TinyMCE_Save(editor_id, content, node)
    {
        base_url = tinyMCE.settings["document_base_url"];
        var vHTML = content;
        if (true == true){
            vHTML = tinyMCE.regexpReplace(vHTML, \'href\s*=\s*"?\'+base_url+\'\', \'href="\', \'gi\');
            vHTML = tinyMCE.regexpReplace(vHTML, \'src\s*=\s*"?\'+base_url+\'\', \'src="\', \'gi\');
        }
        return vHTML;
    }
</script>
');
?>
