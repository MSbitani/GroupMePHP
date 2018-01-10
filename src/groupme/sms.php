<?php

namespace GroupMePHP;

class sms extends client
{
    /**
     * Enables SMS mode for N hours, where N is at most 48
     *
     * After N hours have elapsed, user will receive push notifications
     *
     * @param int $duration
     * @param string $registration_id [optional] The push notification ID/token that should be suppressed during SMS mode. If this is omitted, both SMS and push notifications will be delivered to the device
     *
     * @return string|false GroupMe response or false on failure
     */
    public function enable($duration, $registration_id)
    {
        $params = array(
            'url' => '/users/sms_mode',
            'method' => 'POST',
            'payload' => array(
                'duration' => $duration,
                'registration_id' => $registration_id
            )
        );

        return $this->request($params);
    }

    /**
     * Disables SMS mode
     *
     * @return string|false GroupMe response or false on failure
     */
    public function disable()
    {
        $params = array(
            'url' => '/users/sms_mode/delete',
            'method' => 'POST'
        );

        return $this->request($params);
    }
}