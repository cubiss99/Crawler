<?php
require_once('Parser.php');
class DantriParser extends Parser
{
    public $website = 'Dân trí';
    public $domString = [
        'title' => "//h1[@class='dt-news__title']",
        'description' => "//div[@class='dt-news__sapo']/h2",
        'date' => "//span[@class='dt-news__time']",
        'category' => "//ul[@class='dt-breadcrumb']/li[position() > 1]",
        'content' => "//div[@class='dt-news__content']",
    ];
}
