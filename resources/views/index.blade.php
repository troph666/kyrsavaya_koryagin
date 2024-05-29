<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Маркет-плейс</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <h1>Маркет-плейс</h1>
    <div class="search-bar">
        <input type="text" placeholder="Поиск...">
        <button type="submit">Найти</button>
    </div>
    <div class="user-actions">
        <a href="#" onclick="showSection('product-catalog'); hideAuth();">Каталог</a>
        <a href="#" onclick="showSection('cart'); hideAuth();">Корзина</a>
        <a href="#" onclick="showSection('izbrannoe'); hideAuth();">Избранное</a>
    </div>
    <div class="auth-buttons">
        <a href="#" onclick="showSection('login-registration');">Вход</a>
        <a href="#" onclick="showSection('registration-form');">Регистрация</a>
    </div>
</header>

<main>
    <section id="login-registration" class="auth-section hidden">
        <h2>Вход</h2>
        <form class="auth-form">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" onclick="login(event)">Вход</button>
        </form>
        <button class="close-button" onclick="showSection('product-catalog')">Закрыть</button>
    </section>

    <section id="registration-form" class="auth-section hidden">
        <h2>Регистрация</h2>
        <form class="auth-form" onsubmit="register(event)">
            <label for="reg-username">Логин:</label>
            <input type="text" id="reg-username" name="reg-username" required>
            <label for="reg-password">Пароль:</label>
            <input type="password" id="reg-password" name="reg-password" required>
            <label for="role">Роль:</label>
            <select id="role" name="role">
                <option value="buyer">Покупатель</option>
                <option value="seller">Продавец</option>
            </select>
            <button type="submit">Регистрация</button>
        </form>
        <button class="close-button" onclick="showSection('product-catalog')">Закрыть</button>
    </section>

    <section id="seller-dashboard" class="dashboard hidden">
        <h2>Личный кабинет продавца</h2>
        <nav>
            <ul>
                <li><a href="#" onclick="showSellerSection('seller-products')">Мои товары</a></li>
                <li><a href="#" onclick="showSellerSection('seller-orders')">Заказы</a></li>
            </ul>
        </nav>
        <div id="seller-products" class="seller-section">
            <h3>Мои товары</h3>
            <form class="product-form" onsubmit="addProduct(event)">
                <label for="product-name">Название товара:</label>
                <input type="text" id="product-name" name="product-name" required>
                <label for="product-description">Краткое описание:</label>
                <textarea id="product-description" name="product-description" required></textarea>
                <label for="product-price">Цена:</label>
                <input type="number" id="product-price" name="product-price" required>
                <label for="product-image">Фото:</label>
                <input type="file" id="product-image" name="product-image" accept="image/*">
                <label for="product-category">Категория:</label>
                <select id="product-category" name="product-category">
                    <option value="category1">Категория 1</option>
                    <option value="category2">Категория 2</option>
                    <option value="category3">Категория 3</option>
                    <option value="category4">Категория 4</option>
                    <option value="category5">Категория 5</option>
                </select>
                <button type="submit">Добавить товар</button>
            </form>
            <div id="seller-product-list" class="product-list"></div>
        </div>
        <div id="seller-orders" class="seller-section hidden">
            <h3>Заказы</h3>
            <div id="seller-order-list" class="order-list"></div>
        </div>
    </section>

    <section id="buyer-dashboard" class="dashboard hidden">
        <h2>Личный кабинет покупателя</h2>
        <ul>
            <li>Мои заказы</li>
        </ul>
    </section>
    
    <section id="product-catalog" class="catalog">
        <h2>Каталог товаров</h2>
        <form class="filter-form" onsubmit="filterProducts(event)">

            <label for="category-filter">Категория:</label>
            <select id="category-filter" name="category-filter">
                <option value="all">Все</option>
                <option value="category1">Категория 1</option>
                <option value="category2">Категория 2</option>
                <option value="category3">Категория 3</option>
                <option value="category4">Категория 4</option>
                <option value="category5">Категория 5</option>
            </select>
            <button type="submit">Фильтровать</button>
        </form>
    <div id="product-list" class="product-list">
    <div id="product-list" class="product-list">
    <div class="product-item" data-id="1" data-category="category1">
                <img src="img/6997180321.webp" alt="Лакомство PERFECT FIT IMMUNITY" class="product-image">
                <h3 class="product-title">Лакомство PERFECT FIT IMMUNITY для собак, с говядиной и экстрактом бархатцев, 12 шт x 90 г</h3>
                <p class="product-seller">Продавец:</p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 942 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(1)">Подробнее</button>
            </div>
            <div class="product-item" data-id="2" data-category="category2">
                <img src="img/6921651828.webp" alt="Philips Парогенератор GC6740/30" class="product-image">
                <h3 class="product-title">Philips Парогенератор GC6740/30, фиолетовый</h3>
                <p class="product-seller">Продавец: </p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 12 242 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(2, 'Philips Парогенератор GC6740/30', 12242)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(2)">Подробнее</button>
            </div>
            <div class="product-item" data-id="3" data-category="category3">
                <img src="img/product3.webp" alt="Iphone 15" class="product-image">
                <h3 class="product-title">Iphone 15</h3>
                <p class="product-seller">Продавец: </p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 1500 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(3, 'Iphone 15', 1500)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(3)">Подробнее</button>
            </div>
            <div class="product-item" data-id="4" data-category="category4">
                <img src="img/product4.webp" alt="Процессор i5-13400f" class="product-image">
                <h3 class="product-title">Процессор i5-13400f</h3>
                <p class="product-seller">Продавец: </p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 20 000 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(4, 'Процессор i5-13400f', 20000)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(4)">Подробнее</button>
            </div>
            <div class="product-item" data-id="5" data-category="category5">
                <img src="img/product5.webp" alt="Настольная игра 'Монополия'" class="product-image">
                <h3 class="product-title">Настольная игра "Монополия"</h3>
                <p class="product-seller">Продавец: </p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 3500 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(5, 'Настольная игра "Монополия"', 3500)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(5)">Подробнее</button>
            </div>
            <div class="product-item" data-id="3" data-category="category3">
                <img src="img/product6.webp" alt="Шкаф-купе" class="product-image">
                <h3 class="product-title">Шкаф-купе</h3>
                <p class="product-seller">Продавец:</p>
                <p class="product-category">Категория: </p>
                <p class="product-price">Цена: 16 000 ₽.</p>
                <button class="add-to-cart-button" onclick="addToCart(6, 'Шкаф-купе', 16000)">Добавить в корзину</button>
                <button class="order-button" onclick="orderProduct(1, 'Лакомство PERFECT FIT IMMUNITY', 942)">Оформить заказ</button>
                <button class="details-button" onclick="showProductDetails(6)">Подробнее</button>
            </div>
        </div>
    </section>

    <section id="product-details" class="product-details hidden">
        <h2>Подробная информация о товаре</h2>
        <div id="product-info" class="product-info"></div>
        <button class="back-button" onclick="showSection('product-catalog')">Назад к каталогу</button>
    </section>
    </div>
</section>


    <section id="cart" class="cart hidden">
        <h2>Корзина</h2>
        <div id="cart-items" class="cart-items"></div>
        <button onclick="clearCart()">Очистить корзину</button>
        <button onclick="checkout()">Оформить заказ</button>
    </section>

    <section id="izbrannoe" class="izbrannoe hidden">
        <h2>Избранное</h2>
        <div id="izbrannoe-items-list" class="izbrannoe-items-list"></div>
    </section>
</main>

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


    function register(event) {
        event.preventDefault();
        const role = document.getElementById('role').value;
        if (role === 'seller') {
            showSection('seller-dashboard');
        } else {
            showSection('buyer-dashboard');
        }
    }


    function login(event) {
        event.preventDefault();
        showSection('buyer-dashboard');
    }


    function addProduct(event) {
        event.preventDefault();
        const productName = document.getElementById('product-name').value;
        const productDescription = document.getElementById('product-description').value;
        const productPrice = document.getElementById('product-price').value;
        const productImage = document.getElementById('product-image').files[0];
        const productCategory = document.getElementById('product-category').value;

        const productList = document.getElementById('seller-product-list');
        const productItem = document.createElement('div');
        productItem.classList.add('product-item');
        productItem.innerHTML = `
            <h3>${productName}</h3>
            <p>${productDescription}</p>
            <p>Цена: ${productPrice} ₽</p>
            <button onclick="deleteProduct(this)">Удалить</button>
        `;
        productList.appendChild(productItem);
    }

    function orderProduct(productId, productName, productPrice) {
    const confirmation = confirm(`Вы уверены, что хотите оформить заказ на товар "${productName}" за ${productPrice}₽?`);
    if (confirmation) {
        addToCart(productId, productName, productPrice);
        alert('Товар добавлен в корзину. Можете оформить заказ в корзине.');
    }
}


    function deleteProduct(button) {
        button.parentElement.remove();
    }


    function addToCart(productId, productName, productPrice) {
        const cartItems = document.getElementById('cart-items');
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.dataset.id = productId;
        cartItem.innerHTML = `
            <h3>${productName}</h3>
            <p>Цена: ${productPrice} ₽</p>
            <button class="remove-item-button" onclick="removeFromCart(${productId})">Удалить</button>
        `;
        cartItems.appendChild(cartItem);
    }


    function removeFromCart(productId) {
        const cartItems = document.getElementById('cart-items');
        const cartItem = cartItems.querySelector(`.cart-item[data-id="${productId}"]`);
        if (cartItem) {
            cartItems.removeChild(cartItem);
        }
    }


    function clearCart() {
        const cartItems = document.getElementById('cart-items');
        cartItems.innerHTML = '';
    }


    function checkout() {
        alert('Оформление заказа');
        clearCart();
    }


    function showProductDetails(productId) {
        const productCatalog = [
            { id: 1, name: 'Лакомство PERFECT FIT IMMUNITY', description: 'Лакомство для собак, с говядиной и экстрактом бархатцев.', price: 942, image: 'img/6997180321.webp' },
            { id: 2, name: 'Philips Парогенератор GC6740/30', description: 'Парогенератор Philips, фиолетовый.', price: 12242, image: 'img/6921651828.webp' },
            { id: 3, name: 'Iphone 15', description: 'Описание телефона Iphone 15', price: 1500, image: 'img/product3.webp' },
            { id: 4, name: 'Процессор i5-13400f', description: 'Процессор Intel i5-13400f', price: 20000, image: 'img/product4.webp' },
            { id: 5, name: 'Настольная игра "Монополия"', description: 'Популярная настольная игра "Монополия".', price: 3500, image: 'img/product5.webp' },
            { id: 6, name: 'Шкаф-купе', description: 'Большой шкаф-купе', price: 16000, image: 'img/product6.webp' }
        ];

        const product = productCatalog.find(p => p.id === productId);
        if (product) {
            document.getElementById('product-info').innerHTML = `
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-description">${product.description}</p>
                <p class="product-price">Цена: ${product.price} ₽</p>
                <button class="add-to-cart-button" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Добавить в корзину</button>
            `;
            showSection('product-details');
        }
    }
    function filterProducts(event) {
    event.preventDefault();
    const categoryFilter = document.getElementById('category-filter').value;
    const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(item => {
        const category = item.dataset.category;
        if (categoryFilter === 'all' || category === categoryFilter) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}


    function checkout() {
        alert('Ваш заказ оформлен!');
        clearCart();
    }
</script>
</body>
</html>