<?php

use App\Models\Csr;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Inquiry;
use App\Models\Director;
use App\Models\TeamMember;
use App\Models\TeamGallery;
use App\Models\SisterConcern;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Job;
use App\Models\Application;

/**
 * 1. HOME PAGE
 */
Route::get('/', function () {
    return view('welcome', [
        'sliders' => Slider::all(),
        'projects' => Project::latest()->take(6)->get(),
        'settings' => Setting::first()
    ]);
});

/**
 * 2. ABOUT US SECTION (Specific routes must come before the wildcard)
 */

// Management Team
Route::get('/about-us/management-team', function () {
    return view('pages.management-team', [
        'settings' => Setting::first(),
        'members' => TeamMember::orderBy('sort_order', 'asc')->get(),
        'gallery' => TeamGallery::orderBy('sort_order', 'asc')->get()
    ]);
});

// Board of Directors
Route::get('/about-us/board-of-directors', function () {
    return view('pages.board-of-directors', [
        'settings' => Setting::first(),
        'directors' => Director::orderBy('sort_order', 'asc')->get()
    ]);
});

// Sister Concerns
Route::get('/about-us/sister-concerns', function () {
    return view('pages.sister-concerns', [
        'settings' => Setting::first(),
        'concerns' => SisterConcern::orderBy('sort_order', 'asc')->get()
    ]);
});

// CSR (Corporate Social Responsibility)
Route::get('/about-us/csr', function () {
    return view('pages.csr', [
        'settings' => Setting::first(),
        'csrs' => Csr::orderBy('sort_order', 'asc')->get()
    ]);
});

// WHY US (Added here specifically)
Route::get('/about-us/why-us', function () {
    return view('pages.why-us', [
        'settings' => Setting::first()
    ]);
});

// Our Stories
Route::get('/about-us/stories', function () {
    return view('pages.stories', [
        'settings' => Setting::first()
    ]);
});

// Wildcard for other about sections (Keep this at the bottom of the About section)
Route::get('/about-us/{slug}', function ($slug) {
    return view('pages.stories', ['settings' => Setting::first()]);
});

/**
 * 3. PROJECT DETAIL PAGE
 */
Route::get('/project/{slug}', function ($slug) {
    $project = Project::where('slug', $slug)->firstOrFail();
    $relatedProjects = Project::where('category', $project->category)
        ->where('id', '!=', $project->id)
        ->take(4)
        ->get();

    return view('project-details', [
        'project' => $project,
        'relatedProjects' => $relatedProjects,
        'settings' => Setting::first()
    ]);
});

/**
 * 4. PROJECTS LISTING PAGE
 */

// All Projects Index (Rangs Model - 4 Column Grid)
Route::get('/projects', function () {
    return view('projects-list', [
        'projects' => Project::paginate(12),
        'currentStatus' => 'all',
        'settings' => Setting::first()
    ]);
})->name('projects.index');

// Filtered Residential Projects
Route::get('/projects/residential/{status?}', function ($status = 'all') {
    $query = Project::query();
    
    // Status can be: all, ongoing, upcoming, completed
    if ($status !== 'all') {
        $query->where('category', ucfirst($status));
    }

    return view('projects-list', [
        'projects' => $query->paginate(12),
        'currentStatus' => strtolower($status),
        'settings' => Setting::first()
    ]);
})->name('projects.residential');

/**
 * 5. CONTACT PAGE
 */
Route::get('/contact', function () {
    return view('contact', [
        'settings' => Setting::first()
    ]);
})->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);
    Inquiry::create($validated);
    return back()->with('success', 'Thank you! Your message has been received.');
})->name('contact.send');

/**
 * 6. OTHER PLACEHOLDERS
 */
Route::get('/news-events', function () {
    return view('pages.news', [
        'settings' => \App\Models\Setting::first(),
        'news' => \App\Models\News::orderBy('published_at', 'desc')->get()
    ]);
})->name('news');

Route::get('/services/{slug}', function ($slug) {
    $service = Service::where('slug', $slug)->firstOrFail();
    $settings = \App\Models\Setting::first();
    return view('pages.service-details', compact('service', 'settings'));
})->name('services.show');

Route::get('/blog', function () {
    $blogs = Blog::latest()->whereNotNull('published_at')->get();
    $settings = \App\Models\Setting::first();
    return view('pages.blog-list', compact('blogs', 'settings'));
})->name('blog.index');

// Blog Detail Page
Route::get('/blog/{slug}', function ($slug) {
    $blog = Blog::where('slug', $slug)->firstOrFail();
    $settings = \App\Models\Setting::first();
    return view('pages.blog-detail', compact('blog', 'settings'));
})->name('blog.show');

// 1. Career List Page
Route::get('/career', function () {
    return view('pages.career-list', [
        'jobs' => Job::where('is_active', true)->latest()->get(),
        'settings' => \App\Models\Setting::first()
    ]);
})->name('career.index');

// 2. Career Detail Page
Route::get('/career/{slug}', function ($slug) {
    $job = Job::where('slug', $slug)->firstOrFail();
    return view('pages.career-detail', [
        'job' => $job,
        'settings' => \App\Models\Setting::first()
    ]);
})->name('career.show');

// 3. Handle Application Submission
Route::post('/career/apply', function (Request $request) {
    $validated = $request->validate([
        'job_id' => 'required|exists:jobs,id',
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'resume_text' => 'required|string',
    ]);

    Application::create($validated);
    return back()->with('success', 'Your application has been submitted successfully!');
})->name('career.apply');

Route::get('/terms-conditions', function () {
    return view('pages.terms', ['settings' => \App\Models\Setting::first()]);
})->name('terms');

Route::get('/privacy-policy', function () {
    return view('pages.privacy', ['settings' => \App\Models\Setting::first()]);
})->name('privacy');