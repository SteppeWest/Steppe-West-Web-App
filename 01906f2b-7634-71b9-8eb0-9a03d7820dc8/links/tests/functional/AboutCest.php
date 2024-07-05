<?php

namespace links\tests\functional;

use links\tests\FunctionalTester;

class AboutCest
{
	public function checkAbout(FunctionalTester $I)
	{
		$I->amOnRoute('site/about');
		$I->see('About', 'h1');
	}
}
