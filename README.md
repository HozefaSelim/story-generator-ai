# 📚 AI Story Generator

A Laravel application that generates personalized children's stories with AI-powered text, illustrations, voice narration, and video.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?logo=tailwind-css)

## ✨ Features

| Feature | Description |
|---------|-------------|
| 📝 **Story Generation** | AI creates personalized stories with themes, characters, and lessons |
| 🎨 **Illustrations** | Auto-generated images for each story scene |
| 🎙️ **Voice Narration** | Text-to-speech with multiple voice options |
| 🎬 **Video Creation** | Combines images + audio into MP4 video |
| 📄 **PDF Export** | Printable magazine-style story books |
| 👶 **Personalization** | Child's name, age, interests in the story |

## 🤖 Supported AI Providers

| Type | Provider | Model | Cost |
|------|----------|-------|------|
| Text | Google Gemini | gemini-2.0-flash | **FREE** |
| Text | OpenAI | GPT-4 / GPT-4o | Paid |
| Image | Google Gemini | Imagen | **FREE** |
| Image | OpenAI | DALL-E 3 | Paid |
| Voice | OpenAI | TTS / TTS-HD | Paid |

## 🛠️ Tech Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Blade, TailwindCSS, Alpine.js
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Queue**: Database / Redis
- **Video**: FFmpeg
- **PDF**: DomPDF

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- FFmpeg (for video generation)

### Installation

```bash
# Clone the repository
git clone <repository-url>
cd story-generator-ai

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan storage:link

# Build assets
npm run build
```

### Configuration

Edit `.env` with your API keys:

```env
# Required for FREE generation
GEMINI_API_KEY=your_gemini_api_key

# Optional (for paid features)
OPENAI_API_KEY=your_openai_api_key
```

Get your API keys:
- **Gemini (FREE)**: [Google AI Studio](https://aistudio.google.com/apikey)
- **OpenAI**: [OpenAI Platform](https://platform.openai.com/api-keys)

### Running the Application

```bash
# Terminal 1: Start the server
php artisan serve

# Terminal 2: Start the queue worker (required for story generation)
php artisan queue:work
```

Visit: **http://localhost:8000**

---

## 📖 Usage

1. **Register** an account
2. **Create Story** → Fill in title, theme, style, and child details
3. **Select AI Agents** → Choose text, image, and voice providers
4. **Generate** → Wait 2-5 minutes for full story creation
5. **View & Download** → Watch video, listen to audio, download PDF

### Story Themes

Adventure • Fantasy • Science • Friendship • Animals • Space • Nature • Magic • Pirates • Dinosaurs • Underwater • Fairy Tale

### Voice Options

Alloy • Echo • Fable • Onyx • Nova (recommended) • Shimmer

---

## 📁 Project Structure

```
app/
├── Services/
│   ├── StoryGenerationService.php   # Text generation (Gemini/OpenAI)
│   ├── ImageGenerationService.php   # Image generation (Gemini/DALL-E)
│   ├── TextToSpeechService.php      # Voice narration (OpenAI TTS)
│   ├── VideoCompilationService.php  # Video creation (FFmpeg)
│   └── PdfMagazineService.php       # PDF export (DomPDF)
├── Jobs/
│   └── GenerateStoryJob.php         # Async story generation
└── Models/
    ├── Story.php                    # Story model
    └── StoryElement.php             # Images, audio, video elements
```

---

## 🔧 FFmpeg Installation

Required for video generation:

```bash
# Windows (winget)
winget install --id=Gyan.FFmpeg -e

# macOS
brew install ffmpeg

# Ubuntu/Debian
sudo apt install ffmpeg
```

---

## 💰 Cost Estimation

| Provider | Per Story | Notes |
|----------|-----------|-------|
| Gemini | **$0.00** | Text + Images FREE |
| OpenAI GPT-4 | ~$0.20 | Text only |
| DALL-E 3 | ~$0.16 | 4 images |
| OpenAI TTS | ~$0.02 | Voice narration |

**Recommended**: Use Gemini for text/images (FREE) + OpenAI TTS for voice.

---

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| Queue jobs not processing | Run `php artisan queue:work` |
| Video not generating | Install FFmpeg and restart server |
| API key errors | Check `.env` configuration |
| Storage errors | Run `php artisan storage:link` |

Check logs: `storage/logs/laravel.log`

---

## 📝 License

MIT License

---

**Built with ❤️ for children's creativity and education**
