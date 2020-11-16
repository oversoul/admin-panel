<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use Aecodes\AdminPanel\Widgets\Fields\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{

	/** @test */
	public function canCreateImage()
	{
		$input = Image::make('image')->title('Avatar')->build([]);
		$this->assertArrayHasKey('type', $input);
		$this->assertEquals('Image', $input['type']);
		$this->assertEquals('Avatar', $input['title']);
	}

	/** @test */
	public function canHaveItAcceptMultipleImages()
	{
		$input = (new Image('image'))->title('Image')->multiple()->build([]);
		$this->assertTrue($input['multiple']);
	}
}
