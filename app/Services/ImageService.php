<?php

namespace App\Services;

use Kreait\Firebase\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function create($newPicture, $objectName)
    {
        $storageClient = $this->storage->getStorageClient();
        $bucket = $storageClient->bucket(env('FIREBASE_DATABASE_URL'));
        $object = $bucket->upload(fopen($newPicture->getPathName(), 'r'), [
            'name' => $objectName
        ]);

        dd($object);

        return $object;
    }

    public function delete($pictureLink)
    {
    }

    public function edit($prevPictureLink, $newPicture)
    {
        // Delete previous picture then create new picture
        if ($prevPictureLink) {
            $this->delete($prevPictureLink);
        }
        if ($newPicture) {
            $objectName = (string) Str::uuid().".".$newPicture->getClientOriginalExtension();
            $this->create($newPicture, $objectName);
            return 'https://storage.googleapis.com/'.env('FIREBASE_DATABASE_URL').'.appspot.com/'.$objectName;
        }

        return Null;
    }
}
