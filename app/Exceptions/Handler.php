<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Listado de mensajes de error
     *
     * @var array<int, string>
     */
    protected array $messages = [
        404 => 'No te montes películas, la página que buscas no existe...',
    ];

    /**
     * @param $request
     * @param Throwable $e
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        $response = parent::render($request, $e);

        $status = $response->getStatusCode();

        if (! array_key_exists($status, $this->messages)) {
            return $response;
        }

        return inertia('error/Error404', [
            'status' => $status,
            'message' => $this->messages[$status],
        ])
            ->toResponse($request)
            ->setStatusCode($status);
    }

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
