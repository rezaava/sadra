<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminVideo;
use App\Models\Blog;
use App\Models\JoinSubmission;
use App\Models\PortfolioSubmission;
use App\Models\Products;
use App\Models\QuoteSubmission;
use App\Models\RepresentativeRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $productsCount = Products::count();
        $blogsCount = Blog::count();
        $servicesCount = Service::count();

        $joinRequestsCount = JoinSubmission::count();
        $quoteRequestsCount = QuoteSubmission::count();
        $representativeRequestsCount = RepresentativeRequest::count();
        $portfolioRequestsCount = PortfolioSubmission::count();

        $latestJoinRequests = JoinSubmission::latest()->take(5)->get();
        $latestQuoteRequests = QuoteSubmission::latest()->take(5)->get();
        $latestRepresentativeRequests = RepresentativeRequest::latest()->take(5)->get();

        $adminVideo = AdminVideo::first();

        return view('admin.index', compact(
            'productsCount',
            'blogsCount',
            'servicesCount',
            'joinRequestsCount',
            'quoteRequestsCount',
            'representativeRequestsCount',
            'portfolioRequestsCount',
            'latestJoinRequests',
            'latestQuoteRequests',
            'latestRepresentativeRequests',
            'adminVideo'
        ));
    }
    public function joinRequests()
    {
        $requests = JoinSubmission::latest()->get();

        return view('admin.requests.join', compact('requests'));
    }

    public function quoteRequests()
    {
        $requests = QuoteSubmission::latest()->get();

        return view('admin.requests.quote', compact('requests'));
    }

    public function representativeRequests()
    {
        $requests = RepresentativeRequest::latest()->get();

        return view('admin.requests.representative', compact('requests'));
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => [
                'required',
                'file',
                'mimes:mp4,webm,mov,avi',
                'max:102400',
            ],
        ], [
            'video.required' => 'انتخاب ویدیو الزامی است.',
            'video.file' => 'فایل انتخاب‌شده معتبر نیست.',
            'video.mimes' => 'فرمت ویدیو باید MP4، WEBM، MOV یا AVI باشد.',
            'video.max' => 'حجم ویدیو نباید بیشتر از 100 مگابایت باشد.',
        ]);

        $file = $request->file('video');

        if (!$file || !$file->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'فایل ویدیو معتبر نیست.',
            ], 422);
        }

        $videoDirectory = ('videos/admin');

        if (!File::exists($videoDirectory)) {
            File::makeDirectory($videoDirectory, 0755, true);
        }

        $oldVideo = AdminVideo::first();

        $extension = strtolower($file->getClientOriginalExtension());

        $fileName = 'video_' . uniqid() . '_' . time() . '.' . $extension;

        try {
            $file->move($videoDirectory, $fileName);
        } catch (\Throwable $e) {

            Log::error('Video move failed.', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'ذخیره فایل ویدیو روی سرور انجام نشد.',
            ], 500);
        }

        $videoPath = 'videos/admin/' . $fileName;

        try {

            if ($oldVideo) {

                $oldVideoPath = $oldVideo->video
                    ? ($oldVideo->video)
                    : null;

                $oldVideo->video = $videoPath;
                $oldVideo->save();

                if ($oldVideoPath && File::exists($oldVideoPath)) {
                    File::delete($oldVideoPath);
                }

            } else {

                $oldVideo = AdminVideo::create([
                    'video' => $videoPath,
                ]);
            }

        } catch (\Throwable $e) {

            Log::error('Admin video database save failed.', [
                'message' => $e->getMessage(),
                'video_path' => $videoPath,
            ]);

            $newVideoPath = ($videoPath);

            if (File::exists($newVideoPath)) {
                File::delete($newVideoPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'ثبت ویدیو در دیتابیس انجام نشد.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'ویدیو با موفقیت ذخیره شد.',
            'video' => [
                'id' => $oldVideo->id,
                'path' => $videoPath,
                'url' => asset($videoPath),
                'name' => basename($videoPath),
            ],
        ]);
    }


    public function deleteVideo()
    {
        $video = AdminVideo::first();

        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'ویدیویی برای حذف وجود ندارد.',
            ], 404);
        }

        try {

            if ($video->video) {

                $videoPath = ($video->video);

                if (File::exists($videoPath)) {
                    File::delete($videoPath);
                }
            }

            $video->delete();

            return response()->json([
                'success' => true,
                'message' => 'ویدیو با موفقیت حذف شد.',
            ]);

        } catch (\Throwable $e) {

            Log::error('Admin video delete failed.', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حذف ویدیو انجام نشد.',
            ], 500);
        }
    }
    public function portfolioRequests()
    {
        $requests = PortfolioSubmission::latest()->get();

        return view('admin.requests.portfolio', compact('requests'));
    }
}