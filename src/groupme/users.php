<?php

namespace GroupMePHP;

class users extends client
{
    /**
     * Get details about the authenticated user
     *
     * @return string|false GroupMe response or false on failure
     */
    public function index()
    {
        $params = array(
            'url' => '/users/me',
            'method' => 'GET'
        );

        return $this->request($params);
    }
}