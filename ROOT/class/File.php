<?php
class File {
    private static function reArrayFiles($file) {
        $file_ary = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);

        for($i=0;$i<$file_count;$i++)
        {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
    }

    public static function upload($key, $options = array(), $callback = null) {
        $errors= array();

        $file_name = $_FILES[$key]['name'];
        $file_size =$_FILES[$key]['size'];
        $file_tmp =$_FILES[$key]['tmp_name'];
        $file_type=$_FILES[$key]['type'];
        $file_ext=strtolower(end(explode('.',$_FILES[$key]['name'])));

        if(isset($options['extensions']) && in_array($file_ext,$options['extensions']) === false){
            $errors[]="Extension not allowed";
        }

        if(isset($options['sizelimit']) && $file_size > $options['sizelimit']){
            $errors[]='File size limit reached';
        }

        if(empty($errors)==true){
            if (isset($options['name'])) {
                move_uploaded_file($file_tmp, $options['path'] . $options['name']);
            } else {
                move_uploaded_file($file_tmp, $options['path'] . $options['prefix'] .$file_name);
            }
        } else {
            if (is_callable($callback)) {
                call_user_func($callback, $errors);
            }
        }
    }

    public static function uploadMany($key, $options = array(), $callback = null) {
        $errors = [];
        $files = $_FILES[$key];
        $files_desc = static::reArrayFiles($files);
        foreach($files_desc as $val)
        {
            $file_size =$val['size'];
            $file_ext=strtolower(end(explode('.',$val['name'])));

            if(isset($options['extensions']) && in_array($file_ext,$options['extensions']) === false){
                $errors[]="Extension not allowed";
            }

            if(isset($options['sizelimit']) && $file_size > $options['sizelimit']){
                $errors[]='File size limit reached';
            }

            if(empty($errors)==true){
                if (isset($options['name'])) {
                    move_uploaded_file($val['tmp_name'], $options['path'] . $options['name']);
                } else {
                    move_uploaded_file($val['tmp_name'], $options['path'] . $options['prefix'] .$val['name']);
                }
            } else {
                if (is_callable($callback)) {
                    call_user_func($callback, $errors);
                }
                break;
            }
        }
    }
}
