<?php
require_once('Parser.php');
class VietnamnetParser extends Parser
{
    private $website = 'Vietnamnet';
    // public function articleParser($url)
    // {
    //     $articlePage = $this->curlGet($url);
    //     $finder = $this->returnXPathObject($articlePage);

    //     $title = $finder->query("//h1[@class='title f-22 c-3e']")->item(0); // xpath lay DOM tieu de
    //     $description = $finder->query("//div[@class='bold ArticleLead']/p")->item(0); // xpath lay DOM doan van ngan
    //     $date = $finder->query("//span[@class='ArticleDate']")->item(0); // xpath lay DOM ngay thang
    //     $category = $finder->query("//div[@class='top-cate-head-title']/a")->item(0); // xpath lay DOM the loai
    //     $content = $finder->query("//div[@id='ArticleContent']/p"); // xpath lay DOM content

    //     // khoi tao mang data
    //     $data = array();
    //     $data['title'] = trim($title->textContent);
    //     $data['description'] = trim(str_replace("\xc2\xa0", ' ', $description->textContent), "\xC2\xA0");
    //     $data['date'] = date('Y-m-d H:i:s', strtotime(trim(str_replace("\xc2\xa0", ' ', $date->textContent), "\xC2\xA0"))); // chuyen doi dinh dang datetime vd: 08/01/2021    11:23 GMT+7 -> 8/1/2021 11:23:00

    //     $data['category'] = $category->textContent;
    //     $data['content'] = '';
    //     foreach ($content as $item) {
    //         $nodes = $item->childNodes;
    //         foreach ($nodes as $node) {
    //             $data['content'] = trim($data['content'] . $node->nodeValue);
    //         }
    //     }
    //     $this->insertToDB($this->website, $data['title'], $data['category'], $data['description'], $data['content'], $data['date']);
    // }
}
