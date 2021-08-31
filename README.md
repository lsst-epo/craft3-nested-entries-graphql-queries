# Nested Entry GraphQL Plugin

This Craft CMS plugin allows for performing graphQL search queries that match on fields on nested entries-as-a-field.

## What is a "entry-as-a-field"?

Simply put, an **section** that has been modeled in Craft that has a **field** of **Field Type** "Entries". This "Entries" field may be directly on another entry type or on a **Matrix block** on another entry.

Off the shelf, the "search" argument on the "entries" query will not match on field on the nested entry and return the parent entry.

```gql
{
    entries(search: "some search terms") {
        id
        title
    }
}
```

With the above query, if there is a match on a field in the nested entry then only that nested entry will be returned.

What if you want to return the whole monolithic entry? This plugin allows you to do this.

## How to use this plugin

This plugin introduces a new type of query called "nestedEntries" with a new argument called "searchRelated":

```gql
{
    nestedEntries(searchRelated: [{search: "some search terms"}]) {
        id
        title
    }
}
```

The "searchRelated" argument can take multiple filter criteria:

```graphql
{
    nestedEntries(searchRelated: [{search: "some term"}, {search: "another term"}]) {
        id
        title
    }
}
```

Of course "LIKE" searches are also supported:

```graphql
{
    nestedEntries(searchRelated: [{search: "*ship*"}]) {
        id
        title
    }
}
```

## Collaboration

Pull requests welcome! If you find a bug open up an issue. If you have an idea, but don't know how to implement it then open up a discussion and describe what you trying to accomplish and, if possible, guidance will be provided.