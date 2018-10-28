<?php

namespace MetroMarket\MobilePanel\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof InvalidParametersException) {
            return $e->render($request, $e);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json(array(
                'status'       => 'fail',
                'errorMessage' => 'خطأ في المدخلات',
                'errorDetails' => 'لا يمكن العثور على العنصر المطلوب',
            ), 400);
        }
        if ($e instanceof NotFoundHttpException) {
            return response()->json(array(
                'status'       => 'fail',
                'errorMessage' => 'الصفحة غير موجودة',
                'errorDetails' => 'عذرا, لا يمكن معالجة طلبك تأكد من صحة الرابط',
            ), 404);
        }
        return parent::render($request, $e);
    }
}
