  {% for item in content_data.catalog %}
            <div class="product"><a href="{{ domain }}good/{{ item.id_good }}/">
                <img src="/{{ item.foto }}">
                <div class="product_descript">
<div class="naming"><h1>{{ item.name }}</h1></div>
<div class="short_description">{{ item.short_description }} </div>
</a>
<a href="javascript:dell_basket_goods('#{{ item.id_good }}')">Удалить товар</a>				
</div>
            </div>
            
	{% endfor %}

	<form method="post" action="{{ domain }}order/">
    <input type="submit" name="basket_order" value="Оформить заказ">
	</form>