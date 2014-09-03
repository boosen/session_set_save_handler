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
        $format = "SELECT data FROM sessions WHERE sid = '%s' LIMIT 1";
        $this->tosql = sprintf($format, $sid);
        $result = $this->db->getOne($this->tosql);
        if (!empty($result)) {
            return $this->sessiondata = $result;
        }

        /*
        if (!empty($result)) {
            $this->lastflush = $result['update'];
            $this->sessiondata = $result['data'];
            return true;
        }
        */
    }

    function write($sessID, $sessData)
    {
        $now = time();
        $newExp = $now + $this->lifeTime;
        $this->tosql = "SELECT * FROM sessions WHERE sid = '{$sessID}'";
        $result = $this->db->getOne($this->tosql);
        if ($sessData == '' || !isset($sessID)) {
            $sessID = $this->sessiondata;
        }
        if($result) {
            $this->db->execute("UPDATE sessions SET `update` = '{$newExp}', data = '{$sessData}'  WHERE sid = '{$sessID}'");
            if (mysql_affected_rows()) {
                return true;
            }
        } else {
            $this->db->insert("INSERT INTO sessions (sid, `update`, data) VALUES ('{$sessID}', '{$now}', '{$sessData}',)");
            if (mysql_affected_rows()) {
                return true;
            }
        }
        return false;
    }

    function destory($sessID)
    {
        $this->tosql = "DELETE FROM sessions WHERE sid = '{$sessID}'";
        if ($this->db->execute($this->tosql)) {
            return true;
        } else {
            return false;
        }
    }

    function gc($sessMaxLifeTime)
    {
        $t = time();
        $this->tosql() = "DELETE FROM sessions WHERE $t - `update` > '{$sessMaxLifeTime}'";
        $this->db->execute($this->tosql);
        if (mysql_affected_rows()) {
            return true;
        } else {
            return flase;
        }
    }
}