<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkUserProduct;
use App\Models\LinkUser;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LinkUserOrderExport;
use PDF;

class Order extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id,$search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Request $req, $user_id)
    {
        $id = $req->id;
        $this->user_id = $id;
    }

    public function exportExcel()
    {

        $data = LinkUserProduct::where('user_id', $this->user_id)
        ->whereHas('product', function (Builder $query) {
            if ($this->search) {
                $searchTerm = '%' . $this->search . '%';
                $query->where('product_name', 'like', $searchTerm)
                    ->orWhere('style_code', 'like', $searchTerm);
            }
                })->orderByDesc('id')->get();
        $user = LinkUser::where('id',$this->user_id)->first();

        return Excel::download(new LinkUserOrderExport($data,$user), 'accountstatement.xlsx');
    }

    public function exportPDF()
    {
        $data = LinkUserProduct::with('product.cat')
            ->where('user_id', $this->user_id)
            ->whereHas('product', function (Builder $query) {
                if ($this->search) {
                    $searchTerm = '%' . $this->search . '%';
                    $query->where('product_name', 'like', $searchTerm)
                        ->orWhere('style_code', 'like', $searchTerm);
                }
            })
            ->orderByDesc('id')
            ->get();

        $user = LinkUser::where('id', $this->user_id)->first();

        $pdf = PDF::loadView('link.pdf', ['data' => $data, 'user' => $user]);
        $pdf->setPaper('A4', 'portrait');
        $pdfContent = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $user->name . '.pdf"',
        ];

        return response()->stream(
            function () use ($pdfContent) {
                echo $pdfContent;
            },
            200,
            $headers
        );
    }


    public function render()
    {
        $data = LinkUserProduct::where('user_id', $this->user_id)
    ->whereHas('product', function (Builder $query) {
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where('product_name', 'like', $searchTerm)
                ->orWhere('style_code', 'like', $searchTerm);
        }
    })
    ->orderByDesc('id')
    ->get();
    $user = LinkUser::where('id',$this->user_id)->first();
        return view('livewire.admin.linkcategory.order',compact('data','user'));
    }
}
