<?php

namespace Seedr;

class API
{

    protected $username;
    protected $password;
    protected $url;

    /**
     * Create request with given endpoint
     *
     * @return mixed
     */
    private function request($method, $endpoint, $data = [], $filePath = null)
    {
        $curl = curl_init();

        $opts_array = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL =>  $this->url . $endpoint,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_USERPWD => "$this->username:$this->password",
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_FOLLOWLOCATION => true
        );

        curl_setopt_array($curl, $opts_array);

        if ($filePath){
            $file = fopen($filePath, 'w+');
            curl_setopt($curl, CURLOPT_FILE, $file);   
        }

        $resp = curl_exec($curl);

        curl_close($curl);

        if ($filePath){
            fclose($file);
            return $filePath;
        } else {
            return json_decode($resp);
        }
    }

    /**
     * Send an GET Request
     *
     * @return mixed
     */
    public function get($endpoint)
    {
        return $this->request('GET', $endpoint);
    }

    /**
     * Send an POST Request
     *
     * @return mixed
     */
    public function post($endpoint, $data)
    {
        return $this->request('POST', $endpoint, $data);
    }

    /**
     * Send an DELETE Request
     *
     * @return mixed
     */
    public function delete($endpoint)
    {
        return $this->request('DELETE', $endpoint);
    }

    /**
     * Download an file
     *
     * @return mixed
     */
    public function download($filePath, $endpoint)
    {
        return $this->request('GET', $endpoint, [], $filePath);
    }

}
