<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Маркет-плейс</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header>
    <h1>Маркет-плейс</h1>
    <div class="search-bar">
    <form id="search-form" onsubmit="searchProducts(event)">
        <input type="text" id="search-input" placeholder="Поиск...">
        <button type="submit">Найти</button>
    </form>
</div>

    <div class="user-actions">
    <a href="{{ route('catalog') }}" style="padding: 10px 20px; font-size: 16px; text-decoration: none; color: #ffffff; background-color: #0056b3; border-radius: 5px; transition: background-color 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    Каталог товаров
</a>


    </div>
    <div class="auth-buttons">
    @auth
            @if(Auth::user()->role == 'seller')
            <a href="#" onclick="showSection('seller-dashboard')">Личный кабинет продавца</a>
            @elseif(Auth::user()->isAdmin())
                <a href="#" onclick="showSection('admin-dashboard')">Личный кабинет админа</a>
            @else
                <a href="#" onclick="showSection('buyer-dashboard')">Личный кабинет покупателя</a>
            @endif
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </div>
</header>

<main>
    @auth
        @if(Auth::user()->role == 'seller')
        <section id="seller-dashboard" class="dashboard">
    <h2>Личный кабинет продавца</h2>
    <nav>
        <ul>
            <li><a href="#" onclick="showSection('product-catalog'); hideSellerSections(); return false;">Главная</a></li>
            <li><a href="http://127.0.0.1:8000/seller/products" onclick="hideSellerSections();">Мои товары</a></li>
            <li><a href="#" onclick="showSellerSection('seller-orders'); hideSection('product-catalog'); return false;">Заказы</a></li>
        </ul>
    </nav>

    <div id="seller-products" class="seller-section">
        <h3></h3>
        <form id="add-product-form" action="{{ route('product.add') }}" method="POST" class="add-product-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">Название товара:</label>
                <input type="text" id="product-name" name="product-name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="product-description">Описание товара:</label>
                <textarea id="product-description" name="product-description" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="product-price">Цена:</label>
                <input type="number" id="product-price" name="product-price" required class="form-control">
            </div>
            <div class="form-group">
                <label for="product-image">Изображение товара:</label>
                <input type="file" id="product-image" name="product-image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="product-category">Категория:</label>
                <select id="product-category" name="product-category" class="form-control">
                    <option value="category1">Электроника</option>
                    <option value="category2">Обувь</option>
                    <option value="category3">Мебель</option>
                    <option value="category4">Аксессуары</option>
                    <option value="category5">Автотовары</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить товар</button>
        </form>
        <div id="seller-product-list" class="product-list"></div>
    </div>
    <div id="seller-orders" class="seller-section hidden">
        <h3>Заказы</h3>
        <div id="seller-order-list" class="order-list"></div>
    </div>
</section>

<style>
    .dashboard {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    nav ul {
        list-style-type: none;
        padding: 0;
        text-align: center;
        margin-bottom: 20px;
    }
    nav ul li {
        display: inline-block;
        margin-right: 10px;
    }
    nav ul li a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .seller-section {
        margin-top: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .btn {
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: #fff;
        background-color: #007bff;
    }
    .form-control, .form-control-file {
        width: calc(100% - 22px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-control-file {
        padding: 8px;
    }
    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }
    .order-list {
    }
    .hidden {
        display: none;
    }
</style>


        @elseif(Auth::user()->isAdmin())
        <section id="admin-dashboard" class="dashboard" style="margin: 20px;">
    <div class="container" style="max-width: 1200px; margin: auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h1 style="color: #333;">Личный кабинет админа</h1>
        <div id="users" class="section" style=" margin-top: 20px;">
            <h2 style="color: #333;">Пользователи</h2>
            <button class="btn" onclick="confirmUser()" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; margin-right: 10px;">Подтвердить товар</button>
            <button class="btn" onclick="blockUser()" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Блокировка пользователя</button>
        </div>
    </div>
</section>
        @else
            <section id="buyer-dashboard" class="dashboard" style="margin: 20px;">
                <div class="container" style="max-width: 1200px; margin: auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h1 style="color: #333;">Личный кабинет покупателя</h1>
                    <nav>
                        <ul style="list-style: none; padding: 0; display: flex; gap: 10px;">
                        <a href="/my-orders" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 5px; transition: background-color 0.3s; display: inline-block;">Мои заказы</a>
                        </ul>
                    </nav>
                   
                    <div id="settings" class="section" style="display: none; margin-top: 20px;">
                        <h2 style="color: #333;">Настройки</h2>
                        <form method="POST" action="#">
                            @csrf
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="name" style="display: block; margin-bottom: 5px; color: #555;">Имя:</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="email" style="display: block; margin-bottom: 5px; color: #555;">Email:</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                            <button type="submit" class="btn" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </section>
        @endif
    @endauth
    
    <section id="product-catalog" class="catalog">
    <h2>Каталог товаров</h2>
    <form class="filter-form" onsubmit="filterProducts(event)">
        <label for="category-filter">Категория:</label>
        <select id="category-filter" name="category-filter">
            <option value="all">Все</option>
            <option value="category1">Электроника</option>
            <option value="category2">Обувь</option>
            <option value="category3">Мебель</option>
            <option value="category4">Аксессуары</option>
            <option value="category5">Автотовары</option>
        </select>
        <button type="submit">Фильтровать</button>
    </form>
    <style>
    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }
    .product-card {
        background-color: #ffffff;
        border: 1px solid #dddddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: calc(33% - 20px);
    }
    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .product-title {
        font-size: 18px;
        margin: 10px 0;
    }
    .product-description {
        font-size: 16px;
        color: #555555;
        margin-bottom: 10px;
    }
    .product-price {
        font-size: 16px;
        color: #d9534f;
        margin: 10px 0;
    }
    .product-category {
        font-size: 16px;
        color: #007bff;
        margin: 10px 0;
    }
    .product-seller {
        font-size: 16px;
        color: #555555;
        margin: 10px 0;
    }
    .add-to-cart-button,
    .details-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.3s;
    }
    .add-to-cart-button:hover,
    .details-button:hover {
        background-color: #0056b3;
    }
    .cart {
        display: none;
    }
    .cart-items {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .clear-cart-button,
    .checkout-button {
        padding: 10px 20px;
        background-color: #d9534f;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.3s;
    }
    .clear-cart-button:hover,
    .checkout-button:hover {
        background-color: #c9302c;
    }
    </style>
    <div id="product-list" class="product-list">
    @foreach($products as $product)
        <div class="product-card">
            <h3 class="product-title">{{ $product->name }}</h3>
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <p class="product-description">{{ $product->description }}</p>
            <p class="product-price">Цена: {{ $product->price }}</p>
            <p class="product-category">Категория: 
                @switch($product->category)
                    @case('category1')
                        Электроника
                        @break
                    @case('category2')
                        Обувь
                        @break
                    @case('category3')
                        Мебель
                        @break
                    @case('category4')
                        Аксессуары
                        @break
                    @case('category5')
                        Автотовары
                        @break
                    @default
                        Неизвестная категория
                @endswitch
            </p>
            <p class="product-seller">Продавец: {{ $product->seller_name }}</p>
            <form action="{{ route('order.create') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="product_price" value="{{ $product->price }}">
                <button type="submit">Оформить заказ</button>
            </form>
        </div>
    @endforeach
</div>



<script>

function showSection(sectionId) {
        const sections = document.querySelectorAll('main > section');
        sections.forEach(section => {
            if (section.id === sectionId) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }



function hideAuth() {
        const authSections = document.querySelectorAll('.auth-section');
        authSections.forEach(section => {
            section.classList.add('hidden');
        });
    }


    function showSellerSection(sectionId) {
        const sellerSections = document.querySelectorAll('.seller-section');
        sellerSections.forEach(section => {
            if (section.id === sectionId) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }


    function confirmUser() {
            window.location.href = "http://127.0.0.1:8000/admin/products";
        }

        function blockUser(userId) {
    fetch(`/user/block/${userId}`, { method: 'POST' })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Ошибка блокировки пользователя');
            }
        })
        .then(data => {
            alert('Пользователь успешно заблокирован');
        })
        .catch(error => console.error('Ошибка блокировки пользователя:', error));
}
function searchProducts(event) {
        event.preventDefault();
        const searchText = document.getElementById('search-input').value.toLowerCase();
        const productItems = document.querySelectorAll('.product-card');

        productItems.forEach(item => {
            const productName = item.querySelector('.product-title').textContent.toLowerCase();
            const productDescription = item.querySelector('.product-description').textContent.toLowerCase();

            if (productName.includes(searchText) || productDescription.includes(searchText)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }


    function register(event) {
        event.preventDefault();
        const role = document.getElementById('role').value;
        if (role === 'seller') {
            document.querySelector('.user-actions').classList.add('hidden');
            document.querySelector('.auth-buttons').classList.remove('hidden');
        } else {
            showSection('buyer-dashboard');
        }
    }


function showSection(sectionId) {
    const sections = document.querySelectorAll('main > section');
    sections.forEach(section => {
        if (section.id === sectionId) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    });
}
    function login(event) {
        event.preventDefault();
        showSection('buyer-dashboard');
    }

    function filterProducts(event) {
    event.preventDefault();
    const categoryFilter = document.getElementById('category-filter').value;
    const productItems = document.querySelectorAll('.product-card');

    productItems.forEach(item => {
        const category = item.querySelector('.product-category').textContent.split(': ')[1]; 
        if (categoryFilter === 'all' || category === categoryFilter) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

</script>
</body>
</html>