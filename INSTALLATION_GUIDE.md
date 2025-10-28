# Installation Guide - AI Story Generator

## Quick Start Guide

This guide will help you set up the AI-Powered Story Generator application on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:

1. **PHP 8.2 or higher**
   ```bash
   php --version
   ```

2. **Composer** (PHP package manager)
   ```bash
   composer --version
   ```

3. **Node.js 18+ and NPM**
   ```bash
   node --version
   npm --version
   ```

4. **Git**
   ```bash
   git --version
   ```

5. **Database** (MySQL, PostgreSQL, or SQLite)

6. **OpenAI API Account** with credits

## Step-by-Step Installation

### Step 1: Get the Application

The application is located at:
```
C:\Users\hothe\story-generator-ai
```

Navigate to this directory in your terminal.

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Environment Configuration

1. Copy the example environment file:
   ```bash
   copy .env.example .env
   ```

2. Generate application key:
   ```bash
   php artisan key:generate
   ```

3. Open `.env` file and configure:

   **Database Settings** (SQLite is pre-configured, or use MySQL/PostgreSQL):
   ```env
   # For SQLite (easiest for development)
   DB_CONNECTION=sqlite
   
   # For MySQL
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=story_generator
   # DB_USERNAME=root
   # DB_PASSWORD=your_password
   ```

   **OpenAI API Configuration** (REQUIRED):
   ```env
   OPENAI_API_KEY=sk-your-actual-api-key-here
   OPENAI_ORGANIZATION=org-your-organization-id
   ```

### Step 4: Database Setup

1. Create database tables:
   ```bash
   php artisan migrate
   ```

2. (Optional) Run migrations fresh:
   ```bash
   php artisan migrate:fresh
   ```

### Step 5: Storage Setup

1. Create symbolic link for public storage:
   ```bash
   php artisan storage:link
   ```

2. Create necessary directories (Windows):
   ```bash
   mkdir storage\app\public\story-images
   mkdir storage\app\public\story-audio
   mkdir storage\app\public\story-videos
   mkdir storage\app\public\story-pdfs
   mkdir storage\app\public\uploads\photos
   ```

### Step 6: Build Frontend Assets

```bash
# For production build
npm run build

# For development with hot reload
npm run dev
```

### Step 7: Start the Application

Open **TWO** terminal windows:

**Terminal 1 - Web Server:**
```bash
php artisan serve
```

**Terminal 2 - Queue Worker (IMPORTANT):**
```bash
php artisan queue:work
```

The queue worker is essential for story generation to work!

### Step 8: Access the Application

Open your browser and navigate to:
```
http://localhost:8000
```

## Getting Your OpenAI API Key

1. Go to [OpenAI Platform](https://platform.openai.com/)
2. Sign up or log in
3. Navigate to API Keys section
4. Click "Create new secret key"
5. Copy the key and paste it in your `.env` file
6. **Important**: Add credits to your account (billing section)

### OpenAI API Costs

Estimated costs per story:
- Text Generation (GPT-4): $0.10 - $0.30
- Image Generation (DALL-E 3): $0.04 - $0.16 per image
- Voice (TTS): $0.015 per 1000 characters

Average: $0.20 - $0.60 per story

## Optional: FFmpeg Installation (For Video Features)

### Windows
1. Download from [FFmpeg Official Site](https://ffmpeg.org/download.html)
2. Or use Chocolatey:
   ```bash
   choco install ffmpeg
   ```

3. Verify installation:
   ```bash
   ffmpeg -version
   ```

### Testing FFmpeg
```bash
# Should show version info
ffmpeg -version
```

## First Time Usage

1. **Register an Account**:
   - Go to http://localhost:8000/register
   - Create your account

2. **Create Your First Story**:
   - Click "Create New Story"
   - Fill in the form
   - Wait 2-5 minutes for generation

3. **Check Queue Worker**:
   - Ensure Terminal 2 (queue worker) is running
   - You should see processing messages

## Troubleshooting

### Problem: "No application encryption key"
**Solution:**
```bash
php artisan key:generate
```

### Problem: "Class 'OpenAI' not found"
**Solution:**
```bash
composer install
```

### Problem: "SQLSTATE[HY000]" database error
**Solution:**
- Check `.env` database settings
- For SQLite, ensure `database/database.sqlite` exists:
  ```bash
  type nul > database\database.sqlite
  ```

### Problem: Stories not generating
**Solution:**
- Ensure queue worker is running: `php artisan queue:work`
- Check OpenAI API key is valid
- Check `storage/logs/laravel.log` for errors

### Problem: "Storage not found" or 404 on images
**Solution:**
```bash
php artisan storage:link
```

### Problem: Permission denied errors
**Solution (Windows):** Run terminal as Administrator

**Solution (Linux/Mac):**
```bash
chmod -R 775 storage bootstrap/cache
```

### Problem: Video generation fails
**Solution:**
- Install FFmpeg (see above)
- Verify: `ffmpeg -version`
- Check storage space (videos are large)

## Production Deployment

When deploying to production:

1. **Environment Settings:**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize Application:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

3. **Set Up Queue Worker** with Supervisor (not just `php artisan queue:work`)

4. **Set Up Cron Jobs:**
   ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

5. **Use Production Database** (MySQL/PostgreSQL, not SQLite)

6. **Configure Web Server** (Nginx/Apache)

7. **Enable HTTPS** (Let's Encrypt)

8. **Set Up Backups** for database and storage

## Getting Help

- Check `storage/logs/laravel.log` for error messages
- Ensure all services are running (web server + queue worker)
- Verify OpenAI API key has sufficient credits
- Check system requirements are met

## Next Steps

After successful installation:
1. Read the main README.md for usage instructions
2. Explore the available themes and styles
3. Create test stories to understand the process
4. Customize the application to your needs

## Development Tips

- Keep queue worker running during development
- Use `npm run dev` for hot reloading of assets
- Check logs frequently: `tail -f storage/logs/laravel.log`
- Test with small number of images first (cheaper)
- Monitor OpenAI API usage and costs

---

**Need Help?** Check the main README.md or the troubleshooting section above.

