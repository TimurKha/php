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
opentable($locale['8001']);


                $clans = fopen("http://service.neverlands.ru/rate/players.txt","r");
echo "<center><table border=1 cellspacing=1 cellpadding=1 class=centr_table width=500><tr align=center><td width=60><b>&nbsp;#&nbsp;</b></td><td><b width=195>Ник</b></td><td width=125><b>&nbsp;Очки&nbsp;</b></td></tr>";
$pos = 1;
$row = 0;
while ($data = file_fgetcsv::fgetcsv($clans, 1000, "|"))
{
        if ($row != 1) {


        $cname = $data[2];
$cpoint = $data[4];
$cup = $pos;


$request = "SELECT cname FROM $ustable  WHERE cname='$cname'";
$r = mysql_query($request);
$rws = mysql_fetch_row($r);

if ($rws == '0') {
    mysql_query("INSERT  $ustable(cname,cpoint,cup) VALUES ('$cname','$cpoint','$pos')") or die(MySQL_error());
} else {
    $request = "SELECT cpoint, cp, cup FROM $ustable  WHERE cname='$cname'";
    $r = mysql_query($request);
    while ($rows = mysql_fetch_row($r)) {
           $check_point = $cpoint - $rows[0];
           $check_up = $rows[2] - $pos;
           if ($check_point != '0') {
               mysql_query("UPDATE $ustable SET cpoint='$cpoint', cup='$cup', cp='$check_point', cu='$check_up' WHERE cname='$cname'") or die(mysql_error());
           }
    }

}

$requestp = "SELECT  cp, cu FROM $ustable  WHERE cname='$cname'";
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

        for ($c=0;$c<count($data); $c++)
                {

                 if ($data[1] == $clanznak) {
                  $bgclr = $bgcolor_highlited;
                 } else {
                   $bgclr = $bgcolor_normal;
                    }
                if ($c == 0)
                        switch ($data[$c])
                        {
                        case "0": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;"; break;
                        case "1": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/darks.gif border=1> "; break;
                        case "2": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/lights.gif border=1> "; break;
                        case "3": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/sumers.gif border=1> "; break;
                        case "4": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/chaoss.gif border=1> "; break;
						case "5": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/light.gif border=1> "; break;
						case "6": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/dark.gif border=1> "; break;
                        case "9": $data[$c] = "<tr bgcolor=".$bgclr."><td align=center><b><font color=$fontcolor>".$pos." </font></b>".$view_up."</td><td>&nbsp;<img src=http://image.neverlands.ru/signs/angel.gif border=1> "; break;
                        }
                if ($c == 1)
                        if ($data[$c] == "none")
                        $data[$c] = ""; else

                        $data[$c] = "<img src=http://image.neverlands.ru/signs/".$data[$c]." border=1> ";



                if ($c == 2){
                        $pos++;
                        $login = $data[$c];

                        $data[$c] = "<font color=$fontcolor>$data[$c]</font>";
                        }

                if ($c == 3)
                $data[$c] = "<font color=$fontcolor> [".$data[$c]."] <a href=\"http://www.neverlands.ru/pinfo.cgi?".$login."\" target=_blank><img src=http://image.neverlands.ru/chat/info.gif border=1></a></font></td>";

                if ($c == 4)
                $data[$c] = "<td align=left><font color=$fontcolor><b>".$data[$c]."</b> ".$view_point."</font></td>";

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