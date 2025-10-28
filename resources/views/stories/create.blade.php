<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="heading-lg mb-2">✨ Create New Story</h2>
                <p class="text-slate-400">Let AI bring your imagination to life</p>
            </div>
            <a href="{{ route('stories.index') }}" class="btn-ghost px-6 py-2.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Stories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Card -->
            <div class="card">
                <div class="p-8">
                    <form method="POST" action="{{ route('stories.store') }}" class="space-y-8">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                                    <span class="text-xl">📝</span>
                                </div>
                                <h3 class="text-xl font-bold text-white">Basic Information</h3>
                            </div>

                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Story Title')" />
                                <x-text-input id="title" class="block mt-2 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Enter a creative title for your story" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Grid for Theme and Style -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Theme -->
                                <div>
                                    <x-input-label for="theme" :value="__('Story Theme')" />
                                    <select id="theme" name="theme" class="block mt-2 w-full" required>
                                        <option value="">Select a theme</option>
                                        @foreach($themes as $value => $label)
                                            <option value="{{ $value }}" {{ old('theme') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('theme')" class="mt-2" />
                                </div>

                                <!-- Story Style -->
                                <div>
                                    <x-input-label for="style" :value="__('Visual Style')" />
                                    <select id="style" name="style" class="block mt-2 w-full" required>
                                        <option value="">Select a style</option>
                                        @foreach($styles as $value => $label)
                                            <option value="{{ $value }}" {{ old('style') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('style')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Voice -->
                            <div>
                                <x-input-label for="voice" :value="__('Narration Voice')" />
                                <select id="voice" name="voice" class="block mt-2 w-full" required>
                                    <option value="">Select a voice</option>
                                    @foreach($voices as $value => $label)
                                        <option value="{{ $value }}" {{ old('voice') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('voice')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Personalization Section -->
                        <div class="space-y-6 pt-6 border-t border-slate-700">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-500 rounded-xl flex items-center justify-center">
                                    <span class="text-xl">👶</span>
                                </div>
                                <h3 class="text-xl font-bold text-white">Personalization</h3>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Child Name -->
                                <div>
                                    <x-input-label for="child_name" :value="__('Child Name (Optional)')" />
                                    <x-text-input id="child_name" class="block mt-2 w-full" type="text" name="child_name" :value="old('child_name')" placeholder="e.g., Emma" />
                                    <x-input-error :messages="$errors->get('child_name')" class="mt-2" />
                                    <p class="mt-2 text-sm text-slate-400">Make them the hero of the story</p>
                                </div>

                                <!-- Child Age -->
                                <div>
                                    <x-input-label for="age" :value="__('Child Age')" />
                                    <x-text-input id="age" class="block mt-2 w-full" type="number" name="age" :value="old('age', 5)" min="1" max="18" required />
                                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                    <p class="mt-2 text-sm text-slate-400">Helps tailor complexity (1-18 years)</p>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Interests -->
                                <div>
                                    <x-input-label for="interests" :value="__('Interests (Optional)')" />
                                    <x-text-input id="interests" class="block mt-2 w-full" type="text" name="interests" :value="old('interests')" placeholder="e.g., dinosaurs, space" />
                                    <x-input-error :messages="$errors->get('interests')" class="mt-2" />
                                </div>

                                <!-- Number of Images -->
                                <div>
                                    <x-input-label for="num_images" :value="__('Number of Images')" />
                                    <select id="num_images" name="num_images" class="block mt-2 w-full">
                                        <option value="2">2 images</option>
                                        <option value="4" selected>4 images (recommended)</option>
                                        <option value="6">6 images</option>
                                        <option value="8">8 images</option>
                                        <option value="10">10 images</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('num_images')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Educational Lesson -->
                            <div>
                                <x-input-label for="lesson" :value="__('Educational Lesson (Optional)')" />
                                <x-text-input id="lesson" class="block mt-2 w-full" type="text" name="lesson" :value="old('lesson')" placeholder="e.g., importance of friendship, being brave" />
                                <x-input-error :messages="$errors->get('lesson')" class="mt-2" />
                                <p class="mt-2 text-sm text-slate-400">Include a moral or lesson</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-700">
                            <a href="{{ route('stories.index') }}" class="btn-ghost px-6 py-3 w-full sm:w-auto">
                                Cancel
                            </a>
                            <button type="submit" class="btn-primary px-10 py-4 text-lg w-full sm:w-auto">
                                <span class="text-xl">✨</span>
                                Create Magical Story
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-8 card-gradient p-6">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">🤖 AI-Powered Generation</h3>
                        <p class="text-slate-300 leading-relaxed">
                            Your story will be crafted by GPT-4, with custom illustrations from DALL-E 3, professional voice narration, and optionally compiled into a video. The entire process takes 2-5 minutes depending on complexity.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3 text-sm">
                            <span class="px-3 py-1.5 bg-green-500/20 text-green-300 rounded-lg font-medium border border-green-500/30">✓ GPT-4 Story</span>
                            <span class="px-3 py-1.5 bg-blue-500/20 text-blue-300 rounded-lg font-medium border border-blue-500/30">✓ DALL-E Images</span>
                            <span class="px-3 py-1.5 bg-purple-500/20 text-purple-300 rounded-lg font-medium border border-purple-500/30">✓ Voice Narration</span>
                            <span class="px-3 py-1.5 bg-pink-500/20 text-pink-300 rounded-lg font-medium border border-pink-500/30">✓ PDF Export</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

