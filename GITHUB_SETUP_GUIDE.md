# GitHub Setup Guide

## Prerequisites
- Git installed on your system
- A GitHub account
- Terminal/Command Prompt access

## Step 1: Initialize Git Repository

Open your terminal in the project directory and run:

```bash
# Navigate to your project directory
cd "C:\Users\hothe\OneDrive\سطح المكتب\Yapay Zeka ile kısa hikaye Üretimi\story-generator-ai"

# Initialize git repository
git init

# Check git status
git status
```

## Step 2: Add All Files to Git

```bash
# Add all files to staging
git add .

# Verify what will be committed
git status
```

## Step 3: Create Initial Commit

```bash
# Commit all files
git commit -m "Initial commit: AI-Powered Story Generator"
```

## Step 4: Create GitHub Repository

1. Go to [GitHub](https://github.com/)
2. Click the **"+"** icon in the top right corner
3. Select **"New repository"**
4. Fill in the details:
   - **Repository name**: `story-generator-ai` (or your preferred name)
   - **Description**: "AI-powered story generator for children using OpenAI GPT-4, DALL-E 3, and Laravel"
   - **Visibility**: Choose Public or Private
   - **DO NOT** initialize with README, .gitignore, or license (you already have these)
5. Click **"Create repository"**

## Step 5: Connect to GitHub and Push

After creating the repository, GitHub will show you commands. Use these:

```bash
# Add your GitHub repository as remote
git remote add origin https://github.com/YOUR_USERNAME/story-generator-ai.git

# Rename branch to main (if needed)
git branch -M main

# Push your code to GitHub
git push -u origin main
```

**Replace `YOUR_USERNAME` with your actual GitHub username!**

## Step 6: Verify

Visit your repository on GitHub to confirm all files are uploaded.

## Alternative: Using GitHub Desktop

If you prefer a GUI:

1. Download and install [GitHub Desktop](https://desktop.github.com/)
2. Open GitHub Desktop
3. Click "Add" → "Add existing repository"
4. Browse to your project folder
5. If it says "not a git repository", click "Create a repository"
6. Click "Publish repository" in the top bar
7. Choose your settings and publish

## Important Notes

### Files NOT Uploaded (in .gitignore)
The following files/folders are excluded and won't be uploaded:
- `/node_modules` - Node.js dependencies
- `/vendor` - PHP dependencies  
- `.env` - Your environment configuration (contains secrets!)
- `/storage/*.key` - Storage keys
- `/public/build` - Built assets
- `*.log` - Log files

### Security Reminders
✅ **NEVER commit your `.env` file** - it contains API keys!
✅ **Create `.env.example`** - Template for others (without real keys)
✅ **Add sensitive data to `.gitignore`** - Already done for you

### After Others Clone Your Repository

When someone clones your repository, they need to:

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Build frontend assets
npm run build

# Create storage link
php artisan storage:link
```

## Future Updates

To push new changes:

```bash
# Check what changed
git status

# Add changed files
git add .

# Commit with message
git commit -m "Description of your changes"

# Push to GitHub
git push
```

## Troubleshooting

### Error: "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/story-generator-ai.git
```

### Error: "fatal: not a git repository"
```bash
git init
```

### Error: Authentication failed
- Use a [Personal Access Token](https://github.com/settings/tokens) instead of password
- Or set up [SSH keys](https://docs.github.com/en/authentication/connecting-to-github-with-ssh)

### Large Files Warning
If you get warnings about large files:
```bash
# Check file sizes
git ls-files | xargs ls -lh

# If needed, add large files to .gitignore
```

## Need Help?

- [GitHub Documentation](https://docs.github.com/)
- [Git Basics](https://git-scm.com/book/en/v2/Getting-Started-Git-Basics)
- [Laravel Deployment](https://laravel.com/docs/deployment)

---

**Your project is ready to be shared with the world! 🚀**

