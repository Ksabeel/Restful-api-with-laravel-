<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (int) $buyer->id,
            'name' => (string) $buyer->name,
            'email' => (string) $buyer->email,
            'isVerified' => (bool) $buyer->verified,
            'creationDate' => (string) $buyer->created_at,
            'lastChange' => (string) $buyer->updated_at,
            'deleteDate' => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,
        ];
    }
}
