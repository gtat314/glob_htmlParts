<?php




/**
 * @global int ENABLE_DEV
 */
class glob_htmlParts {

    /**
     * @var string
     */
    public $webpageName;

    /**
     * @var string
     */
    public $webpageUrl;

    /**
     * @var string
     */
    public $webpageDescription;

    /**
     * @var string|null
     */
    public $webpageImage = null;

    /**
     * @var string
     */
    public $organizationLogo;

    /**
     * @var string
     */
    public $organizationEmail;

    /**
     * @var string
     */
    public $organizationTelephone;

    /**
     * @var string
     */
    public $thingDescription;

    /**
     * @var array
     */
    public $thingSameAs = [];

    /**
     * @var string
     */
    public $postalAddressStreetAddress;

    /**
     * @var string
     */
    public $postalAddressAddressLocality;

    /**
     * @var string
     */
    public $postalAddressPostalCode;




    /**
     * @global  string  APP_NAME
     * @global  string  DOMAIN_WEBSITE
     * @param   array   $options
     * @param   string  $pageName
     * @return  string
     */
    private function _createOgMetaTags( $options, $pageName ) {

        $html = '';

        if ( isset( $options[ 'ogLocale' ] ) ) {

            $html .= "\t" . '<meta property="og:locale" content="' . $options[ 'ogLocale' ] . '" />' . "\n";

        } else {

            $html .= "\t" . '<meta property="og:locale" content="el_GR" />' . "\n";

        }

        if ( isset( $options[ 'ogType' ] ) ) {

            $html .= "\t" . '<meta property="og:type" content="' . $options[ 'ogType' ] . '" />' . "\n";

        } else {

            $html .= "\t" . '<meta property="og:type" content="website">' . "\n";

        }

        if ( isset( $options[ 'priceAmount' ] ) ) {

            if ( $options[ 'priceAmount' ] !== null ) {

                $html .= "\t" . '<meta property="product:price:amount" content="' . $options[ 'priceAmount' ] . '">' . "\n";

            }

        }

        if ( isset( $options[ 'priceCurrency' ] ) ) {

            $html .= "\t" . '<meta property="product:price:currency" content="' . $options[ 'priceCurrency' ] . '">' . "\n";

        }

        if ( $this->webpageUrl !== null ) {

            $html .= "\t" . '<meta property="og:url" content="' . $this->webpageUrl . '">' . "\n";

        }

        $html .= "\t" . '<meta property="og:site_name" content="' . APP_NAME . '" />' . "\n";
        $html .= "\t" . '<meta property="og:title" content="' . $pageName . '">' . "\n";

        if ( $this->webpageDescription !== null ) {

            $html .= "\t" . '<meta property="og:description" content="' . $this->webpageDescription . '">' . "\n";

        }

        if ( $this->webpageImage !== null ) {

            $html .= "\t" . '<meta property="og:image" content="' . $this->webpageImage . '" />' . "\n";
            $html .= "\t" . '<meta property="og:image:secure_url" content="' . $this->webpageImage . '" />' . "\n";

        } else {

            $html .= "\t" . '<meta property="og:image" content="https://' . DOMAIN_WEBSITE . '/assets/socialCover.png" />' . "\n";
            $html .= "\t" . '<meta property="og:image:secure_url" content="https://' . DOMAIN_WEBSITE . '/assets/socialCover.png" />' . "\n";

        }

        $html .= "\t" . '<meta property="og:image:width" content="1200" />' . "\n";
        $html .= "\t" . '<meta property="og:image:height" content="630" />' . "\n";

        return $html;

    }

    /**
     * @global  string  DOMAIN_WEBSITE
     * @param   array   $options
     * @param   string  $pageName
     * @return  string
     */
    private function _createTwitterMetaTags( $options, $pageName ) {

        $html = '';
        $html .= "\t" . '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        $html .= "\t" . '<meta name="twitter:title" content="' . $pageName . '" />' . "\n";

        if ( $this->webpageDescription !== null ) {

            $html .= "\t" . '<meta name="twitter:description" content="' . $this->webpageDescription . '" />' . "\n";

        }

        if ( $this->webpageImage !== null ) {

            $html .= "\t" . '<meta name="twitter:image" content="' . $this->webpageImage . '" />' . "\n";

        } else {

            $html .= "\t" . '<meta name="twitter:image" content="https://' . DOMAIN_WEBSITE . '/assets/socialCover.png" />' . "\n";

        }

        if ( isset( $options[ 'priceAmount' ] ) ) {

            if ( $options[ 'priceAmount' ] !== null ) {

                $html .= "\t" . '<meta name="twitter:data1" content="€' . $options[ 'priceAmount' ] . '">' . "\n";
                $html .= "\t" . '<meta name="twitter:label1" content="Price">' . "\n";

            }

        }

        return $html;

    }




    /**
     * @return glob_htmlParts
     */
    public function __construct() {}

    /**
     * @global int      ENABLE_DEV
     * @param array     $options
     * @param boolean   $options[ disableMainCss ]  optional, eg: true
     * @param string    $options[ charset ]         optional, eg: 'UTF-8'
     * @param boolean   $options[ enableModules ]   optional, eg: true
     * @param string    $options[ googleFonts ]     optional, eg: 'https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Noto+Serif+Display:wght@100..900&family=Poiret+One&family=Roboto+Condensed:wght@100..900&family=Roboto:wght@100;300;400;700&display=swap'
     * @param string    $options[ robots ]          optional, eg: 'max-image-preview:large'
     * @param string    $options[ viewport ]        optional, eg: 'width=device-width, initial-scale=1'
     * @param boolean   $options[ xfn ]             optional, eg: true
     * @param string    $options[ ogLocale ]        optional, eg: 'en_US'
     * @param string    $options[ ogType ]          optional, eg: 'website'
     * @param float     $options[ priceAmount ]     optional, eg: 25.99
     * @param string    $options[ priceCurrency ]   optional, eg: 'EUR'
     * @param string    $options[ webfonts ]        optional, eg: '/js/webfonts.js'
     * @return void
     */
    public function createHeader( array $options ) {

        $html       = '';
        $pageName   = '';

        if ( $this->webpageName !== null ) {

            $pageName = $this->webpageName;

        }

        if ( defined( 'APP_NAME' ) ) {

            $pageName = $pageName . ' - ' . APP_NAME;

        }




        if ( isset( $options[ 'charset' ] ) ) {

            $html .= '<meta charset="' . $options[ 'charset' ] . '">' . "\n";

        } else {

            $html .= '<meta charset="UTF-8">' . "\n";

        }

        if ( isset( $options[ 'xfn' ] ) === true && $options[ 'xfn' ] === true ) {

            $html .= '<link rel="profile" href="http://gmpg.org/xfn/11">' . "\n";

        }

        if ( isset( $options[ 'viewport' ] ) ) {

            $html .= "\t" . '<meta name="viewport" content="' . $options[ 'viewport' ] . '">' . "\n";

        } else {

            $html .= "\t" . '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";

        }

        if ( isset( $options[ 'webfonts' ] ) ) {

            $html .= "\t" . '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
            $html .= "\t" . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
            $html .= "\t" . '<script type="text/javascript" src="' . $options[ 'webfonts' ] . '" async></script>' . "\n";

        }

        if ( isset( $options[ 'googleFonts' ] ) ) {

            $html .= "\t" . '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
            $html .= "\t" . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
            $html .= "\t" . '<link rel="preload" href="' . $options[ 'googleFonts' ] . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
            $html .= "\t" . '<noscript>' . "\n";
            $html .= "\t\t" . '<link href="' . $options[ 'googleFonts' ] . '" rel="stylesheet">' . "\n";
            $html .= "\t" . '</noscript>' . "\n";

        }

        if ( isset( $options[ 'robots' ] ) ) {

            $html .= "\t" . '<meta name="robots" content="' . $options[ 'robots' ] . '">' . "\n";

        }

        if ( $this->webpageUrl !== null ) {

            $html .= "\t" . '<link rel="canonical" href="' . $this->webpageUrl . '">' . "\n";

        }

        $html .= "\t" . '<title>' . $pageName . '</title>' . "\n";

        if ( $this->webpageDescription !== null ) {

            $html .= "\t" . '<meta name="description" content="' . $this->webpageDescription . '">' . "\n";

        }

        $html .= $this->_createOgMetaTags( $options, $pageName );
        $html .= $this->_createTwitterMetaTags( $options, $pageName );

        if ( isset( $options[ 'enableModules' ] ) ) {

            if ( ENABLE_DEV === 1 ) {

                $modulesPath    = $_SERVER[ 'DOCUMENT_ROOT' ] . '/modules';
                $moduleFolders  = glob( $modulesPath . '/*', GLOB_ONLYDIR );
    
                foreach ($moduleFolders as $moduleFolder) {
    
                    $moduleName = basename( $moduleFolder );

                    $cssFileRelativePath    = '/modules/' . $moduleName . '/css/main.css';
                    $cssLastModifiedTime    = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . $cssFileRelativePath );
                    $cssVersion             = date( 'YmdHis', $cssLastModifiedTime );
                    $cssHref                = '/modules/' . $moduleName . '/css/main.css?v=' . $cssVersion;

                    $jsFileRelativePath     = '/modules/' . $moduleName . '/js/main.js';
                    $jsLastModifiedTime     = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . $jsFileRelativePath );
                    $jsVersion              = date( 'YmdHis', $jsLastModifiedTime );
                    $jsHref                 = '/modules/' . $moduleName . '/js/main.js?v=' . $jsVersion;
    
                    $html .= "\t<link rel='stylesheet' href='" . $cssHref . "'>\n";
                    $html .= "\t<script type='text/javascript' src='" . $jsHref . "' defer></script>\n";
    
                }
    
            }

        }

        if ( isset( $options[ 'disableMainCss' ] ) === false || $options[ 'disableMainCss' ] !== true ) {

            $cssLastModifiedTime    = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . '/css/main.css' );
            $cssVersion             = date( 'YmdHis', $cssLastModifiedTime );
            $cssHref                = '/css/main.css?v=' . $cssVersion;

            $html .= "\t<link rel='stylesheet' href='" . $cssHref . "'>\n";

        }

        $jsLastModifiedTime     = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . '/js/library.js' );
        $jsVersion              = date( 'YmdHis', $jsLastModifiedTime );
        $jsHref                 = '/js/library.js?v=' . $jsVersion;

        $html .= "\t<script type='text/javascript' src='" . $jsHref . "' defer></script>\n";

        echo $html;

    }

    /**
     * @return void
     */
    public function createCssLinkTag( $fileRelativePath ) {

        $cssLastModifiedTime    = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . $fileRelativePath );
        $cssVersion             = date( 'YmdHis', $cssLastModifiedTime );
        $cssHref                = $fileRelativePath . '?v=' . $cssVersion;

        echo "<link rel='stylesheet' href='" . $cssHref . "'>\n";

    }

    /**
     * @param string $fileRelativePath
     * @param boolean $defer optional
     * @return void
     */
    public function createJsScriptTag( $fileRelativePath, $defer = false ) {

        $jsLastModifiedTime     = filemtime( $_SERVER[ 'DOCUMENT_ROOT' ] . $fileRelativePath );
        $jsVersion              = date( 'YmdHis', $jsLastModifiedTime );
        $jsHref                 = $fileRelativePath . '?v=' . $jsVersion;

        $html = '<script type="text/javascript" src="' . $jsHref . '"';

        if ( $defer === true ) {

            $html .= " defer";

        }

        $html .= "></script>";

        echo $html;

    }

    /**
     * @throws Exception
     * @return void
     */
    public function createSchemaJson( $schema ) {

        if ( is_array( $schema ) === false ) {

            throw new Exception( 'Not an array' );

        }

        $encoded = json_encode( $schema );

        if ( $encoded === false ) {

            throw new Exception( 'Not able to encode' );

        }

        echo '<script type="application/ld+json">' . $encoded . '</script>' . "\n";

    }

    /**
     * @return void
     */
    public function createSchemaWebPageJson() {

        $this->createSchemaJson([
            '@context'      => 'https://schema.org/',
            '@type'         => 'WebPage',
            'name'          => $this->webpageName,
            'description'   => $this->webpageDescription,
            'url'           => $this->webpageUrl
        ]);

    }

    /**
     * @return void
     */
    public function createSchemaItemPageJson() {

        $this->createSchemaJson([
            '@context'      => 'https://schema.org/',
            '@type'         => 'ItemPage',
            'name'          => $this->webpageName,
            'description'   => $this->webpageDescription,
            'url'           => $this->webpageUrl
        ]);

    }

    /**
     * @return void
     */
    public function createSchemaAboutPageJson() {

        $this->createSchemaJson([
            '@context'      => 'https://schema.org/',
            '@type'         => 'AboutPage',
            'name'          => $this->webpageName,
            'description'   => $this->webpageDescription,
            'url'           => $this->webpageUrl
        ]);

    }

    /**
     * @return void
     */
    public function createSchemaCheckouPageJson() {

        $this->createSchemaJson([
            '@context'      => 'https://schema.org/',
            '@type'         => 'CheckoutPage',
            'name'          => $this->webpageName,
            'description'   => $this->webpageDescription,
            'url'           => $this->webpageUrl
        ]);

    }

    /**
     * @param array $settings
     * @return void
     */
    public function setFromGlobSettings( Array $settings ) {

        if ( isset( $settings[ 'shortDescription' ] ) && $settings[ 'shortDescription' ] !== null ) {

            $this->thingDescription = $settings[ 'shortDescription' ];

        }

        if ( isset( $settings[ 'email' ] ) && $settings[ 'email' ] !== null ) {

            $this->organizationEmail = $settings[ 'email' ];

        }

        if ( isset( $settings[ 'phone' ] ) && $settings[ 'phone' ] !== null ) {

            $this->organizationTelephone = str_replace( ' ', '', $settings[ 'phone' ] );

            if ( substr( $this->organizationTelephone, 0, strlen( '+30' ) ) !== '+30') {

                $this->organizationTelephone = '+30' . $this->organizationTelephone;

            }

        }

        if ( isset( $settings[ 'address' ] ) && $settings[ 'address' ] !== null ) {

            $this->postalAddressStreetAddress = $settings[ 'address' ];

        }

        if ( isset( $settings[ 'city' ] ) && $settings[ 'city' ] !== null ) {

            $this->postalAddressAddressLocality = $settings[ 'city' ];

        }

        if ( isset( $settings[ 'postal' ] ) && $settings[ 'postal' ] !== null ) {

            $this->postalAddressPostalCode = $settings[ 'postal' ];

        }

        foreach ( $settings as $setting => $value ) {

            if ( str_starts_with( $setting, 'soc_' ) ) {

                if ( $value !== null ) {

                    $this->thingSameAs[] = $value;

                }

            }

        }

    }

    /**
     * @global string APP_NAME
     * @global string APP_URL
     * @global string APP_LOGO
     * @return void
     */
    public function createSchemaOrganizationJson() {

        $this->createSchemaJson([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => APP_NAME,
            'url' => APP_URL,
            'logo' => APP_LOGO,
            'description' => $this->thingDescription,
            'email' => $this->organizationEmail,
            'telephone' => $this->organizationTelephone,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $this->postalAddressStreetAddress,
                'addressLocality' => $this->postalAddressAddressLocality,
                'postalCode' => $this->postalAddressPostalCode,
                'addressCountry' => 'GR'
            ],
            'sameAs' => $this->thingSameAs
        ]);

    }

}