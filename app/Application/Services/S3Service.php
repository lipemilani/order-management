<?php

namespace App\Application\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class S3Service
{
    public function get(string $name)
    {
        return Storage::disk('s3')->get($name);
    }

    public function put(UploadedFile $content)
    {
        $hashName = Uuid::uuid4()->toString() . '.' . $content->getClientOriginalExtension();
        Storage::disk('s3')->put($hashName, $content->getContent());
        $urlStorage = Storage::disk('s3')->url($hashName);
        $urlStorage = str_replace('s3:9000', 'localhost:9444', $urlStorage);
        return str_replace('/local/', '/ui/local/', $urlStorage);
    }


}
