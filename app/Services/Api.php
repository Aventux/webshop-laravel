<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class Api
{
    private mixed $callbackExecute;
    private mixed $callbackError;

    private int $statusCode = 200;
    private bool $success = true;
    private string $error = '';
    private string $message = '';
    private array $data = [];

    public function __construct()
    {
    }

    public function execute(callable $function): self
    {
        $this->callbackExecute = $function;
        return $this;
    }

    public function error(callable $function): self
    {
        $this->callbackError = $function;
        return $this;
    }

    public function render(): JsonResponse
    {
        try {
            if (is_callable($this->callbackExecute)) {
                $callbackResult = call_user_func($this->callbackExecute);
                $this->callbackResultProcessing($callbackResult);
            }
        } catch (\Throwable $e) {
            $this->success = false;
            if (is_callable($this->callbackError)) {
                $callbackResult = call_user_func($this->callbackError, $e);
                $this->callbackResultProcessing($callbackResult);
            }
        }

        return response()->json([
            'success' => $this->success, 'data' => $this->data, 'message' => $this->message,
            'error'   => $this->error,
        ], $this->statusCode);
    }

    private function callbackResultProcessing($callbackResult): void
    {
        $this->statusCode = $callbackResult['statusCode'] ?? $this->statusCode;
        $this->success = $callbackResult['success'] ?? $this->success;
        $this->data = $callbackResult['data'] ?? $this->data;
        $this->error = $callbackResult['error'] ?? $this->error;
        $this->message = $callbackResult['message'] ?? $this->message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}