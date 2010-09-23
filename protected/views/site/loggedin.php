<div>
<?php 
echo $openid->getName().'<br>';
echo $openid->getIdentity().'<br>';
echo $openid->getAttributes().'<br>';
echo sizeof($openid->getAttributes()).'<br>';
foreach($openid->getAttributes() as $i){
	echo $i.'<br>';
}
?>
</div>