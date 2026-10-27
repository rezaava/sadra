@extends('admin.layout.master')

@section('head')
    <title>ویرایش درباره ما | صدرا</title>
    <style>
        .about-form {
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px #0000000a;
            color: #1a1740;
        }
        .about-form h2 {
            margin-bottom: 25px;
            font-size: 22px;
        }
        .about-form .form-group {
            margin-bottom: 20px;
        }
        .about-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .about-form input,
        .about-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            box-sizing: border-box;
        }
        .about-form textarea {
            min-height: 220px;
            resize: vertical;
        }
        .about-form .current-image {
            display: block;
            max-width: 250px;
            max-height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .about-form .btn-save {
            padding: 12px 28px;
            background: #423a9e;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
        }
        .about-form .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .about-form .success {
            background: #e5f7e9;
            color: #17652b;
        }
        .about-form .error {
            background: #fde8e8;
            color: #a51d1d;
        }
        .jodit-container {
            border-radius: 8px !important;
            border: 1px solid #ddd !important;
            overflow: hidden;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css">
@endsection

@section('main')
    <div class="about-form" dir="rtl">
        <h2>ویرایش اطلاعات درباره ما</h2>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" id="title" name="title" value="{{ old('title', $about?->title) }}" required>
            </div>

            <div class="form-group">
                <label for="slogan">شعار</label>
                <input type="text" id="slogan" name="slogan" value="{{ old('slogan', $about?->slogan) }}" required>
            </div>

            <div class="form-group">
                <label for="img">تصویر</label>

                @if ($about->img)
                    <img class="current-image" src="{{ asset($about->img) }}" alt="تصویر درباره ما">
                @endif

                <input type="file" id="img" name="img" accept="image/jpeg,image/png,image/webp">
                <small>در صورت انتخاب تصویر جدید، تصویر قبلی جایگزین می‌شود.</small>
            </div>

            <div class="form-group">
                <label for="text">متن درباره ما</label>
                <textarea id="textEditor" name="text" required>{{ old('text', $about?->text) }}</textarea>
            </div>

            <button type="submit" class="btn-save">ذخیره تغییرات</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Jodit('#textEditor', {
                width: '100%',
                height: 300,
                allowResize: true,
                direction: 'rtl',
                language: 'fa',
                buttons: [
                    'source', '|',
                    'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'font', 'fontsize', 'brush', 'paragraph', '|',
                    'ul', 'ol', 'outdent', 'indent', '|',
                    'align', 'hr', 'table', '|',
                    'link', 'unlink',
                    '|', 'symbols', 'emoticons', '|',
                    'print', 'fullsize', 'preview'
                ],
                colors: {
                    text: ['#000000', '#ff0000', '#00ff00', '#0000ff', '#ff00ff', '#00ffff'],
                    background: ['#ffffff', '#ffff00', '#00ffff', '#ffcc99']
                },
                defaultFont: 'Vazir, Tahoma, Arial, sans-serif',
                defaultFontSize: '14px',
                fonts: ['Vazir', 'Tahoma', 'Arial', 'Courier New'],
                uploader: {
                    insertImageAsBase64URI: false
                },
                disablePlugins: ['image', 'video']
            });
        });
    </script>
@endsection