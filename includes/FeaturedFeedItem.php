<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use MediaWiki\Feed\FeedItem;

class FeaturedFeedItem extends FeedItem {
	public function __construct( string $title, string $url, string $text, string $date ) {
		parent::__construct( $title, $text, $url, $date );
	}

	public static function fromArray( array $array ): self {
		return new self(
			$array['title'],
			$array['url'],
			$array['text'],
			$array['date']
		);
	}

	public function getRawDate() {
		return $this->date;
	}

	public function getRawTitle() {
		return $this->title;
	}

	public function getRawUrl() {
		return $this->url;
	}

	public function getRawText() {
		return $this->description;
	}

	public function toArray(): array {
		return [
			'title' => $this->title,
			'url' => $this->url,
			'text' => $this->description,
			'date' => $this->date,
		];
	}
}
