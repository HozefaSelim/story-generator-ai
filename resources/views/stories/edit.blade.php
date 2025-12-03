<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="heading-lg mb-2">✏️ Edit Story</h2>
                <p class="text-slate-400">Update your story details</p>
            </div>
            <a href="{{ route('stories.show', $story) }}" class="btn-ghost px-6 py-2.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Story
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Edit Form Card -->
            <div class="card p-8 mb-8">
                <form method="POST" action="{{ route('stories.update', $story) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Story Title')" />
                        <x-text-input id="title" class="block mt-2 w-full" type="text" name="title" :value="old('title', $story->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Description (Optional)')" />
                        <textarea id="description" name="description" rows="3" class="block mt-2 w-full">{{ old('description', $story->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="block mt-2 w-full">
                            <option value="draft" {{ old('status', $story->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="processing" {{ old('status', $story->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ old('status', $story->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ old('status', $story->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        <p class="mt-2 text-sm text-slate-400">Change the status of your story</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-700">
                        <a href="{{ route('stories.show', $story) }}" class="btn-ghost px-6 py-3 w-full sm:w-auto">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary px-10 py-3 w-full sm:w-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Story
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="card border-2 border-red-500/30 bg-gradient-to-br from-red-900/20 to-red-800/20">
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center border-2 border-red-500/30">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-red-400 mb-1">Danger Zone</h3>
                            <p class="text-slate-300 text-sm">This action cannot be undone</p>
                        </div>
                    </div>

                    <p class="text-slate-300 mb-6">
                        Deleting this story will permanently remove all associated content including images, audio, video, and PDF files. This action is irreversible.
                    </p>

                    <form id="delete-story-form" method="POST" action="{{ route('stories.destroy', $story) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeleteStory()" class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold shadow-lg hover:shadow-red-500/50 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Story Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDeleteStory() {
            Swal.fire({
                title: '⚠️ Delete Story?',
                html: `
                    <div class="text-left text-gray-300">
                        <p class="mb-3">This will permanently delete:</p>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            <li>Story text</li>
                            <li>All images</li>
                            <li>Voice narration</li>
                            <li>Video file</li>
                            <li>PDF file</li>
                        </ul>
                        <p class="mt-4 text-red-400 font-semibold">This action cannot be undone!</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#4b5563',
                confirmButtonText: '🗑️ Yes, delete permanently',
                cancelButtonText: 'Cancel',
                background: '#1e293b',
                color: '#f1f5f9',
                customClass: {
                    popup: 'rounded-2xl border border-red-500/30',
                    title: 'text-red-400',
                    confirmButton: 'rounded-xl px-6 py-2',
                    cancelButton: 'rounded-xl px-6 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-story-form').submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
