<?php


    function getAdjective(){
        $adjectives = file("adjectives.txt");
        
        $filesize = 0; 

        foreach($adjectives as $line){
            $filesize++;
        }
        
        $num = rand(0,$filesize);
        $word;
        $linenum = 0;
    
        foreach($adjectives as $line){
            if($linenum == $num){
                $word = $line;
                break;
            }
            else{
                $linenum++;
            }
        }
        return $word;
    }

    function getLocation(){
        $location = file("locations.txt");
        
        $filesize = 0; 

        foreach($location as $line){
            $filesize++;
        }
        
        $num = rand(0,$filesize);
        $word;
        $linenum = 0;
    
        foreach($location as $line){
            if($linenum == $num){
                $word = $line;
                break;
            }
            else{
                $linenum++;
            }
        }
        return $word;
    }
    
    function getQuirk(){
        $quirk = file("quirks.txt");

        $filesize = 0; 
        
        foreach($quirk as $line){
            $filesize++;
        }
        
        $num = rand(0,$filesize);
        $word;
        $linenum = 0;
    
        foreach($quirk as $line){
            if($linenum == $num){
                $word = $line;
                break;
            }
            else{
                $linenum++;
            }
        }
        return $word;
    }

    function rollDie($d){
        $die = rand(1, $d);
        return $die;
    }

    function getRace(){
        $races = array("Dragonborn", "Dwarf", "Elf", "Gnome", "Half-Elf", "Halfling", "Half-Orc", "Human", "Tiefling");
        $num = rand(0, count($races)-1);
        return $races[$num];
    }

    function getClass(){
        $classes = array("Barbarian", "Bard", "Cleric", "Druid", "Fighter", "Monk", "Paladin", "Ranger", "Rogue", "Sorcerer", "Warlock", "Wizard");
        $num = rand(0, count($classes)-1);
        return $classes[$num];
    }

    function rollStats($race){
        $stats = array_fill(0, 0, 0);
        for($i= 0; $i<6; $i++){
            $dTotal = 0;
            $dRolled = array_fill(0, 0, 0);

            for($j=0; $j<4; $j++){
                $d6 = rollDie(6);
                $dTotal += $d6;
                array_push($dRolled, $d6);
            }
            $dTotal -= min($dRolled);
            array_push($stats, $dTotal);
        }

        switch($race){
            case "Dragonborn":
                $stats[0] += 2;
                $stats[4] += 1;
                break;
            case "Dwarf":
                $stats[1] += 2;
                break;
            case "Elf":
                $stats[2] += 2;
                break;
            case "Gnome":
                $stats[5] += 2;
                break;
            case "Half-Elf":
                $stats[4] += 2;
                $stats[rand(0, count($race)-1)] += 1;
                $stats[rand(0, count($race)-1)] += 1;
                break;
            case "Halfling":
                $stats[2] += 2;
                break;
            case "Half-Orc":
                $stats[0] += 2;
                $stats[1] += 1;
                break;
            case "Human":
                foreach($stats as $stat){
                    $stat += 1;
                }
                break;
            default:
                $stats[4] += 2;
                $stats[5] += 1;
                break;

        }

        

        return $stats;
    }

    function getStatPriority(){
        $statPriority = array("Str", "Con", "Dex", "Wis", "Cha", "Int");
        return $statPriority;
    }

    function getFirstName(){
        $firstName = file("humanMaleFirstNames.txt");
        
        $filesize = 0;

        foreach($firstName as $line){
            $filesize++;
        }
        
        $num = rand(1,$filesize);
        $word;
        $linenum = 0;
    
        foreach($firstName as $line){
            if($linenum == $num){
                $word = $line;
                break;
            }
            else{
                $linenum++;
            }
        }
        return $word;
    }

    function getLastName(){
        $lastName = file("humanSurnames.txt");
        
        $filesize = 0;

        foreach($lastName as $line){
            $filesize++;
        }
        
        $num = rand(1,$filesize);
        $word;
        $linenum = 0;
    
        foreach($lastName as $line){
            if($linenum == $num){
                $word = $line;
                break;
            }
            else{
                $linenum++;
            }
        }
        return $word;
    }

    function getAlignment(){
        $alignmentArray = array('Chaotic Evil', 'Chaotic Neutral', 'Chaotic Good', 'Neutral', 'Neutral Good', 'Neutral Evil','Lawful Neutral', 'Lawful Evil', 'Lawful Good');
        $num = rand(0, count($alignmentArray)-1);
        return $alignmentArray[$num];
    }
    

    function getModifiers($stats){
        $modifiers = array_fill(0,0,0);
        foreach($stats as $val){

            switch($val){
                case 2:
                case 3:
                    $mod = -4;
                    break;
                case 4:
                case 5:
                    $mod = -3;
                    break;
                case 6:
                case 7:
                    $mod = -2;
                    break;
                case 8:
                case 9:
                    $mod = -1;
                    break;
                case 10:
                case 11:
                    $mod = 0;
                    break;
                case 12:
                case 13:
                    $mod = 1;
                    break;
                case 14:
                case 15:
                    $mod = 2;
                    break;
                case 16:
                case 17:
                    $mod = 3;
                    break;
                case 18:
                case 19:
                    $mod = 4;
                    break;
                default:
                    $mod = 5;
                    break;
            }
          
            array_push($modifiers, $mod);

        }

        return $modifiers;
    }


    function getHP($class, $modifiers){
        $d = 0;
        if(($class == "Wizard") || ($class == "Sorcerer")){
            $d = 6;
        }
        elseif(($class == "Monk") || ($class == "Warlock") || ($class == "Druid") || ($class == "Cleric") || ($class == "Bard") || ($class == "Rogue")){
            $d = 8;
        }
        elseif(($class == "Ranger") || ($class == "Fighter") || ($class == "Paladin")){
            $d = 10;
        }
        else{
            $d = 12;
        }
        $d += $modifiers[1];
        return $d;
    }

    function getInitiative($modifiers){
        return $modifiers[2];
    }

    function getPassivePerception($modifiers){
        return 10 + $modifiers[3];
    }

    $adj = getAdjective();
    $race = getRace();
    $class = getClass();
    $loc = getLocation();
    $quirk = getQuirk();
    $stats = rollStats($race);
    $statPriority = getStatPriority();
    $firstName = getFirstName();
    $lastName = getLastName();
    $alignment = getAlignment();
    $modifiers = getModifiers($stats);
    $HP = getHP($class, $modifiers);
    $initiative = getInitiative($modifiers);
    $PP = getPassivePerception($modifiers);
 
    


    echo "<h1>You are a: $adj $race $class named '$firstName $lastName' from $loc who $quirk</h1>";

    echo "<h2> YOUR STATS: </h2>";


    for($i=0; $i<count($stats); $i++){
        echo "<p>$statPriority[$i] : $stats[$i] ($modifiers[$i])</p>";
    }
    
    echo "<p>Alignment: $alignment</p>";
    echo "<p>HP: $HP</p>";
    echo "<p>Initiative: $initiative</p>";
    echo "<p>Passive Perception: $PP</p>";
    

    ?>
    <div id="scores">
        <?php
            echo "<p>Acrobatics: $modifiers[2],</p>";
            echo "<p>Animal Handling: $modifiers[3],</p>";
            echo "<p>Arcana: $modifiers[5],</p>";
            echo "<p>Athletics: $modifiers[0],</p>";
            echo "<p>Deception: $modifiers[4],</p>";
            echo "<p>History: $modifiers[5],</p>";
            echo "<p>Insight: $modifiers[3],</p>";
            echo "<p>Intimidation: $modifiers[4],</p>";
            echo "<p>Investigation: $modifiers[5],</p>";
            echo "<p>Medicine: $modifiers[3],</p>";
            echo "<p>Nature: $modifiers[5],</p>";
            echo "<p>Perception: $modifiers[3],</p>";
            echo "<p>Performance: $modifiers[4],</p>";
            echo "<p>Persuasion: $modifiers[4],</p>";
            echo "<p>Religion: $modifiers[5],</p>";
            echo "<p>Sleight of Hand: $modifiers[2],</p>";
            echo "<p>Stealth: $modifiers[2],</p>";
            echo "<p>Survival: $modifiers[3],</p>";
        ?>
    </div>

<?php

    // NEED TO CALCULATE HP AND ADD THAT ON.
    // ADD THE PLUS MODIFIER TO STATS
    // CREATE ALIGNMENT
    // ADD RACE TRAITS
    // ADD INITIATIVE
    // COULD MAYBE MAYBE ADD AC
    // ADD ANIMATION TO THE RESULT DIV WHEN BUTTON CLICKED

?>


