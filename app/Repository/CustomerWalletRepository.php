<?php


namespace App\Repository;


use App\CustomerWallet;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerWalletRepository
{


    public function all()
    {

        $employee = Employee::where('user_id', Auth::id())
            ->with('wallets')
            ->first();
        $wallets = $employee->wallets;

        return $wallets;
    }

    public function storeFromRequest(Request $request)
    {
        $wallet = new CustomerWallet();
        $wallet = $this->save($request, $wallet);

        return $wallet;
    }

    public function updateFromRequest(Request $request, $id)
    {
        $wallet = $this->findById($id);
        $wallet = $this->save($request, $wallet);

        return $wallet;
    }

    private function save(Request $request, CustomerWallet $wallet)
    {
        $customers = $request->customers;
        $wallet->customers()->sync($customers);
        $wallet->wallet = $request->wallet;
        $wallet->save();

        return $wallet->fresh();
    }

    public function findById($id)
    {
        $wallet = CustomerWallet::findOrFail($id);
        return $wallet;
    }
}