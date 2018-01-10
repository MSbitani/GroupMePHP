<?php

namespace GroupMePHP;

class bots extends client
{
    /**
     * Create a new bot
     *
     * @param array $args {
     * @var string $name
     * @var string $group_id
     * @var string $avatar_url [optional]
     * @var string $callback_url [optional]
     * @var bool $dm_notification [optional]
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function create($args)
    {
        $params = array(
            'url' => '/bots',
            'method' => 'POST',
            'payload' => array('bot' => $args)
        );

        return $this->request($params);
    }

    /**
     * Post a message from a bot
     *
     * @param array $args {
     * @var string $bot_id
     * @var string $text
     * @var string $picture_url [optional] Image must be processed through image service
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function post($args)
    {
        $params = array(
            'url' => '/bots/post',
            'method' => 'POST',
            'payload' => $args
        );

        return $this->request($params);
    }

    /**
     * List bots that you have created
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index()
    {
        $params = array(
            'url' => '/bots',
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * Remove a bot that you have created
     *
     * @param string $bot_id ID of the bot to be destroyed
     *
     * @return string|false GroupMe response or false on failure
     */
    public function destroy($bot_id)
    {
        $params = array(
            'url' => '/bots/destroy',
            'method' => 'POST',
            'payload' => array('bot_id' => $bot_id)
        );

        return $this->request($params);
    }
}