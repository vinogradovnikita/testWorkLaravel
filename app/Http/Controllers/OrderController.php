<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRule;
use App\Partner;

use App\Order;

class OrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate();

        return view('pages.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        // Список партнеров
        $partners = [];
        foreach (Partner::get() as $v){
            $partners[$v->id] = $v->name;
        }

        return view('pages.order.edit', [
            'order' => $order,
            'partners' => $partners,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRule $request, $id)
    {
        $order = Order::findOrFail($id);

        // Валидация формы
        $request->validated();

        // Обновление заказа
        $order->fill($request->all())->save();

        return redirect()->route('order.edit', [$order->id])->with('success', ['Заказ успешно обновлен']);
    }
}
