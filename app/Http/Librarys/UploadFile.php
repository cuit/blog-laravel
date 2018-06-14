<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/12
 * Time: 18:58
 */

namespace App\Http\Librarys;

class UploadFile
{
    public static function multipleUpload($inputName = "myFile"){
        $files = $_FILES[$inputName];
        //得到上传图片的张数
        if(is_array($files['name'])){
            $count = count($files['name']);
            for($i=0;$i<$count;$i++){
                foreach ($files as $key=>$value){
                    $file[$key] = $value[$i];
                }
                $filename[$inputName][$i] = UploadFile::upload($file);
            }
        }else{
            $filename[$inputName] = UploadFile::upload($files);
        }
        //var_dump($filename);
        return $filename;
    }

    public static function upload($file,$allowType = array("jpg","jpeg","png","gif"),$path = "upload/",$allowSize=5242880){
        $filename = $file['name'];
        $tmpname = $file['tmp_name'];
        $type = $file['type'];
        $error = $file['error'];
        $size = $file['size'];
        $allowSize = 5242880;  //5M
        if(!$error){
            if($size>$allowSize){
                exit("上传文件过大");
            }
            $ext = StringFunc::getExtName($filename);
            if(!in_array($ext, $allowType)){
                exit("上传文件类型不符合规范");
            }
            if(!getimagesize($tmpname)){
                exit("非法类型上传");
            }
            if(!is_uploaded_file($tmpname)){
                exit("不是通过HTTP POST方式上传的");
            }
            if(!is_dir($path)){
                mkdir($path,0777,true);
            }
            $destination = $path.StringFunc::getUniqName().".".$ext;
            if(move_uploaded_file($tmpname, $destination)){
                $msg = "上传成功！";
                $callBack['filepath'] = $destination;
                unset($filename);
                unset($tmpname);
                unset($type);
                unset($error);
                unset($size);
                unset($ext);
                return $callBack;
            }else{
                exit("上传失败");
            }
        }else{
            switch ($error){
                case 1:
                    $msg="超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
                    break;
                case 2:
                    $msg="超过了表单设置上传文件的大小";			//UPLOAD_ERR_FORM_SIZE
                    break;
                case 3:
                    $msg="文件部分被上传";//UPLOAD_ERR_PARTIAL
                    break;
                case 4:
                    $msg="没有文件被上传";//UPLOAD_ERR_NO_FILE
                    break;
                case 6:
                    $msg="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
                    break;
                case 7:
                    $msg="文件不可写";//UPLOAD_ERR_CANT_WRITE;
                    break;
                case 8:
                    $msg="由于PHP的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
                    break;
            }
        }
        echo $msg;
    }
}