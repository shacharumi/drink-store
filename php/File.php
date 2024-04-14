<?php

class File {
    public static function upload($files, $targetPath) {
        move_uploaded_file($files["tmp_name"], $targetPath);
    }
}