All we know that session can store some infomations on server, a conversation between client and server.
But there will slow down the server profermance if server have many requests. So we need another way to
handle the session store  with *session_set_save_handler*.
------------------------------------------------------------------------------------------------------------------------------------------------------------
####handleWithMysql.php   
*This file will introduce how to handle session store by mysql*

As we know we can use the mysql engine 'memory' will be better if the server have sufficient memory.
>    CREATE TABLE 'sessions' (
>    'sid' CHAR(40) NOT NULL COMMENT 'session name',  
>    'data' VARCHAR(200) NOT NULL COMMENT 'value of seesion',  
>    'update' INT(10) UNSINGED NOT NULL DEFAULT '0' COMMENT 'update time',   
>    UNIQUE INDEX 'sid' ('sid'))  
>    COLLATE='utf8_general_ci'   
>    ENGINE=MEMORY   
>    ROW_FORMAT=DEFAULT   

####handleWithRedis.php
*This file will introduce how to handle session store by redis*
