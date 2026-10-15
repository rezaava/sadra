@extends('admin.layout.master')

@section('title')
    مدیریت کاربران | صدراکو
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/products.css') }}">
@endsection

@section('main')
    <div class="admin-content">
        <div class="content-head-row">
            <div>
                <h2 class="content-title">مدیریت کاربران</h2>
                <div class="content-sub">لیست تمام کاربران ثبت‌نام‌شده در سایت</div>
            </div>
        </div>

        <div class="table-card">
            <div class="head">
                <div>
                    <h5>کاربران</h5>
                    <div class="sub">{{ $users->total() }} کاربر</div>
                </div>
                <div class="admin-search">
                    <form method="GET" action="{{ route('admin.users.index') }}" id="searchForm">
                        <input type="text" name="search" placeholder="جستجو بر اساس نام، موبایل یا ایمیل..."
                               value="{{ $search ?? '' }}" id="searchInput">
                        <i class="bi bi-search"></i>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام و نام‌خانوادگی</th>
                            <th>شماره موبایل</th>
                            <th>ایمیل</th>
                            <th>تاریخ ثبت‌نام</th>
                            <th>نقش</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>#{{ $user->id }}</td>
                                <td>
                                    <div class="user-info">
                                        <div class="avatar">
                                            @if ($user->photo)
                                                <img src="{{ asset($user->photo) }}" alt="{{ $user->first_name }}">
                                            @else
                                                {{ mb_substr($user->first_name ?? 'کاربر', 0, 1) }}{{ mb_substr($user->last_name ?? '', 0, 1) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="name">{{ $user->first_name }} {{ $user->last_name }}</div>
                                            @if (!$user->first_name && !$user->last_name)
                                                <span class="text-muted" style="font-size:0.75rem;">نام ثبت نشده</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->mobile ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td>{{ \Hekmatinasser\Verta\Verta::instance($user->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    @if ($user->hasRole('admin'))
                                        مدیر
                                    @else
                                        کاربر
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="row-action-btn danger" onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟')">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <p>هیچ کاربری یافت نشد.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="table-pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection