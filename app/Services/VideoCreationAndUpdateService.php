<?php

namespace App\Services;

use App\Models\User;
use App\Models\Video;
use App\Services\FFMpegAdapter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class VideoCreationAndUpdateService
{
    public function create(User $user, array $data)
    {
        $data = $this->prepareVideoData($data);
        
        return $user->videos()->create($data);
    }

    public function update(Video $video, array $data)
    {
        if (isset($data['file']) && $data['file'] instanceof File) {
            $data = $this->prepareVideoData($data);
        }

        return $video->update($data);
    }

    private function prepareVideoData($data)
    {
        $fileName = Storage::putFile('', $data['file']);

        $ffmpegService = new FFMpegAdapter($fileName);

        $data['url'] = $fileName;
        $data['length'] = $ffmpegService->getDuration();
        $data['thumbnail'] = $ffmpegService->getThumbnail();

        return $data;
    }
}
