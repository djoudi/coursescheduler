<?php

$start =  mktime(0,0,0,1,7,2008);
$next = mktime(0,0,0,1,14,2008);

$factor = $next - $start;
echo $factor . "<br>";
$display = $start + $factor;
echo date("l n/d/Y",$start) . "<br>";
echo date("l n/d/Y",$next) . "<br>";
echo date("l n/d/Y",$display) . "<br>";
$month=6;
$day=22;
$yr=2008;
echo "<form><select>";
for($x=1;$x<=12;$x++){
$monthname = date("F",mktime(0,0,0,$x,1,0));
$monthnum = date("d",mktime(0,0,0,$x,1,0));
if($x==$month){echo "<option value='" . $monthnum . " 'selected>" . $monthname . "</option>";
}else{	
echo "<option value='" . $monthnum . "'>" . $monthname . "</option>";
}
}

echo "</select><select>";

for($x=1;$x<=31;$x++){
if($x==$day){echo "<option value='" . $x . " 'selected>" . $x . "</option>";
}else{	
echo "<option value='" . $x . "'>" . $x . "</option>";
}
}

echo "</select><select>";

for($x=2007;$x<=2015;$x++){
if($x==$yr){echo "<option value='" . $x . " 'selected>" . $x . "</option>";
}else{	
echo "<option value='" . $x . "'>" . $x . "</option>";
}
}


echo "</select></form>";



?>