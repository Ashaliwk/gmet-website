<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\backend\Services;
use App\Models\backend\Team;
use App\Models\backend\Projects;
use App\Models\backend\Partners;

class GmetSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SERVICES
        Services::truncate();
        $services = [
            [
                'title' => 'GIS & Geospatial Solutions',
                'description' => 'GIS mapping, digital cartography, spatial analysis, geodatabase development, geoprocessing, spatial data management, and 3D visualization.',
                'icon' => '✦',
                'category' => 'GIS',
                'order' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Geology & Mineral Exploration',
                'description' => 'Geological mapping and mineral exploration supporting resource identification, terrain assessment, and exploration planning using geological data, RS & GIS, and spatial analysis.',
                'icon' => '✦',
                'category' => 'Geology',
                'order' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Surveying & Geomatics',
                'description' => 'Topographic, cadastral, engineering, geodetic, GNSS/RTK, Theodolite, Chain, and Total Station surveys for accurate spatial measurement and terrain representation.',
                'icon' => '✦',
                'category' => 'Surveying',
                'order' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Remote Sensing & Satellite Solutions',
                'description' => 'Multispectral, hyperspectral, and radar analytics for LULC mapping, environmental monitoring, agriculture, assessment, change detection, image classification, spatial modeling, and vegetation analysis.',
                'icon' => '✦',
                'category' => 'Remote Sensing',
                'order' => 4,
                'status' => 1,
            ],
            [
                'title' => 'Drone & Photogrammetry',
                'description' => 'High-precision aerial mapping and photogrammetry for terrain visualization, surveying, 3D and elevation modeling, volumetric analysis, topographic mapping, infrastructure planning, and site monitoring.',
                'icon' => '✦',
                'category' => 'UAV & Drone',
                'order' => 5,
                'status' => 1,
            ],
            [
                'title' => 'Hydrology & Water Resources',
                'description' => 'Hydrological analysis for water systems and watersheds, including flood analysis, groundwater assessment, hydrological modeling, and watershed management.',
                'icon' => '✦',
                'category' => 'Hydrology',
                'order' => 6,
                'status' => 1,
            ],
            [
                'title' => 'Agricultural & Environmental',
                'description' => 'Geospatial solutions for agriculture, environmental assessment, and natural-resource management, including crop and land, vegetation, soil and water, ecosystem, climate-impact analysis, precision agriculture, and land-use planning.',
                'icon' => '✦',
                'category' => 'Agriculture',
                'order' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Web GIS & Digital Solutions',
                'description' => 'Interactive web-based geospatial platforms, Web GIS development, cloud-based GIS, real-time data visualization, spatial data integration, customized mapping, and location-based decision planning.',
                'icon' => '✦',
                'category' => 'Web GIS',
                'order' => 8,
                'status' => 1,
            ],
            [
                'title' => 'Engineering & CAD Solutions',
                'description' => '2D/3D CAD drafting, engineering drawings, site development plans, utility layouts, modeling, and detailed design documentation.',
                'icon' => '✦',
                'category' => 'Engineering',
                'order' => 9,
                'status' => 1,
            ],
            [
                'title' => 'GIS Consultancy & Training',
                'description' => 'GIS planning, system design, project guidance, workflow development, technical training, and knowledge transfer across applications, industries, projects, and organizations.',
                'icon' => '✦',
                'category' => 'Consultancy',
                'order' => 10,
                'status' => 1,
            ],
            [
                'title' => 'Data & Decision Support',
                'description' => 'Spatial analytics, data visualization, suitability analysis, geospatial dashboards, modeling, and decision-support frameworks that turn complex spatial datasets into actionable intelligence.',
                'icon' => '✦',
                'category' => 'Analytics',
                'order' => 11,
                'status' => 1,
            ],
            [
                'title' => 'GeoAI Solutions',
                'description' => 'AI combined with spatial data to automate analysis, detect patterns, and generate predictive insights, including image classification, object detection, change detection, predictive spatial analytics, and automated feature extraction.',
                'icon' => '✦',
                'category' => 'AI & ML',
                'order' => 12,
                'status' => 1,
            ],
            [
                'title' => 'Disaster Risk & Hazard Mapping',
                'description' => 'Risk-informed spatial modeling for flood and drought mapping, landslide assessment, seismic risk analysis, vulnerability mapping, hazard zonation, and disaster preparedness.',
                'icon' => '✦',
                'category' => 'Disaster Risk',
                'order' => 13,
                'status' => 1,
            ],
            [
                'title' => 'Land & Urban Development',
                'description' => 'Geospatial solutions for sustainable land management and urban planning, including LULC, cadastral mapping, urban growth planning, land allocation, and management of changing landscapes.',
                'icon' => '✦',
                'category' => 'Urban Planning',
                'order' => 14,
                'status' => 1,
            ],
            [
                'title' => 'Digital Infrastructure Solutions',
                'description' => 'Network design and management, cloud solutions, data management, cybersecurity, IT support, backup and recovery, and infrastructure optimization for secure and continuous digital operations.',
                'icon' => '✦',
                'category' => 'IT Infrastructure',
                'order' => 15,
                'status' => 1,
            ],
        ];

        foreach ($services as $srv) {
            Services::create($srv);
        }

        // 2. TEAMS
        Team::truncate();
        $teamMembers = [
            [
                'fullname' => 'Dr. Muhammad Farhan',
                'email' => 'farhan@gmetechnologies.com',
                'designation' => 'Consultant',
                'intro' => 'Dr. Muhammad Farhan holds a Ph.D. in Geodesy and Surveying Engineering with 12+ years of experience in Remote Sensing, GIS, and Machine Learning. He has 25+ research publications and extensive experience in AI-based geospatial modeling, specializing in drought, flood, and climate impact assessment. He is proficient in Google Earth Engine, ArcGIS, and QGIS, with experience in internationally funded research projects across Pakistan and China.',
                'image' => 'dr-muhammad-farhan.png',
                'order' => 1,
                'status' => 1,
            ],
            [
                'fullname' => 'Dr. Mujtaba Ali',
                'email' => 'mujtaba@gmetechnologies.com',
                'designation' => 'Manager',
                'intro' => 'Dr. Mujtaba Ali is an experienced Manager with a strong background in Remote Sensing, GIS, AI, and geospatial technologies. He is skilled in technical project management, team coordination, and geospatial solutions. Proficient in ArcGIS, ArcGIS Pro, QGIS, Google Earth Engine, HEC-RAS, Python, and MATLAB, he combines technical expertise with effective leadership and project planning.',
                'image' => 'dr-mujtaba-ali.png',
                'order' => 2,
                'status' => 1,
            ],
            [
                'fullname' => 'Ms. Ayesha Zubair',
                'email' => 'ayesha.z@gmetechnologies.com',
                'designation' => 'HR & Compliance Officer',
                'intro' => 'Ms. Ayesha Zubair is an HR professional with expertise in talent management, employee relations, and organizational development. She contributes to precision agriculture initiatives through team coordination, workforce management, and support for technology-driven agricultural projects. Her role combines people management, employee development, project collaboration, and organizational growth.',
                'image' => 'ayesha-zubair.png',
                'order' => 3,
                'status' => 1,
            ],
            [
                'fullname' => 'Dr. Qurat Ul Ain',
                'email' => 'qurat@gmetechnologies.com',
                'designation' => 'Spatial Analysis Specialist',
                'intro' => 'Dr. Qurat Ul Ain is a Spatial Analysis Specialist & GIS Researcher with expertise in spatial data analysis, geospatial modeling, mapping, and environmental applications. Experienced in GIS-based land use/land cover assessment, hydrological modeling, erosion mapping, water resources assessment, and climate-related spatial analysis.',
                'image' => 'qurat-ul-ain.png',
                'order' => 4,
                'status' => 1,
            ],
            [
                'fullname' => 'Ms. Arzoo Mumtaz',
                'email' => 'arzoo@gmetechnologies.com',
                'designation' => 'Remote Sensing Analyst',
                'intro' => 'Ms. Arzoo Mumtaz is a Remote Sensing Specialist with expertise in satellite image processing, LULC mapping, change detection, and flood hazard assessment. She is proficient in ArcGIS, QGIS, ENVI, ERDAS IMAGINE, and Google Earth Engine. Her research focused on urban sprawl and agricultural land transformation, with expertise in land-use change analysis.',
                'image' => 'arzoo-mumtaz.png',
                'order' => 5,
                'status' => 1,
            ],
            [
                'fullname' => 'Ms. Mahnoor Waqar',
                'email' => 'mahnoor@gmetechnologies.com',
                'designation' => 'Hydrological GIS Analyst',
                'intro' => 'Ms. Mahnoor Waqar is an experienced Hydrological GIS Analyst specializing in hydrological mapping and water resource assessment. Her expertise includes watershed delineation, flood hazard mapping, and drainage analysis. Her research focused on Water Footprinting and Evapotranspiration.',
                'image' => 'mahnoor-waqar.png',
                'order' => 6,
                'status' => 1,
            ],
            [
                'fullname' => 'Mr. Wassaf Ahmad',
                'email' => 'wassaf@gmetechnologies.com',
                'designation' => 'GIS Specialist',
                'intro' => 'Wassaf Ahmad is a GIS Specialist who has completed his M.S. in Remote Sensing & GIS from PMAS-Arid Agriculture University, Rawalpindi. He has experience in cadastral mapping, land records management, and satellite image processing. He currently serves as a Research Associate on a Pak–China joint research project.',
                'image' => 'wassaf-ahmad.png',
                'order' => 7,
                'status' => 1,
            ],
            [
                'fullname' => 'Ms. Mahrosh Babar Abbasi',
                'email' => 'mahrosh@gmetechnologies.com',
                'designation' => 'Environmentalist',
                'intro' => 'Mahrosh Babar Abbasi is an Environmentalist currently pursuing an MS in RS & GIS at PMAS-Arid Agriculture University, Rawalpindi. She has expertise in environmental analysis, geospatial data analysis, web-based mapping, and satellite data visualization. Skilled in ArcGIS, Google Earth Engine, and Python.',
                'image' => 'mahrosh-babar-abbasi.png',
                'order' => 8,
                'status' => 1,
            ],
            [
                'fullname' => 'Mr. Jaffar Waqas',
                'email' => 'jaffar@gmetechnologies.com',
                'designation' => 'Web GIS Developer',
                'intro' => 'Mr. Jaffar Waqas is a Web GIS Developer with expertise in interactive web-based mapping applications and geospatial solutions. He is skilled in WebGIS development, geospatial data visualization, satellite image analysis, LULC mapping, and spatial data management using Google Earth Engine, ArcGIS, QGIS, Python, and R.',
                'image' => 'jaffar-waqas.png',
                'order' => 9,
                'status' => 1,
            ],
            [
                'fullname' => 'Ms. Ayesha Tanzeem',
                'email' => 'ayesha.t@gmetechnologies.com',
                'designation' => 'Jr. GIS Officer',
                'intro' => 'Ayesha Tanzeem has 2 years of experience in handling spatial data, satellite imagery, and mapping projects. She is skilled in creating and managing geodatabases, preparing thematic maps, and analyzing land use and natural resources.',
                'image' => 'ayesha-tanzeem.png',
                'order' => 10,
                'status' => 1,
            ],
            [
                'fullname' => 'Mr. Muhammad Ubaid',
                'email' => 'ubaid@gmetechnologies.com',
                'designation' => 'Jr. Remote Sensing Analyst',
                'intro' => 'Mr. Muhammad Ubaid is a Junior Remote Sensing Analyst skilled in satellite image processing, spatial data analysis, and geographic information systems.',
                'image' => 'muhammad-ubaid.png',
                'order' => 11,
                'status' => 1,
            ],
        ];

        foreach ($teamMembers as $tm) {
            Team::create($tm);
        }

        // 3. PROJECTS
        Projects::truncate();
        $projects = [
            [
                'client' => 'Nubia Mining (Private) Limited',
                'title' => 'Satellite-Based Identification of Minerals in the Sakhakot Area Using Satellite Imagery',
                'details' => 'Satellite-Based Identification of Minerals in the Sakhakot Area Using Satellite Imagery. Hyperspectral data acquisition & processing; spectral analysis.',
                'document' => 'Certificate — Nubia Mining',
                'timeline' => 'Completion certificate',
                'key_terms' => 'Hyperspectral data acquisition & processing; spectral analysis.',
                'category' => 'Mineral Exploration',
                'technology' => 'Hyperspectral Imagery, Satellite RS',
                'link' => '#',
                'image' => 'page-19.jpg',
                'is_featured' => 1,
                'order' => 1,
                'status' => 1,
            ],
            [
                'client' => 'One Network Pvt Ltd',
                'title' => 'Satellite Imagery Stereo Acquisition (600 sq. km, 2m)',
                'details' => 'Stereo satellite imagery acquisition covering 600 sq. km at 2m resolution with orthorectification and DEM/DSM/DTM at 5m.',
                'document' => 'PO GM-LOC-PO-743',
                'timeline' => '16-01-2026; 60–75 days after PO issuance',
                'key_terms' => '30% advance payment; orthorectification; DEM/DSM/DTM at 5m.',
                'category' => 'Satellite Solutions',
                'technology' => 'Stereo Satellite Imagery, Photogrammetry',
                'link' => '#',
                'image' => 'page-20.jpg',
                'is_featured' => 1,
                'order' => 2,
                'status' => 1,
            ],
            [
                'client' => 'One Network Pvt Ltd',
                'title' => 'Satellite Imagery Stereo Acquisition (600 sq. km, 2m)',
                'details' => 'Stereo satellite imagery acquisition covering 600 sq. km under PO GM-LOC-PO-744 with orthorectification and DEM generation.',
                'document' => 'PO GM-LOC-PO-744',
                'timeline' => '16-01-2026; 60–75 days after PO issuance',
                'key_terms' => '30% advance payment; orthorectification; DEM/DSM/DTM at 5m.',
                'category' => 'Satellite Solutions',
                'technology' => 'Stereo Satellite Imagery, Orthorectification',
                'link' => '#',
                'image' => 'page-21.jpg',
                'is_featured' => 0,
                'order' => 3,
                'status' => 1,
            ],
            [
                'client' => 'M/S LIMS Pvt. Ltd. (Party A)',
                'title' => 'Hill Torrent Digital Survey of Koh-E-Suleman Range, Dera Ghazi Khan',
                'details' => 'Hill Torrent Digital Survey of Koh-E-Suleman Range with web-based GIS dashboard, geospatial layers, and customizable analysis.',
                'document' => 'Service Agreement — LIMS',
                'timeline' => 'Oct 22, 2025; 90 days (3 months) from work order date',
                'key_terms' => 'Web-based GIS dashboard; geospatial layers; customizable spatial analytics.',
                'category' => 'GIS & Surveying',
                'technology' => 'Web GIS, Hydrological Survey, GeoAI',
                'link' => '#',
                'image' => 'page-22.jpg',
                'is_featured' => 1,
                'order' => 4,
                'status' => 1,
            ],
        ];

        foreach ($projects as $proj) {
            Projects::create($proj);
        }

        // 4. PARTNERS
        Partners::truncate();
        $partners = [
            [
                'name' => 'IBI International Group Co., Ltd.',
                'type' => 'partner',
                'description' => 'Based in Suzhou, China, IBI International Group is a leading EPC and trade financing provider, delivering integrated engineering, project financing, and investment solutions across energy, water, chemicals, and industrial sectors with a strong footprint in developing markets under the Belt and Road Initiative.',
                'website' => 'https://ibi-group.com',
                'image' => null,
                'order' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Quantum Ronics',
                'type' => 'partner',
                'description' => 'Pakistan’s pioneering quantum-resilient cybersecurity company, delivering turnkey solutions that integrate quantum technologies with conventional data protection to secure critical infrastructure across defence, enterprise, and telecom sectors.',
                'website' => 'https://quantumronics.com',
                'image' => null,
                'order' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Axi Systems',
                'type' => 'partner',
                'description' => 'An Islamabad-based AI, cybersecurity, and GIS solutions provider (founded 2024), delivering AI-driven applications, data analytics, cloud computing, and custom software development to help businesses make smarter, data-driven decisions.',
                'website' => 'https://axisystems.pk',
                'image' => null,
                'order' => 3,
                'status' => 1,
            ],
        ];

        foreach ($partners as $partner) {
            Partners::create($partner);
        }
    }
}
