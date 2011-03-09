<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!--
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19101875-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>-->
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.style-my-tooltips.js" type="text/javascript"></script>
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-my-tooltips.css" media="screen" />
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<script type="text/javascript">  
		$().ready(function() {  
			//applies to all elements with title attribute. Change to ".class[title]" to select only elements with specific .class and title
			$("[title]").style_my_tooltips({ 
				tip_follows_cursor: "on", //on/off
				tip_delay_time: 1000 //milliseconds
			});  
		});  
	</script>
	
	
	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id"logo">
			<img src="assets/logo.png" width="250" height="50"></img>
		</div>
		<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Popular Links', 'url'=>array('/post/popular')),
				array('label'=>'Latest Links', 'url'=>array('/post/latest')),
				array('label'=>'Add new link', 'url'=>array('/post/add'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Blogshop List', 'url'=>array('/blogshop/list'),'visible'=>Yii::app()->user->isGuest),							
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login/Signup', 'url'=>array('/site/openIDLogin'), 'visible'=>Yii::app()->user->isGuest),				
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)				
			),
		)); ?>
		</div><!-- mainmenu -->
	</div><!-- header -->
	
	<div id="logoBox">		
		<!-- <span id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></span>-->
		<!--<img id="biglogin" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/login.png" title="You can log in if you have a Google, Yahoo, Facebook or any OpenID Account!"/>-->
	</div>

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by ipostishop.com.<br/>
		All Rights Reserved.<br/>
		<!-- <?php echo Yii::powered(); ?>-->
	</div><!-- footer -->
	
</div><!-- page -->

</body>
</html>
