<!DOCTYPE html>
<html lang="es-ec" >
    <head>
        <?php $this->load->view("template/section_head");?>
    </head>
    <body class="efac-style">

        <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width. You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
        <?php $this->load->view("template/section_header");?>
        <?php $this->load->view("template/section_shortcuts");?>
        <?php $this->load->view("template/section_left_panel");?>		
        <!-- ==========================CONTENT STARTS HERE ========================== -->
        <!-- MAIN PANEL -->
        <div id="main" role="main">
            <?php $this->load->view("template/section_ribbon");?> 
            <!-- MAIN CONTENT -->
            <div id="content">
                <?php $this->load->view($view);?> 
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN PANEL -->
        <!-- ==========================CONTENT ENDS HERE ========================== -->
        
        <?php $this->load->view("template/section_footer");?> 
        <?php $this->load->view("template/section_scripts");?> 

    </body>
</html>