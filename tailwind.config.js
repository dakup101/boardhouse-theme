module.exports = {
    content: [
        './components/*.php',
        './components/**/*.php',
        './woocommerce/*.php',
        './woocommerce/**/*.php',
        './pages/**/*.php',
        './index.php',
        './footer.php',
        './header.php'
    ],
    theme: {
        colors: {
            'orange' : '#ff6600',
            'dark' : '#333333',
            'white' : '#ffffff',
            'green' : '#47c061',
            'light-gray' : '#dbdcdd',
            'gray' : '#5c5c5c',
            'current' : 'currentColor'
        },
        container: {
            padding: '1rem',
            screens: {
                sm: '640px',
                md: '991px',
                lg: '1240px',
                xl: '1440px',
                '2xl': '1740px',
            }
        }
    },
    plugins: [
    ],
}