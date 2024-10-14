<?php

namespace letter\tests\functional;

use letter\tests\FunctionalTester;

class AboutCest
{
	public function checkAbout(FunctionalTester $I)
	{
		$I->amOnRoute('site/about');
		$I->see('About', 'h1');
	}
}
