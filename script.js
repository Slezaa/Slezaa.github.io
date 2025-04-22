function toggleMenu() {
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
}

let cart = [];
let products = [];

document.addEventListener("DOMContentLoaded", () => {
    loadCart();
    updateCartCount();
    setupLoginFormIfNeeded();
    enablePaymentButton();

    // Pokud je stránka s produkty
    const produktyContainer = document.getElementById("produkty-container");
    if (produktyContainer) {
        renderProductsIfNeeded();

        const categoryElement = document.getElementById('category');
        if (categoryElement) {
            categoryElement.addEventListener('change', function () {
                const selectedCategory = this.value;
                renderProductsIfNeeded(selectedCategory);
            });
        } else {
            console.warn("Element s ID 'category' nebyl nalezen.");
        }
    }
});

//převod textu na objekt
function loadCart() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    } else {
        cart = [];
    }
    renderCart();
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}
/*Počet položek v košíku na navbaru*/
function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}
//  render košíku
function renderCart() {
    const content = document.getElementById('content');
    if (!content) return;

    if (cart.length === 0) {
        content.innerHTML = `
            <div class="empty-cart">
                <h1>Košík</h1>
                <p>Váš košík je prázdný</p>
                <button onclick="window.location.href='produkty.html';">Podívat se na nabídku</button>
            </div>
        `;

        document.getElementById('user-auth').style.display = 'none';
        document.getElementById('delivery-options').style.display = 'none';
        document.getElementById('proceed-section').style.display = 'none';
    } else {
        const totalPrice = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

        content.innerHTML = `
            <h1>Košík</h1>
            <table>
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Cena</th>
                        <th>Množství</th>
                        <th>Celkem</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    ${cart.map(item => `
                        <tr>
                            <td>${item.name}, ${item.size}cm</td>
                            <td>${item.price} Kč</td>
                            <td>${item.quantity}</td>
                            <td>${item.price * item.quantity} Kč</td>
                            <td><button onclick="removeFromCart(${item.id})">Odebrat</button></td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
            <div class="total-price-box">
                <p><strong>Celková cena:</strong> <span id="total-price">${totalPrice}</span> Kč</p>
            </div>
        `;
        document.getElementById('checkout-wrapper').style.display = 'flex';
        document.getElementById('user-auth').style.display = 'block';
        document.getElementById('delivery-options').style.display = 'block';
        document.getElementById('proceed-section').style.display = 'block';
        enablePaymentButton();
    }
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartCount();
    renderCart();
}

function clearCart() {
    cart = [];
    saveCart();
    updateCartCount();
    renderCart();
}

//  PRODUKTY
function renderProductsIfNeeded(category = 'all') {
    const container = document.getElementById("produkty-container");
    if (!container) return;

    const url = category === 'all' ? "produkty_data.php" : `produkty_data.php?category=${category}`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = "";
            products = data;

            data.forEach(produkt => {
                const card = document.createElement("div");
                card.className = "produkt-card";

                card.innerHTML = `
                    <img src="${produkt.image_url}" alt="${produkt.jmeno}" class="produkt-image">
                    <div class="produkt-content">
                        <h3>${produkt.jmeno}</h3>
                        <p>${produkt.popis_produktu}</p>
                        <p><strong>Velikost:</strong> ${produkt.velikost}</p>
                        <p><strong>Kategorie:</strong> ${produkt.kategorie}</p>
                        <p class="cena">${produkt.cena} Kč</p>
                        <button onclick="addToCart(${produkt.id})" class="add-to-cart-btn">Přidat do košíku</button>
                    </div>
                `;

                container.appendChild(card);
            });
        })
        .catch(error => {
            console.error("Chyba při načítání produktů:", error);
        });
}

function addToCart(productId) {
    const product = products.find(p => p.id == productId);
    if (!product) return;

    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: product.jmeno,
            size: product.velikost,
            price: product.cena,
            quantity: 1
        });
    }

    saveCart();
    updateCartCount();
}

// Login v košíku
function setupLoginFormIfNeeded() {
    const loginForm = document.getElementById('login-form');
    if (!loginForm) return;

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('checkout.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('login-message').textContent = data.message;
                document.getElementById('login-message').style.color = 'green';
                document.getElementById('delivery-options').style.display = 'block';
                localStorage.setItem('cartEmail', formData.get('email'));
                enablePaymentButton();
            } else {
                document.getElementById('login-message').textContent = data.message;
                document.getElementById('login-message').style.color = 'red';
            }
        })
        .catch(err => {
            console.error(err);
            document.getElementById('login-message').textContent = "Nastala chyba.";
        });
    });
}

//  Tlačítko k platbě
function enablePaymentButton() {
    const proceedButton = document.getElementById('proceed-to-payment');
    if (!proceedButton) return;

    if (cart.length === 0 || !localStorage.getItem('cartEmail')) {
        proceedButton.style.pointerEvents = 'none';
        proceedButton.style.backgroundColor = 'gray';
    } else {
        proceedButton.style.pointerEvents = 'auto';
        proceedButton.style.backgroundColor = '#4CAF50';
    }
}
