<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
<div class="modal fade" id="addCourse_Modal" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_addCourse'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add course</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="municipality">Code</label>
                            <input type='text' name='course_code' class='form-control' placeholder="Course code" required>
                        </div>
                        <div class="form-group">
                            <label for="municipality">Description</label>
                            <input type='text' name='course_description' class='form-control' placeholder="Course description" required>
                        </div>
                        <div class="form-group">
                            <label for="municipality">Year</label>
                            <input type='text' name='course_year' class='form-control' placeholder="Course year" required>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save course</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            
            <!--RIGHT DIV  -->
            <div class="col-md-12">
                
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">New Student</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open('', array("id" => "form_addStudent")); ?>
                    <div class="box-body">
                        <div class='row'>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                
                                <select class='form-control' name='course' id='course' required>
                                    
                                </select>
                                </div>
                            </div>
                            
                            <div class='col-xs-1'>
                                <div class="form-group">

                                <a class='btn btn-success' data-toggle='modal' href='#addCourse_Modal'><i class='fa fa-plus'></i> New course</a>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                           
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <?php echo form_input($student_id);?>
                                </div>
                            </div>
                        
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="firstname">First name</label>
                                    <?php echo form_input($student_fname);?>
                                </div>
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="middlename">Middle name</label>
                                    <?php echo form_input($student_mname);?>
                                </div>
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="lastname">Last name</label>
                                    <?php echo form_input($student_lname);?>
                                </div>
                            </div>
                       
                        
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="Gender">Gender</label>
                                    <select class='form-control' name='student_gender' required>
                                        <option value='' disabled selected>-- Select gender --</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class='col-xs-4'>
                                <div class="form-group">
                                    <label for="place">Birth place</label>
                                    <input type='text' name='student_bplace' class='form-control' placeholder="Birth place">
                                </div> 
                            </div>
                            
                            <div class='col-xs-2'>
                                <div class="form-group date">
                                    <label for="date">Birth date</label>
                                     <input type='text' name='student_bdate' class='form-control bdate' id='datepicker' placeholder="Birth date">
                                </div>
                            </div>
                            <div class='col-xs-1'>
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type='text' name='age' class='form-control' id='age' placeholder="Age" disabled>
                                </div> 
                            </div>
                            <div class='col-xs-2'>
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <input type='text' name='student_religion' class='form-control' placeholder="Religion">
                                </div> 
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="street">Street #</label>
                                    <input type='text' name='student_address_street' class='form-control' placeholder="Street # of student address">
                                </div>
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type='text' name='student_address_barangay' class='form-control' placeholder="Barangay of student address">
                                </div>
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="municipality">Municipality</label>
                                    <input type='text' name='student_address_municipality' class='form-control' placeholder="Municipality of student address">
                                </div>
                            </div>
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type='text' name='student_address_province' class='form-control' placeholder="Province of student address">
                                </div>
                            </div>
                            
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="spouse">Civil status</label>
                                    <select class='form-control' name='student_status' required>
                                        <option value='' disabled selected>-- Select status --</option>
                                        <option>Single</option>
                                        <option>Married</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class='col-xs-4'>
                                <div class="form-group">
                                    <label for="spouse">Spouse name (Optional)</label>
                                    <input type='text' name='student_spouse_name' class='form-control' placeholder="Name of spouse if applicable">
                                </div>
                            </div>
                            <div class='col-xs-5'>
                                <div class="form-group">
                                    <label for="school">Last school attended</label>
                                    <input type='text' name='student_last_school_year_attended' class='form-control' placeholder="Last school attended">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class='row'>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="father">Father's name</label>
                                    <input type='text' name='student_fathers_name' class='form-control' placeholder="Father's full name">
                                </div>
                            </div>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="fatherOccu">Father's occupation</label>
                                    <input type='text' name='student_fathers_occupation' class='form-control' placeholder="Father's occupation">
                                </div>
                            </div>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="father">Mother's name</label>
                                    <input type='text' name='student_mothers_name' class='form-control' placeholder="Mother's full name">
                                </div>
                            </div>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="motherOccu">Mother's occupation</label>
                                    <input type='text' name='student_mothers_occupation' class='form-control' placeholder="Mother's occupation">
                                </div>
                            </div>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="contact">Contact number</label>
                                    <input type='text' name='student_contact_number' class='form-control' placeholder="Contact number">
                                </div>
                            </div>
                            <div class='col-xs-6'>
                                <div class="form-group">
                                    <label for="guardian">Guardian's name</label>
                                    <input type='text' name='student_guardian' class='form-control' placeholder="Guardian's full name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class='pull-right'>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button> &nbsp;
                            <button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>
                  
            </div>
        </div>
    </section>
</div>






<script>
// var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
    
    $(function(){

        $('#datepicker').datepicker({ autoclose: true });

        //Display list of course options
        getCourses();
        
        // ADD student
        $('#form_addStudent').on('submit', function(e){
            e.preventDefault();
            PostDataToUrl($(this).serialize(), '<?=base_url('admin/students/add')?>').then(function(data){
                switch (data.content.status) {
                    case 'error':
                        toastr.error(data.content.message);
                        break;
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addStudent')[0].reset();
                        toastr.success(data.content.message);
                        break;
                    default:
                        break;
                }
            });
        });

        // ADD COURSE
        $('#form_addCourse').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?=base_url('admin/courses/add')?>',
                data: $(this).serialize(),
                type: 'post',
                success: function(data)
                {
                    $('#addCourse_Modal').modal('hide');
                    $('#form_addCourse')[0].reset();
                    executeNotif('Successfully added course', 'success');
                    getCourses();
                }
            });
        });

        //CALCULATE AGE by Date of birth
        $('.bdate').on('change', function(e){
            e.preventDefault();
            var year_bday = $('.bdate').val().split('/')[2];
            var year_now = new Date().getFullYear();
            $('#age').val(year_now-year_bday);
        });
                   
        function getCourses()
        {
            $.ajax({
                url: '<?=base_url('admin/students/getCourse')?>',
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $("#course").empty();
                    $("#course").append("<option value='' disabled selected>-- Select course --</option>");
                    $.each(data, function(index,element){
                        $("#course").append("<option value='"+element.ID+"'>"+element.course_code+" - "+element.course_description+"</option>");
                        
                    });
                },
                error: function(data)
                {
                }
            });
        }    
    });
</script>