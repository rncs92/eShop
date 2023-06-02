<?php


return [
    'classes' => [
        ArticleRepository::class => DI\create(DatabaseArticleRepository::class),
        UserRepository::class => DI\create(DatabaseUserRepository::class),
        CommentRepository::class => DI\create(DatabaseCommentRepository::class),
    ],
];