<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\backend\Services;
use App\Models\backend\Team;
use App\Models\backend\Projects;
use App\Models\backend\Application;
use App\Models\backend\Partners;
use App\Models\backend\Blog;
use App\Models\backend\FAQs;

class ChatbotController extends Controller
{
    /**
     * Handle incoming chatbot messages.
     * Returns JSON with the bot reply and optional data cards.
     *
     * The bot is fully dynamic: every response fetches live data
     * from the database so newly-added services, team members,
     * projects, products, blogs, FAQs, and partners are always
     * included automatically.
     */
    public function handle(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $raw   = trim($request->input('message'));
        $input = mb_strtolower($raw);

        $response = $this->detectIntent($input, $raw);

        return response()->json($response);
    }

    /* ================================================================
     *  INTENT DETECTION — ordered from most specific to fallback
     * ================================================================ */
    private function detectIntent(string $input, string $raw): array
    {
        // 1. Greetings
        if ($this->matches($input, ['hi','hello','hey','assalam','salam','good morning','good afternoon','good evening','howdy','greetings'])) {
            return $this->greetingResponse();
        }

        // 2. About GMET / What does GMET do
        if ($this->matches($input, ['what does gmet','what is gmet','about gmet','tell me about gmet','who is gmet','about us','about you','what do you do','what gmet do','company','about the company'])) {
            return $this->aboutResponse();
        }

        // 3. Services
        if ($this->matches($input, ['service','services','what services','your services','solutions','what do you offer','offerings','capabilities','show me your service','gis service','surveying service','remote sensing service','web gis service','geoai service','uav service','drone service','engineering service'])) {
            return $this->servicesResponse();
        }

        // 4. Products / Applications
        if ($this->matches($input, ['product','products','application','applications','your products','show me your product','show products','digital solutions','gis tools','dashboards','platforms','show me your app','your app'])) {
            return $this->productsResponse();
        }

        // 5. Team
        if ($this->matches($input, ['team','your team','show team','members','staff','people','employees','who works','show me your team','meet the team','team members','our team'])) {
            return $this->teamResponse();
        }

        // 6. Projects
        if ($this->matches($input, ['project','projects','your projects','completed projects','show projects','portfolio','case stud','work done','show me your project','past work','featured project'])) {
            return $this->projectsResponse();
        }

        // 7. Blog / Articles
        if ($this->matches($input, ['blog','blogs','article','articles','news','updates','latest news','posts','insights','read','latest blog','latest article'])) {
            return $this->blogsResponse();
        }

        // 8. FAQ
        if ($this->matches($input, ['faq','faqs','frequently asked','common question','questions and answers'])) {
            return $this->faqsResponse();
        }

        // 9. Partners / Clients
        if ($this->matches($input, ['partner','partners','clients','client','business partner','collaborat','ecosystem','who are your clients','your clients'])) {
            return $this->partnersResponse();
        }

        // 10. How to get started
        if ($this->matches($input, ['get started','getting started','how can i start','how to start','how to begin','start working','engage','hire','work with you','how do i start','onboard'])) {
            return $this->getStartedResponse();
        }

        // 11. Contact Info
        if ($this->matches($input, ['contact','phone','email','address','location','where are you','office','reach you','call','whatsapp','find you','get in touch'])) {
            return $this->contactResponse();
        }

        // 12. CEO / Leadership
        if ($this->matches($input, ['ceo','founder','leadership','leader','abida','who founded','who runs','management','chief executive'])) {
            return $this->ceoResponse();
        }

        // 13. Vision / Mission / Values
        if ($this->matches($input, ['vision','mission','philosophy','core values','values','what drives','purpose','motto'])) {
            return $this->visionResponse();
        }

        // 14. Why Choose GMET
        if ($this->matches($input, ['why choose','why gmet','why should','advantages','what makes you different','strengths','unique','competitive','differentiator'])) {
            return $this->whyChooseResponse();
        }

        // 15. Tools / Software
        if ($this->matches($input, ['tools','software','technology stack','tech stack','what tools','arcgis','qgis','python','google earth engine','matlab','envi','erdas'])) {
            return $this->toolsResponse();
        }

        // 16. Pricing
        if ($this->matches($input, ['price','pricing','cost','how much','rates','fees','budget','quotation','quote'])) {
            return $this->pricingResponse();
        }

        // 17. Resources
        if ($this->matches($input, ['resources','resource','downloads','documents','materials','learning'])) {
            return $this->reply(
                "📚 **GMET Resources**\n\nExplore our collection of resources, documentation, and learning materials about geospatial technologies.\n\n🔗 [View Resources](/resources)"
            );
        }

        // 18. Thanks / Goodbye
        if ($this->matches($input, ['thank','thanks','bye','goodbye','see you','good bye','appreciate','helpful'])) {
            return $this->reply(
                "You're welcome! 😊 It was great assisting you.\n\nIf you have any more questions about GMET's services, projects, or solutions, feel free to ask anytime.\n\n*Turning Data, Technology & Ideas into Impact* 🌍\n\n🔗 [Visit our website](/) | [Contact us](/contact)"
            );
        }

        // ── 19. DEEP SEARCH — search across ALL database tables ───
        $deepResult = $this->deepSearch($input, $raw);
        if ($deepResult) {
            return $deepResult;
        }

        // ── 20. FALLBACK — professional catch-all ─────────────────
        return $this->fallbackResponse();
    }

    /* ================================================================
     *  DEEP SEARCH — scans all live DB content for keyword matches
     *  This is the key feature: any new content you add via admin
     *  panel is automatically searchable by the chatbot.
     * ================================================================ */
    private function deepSearch(string $input, string $raw): ?array
    {
        $words = $this->extractSearchWords($input);
        if (empty($words)) {
            return null;
        }

        $results  = [];
        $sections = [];

        // ── Search Services ─────────────────────────────────────
        $services = Services::where('status', 1)->get();
        foreach ($services as $s) {
            $score = $this->relevanceScore($words, $s->title . ' ' . $s->description . ' ' . ($s->category ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'service', 'data' => $s];
            }
        }

        // ── Search Team ─────────────────────────────────────────
        $team = Team::where('status', 1)->get();
        foreach ($team as $m) {
            $score = $this->relevanceScore($words, $m->fullname . ' ' . $m->designation . ' ' . ($m->intro ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'team', 'data' => $m];
            }
        }

        // ── Search Projects ─────────────────────────────────────
        $projects = Projects::where('status', 1)->get();
        foreach ($projects as $p) {
            $score = $this->relevanceScore($words, $p->title . ' ' . ($p->details ?? '') . ' ' . ($p->client ?? '') . ' ' . ($p->category ?? '') . ' ' . ($p->technology ?? '') . ' ' . ($p->key_terms ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'project', 'data' => $p];
            }
        }

        // ── Search Applications / Products ──────────────────────
        $apps = Application::where('status', 1)->get();
        foreach ($apps as $a) {
            $score = $this->relevanceScore($words, $a->title . ' ' . ($a->description ?? '') . ' ' . ($a->category ?? '') . ' ' . ($a->technology ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'product', 'data' => $a];
            }
        }

        // ── Search Blogs ────────────────────────────────────────
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        foreach ($blogs as $b) {
            $score = $this->relevanceScore($words, $b->title . ' ' . strip_tags($b->content ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'blog', 'data' => $b];
            }
        }

        // ── Search FAQs ─────────────────────────────────────────
        try {
            $faqs = FAQs::all();
            foreach ($faqs as $f) {
                $question = $f->question ?? $f->title ?? '';
                $answer   = $f->answer ?? $f->description ?? '';
                $score    = $this->relevanceScore($words, $question . ' ' . $answer);
                if ($score > 0) {
                    $results[] = ['score' => $score, 'type' => 'faq', 'data' => $f];
                }
            }
        } catch (\Throwable $e) {
            // FAQs table may have different columns — skip silently
        }

        // ── Search Partners ─────────────────────────────────────
        $partners = Partners::where('status', 1)->get();
        foreach ($partners as $pt) {
            $score = $this->relevanceScore($words, $pt->name . ' ' . ($pt->description ?? ''));
            if ($score > 0) {
                $results[] = ['score' => $score, 'type' => 'partner', 'data' => $pt];
            }
        }

        if (empty($results)) {
            return null;
        }

        // Sort by relevance (highest first)
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        // Take top results (max 8)
        $top = array_slice($results, 0, 8);

        return $this->buildDeepSearchResponse($top, $raw);
    }

    /**
     * Build a formatted response from deep search results.
     */
    private function buildDeepSearchResponse(array $results, string $query): array
    {
        $lines  = [];
        $cards  = [];
        $groups = [];

        foreach ($results as $r) {
            $groups[$r['type']][] = $r['data'];
        }

        $lines[] = "Here's what I found related to **\"{$query}\"**:\n";

        // Services
        if (!empty($groups['service'])) {
            $lines[] = "**🛠️ Services:**";
            foreach ($groups['service'] as $s) {
                $lines[] = "• **{$s->title}** — " . Str::limit($s->description, 100);
                $cards[] = ['title' => $s->title, 'description' => Str::limit($s->description, 120), 'link' => '/services', 'type' => 'service'];
            }
            $lines[] = "🔗 [View all Services](/services)\n";
        }

        // Team
        if (!empty($groups['team'])) {
            $lines[] = "**👥 Team Members:**";
            foreach ($groups['team'] as $m) {
                $lines[] = "• **{$m->fullname}** — {$m->designation}";
                $cards[] = ['title' => $m->fullname, 'description' => $m->designation, 'link' => '/team', 'type' => 'team'];
            }
            $lines[] = "🔗 [Meet the full Team](/team)\n";
        }

        // Projects
        if (!empty($groups['project'])) {
            $lines[] = "**📋 Projects:**";
            foreach ($groups['project'] as $p) {
                $client = $p->client ? " — _{$p->client}_" : '';
                $lines[] = "• **{$p->title}**{$client}";
                $cards[] = ['title' => $p->title, 'description' => $p->client ?? '', 'link' => '/projects', 'type' => 'project'];
            }
            $lines[] = "🔗 [View all Projects](/projects)\n";
        }

        // Products / Applications
        if (!empty($groups['product'])) {
            $lines[] = "**📱 Products/Applications:**";
            foreach ($groups['product'] as $a) {
                $cat = $a->category ? " ({$a->category})" : '';
                $lines[] = "• **{$a->title}**{$cat}";
                $cards[] = ['title' => $a->title, 'description' => Str::limit(strip_tags($a->description ?? ''), 100), 'link' => '/applications', 'type' => 'product'];
            }
            $lines[] = "🔗 [Explore Products](/applications)\n";
        }

        // Blogs
        if (!empty($groups['blog'])) {
            $lines[] = "**📰 Blog Posts:**";
            foreach ($groups['blog'] as $b) {
                $lines[] = "• **{$b->title}**";
                $cards[] = ['title' => $b->title, 'description' => Str::limit(strip_tags($b->content ?? ''), 100), 'link' => '/blog/' . $b->id, 'type' => 'blog'];
            }
            $lines[] = "🔗 [Read our Blog](/blog)\n";
        }

        // FAQs
        if (!empty($groups['faq'])) {
            $lines[] = "**❓ FAQs:**";
            foreach ($groups['faq'] as $f) {
                $q = $f->question ?? $f->title ?? 'FAQ';
                $a = $f->answer ?? $f->description ?? '';
                $lines[] = "• **{$q}**\n  " . Str::limit($a, 150);
            }
            $lines[] = "";
        }

        // Partners
        if (!empty($groups['partner'])) {
            $lines[] = "**🤝 Partners:**";
            foreach ($groups['partner'] as $pt) {
                $lines[] = "• **{$pt->name}** — " . Str::limit($pt->description ?? '', 100);
                $cards[] = ['title' => $pt->name, 'description' => Str::limit($pt->description ?? '', 100), 'link' => '/partners', 'type' => 'partner'];
            }
            $lines[] = "🔗 [View Partners](/partners)\n";
        }

        $lines[] = "Feel free to ask me anything else about GMET! 💬";

        return $this->reply(implode("\n", $lines), $cards, 'search');
    }

    /* ================================================================
     *  SPECIFIC RESPONSE BUILDERS (all fetch live DB data)
     * ================================================================ */

    private function greetingResponse(): array
    {
        // Pull live counts for the greeting
        $sCount = Services::where('status', 1)->count();
        $tCount = Team::where('status', 1)->count();
        $pCount = Projects::where('status', 1)->count();
        $aCount = Application::where('status', 1)->count();
        $bCount = Blog::count();

        $stats = [];
        if ($sCount > 0) $stats[] = "{$sCount} services";
        if ($aCount > 0) $stats[] = "{$aCount} products";
        if ($pCount > 0) $stats[] = "{$pCount} projects";
        if ($tCount > 0) $stats[] = "{$tCount} team members";
        if ($bCount > 0) $stats[] = "{$bCount} blog posts";

        $statLine = !empty($stats)
            ? "\n\n📊 We currently have: **" . implode(', ', $stats) . "** — all at your fingertips!"
            : '';

        return $this->reply(
            "Hello! 👋 Welcome to **GMET** — Geo Mapping Engineering & Technologies.{$statLine}\n\nHere are some things you can ask me:\n• What does GMET do?\n• Show me your services\n• Show me your products\n• Show me your team\n• Show me your projects\n• Latest blog posts\n• How can I get started?\n• Contact information\n\nOr just type anything — I'll search our website for you! 🔍"
        );
    }

    private function aboutResponse(): array
    {
        $sCount = Services::where('status', 1)->count();
        $pCount = Projects::where('status', 1)->count();
        $tCount = Team::where('status', 1)->count();

        return $this->reply(
            "**Geo Mapping Engineering & Technologies (GMET)** delivers premier geospatial and engineering solutions for government, private, and development sectors.\n\n🌍 **Our Expertise:**\n• GIS & Remote Sensing\n• Advanced Surveying & UAV/Drone Mapping\n• Web GIS & Cloud Mapping\n• GeoAI & AI-driven Spatial Analysis\n• Geomatics & Precision Engineering\n• Environmental Monitoring & Infrastructure Planning\n\n📌 **Tagline:** *Turning Data, Technology & Ideas into Impact*\n\n🏢 **Founded:** 2025\n👩‍💼 **CEO:** Mrs. Abida Parveen (15+ years of geospatial experience)\n\n📊 **By the numbers:** {$sCount} services • {$pCount} projects • {$tCount} team members\n\n**Vision:** To become the trusted global partner for geospatial innovation.\n**Mission:** To empower organizations with precise geospatial intelligence.\n\n**Core Values:** Innovation • Collaboration • Integrity • Excellence\n\n🔗 [Learn more on our About page](/about)"
        );
    }

    private function servicesResponse(): array
    {
        $services = Services::where('status', 1)->orderBy('order', 'asc')->get();

        if ($services->isEmpty()) {
            return $this->reply(
                "🛠️ **Our Services & Solutions**\n\nGMET offers a complete portfolio of integrated geospatial and engineering services including:\n\n• GIS & Spatial Analysis\n• Remote Sensing & Earth Observation\n• Advanced Surveying & GPS\n• UAV / Drone Mapping\n• Web GIS & Cloud Mapping\n• GeoAI & AI-driven Solutions\n• Town Planning & Land Use\n• Environmental Monitoring\n• Infrastructure & Engineering\n• Landslide Mapping\n• LULC Analysis\n\n🔗 [View all Services](/services)"
            );
        }

        $list = $services->map(fn($s, $i) => ($i + 1) . ". **{$s->title}** — " . Str::limit($s->description, 80))->implode("\n");

        return $this->reply(
            "🛠️ **Our Services & Solutions**\n\nGMET currently offers **{$services->count()}** professional services:\n\n{$list}\n\n🔗 [View detailed descriptions on our Services page](/services)",
            $services->map(fn($s) => [
                'title'       => $s->title,
                'description' => Str::limit($s->description, 120),
                'link'        => '/services',
            ])->toArray(),
            'services'
        );
    }

    private function productsResponse(): array
    {
        $apps = Application::where('status', 1)->orderBy('order', 'asc')->get();

        if ($apps->isEmpty()) {
            return $this->reply(
                "📱 **Our Products & Digital Solutions**\n\nGMET builds interactive GIS applications, analytical platforms, GeoAI dashboards, and spatial decision systems.\n\nOur application portfolio is currently being updated. Please check back soon!\n\n🔗 [View Products](/applications)"
            );
        }

        $list = $apps->map(function ($a, $i) {
            $cat = $a->category ? " ({$a->category})" : '';
            $tech = $a->technology ? " — *{$a->technology}*" : '';
            return ($i + 1) . ". **{$a->title}**{$cat}{$tech}";
        })->implode("\n");

        return $this->reply(
            "📱 **Our Products & Digital Solutions**\n\nGMET has **{$apps->count()}** operational products:\n\n{$list}\n\nYou can register for access to any of these platforms.\n\n🔗 [Explore all Products](/applications)",
            $apps->map(fn($a) => [
                'title'       => $a->title,
                'description' => Str::limit(strip_tags($a->description ?? ''), 120),
                'category'    => $a->category,
                'technology'  => $a->technology,
                'link'        => '/applications',
            ])->toArray(),
            'products'
        );
    }

    private function teamResponse(): array
    {
        $team = Team::where('status', 1)->orderBy('order', 'asc')->get();

        if ($team->isEmpty()) {
            return $this->reply(
                "👥 **Our Team**\n\nGMET has a highly skilled team with technical, analytical, management, environmental, and Web GIS expertise.\n\n🔗 [Meet our Team](/team)"
            );
        }

        $list = $team->map(fn($m) => "• **{$m->fullname}** — {$m->designation}" . ($m->intro ? "\n  _" . Str::limit($m->intro, 80) . "_" : ''))->implode("\n");

        return $this->reply(
            "👥 **Meet Our Expert Team**\n\nGMET's team of **{$team->count()}** professionals:\n\n{$list}\n\n🔗 [View full team profiles](/team)",
            $team->map(fn($m) => [
                'name'        => $m->fullname,
                'designation' => $m->designation,
                'intro'       => Str::limit($m->intro, 100),
                'link'        => '/team',
            ])->toArray(),
            'team'
        );
    }

    private function projectsResponse(): array
    {
        $projects = Projects::where('status', 1)->orderBy('order', 'asc')->get();
        $featured = Projects::where('status', 1)->where('is_featured', 1)->get();

        if ($projects->isEmpty()) {
            return $this->reply(
                "📋 **Our Projects**\n\nGMET's projects reflect our commitment to turning expertise into practical solutions.\n\n🔗 [View Projects](/projects)"
            );
        }

        $list = $projects->take(12)->map(function ($p, $i) {
            $client = $p->client ? " — _{$p->client}_" : '';
            $timeline = $p->timeline ? " ({$p->timeline})" : '';
            return ($i + 1) . ". **{$p->title}**{$client}{$timeline}";
        })->implode("\n");

        $more = $projects->count() > 12 ? "\n\n...and **" . ($projects->count() - 12) . "** more projects!" : '';
        $featuredNote = $featured->count() > 0 ? "\n\n⭐ **Featured:** " . $featured->pluck('title')->implode(', ') : '';

        return $this->reply(
            "📋 **Completed Projects**\n\nGMET has completed **{$projects->count()}** projects:\n\n{$list}{$more}{$featuredNote}\n\n🔗 [View all Projects with details](/projects)",
            $projects->take(12)->map(fn($p) => [
                'title'    => $p->title,
                'client'   => $p->client,
                'timeline' => $p->timeline,
                'link'     => '/projects',
            ])->toArray(),
            'projects'
        );
    }

    private function blogsResponse(): array
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        if ($blogs->isEmpty()) {
            return $this->reply(
                "📰 **GMET Blog**\n\nOur blog is being set up. Check back soon for geospatial insights and industry articles!\n\n🔗 [Visit Blog](/blog)"
            );
        }

        $list = $blogs->take(8)->map(function ($b, $i) {
            $date = $b->created_at ? $b->created_at->format('M d, Y') : '';
            $dateStr = $date ? " — _{$date}_" : '';
            return ($i + 1) . ". **{$b->title}**{$dateStr}";
        })->implode("\n");

        $more = $blogs->count() > 8 ? "\n\n...and **" . ($blogs->count() - 8) . "** more posts!" : '';

        return $this->reply(
            "📰 **Latest Blog Posts**\n\nGMET has published **{$blogs->count()}** blog articles:\n\n{$list}{$more}\n\n🔗 [Read all posts on our Blog](/blog)",
            $blogs->take(8)->map(fn($b) => [
                'title'       => $b->title,
                'description' => Str::limit(strip_tags($b->content ?? ''), 120),
                'link'        => '/blog/' . $b->id,
            ])->toArray(),
            'blogs'
        );
    }

    private function faqsResponse(): array
    {
        try {
            $faqs = FAQs::all();
        } catch (\Throwable $e) {
            $faqs = collect();
        }

        if ($faqs->isEmpty()) {
            return $this->reply(
                "❓ **FAQs**\n\nNo FAQs have been published yet. Feel free to ask me any question about GMET and I'll do my best to help!\n\n📧 Or email us at **info@gmetechnologies.com**"
            );
        }

        $list = $faqs->take(8)->map(function ($f) {
            $q = $f->question ?? $f->title ?? 'Question';
            $a = $f->answer ?? $f->description ?? '';
            return "**Q: {$q}**\nA: " . Str::limit($a, 150);
        })->implode("\n\n");

        return $this->reply(
            "❓ **Frequently Asked Questions**\n\n{$list}\n\nHave another question? Just type it here and I'll help! 💬"
        );
    }

    private function partnersResponse(): array
    {
        $partners = Partners::where('status', 1)->where('type', 'partner')->orderBy('order', 'asc')->get();
        $clients  = Partners::where('status', 1)->where('type', 'client')->orderBy('order', 'asc')->get();

        $msg = "🤝 **GMET Partners & Clients**\n\n";

        if ($partners->isNotEmpty()) {
            $msg .= "**Business Partners:**\n";
            foreach ($partners as $pt) {
                $msg .= "• **{$pt->name}**" . ($pt->description ? " — " . Str::limit($pt->description, 80) : '') . "\n";
            }
            $msg .= "\n";
        }

        if ($clients->isNotEmpty()) {
            $msg .= "**Valued Clients:**\n";
            foreach ($clients as $cl) {
                $msg .= "• **{$cl->name}**" . ($cl->description ? " — " . Str::limit($cl->description, 80) : '') . "\n";
            }
            $msg .= "\n";
        }

        if ($partners->isEmpty() && $clients->isEmpty()) {
            $msg .= "GMET works with clients and strategic business partners across technology, engineering, cybersecurity, GIS, and development sectors.\n\n";
        }

        $msg .= "🔗 [View Partners & Clients](/partners)";

        return $this->reply($msg);
    }

    private function getStartedResponse(): array
    {
        $sCount = Services::where('status', 1)->count();
        $aCount = Application::where('status', 1)->count();

        $extra = '';
        if ($sCount > 0 || $aCount > 0) {
            $parts = [];
            if ($sCount > 0) $parts[] = "[{$sCount} services](/services)";
            if ($aCount > 0) $parts[] = "[{$aCount} products](/applications)";
            $extra = "\n\n📊 Explore our " . implode(' and ', $parts) . " to see what fits your needs.";
        }

        return $this->reply(
            "Great question! Getting started with GMET is easy:\n\n**1️⃣ Reach Out**\nVisit our [Contact page](/contact) or email **info@gmetechnologies.com**.\n\n**2️⃣ Discuss Your Needs**\nOur team will set up a consultation to understand your geospatial or engineering requirements.\n\n**3️⃣ Get a Tailored Proposal**\nWe'll design a customized solution with clear timelines and deliverables.\n\n**4️⃣ Project Kickoff**\nOnce approved, our experienced team begins execution with regular progress updates.{$extra}\n\n📞 **Phone:** +92 344 5828712\n📞 **Office:** +92 51-6126643\n📧 **Email:** info@gmetechnologies.com\n🏢 **Office:** #103 & 104, 1st Floor, Rawal Mall & Residencia, Rawalpindi\n\n🔗 [Contact Us Now](/contact)"
        );
    }

    private function contactResponse(): array
    {
        return $this->reply(
            "📬 **Contact GMET:**\n\n📧 **Email:** info@gmetechnologies.com\n📞 **Mobile:** +92 344 5828712\n📞 **Office:** +92 51-6126643\n🏢 **Address:** Office #103 & 104, 1st Floor, Rawal Mall & Residencia, Rawalpindi\n🌐 **Facebook:** [GMET on Facebook](https://www.facebook.com/profile.php?id=61593893199538)\n\nYou can also send us a message directly through our [Contact page](/contact). We'd love to hear from you! 😊"
        );
    }

    private function ceoResponse(): array
    {
        return $this->reply(
            "👩‍💼 **Mrs. Abida Parveen — CEO, GMET**\n\nWith more than 15 years of experience in geospatial technology, Mrs. Abida Parveen has led transformative projects including:\n\n• Pakistan's first **Cadastral Mapping of State Lands Project**\n• Bangladesh's first **navigation system**\n• **Religious-site mapping** initiatives\n• Multiple **Web-based GIS** projects\n\n*\"The potential of geospatial technology is limited only by our imagination.\"*\n\n🔗 [Read the full CEO message](/about#ceo)"
        );
    }

    private function visionResponse(): array
    {
        return $this->reply(
            "🎯 **GMET Vision & Mission**\n\n**Vision / Philosophy:**\nTo become the trusted global partner for geospatial innovation, delivering intelligent engineering solutions that inspire progress, drive sustainability, and shape the future.\n\n**Mission:**\nTo empower organizations with precise geospatial intelligence, advanced engineering, and innovative technologies for enhanced decision-making and sustainable growth.\n\n**Core Values:** Innovation • Collaboration • Integrity • Excellence\n\n**Motto:** *Innovating Today • Engineering Tomorrow • Mapping the Future*"
        );
    }

    private function whyChooseResponse(): array
    {
        $sCount = Services::where('status', 1)->count();
        $pCount = Projects::where('status', 1)->count();

        return $this->reply(
            "🏆 **Why Choose GMET?**\n\n✅ **Client Focused Approach** — Tailored services with a client-first approach\n✅ **Timely Deliveries** — On-schedule and quality deliveries for all projects\n✅ **Modern Techniques** — Innovative GIS solutions with cutting-edge technology\n✅ **Experienced Staff** — Highly professional team for exceptional results\n✅ **15+ Years CEO Experience** — Deep domain expertise in geospatial intelligence\n✅ **End-to-End Solutions** — From surveying to AI-driven analysis\n\n📊 **Track Record:** {$sCount} services • {$pCount} completed projects\n\n🔗 [Explore our Services](/services)"
        );
    }

    private function toolsResponse(): array
    {
        return $this->reply(
            "🛠️ **Tools & Software GMET Uses:**\n\n• **Python** — Scripting & automation\n• **ArcGIS / ArcGIS Pro** — Industry-standard GIS\n• **QGIS** — Open-source GIS\n• **Google Earth Engine** — Cloud-based geospatial analysis\n• **HEC-RAS** — Hydraulic modeling\n• **MATLAB** — Advanced computation\n• **ENVI** — Remote sensing analysis\n• **ERDAS IMAGINE** — Image processing\n• **R** — Statistical computing\n• **TerraSync Professional** — GPS data collection\n\n🔗 [View our Services page](/services)"
        );
    }

    private function pricingResponse(): array
    {
        return $this->reply(
            "💰 **Pricing Information**\n\nGMET provides customized pricing based on project scope, complexity, and requirements. Each solution is tailored to deliver maximum value.\n\nTo get a personalized quote:\n\n📧 Email us at **info@gmetechnologies.com**\n📞 Call: **+92 344 5828712**\n\nOr fill out our [Contact form](/contact) with your project details, and our team will get back to you promptly!"
        );
    }

    private function fallbackResponse(): array
    {
        // Pull dynamic counts for the fallback
        $sCount = Services::where('status', 1)->count();
        $pCount = Projects::where('status', 1)->count();
        $aCount = Application::where('status', 1)->count();
        $bCount = Blog::count();

        return $this->reply(
            "Thank you for your question! 🙂\n\nI'm here to help you learn about **GMET** — our mapping solutions, services, and how we support organizations in this modern era.\n\nHere are some topics I can help with:\n• **About GMET** — What we do and our mission\n• **Services** ({$sCount} available) — Our geospatial & engineering solutions\n• **Products** ({$aCount} available) — Digital platforms and GIS tools\n• **Projects** ({$pCount} completed) — Our portfolio\n• **Blog** ({$bCount} articles) — Latest insights\n• **Team** — Meet our expert professionals\n• **Contact** — How to reach us\n• **Get Started** — How to work with GMET\n\nJust type any keyword and I'll search our website for you! 🔍"
        );
    }

    /* ================================================================
     *  UTILITIES
     * ================================================================ */

    /**
     * Check if input contains any of the given keywords.
     */
    private function matches(string $input, array $keywords): bool
    {
        foreach ($keywords as $kw) {
            if (str_contains($input, $kw)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Extract meaningful search words (removes stop words).
     */
    private function extractSearchWords(string $input): array
    {
        $stopWords = [
            'the','a','an','is','are','was','were','be','been','being','have','has','had',
            'do','does','did','will','would','shall','should','may','might','must','can',
            'could','i','me','my','we','our','you','your','he','she','it','they','them',
            'this','that','these','those','am','what','which','who','whom','how','when',
            'where','why','and','but','or','nor','not','no','so','if','then','than','too',
            'very','just','only','also','about','up','out','on','off','over','under','again',
            'once','here','there','all','each','every','both','few','more','most','some',
            'any','other','into','to','from','for','with','at','by','of','in','show','me',
            'tell','give','get','see','know','find','please','want','need','like','look',
            'can','let','help','much','many','make','thing','do','does',
        ];

        $words = preg_split('/[\s\-_,.:;!?]+/', $input);
        $words = array_filter($words, fn($w) => strlen($w) >= 2 && !in_array($w, $stopWords));

        return array_values($words);
    }

    /**
     * Calculate a simple relevance score for a text against search words.
     */
    private function relevanceScore(array $words, string $text): int
    {
        $text  = mb_strtolower($text);
        $score = 0;

        foreach ($words as $word) {
            // Exact word match scores higher
            if (str_contains($text, $word)) {
                $score += 2;
            }
            // Partial/stem match
            $stem = rtrim($word, 'seding');
            if (strlen($stem) >= 3 && str_contains($text, $stem)) {
                $score += 1;
            }
        }

        return $score;
    }

    /**
     * Build a standard JSON response array.
     */
    private function reply(string $text, array $cards = [], string $cardType = ''): array
    {
        $response = ['reply' => $text];
        if (!empty($cards)) {
            $response['cards']    = $cards;
            $response['cardType'] = $cardType;
        }
        return $response;
    }
}
