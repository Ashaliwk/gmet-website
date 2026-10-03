<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\backend\satelliteimagery;

class SatelliteImagerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only seed if empty
        if (satelliteimagery::count() === 0) {
            $projects = [
                [
                    'title'        => 'High-Resolution Stereo Satellite Imagery & 3D Terrain Model',
                    'category'     => 'Stereo & 3D DEM',
                    'resolution'   => '0.3m Ultra-HD',
                    'sensor'       => 'WorldView-3 / SuperView-1',
                    'client'       => 'Mining & Geological Exploration AOI',
                    'project_date' => '2026',
                    'order'        => 1,
                    'status'       => 1,
                    'image'        => 'uploads/satellite_imagery/sat-stereo-dem.svg',
                    'description'  => "Acquisition and photogrammetric stereo processing of high-resolution spaceborne satellite imagery covering rugged mountainous mining concessions.\n\nKey deliverables include:\n• 0.3m ground resolution orthorectified true-color surface mosaic\n• 1.0m Digital Surface Model (DSM) and 2.0m bare-earth Digital Terrain Model (DTM)\n• 0.5m interval topographic contours for pit bench layout and haul road engineering\n• Volumetric calculation and stockpile capacity assessments.",
                ],
                [
                    'title'        => 'Multispectral Agricultural Crop Health & NDVI Spectral Mapping',
                    'category'     => 'Multispectral & LULC',
                    'resolution'   => '0.5m Pleiades Neo / 10m Sentinel-2',
                    'sensor'       => 'Pleiades Neo & Sentinel-2 Constellation',
                    'client'       => 'Agri-Tech & Water Resources Sector',
                    'project_date' => '2026',
                    'order'        => 2,
                    'status'       => 1,
                    'image'        => 'uploads/satellite_imagery/sat-multispectral-ndvi.svg',
                    'description'  => "Multi-temporal satellite earth observation program monitoring crop vigor, soil moisture anomalies, and irrigation efficiency across agricultural basins.\n\nKey deliverables include:\n• Calibrated Normalized Difference Vegetation Index (NDVI) & NDWI maps\n• Bi-weekly crop stress zoning and nitrogen uptake estimation\n• Field-level crop classification and acreage boundary delineation\n• Web GIS integration for farm managers and agronomists.",
                ],
                [
                    'title'        => 'Urban Sprawl & Infrastructure Expansion Change Detection',
                    'category'     => 'Change Detection',
                    'resolution'   => '0.5m Optical + SAR',
                    'sensor'       => 'KOMPSAT-3A & Sentinel-1 SAR',
                    'client'       => 'Metropolitan Development Authority',
                    'project_date' => '2025 - 2026',
                    'order'        => 3,
                    'status'       => 1,
                    'image'        => 'uploads/satellite_imagery/sat-change-detection.svg',
                    'description'  => "Temporal satellite change analysis tracking urban expansion, road network additions, and informal settlement dynamics over a 5-year observation baseline.\n\nKey deliverables include:\n• AI-assisted building footprint extraction and change vector analysis\n• Land Use / Land Cover (LULC) transition matrices (impervious vs pervious surfaces)\n• Road alignment compliance and right-of-way encroachment verification\n• High-resolution interactive geospatial change detection dashboards.",
                ],
                [
                    'title'        => 'Synthetic Aperture Radar (SAR) Ground Subsidence & Slope Monitoring',
                    'category'     => 'SAR & Radar',
                    'resolution'   => '1.0m StripMap',
                    'sensor'       => 'TerraSAR-X / PAZ Constellation',
                    'client'       => 'Highway & Tunnel Infrastructure Division',
                    'project_date' => '2026',
                    'order'        => 4,
                    'status'       => 1,
                    'image'        => 'uploads/satellite_imagery/sat-sar-insar.svg',
                    'description'  => "Persistent Scatterer Interferometry (PS-InSAR) utilizing radar satellite constellations to measure millimeter-scale ground displacement along civil transport corridors.\n\nKey deliverables include:\n• Time-series displacement velocity mapping (+/- 1.5mm/year accuracy)\n• Unstable slope and landslide hazard zone classification\n• Embankment settling rate tracking along newly constructed highway sectors\n• Early-warning geospatial risk reports for geotechnical engineering teams.",
                ],
            ];

            foreach ($projects as $proj) {
                satelliteimagery::create($proj);
            }
        }
    }
}
