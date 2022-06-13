<?php

namespace App\Services;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\Storage;

class FFMpegAdapter
{
    private $ffprobe;
    private $ffmpeg;
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->ffprobe = FFProbe::create();
        $this->ffmpeg = FFMpeg::create();
        $this->fileName = $fileName;
    }
    
    public function getDuration()
    {
        $duration = $this->ffprobe->format(Storage::path($this->fileName))->get('duration');
        return (int) $duration;
    }

    public function getThumbnail()
    {
        $video = $this->ffmpeg->open(Storage::path($this->fileName));
        $thumbnailName = pathinfo($this->fileName, PATHINFO_FILENAME) . '.jpg';
        $storage_path = storage_path('app/public/'. $thumbnailName);
        $video->frame(TimeCode::fromSeconds(10))->save($storage_path);
        return $thumbnailName;
    }
}
