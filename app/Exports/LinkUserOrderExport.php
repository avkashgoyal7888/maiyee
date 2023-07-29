<?php

namespace App\Exports;

use App\Models\UserIncentive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LinkUserOrderExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $serialNumber = 1;
    
        return $this->data->map(function ($data) use (&$serialNumber) {
            return [
                'Serial No.' => $serialNumber++,
                'Name' => $data->user->name,
                'Category' => $data->product->cat->name,
                'Product Name' => $data->product->product_name,
                'Style Code' => $data->product->style_code,
                'MRP' => strval($data->product->mrp),
                'Selling Rate' => strval($data->product->selling_price),
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category',
            'Product Name',
            'Style Code',
            'MRP',
            'Selling Rate'
        ];
    }
}
