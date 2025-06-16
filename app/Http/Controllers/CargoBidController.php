<?php

namespace App\Http\Controllers;

use App\Models\CargoBid;
use App\Models\CargoLoading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CargoBidController extends Controller
{
    // 🔹 Перевозчик откликается на груз
    public function store($locale, Request $request, CargoLoading $cargo)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'nullable|integer|min:1',
            'with_vat_cashless' => 'nullable|integer|min:1',
            'without_vat_cashless' => 'nullable|integer|min:1',
            'cash' => 'nullable|integer|min:1',
            'currency' => 'nullable|string',
            'payment_comment' => 'nullable|string',
            'ready_date' => 'nullable|date|after_or_equal:today',
        ]);

        $validator->after(function ($validator) use ($request) {
            $hasAlt = $request->filled('with_vat_cashless') || $request->filled('without_vat_cashless') || $request->filled('cash');
            $hasPrice = $request->filled('price');

            if (!$hasPrice && !$hasAlt) {
                $validator->errors()->add('price', 'Укажите ставку или хотя бы один из вариантов оплаты (с НДС, без НДС, наличными).');
            }
        });

        $validator->validate();

        if ($cargo->company->user_id == Auth::id()) {
            return response()->json(['status' => false, 'message' => 'Вы не можете откликнуться на собственный груз.']);
        }

        // Чекаем если груз фиксированный без торгов, то после первого отклика убираем с общего списка
//        if ($cargo->payment_type == 'no_haggling') {
//            $cargo->update(['status' => CargoLoading::COORDINATION]);
//        }

        // Проверка: уже откликался?
        if (CargoBid::where('cargo_loading_id', $cargo->id)->where('user_id', Auth::id())
            ->where('status', '!=', CargoBid::DECLINED)->exists()) {
            return response()->json(['status' => false, 'message' => 'Вы уже откликались на этот груз.']);
        }

        // Пока добавил сюда чтобы все уходили из списка временно
        $cargo->update(['status' => CargoLoading::COORDINATION]);

        CargoBid::create([
            'cargo_loading_id' => $cargo->id,
            'user_id' => Auth::id(),
            'price' => $request->price,
            'currency' => $request->currency,
            'payment_comment' => $request->payment_comment,
            'with_vat_cashless' => $request->with_vat_cashless,
            'without_vat_cashless' => $request->without_vat_cashless,
            'cash' => $request->cash,
            'status' => 'pending',
            'ready_date' => $request->ready_date,
            'prepayment_percent' => $request->prepayment_percent,
            'is_prepayment' => $request->is_prepayment ?? false,
            'is_on_unloading' => $request->is_on_unload ?? false,
            'is_bank_transfer' => $request->is_bank_transfer ?? false,
            'bank_transfer_days' => $request->bank_transfer_days,
        ]);

        return response()->json(['status' => true, 'message' => 'Отклик отправлен.']);
    }

    // 🟢 Грузовладелец принимает ставку
    public function accept($locale, CargoBid $bid)
    {
        $bid->update(['status' => 'accepted']);

        // (опционально) отклонить остальные отклики:
        CargoBid::where('cargo_loading_id', $bid->cargo_loading_id)
            ->where('id', '!=', $bid->id)
            ->update(['status' => 'declined']);

        $bid->cargoLoading->update(['status' => CargoLoading::IN_PERFORMANCE]);

        return back()->with('success', 'Отклик отклонён.');
    }

    public function finish($locale, CargoLoading $cargoLoading)
    {
        // Найти принятый отклик
        $acceptedBid = $cargoLoading->bids()->where('status', CargoBid::ACCEPTED)->first();

        if ($acceptedBid) {
            // Завершить его
            $acceptedBid->update(['status' => CargoBid::FINISHED]);

            // Отклонить остальные, если остались
            CargoBid::where('cargo_loading_id', $cargoLoading->id)
                ->where('id', '!=', $acceptedBid->id)
                ->update(['status' => CargoBid::DECLINED]);
        }

        // Перевести груз в архив
        $cargoLoading->update(['status' => CargoLoading::ARCHIVE]);

        return redirect()->route('сoordinations');
    }


    // 🔴 Грузовладелец или перевозчик отменяет/отклоняет
    public function decline($locale, CargoBid $bid, Request $request)
    {
        $request->validate([
            'comment' => 'nullable|string|max:255',
            'archiveOption' => 'nullable|in:restore,keep',
        ]);

        // Проверка прав
        if (Auth::id() != $bid->user_id && Auth::id() != $bid->cargoLoading?->company?->user?->id) {
            abort(403);
        }

        // Обновить статус отклика
        $bid->update([
            'status' => 'declined',
            'comment' => $request->comment,
        ]);

        // Выполнить действие над грузом
        if ($request->archiveOption === 'restore') {
            $bid->cargoLoading->update(['status' => CargoLoading::IN_PROGRESS]); // например, убрать из архива
        }

        return back()->with('success', 'Отклик отклонён.');
    }

}
