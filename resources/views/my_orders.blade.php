@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="my-2">Мои заказы</h1>
                </div>
                <div class="card-body">
                    @foreach($orders as $order)
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($order->product) 
                            <h5 class="card-title text-primary mb-3">Товар: {{ $order->product->name }}</h5>
                            <p class="card-text"><strong>Цена:</strong> {{ $order->product->price }} ₽</p>
                            <p class="card-text"><strong>Категория:</strong> {{ $order->product->category }}</p>
                            <p class="card-text"><strong>Продавец:</strong> {{ $order->product->seller_name }}</p>
                            

                            <div class="modal fade" id="addressModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addressModalLabel{{ $order->id }}">Введите адрес доставки</h5>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="addressForm{{ $order->id }}" action="{{ route('order.submit', ['order_id' => $order->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="delivery-address">Адрес доставки:</label>
        <input type="text" id="delivery-address" name="delivery-address" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
</form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                            <p class="card-text">Продукт для этого заказа отсутствует</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="modal fade" id="orderSuccessModal" tabindex="-1" role="dialog" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderSuccessModalLabel">Заказ успешно оформлен</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 1.2rem;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
    }

    .modal-dialog {
        max-width: 500px;
    }

    .modal-content {
        border-radius: 10px;
    }
</style>

@endsection
