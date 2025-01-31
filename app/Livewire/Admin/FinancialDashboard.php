<?php

namespace App\Livewire\Admin;

use App\Mail\WithdrawalNotification;
use App\Models\AccountWithdrawal;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FinancialDashboard extends Component
{
    public $orders_count;
    public $paid_orders_count;
    public $revenue;
    public $pending_balance;
    public $withdrawal_logs;
    public $amount;
    public $showWithdrawPrompt = false;

    public function mount()
    {
        $this->orders_count = Order::count();
        $total_revenue = Order::where('status', 'paid')->sum('total_amount');
        $total_withrawn = AccountWithdrawal::where('cleared', true)->sum('total_amount');
        $this->paid_orders_count = Order::where('status', 'paid')->count();

        $revenue_without_commision = $total_revenue * 0.925;
        $this->revenue = $revenue_without_commision;
        $this->pending_balance = $revenue_without_commision - $total_withrawn;
        $this->withdrawal_logs = AccountWithdrawal::get();
    }

    public function handleWithdraw()
    {
        if ($this->amount <= $this->pending_balance) {
            $transaction = AccountWithdrawal::create([
                'cleared' => false,
                'cleared_at' => null,
                'total_amount' => $this->amount,
                'notes' => 'Account Withdrawal',
                'starting_balance' => $this->pending_balance,
                'ending_balance' => $this->pending_balance - $this->amount,
            ]);

            try {
                Mail::to(config('constants.super_admin_email'))->send(new WithdrawalNotification($transaction));
            } catch (\Exception $e) {
                // Payment failed; store an error message in the session
                Log::error('Error: Failed to send email ' . $e->getMessage());
            }

            $this->showWithdrawPrompt = false;
            $this->withdrawal_logs = AccountWithdrawal::get();
        }
    }

    public function handleCleared($id)
    {
        $transaction = AccountWithdrawal::find($id);

        $transaction->update([
            'cleared' => true,
            'cleared_at' => now()
        ]);

        return redirect(route('admin.financials'));
    }

    public function render()
    {
        return view('livewire.admin.financial-dashboard')->extends('layouts.main');
    }
}
