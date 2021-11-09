<?php


namespace Kizi\Core\ThirdParty\Services\Ecommerce;


use Kizi\Core\ThirdParty\Services\Social;

class Shopify extends Social
{
    protected $version = '2020-01';

    public function __construct()
    {
        $this->clientId     = config('core.shopify.api_key');
        $this->clientSecret = config('core.shopify.secret_key');
        $this->version      = config('core.shopify.api_version');
        $this->redirectUrl  = config('core.shopify.callback_url');
        $this->scopes       = config('core.shopify.scope');
    }

    public function auth(array $parameters = [])
    {
        return $this->verifyRequest($parameters);
        // TODO: Implement accessToken() method.
    }

    private function verifyRequest($data)
    {
        $tmp = [];
        if (is_string($data)) {
            $each = explode('&', $data);
            foreach ($each as $e) {
                [$key, $val] = explode('=', $e);
                $tmp[$key] = $val;
            }
        } elseif (is_array($data)) {
            $tmp = $data;
        } else {
            return false;
        }

        // Timestamp check; 1 hour tolerance
        if (($tmp['timestamp'] - time() > 3600)) {
            return false;
        }

        if (array_key_exists('hmac', $tmp)) {

            // HMAC Validation
            $queries = array_intersect_key($tmp, [
                'code' => '',
                'shop' => '',
                'state' => '',
                'timestamp' => '',
            ]);
            ksort($queries);

            $queryString = http_build_query($queries);
            $match       = $tmp['hmac'];
            $calculated  = hash_hmac('sha256', $queryString, $this->clientSecret);
            return $calculated === $match;
        }

        return false;
    }

    public function generateUrl($name = null)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('No Shop domain was specified.');
        }
        return $this->getAuthUrl($name);
    }

    protected function getAuthUrl($domain)
    {
        return $this->buildAuthUrlFromBase("https://{$domain}.myshopify.com/admin/oauth/authorize");
    }
}
