<?php
class JWTHandler
{
    private $secretKey = 'admin123'; 

    public function encode($payload)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload);
        $base64Header = base64_encode($header);
        $base64Payload = base64_encode($payload);
        $signature = hash_hmac('sha256', "$base64Header.$base64Payload", $this->secretKey, true);
        $base64Signature = base64_encode($signature);
        return "$base64Header.$base64Payload.$base64Signature";
    }

    public function decode($jwt)
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return false;
        }

        list($header, $payload, $signature) = $parts;
        $expectedSignature = hash_hmac('sha256', "$header.$payload", $this->secretKey, true);
        $base64Signature = base64_encode($expectedSignature);

        if ($base64Signature !== $signature) {
            return false;
        }

        return json_decode(base64_decode($payload), true);
    }
}
?>