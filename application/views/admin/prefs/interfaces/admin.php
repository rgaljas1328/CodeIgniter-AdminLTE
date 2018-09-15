<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border">
                            <h3 class="box-title">Edit Admin Interface</h3>
                            </div>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><?php echo anchor('admin/prefs/interfaces/admin', lang('menu_int_admin')); ?></li>
                                    <li><?php echo anchor('admin/prefs/interfaces/public', lang('menu_int_public')); ?></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_admin">
                                        <?php echo $message_admin; ?>

                                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-interface_admin')); ?>
<?php foreach ($admin_pref_interface as $value): ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_user_panel'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="user_panel" class='flat-red' id="user_panel1" value="1" <?php echo set_value('user_panel', $value['user_panel']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="user_panel" class='flat-red' id="user_panel0" value="0" <?php echo set_value('user_panel', $value['user_panel']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_sidebar_form'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sidebar_form" class='flat-red' id="sidebar_form1" value="1" <?php echo set_value('sidebar_form', $value['sidebar_form']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sidebar_form" class='flat-red' id="sidebar_form0" value="0" <?php echo set_value('sidebar_form', $value['sidebar_form']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_messages_menu'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="messages_menu" class='flat-red' id="messages_menu1" value="1" <?php echo set_value('messages_menu', $value['messages_menu']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="messages_menu" class='flat-red' id="messages_menu0" value="0" <?php echo set_value('messages_menu', $value['messages_menu']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_notifications_menu'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="notifications_menu" class='flat-red' id="notifications_menu1" value="1" <?php echo set_value('notifications_menu', $value['notifications_menu']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="notifications_menu" class='flat-red' id="notifications_menu0" value="0" <?php echo set_value('notifications_menu', $value['notifications_menu']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_tasks_menu'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="tasks_menu" id="tasks_menu1" class='flat-red' value="1" <?php echo set_value('tasks_menu', $value['tasks_menu']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="tasks_menu" id="tasks_menu0" class='flat-red' value="0" <?php echo set_value('tasks_menu', $value['tasks_menu']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_user_menu'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="user_menu" id="user_menu1" class='flat-red' value="1" <?php echo set_value('user_menu', $value['user_menu']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="user_menu" id="user_menu0" class='flat-red' value="0" <?php echo set_value('user_menu', $value['user_menu']) == 0 ? 'checked' : NULL; ?> disabled> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_ctrl_sidebar'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ctrl_sidebar" class='flat-red' id="ctrl_sidebar1" value="1" <?php echo set_value('ctrl_sidebar', $value['ctrl_sidebar']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ctrl_sidebar" class='flat-red' id="ctrl_sidebar0" value="0" <?php echo set_value('ctrl_sidebar', $value['ctrl_sidebar']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('prefs_transition_page'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="transition_page" class='flat-red' id="transition_page1" value="1" <?php echo set_value('transition_page', $value['transition_page']) == 1 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_yes')); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="transition_page" class='flat-red' id="transition_page0" value="0" <?php echo set_value('transition_page', $value['transition_page']) == 0 ? 'checked' : NULL; ?>> <?php echo strtoupper(lang('actions_no')); ?>
                                                    </label>
                                                </div>
                                            </div>
<?php endforeach; ?>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="btn-group">
                                                        <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success', 'content' => lang('actions_submit'))); ?>
                                                        <?php echo anchor('admin/prefs/reset_interfaces_admin', lang('actions_default_values'), array('class' => 'btn btn-info ')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></div>
                </section>
            </div>

            <script>
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
                })
            </script>

