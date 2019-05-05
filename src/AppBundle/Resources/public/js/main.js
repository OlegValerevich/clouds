/**
 * Clouds 
 */

//ф-я удаления исполнителя
function removePerformer(id){
    $.ajax({
        type: 'GET',
        async: false,
        url: "/performer/remove/"+id,
        dataType: 'json',
        success: function(rs){
            if(rs['success']){
                $('#removePerf_'+id).hide();
            }else{
                alert('Ошибка! Операция не выполнена');
           }
        }
    });   
}

//ф-я удаления задачи
function removeTask(id){
    $.ajax({
        type: 'GET',
        async: false,
        url: "/task/remove/"+id,
        dataType: 'json',
        success: function(rs){
            if(rs['success']){
                $('#removeTask_'+id).hide();
            }else{
                alert('Ошибка! Операция не выполнена');
           }
        }
    });   
}

function addTask(){
    $(document).ready(function(){ 
        $.ajax({
            type: 'POST',
            async: false,
            url: "/task/add",
            dataType: 'json',
            success: function(rs){
                if(rs['success']){
                    $('#taskPerformer').empty();
                    $.each(rs['performers'], function(key, value) {
                        $('#taskPerformer').append('<option value="' + key + '">' + value + '</option>');});
                        $("#addTask").modal({backdrop: "static"});
                }else {
                    alert(rs['massage']);
                    document.location = '/';
            }
        }
    });  
    
  });  
}

function saveNewTask(){
    $(document).ready(function(){
        var postData = {name: $('#taskName').val(), performer: $('#taskPerformer').val(),
                status: $('#taskStatus').val(), description: $('#taskDescription').val()};
        $.ajax({
            type: 'POST',
            async: false,
            url: "/task/update",
            data: postData,
            dataType: 'json',
            success: function(rs){
                if(rs['success']){
                    alert(rs['massage']);
                    document.location = '/task';
                }else {
                   alert(rs['massage']);
                   document.location = '/';
                }
            }
        });
    });
}