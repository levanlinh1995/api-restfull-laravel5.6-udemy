<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tranformer)
    {
        $transformedInput = [];

        foreach ($request->all() as $input => $value) {
            $transformedInput[$tranformer::originalAttribute($input)] = $value;
        }

        $request->replace($transformedInput);

        $response =  $next($request);

        if (isset($response->exception) && $response->exception instanceof ValidationException) {
            $data = $response->getData();

            $tranformedErrors = [];

            foreach ($data->error as $field => $error) {
                $tranformedField = $tranformer::transformeAttribute($field);
                $tranformedErrors[$tranformedField] = str_replace($field, $tranformedField, $error);
            }

            $data->error = $tranformedErrors;

            $response->setData($data);
        }

        return $response;
    }
}
