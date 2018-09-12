<?php

class FeaturedFeedItem extends FeedItem {
	public function __construct( $title, $url, $text, $date ) {
		parent::__construct( $title, $text, $url, $date );
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
}
