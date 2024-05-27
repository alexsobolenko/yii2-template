<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 */
class Author extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%authors}}';
    }

    /**
     * @return array[]
     */
    public static function forSelect(): array
    {
        $result = [];
        foreach (self::find()->all() as $author) {
            $result[$author->id] = $author->name;
            // $result[] = ['id' => $author->id, 'name' => $author->name];
        }

        return $result;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255, 'min' => 3],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'books_count' => 'Books count',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    /**
     * @return int
     */
    public function booksCount(): int
    {
        return $this->getBooks()->count();
    }
}
