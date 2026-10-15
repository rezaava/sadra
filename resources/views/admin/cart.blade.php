@extends('admin.layout.master')

@section('title')
    جزئیات سبد خرید #{{ $cart->id }} | صدراکو
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/cart.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('main')
    <div class="admin-content">

        <div class="content-head-row">
            <div>
                <h2 class="content-title">جزئیات سبد خرید</h2>
                <div class="content-sub">#CART-{{ $cart->id }}</div>
            </div>
            <a href="{{ route('admin.carts.index') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-right"></i> بازگشت به لیست
            </a>
        </div>

        <div class="row gy-4">

            <!-- اطلاعات اصلی سبد -->
            <div class="col-md-6">
                <div class="detail-card">
                    <h5><i class="bi bi-receipt"></i> اطلاعات سفارش</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>شماره سبد</th>
                            <td>#CART-{{ $cart->id }}</td>
                        </tr>
                        <tr>
                            <th>تاریخ ثبت</th>
                            <td>{{ \Hekmatinasser\Verta\Verta::instance($cart->created_at)->format('Y/m/d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>وضعیت</th>
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
                        </tr>
                        <tr>
                            <th>تعداد اقلام</th>
                            <td>{{ $cart->products->sum('pivot.quantity') }} عدد</td>
                        </tr>
                        <tr>
                            <th>مبلغ کل</th>
                            <td><b>{{ number_format($cart->total_price) }} تومان</b></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- اطلاعات کاربر -->
            <div class="col-md-6">
                <div class="detail-card">
                    <h5><i class="bi bi-person"></i> اطلاعات کاربر</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>نام</th>
                            <td>{{ $cart->user->first_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>نام‌خانوادگی</th>
                            <td>{{ $cart->user->last_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>شماره موبایل</th>
                            <td>{{ $cart->user->mobile ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>ایمیل</th>
                            <td>{{ $cart->user->email ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- آدرس تحویل (در صورت وجود) -->
            @if ($cart->address)
                <div class="col-md-6">
                    <div class="detail-card">
                        <h5><i class="bi bi-geo-alt"></i> آدرس تحویل</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>استان</th>
                                <td>{{ $cart->address->city->parent->title ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>شهر</th>
                                <td>{{ $cart->address->city->title ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>آدرس کامل</th>
                                <td>{{ $cart->address->full_address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>کد پستی</th>
                                <td>{{ $cart->address->postal_code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>پلاک</th>
                                <td>{{ $cart->address->plate ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>واحد</th>
                                <td>{{ $cart->address->unit ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif

            <!-- اطلاعات تراکنش -->
            @if ($transaction)
                <div class="col-md-6">
                    <div class="detail-card">
                        <h5><i class="bi bi-credit-card"></i> اطلاعات تراکنش</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>مبلغ</th>
                                <td>{{ number_format($transaction->amount) }} تومان</td>
                            </tr>
                            <tr>
                                <th>وضعیت</th>
                                <td>
                                    <span class="status-badge {{ $transaction->status }}">
                                        @if ($transaction->status == 'success')
                                            <i class="bi bi-check-circle-fill text-success"></i> موفق
                                        @elseif ($transaction->status == 'pending')
                                            <i class="bi bi-hourglass-split text-warning"></i> در انتظار
                                        @else
                                            <i class="bi bi-x-circle-fill text-danger"></i> ناموفق
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>شماره پیگیری</th>
                                <td>{{ $transaction->ref_id ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>کد Authority</th>
                                <td>{{ $transaction->authority ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>تاریخ تراکنش</th>
                                <td>{{ \Hekmatinasser\Verta\Verta::instance($transaction->created_at)->format('Y/m/d H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif

            <!-- لیست محصولات -->
            <div class="col-12">
                <div class="detail-card">
                    <h5><i class="bi bi-box-seam"></i> محصولات سفارش</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>تصویر</th>
                                    <th>نام محصول</th>
                                    <th>دسته‌بندی</th>
                                    <th>قیمت واحد</th>
                                    <th>تعداد</th>
                                    <th>قیمت نهایی</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($product->mainImage->path ?? 'images/placeholder.png') }}"
                                                 alt="{{ $product->title }}"
                                                 style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td>{{ number_format($product->pivot->price) }} تومان</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ number_format($product->pivot->price * $product->pivot->quantity) }} تومان</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">جمع کل:</td>
                                    <td class="fw-bold">{{ number_format($cart->total_price) }} تومان</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection