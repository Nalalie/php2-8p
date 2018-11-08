
{% include 'header.html' %}
    
    <!-- Основной блок -->
    <div class="main">
    
    <!-- Левый блок -->
    <div class="left">
        
        <!-- Меню -->
	{% include 'menu.html' %}
        
        <div class="open">
            <p>now<br>is<br>open!</p>
        </div>
        
    </div>
        
    <!-- Правый блок -->
    <div class="right">
	<div class="tovar_catalog">
 	{% include 'basket/basket_catalog.php' %}
	</div>
		
    <!-- Нижняя часть главного блока -->
	{% include 'brand.html' %}
        
	{% include 'instagram.html' %}
    
     {% include 'network.html' %}
    </div>
    
     
    
    </div>
	{% include 'footer.html' %} 
</body>
    
</html>