<?php
namespace CMS\Service;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CheckInfoService{
    public static function checkSizeBetween($str,$sizeMax, $sizeMin = 0){
        return strlen($str) <= $sizeMax && strlen($str) >= $sizeMin;
    }
    
    public static function isPassSame($pass1, $pass2){
        return $pass1 === $pass2;
    }
    
    public static function checkEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public static function checkUsermame($username){
        return preg_match("/[a-zA-Z0-9]{1,16}/", $username);
    }
    
    public static function checkFileSize(\Symfony\Component\HttpFoundation\File\UploadedFile $file,$size){
        return filesize($file->getRealPath()) <= $size;
    }
    
    public static function checkFileExtensionAllowed($file,$extensions){
        return in_array(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION), $extensions);
    }
}