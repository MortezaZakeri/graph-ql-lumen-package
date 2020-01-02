<?php
/**
 * User: Morteza Zakeri
 * Date: 1/2/2020
 */

namespace App\GraphQL\Types;


use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'User',
        'description' => 'A user',
        'model' => User::class,
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
                'alias' => 'id',
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'The email of user',
                'resolve' => function ($root, $args) {
                    return strtolower($root->username);
                }
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'user full name',
            ],

        ];
    }

    protected function resolveEmailField($root, $args) {
        return strtolower($root->email);
    }
}
