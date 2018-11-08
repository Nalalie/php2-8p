// JavaScript Document

function register(){
	var login = encodeURI(document.getElementById('login').value);
	var password = encodeURI(document.getElementById('pass').value);
	var rememberme = encodeURI(document.getElementById('rememberme').checked);
	var rememberme2 = encodeURI(document.getElementById('rememberme').checked);
          $.ajax({ type: 'POST', url: '/index.php', data: { metod: 'ajax', PageAjax: 'register', var3: rememberme2, login: login, pass: password, rememberme: rememberme}, success: function(response){
                    $('#autorize').html(response);
                 },
				 dataType:"json"
          });
	};


 
function add_basket(var3) { 
 var var4 = $(var3).attr("data-product-guid");
 var count = encodeURI(document.getElementById('i2').value);
          $.ajax({ type: 'POST', url: '/index.php', data: { metod: 'ajax', PageAjax: 'basket', var4: var4, count_goods: count}, success: function(response){
                    $('#basket').html(response);
                 },
				 dataType:"json"
          });
   }

 function add_basket_one(var3) { 
 var var4 = $(var3).attr("data-product-guid");
          $.ajax({ type: 'POST', url: '/index.php', data: { metod: 'ajax', PageAjax: 'addGoods', uid: var4}, success: function(response){
                    $('#basket').html(response);
                 },
				 dataType:"json"
          });alert(var4);
   }  
   

function clear_basket() { 
          $.ajax({ type: 'POST', url: '/index.php', data: { metod: 'ajax', PageAjax: 'clear_basket'}, success: function(response){
                    $('#basket').html(response);
                 },
				 dataType:"json"
          });
   }


 function see_additional_goods(var3) { 
 var count = $(var3).attr("count_tovar");
 var category = $(var3).attr("category");
 var current_record = $(var3).attr("current_record");
          $.ajax({ type: 'POST', url: '/index.php', data: { metod: 'ajax', PageAjax: 'see_additional_goods', count: count, category: category, current_record: current_record}, success: function(response){
                    $('#button_see_additional_goods').after(response);
					$('#button_see_additional_goods').remove();
                 },
				 dataType:"json"
          });
   } 



