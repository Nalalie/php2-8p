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
        
        {% include 'catalog/product_info.php' %}

     
     
        {% include 'top-product.html' %} 
        
		{% include 'new-product.html' %}
        
        {% include 'network.html' %}

        </div>
    </div>
    
     
    
    </div>

	{% include 'footer.html' %}    

</body>
    
</html>