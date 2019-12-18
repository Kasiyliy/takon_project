<?php


namespace App\Http\Services;


use App\AccountCompanyOrder;
use App\Company;
use App\CompanyOrder;
use App\Exceptions\ApiServiceException;
use App\Exceptions\WebServiceErroredException;
use App\Transaction;
use App\TransactionLog;
use App\TransactionNode;
use App\TransactionType;
use App\User;
use Illuminate\Support\Facades\DB;

class TransactionService
{

	const TRANSACTION_ERROR_MESSAGE = "Что то пошло не так при обработке транзакции. Обратитесь к Администратору";

	public static function SendTakonToUser(CompanyOrder $companyOrder, User $user, $amount,  AccountCompanyOrder $accountCompanyOrder){
		try{
			DB::beginTransaction();
			$transaction = new Transaction();
			$transaction->transaction_type_id = TransactionType::TYPE_TRANSFER_ID;
			$transaction->sender_account_id = $companyOrder->company->account_id;
			$transaction->receiver_account_id = $user->mobileUser->account_id;
			$transaction->save();

			$transactionLog = new TransactionLog();
			$transactionLog->transaction_id = $transaction->id;
			$transactionLog->account_id = $companyOrder->company->account_id;
			$transactionLog->is_sender = true;
			$transactionLog->start_balance = $companyOrder->amount - $amount;
			$transactionLog->final_balance = $companyOrder->amount;
			$transactionLog->save();

			$transactionLog = new TransactionLog();
			$transactionLog->transaction_id = $transaction->id;
			$transactionLog->account_id = $user->mobileUser->account_id;
			$transactionLog->is_sender = false;
			$transactionLog->start_balance = $accountCompanyOrder->amount - $amount;
			$transactionLog->final_balance = $accountCompanyOrder->amount;
			$transactionLog->save();

			$transactionNode = new TransactionNode();
			$transactionNode->transaction_id = $transaction->id;
			$transactionNode->amount = $amount;
			$transactionNode->account_company_order_id = $accountCompanyOrder->id;
			$transactionNode->save();

			DB::commit();

		}
		catch (\Exception $exception){
			DB::rollBack();
			throw new WebServiceErroredException(self::TRANSACTION_ERROR_MESSAGE);
		}
	}


	public static function SendTakonToFriend(AccountCompanyOrder $accountCompanyOrder, User $user, $amount, AccountCompanyOrder $reciverAccount){
		try{
			DB::beginTransaction();
			$transaction = new Transaction();
			$transaction->transaction_type_id = TransactionType::TYPE_TRANSFER_ID;
			$transaction->sender_account_id = $accountCompanyOrder->account_id;
			$transaction->receiver_account_id = $reciverAccount->account_id;
			$transaction->save();

			$transactionLog = new TransactionLog();
			$transactionLog->transaction_id = $transaction->id;
			$transactionLog->account_id = $accountCompanyOrder->account_id;
			$transactionLog->is_sender = true;
			$transactionLog->start_balance = $accountCompanyOrder->amount - $amount;
			$transactionLog->final_balance = $accountCompanyOrder->amount;
			$transactionLog->save();

			$transactionLog = new TransactionLog();
			$transactionLog->transaction_id = $transaction->id;
			$transactionLog->account_id = $reciverAccount->account_id;
			$transactionLog->is_sender = false;
			$transactionLog->start_balance = $reciverAccount->amount - $amount;
			$transactionLog->final_balance = $reciverAccount->amount;
			$transactionLog->save();

			// TODO:  Асыл, я хз зачем эта моделька и как она работает
			$transactionNode = new TransactionNode();
			$transactionNode->transaction_id = $transaction->id;
			$transactionNode->amount = $amount;
			$transactionNode->account_company_order_id = $accountCompanyOrder->id;
			$transactionNode->save();

			DB::commit();
		}catch (\Exception $exception){
			DB::rollBack();
			throw new ApiServiceException(200, false, ['errors' => $exception->getMessage()]);
		}
	}


}