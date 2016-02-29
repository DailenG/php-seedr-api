<?php

namespace Seedr;

class Seedr extends API
{

    protected $url = 'https://www.seedr.cc/rest/';

    /**
     * @param mixed $username
     * @param mixed $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get contents of a folder
     *
     * @return Array
     */
    public function getFolder($id = null)
    {
        return $this->get($id ? 'folder/' . $id : 'folder');
    }

    /**
     * Delete a folder
     *
     * @return Array
     */
    public function deleteFolder($id)
    {
        return $this->delete('folder/' . $id);
    }

    /**
     * Get contents of a file 
     *
     * @return Array
     */
    public function getFile($id)
    {
        return $this->get('file/' . $id);
    }

    /**
     * Delete a file 
     *
     * @return Array
     */
    public function deleteFile($id)
    {
        return $this->delete('file/' . $id);
    }

    /**
     * download a file 
     *
     * @return Array
     */
    public function downloadFile($filePath, $id)
    {
        return $this->download($filePath, 'file/' . $id);
    }

    /**
     * Add a magnet to seedr
     *
     * @return mixed
     */
    public function addTorrentFromMagnet($magnet)
    {
        return $this->post('torrent/magnet', [
            'magnet' => $magnet
        ]);
    }
    
}
