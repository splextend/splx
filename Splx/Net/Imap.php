<?php

namespace Splx\Net;

use Splx\Resource\AbstractResource;
class Imap extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'imap_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'imap_append',
        'imap_body',
        'imap_check',
        'imap_createmailbox',
        'imap_delete',
        'imap_deletemailbox',
        'imap_expunge',
        'imap_fetchbody',
        'imap_fetchstructure',
        'imap_headerinfo',
        'imap_header',
        'imap_headers',
        'imap_listmailbox',
        'imap_getmailboxes',
        'imap_get_quota',
        'imap_status',
        'imap_listsubscribed',
        'imap_set_quota',
        'imap_set_quota',
        'imap_getsubscribed',
        'imap_mail_copy',
        'imap_mail_move',
        'imap_num_msg',
        'imap_num_recent',
        'imap_ping',
        'imap_renamemailbox',
        'imap_reopen',
        'imap_subscribe',
        'imap_undelete',
        'imap_unsubscribe',
        'imap_scanmailbox',
        'imap_mailboxmsginfo',
        'imap_fetchheader',
        'imap_uid',
        'imap_msgno',
        'imap_search',
        'imap_fetch_overview'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'imap_open',
        'imap_8bit',
        'imap_alerts',
        'imap_base64',
        'imap_binary'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'imap_open',
        'imap_close',
        'imap_append',
        'imap_body',
        'imap_check',
        'imap_createmailbox',
        'imap_delete',
        'imap_deletemailbox',
        'imap_expunge',
        'imap_fetchbody',
        'imap_fetchstructure',
        'imap_headerinfo',
        'imap_header',
        'imap_headers',
        'imap_listmailbox',
        'imap_getmailboxes',
        'imap_get_quota',
        'imap_status',
        'imap_listsubscribed',
        'imap_set_quota',
        'imap_set_quota',
        'imap_getsubscribed',
        'imap_mail_copy',
        'imap_mail_move',
        'imap_num_msg',
        'imap_num_recent',
        'imap_ping',
        'imap_renamemailbox',
        'imap_reopen',
        'imap_subscribe',
        'imap_undelete',
        'imap_unsubscribe',
        'imap_scanmailbox',
        'imap_mailboxmsginfo',
        'imap_fetchheader',
        'imap_uid',
        'imap_msgno',
        'imap_search',
        'imap_fetch_overview',
        'imap_8bit',
        'imap_alerts',
        'imap_base64',
        'imap_binary'
    ];

    public function __construct($mailbox, $user, $password, $flags = 0, $retries = 0, array $options = [])
    {
        $resource = self::__callStatic(
            'imap_open',
            [
                $mailbox,
                $user,
                $password,
                $flags,
                $retries,
                $options
            ]
        );

        $this->setResource($resource, ['resource', 'IMAP\Connection']);
    }

    public function __destruct()
    {
        $this->close();
    }
}
