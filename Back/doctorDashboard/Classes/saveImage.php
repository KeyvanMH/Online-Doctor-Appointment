<?php
class saveImage{
    public static function saveImage($tmpName){
        try {
            $filename = '../image/'.$_SESSION['id'].'.jpg';
            $stream = fopen($filename,'w+');
            fwrite($stream,file_get_contents($tmpName));
            fclose($stream);
            return 'image/'.$_SESSION['id'].'.jpg';
        } catch (\Throwable) {
            errorHandling::internalError();
        }
    }
}