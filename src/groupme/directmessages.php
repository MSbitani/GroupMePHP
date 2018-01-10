<?php

namespace GroupMePHP;

class directmessages extends client
{
    /**
     * Fetch direct messages between two users
     *
     * DMs are returned in groups of 20, ordered by created_at descending
     *
     * @param array $args {
     * @var string $other_user_id The other participant in the conversation
     * @var string $before_id [optional] Returns 20 messages created before the given message ID
     * @var string $since_id [optional] Returns 20 messages created after the given message ID
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index($args)
    {
        $params = array(
            'url' => '/direct_messages',
            'method' => 'GET',
            'query' => $args
        );

        return $this->request($params);
    }

    /**
     * Send a DM to another user
     *
     * @param array $args {
     * @var string $source_guid This is used for client-side deduplication
     * @var string $recipient_id The GroupMe user ID of the recipient of this message
     * @var string $text This can be omitted if at least one attachment is present
     * @var array $attachments [optional] A polymorphic list of attachments (locations, images, etc). You may have more than one of any type of attachment, provided clients can display it
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function create($args)
    {
        $params = array(
            'url' => '/direct_messages',
            'method' => 'POST',
            'payload' => array('direct_message' => $args)
        );

        return $this->request($params);
    }
}