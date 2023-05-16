<?php
require "Models/JsonDeserializer.php";
require('Models/MovieDetails.php');
require('Models/Poster.php');
require('Models/PosterSet.php');
require('Models/TheCast.php');
require('Models/VideoSet.php');
require('Models/ActorDetails.php');
require('Models/ProfileSet.php');
require('Models/CastVideoSet.php');
require('Models/Genre.php');

 class Fetch {
    public $api_key  = "5a3724cc34f4701bcebf039158f04dd3"; 
    public $url_base = "https://api.themoviedb.org/3"; 
    public $data; 
    public $posterSet; 
    public $posterSetKids; 
    public $posterSetTeens; 
    public $posterSetAdults; 
    public $movie;   
    public $theCast;   
    public $videoSet;   
    public $actorDetails;   
    public $castVideoSet;   
    public $profileSet;   
    public $genreSet;  
   

    public function __constructor(){

        $this->api_key = "5a3724cc34f4701bcebf039158f04dd3";
        $this->url_base = "https://api.themoviedb.org/3"; 
        $this->posterSet = new PosterSet(); 
        //$this->posterSetKids = new PosterSet(); 
        //$this->posterSetTeens = new PosterSet(); 
        //$this->posterSetAdults = new PosterSet(); 
        $this->movie = new MovieDetails();   
        $this->theCast = new TheCast();   
        $this->videoSet = new VideoSet();   
        $this->actorDetails = new ActorDetails();   
        $this->castVideoSet = new CastVideoSet();   
        $this->profileSet = new ProfileSet();   
        $this->genreSet = new Genre();   
    }
    
    function MovieDetails($movieID){   
        // Get the movie details        
        try {            
            $url = $this->url_base . "/movie/". $movieID ."?api_key=" . $this->api_key ."&language=en-US";
            $response = file_get_contents($url);
            
            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->movie = MovieDetails::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Next get the cast images for that movie       
        try {            
            $url = $this->url_base . "/movie/". $movieID ."/credits?api_key=" . $this->api_key;
            $response = file_get_contents($url);
            
            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->theCast = TheCast::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Get the video(s) for the movie        
        try {            
            $url = $this->url_base . "/movie/". $movieID ."/videos?api_key=" . $this->api_key;
            $response = file_get_contents($url);
            
            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->videoSet = VideoSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
    }
    function Search($search) {
        // Get the movie details        
        try {            
            $url = $this->url_base . "/search/movie?api_key=" .$this->api_key . "&page=1&query=" . $search;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->posterSet = PosterSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }

    }
    function GetTrends(?String $cat,?String $type,?String $genres) {
        
        $urls = "";
        $url_api = "api_key=" . $this->api_key;
        //categories
        $url_trends = "/trending/movie/week?";
        $url_latest = "/movie/latest?";
        $url_discover = "/discover/movie?";
        $url_tv = "/discover/tv?";
        $url_theaters = "/movie/now_playing?";
        //type
        $url_kids = "&certification=G";        
        $url_teens = "&certification=18A&include_adult=false";
        $url_adults = "&certification=A&include_adult=true";
        //genres
        $url_genres = "&with_genres=" . $genres;
        
        $url_popularity = "&sort_by=popularity.desc";
        $url_language = "&language=en-US&certification_country=CA";

        //building request url
        
        $urls = $this->url_base;      
        //add category
        switch($cat){

            case"LATEST":{
                $urls = $urls . $url_trends;
                break;
            }
            case "THEATERS":{
                $urls = $urls . $url_theaters;
                break;
            }
            case "ALL":{
                $urls = $urls . $url_discover;
                break;
            }
            case "TV":{
                $urls = $urls . $url_tv;
                break;
            }
            default:{
                $urls = $urls . $url_trends;
                break;
            }
        }
        //add api key
        $urls = $urls . $url_api;
        //add type
        switch($type){
            case "KIDS":{
                $urls = $urls . $url_kids;
                break;
            }
            case "TEENS":{
                $urls = $urls . $url_teens;
                break;
            }
            case "ADULTS":{
                $urls = $urls . $url_adults;
                break;
            }
            default:{
                break;
            }
        }
        //add genre
        if ($genres != ""){
            $urls = $urls . $url_genres;
        }
        //add popularity
        //$urls = $urls . $url_popularity;
        //add language
        $urls = $urls . $url_language;
        //echo $urls;

        // Gets the Movie trends for the last week(7 days)       
        try {            
            //$url = $this->url_base . "/trending/movie/week?api_key=" . $this->api_key;
            $response = file_get_contents($urls);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->posterSet = PosterSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
/*
        // Gets the Kids Movie trends for the last week(7 days)       
        try {            
            $url = $this->url_base . "/discover/movie?certification_country=US&language=en-US&certification=G&sort_by=popularity.desc&api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->posterSetKids = PosterSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Gets the Teens Movie trends for the last week(7 days)       
        try {            
            $url = $this->url_base . "/discover/movie?certification_country=US&certification=18A&sort_by=popularity.desc&api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->posterSetTeens = PosterSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Gets the Adults Movie trends for the last week(7 days)       
        try {            
            $url = $this->url_base . "/discover/movie?certification_country=US&certification=A&include_adult=true&sort_by=popularity.desc&api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->posterSetAdults = PosterSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }

*/

        // Gets the genres 
        try {            
            $urls = $this->url_base . "/genre/movie/list?api_key=" . $this->api_key;
            $response = file_get_contents($urls);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->genreSet = Genre::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }

    }
    function ActorDetails($actorID) {

        // Get the cast details
        // https://api.themoviedb.org/3/person/54693?api_key=5a3724cc34f4701bcebf039158f04dd3
        try {            
            $url = $this->url_base . "/person/". $actorID . "?api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->actorDetails = ActorDetails::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Next get the movies for that cast
        //https://api.themoviedb.org/3/person/2532098/combined_credits?api_key=5a3724cc34f4701bcebf039158f04dd3
        try {            
            $url = $this->url_base . "/person/". $actorID . "/movie_credits?api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->castVideoSet = CastVideoSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
        // Get the images(s) for the actor
        //https://api.themoviedb.org/3/person/6161/images?api_key=5a3724cc34f4701bcebf039158f04dd3
        try {            
            $url = $this->url_base . "/person/". $actorID . "/images?api_key=" . $this->api_key;
            $response = file_get_contents($url);

            if($response !== false){
                $this->data = json_decode($response,true);
                //add deserialize here
                $this->profileSet = ProfileSet::Deserialize($this->data);
            }
        }catch(Exception $e) {
            $this->data = null;
            echo $e->getMessage();
        }
    } // ActorDetails()
    
}
?>