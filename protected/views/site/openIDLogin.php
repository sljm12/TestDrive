
<div class="form">
<?php echo CHtml::beginForm(); ?>
	Click on your OpenID provider below<p>
	<div class="providers">
		<span id="google" class="provider">Google</span>
		<span id="yahoo" class="provider">Yahoo</span>
	</div>
	<p>
    <div class="row">
        <?php echo CHtml::label('Identifier:', 'openid_identifier'); ?>
        <?php echo CHtml::textField('openid_identifier', '', array('size'=>40)); ?>
        <p class="hint">
            Hint: You may login with <tt>https://www.google.com/accounts/o8/id</tt>.
        </p>
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
	
	
</script>