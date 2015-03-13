<?php
namespace Arch\Connect;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Interface ImgInterface{
        public function setPathImg($pathImg);
	public function getPathImg();
	public function upload(\Symfony\Component\HttpFoundation\File\UploadedFile $file);
        public function getUploadFolder();
        public function getWebPathImg();
}