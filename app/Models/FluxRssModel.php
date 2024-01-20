<?php

namespace App\Models;

class FluxRssModel
{

    /**
     * Function to read the RSS feed from the URL
     *
     * @param array $feeds
     * @param integer $limit
     * @return array
     */
    public function read(array $feeds, int $limit = 5): array
    {
        $items = [];
        foreach ($feeds as $feed) {
            $items[] = $this->readFeed($feed, $limit);
        }
        return $items;
    }

    /**
     * Function to read the RSS feed
     *
     * @return array
     */
    private function readFeed(String $feed, int $limit): array
    {
        $rss = simplexml_load_file($feed);
        $items = [
            "title" => (string) $rss->channel->title,
        ];
        for ($i = 0; $i < $limit; $i++) {
            if (isset($rss->channel->item[$i])) {
                $items["items"][] = [
                    "title" => (string) $rss->channel->item[$i]->title,
                    "link" => (string) $rss->channel->item[$i]->link,
                    "description" => (string) $rss->channel->item[$i]->description,
                    "pubDate" => (string) $rss->channel->item[$i]->pubDate,
                ];
            }
        }
        return $items;
    }

}