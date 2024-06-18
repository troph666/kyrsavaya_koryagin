<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукты для подверждения</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .redirect-btn {
            text-align: right;
            margin-bottom: 20px;
        }

        .redirect-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .redirect-btn a:hover {
            background-color: #1976D2;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .product h2 {
            margin-top: 0;
        }

        .product button {
            padding: 5px 10px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product button:hover {
            background-color: #45a049;
        }

        .product .reject-button {
            background-color: #f44336;
        }

        .product .reject-button:hover {
            background-color: #e53935;
        }

        .edit-button {
            background-color: #2196F3;
        }

        .edit-button:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="redirect-btn">
            <a href="{{ route('catalog') }}">Каталог товаров</a>
        </div>
        <h1>Список товаров для подтверждения</h1>
        @foreach($products as $product)
            <div class="product" id="product_{{ $product->id }}">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p>Цена: {{ $product->price }}</p>
                <p>Категория: {{ $product->category }}</p>
                <form method="post" action="{{ route('admin.product.approve', $product->id) }}">
                    @csrf
                    <button type="submit">Подтвердить товар</button>
                </form>
                <form method="post" action="{{ route('admin.product.reject', $product->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="rejection_reason">Причина отклонения:</label>
                        <textarea id="rejection_reason" name="rejection_reason" required></textarea>
                    </div>
                    <button type="submit" class="reject-button">Отклонить товар</button>
                </form>
                <a href="{{ route('admin.product.edit', $product->id) }}">
                    <button class="edit-button">Редактировать товар</button>
                </a>
            </div>
        @endforeach
    </div>
</body>
</html>
