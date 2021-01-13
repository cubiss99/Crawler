<?php
require_once('Parser.php');
class VnexpressParser extends Parser
{
    private $website = 'VnExpress';
    public function articleParser($url)
    {
        $articlePage = $this->curlGet($url);
        $finder = $this->returnXPathObject($articlePage);
        $title = $finder->query("//h1")->item(0); // xpath lay dom tieu de
        $description = $finder->query("//p[@class='description']/text()")->item(0); // xpath lay doan van ngan
        $date = $finder->query("//span[@class='date']")->item(0); // xpath lay ngay thang
        $category = $finder->query("//ul[@data-campaign='Header']/li/a")->item(0); // lay the loai
        $content = $finder->query("//article"); // xpath lay content

        $data = array();
        $data['title'] = trim($title->textContent);
        $data['description'] = trim($description->textContent);

        // chuyen dinh dangg datetime vi du: Thứ bảy, 9/1/2021, 00:00 (GMT+7) -> 9/1/2021 00:00:00
        $dateArray = explode(' ', trim($date->textContent));
        $dateStr = str_replace(',', '', $dateArray[2]);
        // $data['date'] = trim($date->textContent);
        $data['date'] = date('Y-m-d H:i:s', strtotime($dateStr . $dateArray[3]));
        $data['category'] = trim($category->textContent);
        $data['content'] = '';
        foreach ($content as $item) {
            $nodes = $item->childNodes;
            foreach ($nodes as $node) {
                $data['content'] = $data['content'] . trim($node->nodeValue) . "\n";
            }
        }
        $this->insertToDB($this->website, $data['title'], $data['category'], $data['description'], $data['content'], $data['date']);
        // print_r($data);
    }
}
// $url = 'https://vnexpress.net/thai-nhi-song-sot-du-nhau-bong-non-4217917.html';
// $vnexpress = new VnexpressParser();
// $vnexpress->articleParser($url);
