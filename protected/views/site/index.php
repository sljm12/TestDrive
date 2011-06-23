<style type="text/css">
	#news_header{
		display:block;
		width:100%;
	}
	#news_container{
		clear:both;
		float:left;
		width:70%;
	}
	
	#for_owners{				
		
		
	
	}
	
	#for_shoppers{		

	}
	
	#news{
		float:left;
	}

</style>
<!--
<?php //$this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php //echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
-->
<div id="news_header">
Yeah ! ipostishop is launched!

What is ipostishop ? Click on the below links to find out more.
<a href="">Read more</a>
</div>

<div id="news_container">
	<div id="for_owners">
		<h2>For Blogshops Owners</h2>
		Why should you sign up your blog with us ?
		<ol>
			<li>We provide a central place for you to advertise your goods and services.<li>
			<li>We aim to provide tools to help you advertise.</li>
			<li>We aim to be the No.1 blogshop directory in Singapore and we need your help to do that!</li>
			
		</ol>
	</div>

	<div id="for_shoppers">
		<h2>For Shoppers</h2>
		<ol>
			<li>Always know whats new from your favourite shops!</li>
			<li>Discover new shops and new products everyday!</li>
			<li>Subscribe to our facebook, twitter and email newsletter to always keep yourself updated!</li>
			<li>Tell your friends about your favourite blogs</li>
		</ol>
	</div>
</div>

<div id="news">
	<div id="new_shops">
		<h2>New shops</h2>
	</div>
	<div id="new_news">
		
	</div>
</div>

<script>
	$.get('index.php?r=blogshop/ListNewA',function(data,textStatus,jqXHR){
		if(textStatus==='success'){
			var shops=jQuery.parseJSON(data);
			for(s in shops){
				var shop=shops[s];
				$('#new_shops').append('<div class="front_panel_item"><a href="'+shop.url+'">'+shop.shopname+'</a></div>');
			}
		}else{
			$('#new_shops').append('No new shops avaliable');
		}
		
	});
</script>