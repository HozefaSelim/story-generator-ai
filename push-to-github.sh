#!/bin/bash

echo "========================================"
echo "  Git Setup and Push to GitHub"
echo "========================================"
echo ""

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "ERROR: Git is not installed"
    echo "Please install Git first"
    exit 1
fi

echo "[1/6] Initializing Git repository..."
git init

echo ""
echo "[2/6] Adding all files to git..."
git add .

echo ""
echo "[3/6] Creating initial commit..."
git commit -m "Initial commit: AI-Powered Story Generator"

echo ""
echo "[4/6] Renaming branch to 'main'..."
git branch -M main

echo ""
echo "========================================"
echo "  Setup Complete!"
echo "========================================"
echo ""
echo "Next steps:"
echo "  1. Create a new repository on GitHub: https://github.com/new"
echo "  2. Copy the repository URL (e.g., https://github.com/username/repo.git)"
echo "  3. Run these commands:"
echo ""
echo "     git remote add origin YOUR_REPO_URL"
echo "     git push -u origin main"
echo ""
echo "Replace YOUR_REPO_URL with your actual GitHub repository URL"
echo ""
echo "========================================"

