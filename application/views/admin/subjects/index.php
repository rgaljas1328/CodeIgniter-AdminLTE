<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
<!-- // MODALS -->


<div class="modal fade" id="editmodal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editSubject'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Subject</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label for="code">Department</label>
                            <select class='form-control' id='departmentid1' name='departmentid1' required>
                            
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type='text' name='subj_code1' id='subj_code1' class='form-control' required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type='text' name='subj_description1' id='subj_description1' class='form-control' required>
                    </div>
                    <div class="form-group">
                        
                        <div class='row'>
                            <div class='col-xs-6'>
                                <label>Lecture Units</label>
                                <input type='number' name='subj_units_lec1' id='subj_units_lec1' class='form-control' required>
                            </div>
                            <div class='col-xs-6'>
                                <label>Laboratory Units</label>
                                <input type='number' name='subj_units_lab1' id='subj_units_lab1' class='form-control' required>
                            </div>
                            <input type='hidden' name='ID' id='ID'>
                        </div>
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
                    <div class="box-header with-border">
                        <h3 class="box-title">New Subject</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open('', array("id" => "form_addSubject")); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="code">Department</label>
                            <select class='form-control' id='departmentid' name='departmentid' required>
                            
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <?php echo form_input($subj_code);?>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <?php echo form_input($subj_description);?>
                        </div>
                        <div class="form-group">
                            <label for="year">Units (Lecture)</label>
                            <?php echo form_input($subj_units_lec);?>
                       
                        </div>
                        <div class="form-group">
                            <label for="year">Units (Laboratory)</label>
                            <?php echo form_input($subj_units_lab);?>
                       
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
            <!--RIGHT DIV  -->
            <div class="col-md-9">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">List of Subjects</h3>
                        
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                            <input type="text" id="table_search" class="form-control pull-right" placeholder="Search subject">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body table-responsive" id='subjectTable'>
                            
                        
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
        // GET SUBJECTS
        displaySubjects();
        populateComboBoxDepartmentID("departmentid","");
        function displaySubjects()
        {
            LoadDataFromUrlToTable('subjects/getAll', 'subjectTable');
        }

        $('#form_addSubject').on('submit', function(e){
            e.preventDefault();
            PostDataToUrl($(this).serialize(), 'subjects/add').then(function(data){
                if(data.content.status == 'duplicate')
                {
                    toastr.error(data.content.message);
                }
                else if(data.content.status == 'ok')
                {
                    $('#form_addSubject')[0].reset();
                    toastr.success(data.content.message);
                    $('#subj_code').focus();
                    displaySubjects();
                }
            });
        })
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

        // PUT SUBJECT
        $('#form_editSubject').on('submit', function(e){
            e.preventDefault();
            PutDataToUrl($(this).serialize(), 'subjects/edit').then(function(data){
                if(data.content.status == 'duplicate')
                {
                    toastr.error(data.content.message);
                    
                }
                else if(data.content.status == 'ok')
                {
                    $('#form_editSubject')[0].reset();
                    $('#editmodal').modal('hide');
                    toastr.success(data.content.message);
                    $('#subj_code').focus();
                    displaySubjects();
                }
            });
        });

        //DELETE SUBJECT
        $(document).on('mouseover', 'a[id^="delete"]', function(e){
            e.preventDefault();
            $('a[id^="delete"]').confirmation({
                onConfirm: function(){
                    var id = ($(this)[0].id).split('_')[1];
                    DeleteDataFromUrl({id:id}, 'subjects/delete').then(function(data){
                        toastr.success(data.content.message);
                        displaySubjects();
                    })
                },
                onCancel: function(){}
            });
        });

        // SELECT SUBJECT TO BE EDIT
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/subjects/getSubject')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index,element){
                        $('#subj_code1').val(element.subj_code);
                        $('#subj_description1').val(element.subj_description);
                        $('#subj_units_lec1').val(element.subj_units_lec);
                        $('#subj_units_lab1').val(element.subj_units_lab);
                        $('#ID').val(element.ID);
                        populateComboBoxDepartmentID("departmentid1",element.departmentid);
                    });
                    $('#editmodal').modal('show');
                }
            });
        });


        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("subjectTable");
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