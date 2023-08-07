<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LinkUserOrderExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $user;

    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function collection()
    {
        $serialNumber = 1;

        $collection = collect([
            ['Name', $this->user->name],
            ['Number', $this->user->number],
            ['Address', $this->user->address],
            ['Slot', "Date : {$this->user->delivery_date} Time: {$this->user->start_time}-{$this->user->end_time}"],
        ]);

        $headingRow = ['S. No.', 'Category', 'Product Name', 'Style Code', 'MRP', 'Selling Price'];
        $collection->push($headingRow); // Add headings below the "Slot" information

        foreach ($this->data as $order) {
            $collection->push([
                $serialNumber++,
                ucwords($order->product->cat->name),
                ucwords($order->product->product_name),
                ucwords($order->product->style_code),
                ucwords($order->product->mrp),
                ucwords($order->product->selling_price),
            ]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [];
    }
}
