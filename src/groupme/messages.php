<?php

namespace GroupMePHP;

class messages extends client
{
    /**
     * Retrieve messages for a group
     *
     * By default, messages are returned in groups of 20, ordered by created_at descending. This can be raised or lowered by passing a limit parameter, up to a maximum of 100 messages.
     * Messages can be scanned by providing a message ID as either the before_id, since_id, or after_id parameter. If before_id is provided, then messages immediately preceding the given message will be returned, in descending order. This can be used to continually page back through a group's messages.
     * The after_id parameter will return messages that immediately follow a given message, this time in ascending order (which makes it easy to pick off the last result for continued pagination).
     * Finally, the since_id parameter also returns messages created after the given message, but it retrieves the most recent messages. For example, if more than twenty messages are created after the since_id message, using this parameter will omit the messages that immediately follow the given message. This is a bit counterintuitive, so take care
     *
     * @param string $group_id
     * @param array $args {
     * @var string $before_id [optional] Returns messages created before the given message ID
     * @var string $since_id [optional] Returns most recent messages created after the given message ID
     * @var string $after_id [optional] Returns messages created immediately after the given message ID
     * @var int $limit [optional] Number of messages returned. Default is 20. Max is 100
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index($group_id, $args)
    {
        $params = array(
            'url' => "/groups/$group_id/messages",
            'method' => 'GET',
            'query' => $args
        );

        return $this->request($params);
    }

    /**
     * Send a message to a group
     *
     * @param string $group_id
     * @param array $args {
     * @var string $source_guid Client-side IDs for messages. This can be used by clients to set their own identifiers on messages, but the server also scans these for de-duplication. That is, if two messages are sent with the same source_guid within one minute of each other, the second message will fail with a 409 Conflict response. So it's important to set this to a unique value for each message
     * @var string $text This can be omitted if at least one attachment is present. The maximum length is 1,000 characters
     * @var array $attachments [optional] A polymorphic list of attachments (locations, images, etc). You may have You may have more than one of any type of attachment, provided clients can display it
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function create($group_id, $args)
    {
        // Construct the payload, optionally with attachments
        $payload = array(
            'source_guid' => $args[0],
            'text' => $args[1]
        );

        if (!empty($args[2]))
            $payload['attachments'] = array($args[2]);

        $params = array(
            'url' => "/groups/$group_id/messages",
            'method' => 'POST',
            'payload' => array('message' => $payload)
        );

        return $this->request($params);
    }
}