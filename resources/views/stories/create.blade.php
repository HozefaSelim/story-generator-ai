<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="heading-lg mb-2">✨ Create New Story</h2>
                <p class="text-slate-400">Let AI bring your imagination to life</p>
            </div>
            <a href="{{ route('stories.index') }}" class="btn-ghost px-6 py-2.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                                    <span class="text-xl">📝</span>
                                </div>
                                <h3 class="text-xl font-bold text-white">Basic Information</h3>
                            </div>

                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Story Title')" />
                                <x-text-input id="title" class="block mt-2 w-full" type="text" name="title"
                                    :value="old('title')" required autofocus list="previous-titles"
                                    placeholder="Enter a creative title for your story" />
                                <datalist id="previous-titles">
                                    @foreach(auth()->user()->stories()->latest()->take(10)->pluck('title') as $prevTitle)
                                        <option value="{{ $prevTitle }}">
                                    @endforeach
                                </datalist>
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
                                            <option value="{{ $value }}" {{ old('theme') == $value ? 'selected' : '' }}>
                                                {{ $label }}</option>
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
                                            <option value="{{ $value }}" {{ old('style') == $value ? 'selected' : '' }}>
                                                {{ $label }}</option>
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
                                        <option value="{{ $value }}" {{ old('voice') == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('voice')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Personalization Section -->
                        <div class="space-y-6 pt-6 border-t border-slate-700">
                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-500 rounded-xl flex items-center justify-center">
                                    <span class="text-xl">👶</span>
                                </div>
                                <h3 class="text-xl font-bold text-white">Personalization</h3>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Child Name -->
                                <div>
                                    <x-input-label for="child_name" :value="__('Child Name (Optional)')" />
                                    <x-text-input id="child_name" class="block mt-2 w-full" type="text"
                                        name="child_name" :value="old('child_name')" list="previous-child-names"
                                        placeholder="e.g., Emma" />
                                    <datalist id="previous-child-names">
                                        @foreach($previousChildNames as $name)
                                            <option value="{{ $name }}">
                                        @endforeach
                                    </datalist>
                                    <x-input-error :messages="$errors->get('child_name')" class="mt-2" />
                                    <p class="mt-2 text-sm text-slate-400">Make them the hero of the story</p>
                                </div>

                                <!-- Child Age -->
                                <div>
                                    <x-input-label for="age" :value="__('Child Age')" />
                                    <x-text-input id="age" class="block mt-2 w-full" type="number" name="age"
                                        :value="old('age', 5)" min="1" max="18" required />
                                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                    <p class="mt-2 text-sm text-slate-400">Helps tailor complexity (1-18 years)</p>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Interests -->
                                <div>
                                    <x-input-label for="interests" :value="__('Interests (Optional)')" />
                                    <x-text-input id="interests" class="block mt-2 w-full" type="text" name="interests"
                                        :value="old('interests')" list="previous-interests"
                                        placeholder="e.g., dinosaurs, space" />
                                    <datalist id="previous-interests">
                                        @foreach($previousInterests as $interest)
                                            <option value="{{ $interest }}">
                                        @endforeach
                                    </datalist>
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
                                <x-text-input id="lesson" class="block mt-2 w-full" type="text" name="lesson"
                                    :value="old('lesson')" list="previous-lessons"
                                    placeholder="e.g., importance of friendship, being brave" />
                                <datalist id="previous-lessons">
                                    @foreach($previousLessons as $lesson)
                                        <option value="{{ $lesson }}">
                                    @endforeach
                                </datalist>
                                <x-input-error :messages="$errors->get('lesson')" class="mt-2" />
                                <p class="mt-2 text-sm text-slate-400">Include a moral or lesson</p>
                            </div>
                        </div>

                        <!-- AI Agent Selection Section -->
                        <div class="space-y-6 pt-6 border-t border-slate-700">
                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center">
                                    <span class="text-xl">🤖</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">AI Agent Selection</h3>
                                    <p class="text-sm text-slate-400">Choose which AI models to use for generation</p>
                                </div>
                            </div>

                            <!-- Text Generation Agent -->
                            <div>
                                <x-input-label for="text_agent" :value="__('Story Text Agent')" />
                                <p class="text-sm text-slate-400 mb-3">Choose AI model for writing your story</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    @foreach($textAgents as $key => $agent)
                                        <label class="relative cursor-pointer block group">
                                            <input type="radio" name="text_agent" value="{{ $key }}" class="peer sr-only" {{ old('text_agent', 'gemini_flash') == $key ? 'checked' : '' }}>
                                            <div
                                                class="h-full rounded-xl p-4 border-2 border-slate-700 bg-slate-800/50 peer-checked:border-indigo-500 peer-checked:bg-indigo-500/20 hover:border-slate-500 transition-all duration-200">
                                                <div class="text-center">
                                                    <span class="text-3xl block mb-2">{{ $agent['icon'] }}</span>
                                                    <h4 class="font-bold text-white text-sm">{{ $agent['name'] }}</h4>
                                                    <p class="text-xs text-slate-400 mt-1">{{ $agent['description'] }}</p>
                                                </div>
                                            </div>
                                            <!-- Empty circle (unchecked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:hidden">
                                            </div>
                                            <!-- Filled circle with check (checked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full bg-indigo-500 border-2 border-indigo-500 hidden peer-checked:flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('text_agent')" class="mt-2" />
                            </div>

                            <!-- Image Generation Agent -->
                            <div>
                                <x-input-label for="image_agent" :value="__('Image Generation Agent')" />
                                <p class="text-sm text-slate-400 mb-3">Choose AI model for creating illustrations</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    @foreach($imageAgents as $key => $agent)
                                        <label class="relative cursor-pointer block">
                                            <input type="radio" name="image_agent" value="{{ $key }}" class="peer sr-only"
                                                {{ old('image_agent', 'gemini_imagen') == $key ? 'checked' : '' }}>
                                            <div
                                                class="h-full rounded-xl p-4 border-2 border-slate-700 bg-slate-800/50 peer-checked:border-purple-500 peer-checked:bg-purple-500/20 hover:border-slate-500 transition-all duration-200">
                                                <div class="text-center">
                                                    <span class="text-3xl block mb-2">{{ $agent['icon'] }}</span>
                                                    <h4 class="font-bold text-white text-sm">{{ $agent['name'] }}</h4>
                                                    <p class="text-xs text-slate-400 mt-1">{{ $agent['description'] }}</p>
                                                </div>
                                            </div>
                                            <!-- Empty circle (unchecked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:hidden">
                                            </div>
                                            <!-- Filled circle with check (checked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full bg-purple-500 border-2 border-purple-500 hidden peer-checked:flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('image_agent')" class="mt-2" />
                            </div>

                            <!-- Voice Agent -->
                            <div>
                                <x-input-label for="voice_agent" :value="__('Voice Generation Agent')" />
                                <p class="text-sm text-slate-400 mb-3">Choose audio quality for narration</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($voiceAgents as $key => $agent)
                                        <label class="relative cursor-pointer block">
                                            <input type="radio" name="voice_agent" value="{{ $key }}" class="peer sr-only"
                                                {{ old('voice_agent', 'openai_tts') == $key ? 'checked' : '' }}>
                                            <div
                                                class="h-full rounded-xl p-4 border-2 border-slate-700 bg-slate-800/50 peer-checked:border-pink-500 peer-checked:bg-pink-500/20 hover:border-slate-500 transition-all duration-200">
                                                <div class="text-center">
                                                    <span class="text-3xl block mb-2">{{ $agent['icon'] }}</span>
                                                    <h4 class="font-bold text-white text-sm">{{ $agent['name'] }}</h4>
                                                    <p class="text-xs text-slate-400 mt-1">{{ $agent['description'] }}</p>
                                                </div>
                                            </div>
                                            <!-- Empty circle (unchecked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:hidden">
                                            </div>
                                            <!-- Filled circle with check (checked) -->
                                            <div
                                                class="absolute top-4 right-4 w-5 h-5 rounded-full bg-pink-500 border-2 border-pink-500 hidden peer-checked:flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('voice_agent')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-700">
                            <a href="{{ route('stories.index') }}" class="btn-ghost px-6 py-3 w-full sm:w-auto">
                                Cancel
                            </a>
                            <button type="submit" class="btn-primary px-10 py-4 text-lg w-full sm:w-auto">
                                <span class="text-xl">✨</span>
                                Create Magical Story
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">🤖 Multi-Agent AI Generation</h3>
                        <p class="text-slate-300 leading-relaxed">
                            Choose from multiple AI providers! OpenAI, Google Gemini, or Stability AI. Each offers
                            unique strengths for your story creation.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2 text-xs">
                            <span
                                class="px-3 py-1.5 bg-emerald-500/20 text-emerald-300 rounded-lg font-medium border border-emerald-500/30">🤖
                                OpenAI GPT-4</span>
                            <span
                                class="px-3 py-1.5 bg-blue-500/20 text-blue-300 rounded-lg font-medium border border-blue-500/30">💎
                                Google Gemini</span>
                            <span
                                class="px-3 py-1.5 bg-purple-500/20 text-purple-300 rounded-lg font-medium border border-purple-500/30">🎨
                                DALL-E 3</span>
                            <span
                                class="px-3 py-1.5 bg-orange-500/20 text-orange-300 rounded-lg font-medium border border-orange-500/30">🌟
                                Stability AI</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>