<?php

namespace GroupMePHP;

class likes extends client
{
    /**
     * Like a message
     *
     * @param string $conversation_id
     * @param string $message_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function create($conversation_id, $message_id)
    {
        $params = array(
            'url' => "/messages/$conversation_id/$message_id/like",
            'method' => 'POST'
        );

        return $this->request($params);
    }

    /**
     * Unlike a message
     *
     * @param string $conversation_id
     * @param string $message_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function destroy($conversation_id, $message_id)
    {
        $params = array(
            'url' => "/messages/$conversation_id/$message_id/unlike",
            'method' => 'POST'
        );

        return $this->request($params);
    }
}