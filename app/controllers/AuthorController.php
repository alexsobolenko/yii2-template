<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class AuthorController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $data_provider = new ActiveDataProvider([
            'query' => Author::find(),
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
        $author = new Author();

        if (\Yii::$app->request->isPost && $author->load(\Yii::$app->request->post())) {
            if ($author->save()) {
                \Yii::$app->session->setFlash('success', 'Author created');

                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'author' => $author,
            'title' => 'Create author',
        ]);
    }

    /**
     * @param int $id
     * @return Response|string
     */
    public function actionUpdate(int $id)
    {
        $author = Author::findOne($id);

        if (!$author instanceof Author) {
            \Yii::$app->session->setFlash('danger', 'Author not found');

            return $this->redirect(['index']);
        }

        if (\Yii::$app->request->isPost && $author->load(\Yii::$app->request->post())) {
            if ($author->save()) {
                \Yii::$app->session->setFlash('success', 'Author updated');

                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'author' => $author,
            'title' => "Update author: {$author->name}",
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        $author = Author::findOne($id);
        if (!$author instanceof Author) {
            \Yii::$app->session->setFlash('danger', 'Author not found');

            return $this->redirect(['index']);
        }

        if ($author->booksCount() > 0) {
            \Yii::$app->session->setFlash('danger', 'Cannot delete author having books');

            return $this->redirect(['index']);
        }

        $author->delete();
        \Yii::$app->session->setFlash('success', 'Author deleted');

        return $this->redirect(['index']);
    }
}
