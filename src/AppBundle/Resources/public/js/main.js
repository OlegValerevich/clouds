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

