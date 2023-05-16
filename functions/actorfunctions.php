<?php
include "API/class-Fetch.php";

    $alsoKnownAs = array();
    $biography = "";
    $birthday = "";
    $age = "";
    $gender = "";
    $knownForDepartment = "";
    $name = "";
    $placeOfBirth = "";
    $profilePath = "";
    //profile  
    $profileImages = array();
    $profileSize = array();
    $knownCredits = "";
    //cast movies
    $videoPaths = array();
    $videoTitles = array();
    $videoIds = array();
    $MAX_VID;
    $bio_limit;
    $api_get = new Fetch();
    $actorID = $_GET['actorID'];
    GetActor($actorID);

    function GetActor($actorID) {
        global $api_get,$alsoKnownAs,$biography,$birthday,$age,$gender,$knownForDepartment,$name,$placeOfBirth,$profilePath,$profileImages,$profileSize,$knownCredits,$videoPaths,$videoTitles,$videoIds,$bio_limit;
        $api_get->ActorDetails($actorID);

        //Cast Details
        $bio_limit = 1290;
        $biography = $api_get->actorDetails->biography;
        $birthday = $api_get->actorDetails->birthday;
        if($birthday != null){
            $today = date("Y-m-d");
            $diff = date_diff(date_create($birthday), date_create($today));
            $age = "( ".$diff->format('%y'). " years old )";
        }

        if($api_get->actorDetails->gender == 1)
            $gender = "Female";        
        else if($api_get->actorDetails->gender == 2)
            $gender = "Male";
        else 
            $gender = "n/a";

        $knownForDepartment = $api_get->actorDetails->known_for_department;
        $name = $api_get->actorDetails->name;
        $placeOfBirth = $api_get->actorDetails->place_of_birth;
        if ($api_get->actorDetails->profile_path == null) {
            $profilePath = "/inc/images/actorPoster.png";
        }
        else {
            $profilePath = "https://www.themoviedb.org/t/p/w300_and_h450_bestv2" . $api_get->actorDetails->profile_path;
        }

        for($i = 0; $i < count($api_get->actorDetails->also_known_as); $i++){
            $alsoKnownAs[$i] = $api_get->actorDetails->also_known_as[$i];
        }
        //cast videos
        $knownCredits = count($api_get->castVideoSet->cast);

        for($i = 0; $i < $knownCredits; $i++) {
            $videoPaths[$i] = $api_get->castVideoSet->cast[$i]['poster_path'];
            $videoTitles[$i] = $api_get->castVideoSet->cast[$i]['title'];           
            $videoIds[$i] = $api_get->castVideoSet->cast[$i]['id']; 
                      
        }

        //profile images        
        for($i = 0; $i < count($api_get->profileSet->profiles); $i++) {
             if($api_get->profileSet->profiles[$i]['file_path'] != null){
                $profileImages[$i] = $api_get->profileSet->profiles[$i]['file_path'];
                $profileSize[$i] = $api_get->profileSet->profiles[$i]['width'] . " x " .         
                $api_get->profileSet->profiles[$i]['height'];       
             }    
        }
    }
    function GetMovie($movieID) {
        header("Location: Movie.php?movieID=" . $movieID);
    }
?>