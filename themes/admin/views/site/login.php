<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<h2 class="login-box-msg">Login</h2>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	
	<div class="row">
                        <div class="input-group mb-3">
                            <?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'Username')); ?>
                            <?php echo $form->error($model,'username'); ?>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                        </div>

	</div>

	<div class="row">
            <div class="input-group mb-3">
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
            </div>

		
	</div>

	<div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                    <?php echo $form->label($model,'rememberMe'); ?>
                    <?php echo $form->error($model,'rememberMe'); ?>
                </div>
            </div>
            <div class="col-4">
                <?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary btn-block')); ?>
            </div>
	</div>


		

<?php $this->endWidget(); ?>
</div><!-- form -->
