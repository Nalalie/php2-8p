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
 
 	<a href="{{ domain }}galery/galery/">Фотогаллерея классическая</a> <br>
    <a href="{{ domain }}galery/galery_ajax/">Фотогаллерея AJAX</a>       
        
    <!-- Нижняя часть главного блока -->
	{% include 'brand.html' %}
        
	{% include 'instagram.html' %}
    
     {% include 'network.html' %}
    </div>
    
     
    
    </div>
	{% include 'footer.html' %} 
</body>
    
</html>