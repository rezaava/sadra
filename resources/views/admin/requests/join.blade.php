@extends('admin.layout.master')

@section('title')
    درخواست‌های دعوت به همکاری | پنل مدیریت
@endsection

@section('head')
<style>
.join-admin{direction:rtl;color:#1a1740;padding:28px 0 50px}
.join-admin *{box-sizing:border-box}
.join-admin .panel{background:#fffdf8;border:1px solid #e6e1d8;border-radius:14px;padding:24px}
.join-admin .top{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:22px}
.join-admin h1{font-size:24px;margin:0 0 7px}
.join-admin .muted{color:#777185;font-size:13px;margin:0}
.join-admin .table-wrap{overflow-x:auto}
.join-admin table{width:100%;border-collapse:collapse;min-width:850px}
.join-admin th,.join-admin td{padding:13px 12px;border-bottom:1px solid #eee8df;text-align:right;vertical-align:middle}
.join-admin th{background:#f7f4ee;font-size:12px}
.join-admin td{font-size:13px}
.join-admin .btn{display:inline-block;text-decoration:none;border:0;border-radius:7px;padding:8px 12px;background:#1a1740;color:#fff;font-size:12px}
.join-admin .empty{text-align:center;padding:35px;color:#777185}
.join-admin .pagination{margin-top:20px}
.join-admin .stats{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px}
.join-admin .stat{padding:12px 16px;background:#f7f4ee;border-radius:9px;font-size:13px}
</style>
@endsection
@section('main')
<div class="join-admin">
    <div class="wrap m-4">
        <div class="panel">
            <div class="top">
                <div>
                    <h1>درخواست‌های استخدام</h1>
                    <p class="muted">
                        اطلاعات مهم متقاضیان؛ برای مشاهده تمام اطلاعات روی «مشاهده جزئیات» بزنید.
                    </p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام متقاضی</th>
                        <th>شغل درخواستی</th>
                        <th>شماره تماس</th>
                        <th>ایمیل</th>
                        <th>حقوق درخواستی</th>
                        <th>تاریخ ثبت</th>
                        <th>جزئیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($requests as $item)
                        <tr>
                            <td>{{ $requests->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->requested_job ?: '—' }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email ?: '—' }}</td>
                            <td>{{ $item->expected_salary ?: '—' }}</td>
                            <td>{{ $item->created_at?->format('Y/m/d H:i') }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.requests.join.show', $item->id) }}">
                                    مشاهده جزئیات
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                هنوز درخواست استخدامی ثبت نشده است.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection