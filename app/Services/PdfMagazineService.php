<?php

namespace App\Services;

use App\Models\Story;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class PdfMagazineService
{
    /**
     * Generate a magazine-style PDF from a story
     */
    public function generateMagazine(Story $story): string
    {
        // Load the story with all its elements
        $story->load('elements', 'user');

        // Prepare data for the PDF
        $data = [
            'story' => $story,
            'title' => $story->title,
            'author' => $story->user->name,
            'content' => $story->content,
            'elements' => $story->elements,
            'generatedDate' => now()->format('F j, Y'),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.magazine', $data);
        
        // Set options
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ]);

        // Save PDF
        $fileName = 'story-pdfs/' . uniqid() . '_' . \Str::slug($story->title) . '.pdf';
        $pdfContent = $pdf->output();
        
        Storage::disk('public')->put($fileName, $pdfContent);

        return $fileName;
    }

    /**
     * Generate a simple story book PDF
     */
    public function generateStoryBook(Story $story): string
    {
        $story->load('elements', 'user');

        $data = [
            'story' => $story,
            'title' => $story->title,
            'content' => $this->formatStoryContent($story->content),
            'images' => $story->elements()->where('type', 'image')->get(),
            'generatedDate' => now()->format('F j, Y'),
        ];

        $pdf = Pdf::loadView('pdf.storybook', $data);
        $pdf->setPaper('a4', 'portrait');

        $fileName = 'story-pdfs/' . uniqid() . '_book_' . \Str::slug($story->title) . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        return $fileName;
    }

    /**
     * Generate a coloring book version (images only with outlines)
     */
    public function generateColoringBook(Story $story): string
    {
        $story->load('elements');

        $images = $story->elements()->where('type', 'image')->get();

        $data = [
            'title' => $story->title . ' - Coloring Book',
            'images' => $images,
        ];

        $pdf = Pdf::loadView('pdf.coloring-book', $data);
        $pdf->setPaper('a4', 'portrait');

        $fileName = 'story-pdfs/' . uniqid() . '_coloring_' . \Str::slug($story->title) . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        return $fileName;
    }

    /**
     * Format story content for better PDF rendering
     */
    protected function formatStoryContent(string $content): string
    {
        // Split into paragraphs
        $paragraphs = explode("\n\n", $content);
        
        // Wrap each paragraph in <p> tags
        $formatted = array_map(function ($paragraph) {
            return '<p>' . nl2br(trim($paragraph)) . '</p>';
        }, $paragraphs);

        return implode('', $formatted);
    }

    /**
     * Get PDF file size in human-readable format
     */
    public function getFileSize(string $filePath): string
    {
        $bytes = Storage::disk('public')->size($filePath);
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Download PDF file
     */
    public function downloadPdf(string $filePath, string $fileName = null)
    {
        $fullPath = Storage::disk('public')->path($filePath);
        
        if (!file_exists($fullPath)) {
            throw new \Exception('PDF file not found');
        }

        if (!$fileName) {
            $fileName = basename($filePath);
        }

        return response()->download($fullPath, $fileName);
    }
}

