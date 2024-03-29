<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Cake\Collection\Collection;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Tags', [
            'joinTable' => 'articles_tags',
            'dependent' => true,
        ]);
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }

        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('title')
            ->minLength('title', 10)
            ->maxLength('title', 255)
            ->notEmptyString('body')
            ->minLength('body', 10)
            ->notEmptyString('slug');

        return $validator;
    }

    public function findTagged(Query $query, array $options): Query
    {
        $columns = [
            'Articles.id', 'Articles.user_id', 'Articles.title',
            'Articles.body', 'Articles.published', 'Articles.created',
            'Articles.slug',
        ];

        $query = $query->select($columns)
            ->distinct($columns);

        if (empty($options['tags'])) {
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Articles.id']);
    }

    protected function _buildTags($tagString): array
    {
        $inputTags = array_map('trim', explode(',', $tagString));
        $inputTags = array_filter($inputTags);
        $inputTags = array_unique($inputTags);

        $foundTags = $this->Tags->find()
            ->where(['Tags.title IN' => $inputTags])
            ->all();

        $newTags =  (new Collection($inputTags))->filter(
            function ($tag) use ($foundTags) {
                return !$foundTags->extract('title')->contains($tag);
            }
        );

        $out = $foundTags->append(
            $newTags->map(function ($tag) {
                return $this->Tags->newEntity(['title' => $tag]);
            })
        )->toList();

        return $out;
    }
}
