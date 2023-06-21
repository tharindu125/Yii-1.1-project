<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$this->render('index');
	}

	public function actionGuestSaveData()
  { 	//var_dump($_POST);exit;
		$guest = new GuestDetails; 
		$guest->guest_name = $_POST['guest_name'];
		$guest->room_number = $_POST['room_number'];
		$guest->mobile_number = $_POST['mobile_num'];
		$guest->email = $_POST['email'];
		$guest->gender = $_POST['gender'];
		$guest->dob = $_POST['dob'];
		$guest->country = $_POST['country'];
		$guest->dishes = $_POST['dishes'];
		if($guest->save(false))
		{
			$response = array(
				'status' => 'success',
				'message' => 'Guest data saved successfully.',
			);		
		} else {
			$response = array(
				'status' => 'error',
				'message' => 'Something went wrong.'
			);
		}
		echo json_encode($response);
	}

	public function actionView(){
		$this->render('view');
	}

	public function actionViewSearch(){
		//var_dump($_POST["view_search"]);
		if ($_POST['view_search'] != '') {
			$searchTerm = $_POST['view_search'];
			$criteria = new CDbCriteria();
			$criteria->addSearchCondition('guest_name', $searchTerm, true, 'OR');
			$criteria->addSearchCondition('room_number', $searchTerm, true, 'OR');
			$view = GuestDetails::model()->findAll($criteria);
		}else{
			$view = GuestDetails::model()->findall();
		}
		$this->renderPartial('viewSearch', array('view'=>$view));
	}

	public function actionGuestSearch(){
		// var_dump($_POST);exit;
		$search = GuestDetails::model()->findByPk($_POST["search"]);		
		if($search != null)
		{
			//echo "Searching";	
			$this->renderPartial('guestSearch02', array('search'=>$search));
			// $resposne  = array(
			// 	'status'=>1,
			// 	'msg'=>'Something went wrong please contact ...',
			// );
			// echo json_encode($resposne);		
		}			
	}

	public function actionUpdateData() {	
		$model = GuestDetails::model()->findByPk($_POST['guest_id']);

		if ($model !== null) {
			$model->guest_name = $_POST['guest_name'];
			$model->room_number = $_POST['room_number'];
			$model->mobile_number = $_POST['mobile_num'];
			$model->email = $_POST['email'];
			$model->gender = $_POST['gender'];
			$model->dob = $_POST['dob'];
			$model->country = $_POST['country'];
			$model->dishes = $_POST['dishes'];
			if($model->save(false))
			{
				$response = array(
					'status' => 'success',
					'message' => 'Guest data update successfully.',
				);
				
			} else {
				$response = array(
					'status' => 'error',
					'message' => 'Something went wrong.'
				);
			}
			echo json_encode($response);
		}
	}

	public function actionDeleteData() {
		$model = GuestDetails::model()->findByPk($_POST['id']);
		$model->delete(false);
		$resposne  = array(
			'status'=>1,
			'msg'=>'Deleted successfully',
		);
		echo json_encode($resposne);
	}










	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	
}