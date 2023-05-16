<?php
class PosterSet extends JsonDeserializer {
	public ?int $page;
	/** @var Results[] */
	public ?array $results;
	public ?int $totalPages;
	public ?int $totalResults;

	/**
	 * @param Results[] $results

	*/
}

?>