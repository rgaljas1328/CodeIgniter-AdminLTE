<li class="header text-uppercase">Data Entry</li>
<li class="<?=active_link_controller('users');?>">
    <a href="<?=site_url('admin/users');?>">
        <i class="fa fa-users"></i> <span> Users</span>
    </a>
</li>

<li class="treeview <?=active_link_controller('students')?>">
    <a href="#">
        <i class="fa fa-graduation-cap"></i> 
        <span> Students</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="<?=active_link_function('students')?>"><a href="<?php echo site_url('admin/students'); ?>"> All students</a></li>
        <li class="<?=active_link_function('students')?>"><a href="<?php echo site_url('admin/students/create'); ?>"> Add student</a></li>
    </ul>
</li>
<li class="<?=active_link_controller('instructors')?>">
    <a href="<?php echo site_url('admin/instructors'); ?>">
        <i class="fa fa-user-secret"></i> <span> Instructors</span>
    </a>
</li>