<?php

namespace Spx\IO;

use Splx\Resource\AbstractResource;

class Ftp extends AbstractResource
{
   protected static $prefix = 'ftp';

   protected static $functions = [
       'ftp_login',
       'ftp_pwd',
       'ftp_cdup',
       'ftp_chdir',
       'ftp_exec',
       'ftp_raw',
       'ftp_mkdir',
       'ftp_rmdir',
       'ftp_chmod',
       'ftp_alloc',
       'ftp_nlist',
       'ftp_rawlist',
       'ftp_mlsd',
       'ftp_systype',
       'ftp_pasv',
       'ftp_get',
       'ftp_fget',
       'ftp_put',
       'ftp_append',
       'ftp_fput',
       'ftp_size',
       'ftp_mdtm',
       'ftp_rename',
       'ftp_delete',
       'ftp_site',
       'ftp_close',
       'ftp_set_option',
       'ftp_get_option',
       'ftp_nb_fget',
       'ftp_nb_get',
       'ftp_nb_continue',
       'ftp_nb_put',
       'ftp_nb_fput',
       'ftp_quit'
   ];

   protected static $staticFunctions = [
       'ftp_connect',
       'ftp_ssl_connect'
   ];

   protected static $watchFalseFunctions = [

   ];

    public function __construct($hostname, $isSsl = true, $port = 21, $timeout = 90)
    {
        $resource = self::__callStatic(
            $isSsl ? 'ftp_ssl_connect' : 'ftp_connect',
            [$hostname, $port, $timeout]
        );

        $this->setResource($resource, ['resource', 'FTP\Connection']);
    }

    public function __destruct()
    {
        $this->close();
    }
}
