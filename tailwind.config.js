import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/**/*.php',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.25rem',
                sm: '1.5rem',
                lg: '2.5rem',
                xl: '3rem',
            },
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1200px',
                '2xl': '1320px',
            },
        },
        extend: {
            colors: {
                paper: {
                    50:  '#FBF8F3',
                    100: '#F5F0E7',
                    200: '#E9E2D3',
                },
                ink: {
                    50:  '#F4F5F7',
                    100: '#E4E7EC',
                    200: '#C7CCD4',
                    300: '#98A0AC',
                    400: '#6A7280',
                    500: '#454C57',
                    600: '#2F3540',
                    700: '#1E232C',
                    800: '#141822',
                    900: '#0B0E15',
                },
                brand: {
                    50:  '#EEF3FA',
                    100: '#D5E2F3',
                    200: '#AFC8E6',
                    300: '#7EA8D4',
                    400: '#4E85C1',
                    500: '#2F65AF',
                    600: '#255394',
                    700: '#1C4074',
                    800: '#142D54',
                    900: '#0C1C36',
                },
                navy: {
                    50:  '#EEF2F8',
                    100: '#D6DEEC',
                    200: '#A7B7D2',
                    300: '#7891B7',
                    400: '#4E6E9B',
                    500: '#2E507E',
                    600: '#1F3D66',
                    700: '#152B4A',
                    800: '#0E1E36',
                    900: '#081324',
                },
            },
            fontFamily: {
                // Gravity Regular — texte courant (charte)
                sans: ['Gravity', 'system-ui', 'Segoe UI', 'sans-serif'],
                // Melior Regular — titres ; Source Serif 4 en webfont (Melior est propriétaire)
                display: ['Melior', '"Source Serif 4"', 'Georgia', 'serif'],
                // Times New Roman — exclusivement le nom BSM-SERVICES
                brand: ['"Times New Roman"', 'Times', 'Georgia', 'serif'],
            },
            fontSize: {
                'display-2xl': ['clamp(2.75rem, 5vw + 1rem, 5rem)',   { lineHeight: '1.08', letterSpacing: '-0.01em', fontWeight: '400' }],
                'display-xl':  ['clamp(2.25rem, 3.5vw + 1rem, 3.75rem)', { lineHeight: '1.12', letterSpacing: '-0.008em', fontWeight: '400' }],
                'display-lg':  ['clamp(1.75rem, 2vw + 1rem, 2.5rem)', { lineHeight: '1.18', letterSpacing: '-0.005em', fontWeight: '400' }],
                'eyebrow':     ['0.75rem', { lineHeight: '1', letterSpacing: '0.16em', fontWeight: '400' }],
            },
            borderRadius: {
                xl: '14px',
                '2xl': '20px',
            },
            spacing: {
                18: '4.5rem',
                22: '5.5rem',
                30: '7.5rem',
            },
            boxShadow: {
                soft:  '0 2px 6px rgba(11,14,21,0.05), 0 10px 28px -8px rgba(11,14,21,0.12)',
                lift:  '0 10px 30px -12px rgba(11,14,21,0.20)',
                brand: '0 12px 30px -12px rgba(47,101,175,0.45)',
            },
            transitionTimingFunction: {
                'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
        },
    },
    plugins: [forms, typography],
};
