<?php

    class ErrorHandler
    {
        // handle exception
        public static function handle_exception(Throwable $exception) : void
        {
            http_response_code(500);

            echo json_encode([
                "code"    => $exception->getCode(),
                "message" => $exception->getMessage(),
                "file"    => $exception->getFile(),
                "line"    => $exception->getLine()
            ]);
        }
        // handle error
        public static function handle_error(
            int $errno, 
            string $errstr, 
            string $errfile, 
            int $errline) : bool
        {
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
    }

?>