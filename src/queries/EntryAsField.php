<?php

namespace rosas\queries;

use rosas\arguments\EntryAsFieldArguments;
use craft\gql\arguments\elements\Entry as EntryArguments;
use craft\gql\base\Query;
use craft\gql\interfaces\elements\Entry as EntryInterface;
use craft\gql\resolvers\elements\Entry as EntryResolver;
use craft\helpers\Gql as GqlHelper;
use GraphQL\Type\Definition\Type;

class EntryAsField extends \craft\gql\base\Query
{
    public static function getQueries($checkToken = true): array
    {
        if ($checkToken && !GqlHelper::canQueryEntries()) {
            Craft::info("platypus");
            return [];
        }

        return [
            //'nestedEntries' => [
                'type' => Type::listOf(EntryInterface::getType()),
                'args' => EntryAsFieldArguments::getArguments(),
                //'args' => EntryArguments::getArguments(),
                'resolve' => EntryResolver::class . '::resolve',
                'description' => 'This query is used to query for entries.',
                'complexity' => GqlHelper::relatedArgumentComplexity(),
            //]
        ];
    }
}
