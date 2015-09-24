<?php

class ConfigController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>array('index'),
                            'users'=>array('@'),
			),

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('smtp'),
                            'roles'=>array('admin.config.smtp')
			),
			array('deny',  // deny all users
                            'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionSmtp() {
            $smtp = new Options();
            $form = new SmtpForm();
            if(isset($_POST['SmtpForm'])) {
                $form->attributes = $_POST['SmtpForm'];
                if($form->validate())
                {
                    $command = Yii::app()->db->createCommand();
                    foreach ($form->attributes as $key => $value)
                    {
                        $smtp->update(array('option_value'=>$value), 'option_name=:option', array(':option'=>  strtoupper($key)));
                    }
                    $this->render('index',array(
                        'model'=>$form
                    ));
                }
            } else {
                $options = $smtp->getSmtpOptions();
                foreach ($options as $item)
                    $data[$item['option_name']] = $item['option_value'];
                $form->smtp_host = $data['SMTP_HOST'];
                $form->smtp_secure = $data['SMTP_SECURE'];
                $form->smtp_port = $data['SMTP_PORT'];
                $form->smtp_auth = $data['SMTP_AUTH'];
                $form->smtp_username =$data['SMTP_USERNAME'];
                $form->smtp_password = $data['SMTP_PASSWORD'];
                $form->smtp_from_name = $data['SMTP_FROM_NAME'];
                $this->render('smtp',array(
                    'model'=>$form
                ));
            }            
        }
}