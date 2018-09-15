<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
<div class="content-wrapper">
    <!-- // MODALS -->
<div class="modal fade" id="editCourse_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editCourse'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Course</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">Department</label>
                        <select class='form-control' id='departmentid1' name='departmentid1' required>
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type='text' name='course_code1' id='course_code1' class='form-control' >
                        <input type='hidden' name='ID' id='ID'>

                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type='text' name='course_description1' id='course_description1' class='form-control' ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type='number' name='course_year1' id='course_year1' class='form-control' >
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

<!-- // MODALS -->
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            <!--LEFT DIV  -->
            <div class="col-md-3">
                
                <div class="box box-success box-solid">
                    <div class="box-header ">
                    <h3 class="box-title">New Course</h3>
                    </div>
                    <?php echo form_open('', array("id" => "form_addCourse")); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="code">Department</label>
                            <select class='form-control' id='departmentid' name='departmentid' required>
                            
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <?php echo form_input($course_code);?>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type='text' name='course_description' id='course_description' placeholder='Description' class='form-control' ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <?php echo form_input($course_year);?>
                       
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class='pull-right'>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Submit</button> &nbsp;
                            <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>
                  
            </div>
            <!--RIGHT DIV  -->
            <div class="col-md-9">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h3 class="box-title">List of Course</h3>
                    
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                        <input type="text" id="table_search" class="form-control pull-right" placeholder="Search course">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive" id="courseTable">
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
    
    $(function(){
        // GET COURSE
        displayCourse();
        populateComboBoxDepartmentID("departmentid","");
        function displayCourse()
        {
            LoadDataFromUrlToTable('courses/getAll', 'courseTable');
        }

        function populateComboBoxDepartmentID(departmentid,dataFromDB)
        {
            let request = $.ajax({
                url: '<?=base_url('admin/departments/getDepartments')?>',
                data: '',
                dataType: 'json'
            });
            request.done(function(data){
                $("#"+departmentid+"").empty();
                $("#"+departmentid+"").append("<option value=''>-- Select department --</option>");
                $.each(data, function(index,element){
                    if(dataFromDB == element.ID)
                    {   
                        $("#"+departmentid+"").append("<option value='"+element.ID+"' selected>"+element.Department+"</option>");
                    }
                    else
                    {
                        $("#"+departmentid+"").append("<option value='"+element.ID+"'>"+element.Department+"</option>");
                    }
                });
            });
        }

        // POST COURSE
        $('#form_addCourse').on('submit', function(e){
            e.preventDefault();
            PostDataToUrl($(this).serialize(), 'courses/add').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addCourse')[0].reset();
                        toastr.success(data.content.message);
                        displayCourse();
                        break;
                    default:
                        break;
                }
            });
        });
        
        $('#form_editCourse').on('submit', function(e){
            e.preventDefault();
            PutDataToUrl($(this).serialize(), 'courses/edit').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_editCourse')[0].reset();
                        $('#editCourse_modal').modal('hide');
                        toastr.success(data.content.message);
                        displayCourse();
                        break;
                    default:
                        break;
                }
                
            });
        });

        //DELETE COURSE
        $(document).on('mouseover', 'a[class^="btn"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    DeleteDataFromUrl({id:id}, 'courses/delete').then(function(data){
                        toastr.success(data.content.message);
                        displayCourse();
                    })
                },
                onCancel: function(){}
            });  
        });

        // SELECT COURSE TO BE EDIT
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/courses/getCourse')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index,element){
                        $('#ID').val(element.ID);
                        $('#course_code1').val(element.course_code);
                        $('#course_description1').val(element.course_description);
                        $('#course_year1').val(element.course_year);
                        populateComboBoxDepartmentID("departmentid1",element.departmentid);
                    });
                    $('#editCourse_modal').modal('show');
                }
            });
        });

       
            




        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("courseTable");
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