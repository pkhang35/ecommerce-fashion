@extends('layouts.client')
@section('title', 'Thanh Toán | Synergy 4.0')
@section('content')
    <!-- Billing Section Start  -->
    <section class="section billing section--xl pt-0">
        <div class="container">
            <div class="row billing__content">
                <div class="col-lg-8">
                    <div class="billing__content-card">
                        <div class="billing__content-card-header">
                            <h2 class="font-body--xxxl-500">Thông Tin Thanh Toán</h2>
                        </div>
                        <div class="billing__content-card-body">
                            <form action="#">
                                <div class="contact-form__content">
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                            <label for="fname1">First Name </label>
                                            <input type="text" id="fname1" placeholder="Your first name" />
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="lname2">Last Name </label>
                                            <input type="text" id="lname2" placeholder="Your last name" />
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="company">Last Name <span>(Optional)</span>
                                            </label>
                                            <input type="text" id="company" placeholder="Company name" />
                                        </div>
                                    </div>

                                    <div class="contact-form-input">
                                        <label for="address">Street Address </label>
                                        <input type="text" id="address" placeholder="Your Address" />
                                    </div>

                                    <div class="contact-form__content-group">
                                        <!-- Country -->
                                        <div class="contact-form-input">
                                            <label for="country">Country / Region </label>
                                            <select id="country" class="contact-form-input__dropdown">
                                                <option value="01">United States</option>
                                                <option value="02">Canada</option>
                                                <option value="03">United Kingdom</option>
                                                <option value="04">Bangladesh</option>
                                            </select>
                                        </div>
                                        <!-- states -->
                                        <div class="contact-form-input">
                                            <label for="states">states </label>
                                            <select id="states" class="contact-form-input__dropdown">
                                                <option value="01">Washington DC</option>
                                                <option value="02">Nova Scotia</option>
                                                <option value="03">Alberta</option>
                                                <option value="04">Manitoba</option>
                                                <option value="05">Dhaka</option>
                                            </select>
                                        </div>
                                        <!-- zip -->
                                        <div class="contact-form-input">
                                            <label for="zip">Zip Code</label>
                                            <select id="zip" class="contact-form-input__dropdown">
                                                <option value="01">1216</option>
                                                <option value="02">975</option>
                                                <option value="03">880</option>
                                                <option value="04">95</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                            <label for="email"> email </label>
                                            <input type="text" id="email" placeholder="Email Address" />
                                        </div>
                                        <div class="contact-form-input">
                                            <label for="phone"> Phone </label>
                                            <input type="number" id="phone" placeholder="Phone number" />
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember" />
                                        <label class="form-check-label font-body--md-400" for="remember">
                                            Ship to a different address
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="billing__content-card">
                        <div class="billing__content-card-header">
                            <h2 class="font-body--xxxl-500">Additional Information</h2>
                        </div>
                        <div class="billing__content-card-body">
                            <div class="contact-form-input contact-form-textarea">
                                <label for="note">Order Notes <span>(Optional)</span> </label>
                                <!-- <input type="text" id="fname1" placeholder="Your first name" /> -->
                                <textarea name="notes" id="note" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bill-card">
                        <div class="bill-card__content">
                            <div class="bill-card__header">
                                <h2 class="bill-card__header-title font-body--xxl-500">
                                    Order Summery
                                </h2>
                            </div>
                            <div class="bill-card__body">
                                <!-- Product Info -->
                                <div class="bill-card__product">
                                    <div class="bill-card__product-item">
                                        <div class="bill-card__product-item-content">
                                            <div class="img-wrapper">
                                                <img src="{{ asset('client/images/products/img-01.png') }}"
                                                    alt="product-img" />
                                            </div>
                                            <h5 class="font-body--md-400">
                                                Green Apple <span class="quantity"> x5</span>
                                            </h5>
                                        </div>

                                        <p class="bill-card__product-price font-body--md-500">
                                            $70.00
                                        </p>
                                    </div>
                                    <div class="bill-card__product-item">
                                        <div class="bill-card__product-item-content">
                                            <div class="img-wrapper">
                                                <img src="{{ asset('client/images/products/img-02.png') }}"
                                                    alt="product-img" />
                                            </div>
                                            <h5 class="font-body--md-400">
                                                Orange <span class="quantity">x1</span>
                                            </h5>
                                        </div>

                                        <p class="bill-card__product-price font-body--md-500">
                                            $70.00
                                        </p>
                                    </div>
                                </div>
                                <!-- memo  -->
                                <div class="bill-card__memo">
                                    <!-- Subtotal  -->
                                    <div class="bill-card__memo-item subtotal">
                                        <p class="font-body--md-400">Subtotal:</p>
                                        <span class="font-body--md-500">$84.00</span>
                                    </div>
                                    <!-- Shipping  -->
                                    <div class="bill-card__memo-item shipping">
                                        <p class="font-body--md-400">Shipping:</p>
                                        <span class="font-body--md-500">Free</span>
                                    </div>
                                    <!-- total  -->
                                    <div class="bill-card__memo-item total">
                                        <p class="font-body--lg-400">Total:</p>
                                        <span class="font-body--xl-500">$84.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bill-card__content">
                            <div class="bill-card__header">
                                <div class="bill-card__header">
                                    <h2 class="bill-card__header-title font-body--xxl-500">
                                        Payment Method
                                    </h2>
                                </div>
                            </div>
                            <div class="bill-card__body">
                                <form action="#">
                                    <!-- Payment Methods  -->
                                    <div class="bill-card__payment-method">
                                        <div class="bill-card__payment-method-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="cash" checked />
                                                <label class="form-check-label font-body--400" for="cash">
                                                    cash on delivery
                                                </label>
                                            </div>
                                        </div>

<<<<<<< Updated upstream
                                        <div class="bill-card__payment-method-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="paypal" />
                                                <label class="form-check-label font-body--400" for="paypal">
                                                    Paypal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="bill-card__payment-method-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment"
                                                    id="amazon" />
                                                <label class="form-check-label font-body--400" for="amazon">
                                                    Amazon Pay
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="button button--lg w-100" type="submit">
                                        Place Order
                                    </button>
                                </form>
                            </div>
=======
                            <button class="button button--lg w-100" type="submit" target="_blank">
                                Đặt Hàng
                            </button>
                            </form>
>>>>>>> Stashed changes
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Billing Section  End  -->
@endsection
