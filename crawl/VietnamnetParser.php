<?php
require_once('Parser.php');
class VietnamnetParser extends Parser
{
    public $website = 'Vietnamnet';
    public $domString = [
        'title' => "//h1[@class='title f-22 c-3e']",
        'description' => "//div[@class='bold ArticleLead']/p",
        'date' => "//span[@class='ArticleDate']",
        'category' => "//div[@class='top-cate-head-title']/a",
        'content' => "//div[@id='ArticleContent']/p",
    ];
}