<?php

namespace GroupMePHP;

class leaderboard extends client
{
    /**
     * A list of the liked messages in the group for a given period of time
     *
     * Messages are ranked in order of number of likes
     *
     * @param string $group_id
     * @param string $period one of: 'day', 'week', or 'month'
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index($group_id, $period)
    {
        $params = array(
            'url' => "/groups/$group_id/likes",
            'method' => 'GET',
            'query' => array("period" => $period)
        );

        return $this->request($params);
    }

    /**
     * A list of messages you have liked
     *
     * Messages are returned in reverse chrono-order.
     * Note that the payload includes a liked_at timestamp in ISO-8601 format
     *
     * @param string $group_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function myLikes($group_id)
    {
        $params = array(
            'url' => "/groups/$group_id/likes/mine",
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * A list of messages others have liked
     *
     * @param string $group_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function myHits($group_id)
    {
        $params = array(
            'url' => "/groups/$group_id/likes/for_me",
            'method' => 'GET'
        );

        return $this->request($params);
    }
}