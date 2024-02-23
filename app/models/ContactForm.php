<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;

class ContactForm extends Model
{
    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var string|null
     */
    public $subject;

    /**
     * @var string|null
     */
    public $body;

    /**
     * @var string|null
     */
    public $verifyCode;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [
                ['name', 'email', 'subject', 'body'],
                'required',
            ],
            [
                ['email'],
                'email',
            ],
            [
                ['verifyCode'],
                'captcha',
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * @param string $email
     * @return bool
     */
    public function contact(string $email): bool
    {
        if (!$this->validate()) {
            return false;
        }

        \Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();

        return true;
    }
}
