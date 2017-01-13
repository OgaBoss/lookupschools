/**
 * Created by OluwadamilolaAdebayo on 1/11/16.
 */
$(document).ready(function(){
    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
   if(getUrlVars()["backPage"] != null ){
       $('.btn-facebook').attr('href', '/facebook?type=login;'+ getUrlVars()["backPage"]);
       $('.btn-google-plus').attr('href', '/google?type=login;'+ getUrlVars()["backPage"]);
   }
});
