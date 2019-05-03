<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ADIMS - Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Custom styles -->
        <style type="text/css">
        .signin-content {
        max-width: 360px;
        margin: 0 auto 20px;
        }
        </style>
        <!-- Le styles -->
        <link href="<?=base_url()?>assets/css/lib/bootstrap.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/lib/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/boo-extension.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/boo.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/boo-coloring.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/boo-utility.css" rel="stylesheet">
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body class="signin signin-vertical">
        <?=$this->uri->segment(2)?>
        <?if($this->uri->segment(2) == "registerSuccess"){?>
        <div class="success-msg" style="position: absolute;top: 9%;left: 32%;z-index:1;">
            <img src="<?=base_url()?>assets/img/success.png" />
            <span class="message">Successfully Registered.</span>
        </div>
        <?
        }else if($this->uri->segment(2) == "registerError"){
        ?>
        <div class="error-msg" style="position: absolute;top: 9%;left: 32%;z-index:1;">
            <img src="<?=base_url()?>assets/img/error.png">
            <span class="message">Some error occurred please try again.</span>
        </div>
        <?
        }else if($this->uri->segment(2) == "userExists"){
        ?>
        <div class="error-msg" style="position: absolute;top: 9%;left: 32%;z-index:1;">
            <img src="<?=base_url()?>assets/img/error.png">
            <span class="message">User already exists.</span>
        </div>
        <?
        }
        ?>
        <div class="page-container">
            <div id="header-container">
                <div id="header">
                    <div class="navbar-inverse navbar-fixed-top">
                        <div class="navbar-inner">
                            <div class="container"> </div>
                        </div>
                    </div>
                    <!-- // navbar -->
                    
                    <div class="header-drawer" style="height:3px"> </div>
                    <!-- // breadcrumbs -->
                </div>
                <!-- // drawer -->
            </div>
            <!-- // header-container -->
            
            <div id="main-container">
                <div id="main-content" class="main-content container">
                    <div class="signin-content">
                        <h1 class="welcome text-center" style="line-height: 0.6;"><span style="margin-left: 0px;">Welcome to</span><br />
                        <small>ADIMS</small></h1>
                        <div class="well well-nice form-dark">
                            <div class="tab-content overflow">
                                <div class="tab-pane fade in active" id="login">
                                    <h3 class="no-margin-top"><i class="fontello-icon-user-4"></i> Sign in with your ID</h3>
                                    <form class="form-tied margin-00" method="post" action="<?=base_url()?>index/authenticate_user" name="login_form">
                                        <fieldset>
                                            <?
                                            if(isset($auth_error)){
                                            ?>
                                            <span class="login-error"><?=$auth_error?></span>
                                            <?
                                            }
                                            ?>
                                            <ul>
                                                <li>
                                                    <input id="uid" class="input-block-level" type="text" name="agentname" required="required" placeholder="Username..." />
                                                </li>
                                                <li>
                                                    <input id="pwd" class="input-block-level" type="password" name="agentpassword" required="required" placeholder="Password..." />
                                                </li>
                                            </ul>
                                            <button type="submit" class="btn btn-envato btn-block btn-large">SIGN IN</button>
                                            <hr class="margin-xm">
                                            <label class="checkbox pull-left">
                                                <input id="remember" class="checkbox" type="checkbox">
                                            Remember me </label>
                                            <a href="#forgot" class="link pull-right" data-toggle="tab">Forgot Password?</a>
                                        </fieldset>
                                    </form>
                                    <!-- // form -->
                                    
                                </div>
                                <!-- // Tab Login -->
                                
                                <div class="tab-pane fade" id="forgot">
                                    <h3 class="no-margin-top">Forgot your password?</h3>
                                    <form class="margin-00" method="post" action="dashboard-one.html" name="forgot_password">
                                        <p class="note">Enter your e-mail address, we will send you an e-mail code for password reset.</p>
                                        <input id="email" class="input-block-level" type="email" name="id_email_forgot" placeholder="your email">
                                        <p class="text-center">or</p>
                                        <input id="email" class="input-block-level" type="tel" name="id_phone_forgot" placeholder="number phone">
                                        <hr class="margin-xm">
                                        <button type="submit" class="btn btn-envato">Submit</button>
                                        <p>Have you remembered? <a href="#login" class="link pull-right" data-toggle="tab">Try to log in again.</a></p>
                                    </form>
                                    <!-- // form -->
                                    
                                </div>
                                <!-- // Tab Forgot -->
                                
                                <div class="tab-pane fade" id="register">
                                    <h3 class="no-margin-top"><i class="fontello-icon-users"></i> New User Registration</h3>
                                    <form class="form-tied margin-00" method="post" action="<?=base_url()?>index/registerUser" name="login_form">
                                        <fieldset>
                                            
                                            <legend class="two"><span>First Name:</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="firstname" required="required"/>
                                            <legend class="two"><span>Last Name</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="lastname" required="required"/>
                                            <legend class="two"><span>Username</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="agentname" required="required"/>
                                            <legend class="two"><span>Date Of Birth</span></legend>
                                            <input id="idPassw" class="date-field input-block-level" type="text" name="dob" required="required"/>
                                            <legend class="two"><span>Nationality</span></legend>
                                            <select name="nationality" required="required">
                                                <option value="">--Select--</option>
                                                <?
                                                foreach($nationalities as $key=>$nationality){
                                                ?>
                                                <option value="<?=$nationality["id"]?>"><?=$nationality["nationality"]?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                            <legend class="two"><span>Designation</span></legend>
                                            <select name="designation" required="required">
                                                <option value="">--Select--</option>
                                                <?
                                                foreach($designations as $key=>$designation){
                                                ?>
                                                <option value="<?=$designation["id"]?>"><?=$designation["designation"]?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                            <legend class="two"><span>Company</span></legend>
                                            <select name="company" required="required">
                                                <option value="">--Select--</option>
                                                <?
                                                foreach($companies as $key=>$company){
                                                ?>
                                                <option value="<?=$company["id"]?>"><?=$company["name"]?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                            <legend class="two"><span>Phone 1</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="phone1" required="required"/>
                                            <legend class="two"><span>Phone 2</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="phone2">
                                            <legend class="two"><span>Mobile</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="mobile" required="required"/>
                                            <legend class="two"><span>Email</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="email" required="required"/>
                                            <legend class="two"><span>Address Line 1</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="address1" required="required"/>
                                            <legend class="two"><span>Address Line 2</span></legend>
                                            <input id="idPassw" class="input-block-level" type="text" name="address2" />
                                            <legend class="two"><span>User Role</span></legend>
                                            <select name="agentrole" required="required">
                                                <option value="">--Select--</option>
                                                <?
                                                foreach($userroles as $key=>$role){
                                                ?>
                                                <option value="<?=$role["id"]?>"><?=$role["role"]?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                            <legend class="two"><span>Password</span></legend>
                                            <input id="idPassw" class="input-block-level" type="password" name="agentpassword" required="required"/>
                                            <button type="submit" class="btn btn-green btn-block btn-large" style="margin-top:5%">REGISTER TO ADIMS</button>
                                            <hr class="margin-xm">
                                            <p>Have you remembered? <a href="#login" class="link pull-right" data-toggle="tab">Try to log in again.</a></p>
                                        </fieldset>
                                    </form>
                                    <!-- // form -->
                                    
                                </div>
                                <!-- // Tab Forgot -->
                                
                            </div>
                        </div>
                        <!-- // Well-Nice -->
                        
                        <div class="web-description">
                            <h5>Copyright &copy; 2012 ADIMS</h5>
                            <p>Backend and Frontend interface for ADIMS. <br />
                            All rights reserved.</p>
                        </div>
                    </div>
                    <!-- // sign-content -->
                    
                </div>
                <!-- // main-content -->
                
            </div>
            <!-- // main-container  -->
            
        </div>
        <!-- // page-container -->
        <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <h4>Welcome</h4>
            </div>
            <div class="modal-body">
                <h3 class="margin-0s">Hi,</h3>
                <p>This template has been updated, but the update is not yet available for download on ThemeForest.The package is awaiting approval. <br>Once the new version to download you will see in the icon template version number 1.2.0. <br>After the purchase are all updates, including this one, free.</p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-red">Close</a>
            </div>
        </div>
        <!-- Le javascript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?=base_url()?>assets/js/lib/jquery.js"></script>
        <script src="<?=base_url()?>assets/js/lib/jquery-ui.js"></script>
        <script src="<?=base_url()?>assets/js/lib/jquery.cookie.js"></script>
        <script src="<?=base_url()?>assets/js/lib/jquery.date.js"></script>
        <script src="<?=base_url()?>assets/js/lib/jquery.mousewheel.js"></script>
        <script src="<?=base_url()?>assets/js/lib/jquery.load-image.min.js"></script>
        <script src="<?=base_url()?>assets/js/lib/bootstrap/bootstrap.js"></script>
        <!-- Plugins Bootstrap -->
        <script src="<?=base_url()?>assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-fuelux/js/all-fuelux.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-daterangepicker/js/bootstrap-daterangepicker.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-toggle-button/js/bootstrap-toggle-button.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-rowlink/js/bootstrap-rowlink.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-progressbar/js/bootstrap-progressbar.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-select/bootstrap-select.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-bootbox/bootbox.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-wizard/js/bootstrap-wizard.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-wizard-2/js/bwizard-only.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-image-gallery/js/bootstrap-image-gallery.min.js"></script>
        
        <!-- Plugins Custom - Only example -->
        <script src="<?=base_url()?>assets/plugins/pl-extension/google-code-prettify/prettify.js"></script>
        <!-- Plugins Custom - System -->
        <script src="<?=base_url()?>assets/plugins/pl-system/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-system/xbreadcrumbs/xbreadcrumbs.js"></script>
        <!-- Plugins Custom - System info -->
        <script src="<?=base_url()?>assets/plugins/pl-system-info/qtip2/dist/jquery.qtip.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-system-info/gritter/js/jquery.gritter.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-system-info/notyfy/jquery.notyfy.js"></script>
        <!-- Plugins Custom - Content -->
        <script src="<?=base_url()?>assets/plugins/pl-content/list/js/list.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-content/list/plugins/list.paging.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-content/jpages/js/jPages.js"></script>
        <!-- Plugins Custom - Component -->
        <script src="<?=base_url()?>assets/plugins/pl-component/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-component/rangeslider/jqallrangesliders.min.js"></script>
        <!-- Plugins Custom - Form -->
        <script src="<?=base_url()?>assets/plugins/pl-form/uniform/jquery.uniform.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/select2/select2.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/counter/jquery.counter.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/elastic/jquery.elastic.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/inputmask/jquery.inputmask.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/inputmask/jquery.inputmask.extensions.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/validate/js/jquery.validate.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-form/duallistbox/jquery.duallistbox.min.js"></script>
        <!-- Plugins Custom - Gallery -->
        <script src="<?=base_url()?>assets/plugins/pl-gallery/nailthumb/jquery.nailthumb.1.1.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-gallery/nailthumb/showLoading/js/jquery.showLoading.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-gallery/wookmark/jquery.imagesloaded.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-gallery/wookmark/jquery.wookmark.min.js"></script>
        
        <!-- Plugins Tables -->
        <script src="<?=base_url()?>assets/plugins/pl-table/datatables/media/js/jquery.dataTables.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-table/datatables/plugin/jquery.dataTables.plugins.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-table/datatables/plugin/jquery.dataTables.columnFilter.js"></script>
        <!-- Plugins data visualization -->
        <script src="<?=base_url()?>assets/plugins/pl-visualization/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/percentageloader/percentageloader.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/knob/knob.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.categories.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.grow.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.orderBars.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.pie.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.resize.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.selection.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.stack.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.stackpercent.js"></script>
        <script src="<?=base_url()?>assets/plugins/pl-visualization/flot/jquery.flot.time.js"></script>
        <!-- main js -->
        <script src="<?=base_url()?>assets/js/core.js"></script>
        <script src="<?=base_url()?>assets/js/application.js"></script>
        <script src="<?=base_url()?>assets/js/script.js"></script>
        <script type="text/javascript">
        $(window).load(function(){
        
        });
        </script>
        <script>
        $(document).ready(function() {
            
        });
        </script>
    </body>
</html>