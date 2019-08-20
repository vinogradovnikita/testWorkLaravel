@extends("layouts.front")

@section('content')

    <div class="container mtb-5">

        <h2 class="sub-header">Список заказов</h2>

        <div class="table-responsive">
            @if(!$orders->isEmpty())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название партнера</th>
                        <th>Стоимость заказа</th>
                        <th>Наименование/состав заказа</th>
                        <th>Статус заказа</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><a href="{{ route('order.edit', [$order->id]) }}" target="_blank">{{ $order->id }}</a></td>
                            <td>{{ $order->partner->name }}</td>
                            <td>{{ $order->products->sum('price') }}</td>
                            <td>
                                @foreach($order->products as $product)
                                    {{ $product->name }} <br>
                                @endforeach
                            </td>
                            <td>{{ config('general.order_status')[$order->status] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $orders->links() }}
            @else
                <p>Заказов не найдено</p>
            @endif
        </div>

    </div>

@stop