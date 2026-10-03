@php
    $logos = [
        'AXI_Systems_600dpi.png'                  => 'AXI Systems',
        'FWO_Frontier_Work_Organization_600dpi.png' => 'Frontier Work Organization (FWO)',
        'LIMS_Center_of_Excellence_600dpi.png'    => 'LIMS Center of Excellence',
        'Nubia_Mining_600dpi.png'                 => 'Nubia Mining',
        'ONE_Network_600dpi.png'                  => 'ONE Network',
        'Punjab_Irrigation_Department_600dpi.png' => 'Punjab Irrigation Department',
        'Quantum_Ronics_600dpi.png'               => 'Quantum Ronics',
    ];
@endphp

<section class="section section-tint logo-carousel-section">
    <div class="container">
        <div class="section-heading text-center">
            <span class="eyebrow">Our Clients &amp; Partners</span>
            <h2>Trusted By Leading Organizations</h2>
        </div>

        <div class="logo-marquee">
            <div class="logo-track">
                @foreach ([false, true] as $isCopy)
                    <div class="logo-group" @if ($isCopy) aria-hidden="true" @endif>
                        @foreach ($logos as $file => $name)
                            <div class="logo-item">
                              <img src="{{ asset('assets/images/clients/' . $file) }}"
                                   alt="{{ $name }}"
                                   class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>