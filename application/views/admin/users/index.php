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

                        <div class="col-md-3">
                
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                <h3 class="box-title">New User</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <?php echo form_open(current_url(), array("id" => "create_user")); ?>
                                <div class="box-body">
                                    <div class="form-group">
                                            <?php echo lang('users_firstname', 'first_name'); ?>
                                            <?php echo form_input($first_name);?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_lastname', 'last_name'); ?>
                                            
                                                <?php echo form_input($last_name);?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_company', 'company'); ?>
                                            
                                                <?php echo form_input($company);?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_email', 'email'); ?>
                                            
                                                <?php echo form_input($email);?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_phone', 'phone'); ?>
                                            
                                                <?php echo form_input($phone);?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_password', 'password'); ?>
                                            
                                                <?php echo form_input($password);?>
                                                <div class="progress" style="margin:0">
                                                    <div class="pwstrength_viewport_progress"></div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('users_password_confirm', 'password_confirm'); ?>
                                            
                                                <?php echo form_input($password_confirm);?>

                                        </div>
                                    
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <div class='pull-right'>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button> &nbsp;
                                        <button type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                            </div>
                            
                        </div>
                        <div class="col-md-9">
                             <div class="box box-primary box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">List of Users</h3>
                                    
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                                        <input type="text" id="table_search" class="form-control pull-right" placeholder="Search subject">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-hover" id='userTable'>
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('users_firstname');?></th>
                                                <th><?php echo lang('users_lastname');?></th>
                                                <th><?php echo lang('users_email');?></th>
                                                <th><?php echo lang('users_groups');?></th>
                                                <th><?php echo lang('users_status');?></th>
                                                <th><?php echo lang('users_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($users as $user):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
<?php

foreach ($user->groups as $group)
{

    // Disabled temporary !!!
    // echo anchor('admin/groups/edit/'.$group->id, '<span class="label" style="background:'.$group->bgcolor.';">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
    echo anchor('admin/groups/edit/'.$group->id, '<span class="label label-default">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
}

?>
                                                </td>
                                                <td><?php echo ($user->active) ? anchor('admin/users/deactivate/'.$user->id, '<button class="btn btn-success btn-xs">'.lang('users_active').'</button>') : anchor('admin/users/activate/'. $user->id, '<button class="btn btn-default btn-xs">'.lang('users_inactive').'</button>'); ?></td>
                                                <td>
                                                    <?php echo anchor('admin/users/edit/'.$user->id, '<button class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> '.lang('actions_edit').'</button>'); ?> &nbsp;
                                                    <?php echo anchor('admin/users/profile/'.$user->id, '<button class="btn btn-info btn-xs"><i class="fa fa-info"></i> '.lang('actions_see').'</button>'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
<script>
    $(function(){
        $('#create_user').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?=base_url('admin/users/index')?>',
                data: $(this).serialize(),
                type: 'post',
                success: function(data)
                {
                    location.reload();
                }

            });
        });

        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");
            console.log(tr);
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                td4 = tr[i].getElementsByTagName("td")[3];
                
                if (td1) {
                    if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                
                }   
                  
            }
            
        });
    });      

</script>