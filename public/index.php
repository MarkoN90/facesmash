<?php 

require_once '../classes/Database.php';
require_once '../classes/Contender.php';
require_once '../classes/Game.php';

list($contender1, $contender2) = (new Contender)->getRandomContenders();

if(isset($_GET['winner']) && isset($_GET['loser'])) {

    $winner = Contender::findById($_GET['winner']);
    $loser  = Contender::findById($_GET['loser']);

    $game = new Game($winner, $loser);
    $game->score();
}

?>

<!doctype html>
<html>

<head>
    <title>Facesmash</title>
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="main-header">
        <h1 class="text-center">FACESMASH</h1>
    </div>
    <main>
        <h4 class="text-center p-2">Where we let in for our looks? No. Will we be judged on them? Yes. </h4>
        <h3 class="text-center p-2">Who's Hotter? Click to Choose.</h3>
        <div class="choice-wrapper">
            <div id="image-wrapper">
                <div class="image-wrapper">
                    <a href="index.php?winner=<?= $contender1->id; ?>&loser=<?= $contender2->id; ?>">
                      <img src="<?php echo 'img/'.$contender1->image; ?>">
                    </a>
                    <span class="contender-info"><?= $contender1->name; ?> (<?= $contender1->rating; ?>)</span>
                </div>
                <div id="choice-separator" class="p-1">OR</div>
                <div class="image-wrapper">
                  <a href="index.php?winner=<?= $contender2->id; ?>&loser=<?= $contender1->id; ?>">
                    <img src="<?php echo 'img/'.$contender2->image; ?>">
                  </a>
                  <span class="contender-info"><?= $contender2->name; ?> (<?= $contender2->rating; ?>)</span>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>