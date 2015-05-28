/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

efac = function () { };

efac.rootPath = '';

efac.infoBox = function (msg, callback) {
    ExistMsg=0;
    $.SmartMessageBox({
        title: "<i class='fa fa-refresh' style='color:green'></i> Información",
        content: msg,
        buttons: '[Aceptar]'
     }, callback);  
};

efac.confirmBox = function (title, msg, callback) {
    ExistMsg=0;
    $.SmartMessageBox({
        title: "<i class='fa fa-refresh' style='color:green'></i> " + title,
        content: msg,
        buttons: '[Aceptar][Cancelar]'
     }, function(button){
         if(button === 'Aceptar'){
             callback();
         }
     });  
};

efac.deleteBox = function (title, msg, callback) {
    ExistMsg=0;
    $.SmartMessageBox({
        title: "<i class='fa fa-trash' style='color:red'></i> " + title,
        content: msg,
        buttons: '[Aceptar][Cancelar]'
     }, function(button){
         if(button === 'Aceptar'){
             callback();
         }
     });  
};

efac.url = function(url){
    return efac.rootPath + url;
};


jQuery.validator.addMethod('numeroAutorizacion', function (value, element, param) {        
        var length = this.getLength($.trim(value), element);        
        return (length === 10 || length === 37);        
}, 'El número de autorización debe tener 10 o 37 digitos');



jQuery.extend($.validator.messages, {
    alphanumeric: "Ingrese letras, números y guines bajos",	
    nowhitespace: "No ingrese espacios"
});