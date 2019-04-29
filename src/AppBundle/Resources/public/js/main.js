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

function removePerformer(id){
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/performer/remove/"+id,
        dataType: 'json',
        success: false
    });   
}

function removeTask(id){
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/task/remove/"+id,
        dataType: 'json',
        success: false
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