@extends('layouts.client')
@section('title', 'Sản Phẩm Đã Mua | Synergy 4.0')
@section('content-nav')
<div class="section--xl pt-0">
    <div class="container">
        <!-- Order History  -->
        <div class="dashboard__order-history">
            <div class="dashboard__order-history-title">
                <h2 class="font-body--xxl-500">Sản Phẩm Đã Mua</h2>
            </div>
            <div class="dashboard__order-history-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Tên Sản Phẩm
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Nội dung
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Đánh giá
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Trạng Thái
                                </th>
                                <th scope="col" class="dashboard__order-history-table-title">
                                    Ngày Tạo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <!-- Tên Sản Phẩm -->
                                <td class="dashboard__order-history-table-item order-id">
                                    {{ $comment->product->name }}
                                </td>
                                <!--     Nội dung  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-date
                              ">
                                    {{ $comment->content }}
                                </td>
                                <!--   Đánh giá  -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                    <!-- <p class="order-total-price">
                                        {{ $comment->rating }} -->
                                    <ul class="ratings">
                                        <li>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($comment->rating>= $i)
                                                <!-- Hiển thị sao đầy đủ -->
                                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0176 13.7381 15.4883L12.7138 11.458C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9084 12.9129 10.8336L16.0933 8.18708C16.5106 7.83946 16.2958 7.1459 15.7586 7.11102L11.6056 6.84102C11.4938 6.83309 11.3866 6.79356 11.2964 6.72704C11.2061 6.66052 11.1367 6.56974 11.096 6.46527L9.5469 2.5649C9.50472 2.45405 9.42984 2.35864 9.33219 2.29132C9.23455 2.22401 9.11875 2.18796 9.00015 2.18796C8.88155 2.18796 8.76575 2.22401 8.6681 2.29132C8.57046 2.35864 8.49558 2.45405 8.4534 2.5649L6.90427 6.46527C6.86372 6.56985 6.79429 6.66074 6.70406 6.72737C6.61383 6.79399 6.50652 6.83361 6.39465 6.84158L2.24171 7.11158C1.70508 7.1459 1.48908 7.83946 1.90702 8.18708L5.0874 10.8342C5.17588 10.9089 5.2415 11.0071 5.27673 11.1175C5.31195 11.2278 5.31534 11.3458 5.28652 11.458L4.33702 15.1958C4.17558 15.8309 4.85115 16.3433 5.39452 15.9985L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z"
                                                        fill="#FF8A00" />
                                                </svg>
                                                @elseif ($comment->rating >= $i - 0.5 && $comment->rating < $i)
                                                    <!-- Hiển thị sao nửa -->
                                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0176 13.7381 15.4883L12.7138 11.458C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9084 12.9129 10.8336L16.0933 8.18708C16.5106 7.83946 16.2958 7.1459 15.7586 7.11102L11.6056 6.84102C11.4938 6.83309 11.3866 6.79356 11.2964 6.72704C11.2061 6.66052 11.1367 6.56974 11.096 6.46527L9.5469 2.5649C9.50472 2.45405 9.42984 2.35864 9.33219 2.29132C9.23455 2.22401 9.11875 2.18796 9.00015 2.18796C8.88155 2.18796 8.76575 2.22401 8.6681 2.29132C8.57046 2.35864 8.49558 2.45405 8.4534 2.5649L6.90427 6.46527C6.86372 6.56985 6.79429 6.66074 6.70406 6.72737C6.61383 6.79399 6.50652 6.83361 6.39465 6.84158L2.24171 7.11158C1.70508 7.1459 1.48908 7.83946 1.90702 8.18708L5.0874 10.8342C5.17588 10.9089 5.2415 11.0071 5.27673 11.1175C5.31195 11.2278 5.31534 11.3458 5.28652 11.458L4.33702 15.1958C4.17558 15.8309 4.85115 16.3433 5.39452 15.9985L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z"
                                                            fill="#FF8A00" />
                                                    </svg>
                                                    @else
                                                    <!-- Hiển thị sao trống -->
                                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.31008 13.9111L12.8566 16.1577C13.31 16.4446 13.8725 16.0176 13.7381 15.4883L12.7138 11.458C12.6848 11.3458 12.6882 11.2276 12.7234 11.1172C12.7586 11.0067 12.8243 10.9084 12.9129 10.8336L16.0933 8.18708C16.5106 7.83946 16.2958 7.1459 15.7586 7.11102L11.6056 6.84102C11.4938 6.83309 11.3866 6.79356 11.2964 6.72704C11.2061 6.66052 11.1367 6.56974 11.096 6.46527L9.5469 2.5649C9.50472 2.45405 9.42984 2.35864 9.33219 2.29132C9.23455 2.22401 9.11875 2.18796 9.00015 2.18796C8.88155 2.18796 8.76575 2.22401 8.6681 2.29132C8.57046 2.35864 8.49558 2.45405 8.4534 2.5649L6.90427 6.46527C6.86372 6.56985 6.79429 6.66074 6.70406 6.72737C6.61383 6.79399 6.50652 6.83361 6.39465 6.84158L2.24171 7.11158C1.70508 7.1459 1.48908 7.83946 1.90702 8.18708L5.0874 10.8342C5.17588 10.9089 5.2415 11.0071 5.27673 11.1175C5.31195 11.2278 5.31534 11.3458 5.28652 11.458L4.33702 15.1958C4.17558 15.8309 4.85115 16.3433 5.39452 15.9985L8.69077 13.9111C8.78342 13.8522 8.89093 13.8209 9.00071 13.8209C9.11049 13.8209 9.218 13.8522 9.31065 13.9111H9.31008Z"
                                                            fill="#D3D3D3" />
                                                    </svg>
                                                    @endif
                                                    @endfor
                                        </li>
                                    </ul>
                                    </p>
                                </td>
                                <!--    Trạng Thái -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-total
                              ">
                                    <p class="order-total-price">
                                        @if($comment->status == 0)
                                        Chờ duyệt
                                        @elseif($comment->status == 1)
                                        Đã duyệt
                                        @endif

                                    </p>

                                </td>
                                <!--    Ngày Tạo -->
                                <td
                                    class="
                                dashboard__order-history-table-item
                                order-status
                              ">
                                    {{ date('Y-m-d', strtotime($comment->created_at ))}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{ $comments->links() }}
                </div>
                <!-- More content here -->
            </div>
        </div>
    </div>
</div>
@endsection