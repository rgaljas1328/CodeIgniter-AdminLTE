<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<div class="content-wrapper">
    <div class="modal fade" id="creditSubject">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method='post' id='form_creditSubject'>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span></button>
                        <h4 class="modal-title">Credit Subject</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Subject</label>
                            <textarea id='subject' class='form-control' disabled></textarea>
                            <input type='hidden' id='studentID' name='studentID'>
                            <input type='hidden' id='subjID' name='subjID'>
                        </div>
                        <div class='row'>
                            <div class='col-xs-6'>
                                <label>Grade</label>
                                <input type='text' name='grade' id='grade' class='form-control' required>
                            </div>
                            <div class='col-xs-6'>
                                <label>Taken</label>
                                <input type='number' name='taken' id='taken' class='form-control' required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save credit</button>
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
            <!--LEFT DIV  -->
            <div class="col-md-3">
                <?php $this->load->view('/partial/searchStudent.php'); ?>
            </div>
            <!--RIGHT DIV  -->
            <div class="col-md-9">
                <?php $this->load->view('partial/proceedEvaluation.php'); ?>
            </div>
            
        </div>
    </section>
</div>



<script>
    $('.sidebar-mini').toggleClass("skin-blue fixed sidebar-mini skin-blue fixed sidebar-mini sidebar-collapse");
    $(document).on('click', 'button[id^="credit"]', function(e){
        let tempID = ($(this)[0].id).split('_');
        let id = tempID[1];
        let studentID = $('#studentID').val();
        $('#subjID').val(id);
        $('#subject').val(tempID[2]+' - '+tempID[3]);

        let request = $.ajax({
            url: '<?=base_url('admin/subjectcreditings/getCredit')?>',
            method: 'get',
            data: {id: studentID, subj_id : id},
            dataType: 'json'
        });

        request.done(function(data){
            if(data !== null)
            {
                $('#grade').val(data.subjectcrediting_grade);
                $('#taken').val(data.subjectcrediting_taken);
            }
        });
        $('#creditSubject').modal('show');
        

    });


    $(document).on('mouseover', 'a[class^="btn"]', function(e){
        e.preventDefault();
        let id = ($(this)[0].id).split('_')[1];
        let studentID = $('#studentID').val();
        $('#'+$(this)[0].id+'').confirmation({
            onConfirm: function(){
                DeleteDataFromUrl({subj_id:id, student_id: studentID}, 'subjectcreditings/delete').then(function(data){
                    executeEvaluation(studentID);
                    toastr.success(data.content.message);
                })
            },
            onCancel: function(){}
        });  
    });


    $(document).on('submit','#form_creditSubject', function(e){
        e.preventDefault();
        let student = $('#studentID').val();
        PostDataToUrl($(this).serialize(), 'subjectcreditings/add').then(function(data){
            executeEvaluation(student);
            $('#creditSubject').modal('hide');
            $('#form_creditSubject')[0].reset();
        }); 
    });
    function executeEvaluation(id)
    {
        let firstRequest = $.ajax({
            url: '<?=base_url('admin/evaluations/proceedtoEvaluation')?>',
            data: {student_id:id},
            method: 'get',
            dataType: 'json'
        });
        firstRequest.done(function(data){
            $('#studentID').val(data.ID);
            $('#courseDescription').html('<center><h2><b>'+data.Name+'</b></h2><h3>'+data.course_description+'</h3></center><input type="hidden" id="studentID" name="studentID" value="'+data.ID+'">');
            LoadDataFromUrlToTable('<?=base_url('admin/prospectus/getAll?id=')?>'+data.course_id+'&id1='+data.ID, 'evaluationTable');
            
        });
    }
</script>