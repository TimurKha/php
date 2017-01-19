<?
require_once "../maincore.php";
require_once "subheader.php";
require_once ADMIN."navigation.php";
include LOCALE.LOCALESET."admin/items.php";
include('../config.php');
require_once "../func/connect.php";
		  db_open();
if (!checkrights("N") || !defined("iAUTH") || $aid != iAUTH) fallback("../index.php");	
if (isset($status)) {
	if ($status == "su") {
		$title = $locale['1550'];
		$message = "<b>".$locale['1551']."</b>";
	} elseif ($status == "sn") {
		$title = $locale['1550'];
		$message = "<b>".$locale['1552']."</b>";			} elseif ($status == "del") {		$title = $locale['1550'];		$message = "<b>".$locale['1553']."</b>";	}
	opentable($title);
	echo "<div align='center'>".$message."</div>\n";
	closetable();
	tablebreak();
}
if (isset($_POST['save'])) {		for($i=1;$i<=73;$i++){			if($pr[$i]!=""){$par.=$i.'@'.$pr[$i].'|';}			}		$par=substr_replace($par, '', -1);		if($massa!=""){$need.="71|";}		if($level!=""){$need.="72|";}		for($i=28;$i<=73;$i++){			if($tr[$i]!=""){$need.=$i.'@'.$tr[$i].'|';}			}		$need=substr_replace($need, '', -1);				for($i=1;$i<=21;$i++){		if($ir[$i]!=""){$iron.=$i.'@'.$ir[$i].'|';}		}				for($i=28;$i<=47;$i++){		if($wd[$i]!=""){$wood.=$i.'@'.$wd[$i].'|';}		}				db_query('INSERT INTO items (gif,name,block,dveruki,2w,type,param,need,acte,market,num_a,level,price,dolars,DNV,sneg,ration,massa,slot,effect,art,komplekt,clan) VALUES ('.AP.$gif.AP.','.AP.$name.AP.','.AP.$block.AP.','.AP.$dveruki.AP.','.AP.$wtor.AP.','.AP.$type.AP.','.AP.$par.AP.','.AP.$need.AP.','.AP.$acte.AP.','.AP.$market.AP.','.AP.$num_a.AP.','.AP.$level.AP.','.AP.$price.AP.','.AP.$dolars.AP.','.AP.$DNV.AP.','.AP.$sneg.AP.','.AP.$ration.AP.','.AP.$massa.AP.','.AP.$slot.AP.','.AP.$effect.AP.','.AP.$art.AP.','.AP.$komplekt.AP.','.AP.$clan.AP.');');		redirect(FUSION_SELF.$aidlink."&status=su");}	if (isset($_POST['edit'])) {	for($i=1;$i<=73;$i++){		if($pr[$i]!=""){$par.=$i.'@'.$pr[$i].'|';}		}	$par=substr_replace($par, '', -1);	if($massa!=""){$need.="71|";}	if($level!=""){$need.="72|";}	for($i=28;$i<=73;$i++){		if($tr[$i]!=""){$need.=$i.'@'.$tr[$i].'|';}		}			db_query('UPDATE items SET gif='.AP.$gif.AP.',name='.AP.$name.AP.',block='.AP.$block.AP.',dveruki='.AP.$dveruki.AP.',2w='.AP.$wtor.AP.',type='.AP.$type.AP.',param='.AP.$par.AP.',need='.AP.$need.AP.',acte='.AP.$acte.AP.',market='.AP.$market.AP.',num_a='.AP.$num_a.AP.',level='.AP.$level.AP.',price='.AP.$price.AP.',dolars='.AP.$dolars.AP.',DNV='.AP.$DNV.AP.',sneg='.AP.$sneg.AP.',ration='.AP.$ration.AP.',massa='.AP.$massa.AP.',slot='.AP.$slot.AP.',art='.AP.$art.AP.',komplekt='.AP.$komplekt.AP.',clan='.AP.$clan.AP.' WHERE id='.AP.$idit.AP.';');	$need=substr_replace($need, '', -1);	redirect(FUSION_SELF.$aidlink."&status=sn");}if (isset($_POST['del'])) {	for($i=1;$i<=74;$i++){		if($pr[$i]!=""){$par.=$i.'@'.$pr[$i].'|';}		}	$par=substr_replace($par, '', -1);	if($massa!=""){$need.="71|";}	if($level!=""){$need.="72|";}	for($i=28;$i<=74;$i++){		if($tr[$i]!=""){$need.=$i.'@'.$tr[$i].'|';}		}	db_query('DELETE FROM `items` WHERE id='.AP.$idit.AP.';');	$need=substr_replace($need, '', -1);	redirect(FUSION_SELF.$aidlink."&status=del");}
if (isset($_POST['kraft'])){		for($i=1;$i<=21;$i++){		if($ir[$i]!=""){$iron.=$i.'@'.$ir[$i].'|';}		}			for($i=28;$i<=47;$i++){		if($wd[$i]!=""){$wood.=$i.'@'.$wd[$i].'|';}		}			db_query('UPDATE items SET iron_res='.AP.$iron.AP.',wood_res='.AP.$wood.AP.',tim='.AP.$tim.AP.',molot='.AP.$molot.AP.',umelka='.AP.$umelka.AP.' WHERE id='.AP.$idit.AP.';');		redirect(FUSION_SELF.$aidlink."&status=sn");}
opentable($locale['1550']);
if(isset($_REQUEST['id_adm'])){	
	$action = FUSION_SELF.$aidlink;
	$komplekt_DB = array('Стандарт', 'Герой', 'Варвар', 'Мага Огня', 'Мага Земли', 'Мага Воды', 'Мага Воздуха', 'Дракона', 'Заката', 'Пустынных Ветров',
	'Шмот с нг', 'Орк', 'Гоблин', 'Мертвеца', 'Профессиональный инвентарь', 'Праздничный Шмот', 'Северного Варвара', 'Северного Ярла', 
	'Северного Конунга', 'Северного Шамана', 'Северного Заклинателя', 'Северного Колдуна', 'Огра', 'Разбойника', 'Cкелета', 'Грабителя', 'Призрака');	$molot_DB = array('Бронзовый Молот','Стальной молот','Мифриловый молот');	
	if($id_adm==1){
		$ResultBody .='<form name="additem" method="post" action="'.$action.'&id_adm=1">
<table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
<tr>
  <td valign="top" bgcolor="#f9f9f9"><div id="img"></div>
        <input name="gif" type="text" value="Картинка" />
        </select></td>
  <td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname>
    <select name="type" >
      <option value="w4" selected="selected">Ножи</option>
      <option value="w1">Мечи</option>
      <option value="w2">Топоры</option>
      <option value="w3">Дробящее</option>
      <option value="w6">Алебарды и копья</option>
      <option value="w5">Метательное</option>
      <option value="w7">Посохи</option>
      <option value="w20">Щиты</option>
      <option value="w23">Шлемы</option>
      <option value="w26">Пояса</option>
      <option value="w18">Кольчуги</option>
      <option value="w19">Доспехи</option>
      <option value="w24">Перчатки</option>
      <option value="w80">Наручи</option>
      <option value="w21">Сапоги</option>
      <option value="w25">Кулоны</option>
      <option value="w22">Кольца</option>
      <option value="w28/49">Разное</option>
      <option value="w90">Лицензии</option>
      <option value="w61">Эликсиры</option>
    </select>
    <input name="name" type="text" value="Название" />
    <select name="block" >
      <option value="0" selected="selected">Не щит</option>
      <option value="40">1 точка</option>
      <option value="70">2 точки</option>
      <option value="90">3 точки</option>
    </select>
	<strong>Двуручное Оружие</strong>
    да/нет
    <input name="dveruki" type="checkbox" value="1" />
    <select name="num_a" >
      <option value="0" selected="selected">Не свиток/элексир</option>
      <option value="1">Свиток</option>
      <option value="2">Элексир</option>
    </select>
    <select name="acte" >
      <option value="" selected="selected">Расходники</option>
      <option value="1">Элик</option>
      <option value="2">Свиток</option>
	  <option value="3">Разное</option>
    </select>
	<select name="market" >
      <option value="" selected="selected">Лавка</option>
	  <option value="4">ДД</option>
	  <option value="7">Новая Лавка</option>
    </select>
	<br>Клан:<select name="clan">';
	$clans=mysql_query("SELECT clan_rclans.* FROM clan_rclans ORDER BY clan_rclans.id;");
	$num = (mysql_num_rows($clans));
	if($num>0){
			while ($clan = mysql_fetch_assoc($clans)) {
			$ResultBody .='<option value='.$clan[clan_zn].'>'.$clan[cname].'</option>';
			}}
	$ResultBody .='</select>
    <br />
<strong>Второе оружие</strong>
    да
    <input name="wtor" type="radio" value="1" />
    нет
    <input name="wtor" type="radio" value="0" checked />
    &nbsp; Слот: <select name="slot">
          <option value="1">Шлем</option>
          <option value="2">Ожерелье</option>
          <option value="3">Оружие</option>
          <option value="4">Пояс</option>
          <option value="5">Содержимое карманов пояса</option>
          <option value="8">Слот для сапог</option>
          <option value="9">Слот для кармана</option>
          <option value="10">Содержимое кармана</option>
          <option value="11">Наручи</option>
          <option value="12">Перчатки</option>
          <option value="13">Щит</option>
          <option value="14">Кольцо</option>
          <option value="16">Броня</option>
          <option value="17">Кольчуга</option>
        </select> эффект: <input name="effect" type="text" />
	<select name="art" >
			<option value="0" selected="selected">Не Арт</option>
			<option value="1">Арт</option>
			<option value="2">РАР</option>
			<option value="3">Клан Арт</option>
			<option value="4">Индив Арт</option>
	</select><br>
	Комплект:<select name="komplekt" >';
	$i = 0;
	while($i < sizeof($komplekt_DB)){
		$ResultBody .= '<option value="'.$i.'"  > '.$komplekt_DB[$i].'</option>';
		$i++;
	}
    $ResultBody .='<br><img src=../image/1x1.gif width=1 height=3></td><td><br><img src=../image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td width=50% bgcolor=#D8CDAF><div align=center><font class=invtitle>свойства</div></td><td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</div></td></tr>
	<tr><td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>Цена</label>
              <input name="price" type="text" value="1" /><br>
			  <b><label>Цена DNV</label>
			  <input name="DNV" type="text" /><br>
			  <b><label>Цена $</label>
			  <input name="dolars" type="text" /><br>
			  <b><label>Цена Снег</label>
			  <input name="sneg" type="text" /><br>
			  <b><label>Коэффицент</label>
			  <input name="ration" type="text" /><br>';
	for($i=0;$i<=74;$i++){
		switch($i){
			case 1: $fr="Удар (пример 20-30):";break;
			case 2: $fr="Долговечность:";break;
			case 3: $fr="Карманов(3 max для поясов):";break;
			case 4: $fr="Материал:";break;
			case 5: $fr="Уловка:";break;
			case 6: $fr="Точность:";break;
			case 7: $fr="Сокрушение:";break;
			case 8: $fr="Стойкость:";break;
			case 9: $fr="Класс брони:";break;
			case 10: $fr="Пробой брони:";$i=26;break;
			case 27: $fr="НР:";break;
			case 28: $fr="Очки действия:";break;
			case 29: $fr="Мана:";break;
			case 30: $fr="Cила:";break;
			case 31: $fr="Ловкость:";break;
			case 32: $fr="Удача:";break;
			case 33: $fr="Здоровье:";break;
			case 34: $fr="Знания:";break;
			case 35: $fr="Мудрость:";break;
			case 36: $fr="Влад. мечами:";break;
			case 37: $fr="Влад. топорами:";break;
			case 38: $fr="Влад. дробящим оружием:";break;
			case 39: $fr="Влад. ножами:";break;
			case 40: $fr="Влад. метательным оружием:";break;
			case 41: $fr="Влад. алебардами и копьями:";break;
			case 42: $fr="Влад. посохами:";break;
			case 43: $fr="Влад. экзотическим оружием:";break;
			case 44: $fr="Влад. двуручным оружием:";break;
			case 45: $fr="Магия огня:";break;
			case 46: $fr="Магия воды:";break;
			case 47: $fr="Магия воздуха:";break;
			case 48: $fr="Магия земли:";break;
			case 49: $fr="Сопротивление магии огня:";break;
			case 50: $fr="Сопротивление магии воды:";break;
			case 51: $fr="Сопротивление магии воздуха:";break;
			case 52: $fr="Сопротивление магии земли:";break;
			case 53: $fr="Воровство:";break;
			case 54: $fr="Осторожность:";break;
			case 55: $fr="Скрытность:";break;
			case 56: $fr="Наблюдательность:";break;
			case 57: $fr="Торговля:";break;
			case 58: $fr="Странник:";break;
			case 59: $fr="Языковедение:";break;
			case 60: $fr="Каллиграфия:";break;
			case 61: $fr="Ювелирное дело:";break;
			case 62: $fr="Самолечение:";break;
			case 63: $fr="Оружейник:";break;
			case 64: $fr="Доктор:";break;
			case 65: $fr="Самолечение:";break;
			case 66: $fr="Быстрое восстановление маны:";break;
			case 67: $fr="Лидерство:";break;
			case 68: $fr="Алхимия:";break;
			case 69: $fr="Развитие горного дела:";break;
			case 70: $fr="Рыбалка:";break;
			case 71: $fr="Охота:";break;
			case 72: $fr="Масса:";break;
			case 73: $fr="Скорость:";break;
			case 74: $fr="Cтоимость улучшения:";break;
		}
		if($fr!="")$ResultBody .='<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=pr['.$i.'] type=text value=""/><br>';
	}
	$ResultBody .='</td>
            <td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3"><font class=weaponch><b><label>Уровень:</label>
              <input name="level" type="text" value="" /><br><font class=weaponch><b><label>Масса:</label>
              <input name="massa" type="text" value="" /><br>';
	for($i=28;$i<=74;$i++){
          switch($i){
			case 28: $fr="Очки действия:";break;
			case 29: $fr="";break;
			case 30: $fr="Cила:";break;
			case 31: $fr="Ловкость:";break;
			case 32: $fr="Удача:";break;
			case 33: $fr="Здоровье:";break;
			case 34: $fr="Знания:";break;
			case 35: $fr="Мудрость:";break;
			case 36: $fr="Влад. мечами:";break;
			case 37: $fr="Влад. топорами:";break;
			case 38: $fr="Влад. дробящим оружием:";break;
			case 39: $fr="Влад. ножами:";break;
			case 40: $fr="Влад. метательным оружием:";break;
			case 41: $fr="Влад. алебардами и копьями:";break;
			case 42: $fr="Влад. посохами:";break;
			case 43: $fr="Влад. экзотическим оружием:";break;
			case 44: $fr="Влад. двуручным оружием:";break;
			case 45: $fr="Магия огня:";break;
			case 46: $fr="Магия воды:";break;
			case 47: $fr="Магия воздуха:";break;
			case 48: $fr="Магия земли:";break;
			case 49: $fr="";break;
			case 50: $fr="";break;
			case 51: $fr="";break;
			case 52: $fr="";break;
			case 53: $fr="Воровство:";break;
			case 54: $fr="Осторожность:";break;
			case 55: $fr="Скрытность:";break;
			case 56: $fr="Наблюдательность:";break;
			case 57: $fr="Торговля:";break;
			case 58: $fr="Странник:";break;
			case 59: $fr="Языковедение:";break;
			case 60: $fr="Каллиграфия:";break;
			case 61: $fr="Ювелирное дело:";break;
			case 62: $fr="Самолечение:";break;
			case 63: $fr="Оружейник:";break;
			case 64: $fr="Доктор:";break;
			case 65: $fr="Самолечение:";break;
			case 66: $fr="Быстрое восстановление маны:";break;
			case 67: $fr="Лидерство:";break;
			case 68: $fr="Алхимия:";break;
			case 69: $fr="Развитие горного дела:";break;
			case 70: $fr="Рыбалка:";break;
			case 71: $fr="Охота:"; $i=73;break;
			case 74: $fr="Соимость улучшения:";break;
		}
		if($fr!="")$ResultBody .='<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=tr['.$i.'] type=text value=""/><br>';
	}
	$ResultBody .='</td></tr>
	   </table></td></tr></table></td></tr>
	</table>
	  <div align="center">
		<input name="save" type="submit" class="button" value="Сохранить"/>
	  </div>
	</form>
	<div align="center">
	<p><br>';
	}
	if($id_adm==4){
		$ResultBody .= '<form method="post" action="'.$action.'&id_adm=4">
<select name="type" >
	<option value="" selected="selected">все типы</option>
      <option value="w4">Ножи</option>
      <option value="w1">Мечи</option>
      <option value="w2">Топоры</option>
      <option value="w3">Дробящее</option>
      <option value="w6">Алебарды и копья</option>
      <option value="w5">Метательное</option>
      <option value="w7">Посохи</option>
      <option value="w20">Щиты</option>
      <option value="w23">Шлемы</option>
      <option value="w26">Пояса</option>
      <option value="w18">Кольчуги</option>
      <option value="w19">Доспехи</option>
      <option value="w24">Перчатки</option>
      <option value="w80">Наручи</option>
      <option value="w21">Сапоги</option>
      <option value="w25">Кулоны</option>
      <option value="w22">Кольца</option>
      <option value="w28/49">Разное</option>
      <option value="w90">Лицензии</option>
      <option value="w61">Эликсиры</option>
    </select><br>
<select name="komplekt" >
			<option value="" selected="selected">Все</option>';
	$i = 0;
	while($i < sizeof($komplekt_DB)){
		$ResultBody .= '<option value="'.$i.'"  > '.$komplekt_DB[$i].'</option>';
		$i++;
	}
	$ResultBody .= '</select>		
	<input name="smb7" type="submit" value="Применить фильтр" />
	<select name="idit" >
      <option value=0>Выберите тип/Выберите Вещь</option>';
	if($smb7){if($type==""&&$komplekt==""){$filter="";}else if($komplekt==""){$filter="WHERE type='$type'";} else{$filter="WHERE komplekt='$komplekt'";}}
	$it=mysql_query("SELECT items.id, items.name ,items.level, items.type FROM items $filter ORDER BY type,name,level;");
	  while ($row = mysql_fetch_assoc($it)) {
	  $ResultBody .= '<option value='.$row[id];
	  if($idit==$row[id]){
		$ResultBody .= ' selected=selected';}
	  $ResultBody .= '>'.$row[name].' [ '.$row[level].' ]</option>"';
	  }
	$ResultBody .= '</select> <input name="load" type="submit" class="lbut" value="Загрузить" /><br>
					</form>';
	if($load){
		$it=mysql_fetch_assoc(mysql_query("SELECT * FROM items WHERE id='$idit';"));
	$ResultBody .= '<form name="edititem" method="post" action="'.$action.'&id_adm=4&idit='.$idit.'">
	<table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
	<tr>
	  <td valign="top" bgcolor="#f9f9f9"><div id="img"><input name="gif" type="text" value="'.$it[gif].'" /></div>';
	  unset($w);
          switch($it[type]){
			case w0: $w[0]=" selected=selected";break;
			case w1: $w[1]=" selected=selected";break;
			case w2: $w[2]=" selected=selected";break;
			case w3: $w[3]=" selected=selected";break;
			case w4: $w[4]=" selected=selected";break;
			case w6: $w[5]=" selected=selected";break;
			case w5: $w[6]=" selected=selected";break;
			case w7: $w[7]=" selected=selected";break;
			case w20: $w[8]=" selected=selected";break;
			case w23: $w[9]=" selected=selected";break;
			case w26: $w[10]=" selected=selected";break;
			case w18: $w[11]=" selected=selected";break;
			case w19: $w[12]=" selected=selected";break;
			case w24: $w[13]=" selected=selected";break;
			case w80: $w[14]=" selected=selected";break;
			case w21: $w[15]=" selected=selected";break;
			case w25: $w[16]=" selected=selected";break;
			case w22: $w[17]=" selected=selected";break;
			case w28/49: $w[18]=" selected=selected";break;
			case w90: $w[19]=" selected=selected";break;
			}
	$ResultBody .='</select></td>
  <td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname>
    <select name="type" >
      <option value="w4" '.$w[4].'>Ножи</option>
      <option value="w1" '.$w[1].'>Мечи</option>
      <option value="w2" '.$w[2].'>Топоры</option>
      <option value="w3" '.$w[3].'>Дробящее</option>
      <option value="w6" '.$w[5].'>Алебарды и копья</option>
      <option value="w5" '.$w[6].'>Метательное</option>
      <option value="w7" '.$w[7].'>Посохи</option>
      <option value="w20" '.$w[8].'>Щиты</option>
      <option value="w23" '.$w[9].'>Шлемы</option>
      <option value="w26" '.$w[10].'>Пояса</option>
      <option value="w18" '.$w[11].'>Кольчуги</option>
      <option value="w19" '.$w[12].'>Доспехи</option>
      <option value="w24" '.$w[13].'>Перчатки</option>
      <option value="w80" '.$w[14].'>Наручи</option>
      <option value="w21" '.$w[15].'>Сапоги</option>
      <option value="w25" '.$w[16].'>Кулоны</option>
      <option value="w22" '.$w[17].'>Кольца</option>
      <option value="w28/49" '.$w[18].'>Разное</option>
      <option value="w90" '.$w[19].'>Лицензии</option>
      <option value="w61" '.$w[0].'>Эликсиры</option>
    </select>
    <input name="name" type="text" value="'.$it[name].'" />';
	unset($w);
     switch($it[block]){
		case 0: $w[0]=" selected=selected";break;
		case 40: $w[1]=" selected=selected";break;
		case 70: $w[2]=" selected=selected";break;
		case 90: $w[3]=" selected=selected";break;
		}
	$ResultBody .= '<select name="block" >
      <option value="0" '.$w[0].'>Не щит</option>
      <option value="40" '.$w[1].'>1 точка</option>
      <option value="70" '.$w[2].'>2 точки</option>
      <option value="90" '.$w[3].'>3 точки</option>
    </select>';
	if($it['dveruki']==1){$w1="checked";}
	$ResultBody .= '<input name="dveruki" type="checkbox" value="1" '.$w1.' />';
	unset($w);
     switch($it[num_a]){
		case 0: $w[0]=" selected=selected";break;
		case 1: $w[1]=" selected=selected";break;
		case 2: $w[2]=" selected=selected";break;
		}
	$ResultBody .= '<select name="num_a" >
      <option value="0" '.$w[0].'>Не свиток/элексир</option>
      <option value="1" '.$w[1].'>Свиток</option>
      <option value="2" '.$w[2].'>Элексир</option>
    </select>';
	unset($w);
         switch($it[acte]){
			case 0: $w[0]=" selected=selected";break;
			case 1: $w[1]=" selected=selected";break;
			case 2: $w[2]=" selected=selected";break;
			case 3: $w[3]=" selected=selected";break;
			}
	$ResultBody .= '<select name="acte" >
      <option value="0" '.$w[0].'>Расходники</option>
      <option value="1" '.$w[1].'>Элик</option>
      <option value="2" '.$w[2].'>Свиток</option>
      <option value="3" '.$w[3].'>Разное</option>
    </select>';
	unset($w);
         switch($it[market]){
			case 0: $w[0]=" selected=selected";break;
			case 1: $w[1]=" selected=selected";break;
			case 2: $w[2]=" selected=selected";break;
			case 3: $w[3]=" selected=selected";break;
			case 4: $w[4]=" selected=selected";break;
			case 5: $w[5]=" selected=selected";break;
			case 6: $w[6]=" selected=selected";break;
			case 7: $w[7]=" selected=selected";break;
			}
	$ResultBody .= '<select name="market" >
      <option value="0" '.$w[0].'>Лавка</option>
      <option value="1" '.$w[1].'>Форпост</option>
      <option value="3" '.$w[3].'>Октал</option>
      <option value="2" '.$w[2].'>Деревня Подгорная</option>
	  <option value="4" '.$w[4].'>ДД</option>
	  <option value="3" '.$w[5].'>Новая лавка Октал</option>
      <option value="2" '.$w[6].'>Новая лавка Деревня Подгорная</option>
	  <option value="7" '.$w[7].'>Новая лавка Форпост</option>
	  
    </select>';
	if($it['2w']==1){$w1="checked";}else{$w2="checked";}
	$ResultBody .='<strong>Второе оружие</strong>
    да
    <input name="wtor" type="radio" value="1" '.$w1.' />
    нет
    <input name="wtor" type="radio" value="0" '.$w2.' />';
	unset($w);
             switch($it[slot]){
				case 1: $w[1]=" selected=selected";break;
				case 2: $w[2]=" selected=selected";break;
				case 3: $w[3]=" selected=selected";break;
				case 4: $w[4]=" selected=selected";break;
				case 5: $w[5]=" selected=selected";break;
				case 8: $w[8]=" selected=selected";break;
				case 9: $w[9]=" selected=selected";break;
				case 10: $w[10]=" selected=selected";break;
				case 11: $w[11]=" selected=selected";break;
				case 12: $w[12]=" selected=selected";break;
				case 13: $w[13]=" selected=selected";break;
				case 14: $w[14]=" selected=selected";break;
				case 16: $w[16]=" selected=selected";break;
				case 17: $w[17]=" selected=selected";break;
				}
	$ResultBody .= '&nbsp; Слот: <select name="slot">
          <option value="1" '.$w[1].'>Шлем</option>
          <option value="2" '.$w[2].'>Ожерелье</option>
          <option value="3" '.$w[3].'>Оружие</option>
          <option value="4" '.$w[4].'>Пояс</option>
          <option value="5" '.$w[5].'>Содержимое карманов пояса</option>
          <option value="8" '.$w[8].'>Слот для сапог</option>
          <option value="9" '.$w[9].'>Слот для кармана</option>
          <option value="10" '.$w[10].'>Содержимое кармана</option>
          <option value="11" '.$w[11].'>Наручи</option>
          <option value="12" '.$w[12].'>Перчатки</option>
          <option value="13" '.$w[13].'>Щит</option>
          <option value="14" '.$w[14].'>Кольцо</option>
          <option value="16" '.$w[16].'>Броня</option>
          <option value="17" '.$w[17].'>Кольчуга</option>
        </select> эффект: <input name="effect" type="text" value=" '.$it[effect].'"/>';
	unset($w);
             switch($it[art]){
				case 0: $w[0]=" selected=selected";break;
				case 1: $w[1]=" selected=selected";break;
				case 2: $w[2]=" selected=selected";break;
				case 3: $w[3]=" selected=selected";break;
				case 4: $w[4]=" selected=selected";break;
				}
	$ResultBody .= '<select name="art" >
			<option value="0" '.$w[0].'>Не Арт</option>
			<option value="1" '.$w[1].'>Арт</option>
			<option value="2" '.$w[2].'>РАР</option>
			<option value="3" '.$w[3].'>Клан Арт</option>
			<option value="4" '.$w[4].'>Индив Арт</option>
	</select>';
	$ResultBody .= 'Комплект:<select name="komplekt" >';
	$i = 0;
	while($i < sizeof($komplekt_DB)){
		if ($i == $it[komplekt]){
			$ResultBody .= '<option value="'.$i.'" selected=selected> '.$komplekt_DB[$i].'</option>';
		}
		else {
			$ResultBody .= '<option value="'.$i.'"> '.$komplekt_DB[$i].'</option>';
		}
		$i++;
	}
	$ResultBody .= '</select>
    <br><img src=../image/1x1.gif width=1 height=3></td><td><br><img src=../image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td width=50% bgcolor=#D8CDAF><div align=center><font class=invtitle>свойства</div></td><td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</div></td></tr>
	<tr><td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>Цена</label>
              <input name="price" type="text" value="'.$it[price].'" /><br>
			  <b><label>Цена DNV</label>
			  <input name="DNV" type="text" value="'.$it[DNV].'" /><br>
			  <b><label>Цена $</label>
			  <input name="dolars" type="text" value="'.$it[dolars].'" /><br>
			  <b><label>Цена Снег</label>
			  <input name="sneg" type="text" value="'.$it[sneg].'" /><br>
			  <b><label>Коэффицент</label>
			  <input name="ration" type="text" value="'.$it[ration].'" /><br>';
	$param=explode("|",$it[param]);
foreach ($param as $value) { 
$stat=explode("@",$value);
$par[$stat[0]]=$stat[1];} 						
		  for($i=0;$i<=74;$i++){
          switch($i){
			case 1: $fr="Удар (пример 20-30):";break;
			case 2: $fr="Долговечность:";break;
			case 3: $fr="Карманов(3 max для поясов):";break;
			case 4: $fr="Материал:";break;
			case 5: $fr="Уловка:";break;
			case 6: $fr="Точность:";break;
			case 7: $fr="Сокрушение:";break;
			case 8: $fr="Стойкость:";break;
			case 9: $fr="Класс брони:";break;
			case 10: $fr="Пробой брони:";$i=26;break;
			case 27: $fr="НР:";break;
			case 28: $fr="Очки действия:";break;
			case 29: $fr="Мана:";break;
			case 30: $fr="Cила:";break;
			case 31: $fr="Ловкость:";break;
			case 32: $fr="Удача:";break;
			case 33: $fr="Здоровье:";break;
			case 34: $fr="Знания:";break;
			case 35: $fr="Мудрость:";break;
			case 36: $fr="Влад. мечами:";break;
			case 37: $fr="Влад. топорами:";break;
			case 38: $fr="Влад. дробящим оружием:";break;
			case 39: $fr="Влад. ножами:";break;
			case 40: $fr="Влад. метательным оружием:";break;
			case 41: $fr="Влад. алебардами и копьями:";break;
			case 42: $fr="Влад. посохами:";break;
			case 43: $fr="Влад. экзотическим оружием:";break;
			case 44: $fr="Влад. двуручным оружием:";break;
			case 45: $fr="Магия огня:";break;
			case 46: $fr="Магия воды:";break;
			case 47: $fr="Магия воздуха:";break;
			case 48: $fr="Магия земли:";break;
			case 49: $fr="Сопротивление магии огня:";break;
			case 50: $fr="Сопротивление магии воды:";break;
			case 51: $fr="Сопротивление магии воздуха:";break;
			case 52: $fr="Сопротивление магии земли:";break;
			case 53: $fr="Воровство:";break;
			case 54: $fr="Осторожность:";break;
			case 55: $fr="Скрытность:";break;
			case 56: $fr="Наблюдательность:";break;
			case 57: $fr="Торговля:";break;
			case 58: $fr="Странник:";break;
			case 59: $fr="Языковедение:";break;
			case 60: $fr="Каллиграфия:";break;
			case 61: $fr="Ювелирное дело:";break;
			case 62: $fr="Самолечение:";break;
			case 63: $fr="Оружейник:";break;
			case 64: $fr="Доктор:";break;
			case 65: $fr="Самолечение:";break;
			case 66: $fr="Быстрое восстановление маны:";break;
			case 67: $fr="Лидерство:";break;
			case 68: $fr="Алхимия:";break;
			case 69: $fr="Развитие горного дела:";break;
			case 70: $fr="Рыбалка:";break;
			case 71: $fr="Охота:";break;
			case 72: $fr="Масса:";break;
			case 73: $fr="Скорость:";break;
			case 74: $fr="Стоимость улучшения:";break;
			}
	if($fr!="")$ResultBody .= '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name="pr['.$i.']" type=text value="'.$par[$i].'" /><br>';
}		  
	$ResultBody .= '</td>
            <td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3"><font class=weaponch><b><label>Уровень:</label>
              <input name="level" type="text" value="'.$it[level].'" /><br><font class=weaponch><b><label>Масса:</label>
              <input name="massa" type="text" value="'.$it[massa].'" /><br>';		  
	$need=explode("|",$it[need]);
foreach ($need as $value) { 
$stat=explode("@",$value);
$ned[$stat[0]]=$stat[1];}
		  for($i=28;$i<=74;$i++){
          switch($i){
			case 28: $fr="Очки действия:";break;
			case 29: $fr="";break;
			case 30: $fr="Cила:";break;
			case 31: $fr="Ловкость:";break;
			case 32: $fr="Удача:";break;
			case 33: $fr="Здоровье:";break;
			case 34: $fr="Знания:";break;
			case 35: $fr="Мудрость:";break;
			case 36: $fr="Влад. мечами:";break;
			case 37: $fr="Влад. топорами:";break;
			case 38: $fr="Влад. дробящим оружием:";break;
			case 39: $fr="Влад. ножами:";break;
			case 40: $fr="Влад. метательным оружием:";break;
			case 41: $fr="Влад. алебардами и копьями:";break;
			case 42: $fr="Влад. посохами:";break;
			case 43: $fr="Влад. экзотическим оружием:";break;
			case 44: $fr="Влад. двуручным оружием:";break;
			case 45: $fr="Магия огня:";break;
			case 46: $fr="Магия воды:";break;
			case 47: $fr="Магия воздуха:";break;
			case 48: $fr="Магия земли:";break;
			case 49: $fr="";break;
			case 50: $fr="";break;
			case 51: $fr="";break;
			case 52: $fr="";break;
			case 53: $fr="Воровство:";break;
			case 54: $fr="Осторожность:";break;
			case 55: $fr="Скрытность:";break;
			case 56: $fr="Наблюдательность:";break;
			case 57: $fr="Торговля:";break;
			case 58: $fr="Странник:";break;
			case 59: $fr="Языковедение:";break;
			case 60: $fr="Каллиграфия:";break;
			case 61: $fr="Ювелирное дело:";break;
			case 62: $fr="Самолечение:";break;
			case 63: $fr="Оружейник:";break;
			case 64: $fr="Доктор:";break;
			case 65: $fr="Самолечение:";break;
			case 66: $fr="Быстрое восстановление маны:";break;
			case 67: $fr="Лидерство:";break;
			case 68: $fr="Алхимия:";break;
			case 69: $fr="Развитие горного дела:";break;
			case 70: $fr="Рыбалка:";break;
			case 71: $fr="Охота:";break;
			case 74: $fr="Стоимость улучшения:";break;
			}
	if($fr!="") $ResultBody .= '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=tr['.$i.'] type=text value="'.$ned[$i].'" /><br>';
	}
	$ResultBody .= '</td>
		</tr>
	   </table></td></tr></table></td></tr>
	</table>
	  <div align="center">
		<input name="edit" type="submit" class="button" value="Сохранить" /> <input name="save" type="submit" class="button" value="Сохранить как новый" /> <input name="del" type="submit" class="button" value="Удалить" />
	  </div>
	</form>
	<div align="center">
	<p><br>';
	}
	}	if($id_adm==3){	$ResultBody .= '<form method="post" action="'.$action.'&id_adm=3">	<select name="type" >	<option value="" selected="selected">все типы</option>      <option value="w4">Ножи</option>      <option value="w1">Мечи</option>      <option value="w2">Топоры</option>      <option value="w3">Дробящее</option>      <option value="w6">Алебарды и копья</option>      <option value="w5">Метательное</option>      <option value="w7">Посохи</option>      <option value="w20">Щиты</option>      <option value="w23">Шлемы</option>      <option value="w26">Пояса</option>      <option value="w18">Кольчуги</option>      <option value="w19">Доспехи</option>      <option value="w24">Перчатки</option>      <option value="w80">Наручи</option>      <option value="w21">Сапоги</option>      <option value="w25">Кулоны</option>      <option value="w22">Кольца</option>    </select><br>	<select name="komplekt" >			<option value="" selected="selected">Все</option>';	$i = 0;	while($i < sizeof($komplekt_DB)){		$ResultBody .= '<option value="'.$i.'"  > '.$komplekt_DB[$i].'</option>';		$i++;	}	$ResultBody .= '</select>			<input name="smb7" type="submit" value="Применить фильтр" />		<select name="idit" >      <option value=0>Выберите тип/Выберите Вещь</option>';	if($smb7){if($type==""&&$komplekt==""){$filter="";}else if($komplekt==""){$filter="WHERE type='$type'";} else{$filter="WHERE komplekt='$komplekt'";}}	$it=mysql_query("SELECT items.id, items.name ,items.level, items.type FROM items $filter ORDER BY type,name,level;");	  while ($row = mysql_fetch_assoc($it)) {	  $ResultBody .= '<option value='.$row[id];	  if($idit==$row[id]){		$ResultBody .= ' selected=selected';}	  $ResultBody .= '>'.$row[name].' [ '.$row[level].' ]</option>"';	  }	$ResultBody .= '</select> <input name="load" type="submit" class="lbut" value="Загрузить" /><br>					</form>';						if($load){		$it=mysql_fetch_assoc(mysql_query("SELECT * FROM items WHERE id='$idit';"));			$ResultBody .= '<form name="edititem" method="post" action="'.$action.'&id_adm=3&idit='.$idit.'">	<table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">	<tr>	  <td valign="top" bgcolor="#f9f9f9"><div id="img"><input name="gif" type="text" value="'.$it[gif].'" /></div>';	  unset($w);          switch($it[type]){			case w0: $w[0]=" selected=selected";break;			case w1: $w[1]=" selected=selected";break;			case w2: $w[2]=" selected=selected";break;			case w3: $w[3]=" selected=selected";break;			case w4: $w[4]=" selected=selected";break;			case w6: $w[5]=" selected=selected";break;			case w5: $w[6]=" selected=selected";break;			case w7: $w[7]=" selected=selected";break;			case w20: $w[8]=" selected=selected";break;			case w23: $w[9]=" selected=selected";break;			case w26: $w[10]=" selected=selected";break;			case w18: $w[11]=" selected=selected";break;			case w19: $w[12]=" selected=selected";break;			case w24: $w[13]=" selected=selected";break;			case w80: $w[14]=" selected=selected";break;			case w21: $w[15]=" selected=selected";break;			case w25: $w[16]=" selected=selected";break;			case w22: $w[17]=" selected=selected";break;			}	$ResultBody .='</select></td>	<td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname>    <select name="type" >      <option value="w4" '.$w[4].'>Ножи</option>      <option value="w1" '.$w[1].'>Мечи</option>      <option value="w2" '.$w[2].'>Топоры</option>      <option value="w3" '.$w[3].'>Дробящее</option>      <option value="w6" '.$w[5].'>Алебарды и копья</option>      <option value="w5" '.$w[6].'>Метательное</option>      <option value="w7" '.$w[7].'>Посохи</option>      <option value="w20" '.$w[8].'>Щиты</option>      <option value="w23" '.$w[9].'>Шлемы</option>      <option value="w26" '.$w[10].'>Пояса</option>      <option value="w18" '.$w[11].'>Кольчуги</option>      <option value="w19" '.$w[12].'>Доспехи</option>      <option value="w24" '.$w[13].'>Перчатки</option>      <option value="w80" '.$w[14].'>Наручи</option>      <option value="w21" '.$w[15].'>Сапоги</option>      <option value="w25" '.$w[16].'>Кулоны</option>      <option value="w22" '.$w[17].'>Кольца</option>    </select>    <input name="name" type="text" value="'.$it[name].'" />';	unset($w);     switch($it[block]){		case 0: $w[0]=" selected=selected";break;		case 40: $w[1]=" selected=selected";break;		case 70: $w[2]=" selected=selected";break;		case 90: $w[3]=" selected=selected";break;		}	$ResultBody .= '<select name="block" >      <option value="0" '.$w[0].'>Не щит</option>      <option value="40" '.$w[1].'>1 точка</option>      <option value="70" '.$w[2].'>2 точки</option>      <option value="90" '.$w[3].'>3 точки</option>    </select>';	if($it['dveruki']==1){$w1="checked";}	$ResultBody .= '<input name="dveruki" type="checkbox" value="1" '.$w1.' />';	unset($w);         switch($it[market]){			case 0: $w[0]=" selected=selected";break;			case 1: $w[1]=" selected=selected";break;			case 2: $w[2]=" selected=selected";break;			case 3: $w[3]=" selected=selected";break;			case 4: $w[4]=" selected=selected";break;			case 7: $w[7]=" selected=selected";break;			}	$ResultBody .= '<select name="market" >      <option value="0" '.$w[0].'>Лавка</option>      <option value="1" '.$w[1].'>Форпост</option>      <option value="3" '.$w[3].'>Октал</option>      <option value="2" '.$w[2].'>Деревня Подгорная</option>	  <option value="4" '.$w[4].'>ДД</option>	  <option value="7" '.$w[7].'>Новая лавка</option>    </select>';	if($it['2w']==1){$w1="checked";}else{$w2="checked";}	$ResultBody .='<strong>Второе оружие</strong>    да    <input name="wtor" type="radio" value="1" '.$w1.' />    нет    <input name="wtor" type="radio" value="0" '.$w2.' />';	unset($w);             switch($it[slot]){				case 1: $w[1]=" selected=selected";break;				case 2: $w[2]=" selected=selected";break;				case 3: $w[3]=" selected=selected";break;				case 4: $w[4]=" selected=selected";break;				case 5: $w[5]=" selected=selected";break;				case 8: $w[8]=" selected=selected";break;				case 9: $w[9]=" selected=selected";break;				case 10: $w[10]=" selected=selected";break;				case 11: $w[11]=" selected=selected";break;				case 12: $w[12]=" selected=selected";break;				case 13: $w[13]=" selected=selected";break;				case 14: $w[14]=" selected=selected";break;				case 16: $w[16]=" selected=selected";break;				case 17: $w[17]=" selected=selected";break;				}	$ResultBody .= '&nbsp; Слот: <select name="slot">          <option value="1" '.$w[1].'>Шлем</option>          <option value="2" '.$w[2].'>Ожерелье</option>          <option value="3" '.$w[3].'>Оружие</option>          <option value="4" '.$w[4].'>Пояс</option>          <option value="5" '.$w[5].'>Содержимое карманов пояса</option>          <option value="8" '.$w[8].'>Слот для сапог</option>          <option value="9" '.$w[9].'>Слот для кармана</option>          <option value="10" '.$w[10].'>Содержимое кармана</option>          <option value="11" '.$w[11].'>Наручи</option>          <option value="12" '.$w[12].'>Перчатки</option>          <option value="13" '.$w[13].'>Щит</option>          <option value="14" '.$w[14].'>Кольцо</option>          <option value="16" '.$w[16].'>Броня</option>          <option value="17" '.$w[17].'>Кольчуга</option>        </select> Время: <input name="tim" type="text" value=" '.$it[tim].'"/>		Умелка: <input name="umelka" type="text" value=" '.$it[umelka].'"/>';	$ResultBody .= 'Молот:<select name="molot" >';	$i = 0;	while($i < sizeof($molot_DB)){		if ($i == $it[molot]){			$ResultBody .= '<option value="'.$molot_DB[$i].'" selected=selected> '.$molot_DB[$i].'</option>';		}		else {			$ResultBody .= '<option value="'.$molot_DB[$i].'"> '.$molot_DB[$i].'</option>';		}		$i++;	}	$ResultBody .= '</select>    <br><img src=../image/1x1.gif width=1 height=3></td><td><br><img src=../image/1x1.gif width=1 height=3</td></tr>	<tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr>	<td width=50% bgcolor=#D8CDAF><div align=center><font class=invtitle>свойства</div></td>	<td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</div></td></tr>	<tr><td align="right" bgcolor="#FCFAF3"><font class=weaponch>';	$iron_res=explode("|",$it[iron_res]);	foreach ($iron_res as $value) { 	$stat=explode("@",$value);	$iro[$stat[0]]=$stat[1];} 								  for($i=0;$i<=51;$i++){          switch($i){			case 1: $fr="Олово:";break;			case 2: $fr="Медь:";break;			case 3: $fr="Бронза:";break;			case 4: $fr="Жалезо:";break;			case 5: $fr="Латунь:";break;			case 6: $fr="Маргонит:";break;			case 7: $fr="Сталь:";break;			case 8: $fr="Фахраль:";break;			case 9: $fr="Акмонитал:";break;			case 10: $fr="Серебро:";break;			case 11: $fr="Булат:";break;			case 12: $fr="Сильверит:";break;			case 13: $fr="Золото:";break;			case 14: $fr="Темное серебро:";break;			case 15: $fr="Имперское золото:";break;			case 16: $fr="Платина:";break;			case 17: $fr="Оливин:";break;			case 18: $fr="Альвийское серебро:";break;			case 19: $fr="Мифрил:";$i=50;break;			case 50: $fr="Кожа:";break;			case 51: $fr="Ткань:";break;			}	if($fr!="")$ResultBody .= '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=ir['.$i.'] type=text value="'.$iro[$i].'" /><br>';}		  	$ResultBody .= '</td>            <td bgcolor=#B9A05C><img src=../image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3">';		  	$wood_res=explode("|",$it[wood_res]);	foreach ($wood_res as $value) { 	$stat=explode("@",$value);	$ned[$stat[0]]=$stat[1];}		  for($i=28;$i<=47;$i++){          switch($i){			case 28: $fr="Заготовка из орешника:";break;			case 29: $fr="Заготовка из ивы";break;			case 30: $fr="Заготовка из медного кактуса:";break;			case 31: $fr="Сухая дифенбахия:";break;			case 32: $fr="Заготовка из осины:";break;			case 33: $fr="Заготовка из ольхи:";break;			case 34: $fr="Сухая жимолость:";break;			case 35: $fr="Заготовка из песчаной колючки:";break;			case 36: $fr="Заготовка из березы:";break;			case 37: $fr="Заготовка из фигового дерева:";break;			case 38: $fr="Заготовка из липы:";break;			case 39: $fr="Заготовка из Сосны:";break;			case 40: $fr="Заготовка из бамбука:";break;			case 41: $fr="Заготовка из тополя:";break;			case 42: $fr="Заготовка из драцены:";break;			case 43: $fr="Заготовка из бука:";break;			case 44: $fr="Заготовка из тиса:";break;			case 45: $fr="Заготовка из вяза:";break;			case 46: $fr="Заготовка из эвкалипта:";break;			case 47: $fr="Заготовка из граба:";break;			}	if($fr!="") $ResultBody .= '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=wd['.$i.'] type=text value="'.$ned[$i].'" /><br>';	}	$ResultBody .= '</td>		</tr>	   </table></td></tr></table></td></tr>	</table>	  <div align="center">		<input name="kraft" type="submit" class="button" value="Сохранить" />	  </div>	</form>	<div align="center">	<p><br>';	}	}
}	

print '<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td>
			<a href="?aid='.$aid.'&id_adm=1" value="Изготовление предметов" class="button">Изготовление предметов</a> 
			<a href="?aid='.$aid.'&id_adm=4" value="Редактор предметов" class="button">Редактор предметов</a>			<a href="?aid='.$aid.'&id_adm=3" value="Крафт/Редактор предметов" class="button">Крафт/Редактор предметов</a>
			</td></tr>
		</table><br>';
if(!empty($ResultBody))
{
  print $ResultBody;
}		
closetable();
require_once BASEDIR."footer.php";
?>