<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Feeds;

class YoutubeController extends Controller
{
    public function latest(Request $request)
    {
        $channelId = 'UCUvIsHZLh9maRJzCT6H5wyg';
        $cacheKey = 'youtube_feed_' . $channelId;
        $videos = \Cache::remember($cacheKey, 600, function () use ($channelId) {
            $feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id=$channelId";
            $xml = @simplexml_load_file($feedUrl);
            $videos = [];
            if ($xml && isset($xml->entry)) {
                foreach ($xml->entry as $entry) {
                    $media = $entry->children('http://search.yahoo.com/mrss/');
                    $yt = $entry->children('http://www.youtube.com/xml/schemas/2015');
                    $videoId = (string)$yt->videoId;
                    $videos[] = [
                        'id' => $videoId,
                        'title' => (string)$entry->title,
                        'description' => (string)$media->group->description,
                        'published' => (string)$entry->published,
                        'thumbnail' => "https://img.youtube.com/vi/$videoId/hqdefault.jpg",
                    ];
                }
            }
            return $videos;
        });
        return response()->json($videos);
    }
} 