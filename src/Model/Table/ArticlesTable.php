<?php
namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if($entity->isNew() && !$entity->slug)
        {
            $sluggedTitle = Text::slug($entity->title.$entity->id);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    public function validationDefault(Validator $validator): Validator
    {
         $validator
            ->notEmptyString('title', 'Ce champ ne peut être vide')
            ->minLength('title', 10, '10 caractères minimum')
            ->maxLength('title', 255, '255 caractères maximum')

            ->notEmptyString('body')
            ->minLength('body', 10);
        
        return $validator;
    }
}