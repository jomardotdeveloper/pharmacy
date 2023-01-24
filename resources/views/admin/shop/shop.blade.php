@extends("layouts.admin-master")
@section("title", "Shop")
@section("custom-styles")
<link href="/admin/assets/css/dashboard/dashboard_2.css" rel="stylesheet" type="text/css">
<script src="/admin/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="/admin/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link href="/admin/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/css/basic-ui/custom_sweetalert.css" rel="stylesheet" type="text/css">
<link href="/admin/plugins/animate/animate.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/css/tables/tables.css" rel="stylesheet" type="text/css">
<link href="/admin/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/css/basic-ui/tour_tutorial.css" rel="stylesheet" type="text/css">
<link href="/admin/plugins/hopscotch/hopscotch.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/dt-global_style.css">
@endsection
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><span>Shop</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div id="app">
    <div class="layout-top-spacing mb-2">
        <div class="row">
            <div class="col-md-4 mt-1">
                <div class="widget">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-user"></i>
                            </span>
                        </div>
                        <h5 class="font-size-14 mb-0 text-primary">
                            Cashier
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted text-truncate mb-2">User</p>
                            <h2 class="mb-0"> {{ ucfirst(auth()->user()->username) }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-1">
                <div class="widget">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-coins"></i>
                            </span>
                        </div>
                        <h5 class="font-size-14 mb-0 text-primary">
                            Sales today
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted text-truncate mb-2">Sales</p>
                            <h2 class="mb-0">@{{ sales  }} </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-1">
                <div class="widget">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-coins"></i>
                            </span>
                        </div>
                        <h5 class="font-size-14 mb-0 text-primary">
                            Discount & VAT
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted text-truncate mb-2">Tax</p>
                            <div class="form-group">
                                <select name="tax" id="tax" class="form-control" @change="onChangeTax($event)">
                                    <option value="NULL">
                                        No tax
                                    </option>
                                    @foreach ($taxes as $tax)
                                        <option value="{{ $tax->percentage }}">
                                            {{ $tax->name }} ({{ $tax->percentage }}%)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="text-muted text-truncate mb-2">Discount</p>
                            <div class="form-group">
                                <select name="discount" id="discount" class="form-control" @change="onChangeDiscount($event)">
                                    <option value="NULL">
                                        No discount
                                    </option>
                                    <option value="FIXED_PRICE">
                                        Enter fixed price
                                    </option>
                                    @foreach ($discounts as $discount)
                                        <option value="{{ $discount->percentage }}">
                                            {{ $discount->name }} ({{ $discount->percentage }}%)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" name="fixed_price" id="fixed_price"  @change="onChangeFixedPrice($event)" class="form-control" placeholder="Enter discount value" v-if="transaction.is_fixed_price">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-8 mt-1">
                <div class="widget">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-boxes"></i>
                            </span>
                        </div>
                        <h5 class="font-size-14 mb-0 text-primary">
                            Products
                        </h5>
                    </div>
                    <div class="table-responsive mb-4">
                        <table id="basic-dt" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stocks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products">
                                    <td>@{{ product.full_name }}</td>
                                    <td>@{{ product.category }}</td>
                                    <td>@{{ product.stocks }}</td>
                                    <td>
                                        <a href="#" title="Cart" v-on:click="addToCart(product)" class="font-20 text-success">
                                            <i class="las la-shopping-cart"></i>
                                        </a>
                                        <a href="#" title="Info" v-on:click="info(product)" class="font-20 text-warning">
                                            <i class="las la-question"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stocks</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-1">
                <div class="widget">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-money-bill"></i>
                            </span>
                        </div>
                        <h5 class="font-size-14 mb-0 text-primary">
                            Total
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted text-truncate mb-2">Total Cost</p>
                            <h2 class="mb-0"> ₱@{{ transaction.total_cost }} </h2>
                            <p class="text-muted text-truncate mb-2">VAT</p>
                            <h2 class="mb-0"> @{{ transaction.tax }}% </h2>
                            <p class="text-muted text-truncate mb-2">Discount</p>
                            <h2 class="mb-0" v-if="transaction.is_fixed_price">₱ @{{ transaction.fixed_price }} </h2>
                            <h2 class="mb-0" v-if="!transaction.is_fixed_price"> @{{ transaction.discount }}% </h2>
                            <p class="text-muted text-truncate mb-2">Total Cost W/ VAT & Discount</p>
                            <h2 class="mb-0"> ₱@{{ transaction.total_cost_vat_inc_disc }} </h2>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" style="margin-top:1.7rem;" v-on:click="checkout">Checkout</button>
                            <button class="btn btn-warning" style="margin-top:1.7rem;" data-toggle="modal" data-target="#cartModal">Cart</button>
                            <button class="btn btn-danger" style="margin-top:1.7rem;" v-on:click="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART MODAL -->
    <div id="cartModal" class="modal animated fadeInDown" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center" id="cartList">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Cost</th>
                                    <th>Total Cost</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in cart">
                                    <td>@{{ product.product.full_name }}</td>
                                    <td>@{{ product.unit.val }}</td>
                                    <td>@{{ product.quantity }}</td>
                                    <td>₱@{{ product.singleCost }}</td>
                                    <td>₱@{{ product.cost }}</td>
                                    <td>
                                        <a href="#" title="Remove" v-on:click="removeItem(product)" class="font-20 text-danger">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CHECKOUT -->
    <div id="paymentModal" class="modal animated fadeInDown" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Payment
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="payment" id="payment" placeholder="Payment" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="confirmCheckout"><i class="flaticon-cancel-12"></i>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="voidModal" class="modal animated fadeInDown" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Void Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Void Password
                                    <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="void_password" id="void_password" placeholder="Void Password" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="voidPassword"><i class="flaticon-cancel-12"></i>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- RECEIPT MODAL -->
    <div id="receiptModal" class="modal animated fadeInDown" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-uppercase">Receipt</h1>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1" v-if="receipt.date">@{{ receipt.date }}</span></div>
                        </div>
                        <div class="col-md-6 text-right mt-3">
                            <h4 class="text-danger mb-0">Madelyn's Pharmacy</h4><span></span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Cost</th>
                                        <th>Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in cart">
                                        <td>@{{ product.product.full_name }}</td>
                                        <td>@{{ product.unit.val }}</td>
                                        <td>@{{ product.quantity }}</td>
                                        <td>₱@{{ product.singleCost }}</td>
                                        <td>₱@{{ product.cost }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6>Total</h6>
                                            <h6>Payment</h6>
                                            <h6>Change</h6>
                                        </td>
                                        <td>
                                            <h6>₱@{{ transaction.total_cost }}</h6>
                                            <h6>₱@{{ receipt.payment }}</h6>
                                            <h6>₱@{{ receipt.change }}</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" v-on:click="closeReceipt"><i class="flaticon-cancel-12"></i>Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ENTER QTY AND UNIT MODAL -->
    <div id="qtyModal" class="modal animated fadeInDown" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="cartQty.product">Add to cart @{{ cartQty.product.full_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Unit
                                    <span class="text-danger">*</span></label>
                                <select class="form-control basic" name="unit" id="unit" required>
                                    <option v-for="unit in cartQty.units" :value="unit.key">
                                        @{{ unit.val }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Quantity
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="confirmCart"><i class="flaticon-cancel-12"></i>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push("custom-scripts")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/admin/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="/admin/assets/js/basicui/sweet_alerts.js"></script>
    <script src="/admin/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="/admin/plugins/hopscotch/hopscotch.js"></script>
    <script src="/admin/assets/js/basicui/notifications.js"></script>
    <script src="/admin/plugins/table/datatable/datatables.js"></script>
    <script src="/admin/assets/js/internal-dt/category.js"></script>
    <script src="/admin/assets/js/shop/control.js"></script>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                sales: "{{ count(auth()->user()->sales) }}",
                dt : undefined,
                transaction: {
                    total_cost: 0,
                    tax: 0,
                    discount: 0,
                    total_cost_vat_inc_disc : 0,
                    is_fixed_price : false,
                    fixed_price : 0,
                    void_password : "{{ $void_password }}",
                    temp_prod : undefined
                },
                cartQty: {
                    product: undefined,
                    qty: 0,
                    units: []
                },
                cart: [],
                receipt: {
                    payment: 0,
                    change: 0,
                    date: undefined
                },
                products: []
            },
            methods: {
                onChangeTax : function (event) {
                    this.transaction.tax = event.target.value == "NULL" ? 0 : event.target.value;
                    this.computeTotalCost();
                },
                onChangeDiscount : function (event) {
                    if(event.target.value != "FIXED_PRICE"){
                        this.transaction.discount = event.target.value == "NULL" ? 0 : event.target.value;
                        this.transaction.is_fixed_price = false;
                        this.transaction.fixed_price = 0;
                    }else{
                        this.transaction.is_fixed_price = true;
                    }

                    this.computeTotalCost();
                    
                },
                onChangeFixedPrice : function (event) {
                    this.transaction.fixed_price = event.target.value;
                    this.computeTotalCost();
                },
                computeTotalCost : function () {
                    var taxPercentage = this.transaction.tax / 100;
                    var discountPercentage = this.transaction.discount / 100;
                    var taxAmount = this.transaction.total_cost * taxPercentage;
                    var discountAmount = this.transaction.total_cost * discountPercentage;
                    if(this.transaction.is_fixed_price){
                        this.transaction.total_cost_vat_inc_disc = (this.transaction.total_cost + taxAmount) - this.transaction.fixed_price;
                    }else{
                        this.transaction.total_cost_vat_inc_disc = (this.transaction.total_cost + taxAmount) - discountAmount;
                    }
                    
                    
                },
                voidPassword : async function(){
                    if(this.transaction.void_password == document.getElementById("void_password").value){
                        var product = this.transaction.temp_prod;
                        this.transaction.total_cost -= product.cost;
                        var index = this.cart.indexOf(product);
                        this.cart.splice(index, 1);
                        $("#voidModal").modal("hide");
                        alertSuccess("Product removed.");
                        this.transaction.temp_prod = undefined;
                        await this.fetchData();
                    }else{
                        alertError("Incorrect Void Password");
                    }
                },
                removeItem: async function(product) {
                    this.transaction.temp_prod = product;
                    $("#cartModal").modal("hide");
                    $("#voidModal").modal("show");
                },
                checkout: function() {
                    if (this.cart.length < 1) {
                        alertError("Cart is empty.");
                    } else {
                        $("#paymentModal").modal("show");
                    }
                },

                confirmCheckout: async function() {
                    if (parseFloat($("#payment").val()) < this.transaction.total_cost_vat_inc_disc) {
                        alertError("Payment is not enough.");
                    } else {
                        this.receipt.date = "{{ date('F d, Y') }}";
                        this.receipt.payment = parseFloat($("#payment").val());
                        this.receipt.change = this.receipt.payment - this.transaction.total_cost_vat_inc_disc;
                        alertLoader();
                        await this.checkoutShop({
                            tax : this.transaction.tax,
                            discount : this.transaction.discount,
                            payment: this.receipt.payment,
                            change: this.receipt.change,
                            products: this.cart
                        });
                        swal.close();
                        $("#payment").val("");
                        $("#paymentModal").modal("hide");
                        $("#receiptModal").modal("show");

                    }
                },
                closeReceipt: async function() {
                    $("#receiptModal").modal("hide");
                    this.cart = [];
                    this.cartQty = {
                        product: undefined,
                        qty: 0,
                        units: []
                    };
                    this.receipt = {
                        payment: 0,
                        change: 0,
                        date: undefined
                    };
                    this.transaction.total_cost = 0;
                    await this.fetchData();
                    this.sales = "{{ count(auth()->user()->sales) }}";
                },
                reset: async function() {
                    var self = this;
                    if (this.cart.length < 1) {
                        alertError("Cart is empty.");
                    } else {
                        alertRevert(async function() {
                            self.cart = [];
                            self.cartQty = {
                                product: undefined,
                                qty: 0,
                                units: []
                            };
                            self.receipt = {
                                payment: 0,
                                change: 0,
                                date: undefined
                            };
                            self.transaction.total_cost = 0;
                            await self.fetchData();
                            alertSuccess("Transaction was reset.");
                        });
                    }

                },
                addToCart: function(product) {
                    this.cartQty.product = product;
                    this.cartQty.qty = product.stocks;
                    this.cartQty.units = this.getUnits(product);
                    $("#qtyModal").modal("show");
                },
                confirmCart: async function() {
                    var quantity = $("#quantity").val();
                    var units = this.cartQty.units;
                    if (quantity.length === 0) {
                        alertError("Quantity must not be empty.");
                    } else if (parseInt(quantity) < 1) {
                        alertError("Quantity must not be 0.");
                    } else {
                        var pcUnit = undefined;
                        var bundleUnit = undefined;
                        var halfUnit = undefined;

                        var currentUnit = undefined;
                        var unitQty = 0;
                        var unitCost = 0;
                        var costPer = 0;

                        for (var i = 0; i < units.length; i++) {
                            if (units[i].key == "pc") {
                                pcUnit = units[i];
                            } else if (units[i].key == "bundle") {
                                bundleUnit = units[i];
                            } else if (units[i].key == "half") {
                                halfUnit = units[i];
                            }
                        }
                        if ($("#unit").val() == "pc") {
                            if ((pcUnit.qty * parseInt(quantity)) > this.cartQty.product.stocks) {
                                alertError("Insufficient stocks.");
                                return;
                            } else {
                                unitQty = (pcUnit.qty * parseInt(quantity));
                                unitCost = parseInt(quantity) * this.cartQty.product.cost.pc;
                                costPer = pcUnit.cost;
                                currentUnit = pcUnit;
                            }

                        } else if ($("#unit").val() == "bundle") {
                            if ((bundleUnit.qty * parseInt(quantity)) > this.cartQty.product.stocks) {
                                alertError("Insufficient stocks.");
                                return;
                            } else {
                                unitQty = (bundleUnit.qty * parseInt(quantity));
                                unitCost = parseInt(quantity) * this.cartQty.product.cost.bundle;
                                costPer = bundleUnit.cost;
                                currentUnit = bundleUnit;
                            }

                        } else if ($("#unit").val() == "half") {
                            if ((halfUnit.qty * parseInt(quantity)) > this.cartQty.product.stocks) {
                                alertError("Insufficient stocks.");
                                return;
                            } else {
                                unitQty = (halfUnit.qty * parseInt(quantity));
                                unitCost = parseInt(quantity) * this.cartQty.product.cost.half;
                                costPer = halfUnit.cost;
                                currentUnit = halfUnit;
                            }
                        } else {
                            alertError("Insufficient stocks.");
                        }
                        

                        var isTobeUpdated = false;

                        for(var i = 0; i < this.cart.length; i++) {
                            if(this.cart[i].product.id == this.cartQty.product.id && this.cart[i].unit.val == currentUnit.val) {
                                isTobeUpdated = true;
                                this.cart[i].quantity = parseFloat(this.cart[i].quantity) + parseFloat($("#quantity").val());
                                this.cart[i].cost += unitCost;
                            }
                        }

                        if(!isTobeUpdated){
                            this.cart.push({
                                product: this.cartQty.product,
                                unit: currentUnit,
                                unitQty: unitQty,
                                cost: unitCost,
                                singleCost: costPer,
                                quantity: $("#quantity").val()
                            });
                        }
                        
                        this.transaction.total_cost += unitCost;



                        alertSuccess("Success", "Added to Cart");
                        await this.fetchData();
                        $("#qtyModal").modal("hide");
                        $("#quantity").val(null);

                        this.cartQty = {
                            product: undefined,
                            qty: 0,
                            units: []
                        };

                    }
                },
                info: function(product) {
                    var measurement = product.info.measurement;
                    var variant = product.info.variant;
                    var description = product.info.description;
                    var html = "";
                    if (measurement) {
                        html += "<br> Measurement: " + measurement.toString();
                    }
                    if (variant) {
                        html += "<br> Variant: " + variant.toString();
                    }
                    if (description) {
                        html += "<br> Description: " + description.toString();
                    }

                    alertHtml("Product Info", html);
                },
                getUnits: function(product) {
                    var product = product;
                    var units = [];

                    if (product.cost.pc) {
                        if (product.stocks >= 1) {
                            units.push({
                                key: "pc",
                                val: "Per Pc",
                                qty: 1,
                                cost: product.cost.pc
                            })
                        }
                    }

                    if (product.cost.bundle) {
                        if (product.stocks >= product.quantity.bundle) {
                            units.push({
                                key: "bundle",
                                val: "Per Bundle (" + product.quantity.bundle + " pcs)",
                                qty: product.quantity.bundle,
                                cost: product.cost.bundle
                            });
                        }
                    }

                    if (product.cost.half) {
                        if (product.stocks >= product.quantity.half) {
                            units.push({
                                key: "half",
                                val: "Per Half (" + product.quantity.half + " pcs)",
                                qty: product.quantity.half,
                                cost: product.cost.half
                            });
                        }
                    }

                    return units;
                },
                checkoutShop: async function(vals) {
                    var data = (await axios.post("{{ route('shops.shop.checkout') }}", vals)).data;

                    console.log(data);
                },
                getAllProducts: async function() {
                    return (await axios.get("{{ route('shops.shop.products') }}")).data.data;
                },
                fetchData: async function() {
                    var allProducts = await this.getAllProducts();
                    if (this.cart.length < 1)
                        this.products = allProducts;
                    else {
                        for (var i = 0; i < this.cart.length; i++) {
                            var product = this.cart[i].product;
                            for (var x = 0; x < allProducts.length; x++) {
                                if (allProducts[x].id == product.id) {
                                    allProducts[x].stocks = allProducts[x].stocks - this.cart[i].unitQty;
                                }
                            }
                        }
                        this.products = [];

                        for (var x = 0; x < allProducts.length; x++) {
                            if (allProducts[x].stocks > 0) {
                                this.products.push(allProducts[x]);
                            }
                        }
                    }
                    this.computeTotalCost();
                    this.refreshDatatable();
                },
                refreshDatatable: function() {
                    dt.row().invalidate("data").draw(false);
                }
            },
            created: async function() {
                await this.fetchData();
            }
        });

        async function isFirstVisit() {

        }
    </script>
    @endpush