<?
require_once "maincore.php";
require_once "subheader.php";
require_once "side_left.php";
include('config.php');
include('license.php');
require_once('fgetcsv.php');
include LOCALE.LOCALESET."clan.php";

mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_select_db($db_name) or die(mysql_error()) or die(mysql_error());
mysql_query("set CHARACTER SET cp1251");
opentable($locale['8003']);

$clans = fopen("http://service.neverlands.ru/rate/align.txt","r");

echo "<center><table border=1 cellspacing=1 cellpadding=1 class=centr_table width=400><tr align=center><td width=50><b>&nbsp;Склонность&nbsp;</b></td><td><b width=225>Количество очков</b></td><td width=85><b>&nbsp;Количество персонажей&nbsp;</b></td><td width=85><b>&nbsp;Среднее значение&nbsp;</b></td></tr>";
$pos = 1;
$row = 0;
while ($data = file_fgetcsv::fgetcsv($clans, 1000, "|"))
{
        if ($row > 1) {
$cname = $data[0];
$cpoint = $data[1];
$cpers = $data[2];
$cmiddle = $data[3];
$cup = $pos;


$request = "SELECT cname FROM $altable  WHERE cname='$cname'";
$r = mysql_query($request);
$rws = mysql_fetch_row($r);

if ($rws == '0') {
    mysql_query("INSERT  $altable(cname,cpoint,cup,cpers,cmiddle) VALUES ('$cname','$cpoint','$pos','$cpers','$cmiddle')") or die(MySQL_error());
} else {
    $request = "SELECT cpoint, cp, cup,cpers,cmiddle FROM $altable  WHERE cname='$cname'";
    $r = mysql_query($request);
    while ($rows = mysql_fetch_row($r)) {
           $check_point = $cpoint - $rows[0];
           $check_up = $rows[2] - $pos;
	   $check_pers = $cpers - $rows[3];
	   $check_middle = $cmiddle - $rows[4];
           if ($check_point != '0' or $check_up != '0' or $check_pers !='0' or $check_middle !='0') {
               mysql_query("UPDATE $altable SET cpoint='$cpoint', cup='$cup', cmiddle='$cmiddle', cpers='$cpers', cp='$check_point', cu='$check_up', cmiddles='$check_middle', cperschange='$check_pers' WHERE cname='$cname'") or die(mysql_error());
           }
    }

}
    $request = "SELECT cpoint, cp,cperschange,cmiddles FROM $altable  WHERE cname='$cname'";
    $r = mysql_query($request);
    $rows = mysql_fetch_row($r);

	for ($c=0;$c<count($data); $c++)
                {
                $bgclr = $bgcolor_normal;
                if ($c == 0)
                        switch ($data[$c])
                        {
                        case "1": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center>&nbsp;<img src=http://image.neverlands.ru/signs/darks.gif border=1></td> "; break;
                        case "2": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center>&nbsp;<img src=http://image.neverlands.ru/signs/lights.gif border=1></td> "; break;
                        case "3": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center>&nbsp;<img src=http://image.neverlands.ru/signs/sumers.gif border=1></td> "; break;
                        case "4": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center>&nbsp;<img src=http://image.neverlands.ru/signs/chaoss.gif border=1></td> "; break;
                        }
                if ($c == 1){
if($rows[1]==0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font></td>";
if($rows[1]>0) $data[$c] =  "<td align=center><font color=$fontcolor>$data[$c]</font><font color=green>(+$rows[1])</font></td>";
if($rows[1]<0) $data[$c] =  "<td align=center><font color=$fontcolor>$data[$c]</font><font color=red>($rows[1])</font></td>";

}

                if ($c == 2){
                        $pos++;
if($rows[2]==0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font></td>";
if($rows[2]>0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font><font color=green>(+$rows[2])</font></td>";
if($rows[2]<0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font><font color=red>($rows[2])</font></td>";

                        }

                if ($c == 3){
if($rows[3]==0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font></td>";
if($rows[3]>0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font><font color=green>(+$rows[3])</font></td>";
if($rows[3]<0) $data[$c] = "<td align=center><font color=$fontcolor>$data[$c]</font><font color=red>($rows[3])</font></td>";

}

                echo $data[$c];
                } }
        echo "</tr>";
        $row++;
}
echo "</table></center>";
fclose($clans);
closetable();

require_once "side_right.php";
require_once "footer.php";
?>