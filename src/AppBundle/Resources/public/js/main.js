/**
 * Clouds 
 */
//ф-я сбора информации с формы
function getData(obj_form){
    var hData={};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name !=''){
            hData[this.name]=this.value;
        }
    });
    return hData;
};

//ф-я удаления исполнителя
function removePerformer(id){
    $.ajax({
        type: 'POST',
        async: false,
        url: "/performer/remove/"+id,
        dataType: 'json',
        success: function(response){
            if(response['success']){
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
        type: 'POST',
        async: false,
        url: "/task/remove/"+id,
        dataType: 'json',
        success: function(response){
            if(response['success']){
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
                        $('#taskPerformer').append('<option value="' + key + '">' + value + '</option>');
                    });
                }else {
                    alert('NOT TASK');
            }
        }
    });  
    $("#addTask").modal({backdrop: "static"});
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
            success: function(data){
                if(data['success']){
                    alert(data['massage']);
                    document.location = '/task';
                }else {
                   alert(data['massage']);
                   document.location = '/';
                }
            }
        });
    });
}