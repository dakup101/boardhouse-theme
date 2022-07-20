// Loaded
console.log('--- Site Loaded ---')
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

// let ajaxUrl = 'http://localhost/boardhouse/wp-admin/admin-ajax.php'
let ajaxUrl = 'https://everywhere.pl/www/bh/wp-admin/admin-ajax.php'

// Rendered
window.addEventListener('DOMContentLoaded', ()=>{
    console.log('--- Site Rendered ---');
    
    handleAddToCart();
    handleQuantityInputs();
    cartStatusUpd();

    // Main Slider
    const hero = new Swiper('.hero', {
        modules: [Pagination, Navigation],
        direction: "horizontal",
        pagination: {
            el: '.hero__pagination',
            clickable: true,
            renderBullet: function (index, className) {
                if (index.toString().length<2) return '<span class="' + className + '">0' + (index + 1) + "</span>";
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            }
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    })
    // Detect product carousels and make them Swiper
    const buildCarousels = el => {
        let carouselId = el.dataset.slider;
        let container = '.product-carousel-' + carouselId;
        let paginationContainer = '.carousel-pagination-' + carouselId;
        console.log(container);
        const test = new Swiper(container, {
            modules: [Pagination],
            direction: "horizontal",
            slidesPerView: 6,
            slidesPerGroup: 6,
            loop: false,
            spaceBetween: 30,
            pagination: {
                el: paginationContainer,
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="transition-all hover:cursor-pointer ' + className + '"></span>';
                }
            }
        })
    }
    let carousels = document.querySelectorAll('.product-carousel');
    carousels.forEach(carousel => buildCarousels(carousel));

    

    let tooltipsParents = document.querySelectorAll('.has-tooltip');
    for (let tooltipParent of tooltipsParents){
        let tooltipTrigger = tooltipParent.querySelector('[data-tooltip_trigger]');
        let tooltip = tooltipParent.querySelector('[data-tooltip]');

        tooltipTrigger.addEventListener('mouseover', ()=>{
          tooltip.classList.add('flex');
          tooltip.classList.remove('hidden');
        })
        tooltipTrigger.addEventListener('mouseout', ()=>{
            tooltip.classList.remove('flex');
            tooltip.classList.add('hidden');
        })
    }

    let searchBtn = document.querySelector('[data-make_search]');
    let searchBar = document.querySelector('[data-searchform]');
    searchBtn.addEventListener('click', e => {
        e.preventDefault();
        searchBar.classList.toggle('hidden');
        if (!searchBar.classList.contains('hidden')){
            searchBtn.classList.add('active')
        }
        else{
            searchBtn.classList.remove('active')
        }
    })


    let goToPaymet = document.querySelector('[data-go_to_payment]');
    let placeOrder = document.querySelector('[data-place_order]');
    let customerInfo = document.querySelector('[data-customer_info]');
    let paymentShipping = document.querySelector('[data-payment_shipping]');
    let submitOrder = document.querySelector('[data-place_order]');
    let addrTitle = document.querySelector('[data_title_addr]');
    let payTitle = document.querySelector('[data_title_pay]');
    let deliveryAddr = document.querySelector('[data-delivery_addr]');
    let backToAddr = document.querySelector('[data-back_to_cust]');

    if (goToPaymet){
        goToPaymet.addEventListener('click', e=>{
        e.preventDefault();
        updateCheckoutProps();
        if (validateCustomer()){
            window.scrollTo(0,0);
            customerInfo.classList.add('hidden');
            goToPaymet.classList.add('hidden');
            addrTitle.classList.add('hidden');
            paymentShipping.classList.remove('hidden');
            placeOrder.classList.remove('hidden');
            payTitle.classList.remove('hidden');
            deliveryAddr.classList.remove('hidden');
            renderCheckoutItems();
        }
    })

    backToAddr.addEventListener('click', e => {
        e.preventDefault();
        window.scrollTo(0,0);
        customerInfo.classList.remove('hidden');
        goToPaymet.classList.remove('hidden');
        addrTitle.classList.remove('hidden');
        paymentShipping.classList.add('hidden');
        placeOrder.classList.add('hidden');
        payTitle.classList.add('hidden');
        deliveryAddr.classList.add('hidden');
    })

    submitOrder.addEventListener('click', e => {
        e.preventDefault();
        document.getElementById('place_order').click();
    })

    let checkout = {
        name: null,
        lastName: null,
        tel: null,
        email: null,
        street: null,
        city: null,
        code: null,
        country: "Poland"
    }

    let paymentDefaultDiv = document.querySelector('.shipping-boxes.payment').children[0] as HTMLLabelElement;
    let shippingDefaultDiv = document.querySelector('.shipping-boxes.shipping').children[0] as HTMLLabelElement;
    let paymentTemplate = paymentDefaultDiv.cloneNode(true) as HTMLLabelElement;
    let shippingTemplate = shippingDefaultDiv.cloneNode(true) as HTMLLabelElement;
    let boxesOverlay = document.querySelectorAll('[data-boxes_overlau]');

    document.addEventListener('update_checkout', ()=>{
        boxesOverlay.forEach((overlay) => {overlayToggleHidden(overlay)})
    })

    document.addEventListener('updated_checkout', ()=>{
        updateCheckoutProps();
        renderCheckoutItems();
        boxesOverlay.forEach((overlay) => {overlayToggleHidden(overlay)})
    })
    document.addEventListener('payment_method_selected', ()=>{
        renderCheckoutItems();
    })

    function overlayToggleHidden(overlay){
        overlay.classList.toggle('hidden');
    }

    function updateCheckoutProps(){
        checkout.name = (document.getElementById('billing_first_name') as HTMLInputElement).value;
        checkout.lastName = (document.getElementById('billing_last_name') as HTMLInputElement).value;
        checkout.tel = (document.getElementById('billing_phone') as HTMLInputElement).value;
        checkout.email = (document.getElementById('billing_email') as HTMLInputElement).value;
        checkout.street = (document.getElementById('billing_address_1') as HTMLInputElement).value;
        checkout.city = (document.getElementById('billing_city') as HTMLInputElement).value;
        checkout.code = (document.getElementById('billing_postcode') as HTMLInputElement).value;

        let name = deliveryAddr.querySelector('[data-name]');
        let street = deliveryAddr.querySelector('[data-street]');
        let addr = deliveryAddr.querySelector('[data-addr]');
        let country = deliveryAddr.querySelector('[data-country]');
        let tel = deliveryAddr.querySelector('[data-tel]');
        let email = deliveryAddr.querySelector('[data-email]');

        name.innerHTML = checkout.name + ' ' + checkout.lastName;
        street.innerHTML = checkout.street;
        addr.innerHTML = checkout.code + ' ' + checkout.city;
        country.innerHTML = checkout.country;
        tel.innerHTML = checkout.tel;
        email.innerHTML = checkout.email;

        console.log('--- Props Updated ---');
        console.log(checkout);
    }

    function renderCheckoutItems(){
        let shippingRadios = document.getElementsByName('shipping_method[0]');
        let paymentRadios = document.getElementsByName('payment_method');
        shippingDefaultDiv.classList.add('hidden');
        paymentDefaultDiv.classList.add('hidden');
        renderLabels(shippingRadios, '.shipping-boxes.shipping', shippingTemplate);
        renderLabels(paymentRadios, '.shipping-boxes.payment', paymentTemplate);

    }

    function renderLabels(radios : any, wrapperClassList : string, labelTemplate : HTMLLabelElement){
        let wrapper = document.querySelector(wrapperClassList);
        wrapper.innerHTML = '';
        radios.forEach((radio : HTMLInputElement)=>{
            let template = labelTemplate.cloneNode(true) as HTMLLabelElement;
            console.log(radio);
            let i = 0;
            let rFor = radio.id;
            let rLable = radio.parentNode.children[1].innerHTML;
            let rImg = (radio.parentNode.children[2] as HTMLElement).dataset.shipping_img;
            if (radio.checked) template.classList.add('active')
            template.setAttribute("for", rFor);
            template.querySelector('[data-box_text]').innerHTML = rLable;
            template.querySelector('[data-box_img]').setAttribute("src", rImg);
            if (i===0) wrapper.appendChild(template);
            i++;
            console.log(wrapper.children);
        })
    }

    function validateCustomer(){
        if (!checkout.name){
            alert('Nie podałeś(-aś) imienia')
            return false;
        }
        if (!checkout.lastName){
            alert('Nie podałeś(-aś) nazwiska')
            return false;
        }
        if (!checkout.tel){
            alert('Nie podałeś(-aś) numeru telefonu')
            return false;
        }
        if (!checkout.email){
            alert('Nie podałeś(-aś) adresu email')
            return false;
        }
        if (!checkout.street){
            alert('Nie podałeś(-aś) ulicę')
            return false;
        }
        if (!checkout.city){
            alert('Nie podałeś(-aś) miasta')
            return false;
        }
        if (!checkout.code){
            alert('Nie podałeś(-aś) kodu pocztowego')
            return false;
        }
        return true;
    }
    }

    document.addEventListener('updated_wc_div', ()=>{
        cartStatusUpd();
        handleQuantityInputs();
    })
})



function cartStatusUpd(){
    let statusWrapper = document.querySelector('[data_cart-status]');
    if (!statusWrapper) return null;

    let statusBar = statusWrapper.querySelector('[data-status_bar]') as HTMLElement;
    let statusSvg = statusWrapper.querySelector('[data-cart_status_svg]');
    let statusText = statusWrapper.querySelector('[data-status_bar_text]');
    
    statusSvg.classList.add('shakey');
    statusWrapper.classList.add('opacity-50')
    const data = new FormData();
    data.append('action', 'fetch_status');
    fetch(ajaxUrl, {
        method: "POST",
        body: data,
        credentials: 'same-origin',
    })
    .then(response => response.json()) 
    .then(json => {
        handleStatus(json)
        statusWrapper.classList.remove('opacity-50')
        statusSvg.classList.remove('shakey');
    });

    function handleStatus(status){
        if (status.remains == 0) {
            statusText.textContent = 'Obowiązuje Cię darmowa wysyłka'
            statusBar.classList.remove('bg-orange')
            statusBar.classList.add('bg-green')
        }
        else{
            statusBar.classList.add('bg-orange')
            statusBar.classList.remove('bg-green')
            statusText.textContent = 'Do darmowej dostawy brakuje ' + status.remains + ' zł'
        }
        statusBar.style.width=status.percent+"%";
    }
}

function handleQuantityInputs(){
    let quantityWrappers = document.querySelectorAll('.product .quantity');
    if (quantityWrappers.length>0){
        for(let quantityWrapper of quantityWrappers){
            let quantityInput = quantityWrapper.getElementsByTagName('input')[0] ;
            let quantityUp = quantityWrapper.querySelector('[data-up]');
            let quantityDown = quantityWrapper.querySelector('[data-down]');

            quantityUp.addEventListener('click', e => {
                e.preventDefault();
                let currentValue = parseInt(quantityInput.value);
                currentValue ++;
                quantityInput.value = currentValue.toString();
                let updBtn = document.getElementsByName('update_cart')[0];
                if (updBtn) updBtn.removeAttribute('disabled');
            })

            quantityDown.addEventListener('click', e => {
                e.preventDefault();
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) currentValue--;
                quantityInput.value = currentValue.toString();
                let updBtn = document.getElementsByName('update_cart')[0];
                if (updBtn) updBtn.removeAttribute('disabled');
            })
        }
    }
}
function handleAddToCart(){
    let btn = document.querySelector('.single_add_to_cart_button');
    if (!btn) return

    btn.addEventListener('click', e=>{
        e.preventDefault();
        let target = e.currentTarget as HTMLButtonElement;
        let targetParent = target.parentNode;
        let isVariable = target.value ? false : true;
        let quantity = targetParent.querySelector('[name="quantity"]');
        if (isVariable) {
            let productId = targetParent.querySelector('[name="product_id"]');
            let variationId = targetParent.querySelector('[name="variation_id"]');
            if (!productId && !variationId) return;
            addVariableProduct((productId as HTMLInputElement).value, (variationId as HTMLInputElement).value, (quantity as HTMLInputElement).value, btn)
        }
    })

    let closeBtn = document.querySelector('[data-close_cart_popup]');
    closeBtn.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('[data-cart_popup]').classList.add('hidden');
    })
}
function addVariableProduct(product_id, variation_id, quantity, btn){
    btn.textContent = "Dodaję produkt..."
    console.log('--- Add Variable Product to Cart ---');
    const data = new FormData();
    data.append('action', 'add_variable');
    data.append('product_id', product_id);
    data.append('variation_id', variation_id);
    data.append('quantity', quantity)
    fetch(ajaxUrl, {
        method: "POST",
        body: data,
        credentials: 'same-origin',
    })
    .then(response => response.json()) 
    .then(json => {
        handleCartPopup(json, quantity, btn);
    });
}
function addProduct(add_to_cart){
    console.log('--- Add Simple Product to Cart ---')
}
function handleCartPopup(add_response, quantity, btn){
    if (!add_response[0]) {
        console.log('--- Product NOT added to cart ');
        btn.textContent = "Dodaj do koszyka"
        return;
    }
    console.log('--- Product Added To Cart ---');
    btn.textContent = "Dodano produkt"
    btn.blur()
    console.log('--- Handle Cart PopUp ---');
    let addToCartPopup = document.querySelector('[data-cart_popup]');
    addToCartPopup.classList.remove('hidden');
    let popupCart = addToCartPopup.querySelector('[data-cp_cart]');
    popupCart.classList.add('loading');
    const data = new FormData();
    data.append('action', 'html_cart');
    fetch(ajaxUrl, {
        method: "POST",
        body: data,
        credentials: 'same-origin',
    })
    .then(response => response.text()) 
    .then(text => {
        popupCart.innerHTML = text;
        popupCart.classList.remove('loading');
        cartStatusUpd();
    });
}
function getUserCartItems(){
    console.log('--- Get User Cart Items ---')
}