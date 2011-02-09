<table   cellspacing=20 >
<tr>
<td><img  width=25px height=25px src='../photo/{photo}' align='left' ></td>
<td>
<a href='#' onclick='showFlash({id_flash})'>{title}</a><br><hr>{description}<br>
<br></td>
</tr>
</table>
<br>
<div id='flash_{id_flash}' style='display:none;'>
<object data='../flash/{id_flash}.swf' type='application/x-shockwave-flash' height='400px' width='400px'>
<param value='true' name='menu'/>
<param value='high' name='quality'/>
<param value='transparent' name='wmode'/>
<div>Тест для поисковиков и браузеров не поддерживающих плагины</div>
<embed type='application/x-shockwave-flash' src='../flash/{id_flash}.swf' width='400px' height='400px' />
</object></div><br/>