@extends('admin.layout.master')

@section('title')
    سبدهای خرید پرداخت‌شده | صدراکو
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/cart.css') }}">
@endsection

@section('main')
    <div class="admin-content">

        <div class="content-head-row">
            <div>
                <h2 class="content-title">سبدهای خرید پرداخت‌شده</h2>
                <div class="content-sub">لیست کامل سبدهایی که پرداخت آن‌ها با موفقیت انجام شده است</div>
            </div>
        </div>

        <div class="table-card">
            <div class="head">
                <div>
                    <h5>لیست سبدها</h5>
                    <div class="sub">{{ $carts->total() }} سبد خرید پرداخت‌شده</div>
                </div>
                <div class="admin-search">
                    <form method="GET" action="{{ route('admin.carts.index') }}">
                        <input type="text" name="search" placeholder="جستجو بر اساس کاربر یا شماره سبد..." value="{{ request('search') }}">
                        <i class="bi bi-search"></i>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>شماره سبد</th>
                            <th>کاربر</th>
                            <th>محصولات</th>
                            <th>مبلغ</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $cart)
                            <tr>
                                <td><span class="cart-no">#CART-{{ $cart->id }}</span></td>
                                <td>
                                    <div class="cart-user">
                                        <div class="avatar">
                                            {{ mb_substr($cart->user->first_name ?? 'کاربر', 0, 1) }}
                                            {{ mb_substr($cart->user->last_name ?? '', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="name">{{ $cart->user->first_name }} {{ $cart->user->last_name }}</div>
                                            <div class="phone">{{ $cart->user->mobile ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-thumbs">
                                        @foreach ($cart->products->take(2) as $product)
                                            <div class="thumb">
                                                <img src="{{ asset($product->mainImage->path ?? 'images/placeholder.png') }}" alt="{{ $product->title }}">
                                            </div>
                                        @endforeach
                                        @if ($cart->products->count() > 2)
                                            <div class="more">+{{ $cart->products->count() - 2 }}</div>
                                        @endif
                                    </div>
                                    <span class="cart-items-count">{{ $cart->products->sum('pivot.quantity') }} قلم کالا</span>
                                </td>
                                <td>{{ number_format($cart->total_price) }} تومان</td>
                                <td>{{ \Hekmatinasser\Verta\Verta::instance($cart->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    <span class="status-badge {{ $cart->status }}">
                                        <i class="bi bi-circle-fill"></i>
                                        @switch($cart->status)
                                            @case('processing') در حال پردازش @break
                                            @case('shipped') در حال ارسال @break
                                            @case('delivered') تحویل شده @break
                                            @case('cancelled') لغو شده @break
                                            @default {{ $cart->status }}
                                        @endswitch
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.carts.show', $cart) }}" class="row-action-btn">مشاهده جزئیات</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-bag-x"></i>
                                        <p>هنوز هیچ سبد خرید پرداخت‌شده‌ای ثبت نشده است.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($carts->hasPages())
                <div class="table-pagination">
                    {{ $carts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection