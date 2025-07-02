<?php

declare(strict_types=1);

namespace App\HttpClient;

use Exception;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

use function json_decode;
use function json_last_error;

class ProductClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $_ENV['NODE_PRODUCT_SERVICE_URL'].'/products/',
            'timeout'  => 5
        ]);
    }

    /**
     * @param string $productId
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getProduct(string $productId): array
    {
        try {
            $response = $this->client->get($productId);

            if ($response->getStatusCode() !== StatusCodeInterface::STATUS_OK) {
                throw new Exception("Product service returned status ".$response->getStatusCode());
            }

            $body = (string)$response->getBody();
            $product = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response from product service.");
            }
var_dump($product);
            return $product;
        } catch (ConnectException $e) {
            throw new Exception("Could not connect to product service: ".$e->getMessage());
        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'Unknown';
            throw new Exception("Product service error [HTTP $statusCode]: ".$e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Product fetch failed: ".$e->getMessage());
        }
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getProducts(): array
    {
        try {
            $response = $this->client->get('');

            if ($response->getStatusCode() !== StatusCodeInterface::STATUS_OK) {
                throw new Exception("Product service returned status ".$response->getStatusCode());
            }

            $body = (string)$response->getBody();
            $products = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response from product service.");
            }

            return $products;
        } catch (ConnectException $e) {
            throw new Exception("Could not connect to product service: ".$e->getMessage());
        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'Unknown';
            throw new Exception("Product service error [HTTP $statusCode]: ".$e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Product fetch failed: ".$e->getMessage());
        }
    }
}
