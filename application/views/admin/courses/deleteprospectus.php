
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
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
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/courses/prospectus/?id=<?php echo $id ?>">
                    <i class="fa fa-dashboard"></i> Prospectus
                </a> 
            </li>
            <li class="active">Delete

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
                                <a class="btn btn-app appView" href="<?php echo site_url('admin/courses/prospectus/?id='.$id); ?>">
                                    <i class="fa fa-info"></i> Prospectus
                                </a>
                                <a class="btn btn-app appAdd" href="<?php echo site_url('admin/courses/addprospectus/?id='.$id); ?>">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                                <a class="btn btn-app appEdit" href="<?php echo site_url('admin/courses/editprospectus/?id='.$id); ?>">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                        
                    
                </div>
            </div>
            
            <?php 
            $semester = array('First Semester','Second Semester','Summer');
            $level = array('First Year','Second Year','Third Year','Forth Year');
            $y = 0;
            ?> 
            <?php foreach ($semester as $key => $value) 
            {
                echo "<div class='well'>
                <div class='row'>";
                $iToSend = 1;
                foreach($level as $key1 => $value1)
                {
                    

             ?>
            <div class="col-xs-3">
                <div class="box box-danger box-solid" >
                    
                    <div class="box-header">
                        <h3 class="box-title pull-left"><?php echo $value1 ?></h3>
                        <h3 class="box-title pull-right"><?php echo $value ?></h3>
                    </div>
                    <div class="box-body">
                        
                            <?php  
                                $termRow = $level;  
                                $data = array('level' => $value1, 'term' => $value, 'ID' =>$id,$prospectus); 
                                $this->load->view('admin/courses/deletesubject.php', $data);
                            ?>
                        
                    </div>
                    
                   
                    
                </div>
            </div>
            <?php
                $iToSend++;
                }
                $y++;
                echo "</div>
                </div>";
            }
            
            ?>
           <div class="col-xs-12">
                <center><button id='deleteAll' type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span> Remove All</button></center>
            </div>
        </div>
    </section>

</div>

<script>
//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
    $(function()
    {
        $('.sidebar-mini').toggleClass("skin-blue fixed sidebar-mini skin-blue fixed sidebar-mini sidebar-collapse");
        $(document).on('click', '#deleteAll', function(e){
            $('#deleteAll').html("<span id='rot' class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>");
            e.preventDefault();
            let checkboxValues = new Array;
            $('input[id=subjectID]:checked').map(function() {
                // checkboxValues.push($(this).val());
                let data = {
                    id :$(this).val()
                }
                DeleteDataFromUrl(data, '../../prospectus/delete').then(function(data){
                    toastr.success(data.content.message);
                })
                
            });
            setTimeout(() => {
                location.reload();
            }, 2000);
            
            
            
        })
    });

</script>