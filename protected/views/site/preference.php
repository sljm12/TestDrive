<style type="text/css">
	
	form .header{
		
	}
	
</style>
<div class="form">
<?php
echo $model->openidurl;
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-preference-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="header">Preferences</div>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Receive our news letter'); ?>
		<?php echo $form->checkBox($model,'email_newsletter'); ?>
		<?php echo $form->error($model,'email_newsletter'); ?>
	</div>
	
	<div class="row">
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->