<?php

namespace Kizi\Core\ThirdParty\Services\Social;


use Firebase\JWT\JWT;
use Kizi\Core\Contracts\SocialContract;
use Kizi\Core\ThirdParty\Services\Social;

class Facebook extends Social
{
    public $fb;

    public function __construct()
    {
        $this->stateless    = true;
        $this->clientId     = config('core.social.facebook.auth.key');
        $this->clientSecret = config('core.social.facebook.auth.secret');
        $this->version      = config('core.social.facebook.graph_version');
        $this->redirectUrl  = config('core.social.facebook.callback_url');
        $this->scopes       = config('core.social.facebook.permissions');
        $this->fb           = new \Facebook\Facebook([
            'app_id' => $this->clientId,
            'app_secret' => $this->clientSecret,
            'default_graph_version' => $this->version,
        ]);
    }

    public function generateUrl($name = null)
    {
        return $this->getAuthUrl();
    }

    protected function getAuthUrl()
    {
        return $this->buildAuthUrlFromBase('https://www.facebook.com/'.$this->version.'/dialog/oauth');
    }

    public function request($method, $endpoint, $token, array $query = [])
    {
        $i = 0;
        if (count($query) > 0 && $method == 'get') {
            foreach ($query as $key => $value) {
                if ($i == 0) {
                    $endpoint .= '?';
                } else {
                    $endpoint .= '&';
                }
                if (is_array($value)) {
                    $endpoint .= "{$key}=[".implode(',', $value)."]";
                } else {
                    $endpoint .= "{$key}={$value}";
                }
                $i++;
            }
        }
        $data = [];
        try {
            switch ($method) {
                case 'get' :
                    $response = $this->fb->get(
                        $endpoint,
                        $token
                    );
                    $data     = $response->getDecodedBody();
                    break;
                case 'post' :
                    $response = $this->fb->post(
                        $endpoint,
                        $query,
                        $token
                    );
                    $data     = $response->getDecodedBody();
                    break;
                case 'put' :
                    $response = $this->fb->put(
                        $endpoint,
                        $query,
                        $token
                    );
                    $data     = $response->getDecodedBody();
                    break;
                case 'delete' :
                    $response = $this->fb->delete(
                        $endpoint,
                        $query,
                        $token
                    );
                    $data     = $response->getDecodedBody();
                    break;
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
        return $data;
    }

    public function auth(array $parameters = [])
    {
        // TODO: Implement accessToken() method.
    }
}
