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

//ф-я добавления задачи
function addTask(){
    $(document).ready(function(){ 
        $.ajax({
            type: 'POST',
            async: false,
            url: "/task/add",
            dataType: 'json',
            success: function(rs){
                if(rs['success']){
                    $('#taskPerformer, #taskStatus').empty();
                    
                    $.each(rs['performers'], function(key, value) {
                        $('#taskPerformer').append('<option value="' + key + '">' + value + '</option>');
                    });

                    $.each(rs['status'], function(key, value) {
                        $('#taskStatus').append('<option value="' + key + '">' + value + '</option>');
                    });
                    
                    $("#addTask").modal({backdrop: "static"});
                }else {
                    alert(rs['massage']);
                    document.location = '/';
            }
        }
    });  
    
  });  
}

//ф-я сохранения задачи
function saveNewTask(){
    $(document).ready(function(){
        var postData = {name: $('#taskName').val(), performer: $('#taskPerformer').val(),
                status: $('#taskStatus').val(), description: $('#taskDescription').val()};

        var options = {
            width: 500,
            height: 200, 
            title: 'Статус операции',
            content: $('#infoTask'),
            onOpen: function () {
                $('#addTask').hide();
            },
            onClose: function() {
                document.location = '/task';  
            }
        };
        $.ajax({
            type: 'POST',
            async: false,
            url: "/task/update",
            data: postData,
            dataType: 'json',
            success: function(rs){
                var myModal = new jBox('Modal', options);

                if(rs['success']){
                    $('#card-title').html(rs['message']);
                    myModal.open();
                }else {
                    $('#card-title').html(rs['message']);
                    myModal.open();
                }
            }
        });
    });
}