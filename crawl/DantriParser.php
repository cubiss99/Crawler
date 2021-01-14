<?php
require_once('Parser.php');
class DantriParser extends Parser
{
    private $website = 'Dân trí';

    public function articleParser($url)
    {

    //     $articlePage = $this->curlGet($url);
    //     $finder = $this->returnXPathObject($articlePage);

    //     $title = $finder->query("//h1[@class='dt-news__title']")->item(0); // xpath lay DOM tieu de
    //     $description = $finder->query("//div[@class='dt-news__sapo']/h2")->item(0); // xpath lay DOM doan van ngan
    //     $date = $finder->query("//span[@class='dt-news__time']")->item(0); // xpath lay DOM ngay thang
    //     $category = $finder->query("//ul[@class='dt-breadcrumb']/li[position() > 1]"); // xpath lay DOM the loai
    //     $content = $finder->query("//div[@class='dt-news__content']"); // xpath lay DOM content

    //     // khoi tang mang data
        $data = array();
        $data['title'] = trim($title->textContent);
        $data['description'] = trim($description->textContent);

        $date = str_replace('-', '', trim($date->textContent)); // tach date qua dau '-' thanh mang chuoi
        $data['date'] = date('Y-m-d H:i:s', strtotime(explode(',', $date)[1])); // chuyen doi datetime vd: Thứ sáu, 08/01/2021 - 14:01 -> 8/1/20201 14:01:00

        $data['category'] = '';
        $data['content'] = '';
        // xy ly array de lay tieu de vd: Dân trí > Du Lịch > Khám phá -> Du lịch Khám phá
        foreach ($category as $cate) {
            $nodes = $cate->childNodes;
            foreach ($nodes as $node) {
                $data['category'] = $data['category'] . trim($node->nodeValue) . " ";
            }
        }
        foreach ($content as $item) {
            $nodes = $item->childNodes;
            foreach ($nodes as $node) {
                $data['content'] = trim($data['content'] . $node->nodeValue . "\n");
            }
        }
    // //     //insert database
    // //     $this->insertToDB($this->website, $data['title'], $data['category'], $data['description'], $data['content'], $data['date']);
    //  }
    }
}