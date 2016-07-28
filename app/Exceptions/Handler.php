<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
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
        return parent::report($e);
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
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        /*
         * 1, 程序中主动抛出的异常,例如校验没通过等
         * 2, 写入log
         * 3, 返回json错误信息
         */

        if ($e instanceof ProgramException) {
            Log::error('program exception, message is : ' . $e->getOutMessage());
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getOutMessage()
                ]
            );
        } else {

            //其他的全部统一处理
            Log::error('system exception, message is : ' . $e->getMessage());
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );

        }

        return parent::render($request, $e);
    }
}
