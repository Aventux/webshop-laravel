<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Api
{
    private mixed $callbackExecute;
    private mixed $callbackError;

    private int $statusCode = 200;
    private bool $success = true;
    private string $error = '';
    private string $message = '';
    private array $responseData = [];

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
            'success' => $this->success, 'data' => $this->responseData, 'message' => $this->message,
            'error'   => $this->error,
        ], $this->statusCode);
    }

    private function callbackResultProcessing($callbackResult): void
    {
        $this->statusCode = $callbackResult['statusCode'] ?? $this->statusCode;
        $this->success = $callbackResult['success'] ?? $this->success;
        $this->error = $callbackResult['error'] ?? $this->error;
        $this->message = $callbackResult['message'] ?? $this->message;
        $this->responseData = $callbackResult['responseData'] ?? $this->responseData;
    }
}