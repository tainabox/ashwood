<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\{
    Order,
    Customer
};
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        $orders = $dataProvider->getModels();

        foreach ($orders as $order) {
            $sum[] = $order->sum;
        }

        $total = array_sum($sum);

        $customers = Customer::find()->all();
        foreach ($customers as $customer) {
            $name[$customer['id']] = $customer['name'];
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'customersName' => $name,
            'total' => $total
        ]);
    }

    public function actionFilter()
    {
        $id = Yii::$app->request->post('id');

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['customer_id' => $id]),
        ]);

        $orders = $dataProvider->getModels();

        foreach ($orders as $order) {
            $sum[] = $order->sum;
        }

        $total = array_sum($sum);

        return $this->render('filter', [
            'dataProvider' => $dataProvider,
            'total' => $total
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $customers = Customer::find()->all();
        foreach ($customers as $customer) {
            $name[$customer['id']] = $customer['name'];
        }


        return $this->render('create', [
            'model' => $model,
            'customersName' => $name
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $customers = Customer::find()->all();
        foreach ($customers as $customer) {
            $name[$customer['id']] = $customer['name'];
        }


        return $this->render('update', [
            'model' => $model,
            'customersName' => $name
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
