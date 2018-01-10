<?php

namespace GroupMePHP;

class images extends image_client
{
    /**
     * Uploads a picture to the GroupMe Image service and returns the URL.
     *
     * @param string $url URL to image
     * @param string $dir [optional] Directory to store temporary file, defaults to sys_temp_dir
     *
     * @return string|false GroupMe response or false on failure
     */
    public function pictures($url, $dir = '')
    {
        $dir = empty($dir) ? sys_get_temp_dir() : $dir;
        $file = $url;
        $path = parse_url($url);
        if ($path['scheme'] == 'http' || $path['scheme'] == 'https') {
            $file = tempnam($dir, 'gm_');
            file_put_contents($file, file_get_contents($url));
        }

        $params = array(
            'url' => '/pictures',
            'method' => 'POST',
            'payload' => array('file' => curl_file_create($file))
        );

        $response = $this->request($params);

        if ($file != $url)
            unlink($file);

        return $response;
    }
}