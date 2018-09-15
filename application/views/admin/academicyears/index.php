<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<div class="content-wrapper">
<!-- // MODALS -->
<div class="modal fade" id="editAY_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editAcademicYear'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Add course</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Academic Year</label>
                            <div class='row'>
                                <div class='col-xs-6'>
                                    <input type='number' name='academicyear_yearfrom' id='academicyear_yearfrom' class='form-control input-lg' disabled>
                                </div>
                                <div class='col-xs-6'>
                                    <input type='number' name='academicyear_yearto' id='academicyear_yearto' class='form-control input-lg' required>
                                </div>
                                <input type='hidden' name='ID' id='ID'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Term</label>
                            <select class='form-control' name='academicyear_termedit' id='academicyear_termedit' required>
                                <option>First Semester</option>
                                <option>Second Semester</option>
                                <option>Summer</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class='form-control' name='academicyear_status1' id='academicyear_status1' required>
                                <option>Active</option>
                                <option>Inactive</option>
                                
                            </select>
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
                    <h3 class="box-title">New Academic Year</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open('', array("id" => "form_addAcademicYear")); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="code">Year</label>
                            <div class='row'>
                                <div class='col-xs-6'>
                                    <?php echo form_input($academicyear_year);?>
                                </div>
                                <div class='col-xs-6'>
                                    <?php echo form_input($academicyear_year2);?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="description">Term</label>
                            <select class='form-control' name='academicyear_term' id='academicyear_term' required>
                                <option value=''>-- Select term --</option>
                                <option>First Semester</option>
                                <option>Second Semester</option>
                                <option>Summer</option>
                            </select>
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
                    <h3 class="box-title">List of Academic Year with Term</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                                <input type="text" id="table_search" class="form-control pull-right" placeholder="Search academic year">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive" id='academicyearTable'>
                        
                    </div>
                    <div class="overlay" id='overlay'>
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
 
 
<script type="text/javascript">
   

    $(function(){
        displayAcademicYears();
        // AJAX DISPLAY

        var date = new Date();
        $('#academicyear_year').val(date.getFullYear());
        $('#academicyear_year2').val((date.getFullYear() + 1));
        
        


        $(document).on('change', function(e){
            e.preventDefault();
            var newValue = 0;
            var value2 = $('#academicyear_year2').val();
            var value1 = $('#academicyear_year').val();
            var diff = value2 - value1;
            
            newValue = Number(value2) - 1;
            $('#academicyear_year').val(newValue);
        });

        $(document).on('change', function(e){
            e.preventDefault();
            var newValue = 0;
            var value2 = $('#academicyear_yearto').val();
            var value1 = $('#academicyear_yearfrom').val();
            var diff = value2 - value1;
            
            newValue = Number(value2) - 1;
            $('#academicyear_yearfrom').val(newValue);
        });
        // ADD  ACADEMIC YEAR
        $('#form_addAcademicYear').on('submit', function(e){
            e.preventDefault();
            
            let data = $(this).serialize();
            PostDataToUrl(data, 'academicyears/add').then(function(data)
            {
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addAcademicYear')[0].reset();
                        toastr.success(data.content.message);
                        displayAcademicYears();
                        break;
                    default:
                        break;
                }
            })
        });
        // EDIT ACADEMIC YEAR
        $('#form_editAcademicYear').on('submit', function(e){
            e.preventDefault();
            let data = $(this).serialize();
            PutDataToUrl(data, 'academicyears/edit').then(function(data)
            {
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_editAcademicYear')[0].reset();
                        $('#editAY_modal').modal('hide');
                        toastr.success(data.content.message);
                        displayAcademicYears();
                        break;
                    default:
                        break;
                }
            })
        });

        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("academicyearTable");
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

        function displayAcademicYears()
        {
            LoadDataFromUrlToTable('academicyears/getAll', 'academicyearTable');
        }


        //EDIT BUTTON
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/academicyears/getAcademicYear')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    var result = $('#academicyear_termedit option[value!=""]').first().html();
                    $("#academicyear_termedit option[value='"+result+"']").remove();

                    var result1 = $('#academicyear_status1 option[value!=""]').first().html();
                    $("#academicyear_status1 option[value='"+result1+"']").remove();

                    $.each(data, function(index,element){
                        var acadYear = element.academicyear_year.split('-');
                        
                        $('#academicyear_yearfrom').val(acadYear[0]);
                        $('#academicyear_yearto').val(acadYear[1]);
                        
                        $('#academicyear_termedit').prepend('<option value="'+element.academicyear_term+'"  selected>'+element.academicyear_term+'</option>');
                        $('#academicyear_status1').prepend('<option value="'+element.academicyear_status+'"  selected>'+element.academicyear_status+'</option>');
                        $('#ID').val(element.ID);

                    });
                    
                    $('#editAY_modal').modal('show');
                }
            });
        });

        //DELETE
        $(document).on('mouseover', 'a[id^="delete"]', function(e){
            e.preventDefault();
            $('a[id^="delete"]').confirmation({
                onConfirm: function(){
                    let id = ($(this)[0].id).split('_')[1];
                    DeleteDataFromUrl({id: id}, 'academicyears/delete').then(function(data){
                        toastr.success(data.content.message);
                        displayAcademicYears();
                    });
                },
                onCancel: function(){}
            });
        });
    });
</script>






