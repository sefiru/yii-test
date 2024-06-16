<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\User;
use yii\data\ActiveDataProvider;
use OpenApi\Annotations as OA;
use Yii;

/**
 * @OA\Info(
 *     title="My First API",
 *     version="0.1"
 * )
 */
class DefaultController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Find user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function actionView($id)
    {
        // default
    }

    /**
     * @OA\Post(
     *     path="/api/user",
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function actionCreatee()
    {
        $model = new User();

        $params = Yii::$app->getRequest()->getBodyParams();
        
        if ($model->load($params, '')) {
            $model->status = 10;
            $model->password_hash = Yii::$app->security->generatePasswordHash($params['password']);
            $model->auth_key = Yii::$app->security->generateRandomString();
            if ($model->validate()) {
                $model->save();
                return $model;
            } else {
                return $model->errors;
            }
        }

        return ['error' => 'Failed to load data into the model'];
    }


    /**
     * @OA\Put(
     *     path="/api/user/{id}",
     *     summary="Update an existing user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function actionUpdate($id)
    {
        // default
    }

    /**
     * @OA\Delete(
     *     path="/api/user/{id}",
     *     summary="Delete a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function actionDelete($id)
    {
        // default
    }
}
