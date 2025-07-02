<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderService;
use Exception;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function json_encode;
use function is_string;
use function is_int;

class OrderController
{
    public function __construct(private readonly OrderService $service)
    {
    }

    /**
     * Create new order.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create(Request $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        if (empty($data['productId']) || !is_string($data['productId'])) {
            return $this->errorResponse($response, 'Invalid or missing productId');
        }

        if (!isset($data['quantity']) || !is_int($data['quantity']) || $data['quantity'] <= 0) {
            return $this->errorResponse($response, 'Invalid or missing quantity, must be positive integer');
        }

        try {
            $order = $this->service->createOrder($data['productId'], $data['quantity']);
            $response->getBody()->write(json_encode($order));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(StatusCodeInterface::STATUS_CREATED);
        } catch (GuzzleException $e) {
            return $this->errorResponse($response, 'External service error: ' . $e->getMessage(), StatusCodeInterface::STATUS_BAD_GATEWAY);
        } catch (Exception $e) {
            return $this->errorResponse($response, $e->getMessage());
        }
    }

    /**
     * Get orders list.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function list(Request $request, Response $response): Response
    {
        $orders = $this->service->listOrders();
        $response->getBody()->write(json_encode($orders));

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Helper method for errors.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string                              $message
     * @param int                                 $status
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function errorResponse(Response $response, string $message, int $status = StatusCodeInterface::STATUS_BAD_REQUEST): Response
    {
        $response->getBody()->write(json_encode(['error' => $message]));

        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }
}
