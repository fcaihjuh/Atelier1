<?php

namespace Loader;

  class ClassLoader extends AbstractClassLoader{

    public function loadClass(string $classname)
    {
      $classname = $this -> getfilename($classname);
      $classname = $this -> makePath($classname);

      if(file_exists($classname))
      {
        require_once($classname);
      }
    }

    protected function makePath(string $filename): string
    {
      $file = $this -> prefix.DIRECTORY_SEPARATOR.$filename;
      return $file;
    }

    protected function getFilename(string $classname): string
    {
      $class = str_replace("\\",DIRECTORY_SEPARATOR,$classname).".php";
      return $class;
    }

}