<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 465px;">
                <section class="sidebar" style="overflow: hidden; width: auto; height: 697px;">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <!-- <li>
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a> -->
                        </li>

                        <?php 
                            if (!empty($this->session->userdata('ugroup')) 
                                && ($this->session->userdata('ugroup') == 'admin'))
                            {
                               $this->load->view('admin/_templates/_admin_data_entry');
                            }

                        ?>

                        
                        <li class="header text-uppercase">Enrollment Procedures</li>
                        
                        <li class="<?=active_link_controller('courses')?>">
                            <a href="<?php echo site_url('controller'); ?>">
                                <i class="fa fa-bookmark"></i> <span> Control Subjects</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('courses')?>">
                            <a href="<?php echo site_url('assessment'); ?>">
                                <i class="fa fa-bookmark"></i> <span> Assessment</span>
                            </a>
                        </li>

                        <li class="header text-uppercase">Assessment</li>
                        
                        <li class="<?=active_link_controller('courses')?>">
                            <a href="<?php echo site_url('controller'); ?>">
                                <i class="fa fa-paypal"></i> <span> Transaction</span>
                            </a>
                        </li>
                        <li class="treeview <?=active_link_controller('fees')?>">
                            <a href="#">
                                <i class="fa fa-money"></i> 
                                <span> Fees</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('miscelleneous')?>"><a href="<?php echo site_url('admin/fees/miscelleneous'); ?>"> Miscelleneous Fee</a></li>
                                <li class="<?=active_link_function('tuitions')?>"><a href="<?php echo site_url('admin/fees/tuitions'); ?>"> Tuition Fee</a></li>
                                <li class="<?=active_link_function('mandatories')?>"><a href="<?php echo site_url('admin/fees/mandatories'); ?>"> Mandatory Fee</a></li>
                            </ul>
                        </li>
                        <li class="header text-uppercase">Enrollment Configuration</li>
                        
                        <li class="<?=active_link_controller('departments')?>">
                            <a href="<?php echo site_url('admin/departments'); ?>">
                                <i class="fa fa-bookmark"></i> <span> Departments</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('courses')?>">
                            <a href="<?php echo site_url('admin/courses'); ?>">
                                <i class="fa fa-bookmark"></i> <span> Courses</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('academicyears')?>">
                            <a href="<?php echo site_url('admin/academicyears'); ?>">
                                <i class="fa fa-calendar-check-o"></i> <span> Academic Year</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('rooms')?>">
                            <a href="<?php echo site_url('admin/rooms'); ?>">
                                <i class="fa fa-building"></i> <span> Rooms</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('subjects')?>">
                            <a href="<?php echo site_url('admin/subjects'); ?>">
                                <i class="fa fa-calendar-minus-o"></i> <span> Subjects</span>
                            </a>
                        </li>
                        <li class="treeview <?=active_link_controller('subjectofferings')?>">
                            <a href="#">
                                <i class="fa fa-calendar"></i> 
                                <span> Subject Offerings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('index')?>"><a href="<?php echo site_url('admin/subjectofferings'); ?>"> All subject offerings</a></li>
                                <li class="<?=active_link_function('create')?>"><a href="<?php echo site_url('admin/subjectofferings/create'); ?>"> Add subject offering</a></li>
                            </ul>
                        </li>
                        <li class="<?=active_link_controller('evaluation')?>">
                            <a href="<?php echo site_url('admin/evaluations'); ?>">
                                <i class="fa fa-user"></i> <span> Evaluations</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('groups')?>">
                            <a href="<?php echo site_url('admin/groups'); ?>">
                                <i class="fa fa-shield"></i> <span><?php echo lang('menu_security_groups'); ?></span>
                            </a>
                        </li>
                        <li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('menu_preferences'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><?php echo lang('menu_interfaces'); ?></a></li>
                            </ul>
                        </li>
                        <!-- <li class="<?=active_link_controller('files')?>">
                            <a href="<?php echo site_url('admin/files'); ?>">
                                <i class="fa fa-file"></i> <span><?php echo lang('menu_files'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('database')?>">
                            <a href="<?php echo site_url('admin/database'); ?>">
                                <i class="fa fa-database"></i> <span><?php echo lang('menu_database_utility'); ?></span>
                            </a>
                        </li>


                        <li class="header text-uppercase"><?php echo $title; ?></li>
                        <li class="<?=active_link_controller('license')?>">
                            <a href="<?php echo site_url('admin/license'); ?>">
                                <i class="fa fa-legal"></i> <span><?php echo lang('menu_license'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('resources')?>">
                            <a href="<?php echo site_url('admin/resources'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_resources'); ?></span>
                            </a>
                        </li> -->
                    </ul>
                </section>
                
                </div>
                
            </aside>

