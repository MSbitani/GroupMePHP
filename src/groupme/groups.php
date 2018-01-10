<?php

namespace GroupMePHP;

class groups extends client
{
    /**
     * List the authenticated user's active groups
     *
     * The response is paginated, with a default of 10 groups per page
     *
     * @param array $args {
     * @var int $page [optional] Fetch a particular page of results. Defaults to 1
     * @var int $per_page [optional] Define page size. Defaults to 10
     * @var string $omit [optional] Comma separated list of data to omit from output. Currently supported value is only "memberships". If used then response will contain empty (null) members field.
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index($args = array())
    {
        $params = array(
            'url' => '/groups',
            'method' => 'GET',
            'query' => $args
        );

        return $this->request($params);
    }

    /**
     * List the groups you have left but can rejoin
     *
     * @return string|false GroupMe response or false on failure
     */
    public function former()
    {
        $params = array(
            'url' => '/groups/former',
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * Load a specific group
     *
     * @param string $group_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function show($group_id)
    {
        $params = array(
            'url' => "/groups/$group_id",
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * Create a new group
     *
     * @param array $args {
     * @var string $name Primary name of the group. Maximum 140 characters
     * @var string $description [optional] A subheading for the group. Maximum 255 characters
     * @var string $image_url [optional] GroupMe Image Service URL
     * @var bool $share [optional] If you pass a true value for share, we'll generate a share URL. Anybody with this URL can join the group.
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function create($args)
    {
        $params = array(
            'url' => '/groups',
            'method' => 'POST',
            'payload' => $args
        );

        return $this->request($params);
    }

    /**
     * Update a group after creation
     *
     * @param string $group_id ID of group to be modified
     * @param array $args {
     * @var string $name
     * @var string $description
     * @var string $image_url
     * @var bool $office_mode
     * @var bool $share If you pass a true value for share, we'll generate a share URL. Anybody with this URL can join the group.
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function update($group_id, $args)
    {
        $params = array(
            'url' => "/groups/$group_id/update",
            'method' => 'POST',
            'payload' => $args
        );

        return $this->request($params);
    }

    /**
     * Disband a group
     *
     * This action is only available to the group creator
     *
     * @param string $group_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function destroy($group_id)
    {
        $params = array(
            'url' => "/groups/$group_id/destroy",
            'method' => 'POST'
        );

        return $this->request($params);
    }

    /**
     * Join a shared group
     *
     * @param string $group_id
     * @param string $share_token
     *
     * @return string|false GroupMe response or false on failure
     */
    public function join($group_id, $share_token)
    {
        $params = array(
            'url' => "/groups/$group_id/join/$share_token",
            'method' => 'POST'
        );

        return $this->request($params);
    }

    /**
     * Rejoin a group. Only works if you previously removed yourself
     *
     * @param string $group_id
     *
     * @return string|false GroupMe response or false on failure
     */
    public function rejoin($group_id)
    {
        $params = array(
            'url' => '/groups/join',
            'method' => 'POST',
            'payload' => array('group_id' => $group_id)
        );

        return $this->request($params);
    }

    /**
     * Change owner of requested groups
     *
     * This action is only available to the group creator.
     * Response is array of result objects which contain status field - the result of change owner action for every request:
     * * '200' - OK
     * * '400' - when requestor is also a new owner
     * * '403' - requestor is not owner of the group
     * * '404' - group or new owner not found or new owner is not member of the group
     * * '405' - request object is missing required field or any of the required fields is not an ID
     *
     * @param array[] $args One request is an object where owner_id is the new owner who must be active member of a group specified by group_id. {
     * @var string $group_id
     * @var string $owner_id
     * }
     *
     * @return string|false GroupMe response or false on failure
     */
    public function changeOwners($args)
    {
        $params = array(
            'url' => '/groups/change_owners',
            'method' => 'POST',
            'payload' => array('requests' => $args)
        );

        return $this->request($params);
    }
}