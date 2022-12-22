<?php

namespace App\Services;

class Api
{
    private mixed $callbackExecute;
    private mixed $callbackError;

    private int $statusCode = 200;
    private bool $success = true;
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

    public function render()
    {
        try {
            if (is_callable($this->callbackExecute)) {
                $callbackResult = call_user_func($this->callbackExecute);
                $this->callbackResultProcessing($callbackResult);
            }
        } catch (\Throwable $e) {
            if (is_callable($this->callbackError, $e)) {
                $callbackResult = call_user_func($this->callbackExecute, $e);
                $this->callbackResultProcessing($callbackResult);
            }
        }

        response()->json([
            'success' => $this->success, 'data' => $this->responseData, 'message' => $this->message,
        ], $this->statusCode);
    }

    private function callbackResultProcessing($callbackResult): void
    {
        $this->statusCode = $callbackResult['statusCode'] ?? $this->success;
        $this->success = $callbackResult['success'] ?? $this->success;
        $this->message = $callbackResult['message'] ?? $this->success;
        $this->responseData = $callbackResult['responseData'] ?? $this->responseData;
    }
}