@props([
    'href' => 'https://api.whatsapp.com/send?phone=923070222666&text='.rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.'),
    'label' => 'BOOK AN APPOINTMENT',
])

@once
    <style>
        .book-appointment-btn {
            display: inline-block !important;
            width: auto !important;
            min-width: 0 !important;
            max-width: none !important;
            height: auto !important;
            padding: 0.625rem 2rem !important;
            border: 1px solid #000 !important;
            border-radius: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
            color: #111 !important;
            font-family: "Poppins", sans-serif !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            line-height: normal !important;
            letter-spacing: 1px !important;
            text-align: center !important;
            text-transform: uppercase !important;
            text-decoration: none !important;
            cursor: pointer !important;
            transition: background-color 0.2s ease, color 0.2s ease !important;
        }

        .book-appointment-btn:hover,
        .book-appointment-btn:focus {
            border-color: #000 !important;
            background-color: #000 !important;
            color: #fff !important;
            text-decoration: none !important;
        }
    </style>
@endonce

<a href="{{ $href }}" {{ $attributes->class(['book-appointment-btn']) }}>
    @if ($slot->isEmpty())
        {{ $label }}
    @else
        {{ $slot }}
    @endif
</a>
