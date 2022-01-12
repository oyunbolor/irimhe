// JavaScript Document
$(document).ready(function(){          
	$("select#menuname").change(function(){
		var menu_id = $("select#menuname option:selected").attr('value');
		$.post("get_submenu.php", {menuid:menu_id}, function(data){
			$("select#subname").html(data);
		});
	});
});
$(document).ready(function(){          
	$("select#subname").change(function(){
		var sub_id = $("select#subname option:selected").attr('value');
		$.post("get_submenu1.php", {subid:sub_id}, function(data){
			$("select#subname2").html(data.sub_name2);
		}, "json");
	});
});	

$(document).ready(function(){          
	$("select#menuname").change(function(){
		var menu_id = $("select#menuname option:selected").attr('value');
		$.post("get_submenu2.php", {menuid:menu_id}, function(data){
			$("select#subname").html(data.sub_name);
			$("select#subname2").html(data.sub_name2);
		}, "json");
	});
});	

// $(document).ready(function(){
//     $('[data-toggle="popover"]').popover();   
// });


$(document).ready(function () {
	$("form#changeform").change(function () {
		document.changeform.submit();
	});
});




$(document).ready(function () {
	$(".datepicker").datepicker({
		showOn: "button",
		showButtonPanel: true,
		buttonImage: "images/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Огноо сонгох",
		dateFormat: "yy-mm-dd",
		closeText: 'Хаах',
		currentText: 'Өнөөдөр',
		prevText: 'Өмнөх',
		nextText: 'Дараах',
		monthNames: ['1-р сар', '2-р сар', '3-р сар', '4-р сар', '5-р сар', '6-р сар', '7-р сар', '8-р сар', '9-р сар', '10-р сар', '11-р сар', '12-р сар'],
		dayNamesMin: ['Ня', 'Да', 'Мя', 'Лх', 'Пү', 'Ба', 'Бя'],
		dayNames: ['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Перэв', 'Баасан', 'Бямба'],
		weekHeader: 'Бям.',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
	});
});