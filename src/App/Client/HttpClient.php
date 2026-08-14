<?php

/**
 * Description of HttpClient.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dotsplatform\CatalogSearchApiSdk\Client;

use Dotsplatform\CatalogSearchApiSdk\Exceptions\CatalogSearchApiException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class HttpClient
{
    private const INTERNAL_GATEWAY_TOKEN_HEADER = 'X-Internal-Gateway-Token';

    protected string $serviceHost;

    protected string $gatewayToken;

    protected ?GuzzleClient $client = null;

    public function __construct()
    {
        $host = config('catalog-search-api-sdk.catalog-search-server.host');
        $token = config('catalog-search-api-sdk.catalog-search-server.token');
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
            throw new CatalogSearchApiException([], $e->getMessage());
        }

        $this->assertSuccessful($response);

        return $this->decode($response);
    }

    private function assertSuccessful(ResponseInterface $response): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        throw new CatalogSearchApiException(
            $this->decode($response),
            'Catalog Search API request failed',
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
