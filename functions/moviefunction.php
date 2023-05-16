<?php
    include "API/class-Fetch.php";

    $backdropPath = "";
    $movieTitle = "";
    $releaseDate = "";
    $runtime = "";
    $voteAverage = "";
    $overview = "";
    $posterPath = "";
    $genres = array();
    $max_cost = 8;
    $castImgs = array();
    $castNames = array();
    $castIDs = array();
    $videos = array();
    $videoNames = array();
    $videoKey = "";
    $api_get = new Fetch();
    $movieID = $_GET['movieID'];
    GetMovie($movieID);

    function GetMovie($id) {
        global $backdropPath, $movieTitle,$releaseDate,$runtime,$voteAverage,$overview,$posterPath,$genres,$max_cast,$castImgs,$castNames,$castIDs,$videos,$videoNames,$videoKey,$videoKeySelect,$api_get;

        $api_get->MovieDetails($id);

        // Movie Details
        $backdropPath = "https://image.tmdb.org/t/p/w1920_and_h800_multi_faces" . $api_get->movie->backdrop_path;
        $movieTitle = $api_get->movie->title;
        $releaseDate = $api_get->movie->release_date;
        $runtime = $api_get->movie->runtime;
        $voteAverage = number_format(($api_get->movie->vote_average), 1, '.', '')."%";
        $posterPath = $api_get->movie->poster_path;
        if($posterPath == null) {
            $posterPath = "inc/images/moviePoster.png";
        }
        else {
            $posterPath = "https://image.tmdb.org/t/p/w500" . $posterPath;
        }
        $overview = $api_get->movie->overview;
        
        //clear garbage from overview
        if(strstr($overview, "Server :",false)){
            $overview = substr($overview,0,strpos($overview, "Server :"));
        }
        
        for($i = 0; $i < count($api_get->movie->genres); $i++) {
            $genres[$i] = $api_get->movie->genres[$i]['name'];
        }

        // Cast Details       
        for($i = 0; $i < count($api_get->theCast->cast); $i++) {
            $castImgs[$i] = $api_get->theCast->cast[$i]['profile_path'];
            $castNames[$i] = $api_get->theCast->cast[$i]['name'];
            $castIDs[$i] = $api_get->theCast->cast[$i]['id'];
        
        }
       
        //get trailer
        for($i = 0; $i < count($api_get->videoSet->results); $i++) {
            $videos[$i] = $api_get->videoSet->results[$i]['key'];
            $videoNames[$i] = $api_get->videoSet->results[$i]['name'];
                        
        }
        for($i =0; $i < count($videos); $i++){
            if($videoNames[$i] == "Official Trailer"){
                $videoKey = $videos[$i];
            }
            else {
                $videoKey = $videos[0];
            }
        }
        
    } // OnGet()

    function GetCast($actorID) {
        header("Location: Actor.php?actorID=" . $actorID);
    }
    function Trailer($vid) {
        global $videoKey;
        $videoKey = $vid;
    }
?>