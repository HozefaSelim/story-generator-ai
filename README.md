# 🎨 AI-Powered Story Generator for Children

A complete Laravel-based web application that uses AI to generate personalized, multimedia children's stories. Create engaging educational content with AI-generated text, custom illustrations, voice narration, and printable magazines.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![OpenAI](https://img.shields.io/badge/OpenAI-GPT--4-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

---

## 📋 Project Summary

This application allows parents, teachers, and content creators to generate unique children's stories in minutes using AI technology. The system automatically creates:

- **📖 Story Text** - Personalized narratives using GPT-4
- **🎨 Illustrations** - Custom images for each scene using DALL-E 3
- **🎙️ Voice Narration** - Professional audio using OpenAI TTS
- **📄 PDF Magazine** - Beautiful printable format
- **🎬 Video** - Optional MP4 with images and narration (requires FFmpeg)

### Key Features
- ✅ **Fully Automated** - Generate complete stories in 3-4 minutes
- ✅ **Personalization** - Add child's name, age, interests, and educational lessons
- ✅ **12 Themes** - Adventure, Fantasy, Science, Animals, Space, and more
- ✅ **8 Visual Styles** - Cartoon, Watercolor, 3D, Comic, and more
- ✅ **6 Voice Options** - Different voices for narration
- ✅ **Queue System** - Asynchronous processing with job retries
- ✅ **User Management** - Authentication with role-based access
- ✅ **Download Options** - PDF, MP3, MP4 formats

### Technology Stack
- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **AI Services**: OpenAI (GPT-4, DALL-E 3, TTS)
- **Database**: MySQL / SQLite
- **Queue**: Database / Redis
- **Media**: FFmpeg (optional for video)
- **PDF**: DomPDF with base64 image encoding

### Cost Per Story
- ~$0.50-0.87 per story (OpenAI API costs)
- No subscription fees - pay only for what you generate

---

## 🚀 Quick Start Guide

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite
- **OpenAI API Key** with credits ([Get one here](https://platform.openai.com/api-keys))

### Installation (5 Minutes)

#### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/story-generator-ai.git
cd story-generator-ai
```

#### 2️⃣ Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

#### 3️⃣ Configure Environment
```bash
# Create .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

**Edit `.env` file and add your OpenAI API key:**
```env
OPENAI_API_KEY=sk-proj-your-api-key-here
OPENAI_REQUEST_TIMEOUT=120
```

> 💡 **Get OpenAI API Key:** Visit [platform.openai.com/api-keys](https://platform.openai.com/api-keys)

#### 4️⃣ Database Setup
```bash
# Run migrations
php artisan migrate

# Optional: Seed with sample data
php artisan db:seed
```

#### 5️⃣ Create Storage Link
```bash
# Create symbolic link (REQUIRED for images/audio to display)
php artisan storage:link

# Clear and cache config
php artisan config:clear
php artisan config:cache
```

#### 6️⃣ Build Frontend
```bash
npm run build
```

#### 7️⃣ Start Application
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Queue Worker (REQUIRED!)
php artisan queue:work
```

**🎉 Done!** Visit: `http://localhost:8000`

---

## 📖 How to Use

### Creating Your First Story

1. **Register/Login** at `http://localhost:8000/register`

2. **Go to Create Story** (`/stories/create`)

3. **Fill in the Form:**
   - **Story Title**: e.g., "Luna's Space Adventure"
   - **Theme**: Choose from 12 options (Adventure, Fantasy, etc.)
   - **Visual Style**: Choose from 8 styles (Cartoon, Watercolor, etc.)
   - **Voice**: Select narration voice (Nova recommended for children)
   - **Child Name** (optional): Personalizes the story
   - **Age**: 1-18 years (adjusts complexity)
   - **Interests** (optional): e.g., "dinosaurs, space"
   - **Lesson** (optional): e.g., "importance of friendship"
   - **Number of Images**: 2-10 (4 recommended)

4. **Click "Create Magical Story"**

5. **Wait 3-4 Minutes**
   - Watch the queue worker terminal for progress
   - Story will be marked as "processing"

6. **View Your Story**
   - Once complete, view at `/stories/{id}`
   - See all images, read the story, play audio

7. **Download**
   - Download PDF magazine (printable)
   - Download MP3 audio
   - Download MP4 video (if FFmpeg installed)

### Example Test Data
```
Title: Leo's Brave Adventure
Theme: Adventure
Style: Colorful & Vibrant
Voice: Nova - Youthful
Child Name: Leo
Age: 7
Interests: forests, treasure hunting
Lesson: being brave and helping others
Images: 4
```

---

## ⚙️ Configuration

### OpenAI API Setup

**Step 1: Create Account**
- Go to [platform.openai.com](https://platform.openai.com/)

**Step 2: Add Credits** (⚠️ Required)
- Go to [Billing](https://platform.openai.com/account/billing/overview)
- Add payment method
- Add minimum $5-10 in credits

**Step 3: Generate API Key**
- Go to [API Keys](https://platform.openai.com/api-keys)
- Click "Create new secret key"
- Copy the key (starts with `sk-proj-...`)

**Step 4: Add to Project**
```env
OPENAI_API_KEY=sk-proj-xxxxxxxxxxxxx
OPENAI_REQUEST_TIMEOUT=120
```

**Step 5: Clear Cache**
```bash
php artisan config:clear
php artisan config:cache
```

### FFmpeg (Optional - For Video Generation)

**Without FFmpeg:** Stories generate with text, images, audio, and PDF ✅

**With FFmpeg:** Also generates MP4 video ✅

**Windows:**
```bash
# Option 1: Chocolatey
choco install ffmpeg

# Option 2: Manual
# 1. Download from: https://github.com/BtbN/FFmpeg-Builds/releases
# 2. Extract to C:\ffmpeg
# 3. Add C:\ffmpeg\bin to Windows PATH
# 4. Verify: ffmpeg -version
```

**Linux:**
```bash
sudo apt update && sudo apt install ffmpeg
```

**macOS:**
```bash
brew install ffmpeg
```

---

## 🌟 Features

- **AI-Generated Stories**: Create unique, personalized stories using OpenAI's GPT models
- **Custom Illustrations**: Generate images for each scene using DALL-E 3
- **Voice Narration**: Convert stories to speech with natural-sounding voices
- **Video Compilation**: Combine images and narration into engaging videos
- **PDF Magazine Export**: Print stories as beautiful, gift-quality magazines
- **Photo Integration**: Upload child's photo to make them the story protagonist
- **Multiple Themes & Styles**: Choose from various story themes and visual styles
- **User Roles**: Support for parents, teachers, and administrators
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## 📋 Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Features in Detail](#features-in-detail)
- [API Services](#api-services)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## 🔧 Requirements

### Core Requirements (Must Have)
- **PHP**: >= 8.2
- **Composer**: Latest version
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **Database**: MySQL 8.0+ or SQLite
- **OpenAI API Key**: **REQUIRED** - Get from [platform.openai.com](https://platform.openai.com/)
- **OpenAI Credits**: Minimum $5-10 to start
- **Storage**: At least 5GB free space for generated content
- **Queue Worker**: Must be running during story generation

### Optional Requirements (Enhances Features)
- **FFmpeg**: For video compilation (without it, videos won't be generated but everything else works)
- **Redis**: For better queue management in production
- **Supervisor**: For running queue workers automatically in production

---

## 📁 Project Structure

```
story-generator-ai/
├── app/
│   ├── Http/Controllers/
│   │   ├── StoryController.php      # Main story logic
│   │   └── Controller.php            # Base controller with AuthorizesRequests
│   ├── Jobs/
│   │   └── GenerateStoryJob.php     # Async story generation
│   ├── Models/
│   │   ├── Story.php
│   │   └── StoryElement.php
│   ├── Policies/
│   │   └── StoryPolicy.php          # Authorization policies
│   └── Services/
│       ├── StoryGenerationService.php  # GPT-4 integration
│       ├── ImageGenerationService.php  # DALL-E 3 integration
│       ├── TextToSpeechService.php     # OpenAI TTS
│       ├── VideoCompilationService.php # FFmpeg video creation
│       └── PdfMagazineService.php      # PDF generation
├── config/
│   └── openai.php                   # OpenAI configuration
├── resources/
│   └── views/
│       ├── stories/
│       │   ├── create.blade.php     # Story creation form
│       │   └── show.blade.php       # Story display page
│       └── pdf/
│           └── magazine.blade.php   # PDF template
└── storage/app/public/
    ├── story-images/                # Generated images
    ├── story-audio/                 # Audio files
    ├── story-videos/                # Video files
    └── story-pdfs/                  # PDF magazines
```

---

## 🔒 Security Notes

- Store OpenAI API key securely in `.env` (never commit to git)
- Use `.env.example` for documentation
- Implement rate limiting for story generation
- Validate all user inputs
- Use authorization policies (StoryPolicy)

---

## 📝 License

This project is licensed under the MIT License.

## 🤝 Contributing

Contributions welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📧 Support

- **Issues:** Open an issue on GitHub
- **Documentation:** Check this README
- **Logs:** Check `storage/logs/laravel.log`

## 🙏 Acknowledgments

- [OpenAI](https://openai.com/) - GPT-4, DALL-E 3, and TTS APIs
- [Laravel](https://laravel.com/) - PHP Framework
- [DomPDF](https://github.com/barryvdh/laravel-dompdf) - PDF Generation
- [Tailwind CSS](https://tailwindcss.com/) - UI Styling

---

## 📌 Important Notes

- ⚠️ **Queue worker must run continuously** during story generation
- ⚠️ **OpenAI API key and credits are required** - no free tier
- ⚠️ **Storage link is critical** - run `php artisan storage:link`
- ⚠️ **Clear config after .env changes** - run `php artisan config:clear`
- ✅ **Video is optional** - app works fine without FFmpeg
- ✅ **PDF uses base64 images** - no external image dependencies
- ✅ **Job retries enabled** - failed jobs retry automatically 3 times

---

**Built with ❤️ for children's education and creativity**

**Version:** 1.0.0  
**Last Updated:** November 2025  
**Status:** ✅ Production Ready
