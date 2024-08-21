<?php

namespace App\classes\topic;

use App\classes\ManagementBase;
use App\Models\Comments;
use App\Models\Topics;

class ManagementTopic extends ManagementBase
{
    private static $list_topics = [];
    private static $topics;
    private static $comments;

    private static function findTopics(): void
    {
        self::$topics = Topics::all();
    }

    private static function findComments(): void
    {
        self::$comments = Comments::all();
    }

    public static function getLastComments(): array
    {
        self::findSortedCommentsByDate();

        $ret = [];

        foreach (self::$comments as $comment)
        {
            $ret[$comment["topic_id"]] = $comment["content"];
        }

        return $ret;
    }

    public static function getArrayMapComments(): array
    {
        self::findComments();

        $ret = [];

        foreach (self::$comments as $comment)
        {
            $ret[$comment->topic_id] = $comment->content;
        }

        return $ret;
    }

    private static function findSortedCommentsByDate(): void
    {
        self::$comments = Comments::all()
            ->sortByDesc("created_at")
            ->groupBy("topic_id")
            ->map(function ($group) {
                return $group->first();
            })
            ->toArray();
    }

    public static function getLastCommentsTimes(): array
    {
        self::findSortedCommentsByDate();

        $ret = [];

        foreach (self::$comments as $comment)
        {
            $ret[$comment["topic_id"]] = $comment["added"];
        }

        return $ret;
    }
}
