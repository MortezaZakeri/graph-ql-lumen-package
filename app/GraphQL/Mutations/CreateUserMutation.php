<?php
/**
 * User: Morteza Zakeri
 * Date: 1/2/2020
 */

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Hash;

class CreateUserMutation extends Mutation {

    protected $attributes = [
        'name' => 'CreateUser'
    ];

    public function type(): Type {
        return GraphQL::type('user');
    }

    public function args(): array {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'username' => ['name' => 'username', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($rootValue, array $args,  $context = null, ResolveInfo $resolveInfo) {
        return User::create([
            'name' => $args['name'],
            'username' => $args['username'],
            'password' => Hash::make($args['password'])
        ]);
    }

}
