<?php

namespace App\Jobs;

use App\Models\Post;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ConvertPostVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle(): void
    {
        // 1. Setup FFmpeg
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg', // Standard path on Ubuntu/AWS
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout'          => 3600, // Allow 1 hour for large videos
            'ffmpeg.threads'   => 2,   // Use 2 cores
        ]);

        // 2. Open the uploaded video
        // Note: php-ffmpeg requires a local absolute path
        $localPath = Storage::disk('public')->path($this->post->video);
        
        $video = $ffmpeg->open($localPath);

        // 3. Create the new filename (webm)
        $newFileName = 'posts/videos/' . $this->post->id . '_' . time() . '.webm';
        $newLocalPath = Storage::disk('public')->path($newFileName);

        // Ensure directory exists
        if (!file_exists(dirname($newLocalPath))) {
            mkdir(dirname($newLocalPath), 0755, true);
        }

        // 4. Convert to WebM (X264 is also good, but you asked for web optimized)
        // Adjust KiloBitrate as needed (lower = smaller file, lower quality)
        $format = new WebM();
        $format->setKiloBitrate(1000); 

        $video->save($format, $newLocalPath);

        // 5. Delete original and update Database
        Storage::disk('public')->delete($this->post->video);
        
        $this->post->update([
            'video' => $newFileName
        ]);
    }
}