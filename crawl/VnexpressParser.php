<?php
require_once('Parser.php');
class VnexpressParser extends Parser
{
    public $website = 'VnExpress';
    public $domString = [
        'title' => "//h1",
        'description' => "//p[@class='description']/text()",
        'date' => "//span[@class='date']",
        'category' => "//ul[@data-campaign='Header']/li/a",
        'content' => "//article",
    ];
}
// $url = 'https://vnexpress.net/thai-nhi-song-sot-du-nhau-bong-non-4217917.html';
// $vnexpress = new VnexpressParser();
// $vnexpress->articleParser($url);
