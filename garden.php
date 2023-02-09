<?php

#error_reporting(0);

class Garden {
    private $apples = [];
    private $pears = [];
    private $data = [];
    private $gardenTreeTypes = ['apple', 'pear'];

    //initialize trees
    public function initializeTrees() 
    {
        try {
            if (file_exists('trees.txt')) {
                $this->data = explode("\n", strtolower(file_get_contents('trees.txt')));
                foreach($this->data as $tree) {
                    if (str_contains($tree, 'apple')) {
                        $this->apples[explode(':', $tree)] = rand(40, 50); 
                        continue;
                    }
                    var_dump(explode(':', $tree));
                    $this->pears[explode(':', $tree)] = rand(0, 20);
                }
            }
        } catch (Exception) {
            echo json_encode(array('error' => true, 'message' => 'there is no trees in garden'));
        }

        #var_dump($this->apples);
    }

    //add tree
    public function addTree(String $treeType)
    {
        if (in_array($treeType, $this->gardenTreeTypes)) {
            $newTreeHash = hash("sha256", time());

            file_put_contents('trees.txt', $treeType.':'.$newTreeHash."\n", FILE_APPEND);

            echo json_encode(array('error' => false, 'message' => 'ok'));
            
            unset($this->apples);
            unset($this->pears);

            $this->initializeTrees();
            
            die();
        }

        echo json_encode(array('error' => true, 'message' => 'not supported type of tree'));
    }

    //get all
    public function getAllTrees() 
    {

    }

    public function countTreesByType()
    {

    }
}

$test = new Garden();
$test->initializeTrees();
$test->addTree('apple');