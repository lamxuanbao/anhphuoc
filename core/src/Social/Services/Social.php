<?php


namespace Kizi\Core\Social\Services;


use Firebase\JWT\JWT;
use Kizi\Core\Social\Contracts\Provider;

abstract class Social implements Provider
{
    protected $clientId;
    protected $clientSecret;
    protected $redirectUrl;
    protected $scopes = [];
    protected $scopeSeparator = ',';
    protected $stateless = false;
    protected $parameters = [];
    protected $encodingType = PHP_QUERY_RFC1738;
    protected $version;
    protected $states = [];
    protected $driver;

    abstract function generateUrl($name = null);

    abstract function auth(array $parameters = []);

    public function with(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    protected function usesState()
    {
        return $this->stateless;
    }

    protected function formatScopes(array $scopes, $scopeSeparator)
    {
        return implode($scopeSeparator, $scopes);
    }

    public function setScopes(array $scopes = [])
    {
        $this->scopes = array_unique((array)$scopes);
        return $this;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function setStates(array $states = [])
    {
        $this->states = array_unique((array)$states);
        return $this;
    }

    public function getStates()
    {
        $states           = $this->states;
        $class            = explode("\\", get_class($this));
        $states['driver'] = strtolower(end($class)) ?? null;
        return $states;
    }

    protected function getCodeFields()
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
            'response_type' => 'code',
        ];

        if ($this->usesState()) {
            $fields['state'] = JWT::encode($this->getStates(), config('core.common.jwt_token'));
        }
        return array_merge($fields, $this->parameters);
    }

    protected function buildAuthUrlFromBase($url)
    {
        return urldecode($url.'?'.http_build_query($this->getCodeFields(), '', '&', $this->encodingType));
    }

    public function verify($data)
    {
        return true;
    }
}
