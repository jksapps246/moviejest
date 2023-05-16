<?php
class ActorDetails extends JsonDeserializer{
	public bool $adult;
	/** @var string[] */
	public ?array $also_known_as;
	public ?string $biography;
	public ?string $birthday;
	public $deathday;
	public ?int $gender;
	public $homepage;
	public ?int $id;
	public ?string $imdb_id;
	public ?string $known_for_department;
	public ?string $name;
	public ?string $place_of_birth;
	public ?float $popularity;
	public ?string $profile_path;
}
?>