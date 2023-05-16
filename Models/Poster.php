<?php
class Poster
{
	public ?bool $adult;
	public ?string $backdrop_path;
	public ?int $id;
	public ?string $title;
	public ?string $original_language;
	public ?string $original_title;
	public ?string $overview;
	public ?string $poster_path;
	public ?string $media_type;
	/** @var int[] */
	public ?array $genre_ids;
	public ?float $popularity;
	public ?string $release_date;
	public bool $video;
	public float|int $vote_average;
	public ?int $vote_count;

	/**
	 * @param int[] $genreIds
	 */
}

?>