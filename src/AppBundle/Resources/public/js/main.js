/**
 * Clouds 
 */
//ф-я сбора информации с формы
function getData(obj_form){
    var hData={};
    $('input, textarea', obj_form).each(function(){
        if(this.name && this.name !=''){
            hData[this.name]=this.value;
            console.log('hData['+this.name+'] = '+ hData[this.name]);
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

//function addTask(){
//    
//    console.log("addTask");
//    
//    var myModal = new jBox('Modal', {
//    width:500,
//    height: 500,
//    title: 'Добавление задачи',
//    ajax: {
//      url: '/task/test',
////      data: {
////        id: 1
////      },
//    reload: true,
//    setContent: true,
//    success: function (response) {
//        console.log('jBox AJAX response', response);
//        this.setContent(response);
//      },
//      error: function () {
//        console.log('jBox AJAX NOT ');
////        this.setContent('<b style="color: #d33">Error loading content.</b>');
//      }
//    }
//  });
//  myModal.open();
//}

//$(document).ready(function(){
//  
//    
//    var myModal = new jBox('Modal', {
//        attach: $('#btnModal'),
//        width:500,
//        height: 500,
////        trigger: click,
//        content: $('#Modal')
//        
//    });
//    
//    myModal.open();
//});

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