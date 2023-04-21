<?php
namespace App\Http\Livewire\Admin\Account;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Account;
use App\Models\AccountStatement;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use DB;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $ac_id, $ac_name, $ac_no, $ifsc, $branch, $bankname, $nickname,$from,$to, $amount, $transaction_date, $perticuler;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function closemodal()
    {
        $this->resetinputfields();
    }
    protected $rules = [
        'ac_name' => 'required',
        'nickname' => 'required',
    ];
    protected $messages = [
        'ac_name.required' => 'Account Name is required',
        'nickname.required' => 'Nickname is required',
    ];

    public function resetinputfields()
    {
        $this->ac_name = '';
        $this->ac_no = '';
        $this->ifsc = '';
        $this->branch = '';
        $this->bankname = '';
        $this->nickname = '';
        $this->from = '';
        $this->to = '';
        $this->amount = '';
        $this->transaction_date = '';
        $this->perticuler = '';
    }

    public function supFundTransfer()
    {
        $validatedata = $this->validate([
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
            'transaction_date' => 'required',
            'perticuler' => 'required',
        ], [
            'from.required' => 'Select Account for Send',
            'to.required' => 'Select Supplier for Receive',
            'amount.required' => 'Enter Amount',
            'transaction_date.required' => 'Select Account for Receive',
            'perticuler.required' => 'Remarks Can not be blank',
        ]);

        $str = Supplier::where('id', $this->to)->first();
        $acc = Account::where('id', $this->from)->first();
        if ($acc->effective_balance < $this->amount) {
        $this->addError('amount', 'Not Enough Funds');
        return;
        }
        $acc->effective_balance = $acc->effective_balance - $this->amount;
        $upd = $acc->update();
        $str->effective_balance = $str->effective_balance - $this->amount;
        $upd = $str->update();

        $accdebit = DB::table("account_statements")->where('account_id', $this->from)->orderBy("id", 'DESC')->first();
        if ($accdebit) {
        $accadd = $accdebit->effective_balance - $this->amount;
        } else {
        $accadd = Account::where('id', $this->from)->value('effective_balance');
        }

        $sadeb = DB::table("supplier_accounts")->where('supplier_id', $this->to)->orderBy("id", 'DESC')->first();
        if ($sadeb) {
            $saadd = $sadeb->effective_balance - $this->amount;
        } else {
            $saadd = Supplier::where('id', $this->to)->value('effective_balance');
        }

        // debit
        $order_id = mt_rand(11111111, 99999999);
        $debit = new AccountStatement;
        $debit->order_id = $order_id;
        $debit->account_id = $this->from;
        $debit->amount = $this->amount;
        $debit->effective_balance = $accadd; // updated to use the new effective balance
        $debit->perticuler = $this->perticuler;
        $debit->transaction_date = $this->transaction_date;
        $debit->transaction_type = '0';
        $debit->save();
        // credit
        $sup = new SupplierAccount();
        $sup->order_id = $debit->order_id;
        $sup->supplier_id = $this->to;
        $sup->perticuler = $this->perticuler;
        $sup->amount = $this->amount;
        $sup->effective_balance = $saadd;
        $sup->transaction_type = '1';
        $sup->transaction_date = $this->transaction_date;
        $sup->save();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Transaction Successful...');
        $this->emit('closemodal');
    }

    public function accFundTransfer()
    {
        $validatedata = $this->validate([
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
            'transaction_date' => 'required',
            'perticuler' => 'required',
        ], [
            'from.required' => 'Select Account for Send',
            'to.required' => 'Select Account for Receive',
            'amount.required' => 'Enter Amount',
            'transaction_date.required' => 'Select Account for Receive',
            'perticuler.required' => 'Remarks Can not be blank',
        ]);
    
        $acc = Account::where('id', $this->from)->first();
        if ($acc->effective_balance < $this->amount) {
        $this->addError('amount', 'Not Enough Funds');
        return;
        }
        $acc->effective_balance = $acc->effective_balance - $this->amount;
        $upd = $acc->update();

        $accdebit = DB::table("account_statements")->where('account_id', $this->from)->orderBy("id", 'DESC')->first();
        if ($accdebit) {
        $accadd = $accdebit->effective_balance - $this->amount;
        } else {
        $accadd = Account::where('id', $this->from)->value('effective_balance');
        }

        $acccredit = DB::table("account_statements")->where('account_id', $this->to)->orderBy("id", 'DESC')->first();
        if ($acccredit) {
        $accmin = $acccredit->effective_balance + $this->amount;
        } else {
        $accmin = Account::where('id', $this->to)->value('effective_balance') + $this->amount;
        }

        // debit
        $order_id = mt_rand(11111111, 99999999);
        $debit = new AccountStatement;
        $debit->order_id = $order_id;
        $debit->account_id = $this->from;
        $debit->amount = $this->amount;
        $debit->effective_balance = $accadd; // updated to use the new effective balance
        $debit->perticuler = $this->perticuler;
        $debit->transaction_date = $this->transaction_date;
        $debit->transaction_type = '0';
        $debit->save();
        // credit
        $credit = new AccountStatement;
        $credit->order_id = $debit->order_id;
        $credit->account_id = $this->to;
        $credit->amount = $this->amount;
        $credit->effective_balance = $accmin;
        $credit->perticuler = $this->perticuler;
        $credit->transaction_date = $this->transaction_date;
        $credit->transaction_type = '1';
        $credit->save();
        $cred = Account::where('id', $this->to)->first();
        $cred->effective_balance = $cred->effective_balance + $this->amount;
        $upd = $cred->update();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Transaction Successful...');
        $this->emit('closemodal');
    }

    public function addFunds()
    {
        $validatedata = $this->validate([
            'to' => 'required',
            'amount' => 'required',
            'perticuler' => 'required',
            'transaction_date' => 'required'
        ],[
            'to.required' => 'Select Account...',
            'amount.required' => 'Enter Amount',
            'perticuler.required' => 'Remarks can not be blank..',
            'transaction_date.required' => 'Select Date...',
        ]);

        $account = Account::where('id',$this->to)->first();
        $account->effective_balance = $account->effective_balance + $this->amount;
        $accup = $account->update();

        $order_id = mt_rand(11111111, 99999999);
        $store = new AccountStatement;
        $store->order_id = $order_id;
        $store->account_id = $this->to;
        $store->amount = $this->amount;
        $store->effective_balance = $account->effective_balance; // updated to use the new effective balance
        $store->perticuler = $this->perticuler;
        $store->transaction_date = $this->transaction_date;
        $store->transaction_type = '0';
        $store->save();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Transaction Successful...');
        $this->emit('closemodal');
    }
    public function store()
    {
        $validatedata = $this->validate();
        $acc = new Account;
        $acc->ac_name = $this->ac_name;
        $acc->ac_no = $this->ac_no;
        $acc->ifsc = $this->ifsc;
        $acc->branch = $this->branch;
        $acc->bankname = $this->bankname;
        $acc->nickname = $this->nickname;
        $acc->save();
        $this->resetinputfields();
        session()->flash('success', 'Account Added Successfully...');
        $this->emit('closemodal');
    }
    public function viewStore(int $ac_id)
    {
        $acc = Account::find($ac_id);
        if ($acc != null) {
            $this->ac_name = $acc->ac_name;
            $this->ac_no = $acc->ac_no;
            $this->ifsc = $acc->ifsc;
            $this->branch = $acc->branch;
            $this->bankname = $acc->bankname;
            $this->nickname = $acc->nickname;
            } else {
                return redirect()->to('/admin/account');
        }
    }
    public function editStore($id)
    {
        $acc = Account::find($id);
        if ($acc) {
            $this->ac_id = $acc->id;
            $this->ac_name = $acc->ac_name;
            $this->ac_no = $acc->ac_no;
            $this->ifsc = $acc->ifsc;
            $this->branch = $acc->branch;
            $this->bankname = $acc->bankname;
            $this->nickname = $acc->nickname;
            } else {
                return redirect()->to('/admin/account');
        }
    }
    public function updateStore()
    {
        $validatedata = $this->validate();
        Account::Where('id', $this->ac_id)->update([
        'ac_name' => $this->ac_name,
        'ac_no' => $this->ac_no,
        'ifsc' => $this->ifsc,
        'branch' => $this->branch,
        'bankname' => $this->bankname,
        'nickname' => $this->nickname,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Account Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteAccount($id)
    {
        $acc = Account::find($id);
        if ($acc) {
            $this->ac_id = $acc->id;

        } else {
            return redirect()->to('/admin/account');
        }
    }

    public function delete()
    {
        Account::Where('id', $this->ac_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Account Deleted Successfully...');
        $this->emit('closemodal');
    }
    public function render()
    {
        $data = Account::where('ac_name', 'like', '%'.$this->search.'%')
        ->orderByDesc('id')->paginate(10);
        $acc = Account::all();
        $sup = Supplier::get();
        return view('livewire.admin.account.index', ['data'=>$data, 'acc'=>$acc, 'sup'=>$sup]);
    }
}