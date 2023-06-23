<?php

class Compact
{
    protected $files = [];

    public function addFile($file)
    {
        if (!file_exists($file)) {
            throw new Exception("file not exists");
            die();
        }

        $this->files[] = $file;
    }

    public function create($name)
    {
        if (file_exists($name)) {
            throw new Exception("file exists");
            die();
        }

        $handle = fopen($name, 'w');

        foreach ($this->files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == "css") {
                $comment = "/*  " . $this->filename($file) . "  */";
            }
            if (pathinfo($file, PATHINFO_EXTENSION) == "js") {
                $comment = "//  " . $this->filename($file) ;
            }
            $compactFile .= $comment . PHP_EOL . file_get_contents($file) . PHP_EOL;
        }
        fwrite($handle, $compactFile);
        fclose($handle);

        unset($this->files);
    }

    public function filename($file)
    {
        $fileArr = explode('/', $file);
        return end($fileArr);
    }
}
