<?php

declare(strict_types=1);

namespace App\Decorator;

use App\Model\Entity\Article;
use Cake\I18n\FrozenTime;

class ArticleDecorator
{

    public string $title;
    public string $slug;
    public string $authorName;
    public FrozenTime $created;
    public FrozenTime $modified;
    public Article $origin;

    public function __construct(Article $article)

    {
        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->setAuthorName($article);
        $this->created = $article->created;
        $this->modified = $article->modified;
        $this->origin = $article;
    }

    public function setAuthorName(Article $article)
    {
        $email = $article->user?->email ?? '';
        $this->authorName = $this->extractUserNameFromEmail($email);
    }

    private function extractUserNameFromEmail(string $email): string
    {
        $matches = [];
        return preg_match('/(?<userName>.+)@/i', $email, $matches) ? $matches['userName'] : '';
    }
}
