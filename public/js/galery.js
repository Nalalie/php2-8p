// JavaScript Document

function Photogalery(var3){
          $.ajax({ type: 'POST', url: 'select.php', data: { var1: 'ajax', var2: 'test2', vars: var3}, success: function(response){
                    $('.leftImage').html(response.varL), $('.RightImage').html(response.varR), $('.Centrimage').html(response.Centrimage), $(response.leftImage).html(response.varL);
                 },
                 dataType:"json"
          });
};



$(document).ready(function(){
          $.ajax({ type: 'POST', url: 'select.php', success: function(response){
                    $('.leftImage').html(response.varL), $('.RightImage').html(response.varR), $('.Centrimage').html(response.Centrimage);
                 },
                 dataType:"json"
          });
});




