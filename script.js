// Pages
function navigateTo(page) {
    const content = document.getElementById('content');

    const pages = {
        
        kosik: renderCart
    };

    const pageContent = pages[page];
    if (typeof pageContent === 'function') {
        pageContent();
    } else {
        content.innerHTML = pageContent || `<h1>Stránka nenalezena</h1>`;
    }
}

// Produkty
const products = [
    { id: 1, name: "Plastový sáček", category: "Plastové", size: "20x30 cm", price: 5 },
    { id: 2, name: "Papírový sáček", category: "Papírové", size: "25x35 cm", price: 6 },
    { id: 3, name: "Ekologický sáček", category: "Ekologické", size: "22x33 cm", price: 7 },
    { id: 4, name: "Zip sáček", category: "Zip", size: "30x40 cm", price: 8 },
];

// Košík
let cart = [];

// Přidávání produktu do košíku
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingProduct = cart.find(item => item.id === productId);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }

    updateCartCount();
    alert(`${product.name} byl přidán do košíku!`);
}

// Aktualizace počtu položek v košíku
function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
}

// Filtrace produktů podle kategorie
function filterProducts(category) {
    const filteredProducts = category === 'vse' ? products : products.filter(p => p.category === category);
    renderProducts(filteredProducts);
}

// Page košík
function renderCart() {
    const content = document.getElementById('content');
    if (cart.length === 0) {
        content.innerHTML = `
            <h1>Košík</h1>
            <p>Košík je prázdný.</p>
        `;
    } else {
        content.innerHTML = `
            <h1>Košík</h1>
            <table>
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Rozměr</th>
                        <th>Cena</th>
                        <th>Množství</th>
                        <th>Celkem</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    ${cart.map(item => `
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.size}</td>
                            <td>${item.price} Kč</td>
                            <td>${item.quantity}</td>
                            <td>${item.price * item.quantity} Kč</td>
                            <td><button onclick="removeFromCart(${item.id})">Odebrat</button></td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
            <p><strong>Celková cena:</strong> ${cart.reduce((sum, item) => sum + item.price * item.quantity, 0)} Kč</p>
        `;
    }
}
// Odebrání produktu z košíku
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartCount();
    renderCart();
}

