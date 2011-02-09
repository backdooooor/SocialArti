$(document).ready(function(){
	
	// Элемент select, который будет замещаться:
	var select = $('select.makeMeFancy');

	var selectBoxContainer = $('<div>',{
		width		: select.outerWidth(),
		className	: 'tzSelect',
		html		: '<div class="selectBox"></div>'
	});

	var dropDown = $('<ul>',{className:'dropDown'});
	var selectBox = selectBoxContainer.find('.selectBox');
	
	// Цикл по оригинальному элементу select
	
	select.find('option').each(function(i){
		var option = $(this);
		
		if(i==select.attr('selectedIndex')){
			selectBox.html(option.text());
		}
		
		// Так как используется jQuery 1.4.3, то мы можем получить доступ 
		// к атрибутам данных HTML5 с помощью метода data().
		
		if(option.data('skip')){
			return true;
		}
		
		// Создаем выпадающий пункт в соответствии
		// с иконкой данных и атрибутами HTML5 данных:
		
		var li = $('<li>',{
			html:	'<img width=50px height=50px src="'+option.data('icon')+'" /><span>'+
					option.data('html-text')+'</span>'
		});
				
		li.click(function(){
			
			selectBox.html(option.text());
			dropDown.trigger('hide');
			
			// Когда происходит событие click, мы также отражаем
			// изменения в оригинальном элементе select:
			select.val(option.val());
			
			return false;
		});
		
		dropDown.append(li);
	});
	
	selectBoxContainer.append(dropDown.hide());
	select.hide().after(selectBoxContainer);
	
	// Привязываем пользовательские события show и hide к элементу dropDown:
	
	dropDown.bind('show',function(){
		
		if(dropDown.is(':animated')){
			return false;
		}
		
		selectBox.addClass('expanded');
		dropDown.slideDown();
		
	}).bind('hide',function(){
		
		if(dropDown.is(':animated')){
			return false;
		}
		
		selectBox.removeClass('expanded');
		dropDown.slideUp();
		
	}).bind('toggle',function(){
		if(selectBox.hasClass('expanded')){
			dropDown.trigger('hide');
		}
		else dropDown.trigger('show');
	});
	
	selectBox.click(function(){
		dropDown.trigger('toggle');
		return false;
	});

	// Если нажать кнопку мыши где-нибудь на странице при открытом элементе dropDown,
	// он будет спрятан:
	
	$(document).click(function(){
		dropDown.trigger('hide');
	});
});