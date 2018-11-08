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

<div class="tovar_catalog">
  <div class="namecat">
    <h2 class="namecat">{{ content_data.name }}</h2>
  </div>
		{% include 'catalog/product_catalog.php' %}



</div>


        
    </div>
        
    <!-- Нижняя часть главного блока -->
	{% include 'brand.html' %}
        
	{% include 'instagram.html' %}
    
     {% include 'network.html' %} 
    
    </div>

	{% include 'footer.html' %}      

</body>
    
</html>