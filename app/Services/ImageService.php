<?php

namespace App\Services;

use Kreait\Firebase\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $storageClient = $this->storage->getStorageClient();
        $this->bucket = $storageClient->bucket(env('FIREBASE_DATABASE_URL'));
    }

    public function create($newPicture, $objectName)
    {
        $this->bucket->upload(fopen($newPicture->getPathName(), 'r'), [
            'name' => $objectName,
            'predefinedAcl' => 'PUBLICREAD'
        ]);
    }

    public function delete($pictureLink)
    {
        $names = explode('/', $pictureLink);
        // Get file name from link
        $objectName = end($names);
        $this->bucket->object($objectName)->delete();
    }

    public function edit($prevPicture, $newPicture)
    {
        // Delete previous picture if new picture is not null
        if ($prevPicture && $newPicture) {
            $this->delete($prevPicture);
        }

        if ($newPicture) {
            $objectName = (string) Str::uuid().".".$newPicture->getClientOriginalExtension();
            $this->create($newPicture, $objectName);
            return 'https://storage.googleapis.com/'.env('FIREBASE_DATABASE_URL').'/'.$objectName;
        }

        return $prevPicture;
    }
}
