@extends("layouts.front")

@section('content')

    <div class="container mtb-5">
        <section class="content-header">

            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class='p-0 m-0' style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('wrong'))
                <div class="alert alert-danger">
                    <ul class='m-0 p-0' style="list-style: none;">
                        @foreach (session('wrong') as $wrong)
                            <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {!! $wrong !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <ul class='p-0 m-0' style="list-style: none;">
                        @foreach (session('success') as $succes)
                            <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $succes }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1>Редактирование заказа</h1>
        </section>

        <!-- Main content -->
        <section class="content">


            <div class="form-group">
                {{ Form::label('products', 'Продукты:') }}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Количество</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                {{ Form::label('price', 'Стоимост заказа:') }}
                <p>{{ $order->products->sum('price') }} рублей</p>
            </div>

            <hr>

            {!! Form::model($order, ['route' => ['order.update', $order->id], 'method' => 'put']) !!}
            <div class="form-group">
                {{ Form::label('client_email', 'Email клиента:') }}
                {{ Form::text('client_email', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('partner_id', 'Партнер:') }}
                {{ Form::select('partner_id', $partners, $order->partner->id, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('status', 'Статус заказа:') }}
                {{ Form::select('status', config('general.order_status'), $order->status, ['class' => 'form-control']) }}
            </div>
            <div class="submit-btn">
                {!! Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@stop