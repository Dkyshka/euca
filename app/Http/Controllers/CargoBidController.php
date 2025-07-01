<?php

namespace App\Http\Controllers;

use App\Models\CargoBid;
use App\Models\CargoLoading;
use App\Models\Notification;
use App\Models\Transport;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CargoBidController extends Controller
{
    // 🔹 Перевозчик откликается на груз
    public function store($locale, Request $request, CargoLoading $cargo)
    {
        try {
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
                    $validator->errors()->add('price', __('lang.Укажите ставку или хотя бы один из вариантов оплаты (с НДС, без НДС, наличными).'));
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            if ($cargo->company->user_id == Auth::id()) {
                return response()->json(['status' => false, 'message' => __('lang.Вы не можете откликнуться на собственный груз.')]);
            }

            // Чекаем если груз фиксированный без торгов, то после первого отклика убираем с общего списка
            //        if ($cargo->payment_type == 'no_haggling') {
            //            $cargo->update(['status' => CargoLoading::COORDINATION]);
            //        }

            // Проверка: уже откликался?
            if (CargoBid::where('cargo_loading_id', $cargo->id)
                ->where('user_id', Auth::id())
                ->whereNotIn('status', [CargoBid::DECLINED, CargoBid::FINISHED])
                ->exists()) {
                return response()->json(['status' => false, 'message' => __('lang.Вы уже откликались на этот груз.')]);
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
                'is_on_unloading' => $request->is_on_unloading ?? false,
                'is_bank_transfer' => $request->is_bank_transfer ?? false,
                'bank_transfer_days' => $request->bank_transfer_days,
            ]);

            NotificationService::send($cargo->company->user,
                __('lang.Предложение на груз'),
                $cargo->cargo->title.', '.$cargo->country.'-'.$cargo->final_unload_city);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => __('lang.Отклик отправлен.')]);
    }

    public function counterOffer($locale, Transport $transport, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'nullable|integer|min:1',
                'cargo_loading_id' => 'required|integer|exists:cargo_loadings,id',
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
                    $validator->errors()->add('price', __('lang.Укажите ставку или хотя бы один из вариантов оплаты (с НДС, без НДС, наличными).'));
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $cargo = CargoLoading::where('id', $request->cargo_loading_id)->firstOrFail();

            if ($cargo->company->user->transports()->where('id', $transport->id)->exists()) {
                return response()->json(['status' => false, 'message' => __('lang.Вы не можете отправить предложение на собственный транспорт.')]);
            }

            if (CargoBid::where('cargo_loading_id', $request->cargo_loading_id)
                ->where('initiator_id', Auth::id())
                ->whereNotIn('status', [CargoBid::DECLINED, CargoBid::FINISHED])
                ->exists()) {
                return response()->json(['status' => false, 'message' => __('lang.Вы уже отправили предложение.')]);
            }

            $cargo->update(['status' => CargoLoading::COORDINATION]);
            $transport->update(['status' => Transport::COORDINATION]);

            CargoBid::create([
                'cargo_loading_id' => $request->cargo_loading_id,
                'user_id' => $transport->user->id,
                'initiator_id' => Auth::id(),
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
                'is_on_unloading' => $request->is_on_unloading ?? false,
                'is_bank_transfer' => $request->is_bank_transfer ?? false,
                'bank_transfer_days' => $request->bank_transfer_days,
                'transport_id' => $transport->id,
            ]);

            NotificationService::send($transport->user,
                __('lang.Предложение на груз'),
                $cargo->cargo->title.', '.$cargo->country.'-'.$cargo->final_unload_city);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => __('lang.Отклик отправлен.')]);
    }

    // 🟢 Грузовладелец принимает ставку
    public function accept($locale, CargoBid $bid)
    {
        try {
            DB::beginTransaction();

            $bid->update(['status' => CargoBid::ACCEPTED]);
            $bid->transport?->update(['status' => Transport::IN_PERFORMANCE]);
            // (опционально) отклонить остальные отклики:
//            CargoBid::where('cargo_loading_id', $bid->cargo_loading_id)
//                ->where('id', '!=', $bid->id)
//                ->update(['status' => 'declined']);

            $bid->cargoLoading->update(['status' => CargoLoading::IN_PERFORMANCE]);

            $user = auth()->user();
            $cargoOwnerId = $bid->cargoLoading?->company?->user?->id;

            if ($user->id === $bid->user_id) {
                // Водитель сам принял — уведомить грузовладельца
                if ($cargoOwnerId && $cargoOwnerId !== $user->id) {
                    NotificationService::send($bid->cargoLoading->company->user,
                        __('lang.Водитель отклонил заказ'),
                        $bid->cargoLoading->cargo->title . ', ' . $bid->cargoLoading->country . '-' . $bid->cargoLoading->final_unload_city);
                }
            } else {
                // Грузовладелец принял — уведомить водителя
                NotificationService::send($bid->user,
                    __('lang.Ваше предложение одобрено'),
                    $bid->cargoLoading->cargo->title . ', ' . $bid->cargoLoading->country . '-' . $bid->cargoLoading->final_unload_city);
            }

//            // тут тоже проверку кто есть кто принял
//            NotificationService::send($bid->user,
//                __('lang.Ваше предложение одобрено'),
//                $bid->cargoLoading->cargo->title.', '.$bid->cargoLoading->country.'-'.$bid->cargoLoading->final_unload_city);

            DB::commit();
            return redirect()->route('execution', app()->getLocale());
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function finish($locale, CargoLoading $cargoLoading)
    {
        try {
            DB::beginTransaction();

            // Найти принятый отклик
            $acceptedBid = $cargoLoading->bids()->where('status', CargoBid::ACCEPTED)->first();

            if ($acceptedBid) {
                // Завершить его
                $acceptedBid->update([
                    'status' => CargoBid::FINISHED,
                ]);

                $acceptedBid->transport?->update(['status' => Transport::IN_PROGRESS]);

                // Отклонить остальные, если остались
//            CargoBid::where('cargo_loading_id', $cargoLoading->id)
//                ->where('id', '!=', $acceptedBid->id)
//                ->update(['status' => CargoBid::DECLINED]);

                NotificationService::send($acceptedBid->user,
                    __('lang.Заказ завершён'),
                    $acceptedBid->cargoLoading->cargo->title . ', ' . $acceptedBid->cargoLoading->country . '-' . $acceptedBid->cargoLoading->final_unload_city);
            }

            // Перевести груз в архив
            $cargoLoading->update(['status' => CargoLoading::ARCHIVE]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        return redirect()->route('execution');
    }


    // 🔴 Грузовладелец или перевозчик отменяет/отклоняет
    public function decline($locale, CargoBid $bid, Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'comment' => 'required|string|max:255',
                'archiveOption' => 'nullable|in:restore,keep',
            ]);

            // Проверка прав
            if (Auth::id() != $bid->user_id && Auth::id() != $bid->cargoLoading?->company?->user?->id) {
                abort(403);
            }

            // Обновить статус отклика
            $bid->update([
                'status' => CargoBid::DECLINED,
                'comment' => $request->comment,
            ]);

            $bid->transport?->update(['status' => Transport::IN_PROGRESS]);

            // Выполнить действие над грузом
            if ($request->archiveOption === 'restore') {
                $bid->cargoLoading->update(['status' => CargoLoading::IN_PROGRESS]); // обратно в листинг
            } else {
                $bid->cargoLoading->update(['status' => CargoLoading::ARCHIVE]); // в архив
            }

            $user = auth()->user();
            $cargoOwnerId = $bid->cargoLoading?->company?->user?->id;

            if ($user->id === $bid->user_id) {
                // Водитель сам отклонил — уведомить грузовладельца
                if ($cargoOwnerId && $cargoOwnerId !== $user->id) {
                    NotificationService::send($bid->cargoLoading->company->user,
                        __('lang.Водитель отклонил заказ'),
                        $bid->cargoLoading->cargo->title . ', ' . $bid->cargoLoading->country . '-' . $bid->cargoLoading->final_unload_city . '<br><br>' .
                        $request->comment);
                }
            } else {
                // Грузовладелец отклонил — уведомить водителя
                NotificationService::send($bid->user,
                    __('lang.Ваше предложение отклонено'),
                    $bid->cargoLoading->cargo->title . ', ' . $bid->cargoLoading->country . '-' . $bid->cargoLoading->final_unload_city . '<br><br>' .
                    $request->comment);
            }

            DB::commit();
            return back()->with('success', 'Отклик отклонён.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Произошла ошибка.');
        }
    }

    public function changeStatus($locale, CargoBid $bid, Request $request): JsonResponse
    {
        $request->validate([
            'transport_status' => [
                'required',
                Rule::in([
                    'on_the_way_to_loading',
                    'arrived_at_loading',
                    'loading',
                    'loaded',
                    'on_the_way_to_unload',
                    'waiting_for_unloading',
                    'unloading',
                    'unloaded',
                    'completed',
                    'canceled',
                ]),
            ],
        ]);

        $bid->transport_status = $request->input('transport_status');
        $bid->save();

        return response()->json([
            'status' => true,
        ]);
    }

}
