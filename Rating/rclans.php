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
mysql_query("SET CHARACTER SET cp1251");
opentable($locale['8000']);
        
$clans = fopen("http://service.neverlands.ru/rate/clans.txt","r")or die( "ќшибка!" );

echo "<center><table border=1 cellspacing=1 cellpadding=1 class=centr_table width=500>
<tr align=center><td width=60><b>&nbsp;#&nbsp;</b></td><td><b width=195> лан</b></td><td width=125><b>&nbsp;ќчки&nbsp;</b></td></tr>";
$pos = 0;
$row = 0;
while ($data = file_fgetcsv::fgetcsv($clans, 2000, "|"))
{
        if ($row != 1) {
		
$csc = $data[0];
$cznak = $data[1];
$cname = $data[2];
$cpoint = $data[3];
$cup = $pos;


$request = "SELECT cname FROM $userstable  WHERE cname='$cname'";
$r = mysql_query($request);
$rws = mysql_fetch_row($r);

if ($rws == '0') {
    mysql_query("INSERT  $userstable(cname,cpoint,cup,clan_zn,clan_sc) VALUES ('$cname','$cpoint','$pos','$cznak','$csc')") or die(MySQL_error());
} else {
    $request = "SELECT cpoint, cp, cup FROM $userstable  WHERE cname='$cname'";
    $r = mysql_query($request);
    while ($rows = mysql_fetch_row($r)) {
           $check_point = $cpoint - $rows[0];
           $check_up = $rows[2] - $pos;
           if ($check_point != '0') {
               mysql_query("UPDATE $userstable SET cpoint='$cpoint', cup='$cup', cp='$check_point', cu='$check_up' WHERE cname='$cname'") or die(mysql_error());
           }
    }

}

$requestp = "SELECT  cp, cu FROM $userstable  WHERE cname='$cname'";
    $rp = mysql_query($requestp);
    while ($rowsp = mysql_fetch_row($rp)) {
     $view_point = $rowsp[0];
     $view_up = $rowsp[1];
    }

if ($view_point >= '1') {$view_point = '<font color=green style="font-size: 9px;">(+'.$view_point.'</a>)</font>';}
if ($view_point <= '-1') {$view_point = '<font color=red style="font-size: 9px;">('.$view_point.'</a>)</font>';}
if ($view_up >= '1') {$view_up = '<font color=green style="font-size: 9px;">(+'.$view_up.'</a>)</font>';}
if ($view_up <= '-1') {$view_up = '<font color=red style="font-size: 9px;">('.$view_up.'</a>)</font>';}
if ($view_up == '0') {$view_up = '';}
if ($view_point == '0') {$view_point = '';}

       if (isset($data[2])) {
        if ($data[2] == "$clanname") $bgcol = $bgcolor_highlited; else $bgcol = $bgcolor_normal; }
        if (isset($data[2])) echo "<tr><td align=center><b><font color=$fontcolor>".$pos." </font></b><font color=$fontcolor>".$view_up."</font></td>";

        $pos++;
        for ($c=0;$c<count($data)-2; $c++)
                {


                if ($c == 0)
                        switch ($data[$c])
                        {
                        case "0": $data[$c] = "<td>&nbsp;"; break;
                        case "1": $data[$c] = "<td>&nbsp;<img src=http://image.neverlands.ru/signs/darks.gif border=1> "; break;
                        case "2": $data[$c] = "<td>&nbsp;<img src=http://image.neverlands.ru/signs/lights.gif border=1> "; break;
                        case "3": $data[$c] = "<td>&nbsp;<img src=http://image.neverlands.ru/signs/sumers.gif border=1> "; break;
                        case "4": $data[$c] = "<td>&nbsp;<img src=http://image.neverlands.ru/signs/chaoss.gif border=1> "; break;
                        }

                if ($c == 1)
                        $data[$c] = "<img src=http://image.neverlands.ru/signs/".$data[$c]." border=1> ";

                if ($c == 2){


		        if ($data[$c] == "$clanname")
                        $data[$c] = "<b>".$data[$c]."</b>";
                        $data[$c] = "<font color=$fontcolor>".$data[$c]."</font></td>";
                        }

                if ($c == 3)
                $data[$c] = '<td align=left><b><font color='.$fontcolor.'>'.$data[$c].'</font></b> '.$view_point.'</td>';

                echo $data[$c];
                } }
        echo "</tr>";
$row++;
}
fclose($clans);
echo "</table></center>";
closetable();

require_once "side_right.php";
require_once "footer.php";
?>
