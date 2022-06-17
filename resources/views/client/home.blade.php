@extends('layouts.welcome')

@section('content')
    @if(session('success'))

    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-2">
                                <label for="search">{{ __('Search') }}:</label>
                                <input type="text" id="search" name="search" class="form-control">

                                <button class="text-center navbar-toggler w-100 d-none" data-bs-toggle="collapse" data-bs-target="#menu-filter" aria-controls="menu-filter" aria-expanded="false" aria-label="Toggle Filter">
                                    <span>&#9660;</span>
                                </button>
                                <div class="w-100 collapse navbar-collapse" id="menu-filter">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <div class="mt-3">
                                                <b>{{ __('Categories') }}</b>
                                                @foreach($types as $type)
                                                    <div class="mt-1 mb-1">
                                                        <input type="radio" id="radioType{{ $type->id }}" class="radioType" value="{{ $type->id }}" name="type">{{ $type->name }}
                                                    </div>
                                                @endforeach
                                                <span class="link-primary refresh-filters" id="refresh-category">{{ __('Refresh category filter') }}</span>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="mt-3">
                                                <b>{{ __('Price') }}</b>
                                                <div class="mt-1 mb-1">
                                                    <input type="radio" id="radioPrice1" class="radioPrice" value="0,20" name="price">
                                                    <label for="price">0 - 20 EUR</label>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <input type="radio" id="radioPrice2" class="radioPrice" value="20,50" name="price">
                                                    <label for="price">20 - 50 EUR</label>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <input type="radio" id="radioPrice3" class="radioPrice" value="50,100" name="price">
                                                    <label for="price">50 - 100 EUR</label>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <input type="radio" id="radioPrice4" class="radioPrice" value="100,200" name="price">
                                                    <label for="price">100 - 200 EUR</label>
                                                </div>
                                                <span class="link-primary refresh-filters" id="refresh-price">{{ __('Refresh price filter') }}</span>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="mt-3">
                                                <b>{{ __('Availability') }}</b>
                                                <div class="mt-1 mb-1">
                                                    <input type="checkbox" id="checkStock" value="true" name="checkStock">{{ __('Include out of stock') }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="normal-menu">
                                    <div class="mt-3">
                                        <b>{{ __('Categories') }}</b>
                                        @foreach($types as $type)
                                            <div class="mt-1 mb-1">
                                                <input type="radio" id="radioType{{ $type->id }}" class="radioType" value="{{ $type->id }}" name="type">{{ $type->name }}
                                            </div>
                                        @endforeach
                                        <span class="link-primary refresh-filters" id="refresh-category">{{ __('Refresh category filter') }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <b>{{ __('Price') }}</b>
                                        <div class="mt-1 mb-1">
                                            <input type="radio" id="radioPrice1" class="radioPrice" value="0,20" name="price">
                                            <label for="price">0 - 20 EUR</label>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <input type="radio" id="radioPrice2" class="radioPrice" value="20,50" name="price">
                                            <label for="price">20 - 50 EUR</label>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <input type="radio" id="radioPrice3" class="radioPrice" value="50,100" name="price">
                                            <label for="price">50 - 100 EUR</label>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <input type="radio" id="radioPrice4" class="radioPrice" value="100,200" name="price">
                                            <label for="price">100 - 200 EUR</label>
                                        </div>
                                        <span class="link-primary refresh-filters" id="refresh-price">{{ __('Refresh price filter') }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <b>{{ __('Availability') }}</b>
                                        <div class="mt-1 mb-1">
                                            <input type="checkbox" id="checkStock" value="true" name="checkStock">{{ __('Include out of stock') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-12">
                                <div id="product-container" class="row">
                                    @foreach($products as $product)
                                        @if($product->stock > 0)
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="card product-card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->name }}</h5>
                                                        <p class="card-text">{{ $product->description }}</p>
                                                        @if(Auth::check() && Auth::user()->roles()->first()->name === 'Client')
                                                            <button id="show-product" onclick="showProduct({{ $product }}, '{{ $images[$product->id] }}')" class="btn btn-primary">{{ __('Show product') }}</button>
                                                        @else
                                                            <a href="{{ route('login') }}" id="show-product" class="btn btn-primary">{{ __('Show product') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let buttonRefreshCategory = document.getElementById('refresh-category');
        let buttonRefreshPrice = document.getElementById('refresh-price');
        let inputSearch = document.getElementById('search');

        buttonRefreshCategory.addEventListener('click', refreshCategory);
        buttonRefreshPrice.addEventListener('click', refreshPrice);
        inputSearch.onkeyup = function() { search() };

        for (let i=0;i<document.getElementsByName('price').length;i++) {
            document.getElementsByName('price')[i].addEventListener('change', search);
        }

        for (let i=0;i<document.getElementsByName('type').length;i++) {
            document.getElementsByName('type')[i].addEventListener('change', search);
        }

        document.getElementById('checkStock').addEventListener('change', search);

        let showProductButton = document.getElementById('show-product');
        showProductButton.addEventListener('click', (e) => showProduct(e));

        function refreshCategory() {
            for(let i=1; i<=4; i++) {
                if (document.getElementById("radioType"+i+"").checked === true) {
                    document.getElementById("radioType"+i+"").checked = false;
                }
            }
            search();
        }

        function refreshPrice() {
            for(let i=1; i<=4; i++) {
                if (document.getElementById("radioPrice"+i+"").checked === true) {
                    document.getElementById("radioPrice"+i+"").checked = false;
                }
            }
            search();
        }

        function search() {
            let searchValue = inputSearch.value.trim();
            let categoryValue;
            let priceValue;
            let arrayPrice;
            let checkStock = document.getElementById('checkStock');
            let boolStock;

            for(let i=1; i<=4; i++) {
                if (document.getElementById("radioType"+i+"").checked === true) {
                    categoryValue = document.getElementById("radioType"+i+"").value;
                }
            }

            for(let i=1; i<=4; i++) {
                if (document.getElementById("radioPrice"+i+"").checked === true) {
                    priceValue = document.getElementById("radioPrice"+i+"").value;
                    arrayPrice = priceValue.split(',');
                }
            }

            if (checkStock.checked === true) {
                boolStock = 1;
            }else {
                boolStock = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'{{ route('search.product') }}',
                data:{search: searchValue, category: categoryValue, price: arrayPrice, stock: boolStock},
                type:'POST',
                success: function (response) {
                    if (response.length === 0) {
                        document.getElementById('product-container').innerHTML = '';

                        let container = document.createElement('DIV');
                        container.classList.add('flex');
                        container.classList.add('not-found');
                        container.innerHTML = '{{ __('No products found') }}';

                        document.getElementById('product-container').appendChild(container);
                    }else {
                        document.getElementById('product-container').innerHTML = '';
                        for (let i=0; i<response.length; i++) {
                            let container = document.createElement('DIV');
                            container.classList.add('col-md-4');
                            container.classList.add('col-sm-6');
                            container.classList.add('col-12');

                            let divCard = document.createElement('DIV');
                            divCard.classList.add('card');
                            divCard.classList.add('product-card');

                            let cardBody = document.createElement('DIV');
                            cardBody.classList.add('card-body');

                            let cardTitle = document.createElement('H5');
                            cardTitle.classList.add('card-title');
                            cardTitle.classList.add('card-title-product');
                            cardTitle.innerHTML = response[i]['name'];

                            let cardDescription = document.createElement('P');
                            cardDescription.classList.add('card-text');
                            cardDescription.innerHTML = response[i]['description'];

                            let showProductButton = document.createElement('BUTTON');
                            showProductButton.classList.add('btn');
                            showProductButton.classList.add('btn-primary');
                            showProductButton.setAttribute('id', 'show-product')
                            showProductButton.innerHTML = '{{ __('Show product') }}';
                            showProductButton.addEventListener('click', () => showProduct(response[i]));

                            cardBody.appendChild(cardTitle);
                            cardBody.appendChild(cardDescription);
                            cardBody.appendChild(showProductButton);

                            divCard.appendChild(cardBody);

                            container.appendChild(divCard);

                            if (response[i]['stock'] === 0) {
                                let divSoldOut = document.createElement('DIV');
                                divSoldOut.classList.add('sold-out');
                                divSoldOut.innerHTML = '&times';

                                cardTitle.appendChild(divSoldOut);
                            }

                            document.getElementById('product-container').appendChild(container);
                        }
                    }
                },
            });
        }

        function showProduct(product, image) {
            if (product.stock > 0) {
                Swal.fire({
                    customClass: {
                        popup: 'product-modal-popup',
                        titleText: 'product-modal-title',
                        title: 'd-none',
                        htmlContainer: 'product-modal-container',
                        actions: 'd-none'
                    },
                    html:
                        "<div class='img-container'>" +
                        "<img src="+image+" class='product-modal-img' alt='" + product.name + "'>" +
                        "</div>" +
                        "<div class='text-container'>" +
                        "<h3><b>" + product.name + "</b></h3>" +
                        "<p style='text-align: start; margin: 10px 0 0 0; font-size: 1.125rem'>" + product.description + "</p>" +
                        "<p><h4>" + product.price + "€</h4></p>" +
                        "<p>{{ __('Available stock') }}: " + product.stock + "</p>" +
                        "<div>" +
                        "<button type='button' class='btn btn-secondary btn-subtract' onclick='subtractOrder()'>-</button>" +
                        "<input type='text' id='order-amount' class='order-amount' value='1' min='1' max='" + product.stock + "' onchange='checkStock(" + product.stock + ")'>" +
                        "<button type='button' class='btn btn-secondary btn-add' onclick='addOrder(" + product.stock + ")'>+</button>" +
                        "</div>" +
                        "<div style='margin-top: 25px'>"+
                        "<button type='button' class='btn btn-primary' onclick='addCart("+JSON.stringify(product)+")' style='margin-right: 10px'>{{ __('Add to cart') }}</button>"+
                        "<button type='button' class='btn btn-secondary' onclick='Swal.close(); return false;'>{{ __('Cancel') }}</button>"+
                        "</div>"+
                        "</div>",
                })
            }else {
                Swal.fire({
                    customClass: {
                        popup: 'product-modal-popup',
                        titleText: 'product-modal-title',
                        title: 'd-none',
                        htmlContainer: 'product-modal-container'
                    },
                    html:
                        "<div class='img-container'>" +
                        "<img src="+image+" class='product-modal-img' alt='" + product.name + "'>" +
                        "</div>" +
                        "<div class='text-container'>" +
                        "<h3><b>" + product.name + "</b></h3>" +
                        "<h5><p style='text-align: start; margin-top: 10px'>" + product.description + "<p></h5><hr style='width: 100%'>" +
                        "<p><h4>" + product.price + "€</h4></p>" +
                        "<p>{{ __('Available stock') }}: {{ __('Sold out') }}</p>" +
                        "</div>",
                })
            }
        }

        function checkStock(stock) {
            if (parseInt(document.getElementById('order-amount').value) > stock) {
                document.getElementById('order-amount').value = stock;
            }
        }

        function subtractOrder() {
            if (document.getElementById('order-amount').value !== '1') {
                document.getElementById('order-amount').value--;
            }
        }

        function addOrder(stock) {
            if (parseInt(document.getElementById('order-amount').value) < stock) {
                document.getElementById('order-amount').value++;
            }
        }

        function addCart(product) {
            let shoppingCart = document.getElementById('shopping-cart');
            let spanTotal = document.getElementById('total');

            let totalPrice = parseFloat(spanTotal.textContent);

            let find = false;

            if (shoppingCart.children.length !== 2) {
                for (let i=0; i<shoppingCart.children.length; i++) {
                    if (shoppingCart.children[i].nodeName === 'LI') {
                        if (shoppingCart.children[i].firstChild.textContent === product.name) {
                            find = true;

                            let sumTotalQuantity = parseInt(shoppingCart.children[i].firstChild.nextSibling.textContent) + parseInt(document.getElementById('order-amount').value);

                            if (sumTotalQuantity > parseInt(product.stock)) {
                                Swal.close();

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-start',
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: "{{__('You have selected more quantity of product')}}: "+product.name+" {{__('than stock for sale')}}"
                                });
                            } else {
                                shoppingCart.children[i].firstChild.nextSibling.innerHTML = sumTotalQuantity;

                                totalPrice += (parseInt(document.getElementById(product.name+'-quantity').textContent)*parseFloat(product.price));

                                Swal.close();
                            }
                        }
                    }
                }
            }

            if(find === false) {
                let shoppingCartItem = document.createElement('LI');
                shoppingCartItem.classList.add('list-group-item');
                shoppingCartItem.classList.add('d-flex');
                shoppingCartItem.classList.add('justify-content-between');
                shoppingCartItem.classList.add('align-items-start');
                shoppingCartItem.classList.add('product-li');

                let productContainer = document.createElement('DIV');
                productContainer.classList.add('ms-2');
                productContainer.classList.add('me-auto');

                let productName = document.createElement('DIV');
                productName.classList.add('fw-bold');
                productName.innerHTML = product.name;

                let quantityInput = document.createElement('SPAN');
                quantityInput.setAttribute('id', product.name+'-quantity');
                quantityInput.classList.add('badge');
                quantityInput.classList.add('bg-primary');
                quantityInput.classList.add('rounded-pill');
                quantityInput.innerHTML = document.getElementById('order-amount').value;

                productContainer.appendChild(productName);
                shoppingCartItem.appendChild(productContainer);
                shoppingCartItem.appendChild(quantityInput);

                shoppingCart.insertBefore(shoppingCartItem, shoppingCart.firstChild);

                if (shoppingCart.lastChild.nodeName !== 'DIV') {
                    let divButtons = document.createElement('DIV');
                    divButtons.setAttribute('id', 'action-btns');

                    let buttonPay = document.createElement('BUTTON');
                    buttonPay.setAttribute('type', 'button');
                    buttonPay.classList.add('btn');
                    buttonPay.classList.add('btn-success');
                    buttonPay.setAttribute('onclick', "doCheckout()");
                    buttonPay.innerHTML = "{{ __('Checkout') }}";

                    let buttonDelete = document.createElement('BUTTON');
                    buttonDelete.setAttribute('type', 'button');
                    buttonDelete.classList.add('btn');
                    buttonDelete.classList.add('btn-danger');
                    buttonDelete.setAttribute('onclick', "deleteCart()");
                    buttonDelete.innerHTML = "{{ __('Delete cart') }}";

                    divButtons.appendChild(buttonPay);
                    divButtons.appendChild(buttonDelete);

                    shoppingCart.appendChild(divButtons);
                }

                totalPrice += (parseInt(document.getElementById(product.name+'-quantity').textContent)*parseFloat(product.price));

                Swal.close();
            }

            spanTotal.innerHTML = parseFloat(totalPrice);
        }

        function deleteCart() {
            let spanTotal = document.getElementById('total');
            let products = document.getElementsByClassName('product-li');

            do {
                products[0].remove();
            } while(products.length >= 1);

            spanTotal.innerHTML = '0';
            document.getElementById('action-btns').remove();

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-start',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });

            Toast.fire({
                icon: 'success',
                title: "{{__('Cart delete successfully')}}"
            });
        }

        function doCheckout() {
            let shoppingCart = document.getElementById('shopping-cart');

            let totalPrice = parseFloat(document.getElementById('total').textContent);

            let products = [];

            for (let i=0; i<shoppingCart.children.length; i++) {
                if (shoppingCart.children[i].nodeName === 'LI') {
                    products[i] = {name: shoppingCart.children[i].children[0].textContent, quantity: parseInt(shoppingCart.children[i].children[1].textContent)};
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'{{ route('checkout.cart') }}',
                data:{products: products, total: totalPrice, user: @if(Auth::check()){{ Auth::user()->id }}@endif},
                type:'POST',
                success: function (response) {
                    console.log(response);
                    deleteCart();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-start',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'success',
                        title: "{{__('Order placed')}}"
                    });
                },
            });
        }
    </script>
@endpush
