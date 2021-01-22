<?php

abstract class Parser
{
    // Function to make GET request using cURL
    public $domString;
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
    public function articleParserr($url)
    {
        $articlePage = $this->curlGet($url);
        $finder = $this->returnXPathObject($articlePage);
        // print_r($this->domString);
        $title = $finder->query($this->domString['title'])->item(0); // xpath lay DOM tieu de
        $description = $finder->query($this->domString['description'])->item(0); // xpath lay DOM doan van ngan
        $date = $finder->query($this->domString['date'])->item(0); // xpath lay DOM ngay thang
        $category = $finder->query($this->domString['category'])->item(0); // xpath lay DOM the loai
        $content = $finder->query($this->domString['content']); // xpath lay DOM content

        // khoi tao mang data
        $data = array();
        $data['title'] = trim($title->textContent);
        $data['description'] = trim($description->textContent);
        $data['date'] = trim($date->textContent);
        $data['category'] = trim($category->textContent);
        $data['content'] = '';
        foreach ($content as $item) {
            $nodes = $item->childNodes;
            foreach ($nodes as $node) {
                $data['content'] = $data['content'] . trim($node->nodeValue) . "\n";
            }
        }
        $this->insertToDB($this->website, $data['title'], $data['category'], $data['description'], $data['content'], $data['date']);
    }
    // abstract public function articleParser($url);
}
