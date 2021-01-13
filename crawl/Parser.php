<?php

abstract class Parser
{
    // Function to make GET request using cURL
    function curlGet($url)
    {
        $ch = curl_init();    // Khoi tao cURL session
        // Set gia tri tham so cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $results = curl_exec($ch);    // Executing cURL session
        curl_close($ch);  // Dong cURL session
        return $results;  // tra ve html
    }


    // Function to return XPath object
    function returnXPathObject($item)
    {
        $xmlPageDom = new DOMDocument();    // khoi tao DomDocument object
        libxml_use_internal_errors(true); // dom chuyen tu html5 -> html4
        @$xmlPageDom->loadHTML('<?xml encoding="utf-8" ?>' . $item);    // Loading html page
        $xmlPageXPath = new DOMXPath($xmlPageDom);  // khoi tao XPath DOM object
        return $xmlPageXPath;    // tra ve XPath object
    }
    function insertToDB($website, $title, $category, $description, $content, $date)
    {
        // ket noi mysql
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crawlerfix";
        $conn = mysqli_connect($servername, $username, $password, $database);

        // chuyen dau nhay ' -> \'
        $content = mysqli_real_escape_string($conn, $content);
        $title = mysqli_real_escape_string($conn, $title);
        $description = mysqli_real_escape_string($conn, $description);
        // insert database
        $sql = "insert into article values(null, '" . $website . "', '" . "" . $title . "', '" . $category . "','" . $description . "', '" . $content . "', '" . $date . "')";
        $result = mysqli_query($conn, $sql);
        if ($result) echo '<script>alert("thành công !!!");</script>;';
        else echo '<script>alert("thất bại ' . $sql . '!!!");</script>;';
    }
    // abstract public function articleParser($url);

     function articleParser($url)
    {
        $articlePage = $this->curlGet($url);
        $finder = $this->returnXPathObject($articlePage);

        $title = $finder->query("//h1[@class='dt-news__title']")->item(0); // xpath lay DOM tieu de
        $description = $finder->query("//div[@class='dt-news__sapo']/h2")->item(0); // xpath lay DOM doan van ngan
        $date = $finder->query("//span[@class='dt-news__time']")->item(0); // xpath lay DOM ngay thang
        $category = $finder->query("//ul[@class='dt-breadcrumb']/li[position() > 1]"); // xpath lay DOM the loai
        $content = $finder->query("//div[@class='dt-news__content']"); // xpath lay DOM content

        // khoi tang mang data
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
        //insert database
        $this->insertToDB($this->website, $data['title'], $data['category'], $data['description'], $data['content'], $data['date']);
    }
}
