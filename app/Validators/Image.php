<?php

namespace Validators;
class Image
{
    public static function uploadFile($request, $uploadDirectory): void
    {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar'];
            $filename = $uploadDirectory . basename($avatar['name']);
            if (move_uploaded_file($avatar['tmp_name'], $filename)) {
                $request->set('avatar', $filename);
            }
        }
    }
}