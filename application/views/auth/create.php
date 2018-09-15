<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
    <div class="login-logo">
        <center>
        <img src="<?php echo base_url('assets/IC_LOGO.png') ?>" class="img-responsive" alt="IC Logo" style="width:200px;height:200px;">
        </center>
        <a href="#"><small><b>E</b>nrollment <b>S</b>ystem</small></a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Login to start session</p>
        

        <form id="create" method="post">
            <div class="form-group has-feedback">
                <input type='text' class="form-control" name="username" id="username" placeholder="Username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type='password' class="form-control" name="password" id="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type='text' class="form-control" name="teacher_name" id="teacher_name" placeholder="Name">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type='text' class="form-control" name="teacher_address" id="teacher_address" placeholder="Address">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type='text' class="form-control" name="teacher_position" id="teacher_position" placeholder="Position">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="row">
                
                <div class="col-xs-6"></div>
                
                <div class="col-xs-6"><center>
                    <button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
                    </center></div>
            </div>
        </form>

    </div>

<script>
    $(function(){
        $(document).on('submit', '#create', function(e){
            e.preventDefault();
            
            let request = $.ajax({
                url : '<?=base_url('auth/create'); ?>',
                data : $(this).serialize(),
                method : 'post',
                dataType: 'json'
            });
            request.done(function(data){
                console.log(data);
            });
        })
    })
</script>
