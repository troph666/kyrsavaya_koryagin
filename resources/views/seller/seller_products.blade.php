<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продавец товаров</title>
    <style>
        /* Общие стили для страницы */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Стили для кнопки "Каталог товаров" */
        .btn-catalog {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: #ffffff;
            background-color: #004090;
            border-radius: 5px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .btn-catalog:hover {
            background-color: #002f5a;
        }

        /* Стили для формы добавления товара */
        .add-product-form {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .add-product-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .add-product-form input[type="text"],
        .add-product-form input[type="number"],
        .add-product-form textarea,
        .add-product-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .add-product-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .add-product-form button:hover {
            background-color: #0056b3;
        }

        /* Стили для контейнера товаров */
        .product-container {
            display: flex;
            flex-wrap: wrap;
        }
        .product-item {
            width: calc(33.33% - 20px);
            margin: 10px;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .product-item p {
            margin: 5px 0;
        }
        .product-item .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .product-item .btn-delete:hover {
            background-color: #c82333;
        }

        /* Стили для изображения товара */
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('catalog') }}" class="btn-catalog">Каталог товаров</a>

        <form action="{{ route('product.add') }}" method="POST" class="add-product-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">Название товара:</label>
                <input type="text" id="product-name" name="product-name" required>
            </div>
            <div class="form-group">
                <label for="product-description">Описание товара:</label>
                <textarea id="product-description" name="product-description" required></textarea>
            </div>
            <div class="form-group">
                <label for="product-price">Цена:</label>
                <input type="number" id="product-price" name="product-price" required>
            </div>
            <div class="form-group">
                <label for="product-image">Изображение товара:</label>
                <input type="file" id="product-image" name="product-image">
            </div>
            <div class="form-group">
                <label for="product-category">Категория:</label>
                <select id="product-category" name="product-category">
                    <option value="category1">Электроника</option>
                    <option value="category2">Обувь</option>
                    <option value="category3">Мебель</option>
                    <option value="category4">Аксессуары</option>
                    <option value="category5">Автотовары</option>
                </select>
            </div>
            <button type="submit">Добавить товар</button>
        </form>

        <h3>Мои товары</h3>
        <div class="product-container">
            @foreach($products as $product)
                <div class="product-item">
                    <p><strong>Название:</strong> {{ $product->name }}</p>
                    <p><strong>Описание:</strong> {{ $product->description }}</p>
                    <p><strong>Цена:</strong> {{ $product->price }}</p>
                    <p><strong>Статус:</strong> {{ $product->status }}</p>
                    @if($product->status === 'rejected' && $product->rejection_reason)
                        <p class="rejection-reason"><strong>Причина отклонения:</strong> {{ $product->rejection_reason }}</p>
                    @endif
                    <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Удалить товар</button>
                    </form>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Изображение товара" class="product-image">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
