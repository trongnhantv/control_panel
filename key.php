<?php
include 'bin/verify.php';
//file that change user preference require this line
include 'template/header.php';
?>
<script src="js/change_key.js"></script>
<h3 class="tit">Keys</h3>
<span style='width:70px; display: block;float: left'>Api key</span> <input type='text' value='<?php echo $user->id?>' size='30' readonly style='padding-left: 10px'><br />
<span style='width:70px; display: block;float: left'>Private key</span> <input type='text' id="private_key" value='<?php echo $user->private_key?>' size='30' readonly style='padding-left: 10px'>
<input type="hidden" id='uid' value='<?php echo $user->id ?>'>
<input type='button' id='change' value='Request new key'>
<br />
<div id="holder"></div>
<?php include 'template/footer.php';?>

