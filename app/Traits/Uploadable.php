<?php
namespace App\Traits;

trait Uploadable {
    public function upload($file, $directory) {
        if ($file) {
            $name = mt_rand().'.'.$file->clientExtension();
            $file->move($directory, $name);
            return $name;
        }
        else {
            return null;
        }
    }
}