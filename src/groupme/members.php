<?php

namespace GroupMePHP;

class members extends client
{
    /**
     * Add members to a group
     *
     * Multiple members can be added in a single request, and results are fetched with a separate call (since memberships are processed asynchronously). The response includes a results_id that's used in the results request.
     * In order to correlate request params with resulting memberships, GUIDs can be added to the members parameters. These GUIDs will be reflected in the membership JSON objects.
     *
     * @param string $group_id
     * @param array $args {
     * @var array $members You must use one of the following identifiers: user_id, phone_number, or email {
     * @var string $nickname
     * @var string $user_id [optional]
     * @var string $phone_number [optional]
     * @var string $email [optional]
     * @var string $guid [optional]
     * }
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function add($group_id, $args)
    {
        $params = array(
            'url' => "/groups/$group_id/members/add",
            'method' => 'POST',
            'payload' => $args
        );

        return $this->request($params);
    }

    /**
     * Get the membership results from an {@link add} call
     *
     * Successfully created memberships will be returned, including any GUIDs that were sent up in the add request. If GUIDs were absent, they are filled in automatically. Failed memberships and invites are omitted.
     * Keep in mind that results are temporary -- they will only be available for 1 hour after the add request.
     *
     * @param string $group_id
     * @param string $results_id This is the guid that's returned from an add request
     *
     * @return string|false GroupMe response or false on failure
     */
    public function results($group_id, $results_id)
    {
        $params = array(
            'url' => "/groups/$group_id/members/results/$results_id",
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * Remove a member (or yourself) from a group
     *
     * Note: The creator of the group cannot be removed or exit
     *
     * @param string $group_id
     * @param string $membership_id Please note that this isn't the same as the user ID. In the members key in the group JSON, this is the id value, not the user_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function remove($group_id, $membership_id)
    {
        $params = array(
            'url' => "/groups/$group_id/members/$membership_id/remove",
            'method' => 'POST'
        );
        return $this->request($params);
    }

    /**
     * Update your nickname in a group
     *
     * The nickname must be between 1 and 50 characters
     *
     * @param string $group_id
     * @param string $nickname
     *
     * @return string|false GroupMe response or false on failure
     */
    public function update($group_id, $nickname)
    {
        $params = array(
            'url' => "/groups/$group_id/memberships/update",
            'method' => 'POST',
            'payload' => array('membership' => array('nickname' => $nickname))
        );

        return $this->request($params);
    }
}