<?php

class SessionSaveHandle
{
    public $lifeTime;
    public $tosql;
    public $db;
    private $sessiondata;
    private $lastflush;

    private $sessName = 'PHPSESSID';

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->lifeTime = get_cfg_var("session.gc_maxlifetime");
    }

    function open($savePath, $sessName)
    {
        return true;
    }

    function close()
    {
        return true;
    }

    function read($sid)
    {

    }

    function write($sessID, $sessData)
    {

    }

    function destory($sessID)
    {

    }

    function gc($sessMaxLifeTime)
    {

    }
}