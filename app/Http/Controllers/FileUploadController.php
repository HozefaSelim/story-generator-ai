<?php

namespace App\Http\Controllers;

use App\Models\UserUpload;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Upload a child's photo for story integration
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
            'story_id' => 'nullable|exists:stories,id',
            'upload_type' => 'required|in:profile_photo,story_photo,other',
        ]);

        try {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/photos', $fileName, 'public');

            $upload = UserUpload::create([
                'user_id' => Auth::id(),
                'story_id' => $request->story_id,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'upload_type' => $request->upload_type,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Photo uploaded successfully!',
                'upload' => $upload,
                'url' => Storage::url($filePath),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user's uploads
     */
    public function index()
    {
        $uploads = Auth::user()->uploads()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('uploads.index', compact('uploads'));
    }

    /**
     * Delete an upload
     */
    public function destroy(UserUpload $upload)
    {
        if ($upload->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.',
            ], 403);
        }

        try {
            // Delete file from storage
            Storage::disk('public')->delete($upload->file_path);

            // Delete database record
            $upload->delete();

            return response()->json([
                'success' => true,
                'message' => 'Upload deleted successfully.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete upload: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show upload form
     */
    public function create(Request $request)
    {
        $storyId = $request->query('story_id');
        $story = null;

        if ($storyId) {
            $story = Story::findOrFail($storyId);
            if ($story->user_id !== Auth::id()) {
                abort(403);
            }
        }

        return view('uploads.create', compact('story'));
    }
}
