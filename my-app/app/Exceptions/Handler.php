<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     *  A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    //    /**
    //     * A list of the internal exception types that should not be reported.
    //     *
    //     * @var array<int, class-string<Throwable>>
    //     */
    //    protected $internalDontReport = [
    //        //
    //    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e): void {
            //            report($e);
        });
    }

    public function shouldReturnJson($request, Throwable $e): bool
    {
        return true;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        return parent::render($request, $e);
        //        if ($e instanceof HttpException) {
        //            $message = $e->getMessage();
        //            $code = $e->getCode();    // TODO сделать надстройку над функцией
        //        }
        //
        //        $defaultCode = 500;
        //        return response()->json([
        //            'status' => $code ?? $defaultCode,
        //            'message' => $message ?? 'Server Error',
        //        ], $code ?? $defaultCode);
    }
}
