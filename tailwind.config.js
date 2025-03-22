/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/landing/**/*.blade.php",
        "./resources/views/components/**/*.blade.php",
        "./resources/views/livewire/**/*.blade.php",
    ],
    prefix: "tw-",
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#7367f0",
                    50: "#f3f2ff",
                    100: "#e9e7ff",
                    200: "#d4d0fe",
                    300: "#b6affc",
                    400: "#9a8ff8",
                    500: "#7367f0",
                    600: "#6753e7",
                    700: "#5641cc",
                    800: "#4735a6",
                    900: "#3c2f85",
                    950: "#241a57",
                },
            },
            // fontFamily: {
            //     sans: ["Inter var", "sans-serif"],
            // },
            animation: {
                carousel: "carousel 15s linear infinite",
                carouselPrice: "carouselPrice 20s linear infinite",
                "pulse-glow": "pulse-glow 3s ease-in-out infinite",
                float: "float 4s ease-in-out infinite",
            },
            keyframes: {
                carousel: {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(-50%)" },
                },
                carouselPrice: {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(-200%)" },
                },

                "pulse-glow": {
                    "0%, 100%": { opacity: "1", transform: "scale(1)" },
                    "50%": { opacity: "0.85", transform: "scale(1.05)" },
                },
                float: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-10px)" },
                },
            },
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
                grid: "linear-gradient(to right, rgba(115, 103, 240, 0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(115, 103, 240, 0.1) 1px, transparent 1px)",
            },
            boxShadow: {
                "glow-primary": "0 0 20px -5px rgba(115, 103, 240, 0.5)",
                "glow-primary-lg": "0 0 30px -5px rgba(115, 103, 240, 0.7)",
            },
        },
    },
};
