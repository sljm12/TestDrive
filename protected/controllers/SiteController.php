<?php
class SiteController extends Controller
{

	public function filters()
	{
		return array('accessControl');
	}
	
	public function accessRules()
	{
		return array(
			array('deny','actions'=>array('preference'),'users'=>array('?')),
			array('allow','actions'=>array('preference'),'users'=>array('@'))
		);
	}

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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}	

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->getSession()->destroy();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	* Login using OpenID
	*/
	public function actionOpenIDLogin() {
        $openid=new EOpenID;
 
        if(!isset($_GET['openid_mode'])) {
            if(isset($_POST['openid_identifier'])) {
                $openid->authenticate($_POST['openid_identifier']);
            }
        }
        elseif(isset($_GET['openid_mode'])) {
            $openid->validate();
            Yii::app()->user->login($openid);
			/*
			Check if user has fill in details before if has redirect to last page else redirect to new user page
			*/
			//$this->render('loggedin',array('openid'=>$openid));
			$openIdUrl=$openid->getIdentity();
			if($this->openidUrlFound($openIdUrl)){			
				$userDetails=Userdetails::model()->getUserByOpenIdUrl($openIdUrl);
				$openid->setState("name",$userDetails->username);
				
				Yii::app()->user->login($openid);
				$this->redirect(Yii::app()->homeUrl);
			}else{
				Yii::app()->user->login($openid);
				//$this->redirect(array('newuser'));
				$this->redirect(array('userdetails/create'));
			}
			return;
        }
 
        $this->render('openIDLogin');
    }
	
	private function openidUrlFound($url){
		return Userdetails::model()->isOpenIdUrlFound($url);
	}
	
	private function isTimeToUpdatePrefs($openIdUrl){
		
	}
	
	public function actionNewuser(){
		$model=new Userdetails();

		$openIdUrl=Yii::app()->user->id;
		if($this->openidUrlFound($openIdUrl)){
			$model=Userdetails::model()->getUserByOpenIdUrl($openIdUrl);
		}
	
		if(isset($_POST['Userdetails'])){
			$model->attributes=$_POST['Userdetails'];
			
			$model->openidurl=Yii::app()->user->id;
			
			if($model->validate()){
				if($model->save()){
					$this->redirect(Yii::app()->homeUrl);
				}else{
					throw new CHttpException(500,'Error in saving User Details.');
				}
			}
		}
		
		$this->render('newuser',array('model'=>$model));	
	}
	
	public function actionPreference(){
		$openidurl=Yii::app()->user->id;
		if($openidurl==null){
			throw new CHttpException(401,'Not authorised');
		}
		
		$model=new Preference();
		
		$saved_model=Preference::model()->findByOpenId($openidurl);
		
		if($saved_model!=null){
			$model = &$saved_model;
		}
		
		$categories=Category::model()->getAllCategories();
		//$model->email_newsletter=true;
		
		if(isset($_POST['Preference'])){
			$model->attributes=$_POST['Preference'];
			$model->openidurl=$openidurl;
			$model->save();
			$this->render('preference',array('model'=>$model));			
		}else{		
			$this->render('preference',array('model'=>$model));
		}
	}
}
