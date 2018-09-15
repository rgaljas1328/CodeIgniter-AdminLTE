
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo "Prospectus"; ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/dashboard">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a> 
            </li>
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/courses">
                    <i class="fa fa-dashboard"></i> Course
                </a> 
            </li>
            <li class="active">Prospectus

            </li>
        </ol>
      
    </section>
    <section class="content">
        <div class="row">
            <!--LEFT DIV  -->
            
            <div class="col-xs-12">
                <div class="box box-solid">
                    
                    <div class="box-header with-border">
                    <?php foreach ($courses as $key => $value) {?>
                        <center>
                            <h2><b><?php echo $value['course_code']; ?> (<?php echo $value['course_year']; ?>)</b></h2>
                            <h3><?php echo $value['course_description']; ?></h3>
                        
                        </center>
                    <?php } ?>    
                        <div class="box-tools pull-right">
                            <a class="btn btn-app appAdd" href="<?php echo site_url('admin/courses/addprospectus/?id='.$id); ?>">
                                <i class="fa fa-plus"></i> Add
                            </a>
                            <a class="btn btn-app appEdit" href="<?php echo site_url('admin/courses/editprospectus/?id='.$id); ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a class="btn btn-app appDelete" href="<?php echo site_url('admin/courses/deleteprospectus/?id='.$id); ?>">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-default box-solid">
                    <div class="box-body table-responsive" id='prospectusTable'>
                    
                    </div>
                    <div class="overlay" id='overlay'>
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    $(document).ready(function(){
        $('.sidebar-mini').toggleClass("skin-blue fixed sidebar-mini skin-blue fixed sidebar-mini sidebar-collapse");
        displayProspectus()
        function displayProspectus()
        {
            let id = <?php echo $id; ?>;
            LoadDataFromUrlToTable('../../prospectus/getAll/?id='+id, 'prospectusTable');
        }
    })
</script>