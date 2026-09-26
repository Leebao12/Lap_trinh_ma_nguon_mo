<?php
class Book{
    protected $title;
    protected $author;
    protected $price;
    public function __construct($title,$author,$price)
    {
        $this->title=$title;
        $this->author=$author;
        $this->price=$price;
    }
}
interface Downloadable
{
    public function download();
}
class Ebook extends Book implements Downloadable {
    private $fileSize;
    public function __construct($title, $author, $price,$fileSize)
    {
        parent::__construct($title, $author, $price);
        $this->fileSize=$fileSize;
    }
    public function download()
    {
        echo "Đang tải sách: {$this->title} của tác giả {$this->author} giá {$this->price}....<br>";
        echo "Kích thức tệp: {$this->fileSize} MB<br>";
    }
}

$sach = new Ebook("Lập trình","Vũ Văn Vinh",40000,20);
$sach->download();
?>