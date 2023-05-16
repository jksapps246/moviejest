<?php

class MovieDetails extends JsonDeserializer{
	public bool $adult;
	public ?string $backdrop_path;
	public ?array $belongs_to_collection;
	public ?int $budget;
	/** @var Genres[] */
	public ?array $genres;
	public ?string $homepage;
	public ?int $id;
	public ?string $imdb_id;
	public ?string $original_language;
	public ?string $original_title;
	public ?string $overview;
	public ?float $popularity;
	public ?string $poster_path;
	/** @var ProductionCompanies[] */
	public ?array $production_companies;
	/** @var ProductionCountries[] */
	public ?array $production_countries;
	public ?string $release_date;
	public ?int $revenue;
	public ?int $runtime;
	/** @var SpokenLanguages[] */
	public ?array $spoken_languages;
	public ?string $status;
	public ?string $tagline;
	public ?string $title;
	public ?bool $video;
	public ?float $vote_average;
	public ?int $vote_count;

	/**
	 * @param Genres[] $genres
	 * @param ProductionCompanies[] $productionCompanies
	 * @param ProductionCountries[] $productionCountries
	 * @param SpokenLanguages[] $spokenLanguages
	 
	*/
}
?>