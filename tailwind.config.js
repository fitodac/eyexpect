const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
	mode: 'jit',
	purge: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.vue',
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ['Barlow Condensed', ...defaultTheme.fontFamily.sans],

				'montserrat' : [
					'Montserrat',
					'ui-sans-serif',
					'system-ui',
					'-apple-system',
					'BlinkMacSystemFont',
					'"Segoe UI"',
					'Roboto',
					'"Helvetica Neue"',
					'Arial',
					'"Noto Sans"',
					'sans-serif',
					'"Apple Color Emoji"',
					'"Segoe UI Emoji"',
					'"Segoe UI Symbol"',
					'"Noto Color Emoji"'
				],
			},

			colors: {
				'primary': {
					DEFAULT: '#00AAA7',
					dark: '#00908d',
				},
			},
		},
	},

	plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
