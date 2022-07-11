module.exports = {
    content: [
        './components/*.php',
        './components/**/*.php',
        './woocommerce/*.php',
        './woocommerce/**/*.php',
        './pages/**/*.php',
        './index.php',
        './footer.php',
        './header.php',
        './functions.php'
    ],
    theme: {
        colors: {
            'orange' : '#ff6600',
            'dark' : '#212121',
            'white' : '#ffffff',
            'green' : '#47c061',
            'light-gray' : '#dbdcdd',
            'gray' : '#5c5c5c',
            'dark-gray' : '#5D5D5D',
            'current' : 'currentColor'
        },
        container: {
            padding: '1rem',
            screens: {
                sm: '640px',
                md: '991px',
                lg: '1240px',
                xl: '1440px',
                '2xl': '1760px',
            }
        }
    },
    plugins: [
    ],
}