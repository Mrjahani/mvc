<?php

namespace app;

class view
{
    public static function render($viewpath , $data = null)
    {
        $viewpath = str_replace(".",DIRECTORY_SEPARATOR,$viewpath);
        $file = VIEWPATH . $viewpath . ".php";
        if (is_readable($file)){
            ob_start();
            if (!empty($data))
                extract($data);
            require_once "$file";
            $content = ob_get_clean();
            require MASTERVIEW;
        }else{
            throw new \Exception("view not found");
            return false;
        }
    }
}