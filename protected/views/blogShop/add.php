<style type="text/css">
	.category_label{
		display:block;
	}
	.category_input{
		width:10px;			
		vertical-align:bottom;
	}
</style>

<div class="form">

<?php
//	echo 'Selected categories'.count($selected);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blogshop-add-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shopname'); ?>
		<?php echo $form->textField($model,'shopname'); ?>
		<?php echo $form->error($model,'shopname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url'); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rssUrl'); ?>
		<?php echo $form->textField($model,'rssUrl'); ?>
		<?php echo $form->error($model,'rssUrl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div>
	<h2>Categories</h2>
	<?php 
		for($i=0;$i<sizeof($categories);$i++){
			$category=$categories[$i];
			//echo CHtml::label($category->name,$category->name);
			//echo CHtml::checkBox($category->id);
			echo <<<BLOCK
				<label class="category_label" for="$category->name">
					<input class="category_input" id="$category->id" type="checkbox" value="$category->id" name="category[$category->id]"/>
					$category->name
				</label>
BLOCK;
		}
?>
	</div>
	<p>
	<div class="row">
		<label class="category_label"><input id="ownerCheckBox" class="category_input" type=CHECKBOX name="owner">Are you the owner of this blogshop?</label>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
function checkOwner(){
	var checked=$("#ownerCheckBox:checked").val();
	if(checked === 'on'){
		return true;
	}else{
		return false;
	}
}
$("form").submit(function (){
	var checked=$("#ownerCheckBox:checked").val();
	if(checked === 'on'){
		alert('Submit');
		return true;
	}else{
		return false;
	}
	});
</script>
