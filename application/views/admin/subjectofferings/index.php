<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
<!-- // MODALS -->
<div class="modal fade" id="editCourse_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method='post' id='form_editCourse'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Course</h4>
                </div>
                <div class="modal-body">
               
                        <div class='row'>
                        
                            <div class='col-xs-5'>
                                <div class="form-group">
                                    <label for="Gender">Subject</label>
                                    <input class='form-control' name='subject' id='subject' disabled>
                                </div>
                            </div>
                            
                            <div class='col-xs-3'>
                                <div class="form-group">
                                    <label for="Gender">Room</label>
                                    <select class='form-control' name='room' id='room' required>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class='col-xs-4'>
                                <div class="form-group">
                                    <label for="Gender">Instructor</label>
                                    <select class='form-control' name='instructor' id='instructor' required>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class='col-xs-2'>
                                <div class="form-group">
                                    <label for="Gender">Section</label>
                                    <input type='text' name='section' id='section' class='form-control'>
                                </div>
                            </div>    
                            <div class='col-xs-2'>
                                <div class="form-group">
                                    <label for="Gender">Slots</label>
                                    <input type='number' name='slot' id='slot' class='form-control'>
                                    <span class="help-block" id="slotHelp"></span>
                                </div>
                            </div>    
                            <div class='col-xs-2 bootstrap-timepicker'>
                                <div class="form-group">
                                    <label for="Gender">Timein</label>
                                    <input type='text' name='timein' id='timein' class='form-control timepicker'>
                                </div>
                            </div>            
                            <div class='col-xs-2 bootstrap-timepicker'>
                                <div class="form-group">
                                    <label for="Gender">Timeout</label>
                                    <input type='text' name='timeout' id='timeout' class='form-control timepicker'>
                                </div>
                            </div>
                            <div class='col-xs-4'>
                                <div class="form-group">
                                    <label for="Gender">Days</label><br />
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="M"> 
                                    </label> Monday &nbsp;
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="TH"> 
                                    </label> Tuesday &nbsp;
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="W"> 
                                    </label> Wednesday &nbsp;
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="TH"> 
                                    </label> Thursday &nbsp;
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="F"> 
                                    </label> Friday &nbsp;
                                    <label>
                                    <input type="checkbox" name="day[]" class="flat-red" value="SAT"> 
                                    </label> Saturday &nbsp;
                                </div>           
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
            
            <!--RIGHT DIV  -->
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h3 class="box-title">List of Subject Offerings</h3>

                    <div class="box-tools">
                        
                        <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                        
                            <input type="text" id="table_search" class="form-control pull-right" placeholder="Search student">
                            
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body table-responsive" id='subjectofferingTable'>
                            
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>


<script>
$('.timepicker').timepicker({
      showInputs: false
    })
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
    $(function(){
        

        // AJAX DISPLAY
        displaySubjectOfferings();

        function displaySubjectOfferings()
        {
            LoadDataFromUrlToTable('subjectofferings/getAll', 'subjectofferingTable')
        }

        
        function getInstructors(id)
        {
            let request = $.ajax({
                url: '<?=base_url('admin/instructors/getInstructor')?>',
                method: 'get',
                dataType: 'json'
            });
            request.done(function (data) {
                $("#instructor").empty();
                $("#instructor").append("<option value='' disabled selected>-- Select instructor --</option>");
                $.each(data, function(index,element){
                    if(element.ID == id)
                    {
                        $("#instructor").append("<option value='"+element.ID+"' selected>"+element.instructor_name+" - "+element.instructor_position+"</option>");
                    }
                    else
                    {
                        $("#instructor").append("<option value='"+element.ID+"'>"+element.instructor_name+" - "+element.instructor_position+"</option>");
                    }
                });
            });
        }
       
        function getRooms(id)
        {
            let request = $.ajax({
                url: '<?=base_url('admin/rooms/getRooms')?>',
                method: 'get',
                dataType: 'json'
            });
            request.done(function (data) {
                $("#room").empty();
                    $("#room").append("<option value='' disabled selected>-- Select room --</option>");
                    $.each(data, function(index,element){
                        if(element.ID == id)
                        {
                            $("#room").append("<option value='"+element.ID+"' selected>"+element.room_building_name+" - "+element.room_number+"</option>");
                        }
                        else
                        {
                            $("#room").append("<option value='"+element.ID+"'>"+element.room_building_name+" - "+element.room_number+"</option>");
                        }
                    });
            });
            request.fail(function(data)
            {

            });
        }
        $(document).on('change', '#room', function(e){
            e.preventDefault();
            let id = $(this).val();
            let request = $.ajax({
                url: '<?=base_url('admin/rooms/getRoom')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json'
            });
            request.done(function(data){
                $("#slotHelp").html('Required ' +data.room_capacity+' slots');
            })
        });

        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("subjectofferingTable");
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
        //SELECT SUBJECTOFFERING
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/subjectofferings/getSubjectOffering')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    getInstructors(data.instructor_id);
                    getRooms(data.room_id);
                    $('#subject').val(data.subj_code +'-'+data.subj_description);
                    $('#section').val(data.subjectoffering_section);
                    $('#slot').val(data.subjectoffering_slots);
                    $('#timein').val(data.subjectoffering_timein);
                    $('#timeout').val(data.subjectoffering_timeout);
                    let days = data.subjectoffering_days;
                    let arr = days.split('-');
                    console.log(arr);
                    for(let i = 0; i < arr.length;i++) {
                        $(':checkbox[value="'+arr[i]+'"]').prop("check", true);
                    }
                    $('#editCourse_modal').modal('show');
                }
            });
        });

        //DELETE SUBJECTOFFERING
        $(document).on('mouseover', 'a[class^="btn"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    DeleteDataFromUrl({id:id}, 'subjectofferings/delete').then(function(data){
                        toastr.success(data.content.message);
                        displaySubjectOfferings();
                    })
                },
                onCancel: function(){}
            });  
        });
    });
</script>