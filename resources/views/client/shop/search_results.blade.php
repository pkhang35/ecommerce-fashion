@extends('layouts.client')
@section('content')
    <h1>Kết quả tìm kiếm cho: "{{ request('query') }}"</h1>

    @if ($products->isEmpty())
        <p>Không tìm thấy sản phẩm nào.</p>
    @else
        <div class="row shop__product-items">
            @foreach ($products as $product)
                <div class="col-xl-4 col-md-6">
                    <div class="cards-md cards-md--four w-100">
                        <div class="cards-md__img-wrapper">
                            <a href="product-details.html">
                                @if (isset($product['image']) && $product['image'])
                                    <img src="{{ asset('' . $product['image']) }}" alt="{{ $product['name'] }}"
                                        style="width: 300px; height: auto;">
                                @else
                                    <p>Chưa có ảnh</p>
                                @endif
                            </a>
                            <span class="tag danger font-body--md-400">sale 50%</span>
                            <div class="cards-md__favs-list">
                                <span class="action-btn">
                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z"
                                            stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                </span>
                                <span class="action-btn" data-bs-toggle="modal" data-bs-target="#productView">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 3.54102C3.75 3.54102 1.25 10.0001 1.25 10.0001C1.25 10.0001 3.75 16.4577 10 16.4577C16.25 16.4577 18.75 10.0001 18.75 10.0001C18.75 10.0001 16.25 3.54102 10 3.54102V3.54102Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M10 13.125C10.8288 13.125 11.6237 12.7958 12.2097 12.2097C12.7958 11.6237 13.125 10.8288 13.125 10C13.125 9.1712 12.7958 8.37634 12.2097 7.79029C11.6237 7.20424 10.8288 6.875 10 6.875C9.1712 6.875 8.37634 7.20424 7.79029 7.79029C7.20424 8.37634 6.875 9.1712 6.875 10C6.875 10.8288 7.20424 11.6237 7.79029 12.2097C8.37634 12.7958 9.1712 13.125 10 13.125V13.125Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="cards-md__info d-flex justify-content-between align-items-center">
                            <a href="product-details.html" class="cards-md__info-left">
                                <h6 class="font-body--md-400">
                                    {{ \Illuminate\Support\Str::limit($product['name'], 50, '...') }}</h6>
                                <div class="cards-md__info-price">
                                    <p>Giá: {{ number_format($product['price'], 0, ',', '.') }} VND</p>
                                </div>
                                <ul class="cards-md__info-rating d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="{{ $i <= $product['rating'] ? 'filled' : 'empty' }}">
                                                <path
                                                    d="M6.20663 9.44078L8.57101 10.9385C8.87326 11.1298 9.24826 10.8452 9.15863 10.4923L8.47576 7.80541C8.45647 7.73057 8.45869 7.6518 8.48217 7.57816C8.50566 7.50453 8.54945 7.43902 8.60851 7.38916L10.7288 5.62478C11.007 5.39303 10.8638 4.93066 10.5056 4.90741L7.73701 4.72741C7.66246 4.72212 7.59096 4.69577 7.53081 4.65142C7.47066 4.60707 7.42435 4.54656 7.39726 4.47691L6.36451 1.87666C6.33638 1.80276 6.28647 1.73916 6.22137 1.69428C6.15627 1.6494 6.07907 1.62537 6.00001 1.62537C5.92094 1.62537 5.84374 1.6494 5.77864 1.69428C5.71354 1.73916 5.66363 1.80276 5.63551 1.87666L4.60276 4.47691C4.57572 4.54663 4.52943 4.60722 4.46928 4.65164C4.40913 4.69606 4.33759 4.72246 4.26301 4.72778L1.49438 4.90778C1.13663 4.93066 0.992631 5.39303 1.27126 5.62478L3.39151 7.38953C3.4505 7.43936 3.49424 7.50481 3.51772 7.57837C3.54121 7.65193 3.54347 7.73062 3.52426 7.80541L2.89126 10.2973C2.78363 10.7207 3.23401 11.0623 3.59626 10.8324L5.79376 9.44078C5.85552 9.40152 5.92719 9.38066 6.00038 9.38066C6.07357 9.38066 6.14524 9.40152 6.20701 9.44078H6.20663Z"
                                                    class="{{ $i <= $product['rating'] ? 'filled' : 'empty' }}"
                                                    fill="{{ $i <= $product['rating'] ? '#FF8A00' : '#dcdcdc' }}">
                                                </path>
                                            </svg>
                                        </li>
                                    @endfor
                                </ul>

                            </a>
                            <div class="cards-md__info-right">
                                <span class="action-btn">
                                    <!-- Button thêm vào giỏ hàng -->

                                    <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-primary">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.66667 8.83333H4.16667L2.5 18H17.5L15.8333 8.83333H13.3333M6.66667 8.83333V6.33333C6.66667 4.49239 8.15905 3 10 3V3C11.8409 3 13.3333 4.49238 13.3333 6.33333V8.83333M6.66667 8.83333H13.3333M6.66667 8.83333V11.3333M13.3333 8.83333V11.3333"
                                                    stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
