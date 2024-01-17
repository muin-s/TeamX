<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        $this->renderable(function (ValidationException $e, $request) {
            return $this->convertValidationExceptionToResponse($e, $request);
        });

        // Add custom exception handling logic here if needed
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param \Illuminate\Validation\ValidationException $e
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->errors();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $errors], IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return redirect()->to($request->url())->withInput($request->input())->withErrors($errors, $this->errorBag());
    }

    // Add additional custom exception handling methods if needed
}
