All we know that session can store some infomations on server, a conversation between client and server.
But there will slow down the server profermance if server have many requests. So we need another way to
handle the session store  with *session_set_save_handler*.
------------------------------------------------------------------------------------------------------------------------------------------------------------
* ###handleByMysql.php ####
>This file will introduce how to handle session store by mysql

* ###handleByRedis.php####
>This file will introduce how to handle session store by redis