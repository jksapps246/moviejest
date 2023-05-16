<?php
class TheCast extends JsonDeserializer {
	public ?int $id;
	/** @var Cast[] */
	public ?array $cast;
	/** @var Crew[] */
	public ?array $crew;
}
?>