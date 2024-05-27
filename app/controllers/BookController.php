<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class BookController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $data_provider = new ActiveDataProvider([
            'query' => Book::find(),
        ]);

        return $this->render('index', [
            'data_provider' => $data_provider,
        ]);
    }

    /**
     * @return Response|string
     */
    public function actionCreate()
    {
        $book = new Book();

        if (\Yii::$app->request->isPost && $book->load(\Yii::$app->request->post())) {
            if ($book->save()) {
                \Yii::$app->session->setFlash('success', 'Book created');

                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'book' => $book,
            'title' => 'Create book',
            'authors' => Author::forSelect(),
        ]);
    }

    /**
     * @param int $id
     * @return Response|string
     */
    public function actionUpdate(int $id)
    {
        $book = Book::findOne($id);

        if (!$book instanceof Book) {
            \Yii::$app->session->setFlash('danger', 'Book not found');

            return $this->redirect(['index']);
        }

        if (\Yii::$app->request->isPost && $book->load(\Yii::$app->request->post())) {
            if ($book->save()) {
                \Yii::$app->session->setFlash('success', 'Book updated');

                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'book' => $book,
            'title' => "Update book: {$book->name}",
            'authors' => Author::forSelect(),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $book = Book::findOne($id);
        if (!$book instanceof Book) {
            \Yii::$app->session->setFlash('danger', 'Book not found');

            return $this->redirect(['index']);
        }

        $book->delete();
        \Yii::$app->session->setFlash('success', 'Book deleted');

        return $this->redirect(['index']);
    }
}
