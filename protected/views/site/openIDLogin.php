<style>
.providers{
	vertical-align:middle;
}
</style>
<div class="form">
<?php echo CHtml::beginForm(); ?>
	If you have a Google, Yahoo, any OpenId provider, you can login directly to ipostishop, there is no need to sign up !<p>
	<p>
	What are the benefits?
	<ol>
		<li>There is no need to remember another username/password!</li>
		<li>Faster signup process.</li>
		<li>Focus of the below providers are identiy management, they are more through about protecting your identity.</li>
	</ol>
		
	<div class="providers">
		<span id="google" class="provider"><img src="<?php echo Yii::app()->request->baseUrl;?>/assets/openid/google.png" width=100/></span>
		<span id="yahoo" class="provider"><img src="<?php echo Yii::app()->request->baseUrl;?>/assets/openid/yahoo.png" width=100/></span>
		<!-- <span id="facebook" class="provider"><img src="<?php echo Yii::app()->request->baseUrl;?>/assets/openid/facebook.jpg" width=100/></span> -->
		<span id="myopenid" class="provider"><img src="<?php echo Yii::app()->request->baseUrl;?>/assets/openid/myopenid.jpg" width=100/></span>
	</div>
	<p>
    <div class="row">
        <?php echo CHtml::label('Identifier:', 'openid_identifier'); ?>
        <?php echo CHtml::textField('openid_identifier', '', array('size'=>40)); ?>        
    </div>
 
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<script>
	var providers=[];
	providers["google"]="https://www.google.com/accounts/o8/id";
	providers["yahoo"]="https://me.yahoo.com";
	providers["myopenid"]="http://myopenid.com";
	
	function setOpenIdIdentifier(url){
		$('#openid_identifier').val(url);
	}
	
	function addClickHandler(){
		for(key in providers){			
			var selector='#'+key;
			alert(selector);
			var url=providers[key];
			$(selector).click(function(){
				setOpenIdIdentifier(url);
			});
		}
	}
	
	//addClickHandler();
	
	$('#google').click(function(handler){		
		setOpenIdIdentifier(providers['google']);
		
	});
	
	$('#yahoo').click(function(handler){		
		setOpenIdIdentifier(providers['yahoo']);
		
	});
	
	$('#myopenid').click(function(handler){
		setOpenIdIdentifier(providers['myopenid']);
	});
	
	
</script>
