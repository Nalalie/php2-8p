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
    	{% include 'bread_crumbs.html' %}

		<h1>Запрашиваемая вами таблица отстутствует или удалена. Воспользуйтесь поиском по сайту.</h1>
		
		{% include 'new-product.html' %}
        
		{% include 'top-product.html' %}
        
		{% include 'sale-product.html' %}
        
    </div>
        
    <!-- Нижняя часть главного блока -->
	{% include 'brand.html' %}
        
	{% include 'instagram.html' %}
    
     {% include 'network.html' %}
    
    </div>
    
		{% include 'footer.html' %}
</body>
    
</html>