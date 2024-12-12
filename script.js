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
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
                <div style="flex: 1; min-width: 300px;">
                    <h2><strong>Naše nejprodávanější produkty</strong></h2>
                </div>
            </div>
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
            </div>
        `,
        produkty: `
            <div class="product-grid">
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 20x30">
                    <h2>Plastový sáček</h2>
                    <p>Ideální pro menší balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 30x40">
                    <h2>Papírový sáček</h2>
                    <p>Vhodné pro středně velká balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 40x50">
                    <h2>Ekologický sáček</h2>
                    <p>Skvělé pro větší balení.</p>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 50x60">
                    <h2>Zip sáček</h2>
                    <p>Vhodné pro velkoobjemové použití.</p>
                </div>
            </div>
        `,
        nakup: `
            <div class="product-grid">
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 20x30">
                    <h2>Plastový sáček</h2>
                    <p>Rozměry: 20x30</p>
                    <p>Cena: 10 Kč</p>
                    <p>Ideální pro menší balení.</p>
                    <button onclick="addToCart(1)">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 30x40">
                    <h2>Papírový sáček</h2>
                    <p>Rozměry: 20x30</p>
                    <p>Cena: 15 Kč</p>
                    <p>Vhodné pro středně velká balení.</p>
                    <button onclick="addToCart(2)">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 40x50">
                    <h2>Ekologický sáček</h2>
                    <p>Rozměry: 40x50</p>
                    <p>Cena: 20 Kč</p>
                    <p>Skvělé pro větší balení.</p>
                    <button onclick="addToCart(3)">Vložit do košíku</button>
                </div>
                <div class="product-box">
                    <img src="images/150.jpg" alt="Sáček 50x60">
                    <h2>Zip sáček</h2>
                    <p>Rozměry: 50x60</p>
                    <p>Cena: 25 Kč</p>
                    <p>Vhodné pro velkoobjemové použití.</p>
                    <button onclick="addToCart(4)">Vložit do košíku</button>
                </div>
            </div>
        `,
        onas: `
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
                <div style="flex: 1; min-width: 300px;">
                    <h1>O nás</h1>
                    <p>Jsme rodinná firma, která se od svého vzniku na konci roku 2020 věnuje výrobě a prodeji sáčků všeho druhu. 
Naše nabídka zahrnuje jak tradiční plastové sáčky, tak moderní ekologické varianty, které reflektují rostoucí potřebu udržitelnosti. 
Naším cílem je spojit kvalitní zpracování, praktičnost a ohled na životní prostředí. 
Každý náš produkt je navržen tak, aby splňoval požadavky našich zákazníků – od domácností, přes malé firmy až po velké podniky.</p>
                    <h3>Proč si vybrat právě nás?</h3>
                    <p><strong>Rodinné hodnoty:</strong>Jsme firma, která staví na důvěře, osobním přístupu a dlouhodobých vztazích se zákazníky.</p>
                    <p><strong>Kvalitní produkty:</strong> Naše sáčky jsou vyráběny s důrazem na preciznost a odolnost.</p>
                    <p><strong>Ekologická alternativa:</strong>Nabízíme ekologické sáčky, které snižují dopad na životní prostředí a přispívají k udržitelnější budoucnosti.</p>
                    <h3>Naše mise</h3>
                    <p>Věříme, že i zdánlivě malé věci, jako jsou sáčky, mohou hrát velkou roli v každodenním životě. 
Proto chceme našim zákazníkům přinášet nejen praktická řešení, ale také možnost volby mezi tradičními a ekologickými produkty, které respektují planetu.</p>

                    <p>Děkujeme, že jste s námi na této cestě. Pokud hledáte sáčky, které splní vaše očekávání a podpoří rodinnou firmu s jasnou vizí, jste na správném místě.</p>
                    <p><strong>Těšíme se na spolupráci!</strong></p>
                    <p>Váš tým Fapol</p>
                </div>
            </div>
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
                    <p>Adresa: Jugoslávská 631/74, 613 00 Brno-sever-Černá Pole</p>
                    <p>IČ: 12345678</p>
                    <p>DIČ: CZ12345678</p>
                </div>
                <div style="flex: 1; min-width: 300px; text-align: center;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d563.3772196778308!2d16.622640541555562!3d49.20865858904723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47129461937e9887%3A0xdde6bc98af625c75!2zSnVnb3Nsw6F2c2vDoSA2MzEvNzQsIDYxMyAwMCBCcm5vLXNldmVyLcSMZXJuw6EgUG9sZQ!5e1!3m2!1scs!2scz!4v1734019421017!5m2!1scs!2scz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
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
// Košík -> Home page
window.onload = function() {
    navigateTo('domu');
};