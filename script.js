// Produkty
const products = [
    { id: 1, name: "Plastový sáček", category: "Plastové", size: "20x30 cm", price: 5 },
    { id: 2, name: "Papírový sáček", category: "Papírové", size: "25x35 cm", price: 6 },
    { id: 3, name: "Ekologický sáček", category: "Ekologické", size: "22x33 cm", price: 7 },
    { id: 4, name: "Zip sáček", category: "Zip", size: "30x40 cm", price: 8 },
    { id: 5, name: "Velký plastový sáček", category: "Plastové", size: "50x70 cm", price: 12 },
    { id: 6, name: "Malý papírový sáček", category: "Papírové", size: "15x20 cm", price: 4 },
];

// Data pro košík
let cart = [];

// Pages
function navigateTo(page) {
    const content = document.getElementById('content');
    content.classList.remove('home-background');

    const pages = {
        domu: `
            <div class="home-background">
                <h1>Vítejte ve Fapolu!</h1>
                <p>Fapol je předním výrobcem kvalitních sáčků pro různé potřeby. Nabízíme širokou škálu sáčků od plastových po papírové.</p>
            </div>
        `,
        produkty: `
            <div class="product-grid">
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 20x30">
                    <h2>Plastový sáček</h2>
                    <p>Cena: 10 Kč</p>
                    <p>Ideální pro menší balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 30x40">
                    <h2>Papírový sáček</h2>
                    <p>Cena: 15 Kč</p>
                    <p>Vhodné pro středně velká balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 40x50">
                    <h2>Ekologický sáček</h2>
                    <p>Cena: 20 Kč</p>
                    <p>Skvělé pro větší balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 50x60">
                    <h2>Zip sáček</h2>
                    <p>Cena: 25 Kč</p>
                    <p>Vhodné pro velkoobjemové použití.</p>
                </div>
            </div>
        `,
        nakup: `
            <div class="product-grid">
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 20x30">
                    <h2>Sáček 20x30</h2>
                    <p>Cena: 10 Kč</p>
                    <p>Ideální pro menší balení.</p>
                    <button onclick="addToCart('Sáček 20x30')">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 30x40">
                    <h2>Sáček 30x40</h2>
                    <p>Cena: 15 Kč</p>
                    <p>Vhodné pro středně velká balení.</p>
                    <button onclick="addToCart('Sáček 30x40')">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 40x50">
                    <h2>Sáček 40x50</h2>
                    <p>Cena: 20 Kč</p>
                    <p>Skvělé pro větší balení.</p>
                    <button onclick="addToCart('Sáček 40x50')">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 50x60">
                    <h2>Sáček 50x60</h2>
                    <p>Cena: 25 Kč</p>
                    <p>Vhodné pro velkoobjemové použití.</p>
                    <button onclick="addToCart('Sáček 50x60')">Vložit do košíku</button>
                </div>
            </div>
        `,
        onas: `
            <h1>O nás</h1>
            <p>Firma Fapol byla založena v roce 1990 a specializuje se na výrobu kvalitních sáčků pro rozličné použití.</p>
        `,
        
        kontakt: `
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
                <div style="flex: 1; min-width: 300px;">
                    <h1>Kontakt</h1>
                    <p><strong>Jméno:</strong> Lenka Vašíčková</p>
                    <p><strong>E-mail:</strong> info@fapol.cz</p>
                    <p><strong>Telefon:</strong> +420 123 456 789</p><br>
                    <p><strong>Jméno:</strong> Oldřich Vorba</p>
                    <p><strong>E-mail:</strong> info@fapol.cz</p>
                    <p><strong>Telefon:</strong> +420 987 654 321</p><br>
                    <h1>Firma</h1>
                    <p>Fapol s.r.o.</p>
                    <p>Adresa ssss</p>
                    <p>IČ: 12345678</p>
                    <p>DIČ: CZ12345678</p>
                </div>
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2563.223876306384!2d16.603034315832172!3d49.19506097932298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47129477b8cf7a8b%3A0x3a44f04c04f1c9e5!2sBrno!5e0!3m2!1sen!2scz!4v1636372589435!5m2!1sen!2scz"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        `,
        kosik: renderCart
    };

    const pageContent = pages[page];
    if (typeof pageContent === 'function') {
        pageContent();
    } else {
        content.innerHTML = pageContent || `<h1>Stránka nenalezena</h1>`;
    }
}

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

// Vykreslení produktů v sekci Nákup
function renderProducts(productList) {
    const productContainer = document.getElementById('product-list');
    productContainer.innerHTML = '';
    productList.forEach(product => {
        productContainer.innerHTML += `
            <div class="product-box">
                <h2>${product.name}</h2>
                <p>Kategorie: ${product.category}</p>
                <p>Rozměr: ${product.size}</p>
                <p>Cena: ${product.price} Kč</p>
                <button onclick="addToCart(${product.id})">Vložit do košíku</button>
            </div>
        `;
    });
}

// Page košík
function renderCart() {
    const content = document.getElementById('content');
    if (cart.length === 0) {
        content.innerHTML = `<h1>Košík</h1><p>Košík je prázdný.</p>`;
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
// Košík -> Home page
window.onload = function() {
    navigateTo('domu');
};