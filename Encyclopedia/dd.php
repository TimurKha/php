<?php
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
opentable($locale['9003']);	
if(isset($_REQUEST['set']))
{
	$set=$_REQUEST[set];
	$ITEMS = mysql_query("SELECT items.* FROM items WHERE komplekt='$set' AND art=$_REQUEST[art] ORDER BY items.effect,items.dolars,items.DNV,items.slot;");
	$num = (mysql_num_rows($ITEMS));
	if($num>0){
			while ($ITEM = mysql_fetch_assoc($ITEMS)) {
			$need=explode("|",$ITEM['need']);
				$par=explode("|",$ITEM['param']);
				$bt=0;$tr_b='';$tr_s='';$bl_r='';$m=1;
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
					case 72: $tr_b.="&nbsp;Уровень: <b>$treb[1]</b><br>";break;
					
				}}
				$ResultBody .= '<center><table cellpadding=0 cellspacing=0 border=0 width=760>
								<table cellpadding=3 cellspacing=1 border=0 width=761>
								<tr>
								<td bgcolor=#f9f9f9 width=68><div align=center><img src=http://image.neverlands.ru/weapon/'.$ITEM[gif].' border=0></div>
								</td>
								<td width=684 bgcolor=#ffffff valign=top>
								<table cellpadding=0 cellspacing=0 border=0 width=684>
								<tr>
								<td bgcolor=#ffffff width=684><font class=nickname><b>'.$ITEM[name].'</b><font class=weaponch><br><img src=image/1x1.gif width=1 height=3>
								</td>
								<td>
								<br><img src=image/1x1.gif width=1 height=3</td>
								</tr>
								<tr>
								<td colspan=2 width=684>
								<table cellpadding=0 cellspacing=0 border=0 width=684>
								<tr>
								<td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>свойства</div></td>
								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td>
								<td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</div></td>
								</tr>
								<tr>
								<td bgcolor=#FCFAF3><font class=weaponch>Цена:<b>'.$ITEM[price].' NV</b></font></b><br>';
				if($ITEM[DNV]>1) $ResultBody .='<font class=weaponch>Цена:<img src=http://image.neverlands.ru/money_dea.gif><b>'.$ITEM[DNV].' DNV</b></font></b><br>';
				if($ITEM[dolars]>1) $ResultBody .='<font class=weaponch>Цена:<b>'.$ITEM[dolars].' $</b></font></b><br>';
				if($ITEM[ration]>1) $ResultBody .='<font class=weaponch>Коэффицент:<b><font color=#cc0000>'.$ITEM[ration].'</b></font></b><br>';
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
								switch($stat[0])
								{
								case 1: $tr_s.= "Удар: <b>$stat[1]</b><br>";break;
								case 2: $tr_s.= "Долговечность: <b>$stat[1]/$stat[1]</b><br>";break;
								case 3: $tr_s.= "Карманов: <b>$stat[1]</b><br>";break;
								case 4: $tr_s.= "Материал: <b>$stat[1]</b><br>";break;
								case 5: $tr_s.= "Уловка: $plus<b>$stat[1]%</b><br>";break;
								case 6: $tr_s.= "Точность: $plus<b>$stat[1]%</b><br>";break;
								case 7: $tr_s.= "Сокрушение: $plus<b>$stat[1]%</b><br>";break;
								case 8: $tr_s.= "Стойкость: $plus<b>$stat[1]%</b><br>";break;
								case 9: $tr_s.= "Класс брони: <b>$stat[1]</b><br>";break;
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
								case 68: $tr_s.= "Алхимия: $plus<b>$stat[1]</b><br>";break;
								case 69: $tr_s.= "Развитие горного дела: $plus<b>$stat[1]</b><br>";break;
								case 70: $tr_s.= "Рыбалка: $plus<b>$stat[1]</b><br>";break;
								case 71: $tr_s.= "Охота: $plus<b>$stat[1]</b><br>";break;
								}}
				$ResultBody .= $tr_s.'</td>
								<td bgcolor=#B9A05C><img src=image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3>
								<font class=weaponch>'.$tr_b.'</font></td>
								</td></tr></table></td></tr></table></tr></table></center>';
            }}

}
print '<center><img src="http://image.neverlands.ru/gameplay/hdi/hdi_city1.jpg"></center>
		<LEGEND align=center><B>&nbsp;Покупка артефактов и других вещей&nbsp;</B></LEGEND>
<table cellpadding=10 cellspacing=0 border=0 width=100%>
<tr><td class=freetxt>
<font class=nickname>
<a href="#"><b><font color=#336699>Расходники</font></b></a><br>
<a href="?set=1&art=2"><b><font color=#333333>Комплект Героя [18]</font></b></a><br>
<a href="?set=2&art=2"><b><font color=#333333>Комплект Варвара[18]</font></b></a><br>
<a href="?set=3&art=2"><b><font color=#E80005>Комплект Мага Огня [18]</font></b></a><br>
<a href="?set=4&art=2"><b><font color=#148101>Комплект Мага Земли [18]</font></b></a><br>
<a href="?set=5&art=2"><b><font color=#1C60C6>Комплект Мага Воды [18]</font></b></a><br>
<a href="?set=6&art=2"><b><font color=#14BCE0>Комплект Мага Воздуха [18]</font></b></a><br><br></font>
<a href="#"><font color=#336699>Индивидуальный артефакт</font></a><br>
<a href="?set=0&art=1"><font color=#336699>Стандартные артефакты</font></a><br>
<a href="?set=7&art=1"><font color=#336699>Артефакты из комплекта Дракона</font></a><br>
<a href="?set=13&art=1"><font color=#336699>Артефакты из комплекта Мертвеца</font></a><br>
<a href="?set=8&art=1"><font color=#336699>Артефакты из комплекта Заката</font></a><br>
<a href="?set=9&art=1"><font color=#336699>Артефакты из комплекта Пустынных Ветров</font></a><br>
<a href="?set=0&art=2"><font color=#336699>Раритетные вещи</font></a><br>
<a href="#"><font color=#336699>Свитки и Эликсиры</font></a><br>
<a href="#"><font color=#336699>Ранее составленные клан-артефакты</font></a><br>
<a href="?set=14&art=1"><font color=#336699>Профессиональный инвентарь</font></a>
</td></tr>
</table>';
if(!empty($ResultBody))
{
  print $ResultBody;
}	


closetable();	
require_once "side_right.php";
require_once "footer.php";
?>