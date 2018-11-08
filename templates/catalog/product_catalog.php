  {% for item in content_data.catalog %}
            <div class="product"><a href="{{ domain }}good/{{ item.id_good }}/">
                <img src="/{{ item.foto }}">
                <div class="product_descript">
<div class="naming"><h1>{{ item.name }}</h1></div>
<div class="short_description">{{ item.short_description }} </div>
</a><div class="buttons_sale"><a href="javascript:add_basket_one('#{{ item.id_good }}')" id="{{ item.id_good }}" data-product-guid="{{ item.ID_UUID }}" class="button11">€ {{ item.price }}</a></div>
</div>
            </div>
            
	{% endfor %}
    
    {% if content_data.out_row %} 
<span id="button_see_additional_goods">   
<a href="javascript:see_additional_goods('.button2')" class="button2" tabindex="0" count_tovar="6" current_record="{{ content_data.current_record }}" category="{{ content_data.category }}">кнопка</a>
</span>
	{% endif %}