<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать товар</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        select {
            width: 100%;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Стили для загрузки файла */
        .file-upload {
            margin-top: 10px;
            position: relative;
        }

        .file-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }

        .file-upload label {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            width: 150px;
        }

        .file-upload label:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактировать товар</h1>
        <form method="post" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <label for="name">Название:</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>

            <label for="description">Описание:</label>
            <textarea id="description" name="description" required>{{ $product->description }}</textarea>

            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" required>

            <label for="category">Категория:</label>
            <select id="category" name="category" required>
                <option value="category1" {{ $product->category === 'category1' ? 'selected' : '' }}>Электроника</option>
                <option value="category2" {{ $product->category === 'category2' ? 'selected' : '' }}>Обувь</option>
                <option value="category3" {{ $product->category === 'category3' ? 'selected' : '' }}>Мебель</option>
                <option value="category4" {{ $product->category === 'category4' ? 'selected' : '' }}>Аксессуары</option>
                <option value="category5" {{ $product->category === 'category5' ? 'selected' : '' }}>Автотовары</option>
            </select>

            <div class="file-upload">
            <label for="product-image">Изображение товара:</label>
            <input type="file" id="product-image" name="product-image">
            </div>

            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
</body>
</html>
