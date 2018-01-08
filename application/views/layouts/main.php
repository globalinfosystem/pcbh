<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo CNF_APPNAME; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/bootstrap/css/bootstrap.css" type="text/css"  />	
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/sximo.css" type="text/css"  />
		
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/select2/select2.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/fonts/awesome/css/font-awesome.min.css" type="text/css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/iCheck/skins/square/green.css" type="text/css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/markitup/skins/simple/style.css" type="text/css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/markitup/sets/default/style.css" type="text/css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/js/plugins/fancybox/jquery.fancybox.css" type="text/css"  />

        <script src="<?php echo base_url(); ?>design/js/plugins/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/jquery.cookie.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/select2/select2.min.js"></script>

        <script src="<?php echo base_url(); ?>design/js/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/prettify.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/fancybox/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/prettify.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/parsley.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/jquery.jCombo.min.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/bootstrap.summernote/summernote.min.js"></script>

        <script src="<?php echo base_url(); ?>design/js/plugins/markitup/jquery.markitup.js"></script>
        <script src="<?php echo base_url(); ?>design/js/plugins/markitup/sets/default/set.js"></script>


        <script src="<?php echo base_url(); ?>design/js/sximo.js"></script>
        <script language="javascript">
            var mySettings = {
                onShiftEnter: {keepDefault: false, replaceWith: '<br />\n'},
                onCtrlEnter: {keepDefault: false, openWith: '\n<p>', closeWith: '</p>'},
                onTab: {keepDefault: false, replaceWith: '    '},
                markupSet: [
                    {name: 'Bold', key: 'B', openWith: '(!(<strong>|!|<b>)!)', closeWith: '(!(</strong>|!|</b>)!)'},
                    {name: 'Italic', key: 'I', openWith: '(!(<em>|!|<i>)!)', closeWith: '(!(</em>|!|</i>)!)'},
                    {name: 'Stroke through', key: 'S', openWith: '<del>', closeWith: '</del>'},
                    {separator: '---------------'},
                    {name: 'Bulleted List', openWith: '    <li>', closeWith: '</li>', multiline: true, openBlockWith: '<ul>\n', closeBlockWith: '\n</ul>'},
                    {name: 'Numeric List', openWith: '    <li>', closeWith: '</li>', multiline: true, openBlockWith: '<ol>\n', closeBlockWith: '\n</ol>'},
                    {separator: '---------------'},
                    {name: 'Picture', key: 'P', replaceWith: '<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />'},
                    {name: 'Link', key: 'L', openWith: '<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith: '</a>', placeHolder: 'Your text to link...'},
                    {separator: '---------------'},
                    {name: 'Clean', className: 'clean', replaceWith: function (markitup) {
                            return markitup.selection.replace(/<(.*?)>/g, "")
                        }},
                    {name: 'Preview', className: 'preview', call: 'preview'}
                ]
            }
            jQuery(document).ready(function ($) {
                $('.markItUp').markItUp(mySettings);
            });
        </script>
        
        
        <!---Confirm Box------>
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>design/js/plugins/confirmbox/css/jquery-confirm.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>design/js/plugins/confirmbox/js/jquery-confirm.js"></script>
        <!------Ends Here----->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->	


    </head>

    <body>

    <body class="sxim-init" >
        <div id="wrapper">
            <?php $this->load->view('layouts/sidemenu'); ?>
            <div class="gray-bg " id="page-wrapper">
                <?php $this->load->view('layouts/headmenu'); ?>
                <?php echo $content; ?>		
            </div>
        </div>

        <div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-default">

                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body" id="sximo-modal-content">

                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#sidemenu').sximMenu();
            });
        </script>
    </body>
</html>
