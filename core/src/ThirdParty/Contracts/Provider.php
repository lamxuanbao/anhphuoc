<?php


namespace Kizi\Core\ThirdParty\Contracts;

interface Provider
{
    public function generateUrl($name = null);

    public function with(array $parameters);

    public function setScopes(array $scopes = []);

    public function getScopes();

    public function setStates(array $states = []);

    public function getStates();

    public function verify($data);

    public function auth(array $parameters = []);
}
