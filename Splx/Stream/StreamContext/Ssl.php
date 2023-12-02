<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Ssl
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 *
 * @method getPeerName()
 * @method getVerifyPeer()
 * @method getVerifyPeerName()
 * @method getAllowSelfSigned()
 * @method getCafile()
 * @method getCapath()
 * @method getLocalCert()
 * @method getLocalPk()
 * @method getPassphrase()
 * @method getCNMatch()
 * @method getVerifyDepth()
 * @method getCiphers()
 * @method getCapturePeerCert()
 * @method getCapturePeerCertChain()
 * @method getSNIEnabled()
 * @method getSNIServerName()
 * @method getDisableCompression()
 * @method getPeerFingerprint()
 * @method self setPeerName($value)
 * @method self setVerifyPeer($value)
 * @method self setVerifyPeerName($value)
 * @method self setAllowSelfSigned($value)
 * @method self setCafile($value)
 * @method self setCapath($value)
 * @method self setLocalCert($value)
 * @method self setLocalPk($value)
 * @method self setPassphrase($value)
 * @method self setCNMatch($value)
 * @method self setVerifyDepth($value)
 * @method self setCiphers($value)
 * @method self setCapturePeerCert($value)
 * @method self setCapturePeerCertChain($value)
 * @method self setSNIEnabled($value)
 * @method self setSNIServerName($value)
 * @method self setDisableCompression($value)
 * @method self setPeerFingerprint($value)
 * @method delPeerName()
 * @method delVerifyPeer()
 * @method delVerifyPeerName()
 * @method delAllowSelfSigned()
 * @method delCafile()
 * @method delCapath()
 * @method delLocalCert()
 * @method delLocalPk()
 * @method delPassphrase()
 * @method delCNMatch()
 * @method delVerifyDepth()
 * @method delCiphers()
 * @method delCapturePeerCert()
 * @method delCapturePeerCertChain()
 * @method delSNIEnabled()
 * @method delSNIServerName()
 * @method delDisableCompression()
 * @method delPeerFingerprint()
*/
class Ssl extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'peer_name string',
        'verify_peer',
        'verify_peer_name',
        'allow_self_signed',
        'cafile',
        'capath',
        'local_cert',
        'local_pk',
        'passphrase',
        'CN_match',
        'verify_depth',
        'ciphers',
        'capture_peer_cert',
        'capture_peer_cert_chain',
        'SNI_enabled',
        'SNI_server_name',
        'disable_compression',
        'peer_fingerprint'
    ];
}
