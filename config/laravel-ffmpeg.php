<?php

return [
    'default_disk' => 'local',
    'thumbnails' => 'public',
    'streamable_videos' => 'public',
    'ffmpeg.binaries' => config('savysoft.ffmpeg_variables.ffmpeg'),
    'ffmpeg.threads'  => 12,
    'ffprobe.binaries' => config('savysoft.ffmpeg_variables.ffprobe'),
    'timeout' => 3600,
];
