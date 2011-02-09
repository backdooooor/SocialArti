var IE='\v'=='v';

$(document).ready(function () {


	

 $('#accordion-2').easyAccordion({
			autoStart: false
	});

	
   doGo();

$('#windowClose').bind(

'click',

function()

{
if(!IE){
$('#window').TransferTo(

{

to:'windowOpen',

className:'transferer2',

duration: 400

}

).hide();
}
}

);
$('#windowMin').bind(

'click',

function()

{

$('#windowContent').SlideToggleUp(300);

$('#windowBottom, #windowBottomContent').animate({height: 10}, 300);

$('#window').animate({height:40},300).get(0).isMinimized = true;

$(this).hide();

$('#windowResize').hide();

$('#windowMax').show();

}

);
if(!IE){
$('#window').Resizable(

{

minWidth: 200,

minHeight: 60,

maxWidth: 700,

maxHeight: 400,

dragHandle: '#windowTop',

handlers: {


se: '#windowResize'

},

onResize : function(size, position) {

$('#windowBottom, #windowBottomContent').css('height', size.height-33 + 'px');

var windowContentEl = $('#windowContent').css('width', size.width - 25 + 'px');

if (!document.getElementById('window').isMinimized) {

windowContentEl.css('height', size.height - 48 + 'px');

}

}

}

);
}
});
