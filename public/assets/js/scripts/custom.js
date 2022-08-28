function OpenModal(form_action,modal_id = "form_modal"){
    $("#form").attr("action",form_action)
    $('#form').trigger("reset");
    $("#"+modal_id).modal("show")    
}
function get_record_details_ajax(component,id){
    //Ajax Requiest for set modal fileds data
    return $.ajax({type:"GET",url:window.location.origin+"/get_"+component+"/"+id,dataType: "json",});
}