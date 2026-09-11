<!--Code for Blank Multiple task -->
<div class="modal fade bs-modal-sm" id="alert_message_div" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"  style="background:#00124b;color:#fff">
       <h4 id="alert_message_div_header"></h4>
     </div>
     <div class="modal-body" id="alert_message_div_message">
      
     </div>
     <div class="modal-footer">
      <button class="btn badge btn-primary " data-dismiss="modal" aria-hidden="true">Ok <i class="fa fa-thumbs-up"></i></button>
    </div>
  </div>
</div>
</div>
{{-- END CODE FOR BLANK POPUP --}}



<!--Code for Confirm Multiple Task-->
<div class="modal fade bs-modal-sm" id="alert_confirm_div" tabindex="-1" role="dialog" aria-hidden="true" >
  <div class="modal-dialog modal-sm modal-dialog-centered" >
    <div class="modal-content">

      <form role="form" method="post" action="" class="ajax_form" id="DeleteMultipleForm">
        @csrf
        <div class="modal-header" style="background:#00124b;color:#fff">
         
          <h4 id="alert_message_div_header text-left" style="width: 100%;">Please Confirm </h4>
        </div>
        <input type="hidden" name="ids" value="" id="multiple_Ids">
        <input type="hidden" name="task" value="" id="task">
        <input type="hidden" name="invoicedate_confirm" value="" id="invoicedate_confirm">

        <input type="hidden" name="cancellationCharges" value="" id="cancellationCharges">
        <input type="hidden" name="commisionPaid" value="" id="commisionPaid">
        <input type="hidden" name="tdsPaid" value="" id="tdsPaid">
        
        <div class="modal-body">
          <p id="confirm_alert_message_body"></p>
        </div>
        <div class="modal-footer">
          <button class="btn badge btn-danger" data-dismiss="modal">Cancel <i class="fa fa-times"></i></button>
          <button class="btn badge btn-success" type="submit">Confirm <i class="fa fa-check"></i></button>
        </div>
      </form>     
    </div>
  </div>
</div>
<!--End Code for Confirm Multiple Task-->




<script>
    
    window.setTimeout(function() {
        $(".alert-common").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);


    function multiTaskOperation(task,$this){
        var selected = new Array();
        $("#example1 input.recordcheckbox:checked").each(function() {
            selected.push($(this).val());
        });
        if(selected.length==0){
            $("#alert_message_div").modal('show');
            $("#alert_message_div").find("#alert_message_div_header").text('Oh!');
            $("#alert_message_div").find("#alert_message_div_message").text('Please select at least one record');
        }
        else{
            var taskurl = $($this).attr('data-taskurl');    
            showConfirmDialogTableMultiple(task,taskurl);
        }
    }

    //Show Confirm Dialog Popup 
    function showConfirmDialogTableMultiple(task,taskurl){
        $('#alert_confirm_div').modal('show');
        $('#alert_confirm_div').find('#confirm_alert_message_header').text('Please Confirm');
        $('#alert_confirm_div').find('#confirm_alert_message_body').text('Are you sure you want to '+task+' the selected records ?');

        if(task=='Delete')
        $('#alert_confirm_div').find('.confirm_btn').addClass('btn-danger');

        $('#alert_confirm_div').find('#DeleteMultipleForm').attr('action',taskurl);

        var selected = new Array();
        $("#example1 input.recordcheckbox:checked").each(function() {
        selected.push($(this).val());
        });
        $('#alert_confirm_div').find('#multiple_Ids').val(selected);
        $('#alert_confirm_div').find('#task').val(task);
    }
    $(document).on('change','#example1 .group-checkable',function () {
        var set = $(this).attr("data-set");
        var checked = $(this).is(":checked");
        $(set).each(function () {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }                    
        });
        $.uniform.update(set);
    }); 
</script>