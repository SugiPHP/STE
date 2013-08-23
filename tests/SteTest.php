<?php
/**
 * @package    SugiPHP
 * @subpackage STE
 * @category   tests
 * @author     Plamen Popov <tzappa@gmail.com>
 * @license    http://opensource.org/licenses/mit-license.php (MIT License)
 */

namespace SugiPHP\STE;

class SteTest extends \PHPUnit_Framework_TestCase
{
	public function testOneParam()
	{
		$tpl = new Ste();
		$tpl->setTemplate('<h1>{title}</h1>');
		$this->assertSame("<h1>{title}</h1>", $tpl->getTemplate());
		$this->assertSame("<h1></h1>", $tpl->parse());
		$this->assertSame("<h1>{title}</h1>", $tpl->getTemplate());
		$tpl->set("title", "SugiPHP");
		$this->assertSame("<h1>SugiPHP</h1>", $tpl->parse());
		$this->assertSame("<h1>{title}</h1>", $tpl->getTemplate());
		$tpl->set("title", "foo");
		$this->assertSame("<h1>foo</h1>", $tpl->parse());
	}

	public function testBlock()
	{
		$tpl = new Ste();
		$tpl->setTemplate('<!-- BEGIN block1 --><h1>{title}</h1><!-- END block1 -->');
		$this->assertSame("<h1></h1>", $tpl->parse());
		$tpl->set("title", "foo");
		$this->assertSame("<h1>foo</h1>", $tpl->parse());
		$tpl->hide("block1");
		$this->assertSame("", $tpl->parse());
		$tpl->unhide("block1");
		$this->assertSame("<h1>foo</h1>", $tpl->parse());
	}

	public function testArrayParams()
	{
		$tpl = new Ste();
		$tpl->setTemplate('<h1><a href="{title.href}">{title}</a></h1>');
		$tpl->set("title", "foo");
		$this->assertSame('<h1><a href="">foo</a></h1>', $tpl->parse());
		$tpl->set("title", array("foo", "href" => "/home"));
		$this->assertSame('<h1><a href="/home">foo</a></h1>', $tpl->parse());
		$tpl->set("title", array("bar" => "foo", "href" => "/home"));
		$this->assertSame('<h1><a href="/home">foo</a></h1>', $tpl->parse());

		$tpl->setTemplate('<h1><a href="{title.href}">{title}</a></h1>');
		$tpl->set("title", array("bar" => "foo", "href" => "/home"));
		$this->assertSame('<h1><a href="/home">foo</a></h1>', $tpl->parse());
	}
}
