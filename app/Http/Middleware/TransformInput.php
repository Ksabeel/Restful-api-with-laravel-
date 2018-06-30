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
    public function handle($request, Closure $next, $transformer)
    {
        $tranformedInput = [];

        foreach ($request->request->all() as $input => $value) {
            $tranformedInput[$transformer::originalAttribute($input)] = $value;
        }
        
        $request->replace($tranformedInput);

        $response =  $next($request);

        if (isset($response->exception) && $response->exception instanceof ValidationException) {
            $data = $response->getData();

            $tranformedErrors = [];

            foreach ($data->error as $field => $error) {
                $transformedField = $transformer::transformedAttribute($field);

                $tranformedErrors[$transformedField] = str_replace($field, $transformedField, $error);
            }

            $data->error = $tranformedErrors;

            $response->setData($data);
        }

        return $response;

        // return $next($request);
    }
}
