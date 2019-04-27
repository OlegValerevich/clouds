
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


function readFile(){
    
    console.log("js-readFile" );
       
    var files = $('#upload').prop("files")[0];
    
    if(typeof files == 'undefined') 
        
    return alert('Файл не выбран!');
    
    var Data = new FormData();
    
    Data.append('file', files);
    Data.append('success', 1);
        
    console.log(files);
        
    $.ajax({
        type: 'POST',
        async: false,
        url: "/mylocal/www/index.php/?controller=file&action=readTextFromFile",
        data: Data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data){
           if(data['success']){ 
            $('#text').html(data['text']);
            
            if($('#txtBox').css('dispaly') != 'block') {
                $('#txtBox').show();
            }else{
                $('#txtBox').hide();
            }
            
           }else{
               alert(data['massage']);
           }
        }
    });
}