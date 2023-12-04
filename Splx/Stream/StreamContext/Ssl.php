<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Ssl
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
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
 * @method getVerifyDepth()
 * @method getCiphers()
 * @method getCapturePeerCert()
 * @method getCapturePeerCertChain()
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
 * @method self setVerifyDepth($value)
 * @method self setCiphers($value)
 * @method self setCapturePeerCert($value)
 * @method self setCapturePeerCertChain($value)
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
 * @method delVerifyDepth()
 * @method delCiphers()
 * @method delCapturePeerCert()
 * @method delCapturePeerCertChain()
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

    /**
     * @param $value
     * @return Ssl
     */
    public function setCNMatch($value)
    {
        return $this->set('CN_match', $value);
    }

    /**
     * @return mixed|null
     */
    public function getCNMatch()
    {
        return $this->get('CN_match');
    }

    /**
     * @return Ssl
     */
    public function delCNMatch()
    {
        return $this->del('CN_match');
    }

    /**
     * @param $value
     * @return Ssl
     */
    public function setSNIEnabled($value)
    {
        return $this->set('SNI_enabled', $value);
    }

    /**
     * @return mixed|null
     */
    public function getSNIEnabled()
    {
        return $this->get('SNI_enabled');
    }

    /**
     * @return Ssl
     */
    public function delSNIEnabled()
    {
        return $this->del('SNI_enabled');
    }

    /**
     * @param $value
     * @return Ssl
     */
    public function setSNIServerName($value)
    {
        return $this->set('SNI_server_name', $value);
    }

    /**
     * @return mixed|null
     */
    public function getSNIServerName()
    {
        return $this->get('SNI_server_name');
    }

    /**
     * @return Ssl
     */
    public function delSNIServerName()
    {
        return $this->del('SNI_server_name');
    }
}
