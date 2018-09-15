
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
            <li class="active">Edit

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
                                <a class="btn btn-app appDelete" href="<?php echo site_url('admin/courses/deleteprospectus/?id='.$id); ?>">
                                    <i class="fa fa-trash"></i> Delete
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
                <div class="box box-warning box-solid" >
                    
                    <div class="box-header">
                        <h3 class="box-title pull-left"><?php echo $value1 ?></h3>
                        <h3 class="box-title pull-right"><?php echo $value ?></h3>
                    </div>
                    <div class="box-body">
                        <div id="inputContainer<?php echo $iToSend."_".$y;?>">
                            <?php  
                                $termRow = $level;  
                                $data = array('level' => $value1, 'term' => $value, 'ID' =>$id,$prospectus,$subjects); 
                                $this->load->view('admin/courses/editsubject.php', $data);
                            ?>
                        </div><br>
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
           
        </div>
    </section>

</div>

<script>
    $(function()
    {
        $('.sidebar-mini').toggleClass("skin-blue fixed sidebar-mini skin-blue fixed sidebar-mini sidebar-collapse");
        $(document).on('change','select[id^=editprerequisite]', function(e){
            e.preventDefault()
            let id = $(this).attr('id').split("_")
            let subj_id = id[1]
            let course_id = id[2]
            let subjID = $(this).children(":selected").attr("id")

            let data = {
                subj_id:subj_id,
                course_id:course_id,
                subjID:subjID
            }
            PutDataToUrl(data, '../../prospectus/editPrerequisite').then(function(data){
                toastr.success(data.content.message);
            });
        });
    });

</script>