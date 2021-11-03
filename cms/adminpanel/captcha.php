<?php   
        header('Content-Type: image/png');
        $im = imagecreate(75, 40)or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 250, 250, 100); 
        $red = imagecolorallocate($im, 255, 100, 100);
        $blue = imagecolorallocate($im,100,100,255);
        $green = imagecolorallocate($im,100,255,100);
        $white=imagecolorallocate($im,250,250,250);
 
        $num=rand(1001,9999);
        $strnum=$num."";
        session_start();
        $_SESSION['captcha-code']=$num;
 
        for($i=0;$i<3;$i++){
        imageline ($im,  rand(2,35),  rand(0,45), rand(40,73), rand(10,40), $red);
        imageline ($im,  rand(2,35),  rand(0,45), rand(40,73), rand(10,40), $blue);        
        imageline ($im,  rand(2,35),  rand(0,45), rand(40,73), rand(10,40), $green);
        imagefilledellipse($im, rand(2,70),  rand(0,45), 10, 10, $white);
        imagefilledellipse($im, rand(2,70),  rand(0,45), 5, 10, $green);
        imagefilledellipse($im, rand(2,70),  rand(0,45), 5, 5, $blue);
        imagefilledellipse($im, rand(2,70),  rand(0,45), 7, 12, $red);
        }
 
        $ff=dirname(__FILE__) . '/fonts/vazir/vazir.ttf';  
 
        imagettftext($im, 22,0, 5,  rand(20,30),imagecolorallocate($im, rand(0,50), rand(0,100),rand(50,150)),$ff,$strnum[0] );
        imagettftext($im, 22,0, 22,  rand(20,30),imagecolorallocate($im, rand(0,50), rand(0,100),rand(50,150)),$ff,$strnum[1] );
        imagettftext($im, 22,0, 38,  rand(20,30),imagecolorallocate($im, rand(0,50), rand(0,100),rand(50,150)),$ff,$strnum[2] );
        imagettftext($im, 22,0, 52,  rand(20,30),imagecolorallocate($im, rand(0,50), rand(0,100),rand(50,150)),$ff,$strnum[3] );
 
        imagepng($im);
 
        imagedestroy($im);     
?>