<?php

/**
 * Description of HttpClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\Client;

use Dotsplatform\SearchApiSdk\Exceptions\SearchApiException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class HttpClient
{
    private const INTERNAL_GATEWAY_TOKEN_HEADER = 'X-Internal-Gateway-Token';

    private const CONNECT_TIMEOUT_SECONDS = 3;

    private const REQUEST_TIMEOUT_SECONDS = 10;

    protected string $serviceHost;

    protected string $gatewayToken;

    protected ?GuzzleClient $client = null;

    public function __construct()
    {
        $host = config('search-api-sdk.search-server.host');
        $token = config('search-api-sdk.search-server.token');
        $this->serviceHost = is_string($host) ? $host : '';
        $this->gatewayToken = is_string($token) ? $token : '';
    }

    protected function makeClient(): GuzzleClient
    {
        if ($this->client === null) {
            $this->client = new GuzzleClient([
                'base_uri' => $this->serviceHost,
                'headers' => [
                    'Accept' => 'application/json',
                    self::INTERNAL_GATEWAY_TOKEN_HEADER => $this->gatewayToken,
                ],
                'http_errors' => false,
                'connect_timeout' => self::CONNECT_TIMEOUT_SECONDS,
                'timeout' => self::REQUEST_TIMEOUT_SECONDS,
            ]);
        }

        return $this->client;
    }

    protected function get(string $uri, array $options = []): array
    {
        return $this->request('GET', $uri, $options);
    }

    protected function put(string $uri, array $options = []): array
    {
        return $this->request('PUT', $uri, $options);
    }

    protected function delete(string $uri, array $options = []): array
    {
        return $this->request('DELETE', $uri, $options);
    }

    private function request(string $method, string $uri, array $options): array
    {
        try {
            $response = $this->makeClient()->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            throw new SearchApiException([], $e->getMessage());
        }

        $this->assertSuccessful($response);

        return $this->decode($response);
    }

    private function assertSuccessful(ResponseInterface $response): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        throw new SearchApiException(
            $this->decode($response),
            'Catalog Search API request failed: HTTP '.$response->getStatusCode(),
            $response->getStatusCode(),
        );
    }

    private function decode(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        if ($body === '') {
            return [];
        }

        $decoded = json_decode($body, true);

        return is_array($decoded) ? $decoded : [];
    }
}
