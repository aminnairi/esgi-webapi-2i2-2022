<?php

class Response
{
    final public static function json(int $statusCode, array $headers, $body): string
    {
        foreach ($headers as $headerName => $headerValue) {
            header("$headerName: $headerValue");
        }

        http_response_code($statusCode);

        return json_encode($body);
    }
}
