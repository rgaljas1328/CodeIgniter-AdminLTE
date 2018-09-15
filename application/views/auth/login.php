<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
    <div class="login-logo">
        <center>
        <img src="<?php echo base_url('assets/IC_LOGO.png') ?>" class="img-responsive" alt="USTP Logo" style="width:200px;height:200px;">
        </center>
        <a href="#"><small><b>E</b>nrollment <b>S</b>ystem</small></a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Login to start session</p>
        

        <form id="login" method="post">
            <div class="form-group has-feedback">
                <input type='text' class="form-control" name="username" id="username" placeholder="Username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type='password' class="form-control" name="password" id="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
        $(document).on('submit', '#login', function(e){
            e.preventDefault();
            alert();
        })
    })
</script>
