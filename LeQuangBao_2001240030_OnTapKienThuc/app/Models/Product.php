<?php
namespace App\Models;

class Product {
    private $id;
    private $name;
    private $price;

    public function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function displayRow($category_name, $index) {

        $formattedPrice = number_format($this->price, 0, ',', '.') . ' VNĐ';

        $safeIndex    = htmlspecialchars($index);
        $safeId       = htmlspecialchars($this->id);
        $safeName     = htmlspecialchars($this->name);
        $safeCategory = htmlspecialchars($category_name ?? '');

        return "<tr>
            <td>{$safeIndex}</td>
            <td>{$safeId}</td>
            <td>{$safeName}</td>
            <td>{$formattedPrice}</td>
            <td>{$safeCategory}</td>
        </tr>";
    }
}