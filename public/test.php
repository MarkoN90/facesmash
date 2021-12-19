<?php

require_once '../classes/Contender.php';


class Priznanica {

    public $hello = 'hello';


    public function howMany() {
        var_dump($this);
    }

}



(new Priznanica())->howMany();

$contender = Contender::findById(5);

$contender->save();

