<?php
$ip = "127.0.0.1";
$len = 160;
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
$cnum = $num;	//color number
if(is_array($_GET)&&count($_GET)>0)
{
	if(isset($_GET['c']))
	{
		$cnum = $_GET['c'];
	}
}
$bstr = sprintf("%015b",$num);
$idx = array(  0, 20, 40,  0, 20, 40,  0, 20, 40,  0, 20, 40,  0, 20, 40 );
$idy = array(  0,  0,  0, 20, 20, 20, 40, 40, 40, 60, 60, 60, 80, 80, 80 );
$rgb = array(  0, 95,135,175,215,255);
$fr = ($cnum - 16) / 6 / 6 % 6;
$fg = ($cnum - 16) / 6 % 6;
$fb = ($cnum - 16) % 6;

$img = imagecreatetruecolor($len,$len);	//�½�ͼ��Ĭ�ϱ����Ǻ�ɫ������ͼ���ʶ����
$colorf = imagecolorallocate($img, $rgb[$fr],$rgb[$fg],$rgb[$fb]);
$colorb = imagecolorallocate($img, 238,238,238);

imagefill($img,0,0,$colorb);
for ($i=0; $i<15; $i++)
{
    if($bstr[$i] == "1")
    {   
		imagefilledrectangle($img,($idx[$i]*$len/100),($idy[$i]*$len/100),(($idx[$i]+20)*$len/100),(($idy[$i]+20)*$len/100),$colorf);
		if($i %3 != 2)
		{
			imagefilledrectangle($img,((80-$idx[$i])*$len/100),($idy[$i]*$len/100),((100-$idx[$i])*$len/100),(($idy[$i]+20)*$len/100),$colorf);
		}
    }   
}
header("content-type: image/png");
imagepng($img);	//�����ҳ�档����еڶ�������[,$filename],���ʾ����ͼ��
imagedestroy($img);
?>