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