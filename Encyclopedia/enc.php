<?
require_once "maincore.php";
require_once "subheader.php";
require_once "side_left.php";
include LOCALE.LOCALESET."clan.php";
include('config.php');
require_once "func/connect.php";
		  db_open();
 if(($min_lvl=='')||($max_lvl=='')){
	$min_lvl='0';
	$max_lvl='18';
	}
	else{
	$min_lvl=$_POST['min_lvl'];
	$max_lvl=$_POST['max_lvl'];
	}
if($market==''){
	$market='1';
	}
	else{
	$market=$_REQUEST['market'];
	}
opentable($locale['9002']);
if(isset($_REQUEST['market'])){
		if(isset($_REQUEST['type'])){
			$TypeArray = explode("/", $_REQUEST['type']);
			$type=$_REQUEST[type];
			$market=$_REQUEST[market];
			$ITEMS = mysql_query("SELECT items.* FROM items WHERE market='$market' AND type='w$type' AND level>='$min_lvl' AND level<='$max_lvl' ORDER BY items.price;");
			$num = (mysql_num_rows($ITEMS));
			if($num>0){
			while ($ITEM = mysql_fetch_assoc($ITEMS)) {
				$need=explode("|",$ITEM['need']);
				$par=explode("|",$ITEM['param']);				$iron_res=explode("|",$ITEM['iron_res']);				$wood_res=explode("|",$ITEM['wood_res']);				
				$bt=0;$tr_b='';$tr_s='';$bl_r='';$m=1;$iron='';$wood='';								foreach ($iron_res as $value) {				$ir=explode("@",$value);				switch($ir[0])				{					case 1: $iron.="&nbsp;Олово: <b>$ir[1]</b><br>";break;					case 2: $iron.="&nbsp;Медь: <b>$ir[1]</b><br>";break;					case 3: $iron.="&nbsp;Бронза: <b>$ir[1]</b><br>";break;					case 4: $iron.="&nbsp;Жалезо: <b>$ir[1]</b><br>";break;					case 5: $iron.="&nbsp;Латунь: <b>$ir[1]</b><br>";break;					case 6: $iron.="&nbsp;Маргонит: <b>$ir[1]</b><br>";break;					case 7: $iron.="&nbsp;Сталь: <b>$ir[1]</b><br>";break;					case 8: $iron.="&nbsp;Фахраль: <b>$ir[1]</b><br>";break;					case 9: $iron.="&nbsp;Акмонитал: <b>$ir[1]</b><br>";break;					case 10: $iron.="&nbsp;Серебро: <b>$ir[1]</b><br>";break;					case 11: $iron.="&nbsp;Булат: <b>$ir[1]</b><br>";break;					case 12: $iron.="&nbsp;Сильверит: <b>$ir[1]</b><br>";break;					case 13: $iron.="&nbsp;Золото: <b>$ir[1]</b><br>";break;					case 14: $iron.="&nbsp;Темное серебро: <b>$ir[1]</b><br>";break;					case 15: $iron.="&nbsp;Имперское золото: <b>$ir[1]</b><br>";break;					case 16: $iron.="&nbsp;Платина: <b>$ir[1]</b><br>";break;					case 17: $iron.="&nbsp;Альвийское серебро: <b>$ir[1]</b><br>";break;					case 18: $iron.="&nbsp;Мифрил: <b>$ir[1]</b><br>";break;					case 50: $iron.="&nbsp;Кожа: <b>$ir[1]</b><br>";break;					case 51: $iron.="&nbsp;Ткань: <b>$ir[1]</b><br>";break;									}}								foreach ($wood_res as $value) {				$ir=explode("@",$value);				switch($ir[0])				{					case 28: $wood.="&nbsp;Заготовка из орешника: <b>$ir[1]</b><br>";break;					case 29: $wood.="&nbsp;Заготовка из ивы <b>$ir[1]</b><br>";break;					case 30: $wood.="&nbsp;Заготовка из медного кактуса: <b>$ir[1]</b><br>";break;					case 31: $wood.="&nbsp;Сухая дифенбахия: <b>$ir[1]</b><br>";break;					case 32: $wood.="&nbsp;Заготовка из осины: <b>$ir[1]</b><br>";break;					case 33: $wood.="&nbsp;Заготовка из ольхи: <b>$ir[1]</b><br>";break;					case 34: $wood.="&nbsp;Сухая жимолость: <b>$ir[1]</b><br>";break;					case 35: $wood.="&nbsp;Заготовка из песчаной колючки: <b>$ir[1]</b><br>";break;					case 36: $wood.="&nbsp;Заготовка из березы: <b>$ir[1]</b><br>";break;					case 37: $wood.="&nbsp;Заготовка из фигового дерева: <b>$ir[1]</b><br>";break;					case 38: $wood.="&nbsp;Заготовка из липы: <b>$ir[1]</b><br>";break;					case 39: $wood.="&nbsp;Заготовка из Сосны: <b>$ir[1]</b><br>";break;					case 40: $wood.="&nbsp;Заготовка из бамбука: <b>$ir[1]</b><br>";break;					case 41: $wood.="&nbsp;Заготовка из тополя: <b>$ir[1]</b><br>";break;					case 42: $wood.="&nbsp;Заготовка из драцены: <b>$ir[1]</b><br>";break;					case 43: $wood.="&nbsp;Заготовка из бука: <b>$ir[1]</b><br>";break;					case 44: $wood.="&nbsp;Заготовка из тиса: <b>$ir[1]</b><br>";break;					case 45: $wood.="&nbsp;Заготовка из вяза: <b>$ir[1]</b><br>";break;					case 46: $wood.="&nbsp;Заготовка из эвкалипта: <b>$ir[1]</b><br>";break;					case 47: $wood.="&nbsp;Заготовка из граба: <b>$ir[1]</b><br>";break;					}}				
				foreach ($need as $value) {
				$treb=explode("@",$value);
				if($treb[0]==72)$treb[1]=$ITEM[level];
				if($treb[0]==71)$treb[1]=$ITEM[massa];
				switch($treb[0])
				{
					case 28: $tr_b.="&nbsp;Очки действия: <b>$treb[1]</b><br>";break;
					case 30: $tr_b.="&nbsp;Cила: <b>$treb[1]</b><br>";break;
					case 31: $tr_b.="&nbsp;Ловкость: <b>$treb[1]</b><br>";break;
					case 32: $tr_b.="&nbsp;Удача: <b>$treb[1]</b><br>";break;
					case 33: $tr_b.="&nbsp;Здоровье: <b>$treb[1]</b><br>";break;
					case 34: $tr_b.="&nbsp;Знания: <b>$treb[1]</b><br>";break;
					case 35: $tr_b.="&nbsp;Мудрость: <b>$treb[1]</b><br>";break;
					case 36: $tr_b.="&nbsp;Владение мечами: <b>$treb[1]</b><br>";break;
					case 37: $tr_b.="&nbsp;Владение топорами: <b>$treb[1]</b><br>";break;
					case 38: $tr_b.="&nbsp;Владение дробящим оружием: <b>$treb[1]</b><br>";break;
					case 39: $tr_b.="&nbsp;Владение ножами: <b>$treb[1]</b><br>";break;
					case 40: $tr_b.="&nbsp;Владение метательным оружием: <b>$treb[1]</b><br>";break;
					case 41: $tr_b.="&nbsp;Владение алебардами и копьями: <b>$treb[1]</b><br>";break;
					case 42: $tr_b.="&nbsp;Владение посохами: <b>$treb[1]</b><br>";break;
					case 43: $tr_b.="&nbsp;Владение экзотическим оружием: <b>$treb[1]</b><br>";break;
					case 44: $tr_b.="&nbsp;Владение двуручным оружием: <b>$treb[1]</b><br>";break;
					case 45: $tr_b.="&nbsp;Магия огня: <b>$treb[1]</b><br>";break;
					case 46: $tr_b.="&nbsp;Магия воды: <b>$treb[1]</b><br>";break;
					case 47: $tr_b.="&nbsp;Магия воздуха: <b>$treb[1]</b><br>";break;
					case 48: $tr_b.="&nbsp;Магия земли: <b>$treb[1]</b><br>";break;
					case 53: $tr_b.="&nbsp;Воровство: <b>$treb[1]</b><br>";break;
					case 54: $tr_b.="&nbsp;Осторожность: <b>$treb[1]</b><br>";break;
					case 55: $tr_b.="&nbsp;Скрытность: <b>$treb[1]</b><br>";break;
					case 56: $tr_b.="&nbsp;Наблюдательность: <b>$treb[1]</b><br>";break;
					case 57: $tr_b.="&nbsp;Торговля: <b>$treb[1]</b><br>";break;
					case 58: $tr_b.="&nbsp;Странник: <b>$treb[1]</b><br>";break;
					case 59: $tr_b.="&nbsp;Языковедение: <b>$treb[1]</b><br>";break;
					case 60: $tr_b.="&nbsp;Каллиграфия: <b>$treb[1]</b><br>";break;
					case 61: $tr_b.="&nbsp;Ювелирное дело: <b>$treb[1]</b><br>";break;
					case 62: $tr_b.="&nbsp;Самолечение: <b>$treb[1]</b><br>";break;
					case 63: $tr_b.="&nbsp;Оружейник: <b>$treb[1]</b><br>";break;
					case 64: $tr_b.="&nbsp;Доктор: <b>$treb[1]</b><br>";break;
					case 65: $tr_b.="&nbsp;Самолечение: <b>$treb[1]</b><br>";break;
					case 66: $tr_b.="&nbsp;Быстрое восстановление маны: <b>$treb[1]</b><br>";break;
					case 67: $tr_b.="&nbsp;Лидерство: <b>$treb[1]</b><br>";break;
					case 68: $tr_b.="&nbsp;Алхимия: <b>$treb[1]</b><br>";break;
					case 69: $tr_b.="&nbsp;Развитие горного дела: <b>$treb[1]</b><br>";break;
					case 70: $tr_b.="&nbsp;Рыбалка: <b>$treb[1]</b><br>";break;
					case 71: $tr_b.="&nbsp;Масса: <b>$treb[1]</b><br>";break;
					case 72: $tr_b.="&nbsp;Уровень: <b>$treb[1]</b><br>";break;}}
				$ResultBody .= '<table cellpadding=0 cellspacing=0 border=0 width=760>
								<table cellpadding=3 cellspacing=1 border=0 width=761>
								<tr>
								<td bgcolor=#f9f9f9><div align=center><img src=http://image.neverlands.ru/weapon/'.$ITEM[gif].' border=0></div>
								</td>
								<td width=100% bgcolor=#ffffff valign=top>
								<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr>
								<td bgcolor=#ffffff width=100%><font class=nickname><b>'.$ITEM[name].'</b><font class=weaponch><br><img src=image/1x1.gif width=1 height=3>
								</td>
								<td>
								<br><img src=image/1x1.gif width=1 height=3</td>
								</tr>
								<tr>
								<td colspan=2 width=100%>
								<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr>
								<td bgcolor=#D8CDAF width=33.3%><div align=center><font class=invtitle>свойства</div></td>
								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td>
								<td bgcolor=#D8CDAF width=33.3%><div align=center><font class=invtitle>требования</div></td>								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td>								<td bgcolor=#D8CDAF width=33.3%><div align=center><font class=invtitle>крафт</div></td>
								</tr>
								<tr>
								<td bgcolor=#FCFAF3><font class=weaponch>Цена:<b>'.$ITEM[price].'NV</b></font></b><br>';
				if($ITEM[slot]==16) $ResultBody .= '<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>';
				if($ITEM[block]!="") {
							switch($ITEM[block])
							{
								case 40: $bl_r.= "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>"; break;
								case 70: $bl_r.= "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>"; break;
								case 90: $bl_r.= "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>"; break;
							}}
				$ResultBody .= $bl_r;
				foreach ($par as $value) {
								$stat=explode("@",$value);
								if($stat[1]>0){$plus = "+";}else{$plus ="";}
								switch($stat[0]){
								case 1: $tr_s.= "Удар: <b>$stat[1]</b><br>";break;
								case 2: $tr_s.= "Долговечность: <b>$stat[1]/$stat[1]</b><br>";break;
								case 3: $tr_s.= "Карманов: <b>$stat[1]</b><br>";break;
								case 4: $tr_s.= "Материал: <b>$stat[1]</b><br>";break;
								case 5: $tr_s.= "Уловка: $plus<b>$stat[1]%</b><br>";break;
								case 6: $tr_s.= "Точность: $plus<b>$stat[1]%</b><br>";break;
								case 7: $tr_s.= "Сокрушение: $plus<b>$stat[1]%</b><br>";break;
								case 8: $tr_s.= "Стойкость: $plus<b>$stat[1]%</b><br>";break;
								case 9: $tr_s.= "Класс брони: $plus<b>$stat[1]</b><br>";break;
								case 10: $tr_s.= "Пробой брони: $plus<b>$stat[1]%</b><br>";break;
								case 11: $tr_s.= "Пробой колющим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 12: $tr_s.= "Пробой режущим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 13: $tr_s.= "Пробой проникающим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 14: $tr_s.= "Пробой пробивающим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 15: $tr_s.= "Пробой рубящим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 16: $tr_s.= "Пробой карающим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 17: $tr_s.= "Пробой отсекающим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 18: $tr_s.= "Пробой дробящим ударом: $plus<b>$stat[1]%</b><br>";break;
								case 19: $tr_s.= "Защита от колющих ударов: $plus<b>$stat[1]</b><br>";break;
								case 20: $tr_s.= "Защита от режущих ударов: $plus<b>$stat[1]</b><br>";break;
								case 21: $tr_s.= "Защита от проникающих ударов: $plus<b>$stat[1]</b><br>";break;
								case 22: $tr_s.= "Защита от пробивающих ударов: $plus<b>$stat[1]</b><br>";break;
								case 23: $tr_s.= "Защита от рубящих ударов: $plus<b>$stat[1]</b><br>";break;
								case 24: $tr_s.= "Защита от карающих ударов: $plus<b>$stat[1]</b><br>";break;
								case 25: $tr_s.= "Защита от отсекающих ударов: $plus<b>$stat[1]</b><br>";break;
								case 26: $tr_s.= "Защита от дробящих ударов: $plus<b>$stat[1]</b><br>";break;
								case 27: $tr_s.= "НР: $plus<b>$stat[1]</b><br>";break;
								case 28: $tr_s.= "Очки действия: $plus<b>$stat[1]</b><br>";break;
								case 29: $tr_s.= "Мана: $plus<b>$stat[1]</b><br>";break;
								case 30: $tr_s.= "Cила: $plus<b>$stat[1]</b><br>";break;
								case 31: $tr_s.= "Ловкость: $plus<b>$stat[1]</b><br>";break;
								case 32: $tr_s.= "Удача: $plus<b>$stat[1]</b><br>";break;
								case 33: $tr_s.= "Здоровье: $plus<b>$stat[1]</b><br>";break;
								case 34: $tr_s.= "Знания: $plus<b>$stat[1]</b><br>";break;
								case 35: $tr_s.= "Мудрость: $plus<b>$stat[1]</b><br>";break;
								case 36: $tr_s.= "Владение мечами: $plus<b>$stat[1]%</b><br>";break;
								case 37: $tr_s.= "Владение топорами: $plus<b>$stat[1]%</b><br>";break;
								case 38: $tr_s.= "Владение дробящим оружием: $plus<b>$stat[1]%</b><br>";break;
								case 39: $tr_s.= "Владение ножами: $plus<b>$stat[1]%</b><br>";break;
								case 40: $tr_s.= "Владение метательным оружием: $plus<b>$stat[1]%</b><br>";break;
								case 41: $tr_s.= "Владение алебардами и копьями: $plus<b>$stat[1]%</b><br>";break;
								case 42: $tr_s.= "Владение посохами: $plus<b>$stat[1]%</b><br>";break;
								case 43: $tr_s.= "Владение экзотическим оружием: $plus<b>$stat[1]%</b><br>";break;
								case 44: $tr_s.= "Владение двуручным оружием: $plus<b>$stat[1]%</b><br>";break;
								case 45: $tr_s.= "Магия огня: $plus<b>$stat[1]%</b><br>";break;
								case 46: $tr_s.= "Магия воды: $plus<b>$stat[1]%</b><br>";break;
								case 47: $tr_s.= "Магия воздуха: $plus<b>$stat[1]%</b><br>";break;
								case 48: $tr_s.= "Магия земли: $plus<b>$stat[1]%</b><br>";break;
								case 49: $tr_s.= "Сопротивление магии огня: $plus<b>$stat[1]%</b><br>";break;
								case 50: $tr_s.= "Сопротивление магии воды: $plus<b>$stat[1]%</b><br>";break;
								case 51: $tr_s.= "Сопротивление магии воздуха: $plus<b>$stat[1]%</b><br>";break;
								case 52: $tr_s.= "Сопротивление магии земли: $plus<b>$stat[1]%</b><br>";break;
								case 53: $tr_s.= "Воровство: $plus<b>$stat[1]%</b><br>";break;
								case 54: $tr_s.= "Осторожность: $plus<b>$stat[1]%</b><br>";break;
								case 55: $tr_s.= "Скрытность: $plus<b>$stat[1]%</b><br>";break;
								case 56: $tr_s.= "Наблюдательность: $plus<b>$stat[1]%</b><br>";break;
								case 57: $tr_s.= "Торговля: $plus<b>$stat[1]%</b><br>";break;
								case 58: $tr_s.= "Странник: $plus<b>$stat[1]%</b><br>";break;
								case 59: $tr_s.= "Языковедение: $plus<b>$stat[1]%</b><br>";break;
								case 60: $tr_s.= "Каллиграфия: $plus<b>$stat[1]%</b><br>";break;
								case 61: $tr_s.= "Ювелирное дело: $plus<b>$stat[1]%</b><br>";break;
								case 62: $tr_s.= "Самолечение: $plus<b>$stat[1]%</b><br>";break;
								case 63: $tr_s.= "Оружейник: $plus<b>$stat[1]%</b><br>";break;
								case 64: $tr_s.= "Доктор: $plus<b>$stat[1]%</b><br>";break;
								case 65: $tr_s.= "Самолечение: $plus<b>$stat[1]%</b><br>";break;
								case 66: $tr_s.= "Быстрое восстановление маны: $plus<b>$stat[1]%</b><br>";break;
								case 67: $tr_s.= "Лидерство: $plus<b>$stat[1]%</b><br>";break;
								case 68: $tr_s.= "Алхимия: $plus<b>$stat[1]%</b><br>";break;
								case 69: $tr_s.= "Развитие горного дела: $plus<b>$stat[1]%</b><br>";break;
								case 70: $tr_s.= "Рыбалка: $plus<b>$stat[1]%</b><br>";break;
								case 71: $tr_s.= "Охота: $plus<b>$stat[1]</b><br>";break;
								case 72: $tr_s.= "Масса: $plus<b>$stat[1]</b><br>";break;
								case 73: $tr_s.= "Скорость: $plus<b>$stat[1]</b><br>";break;
							}}				if($ITEM[tim]>1){					$time = 'Минуты';}				else {					$time = 'Минута';}
				$ResultBody .= $tr_s.'</td>
								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td>								<td bgcolor=#FCFAF3><font class=weaponch>'.$tr_b.'</font></td>								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td>								<td bgcolor=#FCFAF3><font class=weaponch>&nbsp;Время:<b>'.$ITEM[tim].'&nbsp;'.$time.'</b><br>								&nbsp;Молот:<b>'.$ITEM[molot].'</b><br>								&nbsp;Умелка:<b>'.$ITEM[umelka].'</b><br>								'.$iron.''.$wood.'</font></td>
								</td></tr></table></td></tr></table></tr></table>
								';
            }}
			else
			{
				$ResultBody .= '<table cellpadding=5 cellspacing=1 border=0 width=760><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.</b></font></td></tr></table>';
            }}}
print '<center><img src="http://image.neverlands.ru/shops/lavka_shop_5.jpg"></center>
		<table width="760" align="center" border="1" cellpadding="2" cellspacing="0" class="news_text">
		<tr>			<th colspan="1"><a href="?market=1"> Лавка Форпост</a> </th>			<th colspan="1"><a href="?market=3"> Лавка Октал</a> </th>			<th colspan="1"><a href="?market=2"> Лавка Деревня Подгорная</a> </th>
			<th colspan="1"><a href="?market=7">Новая Лавка</a> </th>
		</tr>
		</table>';		
if(isset($_REQUEST['market'])){
  print '<center><table width="760" align="center"><tr>
			<a href="?market='.$_REQUEST['market'].'&type=4"><img src="http://image.neverlands.ru/gameplay/shop/knife.gif"></a><a href="?market='.$_REQUEST['market'].'&type=1"><img src="http://image.neverlands.ru/gameplay/shop/sword.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=2"><img src="http://image.neverlands.ru/gameplay/shop/axe.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=3"><img src="http://image.neverlands.ru/gameplay/shop/crushing.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=6"><img src="http://image.neverlands.ru/gameplay/shop/spears_helbeards.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=99"><img src="http://image.neverlands.ru/gameplay/shop/missle.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=7"><img src="http://image.neverlands.ru/gameplay/shop/wand.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=20"><img src="http://image.neverlands.ru/gameplay/shop/shield.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=23"><img src="http://image.neverlands.ru/gameplay/shop/helm.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=26"><img src="http://image.neverlands.ru/gameplay/shop/belt.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=18"><img src="http://image.neverlands.ru/gameplay/shop/armor_light.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=19"><img src="http://image.neverlands.ru/gameplay/shop/armor_hard.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=24"><img src="http://image.neverlands.ru/gameplay/shop/gloves.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=80"><img src="http://image.neverlands.ru/gameplay/shop/armlet.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=21"><img src="http://image.neverlands.ru/gameplay/shop/boots.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=25"><img src="http://image.neverlands.ru/gameplay/shop/amulet.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=22"><img src="http://image.neverlands.ru/gameplay/shop/ring.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=28/49"><img src="http://image.neverlands.ru/gameplay/shop/other.gif"></a><a href="enc.php?market='.$_REQUEST['market'].'&type=61"><img src="http://image.neverlands.ru/gameplay/shop/licen.gif"></a>
			</tr>
			</table>';
}
if(isset($_REQUEST['type'])){
	switch($min_lvl){
		case 0: $w[0]=" selected=selected";break;
		case 1: $w[1]=" selected=selected";break;
		case 2: $w[2]=" selected=selected";break;
		case 3: $w[3]=" selected=selected";break;
		case 4: $w[4]=" selected=selected";break;
		case 5: $w[5]=" selected=selected";break;
		case 6: $w[6]=" selected=selected";break;
		case 7: $w[7]=" selected=selected";break;
		case 8: $w[8]=" selected=selected";break;
		case 9: $w[9]=" selected=selected";break;
		case 10: $w[10]=" selected=selected";break;
		case 11: $w[11]=" selected=selected";break;
		case 12: $w[12]=" selected=selected";break;
		case 13: $w[13]=" selected=selected";break;
		case 14: $w[14]=" selected=selected";break;
		case 15: $w[15]=" selected=selected";break;
		case 16: $w[16]=" selected=selected";break;
		case 17: $w[17]=" selected=selected";break;
		case 18: $w[18]=" selected=selected";break;
}
	switch($max_lvl){
		case 0: $max[0]=" selected=selected";break;
		case 1: $max[1]=" selected=selected";break;
		case 2: $max[2]=" selected=selected";break;
		case 3: $max[3]=" selected=selected";break;
		case 4: $max[4]=" selected=selected";break;
		case 5: $max[5]=" selected=selected";break;
		case 6: $max[6]=" selected=selected";break;
		case 7: $max[7]=" selected=selected";break;
		case 8: $max[8]=" selected=selected";break;
		case 9: $max[9]=" selected=selected";break;
		case 10: $max[10]=" selected=selected";break;
		case 11: $max[11]=" selected=selected";break;
		case 12: $max[12]=" selected=selected";break;
		case 13: $max[13]=" selected=selected";break;
		case 14: $max[14]=" selected=selected";break;
		case 15: $max[15]=" selected=selected";break;
		case 16: $max[16]=" selected=selected";break;
		case 17: $max[17]=" selected=selected";break;
		case 18: $max[18]=" selected=selected";break;
	}
	print'<table align="center"><form action="?market='.$_REQUEST['market'].'&type='.$_REQUEST['type'].'" method="post">
		<tr>
			<td>
			Фильтор: уровень от
			<select name="min_lvl">
				<option value="0"'.$w[0].'>0</option>
				<option value="1"'.$w[1].'>1</option>
				<option value="2"'.$w[2].'>2</option>
				<option value="3"'.$w[3].'>3</option>
				<option value="4"'.$w[4].'>4</option>
				<option value="5"'.$w[5].'>5</option>
				<option value="6"'.$w[6].'>6</option>
				<option value="7"'.$w[7].'>7</option>
				<option value="8"'.$w[8].'>8</option>
				<option value="9"'.$w[9].'>9</option>
				<option value="10"'.$w[10].'>10</option>
				<option value="11"'.$w[11].'>11</option>
				<option value="12"'.$w[12].'>12</option>
				<option value="13"'.$w[13].'>13</option>
				<option value="14"'.$w[14].'>14</option>
				<option value="15"'.$w[15].'>15</option>
				<option value="16"'.$w[16].'>16</option>
				<option value="17"'.$w[17].'>17</option>
				<option value="18"'.$w[18].'>18</option>
			</select>
			до 
			<select name="max_lvl">
				<option value="0"'.$max[0].'>0</option>
				<option value="1"'.$max[1].'>1</option>
				<option value="2"'.$max[2].'>2</option>
				<option value="3"'.$max[3].'>3</option>
				<option value="4"'.$max[4].'>4</option>
				<option value="5"'.$max[5].'>5</option>
				<option value="6"'.$max[6].'>6</option>
				<option value="7"'.$max[7].'>7</option>
				<option value="8"'.$max[8].'>8</option>
				<option value="9"'.$max[9].'>9</option>
				<option value="10"'.$max[10].'>10</option>
				<option value="11"'.$max[11].'>11</option>
				<option value="12"'.$max[12].'>12</option>
				<option value="13"'.$max[13].'>13</option>
				<option value="14"'.$max[14].'>14</option>
				<option value="15"'.$max[15].'>15</option>
				<option value="16"'.$max[16].'>16</option>
				<option value="17"'.$max[17].'>17</option>
				<option value="18"'.$max[18].'>18</option>
			</select>
			<input type="submit" style="width: 95px" value="Сортировать"></form>
			</td>
		</tr>
	</table>';
}
if(!empty($ResultBody)){	print $ResultBody;}		
closetable();
require_once "side_right.php";
require_once "footer.php";
?>