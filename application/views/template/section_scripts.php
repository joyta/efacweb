<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url() ?>js/plugin/pace/pace.min.js"></script>

		<!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?= base_url() ?>js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?= base_url() ?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script> -->

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?= base_url() ?>js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="<?= base_url() ?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="<?= base_url() ?>js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?= base_url() ?>js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?= base_url() ?>js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="<?= base_url() ?>js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?= base_url() ?>js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?= base_url() ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
                <script src="<?= base_url() ?>js/plugin/jquery-validate/messages_es.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?= base_url() ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?= base_url() ?>js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?= base_url() ?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?= base_url() ?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?= base_url() ?>js/plugin/fastclick/fastclick.min.js"></script>

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- Demo purpose only -->
		<script src="<?= base_url() ?>js/demo.min.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?= base_url() ?>js/app.min.js"></script>		

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="<?= base_url() ?>js/speech/voicecommand.min.js"></script>	

		<!-- SmartChat UI : plugin -->
		<script src="<?= base_url() ?>js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="<?= base_url() ?>js/smart-chat-ui/smart.chat.manager.min.js"></script>

		<script type="text/javascript">
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			$(document).ready(function() {
                            pageSetUp();
			})
		</script>
                
                <script src="<?= base_url() ?>js/efac/efac.js"></script>
                
                <script type="text/javascript">
                    efac.rootPath = '<?=  base_url()?>';
                    var FormatoDecimal = { aSep: '', aDec: '.', mDec: 2 };
                    var FormatoDecimalFull = { aSep: '', aDec: '.', mDec: 6 };
        
                    jQuery.validator.addMethod("validUnique", function(value, element, param){    
                        var data = { "attr" : param, "id": $('#id').val(),'value': value};
                        var r = false; 
                        $.ajax({
                            type: "POST",
                            url: '<?=  base_url()?>app/validUnique/',        
                            data: data,
                            async: false,
                            success: function(data){           
                                if(data === 'true'){                  
                                    r = true;
                                }else{                     
                                    r = false;
                                }
                            },
                            error: function(xhr, textStatus, errorThrown){
                                alert('ajax loading error... ... '+textStatus);            
                            }
                        });    
                        return r;
                    }, 'Ya registrado');
                </script>
                
                <!-- PAGE RELATED PLUGIN(S) -->
                <?php
                $viewjs = APPPATH . "views/" . $view . "_js";
                if (file_exists($viewjs . ".php")) {
                    $this->load->view($view . "_js");
                }
                ?> 
                <!-- END PAGE SCRIPTS -->