<?php

namespace ConfrariaWeb\Financial\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AccountInvoiceScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (
            !app()->runningInConsole() &&
            existsAccount() &&
            account() &&
            Auth::check()
        ) {
            $account = account();
            $builder->where('financial_invoices.account_id', $account->id);
        }else if(Auth::check()){
            $builder->where('financial_invoices.user_id', Auth::id());
        }
    }
}
