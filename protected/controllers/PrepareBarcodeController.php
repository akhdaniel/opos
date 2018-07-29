<?php

class PrepareBarcodeController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','directPrint','reset', 'pdf','admin','delete'),
				'users'=>array('@'),
			),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array(),
			// 	'users'=>array('admin'),
			// ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=new PrepareBarcode;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PrepareBarcode']))
		{
			$model->attributes=$_POST['PrepareBarcode'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'Product added for barcode printing.');
				$this->redirect(array('admin' ));
			}
		}

		$model->qty = 1;
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PrepareBarcode']))
		{
			$model->attributes=$_POST['PrepareBarcode'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->redirect(array('admin'));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		$this->layout='//layouts/column1';

		$newModel=new PrepareBarcode;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PrepareBarcode']))
		{
			$newModel->attributes=$_POST['PrepareBarcode'];
			if( !$newModel->save() ) {
				var_dump($newModel->getErrors());
				die('error');
			}
			Yii::app()->user->setFlash('success', 'Product added for barcode printing.');
		}

		$newModel->qty = 1;

		$model=new PrepareBarcode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PrepareBarcode']))
			$model->attributes=$_GET['PrepareBarcode'];

		$this->render('admin',array(
			'model'=>$model,
			'newModel'=> $newModel,
		));
	}

	/**
	 Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PrepareBarcode::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='prepare-barcode-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	process direct print barcode
	*	//parameter: printer type:
	*	//* toshiba
	*	//* intermec
	*
	*	//inlucde driver, which contains print( $products ) function
	*
	**/
	public function actionDirectPrint(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		// $products is the array of product object
		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;
		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$prepareBarcodes = PrepareBarcode::model()->findAll();
		foreach ($prepareBarcodes as $pb){
			$p   = $pb->product;
			$qty = $pb->qty;
			for ($i=0 ; $i<$qty; $i++){
				$data 				= new Product();
				$data->name 		= $p->name;
				$data->list_price 	= $p->list_price;
				$data->ean13 		= $p->ean13 ;
				$data->default_code	= $p->default_code ;

				$products[] = $data;

			}
		}


		$printer = new BarcodePrinter();
		$ret = $printer->send($products, $shop_name, $company_name);

		$ret = str_replace("\n", "<br/>", $ret);
		Yii::app()->user->setFlash('success', 'Barcode Labels printed: <br/> ' . $ret);
		$this->redirect(array('admin'));


	}	

	/**
	reset print buffer
	*	//parameter: printer type:
	*/
	public function actionReset(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();
		PrepareBarcode::model()->deleteAll();
		$this->redirect(array('index' ));

	}

	/**
	process pdf
	*
	**/
	public function actionPdf(){
		Yii::app()->MAyBxCgTKStni_pYPNUb1122->JpLnRZIvtolT();

		// $products is the array of product object
		$as = AppSetting::model()->findOrCreate('shop_name',"SHOP NAME");
		$shop_name = $as->val;

		$as = AppSetting::model()->findOrCreate('company_name',"KOKARFI");
		$company_name = $as->val;

		$prepareBarcodes = PrepareBarcode::model()->findAll();
		foreach ($prepareBarcodes as $pb){
			$p   = $pb->product;
			$qty = $pb->qty;
			for ($i=0 ; $i<$qty; $i++){
				$data 				= new Product();
				$data->name 		= $p->name;
				$data->list_price 	= $p->list_price;
				$data->ean13 		= $p->ean13 ;
				$data->default_code	= $p->default_code ;

				$products[] = $data;

			}
		}

		$ret = $this->createPdf($products, $shop_name, $company_name);

		//$ret = str_replace("\n", "<br/>", $ret);
		//Yii::app()->user->setFlash('success', 'Barcode Labels printed: <br/> ' . $ret);
		//$this->redirect(array('admin'));


	}

	public function createPdf($products, $shop_name='', $company_name=''){
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
		                        'P', 'mm', 'A4', true, 'UTF-8');
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$style = array(
		    'position' => '',
		    'align' => 'C',
		    'stretch' => false,
		    'fitwidth' => true,
		    'cellfitalign' => '',
		    'border' => false,
		    'hpadding' => 'auto',
		    'vpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255),
		    'text' => true,
		    'font' => 'helvetica',
		    'fontsize' => 5,
		    'stretchtext' => 4
		);


		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Nicola Asuni");
		$pdf->SetTitle("TCPDF Example 002");
		$pdf->SetSubject("TCPDF Tutorial");
		$pdf->SetKeywords("TCPDF, PDF, example, test, guide");
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AliasNbPages();
		$pdf->AddPage();

		$ret = '';
		
		$i=0; 
		$x=0;
		$y=0;

		$label_column= 3;
		$label_width = 32; //mm
		$label_height= 18; //mm

		foreach($products as $k=>$p){
			$pdf->SetTextColor(0,0,0);
			if($k>0 && ($k % $label_column ==0) ){
				$i = 0;
				$y += $label_height;
			}
			
			$x = $i * $label_width;

			$nama = $p->name;
			$harga = 'Rp.' . number_format($p->list_price, 0);
			$ean13 = $p->ean13;
			$barcode = $p->default_code;
			
			//// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1,
			// $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

			$pdf->SetFont('helvetica', '', 5);
			//$pdf->MultiCell($label_width, 2, $nama,    0, 'L', 0, 0, $x, $y,   true);
			$pdf->Text($x, $y, $nama);

			$pdf->SetFont('helvetica', '', 6);
			//$pdf->MultiCell($label_width, 3, $harga,   0, 'L', 0, 0, $x, $y+2, true);
			$pdf->Text($x, $y+2, $harga);

			$pdf->SetY($y+5);
			$pdf->SetX($x);
			$pdf->write1DBarcode(sprintf("%d",$barcode), 'C128', '', '', '', $label_height-7, 0.2, $style, 'N');

			// Start Transformation, x y for company name
			$pdf->SetTextColor(255, 255, 255);

			$x_com = $x+$label_width - 3;
			$y_com = $y+$label_height + 0.1;
			$pdf->StartTransform();
			// Rotate 20 degrees counter-clockwise centered by (70,110) 
			// which is the lower left corner of the rectangle
			$pdf->Rotate(90, $x_com, $y_com);
			$pdf->Rect($x_com, $y_com, $label_height, 2.1, 'F', array(), array(BLACK));
			//$pdf->Text($x_com, $y_com, $company_name );
			$pdf->MultiCell($label_height, 2.1, $company_name,   0, 'C', 0, 0, $x_com, $y_com,   true);
			$pdf->StopTransform();

			$k++;
			$i++;

		}

		$pdf->Output("barcode.pdf", "D");		

		//return $ret;
	}	
}
