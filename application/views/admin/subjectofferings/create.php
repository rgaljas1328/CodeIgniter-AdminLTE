

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            
            <div class="col-md-12" id='mainDiv'>
            
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">New Subject Offering</h3>
                    </div>
                   
                    <?php echo form_open('', array("id" => "form_addSubjectoffering")); ?>
                    <div class="box-body">
                        <div class='row'>
                            <div class='col-xs-5'>
                                <label>Department</label>
                                    <select class='form-control' name='department' id='department' required>
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                        
                            <div class='col-xs-5'>
                                <div class="form-group">
                                    <label for="Gender">Subject</label>
                                    <select class='form-control' name='subject' id='subject' required>
                                       
                                    </select>
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
                                    <input type='text' name='section' class='form-control'>
                                </div>
                            </div>    
                            <div class='col-xs-2'>
                                <div class="form-group">
                                    <label for="Gender">Slots</label>
                                    <input type='number' name='slot' class='form-control'>
                                    <span class="help-block" id="slotHelp"></span>
                                </div>
                            </div>    
                            <div class='col-xs-2 bootstrap-timepicker'>
                                <div class="form-group">
                                    <label for="Gender">Timein</label>
                                    <input type='text' name='timein' class='form-control timepicker'>
                                </div>
                            </div>            
                            <div class='col-xs-2 bootstrap-timepicker'>
                                <div class="form-group">
                                    <label for="Gender">Timeout</label>
                                    <input type='text' name='timeout' class='form-control timepicker'>
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

                    <div class="box-footer">
                        <div class='pull-right'>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button> &nbsp;
                            <button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="alert alert-danger alert-dismissible" id='helperSO' hidden>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <div>
                        <ol id="subjectofferingHelper">
                        </ol>
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

        //Display list of course options
        getDepartments();
        getRooms();
        getInstructors();
        
        
        $(document).on('submit', '#form_addSubjectoffering', function(e){
            e.preventDefault();
            let form = $(this).serialize();
            PostDataToUrl(form, 'add').then(function(data){
                console.log(data);
                $('#subjectofferingHelper').html('');
                if(data.content.message == null)
                {
                    let subjID = $('#mainDiv').attr("class");
                    if(subjID == "col-md-12")
                    {
                        $('#mainDiv').toggleClass("col-md-12 col-md-8");
                    }
                    else
                    {
                        $('#mainDiv').toggleClass("col-md-8 col-md-8");
                    }
                    
                    $('#helperSO').show();
                    $.each(data.content, function(index,element){
                        $('#subjectofferingHelper').append('<li>'+element+'</li>');
                    })
                    
                }
                else
                {
                    let subjID = $('#mainDiv').attr("class");
                    changeDiv(subjID);
                    toastr.success(data.content.message);
                    $('#form_addSubjectoffering')[0].reset();
                    $('#slotHelp').html('');
                    $('#helperSO').hide();
                    $('#subjectofferingHelper').html('');
                }

            })
            
        })

        function changeDiv(subjID)
        {
            if(subjID == "col-md-12")
            {
                $('#mainDiv').toggleClass("col-md-12 col-md-12");
            }
            else
            {
                $('#mainDiv').toggleClass("col-md-8 col-md-12");
            }
        }
        


        $(document).on('change', '#department', function(e){
            e.preventDefault();
            let id = $(this).val();
            let request = $.ajax({
                url: '<?=base_url('admin/departments/getSubjects')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json'
            });
            request.done(function(data){
                $("#subject").empty();
                $("#subject").append("<option value='' disabled selected>-- Select subject --</option>");
                $.each(data, function(index,element){
                    $('#subject').append("<option value='"+element.ID+"'>"+element.subj_code+" - "+element.subj_description+"</option>");
                });
            })
        });

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


        function getInstructors()
        {
            let request = $.ajax({
                url: '<?=base_url('admin/instructors/getInstructors')?>',
                method: 'get',
                dataType: 'json'
            });
            request.done(function (data) {
                $("#instructor").empty();
                $("#instructor").append("<option value='' disabled selected>-- Select instructor --</option>");
                $.each(data, function(index,element){
                    $("#instructor").append("<option value='"+element.ID+"'>"+element.instructor_name+" - "+element.instructor_position+"</option>");
                });
            });
        }
       
        function getRooms()
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
                    $("#room").append("<option value='"+element.ID+"'>"+element.room_building_name+" - "+element.room_number+"</option>");
                });
            });
            request.fail(function(data)
            {

            });
        }
        function getDepartments()
        {
            let request = $.ajax({
                url: '<?=base_url('admin/departments/getDepartments')?>',
                data: '',
                dataType: 'json'
            });
            request.done(function(data){
                $("#department").empty();
                $("#department").append("<option value=''>-- Select department --</option>");
                $.each(data, function(index,element){
                    $("#department").append("<option value='"+element.ID+"'>"+element.Department+"</option>");
                });
            });
        }    
    });
</script>
