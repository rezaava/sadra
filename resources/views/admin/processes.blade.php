@extends('admin.layout.master')

@section('head')
    <title>مدیریت مراحل | صدرا</title>
    <style>
        .process-page {
            direction: rtl;
            max-width: 1150px;
            margin: 22px auto;
            color: #1a1740;
            font-size: 13px;
        }
        .process-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            padding: 18px 20px;
            background: #fff;
            border: 1px solid #eceaf5;
            border-radius: 12px;
        }
        .process-title {
            display: flex;
            align-items: center;
            gap: 11px;
        }
        .process-title-icon {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 11px;
            background: #eeeaff;
            color: #423a9e;
            font-size: 20px;
        }
        .process-header h2 {
            font-size: 17px;
            font-weight: 800;
            margin: 0 0 5px;
        }
        .process-subtitle {
            font-size: 11px;
            color: #85839a;
        }
        .process-count {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 8px;
            background: #f5f4fb;
            color: #423a9e;
            font-weight: 700;
            white-space: nowrap;
        }
        .process-alert {
            padding: 11px 14px;
            border-radius: 9px;
            margin-bottom: 14px;
            font-size: 12px;
        }
        .process-alert.success {
            background: #e8f7ed;
            color: #17652b;
            border: 1px solid #ccebd5;
        }
        .process-alert.error {
            background: #fff0f0;
            color: #a51d1d;
            border: 1px solid #f5d1d1;
        }
        .process-card {
            background: #fff;
            border: 1px solid #eae8f2;
            border-radius: 12px;
            margin-bottom: 12px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }
        .process-card:focus-within {
            border-color: #c4bdf3;
            box-shadow: 0 4px 16px #423a9e0b;
        }
        .process-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 16px;
            background: #faf9fd;
            border-bottom: 1px solid #eeedf5;
        }
        .process-card-title {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }
        .process-index {
            display: grid;
            place-items: center;
            width: 27px;
            height: 27px;
            flex-shrink: 0;
            border-radius: 8px;
            background: #423a9e;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }
        .process-card-header h3 {
            font-size: 13px;
            font-weight: 700;
            margin: 0;
        }
        .process-number {
            font-size: 11px;
            color: #88859c;
            background: #f0eef8;
            padding: 5px 9px;
            border-radius: 6px;
            white-space: nowrap;
        }
        .process-card-body {
            padding: 15px 16px 5px;
        }
        .process-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 100px;
            gap: 12px;
        }
        .process-field {
            min-width: 0;
            margin-bottom: 12px;
        }
        .process-field.full {
            grid-column: 1 / -1;
        }
        .process-field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #4c4968;
            margin-bottom: 6px;
        }
        .process-field input,
        .process-field textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 9px 11px;
            border: 1px solid #e3e1eb;
            border-radius: 7px;
            background: #fff;
            color: #1a1740;
            font-family: inherit;
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
        }
        .process-field input {
            height: 38px;
        }
        .process-field input:focus,
        .process-field textarea:focus {
            outline: none;
            border-color: #7770c7;
            box-shadow: 0 0 0 3px #423a9e0d;
        }
        .process-field textarea {
            min-height: 75px;
            resize: vertical;
            line-height: 1.9;
        }
        .process-field input[type="number"] {
            direction: ltr;
            text-align: right;
        }
        .process-actions {
            position: sticky;
            bottom: 12px;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 18px;
            padding: 11px 14px;
            background: #ffffffed;
            backdrop-filter: blur(12px);
            border: 1px solid #e8e6f0;
            border-radius: 10px;
            box-shadow: 0 5px 22px #1a174014;
        }
        .process-actions span {
            color: #77748d;
            font-size: 11px;
        }
        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 39px;
            padding: 9px 20px;
            border: none;
            border-radius: 7px;
            background: #423a9e;
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }
        .btn-save:hover {
            background: #221f5e;
            transform: translateY(-1px);
        }
        .process-empty {
            padding: 35px 20px;
            text-align: center;
            background: #fff;
            border: 1px dashed #dcd8ed;
            border-radius: 12px;
            color: #77748d;
        }
        .process-empty i {
            display: block;
            font-size: 28px;
            margin-bottom: 10px;
            color: #aaa5cf;
        }
        @media (max-width: 768px) {
            .process-page {
                margin: 15px 10px;
            }
            .process-header {
                padding: 13px;
            }
            .process-title-icon {
                width: 36px;
                height: 36px;
                font-size: 17px;
            }
            .process-header h2 {
                font-size: 15px;
            }
            .process-subtitle {
                font-size: 10px;
            }
            .process-count {
                padding: 7px 9px;
                font-size: 11px;
            }
            .process-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            .process-field.order-field {
                grid-column: 1 / -1;
            }
            .process-card-header,
            .process-card-body {
                padding-left: 12px;
                padding-right: 12px;
            }
            .process-actions span {
                display: none;
            }
            .process-actions {
                justify-content: flex-end;
            }
        }
        @media (max-width: 420px) {
            .process-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .process-field.order-field {
                grid-column: auto;
            }
            .process-header {
                align-items: flex-start;
            }
            .process-count {
                font-size: 10px;
            }
            .process-card-header h3 {
                font-size: 12px;
            }
            .btn-save {
                width: 100%;
            }
        }
    </style>
@endsection

@section('main')
    <div class="process-page">
        <div class="process-header">
            <div class="process-title">
                <div class="process-title-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
                <div>
                    <h2>مدیریت فرآیند سفارش گذاری</h2>
                    <div class="process-subtitle">ویرایش محتوا و ترتیب نمایش مراحل سایت</div>
                </div>
            </div>
            <div class="process-count">
                <i class="bi bi-collection"></i>
                {{ $processes->count() }} آیتم
            </div>
        </div>

        @if (session('success'))
            <div class="process-alert success">
                <i class="bi bi-check-circle ms-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="process-alert error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if ($processes->isEmpty())
            <div class="process-empty">
                <i class="bi bi-inbox"></i>
                هیچ آیتمی برای نمایش وجود ندارد.
            </div>
        @else
            <form action="{{ route('admin.processes.update') }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($processes as $process)
                    <div class="process-card">
                        <div class="process-card-header">
                            <div class="process-card-title">
                                <span class="process-index">{{ $loop->iteration }}</span>
                                <h3>ویرایش مرحله {{ $loop->iteration }}</h3>
                            </div>
                            <span class="process-number">ID: {{ $process->id }}</span>
                        </div>

                        <div class="process-card-body">
                            <div class="process-grid">
                                <div class="process-field">
                                    <label for="class_{{ $process->id }}">SVG</label>
                                    <input
                                        type="text"
                                        id="class_{{ $process->id }}"
                                        name="processes[{{ $process->id }}][class]"
                                        value="{{ old('processes.' . $process->id . '.class', $process->class) }}"
                                        required
                                    >
                                </div>

                                <div class="process-field">
                                    <label for="title_{{ $process->id }}">عنوان</label>
                                    <input
                                        type="text"
                                        id="title_{{ $process->id }}"
                                        name="processes[{{ $process->id }}][title]"
                                        value="{{ old('processes.' . $process->id . '.title', $process->title) }}"
                                        required
                                    >
                                </div>

                                <div class="process-field order-field">
                                    <label for="order_{{ $process->id }}">ترتیب نمایش</label>
                                    <input
                                        type="tel"
                                        id="order_{{ $process->id }}"
                                        name="processes[{{ $process->id }}][order]"
                                        value="{{ old('processes.' . $process->id . '.order', $process->order) }}"
                                        min="0"
                                        required
                                    >
                                </div>

                                <div class="process-field full">
                                    <label for="text_{{ $process->id }}">متن مرحله</label>
                                    <textarea
                                        id="text_{{ $process->id }}"
                                        name="processes[{{ $process->id }}][text]"
                                        required
                                    >{{ old('processes.' . $process->id . '.text', $process->text) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="process-actions">
                    <span><i class="bi bi-info-circle ms-1"></i>تغییرات همه مراحل هم‌زمان ذخیره می‌شوند.</span>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check2-circle"></i>
                        ذخیره تغییرات
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection