<?php
/**
 * User: Morteza Zakeri
 * Date: 1/2/2020
 */

namespace App\GraphQL\Queries;

use App\Models\User;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use Closure;

class UsersQuery extends Query {
    protected $attributes = [
        'name' => 'Users query'
    ];

    public function type(): Type {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields) {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        }

        if (isset($args['username'])) {
            return User::where('username', $args['username'])->get();
        }
        return User::all();
    }
}
