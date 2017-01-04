<?php
$ip = "127.0.0.1";
$len = 100;
if(is_array($_SERVER)&&count($_SERVER)>0)
{
	if(isset($_SERVER['REMOTE_ADDR']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		if(strspn($ip,':') > 0)
		{
			$ip = rand(0,255).".".rand(0,255).".".rand(0,255).".".rand(0,255);
		}
	}
}
$iparr = explode('.', $ip);
$num = 256 * $iparr[0] + $iparr[1];

if(is_array($_GET)&&count($_GET)>0)
{
	if(isset($_GET['id']))
	{
		$num = $_GET['id'];
	}
	if(isset($_GET['l']))
	{
		$len = $_GET['l'];
	}
}
$bstr = sprintf("%015b",$num);
$idx = array(  0, 20, 40,  0, 20, 40,  0, 20, 40,  0, 20, 40,  0, 20, 40 );
$idy = array(  0,  0,  0, 20, 20, 20, 40, 40, 40, 60, 60, 60, 80, 80, 80 );
$rgb = array(255,215,175,135, 95,  0);
$fr = $num % 6;
$fg = $num / 6 % 6;
$fb = $num / 6 / 6 % 6;

echo "<svg width=\"".($len/10)."em\" height=\"".($len/10)."em\">\n";
echo "<rect x=\"0%\" y=\"0%\" width=\"100%\" height=\"100%\" style=\"fill:rgb(252,252,252)\" />\n";//灰色背景
for ($i=0; $i<15; $i++)
{
    if($bstr[$i] == "1")
    {   
        echo "<rect x=\"$idx[$i]%\" y=\"$idy[$i]%\" width=\"20%\" height=\"20%\" style=\"fill:rgb($rgb[$fr],$rgb[$fg],$rgb[$fb])\" />\n";
        if($i %3 != 2)
        {
            echo "<rect x=\"".(80-$idx[$i])."%\" y=\"$idy[$i]%\" width=\"20%\" height=\"20%\" style=\"fill:rgb($rgb[$fr],$rgb[$fg],$rgb[$fb])\" />\n";
        }
    }   
}
echo "</svg>\n";
?>

