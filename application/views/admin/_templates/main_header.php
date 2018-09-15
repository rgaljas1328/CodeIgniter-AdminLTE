<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <style>
                .skin-blue .main-header .navbar .sidebar-toggle:hover {
                    background-color: #31b5a9;
                }
                #rot{
                    animation: spin 2s linear infinite;
                }
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
                
                .appAdd
                {
                    color: white;background-color:#3F51B5;
                }
                .appView
                {
                    color: white;background-color:#3c8dbc;
                }
                .appEdit
                {
                    color: white;background-color:#FF9800;
                }
                .appDelete
                {
                    color: white;background-color:#d9534f;
                }
                    .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #9dcc7a;border-collapse: collapse;}
                    .tftable th {font-size:13px;background-color:#3c8dbc;border-width: 1px;padding: 8px;border-style: solid;border-color: #9dcc7a;text-align:left; color:white;}
                    .tftable tr {background-color:#ffffff;}
                    .tftable td {font-size:13px;border-width: 1px;padding: 6px;border-style: solid;border-color: #9dcc7a;}
                    .tftable tr:hover {background-color:#ffff99;}
            </style>
            <header class="main-header" style="background-color: #3cbcaf;">
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo" style="background-color: #31b5a8;">
                    <span class="logo-mini"><b>IC</b></span>
                    <span class="logo-lg"><img src="http://localhost/ICEnrollment/assets/IC_banner.png" class="img-responsive" alt="" style='width:180px;height:52px'></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation" style="background-color: #3cbcaf;">
                
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </a>
                    
                        <span class="navbar-brand">
                            <p>Jampason, Initao, Misamis Oriental, 9023 Philippines </p> 
                            
                        </span>
                        
                    <div class="navbar-custom-menu">
                    
                        <ul class="nav navbar-nav">
<?php if ($admin_prefs['user_menu'] == TRUE): ?>
                            <!-- User Account -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $user_login['username']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                                        <p><?php echo $user_login['firstname'].$user_login['lastname']; ?><small><?php echo lang('header_member_since'); ?> <?php echo date('d-m-Y', $user_login['created_on']); ?></small></p>
                                    </li>
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_followers'); ?></a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_sales'); ?></a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_friends'); ?></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('admin/users/profile/'.$user_login['id']); ?>" class="btn btn-default btn-flat"><?php echo lang('header_profile'); ?></a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('auth/logout/admin'); ?>" class="btn btn-default btn-flat"><?php echo lang('header_sign_out'); ?></a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

<?php endif; ?>
<?php if ($admin_prefs['ctrl_sidebar'] == TRUE): ?>
                            <!-- Control Sidebar Toggle Button -->
                            <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
<?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </header>
