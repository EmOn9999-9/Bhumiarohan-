<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the initial content. Runs only on an empty database, so it is safe to run on
     * every deploy without overwriting changes made in the admin panel.
     */
    public function run(): void
    {
        if (User::exists()) {
            $this->command?->info('Database already has data, skipping seed.');

            return;
        }

        $password = config('company.admin.password');
        if (blank($password)) {
            throw new \RuntimeException('Set ADMIN_PASSWORD in the environment before seeding.');
        }

        User::create([
            'name' => 'Administrator',
            'email' => config('company.admin.email'),
            'password' => $password,
        ]);

        $founder = config('company.founder');
        TeamMember::create([
            'name' => config('company.owner'),
            'role' => $founder['role'],
            'qualification' => $founder['qualification'],
            'bio' => $founder['bio'],
            'quote' => $founder['quote'],
            'sort_order' => 1,
            'is_active' => true,
            'is_founder' => true,
        ]);

        foreach ($this->services() as $i => $service) {
            Service::create($service + [
                'slug' => Str::slug($service['title']),
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function services(): array
    {
        return [
            [
                'title' => 'Building Construction',
                'icon' => 'building',
                'short_description' => 'Residential, commercial and institutional buildings built to code, on schedule and within budget.',
                'description' => "From the foundation to the finishing touches, we deliver complete building construction for homes, apartments, offices and commercial spaces. Every project is planned by qualified engineers, executed by skilled crews and supervised on site to make sure it complies with the National Building Code of Nepal (NBC) and local municipal bylaws.\n\nWe keep clients informed at every stage with transparent costing, clear timelines and regular progress updates.",
                'features' => [
                    'Residential houses & apartments',
                    'Commercial & office buildings',
                    'Earthquake-resistant construction (NBC compliant)',
                    'Turnkey and labour-contract options',
                    'On-site engineering supervision',
                    'Quality material sourcing',
                ],
            ],
            [
                'title' => 'Design & Consulting',
                'icon' => 'cube',
                'short_description' => 'Architectural and structural design, estimation and engineering consultancy you can rely on.',
                'description' => "Good buildings start with good design. Our architects and engineers prepare functional, aesthetic and structurally sound designs, together with the drawings and documents you need for municipal approval.\n\nWe also provide cost estimation, bills of quantities and independent construction supervision, so you can make informed decisions before and during construction.",
                'features' => [
                    'Architectural planning & 3D visualisation',
                    'Structural analysis & design',
                    'Municipal drawing / naksa pass support',
                    'Cost estimation & BOQ preparation',
                    'Construction supervision',
                    'Technical audits & consultancy',
                ],
            ],
            [
                'title' => 'Interior Work & Design',
                'icon' => 'brush',
                'short_description' => 'Thoughtful interiors for homes, offices and commercial spaces, from concept to installation.',
                'description' => "We design and build interiors that are practical, comfortable and reflect your style. Our team handles space planning, material and colour selection, furniture, lighting, false ceilings and finishing work.\n\nWhether it is a single room or a complete office fit-out, we manage the whole process so you get a finished space without the hassle.",
                'features' => [
                    'Residential & office interiors',
                    'Modular kitchens & wardrobes',
                    'False ceilings & lighting design',
                    'Flooring, wall finishes & painting',
                    'Custom furniture',
                    'Turnkey fit-outs',
                ],
            ],
            [
                'title' => 'Renovation',
                'icon' => 'wrench',
                'short_description' => 'Upgrade, repair and remodel existing buildings with minimal disruption.',
                'description' => "We breathe new life into existing buildings. From small repairs to full remodelling, our engineers assess the existing structure first and then plan safe, cost-effective improvements.\n\nWe also carry out structural retrofitting to strengthen older buildings against earthquakes.",
                'features' => [
                    'Home & office remodelling',
                    'Structural repair & retrofitting',
                    'Waterproofing & damp-proofing',
                    'Bathroom & kitchen upgrades',
                    'Extensions & additional floors',
                    'Facade improvements',
                ],
            ],
            [
                'title' => 'Real Estate',
                'icon' => 'home',
                'short_description' => 'Land and property solutions with honest guidance and engineering insight.',
                'description' => "Buying land or property is a major decision. We help clients find, evaluate and develop properties, and our engineers check the technical side: land suitability, access, legal setbacks and construction potential.\n\nWe also develop and sell residential properties built to our own construction standards.",
                'features' => [
                    'Land & property buying assistance',
                    'Site suitability assessment',
                    'Property development',
                    'Valuation support',
                    'Plotting & land development',
                    'Documentation guidance',
                ],
            ],
            [
                'title' => 'Engineering Resources Supply',
                'icon' => 'truck',
                'short_description' => 'Reliable supply of construction materials, equipment and skilled manpower.',
                'description' => "We supply quality construction materials, tools and equipment from trusted manufacturers, along with skilled technical manpower for your projects.\n\nOur engineering background means we can recommend the right material for the job, which saves you money and avoids costly mistakes.",
                'features' => [
                    'Cement, steel & aggregates',
                    'Construction equipment & tools',
                    'Surveying & lab instruments',
                    'Skilled & technical manpower',
                    'Timely delivery across the region',
                    'Material quality certification',
                ],
            ],
            [
                'title' => 'Survey & Lab Testing',
                'icon' => 'beaker',
                'short_description' => 'Accurate land surveys and material testing for safe, informed construction.',
                'description' => "Accurate data is the base of every successful project. We carry out topographic and land surveys with modern instruments, and test soils and construction materials to make sure they meet the required standards.\n\nOur reports are clear and practical, and they are prepared for engineers, contractors and owners alike.",
                'features' => [
                    'Topographic & land surveys',
                    'Total station & GPS surveys',
                    'Soil investigation & SPT',
                    'Concrete, brick & aggregate testing',
                    'Steel & material quality testing',
                    'Detailed technical reports',
                ],
            ],
            [
                'title' => 'Infrastructure / Civil Works',
                'icon' => 'map',
                'short_description' => 'Roads, bridges, water supply, irrigation and other public infrastructure.',
                'description' => "We take on civil and infrastructure works for government bodies, local governments and private clients. Our team handles planning, design and execution for roads, culverts, retaining structures, water supply and irrigation systems.\n\nWe focus on durability, safety and community benefit in every project.",
                'features' => [
                    'Road & pavement construction',
                    'Bridges, culverts & retaining walls',
                    'Water supply & sanitation',
                    'Irrigation & river training works',
                    'Drainage & sewerage',
                    'DPR & feasibility studies',
                ],
            ],
        ];
    }
}
