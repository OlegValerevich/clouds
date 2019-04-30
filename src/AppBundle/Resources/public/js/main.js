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

//function removePerformer(id){
//    
//    $.ajax({
//        type: 'POST',
//        async: false,
//        url: "/performer/remove/"+id,
//        dataType: 'json',
//        success: false
//    });   
//}

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

    var modal = new jBox('Modal', {
        confirmButton: 'Ok',
        cancelButton: 'No'
    });

modal.open();
// return alert('addPerformer');

}