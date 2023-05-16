<?php
    include "API/class-Fetch.php";

    const max_results = 9;
    $posterURLS = array();
    $backdropURLS = array();
    $overviews = array();
    $movieIDS = array();
    $releaseDate = array();
    $movieTitle = array();
    $movieLanguage = array();
    $genres = array();
    $defaultDate = "";
    $defaultTitle = "";
    $defaultLang = "";
    $defaultBio = "";
    $searchTitle= "";
    $defaultBackdrop= "";
    $pathBK = "";
    $searchR = false;
    $get_api = new Fetch(); 
    
    GetTrends();
    
    function GetTrends(){
        global $posterURLS,$backdropURLS,$overviews,$movieIDS,$releaseDate,
        $movieTitle,$movieLanguage,$defaultDate,$defaultTitle,$defaultLang,
        $defaultBio,$searchTitle,$defaultBackdrop,$pathBK,$searchR,$genres,$get_api;

        $get_api->GetTrends("","","");//default
        $searchTitle = "Latest Movies:"; 
        getData($get_api->posterSet->results);

        //get genres
        for($i =0; $i < count($get_api->genreSet->genres); $i++){
            $genres[$i]=$get_api->genreSet->genres[$i];
        }


        if(count($posterURLS) == 0){
            $pathBK = "inc/images/moviePoster.png";
        }
        else {
            $pathBK = "https://image.tmdb.org/t/p/w500" . $posterURLS[0];
            $defaultDate = $releaseDate[0];
            $defaultLang = $movieLanguage[0];
            $defaultTitle = $movieTitle[0];
            $defaultBio = $overviews[0];
            $defaultBackdrop = $backdropURLS[0];
            $searchR = false;        
        }            
    }
    function Search($search) {
        global $posterURLS,$backdropURLS,$overviews,$movieIDS,$releaseDate,$movieTitle,
        $movieLanguage,$defaultDate,$defaultTitle,$defaultLang,$defaultBio,$searchTitle,
        $defaultBackdrop,$pathBK,$searchR,$get_api;

        $get_api->Search($search);
        $searchTitle = "Search Results: " . $search;    
        getData($get_api->posterSet->results);

        if(count($movieIDS) > 0) {
            $defaultDate = $releaseDate[0];
            $defaultLang = $movieLanguage[0];
            $defaultTitle = $movieTitle[0];
            $defaultBio = $overviews[0];
            $defaultBackdrop = $backdropURLS[0];
            $searchR = false;         
        }
        $searchR = true;
    }
    function Filter($cat,$type,$genre) {
        global $posterURLS,$backdropURLS,$overviews,$movieIDS,$releaseDate,$movieTitle,
        $movieLanguage,$defaultDate,$defaultTitle,$defaultLang,$defaultBio,$searchTitle,
        $defaultBackdrop,$pathBK,$searchR,$get_api,$genres;

        $get_api->GetTrends($cat,$type,$genre);
        switch($cat){

            case"LATEST":{
                $searchTitle = "Latest Movies: ";
                break;
            }
            case "THEATERS":{
                $searchTitle = "In Theaters: ";
                break;
            }
            case "ALL":{
                $searchTitle = "All Movies: ";
                break;
            }
            case "TV":{
                $searchTitle = "TV Shows: ";
                break;
            }
            default:{
                $searchTitle = "Latest Movies: ";
                break;
            }
        }
         
        switch($type){
            case "KIDS":{
                $searchTitle = $searchTitle . "Kids: ";
                break;
            }
            case "TEENS":{
                $searchTitle = $searchTitle . "Teens: ";
                break;
            }
            case "ADULTS":{
                $searchTitle = $searchTitle . "Adults: ";
                break;
            }
            default:{
                break;
            }
        }

        //add genre
        if ($genre != ""){
            for($i = 0; $i < count($genres); $i++){
                if($genres[$i]['id'] == $genre ){
                    $searchTitle = $searchTitle . $genres[$i]['name'] . ":";
                }
            }
            
        }
        getData($get_api->posterSet->results);
        /*
        switch($type){
            case "KIDS": {
                $searchTitle = "Latest Kids Movies:";
                getData($get_api->posterSetKids->results);
                break;
            }
            case "TEENS": {
                $searchTitle = "Latest Teens Movies:";
                getData($get_api->posterSetTeens->results); 
                break;
            }
            case "ADULTS": {
                $searchTitle = "Latest Adults Movies:";
                getData($get_api->posterSetAdults->results); 
                break;
            }
            default: {
                $searchTitle = "Latest Movies:";
                getData($get_api->posterSet->results);
                break;
            }
        }*/


        if(count($movieIDS) > 0) {
            $defaultDate = $releaseDate[0];
            $defaultLang = $movieLanguage[0];
            $defaultTitle = $movieTitle[0];
            $defaultBio = $overviews[0];
            $defaultBackdrop = $backdropURLS[0];
                     
        }
        $searchR = false;
    }

    function getData($posterSetResults){
        global $posterURLS,$backdropURLS,$overviews,$movieIDS,$releaseDate,
        $movieTitle,$movieLanguage;

        for($i = 0; $i < count($posterSetResults); $i++) {
            $posterURLS[$i]= $posterSetResults[$i]['poster_path'];
            $backdropURLS[$i]=$posterSetResults[$i]['backdrop_path'];
            $overviews[$i]=$posterSetResults[$i]['overview'];
            //clear garbage from overview
            if(strstr($overviews[$i], "Server :",false)){
                $overviews[$i] = substr($overviews[$i],0,strpos($overviews[$i], "Server :"));
            }
            $movieIDS[$i]=$posterSetResults[$i]['id'];
            $releaseDate[$i]=$posterSetResults[$i]['release_date'];
            $movieTitle[$i]=$posterSetResults[$i]['title'];
            if ($posterSetResults[$i]['original_language'] == "en")
                $movieLanguage[$i]= "English";
            else
                $movieLanguage[$i]=$posterSetResults[$i]['original_language'];
        } 
    }
    function Movie($movieID){
       header("location: Movie.php?movieID=". $movieID);
    }
?>