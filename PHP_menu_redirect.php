<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Menu Redirect</title>
</head>
<body>
  
    <h1>Squaresoft Games</h1>
    <form action="" method="post">
        <select name="link">
           <option value="https://ffvii-remake.square-enix-games.com/en-us/buy-now-landing?utm_source=1075394506&utm_medium=1080387967&utm_campaign=ffviir_amz_01_GoogleSearch_liquid&utm_term=0-FFVIIRLaunch-0-TextAd-SEMLCopy01-BuyNow-US">Final Fantasy 7 (remake)</option>
           <option value="https://finalfantasy.fandom.com/wiki/Final_Fantasy_Tactics">Final Fantasy Tactics</option>
           <option value="https://finalfantasy.fandom.com/wiki/Final_Fantasy_VI">Final Fantasy 6</option>
           <option value="https://finalfantasy.fandom.com/wiki/Final_Fantasy_VIII">Final Fantasy 8</option>
           <option value="https://mana.fandom.com/wiki/Secret_of_Mana">Secret of Mana</option>
           <option value="https://secretofevermore.fandom.com/wiki/Secret_of_Evermore">Secret of Evermore</option>
            </select>
        <input type="submit" name="redirect" value="GO" />
    </form>
    
     <?php 
        if(isset($_POST['redirect'])){
            header('Location: '.$_POST['link']);
            exit;
        }
    ?>
</body>
</html>