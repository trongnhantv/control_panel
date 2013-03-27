<?php

include 'bin/verify.php';
//refresh the session to reflect user

require_once "bin/user.php";
require_once "bin/puzzle.php";
include 'template/header.php';
echo '<h3 class="tit">Puzzle Preference</h3>';

//select all puzzle from database
$db = new MGDatabase();
$cursor = $db-> find("puzzles", array ());
foreach ($cursor as $doc)
{
    $puzzles[] = new Puzzle($doc);
}

//get user preference
$preference = $user->get_preference();

//create a group of rows foreach type, if puzzle is currently in client preference then set checkbox value to yes
$crypto_html ='';
$cursor = $db-> find("puzzles", array ('type'=> 'crypto'));
foreach ($cursor as $doc)
{
    $crypto_obj = new Puzzle($doc);
    //check if the puzzle exists in user preference
    if( in_array($crypto_obj->id,$preference))
        $exist = 'checked';
    else
        $exist ='';
    $crypto_html.=" <tr>
               <td>
                   <input type='checkbox' name='ids[$crypto_obj->id]' $exist/>
               </td>
               <td>
                   <span>$crypto_obj->name</span>
               </td>
           </tr>";
}

//insert each group into the table
?>
<script src="js/preference.js"></script>
<div class="preference_table" method="post">
    <form action="<?php  echo $_SERVER['PHP_SELF'];?>" method="POST" id="preference_form" >

        <h2>Cryptographic Puzzle</h2>
        <table class="nostyle">
            <?php echo $crypto_html ?>
        </table>
<!--        useful Puzzle-->
<!--        <h2>Useful puzzle Puzzle</h2>-->
<!--        <table class="nostyle">-->
<!--         <tr>-->
<!--             <td> <input type="checkbox" name="useful" checked></td>-->
<!--             <td>Fish Counting</td>-->
<!--         </tr>-->
<!--         <tr>-->
<!--             <td> <input type="checkbox" name="useful" checked></td>-->
<!--             <td>Image Cropping <span class = 'star' style="color:red">*</span></td>-->
<!--         </tr>-->
<!--            <tr>-->
<!--                <td> <input type="checkbox" name="useful" checked ></td>-->
<!--                <td>Captcha  <span class = 'star'  style="color:red">*</span></td>-->
<!--            </tr>-->
<!--        </table>-->
        <br />
        <input type="hidden" name="uid" value="<?php echo $user->id ?>">
        <input type="submit" value="Submit">
    </form>
    <br />
<!--    <span class = 'star' style="color:red">*</span> <span style="color :green">Puzzle requires user's interaction</span>-->
</div>
<?php
//echo '<p >API_KEY: '.$user->api.'</p>';
//echo '<p >Private key: '.$user->private_key.'</p>';
include 'template/footer.php';
?>
