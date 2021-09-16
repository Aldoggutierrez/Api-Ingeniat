<?php

namespace App;

use Firebase\JWT\JWT;
use Carbon\Carbon;

class TokenDecoder
{
    public static function decodeToken($token)
    {
        $publicKey = <<<EOD
        -----BEGIN PUBLIC KEY-----
        MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAw3RH2E5qS4ourZ/vawqp
        NuksQ0odSTaw4yeCpuqUQFgbv6To/bzft7tGpyE5h/oKe4KiJixuMBobR5s2CXR+
        JKtP+2/kKO7yvMPycEK21cNugBy58zQINHddWfp0oyVxsUr2vL/DEJ9A8KMC05Us
        yyLZQHVrSRS49D9d0pECZCJYUYjweJBqm6RObn8XJK8K88nlFxxFcnFdqfb1H3rQ
        vdXzdr4ftO1Hpw7MowfUk/MXCEHP9OmSPOEF6Wo6XH1dnE0vs6i6F+z55Qt0qOkG
        Oo+Ic5UmIew3fUBIcE6xtpQwTa/ZKG+sseho1H7CTbs9Fw/Y6T1noKLvLAXI/PUo
        YVdvkab7K3ijWVwfq5U4GpVdlCxGeX67wl7++UeYVUnUEsm6q9TtTAcgaZKQNSd3
        +f5p+pl05BgcnVQ0uZvlPE5IaP4zZlS8iImrTKJ8JZn3Bi4o02jVdsVr4kRYhFb4
        PJGExIFbrRCDjnq6dFFKY0l0x7gZWcmDGsPjhR/GAKKvtQ0zLJtb75Ex4Ks56tL5
        uboB9Yu196e7Xx4ttoYSjGvShRSVp6h7C8G+cl5Wd1++fHbn+WmcdOhPPNZP7alV
        A8wTPUOln7BVwBc1zfckOMmpxkOLiAvAtnrE+onybPoMShki7v5iBqRooRB7IqI2
        j4POCFJL2UQAEI+GLSmkeAECAwEAAQ==
        -----END PUBLIC KEY-----
        EOD;

        $decodedToken = JWT::decode($token,$publicKey,array('RS256'));
        $decoded_array = (array) $decodedToken;
        return $decoded_array;
    }

    public static function validateToken($token)
    {
        

    }
}